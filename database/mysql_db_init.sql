-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS ukol;
USE ukol;

-- Crear la tabla Order
CREATE TABLE IF NOT EXISTS `Order` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `customer_id` INT NOT NULL,
    `creation_date` DATETIME NOT NULL,
    `total_amount` DECIMAL(10, 2) NOT NULL,
    `currency` VARCHAR(3) NOT NULL,
    `status` VARCHAR(15) NOT NULL,
    `payment_type` VARCHAR(50),
    `billing_address` VARCHAR(255),
    `shipping_address` VARCHAR(255),
    INDEX `idx_customer` (`customer_id`),
    INDEX `idx_creation_date` (`creation_date`),
    INDEX `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Crear la tabla OrderItem
CREATE TABLE IF NOT EXISTS `OrderItem` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `total_price` DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (`order_id`) REFERENCES `Order`(`id`) ON DELETE CASCADE,
    INDEX `idx_order_id` (`order_id`),
    INDEX `idx_product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Crear usuario si no existe
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON `ukol`.* TO 'user'@'%';

-- Si deseas que también tenga acceso a cualquier base de datos que se cree en el futuro
GRANT ALL PRIVILEGES ON *.* TO 'user'@'%' WITH GRANT OPTION;

-- Aplicar los cambios de privilegios
FLUSH PRIVILEGES;

-- Insertar órdenes en la tabla 'Order'
INSERT INTO `Order` (customer_id, creation_date, total_amount, currency, status, payment_type, billing_address, shipping_address)
VALUES
(101, NOW(), 120.50, 'USD', 'completed', 'Credit Card', '1234 Elm St', '1234 Elm St'),
(102, NOW(), 180.75, 'USD', 'pending', 'PayPal', '2345 Oak St', '2345 Oak St'),
(103, NOW(), 95.20, 'USD', 'completed', 'Debit Card', '3456 Pine St', '3456 Pine St'),
(104, NOW(), 200.00, 'USD', 'shipped', 'Credit Card', '4567 Maple St', '4567 Maple St'),
(105, NOW(), 130.40, 'USD', 'processing', 'Credit Card', '5678 Cedar St', '5678 Cedar St');

-- Insertar artículos de orden en la tabla 'OrderItem'
INSERT INTO `OrderItem` (order_id, product_id, quantity, price, total_price)
VALUES
(1, 1001, 2, 60.25, 120.50),
(2, 1002, 1, 80.75, 80.75),
(2, 1003, 1, 100.00, 100.00),
(3, 1004, 1, 95.20, 95.20),
(4, 1005, 2, 100.00, 200.00),
(5, 1006, 1, 60.40, 60.40),
(5, 1007, 1, 70.00, 70.00);
