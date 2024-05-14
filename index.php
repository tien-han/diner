<?php
/**
 * 328/diner/index.php
 * Simple MVC using the Fat-Free framework.
 * @author Tien Han
 * @version 1.0
 */

    //Turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //Require the autoload file
    require_once('vendor/autoload.php');
    require_once('model/data-layer.php');
    require_once('model/validate.php');

    $testFood = 'pho';
//    echo validFood($testFood) ? "valid" : "not valid";
    $testfood = '    xy     ';
    echo validFood($testFood);

    //Instantiate the F3 Base class (Fat-Free)
    $f3 = Base::instance();

    //Define a default route
    $f3-> route('GET /', function() {
        //Render a view page
        $view = new Template();
        echo $view->render('views/home-page.html');
    });

    //Breakfast menu route
    $f3-> route('GET /menus/breakfast', function() {
        //Render a view page
        $view = new Template();
        echo $view->render('views/breakfast-menu.html');
    });

    //Lunch menu route
    $f3-> route('GET /menus/lunch', function() {
        //Render a view page
        $view = new Template();
        echo $view->render('views/lunch-menu.html');
    });

    //Dinner menu route
    $f3-> route('GET /menus/dinner', function() {
        //Render a view page
        $view = new Template();
        echo $view->render('views/dinner-menu.html');
    });

    //Order Form Part I route
    //PHP doesn't look for global variables unless you tell it to, so we have to pass in $f3
    $f3-> route('GET|POST /order1', function($f3) {
        //Initialize variables
        $food = '';
        $meal = '';

        //If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
//            echo "<p>You got here using the POST method!</p>";
//            var_dump($_POST);

            if (validFood($_POST['food'])) {
                $food = $_POST['food'];
            } else {
                $f3->set('errors["food"]', 'Please enter a food');
            }

            //If you don't want to pass in $f3 as an argument, you can:
//            global $f3;
//            //OR
//            $f3 = $GLOBALS['f3'];

            //Get the data from the post array
            if (isset($_POST['meal']) and validMeal($_POST['meal'])) {
                $meal = $_POST['meal'];
            } else {
                $f3->set('errors["meal"]', 'Please select a meal');
            }

            //If the data is valid
            // if (!empty($food) && !empty($meal)) {
            //Add the data to the session array
            $f3->set('SESSION.food', $food);
            $f3->set('SESSION.meal', $meal);

            if(empty($f3->get('errors'))) {
                //Send the user to the next form
                $f3->reroute('order2');
            }
        } else {
            echo "<p>You got here using the GET method!</p>";
        }

        //Get the data from the model
        //and add it to the F3 hive so that it's visible in page
        $meals = getMeals();
        $f3->set('meals', $meals);

        //Render a view page
        $view = new Template();
        echo $view->render('views/order1.html');
    });

    //Order Form Part II route
    $f3-> route('GET|POST /order2', function($f3) {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['conds'])) {
                $condiments = implode(", ", $_POST['conds']);
            } else {
                $condiments = "None selected";
            }

            if (true) {

                //Add the data to the session array
                $f3->set('SESSION.condiments', $condiments);

                //Send the user to the next form
                $f3->reroute('summary');
            } else {
                //TODO: This is temporary; move it into a views file
                echo "<p>Validation errors</p>";
            }
        } else {
            echo "<p>You got here using the GET method!</p>";
        }

        //Get the data from the model
        //and add it to the F3 hive so that it's visible in page
        $condiments = getCondiments();
        $f3->set('condiments', $condiments);

        //Render a view page
        $view = new Template();
        echo $view->render('views/order2.html');
    });

    //Order Summary route
    $f3-> route('GET /summary', function($f3) {
        var_dump($f3->get('SESSION'));

        //Render a view page
        $view = new Template();
        echo $view->render('views/order-summary.html');
    });

    //Run Fat-Free
    $f3->run();
?>