<?php
$title = "Recuperar Contraseña | FEMTRIBE";
require __DIR__ . '/../layouts/header.php';
?>

<div class="page-content py-5 bg-light min-vh-100 d-flex align-items-center">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="p-4 text-center text-white" style="background-color: #2c2c2c; border-bottom: 4px solid #6da632;">
                        <span class="badge bg-success bg-opacity-20 text-success fw-bold px-3 py-1.5 rounded-pill mb-2" style="color: #87CC3E !important;">
                            <i class="fas fa-lock me-1"></i> SEGURIDAD DE LA CUENTA
                        </span>
                        <h3 class="fw-bold text-white mb-1">¿Olvidaste tu Contraseña?</h3>
                        <p class="text-white-50 small mb-0">Ingresa tu correo para enviarte las instrucciones de recuperación</p>
                    </div>

                    <div class="card-body p-4 p-md-5">

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger rounded-3 mb-4">
                                <i class="fas fa-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($success)): ?>
                            <div class="alert alert-success rounded-3 mb-4">
                                <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($success) ?>
                            </div>
                        <?php endif; ?>

                        <form action="/forgot-password" method="POST">
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold text-dark">Correo Electrónico Registrado</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control bg-light border-start-0 py-2.5" id="email" name="email" 
                                           placeholder="ejemplo@correo.com" required autofocus>
                                </div>
                                <div class="form-text text-muted small mt-2">
                                    Te enviaremos un enlace seguro con validez de 1 hora para crear tu nueva clave.
                                </div>
                            </div>

                            <button type="submit" class="btn w-100 py-3 rounded-3 fw-bold text-uppercase shadow-sm text-white" style="background-color: #6da632; border: none; font-size: 1rem;">
                                <i class="fas fa-paper-plane me-2"></i>Enviar Enlace de Recuperación
                            </button>
                        </form>

                        <div class="text-center mt-4 pt-3 border-top">
                            <a href="/login" class="fw-bold text-decoration-none small text-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver a Iniciar Sesión
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
