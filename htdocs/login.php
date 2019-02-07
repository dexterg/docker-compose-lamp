
<?php
	$page = __FILE__;
	include "./header.php";
	include "./navbar.php";
	include "./crud_functions.php";
	require './database.php';
?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-1">
    </div> 
    <div class="col-sm-10">
      <div class="jumbotron text-center" style="margin-bottom:0">
        <h1>System login in progress...</h1>
      </div>
    </div> 
    <div class="col-sm-1">
    </div> 
  </div> 
</div>

<?php
  include "./footer.php";
?>
