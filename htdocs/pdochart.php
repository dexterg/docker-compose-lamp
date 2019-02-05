<?php
	$page = "pdochart";
	include "./header.php";
	include "./navbar.php";
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>CRUD operations for books</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="text-right">
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add_new_record_modal">Add new record</button>
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-md-8">
            <h3>Books records:</h3>
            <div class="records_content"></div>
        </div>
		<div class="col-md-4">
			<div class="row">
				<h3>Books graphic:</h3>
			</div>
			<div class="row">
				<div id="chart-books-container">
					<canvas id="chart-books-canvas"></canvas>
				</div>
			</div>
			<div class="row">
				<h3>Categories graphic:</h3>
			</div>
			<div class="row">
				<div id="chart-categories-container">
					<canvas id="chart-categories-canvas"></canvas>
				</div>
			</div>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    </div>
</div>
<!-- /Content Section -->

<!-- Bootstrap Modals -->
<!-- Modal - Add New Record/Book -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Add new book</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" placeholder="Title" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" id="price" placeholder="Price" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="id_category">Category</label>
					<div class="records_categories_content"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addRecord()">Add record</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->


<!-- Modal - Update Book details -->
<div class="modal fade" id="update_book_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Update book</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="update_title">Title</label>
                    <input type="text" id="update_title" placeholder="Title" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="update_price">Price</label>
                    <input type="text" id="update_price" placeholder="Price" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="update_category">Category</label>
					<div class="records_categories_content"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateBookDetails()" >Save Changes</button>
                <input type="hidden" id="hidden_book_id">
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

<?php
  include "./footer.php";
?>

