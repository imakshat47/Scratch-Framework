<?php
class Controller
{
    private $__controller_name = null;
    private $__method_name = null;
    private $__method_arg = null;
    private $__controller_path = CONTROLLERS;

    function __construct()
    {
        $this->load = new Loader();
        $this->uri = new URI();
    }

    /*
    *   @param Array of URI
    *   @return Calls Controller, Method and Arg
    */
    function __get_controller($__uri_array = null)
    {
        global $route;

        foreach ($__uri_array as $__uri_element) {
            if (!$this->__controller_name)
                if (file_exists($this->__controller_path . "$__uri_element.php")) {
                    $this->__controller_name = $__uri_element;
                    require_once $this->__controller_path . "$this->__controller_name.php";
                } elseif (is_dir($this->__controller_path . $__uri_element)) {
                    $this->__controller_path .= "/$__uri_element/";
                } else $this->error_controller();
            elseif (!$this->__method_name) {
                if (method_exists($this->__controller_name, $__uri_element))
                    $this->__method_name = $__uri_element;
                else $this->error_controller();
            } elseif ($__uri_element) {
                if ($this->__method_arg)
                    $this->__method_arg .= ", $__uri_element";
                else $this->__method_arg = "$__uri_element";
            } else $this->error_controller();
        }

        if (!$this->__controller_name)
            $this->error_controller();

        if (!$this->__method_name)
            $this->__method_name = "index";

        if (class_exists($this->__controller_name)) {
            $__controller_obj =   new $this->__controller_name;
            call_user_func_array(array($__controller_obj, "$this->__method_name"), explode(', ', $this->__method_arg));
        } else {
            trigger_error("Class $this->__controller_name not Found.");
            exit;
        }
    }


    /*
    *   Method for issues
    */
    function error_controller($__error = "Page Not Found !!")
    {
        global $route;

        $this->__controller_name = $route['404_notfound'];
        require_once $this->__controller_path . "$this->__controller_name.php";
        $this->__method_name = "_isError";
        $this->__method_arg = $__error;
    }
}
