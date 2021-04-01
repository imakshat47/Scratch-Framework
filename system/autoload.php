<?php

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// SCRATCH PHP FRAMEWORK
// --------------------------------------------------------------------

class Autoload
{
    /* URL hit is stored */
    public $__url = '';

    /** AUTOLOAD CONSTRUCTS */
    function __construct()
    {
        /** URL GET METHOD:
         * URI FROM HEADER
         *  NULL FOR BASE URL
         */
        $this->__url = isset($_GET['url']) ? $_GET['url'] : null;

        /** FILE EXTENSIONS ALLOWED */
        global $config;
        foreach ($config['FILE_EXTNS'] as $__key)
            if (strpos($this->__url, $__key) != false) {
                include_once _DIR_ . $this->__url;
                return;
            }

        /** LOAD SYSTEM FILES:
         * DATABASE
         * SESSION
         * URI
         * LOADER (LOAD)
         * MODEL
         * CONTROLLER
         */
        $__system_files = [
            '__database' => 'Database',
            '__session' => 'Session',
            '__uri' => 'URI',
            '__load' => 'Load',
            '__model' => 'Model',
            '__controller' => 'Controller',
        ];
        foreach ($__system_files as $__system_obj => $__system_file)
            $this->__system_load($__system_file, $__system_obj);

        /* Default Methods */
        /* BASE URL METHOD */
        if (!function_exists('base_url')) {
            function base_url($_base_segment = false)
            {
                global $config;
                return (empty($config['base_url']) ? BASE_URL : $config['base_url']) . $_base_segment;
            }
        }

        /* REDIRECT METHOD */
        if (!function_exists('redirect')) {
            function redirect($_base_segment = null, $_time_eclipse = false)
            {
                if (!(strpos($_base_segment, base_url()) !== false))
                    $_base_segment = base_url($_base_segment);

                if ($_time_eclipse)
                    header("refresh:$_time_eclipse;url=$_base_segment");

                header("Location: $_base_segment");
            }
        }

        /* BACK METHOD */
        if (!function_exists('back')) {
            function back($__segment = false, $_time_eclipse = false)
            {
                redirect($__segment ? $__segment : $_SERVER["HTTP_REFERER"], $_time_eclipse);
            }
        }

        /* GET_DATE METHOD */
        if (!function_exists('get_date')) {
            function get_date($__date_format = null, $__format = null)
            {
                global $config;
                date_default_timezone_set(empty($config['TIME']['time_zone']) ? 'America/Los_Angeles' : $config['TIME']['time_zone']);
                if ($__format)
                    return date(($__date_format == null) ? (empty($config['TIME']['time_format']) ? "Y-m-d H:i:s" : $config['TIME']['time_format']) : $__date_format, $__format);
                return date(($__date_format == null) ? (empty($config['TIME']['time_format']) ? "Y-m-d H:i:s" : $config['TIME']['time_format']) : $__date_format);
            }
        }

        /* ERROR REPORTING METHOD */
        if (!function_exists('__error')) {
            function __error($__error = "Page Not Found !!")
            {
                if (ENVIRONMENT == 'development')
                    trigger_error($__error, E_USER_ERROR);
                $__load = new Load();
                $__load->view(APP['view']['error'], ['msg' => $__error, 'title' => $__error]);
                exit(1);
            }
        }

        /* Dump all on screen */
        if (!function_exists('dd')) {
            function dd($_key = "Scratch here!!", $_exit = true)
            {
                print "<pre>";
                if (is_array($_key))
                    print_r((array)$_key);
                else
                    print_r($_key);
                print "</pre>";
                if ($_exit)
                    exit(5);
            }
        }
    }

    /** SYSTEM FILE CHECK:
     * RUNS CHECK FOR SYSTEM FILES
     * AND INSTANTIATE SYSTEM FILES
     */
    function __system_load($__system_name = false, $__system_obj = false)
    {
        $__system_file = _DIR_ . "../system/$__system_name.php";
        if (file_exists($__system_file)) {
            require_once $__system_file;
            if (class_exists($__system_name)) {
                if ($__system_obj)
                    return $this->$__system_obj = new $__system_name($this);
                return new $__system_name($this);
            }
        }
        trigger_error("Misisng System File: {$__system_name}", E_USER_ERROR);
    }
}
