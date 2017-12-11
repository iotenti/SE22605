<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 12/11/2017
 * Time: 10:53 AM
 */
include_once("functions.php");
include_once ("dbconn.php");

$db = dbConn();

$accounts = getAccounts($db);
echo displayAccounts($accounts);
