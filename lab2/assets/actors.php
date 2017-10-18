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
        $dogs = $sql->fetchALL(PDO::FETCH_ASSOC);
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