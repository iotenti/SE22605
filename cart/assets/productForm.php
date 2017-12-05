<?php

if($action === "Add" && isset($_SESSION['category'])){
    $hidden="";
}else{
    $hidden="hidden";
}

if($action ==="Edit" && $_SESSION['button'] === "Update"){
    $hidden="";
}else{
    $hidden="hidden";
}

?>
<div style="margin:20px;">
    <form method="post" action="#" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Category: </td>
                <td><input type="text" name="prodCategory" disabled="disabled" value="<?php echo $_SESSION['category'] ?> "></td>
            </tr>
            <tr>
                <td>Product Name: </td>
                <td><input type="text" name="prodName" value="<?php echo $prodName ?>"></td>
            </tr>
            <tr>
                <td>Price: $</td>
                <td><input type="text" name="prodPrice" value="<?php echo $prodPrice ?>"></td>
            </tr>
            <tr>
                <td>Image:</td>
                <td><input type="file" name="file"></td>
            </tr>
        </table>
        <br />
        <input type="submit" name="action" <?php echo $hidden ?> value="<?php echo  $_SESSION['button'] ?>" />
    </form>
</div>
<?php

?>