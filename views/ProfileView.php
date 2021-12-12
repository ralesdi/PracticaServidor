<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5">
    <form action="<?=isset($_POST['editable'])?"?controller=$controller&action=saveProfileChanges": "?controller=$controller&action=profile"?>" method="POST" enctype="multipart/form-data">
        <img src=<?=$user->getImage()?> alt="" width="100em" height="100em">
        <input type="file" name="image" <?=isset($_POST['editable'])?"":"hidden"?>> <br>
        <input type="text" value="<?=$user->getDni()?>" disabled>  <br>
        <input type="text" name="username" value="<?=$user->getUsername()?>" <?=isset($_POST['editable'])?"":"disabled"?>> <br>
        <input type="text" name="name" value="<?=$user->getName()?>" <?=isset($_POST['editable'])?"":"disabled"?>> <br>
        <input type="text" name="surname" value="<?=$user->getSurname()?>" <?=isset($_POST['editable'])?"":"disabled"?>> <br>
        <input type="text" name="email" value="<?=$user->getEmail()?>" <?=isset($_POST['editable'])?"":"disabled"?>> <br>
        <input type="submit" name="<?=isset($_POST['editable'])?"save":"editable"?>" value="<?=isset($_POST['editable'])?"Save":"Edit"?>">
    </form>

    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
</section>
<?php require 'includes/footer.php'; ?>