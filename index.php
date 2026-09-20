<?php
require_once 'util/main.php';

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'list_products':
        list_products();
        break;
    case 'delete_product':
        delete_product();
        break;
    case 'add_product':
        add_product();
        break;
    case 'update_product':
        update_product();
        break;
    case 'delete_category':
        delete_category();
        break;
    case 'add_category':
        add_category();
        break;
    default:
        show_categories();
}

// Hiển thị trang Category (Add/Delete) - giống hình 1
function show_categories() {
    $categories = get_categories();
    include 'catalog/add_category.php';
}

// Hiển thị trang Product List
function list_products() {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id === NULL || $category_id === FALSE) {
        $category_id = 1;
    }

    $categories = get_categories();
    $products    = get_products_by_category($category_id);
    $category    = get_category($category_id);

    include 'catalog/list_products.php';
}

function add_product() {
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    $code        = filter_input(INPUT_POST, 'code');
    $name        = filter_input(INPUT_POST, 'name');
    $price       = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

    if ($category_id === NULL || $category_id === FALSE ||
            $code === NULL || $name === NULL ||
            $price === NULL || $price === FALSE) {
        display_error('Please enter valid data for the product.');
        return;
    }

    add_product_to_db($category_id, $code, $name, $price);
    header('Location: index.php?action=list_products&category_id=' . $category_id);
}

function delete_product() {
    $product_id  = filter_input(INPUT_POST, 'product_id',  FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

    if ($product_id === NULL || $product_id === FALSE ||
            $category_id === NULL || $category_id === FALSE) {
        display_error('Please use a valid product ID and category ID.');
        return;
    }

    delete_product_from_db($product_id);
    header('Location: index.php?action=list_products&category_id=' . $category_id);
}

function update_product() {
    $product_id  = filter_input(INPUT_POST, 'product_id',  FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    $code        = filter_input(INPUT_POST, 'code');
    $name        = filter_input(INPUT_POST, 'name');
    $price       = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

    if ($product_id === NULL || $product_id === FALSE ||
            $category_id === NULL || $category_id === FALSE ||
            $code === NULL || $name === NULL ||
            $price === NULL || $price === FALSE) {
        display_error('Please enter valid data to update the product.');
        return;
    }

    update_product_in_db($product_id, $code, $name, $price);
    header('Location: index.php?action=list_products&category_id=' . $category_id);
}

function add_category() {
    $name = filter_input(INPUT_POST, 'name');

    if ($name === NULL || trim($name) === '') {
        display_error('Please enter a category name.');
        return;
    }

    add_category_to_db($name);
    header('Location: index.php');   // Quay lại trang category
}

function delete_category() {
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

    if ($category_id === NULL || $category_id === FALSE) {
        display_error('Please use a valid category ID.');
        return;
    }

    delete_category_from_db($category_id);
    header('Location: index.php');   // Quay lại trang category
}