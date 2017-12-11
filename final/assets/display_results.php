<?php
/**
 * Ian Otenti
 * User: 005505537
 * Date: 12/11/2017
 * Time: 7:57 AM
 */
if(!isset($_SESSION['message'])){
    $_SESSION['message'] = "";
}
require_once ("dbconn.php");
require_once ("functions.php");
include_once ("top.php");
$db = dbConn();
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? null;
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? null;
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? null;
$heard_from = filter_input(INPUT_POST, 'heard_from', FILTER_SANITIZE_STRING) ?? null;
$contact_via = filter_input(INPUT_POST, 'contact_via', FILTER_SANITIZE_STRING) ?? null;
$comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING) ?? null;

$display = "<div style='margin:30px;'>";
$display .= "<p>";

        echo "email address: " . $email;
        echo "<br />";
        echo "Phone Number: ". $phone;
        echo "<br />";
        echo "Heard about us from: " . $heard_from;
        echo "<br />";
        echo "Contact by way of: " . $contact_via;
        echo "<br />";
        echo "comments: " . $comments;
        echo "<br />";
$display .= "</p>";
$display .= "</div>";



include_once ("bottom.php");
