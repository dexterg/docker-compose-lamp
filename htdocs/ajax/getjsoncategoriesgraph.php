<?php

require 'lib.php';

$object = new CRUD();

// Design initial table header

$categories = $object->Read_for_categories_graph();
 
$data = array();

foreach ($categories as $categorie) {
	$data[] = $categorie; 
}
 
echo json_encode($data);
 
?>
