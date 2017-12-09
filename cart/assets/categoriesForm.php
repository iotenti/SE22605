<?php
if(!isset($_SESSION)){
    session_start();
}
?>
<div style="margin:20px;">
    <form method="post" action="#">
        <table>
            <tr>
                <td>Category: </td>
                <td><input type="text" name="prodCategory" value="<?php echo $_SESSION['category'] ?> "> </td>
            </tr>
        </table>
        <br />
        <input type="submit" name="action" value="<?php echo  $_SESSION['button'] ?>" />
    </form>
</div>