<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 10/18/2017
 * Time: 10:25 AM
 */
function dbConn(){ 
    $dsn = "mysql:host=localhost;dbname=phpclassfall2017";
    $username = "actors";
    $password = "se266";
    try{
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }catch(PDOException $e) {
        die("There was a problem connecting to the database, please do a better job.");
    }
}