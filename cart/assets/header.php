<?php
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
switch($action){
    case 'log out':
        session_destroy();
        header('Location: loginPage.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Links Database</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- css links goes here -->
    <!-- javascript goes here -->
</head>
<body>
<header>
    <nav>
        <form method="post" action="#">
            <input type="submit" name="action" value="log out" />
        </form>
    </nav>
</header>
<section>