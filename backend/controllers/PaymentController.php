<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Order;
use App\Services\BancolombiaPaymentService;

class PaymentController extends Controller {

    /**
     * Muestra la vista de Checkout para completar la compra o inscripción
     */
    public function checkout() {
        $currentUser = $this->currentUser();
        $this->view('checkout', ['user' => $currentUser]);
    }

    /**
     * Muestra la vista de pago seguro para una orden específica
     */
    public function pay() {
        $orderNumber = $_GET['order'] ?? null;
        if (!$orderNumber) {
            $this->redirect('/');
        }

        $orderModel = new Order();
        $order = $orderModel->findByOrderNumber($orderNumber);
        if (!$order) {
            $this->redirect('/');
        }

        // Si ya está pagada, redirigir a la vista de respuesta de éxito
        if ($order['status'] === 'paid') {
            $this->redirect('/payment/response?reference=' . urlencode($orderNumber));
        }

        $bancolombiaService = new BancolombiaPaymentService();
        $paymentPayload = $bancolombiaService->prepareCheckoutPayload([
            'order_number' => $order['order_number'],
            'total' => $order['total'],
            'customer_name' => $order['customer_name'],
            'customer_email' => $order['customer_email'],
            'customer_phone' => $order['customer_phone'],
            'customer_document' => $order['customer_document']
        ]);

        $this->view('checkout_payment', [
            'order' => $order,
            'payload' => $paymentPayload
        ]);
    }

    /**
     * Procesa la orden e inicia la transacción con la API de Bancolombia / Wompi
     */
    public function processPayment() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/checkout');
        }

        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        $customerName = trim($_POST['customer_name'] ?? '');
        $customerEmail = trim($_POST['customer_email'] ?? '');
        $customerPhone = trim($_POST['customer_phone'] ?? '');
        $customerDocument = trim($_POST['customer_document'] ?? '');
        $shippingAddress = trim($_POST['shipping_address'] ?? '');
        $city = trim($_POST['city'] ?? 'Cali');
        $department = trim($_POST['department'] ?? 'Valle del Cauca');

        // Leer items de la orden desde POST o Sesión
        $items = isset($_POST['items']) ? json_decode($_POST['items'], true) : [];
        
        if (empty($items) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $items = $_SESSION['cart'];
        }

        if (empty($customerName) || empty($customerEmail) || empty($customerPhone) || empty($customerDocument) || empty($shippingAddress) || empty($items)) {
            $errorMsg = 'Faltan datos obligatorios para procesar la orden o el carrito está vacío.';
            if ($isAjax) {
                $this->json(['success' => false, 'message' => $errorMsg], 400);
            }
            $this->view('checkout', ['error' => $errorMsg]);
            return;
        }

        // Calcular totales
        $subtotal = 0;
        $shippingFee = 0.00;
        $hasPaidShipping = false;
        $maxShipping = 0.00;

        $db = (new \App\Config\Database())->getConnection();

        foreach ($items as $item) {
            $qty = intval($item['quantity'] ?? $item['qty'] ?? $item['cantidad'] ?? 1);
            $price = floatval($item['price'] ?? 0);
            $subtotal += $price * $qty;

            // Verificar envío de cada producto
            $pId = $item['product_id'] ?? $item['id'] ?? null;
            if ($pId && $db) {
                try {
                    $stmt = $db->prepare("SELECT is_free_shipping, shipping_cost FROM products WHERE id = :pid LIMIT 1");
                    $stmt->execute([':pid' => $pId]);
                    $pRow = $stmt->fetch(\PDO::FETCH_ASSOC);
                    if ($pRow) {
                        if ((int)$pRow['is_free_shipping'] === 0) {
                            $hasPaidShipping = true;
                            $sc = (float)$pRow['shipping_cost'];
                            if ($sc > $maxShipping) $maxShipping = $sc;
                        }
                    }
                } catch (\Exception $e) {}
            } elseif (isset($item['is_free_shipping']) && (!$item['is_free_shipping'] || $item['is_free_shipping'] === '0')) {
                $hasPaidShipping = true;
                $sc = floatval($item['shipping_cost'] ?? 0);
                if ($sc > $maxShipping) $maxShipping = $sc;
            }
        }
        $shippingFee = $hasPaidShipping ? ($maxShipping > 0 ? $maxShipping : 12000) : 0.00;
        $total = $subtotal + $shippingFee;

        $currentUser = $this->currentUser();

        $orderData = [
            'user_id' => $currentUser['id'] ?? null,
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'customer_document' => $customerDocument,
            'shipping_address' => $shippingAddress,
            'city' => $city,
            'department' => $department,
            'subtotal' => $subtotal,
            'shipping_fee' => $shippingFee,
            'total' => $total,
            'payment_method' => 'bancolombia_wompi'
        ];

        $orderModel = new Order();
        $createdOrder = $orderModel->createOrder($orderData, $items);

        if (!$createdOrder) {
            $errorMsg = 'Error al registrar la orden de compra. Por favor intenta de nuevo.';
            if ($isAjax) {
                $this->json(['success' => false, 'message' => $errorMsg], 500);
            }
            $this->view('checkout', ['error' => $errorMsg]);
            return;
        }

        // Registrar log de auditoría
        \App\Services\AuditLogService::log('ORDER_CREATE', 'Orden de compra pre-registrada (Pendiente de pago) - Orden: ' . $createdOrder['order_number'], ['order_number' => $createdOrder['order_number'], 'total' => $total], $currentUser['id'] ?? null);

        // Preparar integración con servicio Bancolombia / Wompi
        $bancolombiaService = new BancolombiaPaymentService();
        $paymentPayload = $bancolombiaService->prepareCheckoutPayload([
            'order_number' => $createdOrder['order_number'],
            'total' => $total,
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'customer_document' => $customerDocument
        ]);

        // Guardar registro inicial de pago en estado PENDING
        $orderModel->addPayment([
            'order_id' => $createdOrder['id'],
            'payment_gateway' => 'bancolombia_wompi',
            'transaction_reference' => $createdOrder['order_number'],
            'amount' => $total,
            'currency' => 'COP',
            'status' => 'PENDING',
            'raw_response' => $paymentPayload
        ]);

        if ($isAjax) {
            $this->json([
                'success' => true,
                'message' => 'Orden generada correctamente. Redirigiendo a pasarela Bancolombia...',
                'payload' => $paymentPayload
            ]);
        }

        $this->view('checkout_payment', [
            'order' => $createdOrder,
            'payload' => $paymentPayload
        ]);
    }

    /**
     * Procesa la redirección del cliente al volver del pago con Bancolombia / Wompi
     */
    public function response() {
        $transactionId = $_GET['id'] ?? null;
        $reference = $_GET['reference'] ?? null;

        $orderModel = new Order();
        $bancolombiaService = new BancolombiaPaymentService();

        $transactionData = null;
        if (!empty($transactionId)) {
            $transactionData = $bancolombiaService->getTransactionStatus($transactionId);
        }

        $ref = $reference ?? ($_GET['ref'] ?? null);

        if ($transactionData) {
            $status = strtoupper($transactionData['status'] ?? 'PENDING');
            $ref = $transactionData['reference'] ?? $ref;

            if ($ref) {
                $order = $orderModel->findByOrderNumber($ref);
                if ($order) {
                    $isApproved = ($status === 'APPROVED');
                    $orderStatus = $isApproved ? 'paid' : (($status === 'DECLINED' || $status === 'VOIDED' || $status === 'ERROR') ? 'failed' : 'pending');
                    $orderModel->updateStatus($order['id'], $orderStatus, $ref);
                    $orderModel->updatePaymentStatus($ref, $status, $transactionId, $transactionData);

                    // Garantizar reducción de stock para compras aprobadas
                    if ($isApproved) {
                        $orderModel->reduceStockForOrder((int)$order['id']);
                    }

                    // Registrar log de auditoría
                    \App\Services\AuditLogService::log('PAYMENT_RESPONSE_CALLBACK', 'Respuesta de pasarela recibida para orden ' . $ref . ' - Estado: ' . $status . ' - Transacción Wompi: ' . $transactionId, ['reference' => $ref, 'status' => $status, 'wompi_transaction_id' => $transactionId]);

                    // Si es aprobado, actualizar estado en registrations y enviar correo de bienvenida
                    if ($isApproved) {
                        $registration = \App\Models\Registration::findByOrderNumber($ref);
                        if ($registration && $registration['payment_status'] !== 'paid') {
                            \App\Models\Registration::updatePaymentStatusByOrder($ref, 'paid');
                            $registration['payment_status'] = 'paid';
                            if (!empty($order['total'])) {
                                $registration['payment_amount'] = $order['total'];
                            }
                            
                            // Enviar email de confirmación y bienvenida al participante
                            try {
                                $emailService = new \App\Services\EmailService();
                                $emailService->sendWelcomeEmail($registration);
                            } catch (\Exception $e) {
                                error_log("Error al enviar email en response(): " . $e->getMessage());
                            }
                        }
                    }
                }
            }
        }

        $orderInfo = null;
        if (!empty($ref)) {
            $orderInfo = $orderModel->findByOrderNumber($ref);
        }

        $this->view('payment_response', [
            'transaction' => $transactionData,
            'order' => $orderInfo
        ]);
    }

    /**
     * Endpoint de Webhook asíncrono para notificaciones de Bancolombia / Wompi
     */
    public function webhook() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode(['status' => 'ok', 'message' => 'Wompi Webhook Endpoint Active']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
            return;
        }

        $jsonPayload = file_get_contents('php://input');
        $eventData = json_decode($jsonPayload, true);

        if (!$eventData || empty($eventData['event']) || empty($eventData['data']['transaction'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Payload inválido']);
            return;
        }

        // Obtener la firma/checksum de los headers o del payload
        $headers = function_exists('getallheaders') ? getallheaders() : [];
        $checksumHeader = '';
        foreach ($headers as $key => $val) {
            if (strtolower($key) === 'x-event-checksum') {
                $checksumHeader = $val;
                break;
            }
        }
        if (empty($checksumHeader)) {
            $checksumHeader = $_SERVER['HTTP_X_EVENT_CHECKSUM'] ?? $eventData['signature']['checksum'] ?? '';
        }

        // Validar la autenticidad de la notificación utilizando el servicio de pago
        $bancolombiaService = new BancolombiaPaymentService();
        $isValid = !empty($checksumHeader) && $bancolombiaService->isValidWebhookChecksum($eventData, $checksumHeader);
        
        // Registrar log de auditoría
        $orderModel = new Order();
        $orderModel->logWebhookAttempt([
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            'payload' => $eventData,
            'checksum_received' => $checksumHeader,
            'is_valid' => $isValid,
            'error_message' => $isValid ? null : 'Firma checksum del webhook inválida o ausente'
        ]);

        if (!$isValid) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Firma digital del webhook inválida o ausente']);
            return;
        }

        $tx = $eventData['data']['transaction'];
        $reference = $tx['reference'] ?? null;
        $status = strtoupper($tx['status'] ?? 'PENDING');
        $transactionId = $tx['id'] ?? null;
        $paymentMethodType = $tx['payment_method_type'] ?? null;

        if ($reference) {
            $order = $orderModel->findByOrderNumber($reference);

            if ($order) {
                $isApproved = ($status === 'APPROVED');
                $orderStatus = $isApproved ? 'paid' : (($status === 'DECLINED' || $status === 'VOIDED' || $status === 'ERROR') ? 'failed' : 'pending');
                $orderModel->updateStatus($order['id'], $orderStatus, $reference);
                $orderModel->updatePaymentStatus($reference, $status, $transactionId, $eventData);

                // Registrar log de auditoría
                \App\Services\AuditLogService::log('PAYMENT_WEBHOOK_RECEIVED', 'Notificación Webhook de Wompi procesada para orden ' . $reference . ' - Estado: ' . $status . ' - Transacción Wompi: ' . $transactionId, ['reference' => $reference, 'status' => $status, 'wompi_transaction_id' => $transactionId]);

                // Si es aprobado, actualizar estado en registrations y enviar correo de bienvenida
                if ($isApproved) {
                    $registration = \App\Models\Registration::findByOrderNumber($reference);
                    if ($registration && $registration['payment_status'] !== 'paid') {
                        \App\Models\Registration::updatePaymentStatusByOrder($reference, 'paid');
                        $registration['payment_status'] = 'paid';
                        if (!empty($order['total'])) {
                            $registration['payment_amount'] = $order['total'];
                        }
                        
                        // Enviar email de bienvenida asíncronamente
                        try {
                            $emailService = new \App\Services\EmailService();
                            $emailService->sendWelcomeEmail($registration);
                        } catch (\Exception $e) {
                            error_log("Error al enviar email en webhook(): " . $e->getMessage());
                        }
                    }
                }
            }
        }

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Evento de pago procesado exitosamente']);
    }
}
