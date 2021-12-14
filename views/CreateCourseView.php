<?php require 'includes/header.php'; ?>
<?php require 'includes/navauth.php'; ?>
<section class="page-section pt-5 text-center">

    <form action="?controller=admin&action=validateCourse" method="POST">
    <div class="card w-50 m-auto p-3 color">
        Name: <input class="form-control" name="name" type="text" required> <br>
        Description: <input class="form-control" name="description" type="text" required> <br>
        Teacher:
        <?php if($teachers):?>
            <select class="form-select" name="teacher" >
            <?php foreach($teachers as $teacher): ?>
                <option value="<?=$teacher->getDni()?>"><?=$teacher->getDni()." - ".$teacher->getName()." ".$teacher->getSurname()?></option>
                <?php endforeach; ?>
            </select>
        <?php else: ?>
            There are no teachers in the academy
        <?php endif;?> <br>
        Start Date: <input class="form-control" name="startDate" type="datetime-local" required> <br>
        End Date: <input class="form-control" name="endDate" type="datetime-local" required> <br>
        Application Deadline: <input class="form-control" name="applicationDeadline" type="datetime-local" required> <br>
        Length of the course (h): <input class="form-control" name="length" type="number" required> <br>
        Cost: <input class="form-control" type="number" name="cost" required> <br>
        Max number of students: <input class="form-control" type="number" name="maxStudents" required> <br>
        <input type="submit" name="create" value="Create">
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