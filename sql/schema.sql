-- Peace Automation | Database schema
-- Import via phpMyAdmin or: mysql -u root -p < schema.sql

CREATE DATABASE IF NOT EXISTS `peace_atomation`
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `peace_atomation`;

CREATE TABLE IF NOT EXISTS `inquiries` (
    `id`           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name`         VARCHAR(100)  NOT NULL,
    `email`        VARCHAR(150)  NOT NULL,
    `phone`        VARCHAR(30)   NULL,
    `service_type` VARCHAR(100)  NOT NULL,
    `message`      TEXT          NOT NULL,
    `ip_address`   VARCHAR(45)   NULL,
    `created_at`   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------
-- Shop: orders placed from the website cart (cash on delivery /
-- bank transfer — no card data is ever stored here).
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orders` (
    `id`             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `reference`      VARCHAR(30)   NOT NULL UNIQUE,
    `name`           VARCHAR(100)  NOT NULL,
    `email`          VARCHAR(150)  NULL,
    `phone`          VARCHAR(30)   NOT NULL,
    `company`        VARCHAR(150)  NULL,
    `address`        VARCHAR(255)  NOT NULL,
    `city`           VARCHAR(80)   NOT NULL,
    `notes`          TEXT          NULL,
    `payment_method` VARCHAR(30)   NOT NULL,
    `subtotal`       INT UNSIGNED  NOT NULL,
    `total`          INT UNSIGNED  NOT NULL,
    `status`         VARCHAR(20)   NOT NULL DEFAULT 'new',
    `ip_address`     VARCHAR(45)   NULL,
    `created_at`     TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_orders_created_at` (`created_at`),
    INDEX `idx_orders_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `order_items` (
    `id`           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order_id`     INT UNSIGNED     NOT NULL,
    `product_slug` VARCHAR(120)     NOT NULL,
    `product_name` VARCHAR(200)     NOT NULL,
    `sku`          VARCHAR(40)      NULL,
    `unit_price`   INT UNSIGNED     NOT NULL,
    `quantity`     SMALLINT UNSIGNED NOT NULL,
    `line_total`   INT UNSIGNED     NOT NULL,
    INDEX `idx_order_items_order` (`order_id`),
    CONSTRAINT `fk_order_items_order` FOREIGN KEY (`order_id`)
        REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------
-- Shop: customer reviews shown on product-detail.php.
-- Emails are stored for follow-up but never rendered on the page.
-- ---------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `product_reviews` (
    `id`           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `product_slug` VARCHAR(120)     NOT NULL,
    `author`       VARCHAR(100)     NOT NULL,
    `email`        VARCHAR(150)     NOT NULL,
    `rating`       TINYINT UNSIGNED NOT NULL,
    `body`         TEXT             NOT NULL,
    `is_approved`  TINYINT(1)       NOT NULL DEFAULT 1,
    `ip_address`   VARCHAR(45)      NULL,
    `created_at`   TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_reviews_slug` (`product_slug`, `is_approved`),
    INDEX `idx_reviews_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
