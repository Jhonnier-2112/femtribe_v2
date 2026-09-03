<?php
/**
 * Registro Central de Rutas de la Aplicación FemTribe Runner
 * Las vistas están en: frontend/views/
 * Los controladores están en: backend/controllers/
 */

$frontendViews = realpath(__DIR__ . '/views');

// Rutas Públicas Principales
$router->get('/', 'HomeController@index');
$router->get('/nosotros', function() use ($frontendViews) {
    require $frontendViews . '/nosotros.php';
});

// Rutas Legales
$router->get('/terminos', function() use ($frontendViews) {
    require $frontendViews . '/legal/terminos.php';
});
$router->get('/politica-privacidad', function() use ($frontendViews) {
    require $frontendViews . '/legal/privacidad.php';
});
$router->get('/autorizacion-datos', function() use ($frontendViews) {
    require $frontendViews . '/legal/autorizacion.php';
});

// Rutas de Inscripciones a Carreras
$router->get('/inscribirse', 'RegistrationController@create');
$router->post('/inscribirse/guardar', 'RegistrationController@store');
$router->post('/inscribirse/verificar-documento', 'RegistrationController@checkDocumentStages');
$router->get('/registrar', 'RegistrationController@create');
$router->post('/registrar', 'RegistrationController@store');
$router->get('/registration_success', 'RegistrationController@success');
$router->get('/consulta_inscripcion', 'RegistrationController@consultaForm');
$router->get('/consultar', 'RegistrationController@consultaForm');
$router->post('/consultar_inscripcion', 'RegistrationController@consultarInscripcion');
$router->post('/consultar', 'RegistrationController@consultarInscripcion');

// Rutas de Tienda / E-Commerce y Categorías
$router->get('/productos', 'ProductController@index');
$router->get('/producto', 'ProductController@show');
$router->get('/carrito', 'CartController@index');
$router->post('/cart/sync', 'CartController@sync');
$router->get('/cart/get', 'CartController@getDbCart');

// Rutas de Pasarela de Pagos API Bancolombia / Wompi
$router->get('/checkout', 'PaymentController@checkout');
$router->get('/payment/pay', 'PaymentController@pay');
$router->post('/payment/process', 'PaymentController@processPayment');
$router->get('/payment/response', 'PaymentController@response');
$router->post('/payment/webhook', 'PaymentController@webhook');

// Rutas de Autenticación de Usuario (Corredores y Google Sign-In)
$router->get('/login', 'AuthController@showLogin');
$router->post('/login', 'AuthController@login');
$router->get('/registro', 'AuthController@showRegister');
$router->post('/registro', 'AuthController@register');
$router->get('/forgot-password', 'AuthController@showForgotPassword');
$router->post('/forgot-password', 'AuthController@processForgotPassword');
$router->get('/reset-password', 'AuthController@showResetPassword');
$router->post('/reset-password', 'AuthController@processResetPassword');
$router->get('/auth/google', 'AuthController@redirectToGoogle');
$router->get('/auth/google/callback', 'AuthController@handleGoogleCallback');
$router->post('/auth/refresh-token', 'AuthController@refreshToken');
$router->get('/logout', 'AuthController@logout');
$router->get('/perfil', 'AuthController@profile');
$router->post('/perfil', 'AuthController@updateProfile');
$router->post('/producto/comentario', 'ProductController@addReview');

// Rutas Administrativas y Panel de Gestión
$router->get('/admin/dashboard', 'AdminController@dashboard');
$router->get('/admin/evento', 'AdminController@eventConfig');
$router->get('/admin/evento/exportar', 'AdminController@exportRegistrations');
$router->post('/admin/evento/actualizar', 'AdminController@updateEventConfig');
$router->post('/admin/evento/kilometraje/guardar', 'AdminController@saveStage');
$router->post('/admin/evento/kilometraje/eliminar', 'AdminController@deleteStage');
$router->get('/admin/usuarios', 'UserController@index');
$router->get('/admin/usuarios/editar', 'UserController@edit');
$router->post('/admin/usuarios/actualizar', 'UserController@update');
$router->get('/admin/accesos', 'AdminController@accessLogs');
$router->get('/admin/auditoria', 'AdminController@auditLogs');

// Gestión de Productos
$router->get('/admin/productos', 'AdminController@products');
$router->get('/admin/productos/nuevo', 'AdminController@createProductForm');
$router->post('/admin/productos/guardar', 'AdminController@saveProduct');
$router->get('/admin/productos/editar', 'AdminController@editProductForm');
$router->post('/admin/productos/actualizar', 'AdminController@updateProduct');
$router->post('/admin/productos/upload-media', 'AdminController@uploadMedia');
$router->post('/admin/productos/eliminar', 'AdminController@deleteProduct');

// Gestión de Categorías
$router->get('/admin/categorias', 'AdminController@categories');
$router->post('/admin/categorias/guardar', 'AdminController@saveCategory');
$router->post('/admin/categorias/actualizar', 'AdminController@updateCategory');

// Gestión de Compras / Pedidos
$router->get('/admin/compras', 'AdminController@orders');
$router->get('/admin/compras/detalle', 'AdminController@orderDetail');


$router->get('/admin/run-db', 'AdminController@runDb');

// RUTA TEMPORAL DIAGNÓSTICO — eliminar al terminar
$router->get('/debug-email', 'AuthController@debugEmail');

// Chatbot API
$router->post('/api/chatbot', 'ChatbotController@respond');
