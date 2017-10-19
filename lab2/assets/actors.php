<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 10/18/2017
 * Time: 10:24 AM
 */
function getActorsAsTable($db){
    try{
        $sql = "SELECT * FROM actors";
        $sql = $db->prepare($sql);
        $sql->execute();
        $actors = $sql->fetchALL(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0){
            $table = "<table>" . PHP_EOL;
            foreach($actors as $actor){
                $table .= "<tr><td>" . $actor['fName'] . "</td></tr>";
                $table .= "<tr><td>" . $actor['lName'] . "</td></tr>";
                $table .= "<tr><td>" . $actor['dob'] . "</td></tr>";
                $table .= "<tr><td>" . $actor['height'] . "</td></tr>";
            }
            $table .= "</table>" . PHP_EOL;
        } else {
            $table = "NO DATA" . PHP_EOL;
        }
        return $table;
    }catch(PDOException $e){
        die("There was a problem");
    }
}
function addActor($db, $fName, $lName, $dob, $height){
    try{
        $sql = $db->prepare("INSERT INTO actors VALUES (null, :fName, :lName, :dob, :height)");
        $sql->bindParam(':fName', $fName);
        $sql->bindParam(':lName', $lName);
        $sql->bindParam(':dob', $dob);
        $sql->bindParam(':height', $height);
        $sql->execute();
        return $sql->rowCount();
    }catch (PDOException $e) {
        die("There was a problem adding actor");
    }
}
function getActor($db, $id){
    $sql = $db->prepare("SELECT * FROM actors WHERE id = :id");
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    return $row;
}

