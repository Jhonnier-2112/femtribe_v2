<?php
// Buscar la carpeta backend en varias ubicaciones posibles del dominio principal
$possibleBackendPaths = [
    __DIR__ . '/backend',
    __DIR__ . '/../backend',
    __DIR__ . '/../../backend',
    __DIR__ . '/app',
    __DIR__ . '/../app',
    __DIR__ . '/Backend',
    __DIR__ . '/../Backend'
];

$backendPath = false;
foreach ($possibleBackendPaths as $path) {
    if (is_dir($path) && file_exists($path . '/config/config.php')) {
        $backendPath = realpath($path);
        break;
    }
}

if (!$backendPath) {
    header('HTTP/1.1 500 Internal Server Error');
    echo "<style>body{font-family:sans-serif;padding:2rem;line-height:1.6;background:#f9f9f9;color:#333;}.card{background:#fff;padding:2rem;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.1);max-width:700px;margin:0 auto;}code{background:#eee;padding:2px 6px;border-radius:4px;}</style>";
    echo "<div class='card'>";
    echo "<h2 style='color:#e53e3e;'>⚠️ Error de Despliegue: No se encontró la carpeta 'backend'</h2>";
    echo "<p>El sistema intentó localizar la carpeta <strong>backend</strong> en las siguientes rutas del servidor:</p>";
    echo "<ul>";
    foreach ($possibleBackendPaths as $path) {
        echo "<li><code>" . htmlspecialchars($path) . "</code></li>";
    }
    echo "</ul>";
    echo "<hr><p><strong>¿Cómo solucionarlo en Hostinger?</strong></p>";
    echo "<ol>";
    echo "<li>Asegúrate de haber subido la carpeta <code>backend</code> completa a <code>" . htmlspecialchars(__DIR__ . '/backend') . "</code>.</li>";
    echo "<li>Verifica que la carpeta se llame exactamente <code>backend</code> en minúsculas.</li>";
    echo "</ol>";
    echo "</div>";
    exit;
}

// Cargar configuración general
require_once $backendPath . '/config/config.php';

// Cargar autoloader de Composer
$possibleVendorPaths = [
    __DIR__ . '/vendor/autoload.php',
    __DIR__ . '/../vendor/autoload.php',
    $backendPath . '/vendor/autoload.php'
];

$vendorAutoload = false;
foreach ($possibleVendorPaths as $path) {
    if (file_exists($path)) {
        $vendorAutoload = realpath($path);
        break;
    }
}

if (!$vendorAutoload) {
    header('HTTP/1.1 500 Internal Server Error');
    echo "<style>body{font-family:sans-serif;padding:2rem;line-height:1.6;background:#f9f9f9;color:#333;}.card{background:#fff;padding:2rem;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.1);max-width:700px;margin:0 auto;}code{background:#eee;padding:2px 6px;border-radius:4px;}</style>";
    echo "<div class='card'>";
    echo "<h2 style='color:#e53e3e;'>⚠️ Error: No se encontró la carpeta 'vendor'</h2>";
    echo "<p>Por favor sube la carpeta <code>vendor/</code> al servidor.</p>";
    echo "</div>";
    exit;
}
require_once $vendorAutoload;

// Cargar las clases core del BACKEND
if (!class_exists('App\\Core\\Router')) {
    require_once $backendPath . '/core/Router.php';
}
if (!class_exists('App\\Core\\Controller')) {
    require_once $backendPath . '/core/Controller.php';
}

use App\Core\Router;

session_start();

// Instancia del Router
$router = new Router();

// Cargamos rutas
$possibleRoutePaths = [
    __DIR__ . '/routes.php',
    __DIR__ . '/../routes.php'
];

$routesPath = false;
foreach ($possibleRoutePaths as $path) {
    if (file_exists($path)) {
        $routesPath = realpath($path);
        break;
    }
}

if (!$routesPath) {
    header('HTTP/1.1 500 Internal Server Error');
    echo "<style>body{font-family:sans-serif;padding:2rem;line-height:1.6;background:#f9f9f9;color:#333;}.card{background:#fff;padding:2rem;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.1);max-width:700px;margin:0 auto;}code{background:#eee;padding:2px 6px;border-radius:4px;}</style>";
    echo "<div class='card'>";
    echo "<h2 style='color:#e53e3e;'>⚠️ Error de Despliegue: No se encontró 'routes.php'</h2>";
    echo "<p>El sistema intentó localizar el archivo <strong>routes.php</strong> en las siguientes rutas:</p>";
    echo "<ul>";
    foreach ($possibleRoutePaths as $path) {
        echo "<li><code>" . htmlspecialchars($path) . "</code></li>";
    }
    echo "</ul>";
    echo "</div>";
    exit;
}
require_once $routesPath;

// AUTOLOADER: Carga clases desde backend/ bajo demanda
spl_autoload_register(function ($class) use ($backendPath) {
    // Convertir namespace a nombre de clase base
    $classBase = basename(str_replace('\\', '/', $class)) . '.php';

    // Buscar en las carpetas del backend en orden de prioridad
    $paths = [
        $backendPath . '/controllers/' . $classBase,
        $backendPath . '/models/'      . $classBase,
        $backendPath . '/services/'    . $classBase,
        $backendPath . '/core/'        . $classBase,
        $backendPath . '/config/'      . $classBase,
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Registrar log de acceso a la página en la base de datos si la clase existe
if (class_exists('App\\Services\\AccessLogService')) {
    \App\Services\AccessLogService::logAccess();
}

// Ejecutamos el router
$router->dispatch();
