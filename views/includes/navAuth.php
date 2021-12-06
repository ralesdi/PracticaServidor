<nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
   <div class="container">
      <a class="navbar-brand text-white" href="?controller=home&action=index">MiAcademia</a>
      <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
         Menu
         <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
         <ul class="navbar-nav ms-auto">
         <? 
            $controller = isset($_GET["controller"])?$_GET["controller"]:"";
         ?>  
         <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?controller=<?=$controller?>&action=profile">Profile</a></li>

         <?if($controller=="student"):?>
            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#otros">Courses</a></li>
         <? elseif($controller=="teacher"): ?>

         <? elseif($controller=="admin"): ?>

         <? endif; ?>
            
            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#cursos">Cursos</a></li>
            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?controller=user&action=listado">Usuarios</a></li>
            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#mensajes">Mensajes</a></li>
            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="?controller=user&action=logout">Cerrar</a></li>
         </ul>
      </div>
   </div>
</nav>