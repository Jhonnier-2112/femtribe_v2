<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Services\GoogleAuthService;
use App\Services\TokenAuthService;

class AuthController extends Controller {

    /**
     * Muestra el formulario de inicio de sesión
     */
    public function showLogin() {
        if ($this->isLoggedIn()) {
            $this->redirect('/perfil');
        }
        $googleService = new GoogleAuthService();
        $googleAuthUrl = $googleService->getAuthUrl();

        $this->view('auth/login', ['googleAuthUrl' => $googleAuthUrl]);
    }

    /**
     * Procesar inicio de sesión
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        $loginInput = $_POST['login_input'] ?? '';
        $password = $_POST['password'] ?? '';
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        if (empty($loginInput) || empty($password)) {
            $msg = 'Por favor ingresa tu correo/documento y contraseña.';
            if ($isAjax) {
                $this->json(['success' => false, 'message' => $msg], 400);
            }
            $this->view('auth/login', ['error' => $msg, 'loginInput' => $loginInput]);
            return;
        }

        $userModel = new User();
        $user = $userModel->authenticate($loginInput, $password);

        if ($user) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nombres'] = $user['nombres'];
            $_SESSION['user_apellidos'] = $user['apellidos'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_documento'] = $user['numero_documento'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_role_id'] = $user['role_id'] ?? null;

            // Registrar log de auditoría
            \App\Services\AuditLogService::log('USER_LOGIN', 'Inicio de sesión exitoso por credenciales tradicionales para ' . $user['email'], null, (int)$user['id']);

            // Generar Access Token y Refresh Token con vencimiento de 1 Hora (3600s)
            $tokenService = new TokenAuthService();
            $tokenData = $tokenService->issueTokenPair($user);

            $redirectTo = $_SESSION['redirect_after_login'] ?? '/perfil';
            unset($_SESSION['redirect_after_login']);

            if ($isAjax) {
                $this->json([
                    'success' => true, 
                    'message' => '¡Bienvenido de nuevo!', 
                    'redirect' => null,
                    'tokens' => $tokenData
                ]);
            }
            $this->redirect($redirectTo);
        } else {
            // Registrar log de auditoría
            \App\Services\AuditLogService::log('USER_LOGIN_FAILED', 'Intento fallido de inicio de sesión para el identificador: ' . $loginInput);

            $msg = 'Credenciales incorrectas. Verifica tu correo/documento y contraseña.';
            if ($isAjax) {
                $this->json(['success' => false, 'message' => $msg], 401);
            }
            $this->view('auth/login', ['error' => $msg, 'loginInput' => $loginInput]);
        }
    }

    /**
     * Muestra el formulario de registro de usuario
     */
    public function showRegister() {
        if ($this->isLoggedIn()) {
            $this->redirect('/perfil');
        }
        $googleService = new GoogleAuthService();
        $googleAuthUrl = $googleService->getAuthUrl();

        $this->view('auth/register', ['googleAuthUrl' => $googleAuthUrl]);
    }

    /**
     * Procesa el registro de un nuevo usuario
     */
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/registro');
        }

        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        $data = [
            'nombres' => trim($_POST['nombres'] ?? ''),
            'apellidos' => trim($_POST['apellidos'] ?? ''),
            'tipo_documento' => $_POST['tipo_documento'] ?? 'CC',
            'numero_documento' => trim($_POST['numero_documento'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'telefono' => trim($_POST['telefono'] ?? ''),
            'direccion' => trim($_POST['direccion'] ?? ''),
            'municipio' => trim($_POST['municipio'] ?? 'Cali'),
            'departamento' => trim($_POST['departamento'] ?? 'Valle del Cauca'),
            'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? null,
            'genero' => $_POST['genero'] ?? null,
            'eps' => trim($_POST['eps'] ?? ''),
            'grupo_sanguineo' => $_POST['grupo_sanguineo'] ?? '',
            'rh' => $_POST['rh'] ?? '',
            'role' => 'runner'
        ];

        $userModel = new User();
        $errors = $userModel->validateRegistrationData($data);

        // Verificar si email ya existe
        if (!empty($data['email']) && $userModel->findByEmail($data['email'])) {
            $errors[] = 'El correo electrónico ya está registrado en la plataforma.';
        }

        // Verificar si documento ya existe
        if (!empty($data['numero_documento']) && $userModel->findByDocument($data['numero_documento'])) {
            $errors[] = 'El número de documento ya tiene una cuenta asociada.';
        }

        if (!empty($errors)) {
            if ($isAjax) {
                $this->json(['success' => false, 'errors' => $errors, 'message' => implode('<br>', $errors)], 400);
            }
            $this->view('auth/register', ['errors' => $errors, 'data' => $data]);
            return;
        }

        $userId = User::create($data);

        if ($userId) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_nombres'] = $data['nombres'];
            $_SESSION['user_apellidos'] = $data['apellidos'];
            $_SESSION['user_email'] = $data['email'];
            $_SESSION['user_documento'] = $data['numero_documento'];
            $_SESSION['user_role'] = 'runner';
            $_SESSION['user_role_id'] = \App\Models\Role::CLIENTE_ID;

            // Registrar log de auditoría
            \App\Services\AuditLogService::log('USER_REGISTER', 'Nuevo usuario registrado en la plataforma: ' . $data['email'], ['nombres' => $data['nombres'], 'apellidos' => $data['apellidos']], (int)$userId);

            // Generar Access Token y Refresh Token de 1 Hora (3600s)
            $tokenService = new TokenAuthService();
            $userRecord = array_merge(['id' => $userId], $data);
            $tokenData = $tokenService->issueTokenPair($userRecord);

            $redirectTo = $_SESSION['redirect_after_login'] ?? '/perfil';
            unset($_SESSION['redirect_after_login']);

            if ($isAjax) {
                $this->json([
                    'success' => true, 
                    'message' => '¡Registro exitoso! Bienvenido a FEMTRIBE Runner.', 
                    'redirect' => null,
                    'tokens' => $tokenData
                ]);
            }
            $this->redirect($redirectTo);
        } else {
            $msg = 'Ocurrió un error al crear la cuenta. Por favor intenta de nuevo.';
            if ($isAjax) {
                $this->json(['success' => false, 'message' => $msg], 500);
            }
            $this->view('auth/register', ['errors' => [$msg], 'data' => $data]);
        }
    }

    /**
     * Redirecciona al flujo de autenticación oficial de Google OAuth 2.0
     */
    public function redirectToGoogle() {
        $googleService = new GoogleAuthService();
        $authUrl = $googleService->getAuthUrl();

        if ($authUrl === '#') {
            http_response_code(500);
            echo "Google OAuth 2.0 no está configurado aún en el archivo .env";
            return;
        }

        $this->redirect($authUrl);
    }

    /**
     * Recibe la respuesta de Google OAuth 2.0 y autentica/registra al usuario
     */
    public function handleGoogleCallback() {
        $code = $_GET['code'] ?? null;
        if (!$code) {
            $this->redirect('/login');
        }

        $googleService = new GoogleAuthService();
        $googleUser = $googleService->getGoogleUser($code);

        if (!$googleUser || empty($googleUser['email'])) {
            $this->view('auth/login', ['error' => 'No se pudo obtener el perfil de Google. Intenta nuevamente.']);
            return;
        }

        $userModel = new User();
        $user = $userModel->findOrCreateFromGoogle($googleUser);

        if ($user) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nombres'] = $user['nombres'];
            $_SESSION['user_apellidos'] = $user['apellidos'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_documento'] = $user['numero_documento'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_role_id'] = $user['role_id'] ?? null;

            // Registrar log de auditoría
            \App\Services\AuditLogService::log('USER_LOGIN_GOOGLE', 'Inicio de sesión exitoso vía Google OAuth para ' . $user['email'], null, (int)$user['id']);

            // Emitir Access Token y Refresh Token de 1 Hora (3600s)
            $tokenService = new TokenAuthService();
            $tokenService->issueTokenPair($user);

            $redirectTo = $_SESSION['redirect_after_login'] ?? '/perfil';
            unset($_SESSION['redirect_after_login']);

            $this->redirect($redirectTo);
        } else {
            $this->view('auth/login', ['error' => 'Error al crear/autenticar cuenta con Google.']);
        }
    }

    /**
     * Renovación dinámica de Access Token y Refresh Token (Endpoint de 1 Hora)
     */
    public function refreshToken() {
        $rawRefreshToken = $_COOKIE['refresh_token'] ?? $_POST['refresh_token'] ?? null;
        if (!$rawRefreshToken) {
            $this->json(['success' => false, 'message' => 'Refresh token no proporcionado.'], 401);
        }

        $tokenService = new TokenAuthService();
        $validRecord = $tokenService->validateRefreshToken($rawRefreshToken);

        if (!$validRecord) {
            $tokenService->clearTokenCookies();
            $this->json(['success' => false, 'message' => 'Refresh token vencido o inválido. Inicia sesión de nuevo.'], 401);
        }

        $userModel = new User();
        $user = $userModel->findById($validRecord['user_id']);

        if (!$user) {
            $this->json(['success' => false, 'message' => 'Usuario no encontrado.'], 404);
        }

        $newTokenData = $tokenService->refreshTokens($rawRefreshToken, $user);

        $this->json([
            'success' => true,
            'message' => 'Tokens renovados exitosamente por 1 hora.',
            'tokens' => $newTokenData
        ]);
    }

    /**
     * Cierra la sesión activa y revoca tokens de seguridad
     */
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $_SESSION['user_id'] ?? null;
        $userEmail = $_SESSION['user_email'] ?? 'desconocido';

        if ($userId) {
            \App\Services\AuditLogService::log('USER_LOGOUT', 'Cierre de sesión para ' . $userEmail, null, (int)$userId);
        }

        $tokenService = new TokenAuthService();
        if (!empty($_COOKIE['refresh_token'])) {
            $tokenService->revokeRefreshToken($_COOKIE['refresh_token']);
        }
        $tokenService->clearTokenCookies();

        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        $this->redirect('/');
    }

    /**
     * Muestra el perfil del usuario autenticado
     */
    public function profile() {
        $this->requireAuth();
        $currentUser = $this->currentUser();
        
        $userModel = new User();
        $user = $userModel->findById($currentUser['id']);

        $orderModel = new \App\Models\Order();
        $orders = $orderModel->getUserOrders($currentUser['id']);

        $this->view('auth/profile', ['user' => $user, 'orders' => $orders]);
    }

    /**
     * Actualiza la información del perfil del usuario
     */
    public function updateProfile() {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/perfil');
        }

        $currentUser = $this->currentUser();
        $userModel = new User();

        $data = [
            'nombres' => trim($_POST['nombres'] ?? ''),
            'apellidos' => trim($_POST['apellidos'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'direccion' => trim($_POST['direccion'] ?? ''),
            'municipio' => trim($_POST['municipio'] ?? 'Cali'),
            'departamento' => trim($_POST['departamento'] ?? 'Valle del Cauca'),
            'eps' => trim($_POST['eps'] ?? ''),
            'grupo_sanguineo' => $_POST['grupo_sanguineo'] ?? '',
            'rh' => $_POST['rh'] ?? ''
        ];

        $success = $userModel->updateProfile($currentUser['id'], $data);
        if ($success) {
            $_SESSION['user_nombres'] = $data['nombres'];
            $_SESSION['user_apellidos'] = $data['apellidos'];
            $_SESSION['profile_message'] = 'Perfil actualizado correctamente.';
        } else {
            $_SESSION['profile_error'] = 'No se pudo actualizar el perfil.';
        }

        $this->redirect('/perfil');
    }

    /**
     * Muestra la vista de solicitud de recuperación de contraseña
     */
    public function showForgotPassword() {
        if ($this->isLoggedIn()) {
            $this->redirect('/perfil');
        }
        $this->view('auth/forgot_password');
    }

    /**
     * Procesa la solicitud de recuperación de contraseña y envía el correo
     */
    public function processForgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/forgot-password');
        }

        $email = strtolower(trim($_POST['email'] ?? ''));
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->view('auth/forgot_password', ['error' => 'Ingresa un correo electrónico válido.']);
            return;
        }

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user) {
            $token = $userModel->createPasswordResetToken($email);
            if ($token) {
                try {
                    $appUrl = getenv('APP_URL') ?: (($_SERVER['REQUEST_SCHEME'] ?? 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost'));
                    $resetUrl = rtrim($appUrl, '/') . '/reset-password?token=' . urlencode($token);

                    $emailService = new \App\Services\EmailService();
                    $emailService->sendPasswordResetEmail($user, $resetUrl);
                    
                    \App\Services\AuditLogService::log('PASSWORD_RESET_REQUESTED', 'Solicitud de recuperación para ' . $email, null, (int)$user['id']);
                } catch (\Exception $e) {
                    error_log("Error enviando email de recuperación: " . $e->getMessage());
                }
            }
        }

        // Mensaje neutro por seguridad contra enumeración de usuarios
        $this->view('auth/forgot_password', [
            'success' => 'Si tu correo electrónico se encuentra registrado en nuestra plataforma, recibirás en breve un enlace para restablecer tu contraseña.'
        ]);
    }

    /**
     * Muestra el formulario para ingresar la nueva contraseña mediante el token
     */
    public function showResetPassword() {
        $token = trim($_GET['token'] ?? '');
        if (empty($token)) {
            $this->view('auth/forgot_password', ['error' => 'Enlace de restauración no válido o expirado. Por favor solicita uno nuevo.']);
            return;
        }

        $userModel = new User();
        $user = $userModel->verifyPasswordResetToken($token);
        if (!$user) {
            $this->view('auth/forgot_password', ['error' => 'El enlace de restauración ha expirado o es inválido. Solicita un nuevo enlace.']);
            return;
        }

        $this->view('auth/reset_password', ['token' => $token, 'email' => $user['email']]);
    }

    /**
     * Procesa la actualización de la contraseña con el token de verificación
     */
    public function processResetPassword() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/forgot-password');
        }

        $token = trim($_POST['token'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (empty($token)) {
            $this->view('auth/forgot_password', ['error' => 'Token no proporcionado.']);
            return;
        }

        $userModel = new User();
        $user = $userModel->verifyPasswordResetToken($token);
        if (!$user) {
            $this->view('auth/forgot_password', ['error' => 'El enlace de restauración ha expirado. Por favor solicita uno nuevo.']);
            return;
        }

        if (strlen($password) < 6) {
            $this->view('auth/reset_password', ['token' => $token, 'email' => $user['email'], 'error' => 'La nueva contraseña debe tener al menos 6 caracteres.']);
            return;
        }

        if ($password !== $confirmPassword) {
            $this->view('auth/reset_password', ['token' => $token, 'email' => $user['email'], 'error' => 'Las contraseñas ingresadas no coinciden.']);
            return;
        }

        $success = $userModel->updatePasswordByToken($token, $password);
        if ($success) {
            \App\Services\AuditLogService::log('PASSWORD_RESET_SUCCESS', 'Contraseña restablecida exitosamente para ' . $user['email'], null, (int)$user['id']);
            $this->view('auth/login', [
                'success' => '¡Tu contraseña ha sido restablecida exitosamente! Ya puedes iniciar sesión con tu nueva clave.'
            ]);
        } else {
            $this->view('auth/reset_password', ['token' => $token, 'email' => $user['email'], 'error' => 'No se pudo actualizar la contraseña. Inténtalo nuevamente.']);
        }
    }
    // ══ MÉTODO TEMPORAL DE DIAGNÓSTICO SMTP — eliminar después ══
    public function debugEmail() {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        $key = $_GET['key'] ?? '';
        // Permitir localhost o parámetro de seguridad ?key=femtribe_debug
        if (!in_array($ip, ['127.0.0.1', '::1']) && $key !== 'femtribe_debug' && $key !== '123456') {
            // Si no coincide, dar instrucciones de acceso
            http_response_code(403);
            die('Acceso restringido. Para acceder desde el servidor remoto, agrega &key=femtribe_debug a la URL.');
        }

        // Leer .env del backend
        $env = [];
        $envFile = __DIR__ . '/../.env';
        if (file_exists($envFile)) {
            foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                $line = trim($line);
                if ($line === '' || $line[0] === '#') continue;
                if (strpos($line, '=') !== false) {
                    [$k, $v] = explode('=', $line, 2);
                    $env[trim($k)] = trim($v);
                }
            }
        }

        $testTo    = $_GET['email'] ?? '';
        $runTest   = isset($_GET['run']) && $_GET['run'] === '1' && !empty($testTo);
        $configKey = $_GET['config'] ?? 'gmail';

        // PHPMailer
        $mailerLoaded = class_exists('PHPMailer\PHPMailer\PHPMailer');

        $configs = [
            'gmail' => [
                'label'    => 'Gmail — EmailConfig.php (hardcoded)',
                'host'     => 'smtp.gmail.com',
                'port'     => 587,
                'encrypt'  => 'tls',
                'username' => 'femtribe25@gmail.com',
                'password' => 'zsxc cuss qgvy yxba',
            ],
            'hostinger' => [
                'label'    => 'Hostinger — desde .env',
                'host'     => $env['MAIL_HOST'] ?? 'smtp.hostinger.com',
                'port'     => (int)($env['MAIL_PORT'] ?? 465),
                'encrypt'  => strtolower($env['MAIL_ENCRYPTION'] ?? 'ssl'),
                'username' => $env['MAIL_USER'] ?? '',
                'password' => $env['MAIL_PASS'] ?? '',
            ],
        ];

        // Pruebas TCP
        $tcp = [];
        foreach (['smtp.gmail.com:587', 'smtp.gmail.com:465', 'smtp.hostinger.com:465'] as $endpoint) {
            [$h, $p] = explode(':', $endpoint);
            $s = @fsockopen($h, (int)$p, $en, $es, 5);
            if ($s) { fclose($s); $tcp[$endpoint] = ['ok' => true]; }
            else     { $tcp[$endpoint] = ['ok' => false, 'msg' => "$es ($en)"]; }
        }

        // Test de envío
        $smtpLog = ''; $sendResult = null; $sendError = '';
        if ($runTest && $mailerLoaded) {
            $cfg  = $configs[$configKey] ?? $configs['gmail'];
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            try {
                $mail->SMTPDebug  = \PHPMailer\PHPMailer\SMTP::DEBUG_LOWLEVEL;
                $mail->Debugoutput = function($str, $lvl) use (&$smtpLog) {
                    $smtpLog .= "[L{$lvl}] " . trim($str) . "\n";
                };
                $mail->isSMTP();
                $mail->Host       = $cfg['host'];
                $mail->SMTPAuth   = true;
                $mail->Username   = $cfg['username'];
                $mail->Password   = $cfg['password'];
                $mail->SMTPSecure = $cfg['encrypt'] === 'ssl'
                    ? \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS
                    : \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = $cfg['port'];
                $mail->CharSet    = 'UTF-8';
                $mail->setFrom($cfg['username'], 'FEMTRIBE Debug');
                $mail->addAddress($testTo);
                $mail->isHTML(true);
                $mail->Subject = 'Test SMTP FEMTRIBE — ' . date('H:i:s');
                $mail->Body    = '<h2 style="color:#6da632">✅ SMTP funcionando</h2>'
                               . '<p><b>Config:</b> ' . htmlspecialchars($cfg['label']) . '</p>'
                               . '<p><b>Hora:</b> ' . date('Y-m-d H:i:s') . '</p>';
                $mail->send();
                $sendResult = true;
            } catch (\PHPMailer\PHPMailer\Exception $e) {
                $sendResult = false;
                $sendError  = $mail->ErrorInfo;
            }
        }

        // ── HTML de diagnóstico ──────────────────────────────────────────
        header('Content-Type: text/html; charset=UTF-8');

        function _b($ok, $okT, $failT) {
            $c = $ok ? '#6da632' : '#e63946';
            $t = $ok ? $okT : $failT;
            return "<span style='background:{$c};color:#fff;padding:2px 9px;border-radius:12px;font-size:.8rem;font-weight:bold'>{$t}</span>";
        }
        ?>
<!DOCTYPE html><html lang="es"><head>
<meta charset="UTF-8"><title>Debug Email — FEMTRIBE</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:monospace;background:#0f0f1a;color:#e0e0e0;padding:24px;line-height:1.6}
h1{color:#6da632;border-bottom:2px solid #6da632;padding-bottom:10px;margin-bottom:20px;font-size:1.4rem}
h2{color:#87cc3e;margin:22px 0 10px;font-size:1.05rem}
.card{background:#1a1a2e;border:1px solid #333;border-radius:8px;padding:16px;margin-bottom:14px}
.ok{border-color:#6da632}.err{border-color:#e63946}.warn{border-color:#e6a800}
table{width:100%;border-collapse:collapse;font-size:.85rem}
td,th{padding:7px 10px;border-bottom:1px solid #2a2a40;text-align:left;vertical-align:top}
th{color:#87cc3e}
input,select{width:100%;padding:8px;background:#0f0f1a;border:1px solid #444;border-radius:4px;color:#e0e0e0;margin-bottom:10px;font-family:monospace}
button{background:#6da632;color:#fff;border:none;padding:10px 26px;border-radius:4px;cursor:pointer;font-weight:bold;font-size:1rem}
button:hover{background:#87cc3e}
pre{background:#0a0a14;border:1px solid #2a2a40;padding:12px;border-radius:4px;font-size:.78rem;white-space:pre-wrap;max-height:420px;overflow-y:auto}
.val{color:#a8d8ff}.wt{color:#e6a800}
</style></head><body>
<h1>🔍 Diagnóstico SMTP — FEMTRIBE</h1>

<h2>1. Comparación EmailConfig.php vs .env</h2>
<div class="card warn">
<table>
<tr><th>Parámetro</th><th>EmailConfig.php (USADO en código)</th><th>.env (IGNORADO)</th><th>¿Problema?</th></tr>
<tr><td>Host</td><td class="val">smtp.gmail.com</td><td class="wt"><?= htmlspecialchars($env['MAIL_HOST'] ?? 'N/A') ?></td>
<td><?= _b(($env['MAIL_HOST'] ?? '') === 'smtp.gmail.com', '✓ Igual', '⚠ Difieren') ?></td></tr>
<tr><td>Puerto</td><td class="val">587 (STARTTLS)</td><td class="wt"><?= htmlspecialchars($env['MAIL_PORT'] ?? 'N/A') ?></td>
<td><?= _b(($env['MAIL_PORT'] ?? '') == 587, '✓ Igual', '⚠ Difieren') ?></td></tr>
<tr><td>Usuario</td><td class="val">FEMTRIBE25@gmail.com</td><td class="wt"><?= htmlspecialchars($env['MAIL_USER'] ?? 'N/A') ?></td>
<td><?= _b(($env['MAIL_USER'] ?? '') === 'femtribe25@gmail.com', '✓ Igual', '⚠ Difieren') ?></td></tr>
<tr><td>Contraseña App</td><td class="val">zsxc cuss qgvy yxba</td><td class="wt"><?= htmlspecialchars($env['MAIL_PASS'] ?? 'N/A') ?></td>
<td><?= _b(($env['MAIL_PASS'] ?? '') === 'zsxc cuss qgvy yxba', '✓ Igual', '⚠ DIFERENTE — causa probable') ?></td></tr>
</table>
</div>

<h2>2. Conectividad TCP a servidores SMTP</h2>
<div class="card">
<table>
<tr><th>Servidor:Puerto</th><th>Estado</th></tr>
<?php foreach ($tcp as $ep => $r): ?>
<tr><td><?= htmlspecialchars($ep) ?></td><td><?= _b($r['ok'], '✓ Accesible', '✗ BLOQUEADO — ' . htmlspecialchars($r['msg'] ?? '')) ?></td></tr>
<?php endforeach; ?>
</table>
</div>

<h2>3. Entorno PHP</h2>
<div class="card">
<table>
<tr><th>Verificación</th><th>Estado</th></tr>
<tr><td>PHPMailer</td><td><?= _b($mailerLoaded, '✓ Cargado', '✗ No encontrado') ?></td></tr>
<tr><td>OpenSSL (para TLS/SSL)</td><td><?= _b(extension_loaded('openssl'), '✓ Activo', '✗ DESACTIVADO — sin SMTP seguro') ?></td></tr>
<tr><td>PHP Version</td><td class="val"><?= phpversion() ?></td></tr>
</table>
</div>

<h2>4. Enviar email de prueba</h2>
<div class="card">
<form method="get" action="/debug-email">
<label>Correo destino:</label>
<input type="email" name="email" value="<?= htmlspecialchars($testTo) ?>" placeholder="tucorreo@gmail.com" required>
<label>Configuración a probar:</label>
<select name="config">
<option value="gmail" <?= $configKey==='gmail'?'selected':'' ?>>Gmail hardcoded (zsxc cuss qgvy yxba)</option>
<option value="hostinger" <?= $configKey==='hostinger'?'selected':'' ?>>Hostinger .env (<?= htmlspecialchars($env['MAIL_USER'] ?? '') ?>)</option>
</select>
<input type="hidden" name="run" value="1">
<?php if (!empty($key)): ?><input type="hidden" name="key" value="<?= htmlspecialchars($key) ?>"><?php endif; ?>
<button type="submit">▶ Enviar email de prueba</button>
</form>
</div>

<?php if ($runTest): ?>
<h2>5. Resultado</h2>
<?php if ($sendResult === true): ?>
<div class="card ok"><p><?= _b(true,'✅ ÉXITO','') ?> &nbsp; Correo enviado a <strong><?= htmlspecialchars($testTo) ?></strong> — revisa tu bandeja.</p></div>
<?php elseif ($sendResult === false): ?>
<div class="card err"><p><?= _b(false,'','❌ ERROR') ?> &nbsp; <strong><?= htmlspecialchars($sendError) ?></strong></p></div>
<?php elseif (!$mailerLoaded): ?>
<div class="card err"><p>❌ PHPMailer no está cargado — no se puede hacer el test.</p></div>
<?php endif; ?>

<?php if (!empty($smtpLog)): ?>
<h2>6. Log SMTP completo</h2>
<div class="card"><pre><?= htmlspecialchars($smtpLog) ?></pre></div>
<?php endif; ?>
<?php endif; ?>

<div class="card warn" style="margin-top:18px">⚠️ <strong>Elimina</strong> este método y su ruta en <code>routes.php</code> al terminar.</div>
</body></html>
<?php
    }
    // ══ FIN MÉTODO TEMPORAL ══

}
