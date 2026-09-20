<?php

function get_products_by_category($category_id) {
    $db = get_db();
    $query = 'SELECT * FROM products WHERE categoryID = :category_id ORDER BY productID';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}

function add_product_to_db($category_id, $code, $name, $price) {
    $db = get_db();
    $query = 'INSERT INTO products (categoryID, productCode, productName, listPrice) 
              VALUES (:category_id, :code, :name, :price)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();
}

function delete_product_from_db($product_id) {
    $db = get_db();
    $query = 'DELETE FROM products WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}

function update_product_in_db($product_id, $code, $name, $price) {
    $db = get_db();
    $query = 'UPDATE products
              SET productCode = :code,
                  productName = :name,
                  listPrice   = :price
              WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':code',       $code);
    $statement->bindValue(':name',       $name);
    $statement->bindValue(':price',      $price);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}