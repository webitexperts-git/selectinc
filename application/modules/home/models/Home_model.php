<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Home_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
    }

    public function validate_email($email)  {
 		$this->db->where('email', $email);
	    $this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
		return $result = $query->row();		
 	}

 	public function get_user_detail_by_username($username)  {
 		$this->db->where('username', $username);
	    $this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
		return $result = $query->row();		
 	}

 	public function update_register_token($email){

 		$string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      	$string_shuffled = str_shuffle($string);
      	$token = substr($string_shuffled, 1, 30);

      	$this->db->where('email', $email);
	    $this->db->select('*');
		$this->db->from('register_token');
		$query = $this->db->get();
		$result = $query->row();		
		if(!empty($result)){
			$token = $result->token;
		}
		else{
			$array['email'] = $email;
			$array['token'] = $token;
			$array['creation_date'] = date('Y-m-d H:i:s');

	 		$this->db->insert('register_token', $array);
	 	}
 		
	    return $token;
 	}


    public function user_login()  {

 		$email=$this->input->post('txtemail');
		$password=md5($this->input->post('txtpassword'));

 		$this->db->where('email', $email);
 		$this->db->where('password', $password);
	    $this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
		return $query->row();
 	}
 	
 	
 	public function goolge_user_login()  {

 		$googleid = $this->input->post('googleid');
 		$fname = $this->input->post('googlefname');
 		$lname = $this->input->post('googlelname');
 		$email = $this->input->post('googleemail');
 		$image = $this->input->post('googleimage');
 		
 		$name = trim($this->input->post('txtname'));

        $tusername = $fname. " ". $lname;
        $tusername = str_replace(" ", "", strtolower($tusername));
        $unique = 0;
        $inc = 0;
        $username = $tusername;
        while($unique == 0){
            $this->db->select('*')->from('user');
            $this->db->where('username', $tusername);
            $retdata = $this->db->get()->row();

            if(empty($retdata)){
                $username = $tusername;
                $unique = 1;
                break;
            }
            else{
                $tusername = $username.++$inc;
            }
        }

 		$this->db->where('email', $email);
	    $this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
		$result = $query->row();
		
		if(!empty($result)){
		     $array = array(
		        'google_id' => $googleid,
                'name' => $fname,
                'last_name' => $lname,
                'username' => $username,
                'google_image' => $image,
                'modification_date' => date('Y-m-d H:i:s') 
            );
            
            $this->db->where('email', $email);
            $this->db->update('user', $array);
		}
		else{
		    
		    $array = array(
		        'google_id' => $googleid,
                'unique_code' => "PAANDUV".substr(time(), -6),
                'name' => $fname,
                'last_name' => $lname,
                'username' => $username,           
                'email' => $email,
                'verify_email' => 1,
                'google_image' => $image,
                'newsletter' => 1,
    			'term_condition' => 1,
                'creation_date' => date('Y-m-d H:i:s'),
                'modification_date' => date('Y-m-d H:i:s') 
            );
            
            $this->db->insert('user', $array);
		}
		
		$this->db->where('email', $email);
	    $this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
		return $result = $query->row();
 	}
 	
 	
 	public function save_user_profile_type()  {

 		$googleid = $this->input->post('googleid');
 		$emptype = $this->input->post('emptype');
		
		if(!empty($googleid)){
		     $array = array(
                'user' => $emptype,
                'modification_date' => date('Y-m-d H:i:s') 
            );
            
            $this->db->where('google_id', $googleid);
            $this->db->update('user', $array);
		}
		
		$this->db->where('google_id', $googleid);
	    $this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
		return $result = $query->row();
 	}
 	
 	

 	 public function register($emp) {

        $name = trim($this->input->post('txtname'));
        $lname = trim($this->input->post('txtlname'));

        $tusername = $name.'-'.$lname;
        $tusername = str_replace(" ", "", strtolower($tusername));
        $unique = 0;
        $inc = 0;
        $username = $tusername;
        while($unique == 0){
            $this->db->select('*')->from('user');
            $this->db->where('username', $tusername);
            $retdata = $this->db->get()->row();

            if(empty($retdata)){
                $username = $tusername;
                $unique = 1;
                break;
            }
            else{
                $tusername = $username.++$inc;
            }
        }

        $data_status = 0;
        $usr_status = $this->input->post('emptype');
        if($usr_status == 2){
            $data_status = 1;
        }
        $array = array(
        	'user' => $this->input->post('emptype'),
            'unique_code' => "PAANDUV".substr(time(), -6),
            'name' => $this->input->post('txtname'),
            'last_name' => $this->input->post('txtlname'),
            'username' => $username,            
            'email' => $this->input->post('txtemail'),
            'password' => md5($this->input->post('txtpassword')),
            'newsletter' => (int)$this->input->post('newsletter'),
            'term_condition' => $this->input->post('termcondition'),
			'status' => $data_status,
            'creation_date' => date('Y-m-d H:i:s'),
            'modification_date' => date('Y-m-d H:i:s') 
        );

        $register = $this->db->insert('user', $array);

        if($emp == 2){

            $insert_id = $this->db->insert_id();
            $companyname = $this->input->post('txtcompany');

            $tusername = $companyname;
            $tusername = str_replace(" ", "", strtolower($tusername));
            $unique = 0;
            $inc = 0;
            $username = $tusername;
            while($unique == 0){
                $this->db->select('*')->from('company');
                $this->db->where('username', $tusername);
                $this->db->where('id !=', $insert_id);
                $retdata = $this->db->get()->row();

                if(empty($retdata)){
                    $username = $tusername;
                    $unique = 1;
                    break;
                }
                else{
                    $tusername = $username.++$inc;
                }
            }

            $company = array(
                'user_id' => $insert_id, 
                'company_name' => $companyname, 
                'company_code' => 'PNDVCMP'.substr(time(), -8), 
                'username' => $username, 
                'creation_date' => date('Y-m-d H:i:s'),
                'modification_date' => date('Y-m-d H:i:s') 
            );
            return $this->db->insert('company', $company);
        }
        return $register;
    }


    public function verify_user_email_id($token){

      	$this->db->where('token', $token);
	    $this->db->select('*');
		$this->db->from('register_token');
		$query = $this->db->get();
		$result = $query->row();
		if(!empty($result)){
			$email = $result->email;
			$array = array(
	        	'verify_email' => 1,
	            'modification_date' => date('Y-m-d H:i:s') 
	        );

	        $this->db->where('email', $email);
	        $this->db->update('user', $array);

	        $this->db->where('id', $result->id);
	        $this->db->delete('register_token');

	        return $this->validate_email($email);
		}
 	}


 	public function update_forgot_password_token($email){

 		$string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      	$string_shuffled = str_shuffle($string);
      	$token = substr($string_shuffled, 1, 30);

      	$this->db->where('email', $email);
	    $this->db->select('*');
		$this->db->from('forgot_password_token');
		$query = $this->db->get();
		$result = $query->row();		
		if(!empty($result)){
			$token = $result->token;
		}
		else{
			$array['email'] = $email;
			$array['token'] = $token;
			$array['creation_date'] = date('Y-m-d H:i:s');

	 		$this->db->insert('forgot_password_token', $array);
	 	} 		
	    return $token;
 	}


 	public function verify_user_password_token($token){

      	$this->db->where('token', $token);
	    $this->db->select('*');
		$this->db->from('forgot_password_token');
		$query = $this->db->get();
		return $result = $query->row();		
 	}



 	public function change_user_forgot_password(){

 		$token = $this->input->post('txttoken');
 		$password = $this->input->post('txtpassword');

      	$this->db->where('token', $token);
	    $this->db->select('*');
		$this->db->from('forgot_password_token');
		$query = $this->db->get();
		$result = $query->row();
		if(!empty($result)){
			$email = $result->email;
			$array = array(
	        	'password' => md5($password),
	            'modification_date' => date('Y-m-d H:i:s') 
	        );

	        $this->db->where('email', $email);
	        $this->db->update('user', $array);

	        $this->db->where('id', $result->id);
	        $this->db->delete('forgot_password_token');

	        return $this->validate_email($email);
		}
 	}


 	public function get_blogs() {
        $this->db->select('*')->from('blog');
        $this->db->where('status', 1);
        // $this->db->where('password', md5($password));
        return $this->db->get()->result();
    }

    public function get_blog_description($blog_id) {
        $this->db->select('*')->from('blog');
        $this->db->where('blog_id', $blog_id);
        return $this->db->get()->row();
    }



    public function get_clientsays() {
        $this->db->select('*')->from('client_say');
        $this->db->where('status', 1);
        // $this->db->where('password', md5($password));
        return $this->db->get()->result();
    }

    // public function get_clientsay_description($clientsay_id) {
    //     $this->db->select('*')->from('client_say');
    //     $this->db->where('clientsay_id', $clientsay_id);
    //     return $this->db->get()->row();
    // }

     public function get_talentagencys() {
        $this->db->select('*')->from('application_area');
        $this->db->where('status', 1);
        // $this->db->where('password', md5($password));
        return $this->db->get()->result();
    }

    // public function get_talentagency_description($talentagency_id) {
    //     $this->db->select('*')->from('talent_agency');
    //     $this->db->where('talent_agency_id', $talentagency_id);
    //     return $this->db->get()->row();
    // }


     public function get_publications() {
        $this->db->select('*')->from('publication');
        $this->db->where('status', 1);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(5, 0);
        return $this->db->get()->result();
    }

    public function get_publication_description($publication_id) {
        $this->db->select('*')->from('publication');
        $this->db->where('publication_id', $publication_id);
        return $this->db->get()->row();
    }


    public function get_trustedbrands() {
        $this->db->select('*')->from('trusted_brand');
        $this->db->where('status', 1);
        return $this->db->get()->result();
    }

    public function get_posted_projects()  { 

        $stext = ' p.status = 1';
        $search = $this->input->get('search');
        if(!empty($search)){
            $search = '%' . strtolower(trim($search)) . "%";
            $stext .= " AND (LOWER(p.title) LIKE '$search' || LOWER(c.company_name) LIKE '$search')";
        }

        $application = $this->input->get('application');
        if(!empty($application)){            
            $stext .= " AND pe.application_area = $application";
        }

        $skills = $this->input->get('skills');
        if(!empty($skills)){
            $sklStr = '';
            foreach ($skills as $skill) {
                $sklStr .= "FIND_IN_SET(pe.soft_skill, $skill) || ";
            }
            $stext .= " AND ( ".substr($sklStr, 0, (strlen($sklStr)-3))." )";
            // $stext .= " AND ( $sklStr )";
        }

        $work_type = $this->input->get('work_type');
        if(!empty($work_type)){
            $wtype = '';
            foreach ($work_type as $work) {
                $wtype .= "FIND_IN_SET(p.work_type, $work) || ";
            }

            $stext .= " AND ( ".substr($wtype, 0, (strlen($wtype)-3))." )";
        }

        // $locations = $this->input->get('location');
        // if(!empty($locations)){
        //  $stext .= " AND (";
        //  $k = "";
        //  foreach ($locations as $location) {
        //      $location = "%".$location."%";
        //      $stext .= $k. "LOWER(cp.location) LIKE '$location'";
        //      $k = "||";
        //  }
        //  $stext .= ")";
        // }

        $duration = $this->input->get('duration');
        if(!empty($duration)){
            $durationarray = implode(",", $duration);
            $stext .= " AND p.project_length IN($durationarray)";
        }


        $sql = "SELECT p.*, pe.*,  c.*, p.creation_date as creation_date, p.verify_date as modification_date, p.status as status, p.id as id FROM project p INNER JOIN project_experties pe on p.id = pe.project_id INNER JOIN company c ON p.user_id = c.user_id WHERE $stext ORDER BY p.id DESC";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }




    public function get_posted_open_projects($openjobs)  { 

        $mydata['app_id'] = 0;
        $mydata['data'] = [];
        
        $id_set  = 0;
        $view  = 0;
        $sql = "SELECT id, max_view FROM application_area WHERE application_area_id = '$openjobs'";
        $query = $this->db->query($sql);
        $sresult = $query->row();
        if(!empty($sresult)){
            $id_set  = $sresult->id;
            $view = $sresult->max_view;
            $mydata['app_id'] = $id_set;
        }

        $sql = "SELECT p.*, pe.*,  c.*, p.creation_date as creation_date, p.verify_date as modification_date, p.status as status, p.id as id FROM project p INNER JOIN project_experties pe on p.id = pe.project_id INNER JOIN company c ON p.user_id = c.user_id WHERE FIND_IN_SET($id_set, pe.application_area) ORDER BY p.id DESC LIMIT 0, $view";
        $query = $this->db->query($sql);
        $result = $query->result();
        
        if(!empty($result)){
            $mydata['data'] = $result;
        }
        
        return $mydata;
    }

    public function get_posted_project_detail($project_code)  {         
        $sql = "SELECT p.*, pe.*,  c.*, pb.*, p.creation_date as creation_date, p.verify_date as modification_date, p.status as status, u.name, u.last_name, p.id as project_id FROM project p INNER JOIN project_experties pe on p.id = pe.project_id INNER JOIN company c ON p.user_id = c.user_id INNER JOIN project_budget pb ON p.id = pb.project_id INNER JOIN user u ON u.id= p.user_id WHERE p.project_code = '$project_code'";
        $query = $this->db->query($sql);
        return $result = $query->row();
    }



    public function google_map_for_experts()  {  

        $experts = [];       
        $sql = "SELECT u.name, u.last_name, u.address, u.city, u.state, s.name as state_name, u.country, c.name as country_name, u.zipcode FROM user u INNER JOIN countries c ON c.id = u.country INNER JOIN states s ON s.id = u.state WHERE 1";
        $sql = "SELECT u.name, u.last_name, u.address, u.city, u.country, c.name as country_name, u.zipcode FROM user u INNER JOIN countries c ON c.id = u.country WHERE 1";

        $query = $this->db->query($sql);
        $result = $query->result();
        if(!empty($result)){
            foreach ($result as $expert) {
                
               $address_loc = $expert->city.", ".$expert->country_name;
               $array['DisplayText'] = $address_loc; //$expert->name." ".$expert->last_name;
               $address =  $expert->city.','.$expert->country_name;
               $array['ADDRESS'] = $expert->address.", ".$expert->city.", ".$expert->country_name."-". $expert->zipcode;
               $array['LatitudeLongitude'] =  $this->google_map_experts_lat_lon($address, $expert->country_name);
               $array['MarkerId']= 'Experts';

               array_push($experts , $array);
            }
        }
        return $experts;
    }


    public function view_dynamic_pages($page_id) {
        $this->db->select('*')->from('footer_page_info');
        $this->db->where('page_id', $page_id);
        $this->db->where('status', 1);
        return $this->db->get()->row();
    }





}