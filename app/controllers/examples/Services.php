<?php
class Services extends BaseController
{
    function index()
    {
        echo $data['title'] = "Examples | Services";

        $this->session = new Session();

        $this->session->session('user', ['name' => 'Akshat']);

        // print_r($_SESSION);
    }
}
