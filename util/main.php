<?php
require_once 'model/database.php';
require_once 'model/category_db.php';
require_once 'model/product_db.php';

function display_error($message) {
    include 'errors/error.php';
}