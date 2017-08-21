<?php

require_once APPPATH . 'libraries\REST_Controller.php';

class Report extends REST_Controller {

    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Request-Method: OPTIONS, POST, GET, PUT, DELETE');

        $this->load->model('report_model');
        $this->load->model('answer_model');
    }

    // Descriptive
    public function questions_get($id) {
        $this->load->model('survey_model');

        $data = $this->survey_model->get_where(array('_id' => new MongoId($id)));

        $this->response(array('status' => 'Success', 'message' => $data), 200);
    }

    // Descriptive
    // Count answers
    public function report_answers_post() {
        $data = $this->post();
        $result = array();

        for($x = 0; $x < count($data['options']); $x++) {
            $count = $this->answer_model->count_answer(array(
                'survey_id' => new MongoId($data['id']),
                $data['label'] => $data['options'][$x]
            ));

            array_push($result, array('option' => $data['options'][$x], 'answers' => $count));
        }

        $this->response(array('status' => 'Success', 'message' => $result), 200);
    }

    public function charts_get($id) {
        $charts = $this->report_model->get_where(array('survey_id' => new MongoId($id)), true);

        if(count($charts)) {
            $this->response(array('status' => 'Success', 'message' => $charts), 200);
        } else {
            $this->response(array('status' => 'Error', 'message' => 'You did not create any report for this survey.'), 400);
        }
    }

    public function report_results_post() {
        $data = $this->post();
        $result = array();

        $labels = explode(', ', $data['label']);
        $series = explode(', ', $data['series']);

        for($x = 0; $x < count($series); $x++) {
            $temp = array();

            for($y = 0; $y < count($labels); $y++) {
                $count = $this->count($data['survey_id'][0], $data['l'], $labels[$y], $data['s'], $series[$x]);

                array_push($temp, $count);
            }

            array_push($result, $temp);
        }

        //  Assign numerical values | Legend
        $legend = array();

        for($x = 0; $x < count($labels); $x++) {
            array_push($legend, array(
                'legend' => $labels[$x],
                'key' => $x + 1
            ));
        }

        // Get Data Set
        $data_set = array();

        $set = $this->answer_model->answer_label($data['survey_id'][0], $data['l']);

        for($x = 0; $x < count($set); $x++) {
            for($z = 0; $z < count($set[$x][$data['l']]); $z++) {
                for($y = 0; $y < count($legend); $y++) {
                    if($set[$x][$data['l']][$z] == $legend[$y]['legend']) {
                        array_push($data_set, array('value' => $legend[$y]['key']));
                    }
                }
            }
        }

        $this->response(array('status' => 'Success', 'message' => $result, 'legend' => $legend, 'dataset' => $data_set), 200);
    }

    public function report_result_post() {
        $data = $this->post();
        $result = array();

        $series = explode(', ', $data['series']);

        for($x = 0; $x < count($series); $x++) {
            $count = $this->count_single($data['survey_id'][0], $data['s'], $series[$x]);

            array_push($result, $count);
        }

        $this->response(array('status' => 'Success', 'message' => $result), 200);
    }

    public function count($id, $label, $label_value, $series, $series_value) {
        $count = $this->answer_model->count(array(
            'survey_id' => new MongoId($id), 
            $label => $label_value,
            $series => $series_value
        ));

        return $count;
    }

    public function count_single($id, $series, $series_value) {
        $count = $this->answer_model->count(array(
            'survey_id' => new MongoId($id), 
            $series => $series_value
        ));

        return $count;
    }
}