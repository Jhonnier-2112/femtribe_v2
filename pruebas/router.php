<?php
// Router para PHP built-in server en puerto 8000
// Sirve archivos estáticos directamente y redirige el resto a index.php

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$file = __DIR__ . $uri;

// Si el recurso solicitado existe físicamente dentro de public, lo sirve tal cual
if (is_file($file)) {
    return false; // PHP server servirá el archivo estático
}

// Para cualquier otra ruta, cargamos el front controller
require __DIR__ . '/index.php';