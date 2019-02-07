<?php 
	$page = __FILE__;
	include "./header.php";
	include "./navbar.php";
	include "./crud_functions.php";
	//on appelle notre fichier de config BDD
	require './database.php';
	$id = null; 
	if (!empty($_GET['id'])) { 
		$id = $_REQUEST['id']; 
	} 
	if (null == $id) { 
		header("location:crud_index.php"); 
	} else { 
		//on lance la connection et la requete 
		$pdo = Database ::connect(); 
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		$sql = "SELECT 
					b.id, b.title, b.price, c.name AS category
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
		Database::disconnect();
	}
?>


<div class="container">
	<div class="span10 offset1">
		<div class="row">
			<h3>Read book id: <?php echo $data['id']; ?></h3>
		</div>
		<div class="form-horizontal" >
			<div class="form-group row">
				<label for="staticTitle" class="col-sm-2 col-form-label">Title</label>
				<div class="col-sm-10">
					<input type="text" readonly class="form-control-plaintext" id="staticTitle" value="<?php echo $data['title']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="staticPrice" class="col-sm-2 col-form-label">Price</label>
				<div class="col-sm-10">
					<input type="text" readonly class="form-control-plaintext" id="staticPrice" value="<?php echo $data['price']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="staticCategory" class="col-sm-2 col-form-label">Category</label>
				<div class="col-sm-10">
					<input type="text" readonly class="form-control-plaintext" id="staticCategory" value="<?php echo $data['category']; ?>">
				</div>
			</div>
		</div>
	</div>
	<div class="form-actions">
		<a class="btn btn-success" href="crud_index.php">Back</a>
	</div>
</div>

<?php
  include "./footer.php";
?>
