<?php
$title = "Dashboard Administrador | FEMTRIBE";
require __DIR__ . '/../layouts/header.php';
?>

<div class="page-content py-5">
    <div class="container">
        <?php require __DIR__ . '/layout_nav.php'; ?>

        <!-- Métricas Principales -->
        <div class="row g-4 mb-4 mt-2">
            <!-- Ventas -->
            <div class="col-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden admin-stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-wrapper bg-success-subtle text-success rounded-3 p-3">
                                <i class="fas fa-wallet fa-lg"></i>
                            </div>
                        </div>
                        <h6 class="text-muted small text-uppercase mb-1 fw-bold">Ingresos Totales</h6>
                        <h4 class="fw-bold mb-0 text-dark">$<?= number_format($totalSales, 0, ',', '.') ?></h4>
                        <span class="text-muted small"><?= $totalOrders ?> compras aprobadas</span>
                    </div>
                </div>
            </div>
            
            <!-- Registros -->
            <div class="col-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden admin-stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-wrapper bg-primary-subtle text-primary rounded-3 p-3">
                                <i class="fas fa-running fa-lg"></i>
                            </div>
                        </div>
                        <h6 class="text-muted small text-uppercase mb-1 fw-bold">Inscritos Carrera</h6>
                        <h4 class="fw-bold mb-0 text-dark"><?= $totalRegistrations ?></h4>
                        <span class="text-muted small">Corredores listos</span>
                    </div>
                </div>
            </div>

            <!-- Usuarios -->
            <div class="col-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden admin-stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-wrapper bg-warning-subtle text-warning rounded-3 p-3">
                                <i class="fas fa-users fa-lg"></i>
                            </div>
                        </div>
                        <h6 class="text-muted small text-uppercase mb-1 fw-bold">Corredores Creados</h6>
                        <h4 class="fw-bold mb-0 text-dark"><?= $totalUsers ?></h4>
                        <span class="text-muted small">Cuentas activas</span>
                    </div>
                </div>
            </div>

            <!-- Visitas -->
            <div class="col-6 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden admin-stat-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-wrapper bg-info-subtle text-info rounded-3 p-3">
                                <i class="fas fa-eye fa-lg"></i>
                            </div>
                        </div>
                        <h6 class="text-muted small text-uppercase mb-1 fw-bold">Visitas Totales</h6>
                        <h4 class="fw-bold mb-0 text-dark"><?= $totalVisits ?></h4>
                        <span class="text-muted small">Accesos registrados</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Últimas Compras -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-shopping-bag text-muted me-2"></i>Últimas Compras</h5>
                        <a href="/admin/compras" class="btn btn-sm btn-link text-decoration-none small text-success fw-bold" style="color:#87CC3E !important;">Ver todas</a>
                    </div>
                    <div class="card-body p-0 pb-3">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light text-muted small text-uppercase">
                                    <tr>
                                        <th class="ps-4 py-3">Orden</th>
                                        <th class="py-3">Cliente</th>
                                        <th class="py-3">Monto</th>
                                        <th class="py-3 pe-4 text-end">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recentOrders)): ?>
                                        <?php foreach ($recentOrders as $order): ?>
                                            <tr>
                                                <td class="ps-4">
                                                    <a href="/admin/compras/detalle?id=<?= $order['id'] ?>" class="fw-bold text-decoration-none text-dark">
                                                        <?= htmlspecialchars($order['order_number']) ?>
                                                    </a>
                                                </td>
                                                <td><?= htmlspecialchars($order['customer_name']) ?></td>
                                                <td class="fw-bold text-dark">$<?= number_format($order['total'], 0, ',', '.') ?></td>
                                                <td class="pe-4 text-end">
                                                    <?php if ($order['status'] === 'paid'): ?>
                                                        <span class="badge bg-success-subtle text-success px-2 py-1.5 rounded-3">Aprobado</span>
                                                    <?php elseif ($order['status'] === 'failed' || $order['status'] === 'cancelled'): ?>
                                                        <span class="badge bg-danger-subtle text-danger px-2 py-1.5 rounded-3">Fallo</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning-subtle text-warning px-2 py-1.5 rounded-3">Pendiente</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted small">No hay transacciones recientes.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logs de Tráfico Reciente -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-history text-muted me-2"></i>Accesos Recientes</h5>
                        <a href="/admin/accesos" class="btn btn-sm btn-link text-decoration-none small text-success fw-bold" style="color:#87CC3E !important;">Ver todos</a>
                    </div>
                    <div class="card-body p-0 pb-3">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light text-muted small text-uppercase">
                                    <tr>
                                        <th class="ps-4 py-3">IP / Correo</th>
                                        <th class="py-3">Página</th>
                                        <th class="py-3 pe-4 text-end">Fecha / Hora</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recentLogs)): ?>
                                        <?php foreach ($recentLogs as $log): ?>
                                            <tr>
                                                <td class="ps-4">
                                                    <span class="fw-bold text-dark small d-block"><?= htmlspecialchars($log['ip_address']) ?></span>
                                                    <span class="text-muted small d-block" style="font-size: 0.75rem;"><?= htmlspecialchars($log['email'] ?? 'Visitante Anónimo') ?></span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-dark-subtle text-dark-emphasis font-monospace px-1.5 py-0.5" style="font-size: 0.75rem;"><?= htmlspecialchars($log['method']) ?></span>
                                                    <span class="small text-muted text-truncate d-inline-block align-middle ms-1" style="max-width: 150px;"><?= htmlspecialchars($log['page_url']) ?></span>
                                                </td>
                                                <td class="pe-4 text-end text-muted small" style="font-size: 0.75rem;">
                                                    <?= date('d/m H:i:s', strtotime($log['created_at'])) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted small">No hay logs de tráfico registrados.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
.admin-stat-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.admin-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 .5rem 1.5rem rgba(0,0,0,0.08) !important;
}
.stat-icon-wrapper {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
}
.bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
.bg-primary-subtle { background-color: rgba(13, 110, 253, 0.1) !important; }
.bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1) !important; }
.bg-info-subtle { background-color: rgba(13, 202, 240, 0.1) !important; }
.text-success { color: #2e7d32 !important; }
.text-primary { color: #1565c0 !important; }
.text-warning { color: #f57f17 !important; }
.text-info { color: #00838f !important; }
</style>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
