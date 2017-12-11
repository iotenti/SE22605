<?php
session_start();
if(!isset($_SESSION['message'])){
    $_SESSION['button'] = "Submit";
}
/**
 * Ian Otenti.
 * User: 005505537
 * Date: 12/11/2017
 * Time: 7:40 AM
 */
require_once("assets/dbconn.php");
require_once("assets/functions.php");
include_once("assets/top.php");
$db = dbConn();
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? null;
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? null;
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? null;
$heard_from = filter_input(INPUT_POST, 'heard_from', FILTER_SANITIZE_STRING) ?? null;
$contact_via = filter_input(INPUT_POST, 'contact_via', FILTER_SANITIZE_STRING) ?? null;
$comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING) ?? null;
$error = "<span style='color:red;'>";
include_once("assets/form.php");

switch($action){
    case 'Submit':
        //validate email
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //check to see if email is already in db
            $result = checkEmail($db, $email);
            if($result > 0){
                //result returns row count. If it's higher than 1, display error message
                $message = $error . " There is already an account associated with this email address.</span>";
                echo $message;
            } else {
                //email is new, proceed
                if(isset($_POST['heard_from'])){
                    //if heard_from radio button is selected proceed
                    if(isset($_POST['contact_via'])){
                        //if something has been selected from drop down, proceed
                        if(isset($_POST['phone'])){
                            //phone has been posted. All things have been checked out
                            //change button
                            $_SESSION['button'] = "Add Account";
                        }
                    }else{
                        //nothing has been selected from drop down, print error

                    }
                }else{//if heard_from radio button is not selected
                    //print out error message

                }
            }
        }else{
            echo "please enter a valid email";
        }




    case 'Add Account':
        //all valid, add account
        //echo addAccount($db, $email, $phone, $heard_from, $contact_via, $comments);
        //display results
}





include_once("assets/bottom.php");
