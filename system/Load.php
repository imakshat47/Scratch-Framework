<?php

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// SCRATCH PHP FRAMEWORK
// --------------------------------------------------------------------

class Load
{
    /** PRIVATE PATH SETTING:
     * VIEWS DIRECTORY
     * MODELS DIRECTORY
     */
    private $__view_path = _DIR_ . '../app/views/';
    private $__model_path = _DIR_ . '../app/models/';

    /** CHECKS IF VARIABLE SET, RETURNS:
     * FALSE IF SET
     * TRUE IF NOT SET
     */
    private function __set__($__var__)
    {
        if (isset($this->$__var__))
            return false;
        return true;
    }

    /*
    *   @param VIEW NAME AND ARRAY ARGUMENTS
    */
    public function view($__view = null, $__arg = null)
    {
        $this->__loader();
        if ($this->__is_file($this->__view_path . $__view . ".php")) {
            if (is_array($__arg))
                foreach ($__arg as $__keys => $__value)
                    $$__keys = $__value;
            require $this->__view_path . $__view . ".php";
        } else
            __error("Misisng View: " . ucwords($__view));
    }

    /*
    * @paarm MODEL NAME
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

    /** CHECKS IF FILE EXISTS, RETURNS:
     * TRUE IF EXISTS
     * FALSE IF NOT EXISTS    
     */
    private function __is_file($__file)
    {
        if (file_exists($__file))
            return true;
        return false;
    }

    /**   CHECKS IF CLASS EXISTS, RETURNS:
     * TRUE IF EXISTS
     * FALSE IF NOT EXISTS    
     */
    private function __is_class($__class)
    {
        if (class_exists($__class))
            return true;
        return false;
    }

    /**   CHECKS IF OBJECTS, RETURNS:
     *      LOADS OBJECT FOR VARABLES 
     *
     */
    private function __loader()
    {
        foreach ([
            'uri' => 'URI',
            'session' => 'Session',
            'load' => 'Load',
        ] as $__set__var => $__set__key)
            if ($this->__set__($__set__var))
                $this->$__set__var = new $__set__key();
    }
}
