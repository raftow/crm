<?php
$direct_dir_name = $file_dir_name = dirname(__FILE__);
include("$file_dir_name/crm_start.php");
$objme = AfwSession::getUserConnected();
$customerMe = AfwSession::getCustomerConnected();
if ($objme) {
        if ($objme->isSuperAdmin()) {
                if ($_GET["uao"] == 1) {
                        $company = AfwSession::currentCompany();
                        $file_dir_name = dirname(__FILE__);
                        if (file_exists("$file_dir_name/../client-$company/organization_business.php")) {
                                require_once("$file_dir_name/../client-$company/organization_business.php");
                                if (class_exists('OrganizationBusiness')) {
                                        $res = OrganizationBusiness::update_all_organizations();

                                        $error = implode("<br>\n", $res['errors']);
                                        $info = implode("<br>\n", $res['log']);

                                        if ($info) AfwSession::pushInformation($info);
                                        if ($error) AfwSession::pushError($error);
                                }
                        }
                }
                elseif ($_GET["uct"] == 1) {
                        list($error, $info) = CustomerType::reloadAllFromConfig("ar");
                        if ($info) AfwSession::pushInformation($info);
                        if ($error) AfwSession::pushError($error);
                }
        }

        // اذا عند احدى هذه الصلاحيات يدخل كموظف 
        // التحقيق والرد على طلبات العملاء 
        // مشرف تنسيق
        // إدخال الطلبات الالكترونية التي تصل عبر الهاتف

        $objme_has_crm_employee_role =
                (($objme->hasRole("crm", CrmObject::$AROLE_OF_INVESTIGATOR)) or
                        ($objme->hasRole("crm", CrmObject::$AROLE_OF_REQUEST_ENTER)) or
                        ($objme->hasRole("crm", CrmObject::$AROLE_OF_SUPERVISOR))

                );


        if ($objme->isSuperAdmin() or $objme->hasRole("crm", CrmObject::$AROLE_OF_GENERAL_SUPERVISOR)) {
                $Main_Page = "monitoring.php";
                $MODULE = $My_Module = "crm";
                $options = [];
                $options["dashboard-stats"] = true;
                $options["chart-js"] = true;
                AfwMainPage::echoMainPage($My_Module, $Main_Page, $file_dir_name, $options);
        } elseif ($objme_has_crm_employee_role) {
                $file_dir_name = dirname(__FILE__);
                $Main_Page = "workbox.php";
                $MODULE = $My_Module = "crm";
                AfwMainPage::echoMainPage($My_Module, $Main_Page, $file_dir_name);
        } else {
                die($objme->getVal("firstname") . " : " . $objme->tm("Your are registered now, you can contact your administrator to give you privileges") . "<br>" . $objme->tm("You need also approval from your direct manager for this") . " <br> user name : [" . $objme->getVal("username") . "]");
        }


        /*
        $force_allow_access_to_customers = true; 
        $Direct_Page = "main_menu.php";
        
        include("$file_dir_name/../lib/afw/afw_direct_page.php");*/
} elseif ($customerMe)  // يدخل كعميل
{
        $controllerName = "Crm";
        $methodName = "myrequests";

        $file_dir_name = dirname(__FILE__);
        include("$file_dir_name/../crm/i.php");
} else {
        if (AfwSession::wasUser()) {
                include("$file_dir_name/../crm/login.php");
        } else {
                include("$file_dir_name/../crm/customer_login.php");
        }
}
