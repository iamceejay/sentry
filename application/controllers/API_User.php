<?php

require_once APPPATH . 'libraries\REST_Controller.php';

class API_User extends REST_Controller {

    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Request-Method: OPTIONS, POST, GET, PUT, DELETE');

        $this->load->model('user_model');
    }
    
    public function signup_post() {
        $data = $this->post();

        $data['user_type'] = 'user';
        $data['status'] = 'active';

        unset($data['password2']);

        if($this->form_validation->run('create_account')) {
            if($this->user_model->get_where(array('username' => $data['username']), true)) {
                $this->response(array('status' => 'Error', 'message' => 'Username is already in use. Please try again.'), 400);
            } else if($this->user_model->get_where(array('email' => $data['email']), true)) {
                $this->response(array('status' => 'Error', 'message' => 'Email is already in use. Please try again.'), 400);
            }

            $id = $this->user_model->insert($data);

            if($id) {
                $this->response(array('status' => 'Success', 'message' => 'Account created successfully!'), 200);
            } else {
                $this->response(array('status' => 'Error', 'message' => 'There was an error while creating your account.'), 400);
            }

        } else {
            $this->response(array('status' => 'Error', 'message' => 'Please fill all the required fileds.', 'data' => $data), 400); 
        }
    }

    public function login_post() {
        $data = $this->post();

        if($this->form_validation->run('login')) {
            if($user = $this->user_model->get_where(array('username' => $data['username'], 'password' => $data['password']), true)) {
                if($user['status'] == 'active') {
                    $this->session->set_userdata($user);
                    $this->session->set_userdata('is_loggedin', true);

                    $this->response(array('status' => 'Success', 'message' => 'Successfuly loggedin!', 'link' => $user['user_type'], 'user' => $user), 200);
                } else {
                    $this->response(array('status' => 'Error', 'message' => 'This account has been deactivated.'), 400);
                }
            } else {
                $this->response(array('status' => 'Error', 'message' => 'Username or Password is incorrect.'), 400);
            }
        } else {
            $this->response(array('status' => 'Error', 'message' => 'Please fill all the required fileds.', 'data' => $data), 400);
        }
    }
    
    public function logout_get() {
        $this->session->sess_destroy();
        redirect('/');
    }

    public function current_info_get() {
        $this->response(array('email' => $this->session->userdata('email'), 'firstname' => $this->session->userdata('fname'), 'lastname' => $this->session->userdata('lname'), 'username' => $this->session->userdata('username')));
    }

    public function count_survey_get() {
        $this->load->model('survey_model');

        $count = $this->survey_model->count(array('user_id' => $this->session->userdata('_id')));

        if($count) {
            $this->response(array('status' => 'Success', 'count' => $count), 200);
        } else {
            $this->response(array('status' => 'Success', 'count' => 0), 404);
        }
    }

    public function count_codes_get() {
        $this->load->model('survey_model');
        $this->load->model('code_model');
        $count = 0;

        $surveys = $this->survey_model->get_where(array('user_id' => $this->session->userdata('_id')));

        foreach($surveys as $key => $value) {
            $temp = $this->code_model->count(array('survey_id' => $value['_id'], 'status' => 'active'));

            $count = $count + $temp;
        }

        if($count) {
            $this->response(array('status' => 'Success', 'count' => $count), 200);
        } else {
            $this->response(array('status' => 'Success', 'count' => 0), 404);
        }
    }

    public function count_inactive_get() {
        $this->load->model('survey_model');
        $this->load->model('code_model');
        $count = 0;

        $surveys = $this->survey_model->get_where(array('user_id' => $this->session->userdata('_id')));

        foreach($surveys as $key => $value) {
            $temp = $this->code_model->count(array('survey_id' => $value['_id'], 'status' => 'inactive'));

            $count = $count + $temp;
        }

        if($count) {
            $this->response(array('status' => 'Success', 'count' => $count), 200);
        } else {
            $this->response(array('status' => 'Success', 'count' => 0), 404);
        }
    }
}