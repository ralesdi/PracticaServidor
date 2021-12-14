<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5 m-5 text-center">
    <form action="<?=isset($_POST['editable'])?"?controller=$controller&action=saveProfileChanges": "?controller=$controller&action=profile"?>" method="POST" enctype="multipart/form-data">
        <div class="card w-50 m-auto color">
        <div class="card-header">
            Profile
        </div>
        
        <div class="card-body w-75 m-auto">
        <img class="m-5" src=<?=$user->getImage()?> alt="" width="150em" height="150em">
        <input class="form-control" type="file" name="image" <?=isset($_POST['editable'])?"":"hidden"?>> <br>
        <input class="form-control" type="text" value="<?=$user->getDni()?>" disabled>  <br>
        <input class="form-control" type="text" name="username" value="<?=$user->getUsername()?>" <?=isset($_POST['editable'])?"":"disabled"?>> <br>
        <input class="form-control" type="text" name="name" value="<?=$user->getName()?>" <?=isset($_POST['editable'])?"":"disabled"?>> <br>
        <input class="form-control" type="text" name="surname" value="<?=$user->getSurname()?>" <?=isset($_POST['editable'])?"":"disabled"?>> <br>
        <input class="form-control" type="text" name="email" value="<?=$user->getEmail()?>" <?=isset($_POST['editable'])?"":"disabled"?>> <br>
        <input class="form-control" type="submit" name="<?=isset($_POST['editable'])?"save":"editable"?>" value="<?=isset($_POST['editable'])?"Save":"Edit"?>">
        </div>
        </div>
    </form>

    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
</section>
<?php require 'includes/footer.php'; ?>