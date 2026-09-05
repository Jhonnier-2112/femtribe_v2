<?php
$title = "Detalle de Orden " . htmlspecialchars($order['order_number']) . " | FEMTRIBE";
require __DIR__ . '/../layouts/header.php';
?>

<div class="page-content py-5">
    <div class="container">
        <?php require __DIR__ . '/layout_nav.php'; ?>

        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
            <div>
                <h3 class="fw-bold text-dark mb-0">Detalle de Compra</h3>
                <span class="text-muted small">Orden: <strong class="font-monospace text-dark"><?= htmlspecialchars($order['order_number']) ?></strong></span>
            </div>
            <a href="/admin/compras" class="btn btn-outline-dark rounded-pill px-3"><i class="fas fa-arrow-left me-1"></i>Volver a Compras</a>
        </div>

        <!-- Mensajes Flash -->
        <?php if (!empty($_SESSION['admin_success'])): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($_SESSION['admin_success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['admin_success']); ?>
        <?php endif; ?>
        <?php if (!empty($_SESSION['admin_error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i><?= htmlspecialchars($_SESSION['admin_error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['admin_error']); ?>
        <?php endif; ?>

        <div class="row g-4 text-dark">
            <!-- Información de la Orden -->
            <div class="col-12 col-md-8">
                <!-- Productos Comprados -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                        <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-tshirt text-muted me-2"></i>Productos Adquiridos</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr class="text-muted small text-uppercase">
                                        <th>Producto</th>
                                        <th>Precio Unitario</th>
                                        <th>Cantidad</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item): ?>
                                        <tr>
                                            <td>
                                                <div class="fw-bold text-dark"><?= htmlspecialchars($item['product_name']) ?></div>
                                                <?php
                                                    $itemMeta = [];
                                                    if (!empty($item['color'])) $itemMeta[] = 'Color: ' . htmlspecialchars($item['color']);
                                                    if (!empty($item['gender'])) $itemMeta[] = 'Género: ' . ucfirst(htmlspecialchars($item['gender']));
                                                    if (!empty($item['size'])) $itemMeta[] = 'Talla: ' . htmlspecialchars($item['size']);
                                                ?>
                                                <?php if (!empty($itemMeta)): ?>
                                                    <div class="small text-muted mt-1" style="font-size: 0.8rem;">
                                                        <span class="badge bg-light text-dark border me-1"><?= implode('</span> <span class="badge bg-light text-dark border me-1">', $itemMeta) ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>$<?= number_format($item['price'], 0, ',', '.') ?> COP</td>
                                            <td class="fw-bold"><?= $item['quantity'] ?></td>
                                            <td class="text-end fw-bold text-dark">$<?= number_format($item['subtotal'], 0, ',', '.') ?> COP</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Totales -->
                        <div class="row justify-content-end mt-4">
                            <div class="col-md-5">
                                <div class="border-top pt-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted small">Subtotal:</span>
                                        <span class="fw-bold text-dark">$<?= number_format($order['subtotal'], 0, ',', '.') ?> COP</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted small">Envío:</span>
                                        <span class="fw-bold text-dark">$<?= number_format($order['shipping_fee'], 0, ',', '.') ?> COP</span>
                                    </div>
                                    <div class="d-flex justify-content-between border-top pt-2 mt-2">
                                        <h6 class="fw-bold mb-0">Total:</h6>
                                        <h6 class="fw-bold text-dark mb-0" style="color: #87CC3E !important;">$<?= number_format($order['total'], 0, ',', '.') ?> COP</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Historial de Intentos de Pago / Webhooks -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                        <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-history text-muted me-2"></i>Historial de Pagos (Pasarela Wompi)</h5>
                    </div>
                    <div class="card-body p-4">
                        <?php if (!empty($payments)): ?>
                            <div class="timeline-wrapper">
                                <?php foreach ($payments as $p): ?>
                                    <div class="p-3 mb-3 border rounded-3 bg-light">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold small font-monospace">Ref: <?= htmlspecialchars($p['transaction_reference']) ?></span>
                                            <?php if ($p['status'] === 'APPROVED'): ?>
                                                <span class="badge bg-success">Aprobado</span>
                                            <?php elseif ($p['status'] === 'DECLINED'): ?>
                                                <span class="badge bg-danger">Rechazado</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark"><?= htmlspecialchars($p['status']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="small text-muted mb-1">
                                            <strong>ID Wompi:</strong> <?= htmlspecialchars($p['gateway_transaction_id'] ?? 'N/A') ?>
                                        </div>
                                        <div class="small text-muted mb-1">
                                            <strong>Método:</strong> <?= htmlspecialchars($p['payment_method_type'] ?? 'N/A') ?>
                                        </div>
                                        <div class="small text-muted" style="font-size: 0.75rem;">
                                            <strong>Fecha Registro:</strong> <?= date('d/m/Y H:i:s', strtotime($p['created_at'])) ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted small mb-0">No se registran logs de pago en Wompi para esta orden.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Datos de Facturación / Envío y Panel de Acciones -->
            <div class="col-12 col-md-4">
                <!-- Panel de Acciones de Aprobación -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                        <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-tasks text-muted me-2"></i>Estado del Pago</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted small">Estado actual:</span>
                            <?php if ($order['status'] === 'paid'): ?>
                                <span class="badge bg-success px-3 py-2 fs-6 rounded-pill"><i class="fas fa-check-circle me-1"></i>Aprobada (Pagada)</span>
                            <?php elseif ($order['status'] === 'failed' || $order['status'] === 'cancelled'): ?>
                                <span class="badge bg-danger px-3 py-2 fs-6 rounded-pill"><i class="fas fa-times-circle me-1"></i>Fallida</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark px-3 py-2 fs-6 rounded-pill"><i class="fas fa-clock me-1"></i>Pendiente</span>
                            <?php endif; ?>
                        </div>

                        <?php if ($order['status'] !== 'paid'): ?>
                            <div class="border-top pt-3 mt-3">
                                <h6 class="fw-bold text-dark small mb-2"><i class="fas fa-bolt text-warning me-1"></i>Verificar con Wompi</h6>
                                <form action="/admin/compras/verificar-wompi" method="POST" class="mb-3">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <div class="mb-2">
                                        <input type="text" name="wompi_transaction_id" class="form-control form-control-sm font-monospace" placeholder="ID de Transacción Wompi (opcional)" value="<?= htmlspecialchars($payments[0]['gateway_transaction_id'] ?? '') ?>">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-outline-dark w-100 rounded-3">
                                        <i class="fas fa-search me-1"></i>Consultar Wompi y Validar
                                    </button>
                                </form>

                                <h6 class="fw-bold text-dark small mb-2"><i class="fas fa-check-double text-success me-1"></i>Aprobación Manual Directa</h6>
                                <form action="/admin/compras/aprobar" method="POST" onsubmit="return confirm('¿Confirmas que deseas marcar esta orden como PAGADA y enviar el correo oficial de confirmación al corredor?');">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <input type="hidden" name="order_number" value="<?= htmlspecialchars($order['order_number']) ?>">
                                    <button type="submit" class="btn btn-sm btn-success w-100 py-2 rounded-3 fw-bold text-white shadow-sm" style="background-color: #6da632; border: none;">
                                        <i class="fas fa-envelope-circle-check me-1"></i>Aprobar y Enviar Correo Oficial
                                    </button>
                                </form>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-success bg-success bg-opacity-10 border-0 rounded-3 py-2 px-3 small mb-0 text-success">
                                <i class="fas fa-info-circle me-1"></i> Esta orden está confirmada. Si deseas reenviar el correo de confirmación, puedes usar el botón abajo:
                            </div>
                            <form action="/admin/compras/aprobar" method="POST" class="mt-3" onsubmit="return confirm('¿Deseas reenviar el correo de bienvenida/confirmación al corredor?');">
                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                <input type="hidden" name="order_number" value="<?= htmlspecialchars($order['order_number']) ?>">
                                <button type="submit" class="btn btn-sm btn-outline-success w-100 rounded-3">
                                    <i class="fas fa-envelope me-1"></i>Reenviar Correo de Confirmación
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Envío y Datos del Cliente -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                        <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-shipping-fast text-muted me-2"></i>Envío y Datos</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">Cliente</span>
                            <span class="fw-bold text-dark d-block"><?= htmlspecialchars($order['customer_name']) ?></span>
                            <span class="text-muted small d-block"><?= htmlspecialchars($order['customer_email']) ?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">Documento de Identidad</span>
                            <span class="fw-bold text-dark d-block"><?= htmlspecialchars($order['customer_document']) ?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">Teléfono / Celular</span>
                            <span class="fw-bold text-dark d-block"><?= htmlspecialchars($order['customer_phone']) ?></span>
                        </div>
                        <div class="mb-3 border-top pt-3">
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">Dirección de Entrega</span>
                            <span class="fw-bold text-dark d-block"><?= htmlspecialchars($order['shipping_address']) ?></span>
                            <span class="text-muted small d-block"><?= htmlspecialchars($order['city']) ?>, <?= htmlspecialchars($order['department']) ?></span>
                        </div>
                        <div class="mb-0 border-top pt-3">
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">Método de Pago</span>
                            <span class="badge bg-dark text-white rounded-3 px-3 py-2 mt-1">
                                <?= htmlspecialchars($order['payment_method']) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
