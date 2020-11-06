<?php

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

class Bootstrap
{

    function __construct()
    {
        /* URL GET METHOD */
        $__url = isset($_GET['url']) ? $_GET['url'] : null;

        global $config;
        foreach ($config['FILE_EXTNS'] as $__key)
            if (strpos($__url, $__key) != false) {                
                include_once _DIR_ . $__url;
                return;
            }

        /* INVOKING AUTOLOADER */
        require_once(_DIR_ . '../system/autoload.php');

        /* INSTANTIATING AUTOLOADER */
        $this->__autoload = new Autoload();

        /* SESSION SET UP */
        $this->__autoload->__session->__bootstrap_session();

        /* BASE URL METHOD */
        if (!function_exists('base_url')) {
            function base_url($_base_segment = false)
            {
                global $config;
                return (empty($config['base_url']) ? BASE_URL . $_base_segment : $config['base_url']) . $_base_segment;
            }
        }

        /* REDIRECT METHOD */
        if (!function_exists('redirect')) {
            function redirect($_base_segment = null, $_time_eclipse = false)
            {
                if ($_time_eclipse)
                    header("refresh:$_time_eclipse;url=" . base_url($_base_segment));
                header("Location:" . base_url($_base_segment));
            }
        }

        /* GET_DATE METHOD */
        if (!function_exists('get_date')) {
            function get_date($__date_format = false)
            {
                global $config;
                date_default_timezone_set(empty($config['TIME']['time_zone']) ? 'America/Los_Angeles' : $config['TIME']['time_zone']);
                return date(empty($__date_format) ? (empty($config['TIME']['time_format']) ? "Y-m-d H:i:s" : $config['TIME']['time_format']) : $__date_format);
            }
        }

        /* ERROR REPORTING METHOD */
        if (!function_exists('__error')) {
            function __error($__error = "Page Not Found !!")
            {
                if (ENVIRONMENT == 'development')
                    trigger_error($__error, E_USER_ERROR);
                global $route;
                $__load = new Load();
                $__load->view($route['_404'], ['msg' => $__error, 'title' => $__error]);
                exit(1);
            }
        }

        /* SANATIZE,VALIDATE, INVOKES URL CONTROLLERS AND METHODS */
        global $route;
        $this->__autoload->__controller->__get_controller(empty($this->__autoload->__uri->__is_valid_uri($__url)) ? [$route["base_controller"]] :  $this->__autoload->__uri->__is_valid_uri($__url));
    }
}
