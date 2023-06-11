<?php
require_once __DIR__ . "/../../Template.php";

Template::header("New Exercise");
?>

<h1>New Exercise</h1>

<form action="<?= $this->home ?>/exercises" method="post">
    <input type="text" name="exercise_name" placeholder="Exercise"> <br>
    <input type="date" name="exercise_time" placeholder="Date"> <br>

    <?php if ($this->user->user_role === "admin") : ?>
        <input type="number" name="user_id" placeholder="User ID"> <br>
    <?php endif; ?>

    <input type="submit" value="Save" class="btn">
</form>

<?php Template::footer(); ?>