<?php
if(!isset($_SESSION)){
    session_start();
}
require_once ("dbconn.php");
require_once ("functions.php");
include_once ("header.php");


$db = dbConn();


$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? NULL;
$pwd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING) ?? NULL;
$pwd2 = filter_input(INPUT_POST, 'pwd2', FILTER_SANITIZE_STRING) ?? NULL;
$error = "<div style='margin-top:20px; color:red;'>";



?>
<div class="login">
<?php
include_once("signupForm.php");
switch($action){

    case 'sign up':

        //call a function that checks whether the username is already in the db. if so, show error message
        $result = checkUserName($db, $email);
        if($result > 0){
            $message = $error . " There is already an account associated with this email address.</div>";
            echo $message;
        }else{
            //validate email
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                //if username is valid and not in the db, validate password
                if(strlen($pwd) <= 5){
                    $message = $error . " * password must be at least 6 characters</div>";
                    echo $message;
                }else{
                    if($pwd !== $pwd2){
                        $message = $error . " passwords do not match</div>";
                        echo $message;
                    }else{
                        //store the record and store welcome message

                        $_SESSION['message'] = addUser($db, $email, $pwd);
                        //redirect to login page
                        header('Location: loginPage.php');
                    }
                }
            }else{
                //else email not valid, display error message
                $message = $error . " Please enter a valid email address. ex: joe@example.com</div>";
                echo $message;
            }


        }
}
?>
</div>
<?php
include_once ("footer.php");