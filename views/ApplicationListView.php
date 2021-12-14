<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5 m-5">

    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
    
    <a target="_BLANK" href="?controller=<?=$controller?>&action=pdfApplications"><button class="btn btn-primary btn-lg round">Print</button></a>

    <table class="table table-striped" width="100%">
    <?php if($applications): ?>
        <h2>ACTIVE USERS</h2>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Username</th>
            <?php if($controller=='teacher'): ?>
            <th>Dni</th>
            <th>Email</th>
            <th>Application</th>
            <?php endif; ?>
        </tr>
        <?php foreach($applications as $application): ?>
            <?php $user = User::listByParameters(['username' => $application->getUsername()])[0]?>
            <tr>
                <form enctype="multipart/form-data" method="POST" action=<?=isset($_POST['edit@'.$user->getUsername()])?"?controller=$controller&action=editUser":"?controller=$controller&action=listUsers" ?> >
                <input type="text" name="prevDni" value=<?=$user->getDni()?> hidden>
                <td><img src="<?=$user->getImage()?>" width="80em" height="80em"<?=isset($_POST['edit@'.$user->getUsername()])?"hidden":""?>> 
                    <input type="file" name="image" value="" id="" <?=isset($_POST['edit@'.$user->getUsername()])?"":"hidden"?>>
                    </td>
                <td><input type="text" name="name" value=<?=$user->getName()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td><input type="text" name="surname" value=<?=$user->getSurname()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td><input type="text" name="username" value=<?=$user->getUsername()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <?php if($controller=='teacher'): ?>
                <td><input type="text" name="dni" value=<?=$user->getDni()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td><input type="text" name="email" value=<?=$user->getEmail()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>

                </form>
                <td>
                    <?php if($application->getIsAccepted()==0): ?>
                    <form action="?controller=teacher&action=acceptApplication" method="POST">
                        <button name="id" value=<?=$application->id?>>Accept</button>
                    </form>

                    <form action="?controller=teacher&action=rejectApplication" method="POST">
                    <button type="submit" name="id" value=<?=$application->id?>>Reject</button>
                    </form>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td>THERE ARE NO APPLICATIONS USERS YET!</td></tr>
    <?php endif; ?>
    </table>
    

    
</section>
<?php require 'includes/footer.php'; ?>