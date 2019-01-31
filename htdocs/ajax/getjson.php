<?php

require 'lib.php';

$object = new CRUD();

// Design initial table header

$books = $object->Read_for_graph();
 
$data = array();
foreach ($books as $book) {
	$data[] = $book; 
}
 
echo json_encode($data);
 
?>
