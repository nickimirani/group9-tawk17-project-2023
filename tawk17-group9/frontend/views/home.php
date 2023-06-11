<?php
require_once __DIR__ . "/../Template.php";

Template::header("Home");
?>

<h1>Welcome: <?= $this->home ?></h1>

<p>
Hello! Welcome to our workout tracking app. Get ready to track and monitor your workouts...   </p>


<?php Template::footer(); ?>