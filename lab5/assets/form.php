<?php
/**
 * Created by PhpStorm.
 * User: iotenti
 * Date: 11/12/2017
 * Time: 12:36 PM
 */
/*
 * Create a PHP form that will collect a website url. (35 points)

-For the input use a type text rather than the HTML 5 url.
-Add validation to ensure the url entered is correct.
-If the url entered is incorrect or has already been recorded in the database, display an error message, re-display the form, and re-populate the form with the incorrect value.
-If the url is correct, use curl to get the html and return it in PHP.
-If there is an error display the error to the user, and allow them to try again by displaying the form.
-If curl was successful use the html output to run a regex match of all the links on the page.
-you can use this regex to find a match on all the links in the output. /(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/
-Make sure all the links found are unique. All links must start with http.
-Insert the link into the sites table.  Get a reference to the lastInsertId.
-Use the site ID to add the relationship to each link into the sitelinks table.
-Along with a success message, display the site and the links that were just added to the database.
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