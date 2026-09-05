<?php
namespace App\Services;

class BancolombiaPaymentService {
    private $publicKey;
    private $privateKey;
    private $integritySecret;
    private $eventsSecret;
    private $environment;
    private $baseUrl;

    public function __construct() {
        if (!defined('BANCOLOMBIA_WOMPI_PUBLIC_KEY')) {
            require_once __DIR__ . '/../config/config.php';
        }

        $this->publicKey = trim((string)(defined('BANCOLOMBIA_WOMPI_PUBLIC_KEY') ? BANCOLOMBIA_WOMPI_PUBLIC_KEY : ''));
        $this->privateKey = trim((string)(defined('BANCOLOMBIA_WOMPI_PRIVATE_KEY') ? BANCOLOMBIA_WOMPI_PRIVATE_KEY : ''));
        $this->integritySecret = trim((string)(defined('BANCOLOMBIA_WOMPI_INTEGRITY_SECRET') ? BANCOLOMBIA_WOMPI_INTEGRITY_SECRET : ''));
        $this->eventsSecret = trim((string)(defined('BANCOLOMBIA_WOMPI_EVENTS_SECRET') ? BANCOLOMBIA_WOMPI_EVENTS_SECRET : ''));

        // Detección inteligente del entorno (Producción vs Sandbox)
        $configuredEnv = defined('BANCOLOMBIA_WOMPI_ENV') ? strtolower(trim(BANCOLOMBIA_WOMPI_ENV)) : 'sandbox';
        $isProd = false;

        if ($configuredEnv === 'production' || $configuredEnv === 'prod') {
            $isProd = true;
        } elseif (str_starts_with($this->publicKey, 'pub_prod_') || str_starts_with($this->privateKey, 'prv_prod_')) {
            // Si las llaves inician con pub_prod_ o prv_prod_, forzar producción independientemente de .env
            $isProd = true;
        } elseif (isset($_GET['env']) && $_GET['env'] === 'prod') {
            $isProd = true;
        }

        $this->environment = $isProd ? 'production' : 'sandbox';
        $this->baseUrl = $isProd ? 'https://production.wompi.co/v1' : 'https://sandbox.wompi.co/v1';
    }

    /**
     * Retorna el entorno activo ('production' o 'sandbox')
     */
    public function getEnvironment(): string {
        return $this->environment;
    }

    /**
     * Retorna la URL base activa de Wompi
     */
    public function getBaseUrl(): string {
        return $this->baseUrl;
    }

    /**
     * Genera la firma de integridad SHA-256 para transacciones de Bancolombia / Wompi
     * Fórmula: SHA256(Referencia + MontoEnCentavos + Moneda + SecretoDeIntegridad)
     */
    public function generateIntegritySignature(string $reference, float $amount, string $currency = 'COP'): string {
        $amountInCents = (int)round($amount * 100);
        $concatenated = $reference . $amountInCents . $currency . $this->integritySecret;
        return hash('sha256', $concatenated);
    }

    /**
     * Prepara la configuración del checkout y widget de pago de Bancolombia
     */
    public function prepareCheckoutPayload(array $orderData): array {
        $reference = $orderData['order_number'];
        $amount = floatval($orderData['total']);
        $amountInCents = (int)round($amount * 100);
        $currency = 'COP';
        $signature = $this->generateIntegritySignature($reference, $amount, $currency);

        $host = $_SERVER['HTTP_HOST'] ?? '';
        $isLocal = (bool)preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/', $host);
        if ($isLocal && !empty($host)) {
            $redirectBase = 'http://' . $host . '/payment/response';
        } else {
            $baseUrl = defined('BASE_URL') ? BASE_URL : 'https://femtribe.com.co';
            $redirectBase = rtrim($baseUrl, '/') . '/payment/response';
        }

        // Asegurar que la URL de retorno siempre conserve la referencia de la orden
        $redirectUrl = $redirectBase . (strpos($redirectBase, '?') === false ? '?' : '&') . 'reference=' . urlencode($reference);

        return [
            'publicKey' => $this->publicKey,
            'currency' => $currency,
            'amountInCents' => $amountInCents,
            'amountFormatted' => number_format($amount, 2, ',', '.'),
            'reference' => $reference,
            'signature' => $signature,
            'redirectUrl' => $redirectUrl,
            'environment' => $this->environment,
            'customerData' => [
                'email' => $orderData['customer_email'],
                'fullName' => $orderData['customer_name'],
                'phoneNumber' => $orderData['customer_phone'],
                'legalId' => $orderData['customer_document'],
                'legalIdType' => 'CC'
            ]
        ];
    }

    /**
     * Consulta el estado de una transacción mediante su ID en la API de Bancolombia / Wompi.
     * Incluye fallback automático entre entornos (producción <-> sandbox) y respaldo entre llave privada y pública.
     */
    public function getTransactionStatus(string $transactionId): ?array {
        $cleanId = trim($transactionId);
        if (empty($cleanId)) {
            return null;
        }

        // Definir orden de URLs a probar: primero el entorno detectado, luego el alternativo
        $urlsToTry = [$this->baseUrl];
        $altUrl = ($this->baseUrl === 'https://production.wompi.co/v1') 
            ? 'https://sandbox.wompi.co/v1' 
            : 'https://production.wompi.co/v1';
        $urlsToTry[] = $altUrl;

        // Llaves a probar en orden de prioridad
        $keysToTry = array_filter([$this->privateKey, $this->publicKey]);

        foreach ($urlsToTry as $baseUrl) {
            $url = $baseUrl . '/transactions/' . urlencode($cleanId);

            foreach ($keysToTry as $authKey) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Authorization: Bearer ' . $authKey,
                    'Content-Type: application/json',
                    'Accept: application/json'
                ]);
                curl_setopt($ch, CURLOPT_TIMEOUT, 12);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $curlErr = curl_error($ch);
                curl_close($ch);

                if ($httpCode === 200 && $response) {
                    $json = json_decode($response, true);
                    if (isset($json['data']) && is_array($json['data'])) {
                        return $json['data'];
                    }
                }

                if ($curlErr) {
                    error_log("[BancolombiaPaymentService] cURL error consultando {$url}: {$curlErr}");
                }
            }

            // Intento sin Bearer token (el endpoint público de transacciones de Wompi permite consultar el estado)
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Accept: application/json'
            ]);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200 && $response) {
                $json = json_decode($response, true);
                if (isset($json['data']) && is_array($json['data'])) {
                    return $json['data'];
                }
            }
        }

        return null;
    }

    /**
     * Valida la firma checksum recibida en el Webhook de eventos asíncronos
     * Utiliza la lista dinámica de propiedades de Wompi ('signature.properties')
     */
    public function isValidWebhookChecksum(array $eventPayload, string $checksumHeader): bool {
        if (empty($eventPayload['data']['transaction']) || empty($eventPayload['timestamp'])) {
            return false;
        }

        $tx = $eventPayload['data']['transaction'];
        $timestamp = $eventPayload['timestamp'];

        // Si el payload especifica las propiedades que componen la firma, usarlas en el orden exacto
        $properties = $eventPayload['signature']['properties'] ?? [
            'transaction.id',
            'transaction.status',
            'transaction.amount_in_cents'
        ];

        $concatenated = '';
        foreach ($properties as $prop) {
            $parts = explode('.', $prop);
            $val = $eventPayload['data'] ?? [];
            foreach ($parts as $part) {
                if (is_array($val) && array_key_exists($part, $val)) {
                    $val = $val[$part];
                } else {
                    $val = '';
                }
            }
            $concatenated .= (string)$val;
        }

        $concatenated .= (string)$timestamp . $this->eventsSecret;
        $calculatedHash = hash('sha256', $concatenated);

        $checksumToCompare = trim(strtolower($checksumHeader));
        if (empty($checksumToCompare) && !empty($eventPayload['signature']['checksum'])) {
            $checksumToCompare = trim(strtolower($eventPayload['signature']['checksum']));
        }

        return !empty($checksumToCompare) && hash_equals(strtolower($calculatedHash), $checksumToCompare);
    }
}

