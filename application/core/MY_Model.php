<?php

class MY_Model extends CI_Model {

    protected $_collection = '';
    protected $_primary_key = '_id';
    protected $_order_by = '';

    /**
    * GET functions
    **/

    // function: get
    public function get() {
        $data = $this->mongo_db->get($this->_collection);

        return $data;
    }

    // function: get_id
    public function get_id($id) {
        $query = $this->mongo_db->where(array($this->_primary_key => new MongoId($id)));
        $data = $query->find_one($this->_collection);

        return $data;
    }

    // function: get_where
    public function get_where($where, $single = false) {
        if($single) {
            $method = 'find_one';
        } else {
            $method = 'get';
        }

        $query = $this->mongo_db->where($where);
        $data = $query->$method($this->_collection);

        return $data;
    }

    /**
    * COUNT & STUFF functions
    **/
    public function count($where) {
        $count = $this->mongo_db->where($where)->count($this->_collection);

        return $count;
    }

    /**
    * INSERT & UPDATE functions
    **/

    // function: insert
    public function insert($data) {
        if($id = $this->mongo_db->insert($this->_collection, $data)) {
            return $id;
        } else {
            return false;
        }
    }

    // function: insert batch
    public function insert_batch($data) {
        $ids = $this->mongo_db->batch_insert($this->_collection, $data);

        if(count($ids) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // function: update
    public function update($where, $data) {
        if($this->mongo_db->where($where)->set($data)->update($this->_collection)) {
            return true;
        } else {
            return false;
        }
    }

    // function: delete
    public function delete($where, $single = true) {
        if($single) {
            $this->mongo_db->where($where)->delete($this->_collection);
        } else {
            $this->mongo_db->where($where)->delete_all($this->_collection);
        }
    }
}