<?php
$table = "<table>\n"; //empty table var
//$color = A3BC34;
$color = array();
for($i = 0; $i < 100; $i++){

    $r1 = dechex(mt_rand(0, 15));
    $r2 = dechex(mt_rand(0, 15));
    $g1 = dechex(mt_rand(0, 15));
    $g2 = dechex(mt_rand(0, 15));
    $b1 = dechex(mt_rand(0, 15));
    $b2 = dechex(mt_rand(0, 15));

    $color[$i] = $r1 .= $r2 .= $g1 .= $g2 .= $b1 .= $b2;
}
$counter = 0;
for($rows = 1; $rows <= 10; $rows++){
    $table .= "\t<tr>";
    for($cols = 1; $cols <= 10; $cols++) {
        $table .= "<td style='background-color:#$color[$counter];'>" . $color[$counter] . "<br />" . "<span style='color:#ffffff;'>" . $color[$counter] . "</span>" . "</td>";
        $counter++;
    }

    $table .= "</tr>\n";
}

$table .="</table>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LAB 1</title>
    <style>
        td{
            height: 70px;
            width: 70px;
            text-align: center;
        }
        span{
            font-family: helvetica;
        }
    </style>
</head>
<body>
<?php echo $table ?>
</body>
</html>