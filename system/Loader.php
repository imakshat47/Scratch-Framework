<?php
class Loader
{
    function __construct()
    {
        $this->uri = new URI();
    }

    /*
    *   @param View name and View Arg
    */
    public function view($__view = null, $__arg = null)
    {
        $this->load = new Loader();

        if ($this->__is_file(VIEWS . $__view . ".php")) {
            if ($__arg)
                foreach ($__arg as $__keys => $__value)
                    $$__keys = $__value;

            require_once VIEWS . $__view . ".php";
        } else
            require_once VIEWS .  "errors.php";
    }

    /*
    * @paarm Model Name
    */
    public function model($__model)
    {
        if ($this->__is_file(MODELS . "$__model.php")) {
            global $config;
            foreach ($config['drivers'] as $__drivers)
                if ($this->__is_file(SYSTEM . "$__drivers.php"))
                    require_once SYSTEM . "$__drivers.php";
            require_once MODELS . "$__model.php";
            if ($this->__is_class($__model))
                return new $__model();
            else trigger_error("Class $__model not found!!", E_COMPILE_WARNING);
        } else
            require_once VIEWS .  "errors.php";
    }

    /*
    * CHECK IF FILE EXISTS
    */
    private function __is_file($__file)
    {
        if (file_exists($__file))
            return $__file;
        return false;
    }

    /*
    *   CHECKS IF CLASS EXISTS
    */
    private function __is_class($__class)
    {
        if (class_exists($__class))
            return $__class;
        return false;
    }
}
