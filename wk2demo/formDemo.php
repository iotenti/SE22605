<?php
/* older method:
$submit = isset($_GET['submit']) ? $_GET['submit'] : "";
echo $submit;
*/

$dsn = "mysql:host=localhost;dbname=dogs";
$username = "dogs";
$password = "se266";

try{
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $submit = $_GET['submit'] ?? ""; //null coalesce operator
    if($submit == "do it"){
        $name = $_GET['name'] ?? ""; //associative array
        $gender = $_GET['gender'] ?? "";
        $fixed = $_GET['fixed'] ?? "N";

        $sql = $db->prepare("INSERT INTO dogs VALUES (null, :name, :gender, :fixed)");
        $sql->bindParam(':name', $name);
        $sql->bindParam(':gender', $gender);
        $sql->bindParam(':fixed', $fixed);
        $sql->execute();
        echo $sql->rowCount() . " rows inserted.";
    }
}catch(PDOException $e){
    die("The was a problem connecting to the database.");//print out error message.
}


?>
<form method="get" action="#">
    <input type="text" name="name" value="" /><br />
    <input type="radio" name="gender" value="M"><br />
    <input type="radio" name="gender" value="F"><br />
    <input type="checkbox" name="fixed" value="Y" /><br />
    <input type="submit" id="foo" name="submit" value="do it" />
</form>
<?php
$sql = $db->prepare("SELECT * FROM dogs");
$sql->execute();
$results = $sql->fetchAll();

if(count($results)){
    foreach($results as $dog){
        print_r($dog);
    }
}
?>
