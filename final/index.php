<?php
session_start();
if(!isset($_SESSION['button'])){
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
$error = filter_input(INPUT_POST, 'error', FILTER_SANITIZE_STRING) ?? null;
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING) ?? null;
$error = "<span style='color:red;'>";
$message = "";
echo $message;
include_once("assets/form.php");

switch($action) {
    case 'Submit':
        //validate email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //check to see if email is already in db
            $message = "";
            $result = checkEmail($db, $email);
            if ($result < 1) {
                //email is new, proceed
                //it's good
                $message = "";
                if (isset($_POST['phone'])) {
                    //phone has been posted.
                    //it's good
                    $message = "";
                    if (isset($_POST['heard_from'])) {
                        //if heard_from radio button is selected
                        //it's good
                        $message = "";
                    } else {
                        //heard_from radio button is not selected
                        //print out error message
                        $message .= $error .= "Please select a radio button<br />";
                    }
                } else {
                    //store error message, no phone number provided
                    $message .= $error .= "Please enter a telephone number<br />";
                }
            } else {
                //result returns row count. If it's higher than 1, display error message
                $message .= $error . " There is already an account associated with this email address.<br />";
            }
        } else {
            $message .= $error . "please enter a valid email address<br />";
        }
        if (strlen($message) > 0) {
            echo $message;
            include_once("assets/form.php");
            $message = "";
        } else {
            echo addAccount($db, $email, $phone, $heard_from, $contact_via, $comments);
            include_once("assets/display_results.php");
        }
        break;
    case 'view':
        include_once("assets/view.php");

        break;

}

include_once("assets/bottom.php");