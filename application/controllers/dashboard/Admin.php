<?php

require_once APPPATH . 'libraries\REST_Controller.php';

class Admin extends REST_Controller {

    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Request-Method: OPTIONS, POST, GET, PUT, DELETE');

        if(!$this->session->userdata('is_loggedin') || $this->session->userdata('user_type') != 'admin') {
            redirect('/');
        }
    }

    public function index_get() {
        $data = array(
            'title' => 'Sentry - Admin Dashboard',
            'content' => 'templates/dashboard-admin/dashboard'
        );

        $this->load->view('dashboard_admin', $data);
    }

    public function users_get() {
        $data = array(
            'title' => 'Sentry - Manage Users',
            'content' => 'templates/dashboard-admin/manage_users'
        );

        $this->load->view('dashboard_admin', $data);
    }

    public function question_bank_get() {
        $data = array(
            'title' => 'Sentry - Question Bank',
            'content' => 'templates/dashboard-admin/question_bank'
        );

        $this->load->view('dashboard_admin', $data);
    }

    public function templates_get() {
        $data = array(
            'title' => 'Sentry - Templates',
            'content' => 'templates/dashboard-admin/templates'
        );

        $this->load->view('dashboard_admin', $data);
    }

    public function create_template_get() {
        $data = array(
            'title' => 'Sentry - Create Template',
            'content' => 'templates/dashboard-admin/create_template'
        );

        $this->load->view('dashboard_admin', $data);
    }

    public function count_active_users_get() {
        $this->load->model('user_model');

        $count = $this->user_model->count(array('status' => 'active', 'user_type' => 'user'));

        if($count) {
            $this->response(array('status' => 'Success', 'count' => $count), 200);
        } else {
            $this->response(array('status' => 'Success', 'count' => 0), 404);
        }
    }

    public function count_inactive_users_get() {
        $this->load->model('user_model');

        $count = $this->user_model->count(array('status' => 'inactive', 'user_type' => 'user'));

        if($count) {
            $this->response(array('status' => 'Success', 'count' => $count), 200);
        } else {
            $this->response(array('status' => 'Success', 'count' => 0), 404);
        }
    }

    public function count_templates_get() {
        $this->load->model('template_model');

        $count = $this->template_model->count(array('status' => 'active'));

        if($count) {
            $this->response(array('status' => 'Success', 'count' => $count), 200);
        } else {
            $this->response(array('status' => 'Success', 'count' => 0), 404);
        }
    }

    public function count_questions_get() {
        $this->load->model('question_model');

        $count = count($this->question_model->get());

        if($count) {
            $this->response(array('status' => 'Success', 'count' => $count), 200);
        } else {
            $this->response(array('status' => 'Success', 'count' => 0), 404);
        }
    }
}