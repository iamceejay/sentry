<?php

class Test_Model extends MY_Model {
    
    protected $_collection = 'users';

    public function display() {
        // return $this->get_id('58881d86c0f4419c5568e961');
        // return $this->get_where(array('username' => 'jhondoe'));
        return $this->get();
    }

    public function insert() {
        $data = '[{"id":"textbox","component":"textInput","editable":false,"index":0,"label":"Name","description":"Your name","placeholder":"Your name","options":[],"required":true,"validation":"/.*/"},{"id":"checkbox","component":"checkbox","editable":true,"index":1,"label":"Pets","description":"Do you have any pets?","placeholder":"placeholder","options":["Dog","Cat"],"required":false,"validation":"/.*/"},{"component":"sampleInput","editable":true,"index":2,"label":"Sample","description":"From html template","placeholder":"placeholder","options":[],"required":false,"validation":"/.*/"}]';

        if($id = $this->mongo_db->insert('test', array(
            'type' => 'Survey',
            'questions' => json_decode($data)
        ))) {
            return $id;
        } else {
            return false;
        }
    }
}