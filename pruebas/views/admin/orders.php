<?php
$title = "Administración de Compras | FEMTRIBE Runner";
require __DIR__ . '/../layouts/header.php';
?>

<div class="page-content py-5">
    <div class="container">
        <?php require __DIR__ . '/layout_nav.php'; ?>

        <!-- Encabezado y Filtros de Estado -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 mt-3">
            <div>
                <h3 class="fw-bold text-dark mb-0">Órdenes de Compra e Inscripción</h3>
                <span class="text-muted small">Total: <?= $totalOrders ?> transacciones</span>
            </div>
            
            <div class="d-flex gap-2">
                <a href="/admin/compras" class="btn btn-sm rounded-pill px-3 py-2 border <?= $status === '' ? 'btn-dark' : 'btn-light' ?>">Todas</a>
                <a href="/admin/compras?status=paid" class="btn btn-sm rounded-pill px-3 py-2 border <?= $status === 'paid' ? 'btn-success text-white border-success' : 'btn-light' ?>">Aprobadas</a>
                <a href="/admin/compras?status=pending" class="btn btn-sm rounded-pill px-3 py-2 border <?= $status === 'pending' ? 'btn-warning text-dark border-warning' : 'btn-light' ?>">Pendientes</a>
                <a href="/admin/compras?status=failed" class="btn btn-sm rounded-pill px-3 py-2 border <?= $status === 'failed' ? 'btn-danger text-white border-danger' : 'btn-light' ?>">Fallidas</a>
            </div>
        </div>

        <!-- Tabla de Compras -->
        <div class="card shadow border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted text-uppercase small border-bottom">
                            <tr>
                                <th class="ps-4 py-3">Número de Orden</th>
                                <th class="py-3">Fecha y Hora</th>
                                <th class="py-3">Cliente</th>
                                <th class="py-3">Documento</th>
                                <th class="py-3">Monto Total</th>
                                <th class="py-3">Estado</th>
                                <th class="pe-4 py-3 text-end">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)): ?>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <!-- Número de Orden -->
                                        <td class="ps-4">
                                            <a href="/admin/compras/detalle?id=<?= $order['id'] ?>" class="fw-bold text-decoration-none text-dark font-monospace">
                                                <?= htmlspecialchars($order['order_number']) ?>
                                            </a>
                                        </td>
                                        <!-- Fecha -->
                                        <td class="small text-muted"><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                                        <!-- Cliente -->
                                        <td>
                                            <div class="fw-bold text-dark"><?= htmlspecialchars($order['customer_name']) ?></div>
                                            <div class="small text-muted" style="font-size: 0.8rem;"><?= htmlspecialchars($order['customer_email']) ?></div>
                                        </td>
                                        <!-- Documento -->
                                        <td class="small font-monospace text-muted"><?= htmlspecialchars($order['customer_document']) ?></td>
                                        <!-- Monto -->
                                        <td class="fw-bold text-dark">$<?= number_format($order['total'], 0, ',', '.') ?> COP</td>
                                        <!-- Estado -->
                                        <td>
                                            <?php if ($order['status'] === 'paid'): ?>
                                                <span class="badge bg-success-subtle text-success px-2 py-1.5 rounded-3">Aprobado</span>
                                            <?php elseif ($order['status'] === 'failed' || $order['status'] === 'cancelled'): ?>
                                                <span class="badge bg-danger-subtle text-danger px-2 py-1.5 rounded-3">Fallo</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning-subtle text-warning px-2 py-1.5 rounded-3">Pendiente</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Detalle -->
                                        <td class="pe-4 text-end">
                                            <a href="/admin/compras/detalle?id=<?= $order['id'] ?>" class="btn btn-sm btn-outline-dark rounded-3">
                                                <i class="fas fa-eye me-1"></i>Ver
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-receipt fa-2x mb-3 d-block"></i>
                                        No hay compras registradas en el sistema.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Paginación -->
        <?php if ($totalPages > 1): ?>
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                            <a class="page-item page-link <?= $i === $currentPage ? 'bg-success border-success' : 'text-success' ?>" 
                               href="/admin/compras?page=<?= $i ?>&status=<?= urlencode($status) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>

    </div>
</div>
