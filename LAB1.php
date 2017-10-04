<?php
$table = "<table>\n"; //empty table var
$color = array();//make array called color
for($i = 0; $i < 100; $i++){//loop through to make a bunch of random colors

    $r1 = dechex(mt_rand(0, 15));//gets random num 0-15 then converts it to hex
    $r2 = dechex(mt_rand(0, 15));
    $g1 = dechex(mt_rand(0, 15));
    $g2 = dechex(mt_rand(0, 15));
    $b1 = dechex(mt_rand(0, 15));
    $b2 = dechex(mt_rand(0, 15));

    $color[$i] = $r1 .= $r2 .= $g1 .= $g2 .= $b1 .= $b2; //concatenate 6 different hex digits to one var and stores it in the array.
}
$counter = 0; //counter to change index of array
for($rows = 1; $rows <= 10; $rows++){ //makes 10 rows
    $table .= "\t<tr>"; //open tr tag
    for($cols = 1; $cols <= 10; $cols++) {//makes 10 columns
        $table .= "<td style='background-color:#$color[$counter];'>" . $color[$counter] . "<br />" . "<span style='color:#ffffff;'>" . $color[$counter] . "</span>" . "</td>";
        $counter++; //increments counter
    }

    $table .= "</tr>\n"; //close tr tag
}

$table .="</table>"; //close table tag
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