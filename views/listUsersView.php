<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5 m-5 text-center">

<a target="_BLANK" href="?controller=<?=$controller?>&action=pdfUsers"><button class="btn btn-primary btn-lg">Print</button></a>


    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>

    <table width="100%">
    <?php if( isset($unactiveUsers)): ?>
        <form action="?controller=<?=$controller?>&action=listUsers" method="POST">
    <div style="width:15em">
    <select class="form-select" onchange="this.form.submit()" name="itemsPerPageUnactiveUsers" id="">
            <option <?=$itemPerPage==2?"selected":""?> value="2">2 items per page</option>
            <option <?=$itemPerPage==4?"selected":""?> value="4">4 items per page</option>
            <option <?=$itemPerPage==6?"selected":""?> value="6">6 items per page</option>
            <option <?=$itemPerPage==8?"selected":""?> value="8">8 items per page</option>
            <option <?=$itemPerPage==10?"selected":""?> value="10">10 items per page</option>
        </select>
        <?php for($i = 0; $i<$numPagesUnactiveUsers; $i++): ?>
            <button type="submit" class="btn btn-primary round" name="numPageU" value="<?=$i?>"><?=$i?></button>
    <?php endfor; ?>
    </div>
        
    </form>
        <h2>UNACTIVE USERS</h2>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Username</th>
            <?php if($controller=='admin'): ?>
            <th>Dni</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Activate</th>
            <th>Delete</th>
            <?php endif; ?>
        </tr>
        <?php foreach($unactiveUsers as $user): ?>
            <tr>
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
                <td>
                    <button type="submit" name=<?=isset($_POST["edit@".$user->getUsername()])?"save":"edit@".$user->getUsername() ?> > <?=isset($_POST['edit@'.$user->getUsername()])?"S":"E"?> </button>
                </td>
                </form>
                <td>
                    <form action="?controller=admin&action=activateUser" method="POST">
                    <input type="text" name="numPageU" value="<?=$numPage?>" hidden>
                    <button type="submit" name="username" value=<?=$user->getUsername()?>>^</button>
                    </form>
                </td>
                <td>
                    <form action="?controller=admin&action=deleteUser" method="POST">
                    <button type="submit" name="username" value=<?=$user->getUsername()?>>x</button>
                    </form>
                </td>
                   
            
                
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td>THERE ARE NO UNACTIVE USERS YET!</td></tr>
    <?php endif; ?>
    </table>
    <h2>ACTIVE USERS</h2>
    <form action="?controller=<?=$controller?>&action=listUsers" method="POST">
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
    <?php if($users): ?>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Username</th>
            <?php if($controller=='admin'): ?>
            <th scope="col">Dni</th>
            <th scope="col">Email</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            <?php endif; ?>
        </tr>
        <?php foreach($users as $user): ?>
            <tr>
                <form enctype="multipart/form-data" method="POST" action=<?=isset($_POST['edit@'.$user->getUsername()])?"?controller=$controller&action=editUser":"?controller=$controller&action=listUsers" ?> >
                <input type="text" name="prevDni" value=<?=$user->getDni()?> hidden>
                <td scope="col"><img src="<?=$user->getImage()?>" width="80em" height="80em"<?=isset($_POST['edit@'.$user->getUsername()])?"hidden":""?>> 
                    <input type="file" name="image" value="" id="" <?=isset($_POST['edit@'.$user->getUsername()])?"":"hidden"?>>
                    </td>
                <td scope="col"><input type="text" name="name" value=<?=$user->getName()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td scope="col"><input type="text" name="surname" value=<?=$user->getSurname()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td scope="col"><input type="text" name="username" value=<?=$user->getUsername()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <?php if($controller=='admin'): ?>
                <td scope="col"><input type="text" name="dni" value=<?=$user->getDni()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td scope="col"><input type="text" name="email" value=<?=$user->getEmail()?> <?=isset($_POST['edit@'.$user->getUsername()])?"":"disabled"?>></td>
                <td scope="col">
                    <input type="text" name="numPage" value="<?=$numPage?>" hidden>
                    <button type="submit" name=<?=isset($_POST["edit@".$user->getUsername()])?"save":"edit@".$user->getUsername() ?> > <?=isset($_POST['edit@'.$user->getUsername()])?"S":"E"?> </button>
                </td>
                </form>
                <td scope="col">
                    <form action="?controller=admin&action=deleteUser" method="POST">
                    <button type="submit" name="username" value=<?=$user->getUsername()?>>x</button>
                    </form>
                </td>
                   
            
                
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td>THERE ARE NO ACTIVE USERS YET!</td></tr>
    <?php endif; ?>
    </table>

    
    

    
</section>
<?php require 'includes/footer.php'; ?>