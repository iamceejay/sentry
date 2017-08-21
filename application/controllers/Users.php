<?php

require_once APPPATH . 'libraries\REST_Controller.php';

class Users extends REST_Controller {

    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Request-Method: OPTIONS, POST, GET, PUT, DELETE');

        $this->load->model('user_model');
    }

    public function users_get() {
        $data = $this->user_model->get_where(array(
            'user_type' => 'user'
        ));

        $this->response(array('status' => 'Success', 'message' => $data), 200);
    }

    public function reset_password_get($id) {
        $updated = $this->user_model->update(array('_id' => new MongoID($id)), array('password' => '12345678'));

        if($updated) {
            $this->response(array('status' => 'Success', 'message' => 'Password successfuly reset.'), 200);
        } else {
            $this->response(array('status' => 'Error', 'message' => 'Error while reseting password.'), 400);
        }
    }

    public function user_deactivate_get($id) {
        $updated = $this->user_model->update(array('_id' => new MongoID($id)), array('status' => 'inactive'));

        if($updated) {
            $this->response(array('status' => 'Success', 'message' => 'User deactivated.'), 200);
        } else {
            $this->response(array('status' => 'Error', 'message' => 'Error while deactivating user.'), 400);
        }
    }

    public function user_activate_get($id) {
        $updated = $this->user_model->update(array('_id' => new MongoID($id)), array('status' => 'active'));

        if($updated) {
            $this->response(array('status' => 'Success', 'message' => 'User activated.'), 200);
        } else {
            $this->response(array('status' => 'Error', 'message' => 'Error while activating user.'), 400);
        }
    }

    public function update_post() {
        $data = $this->post();

        $updated = $this->user_model->update(array('_id' => $this->session->userdata('_id')), array('password' => $data['password']), 200);

        if($updated) {
            $this->response(array('status' => 'Success', 'message' => 'Password has been updated.'), 200);
        } else {
            $this->response(array('status' => 'Error', 'message' => 'Error while updating password.'), 400);
        }
    }
}