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
        $pk = $db->lastInsertId();
        //$message = $sql->rowCount() . " record added.";
        return $pk;
    }catch (PDOException $e) { //if it fails, throw the exception and display error message.
        die("There was a problem adding the corporation");
    }
}
function URLisValid($db, $url){
    try{//CHECK TO SEE IF RECORD EXISTS
        $sql = $db->prepare("SELECT * FROM sites WHERE `site` LIKE '%$url%'");
        $sql->execute();
        $sites = $sql->fetchALL(PDO::FETCH_ASSOC);

        if (count($sites) > 0){ //checks if record exists, if it does, display error message and fall repopulated form
            echo "This record already exists";
            curlIt($url);
            include_once("assets/form.php");
        }else{
            $pk = addSite($db, $url); //if not, add it.
            echo "1 record added.";
            $file = curlIt($url);
            findLinks($db, $file, $pk);
            //displayLinks($file);
        }
    }catch(PDOException $e){//if it fails, throw the exception and display error message.
        die("There was a problem");
    }
}
function curlIt($url){
    $file = file_get_contents($url);
    if($file == false){
        echo "There was an error getting file contents";
    }else{
        return $file;
    }
}
function displayLinks($file){ //MAKE DROP BOX LATER**********
    $pattern = "/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/";
    preg_match_all($pattern, $file, $matches, PREG_PATTERN_ORDER);

    $table = "<h1>Links</h1>" . PHP_EOL;
    $table .= "<table>" . PHP_EOL;
    if (is_array($matches) || is_object($matches))
    {
        $tempArray = array_unique($matches[1]);
        $tempArray = array_values($tempArray);

        foreach ($tempArray as $url){
            $table .= "<tr><td>" . $url . "</td></tr>";
        }

    }  else {
        echo "NOT AN ARRAY";
    }
    $table .= "</table>";
    return $table;
}
function findLinks($db, $file, $pk){
    $pattern = "/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/";
    preg_match_all($pattern, $file, $matches, PREG_PATTERN_ORDER);

    if (is_array($matches) || is_object($matches))
    {
        $tempArray = array_unique($matches[1]);
        $tempArray = array_values($tempArray);

        foreach ($tempArray as $url){

             $sql = $db->perpare("INSERT INTO sitelinks VALUES (:link, :site_id)");
             $sql ->bindParams(':link', $url);
             $sql ->bindParams(':site_id', $pk);
             $sql->execute();
             $message = $sql->rowCount() . "records added.";
        }

    }  else {
        echo "NOT AN ARRAY";
    }
    return $message;
}