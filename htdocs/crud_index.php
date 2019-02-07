<?php
	$page = __FILE__;
	include "./header.php";
	include "./navbar.php";
	include "./crud_functions.php";

	//var_dump($_GET);
	//var_dump(isset($_GET["alert"]));
   	//var_dump(isset($GET["type"]));
	if (isset($_GET["alert"]) && isset($GET["type"]) ) {
		var_dump($_GET);
		alert($_GET['alert'], isset($GET['type']));
	}

?>
	<div class="container">
		<div class="row">
		<h2>Simple CRUD</h2>
		<p>
		</div>
		<div class="row">
		<div class="text-right">
			<a href="crud_add.php" class="btn btn-success">Add a book</a>
		</div>
		<div class="table-responsive">
			<table class="table table-hover table-striped table-sm">
			<thead>
				<th>#</th>
				<th>Title</th>
				<th>Price</th>
				<th>Category</th>
				<th>Created at</th>
				<th>Updated at</th>
				<th>Read</th>
				<th>Update</th>
				<th>Delete</th>
			</thead>
			<tbody>
				<?php
				// Include file connection
				include './database.php'; 
				// Data base conection
				$pdo = Database::connect();
				// Simple query 
				//$sql = 'SELECT * FROM books ORDER BY id DESC';
				// Query with join to print the category name 
				// Last records at the top in table
				$sql = "SELECT 
							b.id, b.title, b.price, b.created_at, b.updated_at,
							c.id AS book_category_id, c.name AS category_name
						FROM
							books AS b
						LEFT JOIN
							categories c
						ON b.id_category = c.id
						ORDER BY
							b.created_at DESC";
				foreach ($pdo->query($sql) as $row) {
					//on cree les lignes du tableau avec chaque valeur retournée
					echo '<tr>';
					echo '<td>' . $row['id'] . '</td>';
					echo '<td>' . $row['title'] . '</td>';
					echo '<td>' . $row['price'] . '</td>';
					echo '<td>' . $row['category_name'] . '</td>';
					echo '<td>' . $row['created_at'] . '</td>';
						echo '<td>' . $row['updated_at'] . '</td>';
					echo '<td>';
						echo '<a class="btn btn-outline-primary btn-sm" href="crud_read.php?id=' . $row['id'] . '">Read</a>';	// Edit
					echo '</td>';
					echo '<td>';
						echo '<a class="btn btn-outline-success btn-sm" href="crud_update.php?id=' . $row['id'] . '">Update</a>';	// Update
					echo '</td>';
					echo '<td>';
						echo '<a class="btn btn-outline-danger btn-sm" href="crud_delete.php?id=' . $row['id'] . ' ">Delete</a>';	// Suppress
					echo '</td>';
					echo '</tr>';
				}
				Database::disconnect();
		            ?>    
			</tbody>
			</table>
		</div>
		</div>
	</div>


<?php
	include "./footer.php";
?>
