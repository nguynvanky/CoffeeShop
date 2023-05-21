<?php
session_start();
if (isset($_SESSION['admin']) == false) {
    header("Location: index.php");
    exit();
}
require('database\DatabaseHandler.php');
$db = new DatabaseHandler();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $img = $_POST['img'];
    $desc = $_POST['desc'];
    $category = $_POST['category'];
    $db->UpdateProduct($id, $name, $price, $desc, $img, $category);
    header('Location: manage_product.php');
    exit();
}
