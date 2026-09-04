<?php
$title = "Bitácora de Auditoría | FEMTRIBE Runner";
require __DIR__ . '/../layouts/header.php';
?>

<div class="page-content py-5" style="min-height: 80vh;">
    <div class="container-fluid px-md-5">
        <?php require __DIR__ . '/layout_nav.php'; ?>

        <!-- Encabezado de la Sección -->
        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
            <div>
                <h3 class="fw-bold text-dark mb-0">Auditoría General del Sistema</h3>
                <span class="text-muted small">Total: <?= $totalLogs ?> eventos registrados</span>
            </div>
        </div>

        <!-- Tabla de Logs -->
        <div class="card shadow border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="min-width: 1000px;">
                        <thead class="bg-light text-muted text-uppercase small border-bottom">
                            <tr>
                                <th class="ps-4 py-3" style="width: 200px;">Usuario / Operador</th>
                                <th class="py-3" style="width: 220px;">Acción</th>
                                <th class="py-3">Descripción</th>
                                <th class="py-3 text-center" style="width: 120px;">Metadatos</th>
                                <th class="py-3" style="width: 150px;">Dirección IP</th>
                                <th class="pe-4 py-3 text-end" style="width: 180px;">Fecha y Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($logs)): ?>
                                <?php foreach ($logs as $log): ?>
                                    <tr class="border-bottom border-secondary border-opacity-10">
                                        <!-- Usuario -->
                                        <td class="ps-4">
                                            <?php if ($log['user_id']): ?>
                                                <div class="fw-bold text-dark"><?= htmlspecialchars($log['nombres'] . ' ' . $log['apellidos']) ?></div>
                                                <div class="small text-muted" style="font-size: 0.8rem;"><?= htmlspecialchars($log['email']) ?></div>
                                            <?php else: ?>
                                                <span class="badge bg-secondary-subtle text-secondary-emphasis px-2 py-1">Sistema / Anónimo</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Acción (Badge) -->
                                        <td>
                                            <?php
                                            $action = $log['action'];
                                            $badgeClass = 'bg-secondary';
                                            if (str_starts_with($action, 'USER_LOGIN')) {
                                                $badgeClass = 'bg-success';
                                            } elseif ($action === 'USER_LOGOUT') {
                                                $badgeClass = 'bg-info';
                                            } elseif ($action === 'USER_REGISTER') {
                                                $badgeClass = 'bg-primary';
                                            } elseif (str_starts_with($action, 'REGISTRATION')) {
                                                $badgeClass = 'bg-warning text-dark';
                                            } elseif (str_starts_with($action, 'ORDER_CREATE')) {
                                                $badgeClass = 'bg-warning text-dark';
                                            } elseif (str_starts_with($action, 'PAYMENT')) {
                                                $badgeClass = 'bg-danger';
                                            } elseif (str_starts_with($action, 'ADMIN')) {
                                                $badgeClass = 'bg-dark border border-success text-success';
                                            }
                                            ?>
                                            <span class="badge <?= $badgeClass ?> font-monospace px-2.5 py-1.5" style="font-size: 0.78rem; font-weight: bold; border-radius: 6px;">
                                                <?= htmlspecialchars($action) ?>
                                            </span>
                                        </td>
                                        <!-- Descripción -->
                                        <td class="small" style="font-size: 0.88rem; max-width: 300px; white-space: normal; word-break: break-word;">
                                            <?= htmlspecialchars($log['description']) ?>
                                        </td>
                                        <!-- Metadatos JSON -->
                                        <td class="text-center">
                                            <?php if (!empty($log['metadata'])): ?>
                                                <button type="button" class="btn btn-sm btn-outline-secondary px-2 py-1" 
                                                        style="font-size: 0.75rem; border-radius: 6px;"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#metadataModal" 
                                                        data-json='<?= htmlspecialchars($log['metadata'], ENT_QUOTES, 'UTF-8') ?>'
                                                        data-action='<?= htmlspecialchars($log['action'], ENT_QUOTES, 'UTF-8') ?>'>
                                                    <i class="fas fa-code me-1"></i>Ver
                                                </button>
                                            <?php else: ?>
                                                <span class="text-muted small">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- IP -->
                                        <td class="font-monospace small text-dark"><?= htmlspecialchars($log['ip_address']) ?></td>
                                        <!-- Fecha -->
                                        <td class="pe-4 text-end text-muted small" style="font-size: 0.8rem;">
                                            <?= date('d/m/Y H:i:s', strtotime($log['created_at'])) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-shield-alt fa-2x mb-3 d-block text-secondary"></i>
                                        No hay logs de auditoría registrados en la base de datos.
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
                               href="/admin/auditoria?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>

    </div>
</div>

<!-- Modal para visualizar metadatos técnicos -->
<div class="modal fade" id="metadataModal" tabindex="-1" aria-labelledby="metadataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header border-bottom border-light py-3">
                <h5 class="modal-title fw-bold" id="metadataModalLabel">
                    <i class="fas fa-bug me-2 text-warning"></i>Detalles Técnicos (<span id="modalActionName"></span>)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0">
                <pre class="m-0 p-4 font-monospace text-light bg-dark" id="jsonViewer" style="max-height: 500px; overflow-y: auto; font-size: 0.85rem; border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;"></pre>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const metadataModal = document.getElementById('metadataModal');
    if (metadataModal) {
        metadataModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const action = button.getAttribute('data-action');
            const rawJson = button.getAttribute('data-json');
            
            document.getElementById('modalActionName').textContent = action;
            
            try {
                const parsed = JSON.parse(rawJson);
                // Formatear JSON con sangría de 2 espacios
                document.getElementById('jsonViewer').textContent = JSON.stringify(parsed, null, 2);
            } catch (e) {
                document.getElementById('jsonViewer').textContent = rawJson;
            }
        });
    }
});
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
