<?php
require_once("assets/dbconn.php"); //require this file or fatal error.
require_once("assets/actors.php");
include_once("assets/header.php"); //include header once.

$db = dbConn(); // run function that connects to the db and store that connection in a var called db.

//check to see if these vars have anything in them, and if not, make them equal to an empty string
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$corp = filter_input(INPUT_POST, 'corp', FILTER_SANITIZE_STRING) ?? "";
$incorp_dt = filter_input(INPUT_POST, 'incorp_dt', FILTER_SANITIZE_STRING) ?? "";
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
$zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
$owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";


$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? null;

switch ($action){ //switch, if the button has a value of "Add" then run the addActor function and pass it the information.
    case "Add":
        addCorp($db, $corp, $incorp_dt, $email, $zipcode, $owner, $phone);
        $button ="Add";
        break;
    case "Read":
        $corp = getCorp($db, $id);
        $button = "Read";
        echo $button;
        break;
    case "Update":
        $button = "Update";
        echo $button;
        break;
    case "Delete":
        $button = "Delete";
        echo $button;
        break;
}
echo getActorsAsTable($db); //print out db records

include_once("assets/actorform.php");//this has the meat of the html page. The form being filled out. Called once.
include_once("assets/footer.php"); //call the footer once.
?>