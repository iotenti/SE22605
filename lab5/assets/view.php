<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 11/15/2017
 * Time: 10:35 AM
 */
include_once("header.php");
require_once("dbconn.php");
require_once("FUNctions.php");
$db = dbConn();
$dropDown = getSitesAsDropDown($db);
?>
<form method="get" action="#">
    <h1>Sites</h1>
    <select name="url" value="">
        <?php echo $dropDown ?>
    </select>
    <input type="Submit" name="action" value="view links">
</form>

