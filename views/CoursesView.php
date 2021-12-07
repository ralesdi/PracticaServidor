<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5">

    <? if($controller=="admin"): ?>
    <a href="?controller=admin&action=createCourse"><button>Add Course</button></a>
    <? endif; ?>


    <? if($courses): ?>
        <? foreach($courses as $course): ?>
        <h4><?=$course->getName()?></h4>
        <? endforeach; ?>
    <? else: ?>
        <h3>THERE ARE NO COURSES YET!</h3>
    <? endif; ?>
    
    

    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
</section>
<?php require 'includes/footer.php'; ?>