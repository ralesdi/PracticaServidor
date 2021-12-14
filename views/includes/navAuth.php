  <!-- Navbar -->
  <style>
     .color {background-color: #396EB0 !important; color: #DADDFC !important;}
  </style>
  <nav class=" color navbar navbar-expand-lg navbar-dark" style="color: #DADDFC ; ">
    <div class="container-fluid">
      <button
              class="navbar-toggler"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#navbarExample01"
              aria-controls="navbarExample01"
              aria-expanded="false"
              aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarExample01">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php 
            $controller = isset($_GET["controller"])?strtolower($_GET["controller"]):"";
         ?>  
            <li class="nav-item mx-0 mx-lg-1"><h1>MyAcademy!</h1></li>
            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?controller=<?=$controller?>&action=index">Home</a></li>
            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?controller=<?=$controller?>&action=profile">Profile</a></li>
            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?controller=<?=$controller?>&action=courses">Courses</a></li>
            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?controller=<?=$controller?>&action=directMessages">Direct Messages</a></li>
            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?controller=<?=$controller?>&action=listUsers">Users</a></li>
            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?controller=<?=$controller?>&action=teachers">Teachers</a></li>
                           
            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?controller=user&action=logout">Logout</a></li>

        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->

</header>
<!--------------------------------------------------------------->