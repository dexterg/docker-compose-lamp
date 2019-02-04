
$(document).ready(function () {
	window.setTimeout(function() {
		$(".alert").fadeTo(1000, 50).slideUp(1000, function(){
			$(this).remove();
		});
	}, 5000);
});

function drawCategoriesGraph() {
	var url = window.location.origin + '/ajax/getjsoncategoriesgraph.php';
	$.ajax({
		url: url,
		method: "GET",
		success: function(data) {

			//console.log(data);
			var name = [];
			var total = [];

			$(jQuery.parseJSON(data)).each(function() {	
				 name.push(this.name);
				 total.push(this.total);
			});

			var chartdata = {
				labels: name,
				datasets : [
					{
						backgroundColor: palette('rainbow', name.length).map(function(hex) {
											return '#' + hex;
										}),
						data: total
					}
				]
			};

			document.getElementById("chart-categories-container").innerHTML = '&nbsp;';
			document.getElementById("chart-categories-container").innerHTML = '<canvas id="chart-categories-canvas"></canvas>';
			var ctx = document.getElementById("chart-categories-canvas").getContext("2d");
			//var ctx = $("#myCanvas");
			var barGraph = new Chart(ctx, {
				type: 'polarArea',
				data: chartdata
			});
			
		},
		error: function(data) {
			console.log(data);
		}
	});
}

//function readRecordsForGraph() {
function drawBooksGraph() {
	var url = window.location.origin + '/ajax/getjsonbooksgraph.php';
	$.ajax({
		url: url,
		method: "GET",
		success: function(data) {

			var title = [];
			var price = [];

			$(jQuery.parseJSON(data)).each(function() {	
				 title.push(this.title);
				 price.push(this.price);
			});
			var sum = 0;
			for( var i = 0; i < price.length; i++ ){
				sum += parseInt( price[i], 10 ); //don't forget to add the base
			}
			var avg = sum/price.length
			avg = avg.toFixed(2);
			var arrayBackgroundColor = [];
			var arrayBorderColor = [];
			var arrayHoverBackgroundColor = [];
			var arrayHoverBorderColor = [];
			for (var i = 0; i < price.length; i++) {
				if ( avg > price[i] ) {
					arrayBackgroundColor.push('rgba(240, 20, 25, 0.5)');
					arrayBorderColor.push('rgba(240, 20, 25, 0.7)');
					arrayHoverBackgroundColor.push('rgba(240, 20, 25, 0.7)');
					arrayHoverBorderColor.push('rgba(240, 20, 25, 0.7)');
				} else {
					arrayBackgroundColor.push('rgba(20, 240, 25, 0.5)');
					arrayBorderColor.push('rgba(20, 240, 25, 0.7)');
					arrayHoverBackgroundColor.push('rgba(20, 240, 25, 0.7)');
					arrayHoverBorderColor.push('rgba(20, 240, 25, 0.7)');
				}
			}

			var chartdata = {
				labels: title,
				datasets : [
					{
						label: 'Book price average > ' + avg,
						backgroundColor: arrayBackgroundColor, 
						borderColor: arrayBorderColor,
						hoverBackgroundColor: arrayHoverBackgroundColor,
						hoverBorderColor: arrayHoverBorderColor,
						data: price
					}
				]
			};

			document.getElementById("chart-books-container").innerHTML = '&nbsp;';
			document.getElementById("chart-books-container").innerHTML = '<canvas id="chart-books-canvas"></canvas>';
			var ctx = document.getElementById("chart-books-canvas").getContext("2d");
			//var ctx = $("#myCanvas");
			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
			
		},
		error: function(data) {
			console.log(data);
		}
	});
}

function addRecord() {
	// get values
	var title = $("#title").val();
	title = title.trim();
	var price = $("#price").val();
	price = price.trim();
	var id_category = $("input[name='category_id']:checked").val();
	id_category = id_category.trim();

	if (title == "") {
		alert("Title field is required!");
	}
	else if (price == "") {
		alert("Price field is required!");
	}
	else if (id_category == "") {
		alert("Category field is required!");
	}
	else {
		// Add record
		$.post("ajax/create.php", {
			title: title,
			price: price,
			id_category: id_category
		}, function (data, status) {
			// 1. close the popup
			$("#add_new_record_modal").modal("hide");
			// 2. Read records again
			readRecords();
			// 3. Read categories records;
			readCategoriesRecords();
			// 4. Draw graphics();
			drawBooksGraph();
			drawCategoriesGraph();
			// 5. clear fields from the popup
			$("#title").val("");
			$("#price").val("");
			$('input[name=id_category]').prop('checked', true);
		});
	}
}

// READ records
function readCategoriesRecords(id) {
	$.post("ajax/readcategories.php", { 
			id: id  
		}, 
		function (data, status) {
			$(".records_categories_content").html(data);
		}
	);
}

// READ records
function readRecords() {
	$.get("ajax/read.php", {}, function (data, status) {
			$(".records_content").html(data);
	});
}

function GetBookDetails(book_id) {
		// Add Book ID to the hidden field
		$("#hidden_book_id").val(book_id);
		$.post("ajax/details.php", {
						id: book_id
				},
				function (data, status) {
						// PARSE json data
						var book = JSON.parse(data);
						// Assign existing values to the modal popup fields
						$("#update_title").val(book.title);
						$("#update_price").val(book.price);
						// Radio Checked
						$('input#category_id_' + book["category_id"]).prop('checked', 'checked');
						//console.log(book["category_id"]);
				}
		);
		// Open modal popup
		$("#update_book_modal").modal("show");
}

function UpdateBookDetails() {
	// get values
	var title = $("#update_title").val();
	title = title.trim();
	var price = $("#update_price").val();
	price = price.trim();
	var id_category = $("input[name='category_id']:checked").val();
	id_category = id_category.trim();

	if (title == "") {
		alert("First name field is required!");
	}
	else if (price == "") {
		alert("Last name field is required!");
	}
	else if (id_category == "") {
		alert("Category field is required!");
	}
	else {
		// get hidden field value
		var id = $("#hidden_book_id").val();

		// Update the details by requesting to the server using ajax
		$.post("ajax/update.php", {
				id: id,
				title: title,
				price: price,
				id_category: id_category
			},
			function (data, status) {
				// hide modal popup
				$("#update_book_modal").modal("hide");
				// 1. reload Books by using readRecords();
				readRecords();
				// 2. Read categories records;
				readCategoriesRecords();
				// Draw graphics
				drawBooksGraph();
				drawCategoriesGraph();
			}
		);
	}
}

function DeleteBook(id) {
	var conf = confirm("Are you sure, do you really want to delete Book?");
	if (conf == true) {
		$.post("ajax/delete.php", {
					id: id
			},
			function (data, status) {
				// reload Books by using readRecords();
				readRecords();
				//readRecordsForGraph();
				drawBooksGraph();
				drawCategoriesGraph();
			}
		);
	}
}

$(document).ready(function () {
	// READ records on page load
	readRecords(); // calling function
	//readRecordsForGraph();
	// Prepare modal for adding books
	readCategoriesRecords();
	// Draw graphics
	drawBooksGraph();
	drawCategoriesGraph();
});

