<?php

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// SCRATCH PHP FRAMEWORK
// --------------------------------------------------------------------

class Session
{
    /**SESSION CONSTRUCTS:
     * STARTS SESSION
     */
    function __construct()
    {
        if (!isset($this))
            $this->startSession();
        return $this;
    }

    /** STARTS SESSION IF SESSION NOT STARTED YET */
    public function startSession()
    {
        if ($this->sessionState == self::SESSION_NOT_STARTED)
            $this->sessionState = session_start();
        return $this->sessionState;
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
        $this->__set_session('_last_session', time());
    }

    /** SET SESSION */
    private function __set_session($__key, $__value)
    {
        if ($_SESSION[$__key] = $__value)
            return true;
        return false;
    }

    /** RETURNS SESSION BY KEY */
    private function __get_session($__key)
    {
        return isset($_SESSION[$__key]) ? $_SESSION[$__key] : [];
    }

    /** MARKS TEMP SESSION FOR FLASH DATA */
    private function mark_temp($__key)
    {
        $_SESSION['__flash_session'][$__key] = "new";
    }

    /** UPDATE SESSION:
     * TEMP DATA
     * FLASH DATA
     */
    protected function __update__temp_data()
    {
        if (isset($_SESSION['__flash_session'])) {
            $__flashs = $_SESSION['__flash_session'];

            foreach ($__flashs as $__key => $__value)
                if ($__value == "new")
                    $__flashs[$__key] = "old";
                elseif ($__value == "old") {
                    unset($__flashs[$__key]);
                    $this->unset_session($__key);
                }


            $_SESSION['__flash_session'] = $__flashs;

            if (empty($_SESSION['__flash_session']))
                unset($_SESSION['__flash_session']);
        }
        return;
    }

    /** SET SESSION CALLED BY USER:
     * SESSION NAME
     * SESSION KEY AND VALUE PAIR
     */
    public function set_session($__sesssion__name, $__sesssion__data)
    {
        if (is_array($__sesssion__data)) {
            foreach ($__sesssion__data as $__keys => $__values) {
                if ($this->__is_valid($__sesssion__name))
                    $$__sesssion__name[$__keys] = $__values;
                else {
                    trigger_error("Session $__sesssion__name alreay set!!", E_USER_WARNING);
                    exit(5);
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
        else trigger_error("Session $__key missing!", E_USER_WARNING);
    }

    /** UNSET SESSION BY KEY */
    public function unset_session($__key)
    {
        if (!$this->__is_valid($__key))
            unset($_SESSION[$__key]);
        return true;
    }

    /** SET FLASHDATA */
    public function set_flashdata($__sesssion__name, $__sesssion__data)
    {
        $this->set_session($__sesssion__name, $__sesssion__data);
        $this->mark_temp($__sesssion__name);
    }

    /** RETURNS FALSHDATA */
    public function flashdata($__key)
    {
        if ($__key)
            return $this->__get_session($__key);
        else trigger_error("Session $__key missing!", E_USER_WARNING);
    }
}