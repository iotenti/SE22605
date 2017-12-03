<?php ?>

<form method="post" action="#">
    <table>
        <caption>Manage Categories</caption>
        <tr>
            <td>Category Name:</td>
            <td><input type="text" name="prodCategory" value=""></td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="action" value="category" /><!--value="<?php $button ?>!-->
            </td>
        </tr>
    </table>
</form>