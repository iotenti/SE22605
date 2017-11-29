<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 11/27/2017
 * Time: 8:50 AM
 */
function checkUserName($db, $email){
    try{//CHECK TO SEE IF RECORD EXISTS
        $sql = $db->prepare("SELECT * FROM users WHERE `email`='$email'");
        $sql->execute();
        return $sql->RowCount();
    }catch(PDOException $e){//if it fails, throw the exception and display error message.
        die("There was a problem");
    }
}
function addUser($db, $email, $pwd){
    try{
        $sql = $db->prepare("INSERT INTO users VALUES (null, :email, :password, NOW())");
        $sql->bindParam(':email', $email);
        $sql->bindParam(':password', $pwd);
        $sql->execute();
        $message = "Success!  Welcome to the site";

        return $message;
    }catch(PDOException $e){
        die("There was a problem connecting to the database");
    }
}
function login($db, $email, $pwd){
    try{
        $sql = $db->prepare("SELECT * FROM users WHERE `email`='$email' AND `password`='$pwd'"); //find all rows where username and password match.
        $sql->execute();
        if($sql->RowCount() > 0) {
            $message = $sql->RowCount();
        }else{
            $message = $sql->RowCount();
        }
        return $message;
    }catch(PDOException $e){
        die("There was a problem connecting to the database:  " . $e->getMessage());
    }
}