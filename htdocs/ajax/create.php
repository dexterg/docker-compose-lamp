<?php
if (isset($_POST['title']) && isset($_POST['price']) && isset($_POST['id_category']) ) {
    require("lib.php");

    $title = $_POST['title'];
    $price = $_POST['price'];
    $id_category = $_POST['id_category'];
 
    $object = new CRUD();
 
    $object->Create($title, $price, $id_category);
}
?>
