/**
 * FEMTRIBE - Frontend Authentication Script (auth.js)
 * Maneja Google Sign-In, validaciones client-side, toggling de contraseña y envíos AJAX.
 */

document.addEventListener('DOMContentLoaded', function () {
    initPasswordToggle();
    initRegisterValidation();
    initAjaxForms();
});

/**
 * Mantiene la funcionalidad de mostrar / ocultar contraseña con el botón del ojo.
 */
function initPasswordToggle() {
    document.body.addEventListener('click', function (e) {
        const toggleBtn = e.target.closest('[data-toggle-password]');
        if (!toggleBtn) return;

        e.preventDefault();
        const targetId = toggleBtn.getAttribute('data-toggle-password');
        const input = document.getElementById(targetId) || toggleBtn.parentElement.querySelector('input[type="password"], input[type="text"]');

        if (!input) return;

        const icon = toggleBtn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            if (icon) {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        } else {
            input.type = 'password';
            if (icon) {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    });
}

/**
 * Validaciones en tiempo real para el formulario de registro (coincidencia de contraseñas, fortaleza)
 */
function initRegisterValidation() {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirm');
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthText = document.getElementById('passwordStrengthText');

    if (passwordInput) {
        passwordInput.addEventListener('input', function () {
            const val = passwordInput.value;
            if (!strengthBar) return;

            let score = 0;
            if (val.length >= 6) score++;
            if (val.length >= 10) score++;
            if (/[A-Z]/.test(val) && /[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            strengthBar.className = 'password-strength-bar';
            if (val.length === 0) {
                strengthBar.style.width = '0%';
                if (strengthText) strengthText.textContent = '';
            } else if (score <= 1) {
                strengthBar.classList.add('weak');
                if (strengthText) { strengthText.textContent = 'Contraseña débil (mín. 6 caracteres)'; strengthText.className = 'small text-danger mt-1'; }
            } else if (score === 2) {
                strengthBar.classList.add('medium');
                if (strengthText) { strengthText.textContent = 'Contraseña media'; strengthText.className = 'small text-warning mt-1'; }
            } else {
                strengthBar.classList.add('strong');
                if (strengthText) { strengthText.textContent = 'Contraseña fuerte'; strengthText.className = 'small text-success mt-1'; }
            }

            if (confirmInput && confirmInput.value) {
                validatePasswordMatch();
            }
        });
    }

    if (confirmInput) {
        confirmInput.addEventListener('input', validatePasswordMatch);
    }

    function validatePasswordMatch() {
        if (!passwordInput || !confirmInput) return true;
        const matchError = document.getElementById('passwordMatchError');
        if (confirmInput.value.length > 0 && passwordInput.value !== confirmInput.value) {
            confirmInput.classList.add('is-invalid');
            if (matchError) matchError.classList.remove('d-none');
            return false;
        } else {
            confirmInput.classList.remove('is-invalid');
            if (matchError) matchError.classList.add('d-none');
            return true;
        }
    }
}

/**
 * Intercepta envíos AJAX para los formularios de login y registro
 */
function initAjaxForms() {
    const forms = [
        { id: 'loginForm', alertId: 'loginAlert' },
        { id: 'registerForm', alertId: 'registerAlert' },
        { id: 'quickAuthForm', alertId: 'authModalAlert' }
    ];

    forms.forEach(item => {
        const form = document.getElementById(item.id);
        if (!form) return;

        form.addEventListener('submit', function (e) {
            // Verificar coincidencia de contraseñas en registro
            if (item.id === 'registerForm') {
                const pass = document.getElementById('password');
                const confirm = document.getElementById('password_confirm');
                if (pass && confirm && pass.value !== confirm.value) {
                    e.preventDefault();
                    showAlert(item.alertId, 'Las contraseñas no coinciden. Por favor verifícalas.', 'danger');
                    confirm.focus();
                    return;
                }
            }

            // Manejo por AJAX si la variable global allowAjaxAuth es true o por omisión
            e.preventDefault();

            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Procesando...';
            }

            hideAlert(item.alertId);

            const formData = new FormData(form);

            fetch(form.action, {
                method: form.method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                if (body.success) {
                    showAlert(item.alertId, body.message || '¡Operación exitosa!', 'success');
                    
                    // Si hay tokens en la respuesta AJAX, los guardamos opcionalmente
                    if (body.tokens && body.tokens.access_token) {
                        localStorage.setItem('access_token', body.tokens.access_token);
                    }

                    setTimeout(() => {
                        const redirectUrl = body.redirect || sessionStorage.getItem('redirect_after_auth') || '/perfil';
                        sessionStorage.removeItem('redirect_after_auth');
                        window.location.href = redirectUrl;
                    }, 800);
                } else {
                    const errorMsg = body.message || (body.errors ? body.errors.join('<br>') : 'Error en la solicitud.');
                    showAlert(item.alertId, errorMsg, 'danger');
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnHtml;
                    }
                }
            })
            .catch(err => {
                console.error('Auth Error:', err);
                showAlert(item.alertId, 'Ocurrió un error de conexión con el servidor. Intenta de nuevo.', 'danger');
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                }
            });
        });
    });
}

function showAlert(alertId, message, type = 'danger') {
    const alertEl = document.getElementById(alertId);
    if (!alertEl) return;
    alertEl.className = `alert alert-${type} rounded-3 mb-4 d-flex align-items-center shadow-sm`;
    alertEl.innerHTML = `<i class="fas ${type === 'danger' ? 'fa-exclamation-circle' : 'fa-check-circle'} me-2 fs-5"></i><div>${message}</div>`;
    alertEl.classList.remove('d-none');
}

function hideAlert(alertId) {
    const alertEl = document.getElementById(alertId);
    if (!alertEl) return;
    alertEl.classList.add('d-none');
}
