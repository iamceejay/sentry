<?php

require_once APPPATH . 'libraries\REST_Controller.php';

class Template extends REST_Controller {

    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Request-Method: OPTIONS, POST, GET, PUT, DELETE');

        $this->load->model('template_model');
    }

    public function add_post() {
        $data = $this->post();
        $data['status'] = 'active';

        if($id = $this->template_model->insert($data)) {
            $this->response(array('status' => 'Success', 'message' => 'You have successfully created the template.'), 200);
        } else {
            $this->response(array('status' => 'Error', 'message' => 'There was an error while saving the data.'), 400);
        }
    }

    public function temp_question_post() {
        $this->session->set_userdata('template_question_temp', $this->post());
    }

    public function temp_question_get() {
        $this->response(array('status' => 'Success', 'message' => $this->session->userdata('template_question_temp')), 200);
    }

    public function templates_get() {
        $data = $this->template_model->get_where(array('status' => 'active'));

        $this->response(array('status' => 'Success', 'message' => $data), 200);
    }

    public function temp_template_post() {
        $data = $this->post();

        $this->session->set_userdata('temp_template_info', $data);

        $this->response(array('data' => $this->session->userdata('temp_template_info')));
    }

    public function temp_template_get() {
        $this->response(array('status' => 'Success', 'message' => $this->session->userdata('temp_template_info')), 200);
    }

    public function temp_desstroy_get() {
        $this->session->unset_userdata('temp_template_info');
    }

    public function template_delete_get($id) {
        $updated = $this->template_model->update(array('_id' => new MongoID($id)), array('status' => 'inactive'));

        if($updated) {
            $this->response(array('status' => 'Success', 'message' => 'Template deleted.'), 200);
        } else {
            $this->response(array('status' => 'Error', 'message' => 'Error while deleting template.'), 400);
        }
    }

    public function edit_temp_data_post() {
        $data = $this->post();

        $this->session->set_userdata('template_edit', $data);
    }

    public function edit_temp_data_get() {
        $this->response(array('status' => 'Success', 'message' => $this->session->userdata('template_edit')), 200);
    }

    public function update_template_post($id) {
        $data = $this->post();

        $updated = $this->template_model->update(array('_id' => new MongoID($id)), array('title' => $data['title'], 'description' => $data['description'], 'questions' => $data['questions']));

        if($updated) {
            $this->session->unset_userdata('template_edit');
            $this->response(array('status' => 'Success', 'message' => 'Template Updated.'), 200);
        } else {
            $this->response(array('status' => 'Error', 'message' => 'Error while updating template.'), 400);
        }
    }
}