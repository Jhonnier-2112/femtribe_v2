<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Testimonial;

class TestimonialController extends Controller {

    /**
     * Guarda un nuevo testimonio y calificación de la página
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/nosotros');
        }

        $user = $this->currentUser();

        $name = trim($_POST['name'] ?? '');
        $roleTitle = trim($_POST['role_title'] ?? '');
        $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 5;
        $comment = trim($_POST['comment'] ?? '');

        // Si el usuario está autenticado y no ingresó nombre, usar el de su cuenta
        $avatar = null;
        if ($user) {
            if (empty($name)) {
                $name = trim(($user['nombres'] ?? '') . ' ' . ($user['apellidos'] ?? ''));
                if (empty($name)) {
                    $name = $user['email'] ?? 'Corredor(a)';
                }
            }
            // Intentar obtener avatar del usuario
            if (!empty($user['id'])) {
                try {
                    $db = (new \App\Config\Database())->getConnection();
                    if ($db) {
                        $uStmt = $db->prepare("SELECT avatar FROM users WHERE id = :uid LIMIT 1");
                        $uStmt->execute([':uid' => $user['id']]);
                        $avatar = $uStmt->fetchColumn() ?: null;
                    }
                } catch (\Exception $e) {}
            }
        }

        // Si no especificó rol o handle, asignar por defecto
        if (empty($roleTitle)) {
            $roleTitle = $user ? 'Comunidad FEMTRIBE' : 'Corredor(a)';
        }

        // Validaciones
        $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ||
                  (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) ||
                  isset($_POST['is_ajax']);

        if (empty($name)) {
            $msg = 'Por favor ingresa tu nombre.';
            if ($isAjax) return $this->json(['success' => false, 'message' => $msg], 422);
            $_SESSION['testimonial_error'] = $msg;
            $this->redirect('/nosotros#testimonios-section');
        }

        if ($rating < 1 || $rating > 5) {
            $msg = 'Por favor selecciona una calificación válida de 1 a 5 estrellas.';
            if ($isAjax) return $this->json(['success' => false, 'message' => $msg], 422);
            $_SESSION['testimonial_error'] = $msg;
            $this->redirect('/nosotros#testimonios-section');
        }

        if (empty($comment) || mb_strlen($comment) < 5) {
            $msg = 'Por favor escribe un comentario o testimonio de al menos 5 caracteres.';
            if ($isAjax) return $this->json(['success' => false, 'message' => $msg], 422);
            $_SESSION['testimonial_error'] = $msg;
            $this->redirect('/nosotros#testimonios-section');
        }

        if (mb_strlen($comment) > 1200) {
            $msg = 'El comentario no puede exceder los 1200 caracteres.';
            if ($isAjax) return $this->json(['success' => false, 'message' => $msg], 422);
            $_SESSION['testimonial_error'] = $msg;
            $this->redirect('/nosotros#testimonios-section');
        }

        $testimonialModel = new Testimonial();
        $newTestimonialData = [
            'user_id'    => $user['id'] ?? null,
            'name'       => strip_tags($name),
            'role_title' => strip_tags($roleTitle),
            'rating'     => $rating,
            'comment'    => strip_tags($comment),
            'avatar'     => $avatar,
            'is_approved'=> 1
        ];
        $ok = $testimonialModel->create($newTestimonialData);

        if ($ok) {
            $successMsg = '¡Muchas gracias! Tu testimonio y calificación han sido publicados con éxito.';
            if ($isAjax) {
                $stats = $testimonialModel->getRatingStats();
                return $this->json([
                    'success'     => true, 
                    'message'     => $successMsg,
                    'stats'       => $stats,
                    'testimonial' => array_merge($newTestimonialData, [
                        'created_at' => date('Y-m-d H:i:s')
                    ])
                ]);
            }
            $_SESSION['testimonial_success'] = $successMsg;
        } else {
            $errorMsg = 'Hubo un error al guardar tu testimonio. Por favor intenta de nuevo.';
            if ($isAjax) return $this->json(['success' => false, 'message' => $errorMsg], 500);
            $_SESSION['testimonial_error'] = $errorMsg;
        }

        $this->redirect('/nosotros#testimonios-section');
    }

    /**
     * API para obtener la lista de testimonios y estadísticas (JSON)
     */
    public function apiList() {
        $testimonialModel = new Testimonial();
        $this->json([
            'success' => true,
            'stats'   => $testimonialModel->getRatingStats(),
            'data'    => $testimonialModel->getAllApproved(50)
        ]);
    }
}
