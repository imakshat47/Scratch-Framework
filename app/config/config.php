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

$config["base_url"] = "";

// Database Setup
$database = array(
    'dsn' => '',
    'host' => '',
    'database' => '',
    'user' => '',
    'password' => ''

);

$config["drivers"] = ['Database', 'Session'];

/*Libaraies*/



/*
|--------------------------------------------------------------------------
| DEFINING FEW PATHS
|--------------------------------------------------------------------------
 */
// define('ROOTDIR', $_SERVER['DOCUMENT_ROOT'] . $dirpath);
// define('HTTP_ASSET_PATH', $config['base_url'] . 'assets/');
// define('HTTP_IMAGES', $config['base_url'] . 'images/');
// define('DIR_IMAGE', $_SERVER['DOCUMENT_ROOT'] . $dirpath . 'uploads/');
// define('UPLOADFILE', $config['base_url'] . 'uploads/');

// Timezone Reference
$config["time_reference"] = "";

// Time Format
$config["time_format"] = "";


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
|--------------------------------------------------------------------------
| Auto Base Site URL
|--------------------------------------------------------------------------
|
| URL to your Scratch root. Typically this will be your auto base URL,
| 
 */
$weburl = empty($_SERVER['REQUEST_SCHEME']) ? "http" : $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];
$dirpath = str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$config['auto_base_url'] = $weburl . $dirpath;

/*
|--------------------------------------------------------------------------
| Setting BASE URL
|--------------------------------------------------------------------------
| If BASE URL not set then Auto BASE URL will be used
| But, it's recomended to use BASE URL
 */
$config["base_url"] = empty($config["base_url"]) ? $config["auto_base_url"] : $config["base_url"];


$config['db'] = $database;
