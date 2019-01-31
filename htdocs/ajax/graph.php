<?php

require 'lib.php';

$object = new CRUD();

$books = $object->Read();
$titles_books = array();
$prices_books = array();

foreach ($books as $book) {
	$titles_books[] = $book['title'];
	$prices_books[] = $book['price'];
}
//var_dump($prices_books);
//var_dump($titles_books);

if (count($books) > 0) {
// Design initial table header
$data = "
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js\"></script>
<script>
	var ctx = document.getElementById(\"books_chart\").getContext('2d');
	var booksChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: "; $data .= json_encode($titles_books); $data .= ",
			datasets: [{
				data: "; $data .= json_encode($prices_books); $data .= ",
				label: \"Books\",
				backgroundColor: [ ";
						$average = get_average($prices_books);
						for ($i=0; $i<count($prices_books); $i++) { 
							if ($prices_books[$i] > $average) { 
								$data .= "'rgba(254, 62, 35, 0.3)',"; 
							} else {
								$data .= "'rgba(54, 162, 235, 0.3)',";
							}
						}
				$data .= "],
				borderColor: [ "; for ($i=0; $i<count($prices_books); $i++) { $data .= "'rgba(54, 162, 235, 1)',"; } $data .= "],
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
	";

} else {
    // records not found
    $data .= '<tr><td colspan="6">Records not found!</td></tr>';
}
 
echo $data;
 
?>
