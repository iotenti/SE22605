<?php
session_start(); //indicates that this script needs access to session vars
if($_SESSION['username'] == NULL || !isset($_SESSION['username']) ){
    header('Location: loginPage.php');
}
include_once ("dbconn.php");
include_once ('functions.php');

$db = dbConn();
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

$button = filter_input(INPUT_POST, 'button', FILTER_SANITIZE_STRING) ?? NULL;

$prodCategory = filter_input(INPUT_POST, 'prodCategory', FILTER_SANITIZE_STRING) ?? NULL;
//$category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING) ?? NULL;
$id =  filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING) ?? NULL;
include_once ("adminHeader.php");
?>
<h1>Welcome to the admin page!!</h1>

<?php

switch($action){

    case 'log out':
        session_destroy();
        header('Location: loginPage.php');
        break;
    case 'Manage Categories':
        include_once("controlsForm.php");
        include_once ("categoriesForm.php");
        break;
    case 'Add Category' :
        echo addCategory($db, $prodCategory);
        break;
    case 'view':

        break;
    case 'Edit':
        $button = "Update";
        include_once("controlsForm.php");
        include_once ("categoriesForm.php");
        break;
    case 'Delete':

        break;

}



