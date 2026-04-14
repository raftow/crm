<?php
// 28/02/2022 : rafik :
// alter table crm_emp_request add super_admin char(1) null;
// update crm_emp_request set super_admin = 'N';

class CrmCrmEmpNoteAfwStructure
{
	// token separator = §
	public static function initInstance(&$obj)
	{
		if ($obj instanceof CrmEmpNote) {
			$obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
			$obj->DISPLAY_FIELD = "";
			$obj->ORDER_BY_FIELDS = "orgunit_id, employee_id, note_date";


			$obj->UNIQUE_KEY = array('orgunit_id', 'employee_id', 'note_date');

			$obj->showQeditErrors = true;
			$obj->showRetrieveErrors = true;
			$obj->public_display = true;
			$obj->editByStep = true;
			$obj->editNbSteps = 3;
			$obj->showQeditErrors = true;
			$obj->showRetrieveErrors = true;
			$obj->general_check_errors = true;
			// $obj->after_save_edit = array("class"=>'Road',"attribute"=>'road_id', "currmod"=>'btb',"currstep"=>9);
		} else {
			CrmEmpNoteArTranslator::initData();
			CrmEmpNoteEnTranslator::initData();
		}
	}

	public static $DB_STRUCTURE = array(


		'id' => array(
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'TYPE' => 'PK',
			'CSS' => 'width_pct_25',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'orgunit_id' => array(
			'STEP' => 1,
			'SHORTNAME' => 'orgunit',
			'SEARCH' => true,
			'QSEARCH' => false,
			'INTERNAL_QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 40,
			'MANDATORY' => true,
			'UTF8' => false,
			'CSS' => 'width_pct_25',
			'TYPE' => 'FK',
			'ANSWER' => 'orgunit',
			'ANSMODULE' => 'hrm',
			'DEPENDENT_OFME' => ['employee_id'],
			// here below substr(xxxx ,2,6) in mySQL <=> substr(xxxx ,1,6) in php
			'WHERE' => "id != 1 and (id in (select orgunit_id from §DBPREFIX§crm.crm_orgunit o where o.active = 'Y'))",
			'RELATION' => 'ManyToOne',
			'READONLY' => true,
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),



		
		'employee_id' => array(
			'STEP' => 1,
			'SHORTNAME' => 'employee',
			'SEARCH' => true,
			'QSEARCH' => false,
			'INTERNAL_QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_25',
			'SIZE' => 40,
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'employee',
			'ANSMODULE' => 'hrm',
			'WHERE' => "id in (select e.employee_id from §DBPREFIX§crm.crm_employee e where e.orgunit_id = §orgunit_id§ and e.active = 'Y')", 
			'DEPENDENCY' => 'orgunit_id',
			'RELATION' => 'ManyToOne',			
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'READONLY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'note_date' => array(
			'STEP' => 1,
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'CSS' => 'width_pct_25',
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

		'active' => array(
			'SHOW' => true,
			'RETRIEVE' => true,
			'SEARCH' => true,
			'QSEARCH' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'DEFAUT' => 'Y',
			'TYPE' => 'YN',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'READONLY' => false,
			'STEP' => 1,
			'CSS' => 'width_pct_25',
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),


		'crm_orgunit_id' => array(
			'SHOW' => true,			
			'EDIT' => true,
			'DISPLAY' => true,
			'STEP' => 2,
			'SHORTNAME' => 'corgunit',
			'SIZE' => 40,
			'CSS' => 'width_pct_25',
			'TYPE' => 'FK',
			'ANSWER' => 'crm_orgunit',
			'ANSMODULE' => 'crm',
			'CATEGORY' => 'FORMULA',
			'RELATION' => 'OneToMany',
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
			'READONLY' => true,
		),

		'crm_employee_id' => array(
			'SHOW' => true,			
			'EDIT' => true,
			'DISPLAY' => true,
			'STEP' => 2,
			'SHORTNAME' => 'cempl',
			'SIZE' => 40,
			'CSS' => 'width_pct_25',
			'TYPE' => 'FK',
			'ANSWER' => 'crm_employee',
			'ANSMODULE' => 'crm',
			'CATEGORY' => 'FORMULA',
			'RELATION' => 'OneToMany',
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
			'READONLY' => true,
		),

	
		'note_body' => array(
			'SHOW' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'UTF8' => true,
			'QSEARCH' => true,
			'SIZE' => 'AEREA',
			'CSS' => 'width_pct_100',
			'MB_CSS' => 'width_pct_100',
			'ROWS' => 7,
			'TYPE' => 'TEXT',
			'STEP' => 2,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'noted' => array(
			'SHOW' => true,
			'RETRIEVE' => true,
			'SEARCH' => true,
			'QSEARCH' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'DEFAUT' => 'N',
			'TYPE' => 'YN',
			'SEARCH-BY-ONE' => true,
			'DISPLAY' => true,
			'STEP' => 3,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'READONLY' => true,
		),

		'response' => array(
			'SHOW' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'UTF8' => false,
			'SIZE' => 'AEREA',
			'CSS' => 'width_pct_100',
			'MB_CSS' => 'width_pct_100',
			'ROWS' => 7,
			'TYPE' => 'TEXT',
			'STEP' => 3,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'READONLY' => true,
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
