<?php
session_start(); //indicates that this script needs access to session vars
if($_SESSION['username'] == NULL || !isset($_SESSION['username']) ){
    header('Location: loginPage.php');
}
include_once ("dbconn.php");
include_once ('functions.php');
$_SESSION['category'] = "";
$db = dbConn();
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$prodCategory = filter_input(INPUT_POST, 'prodCategory', FILTER_SANITIZE_STRING) ?? NULL;

$id =  filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING) ?? NULL;
$error = "<div style='margin-top:20px; color:red;'>";
//$manageProducts = filter_input(INPUT_POST, 'prodCategory', FILTER_SANITIZE_STRING) ?? NULL;

include_once ("adminHeader.php");
?>
<h1>Welcome to admin pag!!</h1>

<?php
var_dump($action);
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
            $name = $_FILES['file']['name'];
            $temp_name = $_FILES['file']['tmp_name'];
        }

        if(isset($name)){
            if(!empty($name)){
                $location = 'uploads/';
                if(move_uploaded_file($temp_name, $location . $name)){
                    echo 'Uploaded';
                }
            }else{
                echo "please choose a file";
            }

        }

       //addProduct($db, $id, $prodCategory);
        break;

    case 'Edit':
        if($action === "Edit"){
            $_SESSION['button'] = "Update";
        }
        if($_SESSION["manageProducts"] === "TRUE"){
            if(strlen($id) > 0){
                $result_explode = explode('|', $id);
                $id = $result_explode[0];
                $_SESSION['category'] = $result_explode[1];
            }
            include_once("controlsForm.php");
            include_once ("productForm.php");
        }else{
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

            }else{
            echo updateACategory($db, $prodCategory, $id);
        }

        echo updateACategory($db, $prodCategory, $id);
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



