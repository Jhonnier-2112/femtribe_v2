<?php
namespace App\Config;

use PDO;
use PDOException;

class Database {
    private $host;
    private $port;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        // Cargar configuración si no está cargada
        if (!defined('DB_HOST')) {
            require_once __DIR__ . '/config.php';
        }
        
        $this->host     = DB_HOST;
        $this->port     = defined('DB_PORT') ? DB_PORT : '3306';
        $this->db_name  = DB_NAME;
        $this->username = DB_USER;
        $this->password = DB_PASS;
    }

    public function getConnection() {
        if ($this->conn !== null) {
            return $this->conn;
        }

        $mampSocket = '/Applications/MAMP/tmp/mysql/mysql.sock';
        $host = $_SERVER['HTTP_HOST'] ?? '';
        $isLocal = (defined('APP_ENV') && APP_ENV === 'development') ||
                   empty($host) ||
                   (bool)preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/', $host);

        // Si estamos en entorno local de MAMP, intentar primero la conexión por socket local
        if ($isLocal && file_exists($mampSocket)) {
            $localDbs = array_unique(['fentribe', $this->db_name, 'u266057107_femtribe_bd', 'runner_db']);
            foreach ($localDbs as $ldb) {
                try {
                    $dsn = "mysql:unix_socket={$mampSocket};dbname={$ldb};charset=utf8mb4";
                    $this->conn = new PDO($dsn, 'root', 'root', [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_TIMEOUT => 2
                    ]);
                    $this->conn->exec("SET NAMES utf8mb4");
                    return $this->conn;
                } catch (PDOException $ex) {
                    // Seguir intentando
                }
            }
        }

        // Intento estándar con host y credenciales del entorno
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db_name};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_TIMEOUT => 3
            ]);
            $this->conn->exec("SET NAMES utf8mb4");
            return $this->conn;

        } catch (PDOException $e) {
            // Fallback si la conexión remota fue bloqueada (ej: max_connections_per_hour) y existe MAMP local
            if (file_exists($mampSocket)) {
                $localDbs = ['fentribe', 'u266057107_femtribe_bd', $this->db_name, 'runner_db'];
                foreach ($localDbs as $ldb) {
                    try {
                        $dsn = "mysql:unix_socket={$mampSocket};dbname={$ldb};charset=utf8mb4";
                        $this->conn = new PDO($dsn, 'root', 'root', [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        ]);
                        $this->conn->exec("SET NAMES utf8mb4");
                        return $this->conn;
                    } catch (PDOException $mampFallbackEx) {}
                }
            }

            if (defined('APP_DEBUG') && APP_DEBUG) {
                error_log("Database::getConnection() - Error de conexión: " . $e->getMessage());
                echo "Error de conexión: " . $e->getMessage();
            } else {
                error_log("Database connection failed: " . $e->getMessage());
                echo "Error de conexión a la base de datos.";
            }
        }

        return $this->conn;
    }
}

