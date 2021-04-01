<?php

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// SCRATCH PHP FRAMEWORK
// --------------------------------------------------------------------

class Controller
{
    private $__controller_name = null;
    private $__method_name = null;
    private $__method_arg = null;
    private $__controller_path = _DIR_ . APP['directory']['controller'];

    function __construct()
    {
        global $config;
        /* DRIVER LOADER */
        array_push(
            $config['DRIVERS'],
            'Load',
            'Model',
            'URI'
        );
        /* INITIALIZE DRIVER OBJECT */
        foreach ($config['DRIVERS'] as $__driver) {
            $__load_obj = strtolower($__driver);
            $this->$__load_obj =  new $__driver();
        }
    }

    /**
     *   @param Array of URI
     *   @return JSON 
     */
    function __get_controller($__uri_array = null)
    {
        if (file_exists($this->__controller_path . APP['default']['baseController'] . ".php"))
            require_once($this->__controller_path . APP['default']['baseController'] . ".php");

        foreach ($__uri_array as $__uri_element) {
            if (!$this->__controller_name)
                if (file_exists($this->__controller_path .  ucwords($__uri_element) . ".php")) {
                    $this->__controller_name = $__uri_element;
                    require_once $this->__controller_path .  ucwords($this->__controller_name) . ".php";
                } elseif (is_dir($this->__controller_path . $__uri_element)) {
                    $this->__controller_path .= "/$__uri_element/";
                } else __error("Missing Controller: " . ucwords($__uri_element));
            elseif (!$this->__method_name) {
                if (method_exists($this->__controller_name, $__uri_element))
                    $this->__method_name = $__uri_element;
                else __error("Misisng Method: " . ucwords($__uri_element) . " in Controller  " . ucwords($this->__controller_name));
            } elseif ($__uri_element) {
                if ($this->__method_arg)
                    $this->__method_arg .= ", $__uri_element";
                else $this->__method_arg = "$__uri_element";
            } else __error("Something went wrong. URI ERROR!!");
        }

        if (!$this->__controller_name)
            __error("Missing Controller");

        if (!$this->__method_name)
            $this->__method_name = APP['default']['method'];

        if (!class_exists($this->__controller_name))
            __error("Missing Controller Class: " . ucwords($this->__controller_name));

        $__controller_obj =   new $this->__controller_name;
        call_user_func_array(array($__controller_obj, $this->__method_name), explode(', ', $this->__method_arg));
    }
}