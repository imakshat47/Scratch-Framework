<?php
class Bootstrap
{

    function __construct()
    {
        /* URL GET METHOD */
        $__url = isset($_GET['url']) ? $_GET['url'] : null;

        /* INVOKING AUTOLOADER */
        require_once "autoload.php";

        /* INSTANTIATING AUTOLOADER */
        $this->__autoload = new Autoload();

        $__setup_class = [
            '__uri' => "URI",
            '__controller' => "Controller",
            '__session' => "SESSION"
        ];

        /* INSTANTIATING SETUP CLASSES */
        foreach ($__setup_class as $__class_obj => $__class_load) {
            $this->$__class_obj =  $this->__autoload->__class_laod($__class_load);
        }

        $this->__session->__bootstrap_session();

        /* BASE URL METHOD */
        if (!function_exists('base_url')) {
            function base_url($_base_segment = false)
            {
                global $config;

                return (empty($config['base_url']) ? 'http://localhost/' . $_base_segment : $config['base_url']) . $_base_segment;
            }
        }

        global $route;

        /* SANATIZE,VALIDATE, INVOKES URL CONTROLLERS AND METHODS */
        $this->__controller->__get_controller(empty($this->__uri->__is_valid_uri($__url)) ? [$route["base_controller"]] : $this->__uri->__is_valid_uri($__url));
    }
}
