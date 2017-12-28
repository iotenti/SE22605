<?php
include_once("assets/header.php");
?>
    <h1>Today</h1>
<div>
    <h3><?php echo date('l F d o') ?></h3>
    <h6><?php echo date('g:i a') ?></h6>
</div>

<?php
include_once("assets/footer.php");






// This is important for later
// Prints: July 1, 2000 is on a Saturday
//echo "July 1, 2000 is on a " . date("l", mktime(0, 0, 0, 7, 1, 2000));