<?php
/**
 * Created by PhpStorm.
 * User: iotenti
 * Date: 11/12/2017
 * Time: 12:06 PM
 */
function getSitesAsTable($db){
    try{
        $sql = "SELECT * FROM sites";  //select statement. selects all from actors. Set to a var.
        $sql = $db->prepare($sql); //I think this plugs the statement into a method which helps to protect from sql injections.
        $sql->execute(); //executes statement
        $sites = $sql->fetchALL(PDO::FETCH_ASSOC); //gets data and dumps it into var called corps.
        if($sql->rowCount() > 0){ //if there is data, pop it out into a table.
            $table = "<div style='padding:15px; margin-top:25px;'>" . PHP_EOL;
            $table .= "<table>" . PHP_EOL;
            foreach($sites as $site){
                $table .= "<tr><td>" . $site['site'] . "</td>";
                $table .= "<td>" . date("m/d/Y", strtotime($site['date'])) . "</td>";
            }
            $table .= "</table>" . PHP_EOL;
            $table .= "</div>" . PHP_EOL;
        } else { //if there is not any data, say so.
            $table = "NO DATA" . PHP_EOL;
        }
        return $table; //return it.
    }catch(PDOException $e){ //if it fails, throw the exception and display error message.
        die("There was a problem");
    }
}
function addSite($db, $url){ //function to add actor to the database
    try{
        $sql = $db->prepare("INSERT INTO sites VALUES (null, :site, NOW())"); //create a var = to sql insert statement.
        $sql->bindParam(':site', $url); //bind "place holders" to vars passed from forms. helps with security.
        $sql->execute();
        $message = $sql->rowCount() . " record added.";
        echo $message;
    }catch (PDOException $e) { //if it fails, throw the exception and display error message.
        die("There was a problem adding the corporation");
    }
}
function validURL($db, $url){
    try{//CHECK TO SEE IF RECORD EXISTS
        $sql = $db->prepare("SELECT * FROM sites WHERE `site` LIKE '%$url%'");
        $sql->execute();
        $sites = $sql->fetchALL(PDO::FETCH_ASSOC);

        if (count($sites) > 0){ //checks if record exists, if it does, display error message and fall repopulated form
            echo "This record already exists";
            include_once("assets/form.php");
        }else{
            echo addSite($db, $url); //if not, add it.
        }
    }catch(PDOException $e){//if it fails, throw the exception and display error message.
        die("There was a problem");
    }
}
function curlIt($url){
    try{
        $file = file_get_contents('$url'); //curl
        return $file;
    }catch(PDOException $e){
        die("There was an error getting file contents");
    }


}
