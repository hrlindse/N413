<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Litlist_model extends CI_Model {  
    public function __construct() {
		parent::__construct();
        //this causes the database library to be autoloaded
        //loading of any other models would happen here   
    }
    
	public function get_litlist_items(){
    	$sql = "SELECT * FROM `litlist`";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
	public function get_litlist_detail($id){
    	$sql = "SELECT * FROM `litlist` WHERE id = '".$id."'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
	
	public function get_random_row(){
		$sql = "SELECT * FROM `litlist`
	 		 	ORDER BY RAND() LIMIT 1";
	 	$query = $this->db->query($sql);
        return $query->row_array();
	}
}




