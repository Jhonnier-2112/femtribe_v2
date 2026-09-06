<?php
/**
 * Script CLI para reenviar correos oficiales de confirmación de pago e inscripción.
 *
 * Ejemplos de uso desde la terminal o Hostinger SSH:
 *   php backend/scripts/send_confirmation_email.php --all-paid
 *   php backend/scripts/send_confirmation_email.php FT-20260905-691F
 *   php backend/scripts/send_confirmation_email.php --id=22
 */

require_once __DIR__ . '/../config/config.php';

$arg = $argv[1] ?? '';

if (empty($arg) || $arg === '--help' || $arg === '-h') {
    echo "===========================================================\n";
    echo "  FEMTRIBE - Enviar Correo de Confirmación de Pago\n";
    echo "===========================================================\n";
    echo "Uso:\n";
    echo "  php backend/scripts/send_confirmation_email.php --all-paid\n";
    echo "    -> Envía el correo a TODOS los participantes con payment_status = 'paid'\n\n";
    echo "  php backend/scripts/send_confirmation_email.php [NUMERO_ORDEN]\n";
    echo "    -> Envía el correo a la orden especificada (ej. FT-20260905-040C)\n\n";
    echo "  php backend/scripts/send_confirmation_email.php --id=[ID_INSCRIPCION]\n";
    echo "    -> Envía el correo a la inscripción con el ID dado (ej. --id=21)\n";
    echo "===========================================================\n";
    exit(0);
}

$db = (new \App\Config\Database())->getConnection();
$emailService = new \App\Services\EmailService();

if ($arg === '--all-paid') {
    echo "Buscando todas las inscripciones con payment_status = 'paid'...\n";
    $stmt = $db->query("SELECT * FROM registrations WHERE payment_status = 'paid' ORDER BY id ASC");
    $registrations = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

    if (empty($registrations)) {
        echo "No se encontraron inscripciones pagadas.\n";
        exit(0);
    }

    echo "Total inscripciones encontradas: " . count($registrations) . "\n\n";
    $success = 0;
    $failed = 0;

    foreach ($registrations as $reg) {
        $name = trim($reg['nombres'] . ' ' . $reg['apellidos']);
        $email = $reg['email'];
        $order = $reg['order_number'] ?? 'N/A';

        echo "Enviando a {$name} ({$email}) - Orden: {$order}... ";
        try {
            if ($emailService->sendWelcomeEmail($reg)) {
                echo "OK (Enviado)\n";
                $success++;
            } else {
                echo "FALLÓ\n";
                $failed++;
            }
        } catch (\Throwable $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
            $failed++;
        }
    }

    echo "\nResumen: {$success} enviados con éxito, {$failed} fallidos.\n";
    exit(0);
}

// Buscar por ID específico
if (str_starts_with($arg, '--id=')) {
    $id = intval(substr($arg, 5));
    $stmt = $db->prepare("SELECT * FROM registrations WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id]);
    $reg = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reg) {
        echo "Error: No se encontró ninguna inscripción con ID {$id}.\n";
        exit(1);
    }

    $name = trim($reg['nombres'] . ' ' . $reg['apellidos']);
    echo "Enviando correo a {$name} ({$reg['email']}) - Orden: " . ($reg['order_number'] ?? 'N/A') . "...\n";

    try {
        if ($emailService->sendWelcomeEmail($reg)) {
            echo "¡Éxito! Correo de confirmación enviado correctamente a {$reg['email']}.\n";
            exit(0);
        } else {
            echo "Error: No se pudo entregar el correo.\n";
            exit(1);
        }
    } catch (\Throwable $e) {
        echo "Excepción al enviar: " . $e->getMessage() . "\n";
        exit(1);
    }
}

// Buscar por número de orden
$orderNumber = trim($arg);
$stmt = $db->prepare("SELECT * FROM registrations WHERE order_number = :ord LIMIT 1");
$stmt->execute([':ord' => $orderNumber]);
$reg = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reg) {
    // Si no está en registrations por orden, buscar en orders
    $oStmt = $db->prepare("SELECT * FROM orders WHERE order_number = :ord LIMIT 1");
    $oStmt->execute([':ord' => $orderNumber]);
    $ord = $oStmt->fetch(PDO::FETCH_ASSOC);

    if (!$ord) {
        echo "Error: No se encontró ninguna orden o inscripción con referencia '{$orderNumber}'.\n";
        exit(1);
    }

    // Intentar buscar inscripción por email del cliente de la orden
    $rStmt = $db->prepare("SELECT * FROM registrations WHERE email = :email ORDER BY id DESC LIMIT 1");
    $rStmt->execute([':email' => $ord['customer_email']]);
    $reg = $rStmt->fetch(PDO::FETCH_ASSOC);

    if (!$reg) {
        echo "Error: Se encontró la orden {$orderNumber} pero no tiene un registro de inscripción asociado.\n";
        exit(1);
    }
}

$name = trim($reg['nombres'] . ' ' . $reg['apellidos']);
echo "Enviando correo a {$name} ({$reg['email']}) - Orden: {$orderNumber}...\n";

try {
    if ($emailService->sendWelcomeEmail($reg)) {
        echo "¡Éxito! Correo de confirmación enviado correctamente a {$reg['email']}.\n";
    } else {
        echo "Error: No se pudo entregar el correo.\n";
        exit(1);
    }
} catch (\Throwable $e) {
    echo "Excepción al enviar: " . $e->getMessage() . "\n";
    exit(1);
}
