<?php
require_once __DIR__ . "/../../Template.php";

Template::header($this->model["exercise"]->exercise_id);
?>

<h1><?= $this->model["exercise"]->exercise_id ?></h1>

<p>
    <b>Id: </b>
    <?= $this->model["exercise"]->exercise_id ?>
</p>

<p>
    <b>Exercise: </b>
    <?= $this->model["exercise"]->exercise_name ?>
</p>

<p>
    <b>Exercise time: </b>
    <?= $this->model["exercise"]->exercise_time ?>
</p>

<?php if ($this->user->user_role === "admin") : ?>

    <p>
        <b>User ID: </b>
        <?= $this->model["exercise"]->user_id ?>
    </p>

<?php endif; ?>

<!-- TIME -->


<?php Template::footer(); ?>