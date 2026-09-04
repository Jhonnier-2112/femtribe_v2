<?php
$title = "Editar Usuario | FEMTRIBE";
require __DIR__ . '/../layouts/header.php';

// Valores por defecto del usuario
$uId = $user['id'] ?? 0;
$uNombres = $user['nombres'] ?? '';
$uApellidos = $user['apellidos'] ?? '';
$uTipoDoc = $user['tipo_documento'] ?? 'CC';
$uNumDoc = $user['numero_documento'] ?? '';
$uEmail = $user['email'] ?? '';
$uTelefono = $user['telefono'] ?? '';
$uDireccion = $user['direccion'] ?? '';
$uMunicipio = $user['municipio'] ?? '';
$uDepartamento = $user['departamento'] ?? '';
$uEps = $user['eps'] ?? '';
$uGrupoSang = $user['grupo_sanguineo'] ?? '';
$uRh = $user['rh'] ?? '';

$roleName = strtolower($user['role'] ?? '');
$isUserAdmin = ($roleName === 'admin' || $roleName === 'administrador' || ($user['role_id'] ?? '') === 'a1b2c3d4-0002-0002-0002-000000000002');
?>

<div class="page-content py-5">
    <div class="container">
        <?php require __DIR__ . '/layout_nav.php'; ?>

        <!-- Notificaciones -->
        <?php if (!empty($_SESSION['admin_error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($_SESSION['admin_error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['admin_error']); ?>
        <?php endif; ?>

        <div class="row justify-content-center mt-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header bg-dark text-white border-0 py-3 px-4 rounded-top-4 d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-user-edit me-2"></i>
                            Modificar Información del Corredor
                        </h5>
                        <a href="/admin/usuarios" class="btn btn-sm btn-outline-light rounded-pill px-3"><i class="fas fa-arrow-left me-1"></i>Regresar</a>
                    </div>
                    
                    <div class="card-body p-4 p-md-5 text-dark">
                        <form action="/admin/usuarios/actualizar" method="POST" class="needs-validation" novalidate>
                            <input type="hidden" name="id" value="<?= $uId ?>">

                            <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark"><i class="fas fa-id-card text-muted me-2"></i>Datos de Identidad y Cuenta</h5>
                            <div class="row g-3 mb-4">
                                <!-- Nombres -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Nombres</label>
                                    <input type="text" name="nombres" class="form-control bg-light py-2" value="<?= htmlspecialchars($uNombres) ?>" required>
                                </div>

                                <!-- Apellidos -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Apellidos</label>
                                    <input type="text" name="apellidos" class="form-control bg-light py-2" value="<?= htmlspecialchars($uApellidos) ?>" required>
                                </div>

                                <!-- Tipo Documento -->
                                <div class="col-6 col-md-4">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Tipo Documento</label>
                                    <select name="tipo_documento" class="form-select bg-light py-2">
                                        <option value="CC" <?= $uTipoDoc === 'CC' ? 'selected' : '' ?>>CC - Cédula de Ciudadanía</option>
                                        <option value="CE" <?= $uTipoDoc === 'CE' ? 'selected' : '' ?>>CE - Cédula de Extranjería</option>
                                        <option value="TI" <?= $uTipoDoc === 'TI' ? 'selected' : '' ?>>TI - Tarjeta de Identidad</option>
                                        <option value="PAS" <?= $uTipoDoc === 'PAS' ? 'selected' : '' ?>>PAS - Pasaporte</option>
                                    </select>
                                </div>

                                <!-- Número Documento -->
                                <div class="col-6 col-md-4">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Número Documento</label>
                                    <input type="text" name="numero_documento" class="form-control bg-light py-2" value="<?= htmlspecialchars($uNumDoc) ?>" required>
                                </div>

                                <!-- Rol de Acceso -->
                                <div class="col-12 col-md-4">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Rol en el Sistema</label>
                                    <select name="role_type" class="form-select bg-light py-2">
                                        <option value="cliente" <?= !$isUserAdmin ? 'selected' : '' ?>>Cliente</option>
                                        <option value="admin" <?= $isUserAdmin ? 'selected' : '' ?>>Administrador</option>
                                    </select>
                                </div>

                                <!-- Correo Electrónico -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Correo Electrónico</label>
                                    <input type="email" name="email" class="form-control bg-light py-2" value="<?= htmlspecialchars($uEmail) ?>" required>
                                </div>

                                <!-- Teléfono -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Teléfono de Contacto</label>
                                    <input type="text" name="telefono" class="form-control bg-light py-2" value="<?= htmlspecialchars($uTelefono) ?>">
                                </div>
                            </div>

                            <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark"><i class="fas fa-shipping-fast text-muted me-2"></i>Ubicación y Envío</h5>
                            <div class="row g-3 mb-4">
                                <!-- Dirección -->
                                <div class="col-12">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Dirección</label>
                                    <input type="text" name="direccion" class="form-control bg-light py-2" value="<?= htmlspecialchars($uDireccion) ?>">
                                </div>

                                <!-- Municipio / Ciudad -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Municipio / Ciudad</label>
                                    <input type="text" name="municipio" class="form-control bg-light py-2" value="<?= htmlspecialchars($uMunicipio) ?>">
                                </div>

                                <!-- Departamento -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Departamento</label>
                                    <input type="text" name="departamento" class="form-control bg-light py-2" value="<?= htmlspecialchars($uDepartamento) ?>">
                                </div>
                            </div>

                            <h5 class="fw-bold mb-3 border-bottom pb-2 text-dark"><i class="fas fa-notes-medical text-muted me-2"></i>Ficha Médica (Carrera)</h5>
                            <div class="row g-3">
                                <!-- EPS -->
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Entidad de Salud (EPS)</label>
                                    <input type="text" name="eps" class="form-control bg-light py-2" placeholder="ej. Sura, Sanitas" value="<?= htmlspecialchars($uEps) ?>">
                                </div>

                                <!-- Grupo Sanguíneo -->
                                <div class="col-6 col-md-3">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Grupo Sanguíneo</label>
                                    <select name="grupo_sanguineo" class="form-select bg-light py-2">
                                        <option value="">Selecciona...</option>
                                        <option value="O" <?= $uGrupoSang === 'O' ? 'selected' : '' ?>>Grupo O</option>
                                        <option value="A" <?= $uGrupoSang === 'A' ? 'selected' : '' ?>>Grupo A</option>
                                        <option value="B" <?= $uGrupoSang === 'B' ? 'selected' : '' ?>>Grupo B</option>
                                        <option value="AB" <?= $uGrupoSang === 'AB' ? 'selected' : '' ?>>Grupo AB</option>
                                    </select>
                                </div>

                                <!-- RH -->
                                <div class="col-6 col-md-3">
                                    <label class="form-label fw-bold small text-muted text-uppercase">RH</label>
                                    <select name="rh" class="form-select bg-light py-2">
                                        <option value="">Selecciona...</option>
                                        <option value="+" <?= $uRh === '+' ? 'selected' : '' ?>>+ (Positivo)</option>
                                        <option value="-" <?= $uRh === '-' ? 'selected' : '' ?>>- (Negativo)</option>
                                    </select>
                                </div>

                                <!-- Botón Guardar -->
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-dark w-100 py-3 rounded-3 fw-bold text-uppercase text-dark" style="background-color: #87CC3E; border: none; font-size: 0.95rem;">
                                        <i class="fas fa-save me-2"></i>Guardar Información
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validaciones de Bootstrap en cliente
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
})()
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
