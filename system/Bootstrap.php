<?php

// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// SCRATCH PHP FRAMEWORK
// --------------------------------------------------------------------

class Bootstrap
{

    /** BOOTSTRAP CONSTRUCTOR 
     * HANDLE URI
     * AUTOLOAD SYSTEM FILES
     * DEFINE METHODS
     * SETTING MVC FLOW CONTROL
     */
    function __construct()
    {
        try {
            /** INVOKING AUTOLOADER:
             * SYSTEM/AUTOLOAD.PHP 
             * LOADING ALL SYSTEM FILES
             */
            require_once(_DIR_ . '../system/autoload.php');

            /** INSTANTIATING AUTOLOADER:
             * LOADS SYSTEM FILES
             * GET INSTANCE
             */
            $this->__autoload = new Autoload();

            /** SESSION SET UP:
             * AUTO SAVE SESSION FIRST VARIABLES
             */
            $this->__autoload->__session->__bootstrap_session();

            /** URI FLOW CONTROL:
             * SANATIZE URI,
             * VALIDATE URI, 
             * INVOKES URI CONTROLLER WITH METHODS AND ARGUMENTS
             */
            $this->__autoload->__controller->__get_controller($this->__autoload->__uri->__is_valid_uri($this->__autoload->__url));
        } catch (PDOException $__err) {
            // Handels Exceptions
            __error($__err->getMessage());
        } catch (Exception $__err) {
            // Handles PDO Excepions
            __error($__err->getMessage());
        }
    }
}