<?php
	$page="seed";
	include "./header.php";
	include "./navbar.php";
	include "./seed.inc";

	// Connection to database testdrive
	$seed = new SEED;

	if ( isset($_POST['seed']) ) {
		// Drop table categories
		$seed->DropTable('categories');
		// Create table books
		$seed->CreateTable('categories');
		// Insert datas in categories
		$seed->SeedTable('categories');

		// Drop table books
		$seed->DropTable('books');
		// Create table books
		$seed->CreateTable('books');
		// Insert datas in categories
		$seed->SeedTable('books');
	}

	// Get all rows of all tables
	$books = $seed->GetTable('books');
	$categories = $seed->GetTable('categories');

?>	

<div class="container" style="padding-bottom: 25px;">
	<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-8">
			<h3>Books</h3>
		</div>
		<div class="col-lg-2">
			<h3>Categories</h3>
		</div>
		<div class="col-lg-1"></div>
	</div>
	<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-8">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Title</th>
						<th scope="col">Price</th>
						<th scope="col">Category</th>
						<th scope="col">Created at</th>
						<th scope="col">Updated at</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($books as $book) {
						echo "<tr>";
							echo "<th scope=\"row\">$book->id</th>";
							echo "<td>$book->title</td>";
							echo "<td>$book->price</td>";
							echo "<td>$book->category</td>";
							echo "<td>$book->created_at</td>";
							echo "<td>$book->updated_at</td>";
						echo "</tr>";
					}
				?>
				</tbody>
			</table>
		</div>
		<div class="col-lg-2">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">name</th>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($categories as $category) {
						echo "<tr>";
							echo "<th scope=\"row\">$category->id</th>";
							echo "<td>$category->name</td>";
						echo "</tr>";
					}
				?>
				</tbody>
			</table>
		</div>
		<div class="col-lg-1"></div>
	</div>
</div>

<div class="container" style="padding-bottom: 25px;">
	<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-8">
			<div class="text-right">
				<form name="seed" action="seed.php" method="POST">
					<input type="submit" class="btn btn-danger btn pull-right" name="seed" value="Drop tables books and categories and seed it"</input>
				</form>
			</div>
		</div>
		<div class="col-lg-1"></div>
	</div>
</div>



<?php
  include "./footer.php";
?>
