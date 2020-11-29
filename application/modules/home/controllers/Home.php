<?php
//error_reporting(0);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
	 
	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
  }
     
	public function index(){
		$data['view']='index';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
	}

  public function client_management(){
    $data['view']='client-management';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
  }

  public function edit_client_management(){
    $data['view']='edit-client-management';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
  }


  public function model_management(){
    $data['view']='model-management';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
  }

  public function edit_model_management(){
    $data['view']='edit-model-management';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
  }




  public function mwm_agency_management(){
    $data['view']='mwm-agency-management';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
  }

  public function invoice(){
    $data['view']='invoice';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
  }

  public function generate_new_invoice(){
    $data['view']='generate-new-invoice';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
  }

  public function refund_overview(){
    $data['view']='refund-overview';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
  }

  public function deductions(){
    $data['view']='deductions';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
  }

  public function expences_deduction(){
    $data['view']='expences-deduction';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
  }

  public function reports_overview(){
    $data['view']='reports-overview';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
  }

  public function reports_detail_view(){
    $data['view']='reports-detail-view';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
  }

  public function administration(){
    $data['view']='administration';
    // print_r($data);
    $this->load->view('frontend/layout', $data);   
  }









}