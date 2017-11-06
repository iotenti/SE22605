<?php
require_once("assets/dbconn.php"); //require this file or fatal error.
require_once("assets/corps.php");
include_once("assets/sortform.php");
include_once("assets/searchform.php");
    $db = dbConn(); // run function that connects to the db and store that connection in a var called db.

    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

    $dir = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_STRING) ?? NULL;
    $col = filter_input(INPUT_GET, 'col', FILTER_SANITIZE_STRING) ?? NULL;
    $colSearch = filter_input(INPUT_GET, 'colSearch', FILTER_SANITIZE_STRING) ?? NULL;
    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING) ?? NULL;
?>

<h1>Corporation Name:</h1>
    <a href='assets/add.php'>Add A Record</a>

<?php
  //  echo getCorpName($db);
// control based on the action indicated by the user
switch ($action) {
    case 'Read':
        include_once ('assets/header.php');
        // pass the db and the id to getEmployeeDisplay (which in turns gets the employee first) and echo results
        break;
    case 'New':

        include_once ('assets/header.php');
        // initialize button to Save
        // initialize an employee array and set each field to a blank form value

        break;
    case 'Save':
        include_once ('assets/header.php');
        // pass the data to newEmployee()
        // initialize button to Save
        // initialize an employee array and set each field to a blank form value
        // pass both to employeeForm()
        break;
    case 'Edit':
        include_once ('assets/header.php');
        // getEmployee()
        // initialize button to Update
        // pass both to employeeForm()
        break;
    case 'Update':
        include_once ('assets/header.php');
        // pass the data to updateEmployee()
        // getEmployee()
        // initialize button to Update
        // pass both to employeeForm()
        break;
    case 'Delete':
        include_once ('assets/header.php');
        // deleteEmployee()
        break;
    case 'sort':
        include_once ('assets/header.php');
        $corps = getCorpsAsSortedTable($db, $col, $dir);
        $cols = getColumnNames($db, 'corps');
        echo getCorpsAsTable($db, $corps, $cols);
        break;
    case 'search':
        include_once ('assets/header.php');
        $cols = getColumnNames($db, 'corps');
        echo searchCorp($db, $cols, $colsSearch, $search);
        break;
    default:
        include_once ('assets/header.php');
        $corps = getCorporations($db);
        $cols = getColumnNames($db, 'corps');
        echo getCorpsAsTable($db, $corps, $cols);
        break;
}

include_once("assets/footer.php"); //call the footer once.
?>