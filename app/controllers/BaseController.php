<?php

class BaseController extends Controller
{
    /**
     * Base Controller: Middle layer
     * @version 0.1.3
     * @since 07-03-2021 06:00pm
     */
    function __construct()
    {
        parent::__construct();
    }


    /*
    *   BUILDIN VIEW METHOD
    *   TO LOAD VIEWS IN ONE COMMAND
    */
    protected function view($page, $data = null)
    {
        $this->__show_404($page);

        // SETTING APP VARS
        global $config;
        if (!empty($config['app_var']))
            foreach ($config['app_var'] as $_key => $_val)
                $data[$_key] = isset($data[$_key]) ?  array_merge($data[$_key], $_val) : $_val;

        /* IF NOT TITLE SET BY DEFAULT */
        $data['title'] = empty($data['title']) ? APP . " | " . ucfirst($page) : $data['title'];

        if (isset($this->session->session('user')['token']))
            foreach (['_username', '_user_profile_pic'] as $_row)
                $data[$_row] = $this->$_row;

        /* Renders Partials and request page */
        $this->load->view('partials/header', $data);
        $this->load->view($page, $data);
        $this->load->view('partials/footer', $data);
    }

    /** CHECKS IF PAGE EXISTS
     * RETURN ERRO IF MISSING
     */
    private function __show_404($page)
    {
        if (!file_exists(_DIR_ . '../app/views/' . $page . '.php')) {
            $this->load->view('_404', [
                "title" => "File Misisng",
                "msg" => "Missing View:  $page.php"
            ]);
            exit(5);
        } else  return;
    }
}
