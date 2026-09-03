<?php
namespace App\Services;

use App\Models\Event;
use App\Models\Product;
use App\Config\Database;
use PDO;

class ChatbotService {

    private array $event    = [];
    private array $stages   = [];
    private array $products = [];

    public function __construct() {
        $this->event    = Event::getPrimaryEvent() ?? [];
        $this->stages   = Event::getStages(1);
        $this->loadProducts();
    }

    // ─── Carga rápida de productos activos ─────────────────────────────────
    private function loadProducts(): void {
        try {
            $db   = (new Database())->getConnection();
            $stmt = $db->query("SELECT name, type, price, sizes, gender FROM products WHERE is_active = 1 ORDER BY name ASC LIMIT 20");
            $this->products = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (\Exception $e) {
            $this->products = [];
        }
    }

    // ─── Punto de entrada principal ─────────────────────────────────────────
    public function respond(string $input): array {
        $msg  = strtolower(trim(strip_tags($input)));
        $msg  = $this->normalize($msg);

        // Detectar intención
        $intent = $this->detectIntent($msg);

        return match($intent) {
            'saludo'          => $this->iSaludo(),
            'precio'          => $this->iPrecio(),
            'fecha'           => $this->iFecha(),
            'lugar'           => $this->iLugar(),
            'inscripcion'     => $this->iInscripcion(),
            'cupos'           => $this->iCupos(),
            'kit'             => $this->iKit(),
            'mascota'         => $this->iMascota(),
            'nino'            => $this->iNino(),
            'producto'        => $this->iProductos(),
            'pago'            => $this->iPago(),
            'cuenta'          => $this->iCuenta(),
            'contrasena'      => $this->iContrasena(),
            'contacto'        => $this->iContacto(),
            'requisitos'      => $this->iRequisitos(),
            'distancias'      => $this->iDistancias(),
            'cancelar'        => $this->iCancelar(),
            'agradecimiento'  => $this->iAgradecimiento(),
            default           => $this->iDesconocido(),
        };
    }

    // ─── Normalizar texto ───────────────────────────────────────────────────
    private function normalize(string $s): string {
        $map = ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n',
                'à'=>'a','è'=>'e','ì'=>'i','ò'=>'o','ù'=>'u'];
        return strtr($s, $map);
    }

    // ─── Detectar intención ─────────────────────────────────────────────────
    private function detectIntent(string $msg): string {
        $intents = [
            'saludo'         => ['hola','buenas','buenos','hi','hey','buen dia','buenas tardes','buenas noches','saludos','ola'],
            'agradecimiento' => ['gracias','muchas gracias','grax','thank','thanks','genial','perfecto','excelente','ok gracias'],
            'precio'         => ['precio','costo','cuanto','vale','valor','cuanto cuesta','cuanto vale','tarifa','costo inscripcion','precio inscripcion'],
            'fecha'          => ['fecha','cuando','dia','horario','hora','que dia','que fecha'],
            'lugar'          => ['lugar','donde','ubicacion','direccion','parque','ricaurte','sitio','mapa'],
            'inscripcion'    => ['inscribir','inscripcion','registrar','participar','como me inscribo','como inscribirse','quiero participar','apuntarme'],
            'cupos'          => ['cupos','cuantos quedan','disponibles','hay cupo','lleno','capacidad','hay espacio','quedan cupos'],
            'kit'            => ['kit','dorsal','entrega','reclamar','donde recojo','reclamo','numero dorsal','peto'],
            'mascota'        => ['mascota','perro','gato','pet','can','peludo','correr con mascota'],
            'nino'           => ['nino','menor','kid','hijo','hija','infantil','acudiente','menor de edad'],
            'producto'       => ['producto','tienda','ropa','camiseta','licra','esqueleto','medias','comprar','talla','tallas','store'],
            'pago'           => ['pagar','pago','bancolombia','wompi','transferencia','metodo pago','como pago','tarjeta'],
            'cuenta'         => ['cuenta','login','registrarse','crear cuenta','iniciar sesion','perfil','usuario'],
            'contrasena'     => ['contrasena','olvide','recuperar','reset','cambiar contrasena'],
            'contacto'       => ['contacto','whatsapp','telefono','comunicarse','hablar','escribir','mensaje','numero'],
            'requisitos'     => ['requisito','documento','cedula','necesito','que necesito','que llevar','que traer'],
            'distancias'     => ['distancia','km','kilometros','kilometraje','5k','10k','etapa','modalidad'],
            'cancelar'       => ['cancelar','devolucion','reembolso','cancelacion','no puedo ir','baja'],
        ];

        foreach ($intents as $intent => $keywords) {
            foreach ($keywords as $kw) {
                if (str_contains($msg, $kw)) {
                    return $intent;
                }
            }
        }
        return 'desconocido';
    }

    // ─── RESPUESTAS ─────────────────────────────────────────────────────────

    private function iSaludo(): array {
        $nombre = $this->event['title'] ?? 'Corre con FemTribe';
        return [
            'reply' => "¡Hola! 👋 Bienvenido/a al asistente de **{$nombre}**.\n¿En qué te puedo ayudar hoy? Puedo contarte sobre precios, fechas, cupos, inscripciones y mucho más. 🏃‍♀️",
            'suggestions' => ['¿Cuánto cuesta?', '¿Cuándo es la carrera?', '¿Cómo me inscribo?', '¿Cuántos cupos quedan?'],
        ];
    }

    private function iAgradecimiento(): array {
        return [
            'reply' => "¡Con mucho gusto! 💚 Estamos para servirte. ¿Hay algo más en lo que te pueda ayudar?\n¡Nos vemos en la carrera! 🏆",
            'suggestions' => ['¿Cómo me inscribo?', '¿Cuándo es el evento?', 'Ver productos'],
        ];
    }

    private function iPrecio(): array {
        if (empty($this->stages)) {
            return ['reply' => 'Por el momento no tenemos información de precios disponible. Escríbenos al WhatsApp para confirmarlo. 📞', 'suggestions' => ['Contacto WhatsApp']];
        }

        $lines = [];
        foreach ($this->stages as $s) {
            if (!($s['is_active'] ?? true)) continue;
            $price        = number_format((float)($s['price'] ?? 0), 0, ',', '.');
            $presalePrice = number_format((float)($s['presale_price'] ?? 0), 0, ',', '.');
            $name         = $s['name'] ?? 'Etapa';
            $dist         = $s['distance'] ?? '';
            $inPresale    = $s['is_stage_presale_active'] ?? false;
            $tag          = $inPresale ? " 🔥 *Preventa activa*" : '';
            $lines[]      = "• **{$name}** ({$dist}): \${$price} COP{$tag}";
            if ($inPresale && (float)$s['presale_price'] > 0) {
                $lines[count($lines)-1] = "• **{$name}** ({$dist}): ~~\${$price}~~ → \${$presalePrice} COP 🔥 *Preventa*";
            }
        }

        $reply = "💰 **Precios de inscripción:**\n\n" . implode("\n", $lines);
        $reply .= "\n\n_Los precios son por persona. El pago se realiza en línea._";

        return [
            'reply'       => $reply,
            'suggestions' => ['¿Cómo me inscribo?', '¿Cuántos cupos quedan?', 'Métodos de pago'],
        ];
    }

    private function iFecha(): array {
        $event = $this->event;
        if (empty($event)) {
            return ['reply' => 'No encontré información de fecha en este momento. ¡Pronto confirmamos!', 'suggestions' => ['Contacto WhatsApp']];
        }

        $fecha = !empty($event['event_end_date'])
            ? $this->formatFecha($event['event_end_date'])
            : 'próximamente confirmada';

        $presaleEnd = !empty($event['presale_end_date'])
            ? "⚡ La **preventa** cierra el **" . $this->formatFecha($event['presale_end_date']) . "**.\n"
            : '';

        $reply = "📅 **Fecha del evento:**\n\n{$presaleEnd}🗓️ La carrera es el **{$fecha}**\n⏰ Hora de salida: **6:30 a.m.**\n📍 Lugar: " . ($event['location'] ?? 'Por confirmar');

        return [
            'reply'       => $reply,
            'suggestions' => ['¿Cuánto cuesta?', '¿Dónde es el evento?', 'Entrega de kits'],
        ];
    }

    private function iLugar(): array {
        $location = $this->event['location'] ?? 'Parque Biosaludable de Ricaurte';
        return [
            'reply' => "📍 **Ubicación del evento:**\n\n🏟️ **{$location}**\n\nRecuerda llegar con anticipación el día de la carrera. ¡La energía de la tribu te espera desde la salida! 💪",
            'suggestions' => ['¿Cuándo es?', 'Entrega de kits', '¿Cómo me inscribo?'],
        ];
    }

    private function iInscripcion(): array {
        return [
            'reply' => "🏃‍♀️ **¿Cómo inscribirse?**\n\n1️⃣ Ve a la página de inscripción\n2️⃣ Elige tu modalidad (adulto, niño o mascota)\n3️⃣ Selecciona la etapa/distancia\n4️⃣ Completa tus datos personales\n5️⃣ Realiza el pago en línea con Bancolombia/Wompi\n\n¡Y listo! Recibirás un correo de confirmación. 📧",
            'suggestions' => ['Ir a inscribirme', '¿Cuánto cuesta?', 'Modalidad mascota', 'Modalidad niño'],
            'action' => ['label' => '📝 Inscribirme ahora', 'url' => '/inscribirse'],
        ];
    }

    private function iCupos(): array {
        $event = $this->event;
        if (empty($event)) {
            return ['reply' => 'No puedo consultar cupos en este momento. Escríbenos por WhatsApp.', 'suggestions' => ['Contacto WhatsApp']];
        }

        $total      = (int)($event['total_slots'] ?? 0);
        $registrados = (int)($event['registered_count'] ?? 0);
        $disponibles = (int)($event['available_slots'] ?? 0);

        if ($total === 0) {
            return ['reply' => 'La información de cupos aún no está configurada. ¡Pronto actualizamos!', 'suggestions' => ['¿Cómo me inscribo?']];
        }

        $pct    = $total > 0 ? round(($registrados / $total) * 100) : 0;
        $emoji  = $pct >= 90 ? '🔴' : ($pct >= 70 ? '🟡' : '🟢');
        $estado = $pct >= 90 ? '¡Casi agotado!' : ($pct >= 70 ? 'Quedan pocos lugares' : 'Buen disponibilidad');

        $reply = "🎟️ **Cupos disponibles:**\n\n{$emoji} **{$disponibles} cupos disponibles** de {$total} totales\n📊 Ocupación: {$pct}% — {$estado}\n\n_¡No dejes pasar tu lugar en la tribu!_";

        // Detalle por etapa
        $stageLines = [];
        foreach ($this->stages as $s) {
            if (!($s['is_active'] ?? true)) continue;
            $disp = (int)($s['available_slots'] ?? 9999);
            $nm   = $s['name'] ?? 'Etapa';
            $dist = $s['distance'] ?? '';
            $st   = $disp === 9999 ? '✅ Disponible' : ($disp === 0 ? '❌ Agotado' : "✅ {$disp} cupos");
            $stageLines[] = "• {$nm} ({$dist}): {$st}";
        }
        if ($stageLines) {
            $reply .= "\n\n**Por etapa:**\n" . implode("\n", $stageLines);
        }

        return [
            'reply'       => $reply,
            'suggestions' => ['Inscribirme ahora', '¿Cuánto cuesta?', '¿Cuándo es?'],
            'action'      => ['label' => '📝 Inscribirme', 'url' => '/inscribirse'],
        ];
    }

    private function iKit(): array {
        return [
            'reply' => "🎁 **Entrega de kit y dorsal:**\n\n📅 **Fecha:** Sábado, un día antes del evento\n📍 **Lugar:** Parque Biosaludable de Ricaurte\n⏰ **Horario:** 8:00 AM a 7:00 PM\n\nPresenta tu número de inscripción o documento de identidad para retirar tu kit.",
            'suggestions' => ['¿Qué incluye el kit?', '¿Cuándo es la carrera?', '¿Dónde es?'],
        ];
    }

    private function iMascota(): array {
        return [
            'reply' => "🐾 **Modalidad Mascota:**\n\nPuedes correr con tu peludo favorito. Para inscribirlo necesitas:\n\n• Nombre de la mascota\n• Raza\n• Tu información como responsable\n\n¡La tribu es para todos! 🐕🏃‍♀️\n\n_Consulta el precio en la sección de inscripciones._",
            'suggestions' => ['¿Cuánto cuesta?', 'Inscribir mi mascota', '¿Cuántos cupos hay?'],
            'action'      => ['label' => '🐾 Inscribir mascota', 'url' => '/inscribirse'],
        ];
    }

    private function iNino(): array {
        return [
            'reply' => "👶 **Modalidad Niño/Menor:**\n\nLos menores de edad pueden participar con acudiente. Se requiere:\n\n• Datos del menor\n• Datos del acudiente/responsable\n• Autorización firmada\n\n¡Los más pequeños también hacen parte de la tribu! 🌱",
            'suggestions' => ['¿Cuánto cuesta?', 'Inscribir un niño', '¿Cuántos cupos hay?'],
            'action'      => ['label' => '👶 Inscribir menor', 'url' => '/inscribirse'],
        ];
    }

    private function iProductos(): array {
        if (empty($this->products)) {
            return [
                'reply'       => "🛍️ Tenemos una tienda con ropa y accesorios FemTribe.\n\n¡Visita nuestra tienda para ver todos los productos disponibles!",
                'suggestions' => ['Ver tienda'],
                'action'      => ['label' => '🛍️ Ver tienda', 'url' => '/productos'],
            ];
        }

        $lines = [];
        foreach (array_slice($this->products, 0, 5) as $p) {
            $price  = number_format((float)($p['price'] ?? 0), 0, ',', '.');
            $gender = match(strtolower($p['gender'] ?? '')) {
                'mujer', 'femenino' => '👩',
                'hombre', 'masculino' => '👨',
                default => '👕'
            };
            $lines[] = "• {$gender} **{$p['name']}** — \${$price} COP";
        }

        $total  = count($this->products);
        $shown  = count($lines);
        $reply  = "🛍️ **Productos disponibles:**\n\n" . implode("\n", $lines);
        if ($total > $shown) {
            $reply .= "\n\n_Y {$total} productos en total en nuestra tienda..._";
        }

        return [
            'reply'       => $reply,
            'suggestions' => ['Ver todos los productos', '¿Tienen mi talla?', 'Camisetas disponibles'],
            'action'      => ['label' => '🛍️ Ver tienda completa', 'url' => '/productos'],
        ];
    }

    private function iPago(): array {
        return [
            'reply' => "💳 **Métodos de pago:**\n\n✅ **Bancolombia** — Transferencia y botón de pago\n✅ **Tarjeta de crédito/débito** — Vía Wompi\n✅ **PSE** — Pagos en línea\n\nEl pago se realiza directamente en el proceso de inscripción. Es 100% seguro y en línea. 🔐",
            'suggestions' => ['Inscribirme ahora', '¿Cuánto cuesta?', '¿Cómo me inscribo?'],
        ];
    }

    private function iCuenta(): array {
        return [
            'reply' => "👤 **Cuenta de usuario:**\n\n• **Registrarse:** Crea tu cuenta gratis en /registro\n• **Iniciar sesión:** Accede en /login\n• **Google Sign-In:** Inicia sesión con tu cuenta de Google en un clic\n• **Perfil:** Consulta tus inscripciones y pedidos en /perfil",
            'suggestions' => ['Crear cuenta', 'Iniciar sesión', 'Olvidé mi contraseña'],
            'action'      => ['label' => '👤 Ir al login', 'url' => '/login'],
        ];
    }

    private function iContrasena(): array {
        return [
            'reply' => "🔒 **¿Olvidaste tu contraseña?**\n\nNo te preocupes, es fácil recuperarla:\n\n1️⃣ Ve a la página de recuperación\n2️⃣ Ingresa tu correo electrónico\n3️⃣ Revisa tu bandeja de entrada\n4️⃣ Sigue el enlace para crear nueva contraseña\n\n¡En minutos estarás de vuelta! ⏱️",
            'suggestions' => ['Recuperar contraseña'],
            'action'      => ['label' => '🔑 Recuperar contraseña', 'url' => '/forgot-password'],
        ];
    }

    private function iContacto(): array {
        $wa = getenv('WHATSAPP_BUSINESS_NUMBER') ?: '573104771933';
        $waLink = "https://wa.me/{$wa}";
        return [
            'reply' => "📱 **Contáctanos:**\n\n💬 **WhatsApp:** " . substr($wa, 2) . "\n📸 **Instagram:** @fem_tribe\n📘 **Facebook:** FemTribe\n\n¡Nuestro equipo estará feliz de ayudarte! 💚",
            'suggestions' => ['¿Cómo me inscribo?', '¿Cuándo es el evento?'],
            'action'      => ['label' => '💬 WhatsApp', 'url' => $waLink],
        ];
    }

    private function iRequisitos(): array {
        return [
            'reply' => "📋 **Requisitos para participar:**\n\n✅ Ser mayor de edad (o menor con acudiente)\n✅ Documento de identidad vigente\n✅ Inscripción pagada\n✅ Recoger kit el día anterior\n\n**El día de la carrera lleva:**\n• Tu dorsal/número\n• Ropa cómoda (negro o verde)\n• Hidratación\n• ¡Muchas ganas! 💪",
            'suggestions' => ['Inscribirme', 'Entrega de kits', '¿Cuánto cuesta?'],
        ];
    }

    private function iDistancias(): array {
        if (empty($this->stages)) {
            return ['reply' => 'Por el momento no tenemos información de distancias. ¡Pronto actualizamos!', 'suggestions' => ['Contacto WhatsApp']];
        }

        $lines = [];
        foreach ($this->stages as $s) {
            if (!($s['is_active'] ?? true)) continue;
            $name  = $s['name'] ?? 'Etapa';
            $dist  = $s['distance'] ?? '';
            $price = number_format((float)($s['active_price'] ?? $s['price'] ?? 0), 0, ',', '.');
            $cat   = ucfirst($s['category_type'] ?? 'adulto');
            $lines[] = "• 🏃 **{$name}** — {$dist} | {$cat} | \${$price} COP";
        }

        return [
            'reply'       => "🏅 **Distancias disponibles:**\n\n" . implode("\n", $lines),
            'suggestions' => ['¿Cuánto cuesta?', '¿Cuántos cupos quedan?', 'Inscribirme'],
        ];
    }

    private function iCancelar(): array {
        return [
            'reply' => "❓ **Cancelaciones y reembolsos:**\n\nPara consultar nuestra política de cancelaciones o solicitar un reembolso, comunícate directamente con nuestro equipo:\n\n📱 WhatsApp: 310 477 1933\n📸 Instagram: @fem_tribe\n\nAnalizaremos tu caso personalmente. 💚",
            'suggestions' => ['Contacto WhatsApp', 'Ver política'],
        ];
    }

    private function iDesconocido(): array {
        return [
            'reply' => "🤔 No entendí muy bien tu pregunta, pero puedo ayudarte con:\n\n• 💰 Precios e inscripciones\n• 📅 Fecha y lugar del evento\n• 🎟️ Cupos disponibles\n• 🛍️ Productos de la tienda\n• 📱 Contacto directo\n\n¿Sobre qué te gustaría saber más?",
            'suggestions' => ['¿Cuánto cuesta?', '¿Cuándo es?', '¿Cómo me inscribo?', 'Contacto'],
        ];
    }

    // ─── Helper: formato de fecha ───────────────────────────────────────────
    private function formatFecha(string $date): string {
        $ts   = strtotime($date);
        if (!$ts) return $date;
        $dias = ['domingo','lunes','martes','miércoles','jueves','viernes','sábado'];
        $meses = ['','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
        return $dias[date('w', $ts)] . ', ' . date('j', $ts) . ' de ' . $meses[(int)date('n', $ts)] . ' de ' . date('Y', $ts);
    }
}
