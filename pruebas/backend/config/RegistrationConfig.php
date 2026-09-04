<?php

class RegistrationConfig {
    
    /**
     * Control principal de inscripciones
     * 
     * Cambia este valor para habilitar/deshabilitar inscripciones:
     * - true: Inscripciones ABIERTAS
     * - false: Inscripciones CERRADAS
     */
    const INSCRIPCIONES_ABIERTAS = true;
    
    /**
     * Mensaje personalizado cuando las inscripciones están cerradas
     */
    const MENSAJE_INSCRIPCIONES_CERRADAS = "¡Gracias por tu interés!";
    
    const SUBMENSAJE_INSCRIPCIONES_CERRADAS = "Las inscripciones para la carrera <strong>CORRE CON FEMTRIBE</strong> han alcanzado el límite de 600 participantes y se encuentran temporalmente cerradas.";
    
    const MENSAJE_ADICIONAL = "Mantente atento a nuestras redes sociales, ya que podríamos habilitar cupos adicionales próximamente.";
    
    /**
     * Verifica si las inscripciones están abiertas
     */
    public static function inscripcionesAbiertas() {
        if (defined('ENABLE_REGISTRATIONS')) {
            return (bool)ENABLE_REGISTRATIONS;
        }
        $env = getenv('ENABLE_REGISTRATIONS') !== false ? getenv('ENABLE_REGISTRATIONS') : (getenv('INSCRIPCIONES_ABIERTAS') !== false ? getenv('INSCRIPCIONES_ABIERTAS') : null);
        if ($env !== null) {
            return filter_var($env, FILTER_VALIDATE_BOOLEAN);
        }
        return (bool)self::INSCRIPCIONES_ABIERTAS;
    }
    
    /**
     * Obtiene el mensaje cuando las inscripciones están cerradas
     */
    public static function getMensajeCerradas() {
        return [
            'titulo' => self::MENSAJE_INSCRIPCIONES_CERRADAS,
            'mensaje' => self::SUBMENSAJE_INSCRIPCIONES_CERRADAS,
            'adicional' => self::MENSAJE_ADICIONAL
        ];
    }
}