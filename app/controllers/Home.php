<?php
class Home extends BaseController
{
    function index()
    {
        $data['title'] = "Welcome to Scratch | Home";

        $this->bm->add_user();

        $this->load->view('partials/header', $data);
        $this->load->view('home');
        $this->load->view('partials/footer');
    }

    function users()
    {
        $data['title'] = "Users";

        $this->load->view('partials/header', $data);
        $this->load->view('home');
        $this->load->view('partials/footer');
    }
}
