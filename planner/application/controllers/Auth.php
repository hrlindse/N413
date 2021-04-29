<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller { 
 
    public function __construct() {
        parent::__construct();   
		$this->load->model('auth_model');    
    }    
    
	public function index(){
        $data["page_title"] = "Login | Day Planner";
        $data["this_page"] = "login";
        $this->load->view('templates/head', $data);
        $this->load->view('auth/login', $data);
    }

    public function account(){
        $data["page_title"] = "Account | Day Planner";
        $data["this_page"] = "account";
        $this->load->view('templates/head', $data);
        $this->load->view('auth/account', $data);
    }
	
	public function authenticate(){
        $credentials = $this->input->post();
        $messages = $this->auth_model->authenticate($credentials);
        echo json_encode($messages);
    }
	
	public function logout(){
        $data["page_title"] = "Logout | Day Planner";
        $data["this_page"] = "logout";
		$this->session->user_id = 0; //delete the session
        $this->session->sess_destroy(); //delete the session
        $this->load->view('templates/head', $data);
        $this->load->view('auth/logout', $data);
    }
	
	public function register(){
        $data["page_title"] = "Register | Day Planner";
        $data["this_page"] = "register";
        $this->load->view('templates/head', $data);
        $this->load->view('auth/register', $data);
    }
	
	public function new_account(){
        $credentials = $this->input->post();
        $messages = $this->auth_model->new_account($credentials);
    }
}
