<?php
$title = "Administración de Usuarios | FemTribe Runner";
require __DIR__ . '/../layouts/header.php';
$activeTab = 'users';

// Valores por defecto para filtros
$search = $search ?? '';
$role = $role ?? '';
?>

<div class="page-content py-5">
    <div class="container">
        <?php require __DIR__ . '/layout_nav.php'; ?>

        <!-- Notificaciones de Éxito / Error -->
        <?php if (!empty($_SESSION['admin_success'])): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($_SESSION['admin_success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['admin_success']); ?>
        <?php endif; ?>
        <?php if (!empty($_SESSION['admin_error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($_SESSION['admin_error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['admin_error']); ?>
        <?php endif; ?>

        <!-- Encabezado y Filtros de Búsqueda -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 mt-3">
            <div>
                <h3 class="fw-bold text-dark mb-0">Usuarios y Corredores</h3>
                <span class="text-muted small">Total: <?= $totalUsers ?> corredores registrados</span>
            </div>
            
            <form action="/admin/usuarios" method="GET" class="d-flex flex-wrap gap-2 align-items-center">
                <!-- Filtro de Rol -->
                <select name="role" class="form-select bg-white shadow-sm border small" style="width: 160px; height: 42px;">
                    <option value="">Todos los Roles</option>
                    <option value="client" <?= $role === 'client' ? 'selected' : '' ?>>Cliente</option>
                    <option value="admin" <?= $role === 'admin' ? 'selected' : '' ?>>Administrador</option>
                </select>

                <!-- Campo de Búsqueda -->
                <div class="d-flex bg-white rounded-3 shadow-sm border overflow-hidden" style="height: 42px;">
                    <input type="text" name="search" class="form-control border-0 py-2 px-3 small" placeholder="Buscar por nombre, correo, cédula..." value="<?= htmlspecialchars($search) ?>" style="box-shadow: none; min-width: 250px;">
                    <button type="submit" class="btn btn-light border-0 px-3"><i class="fas fa-search text-muted"></i></button>
                </div>
                
                <?php if ($search !== '' || $role !== ''): ?>
                    <a href="/admin/usuarios" class="btn btn-light border shadow-sm px-3" style="height: 42px; display: inline-flex; align-items: center;"><i class="fas fa-undo"></i></a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Tabla de Usuarios -->
        <div class="card shadow border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted text-uppercase small border-bottom">
                            <tr>
                                <th class="ps-4 py-3">Nombre Completo</th>
                                <th class="py-3">Documento</th>
                                <th class="py-3">Contacto</th>
                                <th class="py-3">Ficha Médica</th>
                                <th class="py-3">Ciudad</th>
                                <th class="py-3">Rol</th>
                                <th class="py-3">Fecha Registro</th>
                                <th class="pe-4 py-3 text-end">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <?php 
                                    $roleName = strtolower($user['role'] ?? '');
                                    $isAdmin = ($roleName === 'admin' || $roleName === 'administrador' || ($user['role_id'] ?? '') === 'a1b2c3d4-0002-0002-0002-000000000002');
                                    ?>
                                    <tr>
                                        <!-- Nombre Completo -->
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark"><?= htmlspecialchars($user['nombres'] . ' ' . $user['apellidos']) ?></div>
                                            <span class="small text-muted font-monospace" style="font-size: 0.75rem;">ID: #<?= $user['id'] ?></span>
                                        </td>
                                        <!-- Documento -->
                                        <td>
                                            <span class="badge bg-light text-dark-emphasis border px-2 py-1.5 small">
                                                <?= htmlspecialchars($user['tipo_documento'] . ' ' . $user['numero_documento']) ?>
                                            </span>
                                        </td>
                                        <!-- Contacto -->
                                        <td>
                                            <div class="small fw-bold text-dark"><?= htmlspecialchars($user['email']) ?></div>
                                            <div class="small text-muted" style="font-size: 0.75rem;"><i class="fas fa-phone-alt me-1"></i><?= htmlspecialchars($user['telefono'] ?: 'No registrado') ?></div>
                                        </td>
                                        <!-- Ficha Médica -->
                                        <td>
                                            <?php if (!empty($user['eps']) || !empty($user['rh'])): ?>
                                                <div class="small"><strong class="text-muted">EPS:</strong> <?= htmlspecialchars($user['eps'] ?: 'N/A') ?></div>
                                                <div class="small" style="font-size: 0.75rem;"><strong class="text-muted">RH:</strong> <?= htmlspecialchars(($user['grupo_sanguineo'] ?? '') . ($user['rh'] ?? '')) ?: 'N/A' ?></div>
                                            <?php else: ?>
                                                <span class="text-muted small">Sin Ficha Médica</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Ciudad -->
                                        <td class="small text-dark">
                                            <?= htmlspecialchars($user['municipio']) ?>, <?= htmlspecialchars($user['departamento']) ?>
                                            <div class="small text-muted text-truncate" style="max-width: 140px;" title="<?= htmlspecialchars($user['direccion']) ?>"><?= htmlspecialchars($user['direccion']) ?></div>
                                        </td>
                                        <!-- Rol -->
                                        <td>
                                            <?php if ($isAdmin): ?>
                                                <span class="badge bg-danger-subtle text-danger px-2.5 py-1.5 rounded-3 fw-bold"><i class="fas fa-user-shield me-1"></i>Administrador</span>
                                            <?php else: ?>
                                                <span class="badge bg-success-subtle text-success px-2.5 py-1.5 rounded-3 fw-bold"><i class="fas fa-running me-1"></i>Cliente</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Fecha Registro -->
                                        <td class="small text-muted">
                                            <?= date('d/m/Y H:i', strtotime($user['created_at'])) ?>
                                        </td>
                                        <!-- Acción -->
                                        <td class="pe-4 text-end">
                                            <a href="/admin/usuarios/editar?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-dark rounded-3" title="Modificar Información">
                                                <i class="fas fa-user-edit"></i> Editar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-users-slash fa-2x mb-3 d-block"></i>
                                        No hay usuarios registrados en el sistema o no coinciden con la búsqueda.
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
                               href="/admin/usuarios?page=<?= $i ?>&search=<?= urlencode($search) ?>&role=<?= urlencode($role) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>

    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
