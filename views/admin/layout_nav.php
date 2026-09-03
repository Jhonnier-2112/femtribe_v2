<?php /* layout_nav.php — Admin navigation + dark/light theme system */ ?>

<!-- ================================================
     ADMIN THEME: CSS completo oscuro / claro
     ================================================ -->
<style>
/* ---- Variables de color para cada tema ---- */
body.admin-dark {
    --adm-bg:         #0f0f0f;
    --adm-bg-2:       #1a1a1a;
    --adm-bg-3:       #242424;
    --adm-border:     rgba(255,255,255,0.08);
    --adm-text:       #e0e0e0;
    --adm-text-muted: #8a8a8a;
    --adm-input-bg:   #1e1e1e;
}
body.admin-light {
    --adm-bg:         #f4f6f8;
    --adm-bg-2:       #ffffff;
    --adm-bg-3:       #e9ecef;
    --adm-border:     rgba(0,0,0,0.1);
    --adm-text:       #1a1a1a;
    --adm-text-muted: #6c757d;
    --adm-input-bg:   #ffffff;
}

/* ---- Fondo y texto general ---- */
body.admin-dark,
body.admin-light {
    background-color: var(--adm-bg) !important;
    color: var(--adm-text) !important;
    transition: background-color 0.3s ease, color 0.3s ease;
}
body.admin-dark .page-content,
body.admin-light .page-content {
    background-color: var(--adm-bg) !important;
}

/* ---- Módulo de evento (container-fluid) ---- */
body.admin-dark .style-admin-bg,
body.admin-light .style-admin-bg {
    background-color: var(--adm-bg) !important;
    color: var(--adm-text) !important;
}

/* ---- Cards ---- */
body.admin-dark .card,
body.admin-light .card {
    background-color: var(--adm-bg-2) !important;
    border-color: var(--adm-border) !important;
    color: var(--adm-text) !important;
    transition: background-color 0.3s ease;
}
body.admin-dark .card-body,
body.admin-dark .card-header,
body.admin-dark .card-footer,
body.admin-light .card-body,
body.admin-light .card-header,
body.admin-light .card-footer {
    background-color: transparent !important;
    color: var(--adm-text) !important;
}

/* ---- Textos ---- */
body.admin-dark h1, body.admin-dark h2, body.admin-dark h3,
body.admin-dark h4, body.admin-dark h5, body.admin-dark h6,
body.admin-light h1, body.admin-light h2, body.admin-light h3,
body.admin-light h4, body.admin-light h5, body.admin-light h6 {
    color: var(--adm-text) !important;
}
/* Nav card: siempre fondo oscuro → texto siempre blanco en ambos temas */
body.admin-light #admin-nav-card h4,
body.admin-light #admin-nav-card p,
body.admin-light #admin-nav-card .text-white-50 {
    color: #ffffff !important;
}
body.admin-dark .text-dark  { color: var(--adm-text) !important; }
body.admin-dark .text-muted { color: var(--adm-text-muted) !important; }
body.admin-light .text-dark { color: #212529 !important; }

/* ---- Tablas ---- */
body.admin-dark .table,
body.admin-light .table {
    color: var(--adm-text) !important;
}
body.admin-dark .table > :not(caption) > * > *,
body.admin-light .table > :not(caption) > * > * {
    background-color: transparent !important;
    color: var(--adm-text) !important;
    border-color: var(--adm-border) !important;
}
body.admin-dark .table-hover > tbody > tr:hover > * {
    background-color: rgba(255,255,255,0.05) !important;
}
body.admin-light .table-hover > tbody > tr:hover > * {
    background-color: rgba(0,0,0,0.04) !important;
}
body.admin-dark thead.bg-light,
body.admin-dark .table thead { background-color: var(--adm-bg-3) !important; color: var(--adm-text-muted) !important; }
body.admin-light thead.bg-light,
body.admin-light .table thead { background-color: #f1f3f5 !important; }

/* ---- Fondos utilitarios ---- */
body.admin-dark .bg-light  { background-color: var(--adm-bg-3) !important; }
body.admin-dark .bg-white  { background-color: var(--adm-bg-2) !important; }
body.admin-light .bg-light { background-color: #f1f3f5 !important; }

/* ---- Formularios ---- */
body.admin-dark .form-control,
body.admin-dark .form-select,
body.admin-light .form-control,
body.admin-light .form-select {
    background-color: var(--adm-input-bg) !important;
    color: var(--adm-text) !important;
    border-color: var(--adm-border) !important;
    transition: background-color 0.3s, color 0.3s;
}
body.admin-dark .form-control::placeholder { color: var(--adm-text-muted) !important; }
body.admin-dark .form-control:focus,
body.admin-dark .form-select:focus {
    background-color: var(--adm-input-bg) !important;
    color: var(--adm-text) !important;
    border-color: #B2D81F !important;
    box-shadow: 0 0 0 0.2rem rgba(178,216,31,0.2) !important;
}
body.admin-dark .form-label,
body.admin-light .form-label {
    color: var(--adm-text-muted) !important;
    font-weight: 600;
}
body.admin-dark .form-label { color: #bdbdbd !important; }
body.admin-dark .input-group-text {
    background-color: var(--adm-bg-3) !important;
    color: var(--adm-text-muted) !important;
    border-color: var(--adm-border) !important;
}

/* ---- Alertas ---- */
body.admin-dark .alert-success  { background-color: #1b3a1f !important; color: #a5d6a7 !important; border-color: #2e7d32 !important; }
body.admin-dark .alert-danger   { background-color: #3a1b1b !important; color: #ef9a9a !important; border-color: #7d2020 !important; }
body.admin-dark .alert-warning  { background-color: #3a2e1b !important; color: #ffe082 !important; border-color: #7d5a00 !important; }
body.admin-dark .alert-info     { background-color: #1b2e3a !important; color: #81d4fa !important; border-color: #0277bd !important; }

/* ---- Badges ---- */
body.admin-dark .badge.bg-light { background-color: var(--adm-bg-3) !important; color: var(--adm-text) !important; }

/* ---- Botones utilitarios ---- */
body.admin-dark .btn-light {
    background-color: var(--adm-bg-3) !important;
    color: var(--adm-text) !important;
    border-color: var(--adm-border) !important;
}
body.admin-dark .btn-outline-secondary {
    color: var(--adm-text-muted) !important;
    border-color: var(--adm-border) !important;
}

/* ---- Separadores y bordes ---- */
body.admin-dark hr,
body.admin-dark .border,
body.admin-dark .border-top,
body.admin-dark .border-bottom,
body.admin-dark .border-start,
body.admin-dark .border-end   { border-color: var(--adm-border) !important; }

/* ---- Modales ---- */
body.admin-dark .modal-content  { background-color: var(--adm-bg-2) !important; color: var(--adm-text) !important; }
body.admin-dark .modal-header,
body.admin-dark .modal-footer   { border-color: var(--adm-border) !important; }
body.admin-dark .btn-close      { filter: invert(1) grayscale(1); }

/* ---- Dropdowns ---- */
body.admin-dark .dropdown-menu  { background-color: var(--adm-bg-2) !important; border-color: var(--adm-border) !important; }
body.admin-dark .dropdown-item  { color: var(--adm-text) !important; }
body.admin-dark .dropdown-item:hover { background-color: rgba(255,255,255,0.07) !important; }
body.admin-dark .dropdown-divider { border-color: var(--adm-border) !important; }

/* ---- Paginación ---- */
body.admin-dark .page-link  { background-color: var(--adm-bg-2) !important; border-color: var(--adm-border) !important; color: var(--adm-text) !important; }
body.admin-dark .page-item.active .page-link { background-color: #B2D81F !important; border-color: #B2D81F !important; color: #000 !important; }
body.admin-dark .page-item.disabled .page-link { background-color: var(--adm-bg-3) !important; color: var(--adm-text-muted) !important; }

/* ---- Stat cards del dashboard ---- */
body.admin-dark .admin-stat-card { background: linear-gradient(135deg, #1e1e1e 0%, #111 100%) !important; }
body.admin-light .admin-stat-card { background: linear-gradient(135deg, #ffffff 0%, #f4f6f8 100%) !important; }

/* ---- Botón toggle de tema ---- */
#adminThemeToggle {
    background: transparent;
    border: 1px solid rgba(178,216,31,0.5);
    color: #B2D81F;
    border-radius: 999px;
    padding: 4px 14px;
    font-size: 0.78rem;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.25s ease;
    white-space: nowrap;
}
#adminThemeToggle:hover {
    background: rgba(178,216,31,0.12);
    border-color: #B2D81F;
}

/* ---- Tabs de navegación (adaptadas por tema) ---- */
.btn-nav-tab {
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.25s ease;
    border: 1px solid rgba(255,255,255,0.15) !important;
}
.btn-tab-inactive { color: #f8f9fa !important; background-color: transparent !important; }
body.admin-light .btn-tab-inactive { color: #495057 !important; border-color: rgba(0,0,0,0.15) !important; }
.btn-nav-tab:hover { color: #fff !important; border-color: #B2D81F !important; background-color: rgba(178,216,31,0.12) !important; }
body.admin-light .btn-nav-tab:hover { color: #000 !important; }
.btn-tab-active { background-color: #B2D81F !important; color: #000 !important; border-color: #B2D81F !important; }
.btn-tab-active:hover { background-color: #9fc41a !important; color: #000 !important; }

/* ---- Botón "Editar" (btn-outline-dark) en modo oscuro → verde marca ---- */
body.admin-dark .btn-outline-dark {
    color: #B2D81F !important;
    border-color: #B2D81F !important;
    background-color: transparent !important;
}
body.admin-dark .btn-outline-dark:hover {
    background-color: #B2D81F !important;
    color: #000 !important;
    border-color: #B2D81F !important;
}

/* ---- Módulo EVENTO en modo claro: neutralizar estilos oscuros hardcoded ---- */

/* Cards con background inline #1e1e1e y gradients oscuros (excluye el nav card) */
body.admin-light .style-admin-bg .card[style*="1e1e1e"]:not(#admin-nav-card),
body.admin-light .style-admin-bg .card[style*="252525"]:not(#admin-nav-card),
body.admin-light .style-admin-bg .card[style*="linear-gradient"]:not(#admin-nav-card) {
    background: #ffffff !important;
    color: #1a1a1a !important;
}

/* El nav card SIEMPRE mantiene fondo oscuro, en todos los módulos y temas */
#admin-nav-card {
    background: linear-gradient(135deg, #1e1e1e 0%, #111 100%) !important;
}

/* Textos blancos y semiblancos dentro del módulo evento */
body.admin-light .style-admin-bg .text-white,
body.admin-light .style-admin-bg .text-white-50,
body.admin-light .style-admin-bg h3.text-white,
body.admin-light .style-admin-bg h6.text-white,
body.admin-light .style-admin-bg .fw-bold.text-white,
body.admin-light .style-admin-bg td .fw-bold.text-white,
body.admin-light .style-admin-bg small.text-white-50,
body.admin-light .style-admin-bg .form-text.text-white-50,
body.admin-light .style-admin-bg label.text-white,
body.admin-light .style-admin-bg .form-label.text-white,
body.admin-light .style-admin-bg td.text-white-50,
body.admin-light .style-admin-bg .text-center.py-5.text-white-50 {
    color: #495057 !important;
}

/* Subtítulo del banner de gestión */
body.admin-light .style-admin-bg p.text-white-50 { color: #6c757d !important; }

/* Labels del formulario con text-white */
body.admin-light .style-admin-bg .form-check-label.text-white-50 { color: #6c757d !important; }

/* Inputs con bg-dark text-white */
body.admin-light .style-admin-bg .bg-dark.text-white,
body.admin-light .style-admin-bg input.bg-dark,
body.admin-light .style-admin-bg select.bg-dark,
body.admin-light .style-admin-bg textarea.bg-dark {
    background-color: #f8f9fa !important;
    color: #212529 !important;
    border-color: #ced4da !important;
}

/* Select con bg-secondary bg-opacity-25 (categoría/modalidad dentro de stages) */
body.admin-light .style-admin-bg select.bg-secondary {
    background-color: #f1f3f5 !important;
    color: #212529 !important;
    border-color: #ced4da !important;
}

/* Input-group-text dentro del módulo evento */
body.admin-light .style-admin-bg .input-group-text.bg-secondary {
    background-color: #e9ecef !important;
    color: #495057 !important;
    border-color: #ced4da !important;
}

/* Contenedor de cada stage (bg-dark position-relative) */
body.admin-light .style-admin-bg .bg-dark.position-relative {
    background-color: #f8f9fa !important;
    border-color: #dee2e6 !important;
}

/* Tabla de inscritos: table-dark → tabla normal */
body.admin-light .style-admin-bg .table-dark {
    --bs-table-bg: transparent !important;
    --bs-table-color: #212529 !important;
    --bs-table-striped-color: #212529 !important;
    --bs-table-hover-color: #212529 !important;
    background-color: transparent !important;
    color: #212529 !important;
}
body.admin-light .style-admin-bg .table-dark > :not(caption) > * > * {
    background-color: transparent !important;
    color: #212529 !important;
    border-color: #dee2e6 !important;
}
body.admin-light .style-admin-bg .table-hover > tbody > tr:hover > * {
    background-color: rgba(0,0,0,0.04) !important;
    color: #212529 !important;
}

/* Encabezado de tabla (tr text-white-50) */
body.admin-light .style-admin-bg thead tr.text-white-50 { color: #6c757d !important; }
body.admin-light .style-admin-bg thead tr th { color: #6c757d !important; }

/* Badges con bg-dark dentro de la tabla */
body.admin-light .style-admin-bg .badge.bg-dark { background-color: #e9ecef !important; color: #212529 !important; }
body.admin-light .style-admin-bg .badge.bg-secondary.bg-opacity-50 { background-color: #dee2e6 !important; color: #495057 !important; }

/* Modal con background #1e1e1e inline */
body.admin-light .modal-content[style*="1e1e1e"] {
    background-color: #ffffff !important;
    color: #212529 !important;
}
body.admin-light .modal-content[style*="1e1e1e"] .form-label { color: #495057 !important; }
body.admin-light .modal-content[style*="1e1e1e"] input.bg-dark,
body.admin-light .modal-content[style*="1e1e1e"] select.bg-dark,
body.admin-light .modal-content[style*="1e1e1e"] textarea.bg-dark {
    background-color: #f8f9fa !important;
    color: #212529 !important;
    border-color: #ced4da !important;
}
body.admin-light .modal-content[style*="1e1e1e"] .modal-header { border-color: #dee2e6 !important; }
body.admin-light .modal-content[style*="1e1e1e"] .modal-footer { border-color: #dee2e6 !important; }
body.admin-light .modal-content[style*="1e1e1e"] .btn-close { filter: none !important; }

/* Métricas rápidas (stat cards con gradiente) en modo claro */
body.admin-light .style-admin-bg .card[style*="linear-gradient"] .text-white-50 { color: #6c757d !important; }
body.admin-light .style-admin-bg .card[style*="linear-gradient"] h3 { color: #212529 !important; }

/* "Sin etapa asignada" y fechas en td */
body.admin-light .style-admin-bg td.text-white-50.small,
body.admin-light .style-admin-bg span.text-white-50.small { color: #6c757d !important; }

</style>

<!-- ================================================
     PANEL DE NAVEGACIÓN ADMIN
     ================================================ -->
<div class="row mb-4">
    <div class="col-12">
        <div id="admin-nav-card" class="card border-0 shadow-sm rounded-4 text-white" style="background: linear-gradient(135deg, #1e1e1e 0%, #111 100%);">
            <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h4 class="fw-bold mb-1" style="color: #B2D81F;">
                        <i class="fas fa-user-shield me-2"></i>Panel de Administración FemTribe
                    </h4>
                    <p class="text-white-50 small mb-0">Gestión de corredores, catálogo de productos, categorías, pedidos e historial de visitas.</p>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <!-- Toggle Tema -->
                    <button id="adminThemeToggle" title="Cambiar tema">
                        <i class="fas fa-moon" id="adminThemeIcon"></i>
                        <span id="adminThemeLabel">Modo Claro</span>
                    </button>

                    <a href="/admin/dashboard" class="btn btn-sm rounded-pill px-3 py-2 btn-nav-tab <?= $activeTab === 'dashboard'   ? 'btn-tab-active' : 'btn-tab-inactive' ?>">
                        <i class="fas fa-chart-pie me-1"></i>Dashboard
                    </a>
                    <a href="/admin/usuarios" class="btn btn-sm rounded-pill px-3 py-2 btn-nav-tab <?= $activeTab === 'users'       ? 'btn-tab-active' : 'btn-tab-inactive' ?>">
                        <i class="fas fa-users me-1"></i>Usuarios
                    </a>
                    <a href="/admin/productos" class="btn btn-sm rounded-pill px-3 py-2 btn-nav-tab <?= $activeTab === 'products'    ? 'btn-tab-active' : 'btn-tab-inactive' ?>">
                        <i class="fas fa-tshirt me-1"></i>Productos
                    </a>
                    <a href="/admin/categorias" class="btn btn-sm rounded-pill px-3 py-2 btn-nav-tab <?= $activeTab === 'categories' ? 'btn-tab-active' : 'btn-tab-inactive' ?>">
                        <i class="fas fa-tags me-1"></i>Categorías
                    </a>
                    <a href="/admin/compras" class="btn btn-sm rounded-pill px-3 py-2 btn-nav-tab <?= $activeTab === 'orders'      ? 'btn-tab-active' : 'btn-tab-inactive' ?>">
                        <i class="fas fa-shopping-bag me-1"></i>Compras
                    </a>
                    <a href="/admin/evento" class="btn btn-sm rounded-pill px-3 py-2 btn-nav-tab <?= $activeTab === 'event'       ? 'btn-tab-active' : 'btn-tab-inactive' ?>">
                        <i class="fas fa-calendar-alt me-1"></i>Evento
                    </a>
                    <a href="/admin/accesos" class="btn btn-sm rounded-pill px-3 py-2 btn-nav-tab <?= $activeTab === 'access_logs' ? 'btn-tab-active' : 'btn-tab-inactive' ?>">
                        <i class="fas fa-history me-1"></i>Logs de Acceso
                    </a>
                    <a href="/admin/auditoria" class="btn btn-sm rounded-pill px-3 py-2 btn-nav-tab <?= $activeTab === 'audit_logs' ? 'btn-tab-active' : 'btn-tab-inactive' ?>">
                        <i class="fas fa-shield-alt me-1"></i>Auditoría
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================================================
     JS: Sistema de tema oscuro / claro
     ================================================ -->
<script>
(function () {
    const THEME_KEY = 'ft_admin_theme';
    const DEFAULT   = 'admin-dark';

    function applyTheme(theme) {
        document.body.classList.remove('admin-dark', 'admin-light');
        document.body.classList.add(theme);
        try { localStorage.setItem(THEME_KEY, theme); } catch(e) {}

        const icon  = document.getElementById('adminThemeIcon');
        const label = document.getElementById('adminThemeLabel');
        const btn   = document.getElementById('adminThemeToggle');
        if (!btn) return;

        if (theme === 'admin-dark') {
            if (icon)  icon.className  = 'fas fa-sun';
            if (label) label.textContent = 'Modo Claro';
            btn.title = 'Cambiar a modo claro';
        } else {
            if (icon)  icon.className  = 'fas fa-moon';
            if (label) label.textContent = 'Modo Oscuro';
            btn.title = 'Cambiar a modo oscuro';
        }
    }

    // Aplicar tema guardado inmediatamente (evita parpadeo)
    var saved;
    try { saved = localStorage.getItem(THEME_KEY); } catch(e) {}
    applyTheme(saved || DEFAULT);

    document.addEventListener('DOMContentLoaded', function () {
        // Actualizar ícono (el DOM ya existe)
        var saved2;
        try { saved2 = localStorage.getItem(THEME_KEY); } catch(e) {}
        applyTheme(saved2 || DEFAULT);

        var btn = document.getElementById('adminThemeToggle');
        if (btn) {
            btn.addEventListener('click', function () {
                var current = document.body.classList.contains('admin-dark') ? 'admin-dark' : 'admin-light';
                applyTheme(current === 'admin-dark' ? 'admin-light' : 'admin-dark');
            });
        }
    });
})();
</script>
