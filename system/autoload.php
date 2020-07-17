<?php

class Autoload
{
    function __construct()
    {

        $__setup_files = [
            SYSTEM . "URI",

            CONFIG . "config",
            CONFIG . "path",

            SYSTEM . "Database",
            SYSTEM . "Session",

            SYSTEM . "Loader",

            SYSTEM . "Controller",
            CONTROLLERS . "BaseController"

        ];

        foreach ($__setup_files as $__file_laod)
            $this->__setup_load($__file_laod);
    }

    function __setup_load($__file = false)
    {
        $__file = "$__file.php";

        if (file_exists($__file))
            require_once $__file;
    }

    function __class_laod($__class_name = false, $__class_obj = false)
    {
        if (class_exists($__class_name)) {
            if ($__class_name)
                return $this->$__class_name =  new $__class_name();
            else
                return new $__class_name();
        }
    }
}
