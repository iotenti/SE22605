<?php
require_once("assets/dbconn.php"); //require this file or fatal error.
require_once("assets/corps.php");
include_once("assets/header.php"); //include header once.

$db = dbConn(); // run function that connects to the db and store that connection in a var called db.

//check to see if these vars have anything in them, and if not, make them equal to an empty string
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$corp = filter_input(INPUT_POST, 'corp', FILTER_SANITIZE_STRING) ?? "";
$incorp_dt = filter_input(INPUT_POST, 'incorp_dt', FILTER_SANITIZE_STRING) ?? "";
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
$zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
$owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";


$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? null;

switch ($action){ //switch, if the button has a value of "Add" then run the addActor function and pass it the information.
    case "Add":
        addCorp($db, $corp, $incorp_dt, $email, $zipcode, $owner, $phone);
        $button ="Add";
        break;
    case "Read":
        $corp = getCorp($db, $id);
        $button = "Read";
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
        echo $table;
        break;
    case "Update":
        include_once("assets/corpform.php");
        $button = "Update";
        echo $button;
        break;
    case "Delete":

        $button = "Delete";
        echo $button;
        break;
}
?>
<h1>Corporation Name:</h1>
<?php
echo getCorpName($db);
//echo getCorpsAsTable($db); //print out db records

//include_once("assets/corpform.php");//this has the meat of the html page. The form being filled out. Called once.
include_once("assets/footer.php"); //call the footer once.
?>