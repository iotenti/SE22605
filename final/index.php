<?php
session_start();
if(!isset($_SESSION['message'])){
    $_SESSION['message'] = "";
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

include_once("assets/form.php");

switch($action){
    case 'Submit':
        echo addAccount($db, $email, $phone, $heard_from, $contact_via, $comments);
}





include_once("assets/bottom.php");
