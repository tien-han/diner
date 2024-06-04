<?php
    /** Order class represents a diner order */

    //In PHP, curly braces must be on the next line for classes
    class Order
    {
        private string $_food;
        private string $_meal;
        private string $_condiments;

        //You can't have overload constructors in PHP
        /**
         * Constructor creates an Order object
         * @param $_food string the food the user ordered
         * @param $_meal string the selected meal
         * @param $_condiments string the selected condiments
         */
        public function __construct($_food="", $_meal="", $_condiments="")
        {
            $this->_food = $_food;
            $this->_meal = $_meal;
            $this->_condiments = $_condiments;
        }

        public function getFood(): string
        {
            return $this->_food;
        }

        public function setFood(string $food): void
        {
            $this->_food = $food;
        }

        /**
         * @return string the meal that was ordered
         */
        public function getMeal(): string
        {
            return $this->_meal;
        }

        public function setMeal(string $meal): void
        {
            $this->_meal = $meal;
        }

        /**
         * Return the condiments
         * @return string array An array of condiments
         */
        public function getCondiments(): string
        {
            return $this->_condiments;
        }

        /**
         * @param string $condiments
         * @return void
         */
        public function setCondiments(string $condiments): void
        {
            $this->_condiments = $condiments;
        }
    }