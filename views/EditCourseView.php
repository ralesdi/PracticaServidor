<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5">

    <form action="?controller=admin&action=updateCourse" method="POST">
        Name: <input name="name" value="<?=$course->getName()?>" type="text" required disabled> <br>
        Description: <input name="description" value="<?=$course->getDescription()?>" type="text" required> <br>
        Teacher:
        <? if($teachers):?>
            <select name="teacher">
                <? foreach($teachers as $teacher): ?>
                <option <?=$teacher->getDni()==$course->getTeacher()?"selected":""?>  value="<?=$teacher->getDni()?>"><?=$teacher->getDni()." - ".$teacher->getName()." ".$teacher->getSurname()?></option>
                <? endforeach; ?>
            </select>
        <? else: ?>
            There are no teachers in the academy
        <? endif;?> <br>
        Start Date: <input name="startDate" class="date" value="<?=date("Y-m-d\TH:i", strtotime($course->getStartDate()));?>" type="datetime-local" required> <br>
        End Date: <input name="endDate" value="<?=date("Y-m-d\TH:i", strtotime($course->getEndDate()));?>" type="datetime-local" required> <br>
        Application Deadline: <input name="applicationDeadline" value="<?=date("Y-m-d\TH:i", strtotime($course->getApplicationDeadline()));?>" type="datetime-local" required> <br>
        Length of the course (h): <input name="length" type="number" value="<?=$course->getLength()?>" required> <br>
        Cost: <input type="number" name="cost" value="<?=$course->getCost()?>" required> <br>
        Max number of students: <input type="number" value="<?=$course->getMaxStudents()?>" name="maxStudents" required> <br>
        <input type="submit" name="create" value="Edit">
    </form>

    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
</section>
<?php require 'includes/footer.php'; ?>