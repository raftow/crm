<?php

class CrmObject extends AfwMomkenObject
{

        public static $CRM_CENTER_ID = 70;

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

        // إدارة البيانات المرجعية للنظام
        public static $AROLE_OF_GENERAL_SUPERVISOR = 376;
        
        public static $objCRMCenter = null;

        public static function getGlobalCRMCenter()
        {
                if(!self::$objCRMCenter) self::$objCRMCenter = CrmOrgunit::loadByMainIndex(self::$CRM_CENTER_ID);

                return self::$objCRMCenter;
        }


        public static function userIsSupervisor($auser = null)
        {
                if (!$auser) $auser = AfwSession::getUserConnected();
                if (!$auser) return 0;

                $employee_id = $auser->getEmployeeId();
                if (!$employee_id) return 0;

                return CrmEmployee::isAdmin($employee_id);
        }

        public static function userIsGeneralSupervisor($auser = null)
        {
                if (!$auser) $auser = AfwSession::getUserConnected();
                if (!$auser) return 0;

                $employee_id = $auser->getEmployeeId();
                if (!$employee_id) return 0;

                return CrmEmployee::isGeneralAdmin($employee_id);
        }

        public static function userIsSuperAdmin($auser = null)
        {
                if (!$auser) $auser = AfwSession::getUserConnected();
                if (!$auser) return false;
                return $auser->isSuperAdmin();
        }


        public function fld_CREATION_USER_ID()
        {
                return "created_by";
        }

        public function fld_CREATION_DATE()
        {
                return "created_at";
        }

        public function fld_UPDATE_USER_ID()
        {
                return "updated_by";
        }

        public function fld_UPDATE_DATE()
        {
                return "updated_at";
        }

        public function fld_VALIDATION_USER_ID()
        {
                return "validated_by";
        }

        public function fld_VALIDATION_DATE()
        {
                return "validated_at";
        }

        public function fld_VERSION()
        {
                return "version";
        }

        public function fld_ACTIVE()
        {
                return  "active";
        }

        public function isTechField($attribute)
        {
                return (($attribute == "created_by") or ($attribute == "created_at") or ($attribute == "updated_by") or ($attribute == "updated_at") or ($attribute == "validated_by") or ($attribute == "validated_at") or ($attribute == "version"));
        }

        
        public static function code_of_customer_type_id($lkp_id=null)
        {
            $lang = AfwLanguageHelper::getGlobalLanguage();
            if($lkp_id) return self::customer_type()['code'][$lkp_id];
            else return self::customer_type()['code'];
        }

        public static function name_of_customer_type_id($customer_type_id, $lang="ar")
        {
            return self::customer_type()[$lang][$customer_type_id];            
        }


        public static function list_of_customer_type_id($lang = null)
        {
            if(!$lang) $lang = AfwLanguageHelper::getGlobalLanguage();
            return self::customer_type()[$lang];
        }
        
        public static function customer_type()
        {
                $arr_list_of_customer_type = array();
                
                $custTypeListDefault = array(1=>['ar'=>"عميل"]);
                $custTypeList = AfwSession::config("cust_type_list", $custTypeListDefault);
                        
                foreach($custTypeList as $idct => $custTypeRow)
                {
                        $arr_list_of_customer_type["code"][$idct] = "CT".$idct;
                        $arr_list_of_customer_type["ar"][$idct] = $custTypeRow['ar'];
                        $arr_list_of_customer_type["en"][$idct] = $custTypeRow['en'];
                }
                
                return $arr_list_of_customer_type;
        }


        public static function calcCrmDate_start_satisfaction()
        {
                $period = CrmOrgunit::getGlobalCRMCenter()->getVal("satisfaction_stats_days");
                return AfwDateHelper::shiftHijriDate("", -$period);
        }

        public static function calcCrmDate_start_satisfaction_greg()
        {
                $period = CrmOrgunit::getGlobalCRMCenter()->getVal("satisfaction_stats_days");
                return AfwDateHelper::shiftGregDate("", -$period);
        }

        public static function calcCrmDate_end_satisfaction()
        {
                return AfwDateHelper::shiftHijriDate("", -1);
        }

        public static function calcCrmDate_end_satisfaction_greg()
        {
                return AfwDateHelper::shiftGregDate("", -1);
        }



        public static function color_of_who($lkp_id=null)
        {
            if($lkp_id) return self::who()['color'][$lkp_id];
            else return self::who()['color'];
        }

        public static function code_of_who_enum($lkp_id=null)
        {
            if($lkp_id) return self::who()['code'][$lkp_id];
            else return self::who()['code'];
        }

        public static function name_of_who_enum($who_enum, $lang="ar")
        {
            return self::who()[$lang][$who_enum];            
        }


        public static function list_of_who_enum($lang = null)
        {
            if(!$lang) $lang = AfwLanguageHelper::getGlobalLanguage();
            return self::who()[$lang];
        }
        
        public static function who()
        {
                $arr_list_of_who = array();
        
                $arr_list_of_who['color'][1] = 'white';
                $arr_list_of_who['code'][1] = 'archive';
                $arr_list_of_who['ar'][1] = 'في الأرشيف';
                $arr_list_of_who['en'][1] = 'In archive';
        
                $arr_list_of_who['color'][2] = 'green';
                $arr_list_of_who['code'][2] = 'customer';
                $arr_list_of_who['ar'][2] = 'عند العميل';
                $arr_list_of_who['en'][2] = 'With customer';
        
                $arr_list_of_who['color'][3] = 'blue';
                $arr_list_of_who['code'][3] = 'supervisor';
                $arr_list_of_who['en'][3] = 'With supervisor';
                $arr_list_of_who['ar'][3] = 'عند المشرف';
        
                $arr_list_of_who['color'][4] = 'gold';
                $arr_list_of_who['code'][4] = 'employee';
                $arr_list_of_who['en'][4] = 'With employee';
                $arr_list_of_who['ar'][4] = 'عند الموظف';
        
                return $arr_list_of_who;

        }


        public static function code_of_user_type($lkp_id=null)
        {
            $lang = AfwLanguageHelper::getGlobalLanguage();
            if($lkp_id) return self::user_type()['code'][$lkp_id];
            else return self::user_type()['code'];
        }

        public static function name_of_user_type($user_type, $lang="ar")
        {
            return self::user_type()[$lang][$user_type];            
        }


        public static function list_of_user_type($lang = null)
        {
            if(!$lang) $lang = AfwLanguageHelper::getGlobalLanguage();
            return self::user_type()[$lang];
        }
        
        public static function user_type()
        {
                $arr_list_of_who = array();
        
                $arr_list_of_who['code'][1] = 'employee';
                $arr_list_of_who['ar'][1] = 'موظف';
                $arr_list_of_who['en'][1] = 'employee';
        
                $arr_list_of_who['code'][2] = 'approved-employee';
                $arr_list_of_who['ar'][2] = 'موظف محترف';
                $arr_list_of_who['en'][2] = 'approved employee';
        
                $arr_list_of_who['code'][3] = 'supervisor';
                $arr_list_of_who['en'][3] = 'supervisor';
                $arr_list_of_who['ar'][3] = 'مشرف';

                $arr_list_of_who['code'][4] = 'manager';
                $arr_list_of_who['en'][4] = 'manager';
                $arr_list_of_who['ar'][4] = 'مدير';
        
                return $arr_list_of_who;

        }
}
