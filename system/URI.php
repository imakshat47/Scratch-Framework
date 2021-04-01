<?php

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// SCRATCH PHP FRAMEWORK
// --------------------------------------------------------------------

class URI
{
    /*
    *   @param string url
    *   @return uri array or false
    */
    function __is_valid_uri($___uri = null)
    {
        if ($___uri) {
            global $config;
            $__uri =  filter_var(rtrim(preg_replace($config['preg_replace'], '', $___uri), '/'), FILTER_SANITIZE_URL);
            return  explode('/', $__uri);
        } else
            return [APP['default']['controller']];
    }

    /*
    *   INVOKE SERVER VARIABLES
    */
    function server($_key = null)
    {
        if ($_key) {
            if (empty($_SERVER[$_key]))
                return null;
            return $_SERVER[$_key];
        }
        return $_SERVER;
    }

    /*
    *   RETURNS POST VALUES FOR KEYS
    */
    function post($_key)
    {
        return isset($_POST[$_key]) ? $_POST[$_key] : null;
    }

    /*
    *   RETURNS POST VALUES FOR KEYS SANITIZED
    */
    function sanitize($_key, $_filter = FILTER_SANITIZE_STRING)
    {
        return htmlspecialchars(strip_tags(filter_var(trim($_key)), $_filter));
    }

    /*
    *   RETURNS URI SEGMENT WITH INT SEGMENT 
    */
    function segment($__segment)
    {
        if ($__segment > 0) {
            $__uri_segment = explode('/', preg_replace('/^\//', '', $_SERVER['REQUEST_URI']));
            if ($__uri__segment = $__uri_segment[--$__segment])
                return $__uri__segment;
        } else {
            trigger_error("URI segment '$__segment'", E_USER_WARNING);
        }
    }
}
