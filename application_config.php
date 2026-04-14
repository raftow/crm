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











        'cust_type_list' => array(1 => ['ar'=>"فرد من المجتمع",     'en'=>"Community member",    'code'=>"community",   'canBecome'=>[3,7,6,8,5  ]],

                                  3 => ['ar'=>"متدرب قطاع حكومي",   'en'=>"Government sector trainee",    'code'=>"trainee-gov",   'canBecome'=>[  7,6,8,5,1]],
                                  7 => ['ar'=>"متدرب كليات التميز", 'en'=>"Colleges of Excellence trainee",    'code'=>"trainee-coe",   'canBecome'=>[3,  6,8,5,1]],
                            8 => ['ar'=>"متدرب شراكات استراتيجية",  'en'=>"Strategic partnerships trainee",    'code'=>"trainee-sp",   'canBecome'=>[3,7,6,  5,1]],
                                  6 => ['ar'=>"متدرب قطاع أهلي",    'en'=>"Private sector trainee",     'code'=>"trainee-pt",   'canBecome'=>[3,7,  8,5,1]],
                                  
                                  4 => ['ar'=>"مدرب",                'en'=>"Trainer",     'code'=>"trainer",  'canBecome'=>[2  ,5,1]],
                                  2 => ['ar'=>"موظف",                'en'=>"Employee",     'code'=>"employee",   'canBecome'=>[  4,5,1]],
                                  5 => ['ar'=>"متعاون من الخارج",   'en'=>"External collaborator",     'code'=>"collaborator",   'canBecome'=>[2,4  ,1]],
                                  ),


        'cust_type_logic' => array(
                3 => [
                        'ref_num' => ['title_ar'=>'الرقم الأكاديمي',    'title_en' => 'Academic number',],
                        'org_name' => ['title_ar'=>'الوحدة التدريبية', 'title_en' => 'Training unit',]
                     ],

                7 => [
                        'ref_num' => ['title_ar'=>'الرقم الأكاديمي',     'title_en' => 'Academic number',],
                        'org_name' => ['title_ar'=>'اسم الكلية',         'title_en' => 'College name',]
                     ],     

                8 => [
                        'ref_num' => ['title_ar'=>'الرقم الأكاديمي',     'title_en' => 'Academic number',],
                        'org_name' => ['title_ar'=>'اسم المعهد أو الأكاديمية', 'title_en' => 'Name of the institute or academy',]
                     ],     

                2 => [
                        'ref_num' => ['title_ar'=>'الرقم الوظيفي',       'title_en' => 'Employee number',],
                        'org_name' => ['title_ar'=>'جهة العمل / الإدارة', 'title_en' => 'Employer / Department',]
                     ], 
                     
                4 => [
                        'ref_num' => ['title_ar'=>'رقم الحاسب',          'title_en' => 'Computer number',],
                        'org_name' => ['title_ar'=>'الوحدة التدريبية',  'title_en' => 'Training unit',]
                     ], 
                     
                5 => [
                        'ref_num' => ['title_ar'=>'رقم الحاسب',          'title_en' => 'Computer number',],
                        'org_name' => ['title_ar'=>'جهة العمل / الإدارة', 'title_en' => 'Employer / Department',]
                     ],      
                                  ),

        'enable_language_switch' => false,
        //  classes params
        /*TravelTemplate_showId =>true, */
        
        'default_controller_name' => "crm",                                  

        /*'simulate_sms_to_mobile' => "0598988330",*/

        'notify_customer' => array("new_request" => array("sms"=>true, "email" => false, "web" => false, "whatsup" => false),
        
                                ),

        'notify_supervisor' => array("new_request" => array("sms"=>true, "email" => true, "web" => false, "whatsup" => false),
        
                        ),

        'notify_employee' => array(
                        "new_request" => array("sms"=>false, "email" => false, "web" => false, "whatsup" => false),
                        "daily_waiting_requests" => array("sms"=>false, "email" => true, "web" => false, "whatsup" => false),
                ),


        'general_company_id' => 1,

        'tasksClassName' => "Request",

        'consider_user_as_customer' => true,

        'MAX_ROW-request-not-admin' => 200,

        'default_customer_type' =>2,

        'LOGO_APP_HEIGHT' => 66,

        'register_file' => "customer_register",

        );

