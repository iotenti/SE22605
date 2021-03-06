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
function addCorp($db, $corp, $incorp_dt, $email, $zipcode, $owner, $phone){ //function to add actor to the database
    try{
        $sql = $db->prepare("INSERT INTO corps VALUES (null, :corp, :incorp_dt, :email, :zipcode, :owner, :phone)"); //create a var = to sql insert statement.
        $sql->bindParam(':corp', $corp); //bind "place holders" to vars passed from forms. helps with security.
        $sql->bindParam(':incorp_dt', $incorp_dt);
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
function getActor($db, $id){ //this will be used to update and delete, I think. Will be used to grab a specific record by primary key number.
    $sql = $db->prepare("SELECT * FROM actors WHERE id = :id"); //select all with a particular id (primary key)
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);//get all columns in associated array. ? I think
    return $row;//return the data
}

