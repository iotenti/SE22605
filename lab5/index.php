<?php
/**
 * Created by PhpStorm.
 * User: iotenti
 * Date: 11/11/2017
 * Time: 11:58 AM
 */
require_once ("assets/dbconn.php");
require_once ("assets/FUNctions.php");
include_once ("assets/form.php");
$db = dbConn();
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) ?? NULL;

switch ($action){
    case 'url':
        $pattern = "@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i";
        $valid = preg_match($pattern, $url);

        if ($valid) {
            addSite($db, $url);
            echo doesRecordExist($db, $url);
            //echo getSitesAsTable($db);
        } else {
            echo "Please input a valid website.";
        }
}


