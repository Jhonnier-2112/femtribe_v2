<?php
$title = "Administración de Categorías | FEMTRIBE Runner";
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

        <div class="row g-4 mt-2">
            <!-- Formulario de Registro / Edición -->
            <div class="col-12 col-md-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-dark text-white border-0 py-3 rounded-top-4">
                        <h6 class="fw-bold mb-0" id="formTitle"><i class="fas fa-plus-circle me-2"></i>Nueva Categoría</h6>
                    </div>
                    <div class="card-body p-4 text-dark">
                        <form action="/admin/categorias/guardar" method="POST" id="categoryForm">
                            <input type="hidden" name="id" id="categoryId" value="">
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted text-uppercase">Nombre de Categoría</label>
                                <input type="text" name="name" id="categoryName" class="form-control bg-light py-2" placeholder="ej. Nutrición Deportiva" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted text-uppercase">Descripción</label>
                                <textarea name="description" id="categoryDesc" class="form-control bg-light" rows="4" placeholder="Detalle sobre el tipo de productos de esta categoría..." style="resize: none;"></textarea>
                            </div>

                            <button type="submit" class="btn btn-dark w-100 py-2.5 rounded-3 fw-bold text-uppercase text-dark" id="btnSubmitCategory" style="background-color: #87CC3E; border: none;">
                                <i class="fas fa-save me-2"></i>Guardar Categoría
                            </button>
                            
                            <button type="button" class="btn btn-light w-100 py-2 mt-2 rounded-3 text-muted border d-none" id="btnCancelEdit" onclick="cancelEditCategory()">
                                Cancelar Edición
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla de Categorías Registradas -->
            <div class="col-12 col-md-8">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                        <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-tags text-muted me-2"></i>Categorías Registradas</h5>
                        <span class="text-muted small">Haz clic en editar para modificar la información de cualquier categoría</span>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light text-muted text-uppercase small border-bottom">
                                    <tr>
                                        <th class="ps-3 py-3">Nombre</th>
                                        <th class="py-3">Slug</th>
                                        <th class="py-3">Descripción</th>
                                        <th class="pe-3 py-3 text-end">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($categories)): ?>
                                        <?php foreach ($categories as $cat): ?>
                                            <tr>
                                                <td class="ps-3 fw-bold text-dark"><?= htmlspecialchars($cat['name']) ?></td>
                                                <td class="font-monospace small"><?= htmlspecialchars($cat['slug']) ?></td>
                                                <td class="text-muted small text-truncate" style="max-width: 250px;">
                                                    <?= htmlspecialchars($cat['description'] ?: 'Sin descripción') ?>
                                                </td>
                                                <td class="pe-3 text-end">
                                                    <button type="button" class="btn btn-sm btn-outline-dark rounded-3" 
                                                            onclick="editCategory(<?= $cat['id'] ?>, '<?= htmlspecialchars(json_encode($cat['name'])) ?>', '<?= htmlspecialchars(json_encode($cat['description'])) ?>')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">No hay categorías registradas.</td>
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

<script>
function editCategory(id, name, desc) {
    document.getElementById('categoryId').value = id;
    document.getElementById('categoryName').value = name.replace(/^"(.*)"$/, '$1');
    document.getElementById('categoryDesc').value = desc.replace(/^"(.*)"$/, '$1');
    
    document.getElementById('formTitle').innerHTML = '<i class="fas fa-edit me-2"></i>Editar Categoría';
    document.getElementById('btnSubmitCategory').innerHTML = '<i class="fas fa-sync-alt me-2"></i>Actualizar Categoría';
    document.getElementById('categoryForm').action = '/admin/categorias/actualizar';
    
    document.getElementById('btnCancelEdit').classList.remove('d-none');
}

function cancelEditCategory() {
    document.getElementById('categoryId').value = '';
    document.getElementById('categoryName').value = '';
    document.getElementById('categoryDesc').value = '';
    
    document.getElementById('formTitle').innerHTML = '<i class="fas fa-plus-circle me-2"></i>Nueva Categoría';
    document.getElementById('btnSubmitCategory').innerHTML = '<i class="fas fa-save me-2"></i>Guardar Categoría';
    document.getElementById('categoryForm').action = '/admin/categorias/guardar';
    
    document.getElementById('btnCancelEdit').classList.add('d-none');
}
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
