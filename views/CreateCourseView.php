<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5">

    <form action="?controller=admin&action=validateCourse">
        Name: <input type="text"> <br>
        Description: <input type="text"> <br>
        Teacher:
        <? if($teachers):?>
            <select name="teacher" id="">
                <? foreach($teachers as $teacher) ?>
                <option value="<?=$teacher->getDni()?>"><?=$teacher->getDni()." - ".$teacher->getName()." ".$teacher->getSurname()?></option>
            </select>
        <? else: ?>
            There are no teachers in the academy
        <? endif;?> <br>
        Start Date: <input type="datetime" name="" id=""> <br>
        End Date: <input type="datetime" name="" id=""> <br>
        Application Deadline: <input type="datetime" name="" id=""> <br>
        Length of the course (h): <input type="number"> <br>
        Cost: <input type="number" name="" id=""> <br>
        Max number of students: <input type="number" name="" id=""> <br>
        <input type="submit" value="Create">
    </form>

    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
</section>
<?php require 'includes/footer.php'; ?>