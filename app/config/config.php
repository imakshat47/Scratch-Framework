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
| URL to your Scratch root. Typically this will be your base URL,
| WITH a trailing slash:
|
|	http://example.com/
|
| WARNING: You MUST set this value!
|
| If it is not set, then Scratch will try guess the protocol and path
| your installation, but due to security concerns the hostname will be set
| to $_SERVER['SERVER_ADDR'] if available, or localhost otherwise.
| The auto-detection mechanism exists only for convenience during
| development and MUST NOT be used in production!
|
| If you need to allow multiple domains, remember that this file is still
| a PHP script and you can easily do that on your own.
|
 */

$config = [

    'BASE_URL' => '',

    'DB' => [
        'db_dns' => '',
        'db_host' => '',
        'db_name' => '',
        'db_pass' => ''
    ],

    'DRIVERS' => [
        'Session',
        'database',
    ],

    'TIME' => [
        'time_zone' => '',
        'time_format' => '',
    ],
    'FILE_EXTNS' => [
        'css',
        'js',
        'png',
        'jpeg',
        'jpg'
    ]
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
| URL to your Scratch root. Typically this will be your auto base URL,
| 
 */


$config['web_url'] =  empty($_SERVER['REQUEST_SCHEME']) ? "http" : $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];

$config['dir_path'] = str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

/*
|--------------------------------------------------------------------------
| Setting BASE URL
|--------------------------------------------------------------------------
| If BASE URL not set then Auto BASE URL will be used
| But, it's recomended to use BASE URL
 */

$config['BASE_URL'] = str_replace("/public", "", empty($config['BASE_URL']) ? $config['web_url'] . $config['dir_path'] : $config['BASE_URL']);
$config["ROOT_DIR"] =  $_SERVER['DOCUMENT_ROOT'] . $config['dir_path'];

$config['HTTP_ASSET_PATH'] = $config['BASE_URL'] . 'assets/';
$config['HTTP_IMAGES'] = $config['BASE_URL'] . 'assets/images/';
$config['UPLOAD_FILE'] = $config['BASE_URL'] . 'assets/uploads/';
$config['DIR_IMAGE'] = $config["ROOT_DIR"] . 'assets/images/';