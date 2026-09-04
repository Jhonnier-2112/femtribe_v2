<?php
$title = "Bitácora de Accesos | FEMTRIBE";
require __DIR__ . '/../layouts/header.php';
?>

<div class="page-content py-5">
    <div class="container">
        <?php require __DIR__ . '/layout_nav.php'; ?>

        <!-- Encabezado de la Sección -->
        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
            <div>
                <h3 class="fw-bold text-dark mb-0">Logs de Acceso al Sistema</h3>
                <span class="text-muted small">Total: <?= $totalLogs ?> visitas registradas</span>
            </div>
        </div>

        <!-- Tabla de Logs -->
        <div class="card shadow border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted text-uppercase small border-bottom">
                            <tr>
                                <th class="ps-4 py-3">Usuario / Visitante</th>
                                <th class="py-3">Dirección IP</th>
                                <th class="py-3">Petición</th>
                                <th class="py-3">Referer (Origen)</th>
                                <th class="py-3">Navegador (User-Agent)</th>
                                <th class="pe-4 py-3 text-end">Fecha y Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($logs)): ?>
                                <?php foreach ($logs as $log): ?>
                                    <tr>
                                        <!-- Usuario -->
                                        <td class="ps-4">
                                            <?php if ($log['user_id']): ?>
                                                <div class="fw-bold text-dark"><?= htmlspecialchars($log['nombres'] . ' ' . $log['apellidos']) ?></div>
                                                <div class="small text-muted" style="font-size: 0.8rem;"><?= htmlspecialchars($log['email']) ?></div>
                                            <?php else: ?>
                                                <span class="badge bg-secondary-subtle text-secondary-emphasis px-2 py-1">Anónimo</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- IP -->
                                        <td class="font-monospace small text-dark"><?= htmlspecialchars($log['ip_address']) ?></td>
                                        <!-- Petición -->
                                        <td>
                                            <span class="badge bg-dark-subtle text-dark-emphasis font-monospace px-1.5 py-1" style="font-size: 0.75rem;">
                                                <?= htmlspecialchars($log['method']) ?>
                                            </span>
                                            <span class="font-monospace small text-muted ms-1" style="word-break: break-all; max-width: 200px; display: inline-block; vertical-align: middle;">
                                                <?= htmlspecialchars($log['page_url']) ?>
                                            </span>
                                        </td>
                                        <!-- Referer -->
                                        <td class="small text-muted text-truncate" style="max-width: 150px;" title="<?= htmlspecialchars($log['referer'] ?? 'Ninguno') ?>">
                                            <?= htmlspecialchars($log['referer'] ?: 'Directo') ?>
                                        </td>
                                        <!-- User Agent -->
                                        <td class="small text-muted text-truncate" style="max-width: 200px;" title="<?= htmlspecialchars($log['user_agent']) ?>">
                                            <?= htmlspecialchars($log['user_agent']) ?>
                                        </td>
                                        <!-- Fecha -->
                                        <td class="pe-4 text-end text-muted small" style="font-size: 0.8rem;">
                                            <?= date('d/m/Y H:i:s', strtotime($log['created_at'])) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-history fa-2x mb-3 d-block"></i>
                                        No hay logs de tráfico registrados en el sistema.
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
                               href="/admin/accesos?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>

    </div>
</div>
