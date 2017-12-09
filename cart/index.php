<?php
if(!isset($_SESSION)){
    session_start();
}
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

if(!isset($_SESSION['button'])){
    $_SESSION['button'] = "Submit";
}
include_once("assets/viewProdsForm.php");

switch($action) {
    case 'log in':
        include_once ("assets/loginPage.php");
        break;
    case 'sign up':
        include_once ("assets/signupPage.php");
        break;
    case 'admin':
        include_once ("assets/admin.php");
        break;
    case 'Submit':
        //get products
        $products = getProducts($db, $id);
        //put products in a table with cart adding capabilities
        echo getProductsAsFrontEndTable($products);
        break;

    case 'Add':
        //$_SESSION['button'] = "View Cart";
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
        // get product added to cart
        $product = getAProductForCart($db, $pk);
        //add product to cart
        $_SESSION['cart'][] = $product;
        echo "<h4>Added to cart!</h4>";
        break;

    case 'Remove':
        //if key can be got, get it.
        $key = $_GET['key'];
        //remove item with that key from the array
        unset($_SESSION['cart'][$key]);
        echo "<h4>Item Removed</h4>";
        //call table again
        include_once("assets/cart.php");
        break;

    case 'View Cart':
        //view cart
        include_once("assets/cart.php");
        break;

    case 'clear cart':
        //clear cart
        $_SESSION['cart'] = [];
        break;
}





include_once ("assets/footer.php");