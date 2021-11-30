<?php require 'includes/header.php'; ?>
<?php require 'includes/navguest.php'; ?>
<section class="page-section pt-5">

    <!--
        $this->dni = $dni;
        $this->name=$name;
        $this->surname=$surname;
        $this->username=$username;
        $this->email=$email;
        $this->password=$password;
        $this->image=$image;
        $this->isActive=$isActive;
    -->
    <form class="text-center" action="?controller=Index&action=completeRegister" method="post">
        <div class="form-floating m-auto mb-2 w-25 justify-content-center">
            <input class="form-control" id="dni" name="dni" type="text" placeholder="Introduzca su usuario..." />
            <label for="name">DNI</label>
        </div>

        <div class="form-floating m-auto mb-2 w-25 justify-content-center">
            <input class="form-control" id="username" name="username" type="text" placeholder="Introduzca su usuario..." />
            <label for="name">Username</label>
        </div>

        <div class="form-floating m-auto mb-2 w-25 justify-content-center">
            <input class="form-control" id="name" name="name" type="text" placeholder="Introduzca su usuario..." />
            <label for="name">Name</label>
        </div>

        <div class="form-floating m-auto mb-2 w-25 justify-content-center">
            <input class="form-control" id="surname" name="surname" type="text" placeholder="Introduzca su usuario..." />
            <label for="name">Surname</label>
        </div>

        <div class="form-floating m-auto mb-2 w-25 justify-content-center">
            <input class="form-control" id="email" name="email" type="email" placeholder="Introduzca su usuario..." />
            <label for="name">Email</label>
        </div>

        <div class="form-floating m-auto mb-2 w-25 justify-content-center">
            <input class="form-control" id="password" name="password" type="password" placeholder="Introduzca su usuario..." />
            <label for="name">Password</label>
        </div>

        <input class="btn-lg btn-primary rounded m-auto " type="submit" value="Register">
        
    </form>

    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
</section>
<?php require 'includes/footer.php'; ?>