<?php require_once __DIR__ . '/layouts/header.php'; ?>
<link rel="stylesheet" href="/assets/css/products.css">
<!-- Quill Snow CSS para renderizar HTML del editor de características -->
<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.7/quill.snow.css">
<style>
/* Reset de estilos del toolbar de Quill (no se usa en frontend, solo el contenido) */
.quill-content.ql-editor { padding: 0 !important; }
.quill-content.ql-editor p { margin-bottom: 0.6rem; }
.quill-content.ql-editor ul,
.quill-content.ql-editor ol { margin: 0 0 0.8rem 1.4rem; }
.quill-content.ql-editor h1 { font-size: 1.5rem; }
.quill-content.ql-editor h2 { font-size: 1.3rem; }
.quill-content.ql-editor h3 { font-size: 1.15rem; }
.quill-content.ql-editor strong { font-weight: 700; }
.quill-content.ql-editor blockquote {
  border-left: 3px solid #87CC3E;
  padding-left: 12px;
  color: #666;
  font-style: italic;
  margin: 8px 0;
}
</style>

<section class="py-4" style="margin-top: 100px;">
  <div class="container">
    <?php
      // Variables básicas
      $name = htmlspecialchars($p['name'] ?? 'Producto');
      $price = isset($p['price']) ? (float)$p['price'] : 0;
      $desc = isset($p['description']) ? trim((string)$p['description']) : '';
      $slug = isset($p['slug']) ? (string)$p['slug'] : '';
      $imgRel = isset($p['image']) ? trim((string)$p['image']) : '';
      $category = isset($p['category']) ? strtolower(trim((string)$p['category'])) : '';
      $type = isset($p['type']) ? strtolower(trim((string)$p['type'])) : '';
      $slugNorm = strtolower(trim((string)$slug));
      $isFreeShipping = !isset($p['is_free_shipping']) || (int)$p['is_free_shipping'] === 1;
      $shippingCost   = isset($p['shipping_cost']) ? (float)$p['shipping_cost'] : 0.00;
      $isUpcoming     = !empty($p['is_upcoming']);
      // Detectar accesorio temprano para usar en construcción de slides
      $isAccessory = ($category === 'accesorios')
        || str_contains($slugNorm, 'termo')
        || str_contains($slugNorm, 'flask')
        || str_contains($slugNorm, 'botella');
      // Solo textil: camisetas y esqueletos
      $isTextilType = in_array($type, ['camisetas', 'esqueletos'], true);

      $slides = [];
      $addedUrls = [];

      $addSlide = function($src, $label, $type = 'image') use (&$slides, &$addedUrls) {
        $clean = ltrim(trim((string)$src), '/');
        if ($clean === '' || isset($addedUrls[$clean])) {
          return;
        }
        $addedUrls[$clean] = true;
        $slides[] = ['src' => $clean, 'label' => $label, 'type' => $type];
      };

      // Si no viene $media pero tenemos el ID del producto, cargarlo desde product_media
      if (empty($media) && !empty($p['id'])) {
        try {
          $mediaModel = new \App\Models\ProductMedia();
          $media = $mediaModel->getByProductId((int)$p['id']);
        } catch (\Throwable $t) {}
      }

      // 1. Cargar medios desde product_media (ordenados por sort_order)
      if (!empty($media) && is_array($media)) {
        $imgCount = 1;
        $vidCount = 1;
        foreach ($media as $item) {
          $isVid = (($item['type'] ?? '') === 'video');
          if ($isVid) {
            $addSlide($item['url'] ?? '', 'Video ' . $vidCount++, 'video');
          } else {
            $label = ($imgCount === 1) ? 'Principal' : ('Detalle ' . $imgCount);
            $addSlide($item['url'] ?? '', $label, 'image');
            $imgCount++;
          }
        }
      }

      // 2. Imagen principal del producto (solo si no fue agregada previamente)
      if (!empty($p['image'])) {
        $addSlide($p['image'], 'Principal', 'image');
      }

      // 3. Medios heredados en p['images'] (evitando duplicados)
      if (!empty($p['images'])) {
        $extraImages = explode(',', (string)$p['images']);
        foreach ($extraImages as $idx => $img) {
          $addSlide(trim($img), 'Detalle ' . ($idx + 1), 'image');
        }
      }

      // 4. Videos heredados en p['video']
      if (!empty($p['video'])) {
        $videos = explode(',', (string)$p['video']);
        $videos = array_slice($videos, 0, 2);
        foreach ($videos as $idx => $vid) {
          $addSlide(trim($vid), 'Video ' . ($idx + 1), 'video');
        }
      }

      // 5. Fallback si no hay slides
      if (empty($slides)) {
        $slides[] = ['src' => 'assets/img/products/placeholder.png', 'label' => 'Placeholder', 'type' => 'image'];
      }
    ?>

    <div class="breadcrumb small mb-3"><a href="/">Inicio</a> / <a href="/productos">Productos</a> / <?php echo $name; ?></div>

    <div class="row g-4">
      <div class="col-12 col-md-6">
        <div class="detail-gallery" style="position: -webkit-sticky; position: sticky; top: 120px; z-index: 10;">
          <?php if (!empty($slides)) : ?>
            <div class="detail-main mb-3">
              <button class="nav-btn prev" aria-label="Imagen anterior">‹</button>
              
              <img id="product-main-image"
                   src="/<?php echo htmlspecialchars(ltrim($slides[0]['src'], '/')); ?>"
                   <?php if (!empty($slides[0]['srcset'])): ?>srcset="<?php echo htmlspecialchars($slides[0]['srcset']); ?>" sizes="<?php echo htmlspecialchars($slides[0]['sizes']); ?>"<?php endif; ?>
                   alt="<?php echo $name . ' ' . htmlspecialchars($slides[0]['label']); ?>"
                   class="img-fluid <?php echo ($slides[0]['type'] ?? 'image') === 'video' ? 'd-none' : ''; ?>" />

              <video id="product-main-video" 
                     src="/<?php echo htmlspecialchars(ltrim($slides[0]['src'], '/')); ?>" 
                     controls 
                     autoplay 
                     muted 
                     loop 
                     class="img-fluid <?php echo ($slides[0]['type'] ?? 'image') !== 'video' ? 'd-none' : ''; ?>" 
                     style="max-height: 500px; width: 100%; object-fit: contain;"></video>
                     
              <button class="nav-btn next" aria-label="Imagen siguiente">›</button>
            </div>
            <div class="detail-thumbs">
              <?php foreach ($slides as $i => $s): ?>
                <button class="detail-thumb <?php echo $i === 0 ? 'active' : ''; ?>" data-index="<?php echo (int)$i; ?>" aria-label="Ver <?php echo htmlspecialchars($s['label']); ?>">
                  <?php if (($s['type'] ?? 'image') === 'video'): ?>
                    <div class="d-flex align-items-center justify-content-center bg-dark text-white rounded" style="width: 64px; height: 64px; font-size: 1.25rem;">
                      <i class="fas fa-play-circle text-danger"></i>
                    </div>
                  <?php else: ?>
                    <img src="/<?php echo htmlspecialchars(ltrim($s['src'], '/')); ?>"
                         <?php if (!empty($s['srcset'])): ?>srcset="<?php echo htmlspecialchars($s['srcset']); ?>" sizes="64px"<?php endif; ?>
                         alt="<?php echo $name . ' ' . htmlspecialchars($s['label']); ?>" />
                  <?php endif; ?>
                </button>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="alert alert-info" role="alert">
              <strong>Guía de tallas y ficha técnica:</strong> Consulta las últimas imágenes antes de comprar.
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-12 col-md-6">
        <h1 class="h3 mb-2">
          <?php echo $name; ?>
          <?php if ($isUpcoming): ?>
            <span class="badge bg-warning text-dark align-middle ms-2 fs-6 shadow-sm border border-warning" style="background-color: #ffc107 !important;">
              <i class="fas fa-clock me-1"></i>- Próximamente
            </span>
          <?php endif; ?>
        </h1>
        <?php if (strtolower((string)$slug) === 'camiseta_oficial_carrera'): ?>
          <div class="mb-2"><span class="badge" style="background:#FFE08A; color:#3A3A3A; font-weight:700; border-radius:999px; padding:6px 10px;">Edición especial limitada</span></div>
        <?php endif; ?>
        <div class="mb-3 d-flex align-items-center gap-2 flex-wrap">
          <?php if ($isUpcoming): ?>
            <span class="badge bg-warning text-dark px-3 py-2 fw-bold fs-6 rounded-pill border border-warning shadow-sm" style="background-color: #ffc107 !important;">
              <i class="fas fa-bullhorn me-1 text-dark"></i> Producto en Próximo Lanzamiento
            </span>
            <span class="badge bg-light text-muted border rounded-pill px-3 py-1.5" style="font-size: 0.82rem;">
              <i class="fas fa-eye me-1"></i> Exhibición previa (Sin venta inmediata)
            </span>
          <?php else: ?>
            <span class="h4 fw-bold text-dark mb-0">$<?php echo number_format($price, 0, ',', '.'); ?></span>
            <?php if ($isFreeShipping || $shippingCost <= 0): ?>
              <span class="badge d-inline-flex align-items-center gap-1 px-3 py-1.5 rounded-pill shadow-sm" style="background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; font-size: 0.82rem;">
                <i class="fas fa-truck text-success"></i> Envío Gratis
              </span>
            <?php else: ?>
              <span class="badge bg-light text-dark border rounded-pill px-3 py-1.5 shadow-sm" style="font-size: 0.82rem;">
                <i class="fas fa-truck text-muted me-1"></i> Envío: $<?php echo number_format($shippingCost, 0, ',', '.'); ?> COP
              </span>
            <?php endif; ?>
          <?php endif; ?>
        </div>
        <?php
          // Detectar accesorio para cambiar formato de descripción y opciones
          $slugNorm = strtolower(trim((string)$slug));
          $isAccessory = ($category === 'accesorios')
            || str_contains($slugNorm, 'termo')
            || str_contains($slugNorm, 'flask')
            || str_contains($slugNorm, 'botella');
        ?>
        <?php if ($desc !== ''): ?>
          <?php
            // Formateo inteligente universal: párrafos + listas cuando la línea inicia con '-' o '•'
            $raw = preg_replace('/\r\n?/','\n',$desc);
            $lines = preg_split('/\n/mu', $raw);
            if ($lines === false) { $lines = preg_split('/\n/m', $raw); }
            $lines = array_values(array_filter(array_map(function($i){ return trim($i); }, (array)$lines)));
            $blocks = [];
            foreach ($lines as $line) {
              // Encabezados tipo "Características:" o "Cuidados:" sin viñeta
              if (preg_match('/^\s*(Características|Cuidados):\s*$/iu', $line, $m)) {
                $blocks[] = ['type' => 'h', 'text' => $m[1]];
                continue;
              }
              // Ítems de lista: comienzan con '-' o '•'
              if (preg_match('/^\s*(?:-|•)\s*(.+)$/u', $line, $m)) {
                $blocks[] = ['type' => 'li', 'text' => $m[1]];
                continue;
              }
              // Resto: párrafos normales
              $blocks[] = ['type' => 'p', 'text' => $line];
            }
          ?>
          <div class="product-description mb-4" style="line-height: 1.7;">
            <?php
              // Detectar si es HTML de Quill (contiene etiquetas HTML)
              $isHtml = preg_match('/<(p|ul|ol|li|strong|em|h[1-6]|span|br)[^>]*>/i', $desc);

              if ($isHtml):
                // Renderizar HTML de Quill directamente — ya fue sanitizado al guardar
                // Aplicar clases de Bootstrap para estilos consistentes
                $htmlDesc = $desc;
                // Asegurar que los estilos de Quill se vean bien en el frontend
            ?>
            <div class="quill-content ql-editor" style="padding:0; font-size:0.95rem; font-family:inherit;">
              <?= $htmlDesc ?>
            </div>
            <?php else: ?>
            <?php
              // Modo legado: texto plano — parsear líneas
              $raw = preg_replace('/\r\n?/','\\n',$desc);
              $lines = preg_split('/\n/mu', $raw);
              if ($lines === false) { $lines = preg_split('/\n/m', $raw); }
              $lines = array_values(array_filter(array_map(function($i){ return trim($i); }, (array)$lines)));
              $blocks = [];
              foreach ($lines as $line) {
                if (preg_match('/^\s*(Características|Cuidados):\s*$/iu', $line, $m)) {
                  $blocks[] = ['type' => 'h', 'text' => $m[1]];
                  continue;
                }
                if (preg_match('/^\s*(?:-|•)\s*(.+)$/u', $line, $m)) {
                  $blocks[] = ['type' => 'li', 'text' => $m[1]];
                  continue;
                }
                $blocks[] = ['type' => 'p', 'text' => $line];
              }
            ?>
            <?php $openList = false; foreach ($blocks as $b): ?>
              <?php if ($b['type'] === 'li'): ?>
                <?php if (!$openList): $openList = true; ?><ul style="margin: 0 0 0.8rem 1.2rem; line-height: 1.7;"><?php endif; ?>
                <li><?php echo htmlspecialchars($b['text']); ?></li>
              <?php else: ?>
                <?php if ($openList): $openList = false; ?></ul><?php endif; ?>
                <?php if ($b['type'] === 'h'): ?>
                  <p class="fw-semibold" style="margin-bottom: 0.6rem;"><?php echo htmlspecialchars($b['text']); ?>:</p>
                <?php else: ?>
                  <p style="margin-bottom: 0.8rem; text-align: justify;"><?php echo htmlspecialchars($b['text']); ?></p>
                <?php endif; ?>
              <?php endif; ?>
            <?php endforeach; if ($openList): ?></ul><?php endif; ?>
            <?php endif; ?>
          </div>


          <?php if (!empty($isTextilTypeLocal)): ?>
            <div class="mb-4" style="line-height: 1.7;">
              <p class="fw-semibold" style="margin-bottom: 0.6rem;">Características:</p>
              <ul style="margin: 0 0 0.8rem 1.2rem;">
                <?php foreach ($features as $f): ?>
                  <li><?php echo htmlspecialchars($f); ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
        <?php endif; ?>

        <?php
          $genderRaw = isset($p['gender']) ? strtolower(trim((string)$p['gender'])) : '';
          $defaultGender = ($genderRaw === 'mujer') ? 'mujer' : 'hombre';
        ?>
        <?php
          // Procesar colores configurados en el producto (desde BD)
          $colorHexMap = [
              'negro' => '#1e293b',
              'blanco' => '#ffffff',
              'verde' => '#87CC3E',
              'rosa' => '#ec4899',
              'rosado' => '#ec4899',
              'azul' => '#3b82f6',
              'rojo' => '#ef4444',
              'gris' => '#64748b',
              'amarillo' => '#eab308',
              'morado' => '#a855f7',
              'verde fluor' => '#ccff00',
              'verde neón' => '#39ff14',
              'verde neon' => '#39ff14',
              'naranja' => '#f97316',
              'fucsia' => '#d946ef',
              'cyan' => '#06b6d4',
              'turquesa' => '#14b8a6',
              'beige' => '#f5f5dc',
              'marron' => '#78350f',
              'marrón' => '#78350f',
              'cafe' => '#78350f',
              'café' => '#78350f'
          ];

          $productColorsRaw = isset($p['colors']) ? trim((string)$p['colors']) : '';
          $availableColors = [];
          if ($productColorsRaw !== '') {
              $availableColors = array_values(array_filter(array_map('trim', explode(',', $productColorsRaw))));
          }

          if (empty($availableColors)) {
              if ($slugNorm === 'camiseta_oficial_carrera' || str_contains($slugNorm, 'carrera')) {
                  $availableColors = ['Blanco'];
              } elseif ($slugNorm === 'esqueleto_limite_run_2025_femtribe' || str_contains($slugNorm, 'esqueleto')) {
                  $availableColors = ['Verde'];
              } else {
                  $availableColors = ['Negro'];
              }
          }

          $initialColor = $availableColors[0];
          $productStock = isset($p['stock']) ? (int)$p['stock'] : 0;
          $isOutOfStock = ($productStock <= 0);
          $isLowStock = (!$isOutOfStock && $productStock < 10);
        ?>
        <?php if ($isUpcoming): ?>
          <div class="card card-body border-warning rounded-4 p-4 shadow-sm" style="background: #fffbeb;">
            <div class="d-flex align-items-center gap-3">
              <div class="rounded-circle d-flex align-items-center justify-content-center bg-warning text-dark shadow-sm" style="width: 50px; height: 50px; min-width: 50px;">
                <i class="fas fa-clock fs-4"></i>
              </div>
              <div>
                <h5 class="fw-bold mb-1 text-dark">¡Próximamente a la venta!</h5>
                <p class="mb-0 text-muted small" style="line-height: 1.5;">
                  Este producto estará disponible para la compra muy pronto. Actualmente se encuentra en exhibición para que puedas conocer sus características, diseño y detalles.
                </p>
              </div>
            </div>
            <hr class="my-3" style="border-color: #fde68a;">
            <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
              <span class="text-muted small"><i class="fas fa-bell me-1 text-warning"></i>Mantente atenta a nuestros canales oficiales para el lanzamiento.</span>
              <a href="/productos" class="btn btn-sm btn-dark rounded-pill px-3 py-2 fw-semibold">
                <i class="fas fa-arrow-left me-1"></i>Ver otros productos
              </a>
            </div>
          </div>
        <?php else: ?>
        <div class="product-options card card-body" style="border-radius:12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h6 mb-0">Selecciona tus opciones</h2>
            <?php if ($isOutOfStock): ?>
              <span class="badge bg-danger rounded-pill px-3 py-1">Agotado</span>
            <?php elseif ($isLowStock): ?>
              <span class="badge bg-warning text-dark border border-warning rounded-pill px-3 py-1 fw-bold shadow-sm" style="font-size: 0.8rem; background-color: #ffc107 !important;">
                <i class="fas fa-fire me-1 text-danger"></i>¡Últimos productos! (<?= $productStock ?> disponibles)
              </span>
            <?php else: ?>
              <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle rounded-pill px-3 py-1" style="font-size: 0.78rem;">
                <i class="fas fa-check-circle me-1"></i><?= $productStock ?> disponibles
              </span>
            <?php endif; ?>
          </div>

          <!-- Selección de Color -->
          <div class="mb-3">
            <label class="form-label d-flex justify-content-between align-items-center mb-2">
              <span class="fw-semibold">Color: <strong id="selectedColorLabel" class="text-dark"><?= htmlspecialchars($initialColor) ?></strong></span>
            </label>
            <div class="d-flex align-items-center gap-2 flex-wrap" id="colorPickerGroup">
              <?php foreach ($availableColors as $idx => $cName): 
                $cLower = strtolower(trim($cName));
                $cHex = $colorHexMap[$cLower] ?? '#475569';
                $isLight = in_array($cLower, ['blanco', 'white', '#fff', '#ffffff', 'beige']);
                $isActive = ($idx === 0);
              ?>
                <button type="button" 
                        class="btn btn-sm <?= $isActive ? 'btn-dark' : 'btn-outline-secondary' ?> rounded-pill px-3 py-1.5 d-inline-flex align-items-center gap-2 color-choice-chip <?= $isActive ? 'active' : '' ?>"
                        data-color="<?= htmlspecialchars($cName) ?>"
                        style="transition: all .15s ease; <?= $isActive ? 'box-shadow:0 2px 6px rgba(0,0,0,.2);' : '' ?>">
                  <span class="color-swatch-circle" style="width:13px;height:13px;border-radius:50%;background:<?= htmlspecialchars($cHex) ?>;border:1px solid <?= $isLight ? '#cbd5e1' : 'rgba(0,0,0,.25)' ?>;display:inline-block;"></span>
                  <span class="color-text fw-semibold" style="font-size:0.85rem;"><?= htmlspecialchars($cName) ?></span>
                </button>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="qty" class="form-label">Cantidad</label>
            <div class="qty-control">
              <button type="button" class="qty-btn minus" aria-label="Menos" <?= $isOutOfStock ? 'disabled' : '' ?>>−</button>
              <input id="qty" type="number" class="form-control qty-input" value="1" min="1" max="<?= max(1, min(20, $productStock)) ?>" <?= $isOutOfStock ? 'disabled' : '' ?>>
              <button type="button" class="qty-btn plus" aria-label="Más" <?= $isOutOfStock ? 'disabled' : '' ?>>+</button>
            </div>
          </div>

          <?php if (!$isAccessory): ?>
            <div class="mb-3">
              <label class="form-label d-block">Género</label>
              <div class="btn-group" role="group" aria-label="Seleccionar género" id="genderGroup">
                <input type="radio" class="btn-check" name="gender" id="genderKids" autocomplete="off" value="kids">
                <label class="btn btn-outline-dark" for="genderKids">Kids</label>

                <input type="radio" class="btn-check" name="gender" id="genderMen" autocomplete="off" value="hombre" <?php echo $defaultGender==='hombre'?'checked':''; ?> >
                <label class="btn btn-outline-dark" for="genderMen">Hombre</label>

                <input type="radio" class="btn-check" name="gender" id="genderWomen" autocomplete="off" value="mujer" <?php echo $defaultGender==='mujer'?'checked':''; ?> >
                <label class="btn btn-outline-dark" for="genderWomen">Mujer</label>
              </div>
            </div>

            <div class="mb-2">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <label class="form-label mb-0 fw-semibold">Talla</label>
                <div id="sizeStockBadge"></div>
              </div>
              <div id="sizesKids" class="size-grid d-none" aria-label="Tallas Kids">
                <button type="button" class="size-chip" data-size="4">4</button>
                <button type="button" class="size-chip" data-size="6">6</button>
                <button type="button" class="size-chip" data-size="8">8</button>
                <button type="button" class="size-chip" data-size="10">10</button>
                <button type="button" class="size-chip" data-size="12">12</button>
                <button type="button" class="size-chip" data-size="14">14</button>
                <button type="button" class="size-chip" data-size="16">16</button>
              </div>
              <div id="sizesMen" class="size-grid <?php echo $defaultGender==='hombre'? '': 'd-none'; ?>" aria-label="Tallas Hombre">
                <button type="button" class="size-chip" data-size="XS">XS</button>
                <button type="button" class="size-chip" data-size="S">S</button>
                <button type="button" class="size-chip" data-size="M">M</button>
                <button type="button" class="size-chip" data-size="L">L</button>
                <button type="button" class="size-chip" data-size="XL">XL</button>
                <button type="button" class="size-chip" data-size="XXL">XXL</button>
              </div>
              <div id="sizesWomen" class="size-grid <?php echo $defaultGender==='mujer'? '': 'd-none'; ?>" aria-label="Tallas Mujer">
                <button type="button" class="size-chip" data-size="XS">XS</button>
                <button type="button" class="size-chip" data-size="S">S</button>
                <button type="button" class="size-chip" data-size="M">M</button>
                <button type="button" class="size-chip" data-size="L">L</button>
                <button type="button" class="size-chip" data-size="XL">XL</button>
              </div>
            </div>
          <?php endif; ?>

          <div class="small text-muted" id="selectionSummary"></div>
          <div class="small text-danger mt-1 d-none" id="selectionError"></div>
          <?php if ($isOutOfStock): ?>
            <div class="alert alert-danger py-2 px-3 small mt-3 mb-0 rounded-3">
              <i class="fas fa-exclamation-triangle me-1"></i> Este producto se encuentra actualmente agotado.
            </div>
          <?php elseif ($isLowStock): ?>
            <div class="alert alert-warning py-2.5 px-3 small mt-3 mb-0 rounded-3 border border-warning shadow-sm d-flex align-items-center gap-2" style="background-color: #fff9e6; color: #856404;">
              <i class="fas fa-fire text-danger fs-5"></i>
              <div>
                <strong>¡Últimos productos disponibles!</strong> Solo quedan <strong><?= $productStock ?></strong> unidades en stock. ¡Asegura el tuyo antes de que se agote!
              </div>
            </div>
          <?php endif; ?>

          <!-- Beneficio de Envío -->
          <div class="p-2.5 px-3 rounded-3 mt-3 d-flex align-items-center gap-2 border" style="<?= ($isFreeShipping || $shippingCost <= 0) ? 'background-color: #f0fdf4; border-color: #bbf7d0 !important;' : 'background-color: #f8fafc; border-color: #e2e8f0 !important;' ?>">
            <i class="fas <?= ($isFreeShipping || $shippingCost <= 0) ? 'fa-shipping-fast text-success' : 'fa-box text-muted' ?> fs-5"></i>
            <div class="small">
              <?php if ($isFreeShipping || $shippingCost <= 0): ?>
                <strong class="text-success d-block">¡Este producto cuenta con Envío Gratis!</strong>
                <span class="text-muted" style="font-size: 0.8rem;">Despacho asegurado a nivel nacional sin costo adicional.</span>
              <?php else: ?>
                <strong class="text-dark d-block">Costo de envío: $<?= number_format($shippingCost, 0, ',', '.') ?> COP</strong>
                <span class="text-muted" style="font-size: 0.8rem;">Entrega rápida y rastreo garantizado a nivel nacional.</span>
              <?php endif; ?>
            </div>
          </div>

          <div class="mt-4 d-flex flex-wrap gap-2 align-items-center">
            <button type="button" id="addToCart" aria-label="Agregar al carrito" class="btn fw-bold px-4 py-2.5 rounded-3 shadow-sm" style="background:#87CC3E; color:#000; border:none;" <?= $isOutOfStock ? 'disabled' : '' ?>>
              <i class="fas fa-shopping-cart me-2"></i>Agregar al carrito
            </button>
            <button type="button" id="buyNow" aria-label="Pagar ahora" class="btn text-white fw-bold px-4 py-2.5 rounded-3 shadow-sm" style="background:#6da632; border:none;" <?= $isOutOfStock ? 'disabled' : '' ?>>
              <i class="fas fa-credit-card me-2"></i>Pagar Ahora
            </button>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<script>
  (function(){
    const slides = <?php echo json_encode(!empty($slides) ? array_map(function($s){ return ['src' => '/' . ltrim($s['src'], '/'), 'label' => $s['label'], 'type' => $s['type'] ?? 'image']; }, $slides) : [], JSON_UNESCAPED_SLASHES); ?>;
    const productName = <?php echo json_encode($name); ?>;
    let current = 0;
    const mainImg = document.getElementById('product-main-image');
    const mainVideo = document.getElementById('product-main-video');
    const container = document.querySelector('.detail-main');
    const thumbBtns = document.querySelectorAll('.detail-thumb');
    function setSlide(idx){
      if (!slides[idx]) return;
      current = idx;
      const slide = slides[idx];
      if (slide.type === 'video') {
        mainImg.classList.add('d-none');
        mainVideo.classList.remove('d-none');
        mainVideo.src = slide.src;
        mainVideo.load();
        mainVideo.play().catch(()=>{});
      } else {
        mainVideo.classList.add('d-none');
        mainVideo.pause();
        mainImg.classList.remove('d-none');
        mainImg.src = slide.src;
        mainImg.alt = productName + ' ' + slide.label;
      }
      thumbBtns.forEach((b,i)=> b.classList.toggle('active', i === idx));
      // Al cambiar de imagen, desactivar zoom por clic
      if(container) container.classList.remove('clicked-zoom');
    }
    thumbBtns.forEach(btn => btn.addEventListener('click', function(){
      const idx = parseInt(this.dataset.index, 10);
      setSlide(idx);
    }));
    const prev = document.querySelector('.detail-main .prev');
    const next = document.querySelector('.detail-main .next');
    prev && prev.addEventListener('click', function(){ setSlide((current - 1 + slides.length) % slides.length); });
    next && next.addEventListener('click', function(){ setSlide((current + 1) % slides.length); });

    // Al pasar el cursor sobre flechas, desactivar zoom por hover
    [prev, next].forEach(btn => {
      if(!btn || !container) return;
      btn.addEventListener('mouseenter', () => container.classList.add('hovering-nav'));
      btn.addEventListener('mouseleave', () => container.classList.remove('hovering-nav'));
      // También al hacer clic en flechas, quitar zoom por clic
      btn.addEventListener('click', () => {
        container.classList.remove('clicked-zoom');
        resetZoomTransform();
      });
    });

    // Zoom al clic sobre la imagen: toggle
    if(mainImg && container){
      mainImg.addEventListener('click', () => {
        if(container.classList.contains('clicked-zoom')){
          container.classList.remove('clicked-zoom');
          resetZoomTransform();
        } else {
          container.classList.add('clicked-zoom');
          // En modo zoom por clic, permitir arrastre dentro del recuadro
          // El transform inicial lo aplica CSS (scale); al arrastrar usaremos translate+scale
        }
      });
    }

    // --- Arrastre (pan) dentro del recuadro cuando está zoom por clic ---
    let isDragging = false;
    let startX = 0, startY = 0;
    let offsetX = 0, offsetY = 0;
    const SCALE_CLICK = 1.8;

    function clampOffsets(){
      if(!mainImg) return;
      const baseW = mainImg.clientWidth; // tamaño render sin transform aplicado inline
      const baseH = mainImg.clientHeight;
      const maxX = (baseW * SCALE_CLICK - baseW) / 2;
      const maxY = (baseH * SCALE_CLICK - baseH) / 2;
      offsetX = Math.max(-maxX, Math.min(maxX, offsetX));
      offsetY = Math.max(-maxY, Math.min(maxY, offsetY));
    }
    function applyTransform(){
      mainImg.style.transform = `translate(${offsetX}px, ${offsetY}px) scale(${SCALE_CLICK})`;
    }
    function resetZoomTransform(){
      isDragging = false; offsetX = 0; offsetY = 0; startX = 0; startY = 0;
      if(mainImg){
        mainImg.style.transform = '';
        mainImg.style.cursor = 'zoom-in';
      }
    }

    if(mainImg){
      mainImg.draggable = false;
      mainImg.addEventListener('dragstart', e => e.preventDefault());

      mainImg.addEventListener('pointerdown', (e) => {
        if(!container.classList.contains('clicked-zoom')) return;
        isDragging = true;
        startX = e.clientX; startY = e.clientY;
        try { mainImg.setPointerCapture(e.pointerId); } catch(_){}
        mainImg.style.cursor = 'grabbing';
        e.preventDefault();
      });
      // Inercia: medir velocidad durante el arrastre y aplicar momentum al soltar
      let vx = 0, vy = 0; // píxeles por ms
      let lastT = 0;
      mainImg.addEventListener('pointermove', (e) => {
        if(!isDragging) return;
        const now = performance.now();
        if(lastT === 0) lastT = now;
        const dt = Math.max(1, now - lastT); // evitar división por cero
        const dx = e.clientX - startX;
        const dy = e.clientY - startY;
        startX = e.clientX; startY = e.clientY;
        lastT = now;
        offsetX += dx; offsetY += dy;
        // velocidad en px/ms
        vx = dx / dt; vy = dy / dt;
        clampOffsets();
        applyTransform();
      });
      function startMomentum(){
        let running = true;
        let prev = performance.now();
        const friction = 0.92; // coeficiente de frenado por frame
        const minSpeed = 0.02; // px/ms
        function step(ts){
          if(!running || !container.classList.contains('clicked-zoom')) return;
          const dt = Math.max(1, ts - prev);
          prev = ts;
          // aplicar movimiento en función de velocidad
          offsetX += vx * dt * 1.0;
          offsetY += vy * dt * 1.0;
          // fricción exponencial
          vx *= friction; vy *= friction;
          // si tocamos límites, amortiguar más y anular componente hacia fuera
          const beforeX = offsetX, beforeY = offsetY;
          clampOffsets();
          if(Math.abs(offsetX - beforeX) > 0.1){ vx = 0; }
          if(Math.abs(offsetY - beforeY) > 0.1){ vy = 0; }
          applyTransform();
          if(Math.abs(vx) < minSpeed && Math.abs(vy) < minSpeed){ running = false; return; }
          requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
      }
      const endDrag = () => {
        if(!isDragging) return;
        isDragging = false;
        lastT = 0;
        // iniciar momentum si aún estamos en zoom por clic
        if(container.classList.contains('clicked-zoom')){
          mainImg.style.cursor = 'grab';
          startMomentum();
        }
      };
      mainImg.addEventListener('pointerup', endDrag);
      mainImg.addEventListener('pointerleave', endDrag);

      // Doble clic para entrar/salir del zoom
      mainImg.addEventListener('dblclick', () => {
        if(container.classList.contains('clicked-zoom')){
          container.classList.remove('clicked-zoom');
          resetZoomTransform();
        } else {
          container.classList.add('clicked-zoom');
        }
      });
    }

    // --- Opciones: color, cantidad, género y tallas ---
    const availableColors = <?php echo json_encode($availableColors, JSON_UNESCAPED_UNICODE); ?>;
    let selectedColor = availableColors.length > 0 ? availableColors[0] : 'Negro';
    const colorChips = document.querySelectorAll('.color-choice-chip');
    const selectedColorLabel = document.getElementById('selectedColorLabel');
    const genderGroup = document.getElementById('genderGroup');
    const sizesKids = document.getElementById('sizesKids');
    const sizesMen = document.getElementById('sizesMen');
    const sizesWomen = document.getElementById('sizesWomen');
    const summary = document.getElementById('selectionSummary');
    const errorBox = document.getElementById('selectionError');
    const sizeStockBadge = document.getElementById('sizeStockBadge');
    const isOutOfStock = <?php echo json_encode($isOutOfStock); ?>;
    const productId = <?php echo (int)($p['id'] ?? 0); ?>;
    let currentStock = <?php echo (int)$productStock; ?>;
    const productSizeStock = <?php echo json_encode(!empty($p['size_stock']) ? json_decode($p['size_stock'], true) : null, JSON_UNESCAPED_UNICODE); ?>;

    // Manejar selección interactiva de color
    colorChips.forEach(chip => {
      chip.addEventListener('click', function(){
        colorChips.forEach(c => {
          c.classList.remove('active', 'btn-dark');
          c.classList.add('btn-outline-secondary');
          c.style.boxShadow = '';
        });
        this.classList.add('active', 'btn-dark');
        this.classList.remove('btn-outline-secondary');
        this.style.boxShadow = '0 2px 6px rgba(0,0,0,.2)';
        selectedColor = this.dataset.color || '';
        if (selectedColorLabel) {
          selectedColorLabel.textContent = selectedColor;
        }
        renderSummary();
      });
    });

    const isAccessory = <?php echo json_encode((bool)$isAccessory); ?>;
    let selectedGender = isAccessory ? '' : (document.querySelector('input[name="gender"]:checked')?.value || '');
    if (!isAccessory && !selectedGender) {
      const defaultR = document.getElementById('genderWomen') || document.getElementById('genderMen') || document.getElementById('genderKids');
      if (defaultR) {
        defaultR.checked = true;
        selectedGender = defaultR.value;
      } else {
        selectedGender = 'hombre';
      }
    }
    let selectedSize = '';
    let selectedSizeStock = currentStock;

    function hasValidSizeStock() {
      if (!productSizeStock || typeof productSizeStock !== 'object' || Array.isArray(productSizeStock)) return false;
      return Object.keys(productSizeStock).some(g => {
        return productSizeStock[g] && typeof productSizeStock[g] === 'object' && Object.keys(productSizeStock[g]).length > 0;
      });
    }

    function getActiveGrid() {
      if (selectedGender === 'kids') return sizesKids;
      if (selectedGender === 'hombre') return sizesMen;
      return sizesWomen;
    }

    function refreshSizesStockState() {
      if (isAccessory) return;
      const activeGrid = getActiveGrid();
      if (!activeGrid) return;

      if (!hasValidSizeStock()) {
        activeGrid.querySelectorAll('.size-chip').forEach(btn => {
          btn.dataset.stock = currentStock;
          btn.classList.remove('out-of-stock');
          btn.removeAttribute('title');
        });
        return;
      }

      const genderStock = (productSizeStock && productSizeStock[selectedGender]) ? productSizeStock[selectedGender] : null;

      activeGrid.querySelectorAll('.size-chip').forEach(btn => {
        const sz = btn.dataset.size;
        if (genderStock && typeof genderStock === 'object' && Object.keys(genderStock).length > 0) {
          if (genderStock[sz] !== undefined) {
            const qty = parseInt(genderStock[sz], 10);
            btn.dataset.stock = qty;
            if (qty <= 0) {
              btn.classList.add('out-of-stock');
              btn.setAttribute('title', `Talla ${sz} agotada`);
            } else {
              btn.classList.remove('out-of-stock');
              btn.setAttribute('title', `${qty} unidades disponibles`);
            }
          } else {
            btn.dataset.stock = '0';
            btn.classList.add('out-of-stock');
            btn.setAttribute('title', `Talla ${sz} no disponible`);
          }
        } else {
          btn.dataset.stock = currentStock;
          btn.classList.remove('out-of-stock');
          btn.removeAttribute('title');
        }
      });
    }

    function updateSizesVisibility(){
      sizesKids?.classList.toggle('d-none', selectedGender !== 'kids');
      sizesMen?.classList.toggle('d-none', selectedGender !== 'hombre');
      sizesWomen?.classList.toggle('d-none', selectedGender !== 'mujer');
      
      // Resetear talla seleccionada al cambiar de categoría
      document.querySelectorAll('.size-chip.selected').forEach(b => b.classList.remove('selected'));
      selectedSize = '';
      selectedSizeStock = currentStock;
      if (sizeStockBadge) sizeStockBadge.innerHTML = '';

      refreshSizesStockState();
      renderSummary();
      renderValidation();
      updateQtyLimits();
    }

    function renderSummary(){
      if (isAccessory) {
        summary.textContent = `Color: ${selectedColor}`;
      } else {
        const genderLabel = selectedGender ? (selectedGender.charAt(0).toUpperCase() + selectedGender.slice(1)) : '';
        summary.textContent = `Color: ${selectedColor} • Género: ${genderLabel} ${selectedSize ? '• Talla: ' + selectedSize : ''}`;
      }
    }

    function isValidSelection(){
      if (isOutOfStock) return false;
      if (!selectedColor && availableColors.length > 0) return false;
      if (isAccessory) return true;
      if (!selectedSize) return false;
      if (!selectedGender) return false;
      if (hasValidSizeStock() && selectedSizeStock <= 0) return false;
      return true;
    }

    function renderValidation(){
      const ok = isValidSelection();
      if (!ok) {
        let msg = '';
        if (isOutOfStock) {
          msg = 'Este producto está agotado actualmente.';
        } else if (!selectedGender && !selectedSize) {
          msg = 'Selecciona el género y la talla antes de agregar.';
        } else if (!selectedGender) {
          msg = 'Selecciona el género antes de agregar.';
        } else if (!selectedSize) {
          msg = 'Selecciona la talla antes de agregar.';
        } else if (hasValidSizeStock() && selectedSizeStock <= 0) {
          msg = `La talla ${selectedSize} (${selectedGender}) se encuentra agotada. Por favor selecciona otra talla.`;
        }
        if (errorBox) { errorBox.textContent = msg; errorBox.classList.remove('d-none'); }
      } else {
        if (errorBox) { errorBox.textContent = ''; errorBox.classList.add('d-none'); }
      }
      updateButtonState();
    }

    function updateButtonState(){
      try {
        const btn = document.getElementById('addToCart');
        const buyBtn = document.getElementById('buyNow');
        const valid = isValidSelection();
        const shouldDisable = !valid || isOutOfStock;
        if (btn) btn.disabled = shouldDisable;
        if (buyBtn) buyBtn.disabled = shouldDisable;
      } catch(_){}
    }

    if (!isAccessory) {
      genderGroup?.addEventListener('change', (e) => {
        const r = e.target.closest('input[name="gender"]');
        if(!r) return;
        selectedGender = r.value;
        updateSizesVisibility();
      });

      document.querySelectorAll('.size-grid .size-chip').forEach(btn => {
        btn.addEventListener('click', () => {
          if (btn.classList.contains('out-of-stock')) {
            const sz = btn.dataset.size || '';
            if (errorBox) {
              errorBox.textContent = `La talla ${sz} para ${selectedGender} está agotada. Elige otra talla disponible.`;
              errorBox.classList.remove('d-none');
            }
            return;
          }

          const grid = btn.parentElement;
          grid.querySelectorAll('.size-chip').forEach(b => b.classList.remove('selected'));
          btn.classList.add('selected');
          selectedSize = btn.dataset.size || '';
          
          if (hasValidSizeStock()) {
            const szStock = btn.dataset.stock !== undefined ? parseInt(btn.dataset.stock, 10) : currentStock;
            selectedSizeStock = szStock;
            if (sizeStockBadge) {
              if (szStock <= 0) {
                sizeStockBadge.innerHTML = '<span class="badge bg-danger">Agotado</span>';
              } else if (szStock < 5) {
                sizeStockBadge.innerHTML = `<span class="badge bg-warning text-dark border border-warning" style="background-color: #ffc107 !important;"><i class="fas fa-fire me-1 text-danger"></i>¡Últimas ${szStock} disponibles!</span>`;
              } else {
                sizeStockBadge.innerHTML = `<span class="badge bg-success-subtle text-success-emphasis border border-success-subtle"><i class="fas fa-check-circle me-1"></i>${szStock} disponibles</span>`;
              }
            }
          } else {
            selectedSizeStock = currentStock;
            if (sizeStockBadge) sizeStockBadge.innerHTML = '';
          }

          updateQtyLimits();
          renderSummary();
          renderValidation();
          updateButtonState();
        });
      });

      // Inicialización de tallas
      updateSizesVisibility();
    }

    renderSummary();
    renderValidation();
    updateButtonState();

    // Controles de cantidad +/-
    const qtyInput = document.getElementById('qty');
    const minusBtn = document.querySelector('.qty-btn.minus');
    const plusBtn = document.querySelector('.qty-btn.plus');

    function updateQtyLimits(){
      if (!qtyInput) return;
      const effStock = (productSizeStock && selectedSize) ? selectedSizeStock : currentStock;
      const maxLimit = effStock > 0 ? Math.min(20, effStock) : 1;
      qtyInput.max = maxLimit;
      if (parseInt(qtyInput.value, 10) > maxLimit) {
        qtyInput.value = maxLimit;
      }
      if (effStock <= 0) {
        qtyInput.value = 1;
        qtyInput.disabled = true;
        if (minusBtn) minusBtn.disabled = true;
        if (plusBtn) plusBtn.disabled = true;
      } else {
        qtyInput.disabled = false;
        if (minusBtn) minusBtn.disabled = false;
        if (plusBtn) plusBtn.disabled = false;
      }
    }

    function clampQty(val){
      const min = parseInt(qtyInput?.min || '1', 10);
      const effStock = (productSizeStock && selectedSize) ? selectedSizeStock : currentStock;
      const max = Math.min(parseInt(qtyInput?.max || '20', 10), effStock > 0 ? effStock : 1);
      return Math.max(min, Math.min(max, val));
    }
    minusBtn?.addEventListener('click', () => {
      const cur = clampQty(parseInt(qtyInput.value || '1', 10) - 1);
      qtyInput.value = cur;
    });
    plusBtn?.addEventListener('click', () => {
      const cur = clampQty(parseInt(qtyInput.value || '1', 10) + 1);
      qtyInput.value = cur;
    });

    // --- Agregar al carrito (localStorage) ---
    const addBtn = document.getElementById('addToCart');
    const STORAGE_KEY = 'ft_cart';
    const productSlug = <?php echo json_encode($slug); ?>;
    const productPrice = <?php echo json_encode($price); ?>;
    function readCart(){
      try { const raw = localStorage.getItem(STORAGE_KEY); return raw ? JSON.parse(raw) : []; } catch(e){ return []; }
    }
    function writeCart(items){
      localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
      const badge = document.querySelector('[data-cart-count]');
      if (badge) badge.textContent = items.reduce((a,i)=> a + Number(i.qty||0), 0);
    }
    function processAddToCart(redirect = false) {
      if (!isValidSelection()) {
        renderValidation();
        return false;
      }
      const qty = clampQty(parseInt(qtyInput.value || '1', 10));
      const size = isAccessory ? '' : (selectedSize || '');
      const gender = isAccessory ? '' : (selectedGender || '');
      const color = selectedColor || '';
      const item = {
        id: productId,
        product_id: productId,
        slug: productSlug,
        name: productName,
        price: Number(productPrice||0),
        qty,
        color,
        gender,
        size,
        is_free_shipping: <?php echo $isFreeShipping ? 'true' : 'false'; ?>,
        shipping_cost: <?php echo (float)$shippingCost; ?>
      };
      const items = readCart();
      const idx = items.findIndex(i => i.slug === item.slug && (i.color||'') === item.color && (i.gender||'') === item.gender && (i.size||'') === item.size);
      if (idx >= 0) {
        items[idx].qty = Number(items[idx].qty || 0) + item.qty;
      } else {
        items.push(item);
      }
      writeCart(items);

      if (redirect) {
        window.location.href = '/checkout';
      }
      return true;
    }

    addBtn?.addEventListener('click', () => {
      if (processAddToCart(false)) {
        try {
          const btn = addBtn; btn.disabled = true; btn.innerHTML = '<i class="fas fa-check me-2"></i>Agregado';
          setTimeout(()=>{ btn.disabled = false; btn.innerHTML = '<i class="fas fa-shopping-cart me-2"></i>Agregar al carrito'; }, 1200);
        } catch(_){}
      }
    });

    const buyBtn = document.getElementById('buyNow');
    buyBtn?.addEventListener('click', () => {
      processAddToCart(true);
    });
  })();
</script>

<!-- Sección de Calificación y Comentarios -->
<section id="reviews-section" class="py-5 bg-white border-top text-dark mt-5">
  <div class="container" style="max-width: 900px;">
    
    <div class="row g-4 align-items-start">
      <!-- Resumen de Calificaciones -->
      <div class="col-12 col-md-4">
        <div class="card border-0 bg-light p-4 rounded-4 text-center shadow-sm">
          <h5 class="fw-bold mb-2">Calificación General</h5>
          <div class="display-4 fw-bold text-dark mb-1"><?= number_format($avgRating ?? 0.0, 1) ?></div>
          <div class="mb-3" style="color: #FFC107;">
            <?php for ($i = 1; $i <= 5; $i++): ?>
              <i class="<?= $i <= round($avgRating ?? 0.0) ? 'fas' : 'far' ?> fa-star fa-lg"></i>
            <?php endfor; ?>
          </div>
          <span class="text-muted small"><?= $totalReviews ?? 0 ?> opiniones registradas</span>
        </div>
      </div>

      <!-- Formulario para agregar Comentario -->
      <div class="col-12 col-md-8">
        <h4 class="fw-bold mb-3 text-dark">Opiniones sobre este Producto</h4>

        <?php if (!empty($_SESSION['review_success'])): ?>
          <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($_SESSION['review_success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
          <?php unset($_SESSION['review_success']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['review_error'])): ?>
          <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($_SESSION['review_error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
          <?php unset($_SESSION['review_error']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['user_id'])): ?>
          <!-- Formulario Interactivo -->
          <div class="card border border-light-subtle rounded-4 p-4 mb-4 bg-light shadow-sm">
            <h6 class="fw-bold mb-3 text-uppercase small text-muted">Escribe tu Calificación y Comentario</h6>
            <form action="/producto/comentario" method="POST">
              <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
              <input type="hidden" name="slug" value="<?= htmlspecialchars($p['slug']) ?>">
              <input type="hidden" name="rating" id="rating-input" value="5">

              <div class="mb-3">
                <label class="form-label fw-semibold small d-block">Tu Calificación:</label>
                <div class="star-rating-selector d-inline-flex gap-2" style="font-size: 1.75rem; color: #FFC107; cursor: pointer; user-select: none;">
                  <span data-value="1" style="color: #FFC107;">★</span>
                  <span data-value="2" style="color: #FFC107;">★</span>
                  <span data-value="3" style="color: #FFC107;">★</span>
                  <span data-value="4" style="color: #FFC107;">★</span>
                  <span data-value="5" style="color: #FFC107;">★</span>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label fw-semibold small">Tu Comentario:</label>
                <textarea name="comment" class="form-control bg-white" rows="3" placeholder="Cuéntanos tu experiencia con este producto..." required style="resize: none; border-radius: 10px;"></textarea>
              </div>

              <button type="submit" class="btn btn-dark fw-bold rounded-pill px-4 text-dark" style="background-color: #87CC3E; border: none;">
                Publicar Comentario
              </button>
            </form>
          </div>
        <?php else: ?>
          <!-- Mensaje para loguearse -->
          <div class="alert alert-warning rounded-4 p-3 mb-4 shadow-sm" role="alert">
            <i class="fas fa-lock me-2"></i>Debes <a href="/login" class="alert-link text-decoration-none fw-bold">iniciar sesión</a> para calificar y dejar comentarios sobre este producto.
          </div>
        <?php endif; ?>

        <!-- Listado de Comentarios -->
        <div class="reviews-list mt-4">
          <?php if (!empty($reviews)): ?>
            <?php foreach ($reviews as $rev): ?>
              <div class="p-3 mb-3 border-bottom">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="fw-bold text-dark"><?= htmlspecialchars($rev['nombres'] . ' ' . $rev['apellidos']) ?></span>
                  <span class="text-muted small" style="font-size: 0.75rem;"><?= date('d/m/Y', strtotime($rev['created_at'])) ?></span>
                </div>
                <div class="mb-2" style="color: #FFC107; font-size: 0.85rem;">
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <i class="<?= $i <= $rev['rating'] ? 'fas' : 'far' ?> fa-star"></i>
                  <?php endfor; ?>
                </div>
                <p class="text-muted small mb-0"><?= nl2br(htmlspecialchars($rev['comment'])) ?></p>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-muted small py-3">Aún no hay comentarios para este producto. ¡Sé el primero en dejar tu opinión!</p>
          <?php endif; ?>
        </div>

      </div>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const stars = document.querySelectorAll('.star-rating-selector span');
  const ratingInput = document.getElementById('rating-input');
  
  if (stars.length > 0 && ratingInput) {
    stars.forEach(star => {
      star.addEventListener('click', function() {
        const val = parseInt(this.dataset.value, 10);
        ratingInput.value = val;
        
        stars.forEach(s => {
          const sVal = parseInt(s.dataset.value, 10);
          if (sVal <= val) {
            s.style.color = '#FFC107';
          } else {
            s.style.color = '#e0e0e0';
          }
        });
      });
    });
  }
});
</script>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>