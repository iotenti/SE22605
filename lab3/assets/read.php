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
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? null;

function getCorp($db, $id){ //this will be used to update and delete, I think. Will be used to grab a specific record by primary key number.
    $sql = $db->prepare("SELECT * FROM corps WHERE id = :id"); //select all with a particular id (primary key)
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);//get all columns in associated array. ? I think
    return $row;//return the data
}
    $corp = getCorp($db, $id);

function printCompany($corp){

    //$button = "Read";
    $table = "<table>";
    $table .= "<tr><th style='padding:5px;'>" . "Corporation" . "</th>";
    $table .= "<th style='padding:15px;'>" . "Email" . "</th>";
    $table .= "<th style='padding:15px;'>" . "Date Added" . "</th>";
    $table .= "<th style='padding:15px;'>" . "Owner" . "</th>";
    $table .= "<th style='padding:15px;'>" . "Phone" . "</th>";
    $table .= "<th style='padding:15px;'>" . "Zip Code" . "</th></tr>";
    $table .= "<tr><td style='padding:5px;'>" . $corp['corp'] . "</td>";
    $table .= "<td style='padding:15px;'>" . $corp['email'] . "</td>";
    $table .= "<td style='padding:15px;'>" . $corp['incorp_dt'] . "</td>";
    $table .= "<td style='padding:15px;'>" . $corp['owner'] . "</td>";
    $table .= "<td style='padding:15px;'>" . $corp['phone'] . "</td>";
    $table .= "<td style='padding:15px;'>" . $corp['zipcode'] . "</td></tr>";
    $table .= "</table>";
    return $table;
}
    $table = printCompany($corp);
var_dump($corp);
      echo $table;

?>
    <form method="post" action="#">
        <input type="submit" id="btn" name="action" value="Add A Record" />
    </form>
<?php
//include_once("assets/corpform.php");//this has the meat of the html page. The form being filled out. Called once.
include_once("footer.php"); //call the footer once.
?>