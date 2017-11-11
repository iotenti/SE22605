<?php
//CURL is a library on top of php.
//PCRE - pearl compatible reg ex
//PCRE functions exist.

session_start(); //indicates that this script needs access to session vars
$_SESSION['username'] = "Ian";
if($_SESSION['username'] == NULL || !isset($_SESSION['username']) ){
    header('Location: login.php'); //must be nothing sent to the browser before this. ---no html, not even a blank line. check session var before you do anything else.
}

$file = file_get_contents("http://www.cnn.com"); //CURL
$pattern = "/Trump/";

echo preg_match_all($pattern, $file, $matches, PREG_OFFSET_CAPTURE); //returns int - 1 for true, 0 false * PREG_OFFSET_CAPTURE shows where the word 'Trump' shows up
print_r($matches);

$greps = preg_grep($pattern, $file); //does not work, need to figure out how to break page up in an array
print_r($greps);

//preg_split returns an array


//grabbing an primary key//
/*
$db = get db
$sql = "INSERT INTO table VALUES (null, 'ian', 'Otenti');
$stmt = $db->prepare($sql);
    bind params if we had any, which we don't
$stmt->execute();
$pk = $db->lastInsertId();   gets the key of the last inserted record. Use it in the next insert statement as the foreign key value (0 returned means the insert didn't happen)
*/

$pwd = "password";
$hash = password_hash($pwd, PASSWORD_DEFAULT); //only use when storing

//use char to save passwords figure out how long it is and use that number//

echo "<p>" . strlen(password_hash($pwd, PASSWORD_DEFAULT)) . "</p>";

$loginpwd = "password"; //got form text box//

if(password_verify($loginpwd, $hash)){ //use for validation
    echo "valid";
}else{
    echo "invalid";
}

/// SHOPPING CART ::: array of arrays ::: store shopping cart as a session var
/// cart is an array. init as empty array.
/// when product is grabbed,
///
///
/// $cart = [];
/// $prod = ['id'=>4,
///         'name'=>'passport',
///         'price'=>'$70',
///         'qty'=>1];
///
///
/// order items and orders are not the same as cart. need 2 tables. store price in order items table.
/// don't now about this
///
/// use GET to pass product ID
///
/// create admin page first, make sure it works. then password protect it
/// then make the customer page
/// index.php for both
///
/// must have separate admins table with admin id, adnmin name, admin pass
/// OR YOU can put a bool in users table to see if they are admin. don't know how to do that.