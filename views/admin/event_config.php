<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="page-content" style="padding-top: 0 !important;">
<div class="container-fluid py-4 px-md-5 style-admin-bg" style="padding-top: calc(62px + 1.5rem) !important; min-height: 100vh;">

    <!-- Navegación Superior del Admin -->
    <?php 
    $activeTab = 'event';
    include __DIR__ . '/layout_nav.php'; 
    ?>

    <!-- Mensajes Flash de Notificación -->
    <?php if (!empty($_SESSION['admin_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow mb-4 text-white" style="background-color: #2e7d32;" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?= htmlspecialchars($_SESSION['admin_success']) ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['admin_success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['admin_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow mb-4 text-white" style="background-color: #c62828;" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> <?= htmlspecialchars($_SESSION['admin_error']) ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['admin_error']); ?>
    <?php endif; ?>

    <!-- Banner Encabezado de Gestión del Evento -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-2 border-bottom border-secondary border-opacity-25 gap-3">
        <div>
            <h2 class="fw-bold mb-1" style="color: #87CC3E;">
                <i class="fas fa-calendar-check me-2"></i>Gestión de Información del Evento
            </h2>
            <p class="text-white-50 mb-0 small">Configura los cupos, fechas de preventa y fin del evento, además de los costos por kilometraje (3K, 5K, 10K y Adicionales).</p>
        </div>
        <div>
            <?php if (!empty($event['is_presale_active'])): ?>
                <span class="badge px-3 py-2 rounded-pill fs-6 text-dark" style="background-color: #87CC3E; font-weight: 700;">
                    <i class="fas fa-fire me-1"></i> PREVENTA ACTIVA
                </span>
            <?php else: ?>
                <span class="badge px-3 py-2 rounded-pill fs-6 bg-secondary text-white" style="font-weight: 600;">
                    <i class="fas fa-tag me-1"></i> VENTA REGULAR
                </span>
            <?php endif; ?>
        </div>
    </div>

    <form action="/admin/evento/actualizar" method="POST" id="eventConfigForm">

        <!-- Métricas Rápidas de Cupos -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card border-0 rounded-4 p-3 shadow-sm h-100" style="background: linear-gradient(135deg, #1e1e1e 0%, #252525 100%);">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-white-50 small text-uppercase fw-bold">Cupos Totales</span>
                            <h3 class="fw-bold text-white mb-0 mt-1"><?= number_format($event['total_slots'] ?? 600) ?></h3>
                        </div>
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background-color: rgba(135, 204, 62, 0.15); width: 54px; height: 54px;">
                            <i class="fas fa-users-cog fs-4" style="color: #87CC3E;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 rounded-4 p-3 shadow-sm h-100" style="background: linear-gradient(135deg, #1e1e1e 0%, #252525 100%);">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-white-50 small text-uppercase fw-bold">Inscritos Actuales</span>
                            <h3 class="fw-bold text-warning mb-0 mt-1"><?= number_format($event['registered_count'] ?? 0) ?></h3>
                        </div>
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background-color: rgba(255, 193, 7, 0.15); width: 54px; height: 54px;">
                            <i class="fas fa-user-check fs-4 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 rounded-4 p-3 shadow-sm h-100" style="background: linear-gradient(135deg, #1e1e1e 0%, #252525 100%);">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-white-50 small text-uppercase fw-bold">Cupos Disponibles</span>
                            <h3 class="fw-bold text-info mb-0 mt-1"><?= number_format($event['available_slots'] ?? 600) ?></h3>
                        </div>
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background-color: rgba(13, 202, 240, 0.15); width: 54px; height: 54px;">
                            <i class="fas fa-ticket-alt fs-4 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">

            <!-- Columna Izquierda: Información General y Fechas del Evento -->
            <div class="col-lg-5">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-4" style="background-color: #1e1e1e;">
                    <h4 class="fw-bold mb-4 pb-2 border-bottom border-secondary border-opacity-25" style="color: #87CC3E;">
                        <i class="fas fa-clock me-2"></i>Fechas y Cupos del Evento
                    </h4>

                    <input type="hidden" name="event_id" value="<?= htmlspecialchars($event['id'] ?? 1) ?>">

                    <div class="mb-3">
                        <label for="event_title" class="form-label text-white fw-semibold">Nombre del Evento *</label>
                        <input type="text" class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 rounded-3" id="event_title" name="event_title" value="<?= htmlspecialchars($event['title'] ?? 'Carrera Corre Con FEMTRIBE') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="event_location" class="form-label text-white fw-semibold">Ubicación / Ciudad</label>
                        <input type="text" class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 rounded-3" id="event_location" name="event_location" value="<?= htmlspecialchars($event['location'] ?? 'Cali, Valle del Cauca') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="total_slots" class="form-label text-white fw-semibold">Límite de Cupos Totales *</label>
                        <input type="number" min="1" class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 rounded-3" id="total_slots" name="total_slots" value="<?= htmlspecialchars($event['total_slots'] ?? 0) ?>" readonly style="cursor: not-allowed; opacity: 0.85;">
                        <div class="form-text text-white-50 small">Este límite se calcula automáticamente como la suma de los cupos de las modalidades activas.</div>
                    </div>

                    <hr class="my-3 border-secondary border-opacity-25">

                    <h6 class="fw-bold mb-3" style="color: #B2D81F;">
                        <i class="fas fa-route me-2"></i>Cupos por Kilometraje y Tipo
                    </h6>
                    <p class="text-white-50 small mb-3">Define el máximo de inscripciones permitidas para cada modalidad de carrera.</p>

                    <?php 
                    // Leer cupos por etapa si existen
                    $stageSlots = [];
                    if (!empty($stages)) {
                        foreach ($stages as $stg) {
                            $stageSlots[$stg['id']] = $stg['slots_limit'] ?? null;
                        }
                    }
                    ?>

                    <?php if (!empty($stages)): ?>
                        <div class="row g-2 mb-2">
                            <?php foreach ($stages as $stg): if (empty($stg['is_active'])) continue; ?>
                            <div class="col-12 p-3 border border-secondary border-opacity-25 rounded-3 mb-2" style="background-color: rgba(255,255,255,0.02);">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge rounded-pill px-2 py-1 fw-bold flex-shrink-0" style="background-color: rgba(178,216,31,0.15); color: #B2D81F; font-size:0.75rem; min-width: 48px; text-align:center;">
                                        <?= htmlspecialchars($stg['distance']) ?>
                                    </span>
                                    <strong class="text-white flex-grow-1" style="font-size:0.82rem;"><?= htmlspecialchars($stg['name']) ?></strong>
                                </div>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label text-white-50 mb-1" style="font-size: 0.7rem;">Cupos Preventa *</label>
                                        <input type="number" min="1" placeholder="Preventa"
                                               class="form-control form-control-sm bg-dark text-white border-secondary border-opacity-50 rounded-3 stage-slots-input"
                                               name="stage_presale_slots[<?= $stg['id'] ?>]"
                                               value="<?= htmlspecialchars($stg['presale_slots_limit'] ?? '') ?>" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label text-white-50 mb-1" style="font-size: 0.7rem;">Cupos Venta Normal *</label>
                                        <input type="number" min="1" placeholder="Normal"
                                               class="form-control form-control-sm bg-dark text-white border-secondary border-opacity-50 rounded-3 stage-slots-input"
                                               name="stage_slots[<?= $stg['id'] ?>]"
                                               value="<?= htmlspecialchars($stg['slots_limit'] ?? '') ?>" required>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-text text-white-50 small mb-0">Define los cupos obligatorios para la preventa y venta normal.</div>
                    <?php else: ?>
                        <p class="text-white-50 small mb-0"><i class="fas fa-info-circle me-1"></i>Primero crea los kilometrajes en la sección de costos.</p>
                    <?php endif; ?>

                    <hr class="my-4 border-secondary border-opacity-25">

                    <h6 class="fw-bold mb-3 text-warning">
                        <i class="fas fa-hourglass-start me-2"></i>Fechas de Preventa y Evento
                    </h6>

                    <?php 
                    // Formatear fechas para input datetime-local
                    $presaleStart = !empty($event['presale_start_date']) ? date('Y-m-d\TH:i', strtotime($event['presale_start_date'])) : '';
                    $presaleEnd = !empty($event['presale_end_date']) ? date('Y-m-d\TH:i', strtotime($event['presale_end_date'])) : '';
                    $eventEnd = !empty($event['event_end_date']) ? date('Y-m-d\TH:i', strtotime($event['event_end_date'])) : '';
                    ?>

                    <div class="mb-3">
                        <label for="presale_start_date" class="form-label text-white fw-semibold">
                            Fecha y Hora de Inicio de Preventa
                            <span class="badge bg-secondary bg-opacity-50 ms-1 fw-normal" style="font-size:0.7rem;">Opcional</span>
                        </label>
                        <input type="datetime-local" class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 rounded-3" id="presale_start_date" name="presale_start_date" value="<?= $presaleStart ?>">
                    </div>

                    <div class="mb-3">
                        <label for="presale_end_date" class="form-label text-white fw-semibold">
                            Fecha y Hora Final de Preventa
                            <span class="badge bg-secondary bg-opacity-50 ms-1 fw-normal" style="font-size:0.7rem;">Opcional</span>
                        </label>
                        <input type="datetime-local" class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 rounded-3" id="presale_end_date" name="presale_end_date" value="<?= $presaleEnd ?>">
                        <div class="form-text text-white-50 small">Durante este rango de fechas se aplicará el precio de preventa a todos los kilometrajes.</div>
                    </div>

                    <div class="mb-3">
                        <label for="event_end_date" class="form-label text-white fw-semibold">
                            Fecha Fin del Evento / Carrera
                            <span class="badge bg-secondary bg-opacity-50 ms-1 fw-normal" style="font-size:0.7rem;">Opcional</span>
                        </label>
                        <input type="datetime-local" class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 rounded-3" id="event_end_date" name="event_end_date" value="<?= $eventEnd ?>">
                    </div>
                </div>
            </div>

            <!-- Columna Derecha: Configuración de Costos por Kilometraje -->
            <div class="col-lg-7">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-4" style="background-color: #1e1e1e;">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary border-opacity-25 flex-wrap gap-2">
                        <h4 class="fw-bold mb-0" style="color: #87CC3E;">
                            <i class="fas fa-dollar-sign me-2"></i>Costos por Kilometraje (3K, 5K, 10K y Adicionales)
                        </h4>
                        <button type="button" class="btn btn-sm px-3 py-2 rounded-pill fw-bold text-dark" style="background-color: #87CC3E; border: none;" data-bs-toggle="modal" data-bs-target="#modalAddStage">
                            <i class="fas fa-plus me-1"></i>Nuevo Kilometraje
                        </button>
                    </div>

                    <div class="row g-3">
                        <?php foreach ($stages as $stg): ?>
                            <div class="col-12">
                                <div class="p-3 rounded-4 border border-secondary border-opacity-25 bg-dark position-relative">
                                    <input type="hidden" name="stages[<?= $stg['id'] ?>][id]" value="<?= $stg['id'] ?>">
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge px-3 py-1 rounded-pill" style="background-color: rgba(135, 204, 62, 0.2); color: #87CC3E; font-weight: 700;">
                                                <?= htmlspecialchars($stg['distance']) ?>
                                            </span>
                                            <h6 class="fw-bold mb-0 text-white"><?= htmlspecialchars($stg['name']) ?></h6>
                                        </div>
                                        
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input" type="checkbox" role="switch" name="stages[<?= $stg['id'] ?>][is_active]" value="1" id="active_<?= $stg['id'] ?>" <?= !empty($stg['is_active']) ? 'checked' : '' ?>>
                                                <label class="form-check-label text-white-50 small" for="active_<?= $stg['id'] ?>">Activo</label>
                                            </div>

                                            <button type="button" class="btn btn-outline-danger btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Eliminar Kilometraje" onclick="deleteStage(<?= $stg['id'] ?>, '<?= htmlspecialchars(addslashes($stg['name'])) ?>')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row g-2 mt-2">
                                        <div class="col-md-4">
                                            <label class="form-label text-white-50 small mb-1">Categoría / Modalidad</label>
                                            <select class="form-select form-select-sm bg-secondary bg-opacity-25 text-white border-secondary border-opacity-50" name="stages[<?= $stg['id'] ?>][category_type]">
                                                <option value="mascota" <?= $stg['category_type'] === 'mascota' ? 'selected' : '' ?>>Mascota + Adulto (3K)</option>
                                                <option value="nino" <?= $stg['category_type'] === 'nino' ? 'selected' : '' ?>>Niño + Adulto (3K)</option>
                                                <option value="adulto" <?= $stg['category_type'] === 'adulto' ? 'selected' : '' ?>>Adulto (5K / 10K / General)</option>
                                                <option value="adicional" <?= $stg['category_type'] === 'adicional' ? 'selected' : '' ?>>Adicional Adulto (3K)</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label class="form-label text-warning small mb-1 fw-bold">Precio Preventa (COP) *</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-secondary bg-opacity-25 border-secondary text-white-50">$</span>
                                                <input type="number" step="500" min="0" class="form-control bg-dark text-white border-secondary border-opacity-50 fw-bold text-warning" name="stages[<?= $stg['id'] ?>][presale_price]" value="<?= (float)$stg['presale_price'] ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label text-success small mb-1 fw-bold">Precio Normal (COP) *</label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-secondary bg-opacity-25 border-secondary text-white-50">$</span>
                                                <input type="number" step="500" min="0" class="form-control bg-dark text-white border-secondary border-opacity-50 fw-bold text-success" name="stages[<?= $stg['id'] ?>][price]" value="<?= (float)$stg['price'] ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-2 mt-2">
                                        <div class="col-md-8">
                                            <input type="text" class="form-control form-control-sm bg-dark text-white-50 border-secondary border-opacity-25" name="stages[<?= $stg['id'] ?>][name]" value="<?= htmlspecialchars($stg['name']) ?>" placeholder="Nombre descriptivo de la etapa">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm bg-dark text-white-50 border-secondary border-opacity-25" name="stages[<?= $stg['id'] ?>][distance]" value="<?= htmlspecialchars($stg['distance']) ?>" placeholder="Distancia (ej. 3K, 5K, 10K)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-25 text-end">
                        <button type="submit" class="btn btn-lg px-4 py-2 rounded-pill fw-bold text-dark" style="background-color: #87CC3E; border: none;">
                            <i class="fas fa-save me-2"></i>Guardar Configuración del Evento
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </form>

    <!-- Sección de Usuarios Inscritos al Evento -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm p-4" style="background-color: #1e1e1e;">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-secondary border-opacity-25 flex-wrap gap-2">
                    <h4 class="fw-bold mb-0" style="color: #87CC3E;">
                        <i class="fas fa-users-cog me-2"></i>Usuarios Inscritos al Evento (<?= count($registrations ?? []) ?>)
                    </h4>
                    <div class="d-flex align-items-center gap-3">
                        <a href="/admin/evento/exportar" class="btn btn-sm fw-bold px-3 py-2 rounded-pill d-flex align-items-center gap-2" style="background-color: #87CC3E; border-color: #87CC3E; color: #121212;">
                            <i class="fas fa-file-excel"></i> Descargar Excel
                        </a>
                        <span class="badge px-3 py-2 rounded-pill bg-dark text-white border border-secondary border-opacity-50">
                            <i class="fas fa-running me-1 text-success"></i> Participantes Confirmados
                        </span>
                    </div>
                </div>

                <?php if (empty($registrations)): ?>
                    <div class="text-center py-5 text-white-50">
                        <i class="fas fa-user-slash fs-1 mb-3 opacity-50"></i>
                        <p class="mb-0 fs-5">Aún no hay usuarios inscritos en este evento.</p>
                    </div>
                <?php else: ?>
                    <?php 
                    // Mapeo rápido de etapas por ID
                    $stagesMap = [];
                    foreach ($stages as $s) {
                        $stagesMap[$s['id']] = $s;
                    }
                    ?>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle mb-0" style="background-color: transparent;">
                            <thead>
                                <tr class="text-white-50 border-bottom border-secondary border-opacity-50" style="font-size: 0.85rem; text-transform: uppercase;">
                                    <th>#</th>
                                    <th>Participante</th>
                                    <th>Cédula / Documento</th>
                                    <th>Categoría</th>
                                    <th>Kilometraje / Etapa(s)</th>
                                    <th>Talla Camiseta Adulto</th>
                                    <th>Talla Camiseta Niño</th>
                                    <th>Pago / Orden</th>
                                    <th>Fecha Inscripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($registrations as $idx => $reg): ?>
                                    <?php 
                                    $stgIds = !empty($reg['etapas_seleccionadas']) ? (is_array($reg['etapas_seleccionadas']) ? $reg['etapas_seleccionadas'] : json_decode($reg['etapas_seleccionadas'], true)) : [];
                                    $selectedStageNames = [];
                                    if (is_array($stgIds)) {
                                        foreach ($stgIds as $sid) {
                                            if (isset($stagesMap[$sid])) {
                                                $selectedStageNames[] = $stagesMap[$sid]['name'] . ' (' . $stagesMap[$sid]['distance'] . ')';
                                            }
                                        }
                                    }
                                    ?>
                                    <tr class="border-bottom border-secondary border-opacity-25">
                                        <td class="text-white-50 fw-bold"><?= $idx + 1 ?></td>
                                        <td>
                                            <div class="fw-bold text-white"><?= htmlspecialchars($reg['nombres'] . ' ' . $reg['apellidos']) ?></div>
                                            <small class="text-white-50"><i class="fas fa-envelope me-1"></i><?= htmlspecialchars($reg['email'] ?? '') ?></small>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary bg-opacity-50 text-white me-1"><?= htmlspecialchars($reg['tipo_documento'] ?? 'CC') ?></span>
                                            <span class="fw-bold text-white"><?= htmlspecialchars($reg['numero_documento'] ?? '') ?></span>
                                        </td>
                                        <td>
                                            <?php if (($reg['categoria_participante'] ?? '') === 'mascota'): ?>
                                                <span class="badge bg-warning text-dark fw-bold px-2 py-1 rounded-pill"><i class="fas fa-dog me-1"></i>Pet Run</span>
                                                <?php if (!empty($reg['nombre_mascota'])): ?>
                                                    <div class="small text-warning mt-1"><i class="fas fa-paw me-1"></i><?= htmlspecialchars($reg['nombre_mascota']) ?></div>
                                                <?php endif; ?>
                                            <?php elseif (($reg['categoria_participante'] ?? '') === 'nino'): ?>
                                                <span class="badge bg-primary text-white fw-bold px-2 py-1 rounded-pill"><i class="fas fa-child me-1"></i>Infantil</span>
                                                <?php if (!empty($reg['acudiente_nombre'])): ?>
                                                    <div class="small text-white-50 mt-1">Acudiente: <?= htmlspecialchars($reg['acudiente_nombre']) ?></div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="badge bg-success text-dark fw-bold px-2 py-1 rounded-pill"><i class="fas fa-user me-1"></i>Adulto</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($selectedStageNames)): ?>
                                                <?php foreach ($selectedStageNames as $stgName): ?>
                                                    <span class="badge bg-dark border border-success text-success d-inline-block mb-1"><?= htmlspecialchars($stgName) ?></span>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <span class="text-white-50 small">Sin etapa asignada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($reg['talla_camiseta_adulto'])): ?>
                                                <span class="badge px-3 py-2 rounded-pill fw-bold text-dark" style="background-color: #87CC3E;">
                                                    <i class="fas fa-tshirt me-1"></i><?= htmlspecialchars($reg['talla_camiseta_adulto']) ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-white-50 small">N/A</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($reg['talla_camiseta_nino'])): ?>
                                                <span class="badge px-3 py-2 rounded-pill fw-bold bg-info text-dark">
                                                    <i class="fas fa-tshirt me-1"></i><?= htmlspecialchars($reg['talla_camiseta_nino']) ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-white-50 small">N/A</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (($reg['payment_status'] ?? 'pending') === 'paid'): ?>
                                                <span class="badge bg-success text-dark fw-bold" style="font-size: 0.75rem;"><i class="fas fa-check-circle me-1"></i>PAGADO</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark fw-bold" style="font-size: 0.75rem;"><i class="fas fa-clock me-1"></i>PENDIENTE</span>
                                            <?php endif; ?>
                                            <?php if (!empty($reg['order_number'])): ?>
                                                <div class="small text-white-50 mt-1" style="font-size: 0.7rem; font-family: monospace;"><?= htmlspecialchars($reg['order_number']) ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-white-50 small">
                                            <?= !empty($reg['created_at']) ? date('d/m/Y g:i A', strtotime($reg['created_at'])) : '' ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<!-- Modal para Crear Nuevo Kilometraje -->
<div class="modal fade" id="modalAddStage" tabindex="-1" aria-labelledby="modalAddStageLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-white rounded-4 border-0 shadow-lg" style="background-color: #1e1e1e;">
            <div class="modal-header border-bottom border-secondary border-opacity-25">
                <h5 class="modal-header-title fw-bold mb-0" id="modalAddStageLabel" style="color: #87CC3E;">
                    <i class="fas fa-plus-circle me-2"></i>Agregar Nuevo Kilometraje
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/evento/kilometraje/guardar" method="POST">
                <input type="hidden" name="event_id" value="<?= htmlspecialchars($event['id'] ?? 1) ?>">
                
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="new_stage_name" class="form-label fw-semibold">Nombre del Kilometraje / Etapa *</label>
                        <input type="text" class="form-control bg-dark text-white border-secondary py-2 rounded-3" id="new_stage_name" name="name" placeholder="ej. 15K Desafío Ciudad" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="new_stage_distance" class="form-label fw-semibold">Distancia *</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary py-2 rounded-3" id="new_stage_distance" name="distance" placeholder="ej. 3K, 5K, 10K, 15K, 21K" required>
                        </div>
                        <div class="col-md-6">
                            <label for="new_stage_category" class="form-label fw-semibold">Categoría / Modalidad *</label>
                            <select class="form-select bg-dark text-white border-secondary py-2 rounded-3" id="new_stage_category" name="category_type" required>
                                <option value="adulto">Adulto (General / 5K / 10K)</option>
                                <option value="mascota">Mascota + Adulto (3K)</option>
                                <option value="nino">Niño + Adulto (3K)</option>
                                <option value="adicional">Adicional Adulto (3K)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="new_stage_presale" class="form-label text-warning fw-semibold">Precio Preventa (COP) *</label>
                            <input type="number" step="500" min="0" class="form-control bg-dark text-warning fw-bold border-secondary py-2 rounded-3" id="new_stage_presale" name="presale_price" placeholder="45000" required>
                        </div>
                        <div class="col-md-6">
                            <label for="new_stage_price" class="form-label text-success fw-semibold">Precio Normal (COP) *</label>
                            <input type="number" step="500" min="0" class="form-control bg-dark text-success fw-bold border-secondary py-2 rounded-3" id="new_stage_price" name="price" placeholder="55000" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="new_stage_desc" class="form-label fw-semibold">Descripción Opcional</label>
                        <textarea class="form-control bg-dark text-white border-secondary rounded-3" id="new_stage_desc" name="description" rows="2" placeholder="Detalles o requerimientos de este kilometraje"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top border-secondary border-opacity-25">
                    <button type="button" class="btn btn-secondary rounded-pill px-3" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn fw-bold text-dark rounded-pill px-4" style="background-color: #87CC3E; border: none;">
                        <i class="fas fa-plus me-1"></i>Crear Kilometraje
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Form Oculto para Eliminar Kilometraje -->
<form id="deleteStageForm" action="/admin/evento/kilometraje/eliminar" method="POST" class="d-none">
    <input type="hidden" name="stage_id" id="delete_stage_id" value="">
</form>

<script>
function deleteStage(id, name) {
    if (confirm('¿Estás seguro de que deseas eliminar el kilometraje "' + name + '"?')) {
        document.getElementById('delete_stage_id').value = id;
        document.getElementById('deleteStageForm').submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const stageInputs = document.querySelectorAll('input[name^="stage_slots["], input[name^="stage_presale_slots["]');
    const totalSlotsInput = document.getElementById('total_slots');
    
    function recalculateTotalSlots() {
        let total = 0;
        stageInputs.forEach(input => {
            const val = parseInt(input.value) || 0;
            total += val;
        });
        if (totalSlotsInput) {
            totalSlotsInput.value = total;
        }
    }
    
    stageInputs.forEach(input => {
        input.addEventListener('input', recalculateTotalSlots);
        input.addEventListener('change', recalculateTotalSlots);
    });
    
    recalculateTotalSlots();
});
</script>

<style>
.style-admin-bg input:focus, .style-admin-bg select:focus {
    border-color: #87CC3E !important;
    box-shadow: 0 0 0 0.25rem rgba(135, 204, 62, 0.25) !important;
}
</style>

</div><!-- /container-fluid style-admin-bg -->
</div><!-- /page-content -->

<?php include __DIR__ . '/../layouts/footer.php'; ?>
