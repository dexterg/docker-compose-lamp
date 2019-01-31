<?php
//var_dump($_POST);
if (isset($_POST['title']) && isset($_POST['price']) ) {
    require("lib.php");

    $title = $_POST['title'];
    $price = $_POST['price'];
 
    $object = new CRUD();
 
    $object->Create($title, $price);
}
?>
