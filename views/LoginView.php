<?php require 'includes/header.php'; ?>
<?php require 'includes/navguest.php'; ?>
<section class="page-section pt-5">
   <div class="container">
      <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Login al sitio</h2>
      <!-- Icon Divider-->
      <div class="divider-custom">
         <div class="divider-custom-line"></div>
         <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
         <div class="divider-custom-line"></div>
      </div>
      <!-- Contact Section Form-->
      <div class="row justify-content-center">
         <div class="col-lg-8 col-xl-7">
            <form action="?controller=index&action=autenticate" method="POST">
               <!-- Name input-->
               <div class="form-floating mb-3">
                  <input class="form-control" id="dni" name="dni" type="text" value="<?=$dni?>"/>
                  <label for="name">DNI</label>
                  <!-- <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div> -->
               </div>
               <!-- Password-->
               <div class="form-floating mb-3">
                  <input class="form-control" id="password" name="password" type="password" placeholder="Password fd" value="<?=$password?>" />
                  <label for="email">Password</label>
                  <!-- <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div> -->
               </div>

               <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="rememberme" id="rememberme" value="on" <?if($rememberme=="on") echo "checked=''"; ?>>
                  <label class="form-check-label" for="formCheckChecked">Recuérdame</label>
               </div>
               <!-- Submit Button-->
               <button class="btn btn-primary btn-xl mt-3 mb-2" id="submitButton" name="submit" type="submit">Entrar</button>
            </form>
            <?php foreach ($messages as $message) : ?>
               <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
                     <?= $message["message"] ?>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
            <?php endforeach; ?>
         </div>
      </div>
   </div>
</section>
<?php require 'includes/footer.php'; ?>