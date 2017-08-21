<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if($this->session->userdata('is_loggedin') && $this->session->userdata('user_type') == 'user') {
            redirect('user');
        } else if($this->session->userdata('is_loggedin') && $this->session->userdata('user_type') == 'admin') {
            redirect('admin');
        }
    }

    public function index() {
        $data = array(
            'title' => 'Sentry - Automated Survey Management with Dynamic Results Statistics',
            'content' => 'templates/landing-page/home-page'
        );

        $this->load->view('landing_page', $data);
    }

    public function create_account() {
        $data = array(
            'title' => 'Sentry - Create Account',
            'content' => 'templates/landing-page/create-account'
        );

        $this->load->view('landing_page', $data);
    }

    public function take_survey() {
        $survey = $this->session->userdata('survey_info');

        $data = array(
            'title' => 'Sentry - ' . $survey[0]['title'],
            'content' => 'templates/landing-page/take_survey'
        );

        $this->load->view('landing_page', $data);
    }

    public function test() {
        var_dump($this->session->userdata());
    }

    public function dess() {
        $this->session->sess_destroy();
    }
}