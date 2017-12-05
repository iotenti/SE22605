<?php
require_once("dbconn.php"); //require this file or fatal error.
require_once("functions.php");
$db = dbConn(); // run function that connects to the db and store that connection in a var called db.
$dropdown = getCategoriesDropDown($db);

if($_SESSION["manageProducts"] === "TRUE") {
    $hiddenOnCategoryForm = "";
    $hiddenOnProductsForm = "hidden";
}else{
    $hiddenOnCategoryForm = "hidden";
    $hiddenOnProductsForm = "";
}
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
        <br />
        <input type="submit" name="action" <?php echo $hiddenOnCategoryForm ?> value="Add" />
        <input type="submit" name="action"<?php echo $hiddenOnProductsForm ?> value="Edit" />
        <input type="submit" name="action" <?php echo $hiddenOnProductsForm ?> value="Delete" />
        <input type="submit" name="action" <?php echo $hiddenOnCategoryForm ?> value="view" />
    </form>
</div>
