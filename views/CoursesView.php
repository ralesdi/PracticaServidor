<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5 text-center">
    <div class="m-5 p-5">
    <a target="_BLANK" href="?controller=<?=$controller?>&action=pdfCourses"><button class="btn btn-primary btn-lg">Print</button></a>
        <?php if($controller=="admin"): ?>
        <a href="?controller=admin&action=createCourse"><button class="btn btn-primary btn-lg">Add Course</button></a>
        <?php endif; ?>
    </div>
    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>

    <form action="?controller=<?=$controller?>&action=courses" method="POST">
    <div style="width:15em; margin: auto">
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
    <?php if($courses): ?>
        <?php foreach($courses as $course): ?>
            <div class="card w-50 m-auto mt-5  color align-self-center">
                <div class="card-header">
                    COURSE
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$course->getName()?></h5>
                    <p class="card-text"><?=$course->getDescription()?></p>
                    <?php $teacher = $course->getTeacherObject() ?>
                    <p class="card-text">Teacher: <?=$teacher->getName()." ".$teacher->getSurname()?></p>

                    <div >
                    <?php if($controller=="admin"): ?>
        <form action="?controller=admin&action=deleteCourse" method="POST">
        <button class="btn btn-light round m-3" type="submit" name="name" value="<?=$course->getName()?>" >Delete Course</button>
        </form>
        <form action="?controller=admin&action=editCourse" method="POST">
        <button class="btn btn-light round m-3" type="submit" name="name" value="<?=$course->getName()?>" >Edit Course</button>
        </form>
        <?php //require_once MODELS_FOLDER."Application.php" ?>
        <?php if($controller!='teacher' ): ?>
            <form action="?controller=<?=$controller?>&action=applicate" method="POST">
            <input type="text" name="courseName" value="<?=$course->getName()?>" hidden>
            <button class="btn btn-light round m-3" type="submit" name="applicate" >Applicate for course</button>
            </form>
        <?php endif;?>
        
        <?php endif; ?>
                    </div>
                </div>
            </div>
       
        <?php endforeach; ?>
    <?php else: ?>
        <h3>THERE ARE NO COURSES YET!</h3>
    <?php endif; ?>
    
</section>
<?php require 'includes/footer.php'; ?>