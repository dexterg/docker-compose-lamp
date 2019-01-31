<?php
if (isset($_POST)) {
    require 'lib.php';

    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];

    $object = new CRUD();

    $object->Update($title, $price, $id);
}
?>
