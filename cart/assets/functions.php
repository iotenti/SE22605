<?php
function checkUserName($db, $email){
    try{//CHECK TO SEE IF RECORD EXISTS
        $sql = $db->prepare("SELECT * FROM users WHERE `email`='$email'");
        $sql->execute();
        return $sql->RowCount();
    }catch(PDOException $e){//if it fails, throw the exception and display error message.
        die("There was a problem");
    }
}
function addUser($db, $email, $pwd){
    try{
        $hash = password_hash($pwd, PASSWORD_DEFAULT);

        $sql = $db->prepare("INSERT INTO users VALUES (null, :email, :password, NOW())");
        $sql->bindParam(':email', $email);
        $sql->bindParam(':password', $hash);
        $sql->execute();
        $message = "Welcome to the site! Please log in";

        return $message;
    }catch(PDOException $e){
        die("There was a problem connecting to the database");
    }
}
function addCategory($db, $prodCategory){
    try{
        $sql = $db->prepare("INSERT INTO `categories`(`category_id`, `category`) VALUES (null, :category)");
        $sql->bindParam(':category', $prodCategory);
        $sql->execute();
        $message = $sql->RowCount() . " Rows inserted.";

        return $message;
    }catch(PDOException $e){
        die("There was a problem connecting to the database");
    }
}
function getCategory($db, $id){
    try{
        $sql = $db->prepare("SELECT * FROM categories WHERE category_id=:category_id"); //get products with unique key
        $sql->bindParam(':category_id', $id); //bind the var
        $sql->execute(); //do it
        $category = $sql->fetchALL(PDO::FETCH_ASSOC);
        foreach($category as $ukAndCategory){
            $result = $ukAndCategory['category_id'] . "|" . $ukAndCategory['category']; //smash unique key and category name together because I take them apart later (explode)
        }

    }catch(PDOException $e) {
        die("There was a problem getting records from the db ---- " . $e);
    }
    return $result;
}
function addProduct($db, $id, $prodName, $prodPrice, $imageName){
    try{
        $sql = $db->prepare("INSERT INTO `products`(`product_id`, `category_id`, `product`, `price`, `image`) VALUES (null, :category_id, :product, :price, :image)");
        $sql->bindParam(':category_id', $id);
        $sql->bindParam(':product', $prodName);
        $sql->bindParam(':price', $prodPrice);
        $sql->bindParam(':image', $imageName);
        $sql->execute();
        $message = $sql->RowCount() . " Rows inserted.";

        return $message;
    }catch(PDOException $e){
        die("There was a problem connecting to the database");
    }
}
function getProducts($db, $id){
    try{
        $sql = $db->prepare("SELECT * FROM products WHERE category_id=:category_id"); //get products with primary key of desired category
        $sql->bindParam(':category_id', $id); //bind the var
        $sql->execute(); //do it
        $products = $sql->fetchALL(PDO::FETCH_ASSOC);

    }catch(PDOException $e) {
        die("There was a problem getting records from the db ---- " . $e);
    }
   return $products;
}
function getAProduct($db, $pk){
    try{
        $sql = $db->prepare("SELECT * FROM products WHERE product_id=:product_id"); //get products with primary key of desired category
        $sql->bindParam(':product_id', $pk); //bind the var
        $sql->execute(); //do it
        $products = $sql->fetchALL(PDO::FETCH_ASSOC);

    }catch(PDOException $e) {
        die("There was a problem getting records from the db ---- " . $e);
    }
    return $products;
}
function getProductsAsAdminTable($products){
    if(count($products) > 0){ //if there is data...    ////make headers

        $db = dbConn();
        $table = "<div style='float:left; position:absolute; margin-left:500px;'>" . PHP_EOL;
        $table .= "<table class='admin'>" . PHP_EOL;
        $table .= "<tr>" . PHP_EOL;
        $table .= "<th class='admin'>Product ID</th>" . PHP_EOL;
        $table .= "<th class='admin'>Product Name</th>" . PHP_EOL;
        $table .= "<th class='admin'>Price</th>" . PHP_EOL;
        $table .= "<th class='admin'>Image</th>" . PHP_EOL;
        $table .= "<th class='admin'>&nbsp;</th>" . PHP_EOL;
        $table .= "</tr>";
        foreach($products as $product){ //make a table
            $pk = $product['product_id'];
            $path = "<img src='uploads/";
            $image = $product['image'];
            $table .= "<tr><td class='admin'>" . $product['product_id'] . "</td>";
            $id = $product['category_id'];
            $id = getCategory($db, $id);

            $table .= "<td class='admin'>" . $product['product'] . "</td>";
            $table .= "<td class='admin'>" . $product['price'] . "</td>";
            $table .= "<td class='admin'>" . $path . $image . "'>" . "</td>";
            $table .= "<td class='admin'>" . "<a href='admin.php?pk=$pk&id=$id&action=Edit'>Edit</a> | <a href='admin.php?pk=$pk&id=$id&action=Delete'>Delete</a>" . "</td>";
        }
        $table .= "</table>" . PHP_EOL;
        $table .= "</div>" . PHP_EOL;
    }else{ //no data, error message
        $table = "<div style='float:right; margin-right:1000px;'>" . PHP_EOL;
        $table .= "NO DATA TO TABLE" . PHP_EOL;
        $table .= "</div>" . PHP_EOL;
    }
    return $table;
}
function addToCart($db, $product){

    foreach($product as $toCart){
        $pk = $toCart['product_id'];
        $prodName = $toCart['product'];
        $prodPrice = $toCart['price'];
        $imageName = $toCart['image'];
    }
    $prod = [
        'id'=>$pk,
        'name'=>$prodName,
        'price'=>$prodPrice,
        'image'=>$imageName];

    $_SESSION['cart'][] = $prod;

    echo "prod: <br />";
    print_r($prod);
    echo "<br /> cart : <br />";
   print_r($_SESSION['cart']);
    echo "<br />";
    for($i=0; $i <= 5; $i++){
        print_r($_SESSION['cart'][$i]);
        echo "<br />";

    }
}
function getProductsAsFrontEndTable($products){
    if(count($products) > 0){ //if there is data...    ////make headers

        $db = dbConn();
        $table = "<div style='float:left; position:absolute; margin-left:500px;'>" . PHP_EOL;
        $table .= "<table class='front'>" . PHP_EOL;
        $table .= "<tr>" . PHP_EOL;
        $table .= "<th class='front'>Product ID</th>" . PHP_EOL;
        $table .= "<th class='front'>Product Name</th>" . PHP_EOL;
        $table .= "<th class='front'>Price</th>" . PHP_EOL;
        $table .= "<th class='front'>Image</th>" . PHP_EOL;
        $table .= "<th class='front'>&nbsp;</th>" . PHP_EOL;
        $table .= "</tr>";
        foreach($products as $product){ //make a table
            $pk = $product['product_id'];
            $path = "<img src='assets/uploads/";
            $image = $product['image'];
            $table .= "<tr><td class='front'>" . $product['product_id'] . "</td>";
            $id = $product['category_id'];
            $id = getCategory($db, $id);

            $table .= "<td class='front'>" . $product['product'] . "</td>";
            $table .= "<td class='front'>" . $product['price'] . "</td>";
            $table .= "<td class='front'>" . $path . $image . "'>" . "</td>";
            $table .= "<td class='front'>" . "<a href='index.php?pk=$pk&id=$id&action=Add'>Add to cart</a>" . "</td>";
        }
        $table .= "</table>" . PHP_EOL;
        $table .= "</div>" . PHP_EOL;
    }else{ //no data, error message
        $table = "<div style='float:right; margin-right:1000px;'>" . PHP_EOL;
        $table .= "NO DATA TO TABLE" . PHP_EOL;
        $table .= "</div>" . PHP_EOL;
    }
    return $table;
}
function getPK($db, $prodName){ //passed url from drop down menu
    try{
        $sql = $db->prepare("SELECT product_id FROM products WHERE product=:product"); //ping the db to get the primary key
        $sql->bindParam(':product', $prodName);
        $sql->execute();
        $pk = $sql->fetchALL(PDO::FETCH_ASSOC);
        $result = "";

        foreach ($pk as $primaryKey){ //assign primary key to a variable to return.
            $result = $primaryKey['product_id'];
        }
    }catch(PDOException $e){
        die("There was a problem getting records from the db");
    }
    return $result;
}
function deleteProduct($db, $pk){
    try{
        $sql = $db->prepare("DELETE FROM products WHERE product_id = :id"); //select all with a particular id (primary key)
        $sql->bindParam(':id', $pk, PDO::PARAM_INT);
        $sql->execute();
        $success = "Record successfully deleted";
        echo $success;
    }catch(PDOException $e){ //if it fails, throw the exception and display error message.
        die("There was a problem");
    }
}
function login($db, $email, $logInPwd){
    try{
        $sql = $db->prepare("SELECT password FROM users WHERE `email`='$email'"); //find all rows where username and password match.
        $sql->execute();
        $result = $sql->fetchALL(PDO::FETCH_ASSOC);

        foreach($result as $hashedPwd){
            $pw = $hashedPwd['password'];
        }

        if($sql->RowCount() > 0) {//email address found now check password
            if(password_verify($logInPwd, $pw)) { //use for validation
                $message = $sql->RowCount();
            }
        }else{//fail
            $message = $sql->RowCount();
        }
        return $message;
    }catch(PDOException $e){
        die("There was a problem connecting to the database:  " . $e->getMessage());
    }
}
function getCategoriesDropDown($db){
    try{
        $sql = "SELECT * FROM categories";
        $sql = $db->prepare($sql);
        $sql->execute(); //executes statement
        $categories = $sql->fetchALL(PDO::FETCH_ASSOC); //gets data and dumps it into array called corps.

        if($sql->rowCount() > 0){ //if there is data, pop it out into a dropdown.
            $dropDown = "<option value=''>Select...</option>" . PHP_EOL;
            foreach($categories as $category){

                $dropDown .= "<option value='" . $category['category_id'] . "|" . $category['category'] . "'>" . $category['category'] . "</option>";
            }
        } else { //if there is not any data, say so.
            $dropDown = "NO DATA" . PHP_EOL;
        }
        return $dropDown; //return it.

    }catch(PDOException $e){ //if it fails, throw the exception and display error message.
        die("There was a problem creating drop down");
    }
}
function updateACategory($db, $prodCategory, $id){
        try{
            $sql = $db->prepare("UPDATE categories SET category=:category WHERE category_id='$id'");
            $sql->bindParam(':category', $prodCategory); //bind "place holders" to vars passed from forms. helps with security.
            $sql->execute();

            return $sql->rowCount() . " row updated.";
        }catch (PDOException $e) { //if it fails, throw the exception and display error message.
            die($e);
        }
}
function updateAProduct($db, $pk, $prodName, $id, $prodPrice, $imageName){
    try{ // product_id, category_id=5, product=farts102, price=12, image=fart.jpg WHERE product_id=1
        $sql = $db->prepare("UPDATE products SET category_id=:category_id, product=:product, price=:price, image=:image WHERE product_id='$pk'");
        $sql->bindParam(':category_id', $id);
        $sql->bindParam(':product', $prodName); //bind "place holders" to vars passed from forms. helps with security.
        $sql->bindParam(':price', $prodPrice);
        $sql->bindParam(':image', $imageName);
        $sql->execute();

        return $sql->rowCount() . " row updated.";
    }catch (PDOException $e) { //if it fails, throw the exception and display error message.
        die($e);
    }
}
function deleteACategory($db, $id){
    try{
        $sql = $db->prepare("DELETE FROM categories WHERE category_id=:id"); //select all with a particular id (primary key)
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $success = "Record successfully deleted";
        echo $success;
    }catch(PDOException $e){ //if it fails, throw the exception and display error message.
        die($e);
    }
}

