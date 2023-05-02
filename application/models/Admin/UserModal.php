<?php

class UserModal extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }
    public function getUser()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->db->where('email', $email);
        $this->db->where('password', $password);

        $query = $this->db->get('users');
        // var_dump($query);
        $find_user = $query->num_rows($query);

        if ($find_user > 0) {
            // return id;
            $this->session->set_userdata('logged_in', TRUE);
            $this->session->set_flashdata('success','You are now logged in successfully');
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('warning','Your Email and password are incorrect');
            redirect('admin');
        }
    }

    

    public function getDatas()
    {
        $query = $this->db->get('quiz_played')->result_array();
        // var_dump($query);
        return $query;
    }
}



?>