<?php
/**
 * Created by PhpStorm.
 * User: iotenti
 * Date: 11/11/2017
 * Time: 11:58 AM
 */
require_once ("assets/dbconn.php");
require_once ("assets/FUNctions.php");

$db = dbConn();

$site = "asdkfjaskdfjawekljfaklsdf";

addSite($db, $site);

echo getSitesAsTable($db);