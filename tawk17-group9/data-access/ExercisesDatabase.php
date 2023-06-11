<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}


require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/ExerciseModel.php";

class ExercisesDatabase extends Database
{
    /*private $table_name = "purchases";
    private $id_name = "purchase_id";*/

    private $table_name = "exercises";
    private $id_name = "exercise_id";


    public function getOne($exercise_id)
    {
        //$result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $purchase_id);
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $exercise_id);

        $exercise = $result->fetch_object("ExerciseModel");

        return $exercise;
    }



    public function getAll()
    {
        $result = $this->getAllRowsFromTable($this->table_name);

        $exercises = [];

        while ($exercise = $result->fetch_object("ExerciseModel")) {
            $exercises[] = $exercise;
        }

        return $exercises;
    }


    public function getByUserId($user_id)
    {
        $query = "SELECT * FROM exercises WHERE user_id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $user_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $exercises = [];

        while ($exercise = $result->fetch_object("ExerciseModel")) {
            $exercises[] = $exercise;
        }

        return $exercises;
    }



    public function insert(ExerciseModel $exercise)
    {
       // $query = "INSERT INTO purchases (product_name, price, purchase_time, user_id) VALUES (?, ?, ?, ?)";
       $query = "INSERT INTO exercises (exercise_name, exercise_time, user_id) VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sii", $exercise->exercise_name, $exercise->exercise_time, $exercise->user_id);

        $success = $stmt->execute();

        return $success;
    }


     
    public function updateById($exercise_id, ExerciseModel $exercise)
    {
        //$query = "UPDATE purchases SET product_name=?, price=?, purchase_time=?, user_id=? WHERE purchase_id=?;";
        $query = "UPDATE exercises SET exercise_name=?, exercise_time=?, user_id=? WHERE exercise_id=?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("siii", $exercise->exercise_name, $exercise->exercise_time, $exercise->user_id, $exercise_id);

        $success = $stmt->execute();

        return $success;
    }

    
    public function deleteById($exercise_id)
    {
        $success = $this->deleteOneRowByIdFromTable($this->table_name, $this->id_name, $exercise_id);

        return $success;
    }
}
