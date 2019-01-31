<?php

require 'lib.php';

$object = new CRUD();

// Design initial table header
$data = '<table class="table table-striped table-sm">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Title</th>
					<th scope="col">Price</th>
					<th scope="col">Update</th>
					<th scope="col">Delete</th>
				</tr>
			</thead>
			<tbody>';

$books = $object->Read();
 
if (count($books) > 0) {
    $number = 1;
    foreach ($books as $book) {
        $data .= '
				<tr>
					<td>' . $book['id'] . '</td>
					<td>' . $book['title'] . '</td>
					<td>' . $book['price'] . '</td>
					<td>
						<button onclick="GetBookDetails(' . $book['id'] . ')" class="btn btn-outline-warning btn-sm">Update</button>
					</td>
					<td>
						<button onclick="DeleteBook(' . $book['id'] . ')" class="btn btn-outline-danger btn-sm">Delete</button>
					</td>
				</tr>';
        $number++;
    }
		$data .= '</tbody>';
} else {
    // records not found
    $data .= '<tr><td colspan="6">Records not found!</td></tr>';
}
 
$data .= '</table>';
 
echo $data;
 
?>
