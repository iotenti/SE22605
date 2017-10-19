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
        <tr><td>First Name:</td><td> <input type="text" name="fName" value="" /></td></tr><!-- text fields for data -->
        <tr><td>Last Name:</td><td> <input type="text" name="lName" value="" /></td></tr>
        <tr><td>Date of birth:</td><td> <input type="text" name="dob" value="" /></td></tr>
        <tr><td>Height:</td><td> <input type="text" name="height" value="" /></td></tr>
        <tr><td><input type="submit" id="btn" name="action" value="Add" /></td></tr><!-- button used to add. Connects to add switch in lab2.php -->
    </table>
    <br /><br />
    </form>
