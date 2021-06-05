<?php

/*
|--------------------------------------------------------------------------
| APP VARIABLE FILE
|--------------------------------------------------------------------------*
*/

/*
    // --------------------------------------------------------------------
    // USER CONFIGURABLE SETTINGS.  EDIT BELOW THIS LINES FOR CHANGES
    // --------------------------------------------------------------------
*/

$app = [
    /** APP Varaibles for Setup for Views */
    'app' => [
        'theme_color' => '#4caf50',

        'lang' => 'en',
        'charset' => 'utf-8',
        'viewport' => 'width=device-width, initial-scale=1',

        'seo_robots' => 'index, follow',

        'metadata' => [
            "title" => "Scratch",
            "type" => "website",
            "url" => "",
            "name" => "Scratch Website",
            "description" => "Scratch: MVC Farmework",
            "keywords" => "scratch,mvc framework",
        ],

        'css' => [
            
        ],

        'js' => [
            
        ],
    ],

    /** DEFINE API VARIABLES */
    'api' => [
        'allow_methods' => implode(',', [
            'GET',
            'POST',
            'PUT',
        ]),
        'max_age' => '3600',
        'allowed_origin' => implode(',', [
            '*',
        ]),
        'content_type' =>
        implode(',', [
            'application/json',
        ]),
        'charset' => 'UTF-8',
    ],
];
