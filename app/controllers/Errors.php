<?php
class Errors extends Controller
{
    // function __construct()
    // {
    // }

    function index()
    {
        echo "Hell";
    }

    function _isError($_isError)
    {
        echo $_isError;
        // $this->load->view('errors', [
        //     'msg' => $_isError,
        //     'title' => 'Error'
        // ]);
    }
}
