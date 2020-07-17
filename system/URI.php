<?php

class URI
{
    function __construct()
    {
    }

    /*
    *   @param string url
    *   @return uri array or false
    */
    function __is_valid_uri($uri = null)
    {
        if ($uri) {
            global $config;
            $_uri =  filter_var(rtrim(preg_replace($config['preg_replace'], '', $uri), '/'), FILTER_SANITIZE_URL);
            return  explode('/', $_uri);
        } else
            return false;
    }

    /*
    *   INVOKE SERVER VARIABLES
    */
    function server($_key)
    {
        if ($_server_key =  empty($_SERVER[$_key]) ? null : $_SERVER[$_key])
            return $_server_key;
    }

    /*
    * RETRUNS LAST INVOKED URI IN SYSTEM
    */
    function back_uri()
    {
        if ($this->server('HTTP_REFERER'))
            return $this->server('HTTP_REFERER');
    }

    /*
    *   RETURNS URI SEGMENT 
    */
    function segment($__segment)
    {
        if ($__segment) {
            $_uri_segment = explode('/', preg_replace('/^\//', '', $_SERVER['REQUEST_URI']));
            if ($__uri__segment = $_uri_segment[$__segment])
                return $__uri__segment;
        } else {
            trigger_error("URI segment '0'", E_USER_WARNING);
        }
    }
}
