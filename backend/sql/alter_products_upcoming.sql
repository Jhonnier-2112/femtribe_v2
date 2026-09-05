-- Agregar columna is_upcoming para productos de exhibición previa / próximo lanzamiento
ALTER TABLE `products` 
ADD COLUMN `is_upcoming` TINYINT(1) NOT NULL DEFAULT 0 AFTER `is_offer`;
