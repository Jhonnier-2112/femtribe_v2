<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    public function index() {
        $this->view('home');
    }
    
    public function nosotros() {
        $this->view('nosotros');
    }
    
    public function productos() {
        $this->view('productos');
    }
    
    public function blog() {
        $this->view('blog');
    }

    public function contacto() {
        header('Content-Type: application/json; charset=utf-8');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
            exit;
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $mensaje = trim($_POST['mensaje'] ?? '');

        if (empty($nombre) || empty($email) || empty($mensaje)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Por favor completa todos los campos del formulario.']);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'El correo electrónico ingresado no es válido.']);
            exit;
        }

        try {
            $emailService = new \App\Services\EmailService();
            $sent = $emailService->sendContactLeadEmail([
                'nombre'  => $nombre,
                'email'   => $email,
                'mensaje' => $mensaje,
                'origen'  => 'Sección ¿ESTÁS LISTO? (Home)'
            ]);

            if ($sent) {
                echo json_encode([
                    'success' => true,
                    'message' => '¡Gracias! Tu mensaje ha sido enviado con éxito. Muy pronto te responderemos.'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'success' => false,
                    'message' => 'No fue posible enviar el mensaje en este momento. Por favor inténtalo más tarde.'
                ]);
            }
        } catch (\Exception $e) {
            error_log("Error en HomeController::contacto: " . $e->getMessage());
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Ocurrió un error al enviar el mensaje. Por favor intenta más tarde.'
            ]);
        }
        exit;
    }
}
