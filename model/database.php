<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'my_guitar_shop1');
define('DB_USER', 'root');
define('DB_PASS', '');

define('DB_DSN', 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4');

function get_db() {
    try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo 'Database connection failed: ' . $e->getMessage();
        exit;
    }
}