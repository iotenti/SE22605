<?php
if(!isset($_SESSION)){
    session_start();
}
$keepImage = filter_input(INPUT_POST, 'hiddenImageName', FILTER_SANITIZE_STRING) ?? "hidden";

if($action === "Add" || $action === "Edit" || $action === "Delete" && isset($_SESSION['category'])){ // to repurpose this form I use this if statement to hide buttons depending on $action
    $hidden="";
}else{
    $hidden="hidden";
}
if($action === "Edit"){
    $keepImage = "";
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
                <td>
                    <input type="file" name="file">
                    <input type="text" name="imageName" hidden value="<?php echo $imageName ?>">
                </td>
            </tr>
            <tr>
                <td <?php echo $keepImage ?>>keep image?  <input type="checkbox" name="keepImage" id="keepImage" /></td>
            </tr>
        </table>
        <br />
        <input type="submit" name="action" <?php echo $hidden ?> value="<?php echo  $_SESSION['button'] ?>" />
    </form>
</div>
<?php

?>