<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEMTRIBE</title>
    <link rel="icon" type="image/png" href="/assets/img/logoverde.png">
    <link rel="shortcut icon" type="image/png" href="/assets/img/logoverde.png">
    <link href="https://fonts.googleapis.com/css2?family=Piazzolla:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/auth.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #1a1a1a; padding: 2px 0; min-height: 1px; line-height: 0.5 !important;">
        <div class="container" style="margin-top: -5px;">
            <a class="navbar-brand d-flex align-items-center" href="/" style="margin-top: 0 !important; margin-bottom: 0 !important; padding-top: 0 !important; padding-bottom: 0 !important;">
                <img src="/assets/img/logoverde.png" alt="FEMTRIBE Logo" style="height: 50px; margin-right: 4px;">
                <img src="/assets/img/nombre.png" alt="FEMTRIBE" style="height: 30px;">
            </a>
            
            <button class="navbar-toggler" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="navbarToggler">
                <i class="fas fa-bars nav-icon-bars"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav align-items-center nav-menu-ft">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Inicio</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="/eventos">Eventos</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="/nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/productos">Productos</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="/blog">Blog</a>
                    </li> -->
                    <?php if (!empty($_SESSION['user_id'])): ?>
                        <?php 
                        $isAdmin = (($_SESSION['user_role'] ?? '') === 'admin' || 
                                    ($_SESSION['user_role'] ?? '') === 'administrador' || 
                                    ($_SESSION['user_role_id'] ?? '') === 'a1b2c3d4-0002-0002-0002-000000000002');
                        ?>
                        <?php if ($isAdmin): ?>
                            <li class="nav-item">
                                <a class="nav-link text-danger fw-bold" href="/admin/dashboard">
                                    <i class="fas fa-user-shield me-1"></i>Admin
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link text-warning fw-bold" href="/perfil">
                                <i class="fas fa-user-circle me-1"></i><?= htmlspecialchars($_SESSION['user_nombres'] ?? 'Mi Perfil') ?>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <button class="btn inscribete-btn" type="button" data-bs-toggle="modal" data-bs-target="#authModal">
                                Login
                            </button>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="cart-circle" href="/carrito" aria-label="Carrito">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="count" data-cart-count>0</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal Superior Interactivo de Registro e Inicio de Sesión -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                <div class="modal-header border-0 pb-0 pe-4 pt-4">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 px-md-5 pb-5 pt-0">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-dark text-warning rounded-circle mb-3 shadow-sm" style="width: 55px; height: 55px; border: 2px solid #87CC3E;">
                            <i class="fas fa-running fa-2x" style="color: #87CC3E;"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-1" id="authModalTitle">Acceso FEMTRIBE</h4>
                        <p class="text-muted small mb-0">Inicia sesión o regístrate para comprar y participar en carreras</p>
                    </div>

                    <!-- Botón de Google OAuth 2.0 -->
                    <a href="/auth/google" class="btn-google mb-3">
                        <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                        </svg>
                        Continuar con Google
                    </a>

                    <div class="auth-divider">
                        <span>o ingresa con tu correo</span>
                    </div>

                    <div id="authModalAlert" class="alert alert-danger d-none rounded-3 small"></div>

                    <!-- Formulario Rápido de Login -->
                    <form action="/login" method="POST" id="quickAuthForm">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Correo o N° Documento</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                <input type="text" class="form-control bg-light border-start-0" name="login_input" required placeholder="ejemplo@correo.com o documento">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label small fw-semibold mb-0">Contraseña</label>
                                <a href="/forgot-password" class="small text-decoration-none fw-semibold" style="color: #6da632;">¿Olvidaste tu contraseña?</a>
                            </div>
                            <div class="input-group password-input-group w-100">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                <input type="password" class="form-control bg-light border-start-0" id="quick_password" name="password" required placeholder="••••••••">
                                <button type="button" class="toggle-password" data-toggle-password="quick_password" aria-label="Mostrar u ocultar contraseña">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 py-2.5 rounded-3 fw-bold text-uppercase shadow-sm" style="background-color: #1a1a1a; border-color: #1a1a1a;">
                            <i class="fas fa-sign-in-alt me-2" style="color: #87CC3E;"></i>Iniciar Sesión
                        </button>
                    </form>

                    <div class="text-center mt-4 pt-3 border-top">
                        <p class="small text-muted mb-0">¿No tienes una cuenta aún? 
                            <a href="/registro" class="fw-bold text-decoration-none" style="color: #87CC3E;">Registrarme como Corredor</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Genérico de Próximamente (Inscripciones / Productos) -->
    <div class="modal fade" id="proximamenteModal" tabindex="-1" aria-labelledby="proximamenteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden text-center position-relative" style="background: #ffffff;">
                <div class="modal-header border-0 pb-0 pe-4 pt-4 justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body px-4 px-md-5 pb-5 pt-0">
                    <!-- Icono dinámico -->
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow-sm" id="proxModalIconWrap" style="width: 76px; height: 76px; background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 100%); border: 3px solid #6da632;">
                        <i class="fas fa-running fa-2x" id="proxModalIcon" style="color: #6da632;"></i>
                    </div>

                    <!-- Badge de Categoría -->
                    <div>
                        <span class="badge px-3 py-1.5 rounded-pill text-uppercase fw-bold mb-2" id="proxModalBadge" style="background-color: #eaf7e3; color: #2e7d32; font-size: 11px; letter-spacing: 1px;">
                            🏃‍♀️ Carrera FEMTRIBE
                        </span>
                    </div>

                    <!-- Título -->
                    <h3 class="fw-bold text-dark mb-2" id="proxModalTitle" style="font-size: 24px;">
                        ¡Inscripciones Próximamente!
                    </h3>

                    <!-- Mensaje Principal -->
                    <p class="text-muted mb-3" id="proxModalMessage" style="font-size: 15px; line-height: 1.6;">
                        Estamos ultimando los detalles para que vivas una experiencia única en <strong>Corre con FEMTRIBE</strong>. Las inscripciones se habilitarán muy pronto.
                    </p>

                    <!-- Caja informativa -->
                    <div class="p-3 rounded-3 mb-4 text-start" id="proxModalNotice" style="background: #f8faf6; border-left: 4px solid #6da632;">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fas fa-bell text-success mt-1"></i>
                            <span class="small text-secondary" id="proxModalNoticeText">
                                Mantente atenta(o) a nuestras redes oficiales o escríbenos a WhatsApp para ser de las primeras en enterarte de la apertura oficial.
                            </span>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="d-flex flex-column gap-2">
                        <a href="https://wa.me/573104771933?text=Hola%20FEMTRIBE,%20quisiera%20recibir%20notificaci%C3%B3n%20cuando%20se%20habiliten%20las%20inscripciones." target="_blank" class="btn btn-dark w-100 py-2.5 rounded-pill fw-bold d-flex align-items-center justify-content-center gap-2 shadow-sm" id="proxModalWhatsappBtn" style="background: #25D366; border-color: #25D366; color: #ffffff;">
                            <i class="fab fa-whatsapp fs-5"></i>
                            <span id="proxModalWhatsappText">Avisarme por WhatsApp</span>
                        </a>

                        <button type="button" class="btn btn-outline-secondary w-100 py-2 rounded-pill fw-semibold" data-bs-dismiss="modal">
                            Entendido, ¡gracias!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        /* Reglas globales: altura del navbar, sticky footer y espacio de contenido */
        :root { --nav-height: 62px; }
        body { min-height: 100vh !important; display: flex !important; flex-direction: column !important; }
        footer { margin-top: auto !important; }
        .page-content { flex: 1 0 auto; padding-top: calc(var(--nav-height) + 1.9rem) !important; }

        /* ESTILOS BASE PARA NAVBAR */
        .navbar-nav .nav-link {
            color: #ffffff !important;
            font-weight: 400 !important;
            font-size: 16px !important;
            padding: 4px 0 !important;
            text-decoration: none !important;
            border: none !important;
            background-color: transparent !important;
            outline: none !important;
            box-shadow: none !important;
            transition: all 0.3s ease !important;
            transform: scale(1) !important;
        }
        
        .navbar-nav .nav-link:hover {
            color: #7ED321 !important;
            transform: scale(1.1) !important;
            text-decoration: none !important;
            border: none !important;
            background-color: transparent !important;
        }
        
        .inscribete-btn {
            background-color: transparent !important;
            border: 2px solid #7ED321 !important;
            color: #7ED321 !important;
            font-weight: 400 !important;
            font-size: 16px !important;
            padding: 6px 18px !important;
            border-radius: 30px !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            white-space: nowrap !important;
            text-align: center !important;
            line-height: 1.2 !important;
            transition: all 0.3s ease !important;
            transform: scale(1) !important;
            vertical-align: middle !important;
            margin-top: -2px !important;
        }
        
        .inscribete-btn:hover {
            background-color: #7ED321 !important;
            color: #000000 !important;
            border-color: #7ED321 !important;
            transform: scale(1.05) !important;
            text-decoration: none !important;
        }
        .cart-circle { display: inline-flex !important; align-items: center !important; justify-content: center !important; position: relative !important; text-decoration: none !important; cursor: pointer !important; color: #87CC3E !important; }
        .cart-circle i,
        .cart-circle svg,
        .cart-circle .svg-inline--fa { color: inherit !important; font-size: 20px !important; transition: transform 0.2s ease !important; }
        .cart-circle:hover i,
        .cart-circle:hover svg,
        .cart-circle:hover .svg-inline--fa { transform: scale(1.15) !important; }
        .cart-circle .count { position: absolute !important; top: -10px !important; right: -12px !important; background: #ffffff !important; color: #000000 !important; border-radius: 50% !important; min-width: 20px !important; height: 20px !important; padding: 0 5px !important; font-size: 12px !important; font-weight: 700 !important; display: inline-flex !important; align-items: center !important; justify-content: center !important; border: 1px solid rgba(0,0,0,0.15) !important; box-shadow: 0 1px 2px rgba(0,0,0,0.2) !important; }

        .nav-menu-ft {
            gap: 25px;
            margin-left: auto !important;
            display: flex !important;
            justify-content: flex-end !important;
            width: 100% !important;
        }

        @media (max-width: 991.98px) {
            :root { --nav-height: 70px; }
            .page-content { padding-top: var(--nav-height); }

            .navbar-collapse {
                background-color: #1a1a1a !important;
                padding: 18px 20px !important;
                border-radius: 12px !important;
                margin-top: 10px !important;
                box-shadow: 0 10px 25px rgba(0,0,0,0.6) !important;
                border: 1px solid rgba(135, 204, 62, 0.25) !important;
            }

            .nav-menu-ft {
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 16px !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 10px 0 !important;
            }

            .navbar-nav .nav-item {
                width: 100% !important;
                text-align: center !important;
            }

            .navbar-nav .nav-link {
                justify-content: center !important;
                padding: 8px 16px !important;
                font-size: 17px !important;
            }
        }
    </style>

    <script>
        // Variables globales de configuración de módulos
        window.FEMTRIBE_CONFIG = {
            registrationsEnabled: <?= (defined('ENABLE_REGISTRATIONS') && ENABLE_REGISTRATIONS) ? 'true' : 'false' ?>,
            productsEnabled: <?= (defined('ENABLE_PRODUCTS') && ENABLE_PRODUCTS) ? 'true' : 'false' ?>
        };

        // Función global para desplegar el Modal de Próximamente (Inscripciones / Productos)
        window.showProximamenteModal = function(type = 'inscripciones', customData = {}) {
            const modalEl = document.getElementById('proximamenteModal');
            if (!modalEl) return;

            const iconEl = document.getElementById('proxModalIcon');
            const badgeEl = document.getElementById('proxModalBadge');
            const titleEl = document.getElementById('proxModalTitle');
            const messageEl = document.getElementById('proxModalMessage');
            const noticeTextEl = document.getElementById('proxModalNoticeText');
            const waBtn = document.getElementById('proxModalWhatsappBtn');
            const waText = document.getElementById('proxModalWhatsappText');

            if (type === 'productos') {
                if (iconEl) iconEl.className = 'fas fa-shopping-bag fa-2x';
                if (badgeEl) {
                    badgeEl.textContent = '🛍️ Tienda FEMTRIBE';
                    badgeEl.style.backgroundColor = '#eef2ff';
                    badgeEl.style.color = '#3730a3';
                }
                if (titleEl) titleEl.textContent = customData.title || '¡Tienda Oficial Próximamente!';
                if (messageEl) messageEl.innerHTML = customData.message || 'Nuestra colección exclusiva deportiva y accesorios estará disponible muy pronto para ti.';
                if (noticeTextEl) noticeTextEl.textContent = customData.notice || 'Estamos preparando prendas de alto rendimiento y productos exclusivos. ¡Muy pronto abriremos compras!';
                if (waBtn) {
                    waBtn.href = 'https://wa.me/573104771933?text=' + encodeURIComponent('Hola FEMTRIBE, me gustaría recibir información sobre el lanzamiento de los productos de la tienda.');
                }
                if (waText) waText.textContent = 'Consultar Productos por WhatsApp';
            } else {
                // Default: inscripciones
                if (iconEl) iconEl.className = 'fas fa-running fa-2x';
                if (badgeEl) {
                    badgeEl.textContent = '🏃‍♀️ Carrera FEMTRIBE';
                    badgeEl.style.backgroundColor = '#eaf7e3';
                    badgeEl.style.color = '#2e7d32';
                }
                if (titleEl) titleEl.textContent = customData.title || '¡Inscripciones Próximamente!';
                if (messageEl) messageEl.innerHTML = customData.message || 'Estamos ultimando los detalles para que vivas una experiencia única en <strong>Corre con FEMTRIBE</strong>. Las inscripciones se habilitarán muy pronto.';
                if (noticeTextEl) noticeTextEl.textContent = customData.notice || 'Mantente atenta(o) a nuestras redes oficiales o escríbenos a WhatsApp para ser de las primeras en enterarte de la apertura de cupos.';
                if (waBtn) {
                    waBtn.href = 'https://wa.me/573104771933?text=' + encodeURIComponent('Hola FEMTRIBE, quisiera recibir notificación cuando se habiliten las inscripciones de la carrera.');
                }
                if (waText) waText.textContent = 'Avisarme por WhatsApp';
            }

            const bsModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            bsModal.show();
        };

        // Función global para desplegar el Modal de Autenticación
        window.isUserLoggedIn = <?= !empty($_SESSION['user_id']) ? 'true' : 'false' ?>;
        window.showAuthModal = function(redirectUrl = '') {
            if (redirectUrl) {
                sessionStorage.setItem('redirect_after_auth', redirectUrl);
            }
            const modalEl = document.getElementById('authModal');
            if (modalEl) {
                const bsModal = new bootstrap.Modal(modalEl);
                bsModal.show();
            } else {
                window.location.href = '/login';
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            const navbarToggler = document.getElementById('navbarToggler');
            const navbarCollapse = document.getElementById('navbarNav');
            const navbar = document.querySelector('.navbar');
            
            if (navbarToggler && navbarCollapse && navbar) {
                navbarToggler.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (navbarCollapse.classList.contains('show')) {
                        navbarCollapse.classList.remove('show');
                    } else {
                        navbarCollapse.classList.add('show');
                    }
                });
            }

            // Detectar si la URL contiene parámetro ?proximamente=... (redirección desde backend)
            const urlParams = new URLSearchParams(window.location.search);
            const proxParam = urlParams.get('proximamente');
            if (proxParam) {
                setTimeout(() => {
                    window.showProximamenteModal(proxParam);
                }, 350);

                // Limpiar parámetro de la URL sin recargar
                urlParams.delete('proximamente');
                const remaining = urlParams.toString();
                const cleanUrl = window.location.pathname + (remaining ? '?' + remaining : '');
                window.history.replaceState({}, document.title, cleanUrl);
            }

            // Interceptar clics en enlaces de inscripciones si están deshabilitadas
            if (!window.FEMTRIBE_CONFIG.registrationsEnabled) {
                document.addEventListener('click', function(e) {
                    const targetLink = e.target.closest('a[href="/inscribirse"], a[href="/registrar"], .inscribete-btn-link');
                    if (targetLink) {
                        e.preventDefault();
                        e.stopPropagation();
                        window.showProximamenteModal('inscripciones');
                    }
                }, true);
            }

            // Interceptar clics en enlaces de productos si están deshabilitados
            if (!window.FEMTRIBE_CONFIG.productsEnabled) {
                document.addEventListener('click', function(e) {
                    const targetLink = e.target.closest('a[href="/productos"], a[href^="/producto?"]');
                    if (targetLink) {
                        e.preventDefault();
                        e.stopPropagation();
                        window.showProximamenteModal('productos');
                    }
                }, true);
            }
        });
    </script>
    <script>
        // Actualiza contador del carrito desde localStorage
        (function(){
            const STORAGE_KEY = 'ft_cart';
            const badge = document.querySelector('[data-cart-count]');
            function update(){
                try {
                    const raw = localStorage.getItem(STORAGE_KEY);
                    const items = raw ? JSON.parse(raw) : [];
                    const count = items.reduce((a,i)=> a + Number(i.qty||0), 0);
                    if (badge) badge.textContent = count;
                } catch(e) { if (badge) badge.textContent = '0'; }
            }
            window.addEventListener('storage', (ev)=>{ if (ev.key === STORAGE_KEY) update(); });
            document.addEventListener('DOMContentLoaded', update);
            update();
        })();
    </script>
