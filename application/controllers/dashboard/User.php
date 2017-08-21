<?php

require_once APPPATH . 'libraries\REST_Controller.php';

class User extends REST_Controller {

    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Request-Method: OPTIONS, POST, GET, PUT, DELETE');

        if(!$this->session->userdata('is_loggedin') || $this->session->userdata('user_type') != 'user') {
            redirect('/');
        }
    }

    public function index_get() {
        $data = array(
            'title' => 'Sentry - ' . $this->session->userdata('fname') . ' ' . $this->session->userdata('lname'),
            'content' => 'templates/dashboard-user/dashboard'
        );

        $this->load->view('dashboard_user', $data);
    }

    public function create_survey_get() {
        if($this->session->userdata('temp_question') !== null) {
            redirect('user/survey_report');
        }

        $data = array(
            'title' => 'Sentry - Create Survey',
            'content' => 'templates/dashboard-user/create-survey'
        );

        $this->load->view('dashboard_user', $data);
    }

    public function survey_builder_get() {
        $data = array(
            'title' => 'Sentry - Survey Builder',
            'content' => 'templates/dashboard-user/survey-builder'
        );

        $this->load->view('dashboard_user', $data);
    }

    public function survey_report_get() {
        if($this->session->userdata('temp_question') === null) {
            redirect('user/create_survey');
        }

        $data = array(
            'title' => 'Sentry - Survey Reports',
            'content' => 'templates/dashboard-user/survey-reports'
        );

        $this->load->view('dashboard_user', $data);
    }

    public function surveys_get() {
        $data = array(
            'title' => 'Sentry - My Surveys',
            'content' => 'templates/dashboard-user/surveys'
        );

        $this->load->view('dashboard_user', $data);
    }

    public function templates_get() {
        $data = array(
            'title' => 'Sentry - Templates',
            'content' => 'templates/dashboard-user/templates'
        );

        $this->load->view('dashboard_user', $data);
    }

    public function profile_get() {
        $data = array(
            'title' => 'Sentry - My Profile',
            'content' => 'templates/dashboard-user/profile'
        );

        $this->load->view('dashboard_user', $data);
    }
}