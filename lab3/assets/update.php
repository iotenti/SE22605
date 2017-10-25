<?php
/**
 * Created by PhpStorm.
 * User: iotenti
 * Date: 10/24/2017
 * Time: 3:20 PM
 */

require_once("dbconn.php"); //require this file or fatal error.
require_once("corps.php");
include_once("header.php"); //include header once.

    $button = "Update";
    $db = dbConn(); // run function that connects to the db and store that connection in a var called db.
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? null;
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
    $corp = filter_input(INPUT_GET, 'corp', FILTER_SANITIZE_STRING) ?? filter_input(INPUT_POST, 'corp', FILTER_SANITIZE_STRING) ?? "";
    //$incorp_dt = filter_input(INPUT_GET, 'incorp_dt', FILTER_SANITIZE_STRING) ?? "";
    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_STRING) ?? filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ??"";
    $zipcode = filter_input(INPUT_GET, 'zipcode', FILTER_SANITIZE_STRING) ?? filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
    $owner = filter_input(INPUT_GET, 'owner', FILTER_SANITIZE_STRING) ?? filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
    $phone = filter_input(INPUT_GET, 'phone', FILTER_SANITIZE_STRING) ?? filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";

    include_once("updateForm.php");

    if ($action == "Update"){
        echo "hello";
        echo updateCorp($db, $id, $corp, $email, $zipcode, $owner, $phone);
        $button = "Update";
    }
?>
    <a href='../index.php'>Home</a>
<?php
    include_once("footer.php"); //call the footer once.
?>