<?php
/**
 * Ian Otenti.
 * User: 005505537
 * Date: 12/11/2017
 * Time: 7:40 AM
 */

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? null;
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? null;
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? null;
$heard_from = filter_input(INPUT_POST, 'heard_from', FILTER_SANITIZE_STRING) ?? null;
$contact_via = filter_input(INPUT_POST, 'contact_via', FILTER_SANITIZE_STRING) ?? null;
$comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING) ?? null;

include_once("assests/form.php");

switch ($action){
    case 'Submit':
        echo $action;
        echo "<br />";
        echo $email;
        echo "<br />";
        echo $phone;
        echo "<br />";
        echo $heard_from;
        echo "<br />";
        echo $contact_via;
        echo "<br />";
        echo $comments;


}