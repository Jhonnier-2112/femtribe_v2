<?php
$title = "Términos y Condiciones | FEMTRIBE";
require __DIR__ . '/../layouts/header.php';
?>

<div class="container py-5" style="margin-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5">
                <div class="border-bottom pb-4 mb-4">
                    <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-2 rounded-pill mb-2" style="color: #87CC3E !important; background-color: rgba(135, 204, 62, 0.15) !important;">Marco Legal y Reglamentario</span>
                    <h1 class="fw-bold text-dark display-6 mb-2">Términos y Condiciones de Uso y Participación</h1>
                    <p class="text-muted small mb-0">Última actualización: <?= date('d/m/Y') ?> | Comunidad Deportiva FEMTRIBE</p>
                </div>

                <div class="legal-content lh-lg text-secondary" style="font-size: 0.98rem;">
                    <h4 class="fw-bold text-dark mt-4 mb-3">1. Aceptación de Términos</h4>
                    <p>
                        Al registrarse, inscribirse en eventos o hacer uso del portal web y servicios de <strong>FEMTRIBE</strong>, el usuario declara haber leído, comprendido y aceptado la totalidad de los presentes Términos y Condiciones. Si no está de acuerdo con alguna disposición, deberá abstenerse de utilizar la plataforma e inscribirse en nuestras actividades deportivas.
                    </p>

                    <h4 class="fw-bold text-dark mt-4 mb-3">2. Objeto del Sitio y Eventos Deportivo</h4>
                    <p>
                        FEMTRIBE es una plataforma dedicada a promover el atletismo, hábitos de vida saludable y la organización de eventos deportivos de carrera en ruta y pista. Toda inscripción efectuada a través de nuestra web es personal e transferible únicamente bajo las condiciones expresadas en el reglamento específico de cada carrera.
                    </p>

                    <h4 class="fw-bold text-dark mt-4 mb-3">3. Condiciones de Inscripción y Pagos</h4>
                    <ul class="ps-3">
                        <li>Las tarifas de inscripción a las carreras están expresadas en Pesos Colombianos (COP) e incluyen el kit oficial según la etapa seleccionada.</li>
                        <li>Los pagos son procesados de forma segura mediante la pasarela certificada de <strong>Wompi / Bancolombia</strong>. FEMTRIBE no almacena datos de tarjetas de crédito o credenciales bancarias.</li>
                        <li>Una vez confirmado el pago y asignada la orden de inscripción, no se realizarán reembolsos en dinero, salvo en casos extraordinarios decretados expresamente por la organización o fuerza mayor debidamente soportada.</li>
                    </ul>

                    <h4 class="fw-bold text-dark mt-4 mb-3">4. Requisitos de Salud y Aptitud Física</h4>
                    <p>
                        Es responsabilidad exclusiva de cada participante contar con la aptitud médica necesaria para la práctica de actividad física de mediana y alta exigencia. Al inscribirse, el atleta declara bajo gravedad de juramento que no posee contraindicaciones médicas o estado de salud que pongan en peligro su integridad física.
                    </p>

                    <h4 class="fw-bold text-dark mt-4 mb-3">5. Entrega de Kits y Dorsales</h4>
                    <p>
                        La entrega de kits de competencia se realizará en los lugares y horarios previamente publicados por la organización. Es requisito indispensable presentar documento de identidad original y el comprobante o referencia de orden de compra enviada al correo electrónico registrado.
                    </p>

                    <h4 class="fw-bold text-dark mt-4 mb-3">6. Modificaciones al Evento o Reglamento</h4>
                    <p>
                        La organización se reserva el derecho de modificar rutas, horarios o fechas por motivos de seguridad, condiciones meteorológicas adversas o instrucciones gubernamentales, garantizando en todo caso la seguridad de las corredoras y asistentes.
                    </p>
                </div>

                <div class="border-top pt-4 mt-5 d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-arrow-left me-2"></i>Volver
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
