<?php
    // Turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //Require the autoload file
    require_once('vendor/autoload.php');

    // Instantiate Fat-Free
    $f3 = Base::instance();

    // Turn on Fat-Free error reporting
    $f3->set('DEBUG', 3);

    //Define a default route (home page)
    $f3->route('GET /', function ()
    {
        // Display the view
        $view = new Template();
        echo $view->render('views/home.html');
    });

    $f3->run();