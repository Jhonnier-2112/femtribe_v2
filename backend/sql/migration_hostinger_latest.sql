-- ==============================================================================
-- MIGRACIÓN DE BASE DE DATOS PARA HOSTINGER (FEMTRIBE)
-- ==============================================================================
-- Instrucciones:
-- 1. Entra a tu panel de Hostinger (hPanel).
-- 2. Ve a "Bases de datos" -> "phpMyAdmin" e ingresa a tu base de datos.
-- 3. Haz clic en la pestaña "SQL" en la barra superior.
-- 4. Copia y pega todo el contenido de este archivo y haz clic en "Continuar" / "Go".
-- ==============================================================================

-- 1. Soporte para productos "Próximamente" (is_upcoming)
ALTER TABLE `products` 
ADD COLUMN IF NOT EXISTS `is_upcoming` TINYINT(1) NOT NULL DEFAULT 0 AFTER `is_offer`;

-- 2. Soporte para desglose de inventario por talla y género (size_stock)
ALTER TABLE `products` 
ADD COLUMN IF NOT EXISTS `size_stock` TEXT NULL AFTER `sizes`;

-- 3. Soporte para colores y tallas generales si no existían
ALTER TABLE `products` 
ADD COLUMN IF NOT EXISTS `colors` VARCHAR(255) NULL AFTER `type`;

ALTER TABLE `products` 
ADD COLUMN IF NOT EXISTS `sizes` VARCHAR(255) NULL AFTER `colors`;

-- 4. Soporte para video e imágenes adicionales en productos
ALTER TABLE `products` 
ADD COLUMN IF NOT EXISTS `video` VARCHAR(255) DEFAULT NULL AFTER `image`;

ALTER TABLE `products` 
ADD COLUMN IF NOT EXISTS `images` TEXT DEFAULT NULL AFTER `video`;

-- 5. Soporte para detalle de talla, género y color en los ítems de órdenes
ALTER TABLE `order_items`
ADD COLUMN IF NOT EXISTS `size` VARCHAR(20) NULL AFTER `product_name`;

ALTER TABLE `order_items`
ADD COLUMN IF NOT EXISTS `gender` VARCHAR(20) NULL AFTER `size`;

ALTER TABLE `order_items`
ADD COLUMN IF NOT EXISTS `color` VARCHAR(50) NULL AFTER `gender`;

-- 6. Soporte para modalidad de niños en inscripciones de carrera (3K KIDS)
ALTER TABLE `registrations` 
ADD COLUMN IF NOT EXISTS `modalidad_nino` VARCHAR(30) DEFAULT NULL AFTER `categoria_participante`;

-- 7. Soporte para etapas preventa y datos de mascota
ALTER TABLE `registrations` 
ADD COLUMN IF NOT EXISTS `etapas_preventa` TEXT DEFAULT NULL;

ALTER TABLE `registrations` 
ADD COLUMN IF NOT EXISTS `nombre_mascota` VARCHAR(100) DEFAULT NULL;

ALTER TABLE `registrations` 
ADD COLUMN IF NOT EXISTS `raza_mascota` VARCHAR(100) DEFAULT NULL;

ALTER TABLE `registrations` 
ADD COLUMN IF NOT EXISTS `talla_panolete_mascota` VARCHAR(50) DEFAULT NULL;

-- 8. Asegurar que las columnas de emergencia permitan NULL para evitar errores de integridad
ALTER TABLE `registrations` MODIFY COLUMN `nombre_emergencia` VARCHAR(150) NULL;
ALTER TABLE `registrations` MODIFY COLUMN `nombre_emergencia_alt` VARCHAR(150) NULL;
ALTER TABLE `registrations` MODIFY COLUMN `celular_emergencia` VARCHAR(50) NULL;
ALTER TABLE `registrations` MODIFY COLUMN `parentesco_emergencia` VARCHAR(80) NULL;

-- 9. Límite de cupos preventa en etapas de carrera
ALTER TABLE `race_stages` 
ADD COLUMN IF NOT EXISTS `presale_slots_limit` INT(11) DEFAULT NULL;

-- 9. Tabla de reseñas/comentarios de productos (por si no existe)
CREATE TABLE IF NOT EXISTS `product_reviews` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `product_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `rating` INT NOT NULL CHECK (`rating` >= 1 AND `rating` <= 5),
    `comment` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
