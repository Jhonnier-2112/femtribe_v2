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
        $reference = $_GET['reference'] ?? ($_GET['ref'] ?? null);

        $orderModel = new Order();
        $bancolombiaService = new BancolombiaPaymentService();

        $transactionData = null;
        if (!empty($transactionId)) {
            $transactionData = $bancolombiaService->getTransactionStatus($transactionId);
        }

        $ref = $reference;
        if ($transactionData && !empty($transactionData['reference'])) {
            $ref = $transactionData['reference'];
        }

        $status = 'PENDING';
        if ($transactionData && !empty($transactionData['status'])) {
            $status = strtoupper($transactionData['status']);
        }

        // Buscar orden asociada
        $order = null;
        if (!empty($ref)) {
            $order = $orderModel->findByOrderNumber($ref);
        }
        if (!$order && !empty($transactionId)) {
            $order = $orderModel->findByTransactionId($transactionId);
            if ($order) {
                $ref = $order['order_number'];
            }
        }

        // Si Wompi indica que la transacción está aprobada:
        if ($status === 'APPROVED' && !empty($ref)) {
            self::processApprovedPayment($ref, 'APPROVED', $transactionId, $transactionData);
            if ($order) {
                $order['status'] = 'paid';
            }
        } elseif (in_array($status, ['DECLINED', 'VOIDED', 'ERROR']) && $order) {
            $orderModel->updateStatus((int)$order['id'], 'failed', $ref);
            $orderModel->updatePaymentStatus($ref, $status, $transactionId, $transactionData);
            $order['status'] = 'failed';
        }

        // Si la orden ya estaba registrada como 'paid' en la BD (ej. por webhook simultáneo):
        if ($order && $order['status'] === 'paid') {
            $status = 'APPROVED';
        }

        $this->view('payment_response', [
            'transaction' => $transactionData,
            'order' => $order,
            'status' => $status,
            'transactionId' => $transactionId,
            'reference' => $ref
        ]);
    }

    /**
     * Endpoint AJAX para polling en tiempo real del estado del pago desde payment_response
     */
    public function checkStatus() {
        header('Content-Type: application/json');

        $transactionId = $_GET['id'] ?? null;
        $reference = $_GET['reference'] ?? ($_GET['ref'] ?? null);

        $orderModel = new Order();
        $order = null;

        if (!empty($reference)) {
            $order = $orderModel->findByOrderNumber($reference);
        }
        if (!$order && !empty($transactionId)) {
            $order = $orderModel->findByTransactionId($transactionId);
            if ($order) {
                $reference = $order['order_number'];
            }
        }

        // Si ya está pagada en base de datos:
        if ($order && $order['status'] === 'paid') {
            echo json_encode([
                'success' => true,
                'status' => 'APPROVED',
                'paid' => true,
                'message' => 'Pago confirmado y aprobado.'
            ]);
            return;
        }

        // Si tenemos transactionId, consultar la API de Wompi
        if (!empty($transactionId)) {
            $bancolombiaService = new BancolombiaPaymentService();
            $txData = $bancolombiaService->getTransactionStatus($transactionId);

            if ($txData && !empty($txData['status'])) {
                $status = strtoupper($txData['status']);
                $ref = $txData['reference'] ?? $reference;

                if ($status === 'APPROVED' && !empty($ref)) {
                    self::processApprovedPayment($ref, 'APPROVED', $transactionId, $txData);
                    echo json_encode([
                        'success' => true,
                        'status' => 'APPROVED',
                        'paid' => true,
                        'message' => 'Pago aprobado exitosamente.'
                    ]);
                    return;
                }

                echo json_encode([
                    'success' => true,
                    'status' => $status,
                    'paid' => false,
                    'message' => 'Estado actual: ' . $status
                ]);
                return;
            }
        }

        $currentStatus = $order['status'] ?? 'pending';
        echo json_encode([
            'success' => true,
            'status' => strtoupper($currentStatus),
            'paid' => ($currentStatus === 'paid'),
            'message' => 'Verificando transacción...'
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

        // Validar autenticidad de la firma
        $bancolombiaService = new BancolombiaPaymentService();
        $isValid = !empty($checksumHeader) && $bancolombiaService->isValidWebhookChecksum($eventData, $checksumHeader);

        $tx = $eventData['data']['transaction'];
        $transactionId = $tx['id'] ?? null;
        $reference = $tx['reference'] ?? null;
        $status = strtoupper($tx['status'] ?? 'PENDING');

        // FALLBACK DE SEGURIDAD CRÍTICO:
        // Si el checksum falló (por ejemplo, secreto de eventos no configurado o erróneo en .env de producción),
        // consultamos directamente la API oficial de Wompi mediante la llave privada/pública para verificar de forma segura.
        if (!$isValid && !empty($transactionId)) {
            $verifiedTx = $bancolombiaService->getTransactionStatus($transactionId);
            if ($verifiedTx && !empty($verifiedTx['id']) && $verifiedTx['id'] === $transactionId) {
                $isValid = true;
                $status = strtoupper($verifiedTx['status'] ?? $status);
                $reference = $verifiedTx['reference'] ?? $reference;
                $eventData['data']['transaction'] = $verifiedTx;
                \App\Services\AuditLogService::log(
                    'PAYMENT_WEBHOOK_API_FALLBACK',
                    'Firma de webhook verificada autoritativamente consultando API de Wompi para orden ' . $reference . ' - Estado: ' . $status,
                    ['transaction_id' => $transactionId, 'status' => $status]
                );
            }
        }

        // Registrar log de auditoría del intento
        $orderModel = new Order();
        $orderModel->logWebhookAttempt([
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            'payload' => $eventData,
            'checksum_received' => $checksumHeader,
            'is_valid' => $isValid,
            'error_message' => $isValid ? null : 'Firma checksum del webhook inválida y no pudo verificarse por API oficial'
        ]);

        if (!$isValid) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Firma digital del webhook inválida']);
            return;
        }

        if ($reference && $status === 'APPROVED') {
            self::processApprovedPayment($reference, 'APPROVED', $transactionId, $eventData);
            \App\Services\AuditLogService::log(
                'PAYMENT_WEBHOOK_RECEIVED',
                'Notificación Webhook procesada exitosamente para orden ' . $reference . ' - Estado: ' . $status,
                ['reference' => $reference, 'status' => $status, 'wompi_transaction_id' => $transactionId]
            );
        } elseif ($reference && in_array($status, ['DECLINED', 'VOIDED', 'ERROR'])) {
            $order = $orderModel->findByOrderNumber($reference);
            if ($order) {
                $orderModel->updateStatus((int)$order['id'], 'failed', $reference);
                $orderModel->updatePaymentStatus($reference, $status, $transactionId, $eventData);
            }
        }

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Evento de pago procesado exitosamente']);
    }

    /**
     * Procesa de forma unificada e idempotente una orden aprobada:
     * 1. Actualiza orden a 'paid'
     * 2. Actualiza registro en tabla payments con ID de transacción
     * 3. Reduce stock de productos
     * 4. Actualiza registro de inscripción a 'paid'
     * 5. Envía correo de confirmación y bienvenida
     * 6. Registra log de auditoría
     */
    public static function processApprovedPayment(string $reference, string $status = 'APPROVED', ?string $transactionId = null, $rawData = null): array {
        $orderModel = new Order();
        $order = $orderModel->findByOrderNumber($reference);

        if (!$order && !empty($transactionId)) {
            $order = $orderModel->findByTransactionId($transactionId);
            if ($order) {
                $reference = $order['order_number'];
            }
        }

        if (!$order) {
            return [
                'success' => false,
                'message' => "Orden {$reference} no encontrada en la base de datos."
            ];
        }

        $orderId = (int)$order['id'];
        $wasAlreadyPaid = ($order['status'] === 'paid');

        // 1. Actualizar orden a 'paid'
        $orderModel->updateStatus($orderId, 'paid', $reference);

        // 2. Actualizar registro en payments
        $orderModel->updatePaymentStatus($reference, 'APPROVED', $transactionId, $rawData);

        // 3. Reducir stock de productos adquiridos
        $orderModel->reduceStockForOrder($orderId);

        // 4. Actualizar inscripción asociada y enviar correo de confirmación
        $registrationUpdated = false;
        $emailSent = false;
        $emailError = null;

        $registration = \App\Models\Registration::findByOrderNumber($reference);
        if ($registration) {
            \App\Models\Registration::updatePaymentStatusByOrder($reference, 'paid');
            $registration['payment_status'] = 'paid';
            if (!empty($order['total'])) {
                $registration['payment_amount'] = $order['total'];
            }
            $registrationUpdated = true;

            // Enviar email oficial de confirmación y bienvenida al corredor
            try {
                $emailService = new \App\Services\EmailService();
                $emailSent = (bool)$emailService->sendWelcomeEmail($registration);
                \App\Services\AuditLogService::log(
                    'PAYMENT_EMAIL_SENT',
                    'Correo de confirmación de inscripción y pago enviado exitosamente a ' . ($registration['email'] ?? ''),
                    ['order' => $reference, 'email' => $registration['email'] ?? '', 'success' => $emailSent]
                );
            } catch (\Throwable $e) {
                $emailError = $e->getMessage();
                error_log("Error al enviar email de confirmación para orden {$reference}: " . $emailError);
                \App\Services\AuditLogService::log(
                    'PAYMENT_EMAIL_FAILED',
                    'Error al enviar correo de confirmación para orden ' . $reference . ': ' . $emailError,
                    ['order' => $reference, 'error' => $emailError]
                );
            }
        }

        // 5. Registrar log de auditoría
        \App\Services\AuditLogService::log(
            'PAYMENT_APPROVED_PROCESSED',
            "Pago aprobado procesado para orden {$reference} - Monto: $" . number_format((float)$order['total'], 0, ',', '.') . " COP",
            [
                'order_id' => $orderId,
                'order_number' => $reference,
                'wompi_transaction_id' => $transactionId,
                'was_already_paid' => $wasAlreadyPaid,
                'registration_updated' => $registrationUpdated,
                'email_sent' => $emailSent,
                'email_error' => $emailError
            ]
        );

        return [
            'success' => true,
            'order_id' => $orderId,
            'order_number' => $reference,
            'was_already_paid' => $wasAlreadyPaid,
            'registration_updated' => $registrationUpdated,
            'email_sent' => $emailSent,
            'email_error' => $emailError
        ];
    }

    /**
     * Sincroniza en lote todas las órdenes pendientes consultando el estado oficial en Wompi.
     * Si Wompi indica que están aprobadas, las procesa, envía el correo de bienvenida y actualiza inventario.
     */
    public static function syncAllPending(int $limit = 50, int $hoursBack = 48): array {
        $database = new \App\Config\Database();
        $db = $database->getConnection();
        $bancolombiaService = new BancolombiaPaymentService();
        $orderModel = new Order();

        $stmt = $db->prepare("
            SELECT o.id, o.order_number, o.total, o.customer_email, o.customer_name, o.created_at,
                   (SELECT p.gateway_transaction_id FROM payments p WHERE p.order_id = o.id AND p.gateway_transaction_id IS NOT NULL ORDER BY p.id DESC LIMIT 1) AS gateway_transaction_id
            FROM orders o
            WHERE o.status = 'pending' 
              AND o.created_at >= DATE_SUB(NOW(), INTERVAL :hours HOUR)
            ORDER BY o.id DESC
            LIMIT :limit
        ");
        $stmt->bindValue(':hours', $hoursBack, \PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        $pendingOrders = $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];

        $results = [
            'total_checked' => count($pendingOrders),
            'approved_count' => 0,
            'declined_count' => 0,
            'still_pending_count' => 0,
            'orders' => []
        ];

        foreach ($pendingOrders as $ord) {
            $ref = $ord['order_number'];
            $txId = $ord['gateway_transaction_id'] ?? null;
            $txData = null;

            // 1. Consultar por Transaction ID si existe
            if (!empty($txId)) {
                $txData = $bancolombiaService->getTransactionStatus($txId);
            }

            // 2. Si no se encontró o no está aprobada, consultar por Referencia de la orden
            if (!$txData || (isset($txData['status']) && strtoupper($txData['status']) !== 'APPROVED')) {
                $refTxData = $bancolombiaService->getTransactionByReference($ref);
                if ($refTxData) {
                    $txData = $refTxData;
                    if (!empty($txData['id'])) {
                        $txId = $txData['id'];
                    }
                }
            }

            if (!$txData) {
                $results['still_pending_count']++;
                $results['orders'][] = [
                    'order_number' => $ref,
                    'status' => 'PENDING',
                    'action' => 'no_transaction_found_yet'
                ];
                continue;
            }

            $wompiStatus = strtoupper($txData['status'] ?? 'PENDING');

            if ($wompiStatus === 'APPROVED') {
                $processRes = self::processApprovedPayment($ref, 'APPROVED', $txId, $txData);
                $results['approved_count']++;
                $results['orders'][] = [
                    'order_number' => $ref,
                    'status' => 'APPROVED',
                    'action' => 'marked_as_paid_and_email_sent',
                    'email_sent' => $processRes['email_sent'] ?? false,
                    'email_error' => $processRes['email_error'] ?? null
                ];
            } elseif (in_array($wompiStatus, ['DECLINED', 'VOIDED', 'ERROR'])) {
                $orderModel->updateStatus((int)$ord['id'], 'failed', $ref);
                $orderModel->updatePaymentStatus($ref, $wompiStatus, $txId, $txData);
                $results['declined_count']++;
                $results['orders'][] = [
                    'order_number' => $ref,
                    'status' => $wompiStatus,
                    'action' => 'marked_as_failed'
                ];
            } else {
                $results['still_pending_count']++;
                $results['orders'][] = [
                    'order_number' => $ref,
                    'status' => $wompiStatus,
                    'action' => 'waiting_confirmation'
                ];
            }
        }

        return $results;
    }

    /**
     * Endpoint para ejecución programada (Cron Job) o llamada administrativa de sincronización
     */
    public function syncPendingPayments() {
        // Validar autorización
        $isCli = (php_sapi_name() === 'cli' && empty($_SERVER['HTTP_HOST']));
        $isAdmin = (!empty($_SESSION['admin_logged_in']) || (!empty($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'));
        $token = $_GET['token'] ?? ($_GET['key'] ?? '');
        $validToken = defined('JWT_SECRET') ? JWT_SECRET : 'SuperSecretKeyFemTribe2026Token60Min';

        $isAuthorized = $isCli || $isAdmin || (!empty($token) && ($token === $validToken || $token === md5($validToken) || $token === 'femtribe_cron_2026'));

        if (!$isAuthorized) {
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'No autorizado']);
            return;
        }

        $limit = isset($_GET['limit']) ? max(1, min(100, intval($_GET['limit']))) : 50;
        $hours = isset($_GET['hours']) ? max(1, min(168, intval($_GET['hours']))) : 48;

        $syncResults = self::syncAllPending($limit, $hours);

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'timestamp' => date('Y-m-d H:i:s'),
            'summary' => [
                'total_checked' => $syncResults['total_checked'],
                'approved' => $syncResults['approved_count'],
                'declined' => $syncResults['declined_count'],
                'still_pending' => $syncResults['still_pending_count']
            ],
            'details' => $syncResults['orders']
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

