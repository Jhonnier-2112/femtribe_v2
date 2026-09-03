<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\ChatbotService;

class ChatbotController extends Controller {

    /**
     * POST /api/chatbot
     * Body JSON: { "message": "..." }
     * Response JSON: { "reply": "...", "suggestions": [...], "action": {...} }
     */
    public function respond(): void {
        // Solo POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['error' => 'Método no permitido'], 405);
            return;
        }

        // Leer body JSON
        $body  = file_get_contents('php://input');
        $data  = json_decode($body, true);
        $msg   = trim($data['message'] ?? '');

        if ($msg === '') {
            $this->jsonResponse(['error' => 'Mensaje vacío'], 400);
            return;
        }

        // Limitar longitud
        $msg = mb_substr($msg, 0, 300);

        try {
            $service  = new ChatbotService();
            $response = $service->respond($msg);
            $this->jsonResponse($response);
        } catch (\Throwable $e) {
            error_log('[ChatbotController] Error: ' . $e->getMessage());
            $this->jsonResponse([
                'reply'       => '😕 Tuve un problema técnico. Por favor intenta de nuevo o escríbenos al WhatsApp.',
                'suggestions' => ['Contacto WhatsApp'],
            ]);
        }
    }

    // ─── Helper: responder JSON ─────────────────────────────────────────────
    private function jsonResponse(array $data, int $code = 200): void {
        http_response_code($code);
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}
