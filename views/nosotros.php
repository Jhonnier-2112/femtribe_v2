<?php include 'layouts/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section position-relative d-flex align-items-center justify-content-center text-center" style="min-height: 55vh; background: linear-gradient(135deg, rgba(47, 79, 79, 0.9) 0%, rgba(60, 90, 60, 0.9) 100%); padding-top: 140px; padding-bottom: 60px;">
  <!-- Overlay para mejor contraste -->
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
  
  <div class="container position-relative" style="z-index: 2;">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h1 class="hero-title display-2 fw-bold text-white mb-4" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">
          CONOCE A <span style="color: #B2D81F; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">FEMTRIBE</span>
        </h1>
        <p class="lead text-white mb-0" style="font-size: 1.2rem; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);">
          Una comunidad dedicada a crear espacios seguros y motivadores para todos los corredores
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Organization Section -->
<section class="section py-4">
  <div class="container py-4">
    <div class="row justify-content-center mb-5" data-aos="fade-up">
      <div class="col-lg-7 text-center">
        <h5 class="fw-bold mb-0" style="color: #B2D81F;">NUESTRA HISTORIA</h5>
      </div>
    </div>

    <!-- Historia, Misión y Visión - Diseño Profesional -->
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-lg overflow-hidden" style="min-height: 600px;">
          <div class="row g-0 h-100">
            <!-- Imagen a altura completa con logo como marca de agua -->
            <div class="col-lg-5">
              <div class="position-relative h-100" style="min-height: 400px;">
                <img src="assets/img/historia.png" alt="Historia FEMTRIBE" class="w-100 h-100" style="object-fit: cover;" onerror="this.src='assets/img/logocarrera.png'; this.onerror=null;">
                

                
                <!-- Overlay de texto en la parte inferior -->
                <div class="position-absolute bottom-0 start-0 end-0 bg-gradient-dark text-white p-4" style="background: linear-gradient(transparent, rgba(0,0,0,0.8));">
                  <h4 class="mb-2 fw-bold">FEMTRIBE</h4>
                  <p class="mb-0 fs-6">Cuerpo fuerte, mente libre, alma en tribu</p>
                </div>
              </div>
            </div>
            
            <!-- Contenido -->
            <div class="col-lg-7">
              <div class="p-5 h-100 d-flex flex-column justify-content-center" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                <!-- Historia Completa -->
                <div class="mb-4">
                  <h3 class="h4 fw-bold text-dark mb-3">Historia de transformación </h3>
                  <p class="text-muted mb-3 fs-6">FEMTRIBE nació de una historia de transformación a través del running. Lo que comenzó para una mujer como una forma de escapar de un momento difícil, poco a poco se convirtió en un espacio de libertad, fortaleza y crecimiento.</p>
                  <p class="text-muted mb-3">Kilómetro a kilómetro, correr se convirtió en una manera de volver a encontrarse, recuperar su fuerza y descubrir una nueva versión de sí misma. Sin darse cuenta, su experiencia personal comenzó a inspirar a otras personas y nació una idea: <strong class="ft-nosotros-bold">compartir aquello que el deporte estaba transformando en ella.</strong></p>
                  <p class="text-muted mb-3">Así comenzó FEMTRIBE, con la intención de crear un espacio donde el deporte fuera mucho más que correr: un lugar para conectar, compartir, superarse y disfrutar del camino.</p>
                  <p class="text-muted mb-3">Lo que empezó como una experiencia personal fue creciendo hasta convertirse en una comunidad mixta y abierta, formada por personas con diferentes historias, ritmos y razones para correr, pero unidas por las mismas ganas de avanzar.</p>
                   <p class="text-muted mb-3"><strong class="ft-nosotros-bold">De una historia personal nació una comunidad que sigue creciendo, conectando y transformándose.</strong></p>
                  <p class="text-muted mb-0">Hoy seguimos creyendo en el poder del deporte para transformar, pero sobre todo en el poder de hacerlo juntos. Porque cada persona tiene su propio camino, y cuando esos caminos se encuentran, <strong class="ft-nosotros-bold">corremos en tribu.</strong></p>
                </div>
                
                <!-- Misión y Visión -->
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                      <div class="d-flex align-items-center mb-3">
                        <div class="ft-icon-circle rounded-circle d-flex align-items-center justify-content-center me-3">
                          <i class="fas fa-crosshairs ft-icon-size"></i>
                        </div>
                        <h5 class="fw-bold mb-0" style="color: #B2D81F;">MISIÓN</h5>
                      </div>
                      <p class="text-muted small mb-0">En FEMTRIBE convertimos el deporte en un motor de vida. Creamos experiencias que van más allá del rendimiento: son símbolos de transformación, resiliencia y pertenencia a una tribu que no se detiene.</p>
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <div class="bg-white p-4 rounded-3 shadow-sm h-100">
                      <div class="d-flex align-items-center mb-3">
                          <div class="ft-icon-circle rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="fas fa-binoculars ft-icon-size"></i>
                          </div>
                          <h5 class="fw-bold mb-0" style="color: #B2D81F;">VISIÓN</h5>
                        </div>
                        <p class="text-muted small mb-0">Ser un movimiento global que desafía los límites. Inspirar a millones a transformar su cuerpo, mente y espíritu a través del deporte, siendo la marca que enciende la fuerza de una nueva generación.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Valores del Club - Encapsulados -->
    <div class="container-fluid py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="bg-white rounded-4 shadow-lg p-5">
              <!-- Título de la sección -->
              <div class="text-center mb-4">
                <h5 class="fw-bold mb-3" style="color: #B2D81F;">NUESTROS VALORES</h5>
                <p class="text-muted fs-5">Los pilares que nos definen como tribu</p>
              </div>
              
              <!-- Grid de valores -->
              <div class="row justify-content-center">
                <div class="col-lg-10">
                  <div class="row">
                    <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                      <div class="text-center bg-light p-4 rounded-3 shadow-sm h-100">
                        <div class="ft-icon-circle-lg rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                          <i class="fas fa-users ft-icon-size-lg"></i>
                        </div>
                        <h5 class="fw-bold" style="color: #B2D81F;">Comunidad</h5>
                        <p class="text-muted small mb-0">Unidos por la pasión del deporte y el crecimiento mutuo</p>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                      <div class="text-center bg-light p-4 rounded-3 shadow-sm h-100">
                        <div class="ft-icon-circle-lg rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                          <i class="fas fa-hands-helping ft-icon-size-lg"></i>
                        </div>
                        <h5 class="fw-bold" style="color: #B2D81F;">Inclusión</h5>
                        <p class="text-muted small mb-0">Espacio abierto donde todos encuentran su lugar</p>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                      <div class="text-center bg-light p-4 rounded-3 shadow-sm h-100">
                        <div class="ft-icon-circle-lg rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                          <i class="fas fa-dumbbell ft-icon-size-lg"></i>
                        </div>
                        <h5 class="fw-bold" style="color: #B2D81F;">Empoderamiento</h5>
                        <p class="text-muted small mb-0">Fortaleciendo cuerpo, mente y espíritu</p>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="400">
                      <div class="text-center bg-light p-4 rounded-3 shadow-sm h-100">
                        <div class="ft-icon-circle-lg rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                          <i class="fas fa-medal ft-icon-size-lg"></i>
                        </div>
                        <h5 class="fw-bold" style="color: #B2D81F;">Superación</h5>
                        <p class="text-muted small mb-0">Alcanzando nuevas metas cada día</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Features Section -->
<section class="section py-4 bg-light">
  <div class="container py-6">
    <div class="row justify-content-center mb-4" data-aos="fade-up">
      <div class="col-lg-7 text-center">
        <h5 class="fw-bold mb-4" style="color: #B2D81F;">¿POR QUÉ CORRER CON NOSOTROS?</h5>
        <h2 class="display-7 fw-bold">Una experiencia única para todos</h2>
      </div>
    </div>
    
    <!-- Video Section -->
    <div class="row justify-content-center mb-5" data-aos="fade-up" data-aos-delay="100">
      <div class="col-lg-9">
        <div class="video-container position-relative">
          <div class="video-wrapper-nosotros">
            <video 
              id="velocidadVideo"
              class="w-100" 
              controls 
              poster="assets/img/CorreconFemtribe2.0/portada_video.png"
              style="height: 600px; object-fit: cover;"
              preload="metadata"
            >
              <source src="assets/img/CorreconFemtribe2.0/video_nosotros.MOV" type="video/mp4">
              Tu navegador no soporta el elemento de video.
            </video>
            
            <!-- Custom Play Button Overlay -->
            <div class="play-button-overlay-nosotros position-absolute top-50 start-50 translate-middle" id="playButtonOverlayNosotros">
              <button class="custom-play-btn-nosotros" onclick="playVideoNosotros()">
                <i class="fas fa-play"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <style>
    .video-wrapper-nosotros {
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0,0,0,0.5);
      background: linear-gradient(45deg, #B2D81F, #41CEB3);
      padding: 4px;
    }
    
    .video-wrapper-nosotros video {
      border-radius: 16px;
      transition: all 0.3s ease;
    }
    
    .video-wrapper-nosotros:hover video {
      transform: scale(1.02);
    }
    
    .custom-play-btn-nosotros {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: linear-gradient(135deg, #B2D81F, #41CEB3);
      border: none;
      color: white;
      font-size: 24px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 10px 30px rgba(135, 204, 62, 0.4);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .custom-play-btn-nosotros:hover {
      transform: scale(1.1);
      box-shadow: 0 15px 40px rgba(135, 204, 62, 0.6);
    }
    
    .custom-play-btn-nosotros i {
      margin-left: 3px;
    }
    
    .play-button-overlay-nosotros {
      opacity: 1;
      transition: opacity 0.3s ease;
      z-index: 10;
    }
    
    .play-button-overlay-nosotros.hidden {
      opacity: 0;
      pointer-events: none;
    }
    </style>
    
    <script>
    function playVideoNosotros() {
      const video = document.getElementById('velocidadVideo');
      const overlay = document.getElementById('playButtonOverlayNosotros');
      
      if (video.paused) {
        video.play();
        overlay.classList.add('hidden');
      }
    }
    
    document.getElementById('velocidadVideo').addEventListener('pause', function() {
      const overlay = document.getElementById('playButtonOverlayNosotros');
      overlay.classList.remove('hidden');
    });
    
    document.getElementById('velocidadVideo').addEventListener('ended', function() {
      const overlay = document.getElementById('playButtonOverlayNosotros');
      overlay.classList.remove('hidden');
    });
    </script>
    <div class="row">
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card h-100 border-0 shadow-sm p-4 feature-card">
          <div class="card-body">
            <div class="ft-icon-circle-xl rounded-circle mb-4 d-flex align-items-center justify-content-center">
              <i class="fas fa-map-marked-alt ft-icon-size-xl"></i>
            </div>
            <h4>Rutas Increíbles</h4>
            <p>Recorre las mejores rutas de la ciudad, diseñadas para disfrutar del paisaje mientras te desafías a ti mismo.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card h-100 border-0 shadow-sm p-4 feature-card">
          <div class="card-body">
            <div class="ft-icon-circle-xl rounded-circle mb-4 d-flex align-items-center justify-content-center">
              <i class="fas fa-running ft-icon-size-xl"></i>
            </div>
            <h4>Comunidad FEMTRIBE</h4>
            <p>Forma parte de una comunidad que se apoyan mutuamente para alcanzar sus metas deportivas.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card h-100 border-0 shadow-sm p-4 feature-card">
          <div class="card-body">
            <div class="ft-icon-circle-xl rounded-circle mb-4 d-flex align-items-center justify-content-center">
              <i class="fas fa-shopping-bag ft-icon-size-xl"></i>
            </div>
            <h4>Kit Exclusivo</h4>
            <p>Recibe un kit de carrera exclusivo con tula, dorsal y muchas sorpresas.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="section py-5">
  <div class="container py-8">
    <div class="row justify-content-center mb-5" data-aos="fade-up">
      <div class="col-lg-7 text-center">
        <h5 class="fw-bold mb-3" style="color: #B2D81F;">TESTIMONIOS</h5>
        <h2 class="display-7 fw-bold">Lo que dicen nuestros corredores</h2>
      </div>
    </div>
    
    <div class="row">
      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="testimonial-card">
          <div class="testimonial-content">
            <div class="testimonial-rating mb-3">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <p class="mb-4">"FEMTRIBE cambió mi vida. Gracias a esta comunidad, he logrado completar mi primera Media Maratón y he conocido personas maravillosas que me inspiran cada día."</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">
                <img src="assets/img/karen.png" alt="Karen Guarnizo">
              </div>
              <div class="testimonial-info">
                <h5 class="mb-0">Karen Guarnizo</h5>
                <small>@karengg17</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="testimonial-card">
          <div class="testimonial-content">
            <div class="testimonial-rating mb-3">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <p class="mb-4">"Gracias a la tribu recuperé la constancia. En esta tribu aprendí que no entreno solo. Aquí todos sumamos, nos apoyamos y crecemos juntos, sin importar las diferencias."</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">
                <img src="assets/img/jairo.png" alt="Jairo Caballero">
              </div>
              <div class="testimonial-info">
                <h5 class="mb-0">Jairo Caballero</h5>
                <small>@caballerojairoandres</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="testimonial-card">
          <div class="testimonial-content">
            <div class="testimonial-rating mb-3">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <p class="mb-4">"Como principiante, encontré en FEMTRIBE el apoyo perfecto para comenzar a correr. Los entrenadores son increíbles y la comunidad te hace sentir como en casa."</p>
            <div class="testimonial-author">
              <div class="testimonial-avatar">
                <img src="assets/img/andrea.png" alt="Andrea Diaz">
              </div>
              <div class="testimonial-info">
                <h5 class="mb-0">Andrea Diaz</h5>
                <small>@andreadiaz123</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <style>
    .testimonial-card {
      background-color: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      height: 100%;
      transition: all 0.3s ease;
    }
    
    .testimonial-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .testimonial-content {
      padding: 30px;
    }
    
    .testimonial-rating i {
      color: #B2D81F;
      margin-right: 2px;
    }
    
    .testimonial-author {
      display: flex;
      align-items: center;
      margin-top: 20px;
    }
    
    .testimonial-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      overflow: hidden;
      margin-right: 15px;
    }
    
    .testimonial-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .testimonial-info small {
      color: var(--gray-color);
    }
  </style>
</section>

<!-- Call to Action -->
<!-- 
<section class="section py-5" style="background-image: url('/assets/img/femtribe_verde.png'); background-size: cover; background-position: center; position: relative;">
  <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8));"></div>
  <div class="container py-5 position-relative" style="z-index: 2;">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center text-white" data-aos="fade-up">
        <h6 class="fw-bold mb-3" style="color: #98BB1B;">ÚNETE A NOSOTRAS</h6>
        <h2 class="display-4 fw-bold mb-4">¿Lista para correr con FEMTRIBE?</h2>
        <p class="lead mb-5">No te pierdas la oportunidad de ser parte de esta increíble experiencia. ¡Inscríbete ahora y vive la carrera de tus sueños!</p>
        <div class="d-flex justify-content-center gap-3">
          <a href="/inscripcion" class="btn btn-primary btn-lg">INSCRÍBETE AHORA</a>
        <a href="/contacto" class="btn btn-outline-light btn-lg">Contáctanos</a>
        </div>
      </div>
    </div>
  </div>
</section>
-->

<style>
  /* =========================================================
     NOSOTROS — Estilos personalizados
     ========================================================= */

  /* Frases en negrilla del texto Historia (color VERDE OFICIAL) */
  .ft-nosotros-bold {
    color: #B2D81F;
    font-weight: 800;
  }

  /* === ICONOS PROFESIONALES — outline clean / círculo blanco con borde verde ===
     Tres tamaños: small (Misión/Visión) · large (Valores 70px) · xlarge (Features 88px)
     Todos usan fondo blanco + borde delgado verde + icono verde.
     Hover: invierte colores y levanta ligeramente. */

  /* Tamaño SMALL → Misión / Visión */
  .ft-icon-circle {
    width: 44px;
    height: 44px;
    background-color: #FFFFFF;
    border: 2px solid #B2D81F;
    color: #B2D81F;
    flex-shrink: 0;
    transition: all 0.28s ease;
  }
  .ft-icon-size { font-size: 1.05rem; }

  /* Tamaño LARGE → Valores (mantiene 70px del layout original) */
  .ft-icon-circle-lg {
    width: 70px;
    height: 70px;
    background-color: #FFFFFF;
    border: 2.3px solid #B2D81F;
    color: #B2D81F;
    flex-shrink: 0;
    transition: all 0.28s ease;
  }
  .ft-icon-size-lg { font-size: 1.55rem; }

  /* Tamaño XLARGE → Features cards */
  .ft-icon-circle-xl {
    width: 88px;
    height: 88px;
    background-color: #FFFFFF;
    border: 2.5px solid #B2D81F;
    color: #B2D81F;
    flex-shrink: 0;
    transition: all 0.28s ease;
  }
  .ft-icon-size-xl { font-size: 1.95rem; }

  /* Hover uniforme en todos los círculos */
  .ft-icon-circle:hover,
  .ft-icon-circle-lg:hover,
  .ft-icon-circle-xl:hover {
    background-color: #B2D81F;
    color: #FFFFFF;
    transform: translateY(-2.5px);
    box-shadow: 0 9px 20px rgba(178, 216, 31, 0.28);
  }

  /* Ajuste: feature-card título h4 que no tiene peso y párrafos → mejorar legibilidad */
  .feature-card h4 {
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.5rem;
  }
  .feature-card p {
    color: #6b7280;
    line-height: 1.55;
    margin: 0;
  }
</style>

<?php include 'layouts/footer.php'; ?>