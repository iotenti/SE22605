<?php
/**
 * Created by PhpStorm.
 * User: iotenti
 * Date: 10/24/2017
 * Time: 3:20 PM
 */

require_once("dbconn.php"); //require this file or fatal error.
require_once("corps.php");
include_once("header.php"); //include header once.

    $db = dbConn(); // run function that connects to the db and store that connection in a var called db.
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? null;

    deleteCorp($db, $id);
?>
<?php
include_once("footer.php"); //call the footer once.
?>