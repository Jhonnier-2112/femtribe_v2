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
      // Detectar accesorio temprano para usar en construcción de slides
      $isAccessory = ($category === 'accesorios')
        || str_contains($slugNorm, 'termo')
        || str_contains($slugNorm, 'flask')
        || str_contains($slugNorm, 'botella');
      // Solo textil: camisetas y esqueletos
      $isTextilType = in_array($type, ['camisetas', 'esqueletos'], true);

      $slides = [];
      
      // 1. Imagen principal
      if (!empty($p['image'])) {
        $slides[] = ['src' => $p['image'], 'label' => 'Principal', 'type' => 'image'];
      }

      // 2. Medios de la tabla product_media (pasados como $media)
      if (!empty($media) && is_array($media)) {
        $imgCount = 1;
        $vidCount = 1;
        foreach ($media as $item) {
          if ($item['type'] === 'video') {
            $slides[] = ['src' => $item['url'], 'label' => 'Video ' . $vidCount++, 'type' => 'video'];
          } else {
            $slides[] = ['src' => $item['url'], 'label' => 'Detalle ' . $imgCount++, 'type' => 'image'];
          }
        }
      } else {
        // Fallback para compatibilidad con campos heredados de base de datos
        if (!empty($p['images'])) {
          $extraImages = explode(',', $p['images']);
          foreach ($extraImages as $idx => $img) {
            $img = trim($img);
            if ($img !== '') {
              $slides[] = ['src' => $img, 'label' => 'Detalle ' . ($idx + 1), 'type' => 'image'];
            }
          }
        }
        if (!empty($p['video'])) {
          $videos = explode(',', $p['video']);
          $videos = array_slice($videos, 0, 2);
          foreach ($videos as $idx => $vid) {
            $vid = trim($vid);
            if ($vid !== '') {
              $slides[] = ['src' => $vid, 'label' => 'Video ' . ($idx + 1), 'type' => 'video'];
            }
          }
        }
      }

      // Fallback si no hay slides
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
        <h1 class="h3 mb-2"><?php echo $name; ?></h1>
        <?php if (strtolower((string)$slug) === 'camiseta_oficial_carrera'): ?>
          <div class="mb-2"><span class="badge" style="background:#FFE08A; color:#3A3A3A; font-weight:700; border-radius:999px; padding:6px 10px;">Edición especial limitada</span></div>
        <?php endif; ?>
        <div class="mb-3"><span class="h5 fw-bold">$<?php echo number_format($price, 0, ',', '.'); ?></span></div>
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
          // Color fijo por producto
          $fixedColorName = 'Negro';
          $fixedColorHex = '#000000';
          // Mantener blancos/verde en casos específicos
          if ($slugNorm === 'camiseta_oficial_carrera' || str_contains($slugNorm, 'carrera')) {
            $fixedColorName = 'Blanco';
            $fixedColorHex = '#FFFFFF';
          } elseif ($slugNorm === 'esqueleto_limite_run_2025_femtribe' || str_contains($slugNorm, 'esqueleto')) {
            $fixedColorName = 'Verde';
            $fixedColorHex = '#87CC3E';
          }
        ?>
        <div class="product-options card card-body" style="border-radius:12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
          <h2 class="h6 mb-3">Selecciona tus opciones</h2>
          <div class="mb-3">
            <label class="form-label">Color</label>
            <div class="d-flex align-items-center gap-2 flex-wrap" id="fixedColor">
              <span class="color-swatch fixed" title="<?php echo htmlspecialchars($fixedColorName); ?>" style="background: <?php echo htmlspecialchars($fixedColorHex); ?>;<?php echo $fixedColorName==='Blanco'? ' border:1px solid #ddd;' : '' ?>"></span>
              <span class="small">Color: <strong><?php echo htmlspecialchars($fixedColorName); ?></strong></span>
            </div>
          </div>

          <div class="mb-3">
            <label for="qty" class="form-label">Cantidad</label>
            <div class="qty-control">
              <button type="button" class="qty-btn minus" aria-label="Menos">−</button>
              <input id="qty" type="number" class="form-control qty-input" value="1" min="1" max="20">
              <button type="button" class="qty-btn plus" aria-label="Más">+</button>
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
              <label class="form-label">Talla</label>
              <div id="sizesKids" class="size-grid d-none" aria-label="Tallas Kids">
                <button type="button" class="size-chip" data-size="14">14</button>
                <button type="button" class="size-chip" data-size="16">16</button>
                <button type="button" class="size-chip" data-size="18">18</button>
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
          <div class="mt-4 d-flex flex-wrap gap-2 align-items-center">
            <button type="button" id="addToCart" aria-label="Agregar al carrito" class="btn fw-bold px-4 py-2.5 rounded-3 shadow-sm" style="background:#87CC3E; color:#000; border:none;">
              <i class="fas fa-shopping-cart me-2"></i>Agregar al carrito
            </button>
            <button type="button" id="buyNow" aria-label="Pagar ahora" class="btn text-white fw-bold px-4 py-2.5 rounded-3 shadow-sm" style="background:#6da632; border:none;">
              <i class="fas fa-credit-card me-2"></i>Pagar Ahora
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if (!empty($slides)) : ?>
<script>
  (function(){
    const slides = <?php echo json_encode(array_map(function($s){ return ['src' => '/' . ltrim($s['src'], '/'), 'label' => $s['label'], 'type' => $s['type'] ?? 'image']; }, $slides), JSON_UNESCAPED_SLASHES); ?>;
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
    const fixedColor = <?php echo json_encode($fixedColorName); ?>;
    const colorPicker = document.getElementById('fixedColor');
    const genderGroup = document.getElementById('genderGroup');
    const sizesKids = document.getElementById('sizesKids');
    const sizesMen = document.getElementById('sizesMen');
    const sizesWomen = document.getElementById('sizesWomen');
    const summary = document.getElementById('selectionSummary');
    const errorBox = document.getElementById('selectionError');
    function updateButtonState(){
      try {
        const btn = document.getElementById('addToCart');
        if (btn) btn.disabled = !isValidSelection();
      } catch(_){}
    }
    let selectedColor = fixedColor || 'Negro';
    const isAccessory = <?php echo json_encode((bool)$isAccessory); ?>;
    let selectedGender = isAccessory ? '' : (document.querySelector('input[name="gender"]:checked')?.value || '');
    let selectedSize = '';

    function updateSizesVisibility(){
      sizesKids.classList.toggle('d-none', selectedGender !== 'kids');
      sizesMen.classList.toggle('d-none', selectedGender !== 'hombre');
      sizesWomen.classList.toggle('d-none', selectedGender !== 'mujer');
      // reset selection when switching group
      document.querySelectorAll('.size-chip.selected').forEach(b => b.classList.remove('selected'));
      selectedSize = '';
      renderSummary();
      renderValidation();
    }
    function renderSummary(){
      if (isAccessory) {
        summary.textContent = `Color: ${selectedColor}`;
      } else {
        summary.textContent = `Color: ${selectedColor} • Género: ${selectedGender} ${selectedSize? '• Talla: '+selectedSize : ''}`;
      }
    }

    function isValidSelection(){
      if (isAccessory) return true;
      const hasGender = !!selectedGender;
      const hasSize = !!selectedSize;
      return hasGender && hasSize;
    }

    function renderValidation(){
      const ok = isValidSelection();
      if (!ok) {
        let msg = '';
        if (!selectedGender && !selectedSize) {
          msg = 'Selecciona el género y la talla antes de agregar.';
        } else if (!selectedGender) {
          msg = 'Selecciona el género antes de agregar.';
        } else if (!selectedSize) {
          msg = 'Selecciona la talla antes de agregar.';
        }
        if (errorBox) { errorBox.textContent = msg; errorBox.classList.remove('d-none'); }
      } else {
        if (errorBox) { errorBox.textContent = ''; errorBox.classList.add('d-none'); }
      }
      updateButtonState();
    }
    // Color fijo: no hay interacción
    if (!isAccessory) {
      genderGroup?.addEventListener('change', (e) => {
        const r = e.target.closest('input[name="gender"]');
        if(!r) return;
        selectedGender = r.value;
        updateSizesVisibility();
      });
      document.querySelectorAll('.size-grid .size-chip').forEach(btn => {
        btn.addEventListener('click', () => {
          const grid = btn.parentElement;
          grid.querySelectorAll('.size-chip').forEach(b => b.classList.remove('selected'));
          btn.classList.add('selected');
          selectedSize = btn.dataset.size || '';
          renderSummary();
          renderValidation();
          updateButtonState();
        });
      });
      // inicialización
      updateSizesVisibility();
    }
    // Color fijo: marcado visual
    colorPicker?.querySelector('.color-swatch')?.classList.add('selected');
    renderSummary();
    renderValidation();
    updateButtonState();
    // Controles de cantidad +/-
    const qtyInput = document.getElementById('qty');
    const minusBtn = document.querySelector('.qty-btn.minus');
    const plusBtn = document.querySelector('.qty-btn.plus');
    function clampQty(val){
      const min = parseInt(qtyInput.min || '1', 10);
      const max = parseInt(qtyInput.max || '20', 10);
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
      const item = { slug: productSlug, name: productName, price: Number(productPrice||0), qty, color, gender, size };
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
<?php endif; ?>

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