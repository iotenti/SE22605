<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 11/27/2017
 * Time: 8:48 AM
 */
require_once ("dbconn.php");
require_once ("functions.php");
include_once ("header.php");


$db = dbConn();


$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? NULL;
$pwd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING) ?? NULL;
?>
    <div style="height:100px">
        <a href="loginPage.php">Log in</a>
    </div>
    <div style="height:300px">
        <?php
        include_once("signupForm.php");
        switch($action){

            case 'sign up':
                //call a function that checks whether the username is already in the db. if so, show error message
                $result = checkUserName($db, $email);
                if($result > 0){
                    $error = "There is already an account associated with this email address.";
                    echo $error;
                }else{
                    //validate email
                    //validate password

                    //if username is valid and not in the db, hash the password and store the record
                    echo addUser($db, $email, $pwd);
                }
        }
        ?>
    </div>
<?php
include_once ("footer.php");