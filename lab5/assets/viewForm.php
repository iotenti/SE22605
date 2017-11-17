<?php
/**
 * Created by PhpStorm.
 * User: iotenti
 * Date: 11/17/2017
 * Time: 12:31 PM
 */
require_once("FUNctions.php");
require_once("dbconn.php");
$db = dbConn();

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) ?? NULL;
$dropDown = getSitesAsDropDown($db);
?>
<form method="get" action="#">
    <h1>Sites</h1>
    <select name="url" value="">
        <?php echo $dropDown ?> <!-- call function to make dropdown menu -->
</select>
<input type="Submit" name="action" value="view links">
</form>