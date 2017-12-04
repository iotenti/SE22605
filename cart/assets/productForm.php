<?php
if($action === "Add" && isset($_SESSION['category'])){
    $hidden="";
}else{
    $hidden="hidden";
}
?>
<div style="margin:20px;">
    <form method="post" action="#">
        <table>
            <tr>
                <td>Product Name: </td>
                <td><input type="text" name="prodName" value=""></td>
            </tr>
            <tr>
                <td>Category: </td>
                <td><input type="text" name="prodCategory" disabled="disabled" value="<?php echo $_SESSION['category'] ?> "></td>
            </tr>
            <tr>
                <td>Price: $</td>
                <td><input type="text" name="prodPrice" value=""></td>
            </tr>
            <tr>
                <td>Image:</td>
                <td><input type="submit" name="action" value="Choose File" /></td>
            </tr>
        </table>
        <br />
        <input type="submit" name="action" <?php echo $hidden ?> value="<?php echo  $_SESSION['button'] ?>" />
    </form>
</div>