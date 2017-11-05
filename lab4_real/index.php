<?php
require_once("assets/dbconn.php"); //require this file or fatal error.
require_once("assets/corps.php");
include_once("assets/header.php"); //include header once.
include_once("assets/sortform.php");
include_once("assets/searchform.php");
    $db = dbConn(); // run function that connects to the db and store that connection in a var called db.

    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
?>

<h1>Corporation Name:</h1>
    <a href='assets/add.php'>Add A Record</a>

<?php
  //  echo getCorpName($db);

    $corps = getCorporations($db);
    $cols = getColumnNames($db, 'corps');
    echo getCorpsAsTable($db, $corps, $cols);

include_once("assets/footer.php"); //call the footer once.
?>