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
    switch($action){
        case 'log in':
            //check username and password against the one stored in the db.
            $result = login($db, $email, $pwd);
            if($result > 0){
                //give log in token
                $_SESSION['username'] = 'TRUE';
                //redirect to admin page
            } else{
                echo "<div style='margin-top:20px; color:red;'>incorrect username or password</div>";
            }
    }

    ?>
</div>
<?php




include_once ("footer.php");