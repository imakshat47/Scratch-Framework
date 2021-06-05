<?php

ini_set("session.use_strict_mode", true);
ini_set("session.cookie_httponly", true);

/** SETTING ENVIRONMENT VARABLES:
 * APP BASE URL
 * ROOT DIRECTORY PATH
 * ASSETS DIRECTORY PATH
 * IMAGES DIRECTORY PATH
 * UPLAOD DIRECTORY PATH
 * APP DEVELOPMENT ENVIRONMENT 
 */

/**sETTING CONFIG AND ROUTE FILES:
 * APP/CONFIG/CONFIG.PHP
 * APP/CONFIG/ROUTE.PHP 
 */
foreach ([
    'config',
    'app',
    'route',
] as $__file)
    if (file_exists("../app/config/$__file.php"))
        require_once "../app/config/$__file.php";

/*
    // --------------------------------------------------------------------
    // USER CONFIGURABLE SETTINGS.  EDIT BELOW THIS LINES FOR CHANGES
    // --------------------------------------------------------------------
*/

/*
    // --------------------------------------------------------------------
    // SETTING ENV VARIABLES. OVERRIDES CONFIG FILE
    // --------------------------------------------------------------------
    // USER SETTING ENVIRONMENT VARIBALES
*/

$__env_var = [
    'BASE_URL' => '',
    'APP' => '',
    'DRIVERS' => '',
    'web_url' => '',
];

/*
*---------------------------------------------------------------
* APPLICATION ENVIRONMENT
*---------------------------------------------------------------
*
* You can load different configurations depending on your
* current "environment"
* Setting the environment also influences things like logging and error reporting.
*
* This can be set to anything, but default usage is:
*     development
*     testing
*     production
*
* NOTE: If you change these, also change the error_reporting() IN PUBLIC/SERVER.PHP
*/

$__constant_var = [
    // System Defined
    'ENVIRONMENT' => 'development',
    'ROOT_DIR' => '',
    'HTTP_ASSET_PATH' => '',
    'HTTP_IMAGES' => '',
    'UPLOAD_FILE' => '',
    'API' => $app['api'],
    // User Defined: Update in /public/server.php "Setting Constant"
    'URL' => $config['BASE_URL'],   
];

/*
    // --------------------------------------------------------------------
    // END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
    // --------------------------------------------------------------------
*/