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
    require $_SERVER['DOCUMENT_ROOT'].'/../config.php';

    // Start a session
    session_start();

    // Instantiate Fat-Free
    $f3 = Base::instance();

    // Add classes
    $controller = new Controller($f3);
    $validator = new Validate();
    $dataLayer = new DataLayer();

    // Turn on Fat-Free error reporting
    $f3->set('DEBUG', 3);

    // Define a default route (home page)
    $f3->route('GET /', function()
    {
        global $controller;
        $controller->home();
    });

    // Define a route (personal information page)
    $f3->route('GET|POST /personal-information', function()
    {
        global $controller;
        $controller->personalInformation();
    });

    // Define a route (profile page)
    $f3->route('GET|POST /profile', function()
    {
        global $controller;
        $controller->profile();
    });

    // Define a route (interests page)
    $f3->route('GET|POST /interests', function()
    {
        global $controller;
        $controller->interests();
    });

    // Define a route (profile summary page)
    $f3->route('GET /summary', function()
    {

    });

    $f3->run();