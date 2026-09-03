<?php include __DIR__ . '/layouts/header.php'; ?>

<style>
.registration-hero {
  background: linear-gradient(135deg, rgba(30, 60, 114, 0.6) 0%, rgba(42, 82, 152, 0.6) 100%), url('assets/img/inscribete.png') center/cover no-repeat;
  padding: 250px 0 150px 0;
  margin-bottom: 40px;
  position: relative;
  overflow: hidden;
}

.registration-hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.2);
  z-index: 1;
}

.registration-hero .container {
  position: relative;
  z-index: 2;
}

.hero-title {
  color: white;
  font-size: 3rem;
  font-weight: 900;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
  margin-bottom: 20px;
}

.hero-subtitle {
  color: #f8f9fa;
  font-size: 1.2rem;
  font-weight: 300;
  margin-bottom: 0;
}

.registration-container {
  padding: 15px 0;
}

.sport-card {
  background: white;
  border-radius: 20px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
  border: none;
  overflow: hidden;
  height: 100%;
}

.sport-card::before {
  display: none;
}

.card-header-sport {
  background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
  color: white;
  padding: 25px 30px;
  border: none;
}

.card-header-sport h3 {
  margin: 0;
  font-weight: 700;
  font-size: 1.8rem;
  text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}

.card-body-sport {
  padding: 40px 30px;
}

.event-info {
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  border-radius: 15px;
  padding: 20px;
  margin-bottom: 30px;

}

.event-info strong {
  color: #28a745;
  font-weight: 700;
}

.form-label-sport {
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 8px;
  font-size: 1rem;
}

.form-control-sport {
  border: 2px solid #e9ecef;
  border-radius: 12px;
  padding: 15px 20px;
  font-size: 1rem;
  transition: all 0.3s ease;
  background: #f8f9fa;
}

.form-control-sport:focus {
  border-color: #28a745;
  box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
  background: white;
  transform: translateY(-2px);
}

.form-select-sport {
  border: 2px solid #e9ecef;
  border-radius: 12px;
  padding: 15px 20px;
  font-size: 1rem;
  background: #f8f9fa;
  transition: all 0.3s ease;
}

.form-select-sport:focus {
  border-color: #28a745;
  box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
  background: white;
}

.btn-sport-primary {
  background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
  border: none;
  border-radius: 12px;
  padding: 15px 30px;
  font-weight: 700;
  font-size: 1.1rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.3s ease;
  box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
}

.btn-sport-primary:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 25px rgba(40, 167, 69, 0.4);
  background: linear-gradient(135deg, #218838 0%, #1abc9c 100%);
}

.btn-sport-secondary {
  background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
  border: none;
  border-radius: 12px;
  padding: 15px 30px;
  font-weight: 600;
  color: white;
  transition: all 0.3s ease;
}

.btn-sport-secondary:hover {
  transform: translateY(-2px);
  background: linear-gradient(135deg, #5a6268 0%, #343a40 100%);
  color: white;
}

.category-option {
  padding: 10px 0;
}

.flyer-container {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  height: 100%;
}

.flyer-image {
  max-width: 100%;
  height: auto;
  border-radius: 15px;
  box-shadow: 0 15px 35px rgba(0,0,0,0.1);
  transition: transform 0.3s ease;
}

.flyer-image:hover {
  transform: scale(1.02);
}

.flyer-card {
  background: white;
  border-radius: 20px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.1);
  border: none;
  overflow: hidden;
  height: 100%;
  position: relative;
}

.flyer-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 0px;
}

@media (max-width: 991px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .card-body-sport {
    padding: 30px 20px;
  }
  
  .flyer-container {
    margin-top: 30px;
    padding: 30px 20px;
  }
  
  .registration-container {
    padding: 20px 0;
  }
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 2rem;
  }
  
  .flyer-container {
    margin-top: 20px;
    padding: 20px;
  }
}

.description-card {
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  border-radius: 15px;
  padding: 25px;

  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.description-text {
  margin: 0;
  font-size: 1.1rem;
  line-height: 1.6;
  color: #2c3e50;
  text-align: justify;
}

.section-title {
  color: #28a745;
  font-weight: 700;
  font-size: 1.3rem;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 2px solid #e9ecef;
  display: flex;
  align-items: center;
}

.section-title::after {
  display: none !important;
}

.section-title i {
  margin-right: 12px !important;
  font-size: 1.2rem;
}

.authorization-text {
  background: #f8f9fa;
  border: 1px solid #dee2e6;
  border-radius: 10px;
  padding: 1.5rem;
  font-size: 0.95rem;
  line-height: 1.6;
}

.flyer-container-center {
  text-align: center;
  margin: 2rem 0;
}

.flyer-image-center {
  max-width: 100%;
  height: auto;
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.flyer-image-center:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
}

.description-text {
  font-size: 1.1rem;
  line-height: 1.8;
  color: #2c3e50;
  text-align: justify;
  margin-bottom: 0;
}

.description-text strong {
  color: #28a745;
  font-weight: 700;
}

.description-text em {
  color: #20c997;
  font-style: italic;
  font-weight: 600;
}

.authorization-text p {
  margin-bottom: 0;
}
</style>

<!-- Hero Section -->
<div class="registration-hero">
  <div class="container text-center">
    <h1 class="hero-title">¡INSCRÍBETE AHORA!</h1>
    <p class="hero-subtitle">Únete a la experiencia deportiva más emocionante</p>
  </div>
</div>

<!-- Texto descriptivo -->
<div class="container mb-4">
  <div class="row">
    <div class="col-12">
      <div class="description-card">
        <p class="description-text">
          <strong style="color: #87CC3E;">Corre Con FemTribe</strong> es más que una carrera, es un movimiento global: un tour de carreras que recorre municipios y ciudades, llevando el deporte como herramienta de transformación. Reconstrúyete y fortalécete con nosotros. Únete a una experiencia única donde la pasión por el running se combina con valores de inclusión, bienestar y excelencia deportiva. <em style="color: #87CC3E;">¡Forma parte de nuestra tribu y descubre tu mejor versión!</em>
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Flyer de la carrera -->
<div class="container mb-4">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
      <div class="flyer-container-center">
        <img src="assets/img/flyer.png" alt="Flyer Carrera - Femtribe" class="flyer-image-center">
      </div>
    </div>
  </div>
</div>

<div class="container registration-container">
  <div class="row justify-content-center">
    <!-- Formulario -->
    <div class="col-lg-10 col-xl-9">
      <div class="sport-card position-relative">
        <div class="card-header-sport">
          <h3 class="text-center">
            <i class="fas fa-running me-2"></i>
            Formulario de Inscripción
          </h3>
        </div>
        
        <div class="card-body-sport">
          <?php if (!empty($event)): ?>
            <div class="event-info">
              <p class="mb-0">
                <i class="fas fa-calendar-alt me-2 text-success"></i>
                <strong>Evento:</strong> <?= htmlspecialchars($event['name'] ?? '') ?>
              </p>
            </div>
          <?php endif; ?>

          <form action="/inscribirse/guardar" method="POST" class="needs-validation" novalidate id="raceRegistrationForm">

            <?php if (!empty($event['is_presale_active'])): ?>
              <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4 d-flex align-items-center justify-content-between p-3" style="background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%); color: white;">
                <div>
                  <h6 class="fw-bold mb-0"><i class="fas fa-fire me-2"></i>¡Tarifas de Preventa Activas!</h6>
                  <small>Aprovecha los precios de preventa por tiempo limitado hasta el <?= !empty($event['presale_end_date']) ? date('d/m/Y g:i A', strtotime($event['presale_end_date'])) : '' ?></small>
                </div>
                <span class="badge bg-white text-success fw-bold px-3 py-2 rounded-pill">PREVENTA</span>
              </div>
            <?php endif; ?>

            <!-- Sección 1: Selección de Categoría y Etapas -->
            <div class="section-title">
              <i class="fas fa-flag-checkered me-2"></i>1. Categoría y Etapas de Carrera (3K, 5K, 10K)
            </div>

            <div class="card p-3 mb-4 border-0 bg-light rounded-4">
              <label class="form-label-sport fw-bold mb-2">Selecciona la Categoría de Participación *</label>
              <div class="d-flex gap-3 flex-wrap mb-3" id="categorySelector">
                <div class="form-check form-check-inline bg-white px-3 py-2 rounded-3 border shadow-sm">
                  <input class="form-check-input" type="radio" name="categoria_participante" id="catAdulto" value="adulto" checked>
                  <label class="form-check-label fw-bold text-dark" for="catAdulto">
                    <i class="fas fa-user-ninja text-success me-1"></i>Adulto (5K / 10K)
                  </label>
                </div>
                <div class="form-check form-check-inline bg-white px-3 py-2 rounded-3 border shadow-sm">
                  <input class="form-check-input" type="radio" name="categoria_participante" id="catNino" value="nino">
                  <label class="form-check-label fw-bold text-dark" for="catNino">
                    <i class="fas fa-child text-primary me-1"></i>3K Niño y Adulto (Infantil)
                  </label>
                </div>
                <div class="form-check form-check-inline bg-white px-3 py-2 rounded-3 border shadow-sm">
                  <input class="form-check-input" type="radio" name="categoria_participante" id="catMascota" value="mascota">
                  <label class="form-check-label fw-bold text-dark" for="catMascota">
                    <i class="fas fa-dog text-warning me-1"></i>3K Perro y Adulto (Pet Run)
                  </label>
                </div>
              </div>

              <!-- Lista de Etapas Disponibles según la categoría -->
              <label class="form-label-sport fw-bold mb-2">Etapas y Kilometrajes Disponibles *</label>
              <div class="row g-3" id="stagesContainer">
                <?php 
                $stagesList = $stages ?? [
                  ['id' => 1, 'name' => '3K Perro y Adulto (Pet Run)', 'category_type' => 'mascota', 'price' => 55000, 'presale_price' => 45000, 'active_price' => 45000, 'distance' => '3K'],
                  ['id' => 2, 'name' => '3K Niño y Adulto (Infantil)', 'category_type' => 'nino', 'price' => 50000, 'presale_price' => 40000, 'active_price' => 40000, 'distance' => '3K'],
                  ['id' => 3, 'name' => '5K Adulto', 'category_type' => 'adulto', 'price' => 65000, 'presale_price' => 55000, 'active_price' => 55000, 'distance' => '5K'],
                  ['id' => 4, 'name' => '10K Adulto', 'category_type' => 'adulto', 'price' => 85000, 'presale_price' => 75000, 'active_price' => 75000, 'distance' => '10K'],
                  ['id' => 5, 'name' => 'Adicional 5K (Adulto 3K)', 'category_type' => 'adicional', 'price' => 30000, 'presale_price' => 25000, 'active_price' => 25000, 'distance' => '5K'],
                  ['id' => 6, 'name' => 'Adicional 10K (Adulto 3K)', 'category_type' => 'adicional', 'price' => 40000, 'presale_price' => 35000, 'active_price' => 35000, 'distance' => '10K']
                ];
                foreach ($stagesList as $stg): 
                  $activePrice = $stg['active_price'] ?? $stg['price'];
                  $isPresale = !empty($event['is_presale_active']);
                ?>
                  <div class="col-md-6 stage-card-item" data-cat-type="<?= htmlspecialchars($stg['category_type']) ?>">
                    <div class="card h-100 border p-3 rounded-3 shadow-sm bg-white">
                      <div class="form-check d-flex justify-content-between align-items-center mb-0">
                        <div>
                          <input class="form-check-input stage-checkbox" type="checkbox" name="etapas_seleccionadas[]" 
                                 value="<?= htmlspecialchars($stg['id']) ?>" id="stage_<?= $stg['id'] ?>" data-price="<?= $activePrice ?>"
                                 data-presale="<?= !empty($stg['is_stage_presale_active']) ? '1' : '0' ?>"
                                 <?= !empty($stg['is_sold_out']) ? 'disabled' : '' ?>>
                          <label class="form-check-label fw-bold me-2 text-dark" for="stage_<?= $stg['id'] ?>">
                            <?= htmlspecialchars($stg['name']) ?>
                          </label>
                          <span class="badge bg-success bg-opacity-10 text-success ms-1"><?= htmlspecialchars($stg['distance']) ?></span>
                          
                          <!-- Indicadores de Cupos -->
                          <?php if (!empty($stg['is_sold_out'])): ?>
                            <span class="badge bg-secondary text-white ms-1" style="font-size: 0.65rem;">AGOTADO</span>
                          <?php else: ?>
                            <?php if (!empty($stg['is_stage_presale_active']) && !empty($stg['presale_slots_limit'])): ?>
                              <?php $leftPresale = max(0, (int)$stg['presale_slots_limit'] - (int)$stg['presale_registered_count']); ?>
                              <span class="badge bg-danger text-white ms-1" style="font-size: 0.65rem;">Quedan <?= $leftPresale ?> preventa</span>
                            <?php elseif (empty($stg['is_stage_presale_active']) && !empty($stg['slots_limit'])): ?>
                              <?php $leftNormal = max(0, ((int)$stg['slots_limit'] + (int)($stg['presale_slots_limit'] ?? 0)) - (int)$stg['registered_count']); ?>
                              <span class="badge bg-warning text-dark ms-1" style="font-size: 0.65rem;">Quedan <?= $leftNormal ?> cupos</span>
                            <?php endif; ?>
                          <?php endif; ?>
                        </div>
                        <div class="text-end">
                          <span class="fw-bold text-success fs-6">$<?= number_format($activePrice, 0, ',', '.') ?></span>
                          <?php if (!empty($stg['is_stage_presale_active']) && !empty($stg['presale_price']) && $stg['presale_price'] < $stg['price']): ?>
                            <br><small class="text-muted text-decoration-line-through me-1" style="font-size: 0.75rem;">$<?= number_format($stg['price'], 0, ',', '.') ?></small>
                            <span class="badge bg-danger text-white" style="font-size: 0.65rem;">PREVENTA</span>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

              <!-- Subsección para Kilometraje Adicional en 3K -->
              <div id="additionalDistanceNotice" class="mt-3 p-3 bg-white rounded-3 border border-warning d-none">
                <div class="d-flex align-items-center gap-2">
                  <i class="fas fa-plus-circle text-warning fs-5"></i>
                  <div>
                    <strong class="text-dark">Kilometraje Adicional para el Adulto en 3K:</strong>
                    <div class="text-muted small">Si el adulto acompañante en la categoría de 3K desea correr un kilometraje adicional (5K o 10K), puede registrar de nuevo el formulario con el kilometraje deseado.</div>
                  </div>
                </div>
              </div>

              <!-- Total Inscripción -->
              <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                <span class="fw-bold text-dark">Valor Total Inscripción:</span>
                <span class="fw-extrabold fs-4 text-success" id="totalRegistrationPrice">$0 COP</span>
              </div>
            </div>

            <!-- Sección Condicional: Datos de la Mascota -->
            <div id="petSection" class="card p-3 mb-4 border-warning bg-warning bg-opacity-10 rounded-4 d-none">
              <h5 class="fw-bold text-dark mb-3"><i class="fas fa-paw me-2 text-warning"></i>Datos de la Mascota</h5>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label-sport">Nombre de la Mascota *</label>
                  <input type="text" class="form-control form-control-sport" name="nombre_mascota" placeholder="Ej. Firulais / Bruno">
                </div>
                <div class="col-md-6">
                  <label class="form-label-sport">Raza / Tipo de Mascota</label>
                  <input type="text" class="form-control form-control-sport" name="raza_mascota" placeholder="Ej. Criollo, Labrador, Poodle">
                </div>
              </div>
            </div>

            <!-- Sección Condicional: Datos del Acudiente (Niños) -->
            <div id="tutorSection" class="card p-3 mb-4 border-info bg-info bg-opacity-10 rounded-4 d-none">
              <h5 class="fw-bold text-dark mb-3"><i class="fas fa-user-shield me-2 text-primary"></i>Datos del Acudiente / Tutor Responsable</h5>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label-sport">Nombre Completo del Acudiente *</label>
                  <input type="text" class="form-control form-control-sport" name="acudiente_nombre" placeholder="Nombre del Padre/Madre/Tutor">
                </div>
                <div class="col-md-6">
                  <label class="form-label-sport">Número de Documento del Acudiente *</label>
                  <input type="text" class="form-control form-control-sport" name="acudiente_documento" placeholder="Número de Cédula">
                </div>
              </div>
            </div>

            <!-- Sección: Datos del Participante -->
            <div class="section-title">
              <i class="fas fa-user me-2"></i>2. Datos del Participante
            </div>

            <!-- Primera fila: Nombres, Apellidos, Tipo de documento -->
            <div class="row">
              <div class="col-md-4 mb-4">
                <label class="form-label-sport" for="nombres">
                  <i class="fas fa-user me-2 text-success"></i>
                  Nombres *
                </label>
                <input type="text" class="form-control form-control-sport" name="nombres" id="nombres" required 
                       value="<?= htmlspecialchars($currentUser['nombres'] ?? '') ?>"
                       placeholder="Ingresa tus nombres" autocomplete="given-name" 
                       pattern="[A-Za-zÀ-ÿ\u00f1\u00d1\s]+" title="Solo se permiten letras y espacios">
                <div class="invalid-feedback">
                  Por favor ingresa tus nombres (solo letras y espacios).
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <label class="form-label-sport" for="apellidos">
                  <i class="fas fa-user me-2 text-success"></i>
                  Apellidos *
                </label>
                <input type="text" class="form-control form-control-sport" name="apellidos" id="apellidos" required 
                       value="<?= htmlspecialchars($currentUser['apellidos'] ?? '') ?>"
                       placeholder="Ingresa tus apellidos" autocomplete="family-name"
                       pattern="[A-Za-zÀ-ÿ\u00f1\u00d1\s]+" title="Solo se permiten letras y espacios">
                <div class="invalid-feedback">
                  Por favor ingresa tus apellidos (solo letras y espacios).
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <label class="form-label-sport" for="tipo_documento">
                  <i class="fas fa-id-card me-2 text-success"></i>
                  Tipo de documento *
                </label>
                <?php $userDocType = $currentUser['tipo_documento'] ?? ''; ?>
                <select name="tipo_documento" id="tipo_documento" class="form-select form-select-sport" required>
                  <option value="">Selecciona</option>
                  <option value="cedula_ciudadania" <?= in_array($userDocType, ['CC', 'cedula_ciudadania']) ? 'selected' : '' ?>>Cédula de ciudadanía</option>
                  <option value="tarjeta_identidad" <?= in_array($userDocType, ['TI', 'tarjeta_identidad']) ? 'selected' : '' ?>>Tarjeta de identidad</option>
                  <option value="pasaporte" <?= in_array($userDocType, ['Pasaporte', 'pasaporte']) ? 'selected' : '' ?>>Pasaporte</option>
                </select>
                <div class="invalid-feedback">
                  Por favor selecciona el tipo de documento.
                </div>
              </div>
            </div>

            <!-- Segunda fila: Número de documento, Fecha, Edad, Género -->
            <div class="row">
              <div class="col-md-4 mb-4">
                <label class="form-label-sport" for="numero_documento">
                  <i class="fas fa-hashtag me-2 text-success"></i>
                  Número de documento *
                </label>
                <input type="text" class="form-control form-control-sport" name="numero_documento" id="numero_documento" required 
                       value="<?= htmlspecialchars($currentUser['numero_documento'] ?? '') ?>"
                       placeholder="Número de documento" pattern="[0-9]+" title="Solo se permiten números">
                <div class="invalid-feedback">
                  Por favor ingresa tu número de documento.
                </div>
              </div>
              <div class="col-md-3 mb-4">
                <label class="form-label-sport" for="fecha_nacimiento">
                  <i class="fas fa-calendar me-2 text-success"></i>
                  Fecha de nacimiento *
                </label>
                <input type="date" class="form-control form-control-sport" name="fecha_nacimiento" id="fecha_nacimiento" required autocomplete="bday">
                <div class="invalid-feedback">
                  Por favor selecciona tu fecha de nacimiento.
                </div>
              </div>
              <div class="col-md-2 mb-4">
                <label class="form-label-sport" for="edad">
                  <i class="fas fa-birthday-cake me-2 text-success"></i>
                  Edad
                </label>
                <input type="number" class="form-control form-control-sport" name="edad" id="edad" min="8" max="120"
                       placeholder="Edad" readonly>
                <div class="invalid-feedback">
                  Por favor ingresa tu edad.
                </div>
              </div>
              <div class="col-md-3 mb-4">
                <label class="form-label-sport" for="genero">
                  <i class="fas fa-venus-mars me-2 text-success"></i>
                  Género *
                </label>
                <select name="genero" id="genero" class="form-select form-select-sport" required>
                  <option value="">Selecciona</option>
                  <option value="masculino">Masculino</option>
                  <option value="femenino">Femenino</option>
                  <option value="otro">Otro</option>
                </select>
                <div class="invalid-feedback">
                  Por favor selecciona tu género.
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-4">
                <label class="form-label-sport" for="eps">
                  <i class="fas fa-hospital me-2 text-success"></i>
                  EPS *
                </label>
                <input type="text" class="form-control form-control-sport" name="eps" id="eps" required 
                       placeholder="Nombre de tu EPS">
                <div class="invalid-feedback">
                  Por favor ingresa tu EPS.
                </div>
              </div>

              <div class="col-md-3 mb-4">
                <label class="form-label-sport" for="grupo_sanguineo">
                  <i class="fas fa-tint me-2 text-success"></i>
                  Grupo sanguíneo *
                </label>
                <select name="grupo_sanguineo" id="grupo_sanguineo" class="form-select form-select-sport" required>
                  <option value="">Selecciona</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="AB">AB</option>
                  <option value="O">O</option>
                </select>
                <div class="invalid-feedback">
                  Por favor selecciona tu grupo sanguíneo.
                </div>
              </div>

              <div class="col-md-3 mb-4">
                <label class="form-label-sport" for="rh">
                  <i class="fas fa-plus-circle me-2 text-success"></i>
                  RH *
                </label>
                <select name="rh" id="rh" class="form-select form-select-sport" required>
                  <option value="">Selecciona</option>
                  <option value="+">Positivo (+)</option>
                  <option value="-">Negativo (-)</option>
                </select>
                <div class="invalid-feedback">
                  Por favor selecciona tu RH.
                </div>
              </div>
            </div>

            <!-- Tercera fila: Talla de Camiseta (Adulto y Niño) -->
            <div class="row">
              <div class="col-md-6 mb-4" id="shirtAdultContainer">
                <label class="form-label-sport" for="talla_camiseta_adulto">
                  <i class="fas fa-tshirt me-2 text-success"></i>
                  Talla de Camiseta Adulto *
                </label>
                <select name="talla_camiseta_adulto" id="talla_camiseta_adulto" class="form-select form-select-sport" required>
                  <option value="">Selecciona Talla Adulto</option>
                  <option value="XS">XS - Extra Pequeña</option>
                  <option value="S">S - Pequeña</option>
                  <option value="M">M - Mediana</option>
                  <option value="L">L - Grande</option>
                  <option value="XL">XL - Extra Grande</option>
                  <option value="XXL">XXL - Doble Extra Grande</option>
                </select>
                <div class="invalid-feedback">
                  Por favor selecciona la talla de camiseta de adulto.
                </div>
              </div>

              <div class="col-md-6 mb-4 d-none" id="shirtChildContainer">
                <label class="form-label-sport" for="talla_camiseta_nino">
                  <i class="fas fa-tshirt me-2 text-primary"></i>
                  Talla de Camiseta Niño *
                </label>
                <select name="talla_camiseta_nino" id="talla_camiseta_nino" class="form-select form-select-sport">
                  <option value="">Selecciona Talla Niño</option>
                  <option value="T4">Talla 4 (2 - 4 años)</option>
                  <option value="T6">Talla 6 (4 - 6 años)</option>
                  <option value="T8">Talla 8 (6 - 8 años)</option>
                  <option value="T10">Talla 10 (8 - 10 años)</option>
                  <option value="T12">Talla 12 (10 - 12 años)</option>
                  <option value="T14">Talla 14 (12 - 14 años)</option>
                  <option value="T16">Talla 16 (14 - 16 años)</option>
                </select>
                <div class="invalid-feedback">
                  Por favor selecciona la talla de camiseta de niño.
                </div>
              </div>
            </div>

            <!-- Sección: Información de Contacto -->
            <div class="section-title mt-4">
              <i class="fas fa-address-book" style="margin-right: 15px;"></i>Información de Contacto
            </div>

            <div class="row">
              <div class="col-md-6 mb-4">
                <label class="form-label-sport" for="direccion">
                  <i class="fas fa-home me-2 text-success"></i>
                  Dirección de domicilio *
                </label>
                <input type="text" class="form-control form-control-sport" name="direccion" id="direccion" required 
                       value="<?= htmlspecialchars($currentUser['direccion'] ?? '') ?>"
                       placeholder="Calle, carrera, número" autocomplete="street-address">
                <div class="invalid-feedback">
                  Por favor ingresa tu dirección.
                </div>
              </div>

              <div class="col-md-3 mb-4">
                <label class="form-label-sport" for="municipio">
                  <i class="fas fa-map-marker-alt me-2 text-success"></i>
                  Municipio *
                </label>
                <input type="text" class="form-control form-control-sport" name="municipio" id="municipio" required 
                       value="<?= htmlspecialchars($currentUser['municipio'] ?? 'Cali') ?>"
                       placeholder="Municipio" autocomplete="address-level2">
                <div class="invalid-feedback">
                  Por favor ingresa tu municipio.
                </div>
              </div>

              <div class="col-md-3 mb-4">
                <label class="form-label-sport" for="departamento">
                  <i class="fas fa-globe me-2 text-success"></i>
                  Departamento *
                </label>
                <input type="text" class="form-control form-control-sport" name="departamento" id="departamento" required 
                       value="<?= htmlspecialchars($currentUser['departamento'] ?? 'Valle del Cauca') ?>"
                       placeholder="Departamento" autocomplete="address-level1">
                <div class="invalid-feedback">
                  Por favor ingresa tu departamento.
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-4">
                <label class="form-label-sport" for="email">
                  <i class="fas fa-envelope me-2 text-success"></i>
                  Correo electrónico *
                </label>
                <input type="email" class="form-control form-control-sport" name="email" id="email" required 
                       value="<?= htmlspecialchars($currentUser['email'] ?? '') ?>"
                       placeholder="tu@email.com" autocomplete="email">
                <div class="invalid-feedback">
                  Por favor ingresa un email válido.
                </div>
              </div>

              <div class="col-md-6 mb-4">
                <label class="form-label-sport" for="telefono">
                  <i class="fas fa-phone me-2 text-success"></i>
                  Teléfono de contacto *
                </label>
                <input type="tel" class="form-control form-control-sport" name="telefono" id="telefono" required 
                       value="<?= htmlspecialchars($currentUser['telefono'] ?? '') ?>"
                       placeholder="3001234567" autocomplete="tel">
                <div class="invalid-feedback">
                  Por favor ingresa tu número de teléfono.
                </div>
              </div>
            </div>

            <!-- Sección: Contacto de Emergencia -->
            <div class="section-title mt-4">
              <i class="fas fa-exclamation-triangle" style="margin-right: 15px;"></i>Nombre de contacto de Emergencia
            </div>

            <div class="row">
              <div class="col-md-3 mb-4">
                <label class="form-label-sport" for="parentesco_emergencia">
                  <i class="fas fa-users me-2 text-success"></i>
                  Parentesco *
                </label>
                <select name="parentesco_emergencia" id="parentesco_emergencia" class="form-select form-select-sport" required autocomplete="off">
                  <option value="">Selecciona</option>
                  <option value="madre">Madre</option>
                  <option value="padre">Padre</option>
                  <option value="otro">Otro</option>
                </select>
                <div class="invalid-feedback">
                  Por favor selecciona el parentesco.
                </div>
              </div>

              <div class="col-md-2 mb-4" id="otro-parentesco" style="display: none;">
                <label class="form-label-sport" for="otro_parentesco_input">
                  <i class="fas fa-question me-2 text-success"></i>
                  ¿Cuál? *
                </label>
                <input type="text" class="form-control form-control-sport" name="otro_parentesco" id="otro_parentesco_input"
                       placeholder="Parentesco" autocomplete="off">
                <div class="invalid-feedback">
                  Por favor especifica el parentesco.
                </div>
              </div>

              <div class="col-md-6 mb-4" id="nombre-emergencia-full">
                <label class="form-label-sport" for="nombre_emergencia">
                  <i class="fas fa-user-friends me-2 text-success"></i>
                  Nombre completo del contacto de emergencia *
                </label>
                <input type="text" class="form-control form-control-sport" name="nombre_emergencia" id="nombre_emergencia" required 
                       placeholder="Nombre de contacto de emergencia" autocomplete="off">
                <div class="invalid-feedback">
                  Por favor ingresa el nombre del contacto de emergencia.
                </div>
              </div>

              <div class="col-md-4 mb-4" id="nombre-emergencia-half" style="display: none;">
                <label class="form-label-sport" for="nombre_emergencia_alt">
                  <i class="fas fa-user-friends me-2 text-success"></i>
                  Nombre de contacto de emergencia *
                </label>
                <input type="text" class="form-control form-control-sport" name="nombre_emergencia_alt" id="nombre_emergencia_alt"
                       placeholder="Nombre de contacto de emergencia" autocomplete="off">
                <div class="invalid-feedback">
                  Por favor ingresa el nombre del contacto de emergencia.
                </div>
              </div>

              <div class="col-md-3 mb-4">
                <label class="form-label-sport" for="celular_emergencia">
                  <i class="fas fa-mobile-alt me-2 text-success"></i>
                  Celular del contacto *
                </label>
                <input type="tel" class="form-control form-control-sport" name="celular_emergencia" id="celular_emergencia" required 
                       placeholder="3001234567" autocomplete="tel">
                <div class="invalid-feedback">
                  Por favor ingresa el celular del contacto de emergencia.
                </div>
              </div>
            </div>

            <!-- Sección: Autorización -->
            <div class="section-title mt-4">
              <i class="fas fa-file-contract" style="margin-right: 15px;"></i>Autorización
            </div>

            <!-- Sección Legal y Autorización de la Carrera -->
            <div class="card border-0 rounded-4 shadow-sm bg-light mb-4">
              <div class="card-body p-4">
                <div class="d-flex align-items-center gap-2 mb-3 text-dark fw-bold">
                  <i class="fas fa-file-contract text-success fs-5"></i>
                  <span class="fs-5">Términos Legales y Autorizaciones de la Carrera</span>
                </div>
                <p class="text-muted small mb-3">
                  Para participar en la <strong>Carrera Corre Con FemTribe</strong>, debes declarar tu estado de salud y autorizar los documentos legales obligatorios conforme a la normativa vigente en Colombia. Puedes consultar cada documento formal a continuación:
                </p>

                <div class="d-flex flex-wrap gap-2 mb-4">
                  <a href="/autorizacion-datos" target="_blank" class="btn btn-sm btn-outline-dark rounded-pill fw-semibold">
                    <i class="fas fa-heartbeat me-1 text-success"></i>1. Exoneración y Salud
                  </a>
                  <a href="/politica-privacidad" target="_blank" class="btn btn-sm btn-outline-dark rounded-pill fw-semibold">
                    <i class="fas fa-user-shield me-1 text-success"></i>2. Política de Datos (Ley 1581)
                  </a>
                  <a href="/terminos" target="_blank" class="btn btn-sm btn-outline-dark rounded-pill fw-semibold">
                    <i class="fas fa-gavel me-1 text-success"></i>3. Términos de Carrera
                  </a>
                </div>

                <div class="form-check bg-white p-3 rounded-3 border shadow-sm">
                  <input class="form-check-input ms-0 me-3" type="checkbox" name="acepta_autorizacion" id="acepta_autorizacion" value="si" required style="width: 1.4em; height: 1.4em; cursor: pointer; float: left;">
                  <label class="form-check-label fw-bold text-dark small" for="acepta_autorizacion" style="cursor: pointer; display: block; line-height: 1.6; padding-left: 0.5rem;">
                    Declaro bajo juramento que me encuentro en aptas condiciones de salud física y mental, asumo los riesgos de la actividad y acepto la <a href="/autorizacion-datos" target="_blank" class="text-success text-decoration-none fw-bold">Exoneración de Responsabilidad</a>, los <a href="/terminos" target="_blank" class="text-success text-decoration-none fw-bold">Términos del Evento</a> y la <a href="/politica-privacidad" target="_blank" class="text-success text-decoration-none fw-bold">Política de Tratamiento de Datos (Habeas Data)</a>. *
                  </label>
                  <div class="invalid-feedback mt-2">
                    Debes aceptar la autorización y términos legales para completar tu inscripción.
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-4">
              <a href="/" class="btn btn-sport-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Volver al inicio
              </a>
              <button type="submit" class="btn btn-sport-primary" data-bs-loading-text="false">
                <i class="fas fa-check-circle me-2"></i>
                Confirmar inscripción
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
let registeredStages = [];

function fetchRegisteredStages(docNum) {
  if (!docNum || docNum.trim().length < 5) {
    registeredStages = [];
    if (typeof updateStageStates === 'function') {
      updateStageStates();
    }
    return;
  }
  
  const xhr = new XMLHttpRequest();
  xhr.open('POST', '/inscribirse/verificar-documento', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      try {
        const response = JSON.parse(xhr.responseText);
        if (response.success) {
          registeredStages = response.registered_stages || [];
          console.log('Etapas ya inscritas para el documento ' + docNum + ':', registeredStages);
          if (typeof updateStageStates === 'function') {
            updateStageStates();
          }
        }
      } catch (e) {
        console.error('Error al analizar respuesta de verificación de documento:', e);
      }
    }
  };
  
  xhr.send('numero_documento=' + encodeURIComponent(docNum));
}

function updateStageStates() {
  const stageCheckboxes = document.querySelectorAll('.stage-checkbox');
  
  // Limpiar indicadores previos
  document.querySelectorAll('.already-registered-badge').forEach(el => el.remove());
  
  stageCheckboxes.forEach(chk => {
    const stageId = parseInt(chk.value);
    const cardItem = chk.closest('.stage-card-item');
    const isRegistered = registeredStages.some(stg => stg.id === stageId);
    
    if (isRegistered) {
      chk.disabled = true;
      chk.checked = false;
      if (cardItem) {
        const label = cardItem.querySelector('label');
        if (label && !cardItem.querySelector('.already-registered-badge')) {
          const badge = document.createElement('span');
          badge.className = 'badge bg-secondary text-white ms-1 already-registered-badge';
          badge.textContent = 'Ya inscrito';
          label.parentNode.insertBefore(badge, label.nextSibling);
        }
      }
    } else {
      chk.disabled = false;
    }
  });

  const hasRegistered5K = registeredStages.some(stg => stg.distance === '5K');
  const hasRegistered10K = registeredStages.some(stg => stg.distance === '10K');

  stageCheckboxes.forEach(chk => {
    const stageId = parseInt(chk.value);
    const isRegistered = registeredStages.some(stg => stg.id === stageId);
    if (isRegistered) return;

    const cardItem = chk.closest('.stage-card-item');
    if (!cardItem) return;
    
    const badgeText = cardItem.querySelector('.badge:not(.already-registered-badge)')?.textContent || '';
    
    if (badgeText.includes('5K')) {
      if (hasRegistered10K) {
        chk.disabled = true;
        chk.checked = false;
        const label = cardItem.querySelector('label');
        if (label && !cardItem.querySelector('.already-registered-badge')) {
          const badge = document.createElement('span');
          badge.className = 'badge bg-warning text-dark ms-1 already-registered-badge';
          badge.textContent = 'Bloqueado (Inscrito a 10K)';
          label.parentNode.insertBefore(badge, label.nextSibling);
        }
      }
    } else if (badgeText.includes('10K')) {
      if (hasRegistered5K) {
        chk.disabled = true;
        chk.checked = false;
        const label = cardItem.querySelector('label');
        if (label && !cardItem.querySelector('.already-registered-badge')) {
          const badge = document.createElement('span');
          badge.className = 'badge bg-warning text-dark ms-1 already-registered-badge';
          badge.textContent = 'Bloqueado (Inscrito a 5K)';
          label.parentNode.insertBefore(badge, label.nextSibling);
        }
      }
    }
  });
}

// Prevenir que Bootstrap modifique automáticamente los botones de submit
document.addEventListener('DOMContentLoaded', function() {
  // Consultar etapas previas si el documento ya viene lleno en el formulario
  const docInput = document.querySelector('input[name="numero_documento"]');
  if (docInput && docInput.value.trim()) {
    fetchRegisteredStages(docInput.value);
  }

  const submitButtons = document.querySelectorAll('button[type="submit"]');
  submitButtons.forEach(button => {
    button.setAttribute('data-bs-loading-text', 'false');
    
    // Prevenir el comportamiento automático de Bootstrap en el submit
    button.addEventListener('click', function(e) {
      // Mantener el contenido original
      setTimeout(() => {
        if (this.innerHTML.includes('fa-spinner') || this.innerHTML.includes('Procesando')) {
          const hasPresale = Array.from(document.querySelectorAll('.stage-checkbox')).some(chk => chk.checked && chk.getAttribute('data-presale') === '1' && chk.closest('.stage-card-item').style.display !== 'none');
          if (hasPresale) {
            this.innerHTML = '<i class="fas fa-check-circle me-2"></i>Confirmar inscripción (Preventa)';
          } else {
            this.innerHTML = '<i class="fas fa-check-circle me-2"></i>Confirmar inscripción';
          }
          this.disabled = false;
        }
      }, 10);
    });
  });

  // Validación en tiempo real para nombres y apellidos
  const nombresField = document.getElementById('nombres');
  const apellidosField = document.getElementById('apellidos');
  
  // Función para validar solo letras
  function validateLettersOnly(input) {
    const regex = /^[A-Za-zÀ-ÿ\u00f1\u00d1\s]*$/;
    const value = input.value;
    
    if (value && !regex.test(value)) {
      // Remover caracteres no válidos
      input.value = value.replace(/[^A-Za-zÀ-ÿ\u00f1\u00d1\s]/g, '');
    }
    
    // Si el campo tiene contenido válido, limpiar errores completamente
    if (input.value.trim() && regex.test(input.value)) {
      clearValidationErrors(input);
    }
  }
  
  // Agregar eventos de validación en tiempo real
  if (nombresField) {
    nombresField.addEventListener('input', function() {
      validateLettersOnly(this);
    });
    
    nombresField.addEventListener('blur', function() {
      if (this.value.trim() === '') {
        showValidationError(this, 'Por favor ingresa tu nombre.');
      } else {
        clearValidationErrors(this);
      }
    });
  }
  
  if (apellidosField) {
    apellidosField.addEventListener('input', function() {
      validateLettersOnly(this);
    });
    
    apellidosField.addEventListener('blur', function() {
      if (this.value.trim() === '') {
        showValidationError(this, 'Por favor ingresa tu apellido.');
      } else {
        clearValidationErrors(this);
      }
    });
  }

  // *** FUNCIONALIDAD DEL CAMPO DE EDAD - VERSIÓN SIMPLE ***
  const fechaNacimiento = document.getElementById('fecha_nacimiento');
  const edad = document.getElementById('edad');
  
  if (fechaNacimiento && edad) {
    console.log('Inicializando campo de edad...');
    
    fechaNacimiento.addEventListener('change', function() {
      console.log('Fecha de nacimiento cambiada:', this.value);
      if (this.value) {
        const birth = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
          age--;
        }
        
        edad.value = age;
        console.log('Edad calculada:', age);
      } else {
        edad.value = '';
        console.log('Fecha vacía, limpiando edad');
      }
    });
    
    // Hacer el campo readonly
    edad.readOnly = true;
    console.log('Campo de edad configurado como readonly');
  } else {
    console.error('No se encontraron los elementos fecha_nacimiento o edad');
  }

});

      // Agregar event listeners para limpiar errores cuando se corrigen los campos
       document.addEventListener('DOMContentLoaded', function() {
         const form = document.getElementById('raceRegistrationForm');
         if (!form) return;
         
         // Event listeners para todos los campos del formulario
         const allInputs = form.querySelectorAll('input, select, textarea');
         
         allInputs.forEach(function(input) {
           console.log('📝 Configurando campo:', input.name || input.id);
           
           // Para campos de texto - limpiar errores al escribir
           if (input.type === 'text' || input.type === 'email' || input.type === 'tel' || input.type === 'number') {
             input.addEventListener('input', function() {
               console.log('✏️ Input en campo:', this.name, 'Valor:', this.value);
               if (this.value.trim().length > 0) {
                 console.log('🧹 Limpiando errores para:', this.name);
                 clearValidationErrors(this);
               }
             });
             
             input.addEventListener('blur', function() {
               console.log('👁️ Blur en campo:', this.name);
               if (this.value.trim().length > 0) {
                 clearValidationErrors(this);
               }
             });
           }
           
           // Para selects - limpiar errores al seleccionar
           if (input.tagName.toLowerCase() === 'select') {
             input.addEventListener('change', function() {
               console.log('🔄 Change en select:', this.name, 'Valor:', this.value);
               if (this.value && this.value !== '') {
                 console.log('🧹 Limpiando errores para select:', this.name);
                 clearValidationErrors(this);
               }
             });
           }

           // Para fecha de nacimiento - calcular edad automáticamente y validar consistencia
           if (input.name === 'fecha_nacimiento') {
             input.addEventListener('change', function() {
               console.log('📅 Cambio en fecha de nacimiento:', this.value);
               if (this.value) {
                 const edad = calcularEdad(this.value);
                 const edadInput = form.querySelector('[name="edad"]');
                 if (edadInput) {
                   edadInput.value = edad;
                   console.log('🎂 Edad calculada:', edad);
                 }
                 
                 // Obtener categoría seleccionada
                 let selectedCat = 'adulto';
                 const catRadios = form.querySelectorAll('input[name="categoria_participante"]');
                 catRadios.forEach(r => { if (r.checked) selectedCat = r.value; });
                 
                 let isAgeValid = true;
                 let ageErrorMessage = '';

                 // 1. Validar por categoría
                 if (selectedCat === 'adulto') {
                   if (edad < 18) {
                     isAgeValid = false;
                     ageErrorMessage = 'Edad mínima para adulto: 18 años';
                   } else if (edad >= 90) {
                     isAgeValid = false;
                     ageErrorMessage = 'Edad máxima para adulto: menos de 90 años';
                   }
                 } else {
                   if (edad < 8) {
                     isAgeValid = false;
                     ageErrorMessage = 'Edad mínima: 8 años';
                   }
                 }

                 // 2. Validar por tipo de documento
                 const docTypeSelect = form.querySelector('[name="tipo_documento"]');
                 if (docTypeSelect && docTypeSelect.value) {
                   const docType = docTypeSelect.value;
                   if (docType === 'tarjeta_identidad' && edad >= 18) {
                     isAgeValid = false;
                     ageErrorMessage = 'Para Tarjeta de Identidad debes ser menor de 18 años.';
                     showValidationError(docTypeSelect, 'La Tarjeta de Identidad es para menores de 18 años.');
                   } else if (docType === 'cedula_ciudadania' && edad <= 18) {
                     isAgeValid = false;
                     ageErrorMessage = 'Para Cédula de Ciudadanía debes tener 18 años o más.';
                     showValidationError(docTypeSelect, 'La Cédula de Ciudadanía es para mayores de 18 años.');
                   } else {
                     clearValidationErrors(docTypeSelect);
                   }
                 }

                 if (isAgeValid) {
                   clearValidationErrors(this);
                   if (edadInput) clearValidationErrors(edadInput);
                 } else {
                   showValidationError(this, ageErrorMessage);
                 }
               }
             });
           }

           // Para tipo de documento - re-validar fecha de nacimiento si existe
           if (input.name === 'tipo_documento') {
             input.addEventListener('change', function() {
               const birthDateInput = form.querySelector('[name="fecha_nacimiento"]');
               if (birthDateInput && birthDateInput.value) {
                 const event = new Event('change');
                 birthDateInput.dispatchEvent(event);
               }
             });
           }
         });
         
         console.log('✅ Event listeners configurados correctamente');
       });

      // Función para calcular edad
      function calcularEdad(fechaNacimiento) {
        if (!fechaNacimiento) return 0;
        
        const hoy = new Date();
        const nacimiento = new Date(fechaNacimiento);
        let edad = hoy.getFullYear() - nacimiento.getFullYear();
        const mesActual = hoy.getMonth();
        const mesNacimiento = nacimiento.getMonth();
        
        if (mesActual < mesNacimiento || (mesActual === mesNacimiento && hoy.getDate() < nacimiento.getDate())) {
          edad--;
        }
        
        return edad;
      }

      // Funciones auxiliares de validación
      function showValidationError(input, message) {
        if (!input) return;
        
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        
        // Buscar o crear el div de feedback
        let feedback = input.parentNode.querySelector('.invalid-feedback');
        if (!feedback) {
          feedback = document.createElement('div');
          feedback.className = 'invalid-feedback';
          input.parentNode.appendChild(feedback);
        }
        feedback.textContent = message;
        feedback.style.display = 'block';
      }
      
      function clearValidationErrors(input) {
        if (!input) return;
        
        // Remover todas las clases de validación
        input.classList.remove('is-invalid');
        input.classList.remove('is-valid');
        
        // Limpiar validación personalizada
        input.setCustomValidity('');
        
        // Buscar y ocultar el mensaje de error
        const feedback = input.parentNode.querySelector('.invalid-feedback');
        if (feedback) {
          feedback.style.display = 'none';
          feedback.textContent = '';
        }
        
        // También buscar en el contenedor padre por si está en otro lugar
        const parentFeedback = input.closest('.mb-4, .col-md-3, .col-md-4, .col-md-6')?.querySelector('.invalid-feedback');
        if (parentFeedback) {
          parentFeedback.style.display = 'none';
          parentFeedback.textContent = '';
        }
      }

      function getCustomValidationMessage(input) {
        if (input.name === 'acepta_autorizacion') {
          return 'Debes aceptar la autorización para continuar.';
        }
        if (input.type === 'email') {
          return 'Por favor ingresa un email válido.';
        }
        return input.validationMessage || 'Este campo es obligatorio.';
      }
      
      function showValidationSummary(errors) {
        if (errors.length === 0) return;
        
        const summary = `Se encontraron ${errors.length} errores:\n\n${errors.join('\n')}`;
        
        Swal.fire({
          icon: 'error',
          title: 'Errores en el formulario',
          text: summary,
          confirmButtonText: 'Entendido',
          confirmButtonColor: '#dc3545'
        });
      }

      // Función de validación adicional completa
function performAdditionalValidation(form) {
  console.log('Iniciando performAdditionalValidation...');
  let isValid = true;
  const errors = [];
  
  // Obtener todos los datos del formulario
  const formData = new FormData(form);
  const data = {};
  for (let [key, value] of formData.entries()) {
    data[key] = value;
  }
  
  console.log('Datos del formulario:', data);
  
  // Validaciones específicas
  
  // 1. Validar nombre completo (mínimo 2 palabras)
  if (!data.nombre_completo || data.nombre_completo.trim().split(' ').length < 2) {
    showValidationError(form.querySelector('[name="nombre_completo"]'), 'Ingresa tu nombre completo (nombre y apellido)');
    errors.push('Nombre completo incompleto');
    isValid = false;
  }
  
  // 2. Validar email con formato correcto
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!data.email || !emailRegex.test(data.email)) {
    showValidationError(form.querySelector('[name="email"]'), 'Ingresa un email válido');
    errors.push('Email inválido');
    isValid = false;
  }
  
  // 3. Validar teléfono (debe iniciar con 3 y tener 10 caracteres)
  const phoneClean = data.telefono ? data.telefono.replace(/[^0-9]/g, '') : '';
  if (!phoneClean || phoneClean.length !== 10 || !phoneClean.startsWith('3')) {
    showValidationError(form.querySelector('[name="telefono"]'), 'El celular de contacto debe iniciar con 3 y tener 10 dígitos (Ej: 3001234567)');
    errors.push('Celular de contacto inválido (debe iniciar con 3 y tener 10 dígitos)');
    isValid = false;
  }
  
  // 4. Validar número de documento (mínimo 6 dígitos)
  if (!data.numero_documento || data.numero_documento.length < 6) {
    showValidationError(form.querySelector('[name="numero_documento"]'), 'Ingresa un número de documento válido (mínimo 6 dígitos)');
    errors.push('Documento inválido');
    isValid = false;
  }
  
  // 5. Validar edad mínima y límites (solo si hay fecha de nacimiento)
  const edad = parseInt(data.edad);
  if (data.fecha_nacimiento) {
    const catRadios = form.querySelectorAll('input[name="categoria_participante"]');
    let selectedCat = 'adulto';
    catRadios.forEach(r => { if (r.checked) selectedCat = r.value; });

    let isAgeValid = true;

    if (selectedCat === 'adulto') {
      if (!edad || edad < 18) {
        showValidationError(form.querySelector('[name="fecha_nacimiento"]'), 'Edad mínima para adulto: 18 años');
        errors.push('Edad para adulto menor de 18 años');
        isAgeValid = false;
      } else if (edad >= 90) {
        showValidationError(form.querySelector('[name="fecha_nacimiento"]'), 'Edad máxima para adulto: menos de 90 años');
        errors.push('Edad para adulto mayor o igual a 90 años');
        isAgeValid = false;
      }
    } else {
      if (!edad || edad < 8) {
        showValidationError(form.querySelector('[name="fecha_nacimiento"]'), 'Debes tener al menos 8 años para registrarte');
        errors.push('Edad insuficiente');
        isAgeValid = false;
      }
    }

    const docTypeSelect = form.querySelector('[name="tipo_documento"]');
    if (docTypeSelect && docTypeSelect.value) {
      const docType = docTypeSelect.value;
      if (docType === 'tarjeta_identidad' && edad >= 18) {
        showValidationError(docTypeSelect, 'La Tarjeta de Identidad es para menores de 18 años.');
        showValidationError(form.querySelector('[name="fecha_nacimiento"]'), 'Para Tarjeta de Identidad debes ser menor de 18 años.');
        errors.push('Tarjeta de Identidad con edad de adulto');
        isAgeValid = false;
      } else if (docType === 'cedula_ciudadania' && edad < 18) {
        showValidationError(docTypeSelect, 'La Cédula de Ciudadanía es para mayores de 18 años.');
        showValidationError(form.querySelector('[name="fecha_nacimiento"]'), 'Para Cédula de Ciudadanía debes tener 18 años o más.');
        errors.push('Cédula de Ciudadanía con edad de menor');
        isAgeValid = false;
      }
    }

    if (!isAgeValid) {
      isValid = false;
    }
  }
  
  // 6. Validar fecha de nacimiento coherente con edad
  if (data.fecha_nacimiento) {
    const fechaNacimiento = new Date(data.fecha_nacimiento);
    const hoy = new Date();
    let edadCalculada = hoy.getFullYear() - fechaNacimiento.getFullYear();
    const mesActual = hoy.getMonth();
    const diaActual = hoy.getDate();
    const mesNacimiento = fechaNacimiento.getMonth();
    const diaNacimiento = fechaNacimiento.getDate();
    
    if (mesActual < mesNacimiento || (mesActual === mesNacimiento && diaActual < diaNacimiento)) {
      edadCalculada--;
    }
    
    if (Math.abs(edadCalculada - edad) > 1) {
      showValidationError(form.querySelector('[name="fecha_nacimiento"]'), 'La fecha de nacimiento no coincide con la edad ingresada');
      errors.push('Fecha de nacimiento inconsistente');
      isValid = false;
    }
  }
  
  // 7. Validar contacto de emergencia
  const parentescoEmergencia = data.parentesco_emergencia;
  let nombreEmergenciaValue = '';
  
  console.log('Parentesco emergencia:', parentescoEmergencia);
  console.log('nombre_emergencia:', data.nombre_emergencia);
  console.log('nombre_emergencia_alt:', data.nombre_emergencia_alt);
  
  if (parentescoEmergencia === 'otro') {
    nombreEmergenciaValue = data.nombre_emergencia_alt || '';
  } else {
    nombreEmergenciaValue = data.nombre_emergencia || '';
  }
  
  console.log('Valor final para validación:', nombreEmergenciaValue);
  
  if (!nombreEmergenciaValue || nombreEmergenciaValue.trim() === '') {
    const targetField = parentescoEmergencia === 'otro' ? 
      form.querySelector('[name="nombre_emergencia_alt"]') : 
      form.querySelector('[name="nombre_emergencia"]');
    console.log('Campo objetivo para error:', targetField);
    showValidationError(targetField, 'Ingresa el nombre del contacto de emergencia');
    errors.push('Contacto de emergencia incompleto');
    isValid = false;
  }
  
  // 8. Validar celular de emergencia (mínimo 7 dígitos)
  const emergencyPhoneClean = data.celular_emergencia ? data.celular_emergencia.replace(/[^0-9]/g, '') : '';
  if (!emergencyPhoneClean || emergencyPhoneClean.length < 7) {
    showValidationError(form.querySelector('[name="celular_emergencia"]'), 'Ingresa un celular de emergencia válido (mínimo 7 dígitos)');
    errors.push('Celular de emergencia inválido');
    isValid = false;
  }
  
  // 9. Validar que el celular de emergencia sea diferente al teléfono personal
  if (phoneClean && emergencyPhoneClean && phoneClean === emergencyPhoneClean) {
    showValidationError(form.querySelector('[name="celular_emergencia"]'), 'El celular de emergencia debe ser diferente a tu teléfono personal');
    errors.push('Celular de emergencia igual al personal');
    isValid = false;
  }
  
  // 10. Validar campos obligatorios específicos
  const requiredFields = [
    { name: 'tipo_documento', message: 'Selecciona el tipo de documento' },
    { name: 'genero', message: 'Selecciona tu género' },
    { name: 'municipio', message: 'Ingresa tu municipio' },
    { name: 'eps', message: 'Ingresa tu EPS' }
  ];
  
  requiredFields.forEach(field => {
    if (!data[field.name] || data[field.name].trim() === '') {
      const element = form.querySelector(`[name="${field.name}"]`);
      if (element) {
        showValidationError(element, field.message);
        errors.push(field.message);
        isValid = false;
      }
    }
  });
  
  // 11. Validar autorización
  const authCheckbox = form.querySelector('[name="acepta_autorizacion"]');
  if (authCheckbox && !authCheckbox.checked) {
    showValidationError(authCheckbox, 'Debes aceptar la autorización para participar');
    errors.push('Autorización no aceptada');
    isValid = false;
  }
  
  // Si hay errores, mostrar notificación
  if (!isValid) {
    showValidationSummary(errors);
    
    // Scroll al primer campo con error
    const firstErrorField = form.querySelector('.is-invalid');
    if (firstErrorField) {
      firstErrorField.scrollIntoView({ 
        behavior: 'smooth', 
        block: 'center' 
      });
      firstErrorField.focus();
    }
  }
  
  console.log('Validación completada. isValid:', isValid, 'Errores:', errors);
  return isValid;
}

// Validación del formulario - ENVÍO DIRECTO SIN MODAL
(function() {
  'use strict';
  window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        console.log('=== VALIDACIÓN COMPLETA DEL FORMULARIO ===');
        
        // Validar todos los campos requeridos
        const requiredFields = [
          { name: 'nombres', message: 'Los nombres son obligatorios' },
          { name: 'apellidos', message: 'Los apellidos son obligatorios' },
          { name: 'tipo_documento', message: 'Selecciona el tipo de documento' },
          { name: 'numero_documento', message: 'El número de documento es obligatorio' },
          { name: 'fecha_nacimiento', message: 'La fecha de nacimiento es obligatoria' },
          { name: 'genero', message: 'Selecciona tu género' },
          { name: 'eps', message: 'La EPS es obligatoria' },
          { name: 'grupo_sanguineo', message: 'Selecciona tu grupo sanguíneo' },
          { name: 'rh', message: 'Selecciona tu RH' },
          { name: 'direccion', message: 'La dirección es obligatoria' },
          { name: 'municipio', message: 'El municipio es obligatorio' },
          { name: 'departamento', message: 'Selecciona tu departamento' },
          { name: 'telefono', message: 'El teléfono es obligatorio' },
          { name: 'email', message: 'El email es obligatorio' },
          { name: 'parentesco_emergencia', message: 'Selecciona el parentesco' },
          { name: 'celular_emergencia', message: 'El celular de emergencia es obligatorio' },
          { name: 'talla_camiseta', message: 'Selecciona tu talla de camiseta' }
        ];
        
        let errors = [];
        let hasErrors = false;
        
        // Validar cada campo requerido
        requiredFields.forEach(field => {
          const input = form.querySelector(`[name="${field.name}"]`);
          if (input) {
            const value = input.value.trim();
            
            if (!value || value === '') {
              errors.push(field.message);
              showValidationError(input, field.message);
              hasErrors = true;
            } else {
              clearValidationErrors(input);
            }
          }
        });
        
        // Validación especial para campos condicionales
        const parentesco = form.querySelector('[name="parentesco_emergencia"]').value;
        if (parentesco === 'otro') {
          const otroParentesco = form.querySelector('[name="otro_parentesco"]');
          const nombreEmergenciaAlt = form.querySelector('[name="nombre_emergencia_alt"]');
          
          if (otroParentesco && !otroParentesco.value.trim()) {
            errors.push('Especifica el tipo de parentesco');
            showValidationError(otroParentesco, 'Este campo es obligatorio');
            hasErrors = true;
          }
          
          // Validación de nombre del contacto de emergencia para nombre_emergencia_alt
          if (nombreEmergenciaAlt) {
            const nombreValue = nombreEmergenciaAlt.value.trim();
            console.log('Segunda validación - nombreEmergenciaAlt value:', nombreValue);
            if (!nombreValue) {
              errors.push('El nombre del contacto de emergencia es obligatorio');
              showValidationError(nombreEmergenciaAlt, 'Este campo es obligatorio');
              hasErrors = true;
            }
          }
        } else {
          const nombreEmergencia = form.querySelector('[name="nombre_emergencia"]');
          if (nombreEmergencia) {
            const nombreValue = nombreEmergencia.value.trim();
            console.log('Segunda validación - nombreEmergencia value:', nombreValue);
            if (!nombreValue) {
              errors.push('El nombre del contacto de emergencia es obligatorio');
              showValidationError(nombreEmergencia, 'Este campo es obligatorio');
              hasErrors = true;
            }
          }
        }
        
        // Validación de email
        const emailInput = form.querySelector('[name="email"]');
        if (emailInput) {
          const email = emailInput.value;
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (email && !emailRegex.test(email)) {
            errors.push('El formato del email no es válido');
            showValidationError(emailInput, 'Formato de email inválido');
            hasErrors = true;
          }
        }
        
        // Validación de celular de contacto (debe iniciar con 3 y tener 10 caracteres)
        const telefonoInput = form.querySelector('[name="telefono"]');
        if (telefonoInput) {
          const telVal = telefonoInput.value.replace(/[^0-9]/g, '');
          if (telVal.length > 0) {
            if (telVal.length !== 10 || !telVal.startsWith('3')) {
              errors.push('El celular de contacto debe iniciar con 3 y tener 10 dígitos (Ej: 3001234567)');
              showValidationError(telefonoInput, 'El celular de contacto debe iniciar con 3 y tener 10 dígitos.');
              hasErrors = true;
            }
          }
        }

        // Validación de edad y tipo de documento
        const fechaNacimientoInput = form.querySelector('[name="fecha_nacimiento"]');
        const edadInput = form.querySelector('[name="edad"]');
        const docTypeSelect = form.querySelector('[name="tipo_documento"]');
        
        if (fechaNacimientoInput && fechaNacimientoInput.value) {
          const edad = calcularEdad(fechaNacimientoInput.value);
          
          if (edadInput) {
            edadInput.value = edad;
          }
          
          const catRadios = form.querySelectorAll('input[name="categoria_participante"]');
          let selectedCat = 'adulto';
          catRadios.forEach(r => { if (r.checked) selectedCat = r.value; });
          
          // 1. Validar por categoría
          if (selectedCat === 'adulto') {
            if (edad < 18) {
              errors.push('Como adulto debes ser mayor de 18 años');
              showValidationError(fechaNacimientoInput, 'Edad mínima para adulto: 18 años');
              hasErrors = true;
            } else if (edad >= 90) {
              errors.push('La edad para adulto debe ser menor a 90 años');
              showValidationError(fechaNacimientoInput, 'Edad máxima para adulto: menos de 90 años');
              hasErrors = true;
            }
          } else {
            if (edad < 8) {
              errors.push('Debes tener al menos 8 años para participar');
              showValidationError(fechaNacimientoInput, 'Edad mínima: 8 años');
              hasErrors = true;
            }
          }

          // 2. Validar por tipo de documento
          if (docTypeSelect && docTypeSelect.value) {
            const docType = docTypeSelect.value;
            if (docType === 'tarjeta_identidad' && edad >= 18) {
              errors.push('Para Tarjeta de Identidad debes ser menor de 18 años.');
              showValidationError(docTypeSelect, 'La Tarjeta de Identidad es para menores de 18 años.');
              showValidationError(fechaNacimientoInput, 'Para Tarjeta de Identidad debes ser menor de 18 años.');
              hasErrors = true;
            } else if (docType === 'cedula_ciudadania' && edad < 18) {
              errors.push('Para Cédula de Ciudadanía debes tener 18 años o más.');
              showValidationError(docTypeSelect, 'La Cédula de Ciudadanía es para mayores de 18 años.');
              showValidationError(fechaNacimientoInput, 'Para Cédula de Ciudadanía debes tener 18 años o más.');
              hasErrors = true;
            }
          }
        }
        
        // Validación de etapa seleccionada
        const catRadios = form.querySelectorAll('input[name="categoria_participante"]');
        let selectedCat = 'adulto';
        catRadios.forEach(r => { if (r.checked) selectedCat = r.value; });
        
        const checkedStages = Array.from(form.querySelectorAll('.stage-checkbox')).filter(chk => chk.checked && chk.closest('.stage-card-item').style.display !== 'none');
        
        if (selectedCat === 'adulto') {
          const checkedAdultStages = checkedStages.filter(chk => {
            const cardItem = chk.closest('.stage-card-item');
            return cardItem && cardItem.getAttribute('data-cat-type') === 'adulto';
          });
          
          if (checkedAdultStages.length === 0) {
            errors.push('Debes seleccionar una etapa para la categoría Adulto (5K o 10K)');
            const container = form.querySelector('#stagesContainer');
            if (container) {
              container.classList.add('is-invalid');
              const feedback = container.parentNode.querySelector('.invalid-feedback') || document.createElement('div');
              feedback.className = 'invalid-feedback d-block';
              feedback.textContent = 'Debes seleccionar una etapa (5K o 10K)';
              if (!container.parentNode.querySelector('.invalid-feedback')) {
                container.parentNode.appendChild(feedback);
              }
            }
            hasErrors = true;
          } else if (checkedAdultStages.length > 1) {
            errors.push('Un adulto solo se puede inscribir a 10K o 5K, pero no a los dos');
            hasErrors = true;
          }
        } else {
          if (checkedStages.length === 0) {
            errors.push('Debe seleccionar al menos una etapa para inscribirse');
            const container = form.querySelector('#stagesContainer');
            if (container) {
              container.classList.add('is-invalid');
              const feedback = container.parentNode.querySelector('.invalid-feedback') || document.createElement('div');
              feedback.className = 'invalid-feedback d-block';
              feedback.textContent = 'Debe seleccionar al menos una etapa para inscribirse';
              if (!container.parentNode.querySelector('.invalid-feedback')) {
                container.parentNode.appendChild(feedback);
              }
            }
            hasErrors = true;
          }
        }
        
        // Validación de choque 5K/10K con etapas ya inscritas
        const hasRegistered5K = registeredStages.some(stg => stg.distance === '5K');
        const hasRegistered10K = registeredStages.some(stg => stg.distance === '10K');
        
        let selected5K = false;
        let selected10K = false;
        
        checkedStages.forEach(chk => {
          const cardItem = chk.closest('.stage-card-item');
          if (cardItem) {
            const badgeText = cardItem.querySelector('.badge:not(.already-registered-badge)')?.textContent || '';
            if (badgeText.includes('5K')) {
              selected5K = true;
            } else if (badgeText.includes('10K')) {
              selected10K = true;
            }
          }
        });
        
        if ((selected5K || hasRegistered5K) && (selected10K || hasRegistered10K)) {
          errors.push('Un participante solo se puede inscribir a 10K o 5K, pero no a las dos distancias (se corren el mismo día). Sin embargo, sí te puedes inscribir a 3K y también a 5K o 10K.');
          const container = form.querySelector('#stagesContainer');
          if (container) {
            container.classList.add('is-invalid');
            const feedback = container.parentNode.querySelector('.invalid-feedback') || document.createElement('div');
            feedback.className = 'invalid-feedback d-block';
            feedback.textContent = 'Conflicto de distancias: No se permiten 5K y 10K juntas.';
            if (!container.parentNode.querySelector('.invalid-feedback')) {
              container.parentNode.appendChild(feedback);
            }
          }
          hasErrors = true;
        }
        
        // Validación de autorización
        const autorizacionInput = form.querySelector('[name="acepta_autorizacion"]');
        if (autorizacionInput && !autorizacionInput.checked) {
          errors.push('Debes aceptar la autorización para participar');
          showValidationError(autorizacionInput, 'Debes aceptar la autorización');
          hasErrors = true;
        }
        
        console.log('Errores encontrados:', errors);
        console.log('¿Hay errores?', hasErrors);
        
        if (hasErrors) {
          // Prevenir envío si hay errores
          event.preventDefault();
          event.stopPropagation();
          
          // Mostrar resumen de errores
          showValidationSummary(errors);
          
          // Hacer scroll al primer campo con error
          const firstErrorField = form.querySelector('.is-invalid');
          if (firstErrorField) {
            firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstErrorField.focus();
          }
          
          form.classList.add('was-validated');
          return false;
        }
        
        // Si no hay errores, mostrar modal de confirmación
        console.log('✅ Formulario válido, mostrando confirmación...');
        
        // IMPORTANTE: Prevenir el envío automático del formulario
        event.preventDefault();
        event.stopPropagation();
        
        form.classList.add('was-validated');
        
        // Mostrar modal de confirmación antes de enviar
        showConfirmationModal(form);
        return false;
      }, false);
    });
  }, false);
})();

// Función para mostrar modal de confirmación
function showConfirmationModal(form) {
  // Obtener todos los datos del formulario
  const formData = new FormData(form);
  const data = {};
  for (let [key, value] of formData.entries()) {
    data[key] = value;
  }
  
  // Función para obtener texto legible de los valores
  function getDocumentTypeText(value) {
    const types = {
      'cedula': 'Cédula de Ciudadanía',
      'tarjeta_identidad': 'Tarjeta de Identidad',
      'cedula_extranjeria': 'Cédula de Extranjería',
      'pasaporte': 'Pasaporte'
    };
    return types[value] || value;
  }
  
  function getGenderText(value) {
    const genders = {
      'masculino': 'Masculino',
      'femenino': 'Femenino',
      'otro': 'Otro'
    };
    return genders[value] || value;
  }
  
  function getExperienceText(value) {
    const experiences = {
      'principiante': 'Principiante',
      'intermedio': 'Intermedio',
      'avanzado': 'Avanzado'
    };
    return experiences[value] || value;
  }
  
  // Crear el contenido del modal
  const modalContent = `
    <div class="text-start">
      <div class="alert alert-info mb-3">
        <i class="fas fa-info-circle me-2"></i>
        Por favor, revisa que todos los datos sean correctos antes de enviar tu inscripción.
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <h6 class="text-primary mb-2"><i class="fas fa-user me-2"></i>Información Personal</h6>
          <p class="mb-1"><strong>Nombres:</strong> ${data.nombres || 'No especificado'}</p>
          <p class="mb-1"><strong>Apellidos:</strong> ${data.apellidos || 'No especificado'}</p>
          <p class="mb-1"><strong>Email:</strong> ${data.email || 'No especificado'}</p>
          <p class="mb-1"><strong>Teléfono:</strong> ${data.telefono || 'No especificado'}</p>
          <p class="mb-1"><strong>Documento:</strong> ${getDocumentTypeText(data.tipo_documento)} - ${data.numero_documento || 'No especificado'}</p>
          <p class="mb-1"><strong>Género:</strong> ${getGenderText(data.genero)}</p>
          <p class="mb-1"><strong>Fecha de Nacimiento:</strong> ${data.fecha_nacimiento || 'No especificado'}</p>
          <p class="mb-3"><strong>Edad:</strong> ${data.edad || 'No especificado'} años</p>
        </div>
        
        <div class="col-md-6">
          <h6 class="text-primary mb-2"><i class="fas fa-tint me-2"></i>Información Médica</h6>
          <p class="mb-1"><strong>Grupo Sanguíneo:</strong> ${data.grupo_sanguineo || 'No especificado'}</p>
          <p class="mb-3"><strong>RH:</strong> ${data.rh ? (data.rh === '+' ? 'Positivo (+)' : 'Negativo (-)') : 'No especificado'}</p>
          
          <h6 class="text-primary mb-2"><i class="fas fa-map-marker-alt me-2"></i>Información Adicional</h6>
          <p class="mb-1"><strong>Municipio:</strong> ${data.municipio || 'No especificado'}</p>
          <p class="mb-3"><strong>EPS:</strong> ${data.eps || 'No especificado'}</p>
          
          <h6 class="text-primary mb-2"><i class="fas fa-phone me-2"></i>Contacto de Emergencia</h6>
          <p class="mb-1"><strong>Nombre:</strong> ${data.parentesco_emergencia === 'otro' ? (data.nombre_emergencia_alt || 'No especificado') : (data.nombre_emergencia || 'No especificado')}</p>
          <p class="mb-1"><strong>Parentesco:</strong> ${data.parentesco_emergencia === 'otro' ? (data.otro_parentesco || 'Otro') : (data.parentesco_emergencia || 'No especificado')}</p>
          <p class="mb-1"><strong>Celular:</strong> ${data.celular_emergencia || 'No especificado'}</p>
        </div>
      </div>
    </div>
  `;
  
  // Mostrar el modal usando SweetAlert2
  Swal.fire({
    title: '¿Confirmar Inscripción?',
    html: modalContent,
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#28a745',
    cancelButtonColor: '#dc3545',
    confirmButtonText: '<i class="fas fa-check me-2"></i>Sí, enviar inscripción',
    cancelButtonText: '<i class="fas fa-times me-2"></i>Cancelar',
    customClass: {
      popup: 'swal-wide'
    },
    allowOutsideClick: false,
    allowEscapeKey: false
  }).then((result) => {
    if (result.isConfirmed) {
      // Si confirma, enviar el formulario
        console.log('✅ Usuario confirmó el envío');
        console.log('🔧 Iniciando envío con XMLHttpRequest...');
        
        // Mostrar loading
        Swal.fire({
          title: 'Enviando inscripción...',
          text: 'Por favor espera mientras procesamos tu información',
          icon: 'info',
          allowOutsideClick: false,
          allowEscapeKey: false,
          showConfirmButton: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });
        
        // Enviar formulario usando XMLHttpRequest para máxima compatibilidad
        const formData = new FormData(form);
        formData.append('ajax', '1'); // Agregar indicador AJAX adicional
        
        console.log('📤 Preparando XMLHttpRequest...');
        const xhr = new XMLHttpRequest();
        const targetUrl = form.getAttribute('action') || '/inscribirse/guardar';
        xhr.open('POST', targetUrl, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('X-CSRF-Token', 'no-csrf');
        
        console.log('📡 Configurando event handlers...');
        xhr.onreadystatechange = function() {
          console.log('📊 ReadyState:', xhr.readyState, 'Status:', xhr.status);
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
              console.log('✅ Respuesta recibida:', xhr.responseText);
              try {
                const data = JSON.parse(xhr.responseText);
                console.log('📋 Datos parseados:', data);
                if (data.success) {
                  // Mostrar modal de éxito y pago
                  Swal.fire({
                    title: '¡Inscripción Registrada!',
                    text: 'Para completar tu inscripción, debes realizar el pago seguro.',
                    icon: 'info',
                    confirmButtonText: 'Proceder al Pago',
                    confirmButtonColor: '#28a745',
                    allowOutsideClick: false
                  }).then(() => {
                    // Redirigir manualmente a la página de pago seguro
                    window.location.href = data.redirect || 'registration_success';
                  });
                } else {
                  // Mostrar error si no fue exitoso
                  console.log('❌ Errores recibidos:', data.message); // Debug
                  Swal.fire({
                    title: 'Errores en el formulario',
                    html: data.message || 'Hubo un problema al procesar tu inscripción.',
                    icon: 'error',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#dc3545',
                    width: '600px',
                    customClass: {
                      htmlContainer: 'text-start'
                    }
                  });
                }
              } catch (e) {
                console.error('❌ Error parsing JSON:', e);
                console.log('📄 Response text:', xhr.responseText);
                Swal.fire({
                  title: 'Error de respuesta',
                  text: 'La respuesta del servidor no es válida.',
                  icon: 'error',
                  confirmButtonText: 'Entendido',
                  confirmButtonColor: '#dc3545'
                });
              }
            } else {
              console.error('❌ HTTP Error:', xhr.status);
              Swal.fire({
                title: 'Error de conexión',
                text: 'No se pudo conectar con el servidor. Por favor, verifica tu conexión e inténtalo de nuevo.',
                icon: 'error',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#dc3545'
              });
            }
          }
        };
        
        console.log('🚀 Enviando petición...');
        xhr.send(formData);
    } else {
      console.log('❌ Usuario canceló el envío');
      // Si cancela, remover la clase was-validated para permitir edición
      form.classList.remove('was-validated');
    }
  });
}

// Validación en tiempo real para todos los campos requeridos (excepto los que tienen validación personalizada)
document.querySelectorAll('input[required], select[required]').forEach(function(input) {
  // Excluir los campos que tienen validación personalizada
  if (input.id === 'fecha_nacimiento' || input.id === 'edad' || input.name === 'numero_documento' || input.name === 'telefono' || input.name === 'celular_emergencia' || input.id === 'nombres' || input.id === 'apellidos') {
    // Estos campos NO deben tener validación automática porque tienen validación personalizada
    return;
  }
  
  // Evento input para campos de texto (incluyendo email) - LIMPIAR ERRORES AL ESCRIBIR
  if (input.tagName.toLowerCase() === 'input') {
    input.addEventListener('input', function() {
      // Limpiar errores cuando el usuario empiece a escribir
      if (this.value.trim().length > 0) {
        clearValidationErrors(this);
      }
    });
    
    input.addEventListener('blur', function() {
      // Validar solo cuando el usuario sale del campo
      if (!this.checkValidity()) {
        showValidationError(this, getCustomValidationMessage(this));
      } else {
        clearValidationErrors(this);
      }
    });
  }
  
  // Evento change para selects y otros elementos
  input.addEventListener('change', function() {
    // Para campos select, limpiar errores si se selecciona cualquier opción válida (no vacía)
    if (this.tagName.toLowerCase() === 'select') {
      if (this.value && this.value !== '') {
        clearValidationErrors(this);
      } else {
        showValidationError(this, getCustomValidationMessage(this));
      }
    } else {
      // Para otros elementos, usar checkValidity
      if (this.checkValidity()) {
        clearValidationErrors(this);
      } else {
        showValidationError(this, getCustomValidationMessage(this));
      }
    }
  });
});

// Validación especial para número de documento: solo permitir números
document.querySelector('input[name="numero_documento"]').addEventListener('input', function(e) {
  // Remover cualquier carácter que no sea número
  this.value = this.value.replace(/[^0-9]/g, '');
  
  // Limpiar errores de validación cuando el campo tenga números válidos
  if (this.value.length > 0) {
    clearValidationErrors(this);
  }
});

// Validación adicional para número de documento en blur
document.querySelector('input[name="numero_documento"]').addEventListener('blur', function() {
  if (this.value.trim() === '') {
    showValidationError(this, 'Este campo es obligatorio.');
  } else {
    clearValidationErrors(this);
    fetchRegisteredStages(this.value);
  }
});

// Consultar etapas al cambiar el número de documento
document.querySelector('input[name="numero_documento"]').addEventListener('change', function() {
  fetchRegisteredStages(this.value);
});

// Validación especial para teléfono de contacto: solo permitir números, espacios, + y -
document.querySelector('input[name="telefono"]').addEventListener('input', function(e) {
  // Remover cualquier carácter que no sea número, espacio, + o -
  this.value = this.value.replace(/[^0-9\s\+\-]/g, '');
  
  // Limpiar errores de validación cuando el campo tenga contenido válido (inicia con 3 y tiene 10 dígitos)
  const cleanVal = this.value.replace(/[^0-9]/g, '');
  if (cleanVal.length === 10 && cleanVal.startsWith('3')) {
    clearValidationErrors(this);
  }
});

// Validación adicional para teléfono de contacto en blur
document.querySelector('input[name="telefono"]').addEventListener('blur', function() {
  const cleanVal = this.value.replace(/[^0-9]/g, '');
  if (this.value.trim() === '') {
    showValidationError(this, 'Por favor ingresa tu número de teléfono.');
  } else if (cleanVal.length !== 10 || !cleanVal.startsWith('3')) {
    showValidationError(this, 'El celular de contacto debe iniciar con 3 y tener 10 dígitos.');
  } else {
    clearValidationErrors(this);
  }
});

// Lógica para Selección Dinámica de Categorías, Multietapas y Cálculo de Precio
(function(){
  const catRadios = document.querySelectorAll('input[name="categoria_participante"]');
  const stageItems = document.querySelectorAll('.stage-card-item');
  const stageCheckboxes = document.querySelectorAll('.stage-checkbox');
  const totalDisplay = document.getElementById('totalRegistrationPrice');
  const petSection = document.getElementById('petSection');
  const tutorSection = document.getElementById('tutorSection');
  const addNotice = document.getElementById('additionalDistanceNotice');
  const shirtChildContainer = document.getElementById('shirtChildContainer');
  const shirtAdultContainer = document.getElementById('shirtAdultContainer');
  const shirtChildSelect = document.getElementById('talla_camiseta_nino');
  const shirtAdultSelect = document.getElementById('talla_camiseta_adulto');

  function updateBirthDateLimits() {
    const birthDateInput = document.getElementById('fecha_nacimiento');
    if (!birthDateInput) return;

    const docTypeSelect = document.getElementById('tipo_documento');
    const docType = docTypeSelect ? docTypeSelect.value : '';

    let selectedCat = 'adulto';
    catRadios.forEach(r => { if (r.checked) selectedCat = r.value; });

    const today = new Date();
    
    let minDate = new Date();
    let maxDate = new Date();
    
    if (docType === 'cedula_ciudadania') {
      // De 18 a 89 años (mayor de 18 y menos de 90)
      minDate.setFullYear(today.getFullYear() - 90);
      minDate.setDate(minDate.getDate() + 1);
      
      maxDate.setFullYear(today.getFullYear() - 18);
    } else if (docType === 'tarjeta_identidad') {
      // De 8 a 17 años (menor de 18 y al menos 8)
      minDate.setFullYear(today.getFullYear() - 18);
      minDate.setDate(minDate.getDate() + 1);
      
      maxDate.setFullYear(today.getFullYear() - 6);
    } else {
      // Pasaporte o vacío: usar reglas de categoría
      if (selectedCat === 'adulto') {
        minDate.setFullYear(today.getFullYear() - 90);
        minDate.setDate(minDate.getDate() + 1);
        maxDate.setFullYear(today.getFullYear() - 18);
      } else {
        minDate.setFullYear(today.getFullYear() - 100);
        maxDate.setFullYear(today.getFullYear() - 8);
      }
    }
    
    birthDateInput.min = minDate.toISOString().split('T')[0];
    birthDateInput.max = maxDate.toISOString().split('T')[0];
    
    if (birthDateInput.value) {
      const edad = calcularEdad(birthDateInput.value);
      const edadInput = document.getElementById('edad');
      if (edadInput) {
        edadInput.value = edad;
      }
      
      let isAgeValid = true;
      let ageErrorMessage = '';

      if (selectedCat === 'adulto') {
        if (edad < 18) {
          isAgeValid = false;
          ageErrorMessage = 'Edad mínima para adulto: 18 años';
        } else if (edad >= 90) {
          isAgeValid = false;
          ageErrorMessage = 'Edad máxima para adulto: menos de 90 años';
        }
      } else {
        if (edad < 8) {
          isAgeValid = false;
          ageErrorMessage = 'Edad mínima: 8 años';
        }
      }

      if (docType === 'tarjeta_identidad' && edad >= 18) {
        isAgeValid = false;
        ageErrorMessage = 'Para Tarjeta de Identidad debes ser menor de 18 años.';
        if (docTypeSelect) showValidationError(docTypeSelect, 'La Tarjeta de Identidad es para menores de 18 años.');
      } else if (docType === 'cedula_ciudadania' && edad < 18) {
        isAgeValid = false;
        ageErrorMessage = 'Para Cédula de Ciudadanía debes tener 18 años o más.';
        if (docTypeSelect) showValidationError(docTypeSelect, 'La Cédula de Ciudadanía es para mayores de 18 años.');
      } else {
        if (docTypeSelect) clearValidationErrors(docTypeSelect);
      }

      if (isAgeValid) {
        clearValidationErrors(birthDateInput);
        if (edadInput) clearValidationErrors(edadInput);
      } else {
        showValidationError(birthDateInput, ageErrorMessage);
      }
    }
  }

  function updateCategoryAndStages() {
    let selectedCat = 'adulto';
    catRadios.forEach(r => { if (r.checked) selectedCat = r.value; });

    const is3K = (selectedCat === 'mascota' || selectedCat === 'nino');

    // Secciones condicionales
    if (petSection) petSection.classList.toggle('d-none', selectedCat !== 'mascota');
    if (tutorSection) tutorSection.classList.toggle('d-none', selectedCat !== 'nino');
    if (addNotice) addNotice.classList.toggle('d-none', !is3K);

    // Manejo de Tallas de Camiseta
    if (shirtChildContainer && shirtChildSelect) {
      const isChild = (selectedCat === 'nino');
      shirtChildContainer.classList.toggle('d-none', !isChild);
      shirtChildSelect.required = isChild;
      if (!isChild) shirtChildSelect.value = '';
    }
    if (shirtAdultSelect) {
      shirtAdultSelect.required = (selectedCat !== 'nino');
    }

    // Filtrar etapas visibles por categoría
    stageItems.forEach(item => {
      const type = item.getAttribute('data-cat-type');
      const chk = item.querySelector('.stage-checkbox');
      
      const shouldShow = (type === selectedCat) || (type === 'adicional' && is3K);

      if (shouldShow) {
        item.style.display = 'block';
        if (type === selectedCat && chk && !is3K) {
          // Mantener o seleccionar por defecto
        }
        if (type === selectedCat && is3K && chk && !chk.disabled) {
          chk.checked = true; // Auto-seleccionar la etapa principal 3K al elegir la categoría
        }
      } else {
        item.style.display = 'none';
        if (chk) chk.checked = false;
      }
    });

    updateBirthDateLimits();
    if (typeof updateStageStates === 'function') {
      updateStageStates();
    }
    calculateTotal();
  }

  function calculateTotal() {
    let total = 0;
    let hasPresale = false;
    stageCheckboxes.forEach(chk => {
      if (chk.checked && chk.closest('.stage-card-item').style.display !== 'none') {
        total += Number(chk.getAttribute('data-price') || 0);
        if (chk.getAttribute('data-presale') === '1') {
          hasPresale = true;
        }
      }
    });
    if (totalDisplay) {
      totalDisplay.textContent = '$' + total.toLocaleString('es-CO') + ' COP';
    }
    
    // Actualizar texto del botón de inscripción
    const submitBtn = document.querySelector('button[type="submit"]');
    if (submitBtn) {
      if (hasPresale) {
        submitBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i>Confirmar inscripción (Preventa)';
      } else {
        submitBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i>Confirmar inscripción';
      }
    }
  }

  catRadios.forEach(r => r.addEventListener('change', updateCategoryAndStages));
  stageCheckboxes.forEach(chk => {
    chk.addEventListener('change', function() {
      let selectedCat = 'adulto';
      catRadios.forEach(r => { if (r.checked) selectedCat = r.value; });
      
      if (selectedCat === 'adulto' && chk.checked) {
        const cardItem = chk.closest('.stage-card-item');
        if (cardItem && cardItem.getAttribute('data-cat-type') === 'adulto') {
          stageCheckboxes.forEach(otherChk => {
            if (otherChk !== chk) {
              const otherCardItem = otherChk.closest('.stage-card-item');
              if (otherCardItem && otherCardItem.getAttribute('data-cat-type') === 'adulto') {
                otherChk.checked = false;
              }
            }
          });
        }
      }
      
      const container = document.getElementById('stagesContainer');
      if (container) {
        container.classList.remove('is-invalid');
        const feedback = container.parentNode.querySelector('.invalid-feedback');
        if (feedback) {
          feedback.style.display = 'none';
          feedback.textContent = '';
        }
      }
      
      calculateTotal();
    });
  });

  const docTypeSelect = document.getElementById('tipo_documento');
  if (docTypeSelect) {
    docTypeSelect.addEventListener('change', function() {
      updateBirthDateLimits();
    });
  }

  document.addEventListener('DOMContentLoaded', updateCategoryAndStages);
  updateCategoryAndStages();
})();

// Validación especial para celular de emergencia: solo permitir números, espacios, + y -
document.querySelector('input[name="celular_emergencia"]').addEventListener('input', function(e) {
  // Remover cualquier carácter que no sea número, espacio, + o -
  this.value = this.value.replace(/[^0-9\s\+\-]/g, '');
  
  // Limpiar errores de validación cuando el campo tenga contenido válido
  if (this.value.length > 0) {
    clearValidationErrors(this);
  }
});

// Validación adicional para celular de emergencia en blur
document.querySelector('input[name="celular_emergencia"]').addEventListener('blur', function() {
  if (this.value.trim() === '') {
    showValidationError(this, 'Por favor ingresa el celular del contacto de emergencia.');
  } else {
    clearValidationErrors(this);
  }
});

// Efectos de animación en los inputs
document.querySelectorAll('.form-control-sport, .form-select-sport').forEach(function(input) {
  input.addEventListener('focus', function() {
    this.parentElement.style.transform = 'scale(1.02)';
  });
  
  input.addEventListener('blur', function() {
    this.parentElement.style.transform = 'scale(1)';
  });
});


// Manejo del campo "otro parentesco"
document.querySelector('select[name="parentesco_emergencia"]').addEventListener('change', function() {
  const otroParentesco = document.getElementById('otro-parentesco');
  const nombreEmergenciaFull = document.getElementById('nombre-emergencia-full');
  const nombreEmergenciaHalf = document.getElementById('nombre-emergencia-half');
  const otroParentescoInput = document.querySelector('input[name="otro_parentesco"]');
  const nombreEmergenciaInput = document.querySelector('input[name="nombre_emergencia"]');
  const nombreEmergenciaAltInput = document.querySelector('input[name="nombre_emergencia_alt"]');
  
  if (this.value === 'otro') {
    otroParentesco.style.display = 'block';
    nombreEmergenciaFull.style.display = 'none';
    nombreEmergenciaHalf.style.display = 'block';
    otroParentescoInput.required = true;
    nombreEmergenciaInput.required = false;
    nombreEmergenciaAltInput.required = true;
  } else {
    otroParentesco.style.display = 'none';
    nombreEmergenciaFull.style.display = 'block';
    nombreEmergenciaHalf.style.display = 'none';
    otroParentescoInput.required = false;
    nombreEmergenciaInput.required = true;
    nombreEmergenciaAltInput.required = false;
  }
});
</script>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Estilos personalizados para SweetAlert2 -->
<style>
.swal-wide {
  width: 600px !important;
}

.swal2-popup {
  border-radius: 15px !important;
}

.swal2-title {
  font-size: 1.5rem !important;
  font-weight: 600 !important;
  color: #2c3e50 !important;
}

.swal2-html-container {
  font-size: 1rem !important;
  line-height: 1.6 !important;
}

.swal2-confirm {
  font-weight: 600 !important;
  padding: 12px 24px !important;
  border-radius: 8px !important;
}

.swal2-cancel {
  font-weight: 600 !important;
  padding: 12px 24px !important;
  border-radius: 8px !important;
}
</style>

<?php include __DIR__ . '/layouts/footer.php'; ?>