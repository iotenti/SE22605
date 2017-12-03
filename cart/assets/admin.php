<?php
session_start(); //indicates that this script needs access to session vars
if($_SESSION['username'] == NULL || !isset($_SESSION['username']) ){
    header('Location: loginPage.php');
}
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

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
        include_once ("categoriesForm.php");


}

include_once ("AdminForm.php");

