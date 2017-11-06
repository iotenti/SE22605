<?
require_once("dbconn.php"); //require this file or fatal error.
require_once("corps.php");
$db = dbConn(); // run function that connects to the db and store that connection in a var called db.

$cols = getColumnNames($db, 'corps');
$form = getSearch($cols);

echo $form;
print_r($cols);


