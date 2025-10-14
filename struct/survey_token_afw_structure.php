<?php

class CrmSurveyTokenAfwStructure
 {
    // token separator = §
    public static function initInstance( &$obj )
 {
        if ( $obj instanceof SurveyToken ) 
 {
            $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
            $obj->DISPLAY_FIELD_BY_LANG = [ 'ar'=>'name_ar', 'en'=>'name_en' ];

            // $obj->ENABLE_DISPLAY_MODE_IN_QEDIT = true;
            $obj->ORDER_BY_FIELDS = '';

            $obj->UNIQUE_KEY = array( 'survey_token' );

            $obj->showQeditErrors = true;
            $obj->showRetrieveErrors = true;
            $obj->general_check_errors = true;
            // $obj->after_save_edit = array( 'class'=>'Road', 'attribute'=>'road_id', 'currmod'=>'btb', 'currstep'=>9 );
            $obj->after_save_edit = array( 'mode'=>'qsearch', 'currmod'=>'crm', 'class'=>'SurveyToken', 'submit'=>true );
        } else {
            SurveyTokenArTranslator::initData();
            SurveyTokenEnTranslator::initData();
        }
    }

    public static $DB_STRUCTURE =
    array(
        'id' => array( 'SHOW' => true, 'RETRIEVE' => true, 'EDIT' => false, 'TYPE' => 'PK' ),

        'survey_id' => array(
			'STEP' => 1,
			'SHORTNAME' => 'participant',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EXCEL' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_100',
			'SIZE' => 32,
			'MANDATORY' => true,
			'UTF8' => false,
			'AUTOCOMPLETE' => true,
			'TYPE' => 'FK',
			'ANSWER' => 'survey',
			'ANSMODULE' => 'crm',
			'RELATION' => 'OneToMany',
			"NO-RETURNTO" => true,
			"OTM-NO-LABEL" => false,
			"OTM-FILE" => true,
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

        'customer_id' => array(
			'STEP' => 1,
			'SHORTNAME' => 'participant',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EXCEL' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_100',
			'SIZE' => 32,
			'MANDATORY' => true,
			'UTF8' => false,
			'AUTOCOMPLETE' => true,
			'TYPE' => 'FK',
			'ANSWER' => 'crm_customer',
			'ANSMODULE' => 'crm',
			'RELATION' => 'OneToMany',
			"NO-RETURNTO" => true,
			"OTM-NO-LABEL" => false,
			"OTM-FILE" => true,
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

        'survey_token' => array(
			'STEP' => 4,
			'FGROUP' => 'status',
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'DISPLAY' => true,
			'QSIZE' => 15,
			'CSS' => 'width_pct_33',
			'SIZE' => 20,
			'TYPE' => 'TEXT',
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'READONLY' => true,
            'MANDATORY' => true,
		), 

        'attribute_enum_1' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                        'TYPE' => 'ENUM', 'DEFAULT' => 0, 
                        'ANSWER' => 'FUNCTION',
                        'FUNCTION_COL_NAME' => '::additional', 
                        'STARS' => '::additional', 'FORMAT' => '::additional'),


        'attribute_enum_2' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                        'TYPE' => 'ENUM', 'DEFAULT' => 0,
                        'ANSWER' => 'FUNCTION',
                        'FUNCTION_COL_NAME' => '::additional', 
                        'STARS' => '::additional', 'FORMAT' => '::additional'),

        'attribute_enum_3' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                        'TYPE' => 'ENUM', 'DEFAULT' => 0,
                        'ANSWER' => 'FUNCTION',
                        'FUNCTION_COL_NAME' => '::additional', 
                        'STARS' => '::additional', 'FORMAT' => '::additional'),


        'attribute_enum_4' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                        'TYPE' => 'ENUM', 'DEFAULT' => 0,
                        'ANSWER' => 'FUNCTION',
                        'FUNCTION_COL_NAME' => '::additional', 
                        'STARS' => '::additional', 'FORMAT' => '::additional'),

        'attribute_enum_5' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                        'TYPE' => 'ENUM', 'DEFAULT' => 0,
                        'ANSWER' => 'FUNCTION',
                        'FUNCTION_COL_NAME' => '::additional', 
                        'STARS' => '::additional', 'FORMAT' => '::additional'),

        'attribute_enum_6' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                        'TYPE' => 'ENUM', 'DEFAULT' => 0,
                        'ANSWER' => 'FUNCTION',
                        'FUNCTION_COL_NAME' => '::additional', 
                        'STARS' => '::additional', 'FORMAT' => '::additional'),

        'attribute_enum_7' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                        'TYPE' => 'ENUM', 'DEFAULT' => 0,
                        'ANSWER' => 'FUNCTION',
                        'FUNCTION_COL_NAME' => '::additional', 
                        'STARS' => '::additional', 'FORMAT' => '::additional'),

        'attribute_enum_8' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                        'TYPE' => 'ENUM', 'DEFAULT' => 0,
                        'ANSWER' => 'FUNCTION',
                        'FUNCTION_COL_NAME' => '::additional', 
                        'STARS' => '::additional', 'FORMAT' => '::additional'),

        'attribute_enum_9' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                        'TYPE' => 'ENUM', 'DEFAULT' => 0,
                        'ANSWER' => 'FUNCTION',
                        'FUNCTION_COL_NAME' => '::additional', 
                        'STARS' => '::additional', 'FORMAT' => '::additional'),

        'attribute_enum_10' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                        'TYPE' => 'ENUM', 'DEFAULT' => 0,
                        'ANSWER' => 'FUNCTION',
                        'FUNCTION_COL_NAME' => '::additional', 
                        'STARS' => '::additional', 'FORMAT' => '::additional'),


        'attribute_yn_1' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                                "DEFAULT" => 'Y', 'TYPE' => 'YN', 'CHECKBOX' => '::additional', 'SWITCHER' => '::additional', 'FORMAT' => '::additional'),

        'attribute_yn_2' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                                "DEFAULT" => 'Y', 'TYPE' => 'YN', 'CHECKBOX' => '::additional', 'SWITCHER' => '::additional', 'FORMAT' => '::additional'),

        'attribute_yn_3' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                                "DEFAULT" => 'Y', 'TYPE' => 'YN', 'CHECKBOX' => '::additional', 'SWITCHER' => '::additional', 'FORMAT' => '::additional'),                    

        'attribute_yn_4' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                                "DEFAULT" => 'Y', 'TYPE' => 'YN', 'CHECKBOX' => '::additional', 'SWITCHER' => '::additional', 'FORMAT' => '::additional'),                    

        'attribute_yn_5' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                                "DEFAULT" => 'Y', 'TYPE' => 'YN', 'CHECKBOX' => '::additional', 'SWITCHER' => '::additional', 'FORMAT' => '::additional'),                    

        'attribute_yn_6' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                                "DEFAULT" => 'Y', 'TYPE' => 'YN', 'CHECKBOX' => '::additional', 'SWITCHER' => '::additional', 'FORMAT' => '::additional'),                    

        'attribute_yn_7' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                                "DEFAULT" => 'Y', 'TYPE' => 'YN', 'CHECKBOX' => '::additional', 'SWITCHER' => '::additional', 'FORMAT' => '::additional'),                    

        'attribute_yn_8' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                                "DEFAULT" => 'Y', 'TYPE' => 'YN', 'CHECKBOX' => '::additional', 'SWITCHER' => '::additional', 'FORMAT' => '::additional'),                    

        'attribute_yn_9' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                                "DEFAULT" => 'Y', 'TYPE' => 'YN', 'CHECKBOX' => '::additional', 'SWITCHER' => '::additional', 'FORMAT' => '::additional'),                    

        'attribute_yn_10' => array('STEP' => 1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'OBSOLETE' => '::additional', 'RETRIEVE' => false, 'EDIT' => true, 'QEDIT' => true, 
                                "DEFAULT" => 'Y', 'TYPE' => 'YN', 'CHECKBOX' => '::additional', 'SWITCHER' => '::additional', 'FORMAT' => '::additional'),                    


        'attribute_date_1' => array( 'SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false, 'OBSOLETE' => '::additional', 
                'EDIT' => true,  'QEDIT' => true,
                'TYPE' => 'DATE',  'READONLY' => false,
                'CSS' => 'width_pct_100', ),

        'attribute_date_2' => array( 'SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false, 'OBSOLETE' => '::additional',
                'EDIT' => true,  'QEDIT' => true,
                'TYPE' => 'DATE',  'READONLY' => false,
                'CSS' => 'width_pct_100', ),


        'attribute_gdate_1' => array( 'SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false, 'OBSOLETE' => '::additional', 
                'EDIT' => true,  'QEDIT' => true,
                'TYPE' => 'GDATE',  'READONLY' => false,
                'CSS' => 'width_pct_100', ),

        'attribute_gdate_2' => array( 'SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false, 'OBSOLETE' => '::additional',
                'EDIT' => true,  'QEDIT' => true,
                'TYPE' => 'GDATE',  'READONLY' => false,
                'CSS' => 'width_pct_100', ),


        'attribute_string_1' => array( 'SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false, 'OBSOLETE' => '::additional', 
                'EDIT' => true,  'QEDIT' => true,
                'SIZE' => 128,  'MAXLENGTH' => '::additional',  'MIN-SIZE' => 5,  'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE',  'UTF8' => true,
                'TYPE' => 'TEXT',  'READONLY' => false,
                'CSS' => 'width_pct_100', ),

        'attribute_string_2' => array( 'SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false, 'OBSOLETE' => '::additional',
                'EDIT' => true,  'QEDIT' => true,
                'SIZE' => 128,  'MAXLENGTH' => '::additional',  'MIN-SIZE' => 5,  'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE',  'UTF8' => true,
                'TYPE' => 'TEXT',  'READONLY' => false,
                'CSS' => 'width_pct_100', ),

        'attribute_string_3' => array( 'SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false, 'OBSOLETE' => '::additional',
                'EDIT' => true,  'QEDIT' => true,
                'SIZE' => 128,  'MAXLENGTH' => '::additional',  'MIN-SIZE' => 5,  'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE',  'UTF8' => true,
                'TYPE' => 'TEXT',  'READONLY' => false,
                'CSS' => 'width_pct_100', ),

        'attribute_area_1' => array( 'SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false, 'OBSOLETE' => '::additional',
                'EDIT' => true,  'QEDIT' => false,
                'SIZE' => 'AREA',  'MAXLENGTH' => '::additional',  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',  'UTF8' => true,
                'TYPE' => 'TEXT',  'READONLY' => false,
                'CSS' => 'width_pct_100', ),

        'attribute_area_2' => array( 'SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false, 'OBSOLETE' => '::additional',
                'EDIT' => true,  'QEDIT' => false,
                'SIZE' => 'AREA',  'MAXLENGTH' => '::additional',  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',  'UTF8' => true,
                'TYPE' => 'TEXT',  'READONLY' => false,
                'CSS' => 'width_pct_100', ),

        'attribute_area_3' => array( 'SEARCH' => true,  'QSEARCH' => true,  'SHOW' => true,  'AUDIT' => false,  'RETRIEVE' => false, 'OBSOLETE' => '::additional',
                'EDIT' => true,  'QEDIT' => false,
                'SIZE' => 'AREA',  'MAXLENGTH' => '::additional',  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',  'UTF8' => true,
                'TYPE' => 'TEXT',  'READONLY' => false,
                'CSS' => 'width_pct_100', ),

        'active'             => array( 'STEP' =>1, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => true, 'EDIT' => true, 'QEDIT' => true, 'DEFAULT' => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields' ),

        'date_start_satisfaction' => array(
			'TYPE' => 'DATE',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  'STEP' => 99, 
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

        'date_end_satisfaction' => array(
                'TYPE' => 'DATE',
                'CATEGORY' => 'FORMULA',
                'SEARCH-BY-ONE' => '',
                'DISPLAY' => '',  'STEP' => 99, 
                'DISPLAY-UGROUPS' => '',
                'EDIT-UGROUPS' => '',
        ),

        //----------- greg


        'date_start_satisfaction_greg' => array(
                'TYPE' => 'GDATE',
                'CATEGORY' => 'FORMULA',
                'SEARCH-BY-ONE' => '',
                'DISPLAY' => '',  'STEP' => 99, 
                'DISPLAY-UGROUPS' => '',
                'EDIT-UGROUPS' => '',
        ),

        'date_end_satisfaction_greg' => array(
                'TYPE' => 'DATE',
                'CATEGORY' => 'FORMULA',
                'SEARCH-BY-ONE' => '',
                'DISPLAY' => '',  'STEP' => 99, 
                'DISPLAY-UGROUPS' => '',
                'EDIT-UGROUPS' => '',
        ),



        'created_by'         => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false,  'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields' ),
        'created_at'         => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields' ),
        'updated_by'         => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields' ),
        'updated_at'         => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields' ),
        'validated_by'       => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields' ),
        'validated_at'       => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields' ),
        
        'version'            => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'INT', 'FGROUP' => 'tech_fields' ),
        'draft'             => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, 'DEFAULT' => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields' ),
        'update_groups_mfk' => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields' ),
        'delete_groups_mfk' => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields' ),
        'display_groups_mfk' => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields' ),
        'sci_id'            => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'scenario_item', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields' ),
        'tech_notes' 	      => array( 'STEP' =>99, 'HIDE_IF_NEW' => true, 'TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA', 'SHOW-ADMIN' => true, 'TOKEN_SEP'=>'§', 'READONLY' =>true, 'NO-ERROR-CHECK'=>true, 'FGROUP' => 'tech_fields' ),
    );

}

// errors

