<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        // $this->check_auth();

    }

    public function check_auth() 
    {
        if(!$this->session->userdata('logged_in'))
        {
            $this->load->view('user/login');
        }
    }
    public function login()
    {
        $this->load->view('user/login');
    }
    function index()
    {
        
        $username = $this->input->post('username');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');

        if($this->form_validation->run() == FALSE){
            $this->load->view('user/login');
        }
        else {
            $this->session->userdata('logged_in', TRUE);
            $data['username'] = $username;
            $this->session->set_userdata('username', $username);
            $this->load->view('user/index', $data);
        }
    }
    public function getAll()
    {
        $data = $this->question->get_all_data();
        $id = $this->input->post('id');
        $question = $data[0]->questions;
        $answer;
        foreach ($data as $i){
            $option[] = $i->options;
            if($i->correct == "1"){
                $answer = $i->options;
            }
        }
        $response = array(
            // 'id' => $id,
            'question' => $question,
            'option' => $option,
            'answer' => $answer
        );
        // var_dump($response);
        echo json_encode($response);
    }
    public function save() {
        // Get the data from the Ajax request
        $username = $this->input->post('username');
        $total_quiz = $this->input->post('total_quiz');
        $attempted_questions = $this->input->post('attempted_questions');
        $correct_questions = $this->input->post('correct_questions');
        // $timer_array = $this->input->post('timer_array');
        $timer_array = date("s");
        
        // Insert the data into the database
        $data = array(
            'username' => $username,
            'total_questions' => $total_quiz,
            'attempted_questions' => $attempted_questions,
            'correct_questions' => $correct_questions,
            'time_taken' => $timer_array,
            'started' => date("Y-m-d H:i:s"),
        );
        // $html = $this->input->post('test');
        if($this->question->store($data))
        {
            echo json_encode(array("status" => "success"));
        }
        else{
            echo json_encode(array("status" => "Error"));
        }
    }
    public function preview()
    {
        $this->check_auth();
        // $this->session->userdata('logged_in', TRUE);
        $this->load->view("user/view");
    }
}


?>