<?php
$title = "Resultado de Transacción | FEMTRIBE";
require __DIR__ . '/layouts/header.php';

$tx = $transaction ?? [];
$ord = $order ?? [];
$txId = $transactionId ?? ($tx['id'] ?? ($_GET['id'] ?? ''));
$orderRef = $reference ?? ($ord['order_number'] ?? ($_GET['reference'] ?? ($_GET['ref'] ?? '')));
$status = strtoupper($status ?? ($tx['status'] ?? ($ord['status'] ?? 'PENDING')));
?>

<div class="container py-5" style="margin-top: 100px; padding-top: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 text-center p-4 p-md-5" id="paymentResultCard">
                <?php if ($status === 'APPROVED' || $status === 'PAID'): ?>
                    <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-check-circle fa-3x"></i>
                    </div>
                    <h2 class="fw-bold text-success mb-1">¡Pago Aprobado!</h2>
                    <p class="text-muted mb-3">Tu transacción ha sido procesada con éxito por Bancolombia / Wompi.</p>
                    <div class="alert alert-success bg-success bg-opacity-10 border-0 rounded-3 py-2 px-3 small text-start mb-4">
                        <i class="fas fa-envelope-open-text text-success me-2"></i>
                        Hemos enviado el <strong>correo oficial de confirmación</strong> con todos los detalles y el número de comprobante a tu dirección de correo electrónico.
                    </div>
                <?php elseif ($status === 'PENDING'): ?>
                    <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-clock fa-3x" id="pendingIcon"></i>
                    </div>
                    <h2 class="fw-bold text-warning mb-1" id="statusTitle">Pago en Verificación</h2>
                    <p class="text-muted mb-3" id="statusSubtitle">Tu pago está siendo verificado por la pasarela de Wompi / Bancolombia</p>

                    <!-- Indicador de Polling en Vivo -->
                    <div id="pollingIndicator" class="alert alert-warning bg-warning bg-opacity-10 border-0 rounded-3 py-2 px-3 small mb-4 d-flex align-items-center justify-content-center gap-2">
                        <span class="spinner-border spinner-border-sm text-warning" role="status" aria-hidden="true"></span>
                        <span id="pollingText">Comprobando aprobación bancaria en tiempo real...</span>
                    </div>
                <?php else: ?>
                    <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-times-circle fa-3x"></i>
                    </div>
                    <h2 class="fw-bold text-danger mb-1">Transacción No Aprobada</h2>
                    <p class="text-muted mb-4">No se pudo completar el pago. Por favor intenta de nuevo o prueba con otro medio de pago.</p>
                <?php endif; ?>

                <?php if (!empty($ord)): ?>
                    <div class="bg-light p-3 rounded-3 text-start mb-4 border">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Número de Orden:</span>
                            <span class="fw-bold text-dark"><?= htmlspecialchars($ord['order_number'] ?? $orderRef) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Total:</span>
                            <span class="fw-bold <?= ($status === 'APPROVED' || $status === 'PAID') ? 'text-success' : 'text-danger' ?>">$<?= number_format($ord['total'], 0, ',', '.') ?> COP</span>
                        </div>
                        <?php if (!empty($ord['customer_name'])): ?>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Cliente:</span>
                                <span class="fw-semibold text-dark"><?= htmlspecialchars($ord['customer_name']) ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($txId)): ?>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">ID Transacción Wompi:</span>
                                <span class="fw-bold font-monospace small text-dark"><?= htmlspecialchars($txId) ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Pasarela de Pago:</span>
                            <span class="badge bg-dark text-uppercase">Bancolombia / Wompi</span>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="d-grid gap-2" id="actionButtons">
                    <?php if ($status === 'APPROVED' || $status === 'PAID'): ?>
                        <a href="/perfil" class="btn text-white py-2.5 rounded-3 fw-bold shadow-sm" style="background-color: #6da632; border: none;">
                            <i class="fas fa-user me-2"></i>Ir a Mi Perfil
                        </a>
                        <a href="/productos" class="btn btn-outline-dark py-2.5 rounded-3 fw-bold">
                            <i class="fas fa-shopping-bag me-2"></i>Volver a la Tienda
                        </a>
                    <?php elseif ($status === 'PENDING'): ?>
                        <button type="button" id="btnManualCheck" class="btn text-white py-2.5 rounded-3 fw-bold shadow-sm" style="background-color: #6da632; border: none;">
                            <i class="fas fa-sync-alt me-2"></i>Consultar Estado Ahora
                        </button>
                        <a href="/perfil" class="btn btn-outline-dark py-2.5 rounded-3 fw-bold">
                            <i class="fas fa-user me-2"></i>Ver mi pedido en Perfil
                        </a>
                    <?php else: ?>
                        <a href="/checkout" class="btn btn-danger py-2.5 rounded-3 fw-bold">
                            <i class="fas fa-redo me-2"></i>Reintentar Pago
                        </a>
                        <a href="/carrito" class="btn btn-outline-dark py-2.5 rounded-3 fw-bold">
                            <i class="fas fa-shopping-cart me-2"></i>Volver al Carrito
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Limpiar carrito si el pago fue aprobado
<?php if ($status === 'APPROVED' || $status === 'PAID'): ?>
try {
    localStorage.removeItem('ft_cart');
    sessionStorage.removeItem('cart');
} catch(e) {}
<?php endif; ?>

// Auto-verificación en tiempo real si el estado es PENDING
<?php if ($status === 'PENDING' && (!empty($txId) || !empty($orderRef))): ?>
(function() {
    const txId = <?= json_encode($txId) ?>;
    const orderRef = <?= json_encode($orderRef) ?>;
    let attempts = 0;
    const maxAttempts = 12; // 12 intentos x 3s = 36 segundos
    let pollingInterval = null;

    function checkPaymentStatus() {
        attempts++;
        const checkUrl = `/payment/check-status?id=${encodeURIComponent(txId || '')}&reference=${encodeURIComponent(orderRef || '')}`;

        fetch(checkUrl, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            console.log('[Wompi Poll] Intento ' + attempts + ':', data);
            if (data && data.status === 'APPROVED') {
                if (pollingInterval) clearInterval(pollingInterval);
                try {
                    localStorage.removeItem('ft_cart');
                    sessionStorage.removeItem('cart');
                } catch(e) {}
                
                // Recargar para mostrar la vista oficial de aprobación y confirmación
                window.location.reload();
            } else if (data && (data.status === 'DECLINED' || data.status === 'VOIDED' || data.status === 'ERROR')) {
                if (pollingInterval) clearInterval(pollingInterval);
                window.location.reload();
            } else if (attempts >= maxAttempts) {
                if (pollingInterval) clearInterval(pollingInterval);
                const indicator = document.getElementById('pollingIndicator');
                if (indicator) {
                    indicator.className = 'alert alert-light border rounded-3 py-2 px-3 small mb-4 text-muted';
                    indicator.innerHTML = '<i class="fas fa-info-circle me-1"></i> El banco está procesando tu transacción. Te notificaremos por correo electrónico apenas sea confirmada.';
                }
            }
        })
        .catch(err => {
            console.warn('[Wompi Poll] Error consultando:', err);
        });
    }

    // Iniciar polling cada 3 segundos
    pollingInterval = setInterval(checkPaymentStatus, 3000);

    // Botón manual de consulta
    const manualBtn = document.getElementById('btnManualCheck');
    if (manualBtn) {
        manualBtn.addEventListener('click', function() {
            manualBtn.disabled = true;
            manualBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Consultando...';
            fetch(`/payment/check-status?id=${encodeURIComponent(txId || '')}&reference=${encodeURIComponent(orderRef || '')}`)
                .then(r => r.json())
                .then(d => {
                    if (d.status === 'APPROVED' || d.paid) {
                        window.location.reload();
                    } else {
                        alert('Estado actual: ' + d.status + '. Tu pago aún se encuentra en validación.');
                        manualBtn.disabled = false;
                        manualBtn.innerHTML = '<i class="fas fa-sync-alt me-2"></i>Consultar Estado Ahora';
                    }
                })
                .catch(e => {
                    manualBtn.disabled = false;
                    manualBtn.innerHTML = '<i class="fas fa-sync-alt me-2"></i>Consultar Estado Ahora';
                });
        });
    }
})();
<?php endif; ?>
</script>

<?php require __DIR__ . '/layouts/footer.php'; ?>

