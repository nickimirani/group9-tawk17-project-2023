<?php

require_once __DIR__ . "/../exerciseexternal-data-access/ExerciseExternalFetcher.php";

class ExerciseExternalService {
    public static function getExerciseByDate($date) {
        $exerciseexternal_fetcher = new ExerciseExternalFetcher();

        // Make API request to retrieve exercise data for the given date
        $exercise_data = $exerciseexternal_fetcher->getExerciseByDate($date);

        // Process the exercise data as needed
        // ...

        return $exercise_data;
    }

    public static function getAllExercises() {
        $exerciseexternal_fetcher = new ExerciseExternalFetcher();

        // Make API request to retrieve all exercise data
        $exercise_data = $exerciseexternal_fetcher->getAllExercises();

        // Process the exercise data as needed
        // ...

        return $exercise_data;
    }
}
