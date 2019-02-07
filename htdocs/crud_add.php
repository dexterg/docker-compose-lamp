<?php
	$page = __FILE__;
	include "./header.php";
	include "./navbar.php";
	include "./crud_functions.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST) && isset($_POST['id_category'])) {
		//on initialise nos messprices d'erreurs;
		$titleError = '';
		$categoryError='';
		$priceError='';
		// on recupère nos valeurs
		$title = htmlentities(trim($_POST['title']));
		$price=htmlentities(trim($_POST['price']));
		$id_category = htmlentities(trim($_POST['id_category']));

		// on vérifie nos champs 
		$valid = true; 
		if (empty($title)) {
			alert('Please enter title','danger');
			$valid = false; 
		} else if (!preg_match("/^[a-zA-Z ]*$/",$title)) {
			alert('Only letters and white space allowed');
			$valid = false; 
		}

		if (empty($price)) { 
			alert('Please enter a price','danger');
			$valid = false; 
		} 

		if (empty($id_category)) { 
			alert('Please choose a category','danger');
			$valid = false; 
			//} else if (!preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#",$tel)) {
			//} else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) { 
		} 
		
		// si les données sont présentes et bonnes, on se connecte à la base 
		if ($valid) { 
			//on inclut notre fichier de connection
			include './database.php'; 
			$pdo = Database::connect(); 
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO books (title, price, id_category) values (?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($title, $price, $id_category));
            Database::disconnect();
            header("Location: crud_index.php?alert='Book inserted'&type='success'");
        }
    }
?>

<div class="container">
	<div class="row">
		<h3>Add a book</h3>
	</div>
	<form method="post" action="crud_add.php">
		<div class="form-group">
			<label class="control-label">Title</label>
			<div class="controls">
				<input title="title" type="text"  placeholder="Book title" name="title"  value="<?php echo !empty($title)?$title:'';?>">
				<?php if (!empty($titleError)): ?>
					<span class="help-inline"><?php echo $titleError;?></span>
				<?php endif; ?>
			</div>
		</div>

		<div class="form-group<?php echo !empty($priceError)?'error':'';?>">
			<label class="form-label">Price</label>
			<div class="controls">
				<input type="text" title="price" placeholder="Book price" name="price" value="<?php echo !empty($price)?$price:''; ?>">
				<?php if(!empty($priceError)):?>
					<span class="help-inline"><?php echo $priceError ;?></span>
				<?php endif;?>
			</div>
		</div>

		<div class="form-group<?php echo !empty($id_categoryError)?'error':'';?>">
			<!-- <select title="id_category">-->
				<?php
				// Read categories
				//on inclut notre fichier de connection
				include './database.php'; 
				//on se connecte à la base 
				$pdo = Database::connect();
				//on formule notre requete
				$sql = 'SELECT * FROM categories ORDER BY name ASC';
				foreach ($pdo->query($sql) as $category) {
						//foreach ($categories as $category) {
						// Create radio button
						$id = $category['id'];
						$name = $category['name'];
						$data = "<div class=\"form-check form-check-inline\">
														<input  class=\"form-check-input\" type=\"radio\" name=\"id_category\" id=\"id_category_$id\" value=\"$id\">
														<label class=\"form-check-label\" for=\"inlineCategoryRadio$id\">$name</label> 
												</div>";
						echo $data;
				}
				?>
			<!--</select>-->
			<?php if (!empty($id_categoryError)): ?>
				<span class="help-inline"><?php echo $id_categoryError;?></span>
			<?php endif;?>
		</div>

		<div class="form-actions">
			<input type="submit" class="btn btn-success" title="submit" value="submit">
			<a class="btn btn-outline-primary" href="crud_index.php">Retour</a>
		</div>
	</form>
</div>

<?php
  include "./footer.php";
?>
