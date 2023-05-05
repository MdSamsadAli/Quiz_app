<?php
class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // $this->load->model('UserModal');
        // $this->check_auth();
    }
    function check_auth()
    {
        if(!$this->session->userdata('logged_in'))
        {
            $this->load->view('admin/login');
        }
    }
    public function index()
    {
        $this->load->view('admin/login');
    }

    public function login()
    {
        $this->usermodal->getUser();
    }
    public function dashboard()
    {
        $this->load->view('admin/dashboard');
    }

    public function getAll()
    {
        $data = $this->usermodal->getDatas();
        echo json_encode($data);
    }
    public function getPreview()
    {
        // $id = $this->input->post('id');
        $data = $this->usermodal->getPreviewData();
        echo json_encode($data);
        // var_dump($data);
    }

}
?>


