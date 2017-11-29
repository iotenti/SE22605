<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 11/27/2017
 * Time: 8:48 AM
 */
session_start();
require_once ("dbconn.php");
require_once ("functions.php");
include_once ("header.php");


$db = dbConn();


$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? NULL;
$pwd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING) ?? NULL;
?>
<div style="height:100px; margin:auto;">
    <a href="signupPage.php">Sign up</a>
</div>
<div style="height:300px;">
    <?php
    include_once ("loginForm.php");
    var_dump($_SESSION);
    switch($action){
        case 'log in':
            //check username and password against the one stored in the db.
            $result = login($db, $email, $pwd);

            var_dump($result);
            if($result > 0){
                //give log in token
                $_SESSION['username'] = 'TRUE';
                header('Location: admin.php');
            } else{
                echo "<div style='margin-top:20px; color:red;'>incorrect username or password</div>";
            }
        case 'log out':
            //session_destroy();
    }

    ?>
</div>
<?php




include_once ("footer.php");