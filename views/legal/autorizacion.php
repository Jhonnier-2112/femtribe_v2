<?php
$title = "Exoneración de Responsabilidad y Autorización de Salud | FEMTRIBE";
require __DIR__ . '/../layouts/header.php';
?>

<div class="container py-5" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5">
                <div class="border-bottom pb-4 mb-4">
                    <span class="badge bg-warning bg-opacity-20 text-dark fw-bold px-3 py-2 rounded-pill mb-2">Declaración Juramentada y Exoneración</span>
                    <h1 class="fw-bold text-dark display-6 mb-2">Autorización de Salud y Exoneración de Responsabilidad</h1>
                    <p class="text-muted small mb-0">Carrera Corre Con FEMTRIBE | Reglamento Oficial de Seguridad</p>
                </div>

                <div class="legal-content lh-lg text-secondary" style="font-size: 0.98rem;">
                    <div class="alert alert-light border border-secondary border-opacity-25 rounded-4 p-4 mb-4">
                        <h5 class="fw-bold text-dark mb-2"><i class="fas fa-shield-alt text-success me-2"></i>Declaración de Salud y Aptitud Física</h5>
                        <p class="mb-0">
                            Manifiesto bajo juramento que me encuentro en aptas condiciones de salud física y mental para participar en la Carrera Corre Con FEMTRIBE. Declaro que no padezco enfermedades cardiovasculares, respiratorias, metabólicas, neurológicas o musculares no controladas que puedan poner en riesgo mi vida o integridad física durante el desarrollo de la prueba.
                        </p>
                    </div>

                    <h4 class="fw-bold text-dark mt-4 mb-3">1. Asunción Voluntaria de Riesgos</h4>
                    <p>
                        Reconozco que la participación en carreras de atletismo de calle involucra esfuerzo físico intenso y riesgos inherentes (caídas, deshidratación, fatiga extrema o imprevistos climáticos). Declaro que asumo de manera libre, consciente y voluntaria todos los riesgos derivados de mi participación en el evento.
                    </p>

                    <h4 class="fw-bold text-dark mt-4 mb-3">2. Exoneración de Responsabilidad</h4>
                    <p>
                        Exonero expresamente a la organización <strong>FEMTRIBE</strong>, directivos, juzgamiento, patrocinadores, entidades gubernamentales y aliados logísticos de cualquier reclamación, demanda o responsabilidad civil, penal o administrativa resultante de accidentes, lesiones físicas o imprevistos personales surgidos durante el desarrollo de la carrera.
                    </p>

                    <h4 class="fw-bold text-dark mt-4 mb-3">3. Compromisos del Participante</h4>
                    <ul class="ps-3">
                        <li>Portar el dorsal visible en el pecho en todo momento durante el recorrido.</li>
                        <li>Acatar las instrucciones del personal logístico, cuerpo médico y jueces oficiales de la competencia.</li>
                        <li>Respetar a los demás atletas, público asistente y normativas viales establecidas.</li>
                        <li>Autorizar la atención médica de primeros auxilios y traslado a centros asistenciales en caso de requerirse durante el evento.</li>
                    </ul>

                    <h4 class="fw-bold text-dark mt-4 mb-3">4. Autorización para Uso de Datos e Imagen</h4>
                    <p>
                        Autorizo el tratamiento de mis datos de contacto y de salud exclusivamente para fines de logística deportiva y atención de emergencias, así como el uso de mi imagen en fotografías y tomas audiovisuales del evento.
                    </p>
                </div>

                <div class="border-top pt-4 mt-5 d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-arrow-left me-2"></i>Volver al Formulario
                    </a>
                    <button onclick="window.print()" class="btn btn-dark rounded-pill px-4">
                        <i class="fas fa-print me-2"></i>Imprimir Documento
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
