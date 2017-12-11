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
        $message = $sql->RowCount() . " Rows inserted. <br />";

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
function getAccounts($db){
    try{
        $sql = $db->prepare("SELECT * FROM account"); //get products with primary key of desired category
        $sql->execute(); //do it
        $accounts = $sql->fetchALL(PDO::FETCH_ASSOC);

    }catch(PDOException $e) {
        die("There was a problem getting records from the db ---- " . $e);
    }
    return $accounts;
}
function displayAccounts($accounts){
    if($accounts){

    $table = "<table>" . PHP_EOL;
    $table .= "<tr>" . PHP_EOL;
    $table .= "<th>ID</th>" . PHP_EOL;
    $table .= "<th>email</th>" . PHP_EOL;
    $table .= "<th>phone</th>" . PHP_EOL;
    $table .= "<th>heard from</th>" . PHP_EOL;
    $table .= "<th>contact</th>" . PHP_EOL;
    $table .= "<th>comments</th>" . PHP_EOL;
    $table .= "</tr>";

    foreach($accounts as $account){ //make a table
        $table .= "<tr>";
        $table .= "<td>" . $account['id'] . "</td>";
        $table .= "<td>" . $account['email'] . "</td>";
        $table .= "<td>" . $account['phone'] . "</td>";
        $table .= "<td>" . $account['heard'] . "</td>";
        $table .= "<td>" . $account['contact'] . "</td>";
        $table .= "<td>" . $account['comments'] . "</td>";
        $table .= "</tr>";
    }
    $table .= "</table>" . PHP_EOL;

    }else{ //no data, error message
        $table = "NO DATA TO TABLE" . PHP_EOL;
    }
    return $table;

}