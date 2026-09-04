<?php
$title = "Pagar Orden | FEMTRIBE";
require __DIR__ . '/layouts/header.php';

$ord = $order ?? [];
$pay = $payload ?? [];
?>

<div class="container py-5" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <!-- Header del Card con gradiente de FEMTRIBE (Verde/Oscuro) -->
                <div class="card-header border-0 py-4 text-center text-white" style="background: linear-gradient(135deg, #1a1a1a 0%, #2e2e2e 100%); border-bottom: 3px solid #87CC3E !important;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light bg-opacity-10 rounded-circle mb-2" style="width: 60px; height: 60px;">
                        <i class="fas fa-shield-alt fa-2x text-warning"></i>
                    </div>
                    <h3 class="fw-bold mb-0">Pasarela de Pago Seguro</h3>
                    <p class="text-light text-opacity-75 small mb-0">Transacción procesada de forma segura por Wompi / Bancolombia</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <!-- Resumen del Pedido -->
                    <div class="bg-light p-4 rounded-4 mb-4 border border-1 border-light-subtle">
                        <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">
                            <i class="fas fa-file-invoice-dollar me-2 text-secondary"></i>Resumen de tu Orden
                        </h5>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Número de Referencia:</span>
                            <span class="fw-bold text-dark"><?= htmlspecialchars($ord['order_number'] ?? $pay['reference'] ?? '') ?></span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Cliente:</span>
                            <span class="fw-semibold text-dark"><?= htmlspecialchars($ord['customer_name'] ?? $pay['customerData']['fullName'] ?? '') ?></span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Correo de Contacto:</span>
                            <span class="text-dark"><?= htmlspecialchars($pay['customerData']['email'] ?? '') ?></span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Teléfono:</span>
                            <span class="text-dark"><?= htmlspecialchars($pay['customerData']['phoneNumber'] ?? '') ?></span>
                        </div>

                        <hr class="my-3">

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted fw-bold">Total a Pagar:</span>
                            <span class="fs-4 fw-extrabold text-success" style="color: #6da632 !important;">$<?= number_format($ord['total'] ?? ($pay['amountInCents'] / 100), 0, ',', '.') ?> COP</span>
                        </div>
                    </div>

                    <!-- Instrucciones de Pago -->
                    <div class="text-center mb-4">
                        <p class="text-muted small">
                            Haz clic en el botón de abajo para abrir la ventana de pago seguro de Wompi. Podrás pagar usando <strong>Nequi, PSE, Cuenta Bancolombia, Tarjetas de Crédito o Débito</strong>.
                        </p>
                    </div>

                    <!-- Botón/Widget de Wompi -->
                    <div class="d-flex flex-column align-items-center py-2" id="wompiWidgetContainer">
                        <!-- Botón Principal Interactivo -->
                        <button type="button" id="btnWompiPay" class="btn btn-success fw-bold py-3 px-4 w-100 rounded-4 shadow-lg mb-3" style="background-color: #87CC3E; border: none; color: #1a1a1a; font-size: 1.15rem; cursor: pointer;">
                            <i class="fas fa-lock me-2"></i>Pagar $<?= number_format($ord['total'] ?? (($pay['amountInCents'] ?? 0) / 100), 0, ',', '.') ?> COP con Wompi
                        </button>

                        <!-- Formulario Oficial de Wompi -->
                        <form action="" method="GET" id="wompiPaymentForm" class="w-100 text-center">
                            <script
                                src="https://checkout.wompi.co/widget.js"
                                data-render="button"
                                data-public-key="<?= htmlspecialchars($pay['publicKey'] ?? '') ?>"
                                data-currency="<?= htmlspecialchars($pay['currency'] ?? 'COP') ?>"
                                data-amount-in-cents="<?= htmlspecialchars($pay['amountInCents'] ?? '') ?>"
                                data-reference="<?= htmlspecialchars($pay['reference'] ?? '') ?>"
                                data-signature:integrity="<?= htmlspecialchars($pay['signature'] ?? '') ?>"
                                data-redirect-url="<?= htmlspecialchars($pay['redirectUrl'] ?? '') ?>"
                                data-customer-data:email="<?= htmlspecialchars($pay['customerData']['email'] ?? '') ?>"
                                data-customer-data:full-name="<?= htmlspecialchars($pay['customerData']['fullName'] ?? '') ?>"
                                data-customer-data:phone-number="<?= htmlspecialchars($pay['customerData']['phoneNumber'] ?? '') ?>"
                                data-customer-data:legal-id="<?= htmlspecialchars($pay['customerData']['legalId'] ?? '') ?>"
                                data-customer-data:legal-id-type="CC"
                            >
                            </script>
                        </form>
                    </div>

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const mainBtn = document.getElementById('btnWompiPay');
                        if (!mainBtn) return;

                        mainBtn.addEventListener('click', function(e) {
                            e.preventDefault();

                            // 1. Intentar hacer clic en el botón inyectado por el script oficial de Wompi
                            const injectedBtn = document.querySelector('#wompiPaymentForm button, #wompiPaymentForm .wompi-button-wpro');
                            if (injectedBtn && injectedBtn !== mainBtn && typeof injectedBtn.click === 'function') {
                                console.log('Ejecutando clic sobre el botón inyectado de Wompi...');
                                injectedBtn.click();
                                return;
                            }

                            // 2. Si no hay botón inyectado, lanzar con WidgetCheckout JS
                            function launchWidgetCheckout() {
                                if (typeof WidgetCheckout !== 'undefined') {
                                    try {
                                        var checkout = new WidgetCheckout({
                                            currency: '<?= htmlspecialchars($pay['currency'] ?? 'COP') ?>',
                                            amountInCents: <?= (int)($pay['amountInCents'] ?? 0) ?>,
                                            reference: '<?= htmlspecialchars($pay['reference'] ?? '') ?>',
                                            publicKey: '<?= htmlspecialchars($pay['publicKey'] ?? '') ?>',
                                            signature: {
                                                integrity: '<?= htmlspecialchars($pay['signature'] ?? '') ?>'
                                            },
                                            redirectUrl: '<?= htmlspecialchars($pay['redirectUrl'] ?? '') ?>',
                                            customerData: {
                                                email: '<?= htmlspecialchars($pay['customerData']['email'] ?? '') ?>',
                                                fullName: '<?= htmlspecialchars($pay['customerData']['fullName'] ?? '') ?>',
                                                phoneNumber: '<?= htmlspecialchars($pay['customerData']['phoneNumber'] ?? '') ?>',
                                                phoneNumberPrefix: '+57',
                                                legalId: '<?= htmlspecialchars($pay['customerData']['legalId'] ?? '') ?>',
                                                legalIdType: 'CC'
                                            }
                                        });
                                        checkout.open(function (result) {
                                            var transaction = result.transaction;
                                            console.log('Resultado Wompi:', transaction);
                                            if (transaction && transaction.id) {
                                                window.location.href = '<?= htmlspecialchars($pay['redirectUrl'] ?? '/payment/response') ?>?id=' + transaction.id + '&reference=' + encodeURIComponent('<?= htmlspecialchars($pay['reference'] ?? '') ?>');
                                            }
                                        });
                                    } catch (err) {
                                        console.error('Error instanciando WidgetCheckout:', err);
                                        alert('Error al abrir la pasarela: ' + err.message);
                                    }
                                } else {
                                    alert('Cargando la pasarela de Wompi... Por favor presiona de nuevo en un segundo.');
                                }
                            }

                            if (typeof WidgetCheckout !== 'undefined') {
                                launchWidgetCheckout();
                            } else {
                                const s = document.createElement('script');
                                s.src = 'https://checkout.wompi.co/widget.js';
                                s.onload = launchWidgetCheckout;
                                s.onerror = function() { alert('No se pudo cargar el módulo de pago de Wompi.'); };
                                document.head.appendChild(s);
                            }
                        });
                    });
                    </script>

                    <div class="text-center mt-4">
                        <a href="/carrito" class="btn btn-link text-muted text-decoration-none small">
                            <i class="fas fa-arrow-left me-2"></i>Volver y modificar el carrito
                        </a>
                    </div>
                </div>

                <!-- Footer del Card Informativo -->
                <div class="card-footer bg-light border-0 py-3 text-center text-muted small">
                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <span><i class="fas fa-lock me-1 text-success"></i>Encriptación SSL</span>
                        <span>•</span>
                        <span><i class="fas fa-check-circle me-1 text-success"></i>Pagos Certificados</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos personalizados para el botón inyectado oficialmente por Wompi */
    #wompiWidgetContainer button,
    #wompiWidgetContainer .wompi-button-wpro,
    .wompi-button-wpro {
        display: inline-block !important;
        width: 100% !important;
        max-width: 100% !important;
        padding: 16px 24px !important;
        font-size: 1.15rem !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        border-radius: 12px !important;
        background-color: #87CC3E !important;
        color: #1a1a1a !important;
        border: none !important;
        box-shadow: 0 6px 16px rgba(135, 204, 62, 0.35) !important;
        cursor: pointer !important;
        transition: all 0.25s ease-in-out !important;
    }
    #wompiWidgetContainer button:hover,
    #wompiWidgetContainer .wompi-button-wpro:hover,
    .wompi-button-wpro:hover {
        background-color: #76b535 !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(135, 204, 62, 0.45) !important;
    }
</style>

<?php require __DIR__ . '/layouts/footer.php'; ?>
