<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/RestAPI.php";
require_once __DIR__ . "/../business-logic/ExercisesService.php";


class ExercisesAPI extends RestAPI
{

    // Handles the request by calling the appropriate member function
    public function handleRequest()
    {

        // GET: /api/exercises
        if ($this->method == "GET" && $this->path_count == 2) {
            $this->getAll();
        }

        // GET: /api/purchases/{id}
        else if ($this->path_count == 3 && $this->method == "GET") {
            $this->getById($this->path_parts[2]);
        }

        // POST: /api/purchases
        else if ($this->path_count == 2 && $this->method == "POST") {
            $this->postOne();
        }

        // PUT: /api/purchases/{id}
        else if ($this->path_count == 3 && $this->method == "PUT") {
            $this->putOne($this->path_parts[2]);
        }

        // DELETE: /api/purchases/{id}
        else if ($this->path_count == 3 && $this->method == "DELETE") {
            $this->deleteOne($this->path_parts[2]);
        }

        // If none of our ifs are true, we should respond with "not found"
        else {
            $this->notFound();
        }
    }


    private function getAll()
    {
        $this->requireAuth();

        if ($this->user->user_role === "admin") {
            $exercises = ExercisesService::getAllExercises();
        } else {
            $exercises = ExercisesService::getExercisesByUser($this->user->user_id);
        }

        $this->sendJson($exercises);
    }


    private function getById($id)
    {
        $this->requireAuth();

        $exercise = ExercisesService::getExerciseById($id);

        if (!$exercise) {
            $this->notFound();
        }

        if ($this->user->user_role !== "admin" || $exercise->user_id !== $this->user->user_id) {
            $this->forbidden();
        }

        $this->sendJson($exercise);
    }


    private function postOne()
    {
        $this->requireAuth();

        $exercise = new ExerciseModel();

        $exercise->exercise_name = $this->body["exercise_name"];
        //$exercise->price = $this->body["price"];
        $exercise->exercise_time = $this->body["exercise_time"];

        // Admins can connect any user to the purchase
        if ($this->user->user_role === "admin") {
            $exercise->user_id = $this->body["user_id"];
        }

        // Regular users can only add purchases to themself
        else {
            $exercise->user_id = $this->user->user_id;
        }

        $success = ExercisesService::saveExercise($exercise);

        if ($success) {
            $this->created();
        } else {
            $this->error();
        }
    }


    private function putOne($id)
    {
        $this->requireAuth(["admin"]);

        $exercise = new ExerciseModel();

        $exercise->exercise_name = $this->body["exercise_name"];
        //$purchase->price = $this->body["price"];
        $exercise->exercise_time = $this->body["exercise_time"];
        $exercise->user_id = $this->body["user_id"];

        $success = ExercisesService::updateExerciseById($id, $exercise);

        if ($success) {
            $this->ok();
        } else {
            $this->error();
        }
    }

    // Deletes the purchase with the specified ID in the DB
    private function deleteOne($id)
    {
        // only admins can delete purchases
        $this->requireAuth(["admin"]);

        $exercise = ExercisesService::getExerciseById($id);

        if ($exercise == null) {
            $this->notFound();
        }

        $success = ExercisesService::deleteExerciseById($id);

        if ($success) {
            $this->noContent();
        } else {
            $this->error();
        }
    }
}
