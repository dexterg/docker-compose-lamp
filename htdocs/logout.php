<?php
	$page = "logout";
	include "./header.php";
	include "./navbar.php";

	//$counter =  isset($_SESSION['counter']) ? $_SESSION['counter'] : null;
	//echo "<p>Counter: $counter</p>";
?>

	<p>
		To continue click following link
		<a  href = "index.php?<?php echo htmlspecialchars(session_id()); ?>">Home</a>
	</p>

<?php
	session_destroy();
	//header("location:index.php");
	//$counter =  isset($_SESSION['counter']) ? $_SESSION['counter'] : null;
	//echo "<p>New counter:$counter</p>";

	include "./footer.php";
?>
