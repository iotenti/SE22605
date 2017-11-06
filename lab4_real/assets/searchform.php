<?
require_once("dbconn.php"); //require this file or fatal error.
require_once("corps.php");
$db = dbConn(); // run function that connects to the db and store that connection in a var called db.
$cols = getColumnNames($db, 'corps');
$dropdown = getDropDown($cols);
?>
<br />
<form method="get" action="#">
    <table>
        <tr>
            <td>Search Column:
                <select name="colSearch">
                    <?php echo $dropdown ?>
                </select>
            </td>
            <td>Term: <input type="text" name="search" value="" /></td>
        </tr>
    </table>
    <input type="submit" value="search" />
    <input type="hidden" name="action" value="search" />

    <input type="submit" name="action" value="reset" />
</form>

