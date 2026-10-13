-- Click And Sip Cafe database
-- Import this file in phpMyAdmin (Import tab). It creates the database and tables.
CREATE DATABASE IF NOT EXISTS `coffee_shop_namin` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `coffee_shop_namin`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,            -- stores a password HASH, never the real password
  `create_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_username` (`username`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) NOT NULL,
  `title` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal_amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `invoice_number` varchar(100) NOT NULL,      -- one invoice = one order, with one row per item
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_invoice` (`invoice_number`),
  CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `payment_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_type` varchar(50) NOT NULL,         -- 'Cash' or 'GCash'
  `amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL,       -- 'To Pay' or 'Waiting for Payment'
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pay_invoice` (`invoice_number`),
  CONSTRAINT `fk_pay_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
