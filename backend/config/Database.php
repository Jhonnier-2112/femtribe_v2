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

    /**
     * Instancia única compartida (Singleton) durante todo el ciclo de vida de la petición HTTP.
     * Evita abrir 10 a 15 conexiones distintas a MySQL por cada recarga de página,
     * reduciendo en más del 90% el consumo del límite 'max_connections_per_hour' (500) de Hostinger.
     */
    private static ?PDO $sharedConn = null;

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

    /**
     * Obtiene la conexión PDO activa o crea una nueva reutilizable.
     */
    public function getConnection(): ?PDO {
        // 1. Reutilizar la conexión ya establecida si sigue viva
        if (self::$sharedConn !== null) {
            try {
                $status = self::$sharedConn->getAttribute(PDO::ATTR_SERVER_INFO);
                if ($status !== false) {
                    return self::$sharedConn;
                }
            } catch (\Throwable $t) {
                self::$sharedConn = null;
            }
        }

        $mampSocket = '/Applications/MAMP/tmp/mysql/mysql.sock';

        // 2. Si estamos en un Mac con MAMP (entorno local de desarrollo), conectar SIEMPRE
        // al socket local de MAMP para NUNCA consumir el límite de 500 conexiones de Hostinger.
        if (file_exists($mampSocket)) {
            $localDbs = array_unique(['fentribe', $this->db_name, 'u266057107_femtribe_bd', 'runner_db']);
            foreach ($localDbs as $ldb) {
                try {
                    $dsn = "mysql:unix_socket={$mampSocket};dbname={$ldb};charset=utf8mb4";
                    $conn = new PDO($dsn, 'root', 'root', [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_TIMEOUT            => 2
                    ]);
                    $conn->exec("SET NAMES utf8mb4");
                    self::$sharedConn = $conn;
                    return self::$sharedConn;
                } catch (PDOException $ex) {
                    // Continuar con la siguiente base de datos local
                }
            }
        }

        // 3. Estrategia de conexión en Producción (Hostinger)
        // En Hostinger, 'srv628.hstgr.io' es la interfaz externa limitada a 500 conex/hora.
        // Si el código se ejecuta en un servidor Linux (Hostinger), conectar a 'localhost' o '127.0.0.1'
        // usa el socket interno de Hostinger y NO consume la cuota remota externa.
        $hostsToTry = [];
        if (PHP_OS_FAMILY === 'Linux') {
            $hostsToTry[] = 'localhost';
            $hostsToTry[] = '127.0.0.1';
            if ($this->host !== 'localhost' && $this->host !== '127.0.0.1') {
                $hostsToTry[] = $this->host;
            }
        } else {
            $hostsToTry[] = $this->host;
            if ($this->host !== 'localhost' && $this->host !== '127.0.0.1') {
                $hostsToTry[] = 'localhost';
                $hostsToTry[] = '127.0.0.1';
            }
        }
        $hostsToTry = array_unique($hostsToTry);

        $lastException = null;

        foreach ($hostsToTry as $targetHost) {
            try {
                $dsn = "mysql:host={$targetHost};port={$this->port};dbname={$this->db_name};charset=utf8mb4";
                $conn = new PDO($dsn, $this->username, $this->password, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_TIMEOUT            => 3
                ]);
                $conn->exec("SET NAMES utf8mb4");
                self::$sharedConn = $conn;
                return self::$sharedConn;
            } catch (PDOException $e) {
                $lastException = $e;
                // Si el error es 1226 (max_connections_per_hour), probar inmediatamente el siguiente host
                continue;
            }
        }

        // 4. Último recurso si existe MAMP local
        if (file_exists($mampSocket)) {
            $localDbs = ['fentribe', 'u266057107_femtribe_bd', $this->db_name, 'runner_db'];
            foreach ($localDbs as $ldb) {
                try {
                    $dsn = "mysql:unix_socket={$mampSocket};dbname={$ldb};charset=utf8mb4";
                    $conn = new PDO($dsn, 'root', 'root', [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    ]);
                    $conn->exec("SET NAMES utf8mb4");
                    self::$sharedConn = $conn;
                    return self::$sharedConn;
                } catch (PDOException $mampFallbackEx) {}
            }
        }

        // Si fallaron todos los intentos, registrar en log sin contaminar salida HTTP
        if ($lastException) {
            error_log("Database connection failed: " . $lastException->getMessage());
        }

        return null;
    }
}
