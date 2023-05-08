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
            redirect('login');
        }
    }
    public function index()
    {
        session_destroy();
        $this->load->view('admin/login');
    }

    public function login()
    {
        $this->usermodal->getUser();
        $this->load->view('admin/login');
    }
    public function dashboard()
    {
        $this->check_auth();
        $this->load->view('admin/dashboard');
    }

    public function getAll()
    {
        $data = $this->usermodal->getDatas();
        echo json_encode($data);
    }
    public function getPreview()
    {
        $id = $this->input->post('id');
        // var_dump($id);
        if($id != null){

            $data = $this->usermodal->getPreviewData($id);

            // var_dump($data);

            $questions = array_column($data, 'questions');
            $correct_answer = array_column($data, 'correct_answer');
            $selected_answer = array_column($data, 'selected_answer');
            $timer = array_column($data, 'timer');
            $username = $data[0]['username'];
            $quiz_played_id = $data[0]['quiz_played_id'];

            $response = array(
                'quiz_played_id' => $quiz_played_id,
                'username' => $username,
                'questions' => $questions,
                'correct_answer' => $correct_answer,
                'selected_answer' => $selected_answer,
                'timer' => $timer,
            );
            echo json_encode($response);
        }
       else {
        $str = "what happened to id";
        var_dump($str);
        }
    }
    public function logout()
    {
        redirect('/admin');
    }

}
?>


