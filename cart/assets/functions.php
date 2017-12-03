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
        $hash = password_hash($pwd, PASSWORD_DEFAULT);

        $sql = $db->prepare("INSERT INTO users VALUES (null, :email, :password, NOW())");
        $sql->bindParam(':email', $email);
        $sql->bindParam(':password', $hash);
        $sql->execute();
        $message = "Welcome to the site! Please log in";

        return $message;
    }catch(PDOException $e){
        die("There was a problem connecting to the database");
    }
}
function addCategory($db, $prodCategory){
    try{
        $sql = $db->prepare("INSERT INTO `categories`(`category_id`, `category`) VALUES (null, :category)");
        $sql->bindParam(':category', $prodCategory);
        $sql->execute();
        $message = $sql->RowCount() . " Rows inserted.";

        return $message;
    }catch(PDOException $e){
        die("There was a problem connecting to the database");
    }
}
function login($db, $email, $logInPwd){
    try{
        $sql = $db->prepare("SELECT password FROM users WHERE `email`='$email'"); //find all rows where username and password match.
        $sql->execute();
        $result = $sql->fetchALL(PDO::FETCH_ASSOC);

        foreach($result as $hashedPwd){
            $pw = $hashedPwd['password'];
        }

        if($sql->RowCount() > 0) {//email address found now check password
            if(password_verify($logInPwd, $pw)) { //use for validation
                $message = $sql->RowCount();
            }
        }else{//fail
            $message = $sql->RowCount();
        }
        return $message;
    }catch(PDOException $e){
        die("There was a problem connecting to the database:  " . $e->getMessage());
    }
}
/*
function getLinksFromDropDown($db, $pk){
    try{
        $sql = $db->prepare("SELECT * FROM sitelinks WHERE site_id ='$pk'"); //search sitelinks table for links with foreign key = primary key just retrieved
        $sql->bindParam(':site_id', $pk);
        $sql->execute();
        $links = $sql->fetchALL(PDO::FETCH_ASSOC); //get array of sites.

        if($sql->rowCount() > 0){ //if something is returned, put it in a table.

            $table = "<table>" . PHP_EOL;
            foreach($links as $link){
                $table .= "<tr><td><a href='" . $link['link'] . "' target='popup'>" . $link['link'] . "</a></td></tr>"; //it's hard to tell if this
                // "target="popup" attribute is doing anything because it pops up in a new window anyway. would target="_blank" be better?
            }
            $table .= "</table>" . PHP_EOL;

            return $table;
        }else{
            echo "No link data returned;";
        }
    }catch(PDOException $e){
        die("There was a problem getting the links from the db");
    }
}*/
function getCategoriesDropDown($db){
    try{
        $sql = "SELECT * FROM categories";
        $sql = $db->prepare($sql);
        $sql->execute(); //executes statement
        $categories = $sql->fetchALL(PDO::FETCH_ASSOC); //gets data and dumps it into array called corps.

        if($sql->rowCount() > 0){ //if there is data, pop it out into a dropdown.
            $dropDown = "<option value=''>Select...</option>" . PHP_EOL;
            foreach($categories as $category){
                $dropDown .= "<option value='" . $category['category_id'] . "'>" . $category['category'] . "</option>";
            }
        } else { //if there is not any data, say so.
            $dropDown = "NO DATA" . PHP_EOL;
        }
        return $dropDown; //return it.

    }catch(PDOException $e){ //if it fails, throw the exception and display error message.
        die("There was a problem creating drop down");
    }
}
function updateARecord($db, $category, $id){
        try{
            $sql = $db->prepare("UPDATE categories SET category=:category WHERE category_id='$id'");

            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->bindParam(':category', $category); //bind "place holders" to vars passed from forms. helps with security.
            $sql->execute();

            return $sql->rowCount() . " row updated.";
        }catch (PDOException $e) { //if it fails, throw the exception and display error message.
            die("There was a problem adding the corporation");
        }
}
