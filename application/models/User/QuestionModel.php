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


    public function get_all_data()
    {
        $id = $this->input->post('id');
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
        if($query)
        {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }
    public function save($id){
        $questions_id = $this->input->post('questions');
        $answers = $this->input->post('answers_selected');
        $correct = $this->input->post('correct_answer');
        $time = $this->input->post('timer_array');

        $data = array();
        foreach ($questions_id as $index => $question_id) {
            $data[] = array(
                // 'id' => $id,
                'quiz_played_id' => $id,
                'question_id' => $questions_id[$index],
                'selected_answer' => $answers[$index],
                'correct_answer' => $correct[$index],
                'timer' => $time[$index]
            );
        }

        $this->db->insert_batch('admin_preview', $data);
        $insert_count = count($data);
        return($insert_count);

    }

}