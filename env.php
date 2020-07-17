<?php
/*
*   Here we set enviroment variables for our project
*/

// --------------------------------------------------------------------
// USER CONFIGURABLE SETTINGS.  EDIT BELOW THIS LINES FOR CHANGES
// --------------------------------------------------------------------

/*
* Set ENV variable below,
*/
$env_variables = [
    'base_url' => '',
    'environment' => '',
];

/*
* Set Routes Names bellow
* Can define your own path here too
*/

$env_routes = [
    'APP' => 'app/',                        // App files path

    'SYSTEM' => 'system/',                  //System files path

    'CONFIG' => 'app/config/',                //Config folder path
    'CONTROLLERS' => 'app/controllers/',     //controlelrs path
    'VIEWS' => 'app/views/',                //views path
    'MODELS' => 'app/models/',              //Model Folder Path

    'IMAGES' => 'assets/images/',             // Path to iamges folder
    'CSS' => 'assets/css/',                  // Path to CSS folder
    'JS' => 'assets/js/',                   // Path to js folder
];

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

foreach ($env_variables as $key => $value) {
    $_ENV[$key] = $value;
}

foreach ($env_routes as $key => $value)
    define("$key", "$value");
