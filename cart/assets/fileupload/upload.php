<?php
if(!isset($_FILES['file'])){
    $_FILES['file']['name'] = null;
} else{
    $name = $_FILES['file']['name'];
    $temp_name = $_FILES['file']['tmp_name'];
}


if(isset($name)){
    if(!empty($name)){
        $location = '../uploads/';
        if(move_uploaded_file($temp_name, $location . $name)){
            echo 'Uploaded';
        }
    }else{
        echo "please choose a file";
    }

}

?>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file"><br /><br />
    <input type="submit" value="submit">
</form>