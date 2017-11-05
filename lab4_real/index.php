<?php
require_once("assets/dbconn.php"); //require this file or fatal error.
require_once("assets/corps.php");
include_once("assets/header.php"); //include header once.

    $db = dbConn(); // run function that connects to the db and store that connection in a var called db.
?>

<h1>Corporation Name:</h1>
    <a href='assets/add.php'>Add A Record</a>

<?php
    echo getCorpName($db);

include_once("assets/footer.php"); //call the footer once.
?>