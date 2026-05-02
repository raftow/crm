<?php

include("crm_start.php");
$objme = AfwSession::getUserConnected();
$customerMe = AfwSession::getCustomerConnected();
// die("objme = $objme , customerMe = $customerMe");
if ($objme) {
        if ($objme->isSuperAdmin()) {
                if ($_GET["uao"] == 1) {
                        $company = AfwSession::currentCompany();
                        if (file_exists(dirname(__FILE__)."/../client-$company/organization_business.php")) {
                                require_once(dirname(__FILE__)."/../client-$company/organization_business.php");
                                if (class_exists('OrganizationBusiness')) {
                                        $res = OrganizationBusiness::update_all_organizations();
                                        $warning = implode("<br>\n", $res['warnings']);
                                        $error = implode("<br>\n", $res['errors']);
                                        $info = implode("<br>\n", $res['log']);

                                        if ($info) AfwSession::pushInformation($info);
                                        if ($error) AfwSession::pushError($error);
                                        if ($warning) AfwSession::pushWarning($warning);
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
                // die("je suis ici 29040001");
                $Main_Page = "monitoring.php";
                $MODULE = $My_Module = "crm";
                $options = [];
                $options["dashboard-stats"] = true;
                $options["chart-js"] = true;
                CmsMainPage::echoMainPage($My_Module, $Main_Page, dirname(__FILE__), $options);
        } elseif ($objme_has_crm_employee_role) {
                $Main_Page = "workbox.php";
                $MODULE = $My_Module = "crm";
                CmsMainPage::echoMainPage($My_Module, $Main_Page, dirname(__FILE__));
        } else {
                die($objme->getVal("firstname") . " : " . $objme->tm("Your are registered now, you can contact your administrator to give you privileges") . "<br>" . $objme->tm("You need also approval from your direct manager for this") . " <br> user name : [" . $objme->getVal("username") . "]");
        }
        
} 
elseif ($customerMe)  // يدخل كعميل
{
        $controllerName = "Crm";
        $methodName = "myrequests";

        include(dirname(__FILE__)."/../crm/i.php");
}
else 
{
        if (AfwSession::wasUser()) {
                include(dirname(__FILE__)."/../crm/login.php");
        } else {
                include(dirname(__FILE__)."/../crm/customer_login.php");
        }
}
