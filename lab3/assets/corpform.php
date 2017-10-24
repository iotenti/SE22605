<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 10/18/2017
 * Time: 10:24 AM
 */

?>
<form method ="post" action="#"><!-- post for inserting information. -->
    <table>
        <tr><td>Corporation Name:</td><td> <input type="text" name="corp" value="" /></td></tr><!-- text fields for data -->
        <tr><td>Date added:</td><td> <input type="text" name="incorp_dt" value="" /></td></tr>
        <tr><td>Email:</td><td> <input type="text" name="email" value="" /></td></tr>
        <tr><td>Zipcode:</td><td> <input type="text" name="zipcode" value="" /></td></tr>
        <tr><td>Owner:</td><td> <input type="text" name="owner" value="" /></td></tr>
        <tr><td>Phone:</td><td> <input type="text" name="phone" value="" /></td></tr>
    </table>
    <br />
    <table>
        <tr><td><input type="submit" id="btn" name="action" value="<?php echo $button; ?>" /></td><!-- button used to add. Connects to add switch in lab2.php -->

    </table>
    <br /><br />
</form>
