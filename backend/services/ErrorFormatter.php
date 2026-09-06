<?php
namespace App\Services;

class ErrorFormatter {

    /**
     * Traduce errores técnicos de SQL o excepciones del sistema a mensajes claros,
     * amables y orientados a la solución para el cliente o corredor.
     *
     * @param string|\Throwable|null $error
     * @param string $defaultMessage
     * @return string
     */
    public static function toUserFriendly(string|\Throwable|null $error, string $defaultMessage = "No fue posible procesar la solicitud en este momento. Por favor verifica la información e inténtalo de nuevo."): string {
        if ($error === null) {
            return $defaultMessage;
        }

        $rawMessage = ($error instanceof \Throwable) ? $error->getMessage() : (string)$error;
        $rawLower = strtolower($rawMessage);

        // 1. Violación de restricción única / Duplicados (1062 / SQLSTATE[23000])
        if (str_contains($rawLower, '23000') || str_contains($rawLower, '1062') || str_contains($rawLower, 'duplicate entry')) {
            if (str_contains($rawLower, 'numero_documento') || str_contains($rawLower, 'documento') || str_contains($rawLower, 'customer_document')) {
                return "Ya existe una inscripción o cuenta asociada a este número de documento. Si ya te registraste previamente, puedes verificar el estado de tu inscripción en la sección de consulta o comunicarte con nuestro soporte para asistirte.";
            }
            if (str_contains($rawLower, 'email') || str_contains($rawLower, 'correo')) {
                return "El correo electrónico ingresado ya se encuentra registrado. Si ya tienes una cuenta, por favor inicia sesión para continuar.";
            }
            if (str_contains($rawLower, 'order_number') || str_contains($rawLower, 'transaction_reference')) {
                return "Ocurrió una pequeña sincronización con el número de orden. Por favor vuelve a intentarlo en un momento.";
            }
            if (str_contains($rawLower, 'slug') || str_contains($rawLower, 'sku')) {
                return "Ya existe un registro con este código o nombre en el sistema.";
            }
            return "Ya existe un registro con los datos suministrados. Por favor verifica tu información o contáctanos si requieres ayuda.";
        }

        // 2. Error de clave foránea / Relación inexistente (1452 / SQLSTATE[23000])
        if (str_contains($rawLower, '1452') || str_contains($rawLower, 'foreign key constraint')) {
            return "No se pudo asociar la inscripción a la carrera. Por favor recarga la página e intenta nuevamente.";
        }

        // 3. Datos demasiado extensos para la columna (1406 / SQLSTATE[22001])
        if (str_contains($rawLower, '22001') || str_contains($rawLower, '1406') || str_contains($rawLower, 'data too long') || str_contains($rawLower, 'truncated')) {
            if (str_contains($rawLower, 'rh')) {
                return "El factor RH ingresado no es válido. Por favor selecciona + (Positivo) o - (Negativo).";
            }
            if (str_contains($rawLower, 'telefono') || str_contains($rawLower, 'celular')) {
                return "El número de teléfono o celular contiene demasiados dígitos. Por favor verifica que tenga 10 números.";
            }
            return "Uno de los campos supera la longitud máxima permitida. Por favor reduce la longitud del texto ingresado (como nombres, dirección o notas).";
        }

        // 4. Campos requeridos o nulos (1364 / 1048 / SQLSTATE[HY000])
        if (str_contains($rawLower, '1364') || str_contains($rawLower, '1048') || str_contains($rawLower, 'cannot be null') || str_contains($rawLower, "doesn't have a default value")) {
            return "Por favor asegúrate de diligenciar todos los campos obligatorios del formulario antes de continuar.";
        }

        // 5. Límite de conexiones o servidor ocupado (1226 / max_connections_per_hour)
        if (str_contains($rawLower, '1226') || str_contains($rawLower, 'max_connections') || str_contains($rawLower, 'exceeded')) {
            return "Nuestros servidores están experimentando una alta demanda de inscripciones en este momento. Por favor espera unos segundos y vuelve a presionar el botón.";
        }

        // 6. Problema temporal de conexión con el motor de base de datos (2002 / 1045 / Connection refused)
        if (str_contains($rawLower, 'connection failed') || str_contains($rawLower, 'access denied') || str_contains($rawLower, '2002') || str_contains($rawLower, 'server has gone away')) {
            return "Estamos teniendo una interrupción momentánea de conexión con la base de datos. Por favor inténtalo de nuevo en unos momentos.";
        }

        // 7. Si el mensaje es una cadena que ya es amigable (no contiene tecnicismos de SQL ni de programación)
        $technicalIndicators = [
            'sqlstate', 'error sql:', 'syntax error', 'pdoexception', 'query failed',
            'select ', 'insert into', 'update ', 'delete from', 'table ', 'column ',
            'stack trace:', 'fatal error', 'warning:', 'undefined variable', 'uncaught'
        ];

        $isTechnical = false;
        foreach ($technicalIndicators as $indicator) {
            if (str_contains($rawLower, $indicator)) {
                $isTechnical = true;
                break;
            }
        }

        if (!$isTechnical && mb_strlen(trim($rawMessage)) > 3) {
            return $rawMessage;
        }

        return $defaultMessage;
    }
}
