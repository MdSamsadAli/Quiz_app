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
        $find_user = $query->num_rows($query);

        if ($find_user > 0) {
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
        return $query;
    }

    public function getPreviewData()
    {

        $id = $this->input->post('id');

        $this->db->select('admin_preview.*, quiz_questions.questions, quiz_played.id as quiz_played_id, quiz_played.username');
        $this->db->from('admin_preview');
        $this->db->join('quiz_questions', 'admin_preview.question_id = quiz_questions.id');
        $this->db->join('quiz_played', 'admin_preview.quiz_played_id = quiz_played.id');
        $this->db->where('quiz_played.id', $id);

        $query = $this->db->get();

        return $query->result_array();

    }
}

?>
