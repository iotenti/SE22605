<?php
/**
 * Created by PhpStorm.
 * User: iotenti
 * Date: 11/11/2017
 * Time: 11:58 AM
 */
include_once ("assets/header.php"); ?>
<h3>add site:</h3>
<?php
require_once ("assets/dbconn.php");
require_once ("assets/FUNctions.php");
include_once("assets/submitForm.php");
$db = dbConn();

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) ?? NULL;
$url = filter_var($url, FILTER_SANITIZE_URL);

switch ($action){
    case 'Submit':
        if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED)) { //checks if URL is valid. if so, kick into this function. That adds the record
            echo URLisValid($db, $url);
        } else {
            echo "Please input a valid URL EX: http://google.com";
        }
}
include_once ("assets/footer.php");


