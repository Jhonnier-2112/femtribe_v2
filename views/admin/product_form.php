<?php
$isEdit = ($mode === 'edit');
$title  = ($isEdit ? "Editar Producto" : "Nuevo Producto") . " | FemTribe Runner";
require __DIR__ . '/../layouts/header.php';

// Valores por defecto
$pId          = $product['id'] ?? '';
$pName        = $product['name'] ?? '';
$pSku         = $product['sku'] ?? '';
$pPrice       = $product['price'] ?? 0;
$pStock       = $product['stock'] ?? 0;
$pCatId       = $product['category_id'] ?? '';
$pGender      = $product['gender'] ?? 'mujer';
$pType        = $product['type'] ?? 'camisetas';
$pColors      = $product['colors'] ?? '';
$pSizes       = $product['sizes']  ?? '';
$pDescription = $product['description'] ?? '';
$pIsNew       = isset($product['is_new'])  && $product['is_new']  == 1;
$pIsOffer     = isset($product['is_offer']) && $product['is_offer'] == 1;

// Procesar colores y tallas para pre-selección
$selectedColors = array_map('strtolower', array_filter(array_map('trim', explode(',', (string)$pColors))));
$selectedSizes  = array_map('strtoupper', array_filter(array_map('trim', explode(',', (string)$pSizes))));

// Capturar mensajes de sesión antes de renderizar
$sessionError   = $_SESSION['admin_error']   ?? '';
$sessionSuccess = $_SESSION['admin_success'] ?? '';
unset($_SESSION['admin_error'], $_SESSION['admin_success']);

// Cargar medios existentes desde product_media (modo edición) o estado recuperado en reintento
$existingMedia = [];
if ($isEdit && !empty($pId)) {
    $mediaModel    = new \App\Models\ProductMedia();
    $existingMedia = $mediaModel->getByProductId((int)$pId);
} elseif (!empty($product['media']) && is_array($product['media'])) {
    $existingMedia = $product['media'];
}
$existingMediaJson = json_encode($existingMedia, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>

<!-- INPUT FILE: fuera del dropZone para evitar propagación de eventos -->
<input type="file" id="fileInput" multiple
       accept=".jpg,.jpeg,.png,.webp,.gif,.mp4,.webm,.mov"
       style="display:none;position:fixed;top:-9999px;">

<!-- ===== MODAL DE NOTIFICACIONES ===== -->
<div id="notifOverlay" style="
    display:none;position:fixed;inset:0;z-index:9999;
    background:rgba(0,0,0,.55);backdrop-filter:blur(4px);
    align-items:center;justify-content:center;">
    <div id="notifBox" style="
        background:#fff;border-radius:20px;padding:2.2rem 2.5rem;
        max-width:440px;width:90%;text-align:center;
        box-shadow:0 20px 60px rgba(0,0,0,.25);
        animation:notifPop .3s cubic-bezier(.34,1.56,.64,1) both;">
        <div id="notifIcon" style="font-size:3rem;margin-bottom:.8rem;"></div>
        <h5 id="notifTitle" style="font-weight:700;margin-bottom:.5rem;color:#1e293b;"></h5>
        <p  id="notifMsg"   style="color:#64748b;font-size:.95rem;margin-bottom:1.5rem;line-height:1.5;"></p>
        <button onclick="closeNotif()" style="
            background:#87CC3E;border:none;color:#111;
            font-weight:700;padding:.7rem 2.2rem;border-radius:30px;
            font-size:.95rem;cursor:pointer;transition:transform .15s;">
            Aceptar
        </button>
    </div>
</div>

<style>
@keyframes notifPop {
    from { transform:scale(.75); opacity:0; }
    to   { transform:scale(1);   opacity:1; }
}

/* Selector estilo Chip/Badge */
.chip-check { display:none; }
.chip-label {
    cursor:pointer; user-select:none;
    transition:all .15s ease-in-out;
}
.chip-check:checked + .chip-label {
    background-color:#1e293b !important;
    color:#ffffff !important;
    border-color:#1e293b !important;
    box-shadow:0 3px 8px rgba(0,0,0,.18);
}

/* ====== MEDIA UPLOADER ====== */
.media-uploader {
    background:#f8fafc;
    border:2px dashed #cbd5e1;
    border-radius:16px;
    padding:1.5rem;
    transition:border-color .25s, background .25s;
    position:relative;
}
.media-uploader.drag-over {
    border-color:#87CC3E;
    background:#f0fdf4;
}
.upload-btn-area {
    display:flex;flex-direction:column;align-items:center;
    gap:.6rem;padding:1.2rem 0 .6rem;cursor:pointer;
    border-radius:12px;transition:background .2s;
    user-select:none;
}
.upload-btn-area:hover { background:rgba(135,204,62,.08); }
.upload-btn-area i     { font-size:2.5rem;color:#87CC3E; }
.upload-btn-area strong{ color:#334155;font-size:1rem; }
.upload-btn-area span  { font-size:.82rem;color:#94a3b8; }
.upload-pick-btn {
    margin-top:.4rem;
    background:#87CC3E;border:none;color:#111;
    font-weight:700;font-size:.82rem;
    padding:.45rem 1.4rem;border-radius:30px;cursor:pointer;
    transition:transform .15s,box-shadow .15s;
    display:inline-flex;align-items:center;gap:.4rem;
}
.upload-pick-btn:hover { transform:translateY(-1px);box-shadow:0 4px 12px rgba(135,204,62,.4); }

/* Grid de miniaturas */
.media-grid {
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(120px,1fr));
    gap:10px;
    margin-top:1rem;
}
.media-card {
    position:relative;border-radius:12px;overflow:hidden;
    background:#1e293b;aspect-ratio:1/1;
    box-shadow:0 2px 8px rgba(0,0,0,.15);
    transition:transform .2s,box-shadow .2s;
    cursor:grab;
}
.media-card:active { cursor:grabbing; }
.media-card:hover  { transform:translateY(-3px);box-shadow:0 6px 18px rgba(0,0,0,.2); }
.media-card img    { width:100%;height:100%;object-fit:cover;display:block;pointer-events:none; }
.media-card .video-thumb {
    width:100%;height:100%;display:flex;flex-direction:column;
    align-items:center;justify-content:center;
    color:#fff;gap:6px;
    background:linear-gradient(135deg,#1e3a5f,#0f172a);
    padding:.5rem;pointer-events:none;
}
.media-card .video-thumb i     { font-size:2rem;color:#87CC3E; }
.media-card .video-thumb span  { font-size:.68rem;text-align:center;word-break:break-all;color:#94a3b8;max-height:2.6em;overflow:hidden; }
.badge-type {
    position:absolute;top:6px;left:6px;
    font-size:.6rem;font-weight:700;text-transform:uppercase;
    padding:2px 7px;border-radius:20px;
    background:rgba(0,0,0,.55);color:#fff;backdrop-filter:blur(4px);
    pointer-events:none;
}
.badge-type.video { background:rgba(135,204,62,.85);color:#000; }
.badge-type.main  { background:rgba(59,130,246,.85); }
.btn-remove {
    position:absolute;top:5px;right:5px;
    width:24px;height:24px;border-radius:50%;
    background:rgba(220,38,38,.85);border:none;cursor:pointer;
    display:flex;align-items:center;justify-content:center;
    color:#fff;font-size:.75rem;line-height:1;
    transition:background .2s,transform .2s;
    backdrop-filter:blur(4px);z-index:2;
}
.btn-remove:hover { background:#dc2626;transform:scale(1.15); }

/* Progreso */
.upload-progress-bar { height:5px;border-radius:99px;background:#e2e8f0;overflow:hidden;margin-top:.8rem;display:none; }
.upload-progress-bar .bar { height:100%;background:#87CC3E;transition:width .3s;width:0%; }

/* Spinner en card mientras sube */
.media-card.uploading::after  { content:'';position:absolute;inset:0;background:rgba(0,0,0,.55); }
.media-card.uploading::before {
    content:'';position:absolute;top:50%;left:50%;
    transform:translate(-50%,-50%);
    width:28px;height:28px;
    border:3px solid #fff;border-top-color:#87CC3E;
    border-radius:50%;animation:spin .7s linear infinite;z-index:2;
}
@keyframes spin { to { transform:translate(-50%,-50%) rotate(360deg); } }

/* Drag-reorder */
.media-card.drag-src    { opacity:.35;border:2px dashed #87CC3E; }
.media-card.drag-target { border:2px solid #87CC3E; }
</style>

<div class="page-content py-5">
  <div class="container">
    <?php require __DIR__ . '/layout_nav.php'; ?>

    <div class="row justify-content-center mt-4">
      <div class="col-lg-9">
        <div class="card border-0 shadow-lg rounded-4">

          <div class="card-header bg-dark text-white border-0 py-3 px-4 rounded-top-4 d-flex align-items-center justify-content-between">
            <h5 class="fw-bold mb-0">
              <i class="<?= $isEdit ? 'fas fa-edit' : 'fas fa-plus-circle' ?> me-2"></i>
              <?= $isEdit ? 'Modificar Información del Producto' : 'Registrar Nuevo Producto' ?>
            </h5>
            <a href="/admin/productos" class="btn btn-sm btn-outline-light rounded-pill px-3">
              <i class="fas fa-arrow-left me-1"></i>Regresar
            </a>
          </div>

          <div class="card-body p-4 p-md-5 text-dark">
            <form id="productForm"
                  action="<?= $isEdit ? '/admin/productos/actualizar' : '/admin/productos/guardar' ?>"
                  method="POST"
                  class="needs-validation"
                  novalidate>

              <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= $pId ?>">
              <?php endif; ?>
              <input type="hidden" name="media_json" id="mediaJson" value="[]">

              <div class="row g-3">

                <!-- Nombre -->
                <div class="col-12 col-md-8">
                  <label class="form-label fw-bold small text-muted text-uppercase">Nombre del Producto</label>
                  <input type="text" name="name" class="form-control bg-light py-2"
                         placeholder="ej. Camiseta Oficial FemTribe Blanca"
                         value="<?= htmlspecialchars($pName) ?>" required>
                </div>

                <!-- SKU -->
                <div class="col-12 col-md-4">
                  <label class="form-label fw-bold small text-muted text-uppercase">Código SKU</label>
                  <input type="text" name="sku" class="form-control bg-light py-2"
                         placeholder="ej. CO-005"
                         value="<?= htmlspecialchars($pSku) ?>" required>
                </div>

                <!-- Precio -->
                <div class="col-6 col-md-6">
                  <label class="form-label fw-bold small text-muted text-uppercase">Precio ($ COP)</label>
                  <div class="input-group">
                    <span class="input-group-text bg-light">$</span>
                    <input type="number" name="price" class="form-control bg-light py-2"
                           value="<?= (float)$pPrice ?>" step="1000" min="0" required>
                  </div>
                </div>

                <!-- Stock -->
                <div class="col-6 col-md-6">
                  <label class="form-label fw-bold small text-muted text-uppercase">Stock Disponible</label>
                  <input type="number" name="stock" class="form-control bg-light py-2"
                         value="<?= (int)$pStock ?>" min="0" required>
                </div>

                <!-- Categoría -->
                <div class="col-12 col-md-4">
                  <label class="form-label fw-bold small text-muted text-uppercase">Categoría</label>
                  <select name="category_id" class="form-select bg-light py-2">
                    <option value="">Selecciona Categoría...</option>
                    <?php foreach ($categories as $cat): ?>
                      <option value="<?= $cat['id'] ?>" <?= $pCatId == $cat['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <!-- Género / Audiencia -->
                <div class="col-6 col-md-4">
                  <label class="form-label fw-bold small text-muted text-uppercase">Público / Género</label>
                  <select name="gender" id="genderSelect" class="form-select bg-light py-2">
                    <option value="mujer"  <?= $pGender === 'mujer'  ? 'selected' : '' ?>>Mujer</option>
                    <option value="hombre" <?= $pGender === 'hombre' ? 'selected' : '' ?>>Hombre</option>
                    <option value="ninos"  <?= ($pGender === 'ninos' || $pGender === 'kids') ? 'selected' : '' ?>>Niños / Kids</option>
                    <option value="unisex" <?= $pGender === 'unisex' ? 'selected' : '' ?>>Unisex</option>
                  </select>
                </div>

                <!-- Tipo -->
                <div class="col-6 col-md-4">
                  <label class="form-label fw-bold small text-muted text-uppercase">Tipo de Producto</label>
                  <select name="type" id="typeSelect" class="form-select bg-light py-2">
                    <option value="camisetas"        <?= $pType === 'camisetas'        ? 'selected' : '' ?>>Camisetas</option>
                    <option value="esqueletos"       <?= $pType === 'esqueletos'       ? 'selected' : '' ?>>Esqueletos</option>
                    <option value="licras"           <?= $pType === 'licras'           ? 'selected' : '' ?>>Licras</option>
                    <option value="medias"           <?= $pType === 'medias'           ? 'selected' : '' ?>>Medias</option>
                    <option value="botella_plegable" <?= $pType === 'botella_plegable' ? 'selected' : '' ?>>Botella Plegable / Termo</option>
                    <option value="accesorios"       <?= $pType === 'accesorios'       ? 'selected' : '' ?>>Accesorios</option>
                  </select>
                </div>

                <!-- SECCIÓN: COLORES Y TALLAS -->
                <!-- Colores disponibles -->
                <div class="col-12 col-md-6">
                  <label class="form-label fw-bold small text-muted text-uppercase d-flex align-items-center gap-1">
                    <i class="fas fa-palette text-primary me-1"></i> Colores Disponibles
                  </label>
                  <div class="d-flex flex-wrap gap-2 mb-2">
                    <?php 
                    $colorOptions = [
                        'Negro' => '#1e293b', 'Blanco' => '#ffffff', 'Verde' => '#87CC3E', 
                        'Rosa' => '#ec4899', 'Azul' => '#3b82f6', 'Rojo' => '#ef4444', 
                        'Gris' => '#64748b', 'Amarillo' => '#eab308', 'Morado' => '#a855f7'
                    ];
                    $presetColorKeys = array_map('strtolower', array_keys($colorOptions));
                    $customColorsList = array_filter($selectedColors, function($c) use ($presetColorKeys) {
                        return !in_array($c, $presetColorKeys);
                    });
                    foreach ($colorOptions as $cName => $cHex): 
                        $cLower = strtolower($cName);
                        $isChecked = in_array($cLower, $selectedColors);
                    ?>
                      <div>
                        <input type="checkbox" name="colors[]" value="<?= $cName ?>" id="color_<?= $cName ?>" class="chip-check" <?= $isChecked ? 'checked' : '' ?>>
                        <label for="color_<?= $cName ?>" class="chip-label btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 d-inline-flex align-items-center gap-2">
                          <span style="width:11px;height:11px;border-radius:50%;background:<?= $cHex ?>;border:1px solid rgba(0,0,0,.25);display:inline-block;"></span>
                          <?= $cName ?>
                        </label>
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <input type="text" name="colors[]" class="form-control form-control-sm bg-light" 
                         placeholder="Otro color personalizado (ej: Verde Neón, Negro Mate)..." 
                         value="<?= htmlspecialchars(implode(', ', $customColorsList)) ?>">
                </div>

                <!-- Tallas Disponibles (dinámicas según Género y Tipo) -->
                <div class="col-12 col-md-6" id="sizesSection">
                  <label class="form-label fw-bold small text-muted text-uppercase d-flex align-items-center gap-1">
                    <i class="fas fa-ruler-horizontal text-warning me-1"></i> Tallas Disponibles
                    <span class="badge bg-success ms-1" id="sizesBadge">Ropa</span>
                  </label>

                  <div id="noSizesNotice" class="alert alert-light border rounded-3 p-2 small text-muted mb-0" style="display:none;">
                    <i class="fas fa-info-circle text-primary me-1"></i>
                    Este tipo de producto (termo / accesorio) no requiere tallas, únicamente color.
                  </div>

                  <div id="sizesContainer" class="d-flex flex-wrap gap-2">
                    <!-- Se renderiza dinámicamente mediante JS -->
                  </div>
                </div>

                <!-- Descripción con Editor WYSIWYG Quill -->
                <div class="col-12">
                  <label class="form-label fw-bold small text-muted text-uppercase d-flex align-items-center gap-2">
                    <i class="fas fa-pen-nib text-success"></i>
                    Descripción / Características del Producto
                    <span class="badge bg-success-subtle text-success-emphasis fw-normal" style="font-size:.7rem;">Editor de texto enriquecido</span>
                  </label>

                  <!-- Editor visual -->
                  <div id="quill-editor-description" style="
                    min-height: 200px;
                    background: #fff;
                    border: 1px solid #dee2e6;
                    border-radius: 0 0 8px 8px;
                    font-size: 0.95rem;
                  "></div>

                  <!-- Campo oculto que se envía al servidor -->
                  <input type="hidden" name="description" id="description-hidden"
                         value="<?= htmlspecialchars($pDescription) ?>">

                  <p class="text-muted small mt-1 mb-0">
                    <i class="fas fa-info-circle me-1"></i>
                    Puedes usar negrita, cursiva, listas, colores, tamaños y más desde la barra de herramientas.
                  </p>
                </div>

                <!-- ===== MEDIA UPLOADER ===== -->
                <div class="col-12 mt-2">
                  <label class="form-label fw-bold small text-muted text-uppercase d-flex align-items-center gap-2">
                    <i class="fas fa-images text-success"></i>
                    Imágenes y Videos del Producto
                    <span class="badge bg-secondary fw-normal" id="mediaCount">0 archivos</span>
                  </label>

                  <div class="media-uploader" id="dropZone">

                    <!-- Botón de selección (trigger real del input) -->
                    <div class="upload-btn-area" id="uploadBtnArea">
                      <i class="fas fa-cloud-upload-alt"></i>
                      <strong>Arrastra archivos aquí</strong>
                      <span>JPG · PNG · WEBP · GIF · MP4 · WEBM · MOV &nbsp;|&nbsp; Máx. 20 MB</span>
                      <button type="button" class="upload-pick-btn" id="pickFilesBtn">
                        <i class="fas fa-folder-open"></i> Explorar archivos
                      </button>
                    </div>

                    <!-- Grid de miniaturas -->
                    <div class="media-grid" id="mediaGrid"></div>

                    <!-- Barra de progreso -->
                    <div class="upload-progress-bar" id="progressBar">
                      <div class="bar" id="progressBarInner"></div>
                    </div>
                  </div>

                  <p class="text-muted small mt-2 mb-0">
                    <i class="fas fa-info-circle me-1"></i>
                    La primera imagen será la imagen principal. Puedes reordenar arrastrando las miniaturas.
                  </p>
                </div>
                <!-- ===== FIN MEDIA UPLOADER ===== -->

                <!-- Flags -->
                <div class="col-12">
                  <div class="d-flex gap-4 mt-2">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" name="is_new"
                             id="isNewSwitch" <?= $pIsNew ? 'checked' : '' ?>>
                      <label class="form-check-label fw-semibold text-muted small text-uppercase" for="isNewSwitch">Marcar como Nuevo</label>
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" name="is_offer"
                             id="isOfferSwitch" <?= $pIsOffer ? 'checked' : '' ?>>
                      <label class="form-check-label fw-semibold text-muted small text-uppercase" for="isOfferSwitch">Marcar en Oferta</label>
                    </div>
                  </div>
                </div>

                <!-- Botón Guardar -->
                <div class="col-12 mt-4">
                  <button type="submit" id="submitBtn"
                          class="btn w-100 py-3 rounded-3 fw-bold text-uppercase"
                          style="background:#87CC3E;border:none;font-size:.95rem;color:#111;">
                    <i class="fas fa-save me-2"></i>
                    <?= $isEdit ? 'Guardar Cambios' : 'Registrar Producto' ?>
                  </button>
                </div>

              </div><!-- /row -->
            </form>
          </div><!-- /card-body -->
        </div>
      </div>
    </div>
  </div>
</div>

<script>
(function () {
    'use strict';

    /* ══════════════════════════════════════
       SISTEMA DE MODALES DE NOTIFICACIÓN
    ══════════════════════════════════════ */
    var notifOverlay = document.getElementById('notifOverlay');
    var notifIcon    = document.getElementById('notifIcon');
    var notifTitle   = document.getElementById('notifTitle');
    var notifMsg     = document.getElementById('notifMsg');

    window.showNotif = function (type, title, msg) {
        // type: 'success' | 'error' | 'warning' | 'info'
        var icons = {
            success: '✅',
            error:   '❌',
            warning: '⚠️',
            info:    'ℹ️'
        };
        notifIcon.textContent  = icons[type] || 'ℹ️';
        notifTitle.textContent = title;
        notifMsg.textContent   = msg;
        notifOverlay.style.display = 'flex';
    };

    window.closeNotif = function () {
        notifOverlay.style.display = 'none';
    };

    // Cerrar modal al hacer clic fuera del recuadro
    notifOverlay.addEventListener('click', function (e) {
        if (e.target === notifOverlay) closeNotif();
    });

    // Mostrar mensajes de sesión PHP al cargar la página
    <?php if ($sessionError): ?>
    window.addEventListener('DOMContentLoaded', function () {
        var rawError = '<?= addslashes($sessionError) ?>';
        if (rawError === 'No se puede agregar este producto') {
            showNotif('error', 'No se puede agregar este producto', 'Ya existe un producto registrado con esta información.');
        } else {
            showNotif('error', 'No se puede agregar este producto', rawError);
        }
    });
    <?php elseif ($sessionSuccess): ?>
    window.addEventListener('DOMContentLoaded', function () {
        showNotif('success', '¡Operación exitosa!', '<?= addslashes($sessionSuccess) ?>');
    });
    <?php endif; ?>


    /* ══════════════════════════════════════
       MEDIA UPLOADER
    ══════════════════════════════════════ */
    var mediaItems       = [];
    var dragSrcIdx       = null;

    var fileInput        = document.getElementById('fileInput');
    var dropZone         = document.getElementById('dropZone');
    var uploadBtnArea    = document.getElementById('uploadBtnArea');
    var pickFilesBtn     = document.getElementById('pickFilesBtn');
    var mediaGrid        = document.getElementById('mediaGrid');
    var progressBar      = document.getElementById('progressBar');
    var progressInner    = document.getElementById('progressBarInner');
    var mediaJsonInput   = document.getElementById('mediaJson');
    var mediaCount       = document.getElementById('mediaCount');
    var submitBtn        = document.getElementById('submitBtn');
    var productForm      = document.getElementById('productForm');

    /* ── Cargar medios existentes (modo edición) ── */
    var existing = <?= $existingMediaJson ?>;
    existing.forEach(function (m) {
        mediaItems.push({ url: m.url, type: m.type, name: m.url.split('/').pop() });
    });
    renderGrid();

    /* ── Botón "Explorar archivos" → abre el input ── */
    pickFilesBtn.addEventListener('click', function (e) {
        e.stopPropagation(); // No propagar al dropZone
        fileInput.click();
    });

    /* ── Clic en el área de texto (no en las miniaturas) → abre el input ── */
    uploadBtnArea.addEventListener('click', function (e) {
        if (e.target !== pickFilesBtn && !pickFilesBtn.contains(e.target)) {
            fileInput.click();
        }
    });

    /* ── Input change ── */
    fileInput.addEventListener('change', function () {
        if (fileInput.files.length) {
            handleFiles(Array.from(fileInput.files));
        }
        // Resetear para poder seleccionar el mismo archivo otra vez
        fileInput.value = '';
    });

    /* ── Drag & Drop sobre el dropZone ── */
    dropZone.addEventListener('dragover', function (e) {
        e.preventDefault();
        dropZone.classList.add('drag-over');
    });
    dropZone.addEventListener('dragleave', function (e) {
        // Solo quitar la clase si el cursor salió del dropZone real
        if (!dropZone.contains(e.relatedTarget)) {
            dropZone.classList.remove('drag-over');
        }
    });
    dropZone.addEventListener('drop', function (e) {
        e.preventDefault();
        dropZone.classList.remove('drag-over');
        var dt = e.dataTransfer;
        if (dt && dt.files.length) {
            handleFiles(Array.from(dt.files));
        }
    });

    /* ══════════════════════════════════════
       PROCESAR Y SUBIR ARCHIVOS
    ══════════════════════════════════════ */
    function handleFiles(files) {
        if (!files.length) return;
        uploadFiles(files);
    }

    function uploadFiles(files) {
        var formData = new FormData();
        files.forEach(function (f) { formData.append('files[]', f); });

        // Mostrar placeholders mientras sube
        var tempIds = [];
        files.forEach(function () {
            var tempId = 'temp_' + Date.now() + '_' + Math.random().toString(36).slice(2);
            tempIds.push(tempId);
            var card = document.createElement('div');
            card.className = 'media-card uploading';
            card.id = tempId;
            mediaGrid.appendChild(card);
        });
        updateCount();

        progressBar.style.display = 'block';
        progressInner.style.width = '15%';
        submitBtn.disabled = true;
        submitBtn.style.opacity = '.6';

        fetch('/admin/productos/upload-media', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(function (res) {
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return res.json();
        })
        .then(function (data) {
            progressInner.style.width = '100%';

            // Eliminar placeholders
            tempIds.forEach(function (id) {
                var c = document.getElementById(id);
                if (c) c.remove();
            });

            if (data.files && data.files.length) {
                data.files.forEach(function (f) {
                    mediaItems.push({ url: f.url, type: f.type, name: f.name });
                });
                renderGrid();
            }

            // Errores parciales (ej: archivo muy grande)
            if (data.errors && data.errors.length) {
                showNotif('warning', 'Algunos archivos no se pudieron subir',
                    'Verifica que los archivos sean del tipo permitido y no superen los 20 MB.');
            }

            setTimeout(function () {
                progressBar.style.display = 'none';
                progressInner.style.width = '0%';
            }, 700);
        })
        .catch(function () {
            // Eliminar placeholders
            tempIds.forEach(function (id) {
                var c = document.getElementById(id);
                if (c) c.remove();
            });
            updateCount();
            showNotif('error', 'Error al subir archivos',
                'No se pudo conectar con el servidor. Verifica tu conexión e intenta de nuevo.');
            progressBar.style.display = 'none';
        })
        .finally(function () {
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
        });
    }

    /* ══════════════════════════════════════
       RENDERIZAR GRID DE MINIATURAS
    ══════════════════════════════════════ */
    function renderGrid() {
        mediaGrid.innerHTML = '';
        mediaItems.forEach(function (item, idx) {
            var card = buildCard(item, idx);
            mediaGrid.appendChild(card);
            initDragOnCard(card, idx);
        });
        updateCount();
        syncJson();
    }

    function buildCard(item, idx) {
        var card = document.createElement('div');
        card.className = 'media-card';
        card.dataset.idx = idx;

        if (item.type === 'image') {
            var img = document.createElement('img');
            img.src = item.url.startsWith('http') ? item.url : '/' + item.url;
            img.alt = item.name || 'imagen';
            img.onerror = function () {
                img.src = '/assets/img/products/placeholder.png';
            };
            card.appendChild(img);

            var badge = document.createElement('span');
            badge.className = 'badge-type' + (idx === 0 ? ' main' : '');
            badge.textContent = idx === 0 ? '★ Principal' : 'Imagen';
            card.appendChild(badge);
        } else {
            var thumb = document.createElement('div');
            thumb.className = 'video-thumb';
            thumb.innerHTML = '<i class="fas fa-play-circle"></i><span>' + (item.name || 'video') + '</span>';
            card.appendChild(thumb);

            var badge = document.createElement('span');
            badge.className = 'badge-type video';
            badge.textContent = '▶ Video';
            card.appendChild(badge);
        }

        // Botón eliminar
        var btnRemove = document.createElement('button');
        btnRemove.type = 'button';
        btnRemove.className = 'btn-remove';
        btnRemove.title = 'Eliminar';
        btnRemove.innerHTML = '<i class="fas fa-times"></i>';
        (function (i) {
            btnRemove.addEventListener('click', function (e) {
                e.stopPropagation();
                e.preventDefault();
                mediaItems.splice(i, 1);
                renderGrid();
            });
        })(idx);
        card.appendChild(btnRemove);

        return card;
    }

    /* ══════════════════════════════════════
       DRAG-TO-REORDER ENTRE MINIATURAS
    ══════════════════════════════════════ */
    function initDragOnCard(card, idx) {
        card.setAttribute('draggable', 'true');

        card.addEventListener('dragstart', function (e) {
            dragSrcIdx = idx;
            card.classList.add('drag-src');
            e.dataTransfer.effectAllowed = 'move';
            e.stopPropagation(); // No activar el dropZone
        });
        card.addEventListener('dragend', function () {
            card.classList.remove('drag-src');
            document.querySelectorAll('.media-card').forEach(function (c) {
                c.classList.remove('drag-target');
            });
        });
        card.addEventListener('dragover', function (e) {
            e.preventDefault();
            e.stopPropagation();
            e.dataTransfer.dropEffect = 'move';
            card.classList.add('drag-target');
        });
        card.addEventListener('dragleave', function () {
            card.classList.remove('drag-target');
        });
        card.addEventListener('drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
            card.classList.remove('drag-target');
            var targetIdx = parseInt(card.dataset.idx);
            if (dragSrcIdx !== null && dragSrcIdx !== targetIdx) {
                var moved = mediaItems.splice(dragSrcIdx, 1)[0];
                mediaItems.splice(targetIdx, 0, moved);
                dragSrcIdx = null;
                renderGrid();
            }
        });
    }

    /* ══════════════════════════════════════
       UTILIDADES
    ══════════════════════════════════════ */
    function updateCount() {
        var n = mediaItems.length;
        // Contar temporales (placeholders uploading)
        var uploading = document.querySelectorAll('.media-card.uploading').length;
        var total = n + uploading;
        mediaCount.textContent = total + ' ' + (total === 1 ? 'archivo' : 'archivos');
    }

    function syncJson() {
        mediaJsonInput.value = JSON.stringify(
            mediaItems.map(function (m, i) {
                return { url: m.url, type: m.type, sort_order: i };
            })
        );
    }

    /* ══════════════════════════════════════
       MANEJO DINÁMICO DE TALLAS POR GÉNERO Y TIPO
    ══════════════════════════════════════ */
    var genderSelect = document.getElementById('genderSelect');
    var typeSelect   = document.getElementById('typeSelect');

    var sizeSets = {
        mujer:  ['XS', 'S', 'M', 'L', 'XL'],
        hombre: ['S', 'M', 'L', 'XL', 'XXL'],
        ninos:  ['4', '6', '8', '10', '12', '14', '16'],
        kids:   ['4', '6', '8', '10', '12', '14', '16'],
        unisex: ['XS', 'S', 'M', 'L', 'XL', 'XXL']
    };

    var serverSizes = <?= json_encode(array_values($selectedSizes)) ?>;
    var nonClothingTypes = ['botella_plegable', 'accesorios'];

    function updateSizesUI() {
        var gender = genderSelect ? genderSelect.value : 'mujer';
        var type   = typeSelect ? typeSelect.value : 'camisetas';
        var isClothing = !nonClothingTypes.includes(type);

        var sizesContainer = document.getElementById('sizesContainer');
        var noSizesNotice  = document.getElementById('noSizesNotice');
        var sizesBadge     = document.getElementById('sizesBadge');

        if (!sizesContainer) return;

        if (!isClothing) {
            sizesContainer.style.display = 'none';
            noSizesNotice.style.display = 'block';
            sizesBadge.textContent = 'Sin Talla';
            sizesBadge.className = 'badge bg-secondary ms-1';
            return;
        }

        sizesContainer.style.display = 'flex';
        noSizesNotice.style.display  = 'none';

        var audienceName = 'Mujeres';
        if (gender === 'hombre') audienceName = 'Hombres';
        else if (gender === 'ninos' || gender === 'kids') audienceName = 'Niños';
        else if (gender === 'unisex') audienceName = 'Unisex';

        sizesBadge.textContent = 'Ropa ' + audienceName;
        sizesBadge.className   = 'badge bg-success ms-1';

        var availableSizes = sizeSets[gender] || sizeSets['unisex'];

        var checkedValues = Array.from(document.querySelectorAll('input[name="sizes[]"]:checked')).map(function(cb){ return cb.value.toUpperCase(); });
        var activeSelected = Array.from(new Set(serverSizes.concat(checkedValues)));

        sizesContainer.innerHTML = '';
        availableSizes.forEach(function (size) {
            var isChecked = activeSelected.includes(size.toUpperCase());
            var div = document.createElement('div');
            div.innerHTML = `
                <input type="checkbox" name="sizes[]" value="${size}" id="size_${size}" class="chip-check" ${isChecked ? 'checked' : ''}>
                <label for="size_${size}" class="chip-label btn btn-sm btn-outline-dark fw-bold rounded-3 px-3 py-1 me-1">
                    ${size}
                </label>
            `;
            sizesContainer.appendChild(div);
        });
    }

    if (genderSelect) genderSelect.addEventListener('change', updateSizesUI);
    if (typeSelect) typeSelect.addEventListener('change', updateSizesUI);
    updateSizesUI();

    /* ══════════════════════════════════════
       SUBMIT CON VALIDACIÓN BOOTSTRAP
    ══════════════════════════════════════ */
    productForm.addEventListener('submit', function (e) {
        syncJson();
        if (!productForm.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            showNotif('warning', 'Datos incompletos',
                'Por favor completa todos los campos requeridos antes de continuar.');
        }
        productForm.classList.add('was-validated');
    });

})();
</script>

<!-- ══════════════════════════════════════════════════════
     QUILL.JS — Editor de texto enriquecido para descripción
     CDN gratuito, sin dependencias adicionales
══════════════════════════════════════════════════════ -->
<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.7/quill.snow.css">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

<style>
/* ── Quill: estilos del contenedor ── */
#quill-editor-description .ql-editor {
  min-height: 180px;
  font-size: 0.95rem;
  font-family: 'Inter', 'Segoe UI', sans-serif;
  line-height: 1.6;
  color: #212529;
}
.ql-toolbar.ql-snow {
  background: #f8f9fa;
  border: 1px solid #dee2e6;
  border-radius: 8px 8px 0 0;
  padding: 8px 10px;
  display: flex;
  flex-wrap: wrap;
  gap: 2px;
}
.ql-container.ql-snow {
  border: 1px solid #dee2e6;
  border-top: none;
  border-radius: 0 0 8px 8px;
}
/* Quill: resaltar cuando tiene foco */
#quill-editor-description:focus-within .ql-container {
  border-color: #86b7fe;
  box-shadow: 0 0 0 3px rgba(13,110,253,.15);
}
/* Quill: placeholder */
.ql-editor.ql-blank::before {
  color: #9ca3af;
  font-style: italic;
}
/* Quill: colores del toolbar */
.ql-snow .ql-picker-label { color: #495057; }
.ql-snow .ql-stroke { stroke: #495057; }
.ql-snow .ql-fill  { fill: #495057; }
.ql-snow button:hover .ql-stroke,
.ql-snow .ql-picker-label:hover .ql-stroke { stroke: #0d6efd; }
.ql-snow button:hover .ql-fill,
.ql-snow .ql-picker-label:hover .ql-fill { fill: #0d6efd; }
/* Dropdown tamaños/fuentes */
.ql-snow .ql-picker.ql-font .ql-picker-label,
.ql-snow .ql-picker.ql-size .ql-picker-label { width: 100px; }
</style>

<script>
(function () {
  // ── Registrar fuentes personalizadas ─────────────────────────
  var Font = Quill.import('formats/font');
  Font.whitelist = ['arial', 'georgia', 'verdana', 'courier', 'trebuchet', 'impact'];
  Quill.register(Font, true);

  // ── Registrar tamaños personalizados ─────────────────────────
  var Size = Quill.import('attributors/style/size');
  Size.whitelist = ['10px','12px','14px','16px','18px','20px','24px','28px','32px','36px','48px'];
  Quill.register(Size, true);

  // ── Inicializar Quill ─────────────────────────────────────────
  var quill = new Quill('#quill-editor-description', {
    theme: 'snow',
    placeholder: 'Escribe las características y descripción del producto...',
    modules: {
      toolbar: [
        // Fila 1: Fuente y tamaño
        [{ 'font': Font.whitelist }, { 'size': Size.whitelist }],
        // Fila 2: Formato de texto
        ['bold', 'italic', 'underline', 'strike'],
        // Fila 3: Color y fondo
        [{ 'color': [] }, { 'background': [] }],
        // Fila 4: Scripts
        [{ 'script': 'sub' }, { 'script': 'super' }],
        // Fila 5: Cabeceras
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        // Fila 6: Listas y sangría
        [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
        // Fila 7: Alineación y dirección
        [{ 'align': [] }, { 'direction': 'rtl' }],
        // Fila 8: Bloques especiales
        ['blockquote', 'code-block'],
        // Fila 9: Links y limpiar formato
        ['link', 'clean']
      ]
    }
  });

  // ── Cargar contenido existente ────────────────────────────────
  var hiddenInput = document.getElementById('description-hidden');
  var existingContent = hiddenInput ? hiddenInput.value.trim() : '';

  if (existingContent) {
    // Si el contenido parece HTML, cargarlo como HTML
    if (existingContent.startsWith('<') || existingContent.includes('<br') || existingContent.includes('<p')) {
      quill.root.innerHTML = existingContent;
    } else {
      // Si es texto plano, insertarlo
      quill.setText(existingContent);
    }
  }

  // ── Sincronizar el editor al campo oculto en tiempo real ──────
  quill.on('text-change', function () {
    if (hiddenInput) {
      var html = quill.root.innerHTML;
      // Si solo hay el párrafo vacío de Quill, limpiar
      hiddenInput.value = (html === '<p><br></p>') ? '' : html;
    }
  });

  // ── Sincronizar también antes del submit del formulario ───────
  var form = document.getElementById('productForm');
  if (form) {
    form.addEventListener('submit', function () {
      if (hiddenInput) {
        var html = quill.root.innerHTML;
        hiddenInput.value = (html === '<p><br></p>') ? '' : html;
      }
    }, true); // capture = true para ejecutar antes que la validación
  }

  // ── Mostrar tooltips de los botones del toolbar (opcional) ───
  var toolbarBtns = document.querySelectorAll('.ql-toolbar button, .ql-toolbar .ql-picker-label');
  var tooltips = {
    'ql-bold':        'Negrita (Ctrl+B)',
    'ql-italic':      'Cursiva (Ctrl+I)',
    'ql-underline':   'Subrayado (Ctrl+U)',
    'ql-strike':      'Tachado',
    'ql-color':       'Color de texto',
    'ql-background':  'Color de fondo',
    'ql-list':        'Lista',
    'ql-indent':      'Sangría',
    'ql-align':       'Alineación',
    'ql-link':        'Insertar enlace',
    'ql-clean':       'Limpiar formato',
    'ql-blockquote':  'Cita',
    'ql-code-block':  'Bloque de código',
  };
  toolbarBtns.forEach(function (el) {
    Object.keys(tooltips).forEach(function (cls) {
      if (el.classList.contains(cls)) {
        el.setAttribute('title', tooltips[cls]);
      }
    });
  });

})();
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
