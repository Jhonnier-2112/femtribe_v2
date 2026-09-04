<?php
/**
 * SCRIPT DE DIAGNÓSTICO DE EMAIL - FEMTRIBE
 * Acceder en: http://localhost:8888/backend/debug_email.php
 * ELIMINAR después de resolver el problema.
 */
if (!in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1'])) {
    http_response_code(403); die('Acceso denegado');
}
header('Content-Type: text/html; charset=UTF-8');

$vendorPath = realpath(__DIR__ . '/../../frontend/vendor/autoload.php');
if ($vendorPath && file_exists($vendorPath)) {
    require_once $vendorPath;
} else {
    die('No se encontró vendor/autoload.php en: ' . __DIR__ . '/../../frontend/vendor/autoload.php');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Cargar .env
$envFile = __DIR__ . '/.env';
$env = [];
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') continue;
        if (strpos($line, '=') !== false) {
            [$key, $val] = explode('=', $line, 2);
            $env[trim($key)] = trim($val);
        }
    }
}

$configs = [
    'Gmail_app_password' => [
        'host'     => 'smtp.gmail.com',
        'port'     => 587,
        'secure'   => PHPMailer::ENCRYPTION_STARTTLS,
        'username' => 'femtribe25@gmail.com',
        'password' => $env['MAIL_PASS'] ?? 'vmzl libi wrji cjsi',
    ],
    'Hostinger_env' => [
        'host'     => $env['MAIL_HOST'] ?? 'smtp.hostinger.com',
        'port'     => (int)($env['MAIL_PORT'] ?? 465),
        'secure'   => (strtolower($env['MAIL_ENCRYPTION'] ?? 'ssl') === 'ssl') ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS,
        'username' => $env['MAIL_USER'] ?? '',
        'password' => $env['MAIL_PASS'] ?? '',
    ],
];

$testTo    = $_GET['email'] ?? '';
$runTest   = isset($_GET['run']) && $_GET['run'] === '1' && !empty($testTo);
$configKey = $_GET['config'] ?? 'Gmail_hardcoded';

?><!DOCTYPE html>
<html lang="es"><head>
<meta charset="UTF-8">
<title>Debug Email - FEMTRIBE</title>
<style>
body{font-family:monospace;background:#0f0f1a;color:#e0e0e0;padding:20px;line-height:1.6}
h1{color:#6da632;border-bottom:2px solid #6da632;padding-bottom:10px;margin-bottom:20px}
h2{color:#87cc3e;margin:20px 0 10px}
.card{background:#1a1a2e;border:1px solid #333;border-radius:8px;padding:16px;margin-bottom:16px}
.ok{border-color:#6da632}.err{border-color:#e63946}.warn{border-color:#e6a800}
table{width:100%;border-collapse:collapse;font-size:.85rem}
td,th{padding:6px 10px;border-bottom:1px solid #333;text-align:left}
th{color:#87cc3e}
.b-ok{background:#6da632;color:#fff;padding:2px 8px;border-radius:12px;font-size:.75rem;font-weight:bold}
.b-err{background:#e63946;color:#fff;padding:2px 8px;border-radius:12px;font-size:.75rem;font-weight:bold}
.b-warn{background:#e6a800;color:#000;padding:2px 8px;border-radius:12px;font-size:.75rem;font-weight:bold}
input,select{width:100%;padding:8px;background:#0f0f1a;border:1px solid #444;border-radius:4px;color:#e0e0e0;margin-bottom:10px}
button{background:#6da632;color:#fff;border:none;padding:10px 24px;border-radius:4px;cursor:pointer;font-weight:bold}
pre{background:#0a0a14;border:1px solid #333;padding:12px;border-radius:4px;overflow-x:auto;font-size:.8rem;white-space:pre-wrap}
</style></head><body>

<h1>Diagnóstico SMTP — FEMTRIBE</h1>

<h2>1. Configuración actual</h2>
<div class="card">
<table>
<tr><th>Parámetro</th><th>EmailConfig.php (usado en código)</th><th>.env (NO usado)</th><th>Problema</th></tr>
<tr><td>Host SMTP</td><td>smtp.gmail.com</td><td><?= htmlspecialchars($env['MAIL_HOST'] ?? 'N/A') ?></td>
<td><?= ($env['MAIL_HOST'] ?? '') !== 'smtp.gmail.com' ? '<span class="b-warn">⚠ Difieren</span>' : '<span class="b-ok">✓ Igual</span>' ?></td></tr>
<tr><td>Puerto</td><td>587</td><td><?= htmlspecialchars($env['MAIL_PORT'] ?? 'N/A') ?></td>
<td><?= ($env['MAIL_PORT'] ?? '') != 587 ? '<span class="b-warn">⚠ Difieren</span>' : '<span class="b-ok">✓ Igual</span>' ?></td></tr>
<tr><td>Usuario</td><td>FEMTRIBE25@gmail.com</td><td><?= htmlspecialchars($env['MAIL_USER'] ?? 'N/A') ?></td>
<td><?= ($env['MAIL_USER'] ?? '') !== 'femtribe25@gmail.com' ? '<span class="b-warn">⚠ Difieren</span>' : '<span class="b-ok">✓ Igual</span>' ?></td></tr>
<tr><td>Contraseña App</td><td><?= htmlspecialchars(substr($env['MAIL_PASS'] ?? 'vmzl...', 0, 8)) ?>...</td><td><?= htmlspecialchars(substr($env['MAIL_PASS'] ?? '', 0, 8)) ?>...</td><td>—</td></tr>
</table>
</div>

<h2>2. Entorno del servidor</h2>
<div class="card">
<table>
<tr><th>Verificación</th><th>Estado</th></tr>
<tr><td>PHPMailer</td><td><?= class_exists('PHPMailer\PHPMailer\PHPMailer') ? '<span class="b-ok">✓ OK</span>' : '<span class="b-err">✗ No encontrado</span>' ?></td></tr>
<tr><td>OpenSSL</td><td><?= extension_loaded('openssl') ? '<span class="b-ok">✓ Activo</span>' : '<span class="b-err">✗ DESACTIVADO — sin TLS/SSL</span>' ?></td></tr>
<tr><td>PHP Version</td><td><?= phpversion() ?></td></tr>
<tr><td>TCP smtp.gmail.com:587</td><td><?php
$s=@fsockopen('smtp.gmail.com',587,$en,$es,5);
if($s){fclose($s);echo '<span class="b-ok">✓ Accesible</span>';}
else echo '<span class="b-err">✗ BLOQUEADO: '.htmlspecialchars($es).' ('.$en.')</span>';
?></td></tr>
<tr><td>TCP smtp.gmail.com:465</td><td><?php
$s2=@fsockopen('smtp.gmail.com',465,$en2,$es2,5);
if($s2){fclose($s2);echo '<span class="b-ok">✓ Accesible</span>';}
else echo '<span class="b-err">✗ BLOQUEADO: '.htmlspecialchars($es2).' ('.$en2.')</span>';
?></td></tr>
<tr><td>TCP smtp.hostinger.com:465</td><td><?php
$s3=@fsockopen('smtp.hostinger.com',465,$en3,$es3,5);
if($s3){fclose($s3);echo '<span class="b-ok">✓ Accesible</span>';}
else echo '<span class="b-err">✗ BLOQUEADO: '.htmlspecialchars($es3).' ('.$en3.')</span>';
?></td></tr>
</table>
</div>

<h2>3. Test de envío en vivo</h2>
<div class="card">
<form method="get">
<label>Correo destino:</label>
<input type="email" name="email" value="<?= htmlspecialchars($testTo) ?>" placeholder="tucorreo@gmail.com" required>
<label>Configuración a probar:</label>
<select name="config">
<?php foreach(array_keys($configs) as $k): ?>
<option value="<?= $k ?>" <?= $configKey===$k?'selected':'' ?>><?= $k ?></option>
<?php endforeach; ?>
</select>
<input type="hidden" name="run" value="1">
<button type="submit">▶ Enviar email de prueba</button>
</form>
</div>

<?php if ($runTest): ?>
<h2>4. Resultado del test</h2>
<?php
$cfg = $configs[$configKey] ?? reset($configs);
$smtpLog = '';
$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug  = SMTP::DEBUG_LOWLEVEL;
    $mail->Debugoutput = function($str, $level) use (&$smtpLog) {
        $smtpLog .= "[L{$level}] " . trim($str) . "\n";
    };
    $mail->isSMTP();
    $mail->Host       = $cfg['host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $cfg['username'];
    $mail->Password   = $cfg['password'];
    $mail->SMTPSecure = $cfg['secure'];
    $mail->Port       = $cfg['port'];
    $mail->CharSet    = 'UTF-8';
    $mail->setFrom($cfg['username'], 'FEMTRIBE Debug');
    $mail->addAddress($testTo);
    $mail->isHTML(true);
    $mail->Subject = 'Test SMTP FEMTRIBE - ' . date('H:i:s');
    $mail->Body    = '<h2 style="color:#6da632">Test SMTP exitoso</h2>
                      <p>Config: ' . htmlspecialchars($configKey) . '</p>
                      <p>Host: ' . htmlspecialchars($cfg['host']) . ':' . $cfg['port'] . '</p>
                      <p>Hora: ' . date('Y-m-d H:i:s') . '</p>';
    $mail->send();
    echo '<div class="card ok"><p><span class="b-ok">✅ ÉXITO</span> — Correo enviado a <strong>' . htmlspecialchars($testTo) . '</strong></p></div>';
} catch (Exception $e) {
    echo '<div class="card err"><p><span class="b-err">❌ ERROR</span> — ' . htmlspecialchars($mail->ErrorInfo) . '</p></div>';
}
if (!empty($smtpLog)) {
    echo '<h2>5. Log SMTP completo</h2>';
    echo '<div class="card"><pre>' . htmlspecialchars($smtpLog) . '</pre></div>';
}
?>
<?php endif; ?>

<div class="card warn" style="margin-top:20px">
<strong>⚠ Seguridad:</strong> Elimina <code>backend/debug_email.php</code> al terminar.
</div>
</body></html>
