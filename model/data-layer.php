<?php
/*
 * This is my Data Layer.
 * It belongs to the Model.
 */

    class DataLayer
    {
        //Get the meals for the Diner app
        static function getMeals() {
            return array('breakfast', 'lunch', 'dinner', 'dessert');
        }

        //Get the condiments for the Diner app
        static function getCondiments() {
            return array('ketchup', 'mustard', 'sriracha', 'mayonnaise');
        }
    }