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
           <td><input type="Submit" name="action" value="View All" /></td>
       </tr>

    </table>
</form>
<?php
// create an array to store valid links
// loop through all the links
// use this for each one:
// if (subpos($whatever[$i], "http")) {
    //found one
    // so therefore add it to the array of valid links
// } else {
    // didnt
// }

?>