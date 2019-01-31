
$(document).ready(function () {
	window.setTimeout(function() {
		$(".alert").fadeTo(1000, 50).slideUp(1000, function(){
			$(this).remove();
		});
	}, 5000);
});

//$(document).ready(function(){
function readRecordsForGraph() {
	$.ajax({
		url: "http://localhost:8080/ajax/getjson.php",
		method: "GET",
		success: function(data) {
			//console.log(data);
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
			avg.toFixed(2);
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
			var oddBorderColor = 'rgba(153, 102, 255, 1)';

			var chartdata = {
				labels: title,
				datasets : [
					{
						label: 'Book price > ' + avg,
						backgroundColor: arrayBackgroundColor, 
						borderColor: arrayBorderColor,
						hoverBackgroundColor: arrayHoverBackgroundColor,
						hoverBorderColor: arrayHoverBorderColor,
						data: price
					}
				]
			};

			var ctx = $("#mycanvas");

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
 
		if (title == "") {
				alert("Title field is required!");
		}
		else if (price == "") {
				alert("Price field is required!");
		}
		else {
				// Add record
				$.post("ajax/create.php", {
						title: title,
						price: price
				}, function (data, status) {
						// close the popup
						$("#add_new_record_modal").modal("hide");
 
						// read records again
						readRecords();
			readRecordsForGraph();
 
						// clear fields from the popup
						$("#title").val("");
						$("#price").val("");
				});
		}
}

// READ records
function readRecords() {
		$.get("ajax/read.php", {}, function (data, status) {
				$(".records_content").html(data);
		});
		//$.get("ajax/graph.php", {}, function (data, status) {
		//		$(".graph_content").html(data);
		//});
}

function GetBookDetails(id) {
		// Add Book ID to the hidden field
		$("#hidden_book_id").val(id);
		$.post("ajax/details.php", {
						id: id
				},
				function (data, status) {
						// PARSE json data
						var book = JSON.parse(data);
						// Assign existing values to the modal popup fields
						$("#update_title").val(book.title);
						$("#update_price").val(book.price);
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

		if (title == "") {
				alert("First name field is required!");
		}
		else if (price == "") {
				alert("Last name field is required!");
		}
		else {
				// get hidden field value
				var id = $("#hidden_book_id").val();

				// Update the details by requesting to the server using ajax
				$.post("ajax/update.php", {
								id: id,
								title: title,
								price: price,
						},
						function (data, status) {
								// hide modal popup
								$("#update_book_modal").modal("hide");
								// reload Books by using readRecords();
								readRecords();
				readRecordsForGraph();
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
				readRecordsForGraph();
			}
		);
	}
}

$(document).ready(function () {
	// READ records on page load
	readRecords(); // calling function
	readRecordsForGraph();
});

