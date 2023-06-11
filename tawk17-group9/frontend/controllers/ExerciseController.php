<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";
require_once __DIR__ . "/../../business-logic/ExercisesService.php";



class ExerciseController extends ControllerBase
{
    public function handleRequest()
    {
        // Check for POST method before checking any of the GET-routes
        if ($this->method == "POST") {
            $this->handlePost();
        }

        // GET: /home/purchases
        if ($this->path_count == 2) {
            $this->showAll();
        }

        // GET: /home/purchases/new
        else if ($this->path_count == 3 && $this->path_parts[2] == "new") {
            $this->showNewExerciseForm();
        }

        // GET: /home/purchases/{id}
        else if ($this->path_count == 3) {
            $this->showOne();
        }

        // GET: /home/purchases/{id}/edit
        else if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->showEditForm();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }

    // Gets all exercises and shows them in the index view
    private function showAll()
    {
        $this->requireAuth();

        if ($this->user->user_role === "admin") {
            $exercises = ExercisesService::getAllExercises();
        } else {
            $exercises = ExercisesService::getExercisesByUser($this->user->user_id);
        }

        // $this->model is used for sending data to the view
        $this->model = $exercises;

        $this->viewPage("exercises/index");
    }

    // Gets one exercise and shows it in the single view
   // Gets one purchase and shows it in the single view
   private function showOne()
{
    // Get the exercise with the ID from the URL
$exercise = $this->getExercise();

// Convert the Unix timestamp to a formatted date and time
$exerciseTime = date("Y-m-d H:i:s", $exercise->exercise_time);

// Update the exercise time to the formatted date and time
$exercise->exercise_time = $exerciseTime;

// Create an instance of the ExerciseExternalFetcher
$externalFetcher = new ExerciseExternalFetcher();

// Retrieve additional exercise data from the external API based on the exercise time
$externalData = $externalFetcher->getExerciseByDate($exercise->exercise_time);

// Process the retrieved external data as needed
// ...

// Assign the processed external data to the exercise model
$exercise->external_data = $externalData;

// $this->model is used for sending data to the view
$this->model["exercise"] = $exercise;

// Shows the view file exercises/single.php
$this->viewPage("exercises/single");

}


    // Gets one and shows it in the edit view
    private function showEditForm()
    {
        $this->requireAuth(["admin"]);

        // Get the exercise with the ID from the URL
        $exercise = $this->getExercise();

        // $this->model is used for sending data to the view
        $this->model = $exercise;

        // Shows the view file exercises/edit.php
        $this->viewPage("exercises/edit");
    }

    private function showNewExerciseForm()
    {
        $this->requireAuth();

        // Shows the view file exercises/new.php
        $this->viewPage("exercises/new");
    }

    // Gets one exercise based on the id in the URL
    private function getExercise()
    {
        $this->requireAuth();

        // Get the exercise with the specified ID
        $id = $this->path_parts[2];

        $exercise = ExercisesService::getExerciseById($id);

        if (!$exercise) {
            $this->notFound();
        }

        if ($this->user->user_role !== "admin" && $exercise->user_id !== $this->user->user_id) {
            $this->forbidden();
        }

        return $exercise;
    }

    // handle all post requests for exercises in one place
    private function handlePost()
    {
        // POST: /home/exercises
        if ($this->path_count == 2) {
            $this->createExercise();
        }

        // POST: /home/exercise/{id}/edit
        else if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->updateExercise();
        }

        // POST: /home/exercise/{id}/delete
        else if ($this->path_count == 4 && $this->path_parts[3] == "delete") {
            $this->deleteExercise();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }

    // Create an exercise with data from the URL and body
    private function createExercise()
    {
        $this->requireAuth();

        $exercise = new ExerciseModel();

        // Get updated properties from the body
        $exercise->exercise_name = $this->body["exercise_name"];
        $exercise->exercise_time = time();

        // Admins can connect any user to the exercise
        if ($this->user->user_role === "admin") {
            $exercise->user_id = $this->body["user_id"];
        }

        // Regular users can only add exercises to themselves
        else {
            $exercise->user_id = $this->user->user_id;
        }

        // Save the exercise
        $success = ExercisesService::saveExercise($exercise);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/exercises");
        } else {
            $this->error();
        }
    }

    // Update an exercise with data from the URL and body
    private function updateExercise()
    {
        $this->requireAuth(["admin"]);

        $exercise = new ExerciseModel();

        // Get ID from the URL
        $id = $this->path_parts[2];

        $existing_exercise = ExercisesService::getExerciseById($id);

        // Get updated properties from the body
        $exercise->exercise_name = $this->body["exercise_name"];
        $exercise->exercise_time = $existing_exercise->exercise_time;
        $exercise->user_id = $this->body["user_id"];

        $success = ExercisesService::updateExerciseById($id, $exercise);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/exercises");
        } else {
            $this->error();
        }
    }

    // Delete an exercise with data from the URL
    private function deleteExercise()
    {
        $this->requireAuth(["admin"]);

        // Get ID from the URL
        $id = $this->path_parts[2];

        // Delete the exercise
        $success = ExercisesService::deleteExerciseById($id);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/exercises");
        } else {
            $this->error();
        }
    }
}
