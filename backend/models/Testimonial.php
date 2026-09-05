<?php
namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class Testimonial {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->ensureTable();
    }

    /**
     * Asegura que la tabla de testimonios exista y tenga los registros base
     */
    public function ensureTable(): void {
        if (!$this->conn) return;

        try {
            $sql = "CREATE TABLE IF NOT EXISTS testimonials (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NULL,
                name VARCHAR(150) NOT NULL,
                role_title VARCHAR(150) NULL DEFAULT 'Corredor(a)',
                rating TINYINT UNSIGNED NOT NULL DEFAULT 5,
                comment TEXT NOT NULL,
                avatar VARCHAR(255) NULL,
                is_approved TINYINT(1) NOT NULL DEFAULT 1,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_approved (is_approved),
                INDEX idx_created (created_at)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            
            $this->conn->exec($sql);

            // Verificar si la tabla está vacía para insertar testimonios iniciales
            $countStmt = $this->conn->query("SELECT COUNT(*) FROM testimonials");
            $total = (int)$countStmt->fetchColumn();

            if ($total === 0) {
                $seedSql = "INSERT INTO testimonials (name, role_title, rating, comment, avatar, is_approved, created_at) VALUES 
                ('Karen Guarnizo', '@karengg17', 5, 'FEMTRIBE cambió mi vida. Gracias a esta comunidad, he logrado completar mi primera Media Maratón y he conocido personas maravillosas que me inspiran cada día.', 'assets/img/karen.png', 1, '2026-08-15 10:00:00'),
                ('Jairo Caballero', '@caballerojairoandres', 5, 'Gracias a la tribu recuperé la constancia. En esta tribu aprendí que no entreno solo. Aquí todos sumamos, nos apoyamos y crecemos juntos, sin importar las diferencias.', 'assets/img/jairo.png', 1, '2026-08-20 14:30:00'),
                ('Andrea Diaz', '@andreadiaz123', 5, 'Como principiante, encontré en FEMTRIBE el apoyo perfecto para comenzar a correr. Los entrenadores son increíbles y la comunidad te hace sentir como en casa.', 'assets/img/andrea.png', 1, '2026-08-28 09:15:00')";
                $this->conn->exec($seedSql);
            }
        } catch (PDOException $e) {
            error_log("Testimonial::ensureTable Error: " . $e->getMessage());
        }
    }

    /**
     * Guarda un nuevo testimonio / comentario de la página
     */
    public function create(array $data): bool {
        if (!$this->conn) return false;

        try {
            $sql = "INSERT INTO testimonials (user_id, name, role_title, rating, comment, avatar, is_approved, created_at)
                    VALUES (:user_id, :name, :role_title, :rating, :comment, :avatar, :is_approved, NOW())";
            
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':user_id'     => !empty($data['user_id']) ? (int)$data['user_id'] : null,
                ':name'        => trim($data['name']),
                ':role_title'  => !empty($data['role_title']) ? trim($data['role_title']) : 'Corredor(a)',
                ':rating'      => max(1, min(5, (int)($data['rating'] ?? 5))),
                ':comment'     => trim($data['comment']),
                ':avatar'      => !empty($data['avatar']) ? trim($data['avatar']) : null,
                ':is_approved' => isset($data['is_approved']) ? (int)$data['is_approved'] : 1
            ]);
        } catch (PDOException $e) {
            error_log("Testimonial::create Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtiene los testimonios aprobados ordenados cronológicamente
     */
    public function getAllApproved(int $limit = 50): array {
        if (!$this->conn) return [];

        try {
            $sql = "SELECT id, user_id, name, role_title, rating, comment, avatar, created_at
                    FROM testimonials
                    WHERE is_approved = 1
                    ORDER BY created_at DESC
                    LIMIT :lim";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            error_log("Testimonial::getAllApproved Error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Estadísticas generales de calificación de la página
     */
    public function getRatingStats(): array {
        if (!$this->conn) {
            return ['average' => 5.0, 'total' => 0, 'breakdown' => [5=>0, 4=>0, 3=>0, 2=>0, 1=>0]];
        }

        try {
            $sql = "SELECT 
                        COUNT(*) as total, 
                        AVG(rating) as avg_rating,
                        SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as star5,
                        SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as star4,
                        SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as star3,
                        SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as star2,
                        SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as star1
                    FROM testimonials 
                    WHERE is_approved = 1";
            $stmt = $this->conn->query($sql);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && (int)$row['total'] > 0) {
                return [
                    'average' => round((float)$row['avg_rating'], 1),
                    'total' => (int)$row['total'],
                    'breakdown' => [
                        5 => (int)$row['star5'],
                        4 => (int)$row['star4'],
                        3 => (int)$row['star3'],
                        2 => (int)$row['star2'],
                        1 => (int)$row['star1']
                    ]
                ];
            }
        } catch (PDOException $e) {
            error_log("Testimonial::getRatingStats Error: " . $e->getMessage());
        }

        return ['average' => 5.0, 'total' => 0, 'breakdown' => [5=>0, 4=>0, 3=>0, 2=>0, 1=>0]];
    }
}
