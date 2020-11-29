<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['login']='home/login';


$route['client-management']='home/home/client_management';
$route['edit-client-management']='home/home/edit_client_management';

$route['model-management']='home/home/model_management';
$route['edit-model-management']='home/home/edit_model_management';


$route['mwm-agency-management']='home/home/mwm_agency_management';

$route['invoice']='home/home/invoice';
$route['generate-new-invoice']='home/home/generate_new_invoice';

$route['refund-overview']='home/home/refund_overview';
$route['deductions']='home/home/deductions';
$route['expences-deduction']='home/home/expences_deduction';
$route['reports-overview']='home/home/reports_overview';
$route['reports-detail-view']='home/home/reports_detail_view';
$route['administration']='home/home/administration';









// -------------- Admin Backend -----------

$route['admin'] = 'login/auth/login';
$route['admin/login'] = 'login/auth/login';
$route['admin/login-admin'] = 'login/auth/login_admin';
$route['admin/logout'] = 'login/auth/logout';

$route['admin/dashboard'] = 'dashboard';
$route['admin/banner'] = 'banner/banner';
$route['admin/add-banner'] = 'banner/add_banner';
$route['admin/update-banner'] = 'banner/updatebanner';
$route['admin/delete-banner'] = 'banner/deletebanner';

$route['admin/profile'] = 'login/auth/admin_profile';
$route['admin/update-profile'] = 'login/auth/update_profile';
$route['admin/change-password'] = 'login/auth/admin_change_password';
$route['admin/update-password'] = 'login/auth/admin_update_password';

$route['admin/users'] = 'admin/admin/users';
$route['admin/experts-users'] = 'admin/admin/experts_users';
$route['admin/company-users'] = 'admin/admin/company_users';

// $route['admin/profile/(:any)/(:any)'] = 'admin/admin/users_profile/$1/$2';

$route['admin/experts/(:any)/(:any)'] = 'admin/admin/users_experts/$1/$2';
$route['admin/company/(:any)/(:any)'] = 'admin/admin/users_company/$1/$2';

$route['admin/users-enable'] = 'admin/admin/users_enabled';
$route['admin/users-status'] = 'admin/admin/users_status';
$route['admin/edit-profile/(:any)/(:any)'] = 'admin/admin/edit_users_profile/$1/$2';
$route['admin/save-profile'] = 'admin/admin/save_users_profile';
$route['admin/users-delete-account'] = 'admin/admin/users_delete_account';

$route['admin/users-approve-account'] = 'admin/admin/users_approve_account';

// Application Area
$route['admin/application-area'] = 'admin/admin/application_area';
$route['admin/add-application-area'] = 'admin/admin/add_application_area';
$route['admin/save-application-area'] = 'admin/admin/save_application_area';
$route['admin/delete-application-area'] = 'admin/admin/delete_application_area';


// physics experience
$route['admin/physics-experience'] = 'admin/admin/physics_experience';
$route['admin/add-physics-experience'] = 'admin/admin/add_physics_experience';
$route['admin/save-physics-experience'] = 'admin/admin/save_physics_experience';
$route['admin/delete-physics-experience'] = 'admin/admin/delete_physics_experience';

// Project Length
$route['admin/project-length'] = 'admin/admin/project_length';
$route['admin/add-project-length'] = 'admin/admin/add_project_length';
$route['admin/save-project-length'] = 'admin/admin/save_project_length';
$route['admin/delete-project-length'] = 'admin/admin/delete_project_length';


// Project visibility
$route['admin/project-visibility'] = 'admin/admin/project_visibility';
$route['admin/add-project-visibility'] = 'admin/admin/add_project_visibility';
$route['admin/save-project-visibility'] = 'admin/admin/save_project_visibility';
$route['admin/delete-project-visibility'] = 'admin/admin/delete_project_visibility';


// Research Development
$route['admin/research-development'] = 'admin/admin/research_development_experience';
$route['admin/add-research-development'] = 'admin/admin/add_research_development_experience';
$route['admin/save-research-development'] = 'admin/admin/save_research_development_experience';
$route['admin/delete-research-development'] = 'admin/admin/delete_research_development_experience';

// Project simulations experience
$route['admin/simulations-experience'] = 'admin/admin/simulations_experience';
$route['admin/add-simulations-experience'] = 'admin/admin/add_simulations_experience';
$route['admin/save-simulations-experience'] = 'admin/admin/save_simulations_experience';
$route['admin/delete-simulations-experience'] = 'admin/admin/delete_simulations_experience';


// Project software experience
$route['admin/software-experience'] = 'admin/admin/software_experience';
$route['admin/add-software-experience'] = 'admin/admin/add_software_experience';
$route['admin/save-software-experience'] = 'admin/admin/save_software_experience';
$route['admin/delete-software-experience'] = 'admin/admin/delete_software_experience';


// Project soft skill
$route['admin/soft-skill'] = 'admin/admin/soft_skill';
$route['admin/add-soft-skill'] = 'admin/admin/add_soft_skill';
$route['admin/save-soft-skill'] = 'admin/admin/save_soft_skill';
$route['admin/delete-soft-skill'] = 'admin/admin/delete_soft_skill';


//  timezone
$route['admin/timezone'] = 'admin/admin/timezone';
$route['admin/add-timezone'] = 'admin/admin/add_timezone';
$route['admin/save-timezone'] = 'admin/admin/save_timezone';
$route['admin/delete-timezone'] = 'admin/admin/delete_timezone';

//  industry
$route['admin/industry'] = 'admin/admin/industry';
$route['admin/add-industry'] = 'admin/admin/add_industry';
$route['admin/save-industry'] = 'admin/admin/save_industry';
$route['admin/delete-industry'] = 'admin/admin/delete_industry';


//  type_of_work
$route['admin/work'] = 'admin/admin/work';
$route['admin/add-work'] = 'admin/admin/add_work';
$route['admin/save-work'] = 'admin/admin/save_work';
$route['admin/delete-work'] = 'admin/admin/delete_work';

//  language
$route['admin/language'] = 'admin/admin/language';
$route['admin/add-language'] = 'admin/admin/add_language';
$route['admin/save-language'] = 'admin/admin/save_language';
$route['admin/delete-language'] = 'admin/admin/delete_language';

// language-proficiency

$route['admin/language-proficiency'] = 'admin/admin/language_proficiency';
$route['admin/add-language-proficiency'] = 'admin/admin/add_language_proficiency';
$route['admin/save-language-proficiency'] = 'admin/admin/save_language_proficiency';
$route['admin/delete-language-proficiency'] = 'admin/admin/delete_language_proficiency';

//  degree
$route['admin/degree'] = 'admin/admin/degree';
$route['admin/add-degree'] = 'admin/admin/add_degree';
$route['admin/save-degree'] = 'admin/admin/save_degree';
$route['admin/delete-degree'] = 'admin/admin/delete_degree';

$route['admin/project-setings'] = 'admin/admin/project_setings';
$route['admin/save-project-setings'] = 'admin/admin/save_project_setings';

// projects
$route['admin/jobs'] = 'projects/project';
$route['admin/pending-jobs'] = 'projects/project/pending_jobs';
$route['admin/approved-jobs'] = 'projects/project/approved_jobs';
$route['admin/rejected-jobs'] = 'projects/project/rejected_jobs';

$route['admin/job-detail/(:any)/(:any)'] = 'projects/project/job_detail/$1/$2';

$route['admin/project-approve'] = 'projects/project/project_approve';
$route['admin/project-reject'] = 'projects/project/project_reject';


$route['admin/paanduv-test'] = 'admin/admin/paanduv_test';
$route['admin/paanduv-test-link'] = 'admin/admin/paanduv_test_link';
$route['admin/paanduv-test-pass-mark'] = 'admin/admin/paanduv_test_pass_mark';

// $route['admin/paanduv-test-pass-mark'] = 'admin/admin/paanduv_test_pass_mark';

//  Blog
$route['admin/blog'] = 'blog/blog';
$route['admin/add-blog'] = 'blog/blog/add_blog';
$route['admin/save-blog'] = 'blog/blog/save_blog';
$route['admin/view-blog/(:any)'] = 'blog/blog/view_blog/$1';
$route['admin/edit-blog/(:any)'] = 'blog/blog/edit_blog/$1';
$route['admin/save-edit-blog'] = 'blog/blog/save_edit_blog';
$route['admin/delete-blog'] = 'blog/blog/delete_blog';


$route['admin/newsletters'] = 'admin/admin/newsletters_subscription';

//  degree
$route['admin/client-say'] = 'clientsay/clientsay';
$route['admin/add-client-say'] = 'clientsay/clientsay/add_clientsay';
$route['admin/save-client-say'] = 'clientsay/clientsay/save_clientsay';
// $route['admin/view-client-say/(:any)'] = 'clientsay/clientsay/view_clientsay/$1';
$route['admin/edit-client-say/(:any)'] = 'clientsay/clientsay/edit_clientsay/$1';
$route['admin/save-edit-client-say'] = 'clientsay/clientsay/save_edit_clientsay';
$route['admin/delete-client-say'] = 'clientsay/clientsay/delete_clientsay';

$route['admin/save-client-say-title'] = 'clientsay/clientsay/client_say_title';

//  degree
$route['admin/talent-agency'] = 'talentagency/talentagency';
$route['admin/add-talent-agency'] = 'talentagency/talentagency/add_talentagency';
$route['admin/save-talent-agency'] = 'talentagency/talentagency/save_talentagency';
// $route['admin/view-talent-agency/(:any)'] = 'talentagency/talentagency/view_talentagency/$1';
$route['admin/edit-talent-agency/(:any)'] = 'talentagency/talentagency/edit_talentagency/$1';
$route['admin/save-edit-talent-agency'] = 'talentagency/talentagency/save_edit_talentagency';
$route['admin/delete-talent-agency'] = 'talentagency/talentagency/delete_talentagency';

$route['admin/talent-agency-title'] = 'talentagency/talentagency/talent_agency_title';



//  degree
$route['admin/trusted-brand'] = 'trustedbrand/trustedbrand';
$route['admin/save-trusted-brand'] = 'trustedbrand/trustedbrand/save_trustedbrand';
$route['admin/delete-trusted-brand'] = 'trustedbrand/trustedbrand/delete_trustedbrand';

$route['admin/trusted-brand-title'] = 'trustedbrand/trustedbrand/trusted_brand_title';

//  Blog
$route['admin/publication'] = 'publication/publication';
$route['admin/add-publication'] = 'publication/publication/add_publication';
$route['admin/save-publication'] = 'publication/publication/save_publication';
$route['admin/view-publication/(:any)'] = 'publication/publication/view_publication/$1';
$route['admin/edit-publication/(:any)'] = 'publication/publication/edit_publication/$1';
$route['admin/save-edit-publication'] = 'publication/publication/save_edit_publication';
$route['admin/delete-publication'] = 'publication/publication/delete_publication';

$route['admin/save-publication-title'] = 'publication/publication/save_publication_title';


//  transaction
$route['admin/transaction-history/(:any)/(:any)'] = 'admin/admin/transaction_history/$1/$2';
$route['admin/profile-for-payout'] = 'admin/admin/profile_for_payout';
$route['admin/usd-payout-transfer']='admin/admin/usd_payout_transfer';

$route['admin/inr-payout-transfer']='admin/admin/inr_payout_transfer';

// $route['admin/save-trusted-brand'] = 'trustedbrand/trustedbrand/save_trustedbrand';
// $route['admin/delete-trusted-brand'] = 'trustedbrand/trustedbrand/delete_trustedbrand';




//  Blog
$route['admin/why-choose'] = 'admin/admin/why_choose';
$route['admin/get-whychoose-detail'] = 'admin/admin/get_why_choose_detail';
$route['admin/save-whychoose'] = 'admin/admin/save_why_choose';

$route['admin/save-whychoose-title'] = 'admin/admin/save_whychoose_title';


$route['admin/how-we-work'] = 'admin/admin/how_we_work';
$route['admin/save-how-we-work'] = 'admin/admin/save_how_we_work';

$route['admin/map-title'] = 'admin/admin/map_title';
$route['admin/save-map-title'] = 'admin/admin/save_map_title';




$route['admin/category'] = 'category/category/get_category';
$route['admin/category/(:any)'] = 'category/category/get_subcategory/$1/$2';
 
$route['admin/add-category'] = 'category/category/add_category';
$route['admin/edit-category'] = 'category/category/update_category';
$route['admin/delete-category'] = 'category/category/delete_category';


$route['admin/brand'] = 'carinfo/carinfo/get_car_info';
$route['admin/model/(:any)/(:any)'] = 'carinfo/carinfo/get_car_model/$1/$2';
$route['admin/year-series/(:any)/(:any)'] = 'carinfo/carinfo/get_car_year_series/$1/$2';

$route['admin/carinfo/(:any)/(:any)'] = 'carinfo/carinfo/get_subcarinfo/$1/$2'; 


$route['admin/add-carinfo'] = 'carinfo/carinfo/add_carinfo';
$route['admin/edit-carinfo'] = 'carinfo/carinfo/update_carinfo';
$route['admin/delete-carinfo'] = 'carinfo/carinfo/delete_carinfo';

$route['admin/car-list/(:any)/(:any)'] = 'admin/admin/get_car_list/$1/$2'; 
$route['admin/delete-user-car'] = 'admin/admin/delete_user_car'; 





$route['admin/template-request'] = 'admin/admin/template_request';
$route['admin/view-order/(:any)/(:any)'] = 'admin/admin/view_template_purchse_request/$1/$2';

$route['admin/change-order-status'] = 'admin/admin/change_order_status';


$route['admin/home-page'] = 'admin/admin/home_page_contents';
$route['admin/save-home-page'] = 'admin/admin/save_home_page_content';

$route['admin/page-settings'] = 'admin/admin/page_settings';
$route['admin/save-page-settings'] = 'admin/admin/save_page_settings';


$route['admin/testimonials'] = 'testimonials/testimonials/view_testimonials';
$route['admin/add-testimonial'] = 'testimonials/testimonials/add_testimonial';
$route['admin/save-testimonial'] = 'testimonials/testimonials/save_testimonial';

$route['admin/edit-testimonial/(:any)'] = 'testimonials/testimonials/edit_testimonial/$1';
$route['admin/update-testimonial'] = 'testimonials/testimonials/update_testimonial';

$route['admin/delete-testimonial'] = 'testimonials/testimonials/delete_testimonial';
// -------------- Category ----------------------------

// ----------------------------------- footer Menu ---------------------------------

$route['admin/about-paanduv'] = 'footer/footer/conpany_informtion/about_paanduv/PAANDUVABOUT01';
$route['admin/how-paanduv-work'] = 'footer/footer/conpany_informtion/how_paanduv_work/PAANDUVABOUT02';
$route['admin/why-paanduv'] = 'footer/footer/conpany_informtion/why_paanduv/PAANDUVABOUT03';
$route['admin/work-agreement'] = 'footer/footer/conpany_informtion/work_agreement/PAANDUVABOUT04';
$route['admin/payment-protection'] = 'footer/footer/conpany_informtion/payment_protection/PAANDUVABOUT05';
$route['admin/pricing'] = 'footer/footer/conpany_informtion/pricing/PAANDUVABOUT06';

$route['admin/company-info/(:any)/(:any)'] = 'footer/footer/edit_company_info/$1/$2';
$route['admin/save-company-info'] = 'footer/footer/save_company_info';

// ================================================================================

$route['admin/employer-membership'] = 'admin/admin/employer_membership_plan';
$route['admin/add-employer-membership'] = 'admin/admin/add_employer_membership_plan';
$route['admin/save-employer-membership'] = 'admin/admin/save_employer_membership_plan';
$route['admin/delete-employer-membership'] = 'admin/admin/delete_employer_membership_plan';

$route['admin/expert-membership'] = 'admin/admin/expert_membership_plan';
$route['admin/add-expert-membership'] = 'admin/admin/add_expert_membership_plan';
$route['admin/save-expert-membership'] = 'admin/admin/save_expert_membership_plan';
$route['admin/delete-expert-membership'] = 'admin/admin/delete_expert_membership_plan';

$route['admin/paanduv-service-fee'] = 'admin/admin/paanduv_service_fee';
$route['admin/save-paanduv-service-fee'] = 'admin/admin/save_paanduv_service_fee';

$route['admin/footer'] = 'webfooter/webfooter';
$route['admin/add-footer-page/(:any)'] = 'webfooter/webfooter/add_footer_page/$1';
$route['admin/save-footer-page'] = 'webfooter/webfooter/save_footer_page';

$route['admin/save-footer-title'] = 'webfooter/webfooter/save_footer_title';

$route['admin/edit-footer-page/(:any)'] = 'webfooter/webfooter/edit_footer_page/$1';
$route['admin/save-edit-footer-page'] = 'webfooter/webfooter/save_edit_footer_page';
$route['admin/delete-footer-page'] = 'webfooter/webfooter/delete_footer_page';

$route['page/(:any)/(:any)'] = 'home/home/view_dynamic_pages/$1/$2';

$route['admin/social-icon'] = 'webfooter/webfooter/social_icon';
$route['admin/add-social-icon'] = 'webfooter/webfooter/add_social_icon';
$route['admin/save-social-icon'] = 'webfooter/webfooter/save_social_icon';
$route['admin/delete-social-icon'] = 'webfooter/webfooter/delete_social_icon';

// $route['admin/save-paanduv-service-fee'] = 'webfooter/webfooter/save_paanduv_service_fee';


// ---------------------------------------------------------------------------------
//  Outer profile.

$route['profile/(:any)'] = 'profile/profile/get_profile/$1';
$route['profile/expert/(:any)/(:any)'] = 'profile/profile/get_exprty_profile/$1/$2';
$route['profile/company/(:any)/(:any)'] = 'profile/profile/get_company_profile/$1/$2';
$route['company/not-found/(:any)'] = 'profile/profile/profile_not_found/$1';


// ------ Payment gateway integratiuon ---------

$route['experts/membership-payment']='payment/payment/payment_expert_membership_plan';
// Indian  Payment Success
$route['experts/expert-membership-payment-success']='payment/payment/expert_membership_payment_success';


$route['company/membership-payment']='payment/payment/payment_company_membership_plan';
// Indian  Payment Success
$route['company/company-membership-payment-success']='payment/payment/company_membership_payment_success';



$route['experts/purchase-bid-payment']='payment/payment/payment_expert_purchase_bid';
$route['experts/purchase-bid-payment-success']='payment/payment/payment_expert_purchase_bid_success';
$route['bids-history']='experts/experts/bids_history';
// // Indian  Payment Success
// $route['experts/expert-purchase-bid-payment-success']='payment/payment/expert_purchase-bid_payment_success';





// $route['experts/membership-payment']='payment/payment/payment_membership_account';
// $route['experts/membership-payment-converter']='payment/payment/membership_payment_converter';

// $route['experts/paypal-payment-form/(:any)']='payment/payment/paypal_payment_form/$1';
// $route['experts/success-membership-payment']='payment/payment/success_membership_payment';



// -------- Company ----------------------------

$route['failure-payment-view']='payment/payment/failure_payment_view';
$route['cancel-payment-view']='payment/payment/cancel_payment_view';


// $route['company/membership-payment']='payment/payment/payment_membership_account';
// $route['company/paypal-payment-form/(:any)']='payment/payment/paypal_payment_form/$1';
// $route['company/success-membership-payment']='payment/payment/success_membership_payment';


$route['company/project-payment']='payment/payment/project_cost_payment';
$route['company/success-project-payment']='payment/payment/success_project_cost_payment';
$route['company/project-milestone-payment']='payment/payment/project_milestone_payment';

$route['company/success-payment-view/(:any)']='payment/payment/success_payment_view/$1';


$route['admin/payout-transfer']='payment/payment/expert_payout_transfer';



$route['testing-payumoney']='payment/payment/tseting_payumoney';
// $route['check-payumoney']='payment/payment/checking_payumoney';
$route['check-payumoney-status']='payment/payment/checking_payumoney_status';


// --------------------- Chatting -----------------------------

$route['chat-profile']='chat/chat';
$route['chat-register']='chat/chat/create_profile';


// $route['company/success-project-payment']='payment/payment/success_project_cost_payment';
// $route['company/project-milestone-payment']='payment/payment/project_milestone_payment';



// --------------------- Contents ------------------------

//  banner
$route['admin/home-banner'] = 'admin/admin/home_banner';
$route['admin/save-home-banner'] = 'admin/admin/save_home_banner';

$route['admin/meet-talents'] = 'admin/admin/meet_the_talents';
$route['admin/talent-selection'] = 'admin/admin/save_talent_selection';


$route['(:any)'] = 'pages/view/$1'; 


