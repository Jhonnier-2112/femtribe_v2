<?php include 'layouts/header.php'; ?>
<?php $inscribeteUrl = !empty($_SESSION['user_id']) ? '/inscribirse' : '/registro'; ?>

<!-- =========================================================================
     HERO SECTION CON CARRUSEL DE ALTO IMPACTO Y CUENTA REGRESIVA
     ========================================================================= -->
<section class="hero-slider position-relative" id="inicio">
  <!-- Carrusel de fondo -->
  <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-indicators carousel-indicators-ft">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    
    <div class="carousel-inner">
      <div class="carousel-item active" style="background-image: url('assets/img/CorreconFemtribe2.0/fondo1.png');">
        <div class="hero-overlay"></div>
      </div>
      <div class="carousel-item" style="background-image: url('assets/img/CorreconFemtribe2.0/fondo2.png');">
        <div class="hero-overlay"></div>
      </div>
      <div class="carousel-item" style="background-image: url('assets/img/CorreconFemtribe2.0/fondo3.png');">
        <div class="hero-overlay"></div>
      </div>
      <div class="carousel-item" style="background-image: url('assets/img/CorreconFemtribe2.0/fondo4.png');">
        <div class="hero-overlay"></div>
      </div>
    </div>
  </div>

  <!-- Contenido superpuesto del Hero -->
  <div class="hero-content position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
    <div class="container text-center py-4" data-aos="fade-up" data-aos-duration="1000">
      
      <!-- Badge Edición Oficial -->
      <div class="hero-badge-container mb-2">
        <span class="hero-pill-badge">
          <i class="fas fa-bolt text-accent me-2"></i>2.ª EDICIÓN OFICIAL · 2026
        </span>
      </div>

      <!-- Logo Oficial de la Carrera -->
      <div class="logo-wrapper mb-2">
        <img src="assets/img/CorreconFemtribe2.0/logocarrera2.0.png" alt="Corre Con FemTribe 2.0" class="logo-carrera img-fluid" onerror="this.src='assets/img/logocarrera.png'; this.onerror=null;">
      </div>

      <h1 class="hero-title-ft">TU CARRERA EMPIEZA EN</h1>

      <!-- Reloj Cuenta Regresiva Estilo Deportivo -->
      <div class="modern-countdown mb-4">
        <div class="modern-countdown-item">
          <span id="countdown-days" class="modern-countdown-number">00</span>
          <span class="modern-countdown-label">Días</span>
        </div>
        <div class="modern-countdown-item">
          <span id="countdown-hours" class="modern-countdown-number">00</span>
          <span class="modern-countdown-label">Horas</span>
        </div>
        <div class="modern-countdown-item">
          <span id="countdown-minutes" class="modern-countdown-number">00</span>
          <span class="modern-countdown-label">Minutos</span>
        </div>
        <div class="modern-countdown-item">
          <span id="countdown-seconds" class="modern-countdown-number">00</span>
          <span class="modern-countdown-label">Segundos</span>
        </div>
      </div>

      <!-- Botones Principales de Acción (CTAs) -->
      <div class="d-flex justify-content-center gap-3 cta-buttons-ft">
        <a href="<?= $inscribeteUrl ?>" class="btn-cta-primary inscribete-btn-link">
          <i class="fas fa-running me-2"></i>¡INSCRÍBETE AHORA!
        </a>
        <a href="/consultar" class="btn-cta-secondary">
          <i class="fas fa-search me-2"></i>CONSULTA TU INSCRIPCIÓN
        </a>
      </div>

    </div>
  </div>
</section>

<!-- =========================================================================
     TICKER DE DESTACADOS RÁPIDOS (Quick Highlights Bar)
     ========================================================================= -->
<section class="quick-highlights-bar py-3">
  <div class="container">
    <div class="row g-3 text-center align-items-center justify-content-center">
      <div class="col-6 col-md-3">
        <div class="highlight-item d-flex align-items-center justify-content-center gap-2">
          <i class="fas fa-route highlight-icon"></i>
          <span><strong>3K · 5K · 10K</strong> Distancias</span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="highlight-item d-flex align-items-center justify-content-center gap-2">
          <i class="fas fa-stopwatch highlight-icon"></i>
          <span><strong>Chip Electrónico</strong> Oficial</span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="highlight-item d-flex align-items-center justify-content-center gap-2">
          <i class="fas fa-medal highlight-icon"></i>
          <span><strong>Medalla Finisher</strong> Metal</span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="highlight-item d-flex align-items-center justify-content-center gap-2">
          <i class="fas fa-shield-alt highlight-icon"></i>
          <span><strong>Póliza Médica</strong> 100% Segura</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     SECCIÓN: ETAPAS DE INSCRIPCIÓN & PRECIOS (Estilo MMM)
     ========================================================================= -->
<section class="section-dark py-5" id="etapas">
  <div class="container py-4">
    
    <!-- Encabezado de Sección -->
    <div class="section-header text-center mb-5" data-aos="fade-up">
      <span class="section-tagline">ASEGURA TU LUGAR</span>
      <h2 class="section-title">ETAPAS DE INSCRIPCIÓN</h2>
      <p class="section-subtitle">Aprovecha la tarifa especial de preventa y no te quedes fuera de la carrera más esperada</p>
      <div class="section-divider"></div>
    </div>

    <!-- Grid de Etapas -->
    <div class="row g-4 justify-content-center">
      
      <!-- Etapa 1: Preventa Activa -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="stage-card stage-active">
          <div class="stage-badge-status">
            <span class="status-pulse-dot"></span> ¡ETAPA ACTIVA!
          </div>
          <div class="stage-header">
            <h3 class="stage-name">ETAPA 1 · PREVENTA</h3>
            <span class="stage-tag">Early Bird · Cupos Limitados</span>
          </div>
          <div class="stage-price-box">
            <span class="stage-currency">$</span>
            <span class="stage-price">85.000</span>
            <span class="stage-period">COP</span>
          </div>
          <ul class="stage-features">
            <li><i class="fas fa-check-circle text-accent"></i> Camiseta técnica oficial 2.0</li>
            <li><i class="fas fa-check-circle text-accent"></i> Medalla finisher de colección</li>
            <li><i class="fas fa-check-circle text-accent"></i> Chip de cronometraje & número</li>
            <li><i class="fas fa-check-circle text-accent"></i> Tula deportiva + kit de regalos</li>
            <li><i class="fas fa-check-circle text-accent"></i> Hidratación y póliza médica</li>
          </ul>
          <div class="stage-cta mt-4">
            <a href="<?= $inscribeteUrl ?>" class="btn-stage-primary w-100 inscribete-btn-link">
              <i class="fas fa-bolt me-2"></i>Inscribirme en Preventa
            </a>
          </div>
        </div>
      </div>

      <!-- Etapa 2: Ordinaria -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="stage-card stage-upcoming">
          <div class="stage-badge-status status-upcoming">
            PRÓXIMAMENTE
          </div>
          <div class="stage-header">
            <h3 class="stage-name">ETAPA 2 · ORDINARIA</h3>
            <span class="stage-tag">Tarifa Regular</span>
          </div>
          <div class="stage-price-box">
            <span class="stage-currency">$</span>
            <span class="stage-price">100.000</span>
            <span class="stage-period">COP</span>
          </div>
          <ul class="stage-features">
            <li><i class="fas fa-check-circle text-accent"></i> Camiseta técnica oficial 2.0</li>
            <li><i class="fas fa-check-circle text-accent"></i> Medalla finisher de colección</li>
            <li><i class="fas fa-check-circle text-accent"></i> Chip de cronometraje & número</li>
            <li><i class="fas fa-check-circle text-accent"></i> Tula deportiva + kit de regalos</li>
            <li><i class="fas fa-check-circle text-accent"></i> Hidratación y póliza médica</li>
          </ul>
          <div class="stage-cta mt-4">
            <button class="btn-stage-disabled w-100" disabled>
              Disponible al agotar Etapa 1
            </button>
          </div>
        </div>
      </div>

      <!-- Etapa 3: Extraordinaria -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="stage-card stage-upcoming">
          <div class="stage-badge-status status-upcoming">
            ÚLTIMOS CUPOS
          </div>
          <div class="stage-header">
            <h3 class="stage-name">ETAPA 3 · CIERRE</h3>
            <span class="stage-tag">Sujeto a disponibilidad</span>
          </div>
          <div class="stage-price-box">
            <span class="stage-currency">$</span>
            <span class="stage-price">120.000</span>
            <span class="stage-period">COP</span>
          </div>
          <ul class="stage-features">
            <li><i class="fas fa-check-circle text-accent"></i> Camiseta técnica oficial 2.0</li>
            <li><i class="fas fa-check-circle text-accent"></i> Medalla finisher de colección</li>
            <li><i class="fas fa-check-circle text-accent"></i> Chip de cronometraje & número</li>
            <li><i class="fas fa-check-circle text-accent"></i> Tula deportiva + kit de regalos</li>
            <li><i class="fas fa-check-circle text-accent"></i> Hidratación y póliza médica</li>
          </ul>
          <div class="stage-cta mt-4">
            <button class="btn-stage-disabled w-100" disabled>
              Etapa Final
            </button>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================================================================
     SECCIÓN: DISTANCIAS & MODALIDADES (Tarjetas Póster 3K, 5K, 10K)
     ========================================================================= -->
<section class="section-distances py-5" id="distancias">
  <div class="container py-4">
    
    <!-- Encabezado de Sección -->
    <div class="section-header text-center mb-5" data-aos="fade-up">
      <span class="section-tagline">ELIGE TU RETO</span>
      <h2 class="section-title">DISTANCIAS OFICIALES</h2>
      <p class="section-subtitle">Diseñadas para todos los niveles: desde principiantes y familias hasta corredores élite</p>
      <div class="section-divider"></div>
    </div>

    <!-- Grid de Tarjetas de Distancias -->
    <div class="row g-4 justify-content-center">
      
      <!-- 3K Recreativa -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="distance-poster-card" style="background-image: url('assets/img/CorreconFemtribe2.0/tarjeta3k.png');">
          <div class="distance-poster-overlay"></div>
          <div class="distance-poster-content">
            <div class="distance-badge-pill">3K RECREATIVA</div>
            <h3 class="distance-card-title">Ruta Familiar & Amigos</h3>
            <p class="distance-card-desc">Perfecta para caminar, trotar a tu propio ritmo y disfrutar en tribu o con tu mascota.</p>
            <div class="distance-specs-grid">
              <div class="spec-chip"><i class="fas fa-clock text-accent"></i> 7:30 AM</div>
              <div class="spec-chip"><i class="fas fa-mountain text-accent"></i> Terreno Plano</div>
              <div class="spec-chip"><i class="fas fa-paw text-accent"></i> Pet Friendly</div>
            </div>
            <a href="<?= $inscribeteUrl ?>" class="btn-distance-action inscribete-btn-link">
              Inscribirme 3K <i class="fas fa-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- 5K Competitiva -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="distance-poster-card featured-distance" style="background-image: url('assets/img/CorreconFemtribe2.0/tarjeta5k.png');">
          <div class="distance-poster-overlay"></div>
          <div class="popular-ribbon"><i class="fas fa-fire me-1"></i> MÁS POPULAR</div>
          <div class="distance-poster-content">
            <div class="distance-badge-pill badge-featured">5K COMPETITIVA</div>
            <h3 class="distance-card-title">Ritmo & Velocidad</h3>
            <p class="distance-card-desc">El reto intermedio para superar tu marca personal con cronometraje electrónico y pacers.</p>
            <div class="distance-specs-grid">
              <div class="spec-chip"><i class="fas fa-clock text-accent"></i> 7:00 AM</div>
              <div class="spec-chip"><i class="fas fa-microchip text-accent"></i> Chip Oficial</div>
              <div class="spec-chip"><i class="fas fa-trophy text-accent"></i> Con Premiación</div>
            </div>
            <a href="<?= $inscribeteUrl ?>" class="btn-distance-action inscribete-btn-link">
              Inscribirme 5K <i class="fas fa-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- 10K Reto Máximo -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="distance-poster-card" style="background-image: url('assets/img/CorreconFemtribe2.0/tarjeta10k.png');">
          <div class="distance-poster-overlay"></div>
          <div class="distance-poster-content">
            <div class="distance-badge-pill">10K RETO MÁXIMO</div>
            <h3 class="distance-card-title">Alta Exigencia Élite</h3>
            <p class="distance-card-desc">Para corredores experimentados que buscan conquistar el circuito completo y el podio general.</p>
            <div class="distance-specs-grid">
              <div class="spec-chip"><i class="fas fa-clock text-accent"></i> 6:30 AM</div>
              <div class="spec-chip"><i class="fas fa-tachometer-alt text-accent"></i> Altimetría Pro</div>
              <div class="spec-chip"><i class="fas fa-medal text-accent"></i> Premios en Dinero</div>
            </div>
            <a href="<?= $inscribeteUrl ?>" class="btn-distance-action inscribete-btn-link">
              Inscribirme 10K <i class="fas fa-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================================================================
     SECCIÓN: LA EXPERIENCIA & VIDEO SHOWCASE + ESTADÍSTICAS
     ========================================================================= -->
<section class="section-experience py-5 position-relative overflow-hidden" id="experiencia">
  <div class="container py-4">
    <div class="row align-items-center g-5">
      
      <!-- Columna Izquierda: Texto Descriptivo y Métricas -->
      <div class="col-lg-6" data-aos="fade-right">
        <span class="section-tagline">LA EXPERIENCIA</span>
        <h2 class="section-title text-start mb-3">MUCHO MÁS QUE UNA CARRERA</h2>
        <p class="lead-ft text-light mb-4">
          Corre Con FemTribe 2.0 es una fiesta deportiva que reúne la pasión del running, la calidez de nuestra comunidad y los hermosos paisajes de Ricaurte, Cundinamarca.
        </p>
        <p class="text-muted mb-4">
          Una ruta pensada para tu seguridad y máximo disfrute, con puntos de hidratación estratégicos, música en vivo, acompañamiento de pacers certificados y una energía inigualable de principio a fin.
        </p>

        <!-- Métricas / Contadores Rápidos -->
        <div class="row g-3 text-center video-stats mb-4">
          <div class="col-6 col-sm-3">
            <div class="stat-card">
              <i class="fas fa-users text-accent mb-2"></i>
              <h4 class="stat-number">600+</h4>
              <p class="stat-label">Corredores</p>
            </div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="stat-card">
              <i class="fas fa-route text-accent mb-2"></i>
              <h4 class="stat-number">3</h4>
              <p class="stat-label">Distancias</p>
            </div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="stat-card">
              <i class="fas fa-gift text-accent mb-2"></i>
              <h4 class="stat-number">20+</h4>
              <p class="stat-label">Premios</p>
            </div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="stat-card">
              <i class="fas fa-heartbeat text-accent mb-2"></i>
              <h4 class="stat-number">100%</h4>
              <p class="stat-label">Segura</p>
            </div>
          </div>
        </div>

        <div class="d-flex flex-wrap gap-3">
          <a href="<?= $inscribeteUrl ?>" class="btn-cta-primary inscribete-btn-link">
            <i class="fas fa-running me-2"></i>Asegurar Mi Cupo
          </a>
          <a href="#kit" class="btn-cta-outline">
            <i class="fas fa-box-open me-2"></i>Ver Kit Oficial
          </a>
        </div>
      </div>

      <!-- Columna Derecha: Reproductor de Video Showcase -->
      <div class="col-lg-6" data-aos="fade-left">
        <div class="video-container-card position-relative rounded-4 overflow-hidden shadow-2xl">
          <div class="video-wrapper">
            <video 
              id="femtribeVideo" 
              class="w-100 rounded-4" 
              poster="assets/img/CorreconFemtribe2.0/fondo1.png"
              preload="metadata"
              playsinline>
              <source src="assets/videos/video.mp4" type="video/mp4">
              <source src="assets/videos/video.webm" type="video/webm">
              Tu navegador no soporta video HTML5.
            </video>
            
            <!-- Botón flotante Play -->
            <div class="play-button-overlay position-absolute top-50 start-50 translate-middle" id="playButtonOverlay">
              <button class="custom-play-btn" onclick="playVideo()" aria-label="Reproducir video">
                <i class="fas fa-play"></i>
              </button>
            </div>

            <!-- Badge Video -->
            <div class="video-live-badge position-absolute top-0 start-0 m-3">
              <i class="fas fa-play-circle me-1"></i> VIDEO OFICIAL
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================================================================
     SECCIÓN: EL KIT OFICIAL DEL CORREDOR
     ========================================================================= -->
<section class="section-kit py-5" id="kit">
  <div class="container py-4">
    
    <!-- Encabezado de Sección -->
    <div class="section-header text-center mb-5" data-aos="fade-up">
      <span class="section-tagline">EQUIPAMIENTO PRO</span>
      <h2 class="section-title">EL KIT DEL CORREDOR</h2>
      <p class="section-subtitle">Todo lo que recibirás con tu inscripción oficial a Corre Con FemTribe 2.0</p>
      <div class="section-divider"></div>
    </div>

    <!-- Grid de Elementos del Kit -->
    <div class="row g-4 justify-content-center">
      
      <!-- Item 1: Camiseta -->
      <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
        <div class="kit-item-card">
          <div class="kit-icon-box">
            <i class="fas fa-tshirt"></i>
          </div>
          <h4 class="kit-item-title">Camiseta Oficial Técnica</h4>
          <p class="kit-item-desc">Tejido ultraligero con tecnología Dry-Fit, máxima transpirabilidad y diseño conmemorativo 2.0.</p>
          <span class="kit-item-tag">Tallas Adultos y Niños</span>
        </div>
      </div>

      <!-- Item 2: Medalla Finisher -->
      <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
        <div class="kit-item-card">
          <div class="kit-icon-box">
            <i class="fas fa-medal"></i>
          </div>
          <h4 class="kit-item-title">Medalla Finisher Metálica</h4>
          <p class="kit-item-desc">Diseño exclusivo en relieve troquelado con cinta sublimada para todos los que crucen la meta.</p>
          <span class="kit-item-tag">100% de Finalistas</span>
        </div>
      </div>

      <!-- Item 3: Chip y Dorsal -->
      <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
        <div class="kit-item-card">
          <div class="kit-icon-box">
            <i class="fas fa-id-badge"></i>
          </div>
          <h4 class="kit-item-title">Número con Chip Oficial</h4>
          <p class="kit-item-desc">Dorsal personalizado e impermeable con sensor electrónico para cronometraje de alta precisión.</p>
          <span class="kit-item-tag">Tiempos en Vivo</span>
        </div>
      </div>

      <!-- Item 4: Tula Deportiva -->
      <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
        <div class="kit-item-card">
          <div class="kit-icon-box">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <h4 class="kit-item-title">Tula Deportiva Oficial</h4>
          <p class="kit-item-desc">Bolsa tula ergonómica, impermeable y de alta resistencia para transportar tu kit y objetos personales.</p>
          <span class="kit-item-tag">Edición Limitada</span>
        </div>
      </div>

      <!-- Item 5: Hidratación y Nutrición -->
      <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="500">
        <div class="kit-item-card">
          <div class="kit-icon-box">
            <i class="fas fa-tint"></i>
          </div>
          <h4 class="kit-item-title">Puntos de Hidratación</h4>
          <p class="kit-item-desc">Agua y bebidas isotónicas en ruta y zona de meta, además de refrigerio de recuperación energética.</p>
          <span class="kit-item-tag">Ruta & Meta</span>
        </div>
      </div>

      <!-- Item 6: Póliza y Asistencia -->
      <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="600">
        <div class="kit-item-card">
          <div class="kit-icon-box">
            <i class="fas fa-ambulance"></i>
          </div>
          <h4 class="kit-item-title">Póliza Médica y Seguridad</h4>
          <p class="kit-item-desc">Seguro individual de accidentes personales, ambulancias medicalizadas y carpa de primeros auxilios.</p>
          <span class="kit-item-tag">Cobertura Total</span>
        </div>
      </div>

    </div>

    <!-- Botón CTA debajo del kit -->
    <div class="text-center mt-5" data-aos="fade-up">
      <a href="<?= $inscribeteUrl ?>" class="btn-cta-primary inscribete-btn-link px-5 py-3">
        <i class="fas fa-check-circle me-2"></i>¡Quiero Mi Kit Oficial!
      </a>
    </div>
  </div>
</section>

<!-- =========================================================================
     MÓDULO: CONSULTA RÁPIDA DE INSCRIPCIÓN (Validador en Vivo)
     ========================================================================= -->
<section class="section-validator py-5 position-relative" id="valida">
  <div class="container py-3">
    <div class="validator-box mx-auto p-4 p-md-5 rounded-4 shadow-2xl" data-aos="fade-up">
      <div class="row align-items-center g-4">
        
        <div class="col-lg-7 text-center text-lg-start">
          <div class="d-inline-flex align-items-center gap-2 mb-2">
            <span class="validator-badge"><i class="fas fa-search me-1"></i> ESTADO EN TIEMPO REAL</span>
          </div>
          <h3 class="validator-title">¿Ya te inscribiste? Valida tu registro aquí</h3>
          <p class="validator-desc mb-0">Consulta al instante tu confirmación, categoría, distancia asignada y comprobante oficial de carrera.</p>
        </div>

        <div class="col-lg-5 text-center text-lg-end">
          <a href="/consultar" class="btn-validator-action">
            <i class="fas fa-id-card me-2"></i>Consultar Mi Cédula
          </a>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     SECCIÓN: RECORRIDOS, SERVICIOS Y ALTIMETRÍA
     ========================================================================= -->
<section class="section-dark py-5" id="recorridos">
  <div class="container py-4">
    
    <!-- Encabezado de Sección -->
    <div class="section-header text-center mb-5" data-aos="fade-up">
      <span class="section-tagline">CIRCUITO OFICIAL</span>
      <h2 class="section-title">RECORRIDO Y SERVICIOS EN RUTA</h2>
      <p class="section-subtitle">Conoce los detalles técnicos del circuito diseñado por los lugares más emblemáticos de Ricaurte</p>
      <div class="section-divider"></div>
    </div>

    <!-- Pestañas de Distancias -->
    <div class="route-tabs-container mb-4 text-center" data-aos="fade-up">
      <div class="nav nav-pills justify-content-center gap-2" id="route-pills-tab" role="tablist">
        <button class="nav-link active route-tab-btn" id="route-3k-tab" data-bs-toggle="pill" data-bs-target="#route-3k" type="button" role="tab">
          Circuito 3K
        </button>
        <button class="nav-link route-tab-btn" id="route-5k-tab" data-bs-toggle="pill" data-bs-target="#route-5k" type="button" role="tab">
          Circuito 5K
        </button>
        <button class="nav-link route-tab-btn" id="route-10k-tab" data-bs-toggle="pill" data-bs-target="#route-10k" type="button" role="tab">
          Circuito 10K
        </button>
      </div>
    </div>

    <!-- Contenido de las pestañas -->
    <div class="tab-content" id="route-pills-tabContent">
      
      <!-- 3K -->
      <div class="tab-pane fade show active" id="route-3k" role="tabpanel">
        <div class="route-card-box p-4 p-md-5 rounded-4">
          <div class="row align-items-center g-4">
            <div class="col-lg-6">
              <span class="badge-accent mb-2">3K · RECREATIVO</span>
              <h3 class="text-white fw-bold mb-3">Circuito Urbano y Malecón</h3>
              <p class="text-light text-opacity-80">Ruta 100% plana sobre asfalto pavimentado. Inicia en el Parque Principal de Ricaurte, recorre las avenidas arborizadas y finaliza en la meta principal con música y animación.</p>
              <div class="route-feature-list">
                <div class="feature-row"><i class="fas fa-map-pin text-accent me-2"></i> <strong>Salida y Meta:</strong> Parque Principal de Ricaurte</div>
                <div class="feature-row"><i class="fas fa-tint text-accent me-2"></i> <strong>Hidratación:</strong> Km 1.5 y Meta</div>
                <div class="feature-row"><i class="fas fa-clock text-accent me-2"></i> <strong>Tiempo Límite:</strong> 1 hora 15 minutos</div>
              </div>
            </div>
            <div class="col-lg-6 text-center">
              <div class="route-preview-placeholder">
                <i class="fas fa-map-marked-alt text-accent fa-4x mb-3"></i>
                <h5 class="text-white">Altimetría y Mapa 3K</h5>
                <p class="text-muted small">Desnivel positivo: +15m · Terreno regular de baja exigencia</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 5K -->
      <div class="tab-pane fade" id="route-5k" role="tabpanel">
        <div class="route-card-box p-4 p-md-5 rounded-4">
          <div class="row align-items-center g-4">
            <div class="col-lg-6">
              <span class="badge-accent mb-2">5K · COMPETITIVO</span>
              <h3 class="text-white fw-bold mb-3">Circuito de Velocidad y Ritmo</h3>
              <p class="text-light text-opacity-80">Trazado homologado de velocidad rápida con pacers guía a 4:30, 5:00, 5:30 y 6:00 min/km. Excelente visibilidad y señalización en cada kilómetro.</p>
              <div class="route-feature-list">
                <div class="feature-row"><i class="fas fa-map-pin text-accent me-2"></i> <strong>Salida y Meta:</strong> Parque Principal de Ricaurte</div>
                <div class="feature-row"><i class="fas fa-tint text-accent me-2"></i> <strong>Hidratación:</strong> Km 2.5, Km 4 y Meta</div>
                <div class="feature-row"><i class="fas fa-stopwatch text-accent me-2"></i> <strong>Cronometraje:</strong> Puntos de control intermedio</div>
              </div>
            </div>
            <div class="col-lg-6 text-center">
              <div class="route-preview-placeholder">
                <i class="fas fa-running text-accent fa-4x mb-3"></i>
                <h5 class="text-white">Altimetría y Mapa 5K</h5>
                <p class="text-muted small">Desnivel positivo: +32m · Acompañamiento de Pacemakers</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 10K -->
      <div class="tab-pane fade" id="route-10k" role="tabpanel">
        <div class="route-card-box p-4 p-md-5 rounded-4">
          <div class="row align-items-center g-4">
            <div class="col-lg-6">
              <span class="badge-accent mb-2">10K · RETO MÁXIMO</span>
              <h3 class="text-white fw-bold mb-3">Circuito Élite Dos Vueltas</h3>
              <p class="text-light text-opacity-80">El mayor desafío del evento. Circuito ampliado con tramos de velocidad y falso plano que pondrán a prueba tu resistencia aeróbica.</p>
              <div class="route-feature-list">
                <div class="feature-row"><i class="fas fa-map-pin text-accent me-2"></i> <strong>Salida y Meta:</strong> Parque Principal de Ricaurte</div>
                <div class="feature-row"><i class="fas fa-tint text-accent me-2"></i> <strong>Hidratación:</strong> Km 2.5, Km 5, Km 7.5 y Meta</div>
                <div class="feature-row"><i class="fas fa-trophy text-accent me-2"></i> <strong>Categorías:</strong> Abierta, Máster A y Máster B</div>
              </div>
            </div>
            <div class="col-lg-6 text-center">
              <div class="route-preview-placeholder">
                <i class="fas fa-trophy text-accent fa-4x mb-3"></i>
                <h5 class="text-white">Altimetría y Mapa 10K</h5>
                <p class="text-muted small">Desnivel positivo: +65m · Premiación oficial en podio</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================================================================
     SECCIÓN: PREMIACIÓN Y RECONOCIMIENTOS
     ========================================================================= -->
<section class="section-premios py-5" id="premiacion">
  <div class="container py-4">
    
    <!-- Encabezado de Sección -->
    <div class="section-header text-center mb-5" data-aos="fade-up">
      <span class="section-tagline">RECONOCIMIENTO AL ESFUERZO</span>
      <h2 class="section-title">PREMIACIÓN Y RECONOCIMIENTOS</h2>
      <p class="section-subtitle">Premiamos a los mejores tiempos de la jornada y celebramos el coraje de cada participante</p>
      <div class="section-divider"></div>
    </div>

    <!-- Grid de Premiación -->
    <div class="row g-4 justify-content-center">
      
      <!-- 1er Lugar -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="award-card award-gold">
          <div class="award-trophy-icon">
            <i class="fas fa-trophy"></i>
          </div>
          <span class="award-position">1.ER PUESTO</span>
          <h3 class="award-title">Campeones Generales</h3>
          <p class="award-desc">Trofeo oficial de campeón + Bonos en efectivo y regalos de marcas patrocinadoras.</p>
          <div class="award-pill">Rama Femenina & Masculina</div>
        </div>
      </div>

      <!-- 2do Lugar -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="award-card award-silver">
          <div class="award-trophy-icon">
            <i class="fas fa-medal"></i>
          </div>
          <span class="award-position">2.° Y 3.ER PUESTO</span>
          <h3 class="award-title">Podio de Honor</h3>
          <p class="award-desc">Trofeos de podio + Kits de productos deportivos y bonos de regalo aliados.</p>
          <div class="award-pill">Todas las Distancias</div>
        </div>
      </div>

      <!-- Medalla Finisher -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="award-card award-finisher">
          <div class="award-trophy-icon">
            <i class="fas fa-ribbon"></i>
          </div>
          <span class="award-position">100% PARTICIPANTES</span>
          <h3 class="award-title">Medalla Finisher</h3>
          <p class="award-desc">Medalla oficial de colección entregada inmediatamente al cruzar el arco de meta.</p>
          <div class="award-pill">Para Toda la Tribu</div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================================================================
     SECCIÓN: PATROCINADORES Y ALIADOS OFICIALES
     ========================================================================= -->
<section class="section-sponsors py-5" id="patrocinadores">
  <div class="container py-4">
    
    <div class="section-header text-center mb-5" data-aos="fade-up">
      <span class="section-tagline">NUESTROS ALIADOS</span>
      <h2 class="section-title">PATROCINADORES OFICIALES</h2>
      <p class="section-subtitle">Marcas e instituciones que hacen posible la gran fiesta de Corre Con FemTribe 2.0</p>
      <div class="section-divider"></div>
    </div>

    <!-- Grilla de Logos de Patrocinadores -->
    <div class="row g-4 align-items-center justify-content-center text-center">
      
      <div class="col-6 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="100">
        <div class="sponsor-logo-box">
          <img src="assets/img/ricaurte.png" alt="Alcaldía de Ricaurte" class="img-fluid sponsor-logo" onerror="this.style.display='none'">
          <span class="sponsor-name-fallback">RICAURTE</span>
        </div>
      </div>

      <div class="col-6 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="200">
        <div class="sponsor-logo-box">
          <img src="assets/img/femtribe_verde.png" alt="FemTribe Running" class="img-fluid sponsor-logo">
        </div>
      </div>

      <div class="col-6 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="300">
        <div class="sponsor-logo-box">
          <i class="fas fa-bolt text-accent fa-2x mb-2"></i>
          <span class="d-block fw-bold text-white small">GATORADE</span>
        </div>
      </div>

      <div class="col-6 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="400">
        <div class="sponsor-logo-box">
          <i class="fas fa-heartbeat text-accent fa-2x mb-2"></i>
          <span class="d-block fw-bold text-white small">CLÍNICA SALUD</span>
        </div>
      </div>

      <div class="col-6 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="500">
        <div class="sponsor-logo-box">
          <i class="fas fa-shoe-prints text-accent fa-2x mb-2"></i>
          <span class="d-block fw-bold text-white small">RUNNER STORE</span>
        </div>
      </div>

      <div class="col-6 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="600">
        <div class="sponsor-logo-box">
          <i class="fas fa-tint text-accent fa-2x mb-2"></i>
          <span class="d-block fw-bold text-white small">AGUA PURA</span>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================================================================
     SECCIÓN: PREGUNTAS FRECUENTES (FAQ ACORDEÓN)
     ========================================================================= -->
<section class="section-faq py-5" id="faq">
  <div class="container py-4">
    
    <div class="section-header text-center mb-5" data-aos="fade-up">
      <span class="section-tagline">RESOLVEMOS TUS DUDAS</span>
      <h2 class="section-title">PREGUNTAS FRECUENTES</h2>
      <p class="section-subtitle">Todo lo que necesitas saber antes del gran día de la carrera</p>
      <div class="section-divider"></div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8" data-aos="fade-up">
        <div class="accordion custom-dark-accordion" id="faqAccordion">
          
          <!-- Pregunta 1 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-box-open me-3 text-accent"></i> ¿Dónde y cuándo se realiza la entrega de kits?
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                La entrega de kits se llevará a cabo los días previos a la carrera en la Expo Runner FemTribe. Debes presentar tu cédula de ciudadanía original o el comprobante de inscripción que puedes descargar desde esta misma plataforma.
              </div>
            </div>
          </div>

          <!-- Pregunta 2 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <i class="fas fa-paw me-3 text-accent"></i> ¿Puedo participar con mi mascota o con niños pequeños?
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                ¡Sí! La distancia <strong>3K Recreativa</strong> es 100% familiar y Pet Friendly. Los niños menores de 12 años deben estar acompañados por un adulto responsable debidamente inscrito.
              </div>
            </div>
          </div>

          <!-- Pregunta 3 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <i class="fas fa-check-circle me-3 text-accent"></i> ¿Cómo confirmo que mi pago e inscripción fueron exitosos?
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Una vez completado el pago a través de Wompi (PSE, Tarjeta de Crédito, Nequi, etc.), recibirás un correo electrónico de confirmación. Además, puedes verificar en cualquier momento tu estado en la sección <a href="/consultar" class="text-accent fw-bold">Consulta Tu Inscripción</a> ingresando tu número de documento.
              </div>
            </div>
          </div>

          <!-- Pregunta 4 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <i class="fas fa-exchange-alt me-3 text-accent"></i> ¿Puedo transferir mi inscripción a otra persona?
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Los cambios o cesiones de cupo se permiten hasta 15 días calendario antes del evento, contactando al equipo organizador a través de nuestros canales oficiales o soporte de WhatsApp.
              </div>
            </div>
          </div>

          <!-- Pregunta 5 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                <i class="fas fa-tshirt me-3 text-accent"></i> ¿Qué talla de camiseta debo elegir?
              </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                En el formulario de inscripción dispondrás de la tabla de medidas exacta en centímetros para silueta dama, caballero y niños. Te recomendamos verificarla para asegurar tu talla ideal.
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     BANNER FINAL CTA: ÚNETE A LA TRIBU
     ========================================================================= -->
<section class="section-final-cta py-5 position-relative text-center overflow-hidden">
  <div class="final-cta-overlay"></div>
  <div class="container py-5 position-relative" style="z-index: 2;" data-aos="zoom-in">
    <div class="col-lg-8 mx-auto">
      <span class="badge-ft-pill mb-3"><i class="fas fa-fire text-accent me-2"></i>CUPOS LIMITADOS</span>
      <h2 class="display-5 fw-black text-white mb-3">¿ESTÁS LISTO PARA VIVIR LA EXPERIENCIA?</h2>
      <p class="lead text-light text-opacity-90 mb-4">
        No dejes pasar la oportunidad de correr, disfrutar y celebrar en comunidad. ¡Inscríbete hoy y asegura tu kit oficial con precio de preventa!
      </p>
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="<?= $inscribeteUrl ?>" class="btn-cta-primary btn-lg px-5 py-3 inscribete-btn-link">
          <i class="fas fa-running me-2"></i>¡INSCRIBIRME AHORA!
        </a>
        <a href="/consultar" class="btn-cta-secondary btn-lg px-5 py-3">
          <i class="fas fa-search me-2"></i>Validar Mi Inscripción
        </a>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     ESTILOS ESPECÍFICOS DEL HOME (PALETA: NEGROS, BLANCOS Y VERDES LIMA)
     ========================================================================= -->
<style>
/* --- VARIABLES Y CONFIGURACIÓN GLOBAL --- */
:root {
  --ft-bg-black: #0d0d10;
  --ft-bg-dark: #131317;
  --ft-bg-card: #1c1c22;
  --ft-bg-card-hover: #24242c;
  --ft-green-accent: #B2D81F;
  --ft-green-primary: #87CC3E;
  --ft-green-dark: #6ba829;
  --ft-white: #ffffff;
  --ft-gray-light: #e4e4e7;
  --ft-gray-muted: #9ca3af;
  --ft-border-subtle: rgba(255, 255, 255, 0.08);
  --ft-border-green: rgba(178, 216, 31, 0.35);
  --ft-glow-green: 0 0 25px rgba(178, 216, 31, 0.35);
}

body {
  background-color: var(--ft-bg-black) !important;
  color: var(--ft-gray-light) !important;
  font-family: 'Montserrat', sans-serif !important;
}

.text-accent {
  color: var(--ft-green-accent) !important;
}

/* --- HERO SECTION --- */
.hero-slider {
  min-height: 100vh;
  position: relative;
  background-color: var(--ft-bg-black);
  overflow: hidden;
}

.hero-slider .carousel-item {
  height: 100vh;
  min-height: 650px;
  background-size: cover;
  background-position: center;
}

.hero-overlay {
  position: absolute;
  top: 0; left: 0; width: 100%; height: 100%;
  background: linear-gradient(
    180deg, 
    rgba(13, 13, 16, 0.6) 0%, 
    rgba(13, 13, 16, 0.8) 50%, 
    rgba(13, 13, 16, 0.98) 100%
  );
}

.hero-content {
  z-index: 10;
  padding-top: 5rem;
}

.hero-pill-badge {
  display: inline-flex;
  align-items: center;
  background: rgba(178, 216, 31, 0.12);
  border: 1px solid var(--ft-border-green);
  color: var(--ft-white);
  padding: 0.45rem 1.2rem;
  border-radius: 50px;
  font-size: 0.85rem;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  backdrop-filter: blur(10px);
}

.logo-carrera {
  max-height: 320px;
  width: auto;
  filter: drop-shadow(0 8px 24px rgba(0,0,0,0.7));
  transition: transform 0.3s ease;
}

.logo-carrera:hover {
  transform: scale(1.02);
}

.hero-title-ft {
  font-size: 1.9rem;
  font-weight: 900;
  color: var(--ft-white);
  letter-spacing: 3px;
  text-transform: uppercase;
  text-shadow: 0 4px 15px rgba(0,0,0,0.8);
  margin-bottom: 1.2rem;
}

/* --- CUENTA REGRESIVA --- */
.modern-countdown {
  display: flex;
  justify-content: center;
  gap: 14px;
  flex-wrap: wrap;
}

.modern-countdown-item {
  background: rgba(28, 28, 34, 0.85);
  border: 2px solid var(--ft-border-green);
  border-radius: 16px;
  padding: 0.9rem 1.4rem;
  min-width: 105px;
  backdrop-filter: blur(12px);
  box-shadow: 0 10px 30px rgba(0,0,0,0.4), var(--ft-glow-green);
  transition: transform 0.25s ease, border-color 0.25s ease;
}

.modern-countdown-item:hover {
  transform: translateY(-4px);
  border-color: var(--ft-green-accent);
}

.modern-countdown-number {
  font-size: 2.8rem;
  font-weight: 900;
  color: var(--ft-green-accent);
  line-height: 1;
  display: block;
  font-family: 'Montserrat', sans-serif;
  text-shadow: 0 2px 10px rgba(178, 216, 31, 0.4);
}

.modern-countdown-label {
  font-size: 0.8rem;
  font-weight: 700;
  color: var(--ft-white);
  text-transform: uppercase;
  letter-spacing: 1.8px;
  margin-top: 0.4rem;
  display: block;
}

/* --- BOTONES CTA DE ALTO IMPACTO --- */
.btn-cta-primary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, var(--ft-green-accent) 0%, var(--ft-green-primary) 100%);
  color: #000000 !important;
  font-weight: 900;
  font-size: 0.95rem;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  padding: 0.95rem 2.4rem;
  border-radius: 50px;
  border: none;
  text-decoration: none;
  box-shadow: 0 6px 20px rgba(178, 216, 31, 0.4);
  transition: all 0.25s cubic-bezier(0.2, 0.8, 0.2, 1);
}

.btn-cta-primary:hover {
  background: linear-gradient(135deg, #c4ed23 0%, var(--ft-green-accent) 100%);
  transform: translateY(-3px) scale(1.02);
  box-shadow: 0 10px 30px rgba(178, 216, 31, 0.6);
  color: #000000 !important;
}

.btn-cta-secondary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: rgba(255, 255, 255, 0.06);
  color: var(--ft-white) !important;
  font-weight: 700;
  font-size: 0.95rem;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  padding: 0.95rem 2.2rem;
  border-radius: 50px;
  border: 2px solid rgba(255, 255, 255, 0.7);
  text-decoration: none;
  backdrop-filter: blur(10px);
  transition: all 0.25s ease;
}

.btn-cta-secondary:hover {
  background: rgba(255, 255, 255, 0.15);
  border-color: var(--ft-green-accent);
  color: var(--ft-green-accent) !important;
  transform: translateY(-3px);
}

.btn-cta-outline {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: transparent;
  color: var(--ft-white) !important;
  font-weight: 700;
  padding: 0.9rem 2rem;
  border-radius: 50px;
  border: 2px solid var(--ft-border-green);
  text-decoration: none;
  transition: all 0.25s ease;
}

.btn-cta-outline:hover {
  background: rgba(178, 216, 31, 0.1);
  border-color: var(--ft-green-accent);
  color: var(--ft-green-accent) !important;
}

/* Indicadores de carrusel */
.carousel-indicators-ft {
  margin-bottom: 2rem;
}

.carousel-indicators-ft [data-bs-target] {
  width: 45px;
  height: 5px;
  border-radius: 4px;
  background-color: rgba(255, 255, 255, 0.4);
  border: none;
  transition: all 0.3s ease;
}

.carousel-indicators-ft .active {
  width: 75px;
  background-color: var(--ft-green-accent);
  box-shadow: var(--ft-glow-green);
}

/* --- QUICK HIGHLIGHTS BAR --- */
.quick-highlights-bar {
  background: #111115;
  border-top: 1px solid var(--ft-border-green);
  border-bottom: 1px solid var(--ft-border-subtle);
}

.highlight-item {
  color: var(--ft-gray-light);
  font-size: 0.9rem;
}

.highlight-icon {
  color: var(--ft-green-accent);
  font-size: 1.25rem;
}

/* --- SECCIONES COMUNES --- */
.section-dark {
  background-color: var(--ft-bg-dark);
}

.section-distances {
  background: linear-gradient(180deg, var(--ft-bg-dark) 0%, var(--ft-bg-black) 100%);
}

.section-experience {
  background-color: var(--ft-bg-black);
}

.section-kit {
  background: linear-gradient(180deg, var(--ft-bg-black) 0%, var(--ft-bg-dark) 100%);
}

.section-validator {
  background-color: var(--ft-bg-dark);
}

.section-premios {
  background-color: var(--ft-bg-black);
}

.section-sponsors {
  background-color: #0f0f13;
}

.section-faq {
  background-color: var(--ft-bg-dark);
}

/* Encabezados de Sección */
.section-header {
  max-width: 750px;
  margin: 0 auto;
}

.section-tagline {
  color: var(--ft-green-accent);
  font-size: 0.85rem;
  font-weight: 800;
  letter-spacing: 2px;
  text-transform: uppercase;
  display: block;
  margin-bottom: 0.4rem;
}

.section-title {
  color: var(--ft-white);
  font-size: 2.3rem;
  font-weight: 900;
  letter-spacing: 1px;
  text-transform: uppercase;
  margin-bottom: 0.6rem;
}

.section-subtitle {
  color: var(--ft-gray-muted);
  font-size: 1.05rem;
  font-weight: 400;
}

.section-divider {
  width: 70px;
  height: 4px;
  background: var(--ft-green-accent);
  border-radius: 2px;
  margin: 1.2rem auto 0;
}

/* --- TARJETAS DE ETAPAS DE PRECIOS --- */
.stage-card {
  background: var(--ft-bg-card);
  border: 1px solid var(--ft-border-subtle);
  border-radius: 24px;
  padding: 2.2rem 2rem;
  height: 100%;
  display: flex;
  flex-direction: column;
  position: relative;
  transition: all 0.35s ease;
}

.stage-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.5);
}

.stage-card.stage-active {
  border: 2px solid var(--ft-green-accent);
  background: linear-gradient(180deg, rgba(178, 216, 31, 0.06) 0%, var(--ft-bg-card) 100%);
  box-shadow: 0 10px 30px rgba(0,0,0,0.4), var(--ft-glow-green);
}

.stage-badge-status {
  position: absolute;
  top: -14px;
  left: 50%;
  transform: translateX(-50%);
  background: var(--ft-green-accent);
  color: #000;
  font-weight: 800;
  font-size: 0.75rem;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 0.35rem 1.1rem;
  border-radius: 50px;
  display: flex;
  align-items: center;
  gap: 6px;
  box-shadow: 0 4px 12px rgba(178, 216, 31, 0.5);
}

.stage-badge-status.status-upcoming {
  background: #33333e;
  color: var(--ft-gray-muted);
  box-shadow: none;
}

.status-pulse-dot {
  width: 8px;
  height: 8px;
  background: #000;
  border-radius: 50%;
  animation: pulse-dot 1.5s infinite;
}

@keyframes pulse-dot {
  0% { transform: scale(0.95); opacity: 0.8; }
  50% { transform: scale(1.3); opacity: 1; }
  100% { transform: scale(0.95); opacity: 0.8; }
}

.stage-name {
  color: var(--ft-white);
  font-size: 1.35rem;
  font-weight: 800;
  margin-top: 0.5rem;
  margin-bottom: 0.2rem;
}

.stage-tag {
  color: var(--ft-gray-muted);
  font-size: 0.85rem;
}

.stage-price-box {
  margin: 1.5rem 0;
  display: flex;
  align-items: baseline;
  gap: 4px;
}

.stage-currency {
  font-size: 1.6rem;
  font-weight: 700;
  color: var(--ft-green-accent);
}

.stage-price {
  font-size: 3rem;
  font-weight: 900;
  color: var(--ft-white);
  line-height: 1;
}

.stage-period {
  font-size: 0.9rem;
  font-weight: 700;
  color: var(--ft-gray-muted);
}

.stage-features {
  list-style: none;
  padding: 0;
  margin: 0 0 1.5rem 0;
  flex-grow: 1;
}

.stage-features li {
  padding: 0.55rem 0;
  color: var(--ft-gray-light);
  font-size: 0.9rem;
  display: flex;
  align-items: center;
  gap: 10px;
  border-bottom: 1px solid rgba(255,255,255,0.04);
}

.btn-stage-primary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: var(--ft-green-accent);
  color: #000 !important;
  font-weight: 800;
  font-size: 0.9rem;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 0.85rem;
  border-radius: 12px;
  text-decoration: none;
  transition: all 0.2s ease;
}

.btn-stage-primary:hover {
  background: #c2ea23;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(178, 216, 31, 0.4);
}

.btn-stage-disabled {
  background: rgba(255,255,255,0.05);
  color: var(--ft-gray-muted);
  border: 1px solid var(--ft-border-subtle);
  font-weight: 600;
  font-size: 0.85rem;
  padding: 0.85rem;
  border-radius: 12px;
  cursor: not-allowed;
}

/* --- TARJETAS PÓSTER DE DISTANCIAS --- */
.distance-poster-card {
  position: relative;
  border-radius: 24px;
  overflow: hidden;
  height: 520px;
  background-size: cover;
  background-position: center;
  border: 2px solid var(--ft-border-subtle);
  box-shadow: 0 15px 35px rgba(0,0,0,0.5);
  transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
  display: flex;
  align-items: flex-end;
}

.distance-poster-card:hover {
  transform: translateY(-10px);
  border-color: var(--ft-green-accent);
  box-shadow: 0 25px 50px rgba(0,0,0,0.7), var(--ft-glow-green);
}

.distance-poster-card.featured-distance {
  border-color: var(--ft-green-accent);
}

.distance-poster-overlay {
  position: absolute;
  top: 0; left: 0; width: 100%; height: 100%;
  background: linear-gradient(
    180deg, 
    rgba(13,13,16,0.1) 0%, 
    rgba(13,13,16,0.6) 45%, 
    rgba(13,13,16,0.96) 90%
  );
  transition: background 0.3s ease;
}

.distance-poster-card:hover .distance-poster-overlay {
  background: linear-gradient(
    180deg, 
    rgba(13,13,16,0.2) 0%, 
    rgba(13,13,16,0.7) 40%, 
    rgba(13,13,16,0.98) 90%
  );
}

.popular-ribbon {
  position: absolute;
  top: 18px;
  right: 18px;
  background: var(--ft-green-accent);
  color: #000;
  font-weight: 800;
  font-size: 0.75rem;
  letter-spacing: 1px;
  padding: 0.35rem 0.9rem;
  border-radius: 50px;
  z-index: 5;
  box-shadow: 0 4px 15px rgba(0,0,0,0.5);
}

.distance-poster-content {
  position: relative;
  z-index: 4;
  padding: 2rem;
  width: 100%;
}

.distance-badge-pill {
  display: inline-block;
  background: rgba(255,255,255,0.15);
  color: var(--ft-white);
  font-weight: 800;
  font-size: 0.8rem;
  letter-spacing: 1.5px;
  padding: 0.3rem 0.8rem;
  border-radius: 6px;
  margin-bottom: 0.8rem;
  backdrop-filter: blur(8px);
}

.distance-badge-pill.badge-featured {
  background: var(--ft-green-accent);
  color: #000;
}

.distance-card-title {
  color: var(--ft-white);
  font-size: 1.5rem;
  font-weight: 800;
  margin-bottom: 0.5rem;
}

.distance-card-desc {
  color: var(--ft-gray-light);
  font-size: 0.88rem;
  line-height: 1.4;
  margin-bottom: 1rem;
}

.distance-specs-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 1.3rem;
}

.spec-chip {
  background: rgba(0,0,0,0.6);
  border: 1px solid rgba(255,255,255,0.15);
  color: var(--ft-white);
  font-size: 0.78rem;
  font-weight: 600;
  padding: 0.3rem 0.7rem;
  border-radius: 50px;
}

.btn-distance-action {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  background: var(--ft-green-accent);
  color: #000 !important;
  font-weight: 800;
  font-size: 0.88rem;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 0.8rem;
  border-radius: 12px;
  text-decoration: none;
  transition: all 0.25s ease;
}

.btn-distance-action:hover {
  background: #c5ef23;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(178,216,31,0.5);
}

/* --- STATS CARD (LA EXPERIENCIA) --- */
.stat-card {
  background: var(--ft-bg-card);
  border: 1px solid var(--ft-border-subtle);
  border-radius: 16px;
  padding: 1.2rem 0.6rem;
  transition: all 0.25s ease;
}

.stat-card:hover {
  border-color: var(--ft-green-accent);
  transform: translateY(-3px);
}

.stat-number {
  font-size: 1.8rem;
  font-weight: 900;
  color: var(--ft-white);
  margin-bottom: 0.2rem;
  line-height: 1;
}

.stat-label {
  color: var(--ft-gray-muted);
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  margin: 0;
}

.lead-ft {
  font-size: 1.15rem;
  font-weight: 500;
  line-height: 1.6;
}

/* --- VIDEO PLAYER ESTILO PRO --- */
.video-container-card {
  border: 2px solid var(--ft-border-green);
  background: #000;
}

.custom-play-btn {
  width: 76px;
  height: 76px;
  border-radius: 50%;
  background: var(--ft-green-accent);
  color: #000;
  border: none;
  font-size: 1.6rem;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 0 35px rgba(178, 216, 31, 0.7);
  transition: all 0.3s ease;
}

.custom-play-btn:hover {
  transform: scale(1.15);
  background: #c7f225;
}

.custom-play-btn i {
  margin-left: 4px;
}

.play-button-overlay.hidden {
  opacity: 0;
  pointer-events: none;
}

.video-live-badge {
  background: rgba(0,0,0,0.7);
  color: var(--ft-green-accent);
  font-size: 0.75rem;
  font-weight: 800;
  padding: 0.35rem 0.8rem;
  border-radius: 50px;
  border: 1px solid var(--ft-border-green);
  backdrop-filter: blur(8px);
}

/* --- KIT OFICIAL ITEMS --- */
.kit-item-card {
  background: var(--ft-bg-card);
  border: 1px solid var(--ft-border-subtle);
  border-radius: 20px;
  padding: 2rem 1.8rem;
  height: 100%;
  position: relative;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
}

.kit-item-card:hover {
  transform: translateY(-6px);
  border-color: var(--ft-green-accent);
  box-shadow: 0 15px 35px rgba(0,0,0,0.4);
}

.kit-icon-box {
  width: 58px;
  height: 58px;
  background: rgba(178, 216, 31, 0.12);
  border: 1px solid var(--ft-border-green);
  color: var(--ft-green-accent);
  font-size: 1.6rem;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.2rem;
  transition: transform 0.25s ease;
}

.kit-item-card:hover .kit-icon-box {
  transform: scale(1.1) rotate(5deg);
  background: var(--ft-green-accent);
  color: #000;
}

.kit-item-title {
  color: var(--ft-white);
  font-size: 1.2rem;
  font-weight: 800;
  margin-bottom: 0.5rem;
}

.kit-item-desc {
  color: var(--ft-gray-muted);
  font-size: 0.88rem;
  line-height: 1.5;
  margin-bottom: 1.2rem;
  flex-grow: 1;
}

.kit-item-tag {
  display: inline-block;
  color: var(--ft-green-accent);
  font-size: 0.78rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  text-transform: uppercase;
}

/* --- MÓDULO VALIDADOR RÁPIDO --- */
.validator-box {
  background: linear-gradient(135deg, #181820 0%, #1f1f28 100%);
  border: 2px solid var(--ft-border-green);
  box-shadow: 0 15px 40px rgba(0,0,0,0.6), var(--ft-glow-green);
}

.validator-badge {
  color: var(--ft-green-accent);
  font-size: 0.78rem;
  font-weight: 800;
  letter-spacing: 1px;
}

.validator-title {
  color: var(--ft-white);
  font-size: 1.65rem;
  font-weight: 800;
  margin-bottom: 0.4rem;
}

.validator-desc {
  color: var(--ft-gray-light);
  font-size: 0.95rem;
}

.btn-validator-action {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: var(--ft-green-accent);
  color: #000 !important;
  font-weight: 800;
  font-size: 0.95rem;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 1rem 2.2rem;
  border-radius: 50px;
  text-decoration: none;
  box-shadow: 0 6px 20px rgba(178, 216, 31, 0.4);
  transition: all 0.25s ease;
}

.btn-validator-action:hover {
  background: #c6ef24;
  transform: translateY(-3px);
  box-shadow: 0 10px 30px rgba(178, 216, 31, 0.6);
}

/* --- RECORRIDOS PESTAÑAS --- */
.route-tab-btn {
  background: var(--ft-bg-card) !important;
  color: var(--ft-white) !important;
  border: 1px solid var(--ft-border-subtle) !important;
  font-weight: 700 !important;
  font-size: 0.95rem !important;
  padding: 0.8rem 2rem !important;
  border-radius: 50px !important;
  transition: all 0.25s ease !important;
}

.route-tab-btn.active {
  background: var(--ft-green-accent) !important;
  color: #000 !important;
  border-color: var(--ft-green-accent) !important;
  box-shadow: 0 4px 15px rgba(178, 216, 31, 0.4) !important;
}

.route-card-box {
  background: var(--ft-bg-card);
  border: 1px solid var(--ft-border-subtle);
}

.badge-accent {
  background: rgba(178, 216, 31, 0.15);
  color: var(--ft-green-accent);
  font-size: 0.78rem;
  font-weight: 800;
  padding: 0.35rem 0.8rem;
  border-radius: 6px;
  display: inline-block;
}

.route-feature-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
  margin-top: 1.2rem;
}

.feature-row {
  color: var(--ft-gray-light);
  font-size: 0.92rem;
}

.route-preview-placeholder {
  background: rgba(0,0,0,0.4);
  border: 2px dashed rgba(255,255,255,0.15);
  border-radius: 18px;
  padding: 3rem 2rem;
}

/* --- PREMIACIÓN --- */
.award-card {
  background: var(--ft-bg-card);
  border: 1px solid var(--ft-border-subtle);
  border-radius: 22px;
  padding: 2.5rem 2rem;
  text-align: center;
  height: 100%;
  transition: all 0.3s ease;
}

.award-card:hover {
  transform: translateY(-8px);
}

.award-card.award-gold {
  border: 2px solid var(--ft-green-accent);
  box-shadow: 0 10px 30px rgba(0,0,0,0.5), var(--ft-glow-green);
}

.award-trophy-icon {
  width: 72px;
  height: 72px;
  background: rgba(178, 216, 31, 0.12);
  border: 2px solid var(--ft-border-green);
  color: var(--ft-green-accent);
  font-size: 2rem;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1.3rem;
}

.award-position {
  color: var(--ft-green-accent);
  font-size: 0.82rem;
  font-weight: 800;
  letter-spacing: 1.5px;
  display: block;
  margin-bottom: 0.4rem;
}

.award-title {
  color: var(--ft-white);
  font-size: 1.4rem;
  font-weight: 800;
  margin-bottom: 0.8rem;
}

.award-desc {
  color: var(--ft-gray-muted);
  font-size: 0.88rem;
  margin-bottom: 1.4rem;
}

.award-pill {
  display: inline-block;
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.1);
  color: var(--ft-gray-light);
  font-size: 0.78rem;
  font-weight: 700;
  padding: 0.35rem 1rem;
  border-radius: 50px;
}

/* --- PATROCINADORES --- */
.sponsor-logo-box {
  background: var(--ft-bg-card);
  border: 1px solid var(--ft-border-subtle);
  border-radius: 16px;
  padding: 1.5rem 1rem;
  height: 100px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  transition: all 0.25s ease;
}

.sponsor-logo-box:hover {
  border-color: var(--ft-green-accent);
  transform: translateY(-4px);
  background: #25252e;
}

.sponsor-logo {
  max-height: 45px;
  max-width: 80%;
  filter: grayscale(100%) brightness(150%);
  transition: filter 0.3s ease;
}

.sponsor-logo-box:hover .sponsor-logo {
  filter: grayscale(0%) brightness(100%);
}

.sponsor-name-fallback {
  color: var(--ft-white);
  font-size: 0.82rem;
  font-weight: 800;
  letter-spacing: 1px;
}

/* --- PREGUNTAS FRECUENTES (FAQ) --- */
.custom-dark-accordion .accordion-item {
  background: var(--ft-bg-card);
  border: 1px solid var(--ft-border-subtle);
  border-radius: 14px !important;
  margin-bottom: 12px;
  overflow: hidden;
}

.custom-dark-accordion .accordion-button {
  background: var(--ft-bg-card);
  color: var(--ft-white);
  font-weight: 700;
  font-size: 1rem;
  padding: 1.3rem 1.5rem;
  box-shadow: none !important;
  border: none;
}

.custom-dark-accordion .accordion-button:not(.collapsed) {
  color: var(--ft-green-accent);
  background: #22222b;
  border-bottom: 1px solid var(--ft-border-subtle);
}

.custom-dark-accordion .accordion-button::after {
  filter: invert(1);
}

.custom-dark-accordion .accordion-button:not(.collapsed)::after {
  filter: invert(75%) sepia(80%) saturate(1000%) hue-rotate(40deg);
}

.custom-dark-accordion .accordion-body {
  color: var(--ft-gray-light);
  font-size: 0.95rem;
  line-height: 1.6;
  background: var(--ft-bg-card);
  padding: 1.4rem 1.5rem;
}

/* --- BANNER FINAL CTA --- */
.section-final-cta {
  background-image: url('assets/img/CorreconFemtribe2.0/fondo1.png');
  background-size: cover;
  background-position: center;
}

.final-cta-overlay {
  position: absolute;
  top: 0; left: 0; width: 100%; height: 100%;
  background: rgba(13, 13, 16, 0.88);
}

.fw-black {
  font-weight: 900 !important;
}

.badge-ft-pill {
  display: inline-block;
  background: rgba(178, 216, 31, 0.15);
  border: 1px solid var(--ft-border-green);
  color: var(--ft-white);
  font-weight: 800;
  font-size: 0.8rem;
  letter-spacing: 1.5px;
  padding: 0.4rem 1.2rem;
  border-radius: 50px;
}

/* --- RESPONSIVE OPTIMIZATIONS --- */
@media (max-width: 991px) {
  .hero-title-ft { font-size: 1.5rem; letter-spacing: 2px; }
  .section-title { font-size: 1.85rem; }
  .logo-carrera { max-height: 240px; }
  .modern-countdown-number { font-size: 2.2rem; }
  .modern-countdown-item { min-width: 85px; padding: 0.75rem 1rem; }
  .distance-poster-card { height: 460px; }
}

@media (max-width: 576px) {
  .hero-content { padding-top: 4.5rem; }
  .hero-title-ft { font-size: 1.2rem; letter-spacing: 1.2px; }
  .logo-carrera { max-height: 180px; }
  .section-title { font-size: 1.55rem; }
  .cta-buttons-ft { flex-direction: column; width: 100%; }
  .btn-cta-primary, .btn-cta-secondary { width: 100%; font-size: 0.85rem; padding: 0.85rem 1.2rem; }
  .modern-countdown { gap: 8px; }
  .modern-countdown-item { min-width: 70px; padding: 0.65rem 0.5rem; }
  .modern-countdown-number { font-size: 1.6rem; }
  .modern-countdown-label { font-size: 0.65rem; }
  .distance-poster-card { height: 420px; }
  .stage-card { padding: 1.8rem 1.4rem; }
  .stage-price { font-size: 2.4rem; }
}
</style>

<!-- =========================================================================
     SCRIPTS DEL HOME (TEMPORIZADOR, VIDEO & ANIMACIONES)
     ========================================================================= -->
<script>
// Fecha objetivo de la carrera
const targetDate = new Date("2026-11-29T07:00:00").getTime();

function updateCountdown() {
    const now = new Date().getTime();
    const diff = targetDate - now;

    const elDays = document.getElementById("countdown-days");
    const elHours = document.getElementById("countdown-hours");
    const elMins = document.getElementById("countdown-minutes");
    const elSecs = document.getElementById("countdown-seconds");

    if (diff <= 0) {
        if (elDays) elDays.textContent = "00";
        if (elHours) elHours.textContent = "00";
        if (elMins) elMins.textContent = "00";
        if (elSecs) elSecs.textContent = "00";
        return;
    }

    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    const secs = Math.floor((diff % (1000 * 60)) / 1000);

    if (elDays) elDays.textContent = days.toString().padStart(2, '0');
    if (elHours) elHours.textContent = hours.toString().padStart(2, '0');
    if (elMins) elMins.textContent = mins.toString().padStart(2, '0');
    if (elSecs) elSecs.textContent = secs.toString().padStart(2, '0');
}

updateCountdown();
setInterval(updateCountdown, 1000);

// Video Player
function playVideo() {
  const video = document.getElementById('femtribeVideo');
  const overlay = document.getElementById('playButtonOverlay');
  if (video) {
    video.play();
    if (overlay) overlay.classList.add('hidden');
  }
}

document.addEventListener('DOMContentLoaded', function() {
  const video = document.getElementById('femtribeVideo');
  const overlay = document.getElementById('playButtonOverlay');
  if (video && overlay) {
    video.addEventListener('pause', () => overlay.classList.remove('hidden'));
    video.addEventListener('ended', () => overlay.classList.remove('hidden'));
    video.addEventListener('play', () => overlay.classList.add('hidden'));
  }
  
  // Dynamic login check for buttons
  const inscribeteBtns = document.querySelectorAll('.inscribete-btn-link');
  inscribeteBtns.forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      if (window.isUserLoggedIn) {
        btn.setAttribute('href', '/inscribirse');
      } else {
        btn.setAttribute('href', '/registro');
      }
    });
  });
});
</script>

<?php include 'layouts/footer.php'; ?>
