<?php

?>
<form method="post" action="#">
    <table>
        <tr>
            <td>Category Name:</td>
            <td><input type="text" name="prodCategory" value=""></td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="action" value="a var" />
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Product Name: </td>
            <td><input type="text" name="prodName" value=""></td>
        </tr>
        <tr>
            <td>Category: </td>
            <td> A DROP DOWN BOXXX</td>
        </tr>
        <tr>
            <td>Price: $</td>
            <td><input type="text" name="prodPrice" value=""></td>
        </tr>
        <tr>
            <td>Image:</td>
        </tr>
        <tr>
            <td><input type="submit" name="action" value="Choose File" /></td>
        </tr>
        <tr>
            <td><input type="submit" name="action" value="<?php echo $action ?>" /></td>
        </tr>
    </table>
</form>