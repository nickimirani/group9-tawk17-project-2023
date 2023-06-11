<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Model class for users-table in database

/*class PurchaseModel{
    public $purchase_id;
    public $product_name;
    public $price;
    public $purchase_time;
    public $user_id;
}*/

class ExerciseModel{
    public $exercise_id;
    public $exercise_name;
    public $exercise_time;
    public $user_id;
    public $created_at;
}