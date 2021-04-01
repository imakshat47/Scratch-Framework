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
    private $__view_path = _DIR_ . APP['directory']['view'];
    private $__model_path = _DIR_ . APP['directory']['model'];

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
        if (file_exists($this->__model_path  . APP['default']['baseModel'] . ".php"))
            require_once($this->__model_path . APP['default']['baseModel'] . ".php");
        if (!$this->__is_file($this->__model_path . "$__model.php"))
            __error("Misisng Model File: " . ucwords($__model));
        require_once $this->__model_path . "$__model.php";
        if (!$this->__is_class($__model))
            __error("Misisng Model Class: " . ucwords($__model));
        return new $__model();
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
     */
    private function __loader()
    {
        foreach (APP['view']['loader'] as $__set__var => $__set__key)
            if ($this->__set__($__set__var))
                $this->$__set__var = new $__set__key();
    }
}