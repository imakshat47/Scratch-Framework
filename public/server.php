<?php

/*
* Welocme User to public/server.php
* This is the main handler file for all your application
* Here we'll set some necessary variables
*/

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

require_once "../env.php";
/* NOTE: UN-COMMENT BELOW LINE & COMMENT ABOVE LINE IF NOT USING VIRTUAL HOST */
// require_once "env.php";

/*
*---------------------------------------------------------------
* ERROR REPORTING
*---------------------------------------------------------------
*
* Different environments will require different levels of error reporting.
* By default development will show errors but testing and live will hide them.
*
*/

switch (ENVIRONMENT) {
    case 'development':
        define("_DIR_", ROOT_DIR);
        /* NOTE: UN-COMMENT BELOW LINE & COMMENT ABOVE LINE IF NOT USING VIRTUAL HOST */
        // define("_DIR_", ROOT_DIR . 'public/');
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        break;

    case 'testing':
        /* NOTE: UN-COMMENT BELOW LINE IF NOT USING VIRTUAL HOST */
        // define("_DIR_", ROOT_DIR. 'public/');
    case 'production':
        if (empty(_DIR_))
            define("_DIR_", ROOT_DIR);
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
        break;

    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}

/*
*---------------------------------------------------------------
* DEFINE APP VARIABLE: STARTING APP WITH BOOTSTRAP
*---------------------------------------------------------------
*/

require_once _DIR_ . '../system/Bootstrap.php';
new Bootstrap();
