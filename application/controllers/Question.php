<?php

require_once APPPATH . 'libraries\REST_Controller.php';

class Question extends REST_Controller {

    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Request-Method: OPTIONS, POST, GET, PUT, DELETE');

        $this->load->model('question_model');
    }

    public function add_post() {
        $data = $this->post();

        if($id = $this->question_model->insert($data)){
            $this->response(array('status' => 'Success', 'message' => 'Question has been added to the Question bank.'), 200);
        } else {
            $this->response(array('status' => 'Error', 'message' => 'There was an error while saving the data.'), 400);
        }
    }

    public function questions_get() {
        $data = $this->question_model->get();

        $this->response(array('status' => 'Success', 'message' => $data), 200);        
    }

    public function question_update_post() {
        $data = $this->post();
        $id = $data['id'];

        unset($data['id']);

        if($updated = $this->question_model->update(array('_id' => new MongoID($id)), $data)) {
            $this->response(array('status' => 'Success', 'message' => 'Question has been updated.'), 200);
        } else {
            $this->response(array('status' => 'Error', 'message' => 'There has been an error while updating the question.'), 200);
        }
    }
}