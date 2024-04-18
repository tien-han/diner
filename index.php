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
        //If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
//            echo "<p>You got here using the POST method!</p>";
//            var_dump($_POST);

            //If you don't want to pass in $f3 as an argument, you can:
            global $f3;
            //OR
            $f3 = $GLOBALS['f3'];

            //Get the data from the post array
            $food = $_POST['food'];
            $meal = $_POST["meal"];

            //If the data is valid
            if (true) {
                $f3->set('SESSION.food', $food);
                $f3->set('SESSION.meal', $meal);
            }
        } else {
            echo "<p>You got here using the GET method!</p>";
        }

        //Render a view page
        $view = new Template();
        echo $view->render('views/order1.html');
    });

    //Order Form Part II route
    $f3-> route('GET /order2', function() {
        //Render a view page
        $view = new Template();
        echo $view->render('views/order2.html');
    });

    //Run Fat-Free
    $f3->run();
?>