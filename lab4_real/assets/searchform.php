<?
require_once("dbconn.php"); //require this file or fatal error.
require_once("corps.php");
$db = dbConn(); // run function that connects to the db and store that connection in a var called db.
?>
<table>
    <tr>
        <td>Search Column:</td>
        <td>
            <select name="searchCol">
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
    </tr>
    <tr>
        <td>Term:</td><td><input type="search" name="action" /></td>
        <td><input type="submit" id="btn" name="action" value="Submit" /></td>
        <td><input type="submit" id="btn" name="action" value="Reset" /></td>
    </tr>
</table>
