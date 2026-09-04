<?php include 'layouts/header.php'; ?>
<?php $inscribeteUrl = !empty($_SESSION['user_id']) ? '/inscribirse' : '/registro'; ?>
<script>
  // Al estar en el home, limpiamos cualquier redirect_after_auth residual de sesiones anteriores
  // para evitar que al hacer login rediriga a /carrito o /checkout inesperadamente
  sessionStorage.removeItem('redirect_after_auth');
</script>

<!-- =========================================================================
     FRANJA SUPERIOR: RELOJ CUENTA REGRESIVA INDEPENDIENTE
     ========================================================================= -->
<section class="countdown-top-bar py-4 py-lg-5" id="countdown-bar">
  <div class="container" data-aos="fade-up" data-aos-duration="800">

    <!-- Reloj Cuenta Regresiva: ESTRUCTURA [LÍNEAS IZQ] [4 CUADROS] [LÍNEAS DER] -->
    <div class="modern-countdown-wrapper">
      <div class="countdown-ends-row">
        <!-- GRUPO 1: 3 LÍNEAS A LA IZQUIERDA (antes del primer cuadro) -->
        <div class="countdown-end-lines countdown-lines-left" aria-hidden="true">
          <span class="countdown-end-line"></span>
          <span class="countdown-end-line"></span>
          <span class="countdown-end-line"></span>
        </div>

        <!-- GRUPO 2: LOS 4 CUADROS IGUALES (Días / Horas / Minutos / Segundos) -->
        <div class="countdown-boxes-row">
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

        <!-- GRUPO 3: 3 LÍNEAS A LA DERECHA (después del último cuadro) -->
        <div class="countdown-end-lines countdown-lines-right" aria-hidden="true">
          <span class="countdown-end-line"></span>
          <span class="countdown-end-line"></span>
          <span class="countdown-end-line"></span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     HERO SECTION CON CARRUSEL DE ALTO IMPACTO
     ========================================================================= -->
<section class="hero-slider position-relative" id="inicio">
  <!-- Carrusel de fondo -->
  <div id="heroCarousel" class="carousel slide">
    <div class="carousel-indicators carousel-indicators-ft">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"
        aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
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
      <div class="carousel-item" style="background-image: url('assets/img/CorreconFemtribe2.0/fondo5.png');">
        <div class="hero-overlay"></div>
      </div>
    </div>
  </div>

  <!-- Contenido superpuesto del Hero: Logo + Botones CTA -->
  <div
    class="hero-content position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
    <div class="container text-center py-4" data-aos="fade-up" data-aos-duration="1000">

      <!-- Logo Oficial de la Carrera -->
      <div class="logo-wrapper mb-4">
        <img src="assets/img/CorreconFemtribe2.0/logocarrera2.0.png" alt="Corre Con FemTribe 2.0"
          class="logo-carrera img-fluid" onerror="this.src='assets/img/logocarrera.png'; this.onerror=null;">
      </div>

      <!-- [TMP COMENTADO] Botón CTA del carrusel (comentado temporalmente para visualización sin botón)
      <div class="d-flex justify-content-center gap-3 cta-buttons-ft">
        <a href="<?= $inscribeteUrl ?>" class="btn-cta-primary inscribete-btn-link">
          ¡INSCRÍBETE AHORA!
        </a>
      </div>
      -->

    </div>
  </div>
</section>

<!-- =========================================================================
     SECCIÓN: MUCHO MÁS QUE UNA CARRERA
     ========================================================================= -->
<section class="more-than-race py-5" id="presentacion">
  <div class="container py-4">

    <!-- PÁRRAFO UNICO (2 frases juntas, 2 LÍNEAS MÁXIMO, ANCHO COMPLETO) -->
    <div class="row justify-content-center" style="margin-bottom: 3.5rem;">
      <div class="col-12 col-xl-11 text-center">

        <p class="mtr-paragraph mtr-paragraph--lead mtr-paragraph--two-lines" data-aos="fade-up" data-aos-duration="900"
          data-aos-delay="100">
          <strong class="mtr-strong">CORRE CON FEMTRIBE 2.0</strong>
          es una experiencia que invita a <strong class="mtr-strong">moverte, superarte, conectar y disfrutar.</strong>
          Elige tu reto entre <strong class="mtr-strong">3K, 5K y 10K</strong>
          y prepárate para vivir una jornada llena de
          <strong class="mtr-strong">movimiento, música, emoción, conexión y momentos</strong> que querrás recordar.
        </p>

      </div>
    </div>

    <!-- =========================================================================
         GRID 3 TARJETAS DE DISTANCIAS (3K / 5K / 10K) · IMAGEN 100% CUADRO
         ========================================================================= -->
    <div class="row g-4 justify-content-center align-items-stretch" id="distancias" style="margin-bottom: 0.4rem;">

      <!-- ============ TARJETA 3K · TARJETA ÚNICA CONTINUA (imagen + info fusionados) ============ -->
      <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="distance-card">
          <a href="<?= $inscribeteUrl ?>" class="distance-image-card distance-image-card--with-btn inscribete-btn-link">
            <img src="assets/img/CorreconFemtribe2.0/tarjeta3k.png" alt="3K Niños y Mascotas Corre Con FemTribe 2.0"
              class="distance-image-card__img" loading="lazy"
              onerror="this.onerror=null;this.src='assets/img/CorreconFemtribe2.0/fondo1.png';">
          </a>

          <!-- BLOQUE INFO PEGADO A LA IMAGEN (misma tarjeta continua) · 3K -->
          <div class="distance-info-block">
            <div class="distance-info-block__header">
              <h4 class="distance-info-block__title">
                3K · Niños y mascotas
              </h4>
            </div>
            <p class="distance-info-block__desc">
              La distancia perfecta para los más pequeños y sus mejores amigos.
            </p>
            <a href="<?= $inscribeteUrl ?>" class="distance-info-block__btn inscribete-btn-link">
              INSCRÍBETE AQUÍ
            </a>
          </div>
        </div>
      </div>

      <!-- ============ TARJETA 5K · TARJETA ÚNICA CONTINUA ============ -->
      <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
        <div class="distance-card">
          <a href="<?= $inscribeteUrl ?>" class="distance-image-card distance-image-card--with-btn inscribete-btn-link">
            <img src="assets/img/CorreconFemtribe2.0/tarjeta5k.png" alt="5K Para Todos Corre Con FemTribe 2.0"
              class="distance-image-card__img" loading="lazy"
              onerror="this.onerror=null;this.src='assets/img/CorreconFemtribe2.0/fondo2.png';">
          </a>

          <!-- BLOQUE INFO PEGADO A LA IMAGEN · 5K -->
          <div class="distance-info-block">
            <div class="distance-info-block__header">
              <h4 class="distance-info-block__title">
                5K · Para todos
              </h4>
            </div>
            <p class="distance-info-block__desc">
              La distancia perfecta para los que buscan un reto accesible, emocionante y lleno de energía.
            </p>
            <a href="<?= $inscribeteUrl ?>" class="distance-info-block__btn inscribete-btn-link">
              INSCRÍBETE AQUÍ
            </a>
          </div>
        </div>
      </div>

      <!-- ============ TARJETA 10K · TARJETA ÚNICA CONTINUA ============ -->
      <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
        <div class="distance-card">
          <a href="<?= $inscribeteUrl ?>" class="distance-image-card distance-image-card--with-btn inscribete-btn-link">
            <img src="assets/img/CorreconFemtribe2.0/tarjeta10k.png" alt="10K Superación Corre Con FemTribe 2.0"
              class="distance-image-card__img" loading="lazy"
              onerror="this.onerror=null;this.src='assets/img/CorreconFemtribe2.0/fondo3.png';">
          </a>

          <!-- BLOQUE INFO PEGADO A LA IMAGEN · 10K -->
          <div class="distance-info-block">
            <div class="distance-info-block__header">
              <h4 class="distance-info-block__title">
                10K · Para los que quieren más
              </h4>
            </div>
            <p class="distance-info-block__desc">
              La distancia para los que buscan superarse, desafiar sus límites y sentir el poder de cada kilómetro.
            </p>
            <a href="<?= $inscribeteUrl ?>" class="distance-info-block__btn inscribete-btn-link">
              INSCRÍBETE AQUÍ
            </a>
          </div>
        </div>
      </div>

    </div><!-- fin row tarjetas distancias -->

    <!-- =========================================================================
         ZONA CONSULTA DE INSCRIPCIÓN (2 columnas: texto+botón IZQ + foto DIFUMINADA DER)
         ========================================================================= -->
    <div class="row g-0 align-items-center justify-content-center consulta-inscripcion"
      style="margin: 0.05rem 0 0.3rem 0;" data-aos="fade-up">

      <!-- COLUMNA IZQUIERDA: Título + subtítulo + BOTÓN CONSULTA -->
      <div class="col-12 col-lg-6 consulta-inscripcion__text-col">
        <div class="consulta-inscripcion__text-wrap">

          <h3 class="consulta-inscripcion__title">
            Valida tu inscripción
          </h3>

          <p class="consulta-inscripcion__subtitle">
            Verifica tu inscripción y consulta los datos de tu registro.
          </p>

          <a href="<?= $inscribeteUrl ?>" class="btn-consulta-inscripcion inscribete-btn-link">
            CONSULTA DE INSCRIPCIÓN
          </a>

        </div>
      </div>

      <!-- COLUMNA DERECHA: FOTO DIFUMINADA (sin fondo, blend overlay, asimétrica derecha) -->
      <div class="col-12 col-lg-6 consulta-inscripcion__photo-col">
        <img src="assets/img/CorreconFemtribe2.0/difuminada.png" alt="Atleta Corre Con FemTribe 2.0"
          class="consulta-inscripcion__photo" loading="lazy"
          onerror="this.onerror=null;this.src='assets/img/CorreconFemtribe2.0/fondo5.png';">
      </div>

    </div>

  </div>
</section>

<!-- =========================================================================
     FRANJA CTA: ¡Anímate a vivir esta gran experiencia!
     ========================================================================= -->
<section class="cta-accent-bar py-5">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <h3 class="cta-accent-bar__title" data-aos="fade-up" data-aos-duration="800">
          ¡Anímate a vivir esta gran experiencia!
        </h3>
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
      <p class="section-subtitle">Marcas e instituciones que hacen posible la gran fiesta de Corre Con FEMTRIBE 2.0</p>
      <div class="section-divider"></div>
    </div>

    <!-- Grilla de Logos de Patrocinadores -->
    <div class="row g-4 align-items-center justify-content-center text-center">

      <div class="col-6 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="100">
        <div class="sponsor-logo-box">
          <img src="assets/img/ricaurte.png" alt="Alcaldía de Ricaurte" class="img-fluid sponsor-logo"
            onerror="this.style.display='none'">
          <span class="sponsor-name-fallback">RICAURTE</span>
        </div>
      </div>

      <div class="col-6 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="200">
        <div class="sponsor-logo-box">
          <img src="assets/img/femtribe_verde.png" alt="FEMTRIBE Running" class="img-fluid sponsor-logo">
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
<section class="section-sponsors-green" id="patrocinadores">
  <div class="container">
    
    <!-- ALIADOS PRINCIPALES -->
    <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="150">
      <div class="col-12 mb-2">
        <h2 class="sponsor-green-title mb-3 mb-md-4">ALIADOS PRINCIPALES</h2>
      </div>

      <div class="col-12">
        <div class="aliados-row d-flex flex-wrap align-items-center justify-content-center gap-2 gap-md-3 gap-lg-4">

          <div class="aliado-item" data-logo="ricaurte" data-aos="zoom-in" data-aos-delay="200">
            <div class="aliado-logo-box">
              <img src="assets/img/CorreconFemtribe2.0/aliado_ricaurte.png" alt="Alcaldía de Ricaurte" class="aliado-logo-img img-fluid">
            </div>
          </div>

          <div class="aliado-item" data-logo="cundeportes" data-aos="zoom-in" data-aos-delay="300">
            <img src="assets/img/CorreconFemtribe2.0/aliado_cundeportes.png" alt="Cundeportes" class="aliado-logo-img img-fluid">
          </div>

          <div class="aliado-item" data-logo="electrolit" data-aos="zoom-in" data-aos-delay="400">
            <div class="aliado-logo-box">
              <img src="assets/img/CorreconFemtribe2.0/aliado_electrolit.png" alt="Electrolit" class="aliado-logo-img img-fluid">
            </div>
          </div>

          <div class="aliado-item" data-logo="adrian" data-aos="zoom-in" data-aos-delay="500">
            <div class="aliado-logo-box">
              <img src="assets/img/CorreconFemtribe2.0/aliado_adrian.png" alt="Aliado Adrián" class="aliado-logo-img img-fluid">
            </div>
          </div>

          <div class="aliado-item" data-logo="ap" data-aos="zoom-in" data-aos-delay="600">
            <div class="aliado-logo-box">
              <img src="assets/img/CorreconFemtribe2.0/aliado_AP.png" alt="Aliado AP Andrés Peña" class="aliado-logo-img img-fluid">
  /* --- SECCIÓN RICAURTE INFO (FONDO AZUL OSCURO OFICIAL) --- */
  .section-ricaurte-info {
    position: relative;
    width: 100%;
    background-color: #002D62;   /* AZUL OSCURO OFICIAL */
    padding: 4.5rem 0;
  }

  .ricaurte-info-text {
    font-family: 'Inter', 'Montserrat', sans-serif;
    font-size: clamp(0.92rem, 1.25vw, 1.08rem);
    line-height: 1.75;
    color: #FFFFFF;              /* TEXTO BASE BLANCO */
    font-weight: 400;
  }

  .ricaurte-info-text strong { color: #B2D81F; }

  /* --- SECCIÓN PATROCINADORES Y ALIADOS (FONDO VERDE OFICIAL #B2D81F) --- */
  .section-sponsors-green {
    position: relative;
    width: 100%;
    background-color: #B2D81F;   /* VERDE OFICIAL - restaurado */
    padding: 2rem 0;
  }

  .section-sponsors-green > .container {
    padding-top: 0 !important;
    padding-bottom: 0 !important;
  }

  .sponsor-green-title {
    font-family: 'Impact', 'Anton', 'League Spartan', 'Oswald', 'Montserrat', sans-serif;
    font-weight: 1000;
    font-style: normal;
    font-size: clamp(1.45rem, 2.35vw, 2.2rem);
    letter-spacing: 0.9px;
    color: #003A77;
    text-transform: uppercase;
    margin: 0;
    -webkit-font-smoothing: antialiased;
  }

  /* Logo principal FemTribe en BLANCO sobre verde */
  .sponsor-logo-main {
    max-height: 115px;
    width: auto;
    object-fit: contain;
    filter: brightness(0) invert(1);
    opacity: 1;
    transition: all 0.3s ease;
  }

  .sponsor-logo-main:hover {
    transform: scale(1.06);
    opacity: 1;
  }

  .aliado-item {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.1rem;
    flex: 0 0 auto;
  }

  .aliado-logo-box {
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    max-height: 150px;
    max-width: 350px;
  }

  /* CUNDEPORTES:
     SIN caja .aliado-logo-box, SIN overflow, SIN height/width forzados.
     Tamaño natural del PNG + filtro. NUNCA se corta nada = 3 aros completos +
     círculo exterior cerrado + letras "CUNDEPORTES RICAURTE" completas. */
  .aliado-item[data-logo="cundeportes"] {
    min-width: 0;
  }
  .aliado-item[data-logo="cundeportes"] .aliado-logo-img {
    filter: saturate(0%) invert(1) contrast(600%);
    mix-blend-mode: screen;
    margin: 0;
    padding: 0;
    max-height: none;
    max-width: min(42vw, 360px);
    width: auto;
    height: auto;
  }

  /* ELECTROLIT: caja + grande */
  .aliado-item[data-logo="electrolit"] .aliado-logo-box {
    max-height: 180px;
    max-width: 460px;
  }

  .aliado-logo-img {
    max-height: 190px;
    max-width: 440px;
    width: auto;
    height: auto;
    object-fit: contain;
    margin: -22% -22%;
    filter: brightness(0) invert(1);
    mix-blend-mode: normal;
    opacity: 1;
    transition: all 0.3s ease;
  }
  .aliado-item[data-logo="ricaurte"] .aliado-logo-img {
    filter: invert(1) grayscale(100%) contrast(400%);
    mix-blend-mode: screen;
    max-height: 160px;
    max-width: 360px;
    margin: 0;
  }
  /* CUNDEPORTES: ahora el PNG ya es LOGO BLANCO (tú lo cambiaste).
     NINGÚN FILTRO. Modo normal. Se ve blanco directo sobre verde. */
  .aliado-item[data-logo="cundeportes"] .aliado-logo-img {
    filter: none;
    mix-blend-mode: normal;
    opacity: 1;
    max-height: 160px;
    max-width: 380px;
    width: auto;
    height: auto;
    margin: 0;
  }

  /* ELECTROLIT: tamaño SIMÉTRICO a Ricaurte y Cundeportes */
  .aliado-item[data-logo="electrolit"] .aliado-logo-img {
    filter: brightness(0) invert(1);
    mix-blend-mode: normal;
    max-height: 160px;
    max-width: 380px;
    margin: 0;
  }

  /* ADRIÁN: tamaño SIMÉTRICO a los otros 3 aliados */
  .aliado-item[data-logo="adrian"] .aliado-logo-img {
    filter: brightness(0) invert(1);
    mix-blend-mode: normal;
    max-height: 160px;
    max-width: 380px;
    margin: 0;
  }

  /* AP (Andrés Peña): PNG ya es BLANCO con transparencia.
     Ningún filtro (igual que Cundeportes). Tamaño simétrico a los otros. */
  .aliado-item[data-logo="ap"] .aliado-logo-img {
    filter: none;
    mix-blend-mode: normal;
    opacity: 1;
    max-height: 145px;
    max-width: 320px;
    width: auto;
    height: auto;
    margin: 0;
  }

  .aliado-logo-img:hover {
    transform: scale(1.06);
    opacity: 1;
  }

  @media (max-width: 768px) {
    .section-sponsors-green {
      padding: 2rem 0;
    }
    .sponsor-green-title {
      font-size: 1rem;
    }
    .sponsor-logo-main {
      max-height: 85px;
    }
    .aliado-logo-box {
      max-height: 110px;
      max-width: 260px;
    }
    .aliado-item[data-logo="electrolit"] .aliado-logo-box {
      max-height: 115px;
      max-width: 290px;
    }
    .aliado-logo-img {
      max-height: 140px;
      max-width: 320px;
    }
    .aliado-item[data-logo="electrolit"] .aliado-logo-img {
      max-height: 115px;
      max-width: 290px;
    }
    .aliados-row {
      gap: 0.25rem !important;
    }
  }

  .btn-ricaurte-ig {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.85rem 2.2rem;
    background: #B2D81F;         /* VERDE OFICIAL B2D81F */
    color: #000000;              /* LETRA NEGRA */
    border: 2px solid #B2D81F;
    border-radius: 999px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 0.9rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-decoration: none;
    transition: all 0.28s ease;
    box-shadow: 0 8px 22px rgba(178, 216, 31, 0.35);
  }

  .btn-ricaurte-ig:hover {
    background: #41CEB3;         /* AZUL CLARO EN HOVER */
    color: #000000;
    border-color: #41CEB3;
    transform: translateY(-2px);
    box-shadow: 0 12px 26px rgba(65, 206, 179, 0.4);
    text-decoration: none;
  }

  /* --- FOTO DE LA IGLESIA TAL CUAL SIN TEXTO --- */
  .section-iglesia-full {
    width: 100%;
    background-color: #00122e;
  }

  .img-iglesia-standalone {
    width: 100%;
    height: auto;
    max-height: 650px;
    object-fit: cover;
    object-position: center;
  }

  @media (max-width: 768px) {
    .section-ricaurte-info {
      padding: 3.2rem 0;
    }
    .btn-ricaurte-ig {
      padding: 0.8rem 1.6rem;
      font-size: 0.82rem;
    }
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
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
  }

  .stage-card.stage-active {
    border: 2px solid var(--ft-green-accent);
    background: linear-gradient(180deg, rgba(178, 216, 31, 0.06) 0%, var(--ft-bg-card) 100%);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4), var(--ft-glow-green);
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
    0% {
      transform: scale(0.95);
      opacity: 0.8;
    }

    50% {
      transform: scale(1.3);
      opacity: 1;
    }

    100% {
      transform: scale(0.95);
      opacity: 0.8;
    }
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
    border-bottom: 1px solid rgba(255, 255, 255, 0.04);
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
    background: rgba(255, 255, 255, 0.05);
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
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
    transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
    display: flex;
    align-items: flex-end;
  }

  .distance-poster-card:hover {
    transform: translateY(-10px);
    border-color: var(--ft-green-accent);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.7), var(--ft-glow-green);
  }

  .distance-poster-card.featured-distance {
    border-color: var(--ft-green-accent);
  }

  .distance-poster-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(180deg,
        rgba(13, 13, 16, 0.1) 0%,
        rgba(13, 13, 16, 0.6) 45%,
        rgba(13, 13, 16, 0.96) 90%);
    transition: background 0.3s ease;
  }

  .distance-poster-card:hover .distance-poster-overlay {
    background: linear-gradient(180deg,
        rgba(13, 13, 16, 0.2) 0%,
        rgba(13, 13, 16, 0.7) 40%,
        rgba(13, 13, 16, 0.98) 90%);
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
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
  }

  .distance-poster-content {
    position: relative;
    z-index: 4;
    padding: 2rem;
    width: 100%;
  }

  .distance-badge-pill {
    display: inline-block;
    background: rgba(255, 255, 255, 0.15);
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
    background: rgba(0, 0, 0, 0.6);
    border: 1px solid rgba(255, 255, 255, 0.15);
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
    box-shadow: 0 6px 18px rgba(178, 216, 31, 0.5);
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
    background: rgba(0, 0, 0, 0.7);
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
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
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
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6), var(--ft-glow-green);
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
    background: rgba(0, 0, 0, 0.4);
    border: 2px dashed rgba(255, 255, 255, 0.15);
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
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), var(--ft-glow-green);
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
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.1);
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
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
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
  @media (max-width: 991.98px) {
    .countdown-top-bar {
      padding-top: 7.5rem !important;
      padding-bottom: 4.5rem !important;
    }

    .countdown-end-lines {
      gap: 4px;
    }

    .countdown-end-line {
      height: 2.5px;
    }

    .countdown-boxes-row {
      gap: 6px;
    }

    .modern-countdown-wrapper {
      max-width: 460px;
    }

    .modern-countdown-item {
      padding: 0.7rem 0.35rem 0.55rem !important;
      min-height: 85px;
      aspect-ratio: 1 / 1.12;
      border-radius: 9px;
    }

    .modern-countdown-number {
      font-size: 1.5rem !important;
    }

    .modern-countdown-label {
      font-size: 0.58rem !important;
      letter-spacing: 1px;
      margin-top: 0.35rem;
    }

    .section-title {
      font-size: 1.85rem;
    }

    .logo-carrera {
      max-height: 240px;
    }

    .distance-poster-card {
      height: 460px;
    }
  }

  @media (max-width: 576px) {
    .countdown-top-bar {
      padding-top: 6.5rem !important;
      padding-bottom: 4rem !important;
    }

    .countdown-end-lines {
      gap: 3px;
    }

    .countdown-end-line {
      height: 2px;
    }

    .countdown-boxes-row {
      gap: 4px;
    }

    .modern-countdown-wrapper {
      max-width: 100%;
      padding: 0 0.25rem;
    }

    .modern-countdown-item {
      padding: 0.55rem 0.15rem 0.42rem !important;
      border-radius: 7px !important;
      border-width: 1.5px !important;
      min-height: 70px;
      aspect-ratio: 1 / 1.15;
      box-shadow: 0 4px 12px rgba(0, 58, 119, 0.25), 0 0 9px rgba(178, 216, 31, 0.15);
    }

    .modern-countdown-number {
      font-size: 1.05rem !important;
      text-shadow: none;
    }

    .modern-countdown-label {
      font-size: 0.44rem !important;
      letter-spacing: 0.4px;
      margin-top: 0.22rem;
    }

    .countdown-top-badge {
      font-size: 0.63rem;
      padding: 0.25rem 0.7rem;
      letter-spacing: 0.6px;
      margin-bottom: 0.8rem;
    }

    .hero-content {
      padding-top: 1.5rem;
    }

    .logo-carrera {
      max-height: 180px;
    }

    .section-title {
      font-size: 1.55rem;
    }

    .cta-buttons-ft {
      flex-direction: column;
      width: 100%;
    }

    .btn-cta-primary,
    .btn-cta-secondary {
      width: 100%;
      font-size: 0.85rem;
      padding: 0.85rem 1.2rem;
    }

    .distance-poster-card {
      height: 420px;
    }

    .stage-card {
      padding: 1.8rem 1.4rem;
    }

    .stage-price {
      font-size: 2.4rem;
    }
  }

  /* =============================================================
     SECCIÓN LEAD FEMTRIBE 2.0 (AZUL CLARO OFICIAL)
     ============================================================= */
  .section-femtribe-lead {
    width: 100%;
    background-color: #41CEB3;
    padding: 9rem 0 3.8rem 0;
  }

  /* COLUMNA IZQUIERDA: banner.png */
  .ft-lead-banner-wrapper {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 1rem;
  }
  .ft-lead-banner {
    display: block;
    max-width: 100%;
    max-height: 260px;
    width: auto;
    height: auto;
    background-color: transparent;
    object-fit: contain;
    mix-blend-mode: multiply;   /* elimina fondo blanco si el PNG lo trae embebido */
    filter: drop-shadow(0 6px 16px rgba(0, 58, 119, 0.1));
  }

  /* Subtítulo FECHA: misma tipografía y color que el título "¿ESTÁS LISTO?",
     PERO se mantiene el tamaño de letra actual (font-size no se toca). */
  .ft-lead-date {
    font-family: 'Impact', 'Anton', 'League Spartan', 'Oswald', 'Montserrat', sans-serif;
    font-weight: 1000;
    font-style: normal;
    font-size: clamp(0.95rem, 1.3vw, 1.1rem);
    letter-spacing: 0.9px;
    color: #003A77;
    text-transform: uppercase;
    margin: 0;
    text-align: center;
    line-height: 1.2;
    -webkit-font-smoothing: antialiased;
  }

  /* Título principal — ¿ESTÁS LISTO? AZUL OSCURO OFICIAL.
     POSICIONAMIENTO: centrado ABSOLUTO respecto a TODA la sección
     (no a la columna del form). Por eso usamos position:absolute +
     transform(-50%) tomando como referencia .section-femtribe-lead. */
  .section-femtribe-lead { position: relative; }
  .ft-lead-title {
    position: absolute;
    top: 2.2rem;
    left: 50%;
    transform: translateX(-50%);
    width: fit-content;
    max-width: 92%;
    font-family: 'Impact', 'Anton', 'League Spartan', 'Oswald', 'Montserrat', sans-serif;
    font-weight: 1000;
    font-style: normal;
    font-size: clamp(1.45rem, 2.35vw, 2.2rem);
    letter-spacing: 0.9px;
    color: #003A77;
    text-transform: uppercase;
    margin: 0;
    line-height: 1.05;
    text-align: center;
    -webkit-font-smoothing: antialiased;
  }

  /* Subtítulo — BLANCO. Centrado horizontal respecto a TODA la sección
     (mismo sistema que el título: absolute + left:50% + translateX).
     Separación del borde superior para que quede bajo el título flotante
     y con respiro respecto al bloque aliados. */
  .ft-lead-subtitle {
    position: absolute;
    top: 4.8rem;
    left: 50%;
    transform: translateX(-50%);
    width: fit-content;
    max-width: 92%;
    font-family: 'Montserrat', sans-serif;
    font-weight: 500;
    font-size: clamp(0.95rem, 1.2vw, 1.1rem);
    color: #FFFFFF;
    margin: 0;
    line-height: 1.4;
    text-align: center;
  }

  /* Formulario wrapper */
  .ft-lead-form {
    width: 100%;
    max-width: 100%;
  }

  /* Labels (AZUL OSCURO OFICIAL) */
  .ft-lead-label {
    display: inline-block;
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: clamp(0.9rem, 1.05vw, 1rem);
    color: #003A77;
    letter-spacing: 0.2px;
    margin-bottom: 0.45rem;
    padding-left: 2px;
  }

  /* Inputs: BLANCOS con BORDE VERDE OFICIAL */
  .ft-lead-input {
    width: 100%;
    background-color: #FFFFFF !important;
    border: 2.5px solid #B2D81F !important;
    border-radius: 8px;
    color: #003A77;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.95rem;
    font-weight: 500;
    padding: 0.7rem 1rem;
    transition: all 0.25s ease;
    outline: none !important;
    box-shadow: none !important;
  }

  .ft-lead-input::placeholder {
    color: rgba(0, 58, 119, 0.4);
    font-weight: 400;
  }

  .ft-lead-input:focus {
    border-color: #003A77 !important;
    background-color: #FFFFFF !important;
    box-shadow: 0 0 0 3px rgba(0, 58, 119, 0.08) !important;
  }

  .ft-lead-textarea {
    min-height: 120px;
    resize: vertical;
    line-height: 1.5;
  }

  /* Botón enviar: verde lima */
  .ft-lead-btn {
    background-color: #B2D81F;
    color: #003A77;
    border: 2px solid #B2D81F;
    border-radius: 8px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 0.95rem;
    letter-spacing: 0.6px;
    text-transform: uppercase;
    padding: 0.65rem 2rem;
    cursor: pointer;
    transition: all 0.25s ease;
    box-shadow: 0 5px 14px rgba(178, 216, 31, 0.28);
  }

  .ft-lead-btn:hover {
    background-color: #003A77;
    color: #FFFFFF;
    border-color: #003A77;
    transform: translateY(-2px);
    box-shadow: 0 9px 20px rgba(0, 58, 119, 0.25);
  }

  @media (max-width: 991.98px) {
    .section-femtribe-lead {
      padding: 7.4rem 0 3rem 0;
    }
    .ft-lead-title {
      font-size: clamp(1.35rem, 3vw, 2rem);
      top: 2rem;
    }
    .ft-lead-subtitle {
      top: 4.5rem;
      font-size: 0.98rem;
    }
    .ft-lead-banner {
      max-height: 210px;
    }
  }

  @media (max-width: 768px) {
    .section-femtribe-lead {
      padding: 7rem 0 2.6rem 0;
    }
    .ft-lead-title {
      font-size: clamp(1.25rem, 5.8vw, 1.8rem);
      top: 1.7rem;
    }
    .ft-lead-subtitle {
      top: 4.2rem;
      font-size: 0.92rem;
      padding: 0 0.5rem;
    }
    .ft-lead-banner {
      max-height: 170px;
    }
    .ft-lead-input {
      padding: 0.7rem 0.95rem;
      border-width: 2px;
    }
    .ft-lead-btn {
      width: 100%;
      padding: 0.75rem 0;
    }
    .ft-lead-textarea {
      min-height: 110px;
    }
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

  document.addEventListener('DOMContentLoaded', function () {
    const heroCarouselEl = document.getElementById('heroCarousel');
    let heroCarousel = null;
    let heroAutoplayTimer = null;
    const HERO_INTERVAL_MS = 3000;

    function startHeroAutoplay() {
      if (heroAutoplayTimer) clearInterval(heroAutoplayTimer);
      heroAutoplayTimer = setInterval(function () {
        if (heroCarousel) heroCarousel.next();
      }, HERO_INTERVAL_MS);
    }

    if (heroCarouselEl && window.bootstrap && bootstrap.Carousel) {
      // Inicialización ÚNICA de Bootstrap (sin ride, para no pelear con setInterval)
      heroCarousel = new bootstrap.Carousel(heroCarouselEl, {
        interval: false,
        ride: false,
        wrap: true,
        pause: false,
        touch: true,
        keyboard: true
      });

      // Autoplay MANUAL (100% confiable, no se traba en foto 1, no se detiene al dar wrap)
      startHeroAutoplay();

      // Si el usuario hace click en un indicador o slide, reiniciar timer para no saltar de foto 2s despues
      heroCarouselEl.addEventListener('slide.bs.carousel', function () {
        startHeroAutoplay();
      });

      // Pausa al hacer hover (mejor UX) — reanudar al salir
      heroCarouselEl.addEventListener('mouseenter', function () {
        if (heroAutoplayTimer) clearInterval(heroAutoplayTimer);
      });
      heroCarouselEl.addEventListener('mouseleave', function () {
        startHeroAutoplay();
      });
    }

    const video = document.getElementById('femtribeVideo');
    const overlay = document.getElementById('playButtonOverlay');
    if (video && overlay) {
      video.addEventListener('pause', () => overlay.classList.remove('hidden'));
      video.addEventListener('ended', () => overlay.classList.remove('hidden'));
      video.addEventListener('play', () => overlay.classList.add('hidden'));
    }

    // Dynamic login check for buttons
    const inscribeteBtns = document.querySelectorAll('.inscribete-btn-link');
    inscribeteBtns.forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        if (window.FEMTRIBE_CONFIG && !window.FEMTRIBE_CONFIG.registrationsEnabled) {
          e.preventDefault();
          window.showProximamenteModal('inscripciones');
          return false;
        }
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