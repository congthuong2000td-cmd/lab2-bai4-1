-- Tạo database my_guitar_shop1
CREATE DATABASE IF NOT EXISTS my_guitar_shop1
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_unicode_ci;

USE my_guitar_shop1;

-- Bảng categories
CREATE TABLE IF NOT EXISTS categories (
    categoryID    INT             NOT NULL AUTO_INCREMENT,
    categoryName  VARCHAR(255)    NOT NULL,
    PRIMARY KEY (categoryID)
) ENGINE=InnoDB;

-- Bảng products
CREATE TABLE IF NOT EXISTS products (
    productID     INT             NOT NULL AUTO_INCREMENT,
    categoryID    INT             NOT NULL,
    productCode   VARCHAR(10)     NOT NULL,
    productName   VARCHAR(255)    NOT NULL,
    listPrice     DECIMAL(10,2)   NOT NULL,
    PRIMARY KEY (productID),
    FOREIGN KEY (categoryID) REFERENCES categories(categoryID)
) ENGINE=InnoDB;

-- Dữ liệu mẫu categories
INSERT INTO categories (categoryName) VALUES
    ('Guitars'),
    ('Basses'),
    ('Drums');

-- Dữ liệu mẫu products
INSERT INTO products (categoryID, productCode, productName, listPrice) VALUES
    (1, 'strat',  'Fender Stratocaster',     699.00),
    (1, 'les_paul','Gibson Les Paul',         1199.00),
    (1, 'sg',     'Gibson SG',               899.00),
    (2, 'p_bass', 'Fender Precision Bass',   799.00),
    (2, 'j_bass', 'Fender Jazz Bass',        899.00),
    (3, 'ludwig', 'Ludwig 5-Piece Drum Set', 999.00),
    (3, 'pearl',  'Pearl Export 5-Piece',    589.00);
