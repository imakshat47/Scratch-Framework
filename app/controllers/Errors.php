<?php
class Errors extends Controller
{
    function error($err)
    {
        $data = [
            'title' => 'Error | Controller',
            'msg' => $err
        ];
        $this->load->view('essentials/errors', $data);
    }

    function _404($isError)
    {
        $this->load->view('essentials/_404');
    }
}
