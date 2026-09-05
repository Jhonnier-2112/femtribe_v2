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

          <a href="/consulta_inscripcion" class="btn-consulta-inscripcion">
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
     SECCIÓN: RICAURTE (LA FOTO DE LA IGLESIA ES LA PROTAGONISTA)
     ========================================================================= -->
<!-- =========================================================================
     SECCIÓN: INFORMACIÓN DE RICAURTE (FONDO AZUL OSCURO OFICIAL)
     ========================================================================= -->
<section class="section-ricaurte-info py-5">
  <div class="container py-3">
    <div class="row justify-content-center text-center">
      <div class="col-12 col-lg-10 col-xl-9" data-aos="fade-up" data-aos-duration="800">
        
        <p class="ricaurte-info-text mb-4">
          <strong>Ricaurte, Cundinamarca</strong>, el escenario perfecto para vivir la experiencia. Te recibe con su clima cálido, la fuerza del <strong>río Magdalena</strong> y la hospitalidad de una comunidad que sabe hacerte sentir en casa.
        </p>

        <p class="ricaurte-info-text mb-4">
          Sus paisajes, sus lugares emblemáticos y la energía de su gente serán el escenario de <strong>CORRE CON FEMTRIBE 2.0</strong>, una experiencia donde cada kilómetro te permitirá descubrir un destino que <strong>se vive, se disfruta y se queda en la memoria.</strong>
        </p>

        <div class="mt-4 pt-2">
          <a href="https://www.instagram.com/alcaldiadericaurtecundinamarca?igsi=azRvd3FyNjF1bXZv" target="_blank" rel="noopener noreferrer" class="btn-ricaurte-ig">
            CONOCE MÁS DE RICAURTE AQUÍ
          </a>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     SECCIÓN: FOTO DE LA IGLESIA (SOLO LA IMAGEN A TAMAÑO COMPLETO SIN TEXTO)
     ========================================================================= -->
<section class="section-iglesia-full p-0 overflow-hidden" data-aos="fade-up">
  <img src="assets/img/CorreconFemtribe2.0/iglesia.png" alt="Iglesia de Ricaurte - Corre Con FEMTRIBE 2.0" class="img-fluid w-100 d-block img-iglesia-standalone">
</section>










<!-- =========================================================================
     SECCIÓN: PATROCINADORES Y ALIADOS OFICIALES (FONDO VERDE OFICIAL #B2D81F)
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
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>

<!-- =========================================================================
     SECCIÓN: ¿ESTÁS LISTO? — LEAD / CONTACTO (FONDO AZUL CLARO OFICIAL)
     ========================================================================= -->
<section class="section-femtribe-lead" id="lead-femtribe">
  <div class="container">
    <div class="row align-items-center justify-content-between g-4 g-lg-5">

      <!-- COLUMNA IZQUIERDA: banner.png centrado + FECHA en blanco -->
      <div class="col-12 col-lg-5 text-center ft-col-left aos-init aos-animate" data-aos="fade-right">
        <p class="ft-lead-date">FECHA: 14 Y 15 DE NOVIEMBRE</p>
        <div class="ft-lead-banner-wrapper">
          <img src="assets/img/CorreconFemtribe2.0/CCF-logo-blanco.png" alt="Logo Corre Con FEMTRIBE 2.0" class="ft-lead-banner img-fluid" onerror="this.onerror=null;this.src='assets/img/banner_camiseta_carrera.png';">
        </div>
      </div>

      <!-- COLUMNA DERECHA: título + subtítulo + formulario -->
      <div class="col-12 col-lg-7" data-aos="fade-left">
        <h2 class="ft-lead-title">¿ESTÁS LISTO?</h2>
        <p class="ft-lead-subtitle">Déjanos tus datos para brindarte toda la información.</p>
        <form class="ft-lead-form" action="/contacto" method="POST" id="leadFormHome">
          <div class="mb-3 mb-md-4">
            <label for="leadNombre" class="ft-lead-label">Nombre</label>
            <input type="text" class="ft-lead-input form-control" id="leadNombre" name="nombre" required placeholder="Tu nombre completo">
          </div>
          <div class="mb-3 mb-md-4">
            <label for="leadEmail" class="ft-lead-label">Correo Electrónico</label>
            <input type="email" class="ft-lead-input form-control" id="leadEmail" name="email" required placeholder="tu@correo.com">
          </div>
          <div class="mb-3 mb-md-4">
            <label for="leadMensaje" class="ft-lead-label">Mensaje</label>
            <textarea class="ft-lead-input ft-lead-textarea form-control" id="leadMensaje" name="mensaje" rows="4" required placeholder="¿En qué podemos ayudarte?"></textarea>
          </div>
          <div id="leadFormFeedback" class="mb-3" style="display: none;"></div>
          <div class="d-flex justify-content-end">
            <button type="submit" class="ft-lead-btn" id="leadSubmitBtn">Enviar</button>
          </div>
        </form>
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

  /* --- FRANJA SUPERIOR COUNTDOWN INDEPENDIENTE (PALETA OFICIAL EVENTO) --- */
  :root {
    --ev-green: #B2D81F;
    --ev-blue-dark: #003A77;
    --ev-blue-light: #41CEB3;
    --ev-white: #ffffff;
  }

  .countdown-top-bar {
    background-color: var(--ev-blue-light);
    position: relative;
    padding-top: 8.5rem !important;
    padding-bottom: 2.5rem !important;
    overflow: hidden;
  }

  .countdown-top-bar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent 0%, var(--ev-green) 50%, transparent 100%);
    opacity: 0.7;
  }

  .countdown-top-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(0, 58, 119, 0.18);
    border: 1px solid rgba(0, 58, 119, 0.35);
    color: var(--ev-blue-dark);
    padding: 0.4rem 1.1rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 800;
    letter-spacing: 1.3px;
    text-transform: uppercase;
    backdrop-filter: blur(10px);
    margin-bottom: 1.2rem;
  }

  .modern-countdown-wrapper {
    max-width: 500px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
  }

  /* ESTRUCTURA PRINCIPAL FLEX: [LÍNEAS IZQ] [4 CUADROS] [LÍNEAS DER] */
  .countdown-ends-row {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    gap: 0;
    margin: 0;
    flex-wrap: nowrap;
    position: relative;
    z-index: 2;
  }

  /* Grupos de 3 líneas EN LOS EXTREMOS — salen HACIA AFUERA de los cuadros laterales */
  .countdown-end-lines {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 4px;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1;
    pointer-events: none;
  }

  /* LÍNEAS IZQUIERDA: nacen en el BORDE IZQUIERDO del bloque de cuadros → van HACIA LA IZQUIERDA hasta el borde pantalla */
  .countdown-lines-left {
    right: calc(100% + 0px);
    width: 9999px;
    max-width: 9999px;
  }

  /* LÍNEAS DERECHA: nacen en el BORDE DERECHO del bloque de cuadros → van HACIA LA DERECHA hasta el borde pantalla */
  .countdown-lines-right {
    left: calc(100% + 0px);
    width: 9999px;
    max-width: 9999px;
  }

  .countdown-end-line {
    display: block;
    height: 3.5px;
    background-color: var(--ev-white);
    border-radius: 3px;
    width: 100%;
  }

  /* Gradientes en las líneas para efecto de fundido natural al salir de los cuadros */
  .countdown-lines-left .countdown-end-line {
    background: linear-gradient(270deg, var(--ev-white) 0%, transparent 30%);
  }

  .countdown-lines-right .countdown-end-line {
    background: linear-gradient(90deg, var(--ev-white) 0%, transparent 30%);
  }

  /* Fila de los 4 CUADROS IGUALES (centrados, TAMAÑO REDUCIDO, ESTÉTICO Y SIMÉTRICO) */
  .countdown-boxes-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    justify-items: center;
    flex: 0 0 auto;
    width: 100%;
    margin: 0;
  }

  .countdown-boxes-row .modern-countdown-item {
    width: 100%;
    min-width: 0;
  }

  /* Cuadros: CASI CUADRADOS, TAMAÑO MÁS PEQUEÑO, ESTÉTICO Y SIMÉTRICO */
  .modern-countdown-item {
    background-color: var(--ev-blue-dark) !important;
    border: 1.5px solid var(--ev-green) !important;
    border-radius: 10px;
    padding: 0.8rem 0.4rem 0.65rem !important;
    min-height: 95px;
    aspect-ratio: 1 / 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    box-shadow: 0 6px 18px rgba(0, 58, 119, 0.28), 0 0 12px rgba(178, 216, 31, 0.18);
    transition: transform 0.25s ease, border-color 0.25s ease;
    text-align: center;
    position: relative;
    z-index: 3;
  }

  .modern-countdown-item:hover {
    transform: translateY(-2px);
    border-color: var(--ev-green) !important;
  }

  .modern-countdown-number {
    font-size: 2.2rem !important;
    font-weight: 900 !important;
    color: var(--ev-green) !important;
    line-height: 1;
    display: block;
    font-family: 'Montserrat', sans-serif;
    text-shadow: 0 1px 5px rgba(178, 216, 31, 0.28);
    margin: 0;
  }

  .modern-countdown-label {
    font-size: 0.7rem !important;
    font-weight: 700 !important;
    color: var(--ev-white) !important;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    margin-top: 0.9rem;
    display: block;
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
    animation: none !important;
    transform: none !important;
    transition: transform 0.5s ease !important;
  }

  .hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(180deg,
        rgba(13, 13, 16, 0.4) 0%,
        rgba(13, 13, 16, 0.5) 50%,
        rgba(13, 13, 16, 0.7) 100%);
  }

  .hero-content {
    z-index: 10;
    display: block;
    pointer-events: none;
  }

  .hero-content>.container {
    height: 100%;
    position: relative;
    pointer-events: none;
    padding: 0;
  }

  .hero-content .logo-wrapper,
  .hero-content .logo-wrapper *,
  .hero-content .cta-buttons-ft,
  .hero-content .cta-buttons-ft * {
    pointer-events: auto;
  }

  .hero-content .logo-wrapper {
    position: absolute;
    top: 15.5rem;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    margin-bottom: 0;
  }

  .hero-content .cta-buttons-ft {
    position: absolute;
    bottom: 5.3rem;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    margin: 0;
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
    filter: drop-shadow(0 8px 24px rgba(0, 0, 0, 0.7));
    transition: transform 0.3s ease;
  }

  .logo-carrera:hover {
    transform: scale(1.02);
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
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4), var(--ft-glow-green);
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
    background: #B2D81F;
    /* 🟩 VERDE OFICIAL */
    color: #000000 !important;
    /* ⬛ LETRA NEGRA */
    font-weight: 900;
    font-size: 0.95rem;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding: 0.95rem 2.4rem;
    border-radius: 50px;
    border: none;
    text-decoration: none;
    box-shadow: 0 6px 20px rgba(178, 216, 31, 0.35);
    transition: all 0.25s cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  .btn-cta-primary:hover {
    background: #c6ec32;
    /* hover: verde un poco más brillante */
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 10px 30px rgba(178, 216, 31, 0.55);
    color: #000000 !important;
  }

  .btn-cta-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #003A77;
    color: #ffffff !important;
    font-weight: 700;
    font-size: 0.95rem;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    padding: 0.95rem 2.2rem;
    border-radius: 50px;
    border: 2px solid rgba(255, 255, 255, 0.55);
    text-decoration: none;
    backdrop-filter: blur(10px);
    transition: all 0.25s ease;
  }

  .btn-cta-secondary:hover {
    background: #004a93;
    border-color: #41CEB3;
    color: #ffffff !important;
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
    background-color: rgba(178, 216, 31, 0.5);
    /* 🟩 verde 50% opaco */
    border: none;
    transition: all 0.3s ease;
  }

  .carousel-indicators-ft .active {
    width: 75px;
    background-color: #B2D81F;
    /* 🟩 VERDE OFICIAL 100% */
    box-shadow: 0 0 12px rgba(178, 216, 31, 0.75);
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

  /* --- SECCIÓN: MUCHO MÁS QUE UNA CARRERA (fondo AZUL OSCURO OFICIAL) --- */
  .more-than-race {
    background-color: #003A77;
  }

  /* TÍTULO PRINCIPAL: TAMAÑO EXACTO IGUAL A "EQUIPAMIENTO PRO" (section-tagline)
   NO tan grande, tal como lo dejaste tú — verde oficial */
  .mtr-main-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 0.85rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #B2D81F;
    margin-bottom: 0.4rem;
    text-align: center;
    display: block;
  }

  /* Párrafos — rediseño tipográfico limpio y profesional */
  .mtr-paragraph {
    font-family: 'Inter', 'Montserrat', sans-serif;
    font-size: 1.15rem;
    line-height: 1.95;
    color: rgba(255, 255, 255, 0.94);
    margin: 0 auto 1.8rem auto;
    max-width: 1020px;
    letter-spacing: 0.25px;
    font-weight: 400;
    text-align: center;
  }

  /* Párrafo UNICO (2 frases juntas): ANCHO MÁS GRANDE + TAMAÑO LIGERAMENTE MÁS PEQUEÑO
   → FUERZA que quede EN 2 LÍNEAS (nunca 3) */
  .mtr-paragraph--two-lines {
    max-width: 1380px;
    /* casi todo el ancho desktop */
    font-size: 1.07rem;
    /* 8% más pequeño */
    line-height: 1.75;
    /* interlineado más compacto */
    margin-bottom: 0;
  }

  @media (min-width: 1200px) {
    .mtr-paragraph--two-lines {
      max-width: 1420px;
      font-size: 1.05rem;
    }
  }

  @media (max-width: 1199.98px) {
    .mtr-paragraph--two-lines {
      max-width: 100%;
    }
  }

  .mtr-paragraph:last-child {
    margin-bottom: 0;
  }

  .mtr-strong {
    color: #B2D81F;
    font-weight: 700;
    letter-spacing: 0.15px;
  }

  /* =========================================================================
   3 TARJETAS DE DISTANCIAS · TARJETA ÚNICA CONTINUA
   (imagen + info fusionados DENTRO del mismo border-radius)
   ========================================================================= */

  /* CONTENEDOR PADRE: controla border-radius, overflow:hidden y HOVER CONJUNTO */
  .distance-card {
    position: relative;
    width: 100%;
    border-radius: 30px;
    overflow: hidden;
    /* ← CLAVE: corta esquinas de imagen + info → UNA SOLA PIEZA */
    box-shadow:
      0 14px 34px rgba(0, 0, 0, 0.22),
      0 6px 14px rgba(0, 0, 0, 0.12);
    transition: all 0.32s cubic-bezier(.2, .7, .2, 1);
    background: transparent;
  }

  .distance-card:hover {
    transform: translateY(-7px);
    /* ← TODO se eleva JUNTO: imagen + info */
    box-shadow:
      0 24px 54px rgba(0, 0, 0, 0.30),
      0 10px 24px rgba(0, 0, 0, 0.18);
  }

  /* La tarjeta de imagen AHORA NO tiene radio/sombra propios → lo hereda el padre */
  .distance-image-card {
    position: relative;
    display: block;
    width: 100%;
    height: 100%;
    min-height: 520px;
    border-radius: 0;
    /* ← QUITADO: radio en el padre .distance-card */
    overflow: visible;
    box-shadow: none;
    /* ← QUITADO: sombra en el padre */
    transition: none;
    /* ← QUITADO: hover en el padre */
    text-decoration: none;
  }

  .distance-image-card:hover {
    transform: none;
    /* ← QUITADO: translate en el padre */
    box-shadow: none;
    text-decoration: none;
  }

  /* Tarjeta con botón + info abajo: imagen MÁS ALTA para mostrar logos inferiores (400px → 430px desktop) */
  .distance-image-card--with-btn {
    min-height: 430px;
  }

  /* La imagen OCUPA TODO el cuadro (punta a punta) */
  .distance-image-card__img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center center;
    display: block;
  }

  /* =========================================================
   BLOQUE INFO · BASE INFERIOR DE LA TARJETA (CONTINUO)
   Raya superior VERDE 2px EXTREMO A EXTREMO (única marca)
   Fondo azul 14% opacidad · Textos CENTRADOS (póster profesional)
   ========================================================= */

  .distance-info-block {
    width: 100%;
    /* ← ANCHO COMPLETO de la tarjeta */
    max-width: none;
    margin: 0;
    /* ← PEGADO a la imagen: 0 margen */
    padding: 1.25rem 1.1rem 1.35rem 1.1rem;

    /* CLAVE SIMETRÍA TOTAL: MISMA ALTURA en las 3 tarjetas (sin importar líneas texto) */
    min-height: 210px;
    /* ← altura fija: 3K/5K/10K quedan EXACTAMENTE iguales */
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;

    /* FONDO: BLANCO (neutro limpio, contrasta TOTAL sobre el fondo sección azul oscuro) */
    background: #ffffff;

    /* RAYA VERDE CONTINUA 2px EXTREMO A EXTREMO (marca visual limpia, sin cortes) */
    border-top: 2px solid #B2D81F;
    border-left: none;
    border-right: none;
    border-bottom: none;
    border-radius: 0;
    /* ← SIN redondez: esquinas inf cortadas por overflow padre */

    text-align: center;
    /* ← CENTRADO = equilibrio póster */
    position: relative;
    transition: background 0.3s ease, box-shadow 0.3s ease;
  }

  .distance-card:hover .distance-info-block {
    background: #fafcff;
    /* hover: blanco + azulado sútil (no agresivo) */
    box-shadow: inset 0 2px 14px rgba(0, 58, 119, 0.06);
    /* sombra interna muy ligera */
  }

  /* Header: SIN barrita izquierda pseudo → la marca es la raya superior CONTINUA */
  .distance-info-block__header {
    position: relative;
    padding-left: 0;
    margin-bottom: 0.55rem;
    width: 100%;
  }

  /* Título: AZUL OSCURO OFICIAL + fw900 + tamaño aumentado */
  .distance-info-block__title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 900;
    font-size: 1.02rem;
    /* antes 0.9rem → +13% tamaño letra (SÓLO letra) */
    line-height: 1.35;
    letter-spacing: 0.4px;
    color: #003A77;
    /* � AZUL OSCURO OFICIAL (definitivo) */
    margin: 0;
  }

  /* Descripción: AZUL OSCURO suavizado + tamaño aumentado */
  .distance-info-block__desc {
    font-family: 'Inter', 'Montserrat', sans-serif;
    font-weight: 500;
    font-size: 0.96rem;
    /* antes 0.86rem → +12% tamaño letra (SÓLO letra) */
    line-height: 1.58;
    letter-spacing: 0.15px;
    color: #1a4a7a;
    /* azul oscuro + claro (100% opaco, no tan duro como #000) */
    margin: 0 auto 0.95rem auto;
    max-width: 330px;
    /* un poco + ancho (310→330 para que las letras nuevas quepan bien */
    flex-grow: 0;
    flex-shrink: 0;
  }

  /* Botón SEMI-PILL compacto CENTRADO · AZUL CLARO OFICIAL + AZUL OSCURO (premium sobre blanco) */
  .distance-info-block__btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.6rem 1.55rem;
    background: #41CEB3;
    color: #003A77;
    border: 1.5px solid #41CEB3;
    border-radius: 14px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 0.79rem;
    letter-spacing: 0.95px;
    text-transform: uppercase;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 5px 14px rgba(65, 206, 179, 0.32);
    margin: auto auto 0 auto;
    /* ← margin-top auto: BOTÓN ALINEADO SIEMPRE AL FONDO (simetría 3 tarjetas) */
    flex-shrink: 0;
  }

  .distance-info-block__btn:hover {
    background: #003A77;
    /* hover: AZUL OSCURO OFICIAL + BLANCO (inversión elegante) */
    color: #ffffff;
    border-color: #003A77;
    transform: translateY(-1.5px);
    box-shadow: 0 8px 20px rgba(0, 58, 119, 0.32);
    text-decoration: none;
  }

  /* --- Responsive tarjeta CONTINUA + bloque info (imagenes ALTAS +30px para logos | tamaños letra AUMENTADOS) --- */
  @media (max-width: 1199.98px) {
    .distance-image-card {
      min-height: 460px;
    }

    .distance-image-card--with-btn {
      min-height: 400px;
    }

    .distance-info-block {
      padding: 1.15rem 1rem 1.25rem 1rem;
      min-height: 215px;
      /* ← +10px por las letras + grandes */
    }

    .distance-info-block__header {
      margin-bottom: 0.5rem;
    }

    .distance-info-block__title {
      font-size: 0.98rem;
    }

    /* antes 0.87rem → +13% */
    .distance-info-block__desc {
      font-size: 0.94rem;
      margin-bottom: 0.88rem;
      max-width: 310px;
    }

    /* antes 0.84rem→+12% | 290→310px ancho */
    .distance-info-block__btn {
      padding: 0.57rem 1.5rem;
      font-size: 0.78rem;
    }
  }

  @media (max-width: 991.98px) {
    .mtr-paragraph {
      font-size: 1.05rem;
      line-height: 1.9;
    }

    .distance-card {
      border-radius: 26px;
    }

    .distance-image-card {
      min-height: 440px;
    }

    .distance-image-card--with-btn {
      min-height: 460px;
    }

    .distance-info-block {
      padding: 1.1rem 0.95rem 1.2rem 0.95rem;
      min-height: 215px;
    }
  }

  @media (max-width: 767.98px) {
    .distance-image-card {
      min-height: 480px;
    }

    .distance-image-card--with-btn {
      min-height: 500px;
    }

    .distance-info-block {
      padding: 1.05rem 0.9rem 1.15rem 0.9rem;
      min-height: 210px;
    }

    .distance-info-block__header {
      margin-bottom: 0.48rem;
    }

    .distance-info-block__title {
      font-size: 0.95rem;
    }

    /* antes 0.85rem → +12% */
    .distance-info-block__desc {
      font-size: 0.93rem;
      line-height: 1.55;
      margin-bottom: 0.85rem;
      max-width: 310px;
    }

    /* antes 0.85rem→+9% | 290→310px */
    .distance-info-block__btn {
      padding: 0.55rem 1.45rem;
      font-size: 0.79rem;
    }
  }

  @media (max-width: 576px) {
    .mtr-paragraph {
      font-size: 0.98rem;
      line-height: 1.85;
    }

    .distance-card {
      border-radius: 22px;
    }

    .distance-image-card {
      min-height: 430px;
    }

    .distance-image-card--with-btn {
      min-height: 465px;
    }

    .distance-info-block {
      padding: 1rem 0.85rem 1.1rem 0.85rem;
      border-top-width: 1.8px;
      min-height: 208px;
    }

    .distance-info-block__header {
      margin-bottom: 0.45rem;
    }

    .distance-info-block__title {
      font-size: 0.95rem;
      letter-spacing: 0.25px;
    }

    /* antes 0.85rem → +12% */
    .distance-info-block__desc {
      font-size: 0.94rem;
      line-height: 1.52;
      margin-bottom: 0.82rem;
      max-width: 300px;
    }

    /* antes 0.86rem→+9% | 280→300px */
    .distance-info-block__btn {
      padding: 0.53rem 1.4rem;
      font-size: 0.78rem;
      border-radius: 13px;
    }
  }

  /* =========================================================================
   ZONA CONSULTA DE INSCRIPCIÓN (2 columnas: texto IZQ + foto DIFUMINADA DER)
   Inspirado en MMM: foto asimétrica derecha, blend con fondo azul oscuro
   ========================================================================= */

  .consulta-inscripcion {
    position: relative;
    width: 100%;
    min-height: 520px;
    display: flex;
    align-items: center;
  }

  /* COLUMNA IZQUIERDA: texto + botón (alineado centro-izquierda) */
  .consulta-inscripcion__text-col {
    position: relative;
    z-index: 5;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .consulta-inscripcion__text-wrap {
    max-width: 560px;
    margin: 0 0 0 auto;
    /* desplazado a la DERECHA para estar más cerca de la atleta */
    padding: 1rem 1.8rem 1rem 1.2rem;
    /* padding vertical equilibrado para centrado vertical */
    text-align: left;
  }

  /* Título principal estilo MMM */
  .consulta-inscripcion__title {
    font-family: 'Montserrat', sans-serif;
    font-size: clamp(1.9rem, 2.8vw, 2.7rem);
    font-weight: 800;
    line-height: 1.2;
    letter-spacing: 0.4px;
    color: #B2D81F;
    /* VERDE OFICIAL (igual que MMM amarillo neon) */
    margin: 0 0 0.3rem 0;
    /* ANTES 0.6rem → MÍNIMO 0.3rem */
    text-align: left;
  }

  /* Subtítulo */
  .consulta-inscripcion__subtitle {
    font-family: 'Inter', 'Montserrat', sans-serif;
    font-size: 1.05rem;
    line-height: 1.65;
    color: rgba(255, 255, 255, 0.88);
    margin: 0 0 0.8rem 0;
    /* ANTES 1.3rem → MUY POCO espacio para botón */
    max-width: 500px;
    text-align: left;
    font-weight: 400;
  }

  /* BOTÓN CONSULTA INSCRIPCIÓN: AZUL CLARO OFICIAL + LETRA NEGRA */
  .btn-consulta-inscripcion {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.72rem 1.9rem;
    /* ANTES 0.85rem 2.2rem → BOTÓN MÁS COMPACTO */
    background: #41CEB3;
    /* fondo AZUL CLARO OFICIAL */
    color: #000000;
    /* letras NEGRAS */
    border: 2px solid #41CEB3;
    /* borde mismo azul claro (no borde blanco) */
    border-radius: 999px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 0.88rem;
    /* un poco más pequeño todavía */
    letter-spacing: 1.05px;
    text-transform: uppercase;
    text-decoration: none;
    transition: all 0.28s ease;
    box-shadow: 0 8px 22px rgba(65, 206, 179, 0.3);
  }

  .btn-consulta-inscripcion:hover {
    background: #B2D81F;
    /* hover: verde oficial */
    color: #000000;
    border-color: #B2D81F;
    transform: translateY(-2px);
    box-shadow: 0 12px 26px rgba(178, 216, 31, 0.38);
    text-decoration: none;
  }

  /* COLUMNA DERECHA: FOTO DIFUMINADA (asímetrica, sale un poco a la derecha) */
  .consulta-inscripcion__photo-col {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    /* FOTO CENTRADA verticalmente respecto al texto */
    justify-content: flex-end;
    min-height: 390px;
    overflow: visible;
  }
  .consulta-inscripcion__photo {
    max-width: 150%;
    /* 35% MÁS GRANDE que antes (antes 112%) */
    max-height: 700px;
    /* 120px MÁS ALTA que antes (antes 560px) */
    width: auto;
    height: auto;
    object-fit: contain;
    object-position: center right;
    /* Centrado vertical con respecto al contenedor */
    position: relative;
    right: 3rem;
    /* MUCHO más saliente a la derecha */
    top: 0;
    /* Centrado vertical con el texto */
    display: block;

    /* 🔑 FOTO NÍTIDA (no blend):
     - quitamos mix-blend-mode (ya no se "fusiona" con el fondo azul, se VE CLARA)
     - opacity 100% (completamente visible)
     - solo drop-shadow elegante */
    opacity: 1;
    filter:
      drop-shadow(-18px 22px 36px rgba(0, 0, 0, 0.42)) contrast(1.02);
  }

  /* --- Responsive Consulta Inscripción --- */
  @media (max-width: 1399.98px) {
    .consulta-inscripcion__photo {
      max-width: 130%;
      max-height: 560px;
      right: -3.5rem;
    }

    .consulta-inscripcion__photo-col {
      min-height: 510px;
    }
  }

  @media (max-width: 1199.98px) {
    .consulta-inscripcion {
      min-height: 460px;
    }

    .consulta-inscripcion__photo-col {
      min-height: 460px;
    }

    .consulta-inscripcion__photo {
      max-width: 125%;
      max-height: 520px;
      right: -2.5rem;
    }

    .consulta-inscripcion__text-wrap {
      padding: 1.6rem 2rem 1.6rem 1rem;
    }
  }

  @media (max-width: 991.98px) {

    /* tablet y móviles: se apilan VERTICALMENTE. Foto ARRIBA, texto CENTRADO debajo */
    .consulta-inscripcion {
      min-height: auto;
      margin: 1.8rem 0 1.8rem 0 !important;
    }

    .consulta-inscripcion__photo-col {
      min-height: auto;
      order: 1;
      margin-bottom: 1.2rem;
      /* Espacio de separación entre la foto y el título en pantallas pequeñas */
      justify-content: center;
    }

    .consulta-inscripcion__photo {
      max-height: 400px;
      right: 0;
      bottom: 0;
      max-width: 100%;
    }

    .consulta-inscripcion__text-col {
      order: 2;
    }

    .consulta-inscripcion__text-wrap {
      max-width: 100%;
      margin: 0 auto;
      padding: 0.5rem 1rem 1rem 1rem;
      text-align: center;
    }

    .consulta-inscripcion__title {
      text-align: center;
      margin-bottom: 0.55rem;
    }

    .consulta-inscripcion__subtitle {
      text-align: center;
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 1.1rem;
    }

    .btn-consulta-inscripcion {
      padding: 0.82rem 1.9rem;
      font-size: 0.88rem;
    }
  }

  @media (max-width: 576px) {
    .consulta-inscripcion {
      margin: 1.6rem 0 1.4rem 0 !important;
    }

    .consulta-inscripcion__photo-col {
      min-height: auto;
      margin-bottom: 1rem;
    }

    .consulta-inscripcion__photo {
      max-height: 310px;
      opacity: 1;
    }

    .consulta-inscripcion__text-wrap {
      padding: 0.4rem 0.5rem 0.5rem 0.5rem;
    }

    .consulta-inscripcion__subtitle {
      font-size: 0.93rem;
      margin-bottom: 1.1rem;
    }

    .btn-consulta-inscripcion {
      padding: 0.82rem 1.7rem;
      font-size: 0.84rem;
    }
  }

  /* --- FRANJA CTA: ¡Anímate a vivir esta gran experiencia! --- */
  .cta-accent-bar {
    background-color: #41CEB3;
  }

  .cta-accent-bar__title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    /* antes 800 → MENOS negrilla */
    font-size: clamp(1.45rem, 2.7vw, 2.05rem);
    /* antes clamp(1.6rem,3vw,2.3rem) → LETRA MÁS PEQUEÑA */
    letter-spacing: 0.9px;
    color: #003A77;
    margin: 0;
    text-align: center;
    line-height: 1.3;
  }

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
  const targetDate = new Date("2026-11-14T06:00:00").getTime();

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

    // Formulario ¿ESTÁS LISTO? -> Enviar a MAIL_FROM_ADDRESS (femtribe25@gmail.com) sin redirección
    const leadForm = document.getElementById('leadFormHome');
    const leadFeedback = document.getElementById('leadFormFeedback');
    if (leadForm) {
      leadForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const nombreInput = document.getElementById('leadNombre');
        const emailInput = document.getElementById('leadEmail');
        const mensajeInput = document.getElementById('leadMensaje');
        const submitBtn = document.getElementById('leadSubmitBtn') || leadForm.querySelector('button[type="submit"]');

        const nombre = (nombreInput ? nombreInput.value : '').trim();
        const email = (emailInput ? emailInput.value : '').trim();
        const mensaje = (mensajeInput ? mensajeInput.value : '').trim();

        if (leadFeedback) {
          leadFeedback.style.display = 'none';
          leadFeedback.innerHTML = '';
        }

        if (!nombre || !email || !mensaje) {
          if (leadFeedback) {
            leadFeedback.className = 'alert alert-warning py-2 px-3 small rounded-3';
            leadFeedback.style.display = 'block';
            leadFeedback.textContent = 'Por favor completa todos los campos del formulario.';
          }
          if (!nombre && nombreInput) nombreInput.focus();
          else if (!email && emailInput) emailInput.focus();
          else if (!mensaje && mensajeInput) mensajeInput.focus();
          return;
        }

        const originalBtnContent = submitBtn ? submitBtn.innerHTML : 'Enviar';
        if (submitBtn) {
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Enviando...';
        }

        try {
          const formData = new FormData(leadForm);
          const response = await fetch(leadForm.getAttribute('action') || '/contacto', {
            method: 'POST',
            body: formData,
            headers: {
              'Accept': 'application/json'
            }
          });

          const data = await response.json().catch(() => null);

          if (response.ok && data && data.success) {
            leadForm.reset();
            if (leadFeedback) {
              leadFeedback.className = 'alert py-2 px-3 small rounded-3 fw-semibold';
              leadFeedback.style.backgroundColor = '#B2D81F';
              leadFeedback.style.color = '#003A77';
              leadFeedback.style.border = '1px solid #9dc415';
              leadFeedback.style.display = 'block';
              leadFeedback.textContent = '✓ ' + (data.message || '¡Mensaje enviado con éxito! Te responderemos pronto.');
            }
          } else {
            if (leadFeedback) {
              leadFeedback.className = 'alert alert-danger py-2 px-3 small rounded-3';
              leadFeedback.style.display = 'block';
              leadFeedback.textContent = '✕ ' + ((data && data.message) ? data.message : 'Error al enviar el mensaje. Por favor intenta de nuevo.');
            }
          }
        } catch (err) {
          if (leadFeedback) {
            leadFeedback.className = 'alert alert-danger py-2 px-3 small rounded-3';
            leadFeedback.style.display = 'block';
            leadFeedback.textContent = '✕ Error de conexión al enviar el formulario. Por favor intenta de nuevo.';
          }
        } finally {
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnContent;
          }
        }
      });
    }
  });
</script>

<?php include 'layouts/footer.php'; ?>