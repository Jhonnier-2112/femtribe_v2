<?php

namespace App\Services;

require_once __DIR__ . '/../config/EmailConfig.php';

// Cargar autoloader de vendor si es necesario
if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    $vendorPath = realpath(__DIR__ . '/../../frontend/vendor/autoload.php');
    if ($vendorPath && file_exists($vendorPath)) {
        require_once $vendorPath;
    }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    private $mailer;
    
    public function __construct() {
        $this->mailer = new PHPMailer(true);
        $this->setupMailer();
    }
    
    private function setupMailer() {
        try {
            $host = getenv('MAIL_HOST') ?: \EmailConfig::SMTP_HOST;
            $port = (int)(getenv('MAIL_PORT') ?: \EmailConfig::SMTP_PORT);
            $user = \EmailConfig::getUsername();
            $pass = \EmailConfig::getPassword();
            $enc  = strtolower(getenv('MAIL_ENCRYPTION') ?: \EmailConfig::SMTP_SECURE);

            $this->mailer->isSMTP();
            $this->mailer->Host = $host;
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $user;
            $this->mailer->Password = $pass;

            if ($enc === 'ssl' || $port === 465) {
                $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else {
                $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }
            $this->mailer->Port = $port;
            $this->mailer->CharSet = 'UTF-8';

            $fromName = getenv('MAIL_FROM_NAME') ?: 'FEMTRIBE';
            $this->mailer->setFrom($user, $fromName);

        } catch (Exception $e) {
            error_log("Error en setupMailer: " . $e->getMessage());
            throw $e;
        }
    }
    
    public function sendWelcomeEmail($participantData) {
        try {
            // Limpiar destinatarios anteriores
            $this->mailer->clearAddresses();
            $this->mailer->clearAttachments();
            $this->mailer->clearCustomHeaders();
            
            // Configurar destinatario
            $nombreDestinatario = trim(($participantData['nombres'] ?? '') . ' ' . ($participantData['apellidos'] ?? ''));
            $this->mailer->addAddress($participantData['email'], $nombreDestinatario ?: $participantData['email']);
            
            // Configurar remitente oficial
            $this->mailer->setFrom(\EmailConfig::getUsername(), \EmailConfig::getFromName());
            $this->mailer->addReplyTo('femtribe25@gmail.com', 'FEMTRIBE Soporte');
            
            // Configurar el correo con asunto dinámico
            $orderNum = !empty($participantData['order_number']) ? ' #' . $participantData['order_number'] : '';
            $this->mailer->isHTML(true);
            $this->mailer->Subject = '🎉 ¡Inscripción y Pago Confirmados!' . $orderNum . ' - Corre con FEMTRIBE';
            
            // Embeber la imagen del logo
            $logoPaths = [
                __DIR__ . '/../../img/logocorreo.png',
                __DIR__ . '/../../assets/img/logocorreo.png',
                __DIR__ . '/../../pruebas/img/logocorreo.png',
                __DIR__ . '/../../assets/img/logocarrera.png',
                __DIR__ . '/../../assets/img/logoverde.png',
            ];
            foreach ($logoPaths as $lPath) {
                if (file_exists($lPath)) {
                    $this->mailer->addEmbeddedImage($lPath, 'femtribe_logo', 'logocorreo.png', 'base64', 'image/png');
                    break;
                }
            }
            
            // Generar el cuerpo del correo
            $this->mailer->Body = $this->generateWelcomeEmailTemplate($participantData);
            
            // Enviar el correo
            $result = $this->mailer->send();
            error_log("Email enviado a " . $participantData['email'] . ": " . ($result ? "ÉXITO" : "FALLÓ"));
            return $result;
        } catch (Exception $e) {
            error_log("Error al enviar email a " . $participantData['email'] . ": " . $e->getMessage());
            throw $e; // Lanzar la excepción para que se capture en el controlador
        }
    }

    public function sendPasswordResetEmail(array $user, string $resetUrl) {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->clearAttachments();
            $this->mailer->clearCustomHeaders();

            $nombre = trim(($user['nombres'] ?? '') . ' ' . ($user['apellidos'] ?? ''));
            $this->mailer->addAddress($user['email'], $nombre ?: $user['email']);

            $this->mailer->setFrom(\EmailConfig::getUsername(), \EmailConfig::getFromName());
            $this->mailer->addReplyTo(\EmailConfig::getUsername(), \EmailConfig::getFromName());

            $this->mailer->isHTML(true);
            $this->mailer->Subject = '🔒 Restauración de Contraseña - FEMTRIBE';

            $logoPath = __DIR__ . '/../../img/logocorreo.png';
            if (file_exists($logoPath)) {
                $this->mailer->addEmbeddedImage($logoPath, 'femtribe_logo', 'logocorreo.png', 'base64', 'image/png');
            }

            $this->mailer->Body = $this->generatePasswordResetTemplate($user, $resetUrl);

            $result = $this->mailer->send();
            error_log("Email de restauración enviado a " . $user['email'] . ": " . ($result ? "ÉXITO" : "FALLÓ"));
            return $result;
        } catch (Exception $e) {
            error_log("Error al enviar email de restauración a " . $user['email'] . ": " . $e->getMessage());
            throw $e;
        }
    }

    private function generatePasswordResetTemplate(array $user, string $resetUrl) {
        $nombre = htmlspecialchars(trim(($user['nombres'] ?? '') . ' ' . ($user['apellidos'] ?? '')));
        $resetUrlEsc = htmlspecialchars($resetUrl);

        return '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restauración de Contraseña</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; background-color: #f8f9fa; }
        .container { background-color: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08); margin: 20px; }
        .header { background-color: #2c2c2c; padding: 30px 20px; text-align: center; color: white; border-bottom: 4px solid #6da632; }
        .content { padding: 30px 25px; }
        .btn-reset { display: inline-block; background-color: #6da632; color: #ffffff !important; text-decoration: none; padding: 14px 28px; font-weight: bold; border-radius: 8px; margin: 20px 0; text-transform: uppercase; font-size: 14px; }
        .footer { background-color: #f1f3f5; padding: 20px; text-align: center; font-size: 12px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="margin:0; font-size: 22px;">🔑 Restauración de Contraseña</h2>
            <p style="margin: 5px 0 0 0; opacity: 0.8; font-size: 14px;">Comunidad FEMTRIBE</p>
        </div>
        <div class="content">
            <p>Hola <strong>' . ($nombre ?: 'Corredor') . '</strong>,</p>
            <p>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta en <strong>FEMTRIBE</strong>.</p>
            <p>Haz clic en el siguiente botón para crear tu nueva contraseña. Este enlace es válido únicamente durante <strong>1 hora</strong> por razones de seguridad:</p>
            <div style="text-align: center;">
                <a href="' . $resetUrlEsc . '" class="btn-reset">Restablecer mi Contraseña</a>
            </div>
            <p style="font-size: 13px; color: #6c757d;">Si no puedes hacer clic en el botón, copia y pega el siguiente enlace en tu navegador web:</p>
            <p style="font-size: 12px; word-break: break-all; color: #6da632;">' . $resetUrlEsc . '</p>
            <hr style="border: none; border-top: 1px solid #eee; margin: 25px 0;">
            <p style="font-size: 12px; color: #888;">Si no solicitaste este cambio, puedes ignorar este correo de forma segura. Tu contraseña actual seguirá siendo la misma.</p>
        </div>
        <div class="footer">
            <p style="margin:0;">&copy; ' . date('Y') . ' FEMTRIBE. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>';
    }

    private function generateWelcomeEmailTemplate($participantData) {
        $nombre = htmlspecialchars(trim(($participantData['nombres'] ?? $participantData['first_name'] ?? '') . ' ' . ($participantData['apellidos'] ?? $participantData['last_name'] ?? '')));
        $documento = htmlspecialchars($participantData['numero_documento'] ?? $participantData['document_number'] ?? '');
        $tipoDoc = $this->getTipoDocumentoText($participantData['tipo_documento'] ?? $participantData['document_type'] ?? '');
        $email = htmlspecialchars($participantData['email'] ?? '');
        $telefono = htmlspecialchars($participantData['telefono'] ?? $participantData['phone'] ?? '');
        $orderNumber = htmlspecialchars($participantData['order_number'] ?? 'N/A');
        
        $monto = (float)($participantData['payment_amount'] ?? 0);
        $montoFormatted = '$' . number_format($monto, 0, ',', '.') . ' COP';
        
        // Categoría y Talla
        $categoria = htmlspecialchars(ucfirst($participantData['categoria_participante'] ?? $participantData['category'] ?? 'Adulto'));
        $talla = htmlspecialchars(!empty($participantData['talla_camiseta_adulto']) ? $participantData['talla_camiseta_adulto'] : (!empty($participantData['talla_camiseta_nino']) ? $participantData['talla_camiseta_nino'] : ($participantData['t_shirt_size'] ?? 'Por confirmar')));
        
        // Ciudad / Municipio
        $ubicacion = htmlspecialchars(trim(($participantData['municipio'] ?? $participantData['city'] ?? '') . (!empty($participantData['departamento'] ?? $participantData['department']) ? ', ' . ($participantData['departamento'] ?? $participantData['department']) : '')));
        
        // Datos médicos
        $eps = htmlspecialchars($participantData['eps'] ?? 'N/A');
        $sangre = htmlspecialchars(trim(($participantData['grupo_sanguineo'] ?? $participantData['blood_group'] ?? '') . ' ' . ($participantData['rh'] ?? '')));
        
        // Contacto de emergencia
        $emergenciaNombre = htmlspecialchars($participantData['nombre_emergencia'] ?? $participantData['emergency_contact_name'] ?? 'N/A');
        $emergenciaTel = htmlspecialchars($participantData['celular_emergencia'] ?? $participantData['emergency_contact_phone'] ?? 'N/A');
        $emergenciaParentesco = htmlspecialchars($participantData['parentesco_emergencia'] ?? $participantData['emergency_contact_relationship'] ?? '');
        
        // Resolver nombres de etapas seleccionadas
        $stageNames = [];
        if (!empty($participantData['etapas_seleccionadas'])) {
            $sel = $participantData['etapas_seleccionadas'];
            $stageIds = is_array($sel) ? $sel : (json_decode($sel, true) ?: [$sel]);
            if (class_exists('App\Models\Event')) {
                try {
                    $allStages = \App\Models\Event::getStages(1);
                    $stageMap = [];
                    foreach ($allStages as $s) {
                        $stageMap[(int)$s['id']] = $s['name'] . ' (' . $s['distance'] . ')';
                    }
                    foreach ($stageIds as $sid) {
                        if (isset($stageMap[(int)$sid])) {
                            $stageNames[] = $stageMap[(int)$sid];
                        }
                    }
                } catch (\Exception $e) {}
            }
        }
        if (empty($stageNames)) {
            $stageNames[] = 'Carrera Corre con FEMTRIBE';
        }

        $stagesHtml = '';
        foreach ($stageNames as $stgName) {
            $stagesHtml .= '<li style="margin-bottom: 5px; color: #1a1a1a; font-weight: 600;">🏃 ' . htmlspecialchars($stgName) . '</li>';
        }

        // Datos opcionales: Mascota / Acudiente
        $extraInfoHtml = '';
        if (!empty($participantData['nombre_mascota'])) {
            $extraInfoHtml .= '<tr><td style="padding: 6px 0; color: #666; font-size: 13px;">🐾 Mascota:</td><td style="padding: 6px 0; font-weight: 600; color: #111; font-size: 13px;">' . htmlspecialchars($participantData['nombre_mascota']) . ' (' . htmlspecialchars($participantData['raza_mascota'] ?? 'Criollo') . ')</td></tr>';
        }
        if (!empty($participantData['acudiente_nombre'])) {
            $extraInfoHtml .= '<tr><td style="padding: 6px 0; color: #666; font-size: 13px;">👤 Acudiente:</td><td style="padding: 6px 0; font-weight: 600; color: #111; font-size: 13px;">' . htmlspecialchars($participantData['acudiente_nombre']) . ' (Doc: ' . htmlspecialchars($participantData['acudiente_documento'] ?? '') . ')</td></tr>';
        }

        $fechaRegistro = !empty($participantData['created_at']) ? date('d/m/Y h:i A', strtotime($participantData['created_at'])) : date('d/m/Y h:i A');

        return '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción y Pago Confirmados - FEMTRIBE</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #222; max-width: 620px; margin: 0 auto; background-color: #f4f6f8; }
        .wrapper { background-color: #ffffff; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin: 20px 10px; }
        .header { background-color: #1a1a1a; padding: 28px 20px; text-align: center; color: white; border-bottom: 4px solid #6da632; }
        .header-logo { max-width: 130px; height: auto; margin-bottom: 10px; }
        .header h1 { font-size: 22px; margin: 8px 0 4px 0; color: #ffffff; font-weight: 800; letter-spacing: 0.5px; }
        .header p { font-size: 14px; margin: 0; color: #b2d81f; font-weight: 600; }
        .content { padding: 26px 22px; }
        .status-badge { display: inline-block; background-color: #eaf7e3; color: #2e7d32; border: 1px solid #a3d98c; padding: 6px 16px; border-radius: 20px; font-weight: 800; font-size: 12px; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 16px; }
        .card { background-color: #fbfbfb; border: 1px solid #eaeaea; border-radius: 10px; padding: 16px 18px; margin-bottom: 18px; }
        .card-title { font-size: 14px; font-weight: 800; color: #1a1a1a; text-transform: uppercase; letter-spacing: 0.8px; margin: 0 0 12px 0; padding-bottom: 6px; border-bottom: 2px solid #6da632; }
        .table-info { width: 100%; border-collapse: collapse; }
        .table-info td { padding: 5px 0; font-size: 13px; vertical-align: top; }
        .td-label { color: #666666; width: 42%; }
        .td-val { color: #111111; font-weight: 600; width: 58%; }
        .support-box { background: linear-gradient(135deg, #f3f9ec 0%, #eaf5e1 100%); border: 1.5px solid #a8dc80; border-radius: 10px; padding: 18px 20px; text-align: center; margin-top: 24px; }
        .support-box h4 { margin: 0 0 6px 0; color: #2e7d32; font-size: 15px; font-weight: 800; }
        .support-box p { margin: 0 0 12px 0; font-size: 13px; color: #333333; }
        .btn-support { display: inline-block; background-color: #6da632; color: #ffffff !important; text-decoration: none; padding: 10px 22px; font-weight: 700; border-radius: 25px; font-size: 13px; box-shadow: 0 2px 6px rgba(109,166,50,0.3); }
        .footer { background-color: #1a1a1a; color: #888888; text-align: center; padding: 18px 20px; font-size: 11px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Encabezado con logo -->
        <div class="header">
            <img src="cid:femtribe_logo" alt="FEMTRIBE" class="header-logo" onerror="this.style.display=\'none\';">
            <h1>¡Inscripción y Pago Confirmados!</h1>
            <p>¡Bienvenida(o) a la tribu! Tu lugar en la carrera está asegurado.</p>
        </div>

        <div class="content">
            <div style="text-align: center;">
                <span class="status-badge">✓ PAGO APROBADO &bull; INSCRIPCIÓN ACTIVA</span>
            </div>

            <p style="font-size: 15px; margin-bottom: 20px;">
                Hola <strong>' . $nombre . '</strong>, tu pago ha sido procesado exitosamente a través de la pasarela segura. Ya estás oficialmente inscrita(o) en <strong>Corre con FEMTRIBE</strong>. A continuación encuentras el comprobante completo de tu orden:
            </p>

            <!-- Resumen de Pago -->
            <div class="card" style="border-left: 4px solid #6da632;">
                <h3 class="card-title">💳 Resumen de la Transacción</h3>
                <table class="table-info">
                    <tr><td class="td-label">Número de Orden:</td><td class="td-val" style="color: #6da632; font-size: 14px;">#' . $orderNumber . '</td></tr>
                    <tr><td class="td-label">Monto Total Pagado:</td><td class="td-val" style="font-size: 15px; color: #2e7d32;">' . $montoFormatted . '</td></tr>
                    <tr><td class="td-label">Estado del Pago:</td><td class="td-val"><span style="color: #2e7d32; font-weight: 700;">Aprobado / Pagado</span></td></tr>
                    <tr><td class="td-label">Método:</td><td class="td-val">Bancolombia / Wompi</td></tr>
                    <tr><td class="td-label">Fecha y Hora:</td><td class="td-val">' . $fechaRegistro . '</td></tr>
                </table>
            </div>

            <!-- Detalle de la Carrera -->
            <div class="card">
                <h3 class="card-title">🏃‍♀️ Etapas y Modalidad</h3>
                <ul style="margin: 0 0 12px 18px; padding: 0;">
                    ' . $stagesHtml . '
                </ul>
                <table class="table-info">
                    <tr><td class="td-label">Categoría:</td><td class="td-val">' . $categoria . '</td></tr>
                    <tr><td class="td-label">Talla de Camiseta:</td><td class="td-val">' . $talla . '</td></tr>
                    ' . $extraInfoHtml . '
                </table>
            </div>

            <!-- Datos del Participante -->
            <div class="card">
                <h3 class="card-title">📋 Datos del Participante</h3>
                <table class="table-info">
                    <tr><td class="td-label">Nombre Completo:</td><td class="td-val">' . $nombre . '</td></tr>
                    <tr><td class="td-label">Documento:</td><td class="td-val">' . $tipoDoc . ': ' . $documento . '</td></tr>
                    <tr><td class="td-label">Correo Electrónico:</td><td class="td-val">' . $email . '</td></tr>
                    <tr><td class="td-label">Teléfono / Celular:</td><td class="td-val">' . $telefono . '</td></tr>
                    ' . (!empty($ubicacion) ? '<tr><td class="td-label">Ciudad / Dpto:</td><td class="td-val">' . $ubicacion . '</td></tr>' : '') . '
                    <tr><td class="td-label">EPS:</td><td class="td-val">' . $eps . '</td></tr>
                    <tr><td class="td-label">Grupo Sanguíneo:</td><td class="td-val">' . ($sangre ?: 'N/A') . '</td></tr>
                    ' . (!empty($emergenciaNombre) && $emergenciaNombre !== 'N/A' ? '<tr><td class="td-label">Contacto Emergencia:</td><td class="td-val">' . $emergenciaNombre . ' (' . $emergenciaTel . ') ' . ($emergenciaParentesco ? '- ' . $emergenciaParentesco : '') . '</td></tr>' : '') . '
                </table>
            </div>

            <!-- Información Importante -->
            <div class="card" style="background-color: #f5f5f5;">
                <h3 class="card-title" style="border-bottom-color: #333;">📦 Entrega de Kits</h3>
                <p style="font-size: 13px; color: #444; margin: 0 0 8px 0;">
                    Para reclamar tu kit oficial y dorsal de carrera, deberás presentar tu <strong>documento de identidad original</strong> o este comprobante con el número de orden <strong>#' . $orderNumber . '</strong>.
                </p>
                <p style="font-size: 12px; color: #666; margin: 0;">
                    Las fechas exactas, lugar y horarios de entrega de kits serán publicados en nuestra plataforma web y redes oficiales.
                </p>
            </div>

            <!-- Bloque de Soporte y Dudas (femtribe25@gmail.com) -->
            <div class="support-box">
                <h4>💬 ¿Tienes alguna duda o inquietud?</h4>
                <p>
                    Si necesitas actualizar algún dato o requieres soporte con tu inscripción, comunícate directamente con nuestro equipo al correo oficial:
                </p>
                <p style="font-size: 15px; font-weight: 800; color: #1a1a1a; margin-bottom: 12px;">
                    ✉️ <a href="mailto:femtribe25@gmail.com?subject=Inquietud%20Inscripcion%20FEMTRIBE%20Orden%20' . urlencode($orderNumber) . '" style="color: #2e7d32; text-decoration: underline;">femtribe25@gmail.com</a>
                </p>
                <a href="mailto:femtribe25@gmail.com?subject=Inquietud%20Inscripcion%20FEMTRIBE%20Orden%20' . urlencode($orderNumber) . '" class="btn-support">
                    Contactar a Soporte
                </a>
            </div>
        </div>

        <div class="footer">
            <p style="margin: 0 0 4px 0;">&copy; ' . date('Y') . ' FEMTRIBE. Todos los derechos reservados.</p>
            <p style="margin: 0; opacity: 0.7;">Cuerpo fuerte, mente libre, alma en tribu.</p>
        </div>
    </div>
</body>
</html>';
    }
    
    private function getTipoDocumentoText($tipo) {
        $t = strtolower(trim((string)$tipo));
        switch($t) {
            case 'cc':
            case 'cedula_ciudadania':
                return 'Cédula de ciudadanía';
            case 'ti':
            case 'tarjeta_identidad':
                return 'Tarjeta de identidad';
            case 'ce':
            case 'cedula_extranjeria':
                return 'Cédula de extranjería';
            case 'pasaporte':
                return 'Pasaporte';
            case 'rc':
            case 'registro_civil':
                return 'Registro civil';
            default:
                return !empty($tipo) ? ucfirst($tipo) : 'Documento';
        }
    }

    public function sendContactLeadEmail(array $data): bool {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->clearAttachments();
            $this->mailer->clearCustomHeaders();
            $this->mailer->clearReplyTos();

            // Destinatario: MAIL_FROM_ADDRESS desde .env
            $toEmail = getenv('MAIL_FROM_ADDRESS') ?: (\EmailConfig::getUsername() ?: 'femtribe25@gmail.com');
            $toName  = getenv('MAIL_FROM_NAME') ?: 'FEMTRIBE';
            $this->mailer->addAddress($toEmail, $toName);

            // Remitente SMTP
            $fromEmail = \EmailConfig::getUsername();
            $fromName  = getenv('MAIL_FROM_NAME') ?: 'FEMTRIBE Web';
            $this->mailer->setFrom($fromEmail, $fromName);

            // Reply-to al correo del remitente del formulario
            $senderEmail = trim($data['email'] ?? '');
            $senderName  = trim($data['nombre'] ?? '');
            if (!empty($senderEmail)) {
                $this->mailer->addReplyTo($senderEmail, $senderName ?: $senderEmail);
            }

            $this->mailer->isHTML(true);
            $this->mailer->Subject = '📩 Nuevo contacto web: ' . ($senderName ?: 'Interesado') . ' - ' . ($data['origen'] ?? '¿ESTÁS LISTO?');

            $nombreEsc  = htmlspecialchars($senderName);
            $emailEsc   = htmlspecialchars($senderEmail);
            $mensajeEsc = nl2br(htmlspecialchars(trim($data['mensaje'] ?? '')));
            $origenEsc  = htmlspecialchars($data['origen'] ?? 'Sección ¿ESTÁS LISTO? (Web)');
            $fecha      = date('d/m/Y h:i A');

            $body = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Mensaje de Contacto</title>
    <style>
        body { font-family: "Montserrat", Arial, sans-serif; background-color: #f4f4f7; margin: 0; padding: 20px; color: #222; }
        .card { background-color: #ffffff; max-width: 600px; margin: 0 auto; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border-top: 5px solid #B2D81F; }
        .header { background-color: #003A77; color: #ffffff; padding: 25px 20px; text-align: center; }
        .header h2 { margin: 0; font-size: 22px; font-weight: 800; letter-spacing: 0.5px; }
        .header p { margin: 6px 0 0; font-size: 13px; color: #B2D81F; font-weight: 600; }
        .content { padding: 30px 25px; }
        .field { margin-bottom: 20px; }
        .label { font-size: 11px; text-transform: uppercase; font-weight: 700; color: #6b7280; letter-spacing: 0.8px; margin-bottom: 4px; }
        .value { font-size: 15px; color: #111827; font-weight: 600; }
        .message-box { background-color: #f8fafc; border-left: 4px solid #B2D81F; padding: 16px 20px; border-radius: 6px; font-size: 14px; line-height: 1.6; color: #1f2937; margin-top: 8px; border: 1px solid #e2e8f0; border-left-width: 4px; border-left-color: #B2D81F; }
        .footer { background-color: #f9fafb; padding: 18px 20px; text-align: center; font-size: 12px; color: #6b7280; border-top: 1px solid #e5e7eb; }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h2>Nuevo Contacto desde la Web</h2>
            <p>' . $origenEsc . '</p>
        </div>
        <div class="content">
            <div class="field">
                <div class="label">Nombre</div>
                <div class="value">👤 ' . $nombreEsc . '</div>
            </div>
            <div class="field">
                <div class="label">Correo Electrónico</div>
                <div class="value">✉️ <a href="mailto:' . $emailEsc . '" style="color: #003A77; text-decoration: none;">' . $emailEsc . '</a></div>
            </div>
            <div class="field">
                <div class="label">Fecha y Hora</div>
                <div class="value">📅 ' . $fecha . '</div>
            </div>
            <div class="field">
                <div class="label">Mensaje</div>
                <div class="message-box">' . $mensajeEsc . '</div>
            </div>
        </div>
        <div class="footer">
            Puedes responder directamente a este correo para comunicarte con <strong>' . $nombreEsc . '</strong> (' . $emailEsc . ').
        </div>
    </div>
</body>
</html>';

            $this->mailer->Body = $body;
            $this->mailer->AltBody = "Nuevo mensaje de contacto web ({$origenEsc}):\n\nNombre: {$senderName}\nCorreo: {$senderEmail}\nFecha: {$fecha}\n\nMensaje:\n" . trim($data['mensaje'] ?? '');

            $result = $this->mailer->send();
            error_log("Email de contacto enviado para " . $senderEmail . ": " . ($result ? "ÉXITO" : "FALLÓ"));
            return (bool)$result;
        } catch (Exception $e) {
            error_log("Error en sendContactLeadEmail: " . $e->getMessage());
            throw $e;
        }
    }
}