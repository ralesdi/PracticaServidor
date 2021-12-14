<!-- Página de inicio a nuestro portal, una vez hemos logueado correctamente. -->
<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5">
   <div class="container text-center">
      <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0"><?= $tituloventana ?></h2>
      <div class="divider-custom">
         <div class="divider-custom-line"></div>
         <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
         <div class="divider-custom-line"></div>
      </div>
      <?php foreach($courses as $course): ?> 
         <h3><?=$course->getName()?></h3>
         <form action="?controller=<?=$controller?>&action=ApplicationList" method="POST">
            <button name="courseName" value="<?=$course->getName()?>">Entrar</button>
         </form>
      <?php endforeach;?>
   </div>
</section>
<?php require 'includes/footer.php'; ?>