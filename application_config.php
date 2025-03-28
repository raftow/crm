<?php
$config_arr = array(
        'application_id' => 1073,
        'crm_application_id' => 1073,
        'application_code' => 'crm',
		'main_module' => 'crm',

        // roClassName => Booking,

        'x_module_means_company'=>false,


        'crm_responder' => "مكتب خدمة العملاء",
        //'crm_responder' => "اللجنة التنظيمية",
        
        'application_name' => ['ar' => "مركز خدمة العملاء", 'en' => "Customer  Service Center",],
        'crm-application-name' => ['ar' => "تواصل معنا", 'en' => "Contact us",],
                 
        

        // ,

        'no_menu_for_login' => true,

        /*'cust_type_list' => array(1=>"مسافر",
                                3=> "مالك باصات",
                                4=>"مالك فنادق",
                                5=>"مكتب رحلات"),*/

        'cust_type_list' => array(1 => "فرد من المجتمع",
                                  2 => "موظف",
                                  3 => "متدرب",
                                  4 => "مدرب",
                                  5 => "متعاون من الخارج",
                                  ),

        'enable_language_switch' => false,
        //  classes params
        /*TravelTemplate_showId =>true, */
        
        'default_controller_name' => "crm",                                  

        'simulate_sms_to_mobile' => "0598988330",

        'notify_customer' => array("new_request" => array("sms"=>true, "email" => false, "web" => false, "whatsup" => false),
        
                                ),

        'notify_supervisor' => array("new_request" => array("sms"=>true, "email" => false, "web" => true, "whatsup" => false),
        
                        ),

        'notify_employee' => array("new_request" => array("sms"=>true, "email" => false, "web" => true, "whatsup" => false),
        
                ),


        'general_company_id' => 1,

        'tasksClassName' => "Request",

        'consider_user_as_customer' => true,

        'MAX_ROW-request-not-admin' => 200,

        'default_customer_type' =>2,

        'LOGO_APP_HEIGHT' => 66,

        'register_file' => "customer_register",

        );

