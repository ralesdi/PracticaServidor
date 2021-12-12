<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5">

<form action="?controller=admin&action=addTeacher" method="POST">
    <input type="text" name="username" placeholder="Username"> <input type="submit" value="Add Techer">
</form>

<?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>

<table width="100%">
    <? if($teachers): ?>
        <h2>Teachers</h2>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Username</th>
            <? if($controller=='admin'): ?>
            <th>Dni</th>
            <th>Email</th>
            <? endif; ?>
        </tr>
        <? foreach($teachers as $user): ?>
            <tr>
                <form enctype="multipart/form-data" method="POST" action=<?=isset($_POST['edit@'.$user->getUsername()])?"?controller=$controller&action=editUser":"?controller=$controller&action=listUsers" ?> >
                <input type="text" name="prevDni" value=<?=$user->getDni()?> hidden>
                <td><img src="<?=$user->getImage()?>" width="80em" height="80em"<?=isset($_POST['edit@'.$user->getUsername()])?"hidden":""?>> 
                    <input type="file" name="image" value="" id="" <?=isset($_POST['edit@'.$user->getUsername()])?"":"hidden"?>>
                    </td>
                <td><input type="text" name="name" value="<?=$user->getName()?>" <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td><input type="text" name="surname" value="<?=$user->getSurname()?>" <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td><input type="text" name="username" value="<?=$user->getUsername()?>" <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <? if($controller=='admin'): ?>
                <td><input type="text" name="dni" value="<?=$user->getDni()?>" <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td><input type="text" name="email" value="<?=$user->getEmail()?>" <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                </form>
                   
            
                
                <? endif; ?>
            </tr>
        <? endforeach; ?>
    <? else: ?>
        <tr><td>THERE ARE NO USERS YET!</td></tr>
    <? endif; ?>
    </table>
    </section>
<?php require 'includes/footer.php'; ?>