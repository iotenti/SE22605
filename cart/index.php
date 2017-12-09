<?php
session_start();
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

echo $action;
echo "<br />";

if(!isset($_SESSION['button'])){
    $_SESSION['button'] = "Submit";
}

//print_r( $_SESSION['cart']);

include_once("assets/viewProdsForm.php");



switch($action) {
    case 'log in':
        break;
    case 'sign up':
        break;
    case 'log out':
        break;
    case 'Submit':
        $products = getProducts($db, $id);
        echo getProductsAsFrontEndTable($products);
        break;

    case 'Add':
        //$_SESSION['button'] = "View Cart";
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
        $product = getAProduct($db, $pk);// get product added to cart
        print_r($product);

        $_SESSION['cart'][] = $product;
        break;

    case 'View Cart':
        include_once("assets/cart.php");
        break;

    case 'Clear Cart':
        $_SESSION['cart'] = [];
        break;
}





include_once ("assets/footer.php");