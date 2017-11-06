<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 11/6/2017
 * Time: 10:17 AM
 */
session_start();
//login verification goes here

//set
$_SESSION['username'] = 'TRUE';
//redirect over to
header('Location: demo.php'); //password protected page//