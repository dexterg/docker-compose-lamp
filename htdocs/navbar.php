<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="/">
    <img src="photo.jpg" class="rounded-circle" width="30" height="30" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item <?php echo ($page == "home" ? "active" : "") ?>"> 
        <a class="nav-link" href="/home.php">Home</a>
      </li>
      <li class="nav-item <?php echo ($page == "seed" ? "active" : "") ?>"> 
        <a class="nav-link" href="/seed.php">Seed</a>
      </li>
      <li class="nav-item <?php echo ($page == "seed2" ? "active" : "") ?>"> 
        <a class="nav-link" href="/seed2.php">Seed2</a>
      </li>
      <li class="nav-item <?php echo ($page == "chart" ? "active" : "") ?>"> 
        <a class="nav-link" href="/chart.php">Chart</a>
      </li>
      <li class="nav-item <?php echo ($page == "crud_index.php" ? "active" : "") ?>"> 
        <a class="nav-link" href="/crud_index.php">simpleCRUD</a>
      </li>
      <li class="nav-item <?php echo ($page == "pdochart" ? "active" : "") ?>"> 
        <a class="nav-link" href="/pdochart.php">ajaxCRUD</a>
      </li>
      <li class="nav-item <?php echo ($page == "info" ? "active" : "") ?>"> 
        <a class="nav-link" href="/info.php">Info</a>
      </li>
      <li class="nav-item navbar-right<?php echo ($page == "login" ? "active" : "") ?>"> 
        <a class="nav-link" href="/login.php">login</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item navbar-right<?php echo ($page == "login" ? "active" : "") ?>"> 
        <a class="nav-link" href="/login.php">login</a>
      </li>
      <li class="nav-item navbar-right<?php echo ($page == "login" ? "active" : "") ?>"> 
        <a class="nav-link" href="/logout.php">logout</a>
      </li>
    </ul>
    <?php 
      echo '<span class="badge badge-info">User: ';
      if (isset($_SESSION['user'])) {
        echo $_SESSION['user'] . "</span>";
      } else {
        echo "anonymous</span>";
      } 
      ?>
    </form>
    <form class="form-inline my-2 my-lg-0">
      <?php echo '<span class="badge badge-info">Visited: ' . $_SESSION['counter'] . '</span>'; ?>
    </form>
  </div>
</nav>

<div id="messages">
</div>
