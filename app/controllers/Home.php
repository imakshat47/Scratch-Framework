<?php
class Home extends BaseController
{
    function index()
    {
        $this->view('home', [
            'title' => 'Home'
        ]);
    }
}
