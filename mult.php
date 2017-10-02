<?php
$table = "<table>\n"; //empty table var
for($rows = 0; $rows < 5; $rows++){
    $table .= "\t<tr>";
    $table .= "</tr>\n";
}
$table .="</table>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>mult tab</title>
</head>
<body>
<?php echo $table ?>
</body>
</html>