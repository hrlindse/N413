<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('calendar_model');
        $this->load->model('tasks_model');
    }

    public function index(){
        $data["page_title"] = "Home | Day Planner";
        $data["this_page"] = "home";
        $this->load->view('templates/head', $data);
        $this->load->view('index', $data);
    }

    public function daily(){
        $data["page_title"] = "Daily View | Day Planner";
        $data["this_page"] = "daily";
//        $data["records"] = $this->litlist_model->get_litlist_items();
        $this->load->view('templates/head', $data);
        $this->load->view('calendar/daily', $data);
    }

//    public function detail($id){
//        $detail = $this->litlist_model->get_litlist_detail($id);
//        $data["page_title"] = "AMP JAMS | ".$detail["item"];
//        $data["this_page"] = "litlist";
//        $data["row"] = $detail;
//        $this->load->view('templates/head', $data);
//        $this->load->view('detail', $data);
//    }

    public function week(){
        $data["page_title"] = "Week View | Day Planner";
        $data["this_page"] = "week";
        $this->load->view('templates/head', $data);
        $this->load->view('calendar/week', $data);
    }

    public function month(){
        $data["page_title"] = "Month View | Day Planner";
        $data["this_page"] = "month";
        $this->load->view('templates/head', $data);
        $this->load->view('calendar/month', $data);
    }


//    public function contact_post(){
//        $contact = $this->input->post();
//        $messages = $this->litform_model->contact_post($contact);
//        echo json_encode($messages);
//    }

    public function account(){
        $data["page_title"] = "Account | Day Planner";
        $data["this_page"] = "account";
        $data["account"] = $this->auth_model->get_settings();
        $this->load->view('templates/head', $data);
        $this->load->view('account', $data);
    }

}