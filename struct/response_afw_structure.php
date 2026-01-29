<?php
class CrmResponseAfwStructure
{
	public static function initInstance(&$obj)
	{
		if ($obj instanceof Response) {
				$obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $obj->DISPLAY_FIELD = "";
                $obj->ORDER_BY_FIELDS = "request_id, response_date desc, response_time desc";


                $obj->UNIQUE_KEY = array('request_id', 'response_date', 'response_time');

                $obj->showQeditErrors = true;
                $obj->showRetrieveErrors = true;
                $obj->public_display = true;
                $obj->public_edit = true;

                $obj->after_save_edit = array("class" => 'Request', "attribute" => 'request_id', "currmod" => 'crm', "currstep" => 4);
		} else {
			ResponseArTranslator::initData();
			ResponseEnTranslator::initData();
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
			'CSS' => 'width_pct_25',
			'FGROUP' => 'the_request'
		),
		
		

		'request_text' => array(
			'CATEGORY' => 'SHORTCUT',
			'SHORTCUT' => 'request_id.request_html',
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 'AREA',
			'ROWS' => 10,
			'MANDATORY' => true,
			'UTF8' => true,
			'FGROUP' => 'the_request',
			'TYPE' => 'TEXT',
			'FORMAT' => 'TOHTML',
			'READONLY' => true,
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),
		
		'employee_id' => array(
			'SHORTNAME' => 'employee',
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_25',
			'SIZE' => 32,
			'FGROUP' => 'the_response',
			'MANDATORY' => false,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'employee',
			'ANSMODULE' => 'hrm',
			'RELATION' => 'ManyToOne',
			'READONLY' => true,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),
		

		'orgunit_id' => array(
			'SHORTNAME' => 'orgunit',
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_25',
			'FGROUP' => 'the_response',
			'SIZE' => 40,
			'MANDATORY' => false,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'orgunit',
			'ANSMODULE' => 'hrm',
			'RELATION' => 'ManyToOne',
			'READONLY' => true,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		

		'response_date' => array(
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 10,
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'DATE',
			'FORMAT' => 'HIJRI_UNIT',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
			'FGROUP' => 'the_response',
			'CSS' => 'width_pct_25',
		),

						'dyn_response_date' => array(
							'SHOW' => false,
							'EDIT' => false,
							'QEDIT' => false,
							'SIZE' => 10,
							'CATEGORY' => 'FORMULA',
							'UTF8' => false,
							'TYPE' => 'TEXT',
							'READONLY' => false,
							'SEARCH-BY-ONE' => false,
							'DISPLAY' => false,
							'STEP' => 99,
							'DISPLAY-UGROUPS' => '',
							'EDIT-UGROUPS' => '',
							'ERROR-CHECK' => true,
							'FGROUP' => 'the_response',
						),

		'response_time' => array(
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 8,
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'TIME',
			'FORMAT' => 'TIME-WITHOUT-SECONDS',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
			'FGROUP' => 'the_response',
			'CSS' => 'width_pct_25',
		),
		
		
		


		'response_templates' => array(
			'CATEGORY' => 'FORMULA',
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 'AREA',
			'ROWS' => 10,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'FORMAT' => 'TOHTML',
			'READONLY' => true,
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
			'FGROUP' => 'the_response',
			'CSS' => 'width_pct_100',
		),

		'response_text' => array(
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 'AREA',
			'ROWS' => 10,
			'MANDATORY' => true,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'FORMAT' => 'TOHTML',
			'READONLY' => false,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
			'FGROUP' => 'the_response',
			'CSS' => 'width_pct_100',
		),

		
		
		'new_status_id' => array(
			'SHORTNAME' => 'status',
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'UTF8' => false,
			'SIZE' => 32,
			'MANDATORY' => false,   // when we just assign request no new status it is same
			'TYPE' => 'FK',
			'ANSWER' => 'request_status',
			'ANSMODULE' => 'crm',
			'WHERE' => "user_type_menum like '%,§user_type§,%' and (response_type_mfk='' or response_type_mfk is null or response_type_mfk like '%,§response_type_id§,%')",
			'FGROUP' => 'the_response',

			'RELATION' => 'ManyToOne',
			'READONLY' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'internal' => array(
			'SEARCH' => true,
			'QSEARCH' => false,
			'RETRIEVE' => false,
			'SHOW' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'READONLY' => true,
			'CSS' => 'width_pct_33',
			'SIZE' => 32,
			'MANDATORY' => false,
			'UTF8' => false,
			'TYPE' => 'YN',
			'DEFAUT' => 'W',
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
			'FGROUP' => 'the_response',
		),

		

		'response_type_id' => array(
			'SHORTNAME' => 'type',
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => false,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'SIZE' => 48,
			'MIN-SIZE' => 5,
			'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'response_type',
			'ANSMODULE' => 'crm',
			'NO-COTE' => true,
			'RELATION' => 'ManyToOne',
			'READONLY' => false,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
			'FGROUP' => 'the_response',
		),

		'request_id' => array(
			'SHORTNAME' => 'the_request',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_100',
			'SIZE' => 64,
			'MIN-SIZE' => 5,
			'FGROUP' => 'the_response',
			'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE',
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'request',
			'ANSMODULE' => 'crm',
			'RELATION' => 'OneToMany',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'response_link' => array(
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 255,
			'MIN-SIZE' => 16,
			'CHAR_TEMPLATE' => 'ALPHABETIC,COMMAS,MATH-SYMBOLS,NUMERIC,SPACE,UNDERSCORE',
			'UTF8' => false,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'STEP' => 1,
			'CSS' => 'width_pct_100',
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'FGROUP' => 'the_response',
		),

		'response_aut'	=> array('TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA'),
		'response_cls'	=> array('TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA'),
		'user_type'	=> array(
			'CATEGORY' => 'FORMULA', 'NO-COTE' => true, 
			'TYPE' => 'ENUM',
			'ANSWER' => 'FUNCTION',
			'READONLY' => true,),

                



		'active' => array(
			'SHOW' => true,
			'HIDE_IF_NEW' => true,
			'STEP' => 99,
			'RETRIEVE' => false,
			'EDIT' => false,
			'QEDIT' => false,
			'DEFAUT' => 'Y',
			'TYPE' => 'YN',
			'AUDIT' => true,
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
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

		/* 'active'                   => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 
                                                                'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),*/

		'version'                  => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'INT',
			'FGROUP' => 'tech_fields'
		),

		// 'draft'                         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 
		//                                        'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),

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
			'ANSMODULE' => 'ums',
			'FGROUP' => 'tech_fields'
		),

		'tech_notes' 	                => array(
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