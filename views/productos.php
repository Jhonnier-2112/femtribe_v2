<?php require_once __DIR__ . '/layouts/header.php'; ?>
<link rel="stylesheet" href="/assets/css/products.css">

<section class="py-4" style="margin-top: 120px;">
    <div class="container">
        <?php
            $total = isset($pagination['total']) ? (int)$pagination['total'] : 0;
            $order = $_GET['order'] ?? 'created_at DESC';
            $perPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 12;
            $options = [
                'created_at DESC' => 'Más nuevos',
                'price ASC' => 'Precio: menor a mayor',
                'price DESC' => 'Precio: mayor a menor',
                'name ASC' => 'Nombre A–Z',
            ];
            $currentCategory = $_GET['category'] ?? null;
            $baseQs = $_GET;
            unset($baseQs['category'], $baseQs['gender'], $baseQs['type']);
            $hrefTodos = '?' . http_build_query($baseQs);
            // Ropa => category = textil
            $qsRopa = $baseQs; $qsRopa['category'] = 'textil'; unset($qsRopa['type'], $qsRopa['gender']);
            $hrefRopa = '?' . http_build_query($qsRopa);
            // Accesorios => category = accesorios
            $qsAcc = $baseQs; $qsAcc['category'] = 'accesorios'; unset($qsAcc['type'], $qsAcc['gender']);
            $hrefAccesorios = '?' . http_build_query($qsAcc);
        ?>

        <!-- Banner superior: imagen fija con enlace al detalle de producto -->
       <!--  <div class="mb-3">
            <a href="" class="d-block" aria-label="Ver detalles de la camiseta de carrera">
                <img src="/assets/img/banner_camiseta_carrera.jpeg" alt="Banner camiseta oficial de carrera" class="catalog-banner-img" />
            </a>
        </div>-->

        <!-- Layout con filtros a la izquierda y contenido a la derecha -->
        <div class="catalog-layout">
            <aside class="filters-sidebar">
                <div class="breadcrumb small mb-2"><a href="/">Inicio</a> / Productos</div>
                <h2 class="filters-title">Filtros</h2>
                <?php
                    $orderQs = $_GET['order'] ?? null;
                    $perQs = isset($_GET['per_page']) ? (int)$_GET['per_page'] : null;
                ?>
                <form method="get" class="filters-form" aria-label="Filtros de categoría">
                    <input type="hidden" name="page" value="1" />
                    <?php if ($orderQs) : ?><input type="hidden" name="order" value="<?php echo htmlspecialchars($orderQs); ?>" /><?php endif; ?>
                    <?php if ($perQs) : ?><input type="hidden" name="per_page" value="<?php echo htmlspecialchars($perQs); ?>" /><?php endif; ?>
                    <input type="hidden" name="category" id="filter-category-hidden" value="<?php echo htmlspecialchars($currentCategory ?? ''); ?>" />
                    <?php
                        // Subfiltros actuales
                        $currentTypes = [];
                        if (!empty($_GET['type'])) {
                            $currentTypes = is_array($_GET['type']) ? $_GET['type'] : [$_GET['type']];
                            $currentTypes = array_map(function($t){ return strtolower((string)$t); }, $currentTypes);
                        }
                    ?>
                    <?php
                        $ropaTypes = ['camisetas','esqueletos','licras','medias'];
                        $accTypes  = ['botella_plegable','accesorios'];
                        $hasTextilSelected = count(array_intersect($currentTypes ?? [], $ropaTypes)) > 0;
                        $hasAccesoriosSelected = count(array_intersect($currentTypes ?? [], $accTypes)) > 0;
                    ?>
                    <div class="filter-group mb-3">
                        <div class="filter-header d-flex justify-content-between align-items-center py-2 px-1" role="button" tabindex="0" aria-expanded="<?php echo ($currentCategory === 'textil' || $hasTextilSelected) ? 'true' : 'false'; ?>">
                            <a href="<?php echo $hrefRopa; ?>" class="text-decoration-none text-dark fw-bold filter-category-link" onclick="event.stopPropagation();">
                                <i class="fas fa-tshirt me-2 text-success"></i>Ropa
                            </a>
                            <span class="chevron ms-auto">▾</span>
                        </div>
                        <div class="filter-body <?php echo ($currentCategory === 'textil' || $hasTextilSelected) ? 'open' : ''; ?>">
                            <div class="filters-list pt-1">
                                <?php 
                                $ropaLabels = [
                                    'camisetas'  => 'Camisetas',
                                    'esqueletos' => 'Esqueletos',
                                    'licras'     => 'Licras',
                                    'medias'     => 'Medias'
                                ];
                                foreach ($ropaLabels as $tVal => $tLabel): ?>
                                    <label class="filter-option py-1 d-flex align-items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="type[]" data-group="textil" value="<?php echo $tVal; ?>" <?php echo in_array($tVal, $currentTypes) ? 'checked' : ''; ?> />
                                        <span><?php echo $tLabel; ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="filter-group mb-3">
                        <div class="filter-header d-flex justify-content-between align-items-center py-2 px-1" role="button" tabindex="0" aria-expanded="<?php echo ($currentCategory === 'accesorios' || $hasAccesoriosSelected) ? 'true' : 'false'; ?>">
                            <a href="<?php echo $hrefAccesorios; ?>" class="text-decoration-none text-dark fw-bold filter-category-link" onclick="event.stopPropagation();">
                                <i class="fas fa-wine-bottle me-2 text-primary"></i>Accesorios
                            </a>
                            <span class="chevron ms-auto">▾</span>
                        </div>
                        <div class="filter-body <?php echo ($currentCategory === 'accesorios' || $hasAccesoriosSelected) ? 'open' : ''; ?>">
                            <div class="filters-list pt-1">
                                <?php 
                                $accLabels = [
                                    'botella_plegable' => 'Termo / Botella Plegable',
                                    'accesorios'       => 'Accesorios Varios'
                                ];
                                foreach ($accLabels as $tVal => $tLabel): ?>
                                    <label class="filter-option py-1 d-flex align-items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="type[]" data-group="accesorios" value="<?php echo $tVal; ?>" <?php echo in_array($tVal, $currentTypes) ? 'checked' : ''; ?> />
                                        <span><?php echo $tLabel; ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="filter-group mb-3">
                        <a href="<?php echo $hrefTodos; ?>" class="btn btn-sm btn-outline-dark w-100 rounded-pill py-2 text-uppercase fw-bold" style="font-size:0.78rem;">
                            <i class="fas fa-list me-1"></i>Ver Todos los Productos
                        </a>
                    </div>
                </form>
            </aside>

            <div class="products-content">
                <!-- Breadcrumb móvil (visible solo en pantallas pequeñas) -->
                <div class="breadcrumb small mb-2 mobile-breadcrumb"><a href="/">Inicio</a> / Productos</div>
                <!-- Topbar móvil: iconos de Filtros y Ordenar por -->
                <div class="mobile-topbar">
                    <button class="mobile-btn" id="openFiltersBtn" aria-label="Abrir filtros"><i class="fas fa-sliders-h"></i> <span>Filtros</span></button>
                    <button class="mobile-btn" id="openSortBtn" aria-label="Abrir ordenar"><i class="fas fa-sort"></i> <span>Ordenar por</span></button>
                </div>
                <div class="sorting-toolbar">
                    <div class="sorting-left">
                        <h1 class="content-title">Productos FEMTRIBE</h1>
                        <p class="content-meta"><?php echo $total . ' producto' . ($total === 1 ? '' : 's'); ?></p>
                    </div>
                    <form method="get" class="sorting-controls">
                        <input type="hidden" name="page" value="1" />
                        <?php // Preservar categoría actual si aplica ?>
                        <?php if ($currentCategory !== null): ?>
                            <input type="hidden" name="category" value="<?php echo htmlspecialchars($currentCategory); ?>" />
                        <?php endif; ?>
                        <?php // Preservar type[] si existe ?>
                        <?php if (!empty($currentTypes)) : foreach ($currentTypes as $ct): ?>
                            <input type="hidden" name="type[]" value="<?php echo htmlspecialchars($ct); ?>" />
                        <?php endforeach; endif; ?>
                        <div class="control">
                            <label>Ordenar por</label>
                            <select name="order" class="form-select sorting-select">
                                <?php foreach ($options as $val => $label): ?>
                                    <option value="<?php echo $val; ?>" <?php echo $order === $val ? 'selected' : ''; ?>>
                                        <?php echo $label; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!--
                        <div class="control">
                            <label>Mostrar</label>
                            <select name="per_page" class="form-select sorting-select">
                                <?php foreach ([12,24,48] as $pp): ?>
                                    <option value="<?php echo $pp; ?>" <?php echo ($perPage === $pp) ? 'selected' : ''; ?>>
                                        <?php echo $pp; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        -->
                    </form>
                </div>

                <!-- Overlay modal: Filtros (móvil) -->
                <div class="overlay" id="filtersOverlay" aria-hidden="true">
                  <div class="overlay-panel">
                    <div class="overlay-header">
                      <span>Filtros</span>
                      <button class="overlay-close" type="button" aria-label="Cerrar">×</button>
                    </div>
                    <div class="overlay-body">
                      <form method="get" class="filters-form" aria-label="Filtros de categoría (móvil)">
                        <input type="hidden" name="page" value="1" />
                        <?php if (!empty($_GET['order'])): ?><input type="hidden" name="order" value="<?php echo htmlspecialchars($_GET['order']); ?>" /><?php endif; ?>
                        <?php if (!empty($_GET['per_page'])): ?><input type="hidden" name="per_page" value="<?php echo htmlspecialchars((int)$_GET['per_page']); ?>" /><?php endif; ?>
                        <input type="hidden" name="category" id="filter-category-hidden" value="<?php echo htmlspecialchars($currentCategory ?? ''); ?>" />
                        <?php
                          $currentTypesMobile = [];
                          if (!empty($_GET['type'])) {
                            $currentTypesMobile = is_array($_GET['type']) ? $_GET['type'] : [$_GET['type']];
                            $currentTypesMobile = array_map(function($t){ return strtolower((string)$t); }, $currentTypesMobile);
                          }
                          $hasTextilSelectedM = count(array_intersect($currentTypesMobile, $ropaTypes)) > 0;
                          $hasAccesoriosSelectedM = count(array_intersect($currentTypesMobile, $accTypes)) > 0;
                        ?>
                        <div class="filter-group">
                          <div class="filter-header" role="button" tabindex="0" aria-expanded="<?php echo $hasTextilSelectedM ? 'true' : 'false'; ?>">
                            <span>Tipo de prenda</span>
                            <span class="chevron">▾</span>
                          </div>
                          <div class="filter-body <?php echo $hasTextilSelectedM ? 'open' : ''; ?>">
                            <div class="filters-list">
                              <?php foreach ($ropaTypes as $tVal): $tLabel = ucfirst($tVal); if ($tVal==='esqueletos') $tLabel='Esqueletos'; ?>
                                <label class="filter-option">
                                  <input type="checkbox" name="type[]" data-group="textil" value="<?php echo $tVal; ?>" <?php echo in_array($tVal, $currentTypesMobile) ? 'checked' : ''; ?> />
                                  <span><?php echo $tLabel; ?></span>
                                </label>
                              <?php endforeach; ?>
                            </div>
                          </div>
                        </div>
                        <div class="filter-group">
                          <div class="filter-header" role="button" tabindex="0" aria-expanded="<?php echo $hasAccesoriosSelectedM ? 'true' : 'false'; ?>">
                            <span>Accesorios</span>
                            <span class="chevron">▾</span>
                          </div>
                          <div class="filter-body <?php echo $hasAccesoriosSelectedM ? 'open' : ''; ?>">
                            <div class="filters-list">
                              <label class="filter-option">
                                <input type="checkbox" name="type[]" data-group="accesorios" value="botella_plegable" <?php echo in_array('botella_plegable', $currentTypesMobile) ? 'checked' : ''; ?> />
                                <span>Termo / Botella Plegable</span>
                              </label>
                              <label class="filter-option">
                                <input type="checkbox" name="type[]" data-group="accesorios" value="accesorios" <?php echo in_array('accesorios', $currentTypesMobile) ? 'checked' : ''; ?> />
                                <span>Accesorios Varios</span>
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="mt-3">
                          <a href="<?php echo $hrefTodos; ?>" class="btn btn-sm btn-outline-dark w-100 rounded-pill py-2 text-uppercase fw-bold" style="font-size:0.78rem;">
                            <i class="fas fa-list me-1"></i>Ver Todos los Productos
                          </a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- Overlay modal: Ordenar por (móvil) -->
                <div class="overlay" id="sortOverlay" aria-hidden="true">
                  <div class="overlay-panel">
                    <div class="overlay-header">
                      <span>Ordenar por</span>
                      <button class="overlay-close" type="button" aria-label="Cerrar">×</button>
                    </div>
                    <div class="overlay-body">
                      <div class="sort-options">
                        <?php foreach ($options as $val => $label): ?>
                          <button class="sort-option" data-order="<?php echo htmlspecialchars($val); ?>" <?php echo ($order === $val) ? 'data-active="true"' : ''; ?>><?php echo htmlspecialchars($label); ?></button>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                </div>

                <?php
                    // Chips de filtros activos con opción de quitar
                    $qsAll = $_GET;
                    $labels = [];
                    if (!empty($qsAll['category'])) {
                        $cat = strtolower((string)$qsAll['category']);
                        $labels['category'] = ($cat === 'textil') ? 'Ropa' : (($cat === 'accesorios') ? 'Accesorios' : $cat);
                    }
                    // Para type[], crear chips individuales
                    $typeValues = [];
                    if (!empty($qsAll['type'])) {
                        $typeValues = is_array($qsAll['type']) ? $qsAll['type'] : [$qsAll['type']];
                        $typeValues = array_map(function($t){ return strtolower((string)$t); }, $typeValues);
                    }
                    if (!empty($qsAll['gender'])) { $labels['gender'] = ucfirst($qsAll['gender']); }
                    if (!empty($qsAll['min_price'])) { $labels['min_price'] = 'Min $' . number_format((float)$qsAll['min_price'], 0, ',', '.'); }
                    if (!empty($qsAll['max_price'])) { $labels['max_price'] = 'Max $' . number_format((float)$qsAll['max_price'], 0, ',', '.'); }
                ?>
                <?php if (!empty($labels) || !empty($typeValues)) : ?>
                    <div class="applied-filters mb-3">
                        <?php foreach ($labels as $key => $label):
                            $tmp = $qsAll; unset($tmp[$key]); $tmp['page'] = 1; $hrefRemove = '?' . http_build_query($tmp);
                        ?>
                            <a class="applied-chip" href="<?php echo $hrefRemove; ?>" title="Quitar filtro"><?php echo htmlspecialchars($label); ?> <span class="chip-x">×</span></a>
                        <?php endforeach; ?>
                        <?php if (!empty($typeValues)) : foreach ($typeValues as $tVal):
                            $tmp = $qsAll;
                            if (isset($tmp['type'])) {
                                $tmp['type'] = array_values(array_filter(is_array($tmp['type']) ? $tmp['type'] : [$tmp['type']], function($x) use ($tVal) { return strtolower((string)$x) !== $tVal; }));
                                if (count($tmp['type']) === 0) { unset($tmp['type']); }
                            }
                            $tmp['page'] = 1;
                            $hrefRemoveType = '?' . http_build_query($tmp);
                        ?>
                            <a class="applied-chip" href="<?php echo $hrefRemoveType; ?>" title="Quitar tipo"><?php echo ucfirst(str_replace('_',' ', $tVal)); ?> <span class="chip-x">×</span></a>
                        <?php endforeach; endif; ?>
                    <?php $tmpAll = $qsAll; unset($tmpAll['category'],$tmpAll['type'],$tmpAll['gender'],$tmpAll['min_price'],$tmpAll['max_price']); $tmpAll['page']=1; $hrefClearAll = '?' . http_build_query($tmpAll); ?>
                    <a class="applied-chip clear-all" href="<?php echo $hrefClearAll; ?>">Limpiar todo</a>
                    </div>
                <?php endif; ?>

                <!-- Inicio del listado y tarjetas -->

        

        <?php if (!empty($products)) : ?>
            <?php
            // Cargar en un solo query las imágenes de product_media para todos los productos de la página
            $productMediaMap = [];
            $pIds = array_filter(array_map(function($prod) { return (int)($prod['id'] ?? 0); }, $products));
            if (!empty($pIds)) {
                try {
                    $dbMed = (new \App\Config\Database())->getConnection();
                    if ($dbMed) {
                        $inIds = implode(',', $pIds);
                        $stmtMed = $dbMed->query("SELECT product_id, type, url FROM product_media WHERE product_id IN ($inIds) AND type = 'image' ORDER BY sort_order ASC, id ASC");
                        while ($mRow = $stmtMed->fetch(PDO::FETCH_ASSOC)) {
                            $productMediaMap[(int)$mRow['product_id']][] = $mRow['url'];
                        }
                    }
                } catch (\Throwable $e) {}
            }
            ?>
            <div class="row g-4">
                <?php foreach ($products as $p) : ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <?php 
                          $pType = isset($p['type']) ? strtolower((string)$p['type']) : '';
                          $isEsqueleto = ($pType === 'esqueletos');
                        ?>
                        <a href="/producto?slug=<?php echo urlencode((string)($p['slug'] ?? '')); ?>" class="card h-100 shadow-sm product-card <?php echo $isEsqueleto ? 'esqueleto-card' : ''; ?>" style="border-radius: 12px; overflow: hidden; text-decoration:none; color: inherit; display:block;">
                            <?php
                                // Soportar assets en /public/assets y también en /assets según despliegue
                                $baseCandidates = array_filter(array_unique([
                                    realpath(__DIR__ . '/../'),
                                    rtrim((string)($_SERVER['DOCUMENT_ROOT'] ?? ''), '/'),
                                    realpath(__DIR__ . '/../../public_html'),
                                    realpath(__DIR__ . '/../../public')
                                ]));

                                $existsRel = function($rel) use ($baseCandidates) {
                                    if (empty($rel)) return false;
                                    $rel = ltrim($rel, '/');
                                    $variations = [$rel];
                                    if (strpos($rel, 'assets/') !== 0) {
                                        $variations[] = 'assets/' . $rel;
                                    }
                                    foreach ($baseCandidates as $base) {
                                        if (!$base) continue;
                                        foreach ($variations as $v) {
                                            if (is_file($base . '/' . $v)) { return true; }
                                        }
                                    }
                                    return false;
                                };

                                $resolveRel = function($rel) use ($baseCandidates) {
                                    if (empty($rel)) return '';
                                    $rel = ltrim($rel, '/');
                                    $variations = [$rel];
                                    if (strpos($rel, 'assets/') !== 0) {
                                        $variations[] = 'assets/' . $rel;
                                    }
                                    foreach ($baseCandidates as $base) {
                                        if (!$base) continue;
                                        foreach ($variations as $v) {
                                            if (is_file($base . '/' . $v)) { return $v; }
                                        }
                                    }
                                    return $rel;
                                };

                                // Recopilar todas las imágenes cargadas para este producto
                                $uploadedImages = [];
                                $pId = (int)($p['id'] ?? 0);
                                if (!empty($productMediaMap[$pId])) {
                                    foreach ($productMediaMap[$pId] as $mUrl) {
                                        $cleanU = ltrim(trim($mUrl), '/');
                                        if ($cleanU !== '' && !in_array($cleanU, $uploadedImages, true)) {
                                            $uploadedImages[] = $cleanU;
                                        }
                                    }
                                }
                                if (!empty($p['images'])) {
                                    foreach (explode(',', (string)$p['images']) as $rawImg) {
                                        $cleanU = ltrim(trim($rawImg), '/');
                                        if ($cleanU !== '' && !in_array($cleanU, $uploadedImages, true)) {
                                            $uploadedImages[] = $cleanU;
                                        }
                                    }
                                }
                                if (!empty($p['image'])) {
                                    $cleanU = ltrim(trim($p['image']), '/');
                                    if ($cleanU !== '' && !in_array($cleanU, $uploadedImages, true)) {
                                        array_unshift($uploadedImages, $cleanU);
                                    }
                                }

                                $slug = isset($p['slug']) ? $p['slug'] : '';
                                $slugU = str_replace('-', '_', $slug);

                                // 1. Imagen frontal: primera imagen cargada
                                $finalImg = '';
                                if (!empty($uploadedImages[0])) {
                                    $finalImg = $resolveRel($uploadedImages[0]);
                                }
                                if (empty($finalImg) || !$existsRel($finalImg)) {
                                    $candidates = [];
                                    if (!empty($p['image'])) {
                                        $candidates[] = ltrim(trim($p['image']), '/');
                                    }
                                    foreach (['jpg','jpeg','png','svg'] as $ext) {
                                        $candidates[] = "assets/img/products/{$slug}.{$ext}";
                                        $candidates[] = "assets/img/products/{$slugU}.{$ext}";
                                        $candidates[] = "assets/img/products/{$slug}_frontal.{$ext}";
                                        $candidates[] = "assets/img/products/{$slugU}_frontal.{$ext}";
                                        if ($slug === 'camiseta_oficial_femtribe') {
                                            $candidates[] = "assets/img/products/camiseta_ofical_femtribe.{$ext}";
                                        }
                                        if ($slug === 'esqueleto_limite_run_2025_femtribe') {
                                            $candidates[] = "assets/img/products/esqueletos_femtribe.{$ext}";
                                            $candidates[] = "assets/img/products/esqueleto_femtribe.{$ext}";
                                        }
                                    }
                                    foreach ($candidates as $rel) {
                                        if ($existsRel($rel)) { $finalImg = $resolveRel($rel); break; }
                                    }
                                }

                                // Fallbacks semánticos por nombre si aún no hay imagen frontal
                                if (empty($finalImg) || !$existsRel($finalImg)) {
                                    if (strpos($slug, 'carrera') !== false && $existsRel('assets/img/products/camiseta_oficial_carrera.png')) $finalImg = 'assets/img/products/camiseta_oficial_carrera.png';
                                    elseif (strpos($slug, 'training') !== false && $existsRel('assets/img/products/camiseta_oficial_femtribe.png')) $finalImg = 'assets/img/products/camiseta_oficial_femtribe.png';
                                    elseif (strpos($slug, 'esqueleto') !== false && $existsRel('assets/img/products/esqueleto_femtribe.png')) $finalImg = 'assets/img/products/esqueleto_femtribe.png';
                                    elseif ((strpos($slug, 'flask') !== false || strpos($slug, 'termo') !== false) && $existsRel('assets/img/products/termo_frontal.png')) $finalImg = 'assets/img/products/termo_frontal.png';
                                    elseif (!empty($uploadedImages[0])) $finalImg = $uploadedImages[0];
                                }

                                // 2. Imagen trasera (hover flip): segunda imagen cargada
                                $backImg = '';
                                if (!empty($uploadedImages[1])) {
                                    $backImg = $resolveRel($uploadedImages[1]);
                                }
                                if (empty($backImg)) {
                                    // Fallback: variantes en disco (_back, -back, _trasera, etc.)
                                    $backCandidates = [];
                                    foreach (['jpg','jpeg','png','svg'] as $ext) {
                                        $backCandidates[] = "assets/img/products/{$slug}_back.{$ext}";
                                        $backCandidates[] = "assets/img/products/{$slugU}_back.{$ext}";
                                        $backCandidates[] = "assets/img/products/{$slug}-back.{$ext}";
                                        $backCandidates[] = "assets/img/products/{$slugU}-back.{$ext}";
                                        $backCandidates[] = "assets/img/products/{$slug}_trasera.{$ext}";
                                        $backCandidates[] = "assets/img/products/{$slugU}_trasera.{$ext}";
                                        $backCandidates[] = "assets/img/products/{$slug}-trasera.{$ext}";
                                        $backCandidates[] = "assets/img/products/{$slugU}-trasera.{$ext}";
                                        $backCandidates[] = "assets/img/products/{$slug}_black.{$ext}";
                                        $backCandidates[] = "assets/img/products/{$slugU}_black.{$ext}";
                                        $backCandidates[] = "assets/img/products/{$slug}-black.{$ext}";
                                        $backCandidates[] = "assets/img/products/{$slugU}-black.{$ext}";
                                        if ($slug === 'camiseta_oficial_femtribe') {
                                            $backCandidates[] = "assets/img/products/camiseta_ofical_femtribe_black.{$ext}";
                                        }
                                        if ($slug === 'esqueleto_limite_run_2025_femtribe') {
                                            $backCandidates[] = "assets/img/products/esqueleto_femtribe_back.{$ext}";
                                            $backCandidates[] = "assets/img/products/esqueletos_femtribe_back.{$ext}";
                                        }
                                    }

                                    if (!empty($finalImg)) {
                                        $frontNoExt = preg_replace('/\.(jpg|jpeg|png)$/i', '', $finalImg);
                                        foreach (['jpg','jpeg','png'] as $ext) {
                                            $backCandidates[] = $frontNoExt . '_back.' . $ext;
                                            $backCandidates[] = str_replace('_', '-', $frontNoExt) . '-back.' . $ext;
                                            $backCandidates[] = str_replace('-', '_', $frontNoExt) . '_back.' . $ext;
                                            $backCandidates[] = preg_replace('/(_|-)frontal$/i', '$1back', $frontNoExt) . '.' . $ext;
                                            $backCandidates[] = $frontNoExt . '_trasera.' . $ext;
                                            $backCandidates[] = $frontNoExt . '_black.' . $ext;
                                            $backCandidates[] = str_replace('_', '-', $frontNoExt) . '-black.' . $ext;
                                            $backCandidates[] = str_replace('-', '_', $frontNoExt) . '_black.' . $ext;
                                        }
                                    }

                                    foreach ($backCandidates as $rel) {
                                        if ($existsRel($rel)) { $backImg = $resolveRel($rel); break; }
                                    }
                                }

                                // Fallbacks semánticos para imagen trasera si no vino una segunda imagen cargada
                                if (empty($backImg)) {
                                    if (strpos($slug, 'carrera') !== false && $existsRel('assets/img/products/camiseta_oficial_carrera_back.png')) $backImg = 'assets/img/products/camiseta_oficial_carrera_back.png';
                                    elseif (strpos($slug, 'training') !== false && $existsRel('assets/img/products/camiseta_oficial_femtribe_back.png')) $backImg = 'assets/img/products/camiseta_oficial_femtribe_back.png';
                                    elseif (strpos($slug, 'esqueleto') !== false && $existsRel('assets/img/products/esqueleto_femtribe_back.png')) $backImg = 'assets/img/products/esqueleto_femtribe_back.png';
                                    elseif ((strpos($slug, 'flask') !== false || strpos($slug, 'termo') !== false) && $existsRel('assets/img/products/termo_back.png')) $backImg = 'assets/img/products/termo_back.png';
                                }
                            ?>
                            <div class="position-relative image-box <?= !empty($backImg) ? 'has-back' : '' ?>" style="aspect-ratio: 4 / 5;">
                                <?php if (!empty($finalImg)) : ?>
                                  <img src="/<?php echo htmlspecialchars(ltrim($finalImg, '/')); ?>" alt="<?php echo htmlspecialchars($p['name']); ?> frontal" class="product-image front" style="width:100%; height:100%;" />
                                  <?php if (!empty($backImg)) : ?>
                                    <img src="/<?php echo htmlspecialchars(ltrim($backImg, '/')); ?>" alt="<?php echo htmlspecialchars($p['name']); ?> trasera" class="product-image back" style="width:100%; height:100%;" />
                                  <?php endif; ?>
                                <?php else : ?>
                                  <div class="d-flex align-items-center justify-content-center w-100 h-100 text-muted" style="background: #f7f7f7; border-radius: 12px;">
                                    <div class="text-center">
                                      <i class="fas fa-image fa-2x mb-2 opacity-50"></i>
                                      <div>Sin imagen</div>
                                    </div>
                                  </div>
                                <?php endif; ?>
                                
                                <div class="position-absolute top-0 start-0 p-2 d-flex gap-2 flex-wrap" style="z-index: 20;">
                                    <?php 
                                        $isUpcoming = !empty($p['is_upcoming']);
                                        $slugRaw = isset($p['slug']) ? (string)$p['slug'] : '';
                                        $slugNorm = str_replace('-', '_', strtolower($slugRaw));
                                        $pStock = isset($p['stock']) ? (int)$p['stock'] : 0;
                                    ?>
                                    <?php if ($isUpcoming) : ?>
                                        <span class="badge bg-warning text-dark shadow-sm fw-bold border border-warning" style="border-radius:999px; padding:6px 12px; background-color: #ffc107 !important;">
                                            <i class="fas fa-clock me-1"></i>Próximamente
                                        </span>
                                    <?php elseif ($pStock <= 0) : ?>
                                        <span class="badge bg-secondary shadow-sm" style="border-radius:999px; padding:6px 10px;">Agotado</span>
                                    <?php elseif ($pStock < 10) : ?>
                                        <span class="badge bg-warning text-dark shadow-sm fw-bold border border-warning" style="border-radius:999px; padding:6px 12px; background-color: #ffc107 !important;">
                                            <i class="fas fa-fire text-danger me-1"></i>¡Últimos productos! (<?= $pStock ?>)
                                        </span>
                                    <?php elseif ($slugNorm === 'camiseta_oficial_carrera') : ?>
                                        <span class="badge" style="background:#FFE08A; color:#3A3A3A; font-weight:700; border-radius:999px; padding:6px 10px;">Edición especial limitada</span>
                                    <?php elseif (!empty($p['is_offer'])) : ?>
                                        <span class="badge bg-danger">Oferta</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-2 text-center" style="min-height: 44px;">
                                    <?php echo htmlspecialchars($p['name']); ?><?php if (!empty($p['is_upcoming'])): ?> <span class="text-warning-emphasis fw-bold" style="font-size:0.85em;"> - Próximamente</span><?php endif; ?>
                                </h5>
                                <div class="mb-2 text-center">
                                    <?php 
                                        $isUpcoming = !empty($p['is_upcoming']);
                                        $slugRaw = isset($p['slug']) ? (string)$p['slug'] : '';
                                        $slugNorm = str_replace('-', '_', strtolower($slugRaw));
                                    ?>
                                    <?php if ($isUpcoming) : ?>
                                        <span class="badge bg-warning text-dark px-3 py-1.5 fw-bold rounded-pill shadow-sm" style="font-size: 0.85rem; background-color: #ffc107 !important;">
                                            <i class="fas fa-clock me-1"></i>- Próximamente
                                        </span>
                                    <?php elseif ($slugNorm === 'camiseta_oficial_carrera') : ?>
                                        <span class="h6 fw-bold">$<?php echo number_format(65000, 0, ',', '.'); ?></span>
                                    <?php else : ?>
                                        <span class="h6 fw-bold">$<?php echo number_format((float)$p['price'], 0, ',', '.'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php 
                                    $pIsFree = !isset($p['is_free_shipping']) || (int)$p['is_free_shipping'] === 1;
                                    $pShipCost = isset($p['shipping_cost']) ? (float)$p['shipping_cost'] : 0.00;
                                ?>
                                <div class="mb-2 text-center">
                                    <?php if (!empty($p['is_upcoming'])): ?>
                                        <span class="badge bg-light text-muted border rounded-pill px-2.5 py-0.5" style="font-size: 0.72rem;">
                                            <i class="fas fa-eye me-1"></i> Muestra de exhibición
                                        </span>
                                    <?php elseif ($pIsFree || $pShipCost <= 0): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-0.5" style="font-size: 0.72rem;">
                                            <i class="fas fa-truck me-1"></i> Envío Gratis
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-dark border rounded-pill px-2 py-0.5" style="font-size: 0.72rem;">
                                            <i class="fas fa-truck text-muted me-1"></i> Envío $<?= number_format($pShipCost, 0, ',', '.') ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="text-center mt-auto pt-1">
                                    <?php if (!empty($p['is_upcoming'])): ?>
                                        <span class="badge bg-dark text-white rounded-pill px-3 py-1 small fw-semibold" style="font-size: 0.75rem;">
                                            <i class="fas fa-calendar-alt me-1 text-warning"></i> Próximamente a la venta
                                        </span>
                                    <?php elseif ($pStock <= 0): ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2.5 py-1 small">Agotado</span>
                                    <?php elseif ($pStock < 10): ?>
                                        <span class="badge bg-warning-subtle text-dark border border-warning rounded-pill px-2.5 py-1 fw-bold small" style="font-size: 0.75rem;">
                                            <i class="fas fa-fire text-danger me-1"></i>¡Últimos productos! (<?= $pStock ?> disp.)
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted small" style="font-size: 0.78rem;">
                                            <i class="fas fa-check text-success me-1"></i><?= $pStock ?> disponibles
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php
                $page = isset($pagination['page']) ? (int)$pagination['page'] : 1;
                $pages = isset($pagination['pages']) ? (int)$pagination['pages'] : 1;

                // Construir base de query string manteniendo filtros y orden
                $qs = $_GET;
                unset($qs['page']);
                $baseQuery = http_build_query($qs);
            ?>

            <nav class="mt-4" aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?<?php echo $baseQuery; ?>&page=<?php echo max(1, $page - 1); ?>" tabindex="-1">Anterior</a>
                    </li>
                    <?php for ($i = 1; $i <= $pages; $i++) : ?>
                        <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?<?php echo $baseQuery; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo $page >= $pages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?<?php echo $baseQuery; ?>&page=<?php echo min($pages, $page + 1); ?>">Siguiente</a>
                    </li>
                </ul>
            </nav>

        <?php else : ?>
            <div class="text-center py-5">
                <h3 class="fw-bold mb-3">Aún no hay productos disponibles</h3>
                <p class="text-muted mb-4">Muy pronto encontrarás nuestras novedades aquí.</p>
            </div>
        <?php endif; ?>
            </div> <!-- /.products-content -->
        </div> <!-- /.catalog-layout -->
    </div>
    <style>
        /* Panel de compra profesional */
        .purchase-panel { border: 1px solid #e9ecef; background: #fcfcfd; border-radius: 10px; padding: 12px; }
        .purchase-panel .form-label { font-weight: 600; color: #333; }
        .btn-whatsapp { background: #25D366; border-color: #25D366; color: #fff; font-weight: 700; }
        .btn-whatsapp:hover { background: #1ebe5d; border-color: #1ebe5d; color: #fff; }
        .validation-msg { color: #C92A2A; }
        /* Ajuste de imagen para esqueleto: mostrar contorno completo */
        .product-card.esqueleto-card .product-image { object-fit: contain !important; }
        .product-card.esqueleto-card .image-box { background: #fff; }
        .product-card.esqueleto-card .image-wrapper { padding: 8px; }
        /* Hover flip suave en tarjetas con 2 imágenes */
        .product-card .image-box { position: relative; overflow: hidden; }
        .product-card .product-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.28s ease, transform 0.35s ease;
        }
        .product-card .product-image.front {
            opacity: 1;
            z-index: 1;
        }
        .product-card .product-image.back {
            opacity: 0;
            z-index: 2;
            pointer-events: none;
        }
        /* Solo activar flip si tiene segunda imagen (.has-back) */
        .product-card:hover .image-box.has-back .product-image.front {
            opacity: 0;
        }
        .product-card:hover .image-box.has-back .product-image.back {
            opacity: 1;
            transform: scale(1.03);
        }
        .image-box.tap-flip .product-image.front {
            opacity: 0 !important;
        }
        .image-box.tap-flip .product-image.back {
            opacity: 1 !important;
            transform: scale(1.03);
        }
    </style>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // En dispositivos táctiles: primer tap hace flip, segundo tap navega
        const isCoarse = window.matchMedia('(hover: none)').matches || window.matchMedia('(pointer: coarse)').matches;
        if (isCoarse) {
          const cards = Array.from(document.querySelectorAll('.product-card'));
          cards.forEach(card => {
            const imageBox = card.querySelector('.image-box');
            const backImg = card.querySelector('.product-image.back');
            if (!imageBox || !backImg) return; // sin imagen trasera, no aplica flip

            card.addEventListener('click', function(e) {
              const flipped = imageBox.classList.contains('tap-flip');
              if (!flipped) {
                imageBox.classList.add('tap-flip');
                e.preventDefault();
                setTimeout(() => {
                  imageBox.classList.remove('tap-flip');
                }, 3000);
              } else {
                imageBox.classList.remove('tap-flip');
              }
            }, true);
          });
        }

        // Filtros y ordenamiento
        const filterForms = Array.from(document.querySelectorAll('.filters-form'));
        const sortingForm = document.querySelector('.sorting-controls');
        const orderSelect = sortingForm ? sortingForm.querySelector('select[name="order"]') : null;

        if (orderSelect && sortingForm) {
          orderSelect.addEventListener('change', () => {
            sortingForm.submit();
          });
        }

        function attachFilterHandlers(form) {
          const catHidden = form.querySelector('#filter-category-hidden');
          const ropaChecks = Array.from(form.querySelectorAll('input[name="type[]"][data-group="textil"]'));
          const accChecks = Array.from(form.querySelectorAll('input[name="type[]"][data-group="accesorios"]'));
          function updateCategory() {
            const anyRopa = ropaChecks.some(c => c.checked);
            const anyAcc = accChecks.some(c => c.checked);
            if (anyRopa && anyAcc) {
              catHidden.value = '';
            } else if (anyRopa) {
              catHidden.value = 'textil';
            } else if (anyAcc) {
              catHidden.value = 'accesorios';
            }
          }
          if (catHidden && (ropaChecks.some(c => c.checked) || accChecks.some(c => c.checked))) {
            updateCategory();
          }
          // Manejar clic en cualquier área del botón de opción
          form.querySelectorAll('.filter-option').forEach(opt => {
            opt.addEventListener('click', function(e) {
              if (e.target && e.target.tagName.toLowerCase() === 'input') {
                return;
              }
              e.preventDefault();
              const chk = this.querySelector('input[type="checkbox"]');
              if (chk) {
                chk.checked = !chk.checked;
                chk.dispatchEvent(new Event('change', { bubbles: true }));
              }
            });
          });

          [...ropaChecks, ...accChecks].forEach(chk => {
            chk.addEventListener('change', () => {
              updateCategory();
              form.submit();
            });
          });
          form.addEventListener('submit', () => {
            updateCategory();
            if (!catHidden.value) { catHidden.removeAttribute('name'); }
          });
          const bindToggle = (hdr) => {
            const body = hdr.nextElementSibling;
            if (!body) return;
            const toggle = () => {
              const isOpen = body.classList.toggle('open');
              hdr.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
              const chev = hdr.querySelector('.chevron');
              if (chev) chev.classList.toggle('rotate', isOpen);
            };
            hdr.addEventListener('click', toggle);
            hdr.addEventListener('keydown', (e) => {
              if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggle(); }
            });
          };
          form.querySelectorAll('.filter-header').forEach(bindToggle);
        }
        filterForms.forEach(attachFilterHandlers);

        // Encabezados visibles en sidebar y overlay móvil
        const extraHeaders = Array.from(document.querySelectorAll('.filters-sidebar .filter-header, #filtersOverlay .filter-header'));
        extraHeaders.forEach(h => {
          if (!h.__boundToggle) {
            const body = h.nextElementSibling;
            if (!body) return;
            const toggle = () => {
              const isOpen = body.classList.toggle('open');
              h.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
              const chev = h.querySelector('.chevron');
              if (chev) chev.classList.toggle('rotate', isOpen);
            };
            h.addEventListener('click', toggle);
            h.addEventListener('keydown', (e) => {
              if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggle(); }
            });
            h.__boundToggle = true;
          }
        });

        // Overlays móviles
        const filtersOverlay = document.getElementById('filtersOverlay');
        const sortOverlay = document.getElementById('sortOverlay');
        const openFiltersBtn = document.getElementById('openFiltersBtn');
        const openSortBtn = document.getElementById('openSortBtn');
        function openOverlay(el){ if (el) el.setAttribute('aria-hidden','false'); }
        function closeOverlay(el){ if (el) el.setAttribute('aria-hidden','true'); }
        if (openFiltersBtn) openFiltersBtn.addEventListener('click', () => openOverlay(filtersOverlay));
        if (openSortBtn) openSortBtn.addEventListener('click', () => openOverlay(sortOverlay));
        document.querySelectorAll('.overlay .overlay-close').forEach(btn => {
          btn.addEventListener('click', () => closeOverlay(btn.closest('.overlay')));
        });
        document.querySelectorAll('.overlay').forEach(ov => {
          ov.addEventListener('click', (e) => {
            if (e.target === ov) closeOverlay(ov);
          });
        });
        document.querySelectorAll('#sortOverlay .sort-option').forEach(btn => {
          btn.addEventListener('click', () => {
            const val = btn.getAttribute('data-order');
            if (orderSelect) { orderSelect.value = val; }
            if (sortingForm) { sortingForm.submit(); }
          });
        });
      });
    </script>
</section>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>