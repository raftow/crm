<?php

class CrmObject extends AFWObject{

    // إدارة المنتج	إدارة البيانات العامة للنظام
    public static $AROLE_OF_DATA_SITE = 322;
    
    // التحقيق	التحقيق والرد على طلبات العملاء 
    public static $AROLE_OF_INVESTIGATOR = 323;

    // الإشراف على تشغيل نظام خدمة العملاء
    public static $AROLE_OF_SUPERVISOR = 324;

    // إدخال الطلبات الالكترونية التي تصل عبر الهاتف
    public static $AROLE_OF_REQUEST_ENTER = 327;

    // إدارة البيانات المرجعية للنظام
    public static $AROLE_OF_LOOKUPS = 347;


    public static function userConnectedIsSupervisor($objme=null)
    {
        if(!$objme) $objme = AfwSession::getUserConnected();
        if(!$objme) return 0;

        $employee_id = $objme->getEmployeeId();
        if(!$employee_id) return 0;

        return CrmEmployee::isAdmin($employee_id);
    }

    public static function userConnectedIsGeneralSupervisor($objme=null)
    {
        if(!$objme) $objme = AfwSession::getUserConnected();
        if(!$objme) return 0;

        $employee_id = $objme->getEmployeeId();
        if(!$employee_id) return 0;

        return CrmEmployee::isGeneralAdmin($employee_id);
    }

    public static function userConnectedIsSuperAdmin($objme=null)
    {
            if(!$objme) $objme = AfwSession::getUserConnected();
            if(!$objme) return false;
            return $objme->isSuperAdmin();
    }
	


}