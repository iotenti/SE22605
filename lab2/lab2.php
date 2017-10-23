<?php
require_once("assets/dbconn.php"); //require this file or fatal error.
require_once("assets/actors.php");
include_once("assets/header.php"); //include header once.

$db = dbConn(); // run function that connects to the db and store that connection in a var called db.

//check to see if these vars have anything in them, and if not, make them equal to an empty string
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$fName = filter_input(INPUT_POST, 'fName', FILTER_SANITIZE_STRING) ?? "";
$lName = filter_input(INPUT_POST, 'lName', FILTER_SANITIZE_STRING) ?? "";
$dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING) ?? "";
$height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_STRING) ?? "";
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? null;

switch ($action){ //switch, if the button has a value of "Add" then run the addActor function and pass it the information.
    case "Add":
        addActor($db, $fName, $lName, $dob, $height);
        $button ="Add";
        break;
    case "Edit":
        $dog = getDog($db, $id);
        $button = "Update";
        echo $button;
        break;
    case "Update":
        break;
    case "Delete":
        break;
}
echo getActorsAsTable($db); //print out db records

include_once("assets/actorform.php");//this has the meat of the html page. The form being filled out. Called once.
include_once("assets/footer.php"); //call the footer once.
?>