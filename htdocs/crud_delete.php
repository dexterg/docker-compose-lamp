<?php
	$page = __FILE__;
	include "./header.php";
	include "./navbar.php";
	include "./crud_functions.php";
	require './database.php';

	$id=0; 
	if (!empty($_GET['id'])) { 
		$id = $_REQUEST['id']; 
	} 
	if (!empty($_POST)) { 
		$id = $_POST['id']; 
		$pdo = Database::connect(); 
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM books WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		Database::disconnect();
		header("Location: crud_index.php");
	}
?>

<div class="container">
	<div class="span10 offset1">
		<div class="row">
			<h3>Delete book id: <?php echo $id;?></h3>
		</div>
                     
		<form class="form-horizontal" action="crud_delete.php" method="post">
			<input type="hidden" name="id" value="<?php echo $id;?>"/>
			Are you sure to delete thi book?
			<div class="form-actions">
				<button type="submit" class="btn btn-danger">Yes</button>
				<a class="btn btn-outline-success" href="crud_index.php">No</a>
			</div>
		</form>
	</div>
</div>

<?php
  include "./footer.php";
?>
