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
        //echo '<h1>My Breakfast Menu</h1>';
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

    //Run Fat-Free
    $f3->run();
?>