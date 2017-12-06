<?php
session_start(); //indicates that this script needs access to session vars
if($_SESSION['username'] == NULL || !isset($_SESSION['username']) ){
    header('Location: loginPage.php');
}

include_once ("adminHeader.php");
include_once ("dbconn.php");
include_once ('functions.php');

$db = dbConn();

$_SESSION['category'] = "";

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$prodCategory = filter_input(INPUT_POST, 'prodCategory', FILTER_SANITIZE_STRING) ?? NULL;
$id =  filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING) ?? NULL;
$pk =  filter_input(INPUT_GET, 'pk', FILTER_SANITIZE_STRING) ?? NULL;
$prodName = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING) ?? NULL;
$prodPrice = filter_input(INPUT_POST, 'prodPrice', FILTER_SANITIZE_STRING) ?? NULL;
$imageName = filter_input(INPUT_POST, 'imageName', FILTER_SANITIZE_STRING) ?? NULL;
$hiddenImageName = filter_input(INPUT_POST, 'hiddenImageName', FILTER_SANITIZE_STRING) ?? NULL;
$error = "<div style='margin-top:20px; color:red;'>";
?>

<h1>Welcome to admin pag!!</h1>

<?php
print_r($action);
echo "<br />";
print_r($imageName);
echo "<br />";

switch($action){
    case 'log out':
        session_destroy();
        header('Location: loginPage.php');
        break;

    case 'Manage Categories':
        if($action === "Manage Categories"){
            $_SESSION['button'] = "Add Category";
            $_SESSION['category'] = null;
            $_SESSION["manageProducts"] = "FALSE";
        }
        include_once("controlsForm.php");
        include_once ("categoriesForm.php");
        break;

    case 'Manage Products':
        if($action === "Manage Products"){
            $_SESSION['button'] = "Add Product";
            $_SESSION['category'] = null;
            $_SESSION["manageProducts"] = "TRUE";
        }
        include_once("controlsForm.php");
        include_once ("productForm.php");
        break;

    case 'Add Category' :
        echo addCategory($db, $prodCategory);
        break;

    case 'Add Product':
        if(!isset($_FILES['file'])){
            $_FILES['file']['name'] = null;
        } else{
            $imageName = $_FILES['file']['name'];
            $temp_name = $_FILES['file']['tmp_name'];
        }
        if(isset($imageName)){
            if(!empty($imageName)){
                $location = 'uploads/';
                if(move_uploaded_file($temp_name, $location . $imageName)){
                    echo 'Uploaded';
                }
            }else{
                echo "please choose a file";
            }
        }
        include_once("controlsForm.php");
        include_once ("productForm.php");

        echo addProduct($db, $id, $prodName, $prodPrice, $imageName);
        break;
    case 'view':
        $result_explode = explode('|', $id);
        $id = $result_explode[0];

        $products = getProducts($db, $id);
        $table = getProductsAsTable($products);
        echo $table;

        include_once("controlsForm.php");
        include_once ("productForm.php");
        break;

    case 'Edit':
        $_SESSION['button'] = "Update";
        if($_SESSION["manageProducts"] === "TRUE"){ //if we are dealing with products management
            //get product with pk passed from table function
            $products = getAProduct($db, $pk);
            //loop through array assign data -- use to repopulate update from
            foreach($products as $product){
                $result_explode = explode('|', $id);
                $id = $result_explode[0];
                $_SESSION['category'] = $result_explode[1];
                $prodName = $product['product'];
                $prodPrice = $product['price'];
                $imageName = $product['image'];
            }
            include_once("controlsForm.php");
            include_once ("productForm.php");

        }else{ //else we are dealing with category management
            if(strlen($id) > 0){
                $result_explode = explode('|', $id);
                $id = $result_explode[0];
                $_SESSION['category'] = $result_explode[1];
            }
            include_once("controlsForm.php");
            include_once ("categoriesForm.php");
        }
        break;

    case 'Add':
        if($action === "Add"){
            $_SESSION['button'] = "Add Product";
        }
            if(strlen($id) > 0){
                $result_explode = explode('|', $id);
                $id = $result_explode[0];
                $_SESSION['category'] = $result_explode[1];
            }
            include_once("controlsForm.php");
            include_once ("productForm.php");

        break;

    case 'Update':
        if($_SESSION["manageProducts"] === "TRUE"){
            if(!isset($_FILES['file'])){
                $_FILES['file']['name'] = null;

            } else{
                $imageName = $_FILES['file']['name'];
                $temp_name = $_FILES['file']['tmp_name'];
            }
            if(isset($temp_name)){
                if(!empty($imageName)){
                    $location = 'uploads/';
                    if(move_uploaded_file($temp_name, $location . $imageName)){
                        echo 'Uploaded';
                    }
                }else{
                    echo "upload 1";
                }
            }

            echo updateAProduct($db, $pk, $prodName, $id, $prodPrice, $imageName);
            }else{
            echo updateACategory($db, $prodCategory, $id);
        }
        break;

    case 'Delete':
        var_dump($action);
        if($action === "Delete"){
            $_SESSION['button'] = "Delete Record";
        }
        if(strlen($id) > 0){
            $result_explode = explode('|', $id);
            $id = $result_explode[0];
            $_SESSION['category'] = $result_explode[1];
        }
        include_once("controlsForm.php");
        include_once ("categoriesForm.php");
        break;
    case 'Delete Record':
        echo deleteACategory($db, $id);
        break;
}



