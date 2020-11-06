<?php
class Home extends BaseController
{
    function index()
    {
        echo $data['title'] = "Welcome to Scratch | Home";
        $this->view('home', $data);

        /* -or- */

        // $this->load->view('partials/header', $data);
        // $this->load->view('home');
        // $this->load->view('partials/footer');
    }
}
