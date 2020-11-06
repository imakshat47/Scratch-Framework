<?php

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// SCRATCH PHP FRAMEWORK
// --------------------------------------------------------------------

class Autoload
{
    /** AUTOLOAD CONSTRUCTS */
    function __construct()
    {
        /** LOAD SYSTEM FILES:
         * DATABASE
         * SESSION
         * URI
         * LOADER (LOAD)
         * MODEL
         * CONTROLLER
         */
        $__system_files = [
            '__database' => 'Database',
            '__session' => 'Session',
            '__uri' => 'URI',
            '__load' => 'Load',
            '__model' => 'Model',
            '__controller' => 'Controller',
        ];
        foreach ($__system_files as $__system_obj => $__system_file)
            $this->__system_load($__system_file, $__system_obj);
    }

    /** SYSTEM FILE CHECK:
     * RUNS CHECK FOR SYSTEM FILES
     * AND INSTANTIATE SYSTEM FILES
     */
    function __system_load($__system_name = false, $__system_obj)
    {
        $__system_file = _DIR_ . "../system/$__system_name.php";
        if (file_exists($__system_file)) {
            require_once $__system_file;
            if (class_exists($__system_name)) {
                return $this->$__system_obj = new $__system_name($this);
            }
        }
        trigger_error("Misisng System File: {$__system_name}", E_USER_ERROR);
    }
}