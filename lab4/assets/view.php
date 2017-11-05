<?php
require_once("dbconn.php"); //require this file or fatal error.
require_once("corps.php");
include_once("header.php"); //include header once.

$db = dbConn(); // run function that connects to the db and store that connection in a var called db.
include_once("sortform.php");

?>
    <h1>Corporations:</h1>
<?php
echo getCorpsAsTable($db);
include_once("footer.php"); //call the footer once.
?>