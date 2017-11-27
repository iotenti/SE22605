<?php
session_start(); //indicates that this script needs access to session vars
if($_SESSION['username'] == NULL || !isset($_SESSION['username']) ){
    header('Location: loginPage.php'); //must be nothing sent to the browser before this. ---no html, not even a blank line. check session var before you do anything else.
}