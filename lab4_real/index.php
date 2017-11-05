<?php
require_once("assets/dbconn.php"); //require this file or fatal error.
require_once("assets/corps.php");
include_once("assets/header.php"); //include header once.
include_once("assets/sortform.php");
include_once("assets/searchform.php");
    $db = dbConn(); // run function that connects to the db and store that connection in a var called db.
?>

<h1>Corporation Name:</h1>
    <a href='assets/add.php'>Add A Record</a>

<?php
    echo getCorpName($db);
// control based on the action indicated by the user
switch ($action) {
    case 'Read':
        // pass the db and the id to getEmployeeDisplay (which in turns gets the employee first) and echo results
        break;
    case 'New':
        // initialize button to Save
        // initialize an employee array and set each field to a blank form value
        // pass both to employeeForm()
        break;
    case 'Save':
        // pass the data to newEmployee()
        // initialize button to Save
        // initialize an employee array and set each field to a blank form value
        // pass both to employeeForm()
        break;
    case 'Edit':
        // getEmployee()
        // initialize button to Update
        // pass both to employeeForm()
        break;
    case 'Update':
        // pass the data to updateEmployee()
        // getEmployee()
        // initialize button to Update
        // pass both to employeeForm()
        break;
    case 'Delete':
        // deleteEmployee()
        break;
    default:
        $corporations = getCorporations($db);
        $cols = getColumnNames($db, 'corporations');
        echo getEmployeesAsTable($db, $corporations, $cols);
        break;
}
include_once("assets/footer.php"); //call the footer once.
?>