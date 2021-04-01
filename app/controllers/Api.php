<?php

if (!empty(API)) {
    if (!empty(API['allowed_origin']))
        header("Access-Control-Allow-Origin: {API['allowed_origin']}");
    if (!empty(API['content_type']))
        header("Content-Type: {API['content_type']}; charset={API['charset']}");
    if (!empty(API['allowed_methods']))
        header("Access-Control-Allow-Methods: {API['allowed_methods']}");
    if (!empty(API['max_age']))
        header("Access-Control-Max-Age: {API['max_age']}");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
}

class API extends BaseController
{

    /**
     * Response Json Output
     */
    public $response = [
        'succ' => true,
        'msg' => "Request Hit Success!!"
    ];

    function __construct()
    {
        parent::__construct();

        /**
         * Validate Request  
         * @uses Allowed Routes Paths
         */
        $this->validate_request([
            null,
            base_url(),
        ]);
        $this->api = $this->load->model("Api_Model");
    }

    function v2($functionCall, $user_cipher = null)
    {
        $this->response['data'] = $functionCall;
    }

    /** 
     * validate_request : Validate Request for server handels REQEST METHODS
     * @version 0.1.0
     * @since 20-12-2020 02:29am
     * @param Array $_allowed_urls : allowed routes
     */
    private function validate_request($_allowed_urls)
    {
        if (in_array($this->uri->server("HTTP_REFERER"), $_allowed_urls)) {
            if (in_array($this->uri->server("REQUEST_METHOD"), explode(',', API['allow_methods'])))
                return true;
        }
        $this->response = [
            'succ' => false,
            'msg' => "Request: Not Entertained.",
            '_errs'  => "Server: {$this->uri->server("HTTP_REFERER")} Request Not Allowed.",
        ];
    }

    /**
     * __destruct(): Return Json
     * @return Json $response
     */
    function __destruct()
    {
        echo json_encode($this->response);
        exit(5);
    }
}
