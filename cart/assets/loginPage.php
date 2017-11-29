<?php
session_start();
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

    if(isset($_SESSION['message'])){

        echo "<div style='margin-top:20px;'>" . $_SESSION['message'] . "</div>";
        session_destroy();
    }

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