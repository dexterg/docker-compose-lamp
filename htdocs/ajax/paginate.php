<?php

	require 'lib.php';
	// To paginate...
	$limitinf = $_POST['limitinf'];

	$object = new CRUD();
	$booksCount = $object->getBooksCount();
	// Print 1 2 3 3 etc to paginate
	global $limitsup;
	global $pageset;
	$pageset = 1;
	$dataPaginate = "<button class=\"btn btn-sm btn-outline-info\" onclick=\"readRecords(0)\"> << </button>&nbsp;";
	for ($i=0; $i<$booksCount; $i+=5) {
		if ($limitinf == $i ) {
			$dataPaginate .= "<button class=\"btn btn-sm btn-outline-success\" onclick=\"readRecords($i)\">$pageset</button>&nbsp;";
		} else {
			$dataPaginate .= "<button class=\"btn btn-sm btn-outline-info\" onclick=\"readRecords($i)\">$pageset</button>&nbsp;";
		}
		$limitsup = $i;
		$pageset++;
	}
	$dataPaginate .= "<button class=\"btn btn-sm btn-outline-info\" onclick=\"readRecords($limitsup)\"> >> </button>&nbsp;";

echo $dataPaginate;
 
?>
