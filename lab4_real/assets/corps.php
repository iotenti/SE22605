<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 10/18/2017
 * Time: 10:24 AM
 */
function getCorpsAsTable($db, $corps){ //PROBLEM COULD BE WITH TRY/CATCH
    try{
        setlocale(LC_MONETARY, 'en_US.UTF-8');
        if(count($corps) > 0) { //if there is data, pop it out into a table.
            $table = "<table>" . PHP_EOL;
            foreach($corps as $corp){
                $id = $corp['id'];  //might be redundant
                $readLink = "<a href='assets/read.php?id=$id'>Read</a>"; //made a var to dump into link
                $updateLink = "<a href='assets/update.php?id=$id'>Update</a>";
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
function getViewAllCorpsAsTable($db, $corps, $cols = null) //I made a sortable table to show all columns. this is it
{
    try {
        setlocale(LC_MONETARY, 'en_US.UTF-8');
        if (count($corps) > 0) { //if there is data, pop it out into a table.
            $table = "<table>" . PHP_EOL;
            if ($cols) {
                $table .= "\t<tr>";
                foreach ($cols as $col) {
                    $table .= "<th>$col</th>"; //build column headers as anchors
                }
                $table .= "</tr>" . PHP_EOL;
            }
            foreach ($corps as $corp) {
                $table .= "<tr><td>" . $corp['id'] . "</td>";
                $table .= "<td>" . $corp['corp'] . "</td>";
                $table .= "<td>" . date('m/d/Y', strtotime($corp['incorp_dt'])) . "</td>";
                $table .= "<td>" . $corp['email'] . "</td>";
                $table .= "<td>" . $corp['zipcode'] . "</td>";
                $table .= "<td>" . $corp['owner'] . "</td>";
                $table .= "<td>" . $corp['phone'] . "</td>";
                $table .= "</tr>" . PHP_EOL;
            }
            $table .= "</table>" . PHP_EOL;
        } else { //if there is not any data, say so.
            $table = "NO DATA" . PHP_EOL;
        }
        return $table; //return it.
    } catch (PDOException $e) {
        die("There was a problem"); //if it fails, throw the exception and display error message.
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
                $updateLink = "<a href='assets/update.php?id=$id'>Update</a>";
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
        $sql->bindParam(':email', $email);
        $sql->bindParam(':zipcode', $zipcode);
        $sql->bindParam(':owner', $owner);
        $sql->bindParam(':phone', $phone);
        $sql->execute();
        $message = $sql->rowCount() . " record added.";
        echo $message;
    }catch (PDOException $e) { //if it fails, throw the exception and display error message.
        die("There was a problem adding the corporation");
    }
}
function updateCorp($db, $id, $corp, $email, $zipcode, $owner, $phone){ //function to add actor to the database
    try{
        $sql = $db->prepare("UPDATE corps SET corp = :corp, email = :email, zipcode = :zipcode, owner = :owner, phone = :phone WHERE id = :id"); //create a var = to sql insert statement.
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->bindParam(':corp', $corp); //bind "place holders" to vars passed from forms. helps with security.
        $sql->bindParam(':email', $email);
        $sql->bindParam(':zipcode', $zipcode);
        $sql->bindParam(':owner', $owner);
        $sql->bindParam(':phone', $phone);
        $sql->execute();
        return $sql->rowCount() . " row updated.";
    }catch (PDOException $e) { //if it fails, throw the exception and display error message.
        die("There was a problem adding the corporation");
    }
}
function getCorp($db, $searchID){ //this will be used to update and delete, I think. Will be used to grab a specific record by primary key number.
    $sql = $db->prepare("SELECT * FROM corps WHERE id = :id"); //select all with a particular id (primary key)
    $sql->bindParam(':id', $searchID, PDO::PARAM_INT);
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
    $table .= "<td style='padding:15px;'>" . date("m/d/Y", strtotime($corp['incorp_dt'])) . "</td>";
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

    return $corp;
}
function getCorporations($db) {
    try {
        $sql = "SELECT * FROM corps";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die ("There was a problem getting the table of employees");
    }
    return $corps;
}
function getCorpsAsSortedTable($db, $col, $dir){
    try {
        if($col == NULL){ //make a default value for sorting
            $col = "id";
        }
        if($dir == NULL){ //default value of ORDER BY
            $dir = "ASC";
        }
        $sql = "SELECT * FROM corps ORDER BY $col $dir";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $corps = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die ("There was a problem getting the table of corporations");
    }
    return $corps;
}
function searchCorp($db, $colSearch, $search){
    try {
        if($colSearch == NULL){ //default value for where if it's NULL
            $colSearch = 'id';
        }
        $sql = "SELECT * FROM corps WHERE $colSearch LIKE '%$search%'"; //search statement
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $table = "<table>" . PHP_EOL;
        $table .= "<tr><td>" . $stmt->rowCount() . " records found.</td></tr>". PHP_EOL;
        foreach($corps as $corp){
            $id = $corp['id'];  //might be redundant
            $readLink = "<a href='assets/read.php?id=$id'>Read</a>"; //made a var to dump into link
            $updateLink = "<a href='assets/update.php?id=$id'>Update</a>";
            $deleteLink = "<a href='assets/delete.php?id=$id'>Delete</a>";

            $table .= "<tr><td>" . $corp['corp'] . "</td>";
            $table .= "<td>$readLink</td>";
            $table .= "<td>$updateLink</td>";
            $table .= "<td>$deleteLink</td>";
        }
        $table .= "</table>" . PHP_EOL;
        return $table;

    } catch (PDOException $e) {
        die ("No Records Found");
    }

}
function viewAllSearchCorp($db, $cols, $colSearch, $search){ //I made a searchable table that displays all columns, also.
    try {
        $sql = "SELECT * FROM corps WHERE $colSearch LIKE '%$search%'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $corps = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $table = "<table>" . PHP_EOL;
        $table .= "<tr><td>" . $stmt->rowCount() . " records found.</td></tr>". PHP_EOL;
        if ($cols) {
            $table .= "\t<tr>";
            foreach ($cols as $col) {
                $table .= "<th>$col</th>"; //build column headers as anchors ********************might need to re-purpose later***************************
            }
            $table .= "</tr>" . PHP_EOL;
        }
        foreach ($corps as $corp) {
            $table .= "<tr><td>" . $corp['id'] . "</td>";
            $table .= "<td>" . $corp['corp'] . "</td>";
            $table .= "<td>" . date('m/d/Y', strtotime($corp['incorp_dt'])) . "</td>";
            $table .= "<td>" . $corp['email'] . "</td>";
            $table .= "<td>" . $corp['zipcode'] . "</td>";
            $table .= "<td>" . $corp['owner'] . "</td>";
            $table .= "<td>" . $corp['phone'] . "</td>";
            $table .= "</tr>" . PHP_EOL;
        }
        $table .= "</table>" . PHP_EOL;
        return $table;

    } catch (PDOException $e) {
        die ("No Records Found");
    }
}
function getDropDown($cols){ //builds drop down menu for forms.
    $form =  "<option value=''>Select...</option>" . PHP_EOL;
    foreach($cols as $col){
        $form .= "<option value='" . $col . "'>" . $col . "</option>";
    }
    return $form;
}



