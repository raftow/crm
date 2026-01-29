<?php
class CrmRequestStatusAfwStructure
{

        // token separator = §
        public static function initInstance(&$obj)
        {
                if ($obj instanceof RequestStatus) {
                        $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                        $obj->DISPLAY_FIELD_BY_LANG = ['ar' => "request_status_name_ar", 'en' => "request_status_name_en"];

                        // $obj->ENABLE_DISPLAY_MODE_IN_QEDIT=true;
                        $obj->ORDER_BY_FIELDS = "who_enum, lookup_code";
                        $obj->IS_LOOKUP = true;
                        $obj->public_display = true;
                        $obj->ENABLE_DISPLAY_MODE_IN_QEDIT = true;
                        $obj->showQeditErrors = true;
                        // $obj->AUDIT_DATA = true;
                        $obj->ignore_insert_doublon = true;
                        $obj->UNIQUE_KEY = array('lookup_code');
                        $obj->editByStep = false;
                        $obj->editNbSteps = 0;
                        
                        $obj->showRetrieveErrors = true;
                        $obj->general_check_errors = true;
                        // $obj->after_save_edit = array("class"=>'RequestStatus',"attribute"=>'xxxx_id', "currmod"=>'crm',"currstep"=>2);
                        $obj->after_save_edit = array("mode" => "qsearch", "currmod" => 'crm', "class" => 'RequestStatus', "submit" => true);
                } else {
                        RequestStatusArTranslator::initData();
                        RequestStatusEnTranslator::initData();
                }
        }

        public static $DB_STRUCTURE = array(


                'id' => array(
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'TYPE' => 'PK',
                        'SEARCH-BY-ONE' => '',
                        'DISPLAY' => true,
                        'STEP' => 1,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                ),

                /*
                'who' => array(
                        'SHOW' => true,
                        'EDIT' => true,
                        'RETRIEVE' => true,
                        'SIZE' => 60,
                        'MANDATORY' => false,
                        'UTF8' => false,
                        'CATEGORY' => 'FORMULA',
                        'READONLY' => true,
                        'CSS' => 'width_pct_50',
                        'TYPE' => 'TEXT',
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                ),*/

                'who_enum' => array(
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'DEFAUT' => 1,
			'SIZE' => 32,
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'ENUM',
			'ANSWER' => 'FUNCTION',
			'READONLY' => false,
			'EDIT-SHORT-LIST' => true,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
                        'CSS' => 'width_pct_50',
		),

                'lookup_code' => array(
                        'TYPE' => 'TEXT',
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'SIZE' => 64,
                        'QEDIT' => true,
                        'SHORTNAME' => 'code',
                        'SEARCH-BY-ONE' => '',
                        'DISPLAY' => true,
                        'STEP' => 1,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                ),

                'request_status_name_ar' => array(
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => 32,
                        'QSIZE' => 32,
                        'MIN-SIZE' => 5,
                        'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE',
                        'MANDATORY' => true,
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'READONLY' => false,
                        'SEARCH-BY-ONE' => true,
                        'DISPLAY' => true,
                        'STEP' => 1,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'ERROR-CHECK' => true,
                ),

                'request_status_name_en' => array(
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => 32,
                        'QSIZE' => 32,
                        'MIN-SIZE' => 5,
                        'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
                        'MANDATORY' => true,
                        'UTF8' => false,
                        'TYPE' => 'TEXT',
                        'READONLY' => false,
                        'SEARCH-BY-ONE' => true,
                        'DISPLAY' => true,
                        'STEP' => 1,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'ERROR-CHECK' => true,
                ),


                'customer_status_name_ar' => array(
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => 32,
                        'QSIZE' => 32,
                        'MIN-SIZE' => 5,
                        'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE',
                        'MANDATORY' => true,
                        'UTF8' => true,
                        'TYPE' => 'TEXT',
                        'READONLY' => false,
                        'SEARCH-BY-ONE' => true,
                        'DISPLAY' => true,
                        'STEP' => 1,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'ERROR-CHECK' => true,
                ),

                'customer_status_name_en' => array(
                        'SEARCH' => true,
                        'QSEARCH' => true,
                        'SHOW' => true,
                        'RETRIEVE' => true,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => 32,
                        'QSIZE' => 32,
                        'MIN-SIZE' => 5,
                        'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
                        'MANDATORY' => true,
                        'UTF8' => false,
                        'TYPE' => 'TEXT',
                        'READONLY' => false,
                        'SEARCH-BY-ONE' => true,
                        'DISPLAY' => true,
                        'STEP' => 1,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'ERROR-CHECK' => true,
                ),


                'response_type_mfk' => array(
                        'SHORTNAME' => 'response_types',
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'EDIT' => true,
                        'QEDIT' => false,
                        'SIZE' => 32,
                        'MANDATORY' => false,
                        'UTF8' => false,
                        'DEFAUT' => ',1,',
                        'TYPE' => 'MFK',
                        'ANSWER' => 'response_type',
                        'ANSMODULE' => 'crm',
                        'READONLY' => false,
                        'SEARCH-BY-ONE' => false,
                        'DISPLAY' => true,
                        'STEP' => 1,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'ERROR-CHECK' => true,
                ),

                'user_type_menum' => array(
                        'SEARCH' => true,
                        'QSEARCH' => false,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'SIZE' => 32,
                        'MANDATORY' => false,
                        'UTF8' => false,
                        'DEFAUT' => ',1,',
                        'TYPE' => 'MENUM',
                        'ANSWER' => 'FUNCTION',
                        'FUNCTION_COL_NAME' => 'user_type',
                        'READONLY' => false,
                        'SEARCH-BY-ONE' => false,
                        'DISPLAY' => true,
                        'STEP' => 1,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                        'ERROR-CHECK' => true,
                ),


                

                'active' => array(
                        'SHOW-ADMIN' => true,
                        'RETRIEVE' => false,
                        'EDIT' => true,
                        'QEDIT' => true,
                        'DEFAUT' => 'Y',
                        'TYPE' => 'YN',
                        'SEARCH-BY-ONE' => '',
                        'DISPLAY' => '',
                        'STEP' => 1,
                        'DISPLAY-UGROUPS' => '',
                        'EDIT-UGROUPS' => '',
                ),

                'created_by'         => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'TECH_FIELDS-RETRIEVE' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'auser',
                        'ANSMODULE' => 'ums',
                        'FGROUP' => 'tech_fields'
                ),

                'created_at'            => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'TECH_FIELDS-RETRIEVE' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'TYPE' => 'GDAT',
                        'FGROUP' => 'tech_fields'
                ),

                'updated_by'           => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'TECH_FIELDS-RETRIEVE' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'auser',
                        'ANSMODULE' => 'ums',
                        'FGROUP' => 'tech_fields'
                ),

                'updated_at'              => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'TECH_FIELDS-RETRIEVE' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'TYPE' => 'GDAT',
                        'FGROUP' => 'tech_fields'
                ),

                'validated_by'       => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'TYPE' => 'FK',
                        'ANSWER' => 'auser',
                        'ANSMODULE' => 'ums',
                        'FGROUP' => 'tech_fields'
                ),

                'validated_at'          => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'TYPE' => 'GDAT',
                        'FGROUP' => 'tech_fields'
                ),

                /* 'active'                   => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => true, 
                                                                'QEDIT' => true, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),*/

                'version'                  => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'TYPE' => 'INT',
                        'FGROUP' => 'tech_fields'
                ),

                // 'draft'                         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => true, 
                //                                        'QEDIT' => true, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),

                'update_groups_mfk'             => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'ANSWER' => 'ugroup',
                        'ANSMODULE' => 'ums',
                        'TYPE' => 'MFK',
                        'FGROUP' => 'tech_fields'
                ),

                'delete_groups_mfk'             => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'ANSWER' => 'ugroup',
                        'ANSMODULE' => 'ums',
                        'TYPE' => 'MFK',
                        'FGROUP' => 'tech_fields'
                ),

                'display_groups_mfk'            => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'ANSWER' => 'ugroup',
                        'ANSMODULE' => 'ums',
                        'TYPE' => 'MFK',
                        'FGROUP' => 'tech_fields'
                ),

                'sci_id'                        => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'SHOW' => true,
                        'RETRIEVE' => false,
                        'QEDIT' => false,
                        'TYPE' => 'INT', /*stepnum-not-the-object*/
                        'FGROUP' => 'tech_fields'
                ),

                'tech_notes'                         => array(
                        'STEP' => 99,
                        'HIDE_IF_NEW' => true,
                        'TYPE' => 'TEXT',
                        'CATEGORY' => 'FORMULA',
                        "SHOW-ADMIN" => true,
                        'TOKEN_SEP' => "§",
                        'READONLY' => true,
                        "NO-ERROR-CHECK" => true,
                        'FGROUP' => 'tech_fields'
                ),
        );
}
