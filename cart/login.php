<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 11/27/2017
 * Time: 8:48 AM
 */
require_once ("assets/dbconn.php");
include_once ("assets/header.php");
include_once("assets/loginForm.php");

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
switch($action){
    case 'log in':
        //call function to check db whether email exists, if so, check the given password against the one stored in the db.
        //give login token
        //redirect to admin page
    case 'sign up':
        //call a function that checks whether the username is already in the db. if so, show error message
        //if username is not in the db, hash the password and store the record
}





include_once ("footer.php");