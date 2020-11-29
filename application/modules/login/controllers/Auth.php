<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('auth_model');
	      $this->lang->load('login');
        //check_user_logged();
    }

    public function index(){    
       $this->load->view('admin-login');
    }

    public function login() {
      $this->load->view('admin-login');
    }

    public function login_admin(){    
      
      $this->form_validation->set_rules('txtemail', 'Username', 'required');
      $this->form_validation->set_rules('txtpassword', 'Password', 'required');
      
      if ($this->form_validation->run() == TRUE) {        
        $validate = $this->auth_model->validate_admin_login();   

        if(!empty($validate)) {              
          
          $admin_data = []; 
          $array['id'] = $validate->id;
          $array['fname'] = $validate->fname;
          $array['lname'] = $validate->lname;
          $array['username'] = $validate->username;
          $array['email'] = $validate->email;
          $array['phone'] = $validate->phone;
          $array['image'] = $validate->image;
          $array['login_type'] = $validate->login_type;
          $array['logged_admin'] = TRUE;
          
          $admin_data['admin'] = $array;
          $this->session->set_userdata($admin_data);

          echo "success";
          exit();
        }        
      }
      else{
        echo validation_errors();
        exit();
      }
      echo "error" ;
    }

    public function logout() {
      $admin_data = $this->session->userdata('admin');
      $this->session->sess_destroy($admin_data);
      redirect('admin/login');
    } 



    public function admin_profile(){    
      $admin_data = $this->session->userdata('admin');
      if(!empty($admin_data)){
        $id = $admin_data['id'];
        $data['profile'] = $this->auth_model->admin_profile($id);
        $data['view']='profile-setting';
        $this->load->view('backend/admin-layout', $data);
      }
      else{
        redirect('admin/login');
      }
    }


    public function update_profile(){ 

      $this->form_validation->set_rules('txtfname', 'First Name', 'required');
      $this->form_validation->set_rules('txtcontactno', 'Contact No', 'required');
      $this->form_validation->set_rules('txtemail', 'Email id', 'required');

      if ($this->form_validation->run() == TRUE) {        
        $filename=time() . date('Ymd');
        $profileimage='';
        if(isset($_FILES['profileimag'])&&$_FILES['profileimag']['error']=='0'){
          $config = array(
            'upload_path' => "assets/admin/images",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000",
            'file_name' => $filename
          );
          $this->load->library('upload', $config);
          if($this->upload->do_upload('profileimag')){
            $data = array('upload_data' => $this->upload->data());
            $profileimage=$data['upload_data']['file_name'];
          }
          else {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];die;
          }
        }
        $save = $this->auth_model->save_admin_profile($profileimage);
        if($save){
          echo "success";
        }else{
          echo "error";
        }
      }
      else{
        echo validation_errors();
      }
      // redirect('admin/profile');
    }


    public function admin_change_password(){    
      $admin_data = $this->session->userdata('admin');
      if(!empty($admin_data)){
        $id = $admin_data['id'];
        $data['id']= $id;
        $data['view']='change-password';
        $this->load->view('backend/admin-layout', $data);
      }
      else{
        redirect('admin/login');
      }
    }


    public function admin_update_password(){ 

      $this->form_validation->set_rules('txtoldpassword', 'Old Password', 'required');
      $this->form_validation->set_rules('txtnewpassword', 'New Password', 'required');
      $this->form_validation->set_rules('txtconfirmpassword', 'Confirm Password', 'required');

      if ($this->form_validation->run() == TRUE) {  

        $id = $this->input->post('txtid');
        $oldpass = $this->input->post('txtoldpassword');
        $newpass = $this->input->post('txtnewpassword');
        $conpass = $this->input->post('txtconfirmpassword'); 
        if($newpass != $conpass){
          echo "mismatch";
          exit();
        }
        $array['password'] = md5($conpass);
        $array['modification_date'] = date('Y-m-d H:i:s');

        $save = $this->auth_model->change_admin_password($id, $oldpass, $array);
        echo $save;
      }
      else{
        echo validation_errors();
      }
    }

   
    public function forget_password() {
           if($this->input->post()) {
               $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
               $this->form_validation->set_rules('email', 'email', 'required');
               if($this->form_validation->run() == TRUE) {
                        $email = $this->input->post('email');
                        $this->auth_model->setEmail($email);
                        $validate = $this->auth_model->checkUserEmail();
                        if(!empty($validate)) {
                            // need send email
                            $this->session->set_flashdata('success_message', lang('password_reset_message'));
                               redirect('login/forget-password');
                            } else {
                            $this->session->set_flashdata('error_message', lang('email_invalid_message'));
                            redirect('login/forget-password');    
                    }
               }
           }
         $this->load->view('login/forget_password');
    }
    

    public function user_login(){
      //echo "abc";die();
      $response = new stdClass();
      if($this->session->userdata('logged_user') == TRUE){
        //echo "abc";die();
       redirect(base_url());
      }
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
          $response->status = 2;
          $response->message = 'Fields are empty.';
           //redirect('login-signup');
        } else {
          //echo "<?pre>";print_r($_POST);die();
            $validate = $this->auth_model->validate_new_user();
      
            if(!empty($validate)) {
             // echo '<pre>'; print_r($validate);die;
                $usersdata = array();
                $usersdata['users_id'] = $validate->users_id;
                $usersdata['logged_user'] = TRUE;
                //echo "<pre>";print_r($_SESSION);die();
                $this->session->set_userdata($usersdata);
                // echo "<pre>";print_r($_SESSION);die();
                //redirect(base_url());
                $response->status = 1;
                $response->message = 'success.';
            } else {
                $response->status = 2;
                $response->message = 'Invalid credential/ Not match field.';
            }
      
      }
      echo json_encode($response);die();
    }

    public function user_logout() {
        /*$array_items = array('user_id', 'first_name', 'last_name','logged_user');
        $this->session->unset_userdata($array_items);
        $this->session->sess_destroy();*/
         $array_items = array('users_id', 'logged_user');
        $this->session->unset_userdata($array_items);
        redirect(base_url());
    }

     
   public function twitterLogin(){
        $base_url=base_url();
        $userData = array();
        if(isset($_GET['ref'])){
          $referral_from = $_GET['ref'];
        }else{
          $referral_from = NULL;
        }
        //Include the twitter oauth php libraries
        require_once APPPATH."libraries/TwitterOAuth/twitteroauth.php";
 
        //Twitter API Configuration
        $consumerKey = CONSUMER_KEY;
        $consumerSecret = CONSUMER_SECRET;
        $oauthCallback = OAUTHCALLbACK_URI;

        //echo CONSUMER_KEY.' yo yo honey singh '.CONSUMER_SECRET.' yo yo honey singh '.OAUTHCALLbACK_URI;die();
 
        //Get existing token and token secret from session
        $sessToken = $this->session->userdata('token');
        $sessTokenSecret = $this->session->userdata('token_secret');
 
        //Get status and user info from session
        $sessStatus = $this->session->userdata('status');
        $sessUserData = $this->session->userdata('userData');
 
        if(isset($sessStatus) && $sessStatus == 'verified'){
            //Connect and get latest tweets
            $connection = new TwitterOAuth($consumerKey, $consumerSecret, $sessUserData['accessToken']['oauth_token'], $sessUserData['accessToken']['oauth_token_secret']); 
           // $data['tweets'] = $connection->get('statuses/user_timeline', array('screen_name' => $sessUserData['username'], 'count' => 5));
   //echo "jaya";die();
            //User info from session
            $userData = $sessUserData;
        }elseif($this->input->get('oauth_token') !== null && $sessToken == $this->input->get('oauth_token')){
         // echo "pankaj";die();
            //Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
            $connection = new TwitterOAuth($consumerKey, $consumerSecret, $sessToken, $sessTokenSecret);
            //echo "<pre>";print_r($connection);die();
            $accessToken = $connection->getAccessToken($this->input->get('oauth_verifier'));
            if($connection->http_code == '200'){
                //Get user profile info
                $userInfo = $connection->get('account/verify_credentials', ['include_email' => "true"]);
                 //echo'<pre>'; print_r($userInfo);die;
                //Preparing data for database insertion
                $name = explode(" ",$userInfo->name);
                $first_name = isset($name[0])?$name[0]:'';
                $last_name = isset($name[1])?$name[1]:'';
                $userData = array(
                    'oauth_provider' => 'twitter',
                    'oauth_uid' => $userInfo->id,
                    'username' => $userInfo->screen_name,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'locale' => $userInfo->lang,
                    'profile_url' => 'https://twitter.com/'.$userInfo->screen_name,
                    'picture_url' => $userInfo->profile_image_url,
                    'email' => $userInfo->screen_name,
                );


                //Insert or update user data

                $userDetailEamil=$this->auth_model->getSoicalUsername($userInfo);
                $userDetail=$this->auth_model->getTwitterLogin($userInfo);
                if(!empty($userDetailEamil) && empty($userDetail)){
                  $this->session->set_flashdata('message', "This E-mail is already Register by $userDetailEamil->login_type ");
                   // redirect('registration');
                   redirect(base_url());
                }
                if(empty($userDetail)){

                         $users_id=$this->auth_model->setTwitterLogin($userInfo,$referral_from);
                         $collabiddata = array();
                         $collabiddata['users_id'] = $users_id;
                         $this->session->set_userdata($collabiddata);
                         $collabiduser_detail=getLoggedUserDetail();
                       if($collabiduser_detail->social_login_type==0){
                          redirect('next-prccess');
                        }else{
                       # Create User LoginSession
                          $collabiddata = array();
                          $collabiddata['users_id'] = $collabiduser_detail->users_id;
                          $collabiddata['u_email'] = $collabiduser_detail->u_email;
                          $collabiddata['username'] = $collabiduser_detail->username;
                          $collabiddata['logged_user'] = TRUE;
                          $collabiddata['forbidden_logged'] = '-1';

                          $this->session->set_userdata($collabiddata);
                         redirect(base_url());
                       }
                }else{
                      if($userDetail->social_login_type==0){
                          $collabiddata = array();
                          $collabiddata['users_id'] = $userDetail->users_id;
                          $this->session->set_userdata($collabiddata);
                        redirect('next-prccess');
                      }else{
                         # Create User LoginSession

                  // echo "<pre>";print_r($userDetail); die();
                          $collabiddata = array();
                          $collabiddata['users_id'] = $userDetail->users_id;
                          $collabiddata['u_email'] = $userDetail->email;
                          $collabiddata['username'] = $userDetail->username;
                          $collabiddata['logged_user'] = TRUE;
                          $collabiddata['forbidden_logged'] = '-1';

                          $this->session->set_userdata($collabiddata);
                         redirect(base_url());
                      }
                }
 
                //Store status and user profile info into session
                $userData['accessToken'] = $accessToken;
                $this->session->set_userdata('status','verified');
                $this->session->set_userdata('userData',$userData);
 
                //Get latest tweets
                //$data['tweets'] = $connection->get('statuses/user_timeline', array('screen_name' => $userInfo->screen_name, 'count' => 5));
            } else {
               
               $this->session->set_flashdata('error', "Some problem occurred, please try again later!");
               redirect(base_url());
            }
        }else{
            //unset token and token secret from session
            $this->session->unset_userdata('token');
            $this->session->unset_userdata('token_secret');
 
            //Fresh authentication
            $connection = new TwitterOAuth($consumerKey, $consumerSecret);
            $requestToken = $connection->getRequestToken($oauthCallback);
              //echo"<pre>";print_r($requestToken);die;
            //Received token info from twitter
            $this->session->set_userdata('token',$requestToken['oauth_token']);
            $this->session->set_userdata('token_secret',$requestToken['oauth_token_secret']);
 
            //Any value other than 200 is failure, so continue only if http code is 200
            if($connection->http_code == '200'){
                //Get twitter oauth url
                $twitterUrl = $connection->getAuthorizeURL($requestToken['oauth_token']);
                $data['oauthURL'] = $twitterUrl;
                redirect($data['oauthURL']);
            }else{
               $this->session->set_flashdata('error', "Error connecting to twitter! try again later!");
               redirect(base_url());
               
            }
        }
    } 



   

}

