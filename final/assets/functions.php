<?php
/**
 * Ian Otenti
 * User: 005505537
 * Date: 12/11/2017
 * Time: 7:44 AM
 */

function addAccount($db, $email, $phone, $heard_from, $contact_via, $comments){
    try{
        $sql = $db->prepare("INSERT INTO `account`(`id`, `email`, `phone`, `heard`, `contact`, `comments`) VALUES (null, :email, :phone, :heard, :contact, :comments)");
        $sql->bindParam(':email', $email);
        $sql->bindParam(':phone', $phone);
        $sql->bindParam(':heard', $heard_from);
        $sql->bindParam(':contact', $contact_via);
        $sql->bindParam(':comments', $comments);
        $sql->execute();
        $message = $sql->RowCount() . " Rows inserted.";

        return $message;
    }catch(PDOException $e){
        die("There was a problem connecting to the database");
    }
}
function checkEmail($db, $email){
    try{//CHECK TO SEE IF RECORD EXISTS
        $sql = $db->prepare("SELECT * FROM account WHERE `email`='$email'");
        $sql->execute();
        return $sql->RowCount();
    }catch(PDOException $e){//if it fails, throw the exception and display error message.
        die("There was a problem");
    }
}