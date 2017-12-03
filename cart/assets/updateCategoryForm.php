<?php
require_once("dbconn.php"); //require this file or fatal error.
require_once("functions.php");
$db = dbConn(); // run function that connects to the db and store that connection in a var called db.

$dropdown = getCategories($db);
?>
<div style="margin-top:20px;">
    <form method="get" action="#">
        <table>
            <tr>
                <td>Select Category:
                    <select name="colSearch">
                        <?php echo $dropdown ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
