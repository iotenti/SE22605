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
function addProduct($db, $id, $prodCategory){
    try{
        $sql = $db->prepare("INSERT INTO `products`(`product_id`, `category_id`, `product`, `price`, `image`) VALUES (null, :category)");
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
function getCategoriesDropDown($db){
    try{
        $sql = "SELECT * FROM categories";
        $sql = $db->prepare($sql);
        $sql->execute(); //executes statement
        $categories = $sql->fetchALL(PDO::FETCH_ASSOC); //gets data and dumps it into array called corps.

        if($sql->rowCount() > 0){ //if there is data, pop it out into a dropdown.
            $dropDown = "<option value=''>Select...</option>" . PHP_EOL;
            foreach($categories as $category){

                $dropDown .= "<option value='" . $category['category_id'] . "|" . $category['category'] . "'>" . $category['category'] . "</option>";
            }
        } else { //if there is not any data, say so.
            $dropDown = "NO DATA" . PHP_EOL;
        }
        return $dropDown; //return it.

    }catch(PDOException $e){ //if it fails, throw the exception and display error message.
        die("There was a problem creating drop down");
    }
}
function updateACategory($db, $prodCategory, $id){
        try{
            $sql = $db->prepare("UPDATE categories SET category=:category WHERE category_id='$id'");
            $sql->bindParam(':category', $prodCategory); //bind "place holders" to vars passed from forms. helps with security.
            $sql->execute();

            return $sql->rowCount() . " row updated.";
        }catch (PDOException $e) { //if it fails, throw the exception and display error message.
            die($e);
        }
}
function deleteACategory($db, $id){
    try{
        $sql = $db->prepare("DELETE FROM categories WHERE category_id=:id"); //select all with a particular id (primary key)
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $success = "Record successfully deleted";
        echo $success;
    }catch(PDOException $e){ //if it fails, throw the exception and display error message.
        die($e);
    }
}

