<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Litform_model extends CI_Model {  
    public function __construct() {
		parent::__construct();
        //this causes the database library to be autoloaded
        //loading of any other models would happen here   
    }
    
	public function contact_post($contact){
		$contact["name"] = $this->db->escape_str($contact["name"]);
		$contact["comment"] = $this->db->escape_str($contact["comment"]);
    	$messages = array();
		$messages["status"] = $this->db->insert('form_responses', $contact);
		
		if($messages["status"]){
			$messages["success"] = '<p>Thank you for submitting your comment. <br/>
									<span class="mt-5 float-right"><i>The Web Site Team</i></span></p>';
		}else{
			$messages["failed"] = '<p>Sorry, but something went wrong.  Please try again later. <br/>
								   <span class="mt-5 float-right"><i>The Web Site Team</i></span></p>';
		}
        return $messages;
    }
	
	public function get_messages(){
		$sql = "SELECT * FROM `form_responses`
            	ORDER BY timestamp DESC";
		$query = $this->db->query($sql);
        return $query->result_array();
	}
}




