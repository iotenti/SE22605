<?php
include_once("assets/header.php");

?>

    <div class="col-lg-12">
        <h1>Daily Schedule</h1>
    </div>
    <div class="col-sm-4">
        <h3><?php echo date('l F d o') ?></h3>
    </div>
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <h3><?php echo date('g:i a') ?></h3>
    </div>
    <div class="col-lg-12">
        
    </div>


<?php

include_once("assets/footer.php");






// This is important for later
// Prints: July 1, 2000 is on a Saturday
//echo "July 1, 2000 is on a " . date("l", mktime(0, 0, 0, 7, 1, 2000));