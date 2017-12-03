<?php
session_start(); //indicates that this script needs access to session vars
if($_SESSION['username'] == NULL || !isset($_SESSION['username']) ){
    header('Location: loginPage.php');
}
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

include_once ("header.php");
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
?>
<h1>Welcome to the admin page!!</h1>
<?php
include_once ("AdminForm.php");

