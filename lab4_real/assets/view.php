<?php
require_once("dbconn.php"); //require this file or fatal error.
require_once("corps.php");
include_once("sortform.php");
include_once("searchform.php");
$db = dbConn(); // run function that connects to the db and store that connection in a var called db.

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

$dir = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_STRING) ?? NULL;
$col = filter_input(INPUT_GET, 'col', FILTER_SANITIZE_STRING) ?? NULL;
$colSearch = filter_input(INPUT_GET, 'colSearch', FILTER_SANITIZE_STRING) ?? NULL;
$search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING) ?? NULL;
?>

    <h1>Corporation Name:</h1>
    <a href='add.php'>Add A Record</a>
    <br/>
    <a href='../index.php'>Home</a>

<?php
//  echo getCorpName($db);
// control based on the action indicated by the user
switch ($action) {
    case 'reset':
        include_once ('header.php');
        $corps = getCorporations($db);
        echo getViewAllCorpsAsTable($db, $corps, $cols);
        break;
    case 'sort':
        include_once ('header.php');
        $corps = getCorpsAsSortedTable($db, $col, $dir);
        $cols = getColumnNames($db, 'corps');
        echo getViewAllCorpsAsTable($db, $corps, $cols);
        break;
    case 'search':
        include_once ('header.php');
        $cols = getColumnNames($db, 'corps');
        echo viewAllSearchCorp($db, $cols, $colSearch, $search);
        break;
    default:
        include_once ('header.php');
        $corps = getCorporations($db);
        $cols = getColumnNames($db, 'corps');
        echo getViewALLCorpsAsTable($db, $corps, $cols = null);
        break;
}

include_once("footer.php"); //call the footer once.
?>