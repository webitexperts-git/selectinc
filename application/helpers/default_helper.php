<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// ------------------------------------------------------------------------

/**
 * @access  public
 * @param   mixed   Script src's or an array
 * @param   string  language
 * @param   string  type
 * @param   string  title
 * @param   boolean should index_page be added to the script path
 * @return  string
 */
 // mail function ----
 function send_mail($email,$subject,$message){

    $from = "manjeet@webitexperts.com";
    $sender_name = "Paanduv";
    $ci = &get_instance();
    $config = Array(
        'mailpath' => '/usr/sbin/sendmail',
        'protocol' => 'sendmail',
        'smtp_host' => 'uitgaande.email',
        'smtp_port' => '587',
        'smtp_user' => 'manjeet@webitexperts.com',
        'smtp_pass' => ';5?U]wtLtDi6',
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1',
    );
    $ci->load->library('email');    
    $ci->email->initialize($config);
    $ci->email->from($from, $sender_name);
    $ci->email->to(trim($email));           
    $ci->email->subject($subject);
    $ci->email->message($message);
    if($ci->email->send()){
        return true;
    }else{
        return false;
    }   
}


function get_paanduv_service_fee($user_id){
    $ci =& get_instance();

    $sql = "SELECT c.id, c.pan, c.name FROM countries c INNER JOIN expert_billing_address eba ON c.id = eba.country WHERE eba.user_id = $user_id";
    $query = $ci->db->query($sql);
    $country_data = $query->row();

    $sql = "SELECT service_fee, service_fee_other FROM admin WHERE id = 1";
    $query = $ci->db->query($sql);
    $service_data = $query->row();


    $array = [];
    if(!empty($country_data)){
        if($country_data->pan == 0){            
            $array['service_fee'] = $service_data->service_fee_other;
            $array['currency'] = 'USD';
        }
        else if($country_data->pan == 1){            
            $array['service_fee'] = $service_data->service_fee;
            $array['currency'] = 'INR';
        }
    } 
    return $array;
}


function get_service_fee(){
    $ci =& get_instance();

    $sql = "SELECT service_fee, service_fee_other FROM admin WHERE id = 1";
    $query = $ci->db->query($sql);
    $result = $query->row();
    
    return $result;
}


function currency_converter($user_id, $usd_amount){
    
    $ci =& get_instance();
    $sql = "SELECT c.id, c.pan, c.name FROM countries c INNER JOIN expert_billing_address eba ON c.id = eba.country WHERE eba.user_id = $user_id";
    $query = $ci->db->query($sql);
    $result = $query->row(); 

    $inr_rate = get_pabe_settings()->exchange_rate; //74.42; //1 usd
    $array = [];
    if(!empty($result)){
        if($result->pan == 0){            
            $array['currency'] = 0; //outside india
            $array['amount'] = $usd_amount;
            $array['inr_amount'] = ($usd_amount * $inr_rate);
        }
        else if($result->pan == 1){
            $array['currency'] = 1; //india
            $array['amount'] = $usd_amount;
            $array['inr_amount'] = ($usd_amount * $inr_rate);
        }
    }
    return $array;
}


function get_security_lock($user_id){
    $ci =& get_instance();
    $sql = "SELECT account_lock FROM security_questions_answer WHERE user_id = $user_id";
    $query = $ci->db->query($sql);
    $result = $query->row();
    
    return $result;
}


function purchase_bids(){
    $ci =& get_instance();
    $sql = "SELECT max_pruchase_bids FROM admin WHERE id = 1";
    $query = $ci->db->query($sql);
    $result = $query->row();
    
    return $result;
}

function get_paypal_username($id){
    $ci =& get_instance();
    $sql = "SELECT paypal_username FROM user WHERE id = $id";
    $query = $ci->db->query($sql);
    $result = $query->row();
    
    return $result;
}

function get_project_detail_by_id($project_id){
    $ci =& get_instance();
    $sql = "SELECT * FROM project WHERE project_code = '$project_id'";
    $query = $ci->db->query($sql);
    $result = $query->row();
     
    return $result;
}

function get_user_detail_by_id($unique_code){
    $ci =& get_instance();
    $sql = "SELECT * FROM user WHERE unique_code = '$unique_code'";
    $query = $ci->db->query($sql);
    $result = $query->row();
     
    return $result;
}


function get_saved_project($user_id, $project_id){
    $ci =& get_instance();
    $sql = "SELECT * FROM saved_project WHERE user_id = $user_id AND project_id = $project_id ";
    $query = $ci->db->query($sql);
    $result = $query->row();
     
    return $result;
}

function user_profile($id){
    $ci =& get_instance();
    $sql = "SELECT * FROM user WHERE id = $id";
    $query = $ci->db->query($sql);
    $result = $query->row();
    
    return $result;
}

function user_contact_info($id){
    $ci =& get_instance();
    $sql = "SELECT * FROM user WHERE id = $id AND billing_address = 1";
    $query = $ci->db->query($sql);
    $result = $query->row();
    
    $billing_address = 0;
    if(!empty($result)){
        $billing_address = 1;
    }
    return $billing_address;
}


function get_pan_tax($country_id){
    $ci =& get_instance();
    $sql = "SELECT * FROM  countries WHERE id = $country_id AND pan = 1";
    $query = $ci->db->query($sql);
    $result = $query->row();
    
    $pan = 0;
    if(!empty($result)){
        $pan = 1;
    }
    return $pan;
}


function get_timezone(){
    $ci =& get_instance();
    $sql = "SELECT * FROM timezone WHERE status = 1 ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}


function get_countries(){
    $ci =& get_instance();
    $sql = "SELECT * FROM  countries WHERE 1 ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}


function get_state_list(){
    $ci =& get_instance();
    $sql = "SELECT s.id, s.name as state_name, c.name as country_name FROM states s INNER JOIN countries c ON c.id = s.country_id WHERE 1 ORDER BY s.country_id ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}


function get_states($country_id){
    $ci =& get_instance();
    $sql = "SELECT * FROM states WHERE country_id = $country_id ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}


function get_industry(){
    $ci =& get_instance();
    $sql = "SELECT * FROM type_of_industry WHERE status = 1 ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}

function get_type_of_work(){
    $ci =& get_instance();
    $sql = "SELECT * FROM type_of_work WHERE status = 1 ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}


function get_application_area(){
    $ci =& get_instance();
    $sql = "SELECT * FROM application_area WHERE status = 1 ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}



function get_simulations_experience(){
    $ci =& get_instance();
    $sql = "SELECT * FROM simulations_experience WHERE status = 1 ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}

function get_software_experience(){
    $ci =& get_instance();
    $sql = "SELECT * FROM software_experience WHERE status = 1 ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}

function get_research_development_experience(){
    $ci =& get_instance();
    $sql = "SELECT * FROM research_development_experience WHERE status = 1 ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}

function get_physics_experience(){
    $ci =& get_instance();
    $sql = "SELECT * FROM physics_experience WHERE status = 1 ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}

function get_soft_skill(){
    $ci =& get_instance();
    $sql = "SELECT * FROM soft_skill WHERE status = 1 ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}


function get_project_length(){
    $ci =& get_instance();
    $sql = "SELECT * FROM project_length WHERE status = 1 ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}

function get_project_visibility(){
    $ci =& get_instance();
    $sql = "SELECT * FROM project_visibility WHERE status = 1 ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}


function get_language(){
    $ci =& get_instance();
    $sql = "SELECT * FROM  language WHERE status = 1  ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}

function get_language_proficiency(){
    $ci =& get_instance();
    $sql = "SELECT * FROM  language_proficiency WHERE status = 1  ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}



function get_degree(){
    $ci =& get_instance();
    $sql = "SELECT * FROM  degree WHERE status = 1  ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}

function get_months(){
    $ci =& get_instance();
    $sql = "SELECT * FROM months WHERE status = 1 ORDER BY id ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}


function get_security_questions(){
    $ci =& get_instance();
    $sql = "SELECT * FROM security_questions WHERE 1 ORDER BY id";
    $query = $ci->db->query($sql);
    $result = $query->result();

    return $result;
}

function get_primary_security_questions(){
    $ci =& get_instance();
    $sql = "SELECT * FROM security_questions WHERE active = 1";
    $query = $ci->db->query($sql);
    $result = $query->row();
    
    return $result;
}

function get_user_security_answer($user_id, $question){
    $ci =& get_instance();
    $sql = "SELECT * FROM security_questions_answer WHERE question = $question AND user_id = $user_id";
    $query = $ci->db->query($sql);
    $result = $query->row();
    
    return $result;
}


function get_notification_for(){
    $ci =& get_instance();
    $sql = "SELECT * FROM notification_for WHERE status = 1 ORDER BY id";
    $query = $ci->db->query($sql);
    $result = $query->result();

    return $result;
}

function get_message_counter(){
    $ci =& get_instance();
    $sql = "SELECT * FROM message_counter WHERE status = 1 ORDER BY id";
    $query = $ci->db->query($sql);
    $result = $query->result();

    return $result;
}

function get_email_with_unread_activity(){
    $ci =& get_instance();
    $sql = "SELECT * FROM email_with_unread_activity WHERE status = 1 ORDER BY id";
    $query = $ci->db->query($sql);
    $result = $query->result();

    return $result;
}

function get_provided_resource($data){
    $resource = array(
        '0' => '',
        '1' => 'Access to commerical software licence',
        '2' => 'Access to computer hardware'
    );

    if($data == -1){
        return $resource;
    }
     
    return $resource[$data];
}

function get_provided_agreement($data){
    $agreement = array(
        '0' => '',
        '1' => "Paanduv's Non-disclosure agreement",
        '2' => 'Custom Non-disclosure agreement'
    );     
    return $agreement[$data];
}

function get_provided_requirement($data){
    $requirement = array(
        '0' => '',
        '1' => "More than 30 hrs/week",
        '2' => 'Less than 30 hrs/week'
        
    );  
    if($data == -1){
        return $requirement;
    }    
    return $requirement[$data];
    // '3' => "i don't know yet"
}

function get_provided_dealline($data){
    $dealline = array(
        '0' => '',
        '1' => "More than 6 months",
        '2' => '3 to 6 months',
        '3' => "1 to 3 months",
        '4' => "Less than 1 month"
    );   
    if($data == -1){
        return $dealline;
    }  
    return $dealline[$data];
}

function get_why_join_paanduv($data){
    $dealline = array(
        '0' => '',
        '1' => "I want to earn extra money",
        '2' => 'I am underpaid by my employer',
        '3' => "I can take on more projects",
        '4' => "I want to grow my expertise",
        '5' => "I want to become full-time freelancer",
        '6' => "I want to explore diffrent areas of application"
    );     
    return $dealline[$data];
}


function calculateExperianceDays($start_date, $end_date){

    if(empty($start_date)){
        return 0;
    }
    if(empty($end_date)){
        return 0;
    }

    $diff = abs(strtotime($end_date) - strtotime($start_date));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    $hours = floor($diff / ( 60 * 60 ));

    $experiance = "Today";

    if($years > 0){
        $experiance = $years." year";
    }
    if($months > 0){
        if($years > 0){
            $experiance = $years . " year(s), " . $months . " month(s)";
        }
        else{
            $experiance = $months . " month(s)";
        }
    }
    if($days > 0){
        if($years < 1){
            if($months > 0){
                if($years > 0){
                    $experiance = $years . " year(s), " . $months . " month(s)";
                }
                else{
                    $experiance = $months . " month(s)";
                }
            }
            else{
                $experiance = $days . " day(s)";
            }
        }
        else{
            if($months > 0){
                if($years > 0){
                    $experiance = $years . " year(s), " . $months . " month(s)";
                }
            }
            else{
                $experiance = $years . " year(s)";
            }
        }
    }
    if($days <= 0){        
        $experiance = $hours.' hours';
    }
    
    return $experiance;
}

function get_page_settings() {
    $ci =& get_instance();   
    $ci->db->select('*')->from('settings');
    $ci->db->where('id', 1);
    return $ci->db->get()->row();
}


function get_test_link(){
    $ci =& get_instance();
    $sql = "SELECT test_link, service_fee, test_text FROM admin WHERE id = 1";
    $query = $ci->db->query($sql);
    $result = $query->row();

    return $result;
}

function get_user_location(){
    $ci =& get_instance();
    $sql = "SELECT DISTINCT c.id, c.name FROM countries c INNER JOIN user u ON c.id = u.country_code  WHERE 1 ORDER BY name ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
     
    return $result;
}

function get_chatting_last_message($id){
    $ci =& get_instance();
    $sql = "SELECT * FROM user_chatting WHERE (from_user_id = $id || to_user_id = $id) ORDER BY id DESC";
    $query = $ci->db->query($sql);
    $result = $query->row();
    
    return $result;
}


function get_project_posted_count($id){

    $data['projects'] = 0;

    $ci =& get_instance();
    $sql = "SELECT count(id) as projects FROM project WHERE user_id = $id AND (status != -1 || status != 2)";
    $query = $ci->db->query($sql);
    $result = $query->row();
    if(!empty($result)){
        $data['projects'] = $result->projects;
    }
    
    return $data;
}

function get_project_count($id, $status){

    $data['projects'] = 0;

    $ci =& get_instance();
    $sql = "SELECT count(id) as projects FROM project WHERE user_id = $id AND  status = $status";
    $query = $ci->db->query($sql);
    $result = $query->row();
    if(!empty($result)){
        $data['projects'] = $result->projects;
    }
    
    return $data;
}


function get_employer_membership(){

    $ci = &get_instance();
    $sql = "SELECT *FROM company_membership WHERE status = 1";
    $query = $ci->db->query($sql);
    $result = $query->result();
    
    return $result;
}

function get_expert_membership(){

    $ci = &get_instance();
    $sql = "SELECT *FROM expert_membership WHERE status = 1";
    $query = $ci->db->query($sql);
    $result = $query->result();
    
    return $result;
}


function get_budget_proposal($project_id){

    $ci = &get_instance();
    $sql = "SELECT *FROM budget_milestone WHERE project_id =  $project_id AND status = 1 ORDER BY id ASC";
    $query = $ci->db->query($sql);
    $result = $query->result();
    
    return $result;
}


function get_max_pay_hourly_rate(){

    $ci = &get_instance();
    $sql = "SELECT max_hourly_rate FROM admin WHERE id = 1";
    $query = $ci->db->query($sql);
    $result = $query->row();

    return $result;
}


// -------------- New Work ----------------

function get_proposal_count($user_id, $project_id){

    $ci = &get_instance();
    $sql = "SELECT count(eaj.id) as total_proposals FROM expert_applied_job eaj INNER JOIN project p ON p.id = eaj.project_id INNER JOIN company c ON c.user_id = p.user_id  WHERE eaj.project_id =  $project_id AND c.user_id = $user_id";
    $query = $ci->db->query($sql);
    $result = $query->row();
    
    return $result;
}

function get_invited_count($user_id, $project_id){

    $ci = &get_instance();
    $sql = "SELECT count(ei.id) as total_invited FROM expert_invite ei INNER JOIN project p ON p.id = ei.project_id INNER JOIN company c ON c.user_id = p.user_id  WHERE ei.project_id =  $project_id AND c.user_id = $user_id";
    $query = $ci->db->query($sql);
    $result = $query->row();
    
    return $result;
}


function bind_pay_button($project_id, $milestone_id){

    $ci = &get_instance();
    
    $sql = "SELECT * FROM budget_milestone WHERE project_id = $project_id AND (milestone_status = 1 || milestone_status = 2  || milestone_status = 4)";
    $query = $ci->db->query($sql);
    $result = $query->row();
    if(!empty($result)){
        return NULL;
    }

    $sql = "SELECT * FROM budget_milestone WHERE project_id = $project_id AND id > $milestone_id AND paid = 0 AND new_created = 0 ORDER BY id ASC";
    $query = $ci->db->query($sql);
    $result = $query->row();

    return $result;
}
 

// ======================= Ratings and Feedback =====================

function get_overall_rating_for_expert($user_id, $from){
    
    $rating = 0;
    $ci =& get_instance();
    $sql = "SELECT count(rf.id) as total_user, sum(rf.rate) as total_rating FROM rating_and_feedback rf INNER JOIN expert_applied_job eaj ON eaj.project_id = rf.project_id WHERE eaj.user_id =  $user_id AND rf.rate_from = $from";
    $query = $ci->db->query($sql);
    $result = $query->row();

    if(!empty($result)){
        $mrating = $result->total_rating;
        $musers = $result->total_user;

        if($mrating > 0 && $musers > 0){
            $rating = ($result->total_rating / $result->total_user);
        }
    }
    return $rating;
}

function get_completed_jobs($user_id, $status){
    // 0-applied, 1-in-progress, 2-complete, 3-dispute
    
    $jobs = 0;
    $ci =& get_instance();
    $sql = "SELECT count(id) as completed_job FROM expert_applied_job WHERE user_id =  $user_id AND   status = $status";
    $query = $ci->db->query($sql);
    $result = $query->row();

    if(!empty($result)){
        $jobs = $result->completed_job;
    }
    return $jobs;
}


function total_earning($user_id){
    
    $array['usd'] = 0;
    $array['inr'] = 0;
    
    $jobs = 0;
    $ci =& get_instance();

    $sql = "SELECT sum(bm.expert_fee) as usd_earning FROM budget_milestone bm INNER JOIN expert_applied_job eaj ON bm.project_id = eaj.project_id INNER JOIN project_milestone_payment pmp ON pmp.milestone_id = bm.id WHERE eaj.user_id =  $user_id AND bm.admin_paid = 1 AND pmp.mc_currency = 'USD'";
    $query = $ci->db->query($sql);
    $result = $query->row();

    if(!empty($result)){
        $array['usd'] = $result->usd_earning;
    }

   $sql = "SELECT sum(bm.expert_fee) as inr_earning FROM budget_milestone bm INNER JOIN expert_applied_job eaj ON bm.project_id = eaj.project_id INNER JOIN project_milestone_payment pmp ON pmp.milestone_id = bm.id WHERE eaj.user_id =  $user_id AND bm.admin_paid = 1 AND pmp.mc_currency = 'INR'";
    $query = $ci->db->query($sql);
    $result = $query->row();

    if(!empty($result)){
        $array['inr'] = $result->inr_earning;
    }

    return $array;
}


function get_project_rating($project_id, $from){
    $ci =& get_instance();
    $sql = "SELECT rate, comment, modification_date FROM rating_and_feedback WHERE project_id = $project_id AND rate_from = $from";
    $query = $ci->db->query($sql);
    return $result = $query->row();
}


// ==========================

function get_overall_rating_for_employer($user_id, $from){
    
    $rating = 0;
    $ci =& get_instance();
    $sql = "SELECT count(rf.id) as total_user, sum(rf.rate) as total_rating FROM rating_and_feedback rf INNER JOIN expert_applied_job eaj ON eaj.project_id = rf.project_id INNER JOIN project p ON p.id = eaj.project_id WHERE p.user_id =  $user_id AND rf.rate_from = $from";
    $query = $ci->db->query($sql);
    $result = $query->row();

    if(!empty($result)){
        $mrating = $result->total_rating;
        $musers = $result->total_user;
        if($mrating > 0 && $musers > 0){
            $rating = ($result->total_rating / $result->total_user);
        }
    }
    return $rating;
}

function get_posted_jobs($user_id){
    // 0-applied, 1-in-progress, 2-complete, 3-dispute
    // -1-draft, 0-under-review, 1-open, 2-in-progress, 3-closed, 4-rejected, 5-dispute, 6-dispute-resolved
    
    $jobs = 0;
    $ci =& get_instance();
    $sql = "SELECT count(id) as posted_job FROM project WHERE user_id = $user_id AND (status != -1 AND status != 4 AND status != 0)";
    $query = $ci->db->query($sql);
    $result = $query->row();

    if(!empty($result)){
        $jobs = $result->posted_job;
    }
    return $jobs;
}

function get_open_jobs($user_id){
   // -1-draft, 0-under-review, 1-open, 2-in-progress, 3-closed, 4-rejected, 5-dispute, 6-dispute-resolved  
    $jobs = 0;
    $ci =& get_instance();
    $sql = "SELECT count(id) as open_jobs FROM project WHERE user_id = $user_id AND status = 1";
    $query = $ci->db->query($sql);
    $result = $query->row();

    if(!empty($result)){
        $jobs = $result->open_jobs;
    }
    return $jobs;
}


function total_spent($user_id){
    
    $array['usd'] = 0;
    $array['inr'] = 0;
  
    $ci =& get_instance();

    $sql = "SELECT sum(pmp.payment_gross) as usd_earning FROM budget_milestone bm INNER JOIN expert_applied_job eaj ON bm.project_id = eaj.project_id INNER JOIN project_milestone_payment pmp ON pmp.milestone_id = bm.id INNER JOIN project p ON p.id = bm.project_id WHERE p.user_id =  $user_id AND bm.paid = 1 AND pmp.mc_currency = 'USD'";
    $query = $ci->db->query($sql);
    $result = $query->row();

    if(!empty($result)){
        $array['usd'] = $result->usd_earning;
    }

    $sql = "SELECT sum(pmp.payment_gross) as inr_earning FROM budget_milestone bm INNER JOIN expert_applied_job eaj ON bm.project_id = eaj.project_id INNER JOIN project_milestone_payment pmp ON pmp.milestone_id = bm.id INNER JOIN project p ON p.id = bm.project_id WHERE p.user_id = $user_id AND bm.paid = 1 AND pmp.mc_currency = 'INR'";
    $query = $ci->db->query($sql);
    $result = $query->row();

    if(!empty($result)){
        $array['inr'] = $result->inr_earning;
    }

    return $array;
}

function get_total_hire($user_id){
    // 0-applied, 1-in-progress, 2-complete, 3-dispute    
    $hire = 0;
    $ci =& get_instance();
    $sql = "SELECT count(eaj.id) as total_hire FROM expert_applied_job eaj INNER JOIN project p ON eaj.project_id = p.id WHERE p.user_id =  $user_id AND eaj.status >= 1";
    $query = $ci->db->query($sql);
    $result = $query->row();

    if(!empty($result)){
        $hire = $result->total_hire;
    }
    return $hire;
}

function get_active_hire($user_id){
    // 0-applied, 1-in-progress, 2-complete, 3-dispute
    
    $active = 0;
    $ci =& get_instance();
    $sql = "SELECT count(eaj.id) as total_active FROM expert_applied_job eaj INNER JOIN project p ON eaj.project_id = p.id WHERE p.user_id = $user_id AND eaj.status = 1";
    $query = $ci->db->query($sql);
    $result = $query->row();

    if(!empty($result)){
        $active = $result->total_active;
    }
    return $active;
}

function get_expert_job_success($user_id){
    // 0-applied, 1-in-progress, 2-complete, 3-dispute    
    $total_project = 0;
    $dispute_project = 0;

    $ci =& get_instance();
    $sql = "SELECT count(id) as total_project FROM expert_applied_job WHERE user_id = $user_id AND status >= 1";
    $query = $ci->db->query($sql);
    $result = $query->row();
    if(!empty($result)){
        $total_project = $result->total_project;
    }

    $sql = "SELECT count(id) as dispute_project FROM expert_applied_job WHERE user_id = $user_id AND status = 3";
    $query = $ci->db->query($sql);
    $result = $query->row();
    if(!empty($result)){
        $dispute_project = $result->dispute_project;
    }

    $success_rate = 0;
    if($total_project > 0){
        $success_project = $total_project - $dispute_project;
        $success_rate = ($success_project * 100)/$total_project;
    }
    return $success_rate;
}

// ============================== Home Contents ========================

function homebanner(){
    $ci =& get_instance();
    $sql = "SELECT * FROM home_banner WHERE id = 1";
    $query = $ci->db->query($sql);
    return $result = $query->row();
}

function get_pabe_settings(){
    $ci =& get_instance();
    $sql = "SELECT * FROM page_settings WHERE id = 1";
    $query = $ci->db->query($sql);
    return $result = $query->row();
}


function get_meet_the_talents() {

    $ci =& get_instance();

    $selected_experts = '';
    $sql = "SELECT selected_experts FROM page_settings WHERE id = 1";
    $query = $ci->db->query($sql);
    $result = $query->row();
    if(!empty($result)){
        $selected_experts = $result->selected_experts;
    }

    $sql = "SELECT u.id, u.name, u.last_name, u.unique_code, u.username, u.test_pass, ed.application_area, ed.simulations_experience, ed.software_experience, ed.research_development_experience, ed.physics_experience, ed.soft_skill, ed.title as designation FROM user u INNER JOIN experts_detail ed ON u.id = ed.user_id where u.id IN ($selected_experts)";
    $query = $ci->db->query($sql);
    return $result = $query->result();
}


function get_how_we_work() {
    $ci =& get_instance();
    $sql = "SELECT  *FROM how_we_work where id = 1";
    $query = $ci->db->query($sql);
    return $result = $query->row();
}


function get_why_choose() {
    $ci =& get_instance();
    $sql = "SELECT  *FROM why_choose where status = 1";
    $query = $ci->db->query($sql);
    return $result = $query->result_array();
}

function get_footer_navigate() {
    $ci =& get_instance();
    $sql = "SELECT id, footer_id, name from footer_navigate where status = 1";
    $query = $ci->db->query($sql);
    return $result = $query->result();
}


function get_footer_navigate_pages($footer_id) {
    $ci =& get_instance();
    $sql = "SELECT id, page_id, footer_id, page_title, slug, footer_link_name, redirect_other FROM footer_page_info where footer_id = $footer_id AND status = 1";
    $query = $ci->db->query($sql);
    return $result = $query->result();
}


function get_social_icons() {
    $ci =& get_instance();
    $ci->db->select('*')->from('social_icon');
    $ci->db->where('status', 1);
    return $result = $ci->db->get()->result();
}


function get_membership_plan($user_id)  {

    $ci =& get_instance();

    $type = 1;
    $ci->db->where('user_id', $user_id);
    $ci->db->where('status', 1);
    $ci->db->select('*');
    $ci->db->from('expert_membership_plan');
    $query = $ci->db->get();
    $result = $query->row();
   

    $membership_id = 1;
    if(!empty($result)){
        $membership_id = $result->membership_id;
    }
    $ci->db->where('id', $membership_id);
    $ci->db->select('*');
    $ci->db->from('expert_membership');
    $query = $ci->db->get();
    $result = $query->row();

    return $result;
}

function get_bids($user_id){

    $available_bids = 0;
    $ci =& get_instance();
    $sql = "SELECT bids FROM expert_bids WHERE user_id = $user_id";
    $query = $ci->db->query($sql);
    $result = $query->row();

    if(!empty($result)){
        $available_bids = (int)$result->bids;
    }
    
    return $available_bids;
}









