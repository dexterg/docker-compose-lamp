<?php
	$page="chart";
	include "./header.php";
	include "./navbar.php";

	$labels = array();
	$datas =array();
	for ($i=1; $i<=12; $i++) {
		array_push($labels, date('F', mktime(0, 0, 0, $i, 10))); // March );
		array_push($datas, rand(10,50));
	}
	//echo "<br>" . json_encode($labels);
	//echo "<br>" . json_encode($datas);

	function get_average( array $array_arg) :float {
		$average = 0;
		$sum = 0;
		foreach ($array_arg as $value) {
			$sum += $value;
		}
		return $sum/count($array_arg);
	}

	/*
	// specify your own database credentials
	define('DB_HOST', 'mariadb');
	define('DB_USERNAME', 'testdrive');
	define('DB_PASSWORD', 'testdrive');
	define('DB_NAME', 'testdrive');

	//get connection
	$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if(!$mysqli){
		die("Connection failed: " . $mysqli->error);
	}

	// Create database docker_lamp
	$database = "testdrive";
	$query = sprintf("CREATE DATABASE IF NOT EXISTS $database");
	try {
		//execute query
		$result = $mysqli->query($query);
	} catch (Exception $e) {
		echo '<br>Exception received: ',  $e->getMessage(), "\n";
	} finally {
		//echo "<br>Database $database created.";
	}
	$mysqli->close();

	//get connection
	$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if(!$mysqli){
		die("Connection failed: " . $mysqli->error);
	}

	// Create table books
	$table = "books";
	$query = sprintf("	CREATE TABLE IF NOT EXISTS $database.$table (
							id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
							price DECIMAL(5,2) NOT NULL,
							title VARCHAR(30) NOT NULL,
							created_at TIMESTAMP DEFAULT NOW(),
							updated_at TIMESTAMP DEFAULT NOW()
						)"
					);
	try {
		//execute query
		$result = $mysqli->query($query);
	} catch (Exception $e) {
		echo '<br>Exception received: ',  $e->getMessage(), "\n";
	} finally {
		//echo "<br>Table $table created.";
	}

	// Delete Table books
	$table = "books";
	$query = sprintf("DELETE FROM $table");
	try {
		//execute query
		//$result = $mysqli->query($query);
	} catch (Exception $e) {
		echo '<br>Exception received: ',  $e->getMessage(), "\n";
	} finally {
		?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert" id="success_alert">
			<?php echo "Table $table deleted !"?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php
	}

	// Insert datas in books
	$query = sprintf("	INSERT INTO $table
							(title, price, created_at, updated_at)
						VALUES
							('php7 advenced', '25.00', NOW(), NOW()),
							('mysql8', '32.20', NOW(), NOW()),
							('bootstrap 4.0', '9.10', NOW(), NOW()),
							('docker', '24.50', NOW(), NOW()),
							('apache 2.0', '12.50', NOW(), NOW());
					");
	try {
		//execute query
		//$result = $mysqli->query($query);
	} catch (Exception $e) {
		echo '<br>Exception received: ',  $e->getMessage(), "\n";
	} finally {
		//echo "<br>Table $table created.";
		?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<?php echo "Datas inserted in $table !"; ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php
	}

	//query to get data from the table
	$query = sprintf("SELECT title, price FROM books ORDER BY id");
	//execute query
	$result = $mysqli->query($query);
	$books_title = array();
	$books_price = array();
	// loop through the returned data with assoc
	while($row = $result->fetch_assoc()) {
		$books_title[] = $row["title"];
		$books_price[] = $row["price"];
	}

	$books_count = count($books_price);
	//echo "<br>" . json_encode($books_title);
	//echo "<br>" . json_encode($books_price);
	//echo "<br>" . count($books_price);

	//free memory associated with result
	$result->close();
	//close connection
	$mysqli->close();

	 */

	try {
		// specify your own database credentials
		$db_config = array();
		$db_config['PDO_SGBD']		= 'mysql';
		$db_config['PDO_HOST']		= 'mariadb';
		$db_config['PDO_DB_NAME']	= 'testdrive';
		$db_config['PDO_USER']		= 'testdrive';
		$db_config['PDO_PASSWORD']	= 'testdrive';
		$db_config['PDO_OPTIONS']	= array(
			// Activation des exceptions PDO :
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			// Change le fetch mode par défaut sur FETCH_ASSOC ( fetch() retournera un tableau associatif ) :
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		);
		$pdo = new PDO($db_config['PDO_SGBD'] .':host='. $db_config['PDO_HOST'] .';dbname='. $db_config['PDO_DB_NAME'],
		$db_config['PDO_USER'],
		$db_config['PDO_PASSWORD'],
		$db_config['PDO_OPTIONS']);
		unset($db_config);
	} catch(Exception $e) {
		trigger_error($e->getMessage(), E_USER_ERROR);
	}

	/*
	// bindValue
	$book_title = "Elixir";
	$book_price = '20,30';
	$book_category = '1';
	$query = $pdo->prepare('INSERT INTO books (title, price, id_category) VALUES (:book_title, :book_price, :book_category)');
	$query->bindValue('book_price', $book_price, PDO::PARAM_INT);
	$query->bindValue('book_title', $book_title, PDO::PARAM_STR);
	$query->bindParam('book_category', $book_category, PDO::PARAM_STR);
	$query->execute();

	$book_title = "Phoenix";
	$book_price = '22,20';
	$book_category = '1';
	$query->bindValue('book_price', $book_price, PDO::PARAM_INT);
	$query->bindValue('book_title', $book_title, PDO::PARAM_STR);
	$query->bindParam('book_category', $book_category, PDO::PARAM_STR);
	$query->execute();

	// bindParam
	$book_title = "Ruby";
	$book_price = '28,60';
	$book_category = '1';
	$query = $pdo->prepare('INSERT INTO books (title, price, id_category) VALUES (:book_title, :book_price, :book_category)');
	$query->bindParam('book_price', $book_price, PDO::PARAM_INT);
	$query->bindParam('book_title', $book_title, PDO::PARAM_STR);
	$query->bindParam('book_category', $book_category, PDO::PARAM_STR);
	$query->execute();

	$book_title = "Rails";
	$book_price = '16,30';
	$book_category = '1';
	$query->execute();

	 */

	try {
		$query = $pdo->prepare('SELECT 
									title,
									price
								FROM
									books
								ORDER BY
									title ASC
								LIMIT 0, :offset');
		$offset = 10;
		$query->bindValue('offset', $offset, PDO::PARAM_INT);
		$query->execute();
		$rows = $query->fetchAll(PDO::FETCH_OBJ);
		$books_count= $query->rowCount();
		foreach($rows as $book) {
			$books_title[] = $book->title;
			$books_price[] = $book->price;
		}
	} catch(Exception $e) { 
		exit('<b>Catched exception at line '. $e->getLine() .' :</b> '. $e->getMessage());
	}
	
	try {
		$query = $pdo->prepare("
									SELECT c.name, count(c.name) AS total
									FROM books b
									LEFT JOIN
										categories c
									ON b.id_category = c.id
									GROUP BY b.id_category
									");
		$offset = 10;
		$query->bindValue('offset', $offset, PDO::PARAM_INT);
		$query->execute();
		$rows = $query->fetchAll(PDO::FETCH_OBJ);
		$categories_count= $query->rowCount();
		foreach($rows as $category) {
			$categories_name[] = $category->name;
			$categories_total[] = $category->total;
		}
	} catch(Exception $e) { 
		exit('<b>Catched exception at line '. $e->getLine() .' :</b> '. $e->getMessage());
	}

/*
<div class="container" style="padding-bottom: 25px;">
	<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-10">
	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Title</th>
				<th scope="col">Price</th>
				<th scope="col">Created at</th>
				<th scope="col">Updated at</th>
				<!--
				<th scope="col">Update</th>
				<th scope="col">Delete</th>
				-->
			</tr>
		</thead>
		<tbody>

		<?php
		foreach($rows as $row) {
			echo "<tr>";
				echo "<th scope=\"row\">$row->id</th>";
				echo "<td>$row->title</td>";
				echo "<td>$row->price</td>";
				echo "<td>$row->created_at</td>";
				echo "<td>$row->updated_at</td>";
				//echo '<td><button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#updateModal">Update</button></td>';
				//echo '<td><button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deletModal">Delete</button></td>';
			echo "</tr>";
		}
		?>
		</tbody>
	</table>
	<!--
	<div class="text-right">
		<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="addtModal">Add new record</button>
	</div>
	-->
	</div>
	<div class="col-lg-1"></div>
	</div>
</div>
 */

?>	


<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-1">
    </div> 
    <div class="col-sm-10">
      <div class="jumbotron text-center" style="margin-bottom:0">
        <h1>Graphics of books and catégories</h1>
        <span class="badge badge-pill badge-info">chart.js</span>
        <span class="badge badge-pill badge-info">PHP PDO</span>
      </div>
    </div> 
    <div class="col-sm-1">
    </div> 
  </div> 
</div>

<div class="container" style="padding-bottom: 25px;">
	<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-4">
			<canvas id="categories_chart" ></canvas>
		</div>
		<div class="col-lg-6">
			<canvas id="books_chart" ></canvas>
		</div>
		<div class="col-lg-1"></div>
	</div>
	<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-4">
			<?php echo "<h2 class=\"text-center\">$categories_count categories</h2>"; ?>
		</div>
		<div class="col-lg-6">
			<?php echo "<h2 class=\"text-center\">$books_count books</h2>"; ?>
		</div>
		<div class="col-lg-1"></div>
	</div>
</div>

<?php
/*
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
	var ctx = document.getElementById("bar_chart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: <?php echo json_encode($labels); ?>,
			datasets: [{
				data: <?php echo json_encode($datas); ?>,
				label: "Requests",
				backgroundColor: [ 
					<?php
						$average = get_average($datas);
						for ($i=0; $i<12; $i++) { 
							if ($datas[$i] > $average) { 
								echo "'rgba(254, 62, 35, 0.3)',"; 
							} else {
								echo "'rgba(54, 162, 235, 0.3)',"; 
							}
						}
					?> 
				],
				borderColor: [ <?php for ($i=1; $i<=12; $i++) { echo "'rgba(54, 162, 235, 1)',"; } ?> ],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
</script>
*/
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
	var ctx = document.getElementById("books_chart").getContext('2d');
	var booksChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: <?php echo json_encode($books_title); ?>,
			datasets: [{
				data: <?php echo json_encode($books_price); ?>,
				label: "Books",
				backgroundColor: [ 
					<?php
						$books_average = get_average($books_price);
						for ($i=0; $i<count($books_price); $i++) { 
							if ($books_price[$i] > $books_average) { 
								echo "'rgba(254, 62, 35, 0.3)',"; 
							} else {
								echo "'rgba(54, 162, 25, 0.3)',"; 
							}
						}
					?> 
				],
				borderColor: [ 
					<?php 
						for ($i=0; $i<count($books_price); $i++) { 
							if ($books_price[$i] > $books_average) { 
								echo "'rgba(254, 62, 35, 0.5)',"; 
							} else {
								echo "'rgba(54, 162, 25, 0.5)',"; 
							}
						}
					?> 
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
</script>

<script>
	var ctx = document.getElementById("categories_chart").getContext('2d');
	var booksChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: <?php echo json_encode($categories_name); ?>,
			datasets: [{
				data: <?php echo json_encode($categories_total); ?>,
				label: "Categories count",
				backgroundColor: [ 
					<?php
						for ($i=0; $i<count($categories_name); $i++) { 
							echo "'rgba(25, 62, 254, 0.3)',"; 
						}
					?> 
				],
				borderColor: [ 
					<?php 
						for ($i=0; $i<count($categories_name); $i++) { 
							echo "'rgba(25, 25, 245, 1)',"; 
						} 
					?> 
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
</script>

<?php
  include "./footer.php";
?>
