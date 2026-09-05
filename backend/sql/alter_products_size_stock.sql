-- Agregar columna size_stock para guardar desglose de inventario por talla y por género (Hombre, Mujer, Niños)
ALTER TABLE `products` 
ADD COLUMN IF NOT EXISTS `size_stock` TEXT NULL AFTER `sizes`;

-- Agregar soporte de talla, género y color a order_items para registro detallado y descuento exacto
ALTER TABLE `order_items`
ADD COLUMN IF NOT EXISTS `size` VARCHAR(20) NULL AFTER `product_name`,
ADD COLUMN IF NOT EXISTS `gender` VARCHAR(20) NULL AFTER `size`,
ADD COLUMN IF NOT EXISTS `color` VARCHAR(50) NULL AFTER `gender`;

