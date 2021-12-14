<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5 text-center">

    <form action="?controller=admin&action=updateCourse" method="POST">
        <div class="card w-50 m-auto p-3 color">
        Name: <input class="form-control"  value="<?=$course->getName()?>" type="text" required disabled> <br> <input name="name" value="<?=$course->getName()?>" type="text" required hidden>
        Description: <input class="form-control" name="description" value="<?=$course->getDescription()?>" type="text" required> <br>
        Teacher:
        <?php if($teachers):?>
            <select class="form-select" name="teacher">
                <?php foreach($teachers as $teacher): ?>
                <option <?=$teacher->getDni()==$course->getTeacher()?"selected":""?>  value="<?=$teacher->getDni()?>"><?=$teacher->getDni()." - ".$teacher->getName()." ".$teacher->getSurname()?></option>
                <?php endforeach; ?>
            </select>
        <?php else: ?>
            There are no teachers in the academy
        <?php endif;?> <br>
        Start Date: <input class="form-control" name="startDate" class="date" value="<?=date("Y-m-d\TH:i", strtotime($course->getStartDate()));?>" type="datetime-local" required> <br>
        End Date: <input class="form-control" name="endDate" value="<?=date("Y-m-d\TH:i", strtotime($course->getEndDate()));?>" type="datetime-local" required> <br>
        Application Deadline: <input class="form-control" name="applicationDeadline" value="<?=date("Y-m-d\TH:i", strtotime($course->getApplicationDeadline()));?>" type="datetime-local" required> <br>
        Length of the course (h): <input class="form-control" name="length" type="number" value="<?=$course->getLength()?>" required> <br>
        Cost: <input class="form-control" type="number" name="cost" value="<?=$course->getCost()?>" required> <br>
        Max number of students: <input class="form-control" type="number" value="<?=$course->getMaxStudents()?>" name="maxStudents" required> <br>
        <input type="submit" name="edit" value="Edit">
                    
        </div>
    </form>
        <a href="?controller=admin&action=courses"><button class="btn btn-primary btn-large round">Back</button></a>

    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
</section>
<?php require 'includes/footer.php'; ?>