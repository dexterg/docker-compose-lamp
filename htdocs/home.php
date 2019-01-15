<?php
  $page="home";
  include "./header.php";
  include "./navbar.php";
?>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-2">
    </div> 
    <div class="col-sm-8">
      <div class="jumbotron text-center" style="margin-bottom:0">
        <h1>Welcome to LAMP stack on docker</h1>
        <span class="badge badge-pill badge-info">Linux</span>
        <span class="badge badge-pill badge-info">Apache</span>
        <span class="badge badge-pill badge-info">MySQL</span>
        <span class="badge badge-pill badge-info">PHP</span>
        <h1>with some addons</h1>
        <span class="badge badge-pill badge-info">Postgresql</span>
        <span class="badge badge-pill badge-info">Mongodb</span>
      </div>
    </div> 
    <div class="col-sm-2">
    </div> 
  </div> 
</div>
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-4">
    </div> 
    <div class="col-sm-4">
      <p><a href="http://localhost:8080">8080 -> apache2</a></p>
      <p><a href="http://localhost:8081">8081 -> nginx</a></p>
      <p><a href="http://localhost:8082">8082 -> phpmyadmin (root/testdrive)</a></p>
      <p><a href="http://localhost:8083">8083 -> adminer</a></p>
      <p><a  href="http://localhost:8084">8084 -> ngrok</a></p>
      <p><a  href="http://localhost:8085">8085 -> mailhog</a></p>
      <!--
      <button type="submit" onclick="location.href = '/mail.php';" class="btn btn-primary">Test mail</button>
      -->
    </div> 
    <div class="col-sm-4">
      <?php include './mail.php'; ?>
    </div> 
  </div>
</div>

<?php
  include "./footer.php";
?>
