<?php
require_once("assets/dbconn.php"); //require this file or fatal error.
    require_once("assets/corps.php");
    ?>
    <div style="float:right; margin-top:105px; margin-right:700px"><?php
    include_once("assets/sortform.php");
    include_once("assets/searchform.php");?>
    </div>
<?php
    $db = dbConn(); // run function that connects to the db and store that connection in a var called db.

    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

    $dir = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_STRING) ?? NULL;
    $col = filter_input(INPUT_GET, 'col', FILTER_SANITIZE_STRING) ?? NULL;
    $colSearch = filter_input(INPUT_GET, 'colSearch', FILTER_SANITIZE_STRING) ?? NULL;
    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING) ?? NULL;
    ?>
<div style="margin-left:25px">
<h1>Corporation Name:</h1>
    <a href='assets/add.php'>Add A Record</a>
    <br/>
    <a href='assets/view.php'>View All</a>

<?php
  //  echo getCorpName($db);
// control based on the action indicated by the user
switch ($action) {
    case 'reset':
        include_once ('assets/header.php');
        $corps = getCorporations($db);
        echo getCorpsAsTable($db, $corps);
        break;
    case 'sort':
        include_once ('assets/header.php');
        $corps = getCorpsAsSortedTable($db, $col, $dir);
        echo getCorpsAsTable($db, $corps);
        break;
    case 'search':
        include_once ('assets/header.php');
        echo searchCorp($db, $colSearch, $search);
        break;
    default:
        include_once ('assets/header.php');
        $corps = getCorporations($db);
        echo getCorpsAsTable($db, $corps);
        break;
}

include_once("assets/footer.php"); //call the footer once.
?>
</div>
