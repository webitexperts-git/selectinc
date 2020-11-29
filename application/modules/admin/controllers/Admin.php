<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

   function __construct() {
        parent:: __construct();
        $this->load->model('admin_model');
	      $this->lang->load('login');
        //check_user_logged();
   }

   public function users(){    
      $searchtext = $this->input->get('search');
      $page = $this->input->get('page');
      $data['users'] = $this->admin_model->get_user_profile($searchtext, $page);     
      // print_r($data); 
      $data['view']='index';
      $data['view_title']='All Users';
      $this->load->view('backend/admin-layout', $data);
   }

   public function experts_users(){    
      $searchtext = $this->input->get('search');
      $page = $this->input->get('page');
      $data['users'] = $this->admin_model->experts_users($searchtext, $page);      
      $data['view']='index';
      $data['view_title']='Experts';
      $this->load->view('backend/admin-layout', $data);
   }

   public function company_users(){    
      $searchtext = $this->input->get('search');
      $page = $this->input->get('page');
      $data['users'] = $this->admin_model->company_users($searchtext, $page);      
      $data['view']='index';
      $data['view_title']='Company';
      $this->load->view('backend/admin-layout', $data);
   }


   // public function users_profile($username, $uniqueid){      
   //    $data['user_profile'] = $this->admin_model->get_user_profile_details($uniqueid);
   //  //   $data['categories'] = $this->admin_model->get_categories();
   //    $data['view']='user-profile';
   //    $this->load->view('backend/admin-layout', $data);
   // }

   public function users_experts($user_name, $user_code){
      $data['view']='expert-profile';
      $data['profile'] = $this->admin_model->get_user_profile_detail($user_code);
      $data['detail'] = $this->admin_model->get_expert_detail($user_code);
      $data['education'] = $this->admin_model->get_expert_education($user_code);
      $data['employement_history'] = $this->admin_model->get_expert_employement_history($user_code);
      $data['projects'] = $this->admin_model->get_expert_project($user_code);
      $data['testimonials'] = $this->admin_model->get_expert_testimonials($user_code);
      $data['languages'] = $this->admin_model->get_expert_language($user_code);

       // print_r($data);    
       $this->load->view('backend/admin-layout', $data);
   }


   public function users_company($user_name, $user_code){
    $data['view']='company-profile';
    $data['profile'] = $this->admin_model->get_user_profile_detail($user_code);
    $data['company'] = $this->admin_model->get_company_details($user_code);
    $data['user_id'] = $this->admin_model->get_user_id($user_code);
    // print_r($data);
    $this->load->view('backend/admin-layout', $data);
  }

   public function users_enabled(){    
      
      $enable = $this->admin_model->users_enabled();
      if($enable == 1){
        echo "success";
        exit();
      }
      echo "error";
      exit();
   }

   public function users_status(){    
      
      $enable = $this->admin_model->users_status();
      if($enable == 1){
        echo "success";
        exit();
      }
      echo "error";
      exit();
   }

   public function edit_users_profile($username, $uniqueid){    
       
      $data['user_profile'] = $this->admin_model->get_user_profile_details($uniqueid);
    //   $data['categories'] = $this->admin_model->get_categories();
      $data['view']='edit-user-profile';
      $this->load->view('backend/admin-layout', $data);
   }


   public function save_users_profile(){
       
      $this->form_validation->set_rules('txtfname', 'First Name', 'required');
      $this->form_validation->set_rules('txtlname', 'Last Name', 'required');
      $this->form_validation->set_rules('txtcont1', 'Contact No', 'required');
      $this->form_validation->set_rules('txtemail', 'Email Id', 'required'); 
    
      if ($this->form_validation->run() == TRUE) { 

         $filename = time() . date('Ymd');
         $profileimage = '';
         if(isset($_FILES['txtprofileimg'])&&$_FILES['txtprofileimg']['error']=='0'){
            $config = array(
               'upload_path' => "assets/upload/images/",
               'allowed_types' => "gif|jpg|png|jpeg",
               'overwrite' => TRUE,
               'max_size' => "2048000",
               'file_name' => $filename
            );
            $this->load->library('upload', $config);
            if($this->upload->do_upload('txtprofileimg')){
               $data = array('upload_data' => $this->upload->data());
               $profileimage=$data['upload_data']['file_name'];
            }
            else {
               $error = array('error' => $this->upload->display_errors());
               echo $error['error'];die;
            }
         }
         $ret_date = $this->admin_model->save_users_profile($profileimage);
         if(empty($ret_date )){
            echo "error";
            exit();
         }

         $uniqueid = $this->input->post('txtuniqueid');
         // redirect('admin/profile/'.$ret_date."/".$uniqueid);
         echo "success#".$ret_date;
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }



   public function users_delete_account(){ 
      $enable = $this->admin_model->users_delete_account();
      echo $enable;
   }

    public function users_approve_account(){ 
      $enable = $this->admin_model->users_approve_account();
      echo $enable;
   }
   



   // Application Area

   public function application_area(){      
      $data['application_areas'] = $this->admin_model->get_application_area(null, 0);
      $data['view']='application-area/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_application_area(){
       
      $this->form_validation->set_rules('txttitle', 'Application Area Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_application_area();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_application_area(){
       
      $this->form_validation->set_rules('txeditttitle', 'Application Area Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_application_area();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_application_area(){
       
      $this->form_validation->set_rules('txtdelid', 'Application Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_application_area();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }



   // physics experience

   public function physics_experience(){      
      $data['physics_experiences'] = $this->admin_model->get_physics_experience(null, 0);
      $data['view']='physics-experience/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_physics_experience(){
       
      $this->form_validation->set_rules('txttitle', 'Physics Experience Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_physics_experience();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_physics_experience(){
       
      $this->form_validation->set_rules('txeditttitle', 'Physics Experience Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_physics_experience();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_physics_experience(){
       
      $this->form_validation->set_rules('txtdelid', 'Physics Experience Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_physics_experience();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }



   // Project Length

   public function project_length(){      
      $data['project_lengths'] = $this->admin_model->get_project_length(null, 0);
      $data['view']='project-length/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_project_length(){
       
      $this->form_validation->set_rules('txttitle', 'Project Length Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_project_length();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_project_length(){
       
      $this->form_validation->set_rules('txeditttitle', 'Project Length Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_project_length();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_project_length(){
       
      $this->form_validation->set_rules('txtdelid', 'Project Length Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_project_length();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }





 // Project visibility

   public function project_visibility(){      
      $data['project_visibilitys'] = $this->admin_model->get_project_visibility(null, 0);
      $data['view']='project-visibility/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_project_visibility(){
       
      $this->form_validation->set_rules('txttitle', 'Project Visibility Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_project_visibility();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_project_visibility(){
       
      $this->form_validation->set_rules('txeditttitle', 'Project Visibility Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_project_visibility();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_project_visibility(){
       
      $this->form_validation->set_rules('txtdelid', 'Project visibility Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_project_visibility();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }






 // research_development_experiences

   public function research_development_experience(){      
      $data['research_development_experiences'] = $this->admin_model->get_research_development_experience(null, 0);
      $data['view']='research-development/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_research_development_experience(){
       
      $this->form_validation->set_rules('txttitle', 'Research Development Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_research_development_experience();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_research_development_experience(){
       
      $this->form_validation->set_rules('txeditttitle', 'Research Development Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_research_development_experience();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_research_development_experience(){
       
      $this->form_validation->set_rules('txtdelid', 'Research Development Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_research_development_experience();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }



 // simulations experience

   public function simulations_experience(){      
      $data['simulations_experiences'] = $this->admin_model->get_simulations_experience(null, 0);
      $data['view']='simulations-experience/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_simulations_experience(){
       
      $this->form_validation->set_rules('txttitle', 'Simulations Experience Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_simulations_experience();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_simulations_experience(){
       
      $this->form_validation->set_rules('txeditttitle', 'Simulations Experience Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_simulations_experience();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_simulations_experience(){
       
      $this->form_validation->set_rules('txtdelid', 'Simulations Experience Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_simulations_experience();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }




   // software experience

   public function software_experience(){      
      $data['software_experiences'] = $this->admin_model->get_software_experience(null, 0);
      $data['view']='software-experience/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_software_experience(){
       
      $this->form_validation->set_rules('txttitle', 'Software Experience Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_software_experience();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_software_experience(){
       
      $this->form_validation->set_rules('txeditttitle', 'Software Experience Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_software_experience();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_software_experience(){
       
      $this->form_validation->set_rules('txtdelid', 'Software Experience Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_software_experience();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }



    // Soft Skill

   public function soft_skill(){      
      $data['soft_skills'] = $this->admin_model->get_soft_skill(null, 0);
      $data['view']='soft-skill/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_soft_skill(){
       
      $this->form_validation->set_rules('txttitle', 'Soft Skill Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_soft_skill();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_soft_skill(){
       
      $this->form_validation->set_rules('txeditttitle', 'Soft Skill Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_soft_skill();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_soft_skill(){
       
      $this->form_validation->set_rules('txtdelid', 'Soft Skill Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_soft_skill();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }



   // Soft Skill

   public function timezone(){      
      $data['timezones'] = $this->admin_model->get_timezone(null, 0);
      $data['view']='timezone/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_timezone(){
       
      $this->form_validation->set_rules('txttitle', 'Soft Skill Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_timezone();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_timezone(){
       
      $this->form_validation->set_rules('txeditttitle', 'Soft Skill Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_timezone();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_timezone(){
       
      $this->form_validation->set_rules('txtdelid', 'Soft Skill Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_timezone();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }


   // Soft Skill

   public function industry(){      
      $data['industrys'] = $this->admin_model->get_industry(null, 0);
      $data['view']='industry/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_industry(){
       
      $this->form_validation->set_rules('txttitle', 'Soft Skill Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_industry();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_industry(){
       
      $this->form_validation->set_rules('txeditttitle', 'Soft Skill Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_industry();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_industry(){
       
      $this->form_validation->set_rules('txtdelid', 'Soft Skill Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_industry();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }


   // Work Type

   public function work(){      
      $data['works'] = $this->admin_model->get_work(null, 0);
      $data['view']='work/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_work(){
       
      $this->form_validation->set_rules('txttitle', 'Soft Skill Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_work();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_work(){
       
      $this->form_validation->set_rules('txeditttitle', 'Soft Skill Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_work();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_work(){
       
      $this->form_validation->set_rules('txtdelid', 'Soft Skill Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_work();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }


// Language

   public function language(){      
      $data['languages'] = $this->admin_model->get_language(null, 0);
      $data['view']='language/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_language(){
       
      $this->form_validation->set_rules('txttitle', 'Language Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_language();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_language(){
       
      $this->form_validation->set_rules('txeditttitle', 'Language Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_language();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_language(){
       
      $this->form_validation->set_rules('txtdelid', 'Language Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_language();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }



// Language Proficiency

   public function language_proficiency(){      
      $data['language_proficiencys'] = $this->admin_model->get_language_proficiency(null, 0);
      $data['view']='language-proficiency/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_language_proficiency(){
       
      $this->form_validation->set_rules('txttitle', 'Language Proficiency ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_language_proficiency();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_language_proficiency(){
       
      $this->form_validation->set_rules('txeditttitle', 'Language Proficiency', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_language_proficiency();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_language_proficiency(){
       
      $this->form_validation->set_rules('txtdelid', 'Language Proficiency Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_language_proficiency();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }





// Language

   public function degree(){      
      $data['degrees'] = $this->admin_model->get_degree(null, 0);
      $data['view']='degree/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function add_degree(){
       
      $this->form_validation->set_rules('txttitle', 'degree Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_degree();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_degree(){
       
      $this->form_validation->set_rules('txeditttitle', 'degree Name', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_degree();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_degree(){
       
      $this->form_validation->set_rules('txtdelid', 'degree Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_degree();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }


   // =====================

    public function paanduv_test_link(){
       
      $this->form_validation->set_rules('txeditttitle', 'Link Name', 'required');
      $this->form_validation->set_rules('testtext', 'Test Text', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->paanduv_test_link();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }


   public function paanduv_test(){      
      $data['link'] = get_test_link();
      $data['view']='paanduv-test/index';
      // print_r($data);
      $this->load->view('backend/admin-layout', $data);
   }

   public function paanduv_test_pass_mark(){
       
      $this->form_validation->set_rules('testuserid', 'User Data', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->paanduv_test_pass_mark();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }
 
   public function paanduv_service_fee(){      
      $data['service_fee'] = get_test_link();
      $data['view']='servicefee/index';
      // print_r($data);
      $this->load->view('backend/admin-layout', $data);
   }

    public function save_paanduv_service_fee(){
       
      $this->form_validation->set_rules('txeditttitle', 'Service Fee', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_paanduv_service_fee();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }





   // ============== Membership ============

   public function employer_membership_plan(){      
      $data['memberships'] = $this->admin_model->get_employer_membership();
      $data['view']='membership/employer';
      // print_r($data);
      $this->load->view('backend/admin-layout', $data);
   }



   public function add_employer_membership_plan(){
       
      $this->form_validation->set_rules('txtmembershipname', 'Membership Name', 'required');
      $this->form_validation->set_rules('txtmax_project', 'Maximum Posted Projects', 'required');
      $this->form_validation->set_rules('txtfinal_report', 'Final Report for Grammatical and Technical Inaccuracies', 'required');
      $this->form_validation->set_rules('txtprice', 'Price', 'required');
      $this->form_validation->set_rules('txtoff', '% Off Service Fee', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_employer_membership_plan();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_employer_membership_plan(){
 
      $this->form_validation->set_rules('txeditid', 'Membership Data', 'required');
       $this->form_validation->set_rules('txteditmembershipname', 'Membership Name', 'required');
     
      
      $this->form_validation->set_rules('txeditprice', 'Price', 'required');
    
      $unlimited_posted_project = (int)$this->input->post('chkunltpostedpro');
      $unlimited_final_report = (int)$this->input->post('chkunltfinalreport');
      $unlimited_service_fee = (int)$this->input->post('chkunltoff');

      if($unlimited_posted_project != -1){
          $this->form_validation->set_rules('txeditmax_project', 'Maximum Posted Projects', 'required');
      }

      if($unlimited_final_report != -1){
         $this->form_validation->set_rules('txteditfinal_report', 'Final Report for Grammatical and Technical Inaccuracies', 'required');
      }

      if($unlimited_service_fee != -1){
           $this->form_validation->set_rules('txeditoff', '% Off Service Fee', 'required');
      }


      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_employer_membership_plan();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_employer_membership_plan(){
       
      $this->form_validation->set_rules('txtdelid', 'Membership Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_employer_membership_plan();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }



   // ============

   public function expert_membership_plan(){      
      $data['memberships'] = $this->admin_model->get_expert_membership_plan();
      $data['view']='membership/expert';
      // print_r($data);
      $this->load->view('backend/admin-layout', $data);
   }

    public function add_expert_membership_plan(){
       
      $this->form_validation->set_rules('txtmembershipname', 'Membership Name', 'required');
      $this->form_validation->set_rules('txtprice', 'Price', 'required');
      
      
      $unlimited_posted_project = (int)$this->input->post('chkunltpostedpro');
      $unlimited_purchase_bids = (int)$this->input->post('chkadditionalbits');
      
      if($unlimited_posted_project != -1){
         $this->form_validation->set_rules('txtmax_project', 'Maximum Posted Projects', 'required');
      }

      if($unlimited_purchase_bids != -1){
         $this->form_validation->set_rules('txtbidspurchaseprice', 'Bids Pruchase Price', 'required');
      }


      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->add_expert_membership_plan();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function save_expert_membership_plan(){

      $this->form_validation->set_rules('txeditid', 'Membership Data', 'required');
      $this->form_validation->set_rules('txteditmembershipname', 'Membership Name', 'required');
     
      $this->form_validation->set_rules('txeditprice', 'Price', 'required');
      
      $unlimited_posted_project = (int)$this->input->post('chkunltpostedpro');
      $unlimited_purchase_bids = (int)$this->input->post('chkadditionalbits');
      
      if($unlimited_posted_project != -1){
          $this->form_validation->set_rules('txeditmax_project', 'Maximum Posted Projects', 'required');
      }
       
      if($unlimited_purchase_bids != -1){
         $this->form_validation->set_rules('txteditbidspurchaseprice', 'Bids Pruchase Price ', 'required');
      }

    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->save_expert_membership_plan();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   public function delete_expert_membership_plan(){
       
      $this->form_validation->set_rules('txtdelid', 'Membership Data ', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $ret_date = $this->admin_model->delete_expert_membership_plan();
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }

   // ================ Transation Historyv===================

   public function transaction_history($username, $user_code){      
      $data['transactions'] = $this->admin_model->get_transaction_history($user_code);
      // print_r($data);
      $data['view']='transaction-history/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function profile_for_payout(){      
      $data['error'] = 'error';
      $data['data'] = [];

      $this->form_validation->set_rules('expert_id', 'Receiver Detail', 'required');
      $this->form_validation->set_rules('type', 'Account Date', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         $profile = $this->admin_model->profile_for_payout();
         if($profile){
            $data['error'] = 'success';
            $data['data'] = $profile;
         }
      }
      else{

         $data['data'] = validation_errors();
      }
      echo json_encode($data);
   }

   public function usd_payout_transfer(){ 

      $this->form_validation->set_rules('txtpaypalid', 'Paypal Id', 'required');
      $this->form_validation->set_rules('txtbnrefno', 'Bank Reference No', 'required');
      $this->form_validation->set_rules('txtservicefee', 'Service Fee', 'required');
      $this->form_validation->set_rules('txtexpertamount', 'Expert Payable Amount', 'required');
      $this->form_validation->set_rules('txtmilestoneid', 'Milestone', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         echo $ret_data = $this->admin_model->usd_payout_transfer();
         exit();
      }
      else{
         echo validation_errors();
         exit();
      }
      echo 'error';
   }

 
   public function inr_payout_transfer(){ 

      $this->form_validation->set_rules('txtservicefeeinr', 'Service Fee', 'required');
      $this->form_validation->set_rules('txtexpertamountinr', 'Expert Payable Amount', 'required');
      $this->form_validation->set_rules('txtmilestoneidinr', 'Milestone', 'required');
      $this->form_validation->set_rules('txtbanknameinr', 'Bank Name', 'required');
      $this->form_validation->set_rules('txtacountnoinr', 'Account Number', 'required');
      $this->form_validation->set_rules('txtifsccodeinr', 'IFSC Code', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
         echo $ret_data = $this->admin_model->inr_payout_transfer();
         exit();
      }
      else{
         echo validation_errors();
         exit();
      }
      echo 'error';




 
      // $info = array( 
      //    'shopId' => 'ABC001',
      //    "payout" => array( 
      //      "amount" => 500, 
      //    ),
      //    "account" => array( 
      //      "accountNumber" => 'DE610639036594575851447918096101', 
      //      "swiftCode" => 'AARBDE5W700', 
      //      "bankName" => 'Aareal Bank', 
      //    ),
      //    "customerAddress" => array( 
      //      "street" => 'street', 
      //      "city" => 'city', 
      //      "countryCode" => 'countryCode', 
      //      "name" => 'name', 
      //    ),   
      // ); 

      // $post_data = json_encode($info);
      // // print_r($post_data);
      // $ch = curl_init('https://secure.payu.com/api/v2_1/payouts');
      // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      //    "Content-Type: application/json",
      //    "Authorization: Bearer 3e5cac39-7e38-4139-8fd6-30adc06a61bd"
      // ));
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

      // // execute!
      // $response = curl_exec($ch);

      // // close the connection, release resources used
      // curl_close($ch);

      // // do anything you want with your response
      // var_dump($response);

      // exit();
 
   }



   public function paypal_payout_transfer(){ 
 
 

      // define("PAYPAL_CLIENT_ID", "AarKonYsuhJb5aPe6kmqyzovCKdSbhejQLe7H7ukAP_QqlhzZbztLKlTOJJYVjsxhSMPWyGcp3zyxDzH");

      // define("PAYPAL_CLIENT_SECRET","EDsRVPyK5fwaAeuCEpui_PnZrxxJRKFslsCNL9AU1NSLIdzl0oDpojoN3PacWiQ8H2gb0s11FvTtxUZ6");

      // define("PAYPAL_TOKEN_URL", "https://api.sandbox.paypal.com/v1/oauth2/token");
      // define("PYPAL_PAYOUTS_URL", "https://api.sandbox.paypal.com/v1/payments/payouts");

      // $headers[] = "Accept: application/json";
      // $headers[] = "Content-Type: application/x-www-form-urlencoded";

      // //--- Data field for our token request
      // $data = "grant_type=client_credentials";

      // //--- Pass client id & client secrent for authorization
      // $curl_options[CURLOPT_USERPWD] = PAYPAL_CLIENT_ID . ":" . PAYPAL_CLIENT_SECRET;

      // $token_request = curl_request(PAYPAL_TOKEN_URL, "POST", $headers, $data, $curl_options);
      // $token_request = json_decode($token_request);
      // if(isset($token_request->error)){
      //     die("Paypal Token Error: ". $token_request->error_description);
      // }

      // $headers = $data = [];
      // //--- Headers for payout request
      // $headers[] = "Content-Type: application/json";
      // $headers[] = "Authorization: Bearer $token_request->access_token";

      // $time = time();
      // //--- Prepare sender batch header
      // $sender_batch_header["sender_batch_id"] = $time;
      // $sender_batch_header["email_subject"] = "Payout Received";
      // $sender_batch_header["email_message"]   = "You have received a payout, Thank you for using our services";

      // //--- First receiver
      // $receiver["recipient_type"] = "EMAIL";
      // $receiver["note"] = "Thank you for your services";
      // $receiver["sender_item_id"] = $time++;
      // $receiver["receiver"] = $_POST['txtpaypalid'];
      // $receiver["amount"]["value"] = $_POST['txtamount'];
      // $receiver["amount"]["currency"] = "USD";
      // $items[] = $receiver;

      // print_r($sender_batch_header);

      // $data["sender_batch_header"] = $sender_batch_header;
      // $data["items"] = $items;

      // //--- Send payout request
      // $payout = curl_request(PYPAL_PAYOUTS_URL, "POST", $headers, json_encode($data));

      // print_r($payout);
   }




   public function home_banner(){      
      $data['data'] = $this->admin_model->get_home_banner();
      $data['view']='homepage/banner/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function save_home_banner(){
       
      $filename = time() . date('Ymd');
      $image = '';
      if(isset($_FILES['txtimage'])&&$_FILES['txtimage']['error']=='0'){
         $config = array(
            'upload_path' => "assets/upload/home/",
            'allowed_types' => "jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000",
            'file_name' => $filename
         );
         $this->load->library('upload', $config);
         if($this->upload->do_upload('txtimage')){
            $data = array('upload_data' => $this->upload->data());
            $image=$data['upload_data']['file_name'];
         }
         else {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];die;
         }
      }
      $ret_date = $this->admin_model->save_home_banner($image);
      if(!empty($ret_date)){
         echo 'success';
         exit();
      }
      echo 'error';
   }

   public function meet_the_talents(){      
      $data['experts'] = $this->admin_model->get_meet_the_talents();
      $data['view']='homepage/meet-talent/index';
      // print_r($data);
      $this->load->view('backend/admin-layout', $data);
   }

   public function save_talent_selection(){
      $ret_date = $this->admin_model->save_talent_selection();
      if(!empty($ret_date)){
         echo 'success';
         exit();
      }
      echo 'error';
   }


    public function how_we_work(){      
      $data['data'] = $this->admin_model->get_how_we_work();
      $data['view']='homepage/how-we-work/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function save_how_we_work(){
        
      $filename = time() . date('Ymd');
      $image1 =  '';
      if(isset($_FILES['image1'])&&$_FILES['image1']['error']=='0'){
         $config = array(
            'upload_path' => "assets/upload/home/",
            'allowed_types' => "jpg|png|jpeg|mp4|avi|mpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000",
            'file_name' => $filename
         );
         $this->load->library('upload', $config);
         if($this->upload->do_upload('image1')){
            $data = array('upload_data' => $this->upload->data());
            $image1 = $data['upload_data']['file_name'];
         }
         else {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];die;
         }
      }

      $filename2 = time() . date('Ymd');
      $image2 = '';
      if(isset($_FILES['image2'])&&$_FILES['image2']['error']=='0'){
         $config = array(
            'upload_path' => "assets/upload/home/",
            'allowed_types' => "jpg|png|jpeg|mp4|avi|mpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000",
            'file_name' => $filename2
         );
         $this->load->library('upload', $config);
         if($this->upload->do_upload('image2')){
            $data = array('upload_data' => $this->upload->data());
            $image2 = $data['upload_data']['file_name'];
         }
         else {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];die;
         }
      }

      $ret_date = $this->admin_model->save_how_we_work($image1, $image2);
      if(!empty($ret_date)){
         echo 'success';
         exit();
      }
      echo 'error';
   }


   public function why_choose(){      
      $data['datas'] = $this->admin_model->get_why_choose();
      $data['view']='homepage/whychoose/index';
      // print_r($data);
      $this->load->view('backend/admin-layout', $data);
   }

   public function save_whychoose_title(){

      $this->form_validation->set_rules('txtpagetitle', 'Title ', 'required');
      if ($this->form_validation->run() == TRUE) {
          $delete = $this->admin_model->save_whychoose_title();
          if($delete){
            echo "success";
            exit();
          }
      }
      else{
        echo  validation_errors();
        exit();
      }
      echo "error";
    }


    public function get_why_choose_detail(){     
      $data['error'] = 'error'; 
      $data['data'] = []; 
      
      $ret_data = $this->admin_model->get_why_choose_detail();
      if($ret_data){
         $data['error'] = 'success'; 
         $data['data'] = $ret_data; 
      }
      echo json_encode($data);
   }



    public function save_why_choose(){

      $this->form_validation->set_rules('txtchoosecode', 'Why Choose Data ', 'required');
      $this->form_validation->set_rules('txttitle', 'Title ', 'required');
      $this->form_validation->set_rules('txtdescription', 'Description', 'required');
      
      if ($this->form_validation->run() == TRUE) {

        // if(empty($_FILES['txtimage']['name'])){
        //   echo 'Choose an image to upload';
        //   exit();
        // }

        $filename=time() . date('Ymd');
        $image = '';
        if(isset($_FILES['txtimage'])&&$_FILES['txtimage']['error']=='0'){           
          $config = array(
            'upload_path' => "assets/upload/whychoose/",
            'allowed_types' => "jpg|png|jpeg",
            'overwrite' => false,
            'max_size' => "2048000", 
            'file_name' => $filename
          );

          $this->load->library('upload', $config);
          if($this->upload->do_upload('txtimage'))
          {  
              $data = array('upload_data' => $this->upload->data());
              $image = $data['upload_data']['file_name'];
          }
          else
          {
              $error = array('error' => $this->upload->display_errors());
              echo $error['error'];
              die;
          }
        }

 
        $save = $this->admin_model->save_why_choose($image);
        if($save){
          echo "success";
          exit();
        }
      }
      else{
        echo  validation_errors();
        exit();
      }
      echo "error";
    }


    public function map_title(){      
      $data['view']='homepage/map/index';
      $this->load->view('backend/admin-layout', $data);
   }

   public function save_map_title(){
      $ret_date = $this->admin_model->save_map_title();
      if(!empty($ret_date)){
         echo 'success';
         exit();
      }
      echo 'error';
   }


   public function project_setings(){      
      $data['view']='settings';
      $this->load->view('backend/admin-layout', $data);
   }


   public function save_project_setings(){

      $this->form_validation->set_rules('applications', 'Applications ', 'required');
      $this->form_validation->set_rules('industry', 'Industry Experience ', 'required');
      $this->form_validation->set_rules('simulations', 'Simulations experience', 'required');
      $this->form_validation->set_rules('software', 'Software experience', 'required');
      $this->form_validation->set_rules('research', 'Research and development experience ', 'required');
      $this->form_validation->set_rules('physics', 'Physics Experience', 'required');
      $this->form_validation->set_rules('skill', 'Skill', 'required');
      $this->form_validation->set_rules('txtinrrate', 'Exchange Rate', 'required');

      $this->form_validation->set_rules('txtservicefeeinr', 'Service Fee Rate INR', 'required');
      $this->form_validation->set_rules('txtservicefeeusd', 'Service Fee Rate USD', 'required');

      if ($this->form_validation->run() == TRUE) {

        $filename=time() . date('Ymd');
        $image = '';
        if(isset($_FILES['txtimage'])&&$_FILES['txtimage']['error']=='0'){           
          $config = array(
            'upload_path' => "assets/upload/",
            'allowed_types' => "jpg|png|jpeg",
            'overwrite' => false,
            'max_size' => "2048000", 
            'file_name' => $filename
          );

          $this->load->library('upload', $config);
          if($this->upload->do_upload('txtimage'))
          {  
              $data = array('upload_data' => $this->upload->data());
              $image = $data['upload_data']['file_name'];
          }
          else
          {
              $error = array('error' => $this->upload->display_errors());
              echo $error['error'];
              die;
          }
        } 
        $save = $this->admin_model->save_project_setings($image);
        if($save){
          echo "success";
          exit();
        }
      }
      else{
        echo  validation_errors();
        exit();
      }
      echo "error";
    }





   










































































































































































   // public function get_car_list($username, $uniqueid){       
   //    $data['car_list'] = $this->admin_model->get_user_car_list($uniqueid);
   //    $data['view']='view-added-cars';

   //    // print_r($data);
   //    $this->load->view('backend/admin-layout', $data);
   // }

   // public function delete_user_car(){ 
   //    $ret_msg = $this->admin_model->delete_user_car();
   //    echo $ret_msg;
   // }



































   // public function get_ad(){  
   //    $searchtext = $this->input->get('search');
   //    $page = (int)$this->input->get('page');

   //    $data['ads'] = $this->admin_model->get_ad($searchtext, $page);
   //    $data['view']='ad';
   //    $this->load->view('backend/admin-layout', $data);
   // }

   // public function get_ad_detail($order_id){  

   //    $data['ad'] = $this->admin_model->get_ad_detail($order_id);
   //    $data['view']='ad-detail';
   //    $this->load->view('backend/admin-layout', $data);
   // }




 


 // -----------------------------------------------------------------

    // public function template_request(){   
    //   $data['view']='template-request';
    //   $data['templates'] = $this->admin_model->get_template_purchse_request();

    //   // print_r($data );
    //   $this->load->view('backend/admin-layout', $data);
    // }


    // public function view_template_purchse_request($slug, $order_id){   
    //   $data['view']='view-template-request';
    //   $data['template'] = $this->admin_model->view_template_purchse_request($order_id);

    //   // print_r($data );
    //   $this->load->view('backend/admin-layout', $data);
    // }



     public function home_page_contents(){   
      $data['view']='home-page';
      $data['home'] = $this->admin_model->get_home_page_content();
      $this->load->view('backend/admin-layout', $data);
    }


    public function save_home_page_content(){
       
      $this->form_validation->set_rules('txttitle', 'Title', 'required');
      $this->form_validation->set_rules('homedescription', 'Description', 'required');
      // $this->form_validation->set_rules('aboutimage', 'Image', 'required');
      $this->form_validation->set_rules('txtiframe', 'IFrame Links', 'required');

     
      if ($this->form_validation->run() == TRUE) { 

         $filename = time() . date('Ymd');
         $aboutimage = '';
         if(isset($_FILES['aboutimage'])&&$_FILES['aboutimage']['error']=='0'){
            $config = array(
               'upload_path' => "assets/upload/profileimage/",
               'allowed_types' => "gif|jpg|png|jpeg",
               'overwrite' => TRUE,
               'max_size' => "2048000",
               'file_name' => $filename
            );
            $this->load->library('upload', $config);
            if($this->upload->do_upload('aboutimage')){
               $data = array('upload_data' => $this->upload->data());
               $aboutimage = $data['upload_data']['file_name'];
            }
            else {
               $error = array('error' => $this->upload->display_errors());
               echo $error['error'];die;
            }
         }
         $ret_date = $this->admin_model->save_home_page_content($aboutimage);
         redirect('admin/home-page');
      }
      echo validation_errors();
      exit();
   }

   public function change_order_status(){       
      echo $retdata = $this->admin_model->change_order_status();
   }



   public function page_settings(){   
      $data['view']='page-settings';
      $data['settings'] = $this->admin_model->get_page_settings();

      $this->load->view('backend/admin-layout', $data);
   }



   public function save_page_settings(){
       
      $this->form_validation->set_rules('txtaddress', 'Address', 'required');
      $this->form_validation->set_rules('txtcontact', 'Contact No', 'required');
      $this->form_validation->set_rules('txtemail', 'Email', 'required');       
      $this->form_validation->set_rules('txtcopyright', 'Copyright', 'required');
      $this->form_validation->set_rules('txtemail', 'Email Id', 'required'); 
    
      if ($this->form_validation->run() == TRUE) { 

         $filename = time() . date('Ymd');
         $logo = '';
         if(isset($_FILES['txtlogo'])&&$_FILES['txtlogo']['error']=='0'){
            $config = array(
               'upload_path' => "assets/upload/profileimage/",
               'allowed_types' => "gif|jpg|png|jpeg",
               'overwrite' => TRUE,
               'max_size' => "2048000",
               'file_name' => $filename
            );
            $this->load->library('upload', $config);
            if($this->upload->do_upload('txtlogo')){
               $data = array('upload_data' => $this->upload->data());
               $logo=$data['upload_data']['file_name'];
            }
            else {
               $error = array('error' => $this->upload->display_errors());
               echo $error['error'];die;
            }
         }
         $ret_date = $this->admin_model->save_page_settings($logo);
         if(empty($ret_date )){
            echo "error";
            exit();
         }
         echo "success";
         exit();
      }
      else{
         echo validation_errors();
      exit();
      }
      echo "error";
   }


    public function newsletters_subscription(){      
      $data['users'] = $this->admin_model->get_newsletters_subscription();
      $data['view']='newsletters';
      // print_r($data);
      $this->load->view('backend/admin-layout', $data);
   }



   

}

