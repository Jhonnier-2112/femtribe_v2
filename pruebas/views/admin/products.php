<?php
$title = "Administración de Productos | FEMTRIBE Runner";
require __DIR__ . '/../layouts/header.php';
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

        <!-- Encabezado de la Sección -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 mt-3">
            <div>
                <h3 class="fw-bold text-dark mb-0">Catálogo de Productos</h3>
                <span class="text-muted small">Total: <?= $totalProducts ?> productos activos</span>
            </div>
            <div class="d-flex gap-2">
                <form action="/admin/productos" method="GET" class="d-flex bg-white rounded-3 shadow-sm border overflow-hidden">
                    <input type="text" name="search" class="form-control border-0 py-2 px-3 small" placeholder="Buscar por nombre o SKU..." value="<?= htmlspecialchars($search) ?>" style="box-shadow: none; min-width: 220px;">
                    <button type="submit" class="btn btn-light border-0 px-3"><i class="fas fa-search text-muted"></i></button>
                </form>
                <a href="/admin/productos/nuevo" class="btn text-dark fw-bold px-4 rounded-3 d-flex align-items-center" style="background-color:#87CC3E; border:none;">
                    <i class="fas fa-plus me-2"></i>Nuevo Producto
                </a>
            </div>
        </div>

        <!-- Tabla de Productos -->
        <div class="card shadow border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted text-uppercase small border-bottom">
                            <tr>
                                <th class="ps-4 py-3">Imagen</th>
                                <th class="py-3">SKU</th>
                                <th class="py-3">Nombre</th>
                                <th class="py-3">Categoría</th>
                                <th class="py-3">Filtros</th>
                                <th class="py-3">Precio</th>
                                <th class="py-3">Stock</th>
                                <th class="pe-4 py-3 text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($products)): ?>
                                <?php foreach ($products as $p): ?>
                                    <tr>
                                        <!-- Imagen -->
                                        <td class="ps-4">
                                            <div class="rounded-3 overflow-hidden border bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <img src="/<?= htmlspecialchars($p['image'] ?: 'assets/img/products/placeholder.png') ?>" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;" onerror="this.src='/assets/img/products/placeholder.png';">
                                            </div>
                                        </td>
                                        <!-- SKU -->
                                        <td class="fw-bold font-monospace small"><?= htmlspecialchars($p['sku']) ?></td>
                                        <!-- Nombre -->
                                        <td>
                                            <div class="fw-bold text-dark"><?= htmlspecialchars($p['name']) ?></div>
                                            <span class="text-muted small font-monospace" style="font-size: 0.75rem;">/producto?slug=<?= htmlspecialchars($p['slug']) ?></span>
                                        </td>
                                        <!-- Categoría -->
                                        <td>
                                            <span class="badge bg-dark-subtle text-dark-emphasis rounded-3 px-2 py-1.5 small">
                                                <?= htmlspecialchars($p['category_name'] ?: ($p['category'] ?: 'Sin Categoría')) ?>
                                            </span>
                                        </td>
                                        <!-- Filtros -->
                                        <td>
                                            <span class="badge bg-light text-muted border text-uppercase me-1" style="font-size: 0.7rem;"><?= htmlspecialchars($p['gender']) ?></span>
                                            <span class="badge bg-light text-muted border text-uppercase" style="font-size: 0.7rem;"><?= htmlspecialchars($p['type']) ?></span>
                                            <?php if ($p['is_new']): ?>
                                                <span class="badge bg-success-subtle text-success ms-1" style="font-size: 0.7rem;">Nuevo</span>
                                            <?php endif; ?>
                                            <?php if ($p['is_offer']): ?>
                                                <span class="badge bg-danger-subtle text-danger ms-1" style="font-size: 0.7rem;">Oferta</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Precio -->
                                        <td class="fw-bold text-dark">$<?= number_format($p['price'], 0, ',', '.') ?></td>
                                        <!-- Stock -->
                                        <td>
                                            <?php if ($p['stock'] <= 5): ?>
                                                <span class="text-danger fw-bold"><i class="fas fa-exclamation-triangle me-1"></i><?= $p['stock'] ?> (Bajo)</span>
                                            <?php else: ?>
                                                <span class="text-success fw-bold"><?= $p['stock'] ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Acciones -->
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex gap-2">
                                                <a href="/admin/productos/editar?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-dark rounded-3" title="Editar Producto">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="/admin/productos/eliminar" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar (desactivar) este producto del catálogo?');" class="m-0">
                                                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" title="Eliminar Producto">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-box-open fa-2x mb-3 d-block"></i>
                                        No hay productos registrados en el sistema o no coinciden con la búsqueda.
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
                               href="/admin/productos?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>

    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
