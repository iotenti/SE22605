<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 10/18/2017
 * Time: 10:24 AM
 */
function getActorsAsTable($db){
    try{
        $sql = "SELECT * FROM actors";  //select statement. selects all from actors. Set to a var.
        $sql = $db->prepare($sql); //I think this plugs the statement into a method which helps to protect from sql injections.
        $sql->execute(); //executes statement
        $actors = $sql->fetchALL(PDO::FETCH_ASSOC); //gets data and dumps it into var called actors.
        if($sql->rowCount() > 0){ //if there is data, pop it out into a table.
            $table = "<table>" . PHP_EOL;
            foreach($actors as $actor){
                $table .= "<tr><td>" . $actor['firstname'] . "</td>";
                $table .= "<td>" . $actor['lastname'] . "</td>";
                $table .= "<td>" . $actor['dob'] . "</td>";
                $table .= "<td>" . $actor['height'] . "</td></tr>";
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
function addActor($db, $fName, $lName, $dob, $height){ //function to add actor to the database
    try{
        $sql = $db->prepare("INSERT INTO actors VALUES (null, :fName, :lName, :dob, :height)"); //create a var = to sql insert statement.
        $sql->bindParam(':fName', $fName); //bind "place holders" to vars passed from forms. helps with security.
        $sql->bindParam(':lName', $lName);
        $sql->bindParam(':dob', $dob);
        $sql->bindParam(':height', $height);
        $sql->execute();
        return $sql->rowCount();
    }catch (PDOException $e) { //if it fails, throw the exception and display error message.
        die("There was a problem adding actor");
    }
}
function getActor($db, $id){ //this will be used to update and delete, I think. Will be used to grab a specific record by primary key number.
    $sql = $db->prepare("SELECT * FROM actors WHERE id = :id"); //select all with a particular id (primary key)
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);//get all columns in associated array. ? I think
    return $row;//return the data
}

