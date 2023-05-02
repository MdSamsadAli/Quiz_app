<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuestionModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getData()
    {
        $id = $this->input->post('id');
        $query = $this->db->get("quiz_questions", $id)->result_array();
        return $query;
    }

    // public function getanswersbyquestion($questionId)
    // {
    //     $this->db->where('question_id', $questionId);
    //     $query = $this->db->get("quiz_options")->result_array();
    //     return $query;
    // }
    // public function getcorrectanswer($questionId)
    // {
    //     $this->db->where('question_id', $questionId);
    //     $this->db->where('correct', 1);
    //     $query = $this->db->get("quiz_options")->row()->id;
    //     return $query;
    // }

    public function get_all_data()
    {
        $id = $this->input->post('id');
        // $id = 1;
        $this->db->select('t1.questions, t2.*');
        $this->db->from('quiz_questions t1');
        $this->db->join('quiz_options t2', 't1.id = t2.question_id', 'inner');
        $this->db->where('t1.id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function store($data)
    {
        $query = $this->db->insert('quiz_played', $data);
        return $query;
    }
    

}