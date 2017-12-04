<?php
require_once("dbconn.php"); //require this file or fatal error.
require_once("functions.php");
$db = dbConn(); // run function that connects to the db and store that connection in a var called db.
$dropdown = getCategoriesDropDown($db);
?>
<div style="margin:20px;">
    <form method="get" action="#">
        <table>
            <tr>
                <td>Select Category:
                    <select name="id">
                        <?php echo $dropdown ?>
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" name="action" value="Edit" />
        <input type="submit" name="action" value="Delete" />
        <input type="submit" name="action" value="view" />
    </form>
</div>
