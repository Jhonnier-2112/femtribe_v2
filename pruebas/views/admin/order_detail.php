<?php
$title = "Detalle de Orden " . htmlspecialchars($order['order_number']) . " | FEMTRIBE Runner";
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

            <!-- Datos de Facturación / Envío -->
            <div class="col-12 col-md-4">
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
