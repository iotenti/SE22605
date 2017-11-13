<?php
/**
 * Created by PhpStorm.
 * User: iotenti
 * Date: 11/11/2017
 * Time: 11:58 AM
 */
include_once ("assets/header.php");
require_once ("assets/dbconn.php");
require_once ("assets/FUNctions.php");
include_once ("assets/form.php");
$db = dbConn();
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) ?? NULL;
$url = filter_var($url, FILTER_SANITIZE_URL);
switch ($action){
    case 'Submit':
        //$pattern = "@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i";
        //$valid = preg_match($pattern, $url);
        if (filter_var($url, FILTER_VALIDATE_URL)) { //checks if URL is valid. if so, kick into this function.
            echo URLisValid($db, $url);
        } else {
            echo "Please input a valid URL EX: http://google.com";
        }
    case 'View All':
        include_once ("assets/header.php");
        echo getSitesAsTable($db);
        include_once ("assets/footer.php");
}
include_once ("assets/footer.php");


