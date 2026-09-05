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

<?php
// Cargar modelo de testimonios
if (!class_exists('App\Models\Testimonial')) {
    $possibleTestimonialPaths = [
        __DIR__ . '/../backend/models/Testimonial.php',
        __DIR__ . '/backend/models/Testimonial.php',
        dirname(__DIR__) . '/backend/models/Testimonial.php'
    ];
    foreach ($possibleTestimonialPaths as $tPath) {
        if (file_exists($tPath)) {
            require_once $tPath;
            break;
        }
    }
}

$testimonialModel = class_exists('App\Models\Testimonial') ? new \App\Models\Testimonial() : null;
$testimonialStats = $testimonialModel ? $testimonialModel->getRatingStats() : ['average' => 5.0, 'total' => 3, 'breakdown' => [5=>3, 4=>0, 3=>0, 2=>0, 1=>0]];
$allTestimonials = $testimonialModel ? $testimonialModel->getAllApproved(60) : [];

$tSuccess = $_SESSION['testimonial_success'] ?? null;
$tError = $_SESSION['testimonial_error'] ?? null;
unset($_SESSION['testimonial_success'], $_SESSION['testimonial_error']);

// Prellenar si el usuario está autenticado
$currentUserName = '';
$currentUserRole = '';
if (!empty($_SESSION['user_nombres'])) {
    $currentUserName = trim($_SESSION['user_nombres'] . ' ' . ($_SESSION['user_apellidos'] ?? ''));
    $currentUserRole = 'Comunidad FEMTRIBE';
}
?>

<!-- Testimonials Section -->
<section class="section py-5 position-relative" id="testimonios-section" style="background: linear-gradient(180deg, #ffffff 0%, #f9fafb 100%);">
  <div class="container py-4">

    <!-- Mensajes de feedback -->
    <?php if ($tSuccess): ?>
      <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4 border-0" role="alert" style="background-color: #ecfdf5; color: #065f46;">
        <i class="fas fa-check-circle me-2 fs-5 text-success"></i> <?= htmlspecialchars($tSuccess) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    <?php endif; ?>

    <?php if ($tError): ?>
      <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm mb-4 border-0" role="alert">
        <i class="fas fa-exclamation-triangle me-2 fs-5"></i> <?= htmlspecialchars($tError) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    <?php endif; ?>

    <!-- Encabezado de la Sección -->
    <div class="row justify-content-center mb-4" data-aos="fade-up">
      <div class="col-lg-8 text-center">
        <h5 class="fw-bold mb-2 text-uppercase tracking-wider" style="color: #B2D81F; letter-spacing: 2px;">TESTIMONIOS</h5>
        <h2 class="display-6 fw-bold mb-3 text-dark">Lo que dicen nuestros corredores</h2>
        <p class="text-muted fs-6 mb-0">Conoce las vivencias de la tribu, comparte tu experiencia y califica nuestra plataforma.</p>
      </div>
    </div>

    <!-- Barra de Calificación Global y Botón de Acción -->
    <div class="row justify-content-center mb-5" data-aos="fade-up">
      <div class="col-lg-10">
        <div class="card border-0 rounded-4 shadow-sm p-4 p-md-4" style="background: #ffffff; border: 1px solid rgba(178, 216, 31, 0.25) !important;">
          <div class="row align-items-center g-3 text-center text-md-start">
            <div class="col-md-4 col-lg-3 text-center border-end-md">
              <div class="display-4 fw-bolder text-dark mb-0" id="stat-average-score"><?= number_format($testimonialStats['average'], 1) ?></div>
              <div class="text-warning fs-5 my-1" id="stat-average-stars">
                <?php
                $avgFull = floor($testimonialStats['average']);
                for ($i = 1; $i <= 5; $i++):
                    if ($i <= $avgFull): ?>
                        <i class="fas fa-star" style="color: #B2D81F;"></i>
                    <?php elseif ($i - $testimonialStats['average'] <= 0.5): ?>
                        <i class="fas fa-star-half-alt" style="color: #B2D81F;"></i>
                    <?php else: ?>
                        <i class="far fa-star text-muted"></i>
                    <?php endif;
                endfor; ?>
              </div>
              <small class="text-muted fw-semibold" id="stat-total-label">
                Basado en <span id="stat-total-count"><?= $testimonialStats['total'] ?></span> <?= $testimonialStats['total'] === 1 ? 'opinión' : 'opiniones' ?>
              </small>
            </div>
            
            <div class="col-md-5 col-lg-5">
              <h5 class="fw-bold text-dark mb-1">¡Tu opinión nos hace crecer!</h5>
              <p class="text-muted small mb-0">
                Cada comentario inspira a nuevos miembros a unirse a la tribu y nos ayuda a perfeccionar la experiencia de nuestra carrera y página web.
              </p>
            </div>

            <div class="col-md-3 col-lg-4 text-center text-md-end">
              <button type="button" class="btn btn-ft-rating px-4 py-3 fw-bold rounded-pill shadow-sm text-dark d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#modalNuevoTestimonio">
                <i class="fas fa-star me-2 fs-6"></i> Dejar mi testimonio
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Grid de Testimonios / Comentarios -->
    <div class="row g-4" id="testimonials-grid">
      <?php if (!empty($allTestimonials)): ?>
        <?php foreach ($allTestimonials as $idx => $t): ?>
          <div class="col-md-6 col-lg-4 mb-2 testimonial-col-item" data-aos="fade-up" data-aos-delay="<?= min(400, ($idx % 3 + 1) * 100) ?>">
            <div class="testimonial-card h-100 position-relative d-flex flex-column justify-content-between p-4">
              <!-- Watermark Quote -->
              <i class="fas fa-quote-right quote-watermark"></i>
              
              <div class="testimonial-top">
                <!-- Estrellas de Calificación -->
                <div class="testimonial-rating mb-3">
                  <?php for ($s = 1; $s <= 5; $s++): ?>
                    <i class="<?= $s <= $t['rating'] ? 'fas fa-star' : 'far fa-star' ?>" style="color: <?= $s <= $t['rating'] ? '#B2D81F' : '#d1d5db' ?>;"></i>
                  <?php endfor; ?>
                  <span class="ms-2 text-muted fw-bold small"><?= (int)$t['rating'] ?>.0</span>
                </div>
                
                <!-- Contenido del Comentario -->
                <p class="testimonial-text mb-4 text-dark">
                  "<?= nl2br(htmlspecialchars($t['comment'])) ?>"
                </p>
              </div>

              <!-- Autor del testimonio -->
              <div class="testimonial-author pt-3 border-top">
                <div class="testimonial-avatar">
                  <?php if (!empty($t['avatar']) && (file_exists($t['avatar']) || file_exists(__DIR__ . '/../' . $t['avatar']) || filter_var($t['avatar'], FILTER_VALIDATE_URL))): ?>
                    <img src="<?= htmlspecialchars($t['avatar']) ?>" alt="<?= htmlspecialchars($t['name']) ?>" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'testimonial-initials\'><?= strtoupper(substr(htmlspecialchars($t['name']), 0, 1)) ?></div>';">
                  <?php else: ?>
                    <div class="testimonial-initials">
                      <?= strtoupper(mb_substr(trim($t['name']), 0, 1, 'UTF-8')) ?>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="testimonial-info overflow-hidden">
                  <h6 class="mb-0 fw-bold text-dark text-truncate"><?= htmlspecialchars($t['name']) ?></h6>
                  <small class="text-muted d-block text-truncate"><?= htmlspecialchars($t['role_title'] ?: 'Corredor(a)') ?></small>
                </div>
                <div class="ms-auto text-end flex-shrink-0">
                  <small class="text-muted" style="font-size: 0.75rem;">
                    <?= !empty($t['created_at']) ? date('d/m/Y', strtotime($t['created_at'])) : '' ?>
                  </small>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center py-5">
          <p class="text-muted">Aún no hay comentarios publicados. ¡Sé el primero en compartir tu experiencia!</p>
        </div>
      <?php endif; ?>
    </div>

  </div>
</section>

  <!-- Modal para Agregar Testimonio y Calificar (fuera de section para evitar stacking context conflict) -->
  <div class="modal fade" id="modalNuevoTestimonio" tabindex="-1" aria-labelledby="modalTestimonioLabel" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
        
        <div class="modal-header text-white p-4" style="background-color: #1a1a1a;">
          <div>
            <h5 class="modal-title fw-bold mb-1" id="modalTestimonioLabel" style="color: #ffffff;">
              <i class="fas fa-star me-2" style="color: #B2D81F;"></i> Calificar y Dejar Testimonio
            </h5>
            <small class="text-white-50">Comparte tu experiencia con la comunidad FEMTRIBE</small>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <form action="/testimonio/guardar" method="POST" id="formTestimonio" class="p-4 bg-white">
          <input type="hidden" name="rating" id="ratingScoreInput" value="5">

          <!-- Selector Interactivo de Estrellas -->
          <div class="mb-4 text-center p-3 rounded-4" style="background-color: #f8fafc; border: 1px dashed #cbd5e1;">
            <label class="form-label fw-bold d-block text-dark mb-1">Tu Calificación de la Página y Experiencia</label>
            <small class="text-muted d-block mb-3">Toca o haz clic en las estrellas para calificar</small>
            
            <div class="interactive-stars-box d-flex justify-content-center align-items-center gap-2 mb-3" id="starRatingContainer" role="radiogroup" aria-label="Calificación de 1 a 5 estrellas">
              <button type="button" class="star-btn-wrapper p-2 border-0 bg-transparent" data-value="1" title="1 estrella - Regular" aria-label="1 estrella">
                <i class="fas fa-star star-rate-item star-active" data-value="1"></i>
              </button>
              <button type="button" class="star-btn-wrapper p-2 border-0 bg-transparent" data-value="2" title="2 estrellas - Aceptable" aria-label="2 estrellas">
                <i class="fas fa-star star-rate-item star-active" data-value="2"></i>
              </button>
              <button type="button" class="star-btn-wrapper p-2 border-0 bg-transparent" data-value="3" title="3 estrellas - Buena" aria-label="3 estrellas">
                <i class="fas fa-star star-rate-item star-active" data-value="3"></i>
              </button>
              <button type="button" class="star-btn-wrapper p-2 border-0 bg-transparent" data-value="4" title="4 estrellas - Muy buena" aria-label="4 estrellas">
                <i class="fas fa-star star-rate-item star-active" data-value="4"></i>
              </button>
              <button type="button" class="star-btn-wrapper p-2 border-0 bg-transparent" data-value="5" title="5 estrellas - ¡Excelente!" aria-label="5 estrellas">
                <i class="fas fa-star star-rate-item star-active" data-value="5"></i>
              </button>
            </div>

            <div class="d-flex flex-wrap justify-content-center align-items-center gap-2 mt-2">
              <span class="badge rounded-pill px-3 py-2 fw-bold shadow-sm" id="ratingBadge" style="background-color: #B2D81F; color: #1a1a1a; font-size: 0.95rem;">
                5 / 5 ★
              </span>
              <span class="fw-bold small" id="ratingTextDesc" style="color: #166534;">
                ¡Excelente! Me encanta la comunidad y la página
              </span>
            </div>
          </div>

          <!-- Nombre -->
          <div class="mb-3">
            <label class="form-label fw-bold small text-dark">Tu Nombre Completo <span class="text-danger">*</span></label>
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-user"></i></span>
              <input type="text" name="name" id="inputAuthorName" class="form-control border-start-0 ps-0" placeholder="Ej: Karen Guarnizo" value="<?= htmlspecialchars($currentUserName) ?>" required maxlength="150">
            </div>
          </div>

          <!-- Rol / Usuario / Instagram -->
          <div class="mb-3">
            <label class="form-label fw-bold small text-dark">¿Cómo te identificas? <small class="text-muted fw-normal">(Opcional)</small></label>
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-at"></i></span>
              <input type="text" name="role_title" id="inputRoleTitle" class="form-control border-start-0 ps-0" placeholder="Ej: @tu_usuario, Corredora 10K, o Maratón 2026" value="<?= htmlspecialchars($currentUserRole) ?>" maxlength="150">
            </div>
          </div>

          <!-- Comentario / Testimonio -->
          <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <label class="form-label fw-bold small text-dark mb-0">Tu Comentario / Testimonio <span class="text-danger">*</span></label>
              <small class="text-muted" id="charCountLabel">0 / 1000</small>
            </div>
            <textarea name="comment" id="inputCommentText" class="form-control" rows="4" placeholder="¿Qué es lo que más te gusta de FEMTRIBE? Cuéntanos tu historia, tu progreso o qué opinas de nuestra página..." required minlength="5" maxlength="1000"></textarea>
          </div>

          <!-- Alerta de error JS en el modal si falla -->
          <div class="alert alert-danger d-none py-2 small rounded-3" id="modalErrorAlert"></div>

          <!-- Botón de Envío -->
          <div class="mt-4">
            <button type="submit" class="btn btn-ft-rating w-100 py-3 fw-bold rounded-pill text-dark shadow-sm" id="btnSubmitTestimonial">
              <span class="btn-text"><i class="fas fa-paper-plane me-2"></i> Publicar mi testimonio</span>
              <span class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
  
  <style>
    /* Estilos del Módulo de Testimonios */
    .btn-ft-rating {
      background-color: #B2D81F;
      border: 2px solid #B2D81F;
      color: #1a1a1a;
      transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .btn-ft-rating:hover {
      background-color: #9ec217;
      border-color: #9ec217;
      color: #000000;
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(178, 216, 31, 0.3) !important;
    }

    .testimonial-card {
      background-color: #ffffff;
      border-radius: 20px;
      overflow: hidden;
      border: 1px solid rgba(0, 0, 0, 0.06);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
      transition: all 0.35s ease;
      position: relative;
    }
    
    .testimonial-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 18px 36px rgba(0, 0, 0, 0.08);
      border-color: rgba(178, 216, 31, 0.45);
    }

    .quote-watermark {
      position: absolute;
      top: 18px;
      right: 22px;
      font-size: 2.2rem;
      color: rgba(178, 216, 31, 0.15);
      pointer-events: none;
    }
    
    .testimonial-text {
      font-size: 0.95rem;
      line-height: 1.65;
      color: #374151;
      font-style: italic;
    }
    
    .testimonial-rating i {
      margin-right: 2px;
      font-size: 0.95rem;
    }
    
    .testimonial-author {
      display: flex;
      align-items: center;
      margin-top: auto;
    }
    
    .testimonial-avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      overflow: hidden;
      margin-right: 14px;
      flex-shrink: 0;
      border: 2px solid #B2D81F;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f3f4f6;
    }
    
    .testimonial-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .testimonial-initials {
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #B2D81F 0%, #8cae0a 100%);
      color: #1a1a1a;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 1.15rem;
      text-transform: uppercase;
    }

    /* Estrellas interactivas en el modal */
    .star-btn-wrapper {
      cursor: pointer;
      line-height: 1;
      padding: 6px;
      border-radius: 12px;
      transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      touch-action: manipulation;
    }
    .star-btn-wrapper:hover,
    .star-btn-wrapper:focus-visible {
      transform: scale(1.22);
      background-color: rgba(0, 0, 0, 0.04);
      outline: none;
    }
    .star-rate-item {
      font-size: 2.35rem;
      transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275), color 0.2s ease, filter 0.2s ease;
      pointer-events: none;
      display: inline-block;
    }
    .star-rate-item.star-active {
      color: #f59e0b !important;
      filter: drop-shadow(0 2px 6px rgba(245, 158, 11, 0.4));
    }
    .star-rate-item.star-inactive {
      color: #cbd5e1 !important;
      filter: none;
    }
    .star-bump {
      animation: starBumpAnim 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    @keyframes starBumpAnim {
      0% { transform: scale(1); }
      45% { transform: scale(1.4); }
      100% { transform: scale(1); }
    }

    @media (min-width: 768px) {
      .border-end-md {
        border-right: 1px solid #e5e7eb;
      }
    }
  </style>

  <!-- Script Interactivo para Testimonios y Calificación -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const starRatingContainer = document.getElementById('starRatingContainer');
      const starWrappers = document.querySelectorAll('.star-btn-wrapper');
      const ratingScoreInput = document.getElementById('ratingScoreInput');
      const ratingBadge = document.getElementById('ratingBadge');
      const ratingTextDesc = document.getElementById('ratingTextDesc');
      const formTestimonio = document.getElementById('formTestimonio');
      const inputCommentText = document.getElementById('inputCommentText');
      const charCountLabel = document.getElementById('charCountLabel');
      const btnSubmitTestimonial = document.getElementById('btnSubmitTestimonial');
      const modalErrorAlert = document.getElementById('modalErrorAlert');
      const testimonialsGrid = document.getElementById('testimonials-grid');

      const ratingDetails = {
        1: { text: "Regular - Hay cosas por mejorar", badge: "1 / 5 ★", color: "#dc2626", bg: "#fee2e2", textColor: "#991b1b" },
        2: { text: "Aceptable - Cumple con lo básico", badge: "2 / 5 ★", color: "#ea580c", bg: "#ffedd5", textColor: "#9a3412" },
        3: { text: "Buena - Experiencia positiva", badge: "3 / 5 ★", color: "#b45309", bg: "#fef9c3", textColor: "#854d0e" },
        4: { text: "Muy buena - Me gusta mucho", badge: "4 / 5 ★", color: "#4d7c0f", bg: "#ecfccb", textColor: "#365314" },
        5: { text: "¡Excelente! Me encanta la comunidad y la página", badge: "5 / 5 ★", color: "#166534", bg: "#B2D81F", textColor: "#1a1a1a" }
      };

      let currentRating = 5;

      function renderStars(count, isHover = false) {
        starWrappers.forEach(btn => {
          const val = parseInt(btn.getAttribute('data-value'));
          const icon = btn.querySelector('.star-rate-item');
          if (!icon) return;

          if (val <= count) {
            // Estrella activa: rellena y dorada
            icon.classList.remove('far', 'star-inactive');
            icon.classList.add('fas', 'star-active');
          } else {
            // Estrella inactiva: contorno y gris claro
            icon.classList.remove('fas', 'star-active');
            icon.classList.add('far', 'star-inactive');
          }
        });

        const detail = ratingDetails[count] || ratingDetails[5];
        if (ratingBadge) {
          ratingBadge.textContent = detail.badge;
          ratingBadge.style.backgroundColor = detail.bg;
          ratingBadge.style.color = detail.textColor;
        }
        if (ratingTextDesc) {
          ratingTextDesc.textContent = detail.text;
          ratingTextDesc.style.color = detail.color;
        }
      }

      // Interacción con cada botón de estrella (hover y clic)
      starWrappers.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
          const val = parseInt(this.getAttribute('data-value'));
          renderStars(val, true);
        });

        btn.addEventListener('click', function(e) {
          e.preventDefault();
          const val = parseInt(this.getAttribute('data-value'));
          currentRating = val;
          if (ratingScoreInput) ratingScoreInput.value = currentRating;
          renderStars(currentRating);

          // Efecto visual de rebote (bump) al pulsar
          const icon = this.querySelector('.star-rate-item');
          if (icon) {
            icon.classList.remove('star-bump');
            void icon.offsetWidth;
            icon.classList.add('star-bump');
          }
        });
      });

      // Restaurar calificación elegida únicamente al sacar el cursor de todo el contenedor
      if (starRatingContainer) {
        starRatingContainer.addEventListener('mouseleave', function() {
          renderStars(currentRating);
        });
      }

      // Inicializar en 5 estrellas por defecto
      renderStars(5);

      // Contador de caracteres
      if (inputCommentText && charCountLabel) {
        inputCommentText.addEventListener('input', function() {
          const len = this.value.length;
          charCountLabel.textContent = `${len} / 1000`;
          if (len > 900) {
            charCountLabel.classList.add('text-danger');
          } else {
            charCountLabel.classList.remove('text-danger');
          }
        });
      }

      // Envío AJAX del formulario con fallback
      if (formTestimonio) {
        formTestimonio.addEventListener('submit', async function(e) {
          e.preventDefault();

          if (modalErrorAlert) {
            modalErrorAlert.classList.add('d-none');
            modalErrorAlert.textContent = '';
          }

          const nameVal = document.getElementById('inputAuthorName').value.trim();
          const commentVal = inputCommentText.value.trim();

          if (!nameVal) {
            showError('Por favor ingresa tu nombre.');
            return;
          }
          if (commentVal.length < 5) {
            showError('Por favor escribe un comentario de al menos 5 caracteres.');
            return;
          }

          // Spinner estado cargando
          setLoading(true);

          const formData = new FormData(formTestimonio);
          formData.append('is_ajax', '1');

          try {
            const response = await fetch('/testimonio/guardar', {
              method: 'POST',
              body: formData,
              headers: {
                'X-Requested-With': 'XMLHttpRequest'
              }
            });

            const rawText = await response.text();
            let data = null;
            try {
              const startIdx = rawText.indexOf('{');
              const endIdx = rawText.lastIndexOf('}');
              if (startIdx !== -1 && endIdx !== -1) {
                data = JSON.parse(rawText.substring(startIdx, endIdx + 1));
              } else {
                data = JSON.parse(rawText);
              }
            } catch (parseErr) {
              console.error('Respuesta no JSON del servidor:', rawText);
              showError('Error al procesar la respuesta del servidor. Inténtalo de nuevo.');
              setLoading(false);
              return;
            }

            if (data && data.success) {
              // Cerrar modal de forma limpia y garantizada
              cerrarModalSeguro();

              // Resetear formulario
              if (inputCommentText) inputCommentText.value = '';
              if (charCountLabel) charCountLabel.textContent = '0 / 1000';

              // Notificación Toast de éxito
              mostrarToastExito(data.message || '¡Testimonio publicado con éxito!');

              // Actualizar Estadísticas en pantalla
              if (data.stats) {
                const avgEl = document.getElementById('stat-average-score');
                const totalEl = document.getElementById('stat-total-count');
                const totalLabel = document.getElementById('stat-total-label');
                if (avgEl) avgEl.textContent = Number(data.stats.average).toFixed(1);
                if (totalEl) totalEl.textContent = data.stats.total;
                if (totalLabel) totalLabel.innerHTML = `Basado en <span id="stat-total-count">${data.stats.total}</span> ${data.stats.total === 1 ? 'opinión' : 'opiniones'}`;
              }

              // Insertar la nueva tarjeta de testimonio en la cuadrícula de forma inmediata
              if (data.testimonial && testimonialsGrid) {
                const newCardHtml = crearCardTestimonioHtml(data.testimonial);
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = newCardHtml;
                const newCardEl = tempDiv.firstElementChild;
                
                if (newCardEl) {
                  testimonialsGrid.insertAdjacentElement('afterbegin', newCardEl);
                  try {
                    newCardEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    const card = newCardEl.querySelector('.testimonial-card');
                    if (card) {
                      card.style.borderColor = '#B2D81F';
                      card.style.boxShadow = '0 0 25px rgba(178, 216, 31, 0.35)';
                    }
                  } catch(_) {}
                }
              }

            } else {
              showError((data && data.message) ? data.message : 'Error al guardar el testimonio.');
            }
          } catch (err) {
            console.error('Error enviando testimonio:', err);
            showError('Hubo un inconveniente al enviar tu comentario. Por favor verifica tus datos e inténtalo de nuevo.');
          } finally {
            setLoading(false);
          }
        });
      }

      function cerrarModalSeguro() {
        const modalEl = document.getElementById('modalNuevoTestimonio');
        if (!modalEl) return;

        // 1. Simular clic en el botón de cerrar nativo de Bootstrap
        const closeBtn = modalEl.querySelector('[data-bs-dismiss="modal"]');
        if (closeBtn) {
          closeBtn.click();
        } else if (window.bootstrap && bootstrap.Modal) {
          const inst = bootstrap.Modal.getInstance(modalEl) || bootstrap.Modal.getOrCreateInstance(modalEl);
          if (inst) inst.hide();
        }

        // 2. Limpieza exhaustiva para que la pantalla NUNCA quede oscura ni bloqueada
        const cleanup = () => {
          document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
          document.body.classList.remove('modal-open');
          document.body.style.removeProperty('overflow');
          document.body.style.removeProperty('padding-right');
          if (modalEl) {
            modalEl.classList.remove('show');
            modalEl.style.display = 'none';
            modalEl.setAttribute('aria-hidden', 'true');
            modalEl.removeAttribute('aria-modal');
          }
        };

        modalEl.addEventListener('hidden.bs.modal', cleanup, { once: true });
        setTimeout(cleanup, 200);
      }

      // Evento de respaldo: si el usuario cierra la modal manualmente, asegurar que no queden backdrops colgados
      const modalEl = document.getElementById('modalNuevoTestimonio');
      if (modalEl) {
        modalEl.addEventListener('hidden.bs.modal', function() {
          document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
          document.body.classList.remove('modal-open');
          document.body.style.removeProperty('overflow');
          document.body.style.removeProperty('padding-right');
        });
      }

      function setLoading(isLoading) {
        if (!btnSubmitTestimonial) return;
        const btnText = btnSubmitTestimonial.querySelector('.btn-text');
        const spinner = btnSubmitTestimonial.querySelector('.spinner-border');
        if (isLoading) {
          btnSubmitTestimonial.disabled = true;
          if (btnText) btnText.classList.add('opacity-50');
          if (spinner) spinner.classList.remove('d-none');
        } else {
          btnSubmitTestimonial.disabled = false;
          if (btnText) btnText.classList.remove('opacity-50');
          if (spinner) spinner.classList.add('d-none');
        }
      }

      function showError(msg) {
        if (modalErrorAlert) {
          modalErrorAlert.textContent = msg;
          modalErrorAlert.classList.remove('d-none');
        } else {
          alert(msg);
        }
      }

      function mostrarToastExito(msg) {
        const toastBox = document.createElement('div');
        toastBox.className = 'position-fixed bottom-0 end-0 p-3';
        toastBox.style.zIndex = '9999';
        toastBox.innerHTML = `
          <div class="toast show align-items-center text-white border-0 rounded-4 shadow-lg" style="background-color: #1a1a1a;" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
              <div class="toast-body d-flex align-items-center">
                <i class="fas fa-check-circle fs-4 me-3" style="color: #B2D81F;"></i>
                <div>
                  <h6 class="mb-0 fw-bold" style="color: #B2D81F;">¡Testimonio publicado!</h6>
                  <p class="mb-0 small text-light">${msg}</p>
                </div>
              </div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
            </div>
          </div>
        `;
        document.body.appendChild(toastBox);
        setTimeout(() => {
          toastBox.remove();
        }, 5000);
      }

      function crearCardTestimonioHtml(t) {
        const ratingNum = parseInt(t.rating) || 5;
        let starsHtml = '';
        for (let i = 1; i <= 5; i++) {
          starsHtml += `<i class="${i <= ratingNum ? 'fas fa-star' : 'far fa-star'}" style="color: ${i <= ratingNum ? '#B2D81F' : '#d1d5db'};"></i>`;
        }

        const initial = (t.name || 'C').charAt(0).toUpperCase();
        let avatarHtml = `<div class="testimonial-initials">${initial}</div>`;
        if (t.avatar) {
          avatarHtml = `<img src="${t.avatar}" alt="${escapeHtml(t.name)}" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\\'testimonial-initials\\'>${initial}</div>';">`;
        }

        const roleText = escapeHtml(t.role_title || 'Corredor(a)');
        const nowFormatted = new Date().toLocaleDateString('es-CO');

        return `
          <div class="col-md-6 col-lg-4 mb-2 testimonial-col-item animate__animated animate__fadeIn">
            <div class="testimonial-card h-100 position-relative d-flex flex-column justify-content-between p-4">
              <i class="fas fa-quote-right quote-watermark"></i>
              <div class="testimonial-top">
                <div class="testimonial-rating mb-3">
                  ${starsHtml}
                  <span class="ms-2 text-muted fw-bold small">${ratingNum}.0</span>
                </div>
                <p class="testimonial-text mb-4 text-dark">
                  "${escapeHtml(t.comment)}"
                </p>
              </div>
              <div class="testimonial-author pt-3 border-top">
                <div class="testimonial-avatar">
                  ${avatarHtml}
                </div>
                <div class="testimonial-info overflow-hidden">
                  <h6 class="mb-0 fw-bold text-dark text-truncate">${escapeHtml(t.name)}</h6>
                  <small class="text-muted d-block text-truncate">${roleText}</small>
                </div>
                <div class="ms-auto text-end flex-shrink-0">
                  <small class="text-muted" style="font-size: 0.75rem;">${nowFormatted}</small>
                </div>
              </div>
            </div>
          </div>
        `;
      }

      function escapeHtml(string) {
        const div = document.createElement('div');
        div.textContent = string || '';
        return div.innerHTML;
      }
    });
  </script>

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