<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 11/27/2017
 * Time: 8:48 AM
 */
session_start();
if ( isset($_GET['message']) && $_GET['message'] == 1 )
{
    // treat the succes case ex:
    echo $_GET['message'];
}
require_once ("dbconn.php");
require_once ("functions.php");
include_once ("header.php");


$db = dbConn();


$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? NULL;
$pwd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING) ?? NULL;
$error = "<div style='margin-top:20px; color:red;'>";
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
                $_SESSION['username'] = $email;
                header('Location: admin.php');
            } else{
               $message = $error . " incorrect username or password</div>";
                echo $message;
            }
    }

    ?>
</div>
<?php




include_once ("footer.php");