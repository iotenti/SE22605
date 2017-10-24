<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 10/18/2017
 * Time: 10:24 AM
 */
function getCorpsAsTable($db){
    try{
        $sql = "SELECT * FROM corps";  //select statement. selects all from actors. Set to a var.
        $sql = $db->prepare($sql); //I think this plugs the statement into a method which helps to protect from sql injections.
        $sql->execute(); //executes statement
        $corps = $sql->fetchALL(PDO::FETCH_ASSOC); //gets data and dumps it into var called corps.
        if($sql->rowCount() > 0){ //if there is data, pop it out into a table.
            $table = "<table>" . PHP_EOL;
            foreach($corps as $corp){
                $table .= "<tr><td>" . $corp['corp'] . "</td>";
                $table .= "<td>" . $corp['email'] . "</td>";
                $table .= "<td>" . $corp['incorp_dt'] . "</td>";
                $table .= "<td>" . $corp['owner'] . "</td>";
                $table .= "<td>" . $corp['phone'] . "</td>";
                $table .= "<td>" . $corp['zipcode'] . "</td></tr>";
            } //**********************ADD ID STUFF******************************
            $table .= "</table>" . PHP_EOL;
        } else { //if there is not any data, say so.
            $table = "NO DATA" . PHP_EOL;
        }
        return $table; //return it.
    }catch(PDOException $e){ //if it fails, throw the exception and display error message.
        die("There was a problem");
    }
}
function getCorpName($db){
    try{
        $sql = "SELECT * FROM corps";  //select statement. selects all from actors. Set to a var.
        $sql = $db->prepare($sql); //I think this plugs the statement into a method which helps to protect from sql injections.
        $sql->execute(); //executes statement
        $corps = $sql->fetchALL(PDO::FETCH_ASSOC); //gets data and dumps it into var called corps.
        if($sql->rowCount() > 0){ //if there is data, pop it out into a table.
            $table = "<table>" . PHP_EOL;
            foreach($corps as $corp){
                $id = $corp['id'];  //might be redundant
                $readLink = "<a href='assets/read.php?id=$id'>Read</a>"; //made a var to dump into link
                $updateLink = getUpdate($db, $id);
                // $updateLink = "<a href='assets/update.php?id=$id'>Update</a>";
                $deleteLink = "<a href='assets/delete.php?id=$id'>Delete</a>";

                $table .= "<tr><td>" . $corp['corp'] . "</td>";
                $table .= "<td>$readLink</td>";
                $table .= "<td>$updateLink</td>";
                $table .= "<td>$deleteLink</td>";
            }

            $table .= "</table>" . PHP_EOL;
        } else { //if there is not any data, say so.
            $table = "NO DATA" . PHP_EOL;
        }
        return $table; //return it.
    }catch(PDOException $e){ //if it fails, throw the exception and display error message.
        die("There was a problem");
    }
}
function addCorp($db, $corp, $email, $zipcode, $owner, $phone){ //function to add actor to the database
    try{
        $sql = $db->prepare("INSERT INTO corps VALUES (null, :corp, NOW(), :email, :zipcode, :owner, :phone)"); //create a var = to sql insert statement.
        $sql->bindParam(':corp', $corp); //bind "place holders" to vars passed from forms. helps with security.
       // $sql->bindParam(':incorp_dt', $incorp_dt);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':zipcode', $zipcode);
        $sql->bindParam(':owner', $owner);
        $sql->bindParam(':phone', $phone);
        $sql->execute();
        $message = $sql->rowCount() . " rows inserted" . "<br />";
        echo $message;
    }catch (PDOException $e) { //if it fails, throw the exception and display error message.
        die("There was a problem adding the corporation");
    }
}
function updateCorp($db, $id, $corp, $email, $zipcode, $owner, $phone){ //function to add actor to the database
    try{
        $sql = $db->prepare("UPDATE corps set  corp = :corp, email = :email, zipcode = :zipcode, owner = :owner, phone = :phone WHERE id = :id"); //create a var = to sql insert statement.
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->bindParam(':corp', $corp); //bind "place holders" to vars passed from forms. helps with security.
        $sql->bindParam(':email', $email);
        $sql->bindParam(':zipcode', $zipcode);
        $sql->bindParam(':owner', $owner);
        $sql->bindParam(':phone', $phone);
        $sql->execute();
        return $sql->rowCount();
    }catch (PDOException $e) { //if it fails, throw the exception and display error message.
        die("There was a problem adding the corporation");
    }
}
function getCorp($db, $id){ //this will be used to update and delete, I think. Will be used to grab a specific record by primary key number.
    $sql = $db->prepare("SELECT * FROM corps WHERE id = :id"); //select all with a particular id (primary key)
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();
    $corp = $sql->fetch(PDO::FETCH_ASSOC);//get all columns in associated array. ? I think

    $table = "<table>";
    $table .= "<tr><th style='padding:5px;'>" . "Corporation" . "</th>";
    $table .= "<th style='padding:15px;'>" . "Email" . "</th>";
    $table .= "<th style='padding:15px;'>" . "Date Added" . "</th>";
    $table .= "<th style='padding:15px;'>" . "Owner" . "</th>";
    $table .= "<th style='padding:15px;'>" . "Phone" . "</th>";
    $table .= "<th style='padding:15px;'>" . "Zip Code" . "</th></tr>";
    $table .= "<tr><td style='padding:5px;'>" . $corp['corp'] . "</td>";
    $table .= "<td style='padding:15px;'>" . $corp['email'] . "</td>";
    $table .= "<td style='padding:15px;'>" . $corp['incorp_dt'] . "</td>";
    $table .= "<td style='padding:15px;'>" . $corp['owner'] . "</td>";
    $table .= "<td style='padding:15px;'>" . $corp['phone'] . "</td>";
    $table .= "<td style='padding:15px;'>" . $corp['zipcode'] . "</td></tr>";
    $table .= "</table>";
    return $table;
}
function deleteCorp($db, $id){
    try{
        $sql = $db->prepare("DELETE FROM corps WHERE id = :id"); //select all with a particular id (primary key)
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $success = "Record successfully deleted" . "<br /><br />" . " <a href='../index.php'>Home</a>" ;
        echo $success;
        }catch(PDOException $e){ //if it fails, throw the exception and display error message.
    die("There was a problem");
    }
}
function getUpdate($db, $id){ //this will be used to update and delete, I think. Will be used to grab a specific record by primary key number.
    $sql = $db->prepare("SELECT * FROM corps WHERE id = :id"); //select all with a particular id (primary key)
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();
    $corp = $sql->fetch(PDO::FETCH_ASSOC);//get all columns in associated array. ? I think

    $name = $corp['corp'];
    $email = $corp['email'];
    $owner = $corp['owner'];
    $phone = $corp['phone'];
    $zipcode = $corp['zipcode'];

    $updateLink = "<a href='assets/update.php?id=$id&corp=$name&email=$email&zipcode=$zipcode&owner=$owner&phone=$phone'>Update</a>";
    return $updateLink;
}

