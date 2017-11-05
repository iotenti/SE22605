<?
require_once("dbconn.php"); //require this file or fatal error.
require_once("corps.php");
$db = dbConn(); // run function that connects to the db and store that connection in a var called db.
?>
<br /><br />
<form method="get" action="#">
    <table>
        <tr>
            <td>Search Column:
                <select name="col">
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
            <td>Term: <input type="text" name="search" value="" /></td>
        </tr>
    </table>
    <input type="submit" id="btn" name="action" value="search" />
    <input type="submit" id="btn" name="action" value="reset" />

</form>

