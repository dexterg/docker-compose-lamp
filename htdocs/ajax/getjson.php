<?php

require 'lib.php';

$object = new CRUD();

// Design initial table header

$categories = $object->Read_categories();
 
$data = array();

foreach ($categories as $category) {
	$data[] = $category; 
}

echo json_encode($data);
 
?>
