<?php

require 'lib.php';

$object = new CRUD();

// Design initial table header

$categories = $object->Read_categories();
 
$data = "";
if (count($categories) > 0) {
    foreach ($categories as $category) {
		$id = $category['id'];
		$name = $category['name'];
        $data .= "<div class=\"form-check form-check-inline\">
						<input  class=\"form-check-input\" type=\"radio\" name=\"category_id\" id=\"category_id_$id\" value=\"$id\" checked=\"\">
						<label class=\"form-check-label\" for=\"inlineCategoryRadio$id\">$name</label> 
					</div>";
    }
} else {
    // records not found
    $data = '<p>Records not found!</p>';
}
 
echo $data;
 
?>
