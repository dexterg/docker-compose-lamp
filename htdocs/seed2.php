<?php
	include "./header.php";
	$page="seed2";
	include "./navbar.php";
	include "./ajax/db_connection.php";
	include "./seed2.class";

	// Connection to database testdrive
	$seed = new SEED2;

	// Test if submit seed button
	if ( isset($_POST['seed2']) ) {
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
	// Close connexion
	$seed = null;
	// Print table books
	include "./seed2.html";

	// Print footer
	include "./footer.php";
?>
