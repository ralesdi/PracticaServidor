<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5">

    <? if($controller=="admin"): ?>
    <a href="?controller=admin&action=activateUsers"><button>User Activation</button></a>
    <? endif; ?>

    <table width="100%">
    <? if($unactiveUsers): ?>
        <h2>UNACTIVE USERS</h2>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Username</th>
            <? if($controller=='admin'): ?>
            <th>Dni</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Activate</th>
            <th>Delete</th>
            <? endif; ?>
        </tr>
        <? foreach($unactiveUsers as $user): ?>
            <tr>
                <form action="">
                <td><?=$user->getImage()?></td>
                <td><?=$user->getName()?></td>
                <td><?=$user->getSurname()?></td>
                <td><?=$user->getUsername()?></td>
                <? if($controller=='admin'): ?>
                <td><?=$user->getDni()?></td>
                <td><?=$user->getEmail()?></td>
                <td>
                    <button type="submit" name="username" value=<?=$user->getUsername()?>>E</button>
                </td>
                </form>
                <td>
                    <form action="?controller=admin&action=activateUser" method="POST">
                    <button type="submit" name="username" value=<?=$user->getUsername()?>>!</button>
                    </form>
                </td>
                <td>
                    <form action="?controller=admin&action=deleteUser" method="POST">
                    <button type="submit" name="username" value=<?=$user->getUsername()?>>x</button>
                    </form>
                </td>
                   
            
                
                <? endif; ?>
            </tr>
        <? endforeach; ?>
    <? else: ?>
        <tr><td>THERE ARE NO USERS YET!</td></tr>
    <? endif; ?>
    </table>

    <table width="100%">
    <? if($users): ?>
        <h2>ACTIVE USERS</h2>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Username</th>
            <? if($controller=='admin'): ?>
            <th>Dni</th>
            <th>Email</th>
            <th>Edit</th>
            <? endif; ?>
        </tr>
        <? foreach($users as $user): ?>
            <tr>
                <td><?=$user->getImage()?></td>
                <td><?=$user->getName()?></td>
                <td><?=$user->getSurname()?></td>
                <td><?=$user->getUsername()?></td>
                <? if($controller=='admin'): ?>
                <td><?=$user->getDni()?></td>
                <td><?=$user->getEmail()?></td>
                <th><button>Edit</button></th>
                <? endif; ?>
            </tr>
        <? endforeach; ?>
    <? else: ?>
        <tr><td>THERE ARE NO USERS YET!</td></tr>
    <? endif; ?>
    </table>
    

    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
</section>
<?php require 'includes/footer.php'; ?>