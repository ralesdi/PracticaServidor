<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5 m-5 text-center">

<?php if($controller=='admin'): ?>
    <div class="w-25 m-auto m-5 p-5">
    <form action="?controller=admin&action=addTeacher" method="POST">
    <input type="text" class="form-control " name="username" placeholder="Username"> <input class="btn btn-primary round" type="submit" value="Add Teacher">
    </div>
       </form>
<?php endif; ?>

<a target="_BLANK" href="?controller=<?=$controller?>&action=pdfTeachers"><button class="btn btn-primary btn-lg">Print</button></a>
<?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
    
    <form action="?controller=<?=$controller?>&action=teachers" method="POST">
    <div style="width:15em">
    <select class="form-select" onchange="this.form.submit()" name="itemsPerPageActiveUsers" id="">
            <option <?=$itemPerPage==2?"selected":""?> value="2">2 items per page</option>
            <option <?=$itemPerPage==4?"selected":""?> value="4">4 items per page</option>
            <option <?=$itemPerPage==6?"selected":""?> value="6">6 items per page</option>
            <option <?=$itemPerPage==8?"selected":""?> value="8">8 items per page</option>
            <option <?=$itemPerPage==10?"selected":""?> value="10">10 items per page</option>
        </select>
        <?php for($i = 0; $i<$numPagesActiveUsers; $i++): ?>
            <button type="submit" class="btn btn-primary round" name="numPage" value="<?=$i?>"><?=$i?></button>
    <?php endfor; ?>
    </div>
        
    </form>

    <table class="table table-striped" width="100%">
    <?php if($teachers): ?>
        <h2>ACTIVE USERS</h2>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Username</th>
            <?php if($controller=='admin'): ?>
            <th>Dni</th>
            <th>Email</th>
            <?php endif; ?>
        </tr>
        <?php foreach($teachers as $user): ?>
            <tr>
                <?php $user = User::listById($user->getDni()) ?> 
                <form enctype="multipart/form-data" method="POST" action=<?=isset($_POST['edit@'.$user->getUsername()])?"?controller=$controller&action=editUser":"?controller=$controller&action=listUsers" ?> >
                <input type="text" name="prevDni" value=<?=$user->getDni()?> hidden>
                <td><img src="<?=$user->getImage()?>" width="80em" height="80em"<?=isset($_POST['edit@'.$user->getUsername()])?"hidden":""?>> 
                    <input type="file" name="image" value="" id="" <?=isset($_POST['edit@'.$user->getUsername()])?"":"hidden"?>>
                    </td>
                <td><input type="text" name="name" value=<?=$user->getName()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td><input type="text" name="surname" value=<?=$user->getSurname()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td><input type="text" name="username" value=<?=$user->getUsername()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <?php if($controller=='admin'): ?>
                <td><input type="text" name="dni" value=<?=$user->getDni()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td><input type="text" name="email" value=<?=$user->getEmail()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <?php endif; ?>
                </form>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td>THERE ARE NO ACTIVE USERS YET!</td></tr>
    <?php endif; ?>
    </table>

    
    </section>
<?php require 'includes/footer.php'; ?>