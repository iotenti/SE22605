<?
require_once("dbconn.php"); //require this file or fatal error.
require_once("corps.php");
$db = dbConn(); // run function that connects to the db and store that connection in a var called db.
?>
<form method ="get" action="#">
<table>
    <td>Sort Column</td>
    <td>
        <select name="col" value"">
            <option value="">Select...</option>
            <option value="id">id</option>
            <option value="corp">Corporation</option>
            <option value="email">Email</option>
            <option value="incorp_dt">Date</option>
            <option value="owner">Owner</option>
            <option value="phone">Phone</option>
            <option value="zipcode">Zip Code</option>
        </select>
    </td>
    <td>Ascending:</td><td><input type="radio" name="dir" value="ASC" /></td>
    <td>Descending:</td><td><input type="radio" name="dir" value="DESC" /></td>
</table>
<input type="submit" id="btn" name="action" value="sort" />
<input type="submit" id="btn" name="action" value="reset" />
</form>
