<?php
class Load
{
    private $__view_path = _DIR_ . '../app/views/';
    private $__model_path = _DIR_ . '../app/models/';

    function __construct()
    {
    }

    private function __set__($__var__)
    {
        if (isset($this->$__var__))
            return false;
        return true;
    }

    /*
    *   @param View name and View Arg
    */
    public function view($__view = null, $__arg = null)
    {
        // $this->load = new Load();
        if ($this->__is_file($this->__view_path . $__view . ".php")) {
            if (is_array($__arg))
                foreach ($__arg as $__keys => $__value)
                    $$__keys = $__value;
            require $this->__view_path . $__view . ".php";
        } else
            __error("Misisng View: " . ucwords($__view));
    }

    /*
    * @paarm Model Name
    */
    public function model($__model)
    {
        if ($this->__is_file($this->__model_path . "$__model.php")) {
            require_once $this->__model_path . "$__model.php";
            if ($this->__is_class($__model))
                return new $__model();
            else {
                $this->view('essentials/errors', [
                    'title' => 'Error | Model',
                    'msg' => "Model Class $__model not found. "
                ]);
                exit(5);
            }
        } else
            __error("Misisng Model: " . ucwords($__view));
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
