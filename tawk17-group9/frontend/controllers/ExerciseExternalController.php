<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";
require_once __DIR__ . "/../../business-logic/ExerciseExternalService.php";


class ExerciseExternalController extends ControllerBase
{

    public function handleRequest()
    {
        $date = isset($this->query_params["date"]) ? $this->query_params["date"] : null;
        /*$endtime = isset($this->query_params["endtime"]) ? $this->query_params["endtime"] : null;*/

        $this->model = "";

        if($date){
            // Get chapter & verse
            $this->model = ExerciseExternalService::getExerciseByDate($date); 
        }

        /*if($starttime && $endtime){
            // Get chapter & verse
            $this->model = BibleService::getEndTime($starttime, $endtime);

            
        }*/
        else if($date){
            // Get chapter all verses
            $this->model = ExerciseExternalService::getAllExercises();
        }

        $this->viewPage("exerciseexternal/home");
    }
}
