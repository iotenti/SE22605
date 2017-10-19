<?php
require_once("assets/dbconn.php");
require_once("assets/actors.php");
include_once("assets/header.php");
$db = dbConn();
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";

$fName = filter_input(INPUT_POST, 'fName', FILTER_SANITIZE_STRING) ?? "";
$lName = filter_input(INPUT_POST, 'lName', FILTER_SANITIZE_STRING) ?? "";
$dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING) ?? "";
$height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_STRING) ?? "";
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? null;

switch ($action){
    case "Add":
        addActor($db, $fName, $lName, $dob, $height);
        $button ="Add";
        break;
    case "Edit":
        $actor = getActor($db, $id);
        $button = "Update";
        echo $button;
        break;
    case "Update":
        break;
    case "Delete":
        break;
}
echo getActorsAsTable($db);

include_once("assets/actorform.php");
include_once("assets/footer.php");
?>