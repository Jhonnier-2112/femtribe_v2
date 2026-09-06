<?php
namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class Registration {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        self::checkPaymentColumns();
    }

    /**
     * Obtiene el catálogo de etapas de carrera activas con precios vigentes (preventa/normal)
     */
    public static function getRaceStages(): array {
        if (class_exists('App\Models\Event')) {
            $stages = \App\Models\Event::getStages(1);
            if (!empty($stages)) {
                return $stages;
            }
        }
        try {
            $database = new Database();
            $db = $database->getConnection();
            $stmt = $db->query("SELECT id, name, slug, category_type, distance, COALESCE(presale_price, price) AS presale_price, price, description, is_active FROM race_stages WHERE is_active = 1 ORDER BY category_type ASC, id ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }

    public static ?string $lastErrorMessage = null;

    /**
     * Registra un participante a una o varias etapas de carrera
     */
    public static function create($data) {
        self::$lastErrorMessage = null;
        try {
            $database = new Database();
            $db = $database->getConnection();
            if (!$db) {
                self::$lastErrorMessage = "No se pudo conectar a la base de datos.";
                error_log("Registration::create() Error: " . self::$lastErrorMessage);
                return false;
            }

            // Normalizar RH de forma ultra robusta
            $rawRh = trim($data['rh'] ?? '');
            if (stripos($rawRh, '+') !== false || stripos($rawRh, 'pos') !== false) {
                $rh = '+';
            } elseif (stripos($rawRh, '-') !== false || stripos($rawRh, 'neg') !== false) {
                $rh = '-';
            } elseif (!empty($rawRh)) {
                $rh = substr($rawRh, 0, 10);
            } else {
                $rh = '+';
            }

            // Validar que si viene un user_id realmente exista en la tabla users para evitar violación de FK
            $userId = !empty($data['user_id']) ? (int)$data['user_id'] : null;
            if ($userId !== null) {
                try {
                    $uCheck = $db->prepare("SELECT id FROM users WHERE id = :uid LIMIT 1");
                    $uCheck->execute([':uid' => $userId]);
                    if (!$uCheck->fetch()) {
                        $userId = null;
                    }
                } catch (\Throwable $t) {
                    $userId = null;
                }
            }

            $sql = "INSERT INTO registrations (
                user_id, categoria_participante, modalidad_nino, etapas_seleccionadas, etapas_preventa, nombre_mascota, raza_mascota, talla_panolete_mascota,
                acudiente_nombre, acudiente_documento, nombres, apellidos, tipo_documento, numero_documento, 
                fecha_nacimiento, edad, genero, eps, grupo_sanguineo, rh, talla_camiseta_adulto, talla_camiseta_nino,
                direccion, municipio, departamento, email, telefono, 
                parentesco_emergencia, otro_parentesco, nombre_emergencia, 
                nombre_emergencia_alt, celular_emergencia, acepta_autorizacion, created_at,
                payment_status, payment_amount, order_number
            ) VALUES (
                :user_id, :categoria_participante, :modalidad_nino, :etapas_seleccionadas, :etapas_preventa, :nombre_mascota, :raza_mascota, :talla_panolete_mascota,
                :acudiente_nombre, :acudiente_documento, :nombres, :apellidos, :tipo_documento, :numero_documento, 
                :fecha_nacimiento, :edad, :genero, :eps, :grupo_sanguineo, :rh, :talla_camiseta_adulto, :talla_camiseta_nino,
                :direccion, :municipio, :departamento, :email, :telefono, 
                :parentesco_emergencia, :otro_parentesco, :nombre_emergencia, 
                :nombre_emergencia_alt, :celular_emergencia, :acepta_autorizacion, NOW(),
                :payment_status, :payment_amount, :order_number
            )";

            $etapas = is_array($data['etapas_seleccionadas'] ?? null) ? json_encode($data['etapas_seleccionadas']) : ($data['etapas_seleccionadas'] ?? '[]');

            // Determinar qué etapas están en preventa en el momento de la inscripción
            $etapasIds = is_array($data['etapas_seleccionadas'] ?? null) ? $data['etapas_seleccionadas'] : json_decode($data['etapas_seleccionadas'] ?? '[]', true);
            if (!is_array($etapasIds)) {
                $etapasIds = [$etapasIds];
            }
            
            $etapasPreventaIds = [];
            if (class_exists('App\Models\Event')) {
                $allStages = \App\Models\Event::getStages(1);
                $event = \App\Models\Event::getPrimaryEvent();
                foreach ($allStages as $stg) {
                    if (in_array((int)$stg['id'], $etapasIds)) {
                        if (\App\Models\Event::isStageInPresale($stg, $event)) {
                            $etapasPreventaIds[] = (int)$stg['id'];
                        }
                    }
                }
            }
            $etapasPreventa = json_encode($etapasPreventaIds);

            $nomEmergencia = !empty($data['nombre_emergencia']) 
                ? trim((string)$data['nombre_emergencia']) 
                : (!empty($data['nombre_emergencia_alt']) 
                    ? trim((string)$data['nombre_emergencia_alt']) 
                    : (!empty($data['acudiente_nombre']) ? trim((string)$data['acudiente_nombre']) : 'Contacto de Emergencia'));

            $nomEmergenciaAlt = !empty($data['nombre_emergencia_alt']) 
                ? trim((string)$data['nombre_emergencia_alt']) 
                : $nomEmergencia;

            $celEmergencia = !empty($data['celular_emergencia']) 
                ? trim((string)$data['celular_emergencia']) 
                : (!empty($data['telefono']) ? trim((string)$data['telefono']) : '0000000000');

            $insertData = [
                ':user_id' => $userId,
                ':categoria_participante' => $data['categoria_participante'] ?? 'adulto',
                ':modalidad_nino' => !empty($data['modalidad_nino']) ? substr($data['modalidad_nino'], 0, 30) : (($data['categoria_participante'] ?? '') === 'nino' ? (!empty($data['edad']) && (int)$data['edad'] < 8 ? 'acompanado' : 'solo') : null),
                ':etapas_seleccionadas' => is_array($data['etapas_seleccionadas'] ?? null) ? json_encode($data['etapas_seleccionadas']) : ($data['etapas_seleccionadas'] ?? '[]'),
                ':etapas_preventa' => $etapasPreventa,
                ':nombre_mascota' => !empty($data['nombre_mascota']) ? $data['nombre_mascota'] : null,
                ':raza_mascota' => !empty($data['raza_mascota']) ? $data['raza_mascota'] : null,
                ':talla_panolete_mascota' => !empty($data['talla_panolete_mascota']) ? substr($data['talla_panolete_mascota'], 0, 20) : null,
                ':acudiente_nombre' => !empty($data['acudiente_nombre']) ? $data['acudiente_nombre'] : null,
                ':acudiente_documento' => !empty($data['acudiente_documento']) ? $data['acudiente_documento'] : null,
                ':nombres' => $data['nombres'] ?? '',
                ':apellidos' => $data['apellidos'] ?? '',
                ':tipo_documento' => !empty($data['tipo_documento']) ? substr($data['tipo_documento'], 0, 50) : 'CC',
                ':numero_documento' => $data['numero_documento'] ?? '',
                ':fecha_nacimiento' => !empty($data['fecha_nacimiento']) ? $data['fecha_nacimiento'] : null,
                ':edad' => !empty($data['edad']) ? (int)$data['edad'] : null,
                ':genero' => !empty($data['genero']) ? substr($data['genero'], 0, 20) : null,
                ':eps' => !empty($data['eps']) ? substr($data['eps'], 0, 100) : null,
                ':grupo_sanguineo' => !empty($data['grupo_sanguineo']) ? substr($data['grupo_sanguineo'], 0, 20) : null,
                ':rh' => $rh,
                ':talla_camiseta_adulto' => !empty($data['talla_camiseta_adulto']) ? substr($data['talla_camiseta_adulto'], 0, 20) : null,
                ':talla_camiseta_nino' => !empty($data['talla_camiseta_nino']) ? substr($data['talla_camiseta_nino'], 0, 20) : null,
                ':direccion' => !empty($data['direccion']) ? substr($data['direccion'], 0, 255) : '',
                ':municipio' => !empty($data['municipio']) ? substr($data['municipio'], 0, 100) : 'Cali',
                ':departamento' => !empty($data['departamento']) ? substr($data['departamento'], 0, 100) : 'Valle del Cauca',
                ':email' => $data['email'] ?? '',
                ':telefono' => $data['telefono'] ?? '',
                ':parentesco_emergencia' => !empty($data['parentesco_emergencia']) ? substr($data['parentesco_emergencia'], 0, 80) : 'familiar',
                ':otro_parentesco' => !empty($data['otro_parentesco']) ? substr($data['otro_parentesco'], 0, 80) : null,
                ':nombre_emergencia' => substr($nomEmergencia, 0, 150),
                ':nombre_emergencia_alt' => substr($nomEmergenciaAlt, 0, 150),
                ':celular_emergencia' => substr($celEmergencia, 0, 30),
                ':acepta_autorizacion' => $data['acepta_autorizacion'] ?? 'si',
                ':payment_status' => $data['payment_status'] ?? 'pending',
                ':payment_amount' => $data['payment_amount'] ?? 0.00,
                ':order_number' => $data['order_number'] ?? null
            ];

            $stmt = $db->prepare($sql);
            if ($stmt->execute($insertData)) {
                return $db->lastInsertId();
            } else {
                $err = $stmt->errorInfo();
                error_log("Registration::create() execute failed: " . json_encode($err));
                self::$lastErrorMessage = \App\Services\ErrorFormatter::toUserFriendly($err[2] ?? 'Fallo al ejecutar la inserción', 'No fue posible guardar la información de la inscripción.');
                return false;
            }
            
        } catch (\Throwable $e) {
            error_log("Registration::create() Exception: " . $e->getMessage());
            self::$lastErrorMessage = \App\Services\ErrorFormatter::toUserFriendly($e, 'Ocurrió un inconveniente al registrar la inscripción.');
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM registrations WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAll() {
        try {
            // No se hace JOIN con events para evitar fallos cuando event_id es NULL
            $query = "SELECT r.* FROM registrations r ORDER BY r.created_at DESC, r.id DESC";
            $stmt = $this->conn->query($query);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows ?: [];
        } catch (PDOException $e) {
            error_log("Registration::getAll() Error: " . $e->getMessage());
            return [];
        }
    }

    public function countAll() {
        try {
            $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM registrations");
            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (PDOException $e) {
            return 0;
        }
    }

    public static function findByDocument($numero_documento) {
        try {
            $database = new Database();
            $db = $database->getConnection();
            
            $stmt = $db->prepare("SELECT * FROM registrations WHERE numero_documento = :numero_documento ORDER BY id DESC LIMIT 1");
            $stmt->execute([':numero_documento' => $numero_documento]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function findAllByDocument($numero_documento) {
        try {
            $database = new Database();
            $db = $database->getConnection();
            
            $stmt = $db->prepare("SELECT * FROM registrations WHERE numero_documento = :numero_documento");
            $stmt->execute([':numero_documento' => $numero_documento]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }

    public function validateData($data) {
        $errors = [];

        if (empty($data['nombres'])) {
            $errors[] = 'Los nombres son requeridos';
        }
        if (empty($data['apellidos'])) {
            $errors[] = 'Los apellidos son requeridos';
        }
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email válido es requerido';
        }
        if (empty($data['numero_documento'])) {
            $errors[] = 'El número de documento es requerido';
        }
        
        if (empty($data['telefono'])) {
            $errors[] = 'El teléfono es requerido';
        } else {
            $telefonoClean = preg_replace('/[^0-9]/', '', $data['telefono']);
            if (strlen($telefonoClean) !== 10 || strpos($telefonoClean, '3') !== 0) {
                $errors[] = 'El celular de contacto debe iniciar con 3 y tener 10 dígitos';
            }
        }

        if (empty($data['etapas_seleccionadas'])) {
            $errors[] = 'Debe seleccionar al menos una etapa para inscribirse';
        } else {
            $categoria = $data['categoria_participante'] ?? 'adulto';
            $selectedStages = $data['etapas_seleccionadas'] ?? [];
            if (!is_array($selectedStages)) {
                $selectedStages = [$selectedStages];
            }
            
            $allStages = self::getRaceStages();
            $stagesMap = [];
            foreach ($allStages as $stg) {
                $stagesMap[(int)$stg['id']] = $stg;
            }

            if ($categoria === 'adulto') {
                $selectedAdultOrAdicionalCount = 0;
                foreach ($selectedStages as $sid) {
                    if (isset($stagesMap[(int)$sid])) {
                        $catType = $stagesMap[(int)$sid]['category_type'] ?? '';
                        if ($catType === 'adulto' || $catType === 'adicional') {
                            $selectedAdultOrAdicionalCount++;
                        }
                    }
                }
                
                if ($selectedAdultOrAdicionalCount === 0) {
                    $errors[] = 'Debe seleccionar una etapa para la categoría Adulto o Kilometraje Adicional (5K o 10K)';
                } elseif ($selectedAdultOrAdicionalCount > 1) {
                    $errors[] = 'Un adulto solo se puede inscribir a 10K o 5K, pero no a los dos';
                }
            } else {
                $main3KCount = 0;
                $adicionalCount = 0;
                foreach ($selectedStages as $sid) {
                    if (isset($stagesMap[(int)$sid])) {
                        $catType = $stagesMap[(int)$sid]['category_type'] ?? '';
                        if ($catType === 'adicional') {
                            $adicionalCount++;
                        } else {
                            $main3KCount++;
                        }
                    }
                }

                if ($adicionalCount > 1) {
                    $errors[] = 'Solo puedes seleccionar un kilometraje adicional (5K o 10K, no ambos)';
                }
                if ($main3KCount > 1) {
                    $errors[] = 'Solo puedes seleccionar una carrera o etapa principal para tu inscripción en 3K';
                }
                if ($main3KCount === 0 && $adicionalCount === 0) {
                    $errors[] = 'Debe seleccionar una etapa para la categoría 3K o kilometraje adicional';
                }
            }

            // Validar si los cupos de las etapas seleccionadas están agotados
            if (class_exists('App\Models\Event')) {
                $allStages = \App\Models\Event::getStages(1);
                $stagesMap = [];
                foreach ($allStages as $stg) {
                    $stagesMap[(int)$stg['id']] = $stg;
                }

                foreach ($selectedStages as $sid) {
                    if (isset($stagesMap[(int)$sid])) {
                        $stg = $stagesMap[(int)$sid];
                        if (!empty($stg['is_sold_out'])) {
                            $errors[] = 'Los cupos para la etapa "' . $stg['name'] . '" se han agotado.';
                        }
                    }
                }
            }
        }

        // Validar que no se inscriba a 5K y 10K (ya sea en esta inscripción o combinada con previas)
        if (!empty($data['numero_documento']) && !empty($data['etapas_seleccionadas'])) {
            $currentStages = $data['etapas_seleccionadas'];
            if (!is_array($currentStages)) {
                $currentStages = [$currentStages];
            }
            
            $existingRegistrations = self::findAllByDocument($data['numero_documento']);
            $existingStageIds = [];
            foreach ($existingRegistrations as $reg) {
                if (($reg['payment_status'] ?? 'pending') === 'paid') {
                    $etapas = $reg['etapas_seleccionadas'];
                    if (!empty($etapas)) {
                        if (is_string($etapas)) {
                            $decoded = json_decode($etapas, true);
                            if (is_array($decoded)) {
                                foreach ($decoded as $id) {
                                    $existingStageIds[] = (int)$id;
                                }
                            } else {
                                $existingStageIds[] = (int)$etapas;
                            }
                        } elseif (is_array($etapas)) {
                            foreach ($etapas as $id) {
                                $existingStageIds[] = (int)$id;
                            }
                        }
                    }
                }
            }

            $allStages = self::getRaceStages();
            $stageDistances = [];
            $stageNames = [];
            foreach ($allStages as $stg) {
                $stageDistances[(int)$stg['id']] = $stg['distance'];
                $stageNames[(int)$stg['id']] = $stg['name'];
            }

            // Validar si ya se encuentra inscrito en exactamente la misma etapa
            foreach ($currentStages as $sid) {
                if (in_array((int)$sid, $existingStageIds)) {
                    $errors[] = "Ya existe una inscripción registrada con este documento para la etapa: " . ($stageNames[(int)$sid] ?? $sid);
                }
            }

            // Validar choque entre 5K y 10K
            $has5K = false;
            $has10K = false;
            $totalStageIds = array_unique(array_merge($currentStages, $existingStageIds));
            
            foreach ($totalStageIds as $sid) {
                $dist = $stageDistances[(int)$sid] ?? '';
                if ($dist === '5K') {
                    $has5K = true;
                } elseif ($dist === '10K') {
                    $has10K = true;
                }
            }

            if ($has5K && $has10K) {
                $errors[] = 'Un participante solo se puede inscribir a 10K o 5K, pero no a las dos distancias (se corren el mismo día). Sin embargo, sí te puedes inscribir a 3K y también a 5K o 10K.';
            }
        }

        $categoria = $data['categoria_participante'] ?? 'adulto';
        
        if (!empty($data['fecha_nacimiento'])) {
            try {
                $birthDate = new \DateTime($data['fecha_nacimiento']);
                $today = new \DateTime('now');
                $age = $today->diff($birthDate)->y;

                if ($categoria === 'adulto') {
                    if ($age < 11) {
                        $errors[] = 'La edad mínima para participar en 5K y 10K es de 11 años';
                    } elseif ($age >= 90) {
                        $errors[] = 'La edad debe ser menor a 90 años';
                    }
                } elseif ($categoria === 'nino') {
                    if ($age > 10) {
                        $errors[] = 'La categoría 3K KIDS es para niños de hasta 10 años. A partir de los 11 años deben inscribirse en 5K o 10K';
                    } elseif ($age < 2) {
                        $errors[] = 'La edad mínima sugerida para participar en 3K KIDS es de 2 años';
                    }

                    $modalidad = $data['modalidad_nino'] ?? ($age < 8 ? 'acompanado' : 'solo');
                    if ($age < 8 && $modalidad === 'solo') {
                        $errors[] = 'Los niños menores de 8 años deben correr acompañados obligatoriamente por un adulto';
                    }
                } else {
                    if ($age < 8) {
                        $errors[] = 'El guía o participante de 3K Pet debe tener al menos 8 años';
                    }
                }

                // Validar consistencia de tipo de documento y edad
                $docType = $data['tipo_documento'] ?? '';
                if (($docType === 'tarjeta_identidad' || $docType === 'registro_civil') && $age >= 18) {
                    $errors[] = 'El tipo de documento seleccionado es solo para menores de 18 años';
                } elseif ($docType === 'cedula_ciudadania' && $age < 18) {
                    $errors[] = 'La Cédula de Ciudadanía es para mayores de 18 años';
                }
            } catch (\Exception $e) {
                $errors[] = 'La fecha de nacimiento no tiene un formato válido';
            }
        } else {
            $errors[] = 'La fecha de nacimiento es requerida';
        }

        if ($categoria === 'nino') {
            $modalidad = $data['modalidad_nino'] ?? '';
            $childAge = !empty($data['edad']) ? (int)$data['edad'] : 0;
            if (empty($data['acudiente_nombre'])) {
                if ($childAge < 8 || $modalidad === 'acompanado') {
                    $errors[] = 'El nombre del adulto acompañante es obligatorio para 3K KIDS';
                } else {
                    $errors[] = 'El nombre del acudiente o tutor responsable que autoriza es obligatorio';
                }
            }
        }
        if ($categoria === 'nino' && empty($data['talla_camiseta_nino'])) {
            $errors[] = 'La talla de camiseta para el niño es obligatoria';
        }
        if ($categoria !== 'nino' && empty($data['talla_camiseta_adulto'])) {
            $errors[] = 'La talla de camiseta de adulto es obligatoria';
        }
        if ($categoria === 'mascota') {
            $isOnlyAdicional = false;
            $allStages = self::getRaceStages();
            $stagesMap = [];
            foreach ($allStages as $stg) {
                $stagesMap[(int)$stg['id']] = $stg;
            }
            $selectedStages = $data['etapas_seleccionadas'] ?? [];
            if (!is_array($selectedStages)) {
                $selectedStages = [$selectedStages];
            }
            if (!empty($selectedStages)) {
                $onlyAdicionalCheck = true;
                foreach ($selectedStages as $sid) {
                    if (isset($stagesMap[(int)$sid]) && ($stagesMap[(int)$sid]['category_type'] ?? '') !== 'adicional') {
                        $onlyAdicionalCheck = false;
                        break;
                    }
                }
                $isOnlyAdicional = $onlyAdicionalCheck;
            }

            if (!$isOnlyAdicional) {
                if (empty($data['nombre_mascota'])) {
                    $errors[] = 'El nombre de la mascota es obligatorio para la categoría Pet Run';
                }
                if (empty($data['talla_panolete_mascota'])) {
                    $errors[] = 'La talla de la pañoleta de la mascota es obligatoria';
                }
            }
        }

        if (($data['acepta_autorizacion'] ?? '') !== 'si') {
            $errors[] = 'Debe aceptar la autorización para participar';
        }

        return $errors;
    }

    /**
     * Asegura que existan las columnas de pago, datos del formulario y longitudes seguras en registrations
     */
    public static function checkPaymentColumns() {
        try {
            $database = new Database();
            $db = $database->getConnection();
            if (!$db) return;
            
            // Comprobar si existe la columna order_number
            $check = $db->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'registrations' AND COLUMN_NAME = 'order_number'");
            $exists = (int)$check->fetchColumn() > 0;
            
            if (!$exists) {
                $db->exec("ALTER TABLE registrations ADD COLUMN payment_status VARCHAR(30) NOT NULL DEFAULT 'pending', ADD COLUMN payment_amount DECIMAL(12,2) NOT NULL DEFAULT 0.00, ADD COLUMN order_number VARCHAR(50) NULL");
            }

            // Asegurar todas las columnas del formulario de inscripción
            try { $db->exec("ALTER TABLE registrations ADD COLUMN user_id INT DEFAULT NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations ADD COLUMN categoria_participante ENUM('adulto','nino','mascota') NOT NULL DEFAULT 'adulto'"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations ADD COLUMN etapas_seleccionadas TEXT DEFAULT NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations ADD COLUMN nombre_mascota VARCHAR(100) DEFAULT NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations ADD COLUMN raza_mascota VARCHAR(100) DEFAULT NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations ADD COLUMN talla_panolete_mascota VARCHAR(20) DEFAULT NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations ADD COLUMN acudiente_nombre VARCHAR(150) DEFAULT NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations ADD COLUMN acudiente_documento VARCHAR(30) DEFAULT NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations ADD COLUMN talla_camiseta_adulto VARCHAR(20) DEFAULT NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations ADD COLUMN talla_camiseta_nino VARCHAR(20) DEFAULT NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations ADD COLUMN modalidad_nino VARCHAR(30) DEFAULT NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations ADD COLUMN etapas_preventa TEXT DEFAULT NULL"); } catch (\Throwable $t) {}

            // Asegurar longitud adecuada de columnas críticas para evitar truncamientos
            try { $db->exec("ALTER TABLE registrations MODIFY COLUMN rh VARCHAR(20) NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations MODIFY COLUMN grupo_sanguineo VARCHAR(20) NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations MODIFY COLUMN tipo_documento VARCHAR(50) NOT NULL DEFAULT 'CC'"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations MODIFY COLUMN nombre_emergencia VARCHAR(150) NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations MODIFY COLUMN nombre_emergencia_alt VARCHAR(150) NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations MODIFY COLUMN celular_emergencia VARCHAR(50) NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE registrations MODIFY COLUMN parentesco_emergencia VARCHAR(80) NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE users MODIFY COLUMN rh VARCHAR(20) NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE users MODIFY COLUMN grupo_sanguineo VARCHAR(20) NULL"); } catch (\Throwable $t) {}
            try { $db->exec("ALTER TABLE users MODIFY COLUMN tipo_documento VARCHAR(50) NOT NULL DEFAULT 'CC'"); } catch (\Throwable $t) {}
        } catch (PDOException $e) {
            error_log("Registration::checkPaymentColumns() Error: " . $e->getMessage());
        }
    }

    /**
     * Actualiza el estado de pago de una inscripción por su número de orden
     */
    public static function updatePaymentStatusByOrder(string $orderNumber, string $paymentStatus): bool {
        try {
            $database = new Database();
            $db = $database->getConnection();
            $stmt = $db->prepare("UPDATE registrations SET payment_status = :status WHERE order_number = :order_num");
            return $stmt->execute([
                ':status' => $paymentStatus,
                ':order_num' => $orderNumber
            ]);
        } catch (PDOException $e) {
            error_log("Registration::updatePaymentStatusByOrder() Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Busca la inscripción asociada a un número de orden
     */
    public static function findByOrderNumber(string $orderNumber): ?array {
        try {
            $database = new Database();
            $db = $database->getConnection();
            $stmt = $db->prepare("SELECT * FROM registrations WHERE order_number = :order_number LIMIT 1");
            $stmt->execute([':order_number' => $orderNumber]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * Busca la inscripción mediante su ID único
     */
    public static function findById(int $id): ?array {
        try {
            $database = new Database();
            $db = $database->getConnection();
            $stmt = $db->prepare("SELECT * FROM registrations WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }
}
