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
        table.front, th.front, td.front{
            border-collapse: collapse;
        }
        td.front, th.front {
            padding: 15px;
            text-align: center;
            vertical-align: middle;
            max-width: 300px;
        }
        .login{
            padding-top:30px;
            padding-left:50px;
            height:350px;
            margin:auto;

        }
    </style>
</head>
<body>
<header>
    <nav>
        <div style="margin:20px; float:right;">
            <a href="/cart/index.php">Store</a> || <a href="/cart/assets/loginPage.php">Log In</a> || <a href="/cart/assets/signupPage.php">Sign Up</a> || <a href="/cart/assets/admin.php">Admin</a>
            <form method="post" action="#">
                <input type="submit" name="action" value="clear cart" />
            </form>
        </div>
    </nav>
</header>
<section>
