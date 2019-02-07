<?php 
	$page = __FILE__;
	include "./header.php";
	include "./navbar.php";
	include "./crud_functions.php";
	//on appelle notre fichier de config BDD
	require './database.php'; 

	$id = null; 
	if ( !empty($_GET['id'])) { 
		$id = $_REQUEST['id']; 
	} 
	if ( null==$id ) { 
		header("Location: crud_index.php"); 
	} 
	if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) { 
		// on initialise nos erreurs 
		$titleError = null; 
		$priceError = null; 
		$categoryError = null; 
		// On assigne nos valeurs 
		$title = $_POST['title']; 
		$price = $_POST['price']; 
		$id_category = $_POST['id_category']; 
		// On verifie que les champs sont remplis 
		$valid = true; 
		if (empty($title)) { 
			$titleError = 'Please enter a title'; 
			alert($titleError,'danger');
			$valid = false; 
		} 
		if (empty($price)) { 
			$priceError = 'Please enter a price'; 
			alert($priceError,'danger');
			$valid = false; 
		} 
		if (empty($id_category)) { 
			$categoryError = 'Please enter a category'; 
			alert($categoryError,'danger');
			$valid = false; 
		} 
		// mise à jour des donnés 
		if ($valid) { 
			$pdo = Database::connect(); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE books SET title = ?, price = ?, id_category = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($title,$price, $id_category, $id));
			Database::disconnect();
			header("Location: crud_index.php");
		} 
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$sql = "SELECT * FROM books where id = ?";
		$sql = "SELECT 
					b.id, b.title, b.price, c.id AS book_category_id
				FROM
					books AS b
				LEFT JOIN
					categories c
				ON b.id_category = c.id
				WHERE 
					b.id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$title = $data['title'];
		$price = $data['price'];
		$book_category_id = $data['book_category_id'];

		// Get list of categories for the radio buttons
		$sql = "SELECT id, name FROM categories";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$categories_data = $q->fetchAll(PDO::FETCH_ASSOC);
		
		Database::disconnect();
	}
		
?>


	<div class="container">
		<div class="row">
			<h3>Update book id: <?php echo $id ;?></h3>
		</div>
		<form method="post" action="crud_update.php?id=<?php echo $id ;?>">

			<div class="form-group <?php echo!empty($titleError) ? 'error' : ''; ?>">
				<label class="control-label">Title</label>
				<div class="controls">
					<input title="title" type="text"  placeholder="title of book" name="title" value="<?php echo!empty($title) ? $title : ''; ?>">
					<?php if (!empty($titleError)): ?>
						<span class="help-inline"><?php echo $titleError; ?></span>
					<?php endif; ?>
				</div>
			</div>


			<div class="form-group<?php echo!empty($priceError) ? 'error' : ''; ?>">
				<label class="control-label">Price</label>
				<div class="controls">
					<input type="text" placeholder="title of book" name="price" title="price" value="<?php echo!empty($price) ? $price : ''; ?>">
					<?php if (!empty($priceError)): ?>
						<span class="help-inline"><?php echo $priceError; ?></span>
					<?php endif; ?>
				</div>
			</div>

			<div class="form-group <?php echo!empty($categoryError) ? 'error' : ''; ?>">
				<label class="control-label">Category</label>
				<div class="controls">
				<?php
					foreach ($categories_data as $category_data) {
						//var_dump($category_data);
						$category_id = $category_data['id'];
						$category_name = $category_data['name'];
						echo "<div class=\"form-check form-check-inline\">";
							if ( $category_id == $book_category_id ) {
								echo "<input  class=\"form-check-input\" type=\"radio\" name=\"id_category\" id=\"category_id_$id\" value=\"$category_id\" checked=\"\">";
							} else {
								echo "<input  class=\"form-check-input\" type=\"radio\" name=\"id_category\" id=\"category_id_$id\" value=\"$category_id\">";
							}
							echo "<label class=\"form-check-label\" for=\"inlineCategoryRadio$category_id\">$category_name</label>";
						echo "</div>";
					}
				?>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" class="btn btn-success" title="submit" value="Update">
				<a class="btn btn-outline-success" href="crud_index.php">Cancel</a>
			</div>
		</form>
	</div>


<?php
  include "./footer.php";
?>
