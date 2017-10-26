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
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
    $corp = filter_input(INPUT_POST, 'corp', FILTER_SANITIZE_STRING) ?? "";
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ??"";
    $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
    $owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";

    $corps = getUpdate($db, $id);
?>
<form method ="post" action="#"><!-- post for inserting information. -->
        <table>
            <tr><td><input type="hidden" name="id" value="<?php echo $corps['id'] ?>" /></td></tr>
            <tr><td>Corporation Name:</td><td> <input type="text" name="corp" value="<?php echo $corps['corp'] ?>" /></td></tr><!-- text fields for data -->
            <tr><td>Email:</td><td> <input type="text" name="email" value="<?php echo $corps['email'] ?>" /></td></tr>
            <tr><td>Zipcode:</td><td> <input type="text" name="zipcode" value="<?php echo $corps['zipcode'] ?>" /></td></tr>
            <tr><td>Owner:</td><td> <input type="text" name="owner" value="<?php echo $corps['owner'] ?>" /></td></tr>
            <tr><td>Phone:</td><td> <input type="text" name="phone" value="<?php echo $corps['phone'] ?>" /></td></tr>
        </table>
        <br />
        <table>
            <tr><td><input type="submit" id="btn" name="action" value="Update" /></td><!-- button used to add. Connects to add switch in lab2.php -->
        </table>
        <br /><br />
    </form>
<?php
    if ($action == "Update"){
        echo updateCorp($db, $id, $corp, $email, $zipcode, $owner, $phone);
        $button = "Update";
    }
?>
    <a href='../index.php'>Home</a>
<?php
    include_once("footer.php"); //call the footer once.
?>