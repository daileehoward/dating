<?php
    // Turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //Require the autoload file
    require_once('vendor/autoload.php');
    require_once('model/data-layer.php');

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

    //Define a default route (personal information page)
    $f3->route('GET /personal-information', function ()
    {
        // Display the view
        $view = new Template();
        echo $view->render('views/personal-information-form.html');
    });

    //Define a default route (profile page)
    $f3->route('GET /profile', function ()
    {
        // Display the view
        $view = new Template();
        echo $view->render('views/profile-form.html');
    });

    //Define a default route (interests page)
    $f3->route('GET /interests', function ()
    {
        // Display the view
        $view = new Template();
        echo $view->render('views/interests-form.html');
    });

    $f3->run();