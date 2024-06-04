<?php
/*
 * This is my Data Layer.
 * It belongs to the Model.
 */

    class DataLayer
    {
        //Add a field to store the db connection object
        private $_dbh;

        /**
         * @return DataLayer constructor connects to PDO Database
         */
        function __construct()
        {
            //Require my PDO database connection credentials
            require_once $_SERVER['DOCUMENT_ROOT'].'/../config1.php';

            try {
                //Instantiate our PDO Database object
                $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            }
            catch(PDOException $e) {
                //die($e->getMessage());
                die("<p>Something went wrong!</p>");
            }
        }

        /**
         * Save a restaurant order to the database
         *
         * @param $order on Order object
         *
         * @return int the Order ID
         */
        function saveOrder($order)
        {
            //1. Define the query
            $sql = 'INSERT INTO orders (food, meal, condiments)
            VALUES (:food, :meal, :condiments)';

            //2. Prepare the statement
            $statement = $this->_dbh->prepare($sql);

            //3. Bind the parameters
            $food= $order->getFood();
            $meal = $order->getMeal();
            $condiments = $order->getCondiments();

            $statement->bindParam(':food', $food);
            $statement->bindParam(':meal', $meal);
            $statement->bindParam(':condiments', $condiments);

            //4. Execute the query
            $statement->execute();

            //5. Get the primary key
            $id = $this->_dbh->lastInsertId();
            return $id;
        }

        /**
         * Get the meals for the Diner app
         *
         * @return string[]
         */
        static function getMeals() {
            return array('breakfast', 'brunch', 'lunch', 'dinner', 'dessert');
        }

        //Get the condiments for the Diner app
        static function getCondiments() {
            return array('ketchup', 'mustard', 'sriracha', 'mayonnaise');
        }
    }