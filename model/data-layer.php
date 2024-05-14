<?php
/*
 * This is my Data Layer.
 * It belongs to the Model.
 */

//Get the meals for the Diner app
function getMeals() {
    return array('breakfast', 'lunch', 'dinner', 'dessert');
}

//Get the condiments for the Diner app
function getCondiments() {
    return array('ketchup', 'mustard', 'sriracha', 'mayonnaise');
}