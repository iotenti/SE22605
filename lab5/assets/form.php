<?php
/**
 * Created by PhpStorm.
 * User: iotenti
 * Date: 11/12/2017
 * Time: 12:36 PM
 */

$site = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) ?? NULL;
?>
<form method="get" action="#">
    <table>
        <tr>
            <td>Site:</td>
            <td><input type="text" name="url" value="<?php $site ?>"></td>
        </tr>
       <tr>
           <td><input type="Submit" name="action" value="url" /></td>
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