<?php
require_once("dbconn.php"); //require this file or fatal error.
require_once("corps.php");
$db = dbConn(); // run function that connects to the db and store that connection in a var called db.
$cols = getColumnNames($db, 'corps');
$dropdown = getDropDown($cols);
?>
<form method ="get" action="#">
    <table>
        <td>Sort Column</td>
        <td>
            <select name="col" value="">
                <?php echo $dropdown ?>
            </select>
        </td>
        <td>Ascending:</td><td><input type="radio" name="dir" value="ASC" /></td>
        <td>Descending:</td><td><input type="radio" name="dir" value="DESC" /></td>
    </table>
    <input type="submit" value="sort" />
    <input type="hidden" name="action" value="sort" />

    <input type="submit" name="action" value="reset" />

</form>

