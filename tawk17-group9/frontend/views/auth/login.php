<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Workout App -  Login", $this->model["error"]);
?>

<div class="container">
    <h1 class="title">Workout App</h1>

    <div class="login-form">
        <h2 class="subtitle">Log in</h2>

        <form action="<?= $this->home ?>/auth/login" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password">
            </div>

            <button type="submit" class="btn btn-primary">Log in</button>
        </form>

        <p class="register-link">Not registered? <a href="<?= $this->home ?>/auth/register">Create user</a></p>
    </div>
</div>

<?php Template::footer(); ?>
