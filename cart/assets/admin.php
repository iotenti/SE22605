<?php
if(!isset($_SESSION)){
    session_start();
}

if($_SESSION['username'] == NULL || !isset($_SESSION['username']) ){
    header('Location: loginPage.php');
}

include_once ("adminHeader.php");
include_once ("dbconn.php");
include_once ('functions.php');

$db = dbConn();

$_SESSION['category'] = "";

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$prodCategory = filter_input(INPUT_POST, 'prodCategory', FILTER_SANITIZE_STRING) ?? NULL;
$id =  filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING) ?? NULL;
$pk =  filter_input(INPUT_GET, 'pk', FILTER_SANITIZE_STRING) ?? NULL;
$prodName = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING) ?? NULL;
$prodPrice = filter_input(INPUT_POST, 'prodPrice', FILTER_SANITIZE_STRING) ?? NULL;
$imageName = filter_input(INPUT_POST, 'imageName', FILTER_SANITIZE_STRING) ?? NULL;
$error = "<div style='margin-top:20px; color:red;'>";
?>
<h1>Admin tools</h1>

<?php
switch($action){
    case 'log out':
        //destroy session when logout case
        session_destroy();
        header('Location: loginPage.php');
        break;

    case 'Store':
        include_once ("../index.php");
        break;

    case 'Manage Categories':
        //if managing categories: change button for categories, and change manageproducts session var so switches work for categories instead of products
        if($action === "Manage Categories"){
            $_SESSION['button'] = "Add Category";
            $_SESSION['category'] = null;
            $_SESSION["manageProducts"] = "FALSE";
        }
        include_once("controlsForm.php");
        include_once ("categoriesForm.php");
        break;

    case 'Manage Products':
        //if managing products: change button for categories, and change manageproducts session var so switches work for products instead of categories
        if($action === "Manage Products"){
            $_SESSION['button'] = "Add Product";
            $_SESSION['category'] = null;
            $_SESSION["manageProducts"] = "TRUE";
        }
        include_once("controlsForm.php");
        include_once ("productForm.php");
        break;

    case 'Add Category' :
        //call function to add category
        echo addCategory($db, $prodCategory);
        break;

    case 'Add Product':
        //if no files have been uploaded here set $_FILE to null
        if(!isset($_FILES['file'])){
            $_FILES['file']['name'] = null;
        } else{
            //if something is there, name it and get the temp location
            $imageName = $_FILES['file']['name'];
            $temp_name = $_FILES['file']['tmp_name'];
        }
        //if there is a name
        if(isset($imageName)){
            //and the name is not empty
            if(!empty($imageName)){
                //make a location
                $location = 'uploads/';
                //move image to no location
                if(move_uploaded_file($temp_name, $location . $imageName)){

                }
            }else{
                echo "please choose a file";
            }
        }
        include_once("controlsForm.php");
        include_once ("productForm.php");
        //add product
        echo addProduct($db, $id, $prodName, $prodPrice, $imageName);
        break;

    case 'view':
        //dropdown selection form passes ID|CATEGORY NAME
        //explode to break them apart
        $result_explode = explode('|', $id);
        //set id - don't need category name here
        $id = $result_explode[0];
        //pass category id to get products from db
        $products = getProducts($db, $id);
        //get admin table to display products
        $table = getProductsAsAdminTable($products);
        echo $table;

        include_once("controlsForm.php");
        include_once ("productForm.php");
        break;

    case 'Edit':
        //change button for editing
        $_SESSION['button'] = "Update";

        if($_SESSION["manageProducts"] === "TRUE"){ //if we are dealing with products management
            //get product with pk passed from table function
            $products = getAProduct($db, $pk);
            //loop through array assign data -- use to repopulate update from
                foreach($products as $product){
                    //dropbox passes ID|CATEGORY
                    //use this explode to take them apart
                    $result_explode = explode('|', $id);
                    //set category id
                    $id = $result_explode[0];
                    //set category name
                    $_SESSION['category'] = $result_explode[1];
                    $prodName = $product['product'];
                    $prodPrice = $product['price'];
                    $imageName = $product['image'];
                }

            include_once("controlsForm.php");
            include_once ("productForm.php");
            break;
        }else{ //else we are dealing with category management
            if(strlen($id) > 0){
                //dropbox passes ID|CATEGORY
                //use this explode to take them apart
                $result_explode = explode('|', $id);
                //set category id
                $id = $result_explode[0];
                //set category name
                $_SESSION['category'] = $result_explode[1];
            }
            include_once("controlsForm.php");
            include_once ("categoriesForm.php");
            break;
        }


    case 'Add':
        //change button
        $_SESSION['button'] = "Add Product";

        if(strlen($id) > 0){
            //dropbox passes ID|CATEGORY
            //use this explode to take them apart
            $result_explode = explode('|', $id);
            //set category id
            $id = $result_explode[0];
            //set category name
            $_SESSION['category'] = $result_explode[1];
        }
        include_once("controlsForm.php");
        include_once ("productForm.php");

        break;

    case 'Update':
        //if dealing with product management
        if($_SESSION["manageProducts"] === "TRUE"){
            //if keep image checkbox not checked
            if(!isset($_POST['keepImage'])){
                //if there is no file uploaded
                if(!isset($_FILES['file'])){
                    $_FILES['file']['name'] = null;

                } else{
                    //if there is a file, name it and get the location
                    $imageName = $_FILES['file']['name'];
                    $temp_name = $_FILES['file']['tmp_name'];
                }
                //if there is a location set
                if(isset($temp_name)){
                    //if there is a name
                    if(!empty($imageName)){
                        //var containign new loc
                        $location = 'uploads/';
                        //move it
                        if(move_uploaded_file($temp_name, $location . $imageName)){
                        }
                    }else{
                    }
                }
                //update the product with new image
                echo updateAProduct($db, $pk, $prodName, $id, $prodPrice, $imageName);
                break;
            }else{
                // else keep image checkbox is checked and use old image name hidden in textbox
                echo updateAProduct($db, $pk, $prodName, $id, $prodPrice, $imageName);
                break;
            }
        }else{ //else not dealing with product management, update the category instead.
            echo updateACategory($db, $prodCategory, $id);
            break;
        }


    case 'Delete':
        //change button
        $_SESSION['button'] = "Delete Record";

        if($_SESSION['manageProducts'] === "TRUE"){ //dealing with product management
            //get product with pk passed from table function
            $products = getAProduct($db, $pk);
            //get primary key
            $pk = getPK($db, $prodName);
            //loop through array assign data -- use to repopulate update from
            foreach($products as $product){
                //dropbox passes ID|CATEGORY
                //use this explode to take them apart
                $result_explode = explode('|', $id);
                //set category id
                $id = $result_explode[0];
                //set category name
                $_SESSION['category'] = $result_explode[1];

                $prodName = $product['product'];
                $prodPrice = $product['price'];
                $imageName = $product['image'];
            }

            include_once("controlsForm.php");
            include_once ("productForm.php");
            break;
        }else{
            if(strlen($id) > 0){
                //dropbox passes ID|CATEGORY
                //use this explode to take them apart
                $result_explode = explode('|', $id);
                //set category id
                $id = $result_explode[0];
                //set category name
                $_SESSION['category'] = $result_explode[1];
            }
            include_once("controlsForm.php");
            include_once ("categoriesForm.php");
            break;

        }

    case 'Delete Record':
        if($_SESSION['manageProducts'] === "TRUE"){
            //delete product
            echo deleteProduct($db, $pk);
            break;
        }else{
            //delete category
            echo deleteACategory($db, $id);
            break;
        }
}



