<?php
var_dump($_SESSION['category']);
?>
<div style="margin:20px;">
    <form method="post" action="#">
        <table>
            <tr>
                <td>Category Name:</td>
                <td><input type="text" name="prodCategory" value="<?php echo $_SESSION['category'] ?> "> </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="action" value="<?php echo  $_SESSION['button'] ?>" />
                </td>
            </tr>
        </table>
    </form>
</div>