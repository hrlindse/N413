<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        //this causes the database library to be autoloaded
        //loading of any other models would happen here
    }

    public function get_calendar_items(){
        $sql = "SELECT * FROM `events`";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_event_detail($id){
        $sql = "SELECT * FROM `events` WHERE id = '".$id."'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
}




