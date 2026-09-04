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
    public static function getUsername(): string {
        return getenv('MAIL_USER') ?: 'femtribe25@gmail.com';
    }

    public static function getPassword(): string {
        return getenv('MAIL_PASS') ?: '';
    }

    public static function getFromEmail(): string {
        return getenv('MAIL_FROM_ADDRESS') ?: getenv('MAIL_USER') ?: 'femtribe25@gmail.com';
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