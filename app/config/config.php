<?php

/*
|--------------------------------------------------------------------------
| APP CONFIG FILE
|--------------------------------------------------------------------------*
*/

global $config;

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your Scratch root app. Typically this will be your base URL,
| With a trailing slash:
|
|	http://app_name.com/
|
| If it is not set, then Scratch will try guess the protocol and path
| your installation, but due to security concerns the hostname will be set
| to $_SERVER['SERVER_ADDR'] if available, or localhost otherwise.
| The auto-detection mechanism exists only for convenience during
| development.
| NOTE: MUST NOT be used in production!
|
| If you need to allow multiple domains, remember that this file is still
| a PHP script and you can easily do that on your own.
|
 */
/*
    // --------------------------------------------------------------------
    // USER CONFIGURABLE SETTINGS.  EDIT BELOW THIS LINES FOR CHANGES
    // --------------------------------------------------------------------
*/

$config = [
    /**BASE URL FOR SYSTEM /APP */
    'BASE_URL' => '',



    /** SET App DEVELOPMENT ENVIRONMENT */
    'ENVIRONMENT' => 'development',



    /** DEFINE APP VARIABLES */
    'APP' => [
        // Name of Application
        'name' => 'Scratch',
        // Fallback url - Redirects to another url if any error
        'fallback_url' => '',
        // directory for different MVC components
        'directory' => [
            'controller' => '../app/controllers/',
            'model' => '../app/models/',
            'view' => '../app/views/',
        ],
        // default seeting of components
        'default' => [
            'controller' => 'Home',
            'method' => 'index',

            'baseController' => 'BaseController',
            'baseModel' => 'Base_Model',
        ],
        // 404 erro view
        'error' => '_404',
        // Loader intances
        'loader' => [
            'uri' => 'URI',
            'session' => 'Session',
            'load' => 'Load',
        ],
    ],



    /** SET DB VARIABLES
     * DATABASE DNS
     * DATABASE HOST
     * DATABASE USER
     * DATABASE NAME
     * DATABASE PASSWORD
     */
    'DB' => [
        'db_dns' => '',

        'db_host' => '',
        'db_user' => '',

        'db_name' => '',
        'db_pass' => ''
    ],



    /** DRIVERS
     * SESSION
     * DATABASE
     * EMAIL
     * PAGINATION
     */
    'DRIVERS' => [
        'session',
        'database',
    ],



    /** SET GET_TIME METHOD: 
     * TIMEZONE 
     * FORMAT     
    */
    'TIME' => [
        'time_zone' => 'Asia/Kolkata',
        'time_format' => 'Y-m-d H:i:s',
    ],



    /** FILE EXTENSIONS ALLOWED TO ADD 
     * 'css',
     * 'js',
     * 'png',
     * 'jpeg',
     * 'jpg'
     * */
    'FILE_EXTNS' => []
];

/*
|--------------------------------------------------------------------------
| Allowed URL Characters
|--------------------------------------------------------------------------
|
| This lets you specify which characters are permitted within your URLs.
| When someone tries to submit a URL with disallowed characters they will
| get a warning message.
|
| As a security measure you are STRONGLY encouraged to restrict URLs to
| as few characters as possible.  By default only these are allowed: a-z 0-9~%.:_-
|
| Leave blank to allow all characters -- but only if you are insane.
|
| The configured value is actually a regular expression character group
| and it will be executed as: ! preg_match('/^[<permitted_uri_chars>]+$/i
|
| DO NOT CHANGE THIS UNLESS YOU FULLY UNDERSTAND THE REPERCUSSIONS!!
|
*/
/**SYSTEM URI
 * PERMITTED URI CHARACTERS
 * PATTERNS REPLACE
 */
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';

$config['preg_replace'] = '/^\//';

/*
    // --------------------------------------------------------------------
    // END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
    // --------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Auto Base Site URL
|--------------------------------------------------------------------------
|
| URL to your Scratch root: Auto Base URL,
| 
 */
/** WEB URL HEADER */
$config['web_url'] =  empty($_SERVER['REQUEST_SCHEME']) ? "http" : $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];
/** DIR PATH */
$config['dir_path'] = str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
/*
|--------------------------------------------------------------------------
| Setting BASE URL
|--------------------------------------------------------------------------
| If BASE URL not set then Auto BASE URL will be used
| But, it's recomended to use BASE URL
 */
/** BASE URL SETTING */
$config['BASE_URL'] = str_replace("/public", "", empty($config['BASE_URL']) ? $config['web_url'] . $config['dir_path'] : $config['BASE_URL']);
/** ROOT PATH SETTING */
$config["ROOT_DIR"] =  $_SERVER['DOCUMENT_ROOT'] . $config['dir_path'];
/** STATIC ACCESS PATHS:
 * ASSET FOLDER
 * IMAGES FOLDER
 * UPLOAD FOLDER
 */
$config['HTTP_ASSET_PATH'] = $config['BASE_URL'] . 'assets/';
$config['HTTP_IMAGES'] = $config['BASE_URL'] . 'assets/images/';
$config['UPLOAD_FILE'] = $config['BASE_URL'] . 'assets/uploads/';

/** SETTING ALL VARABLES IN ../ENV.PHP FILE */
