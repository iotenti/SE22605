<?php

require_once ("assets/dbconn.php");
require_once ("assets/functions.php");
include_once ("assets/header.php");

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$prodCategory = filter_input(INPUT_POST, 'prodCategory', FILTER_SANITIZE_STRING) ?? NULL;
$id =  filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING) ?? NULL;
$pk =  filter_input(INPUT_GET, 'pk', FILTER_SANITIZE_STRING) ?? NULL;
$prodName = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING) ?? NULL;
$prodPrice = filter_input(INPUT_POST, 'prodPrice', FILTER_SANITIZE_STRING) ?? NULL;
$imageName = filter_input(INPUT_POST, 'imageName', FILTER_SANITIZE_STRING) ?? NULL;
$hiddenImageName = filter_input(INPUT_POST, 'hiddenImageName', FILTER_SANITIZE_STRING) ?? NULL;
//$prod =  filter_input(INPUT_GET, 'prod', FILTER_SANITIZE_STRING) ?? NULL;

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

include_once ("assets/viewProds.php");



switch($action) {
    case 'log in':
        break;
    case 'sign up':
        break;
    case 'log out':
        break;
    case 'Submit':
        print_r($id);
        $products = getProducts($db, $id);
        echo getProductsAsFrontEndTable($products);
        break;
    case 'Add':
        $product = getAProduct($db, $pk);// get product added to cart


        addToCart($db, $product);
        break;
    case 'Clear Cart':
        $_SESSION['cart'] = [];
}





include_once ("assets/footer.php");