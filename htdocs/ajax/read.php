<?php

require 'lib.php';

// To paginate...
$limitinf = $_POST['limitinf'];
$object = new CRUD();
// Get list of books with pagination
$books = $object->Read($limitinf);

// Design initial table header
$data = '<table class="table table-striped table-sm">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Title</th>
					<th scope="col">Price</th>
					<th scope="col">Category</th>
					<th scope="col">Update</th>
					<th scope="col">Delete</th>
				</tr>
			</thead>
			<tbody>';

// Table construct
if (count($books) > 0) {
    $number = 1;
    foreach ($books as $book) {
        $data .= '
				<tr>
					<td>' . $book['id'] . '</td>
					<td>' . $book['title'] . '</td>
					<td>' . $book['price'] . '</td>
					<td>' . $book['category'] . '</td>
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
	$data .= '</tbody>';
$data .= '</table>';
 
echo $data;
 
?>
