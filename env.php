<?php
/*
*   Here we set enviroment variables for our project
*/

foreach ([
    'config',
    'route',
] as $__file)
    if (file_exists("../app/config/$__file.php"))
        require_once "../app/config/$__file.php";
/* NOTE: UN-COMMENT BELOW LINES & COMMENT ABOVE LINES IF NOT USING VIRTUAL HOST */
// if (file_exists("app/config/$__file.php"))
//     require_once "app/config/$__file.php";

// --------------------------------------------------------------------
// USER CONFIGURABLE SETTINGS.  EDIT BELOW THIS LINES FOR CHANGES
// --------------------------------------------------------------------

/*
// --------------------------------------------------------------------
// SETTING ENV VARIABLES. OVERRIDES CONFIG FILE
// --------------------------------------------------------------------
*/

$__env_var = [
    'BASE_URL' => '',
    'ROOT_DIR' => '',
    'HTTP_ASSET_PATH' => '',
    'HTTP_IMAGES' => '',
    'UPLOAD_FILE' => '',
    'DIR_IMAGE' => '',
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
*
*     development
*     testing
*     production
*
* NOTE: If you change these, also change the error_reporting() code below
*/

$__env_var['ENVIRONMENT'] = 'development';

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

foreach ($__env_var as $__key => $__value)
    define($__key, empty($__value) ? $config[$__key] : $__value);
