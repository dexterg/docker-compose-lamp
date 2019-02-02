<?php
if (isset($_POST)) {
    require 'lib.php';

    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
	$id_category = $_POST['id_category'];

	//var_dump($_POST);

    $object = new CRUD();

    $object->Update($title, $price, $id_category, $id);
}
?>
