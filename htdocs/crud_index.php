<?php
	$page = __FILE__;
	include "./header.php";
	include "./navbar.php";
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
				<th>Created at</th>
				<th>Updated at</th>
				<th>Read</th>
				<th>Update</th>
				<th>Delete</th>
			</thead>
			<tbody>
				<?php
				//on inclut notre fichier de connection
				include './database.php'; 
				//on se connecte à la base 
				$pdo = Database::connect();
				//on formule notre requete
				$sql = 'SELECT * FROM books ORDER BY id DESC';
				foreach ($pdo->query($sql) as $row) {
					//on cree les lignes du tableau avec chaque valeur retournée
					echo '<tr>';
					echo '<td>' . $row['id'] . '</td>';
					echo '<td>' . $row['title'] . '</td>';
					echo '<td>' . $row['price'] . '</td>';
					echo '<td>' . $row['created_at'] . '</td>';
						echo '<td>' . $row['updated_at'] . '</td>';
					echo '<td>';
						echo '<a class="btn btn-outline-primary btn-sm" href="crud_edit.php?id=' . $row['id'] . '">Read</a>';	// Edit
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
