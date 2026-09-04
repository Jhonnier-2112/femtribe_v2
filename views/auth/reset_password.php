<?php
$title = "Crear Nueva Contraseña | FEMTRIBE Runner";
require __DIR__ . '/../layouts/header.php';
?>

<div class="page-content py-5 bg-light min-vh-100 d-flex align-items-center">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="p-4 text-center text-white" style="background-color: #2c2c2c; border-bottom: 4px solid #6da632;">
                        <span class="badge bg-success bg-opacity-20 text-success fw-bold px-3 py-1.5 rounded-pill mb-2" style="color: #87CC3E !important;">
                            <i class="fas fa-key me-1"></i> RESTAURACIÓN SEGURA
                        </span>
                        <h3 class="fw-bold text-white mb-1">Crea tu Nueva Contraseña</h3>
                        <p class="text-white-50 small mb-0">Para la cuenta: <strong><?= htmlspecialchars($email ?? '') ?></strong></p>
                    </div>

                    <div class="card-body p-4 p-md-5">

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger rounded-3 mb-4">
                                <i class="fas fa-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <form action="/reset-password" method="POST" id="resetPasswordForm">
                            <input type="hidden" name="token" value="<?= htmlspecialchars($token ?? '') ?>">

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold text-dark">Nueva Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control bg-light border-start-0 py-2.5" id="password" name="password" 
                                           placeholder="Mínimo 6 caracteres" required minlength="6">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="confirm_password" class="form-label fw-semibold text-dark">Confirmar Nueva Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-check-double"></i></span>
                                    <input type="password" class="form-control bg-light border-start-0 py-2.5" id="confirm_password" name="confirm_password" 
                                           placeholder="Repite tu nueva contraseña" required minlength="6">
                                </div>
                                <div id="passMismatchAlert" class="form-text text-danger small mt-1 d-none">
                                    Las contraseñas no coinciden.
                                </div>
                            </div>

                            <button type="submit" class="btn w-100 py-3 rounded-3 fw-bold text-uppercase shadow-sm text-white" style="background-color: #6da632; border: none; font-size: 1rem;">
                                <i class="fas fa-save me-2"></i>Guardar Nueva Contraseña
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('resetPasswordForm');
    const pass = document.getElementById('password');
    const confirm = document.getElementById('confirm_password');
    const alert = document.getElementById('passMismatchAlert');

    function checkMatch() {
        if (confirm.value && pass.value !== confirm.value) {
            alert.classList.remove('d-none');
            confirm.setCustomValidity('Las contraseñas no coinciden');
        } else {
            alert.classList.add('d-none');
            confirm.setCustomValidity('');
        }
    }

    pass.addEventListener('input', checkMatch);
    confirm.addEventListener('input', checkMatch);
});
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
