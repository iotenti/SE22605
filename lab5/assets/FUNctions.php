<?php
/**
 * Created by PhpStorm.
 * User: iotenti
 * Date: 11/12/2017
 * Time: 12:06 PM
 */
function getSitesAsDropDown($db){
    try{
        $sql = "SELECT * FROM sites";  //select statement. selects all from actors. Set to a var.
        $sql = $db->prepare($sql); //I think this plugs the statement into a method which helps to protect from sql injections.
        $sql->execute(); //executes statement
        $sites = $sql->fetchALL(PDO::FETCH_ASSOC); //gets data and dumps it into var called corps.
        if($sql->rowCount() > 0){ //if there is data, pop it out into a table.
            $dropDown = "<option value=''>Select...</option>" . PHP_EOL;
            foreach($sites as $site){
                $dropDown .= "<option value='" . $site['site'] . "'>" . $site['site'] . "</option>";
            }
        } else { //if there is not any data, say so.
            $dropDown = "NO DATA" . PHP_EOL;
        }
        return $dropDown; //return it.
    }catch(PDOException $e){ //if it fails, throw the exception and display error message.
        die("There was a problem creating drop down");
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
            echo "<b>" . $url . "</b>" . " added to the database.";
            $file = curlIt($url);
            insertLinks($db, $file, $pk);
            echo displayLinks($file, $url);
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
function displayLinks($file, $url){ //MAKE DROP BOX LATER**********
    $pattern = "/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/";
    preg_match_all($pattern, $file, $matches, PREG_PATTERN_ORDER);

    $table = "<h1>Success!</h1>" . PHP_EOL;
    $table .= "<h4>Links from " . $url ."</h4>" . PHP_EOL;
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
function insertLinks($db, $file, $pk){
    try{
        $pattern = "/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/";
        preg_match_all($pattern, $file, $matches, PREG_PATTERN_ORDER);

        if (is_array($matches) || is_object($matches))
        {
            $tempArray = array_unique($matches[1]);
            $tempArray = array_values($tempArray);

            foreach ($tempArray as $url){
                $sql = $db->prepare("INSERT INTO sitelinks (site_id, link) VALUES (:site_id, :link)");
                $sql->bindParam(':site_id', $pk);
                $sql->bindParam(':link', $url);
                $sql->execute();
                $message = $sql->rowCount() . "records added.";
            }
        }  else {
            echo "NOT AN ARRAY";
        }
        return $message;
    }catch(PDOException $e){
        die("there was an error inserting links into the database");
    }

}