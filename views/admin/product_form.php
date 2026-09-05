<?php
$isEdit = ($mode === 'edit');
$title  = ($isEdit ? "Editar Producto" : "Nuevo Producto") . " | FEMTRIBE";
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
$pSizeStock   = $product['size_stock'] ?? '';
$pDescription = $product['description'] ?? '';
$pIsNew          = isset($product['is_new'])  && $product['is_new']  == 1;
$pIsOffer        = isset($product['is_offer']) && $product['is_offer'] == 1;
$pIsUpcoming     = isset($product['is_upcoming']) && (int)$product['is_upcoming'] === 1;
$pIsFreeShipping = !isset($product['is_free_shipping']) || (int)$product['is_free_shipping'] === 1;
$pShippingCost   = isset($product['shipping_cost']) ? (float)$product['shipping_cost'] : 0.00;

// Procesar colores y tallas para pre-selección
$rawSelectedColors   = array_values(array_filter(array_map('trim', explode(',', (string)$pColors))));
$selectedColorsLower = array_map('strtolower', $rawSelectedColors);
$selectedSizes       = array_map('strtoupper', array_filter(array_map('trim', explode(',', (string)$pSizes))));

$pSizeStockData = [];
if (!empty($pSizeStock)) {
    $pSizeStockData = is_array($pSizeStock) ? $pSizeStock : (json_decode((string)$pSizeStock, true) ?: []);
}

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
                         placeholder="ej. Camiseta Oficial FEMTRIBE Blanca"
                         value="<?= htmlspecialchars($pName) ?>" required>
                </div>

                <!-- SKU -->
                <div class="col-12 col-md-4">
                  <label class="form-label fw-bold small text-muted text-uppercase">Código SKU</label>
                  <input type="text" name="sku" class="form-control bg-light py-2"
                         placeholder="ej. CO-005"
                         value="<?= htmlspecialchars($pSku) ?>" required>
                </div>

                <!-- Switch Destacado: Producto Próximo / Próximamente -->
                <div class="col-12">
                  <div class="p-3 rounded-4 border d-flex align-items-center justify-content-between flex-wrap gap-2" 
                       id="upcomingBanner"
                       style="<?= $pIsUpcoming ? 'background: #fffbeb; border-color: #f59e0b !important;' : 'background: #f8fafc; border-color: #e2e8f0 !important;' ?> transition: all .2s ease;">
                    <div class="d-flex align-items-center gap-3">
                      <div class="rounded-circle d-flex align-items-center justify-content-center <?= $pIsUpcoming ? 'bg-warning text-dark' : 'bg-light text-muted border' ?> shadow-sm" 
                           id="upcomingIconBox" style="width:42px; height:42px; min-width:42px;">
                        <i class="fas fa-clock fs-5"></i>
                      </div>
                      <div>
                        <label class="form-check-label fw-bold text-dark mb-0 cursor-pointer d-flex align-items-center gap-2" for="isUpcomingSwitch">
                          ¿Producto Próximo / Próximamente a la venta?
                          <span class="badge bg-warning text-dark border border-warning" id="upcomingActiveBadge" style="<?= $pIsUpcoming ? '' : 'display:none;' ?> font-size:0.7rem;">Activo</span>
                        </label>
                        <span class="text-muted small" id="upcomingHelperText">
                          <?= $pIsUpcoming ? 'Modo Próximamente activo: el producto se mostrará en catálogo con etiqueta "- Próximamente" sin requerir valor ni stock para venta inmediata.' : 'Marca este check para subir un producto que próximamente va a estar a la venta sin valor ni stock, para que los usuarios lo vean.' ?>
                        </span>
                      </div>
                    </div>
                    <div class="form-check form-switch fs-4 m-0">
                      <input class="form-check-input" type="checkbox" name="is_upcoming" id="isUpcomingSwitch" <?= $pIsUpcoming ? 'checked' : '' ?> style="cursor:pointer;">
                    </div>
                  </div>
                </div>

                <!-- Precio -->
                <div class="col-6 col-md-6" id="priceContainer">
                  <label class="form-label fw-bold small text-muted text-uppercase d-flex align-items-center justify-content-between">
                    <span>Precio ($ COP) <span class="text-danger required-asterisk" id="priceAsterisk" style="<?= $pIsUpcoming ? 'display:none;' : '' ?>">*</span></span>
                    <span class="badge bg-warning-subtle text-dark border border-warning" id="priceUpcomingBadge" style="<?= $pIsUpcoming ? '' : 'display:none;' ?> font-size:0.68rem;">Opcional (Próximo)</span>
                  </label>
                  <div class="input-group">
                    <span class="input-group-text bg-light">$</span>
                    <input type="number" name="price" id="productPrice" class="form-control bg-light py-2"
                           value="<?= (float)$pPrice ?>" step="1000" min="0" <?= $pIsUpcoming ? '' : 'required' ?>>
                  </div>
                  <small class="text-muted" id="priceHint" style="font-size: 0.78rem; <?= $pIsUpcoming ? '' : 'display:none;' ?>">No se mostrará precio al público mientras esté marcado como Próximamente.</small>
                </div>

                <!-- Stock -->
                <div class="col-6 col-md-6" id="stockContainer">
                  <label class="form-label fw-bold small text-muted text-uppercase d-flex align-items-center justify-content-between">
                    <span>Stock Disponible <span class="text-danger required-asterisk" id="stockAsterisk" style="<?= $pIsUpcoming ? 'display:none;' : '' ?>">*</span></span>
                    <span class="badge bg-warning-subtle text-dark border border-warning" id="stockUpcomingBadge" style="<?= $pIsUpcoming ? '' : 'display:none;' ?> font-size:0.68rem;">Opcional (Próximo)</span>
                  </label>
                  <input type="number" name="stock" id="productStock" class="form-control bg-light py-2"
                         value="<?= (int)$pStock ?>" min="0" <?= $pIsUpcoming ? '' : 'required' ?>>
                  <small class="text-muted" id="stockHint" style="font-size: 0.78rem; <?= $pIsUpcoming ? '' : 'display:none;' ?>">No se requiere stock para venta inmediata.</small>
                </div>

                <!-- Configuración de Envío -->
                <div class="col-12">
                  <div class="p-3 rounded-4 border" style="background: #f8fafc; border-color: #e2e8f0 !important;">
                    <label class="form-label fw-bold small text-muted text-uppercase mb-2 d-flex align-items-center gap-2">
                      <i class="fas fa-shipping-fast text-dark"></i> Modalidad de Envío
                    </label>
                    <div class="row g-3 align-items-center">
                      <div class="col-12 col-md-6">
                        <div class="d-flex gap-2">
                          <input type="radio" class="btn-check" name="is_free_shipping" id="shippingFree" value="1" <?= $pIsFreeShipping ? 'checked' : '' ?> onchange="toggleShippingCostInput(true)">
                          <label class="btn btn-outline-success flex-fill py-2 fw-semibold d-flex align-items-center justify-content-center gap-2" for="shippingFree" style="border-radius: 12px; font-size: 0.9rem;">
                            <i class="fas fa-check-circle"></i> Envío Gratis
                          </label>

                          <input type="radio" class="btn-check" name="is_free_shipping" id="shippingPaid" value="0" <?= !$pIsFreeShipping ? 'checked' : '' ?> onchange="toggleShippingCostInput(false)">
                          <label class="btn btn-outline-dark flex-fill py-2 fw-semibold d-flex align-items-center justify-content-center gap-2" for="shippingPaid" style="border-radius: 12px; font-size: 0.9rem;">
                            <i class="fas fa-tag"></i> Tiene Costo
                          </label>
                        </div>
                      </div>

                      <div class="col-12 col-md-6" id="shippingCostContainer" style="<?= $pIsFreeShipping ? 'display: none;' : '' ?>">
                        <div class="input-group">
                          <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                          <input type="number" name="shipping_cost" id="shippingCostInput" class="form-control py-2" 
                                 placeholder="Costo de envío (ej: 12000)" 
                                 value="<?= (float)$pShippingCost ?>" step="any" min="0">
                          <span class="input-group-text bg-white text-muted small">COP</span>
                        </div>
                        <small class="text-muted d-block mt-1" style="font-size: 0.78rem;">Valor del flete a cobrar en el checkout por este producto.</small>
                      </div>
                    </div>
                  </div>
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
                <div class="col-12">
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
                    $customColorsList = array_filter($rawSelectedColors, function($c) use ($presetColorKeys) {
                        return !in_array(strtolower($c), $presetColorKeys);
                    });
                    foreach ($colorOptions as $cName => $cHex): 
                        $cLower = strtolower($cName);
                        $isChecked = in_array($cLower, $selectedColorsLower);
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

                <!-- SECCIÓN: INVENTARIO Y CANTIDADES POR TALLA Y GÉNERO -->
                <div class="col-12" id="sizesSection">
                  <div class="p-3.5 rounded-4 border" style="background:#f8fafc; border-color:#e2e8f0 !important;">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                      <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-dark text-white shadow-xs" style="width:38px; height:38px; min-width:38px;">
                          <i class="fas fa-layer-group"></i>
                        </div>
                        <div>
                          <label class="form-label fw-bold text-dark mb-0 text-uppercase small d-flex align-items-center gap-1">
                            <i class="fas fa-ruler-horizontal text-warning me-1"></i> Cantidades de Stock por Talla y Género
                            <span class="badge bg-success ms-1" id="sizesBadge">Ropa</span>
                          </label>
                          <small class="text-muted d-block" style="font-size:0.78rem;">Ingresa la cantidad disponible por separado para cada talla en Hombre, Mujer y Niños.</small>
                        </div>
                      </div>
                      <div>
                        <span class="badge bg-white text-dark border px-3 py-2 fw-semibold shadow-xs rounded-pill" id="totalSizeStockCounter" style="font-size:0.85rem;">
                          <i class="fas fa-calculator text-success me-1"></i> Stock Total: <strong id="calculatedStockNumber" class="text-dark fs-6">0</strong> unidades
                        </span>
                      </div>
                    </div>

                    <div id="noSizesNotice" class="alert alert-light border rounded-3 p-3 small text-muted mb-0" style="display:none;">
                      <i class="fas fa-info-circle text-primary me-2"></i>
                      Este tipo de producto (termo / accesorio) no requiere desglose por tallas. Ingresa la cantidad directamente en el campo <strong>Stock Disponible</strong> arriba.
                    </div>

                    <div id="sizesStockContainer">
                      <!-- Pestañas de Género -->
                      <ul class="nav nav-pills gap-2 mb-3" id="genderSizesTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active rounded-pill px-3 py-1.5 fw-bold d-flex align-items-center gap-2 border" id="tab-mujer-btn" data-bs-toggle="pill" data-bs-target="#tab-mujer" type="button" role="tab">
                            <i class="fas fa-female text-danger"></i> Mujer
                            <span class="badge bg-dark-subtle text-dark rounded-pill px-2 py-0.5" id="badge-count-mujer">0</span>
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link rounded-pill px-3 py-1.5 fw-bold d-flex align-items-center gap-2 border" id="tab-hombre-btn" data-bs-toggle="pill" data-bs-target="#tab-hombre" type="button" role="tab">
                            <i class="fas fa-male text-primary"></i> Hombre
                            <span class="badge bg-dark-subtle text-dark rounded-pill px-2 py-0.5" id="badge-count-hombre">0</span>
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link rounded-pill px-3 py-1.5 fw-bold d-flex align-items-center gap-2 border" id="tab-kids-btn" data-bs-toggle="pill" data-bs-target="#tab-kids" type="button" role="tab">
                            <i class="fas fa-child text-warning"></i> Niños / Kids
                            <span class="badge bg-dark-subtle text-dark rounded-pill px-2 py-0.5" id="badge-count-kids">0</span>
                          </button>
                        </li>
                      </ul>

                      <!-- Paneles de Tallas -->
                      <div class="tab-content" id="genderSizesTabContent">
                        <!-- Mujer -->
                        <div class="tab-pane fade show active" id="tab-mujer" role="tabpanel">
                          <div class="row g-2" id="grid-sizes-mujer"></div>
                        </div>
                        <!-- Hombre -->
                        <div class="tab-pane fade" id="tab-hombre" role="tabpanel">
                          <div class="row g-2" id="grid-sizes-hombre"></div>
                        </div>
                        <!-- Kids -->
                        <div class="tab-pane fade" id="tab-kids" role="tabpanel">
                          <div class="row g-2" id="grid-sizes-kids"></div>
                        </div>
                      </div>
                    </div>

                    <!-- Contenedor dinámico de inputs ocultos sizes[] -->
                    <div id="hiddenSizesInputs" style="display:none;"></div>

                    <!-- Campo oculto serializado JSON size_stock -->
                    <input type="hidden" name="size_stock" id="sizeStockJsonInput" value="<?= htmlspecialchars(is_string($pSizeStock) ? $pSizeStock : json_encode($pSizeStockData ?: [])) ?>">
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
                  <div class="d-flex flex-wrap gap-4 mt-2">
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
       MANEJO DINÁMICO DE TALLAS Y CANTIDADES POR GÉNERO
    ══════════════════════════════════════ */
    var genderSelect = document.getElementById('genderSelect');
    var typeSelect   = document.getElementById('typeSelect');

    var sizeSets = {
        mujer:  ['XS', 'S', 'M', 'L', 'XL'],
        hombre: ['S', 'M', 'L', 'XL', 'XXL'],
        kids:   ['4', '6', '8', '10', '12', '14', '16']
    };

    var initialSizeStock = <?= json_encode(!empty($pSizeStockData) ? $pSizeStockData : (object)[]) ?>;
    var serverSizes      = <?= json_encode(array_values($selectedSizes)) ?>;
    var nonClothingTypes = ['botella_plegable', 'accesorios'];

    var gridMujer   = document.getElementById('grid-sizes-mujer');
    var gridHombre  = document.getElementById('grid-sizes-hombre');
    var gridKids    = document.getElementById('grid-sizes-kids');
    var sizeStockJsonInput = document.getElementById('sizeStockJsonInput');
    var hiddenSizesInputs  = document.getElementById('hiddenSizesInputs');
    var calculatedStockNumber = document.getElementById('calculatedStockNumber');
    var badgeCountMujer = document.getElementById('badge-count-mujer');
    var badgeCountHombre = document.getElementById('badge-count-hombre');
    var badgeCountKids = document.getElementById('badge-count-kids');
    var sizesBadge = document.getElementById('sizesBadge');
    var noSizesNotice = document.getElementById('noSizesNotice');
    var sizesStockContainer = document.getElementById('sizesStockContainer');

    function initSizeGrids() {
        renderGenderGrid('mujer', sizeSets.mujer, gridMujer);
        renderGenderGrid('hombre', sizeSets.hombre, gridHombre);
        renderGenderGrid('kids', sizeSets.kids, gridKids);
        recalcStock();
    }

    function renderGenderGrid(gKey, sizesArr, container) {
        if (!container) return;
        container.innerHTML = '';
        var currentGenderData = initialSizeStock[gKey] || {};

        sizesArr.forEach(function(s) {
            var qtyVal = '';
            if (currentGenderData[s] !== undefined && currentGenderData[s] !== null) {
                qtyVal = currentGenderData[s];
            }

            var col = document.createElement('div');
            col.className = 'col-6 col-sm-4 col-md-3 col-lg-2';
            col.innerHTML = `
                <div class="p-2.5 rounded-3 border bg-white text-center size-stock-card shadow-xs" style="transition: all .15s ease;">
                    <span class="badge bg-dark text-white rounded-pill px-2.5 py-1 mb-2 d-inline-block fw-bold" style="font-size: 0.82rem;">
                        Talla ${s}
                    </span>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light text-muted px-2" title="Cantidad disponible">
                            <i class="fas fa-boxes-stacked" style="font-size:0.75rem;"></i>
                        </span>
                        <input type="number" min="0" step="1" 
                               class="form-control text-center fw-bold size-qty-input" 
                               data-gender="${gKey}" data-size="${s}" 
                               value="${qtyVal !== '' ? qtyVal : ''}" 
                               placeholder="0"
                               style="font-size:0.95rem;">
                    </div>
                    <div class="small text-muted mt-1" style="font-size: 0.72rem;">unidades</div>
                </div>
            `;
            container.appendChild(col);
        });
    }

    function recalcStock() {
        var allInputs = document.querySelectorAll('.size-qty-input');
        var stockData = { mujer: {}, hombre: {}, kids: {} };
        var sumMujer = 0, sumHombre = 0, sumKids = 0;
        var activeSizes = [];

        allInputs.forEach(function(inp) {
            var g = inp.dataset.gender;
            var s = inp.dataset.size;
            var raw = inp.value.trim();
            if (raw !== '') {
                var val = parseInt(raw, 10);
                if (!isNaN(val) && val >= 0) {
                    stockData[g][s] = val;
                    if (g === 'mujer') sumMujer += val;
                    else if (g === 'hombre') sumHombre += val;
                    else if (g === 'kids') sumKids += val;

                    if (val > 0 && !activeSizes.includes(s)) {
                        activeSizes.push(s);
                    }
                }
            }
        });

        if (badgeCountMujer) badgeCountMujer.textContent = sumMujer;
        if (badgeCountHombre) badgeCountHombre.textContent = sumHombre;
        if (badgeCountKids) badgeCountKids.textContent = sumKids;

        var totalCalculated = sumMujer + sumHombre + sumKids;
        if (calculatedStockNumber) calculatedStockNumber.textContent = totalCalculated;

        var hasAnySizeInput = false;
        allInputs.forEach(function(i){ if(i.value.trim() !== '') hasAnySizeInput = true; });

        if (hasAnySizeInput && productStock) {
            productStock.value = totalCalculated;
        }

        var cleanStockToSave = {};
        ['mujer', 'hombre', 'kids'].forEach(function(g) {
            if (Object.keys(stockData[g]).length > 0) {
                cleanStockToSave[g] = stockData[g];
            }
        });
        if (sizeStockJsonInput) {
            sizeStockJsonInput.value = Object.keys(cleanStockToSave).length > 0 ? JSON.stringify(cleanStockToSave) : '';
        }

        if (hiddenSizesInputs) {
            hiddenSizesInputs.innerHTML = '';
            activeSizes.forEach(function(s) {
                var h = document.createElement('input');
                h.type = 'hidden';
                h.name = 'sizes[]';
                h.value = s;
                hiddenSizesInputs.appendChild(h);
            });
        }
    }

    document.addEventListener('input', function(e) {
        if (e.target && e.target.classList.contains('size-qty-input')) {
            recalcStock();
        }
    });

    document.querySelectorAll('#genderSizesTabs button').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('#genderSizesTabs button').forEach(function(b) { b.classList.remove('active'); });
            document.querySelectorAll('#genderSizesTabContent .tab-pane').forEach(function(p) { p.classList.remove('show', 'active'); });
            this.classList.add('active');
            var targetId = this.getAttribute('data-bs-target');
            var targetPane = document.querySelector(targetId);
            if (targetPane) {
                targetPane.classList.add('show', 'active');
            }
        });
    });

    function updateTypeAndGenderView() {
        var gender = genderSelect ? genderSelect.value : 'mujer';
        var type   = typeSelect ? typeSelect.value : 'camisetas';
        var isClothing = !nonClothingTypes.includes(type);

        if (!isClothing) {
            if (sizesStockContainer) sizesStockContainer.style.display = 'none';
            if (noSizesNotice) noSizesNotice.style.display = 'block';
            if (sizesBadge) {
                sizesBadge.textContent = 'Sin Talla';
                sizesBadge.className = 'badge bg-secondary ms-1';
            }
        } else {
            if (sizesStockContainer) sizesStockContainer.style.display = 'block';
            if (noSizesNotice) noSizesNotice.style.display = 'none';
            if (sizesBadge) {
                sizesBadge.textContent = 'Ropa';
                sizesBadge.className = 'badge bg-success ms-1';
            }

            if (gender === 'hombre') {
                var hBtn = document.getElementById('tab-hombre-btn');
                if (hBtn) hBtn.click();
            } else if (gender === 'ninos' || gender === 'kids') {
                var kBtn = document.getElementById('tab-kids-btn');
                if (kBtn) kBtn.click();
            } else if (gender === 'mujer') {
                var mBtn = document.getElementById('tab-mujer-btn');
                if (mBtn) mBtn.click();
            }
        }
    }

    if (genderSelect) genderSelect.addEventListener('change', updateTypeAndGenderView);
    if (typeSelect) typeSelect.addEventListener('change', updateTypeAndGenderView);

    initSizeGrids();
    updateTypeAndGenderView();

    /* ══════════════════════════════════════
       TOGGLE PRODUCTO PRÓXIMO / PRÓXIMAMENTE
    ══════════════════════════════════════ */
    const isUpcomingSwitch   = document.getElementById('isUpcomingSwitch');
    const productPrice       = document.getElementById('productPrice');
    const productStock       = document.getElementById('productStock');
    const priceAsterisk      = document.getElementById('priceAsterisk');
    const stockAsterisk      = document.getElementById('stockAsterisk');
    const priceUpcomingBadge = document.getElementById('priceUpcomingBadge');
    const stockUpcomingBadge = document.getElementById('stockUpcomingBadge');
    const priceHint          = document.getElementById('priceHint');
    const stockHint          = document.getElementById('stockHint');
    const upcomingHelperText = document.getElementById('upcomingHelperText');
    const upcomingBanner     = document.getElementById('upcomingBanner');
    const upcomingIconBox    = document.getElementById('upcomingIconBox');
    const upcomingActiveBadge = document.getElementById('upcomingActiveBadge');

    function updateUpcomingState() {
        if (!isUpcomingSwitch) return;
        const isUpcoming = isUpcomingSwitch.checked;
        if (isUpcoming) {
            if (productPrice) productPrice.removeAttribute('required');
            if (productStock) productStock.removeAttribute('required');
            if (priceAsterisk) priceAsterisk.style.display = 'none';
            if (stockAsterisk) stockAsterisk.style.display = 'none';
            if (priceUpcomingBadge) priceUpcomingBadge.style.display = 'inline-block';
            if (stockUpcomingBadge) stockUpcomingBadge.style.display = 'inline-block';
            if (priceHint) priceHint.style.display = 'block';
            if (stockHint) stockHint.style.display = 'block';
            if (upcomingActiveBadge) upcomingActiveBadge.style.display = 'inline-block';
            if (upcomingBanner) {
                upcomingBanner.style.background = '#fffbeb';
                upcomingBanner.style.borderColor = '#f59e0b';
            }
            if (upcomingIconBox) {
                upcomingIconBox.className = 'rounded-circle d-flex align-items-center justify-content-center bg-warning text-dark shadow-sm';
            }
            if (upcomingHelperText) {
                upcomingHelperText.textContent = 'Modo Próximamente activo: el producto se mostrará en catálogo con etiqueta "- Próximamente" sin requerir valor ni stock para venta inmediata.';
            }
        } else {
            if (productPrice) productPrice.setAttribute('required', 'required');
            if (productStock) productStock.setAttribute('required', 'required');
            if (priceAsterisk) priceAsterisk.style.display = 'inline';
            if (stockAsterisk) stockAsterisk.style.display = 'inline';
            if (priceUpcomingBadge) priceUpcomingBadge.style.display = 'none';
            if (stockUpcomingBadge) stockUpcomingBadge.style.display = 'none';
            if (priceHint) priceHint.style.display = 'none';
            if (stockHint) stockHint.style.display = 'none';
            if (upcomingActiveBadge) upcomingActiveBadge.style.display = 'none';
            if (upcomingBanner) {
                upcomingBanner.style.background = '#f8fafc';
                upcomingBanner.style.borderColor = '#e2e8f0';
            }
            if (upcomingIconBox) {
                upcomingIconBox.className = 'rounded-circle d-flex align-items-center justify-content-center bg-light text-muted border shadow-sm';
            }
            if (upcomingHelperText) {
                upcomingHelperText.textContent = 'Marca este check para subir un producto que próximamente va a estar a la venta sin valor ni stock, para que los usuarios lo vean.';
            }
        }
    }

    if (isUpcomingSwitch) {
        isUpcomingSwitch.addEventListener('change', updateUpcomingState);
        updateUpcomingState();
    }

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

function toggleShippingCostInput(isFree) {
  const container = document.getElementById('shippingCostContainer');
  const input = document.getElementById('shippingCostInput');
  if (container) {
    if (isFree) {
      container.style.display = 'none';
      if (input) input.value = '0';
    } else {
      container.style.display = 'block';
      if (input && (!input.value || parseFloat(input.value) === 0)) {
        input.value = '12000';
      }
      if (input) input.focus();
    }
  }
}
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
