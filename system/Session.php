<?php

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// SCRATCH PHP FRAMEWORK
// --------------------------------------------------------------------

class Session
{
    private $__flash_key = "__flash_data";

    /**SESSION CONSTRUCTS:
     * STARTS SESSION
     */
    function __construct()
    {
        /** STARTS SESSION IF SESSION NOT STARTED YET */
        if (!session_id())
            session_start();
    }

    /** CHECKS FOR A VALID SESSION KEY */
    private function __is_valid($__key)
    {
        if (isset($_SESSION[$__key]))
            return false;
        return true;
    }

    /** BOOTSTRAP SESSION:
     * UPDATE TEMP SESSION
     * SET LAST SESSION
     */
    public function __bootstrap_session()
    {
        $this->__update__temp_data();
    }

    /** SET SESSION */
    private function __set_session($__key, $__value)
    {
        $_SESSION[$__key] = $__value;
        session_write_close();
    }

    /** RETURNS SESSION BY KEY */
    private function __get_session($__key)
    {
        return isset($_SESSION[$__key]) ? $_SESSION[$__key] : [];
    }

    /** MARKS TEMP SESSION FOR FLASH DATA */
    private function mark_temp($__key)
    {
        if (!isset($_SESSION[$this->__flash_key]))
            $_SESSION[$this->__flash_key] = [];
        $_SESSION[$this->__flash_key][$__key] = "_new";
    }

    /** UPDATE SESSION:
     * TEMP DATA
     * FLASH DATA
     */
    protected function __update__temp_data()
    {
        if (!empty($_SESSION[$this->__flash_key])) {
            $__flashs = $_SESSION[$this->__flash_key];
            foreach ($__flashs as $__key => $__value)
                if ($__value === "new") {
                    $__flashs[$__key] = "old";
                } elseif ($__value === "old") {
                    if ($this->unset_session($__key))
                        unset($__flashs[$__key]);
                } else {
                    $__flashs[$__key] = "new";
                }
            $_SESSION[$this->__flash_key] = $__flashs;
            if (empty($_SESSION[$this->__flash_key]))
                unset($_SESSION[$this->__flash_key]);
        }
    }

    /** SET SESSION CALLED BY USER:
     * SESSION NAME
     * SESSION KEY AND VALUE PAIR
     */
    public function set_session($__sesssion__name, $__sesssion__data, $__hard = false)
    {
        if ($__hard)
            session_regenerate_id(true);
        if (is_array($__sesssion__data)) {
            foreach ($__sesssion__data as $__keys => $__values) {
                if ($this->__is_valid($__sesssion__name))
                    $$__sesssion__name[$__keys] = $__values;
                else {
                    __error("Session $__sesssion__name alreay set!!", true);
                }
            }
            $this->__set_session($__sesssion__name, $$__sesssion__name);
        } else
            $this->__set_session($__sesssion__name, $__sesssion__data);
    }

    /** USER SESSION RETURNS VALUES BY KEY */
    public function session($__key)
    {
        if ($__key)
            return $this->__get_session($__key);
        else
            __error("Session $__key missing!", E_USER_WARNING);
    }

    /** UNSET SESSION BY KEY */
    public function unset_session($__key, $__hard = false)
    {
        if ($__hard) {
            // remove all session variables
            session_unset();
            // destroy the session
            session_destroy();
        }
        if (!$this->__is_valid($__key)) {
            unset($_SESSION[$__key]);
            return true;
        }
        return false;
    }

    /** SET FLASHDATA */
    public function set_flashdata($__sesssion__name, $__sesssion__data)
    {
        $this->mark_temp($__sesssion__name);
        $this->set_session($__sesssion__name, $__sesssion__data);
    }

    /** RETURNS FALSHDATA */
    public function flashdata($__key)
    {
        if ($__key)
            return $this->__get_session($__key);
        else __error("Session $__key missing!", E_USER_WARNING);
    }
}
