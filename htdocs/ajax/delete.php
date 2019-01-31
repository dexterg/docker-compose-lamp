<?php
if (isset($_POST['id']) && isset($_POST['id']) != "") {
    require 'lib.php';
    $book_id = $_POST['id'];
 
    $object = new CRUD();
    $object->Delete($book_id);
}
?>
