<?php

class EmailConfig {
    // Configuración SMTP — todos los valores se leen desde .env vía getenv()
    // NO hardcodear credenciales aquí.

    const SMTP_HOST     = 'smtp.gmail.com';
    const SMTP_PORT     = 587;
    const SMTP_SECURE   = 'tls';
    const CHARSET       = 'UTF-8';
    const IS_HTML       = true;

    // ── Credenciales dinámicas (desde .env) ───────────────────────────────
    private static function initEnv(): void {
        if (!getenv('MAIL_PASS') && empty($_ENV['MAIL_PASS'])) {
            $envPath = __DIR__ . '/../.env';
            if (file_exists($envPath)) {
                $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    $line = trim($line);
                    if ($line === '' || str_starts_with($line, '#')) continue;
                    if (strpos($line, '=') !== false) {
                        [$k, $v] = explode('=', $line, 2);
                        $k = trim($k);
                        $v = trim($v, " \t\n\r\0\x0B\"'");
                        putenv("{$k}={$v}");
                        $_ENV[$k] = $v;
                        $_SERVER[$k] = $v;
                    }
                }
            }
        }
    }

    public static function getUsername(): string {
        self::initEnv();
        return getenv('MAIL_USER') ?: ($_ENV['MAIL_USER'] ?? ($_SERVER['MAIL_USER'] ?? 'femtribe25@gmail.com'));
    }

    public static function getPassword(): string {
        self::initEnv();
        return getenv('MAIL_PASS') ?: ($_ENV['MAIL_PASS'] ?? ($_SERVER['MAIL_PASS'] ?? 'vmzl libi wrji cjsi'));
    }

    public static function getFromEmail(): string {
        return self::getUsername();
    }

    public static function getFromName(): string {
        return getenv('MAIL_FROM_NAME') ?: 'FEMTRIBE';
    }

    // Compatibilidad con código legado que usa las constantes directamente
    // (se resuelven en tiempo de ejecución leyendo .env)
    public static function getSmtpUsername(): string {
        return self::getUsername();
    }

    public static function getSmtpPassword(): string {
        return self::getPassword();
    }

    // Alias estáticos para código que accede a SMTP_USERNAME como método
    public static function smtpUsername(): string { return self::getUsername(); }
    public static function smtpPassword(): string { return self::getPassword(); }

    public static function isConfigured(): bool {
        $pass = self::getPassword();
        return !empty($pass) && $pass !== 'app-password-here';
    }
}