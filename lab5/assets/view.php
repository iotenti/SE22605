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
<?php
switch($action){
    case 'view links':
        include_once ("header.php"); //choose a website
        $pk = getPK($db, $url); //gets primary key of website
        $rowCount = getRowCountForSiteLinks($db, $pk); //gets rowCount of all associated links
        echo getDateStored($db, $url, $rowCount); //pass rowcount to this function which displays it along with the date the record was stored, and retrieved.
        echo getLinksForDropDown($db, $pk); //displays links for selected record.
        include_once ("footer.php");
}
?>
