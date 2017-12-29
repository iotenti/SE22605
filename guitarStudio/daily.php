<?php
include_once("assets/header.php");

$timeZone = new DateTimeZone('America/New_York');
$today = date('l F d o e');
$dt = new DateTime($today, $timeZone);

?>

    <div class="col-lg-12">
        <h1>Daily Schedule</h1>
    </div>
    <div class="col-sm-4">
        <h3><?php echo var_dump($dt)?></h3>
    </div>
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <h3><?php echo date('g:i a') ?></h3>
    </div>


<?php
include_once("assets/footer.php");






// This is important for later
// Prints: July 1, 2000 is on a Saturday
//echo "July 1, 2000 is on a " . date("l", mktime(0, 0, 0, 7, 1, 2000));