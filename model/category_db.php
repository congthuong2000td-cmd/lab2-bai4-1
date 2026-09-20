<?php

function get_categories() {
    $db = get_db();
    $query = 'SELECT * FROM categories ORDER BY categoryID';
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();
    return $categories;
}

function get_category($category_id) {
    $db = get_db();
    $query = 'SELECT * FROM categories WHERE categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $category = $statement->fetch();
    $statement->closeCursor();
    return $category;
}

function add_category_to_db($name) {
    $db = get_db();
    $query = 'INSERT INTO categories (categoryName) VALUES (:name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();
}

function delete_category_from_db($category_id) {
    $db = get_db();

    // Xóa tất cả sản phẩm thuộc category này trước
    $q1 = 'DELETE FROM products WHERE categoryID = :category_id';
    $s1 = $db->prepare($q1);
    $s1->bindValue(':category_id', $category_id);
    $s1->execute();
    $s1->closeCursor();

    // Sau đó mới xóa category
    $q2 = 'DELETE FROM categories WHERE categoryID = :category_id';
    $s2 = $db->prepare($q2);
    $s2->bindValue(':category_id', $category_id);
    $s2->execute();
    $s2->closeCursor();
}