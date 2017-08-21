<?php

require_once APPPATH . 'libraries\REST_Controller.php';

class Survey extends REST_Controller {

    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Request-Method: OPTIONS, POST, GET, PUT, DELETE');

        $this->load->model('report_model');
        $this->load->model('survey_model');
    }

    public function index_get() {
        $this->response(array('status' => 'Success', 'questions' => $this->session->userdata('temp_builder_questions')), 200);
    }

    public function temp_question_post() {
        $data = $this->post();
        $labels = array();
        
        $this->session->set_userdata('temp_question', $data);

        for($x = 0; $x < count($data['questions']); $x++) {
            if($data['questions'][$x]['component'] == 'select' || $data['questions'][$x]['component'] == 'radio' || $data['questions'][$x]['component'] == 'checkbox' || $data['questions'][$x]['options'] != 0) {
                array_push($labels, array(
                    'label' => $data['questions'][$x]['label'],
                    'options' => $data['questions'][$x]['options']
                    ));
            }
        }

        $this->session->set_userdata('temp_labels', $labels);

        $this->response(array('status' => 'Success', 'questions' => $this->session->userdata('temp_question')), 200);
    }

    public function temp_destroy_get() {
        $this->session->unset_userdata('temp_question');
        $this->session->unset_userdata('temp_labels');
    }

    public function temp_label_get() {
        $data = $this->session->userdata('temp_labels');

        $this->response(array('status' => 'Success', 'labels' => $data), 200);
    }

    public function save_post() {
        $this->load->model('code_model');
        $this->load->helper('string');

        $survey = $this->session->userdata('temp_question');
        $survey['user_id'] = $this->session->userdata('_id');
        $report = $this->post();
        $codes = array();
        $edit = 0;

        if($this->session->userdata('temp_edit_info') != null) {
            $edit = $this->session->userdata('temp_edit_info');
        }

        if($edit != null) {
            $this->survey_model->delete(array('_id' => new MongoID($edit['_id'][0])));
            $this->report_model->delete(array('survey_id' => new MongoID($edit['_id'][0])));
            $this->code_model->delete(array('survey_id' => new MongoID($edit['_id'][0])), false);

            $this->session->unset_userdata('temp_edit_info');
        }
        
        if($survey_id = $this->survey_model->insert($survey)) {
            $report['survey_id'] = $survey_id;

            for($index = 0; $index < $survey['population']; $index++) {
                $code = array(
                    'survey_id' => $survey_id,
                    'code' => random_string('alnum', 5),
                    'status' => 'active'
                );

                array_push($codes, $code);
            }

            $this->code_model->insert_batch($codes);

            if($this->report_model->insert($report)) {
                $this->session->unset_userdata('temp_question');
                $this->session->unset_userdata('temp_labels');

                $this->response(array('status' => 'Success', 'message' => 'Survey & Reports saved!'), 200);
            } else {
                $this->response(array('status' => 'Error', 'message' => 'REPORTS: There was an error while inserting the data.'), 400);
            }
        } else {
            $this->response(array('status' => 'Error', 'message' => 'SURVEY: There was an error while inserting the data.'), 400);
        }
    }

    public function my_surveys_get() {
        $this->load->model('code_model');

        $surveys = $this->survey_model->get_where(array('user_id' => $this->session->userdata('_id')));

        for($x = 0; $x < count($surveys); $x++) {
            $inactive = $this->code_model->get_where(array('survey_id' => $surveys[$x]['_id'], 'status' => 'inactive'));

            if(count($inactive) > 0) {
                $surveys[$x]['editable'] = false;
            } else {
                $surveys[$x]['editable'] = true;
            }
        }

        if($surveys) {
            $this->response(array('status' => 'Success', 'message' => $surveys), 200);
        } else {
            $this->response(array('status' => 'Error', 'title' => 'No Survey Found', 'message' => 'You haven\'t created a survey yet.'), 404);
        }
    }

    public function my_codes_get($id) {
        $this->load->model('code_model');
        $id = new MongoID($id);

        $codes = $this->code_model->get_where(array('survey_id' => $id, 'status' => 'active'));

        $this->response(array('status' => 'success', 'message' => $codes));
    }

    // Validate respondent's code
    // stores survey info into session if code is valid
    public function check_code_post() {
        $this->load->model('code_model');
        $code = $this->post();
        $code['status'] = 'active';

        if($result = $this->code_model->get_where($code, true)) {
            $survey = $this->survey_model->get_where(array('_id' => $result['survey_id']));

            $this->session->set_userdata('survey_code', $code['code']);
            $this->session->set_userdata('survey_info', $survey);

            $this->response(array('status' => 'Success', 'message' => $survey), 200);
        } else {
            $this->response(array('status' => 'Error', 'message' => 'Sorry but that is an invalid code.'), 400);
        }
    }

    // Get survey questions from session
    public function respondent_survey_get() {
        $questions = $this->session->userdata('survey_info')[0]['questions'];

        $this->response(array('status' => 'Success', 'message' => $questions), 200);
    }

    // Get survey id and user's code
    public function respondent_survey_id_get() {
        $id = $this->session->userdata('survey_info')[0]['_id']->{'$id'};

        $this->response(array('status' => 'Success', 'id' => $id, 'code' => $this->session->userdata('survey_code')), 200);
    }

    public function respondent_answer_post() {
        $this->load->model('answer_model');
        $this->load->model('code_model');
        
        $data = $this->post();
        $data['survey_id'] = new MongoID($data['id']);
        $code = $data['code'];
        $answers = array();

        unset($data['id']);

        foreach($data['answers'] as $key => $value) {
            $explode = explode(', ', $value['value']);

            if(count($explode) != 0) {
                foreach($explode as $e => $val) {
                    $data[$value['label']] = $explode;
                }
            } else {
                $data[$value['label']] = $value['value'];
            }
        }

        unset($data['id']);
        unset($data['answers']);
        // unset($data['code']);

        $data['date_answered'] = date('Y-m-d H:i:s');

        if($id = $this->answer_model->insert($data)) {
            if($this->code_model->update(array('code' => $code), array('status' => 'inactive'))) {
                $this->session->unset_userdata('survey_code');
                $this->session->unset_userdata('survey_info');

                $this->response(array('status' => 'Success', 'message' => 'Thank you for answering the survey!'), 200);
            } else {
                $this->response(array('status' => 'Error', 'message' => 'There has been error while submitting your response. Please try again.', 'answers' => $answers), 400);
            }
        } else {
            $this->response(array('status' => 'Error', 'message' => 'There has been error while submitting your response. Please try again.'), 400);
        }
    }

    public function builder_questions_post() {
        $this->session->set_userdata('temp_builder_questions', $this->post());

        $this->response(array('questions' => $this->session->userdata('temp_builder_questions')), 200);
    }

    public function builder_questions_get() {
        $this->response(array('status' => 'Success', 'message' => $this->session->userdata('temp_builder_questions')), 200);
    }

    public function temp_edit_post() {
        $data = $this->post();

        $this->session->set_userdata('temp_edit_info', $data);
    }

    public function temp_edit_get() {
        $this->response(array('status' => 'Success', 'message' => $this->session->userdata('temp_edit_info')), 200);
    }

    public function code_add_post() {
        $codes = array();
        $this->load->model('code_model');
        $this->load->helper('string');
        $data = $this->post();
        $survey = $this->survey_model->get_where(array('_id' => new MongoID($data['id'][0])));

        $population = $survey[0]['population'] + $data['population'];

        if($this->survey_model->update(array('_id' => new MongoID($data['id'][0])), array('population' => $population))) {
            for($index = 0; $index < $data['population']; $index++) {
            $code = array(
                    'survey_id' => new MongoID($data['id'][0]),
                    'code' => random_string('alnum', 5),
                    'status' => 'active'
                );

                array_push($codes, $code);
            }

            $this->code_model->insert_batch($codes);

            $this->response(array('status' => 'Success', 'message' => 'Population size has been changed.'), 200);
        } else {
            $this->response(array('status' => 'Error', 'message' => 'There was an error while updating population size.'), 400);
        }
    }

    public function report_summary_get($id) {
        $this->load->model('answer_model');

        $summary = $this->survey_model->get_where(array('_id' => new MongoID($id)));
        $answers = $this->answer_model->get_where(array('survey_id' => new MongoID($id)));

        $this->response(array('message' => $summary, 'answers' => $answers), 200);
    }

    // Mobile: get surveys
    public function mobile_survey_get($id) {
        $surveys = $this->survey_model->get_where(array('user_id' => new MongoID($id)));

        $this->response(array('status' => 'Success', 'message' => $surveys), 200);
    }

    public function mobile_answer_post() {
        $this->load->model('answer_model');
        $this->load->model('code_model');
        $data = $this->post();

        $data['survey_id'] = new MongoID($data['survey_id']);

        foreach($data['answers'] as $key => $value) {
            $explode = explode(', ', $value['value']);

            if(count($explode) != 0) {
                foreach($explode as $e => $val) {
                    $data[$value['label']] = $explode;
                }
            } else {
                $data[$value['label']] = $value['value'];
            }
        }

        unset($data['answers']);

        $where = array(
            'survey_id' => $data['survey_id'],
            'status' => 'active'
        );

        $code = $this->code_model->get_where($where, true);

        if($code) {
            $this->code_model->update(array('code' => $code['code']), array('status' => 'inactive'));

            $this->answer_model->insert($data);
        }
    }
} 