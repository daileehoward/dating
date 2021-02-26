<?php
    // Turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Start a session
    session_start();

    // Require the autoload file
    require_once('vendor/autoload.php');
    require_once('model/data-layer.php');

    // Instantiate Fat-Free
    $f3 = Base::instance();

    // Turn on Fat-Free error reporting
    $f3->set('DEBUG', 3);

    // Define a default route (home page)
    $f3->route('GET /', function()
    {
        // Display the view
        $view = new Template();
        echo $view->render('views/home.html');
    });

    // Define a default route (personal information page)
    $f3->route('GET|POST /personal-information', function()
    {
        // Display the view
        $view = new Template();
        echo $view->render('views/personal-information-form.html');
    });

    // Define a default route (profile page)
    $f3->route('GET|POST /profile', function($f3)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_SESSION['name'] = $_POST['firstName'] . " " . $_POST['lastName'];
            $_SESSION['species'] = $_POST['species'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['gender'] = $_POST['gender'];
            $_SESSION['phone'] = $_POST['phone'];
        }

        // Display the view
        $view = new Template();
        echo $view->render('views/profile-form.html');
    });

    // Define a default route (interests page)
    $f3->route('GET|POST /interests', function($f3)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['state'] = $_POST['state'];
            $_SESSION['seeking'] = $_POST['seeking'];
            $_SESSION['biography'] = $_POST['biography'];
        }

        $f3->set('indoorInterests', getIndoorInterests());
        $f3->set('outdoorInterests', getOutdoorInterests());

        // Display the view
        $view = new Template();
        echo $view->render('views/interests-form.html');
    });

    // Define a default route (profile summary page)
    $f3->route('POST /summary', function($f3)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if (isset($_POST['indoor']) && isset($_POST['outdoor']))
            {
                $_SESSION['interests'] = implode(", ", $_POST['indoor']) . ", " .
                    implode(", ", $_POST['outdoor']);
            }
            elseif (isset($_POST['indoor']))
            {
                $_SESSION['interests'] = implode(", ", $_POST['indoor']);
            }
            elseif (isset($_POST['outdoor']))
            {
                $_SESSION['interests'] = implode(", ", $_POST['outdoor']);
            }
        }

        // Display the view
        $view = new Template();
        echo $view->render('views/profile-summary.html');
    });

    $f3->run();