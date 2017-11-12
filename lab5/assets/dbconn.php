<?php
/**
 * Created by PhpStorm.
 * User: 005505537
 * Date: 10/18/2017
 * Time: 10:25 AM
 */
function dbConn(){ //function to connect to database
    $dsn = "mysql:host=localhost;dbname=phpclassfall2017"; //connection string dumped into var dsn
    $username = "actors"; //username and password put into vars.
    $password = "se266";
    try{
        $db = new PDO($dsn, $username, $password); //PHP Data Object, connection string, password, username used as vars for security? ?
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//not sure.
        return $db;//return the database connection
    }catch(PDOException $e) { //print out error message if there is a problem.
        die("There was a problem connecting to the database, please do a better job.");
    }
}
function getColumnNames($db, $tbl){

    $sql = "select column_name from information_schema.columns where lower(table_name)=lower('". $tbl . "')";
    $stmt = $db->prepare($sql);
    try {
        if($stmt->execute()):
            $raw_column_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($raw_column_data as $outer_key => $array):
                foreach($array as $inner_key => $value):
                    if (!(int)$inner_key):
                        $column_names[] = $value;
                    endif;
                endforeach;
            endforeach;
        endif;
    } catch (Exception $e){
        die("There was a problem retrieving the column names");
    }
    return $column_names;
}