<?php
$direct_dir_name = $file_dir_name = dirname(__FILE__);
include("$file_dir_name/crm_start.php");
$objme = AfwSession::getUserConnected();
$customerMe = AfwSession::getCustomerConnected();
if($objme)
{
        
        // اذا عند احدى هذه الصلاحيات يدخل كموظف 
        // التحقيق والرد على طلبات العملاء 
        // مشرف تنسيق
        // إدخال الطلبات الالكترونية التي تصل عبر الهاتف

        $objme_has_crm_employee_role = 
        (($objme->hasRole("crm", CrmObject::$AROLE_OF_INVESTIGATOR)) or 
         ($objme->hasRole("crm", CrmObject::$AROLE_OF_REQUEST_ENTER)) or 
         ($objme->hasRole("crm", CrmObject::$AROLE_OF_SUPERVISOR))
        
        );


        if($objme->isSuperAdmin())
        {
                $Main_Page = "monitoring.php";
                $My_Module = "crm";
                /*
                $cl = "Request";
                $currmod="crm";
                */
                unset($_POST);
                unset($_GET);
                $customerMe = null;
        
                include("$file_dir_name/../lib/afw/afw_main_page.php");
        }
        elseif($objme_has_crm_employee_role)
        {
                $Main_Page = "workbox.php";
                $My_Module = "crm";
                /*
                $cl = "Request";
                $currmod="crm";
                */
                $customerMe = null;
                unset($_POST);
                unset($_GET);

                // AfwRunHelper::simpleError("System under maintenance. contactez RB");
        
                include("$file_dir_name/../lib/afw/afw_main_page.php");
        }
        else
        {
                die($objme->getVal("firstname")." : ".$objme->tm("Your are registered now, you can contact your administrator to give you privileges")."<br>". $objme->tm("You need also approval from your direct manager for this")." <br> user name : [".$objme->getVal("username")."]");
        }
        
        
        /*
        $force_allow_access_to_customers = true; 
        $Direct_Page = "main_menu.php";
        
        include("$file_dir_name/../lib/afw/afw_direct_page.php");*/
}
elseif($customerMe)  // يدخل كعميل
{
        $controllerName = "Crm";
        $methodName = "myrequests";

        $file_dir_name = dirname(__FILE__);
        include("$file_dir_name/../crm/i.php");
}
else
{
        include("$file_dir_name/../crm/customer_login.php");
}
