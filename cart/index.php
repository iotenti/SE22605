<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 11/27/2017
 * Time: 8:48 AM
 */
require_once ("assets/dbconn.php");
require_once ("assets/functions.php");
include_once ("assets/header.php");

$db = dbConn();
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;




switch($action) {
    case 'log in':

    case 'sign up':

    case 'log out':

}





include_once ("assets/footer.php");