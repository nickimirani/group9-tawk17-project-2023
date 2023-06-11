<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/ExercisesDatabase.php";

class ExercisesService{

    public static function getExerciseById($id){
        $exercises_database = new ExercisesDatabase();

        $exercise = $exercises_database->getOne($id);

        return $exercise;
    }
    

    public static function getAllExercises(){
        $exercises_database = new ExercisesDatabase();

        $exercises = $exercises_database->getAll();

        return $exercises;
    }
    

    public static function getExercisesByUser($user_id){
        $exercises_database = new ExercisesDatabase();

        $exercises = $exercises_database->getByUserId($user_id);

        return $exercises;
    }

    
    public static function saveExercise(ExerciseModel $exercise){
        $exercises_database = new ExercisesDatabase();

        $success = $exercises_database->insert($exercise);

        return $success;
    }

    
    public static function updateExerciseById($exercise_id, ExerciseModel $exercise){
        $exercise_database = new ExercisesDatabase();

        $success = $exercise_database->updateById($exercise_id, $exercise);

        return $success;
    }

    
    public static function deleteExerciseById($exercise_id){
        $exercise_database = new ExercisesDatabase();

        $success = $exercise_database->deleteById($exercise_id);

        return $success;
    }
}

