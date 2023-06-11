<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Exercises");
?>

<h1>Exercises</h1>

<a href="<?= $this->home ?>/exercises/new">Create new</a>

<div class="item-grid">
    <?php foreach ($this->model as $exercise) : ?>
        <article class="item">
            <div>
                <b><?= $exercise->exercise_name ?></b> <br>
                <span>Exercise time: <?= date('Y-m-d H:i:s',($exercise->exercise_time)) ?></span> <br>

            </div>
            <?php if ($this->user->user_role === "admin") : ?>
                <p>
                    <b>User ID: </b>
                    <?= $exercise->user_id ?>
                </p>
                <a href="<?= $this->home ?>/exercises/<?= $exercise->exercise_id ?>/edit">Edit</a>
            <?php endif; ?>
            <a href="<?= $this->home ?>/exercises/<?= $exercise->exercise_id ?>">Show</a>
        </article>
    <?php endforeach; ?>
</div>

<?php Template::footer(); ?>