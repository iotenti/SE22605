<?php
include_once("assets/header.php");

?>
    <div id="txt"></div>
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
    <div class="col-lg-8 schedule">
        <table class="table-striped center">
            <thead>
            <tr>
                <th class="schedule"></th>
                <th class="schedule">Ian</th>
                <th class="schedule">Stevie</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="time schedule">12 pm</td>
                <!-- this is important to understand -->
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="time">12:30 pm</td>
                <td><div class="lesson">Ian Otenti</div></td>
                <td></td>
            </tr>
            <tr>
                <td class="time">1 pm</td>
                <td rowspan="2"><div class="hourLesson" style="padding-top:29px;">Addison</div></td>
                <td></td>
            </tr>
            <tr>
                <td class="time">1:30 pm</td>
                <td></td>
            </tr>
            <tr>
                <td class="time">2 pm</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="time">2:30 pm</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="time">3 pm</td>
                <td><div></div></td>
                <td><div></div></td>
            </tr>
            <tr>
                <td class="time">3:30 pm</td>
                <td><div></div></td>
                <td><div></div></td>
            </tr>
            <tr>
                <td class="time">4 pm</td>
                <td><div></div></td>
                <td><div></div></td>
            </tr>
            <tr>
                <td class="time">4:30 pm</td>
                <td></td>
                <td rowspan="2"><div class="hourLesson">Dean</div></td>
            </tr>
            <tr>
                <td class="time">5 pm</td>
                <td><div></div></td>
            </tr>
            <tr>
                <td class="time">5:30 pm</td>
                <td><div></div></td>
                <td><div></div></td>
            </tr>
            <tr>
                <td class="time">6 pm</td>
                <td><div></div></td>
                <td><div class="lesson">Matt</div></td>
            </tr>
            <tr>
                <td class="time">6:30 pm</td>
                <td><div></div></td>
                <td><div></div></td>
            </tr>
            <tr>
                <td class="time">7 pm</td>
                <td><div></div></td>
                <td rowspan="2"><div class="hourLesson">Beth</div></td>
            </tr>
            <tr>
                <td class="time">7:30 pm</td>
                <td></td>
                <td><div></div></td>
            </tr>
            <tr>
                <td class="time">8 pm</td>
                <td><div></div></td>
                <td><div></div></td>
            </tr>
            <tr>
                <td class="time">8:30 pm</td>
                <td><div></div></td>
                <td><div></div></td>
            </tr>
            </tbody>

        </table>


    </div>


<?php

include_once("assets/footer.php");






// This is important for later
// Prints: July 1, 2000 is on a Saturday
//echo "July 1, 2000 is on a " . date("l", mktime(0, 0, 0, 7, 1, 2000));