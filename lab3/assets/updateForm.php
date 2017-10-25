<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 10/25/2017
 * Time: 9:59 AM
 */
?>
<form method ="post" action="update.php"><!-- post for inserting information. -->
        <table>
            <tr><td>Corporation Name:</td><td> <input type="text" name="corp" value="<?php echo $corp ?>" /></td></tr><!-- text fields for data -->
            <tr><td>Email:</td><td> <input type="text" name="email" value="<?php echo$email ?>" /></td></tr>
            <tr><td>Zipcode:</td><td> <input type="text" name="zipcode" value="<?php echo$zipcode ?>" /></td></tr>
            <tr><td>Owner:</td><td> <input type="text" name="owner" value="<?php echo $owner ?>" /></td></tr>
            <tr><td>Phone:</td><td> <input type="text" name="phone" value="<?php echo $phone ?>" /></td></tr>
            <tr><td> <input type="hidden" name="id" value="<?php echo $id ?>" /></td></tr>
        </table>
        <br />
        <table>
            <tr><td><input type="submit" id="btn" name="action" value="Update" /></td><!-- button used to add. Connects to add switch in lab2.php -->

        </table>
        <br /><br />
    </form>