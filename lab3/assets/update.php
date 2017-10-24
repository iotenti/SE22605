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

$db = dbConn(); // run function that connects to the db and store that connection in a var called db.
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? null;

$corp = filter_input(INPUT_POST, 'corp', FILTER_SANITIZE_STRING) ?? "";
$incorp_dt = filter_input(INPUT_POST, 'incorp_dt', FILTER_SANITIZE_STRING) ?? "";
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
$zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
$owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";
?>

echo getCorp($db, $id);
echo updateCorp($db, $id, $corp, $email, $zipcode, $owner, $phone);


?>
    <a href='../index.php'>Home</a>
    <form method="post" action="#">
        <input type="submit" id="btn" name="action" value="Add A Record" />
    </form>
<?php
include_once("footer.php"); //call the footer once.
?>