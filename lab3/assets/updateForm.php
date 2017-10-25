<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 10/25/2017
 * Time: 9:59 AM
 */
require_once ("dbconn.php");
require_once("update.php");

    $db = dbConn();
    $gotCorpForUpdate = getUpdate($db, $id);
?>
<form method ="post" action="#"><!-- post for inserting information. -->
        <table>
            <tr><td><input type="hidden" name="id" value="<?php echo $gotCorpForUpdate['id'] ?>" /></td></tr>
            <tr><td>Corporation Name:</td><td> <input type="text" name="corp" value="<?php echo $gotCorpForUpdate['corp'] ?>" /></td></tr><!-- text fields for data -->
            <tr><td>Email:</td><td> <input type="text" name="email" value="<?php echo $gotCorpForUpdate['email'] ?>" /></td></tr>
            <tr><td>Zipcode:</td><td> <input type="text" name="zipcode" value="<?php echo $gotCorpForUpdate['zipcode'] ?>" /></td></tr>
            <tr><td>Owner:</td><td> <input type="text" name="owner" value="<?php echo $gotCorpForUpdate['owner'] ?>" /></td></tr>
            <tr><td>Phone:</td><td> <input type="text" name="phone" value="<?php echo $gotCorpForUpdate['phone'] ?>" /></td></tr>
        </table>
        <br />
        <table>
            <tr><td><input type="submit" id="btn" name="action" value="Update" /></td><!-- button used to add. Connects to add switch in lab2.php -->

        </table>
        <br /><br />
    </form>