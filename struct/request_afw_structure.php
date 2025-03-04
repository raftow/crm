<?php
class CrmRequestAfwStructure
{
	public static function initInstance(&$obj)
	{
		if ($obj instanceof Request) {
			$obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
			$obj->DISPLAY_FIELD = "request_title";
			// $obj->ENABLE_DISPLAY_MODE_IN_QEDIT=true;
			$obj->ORDER_BY_FIELDS = "request_priority asc, request_date asc, request_time asc, customer_id asc";
			$obj->AUDIT_DATA = false;

			$obj->STATS_DEFAULT_CODE = "gs001";

			$obj->UNIQUE_KEY = array('request_code', 'customer_id');
			$obj->editByStep = false;
			//$obj->editNbSteps = 5;
			$obj->showQeditErrors = true;
			$obj->showRetrieveErrors = true;

			$obj->CAN_FORCE_UPDATE_DATE = true; // temporaire pour la migration

			$obj->after_save_edit = array("file" => '../crm/workbox.php');
			// $obj->after_save_edit = array("mode"=>"qsearch", "currmod"=>'adm', "class"=>'Request',"submit"=>true);
			$obj->OwnedBy = array('module' => "crm", 'afw' => "CrmCustomer");
		} else {
			RequestArTranslator::initData();
			RequestEnTranslator::initData();
		}
	}
	public static $DB_STRUCTURE = array(


		'id' => array(
			'FGROUP' => 'request_text',  /* 'STEP' => 1,*/
			'SHOW' => true,
			'RETRIEVE' => false,
			'EXCEL' => true,
			'EDIT' => true,
			'TYPE' => 'PK',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'request_text' => array(
			'FGROUP' => 'request_text',  /* 'STEP' => 2,  */
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EXCEL' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 'AREA',
			'ROWS' => 16,
			'MANDATORY' => true,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'FORMAT' => 'TOHTML',
			'READONLY' => false,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),


		'request_date' => array(
			'FGROUP' => 'tech_data',  /* 'STEP' => 1,  */
			'SEARCH' => true,
			'QSEARCH' => true,
			'QSEARCH_OPER' => 'between',
			'QSIZE' => 6,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EXCEL' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'SIZE' => 40,
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'DATE',
			'FORMAT' => 'CONVERT_SYSTEM_FORMAT',
			'RETRIEVE-VALUE' => false,
			'READONLY' => true,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'request_time' => array(
			'FGROUP' => 'tech_data',  /* 'STEP' => 1,  */
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'SIZE' => 32,
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'TIME',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),



		'request_code' => array(
			'FGROUP' => 'tech_data',  /* 'STEP' => 1,  */
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => true,
			'IMPORTANT' => 'medium',
			'EDIT' => true,
			'CSS' => 'width_pct_33',
			'SIZE' => 16,
			'MIN-SIZE' => 3,
			'CHAR_TEMPLATE' => 'ALPHABETIC,NUMERIC,UNDERSCORE',
			'MANDATORY' => true,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => true,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'prio_icon' => array(
			'FGROUP' => 'tech_data',  /* 'STEP' => 1,  */
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => true,
			'IMPORTANT' => 'medium',
			'TYPE' => 'TEXT',
			'READONLY' => true,
			'CATEGORY' => 'FORMULA',
		),


		'customer_type_id' => array(
			'FGROUP' => 'tech_data',  /* 'STEP' => 1,  */
			'SHORTNAME' => 'type',
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'QSIZE' => 3,
			'SIZE' => 32,
			'REQUIRED' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'customer_type',
			'ANSMODULE' => 'crm',
			'READONLY' => false,
			'EDIT-SHORT-LIST' => true,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'MANDATORY' => true,
			'ERROR-CHECK' => true,
		),

		'related_request_code' => array(
			'FGROUP' => 'tech_data',  /* 'STEP' => 2,  */
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'SIZE' => 16,
			'MIN-SIZE' => 3,
			'CHAR_TEMPLATE' => 'ALPHABETIC,NUMERIC,UNDERSCORE',
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),


		'request_type_id' => array(
			'FGROUP' => 'tech_data',  /* 'STEP' => 1,  */
			'SHORTNAME' => 'type',
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EXCEL' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'QSIZE' => 3,
			'SIZE' => 32,
			'REQUIRED' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'request_type',
			'ANSMODULE' => 'crm',
			'RELATION' => 'ManyToOne',
			'READONLY' => false,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'MANDATORY' => true,
			'ERROR-CHECK' => true,
		),

		'region_id' => array(
			'FGROUP' => 'tech_data',  /* 'STEP' => 1,  */
			'SHORTNAME' => 'region',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'SIZE' => 40,
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'region',
			'ANSMODULE' => 'ums',
			'RELATION' => 'ManyToOne',
			'READONLY' => true,
			'DEPENDENT_OFME' => array(0 => 'city_id',),
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'city_id' => array(
			'FGROUP' => 'tech_data',  /* 'STEP' => 1,  */
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'SIZE' => 40,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'city',
			'ANSMODULE' => 'ums',
			'WHERE' => "region_id = §region_id§",
			'DEPENDENCY' => 'region_id',
			'RELATION' => 'ManyToOne',
			'READONLY' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'other_city' => array(
			'FGROUP' => 'tech_data',  /* 'STEP' => 1,  */
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'CHAR_TEMPLATE' => '',
			'UTF8' => true,
			'CSS' => 'width_pct_33',
			'TYPE' => 'TEXT',
			'READONLY' => true,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'customer_id' => array(
			'FGROUP' => 'tech_data',  /* 'STEP' => 1, */
			'SHORTNAME' => 'customer',
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

		'email' => array(
			'FGROUP' => 'tech_data',
			'STEP' => 1,
			'CATEGORY' => 'SHORTCUT',
			'SHORTCUT' => 'customer_id.email',
			'SHOW' => true,
			'EDIT' => true,
			'SIZE' => 16,
			'MIN-SIZE' => 7,
			'MAXLENGTH' => 64,
			'FORMAT' => 'EMAIL',
			'UTF8' => false,
			'TYPE' => 'TEXT',
			'READONLY' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
			'CSS' => 'width_pct_100',
		),

		'lang_id' => array(
			'FGROUP' => 'tech_data',  /* 'STEP' => 99,  */
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => false,
			'RETRIEVE' => false,
			'EDIT' => false,
			'QEDIT' => false,
			'SIZE' => 32,
			'MIN-SIZE' => 5,
			'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'enum',
			'ANSWER' => 'FUNCTION',
			'DEFAUT' => 1,
			'RELATION' => 'ManyToOne',
			'READONLY' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),


		'mobile' => array(
			'FGROUP' => 'tech_data',  /* 'STEP' => 1,  */
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => false,
			'RETRIEVE' => false,
			'EXCEL' => true,
			'EDIT' => false,
			'QEDIT' => false,
			'CSS' => 'width_pct_50',
			'SIZE' => 16,
			'MIN-SIZE' => 10,
			'MAXLENGTH' => 16,
			'CATEGORY' => 'SHORTCUT',
			'SHORTCUT' => 'customer_id.mobile',
			'MANDATORY' => true,
			'FORMAT' => 'SA-MOBILE',
			'UTF8' => false,
			'TYPE' => 'TEXT',
			'READONLY' => true,
			'SEARCH-BY-ONE' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),



		'request_title' => array(
			'FGROUP' => 'props',  /* 'STEP' => 2,  */
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EXCEL' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_100',
			'SIZE' => 64,
			'MIN-SIZE' => 5,
			'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE',
			'MANDATORY' => true,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'NO-LABEL' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'request_for' => array(
			'FGROUP' => 'props',  /* 'STEP' => 2,  */
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 128,
			'MIN-SIZE' => 5,
			'CSS' => 'width_pct_100',
			'CHAR_TEMPLATE' => '',
			'MANDATORY' => false,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'request_link' => array(
			'FGROUP' => 'props',  /* 'STEP' => 2,  */
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 255,
			'MIN-SIZE' => 16,
			'CHAR_TEMPLATE' => 'ALPHABETIC,COMMAS,MATH-SYMBOLS,NUMERIC,SPACE,UNDERSCORE',
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'CSS' => 'width_pct_100',
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'request_priority' => array(
			'FGROUP' => 'props',  /* 'STEP' => 3,  */
			'SHORTNAME' => 'priority',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'CSS' => 'width_pct_33',
			'SIZE' => 32,
			'MANDATORY' => true,
			'UTF8' => false,
			'DEFAUT' => 3,
			'TYPE' => 'ENUM',
			'ANSWER' => 'FUNCTION',
			'READONLY' => false,
			'AUDIT' => false,
			'ANSMODULE' => 'crm',
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
			'DEFAUT' => 3,
		),


		'service_category_id' => array(
			'FGROUP' => 'props',  /* 'STEP' => 2,  */
			'SHORTNAME' => 'category',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 32,
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'service_category',
			'ANSMODULE' => 'crm',
			'DEFAUT' => 1,
			'RELATION' => 'ManyToOne',
			'READONLY' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
			'DEFAUT' => 1,
			'CSS' => 'width_pct_33',
		),

		'service_id' => array(
			'FGROUP' => 'props',  /* 'STEP' => 2,  */
			'SHORTNAME' => 'service',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'service',
			'ANSMODULE' => 'crm',
			'DEFAUT' => 1,
			'RELATION' => 'ManyToOne',
			'READONLY' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
			'DEFAUT' => 1,
			'CSS' => 'width_pct_33',
		),



		'requestFileList' => array(
			'FGROUP' => 'props',
			'SHORTNAME' => 'files',
			'SHOW' => false,
			/*'FORMAT' => 'minibox',  'ICONS' => true,  'DELETE-ICON' => true,  'BUTTONS' => true,  */
			'SEARCH' => false,
			'QSEARCH' => false,
			'RETRIEVE' => false,
			'EDIT' => false,
			'INPUT_WIDE' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'MANDATORY' => false,
			'UTF8' => false,
			'TYPE' => 'FK',
			'EMPTY-ITEMS-MESSAGE' => 'no-request-file',
			'CATEGORY' => 'ITEMS',
			'ANSWER' => 'request_file',
			'ANSMODULE' => 'crm',
			'ITEM' => 'request_id',
			'READONLY' => true,
			'CAN-BE-SETTED' => false,
			'NO-LABEL' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'ul_cl_files' => array(
			'FGROUP' => 'props',
			'SIZE' => 255,
			'SHOW' => true,
			'EDIT' => true,
			'READONLY' => true,
			'NO-RETRIEVE' => true,
			'CATEGORY' => 'FORMULA',
			'TYPE' => 'TEXT',
		),


		'supervisor_id' => array(
			'FGROUP' => 'assignment',  /* 'STEP' => 3,  */
			'SHORTNAME' => 'supervisor',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 60,
			'MANDATORY' => false,
			'UTF8' => false,
			'CSS' => 'width_pct_100',
			'TYPE' => 'FK',
			'ANSWER' => 'employee',
			'ANSMODULE' => 'hrm',
			'RELATION' => 'OneToMany',
			'READONLY' => true,
			'AUDIT' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'orgunit_id' => array(
			'FGROUP' => 'assignment',  /* 'STEP' => 3,  */
			'SHORTNAME' => 'orgunit',
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EXCEL' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'WHERE' => "me.id in (select distinct o.orgunit_id from §DBPREFIX§crm.crm_orgunit o 
				                        inner join §DBPREFIX§crm.crm_employee e on e.orgunit_id = o.orgunit_id 
										where o.active='Y' and e.active='Y')",
			'SIZE' => 60,
			'UTF8' => false,
			'CSS' => 'width_pct_100',
			'AUTOCOMPLETE' => true,
			'TYPE' => 'FK',
			'ANSWER' => 'orgunit',
			'ANSMODULE' => 'hrm',
			'RELATION' => 'ManyToOne',
			'READONLY' => true,
			'READONLY-MODULE' => 'crm',
			'DISABLE-READONLY-ADMIN' => true,
			'DISABLE-READONLY-324' => true,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'AUDIT' => false,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'employee_id' => array(
			'FGROUP' => 'assignment',  /* 'STEP' => 3,  */
			'SHORTNAME' => 'employee',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EXCEL' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 60,
			'MANDATORY' => false,
			'UTF8' => false,
			'CSS' => 'width_pct_100',
			'AUTOCOMPLETE' => true,
			'TYPE' => 'FK',
			'ANSWER' => 'employee',
			'ANSMODULE' => 'hrm',
			'RELATION' => 'OneToMany',
			'READONLY' => true,
			'AUDIT' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),


		'man' => array(
			'FGROUP' => 'assignment',
			'SHORTNAME' => 'employee',
			'SHOW' => true,
			'EDIT' => true,
			'RETRIEVE' => true,
			'SIZE' => 60,
			'MANDATORY' => false,
			'UTF8' => false,
			'CATEGORY' => 'FORMULA',
			'READONLY' => true,
			'CSS' => 'width_pct_33',
			'TYPE' => 'TEXT',
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'assign_date' => array(
			'FGROUP' => 'assignment',  /* 'STEP' => 3,  */
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'SIZE' => 10,
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'DATE',
			'FORMAT' => 'HIJRI_UNIT',
			'READONLY' => true,
			'AUDIT' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'assign_time' => array(
			'FGROUP' => 'assignment',  /* 'STEP' => 3,  */
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'SIZE' => 8,
			'UTF8' => false,
			'TYPE' => 'TIME',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'status_id' => array(
			'FGROUP' => 'status',  /* 'STEP' => 3,  */
			'SHORTNAME' => 'status',
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EXCEL' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 60,
			'MANDATORY' => true,
			'UTF8' => false,
			'CSS' => 'width_pct_33',
			'QSIZE' => 3,
			'TYPE' => 'FK',
			'ANSWER' => 'request_status',
			'ANSMODULE' => 'crm',
			'DEFAUT' => 0,
			'RELATION' => 'ManyToOne',
			'READONLY' => true,
			'AUDIT' => false,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'status_date' => array(
			'FGROUP' => 'status',  /* 'STEP' => 3,  */
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'SIZE' => 10,
			'UTF8' => false,
			'TYPE' => 'DATE',
			'FORMAT' => 'HIJRI_UNIT',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'status_time' => array(
			'FGROUP' => 'status',  /* 'STEP' => 3,  */
			'SEARCH' => false,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'SIZE' => 8,
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'TIME',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'status_comment' => array(
			'FGROUP' => 'status',  /* 'STEP' => 3,  */
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 255,
			'MIN-SIZE' => 10,
			'CHAR_TEMPLATE' => 'ALL',
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => true,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'status_action_enum' => array(
			'FGROUP' => 'status', 
			'SHORTNAME' => 'action',
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'AUDIT' => false,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'MAXLENGTH' => 32,
			'MIN-SIZE' => 1,
			'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
			'UTF8' => false,
			'TYPE' => 'ENUM',
			'ANSWER' => 'FUNCTION',
			'READONLY' => false,
			'CSS' => 'width_pct_50',
		),

		'days_investigator' => array(
			'FGROUP' => 'status',  /* 'STEP' => 3,  */
			'SEARCH' => false,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'SIZE' => 8,
			'MANDATORY' => false,
			'UTF8' => false,
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'days_delay' => array(
			'FGROUP' => 'status',  /* 'STEP' => 3,  */
			'SEARCH' => false,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_33',
			'SIZE' => 8,
			'MANDATORY' => false,
			'UTF8' => false,
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'survey_sent' => array(
			'FGROUP' => 'status',  /* 'STEP' => 5, */
			'SHORTNAME' => 'sent',
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'UTF8' => false,
			'TYPE' => 'YN',
			'DEFAUT' => 'N',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'CSS' => 'width_pct_50',
		),

		'survey_opened' => array(
			'FGROUP' => 'status',  /* 'STEP' => 5,*/
			'SHORTNAME' => 'opened',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'UTF8' => false,
			'TYPE' => 'YN',
			'DEFAUT' => 'N',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'CSS' => 'width_pct_50',
		),

		'survey_token' => array(
			'STEP' => 99,
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
		),



		'easy_fast' => array(
			'FGROUP' => 'status',  /* 'STEP' => 5,  */
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'UTF8' => false,
			'TYPE' => 'YN',
			'DEFAUT' => 'W',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'CSS' => 'width_pct_50',
		),

		'service_satisfied' => array(
			'FGROUP' => 'status',
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'QSIZE' => 3,
			'SIZE' => 32,
			'UTF8' => false,
			'TYPE' => 'YN',
			'DEFAUT' => 'W',
			'READONLY' => true,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'CSS' => 'width_pct_50',
		),

		'pb_resolved' => array(
			'FGROUP' => 'status',  /* 'STEP' => 5,  */
			'SEARCH' => true,
			'QSEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'UTF8' => false,
			'QSIZE' => 3,
			'TYPE' => 'YN',
			'DEFAUT' => 'W',
			'READONLY' => true,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'CSS' => 'width_pct_50',
		),

		'general_satisfaction' => array(
			'FGROUP' => 'status',  /* 'STEP' => 5,  */
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'UTF8' => false,
			'TYPE' => 'YN',
			'DEFAUT' => 'W',
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'CSS' => 'width_pct_50',
		),

		'request_late' => array(
			'FGROUP' => 'status',
			'TYPE' => 'INT',
			'SHOW' => false,
			'RETRIEVE' => false,
			'EDIT' => false,
			'READONLY' => true,
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),


		'response_all' => array(
			'FGROUP' => 'status',
			'SHOW' => true,
			'STEP' => 99,
			'RETRIEVE' => false,
			'EXCEL' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 255,
			'MIN-SIZE' => 10,
			'CATEGORY' => 'FORMULA',
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => true,
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'responseList' => array(/*'STEP' => 4,*/
			'SHORTNAME' => 'responses',
			'SHOW' => true,
			'FORMAT' => 'minibox',
			'MINIBOX-TPL' => true,
			'TEMPLATE' => 'accordion',
			'ICONS' => true,
			'DELETE-ICON' => true,
			'BUTTONS' => true,
			'SEARCH' => true,
			'QSEARCH' => false,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'MANDATORY' => false,
			'UTF8' => false,
			'TYPE' => 'FK',
			'NO-LABEL' => true,
			'FGROUP' => 'responseList',
			'NO-CACHE' => true,
			'CATEGORY' => 'ITEMS',
			'ANSWER' => 'response',
			'ANSMODULE' => 'crm',
			'ITEM' => 'request_id',
			'XPOLE' => true,
			'READONLY' => true,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'OTHER-LINKS-TOP' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'externalResponseList' => array(/*'STEP' => 4,*/
			'SHORTNAME' => 'extresponses',
			'FORMAT' => 'minibox',
			'MINIBOX-TPL' => true,
			'ICONS' => true,
			'QSEARCH' => false,
			'RETRIEVE' => false,
			'TYPE' => 'FK',
			'NO-LABEL' => true,
			'FGROUP' => 'responseList',
			'NO-CACHE' => true,
			'CATEGORY' => 'ITEMS',
			'ANSWER' => 'response',
			'ANSMODULE' => 'crm',
			'ITEM' => 'request_id',
			'WHERE' => 'internal=\'N\' and new_status_id not in (3,301,9)',
			'READONLY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'doneResponseList' => array(/*'STEP' => 4,*/
			'SHORTNAME' => 'extresponses',
			'FORMAT' => 'minibox',
			'MINIBOX-TPL' => true,
			'ICONS' => true,
			'QSEARCH' => false,
			'RETRIEVE' => false,
			'TYPE' => 'FK',
			'NO-LABEL' => true,
			'FGROUP' => 'responseList',
			'NO-CACHE' => true,
			'CATEGORY' => 'ITEMS',
			'ANSWER' => 'response',
			'ANSMODULE' => 'crm',
			'ITEM' => 'request_id',
			'WHERE' => 'internal=\'N\' ',
			'READONLY' => true, // and new_status_id = 5
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'is_satisfied' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'is_not_satisfied' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'is_indifferent' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'is_request' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'is_enquiry' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'is_complaint' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'is_grievance' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1,  */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'is_HI' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'is_suggestion' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1,*/
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'is_support' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),


		'chez_supervisor' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'chez_customer' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'chez_investigator' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),


		'chez_archive' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),



		'request_done' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),



		'request_ongoing' => array(
			'TYPE' => 'INT',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1,*/
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'date_start_perf' => array(
			'TYPE' => 'DATE',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'date_end_perf' => array(
			'TYPE' => 'DATE',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),


		'date_start_stats' => array(
			'TYPE' => 'DATE',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'date_end_stats' => array(
			'TYPE' => 'DATE',
			'CATEGORY' => 'FORMULA',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'active' => array(
			'SHOW-ADMIN' => true,
			'RETRIEVE' => false,
			'EDIT' => false,
			'QEDIT' => false,
			'DEFAUT' => 'Y',
			'TYPE' => 'YN',
			'AUDIT' => false,
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',  /* 'STEP' => 1, */
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
