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
//$category = filter_input(INPUT_POST, 'cat', FILTER_SANITIZE_STRING) ?? NULL;
$id =  filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING) ?? NULL;
$error = "<div style='margin-top:20px; color:red;'>";

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
        }


        include_once("controlsForm.php");
        include_once ("categoriesForm.php");

        break;


    case 'Add Category' :
        echo addCategory($db, $prodCategory);
        break;

    case 'Edit':
        var_dump($action);
        if($action === "Edit"){
            $_SESSION['button'] = "Update";
        }
        if(strlen($id) > 0){
            $result_explode = explode('|', $id);
            $id = $result_explode[0];
            $_SESSION['category'] = $result_explode[1];
        }
        include_once("controlsForm.php");
        include_once ("categoriesForm.php");

        break;
    case 'Update':
        echo updateARecord($db, $prodCategory, $id);
        break;
    case 'Delete':
        var_dump($action);
        if($action === "Delete"){
            $_SESSION['button'] = "Delete";
        }
        if(strlen($id) > 0){
            $result_explode = explode('|', $id);
            $id = $result_explode[0];
            $_SESSION['category'] = $result_explode[1];
        }
        include_once("controlsForm.php");
        include_once ("categoriesForm.php");
        echo deleteARecord($db, $id);


        break;
}



