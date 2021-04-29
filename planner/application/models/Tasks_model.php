<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        //this causes the database library to be autoloaded
        //loading of any other models would happen here
    }

    public function get_task_items(){
        $sql = "SELECT * FROM `tasks`";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_task_detail($id){
        $sql = "SELECT * FROM `tasks` WHERE id = '".$id."'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
}

