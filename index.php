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
    //If added something new to autoload file, type 'composer update' in root directory
    require_once('vendor/autoload.php');

    //Instantiate the F3 Base class (Fat-Free)
    $f3 = Base::instance();
    $con = new Controller($f3);
    $dataLayer = new DataLayer();

    ////Testing
    //$myOrder = new Order('breakfast', 'pancakes', 'maple syrup');
    //$id = $dataLayer->saveOrder($myOrder);
    //echo "Order $id inserted successfully!";

    //Define a default route
    $f3-> route('GET /', function() {
        $GLOBALS['con']->home();
    });

    //Breakfast menu route
    $f3-> route('GET /menus/breakfast', function() {
        //Render a view page
        $GLOBALS['con']->breakfast();
    });

    //Lunch menu route
    $f3-> route('GET /menus/lunch', function() {
        //Render a view page
        $GLOBALS['con']->lunch();
    });

    //Dinner menu route
    $f3-> route('GET /menus/dinner', function() {
        $GLOBALS['con']->dinner();
    });

    //Order Form Part I route
    //PHP doesn't look for global variables unless you tell it to, so we have to pass in $f3
    $f3-> route('GET|POST /order1', function($f3) {
        //If you don't want to pass in $f3 as an argument, you can:
            //global $f3;
            //OR
            //$f3 = $GLOBALS['f3'];
        $GLOBALS['con']->order1();
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
                $f3->get('SESSION.order')->setCondiments($condiments);

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
        $condiments = DataLayer::getCondiments();
        $f3->set('condiments', $condiments);

        //Render a view page
        $view = new Template();
        echo $view->render('views/order2.html');
    });

    //Order Summary route
    $f3-> route('GET /summary', function() {
        $GLOBALS['con']->summary();
    });

    //Run Fat-Free
    $f3->run();
?>