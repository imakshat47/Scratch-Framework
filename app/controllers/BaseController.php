<?php

define('Views', "App/views");

define('Images', "assets/images/");
define('Css', "assets/css/");
define('Js', "assets/js/");

class BaseController extends Controller
{
    /*
    *   BASE CONTROLLER TO LOAD ALL SERVICES AND DRIVERS AT ONE PLACE
    */
    function __construct()
    {
        parent::__construct();

        $this->bm =  $this->load->model('Base_Model');

        $this->session = new Session();
    }

    /*
    *   BUILDIN VIEW METHOD
    *   TO LOAD VIEWS IN ONE COMMAND
    */
    function view($page = 'home', $data = null)
    {
        if (!file_exists(Views . "$page.php")) {
            // Whoops, we don't have a page for that!
            show_404($page);
        }

        $data['metadata'] = [
            'name' => 'Scratch PHP',
            'description' => 'A flexible and highly scalable php Framework, Scratch. Build beautiful websites and powerful Apps',
            'keywords' => 'Scratch, PHP Framework, Website Prameworks'
        ];

        $data['og_data'] = [
            'url' => '',
            'site_name' => '',
            'description' => ''
        ];

        /* IF NOT TITLE SET BY DEFAULT */
        $data['title'] = empty($data['title']) ? ucfirst($page) : $data['title'];

        $this->load->view('partials/header', $data);
        $this->load->view($page, $data);
        $this->load->view('partials/footer');
    }
}
