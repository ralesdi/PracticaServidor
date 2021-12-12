<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5">

    <form action="?controller=admin&action=validateCourse" method="POST">
        Name: <input name="name" type="text" required> <br>
        Description: <input name="description" type="text" required> <br>
        Teacher:
        <? if($teachers):?>
            <select name="teacher" >
            <? foreach($teachers as $teacher): ?>
                <option value="<?=$teacher->getDni()?>"><?=$teacher->getDni()." - ".$teacher->getName()." ".$teacher->getSurname()?></option>
                <? endforeach; ?>
            </select>
        <? else: ?>
            There are no teachers in the academy
        <? endif;?> <br>
        Start Date: <input name="startDate" type="datetime-local" required> <br>
        End Date: <input name="endDate" type="datetime-local" required> <br>
        Application Deadline: <input name="applicationDeadline" type="datetime-local" required> <br>
        Length of the course (h): <input name="length" type="number" required> <br>
        Cost: <input type="number" name="cost" required> <br>
        Max number of students: <input type="number" name="maxStudents" required> <br>
        <input type="submit" name="create" value="Create">
    </form>

    <?php foreach ($messages as $message) : ?>
        <div class="alert alert-<?= $message["type"] ?> alert-dismissible fade show" role="alert">
            <?= $message["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
</section>
<?php require 'includes/footer.php'; ?>