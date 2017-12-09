<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Links Database</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- css links goes here -->
    <!-- javascript goes here -->
    <style>
        img {
            max-width: 200px;
            height:auto;
        }
        table.admin, th.admin, td.admin{
            border: 1px solid black;
            border-collapse: collapse;
        }
        td.admin, th.admin {
            padding: 15px;
            text-align: center;
            vertical-align: middle;
            max-width: 300px;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <div style="margin:20px; float:right;">
            <form method="post" action="#">
                <input type="submit" name="action" value="Manage Categories" /> ||  <input type="submit" name="action" value="Manage Products" /> || <input type="submit" name="action" value="log out" />
            </form>
            <a href="../index.php">View Store</a>
        </div>
    </nav>
</header>
<section>
