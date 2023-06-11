<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Edit " . $this->model->exercise_id);
?>

<h1>Edit <?= $this->model->exercise_id ?></h1>

<form action="<?= $this->home ?>/exercises/<?= $this->model->exercise_id ?>/edit" method="post">
    <input type="text" name="exercise_name" value="<?= $this->model->exercise_name ?>" placeholder="Exercise"> <br>
   
    <input type="date" name="time" value="<?= $this->model->time ?>" placeholder="Date"> <br>

    <input type="number" name="user_id" value="<?= $this->model->user_id ?>" placeholder="User ID"> <br>

    <input type="submit" value="Save" class="btn">
</form>

<form action="<?= $this->home ?>/exercises/<?= $this->model->exercise_id ?>/delete" method="post">
    <input type="submit" value="Delete" class="btn delete-btn">
</form>

<?php Template::footer(); ?>