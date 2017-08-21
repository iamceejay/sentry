<?php

class Answer_Model extends MY_Model {

    protected $_collection = 'answers';

    // Descriptive Reports
    public function report_answers($id = null, $question) {
        $result = $this->mongo_db->select(array('answer'), array('_id'))->where(
            array(
                'survey_id' => new MongoID("58a05c09853553f413000029"),
                'question' => $question
            ))->get($this->_collection);

        return $result;
    }

    // Count answers
    public function count_answer($where) {
        $count = $this->mongo_db->where($where)->count($this->_collection);

        return $count;
    }

    // Get answer from a specific label
    public function answer_label($id, $label) {
        $data = $this->mongo_db->select(array($label))->where(array('survey_id' => new MongoID($id)))->get($this->_collection);

        return $data;
    }
}