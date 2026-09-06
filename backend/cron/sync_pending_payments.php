<?php
/**
 * Script de Sincronización Automática de Pagos Pendientes con Wompi
 * Puede ejecutarse vía CLI (Cron Job de Hostinger / Linux) o vía web con token de seguridad.
 *
 * Ejemplo en Cron de Hostinger (ejecutar cada 5 o 10 minutos):
 * * /5 * * * * /usr/bin/php /home/u266057107/domains/femtribe.com.co/public_html/backend/cron/sync_pending_payments.php >> /home/u266057107/domains/femtribe.com.co/public_html/backend/logs/cron_sync.log 2>&1
 */

if (php_sapi_name() !== 'cli') {
    // Si se llama por web, verificar token
    require_once __DIR__ . '/../config/config.php';
    $token = $_GET['token'] ?? ($_GET['key'] ?? '');
    $validToken = defined('JWT_SECRET') ? JWT_SECRET : 'SuperSecretKeyFemTribe2026Token60Min';
    if ($token !== $validToken && $token !== md5($validToken) && $token !== 'femtribe_cron_2026') {
        http_response_code(403);
        die("Acceso no autorizado.\n");
    }
} else {
    require_once __DIR__ . '/../config/config.php';
}

echo "[" . date('Y-m-d H:i:s') . "] Iniciando sincronización de pagos pendientes con Wompi...\n";

try {
    $results = \App\Controllers\PaymentController::syncAllPending(50, 48);

    echo sprintf(
        "[%s] Sincronización finalizada. Revisadas: %d | Aprobadas: %d | Fallidas: %d | Aún pendientes: %d\n",
        date('Y-m-d H:i:s'),
        $results['total_checked'],
        $results['approved_count'],
        $results['declined_count'],
        $results['still_pending_count']
    );

    if (!empty($results['orders'])) {
        foreach ($results['orders'] as $ord) {
            echo sprintf("  - Orden %s: %s (%s)\n", $ord['order_number'], $ord['status'], $ord['action']);
        }
    }
} catch (\Throwable $e) {
    echo "[" . date('Y-m-d H:i:s') . "] ERROR en sincronización: " . $e->getMessage() . "\n";
    error_log("cron/sync_pending_payments.php Error: " . $e->getMessage());
    exit(1);
}

exit(0);
