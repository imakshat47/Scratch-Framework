<?php

class Config
{
    function __construct()
    {

        if (file_exists($base_controller = CONTROLLERS . 'BaseController.php'))
            require $base_controller;
       

        function show_404($_name = null)
        {
            echo 'Page ' . Views . $_name . '.php not Found!!';
            exit(5); //PAge not found
        }
    }
}
