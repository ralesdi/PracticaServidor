<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5">

    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
    <form action="?controller=<?=$controller?>&action=ApplicationList" method="POST">
        <input type="text" name="courseName" value="<?=$courseApp?>" hidden>
        <select onchange="this.form.submit()" name="itemsPerPageActiveUsers" id="">
            <option <?=$itemPerPage==2?"selected":""?> value="2">2 items per page</option>
            <option <?=$itemPerPage==4?"selected":""?> value="4">4 items per page</option>
            <option <?=$itemPerPage==6?"selected":""?> value="6">6 items per page</option>
            <option <?=$itemPerPage==8?"selected":""?> value="8">8 items per page</option>
            <option <?=$itemPerPage==10?"selected":""?> value="10">10 items per page</option>
        </select>
        <? for($i = 0; $i<$numPagesActiveUsers; $i++): ?>
            <button type="submit" name="numPage" value="<?=$i?>"><?=$i?></button>
    <? endfor; ?>
    </form>
    <table width="100%">
    <? if($applications): ?>
        <h2>ACTIVE USERS</h2>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Username</th>
            <? if($controller=='teacher'): ?>
            <th>Dni</th>
            <th>Email</th>
            <th>Application</th>
            <? endif; ?>
        </tr>
        <? foreach($applications as $application): ?>
            <? $user = User::listByParameters(['username' => $application->getUsername()])[0]?>
            <tr>
                <form enctype="multipart/form-data" method="POST" action=<?=isset($_POST['edit@'.$user->getUsername()])?"?controller=$controller&action=editUser":"?controller=$controller&action=listUsers" ?> >
                <input type="text" name="prevDni" value=<?=$user->getDni()?> hidden>
                <td><img src="<?=$user->getImage()?>" width="80em" height="80em"<?=isset($_POST['edit@'.$user->getUsername()])?"hidden":""?>> 
                    <input type="file" name="image" value="" id="" <?=isset($_POST['edit@'.$user->getUsername()])?"":"hidden"?>>
                    </td>
                <td><input type="text" name="name" value=<?=$user->getName()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td><input type="text" name="surname" value=<?=$user->getSurname()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td><input type="text" name="username" value=<?=$user->getUsername()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <? if($controller=='teacher'): ?>
                <td><input type="text" name="dni" value=<?=$user->getDni()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td><input type="text" name="email" value=<?=$user->getEmail()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>

                </form>
                <td>
                    <?if($application->getIsAccepted()==0): ?>
                    <form action="?controller=teacher&action=acceptApplication" method="POST">
                        <button name="id" value=<?=$application->id?>>Accept</button>
                    </form>

                    <form action="?controller=teacher&action=rejectApplication" method="POST">
                    <button type="submit" name="id" value=<?=$application->id?>>Reject</button>
                    </form>
                    <? endif; ?>
                </td>
                <? endif; ?>
            </tr>
        <? endforeach; ?>
    <? else: ?>
        <tr><td>THERE ARE NO APPLICATIONS USERS YET!</td></tr>
    <? endif; ?>
    </table>
    

    
</section>
<?php require 'includes/footer.php'; ?>