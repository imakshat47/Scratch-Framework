<?php
class Session
{
    function __construct()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
    }

    private function __is_valid($__key)
    {
        if (isset($_SESSION[$__key]))
            return false;
        return true;
    }

    public function __bootstrap_session()
    {
        $this->__update__temp_data();
        $this->__set_session('_last_session', time());
    }

    private function __set_session($__key, $__value)
    {
        if ($_SESSION[$__key] = $__value)
            return true;
        return false;
    }

    private function __get_session($__key)
    {
        return isset($_SESSION[$__key]) ? $_SESSION[$__key] : [];
    }

    private function mark_temp($__key)
    {
        $_SESSION['__flash_session'][$__key] = "new";
    }


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

    public function session($__key)
    {
        if ($__key)
            return $this->__get_session($__key);
        else trigger_error("Session $__key missing!", E_USER_WARNING);
    }

    public function unset_session($__key)
    {
        if (!$this->__is_valid($__key))
            unset($_SESSION[$__key]);
        return true;
    }

    public function set_flashdata($__sesssion__name, $__sesssion__data)
    {
        $this->set_session($__sesssion__name, $__sesssion__data);
        $this->mark_temp($__sesssion__name);
    }

    public function flashdata($__key)
    {
        if ($__key)
            return $this->__get_session($__key);
        else trigger_error("Session $__key missing!", E_USER_WARNING);
    }

    /* temp_data to be added */
}
