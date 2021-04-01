<?php

/** 
 * Welocme User to PUBLIC/SERVER.PHP
 * THIS IS THE MAIN HANDLER FILE SETTING VARIABLE FOR APPLICATION
 * SOME NECESSARY VARIABLES:
 */
require_once "../env.php";

/*
*---------------------------------------------------------------
* ERROR REPORTING
*---------------------------------------------------------------
*
* Different environments will require different levels of error reporting.
* By default development will show errors but testing and production will hide them.
*
* Also, setting DIR for use. 
*
*/

switch (ENVIRONMENT) {
    case 'development':
        define("_DIR_", ROOT_DIR);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        break;

    case 'testing':
    case 'production':
        define("_DIR_", ROOT_DIR);
        ini_set('display_errors', 0);
        error_reporting(0);
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
    // --------------------------------------------------------------------
    // END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
    // --------------------------------------------------------------------
*/

/** DEFINE APPLICATION VARIABLE: 
 * STARTING APPLICATION WITH BOOTSTRAP
 */
require_once _DIR_ . '../system/Bootstrap.php';
new Bootstrap();
