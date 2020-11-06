<?php
class BaseController extends Controller
{
    /*
    *   BASE CONTROLLER TO LOAD ALL SERVICES AND DRIVERS AT ONE PLACE
    */
    function __construct()
    {
        parent::__construct();
    }

    /*
    *   BUILDIN VIEW METHOD
    *   TO LOAD VIEWS IN ONE COMMAND
    */
    function view($page, $data = null)
    {
        $this->__show_404($page);

        // SET METADATA
        $data['metadata'] = [
            'name' => 'Scratch PHP',
            'description' => 'A flexible and highly scalable php Framework, Scratch. Build beautiful websites and powerful Apps',
            'keywords' => 'Scratch, PHP Framework, Website Prameworks'
        ];

        // SET OG DATA
        $data['og_data'] = [
            'url' => 'http://www.scratch.com/',
            'site_name' => 'SCRATCH',
            'description' => 'A flexible and highly scalable php Framework, Scratch. Build beautiful websites and powerful Apps'
        ];

        /* IF NOT TITLE SET BY DEFAULT */
        $data['title'] = empty($data['title']) ? ucfirst($page) : $data['title'];

        /* Renders Partials and request page */
        $this->load->view('partials/header', $data);
        $this->load->view($page);
        $this->load->view('partials/footer');
    }

    /** CHECKS IF PAGE EXISTS
     * RETURN ERRO IF MISSING
     */
    public function __show_404($page)
    {
        if (!file_exists(_DIR_ . '../app/views/' . $page . '.php')) {
            $this->load->view('_404', [
                'title' => 'File Misisng',
                'msg' => "Missing View:  $page.php"
            ]);
            exit(5);
        } else  return;
    }
}