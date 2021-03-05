<?php
    /**
     * @author Dailee Howard
     * @file index.php
     * @description This file contains the framework for Bow-Meow Dates.
     */

    // Turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Require the autoload file
    require_once('vendor/autoload.php');

    // Start a session
    session_start();

    // Instantiate Fat-Free
    $f3 = Base::instance();
    $validator = new Validate();
    $dataLayer = new DataLayer();

    // Turn on Fat-Free error reporting
    $f3->set('DEBUG', 3);

    // Define a default route (home page)
    $f3->route('GET /', function()
    {
        // Display the view
        $view = new Template();
        echo $view->render('views/home.html');
    });

    // Define a route (personal information page)
    $f3->route('GET|POST /personal-information', function($f3)
    {
        global $validator;
        global $dataLayer;

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $firstName = trim($_POST['firstName']);
            $lastName = trim($_POST['lastName']);
            $_SESSION['species'] = trim($_POST['species']);
            $age = trim($_POST['age']);
            $_SESSION['gender'] = $_POST['gender'];
            $phone = trim($_POST['phone']);

            if ($validator->validName($firstName) && $validator->validName($lastName))
            {
                $_SESSION['name'] = $firstName . " " . $lastName;
            }
            else
            {
                if (!$validator->validName($firstName))
                {
                    $f3->set('errors["firstName"]', "*First name can't be empty and must contain only characters");
                }

                if (!$validator->validName($lastName))
                {
                    $f3->set('errors["lastName"]', "*Last name can't be empty and must contain only characters");
                }
            }

            if ($validator->validAge($age))
            {
                $_SESSION['age'] = $age;
            }
            else
            {
                $f3->set('errors["age"]', "*Age can't be empty and must be numeric between 18 and 118");
            }

            if ($validator->validPhone($phone))
            {
                $_SESSION['phone'] = $_POST['phone'];
            }
            else
            {
                $f3->set('errors["phone"]', "*Phone can't be empty and must be in the pattern: XXX-XXX-XXXX");
            }

            if (empty($f3->get('errors')))
            {
                $f3->reroute('/profile');
            }
        }

        // Display the view
        $view = new Template();
        echo $view->render('views/personal-information-form.html');
    });

    // Define a route (profile page)
    $f3->route('GET|POST /profile', function($f3)
    {
        global $validator;
        global $dataLayer;

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $email = trim($_POST['email']);
            $_SESSION['state'] = trim($_POST['state']);
            $_SESSION['seeking'] = $_POST['seeking'];
            $_SESSION['biography'] = $_POST['biography'];

            if ($validator->validEmail($email))
            {
                $_SESSION['email'] = $email;
            }
            else
            {
                $f3->set('errors["email"]', "*Email can't be empty and must be formatted correctly");
            }

            if (empty($f3->get('errors')))
            {
                $f3->reroute('/interests');
            }
        }

        // Display the view
        $view = new Template();
        echo $view->render('views/profile-form.html');
    });

    // Define a route (interests page)
    $f3->route('GET|POST /interests', function($f3)
    {
        global $validator;
        global $dataLayer;

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

            if (empty($f3->get('errors')))
            {
                $f3->reroute('/summary');
            }
        }

        $f3->set('indoorInterests', $dataLayer->getIndoorInterests());
        $f3->set('outdoorInterests', $dataLayer->getOutdoorInterests());

        // Display the view
        $view = new Template();
        echo $view->render('views/interests-form.html');
    });

    // Define a route (profile summary page)
    $f3->route('GET /summary', function()
    {
        // Display the view
        $view = new Template();
        echo $view->render('views/profile-summary.html');
    });

    $f3->run();