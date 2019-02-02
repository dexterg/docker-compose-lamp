<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="/">My Lab</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item <?php echo ($page == "home" ? "active" : "") ?>"> 
        <a class="nav-link" href="/home.php">Home</a>
      </li>
      <li class="nav-item <?php echo ($page == "chart" ? "active" : "") ?>"> 
        <a class="nav-link" href="/chart.php">Chart</a>
      </li>
      <li class="nav-item <?php echo ($page == "seed" ? "active" : "") ?>"> 
        <a class="nav-link" href="/seed.php">Seed</a>
      </li>
      <li class="nav-item <?php echo ($page == "pdochart" ? "active" : "") ?>"> 
        <a class="nav-link" href="/pdochart.php">PDOchart</a>
      </li>
      <li class="nav-item <?php echo ($page == "info" ? "active" : "") ?>"> 
        <a class="nav-link" href="/info.php">Info</a>
      </li>
    </ul>
  </div>
</nav>
