<?php
/**
 * Created by PhpStorm.
 * User: iotenti
 * Date: 11/12/2017
 * Time: 12:36 PM
 */
require_once ("assets/dbconn.php");
$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) ?? NULL;
?>
<form method="get" action="#">
    <table>
        <tr>
            <td>Site:</td>
            <td><input type="text" name="url" value="<?php echo $url ?>"></td> <!-- to repopulate the form -->
        </tr>
       <tr>
           <td><input type="Submit" name="action" value="Submit" /></td>
       </tr>
    </table>
</form>
