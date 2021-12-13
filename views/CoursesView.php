<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5">

    <? if($controller=="admin"): ?>
    <a href="?controller=admin&action=createCourse"><button>Add Course</button></a>
    <? endif; ?>

    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>

    <form action="?controller=<?=$controller?>&action=courses" method="POST">
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
    <? if($courses): ?>
        <? foreach($courses as $course): ?>
        <h4><?=$course->getName()?></h4>
        <h4><?=$course->getDescription()?></h4>
        <h4><?=$course->getTeacher()?></h4>
        <? if($controller=="admin"): ?>
        <form action="?controller=admin&action=deleteCourse" method="POST">
        <button type="submit" name="name" value="<?=$course->getName()?>" >Delete Course</button>
        </form>
        <form action="?controller=admin&action=editCourse" method="POST">
        <button type="submit" name="name" value="<?=$course->getName()?>" >Edit Course</button>
        </form>
        <? //require_once MODELS_FOLDER."Application.php" ?>
        <? if($controller!='teacher' ): ?>
            <form action="?controller=<?=$controller?>&action=applicate" method="POST">
            <input type="text" name="courseName" value="<?=$course->getName()?>" hidden>
            <button type="submit" name="applicate" >Applicate for course</button>
            </form>
        <? endif;?>
        
        <? endif; ?>
        <? endforeach; ?>
    <? else: ?>
        <h3>THERE ARE NO COURSES YET!</h3>
    <? endif; ?>
    
</section>
<?php require 'includes/footer.php'; ?>