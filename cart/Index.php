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
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? NULL;
$pwd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING) ?? NULL;


switch($action){
    case 'log in':
        //check username and password against the one stored in the db.
        //give login token
        //redirect to admin page



    case 'sign up':
        //call a function that checks whether the username is already in the db. if so, show error message
        $result = checkUserName($db, $email);
        if($result > 0){
            $error = "There is already an account associated with this email address.";
            echo $error;
        }else{
            //validate email

            //if username is valid and not in the db, hash the password and store the record
           // addUser($db, $email, $pwd);


        }


}





include_once ("assets/footer.php");