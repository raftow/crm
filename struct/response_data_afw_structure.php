<?php
class CrmResponseDataAfwStructure
{
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

		'response_id' => array(
			'SHORTNAME' => 'response',
			'SEARCH' => false,
			'QSEARCH' => false,
			'SHOW' => false,
			'RETRIEVE' => false,
			'EDIT' => false,
			'QEDIT' => false,
			'SIZE' => 32,
			'MANDATORY' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'response',
			'ANSMODULE' => 'crm',
			'RELATION' => 'OneToMany',
			'READONLY' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => false,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'module_id' => array(
			'SHORTNAME' => 'module',
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 32,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'module',
			'ANSMODULE' => 'ums',
			'RELATION' => 'ManyToOne',
			'READONLY' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'item_code' => array(
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'MIN-SIZE' => 3,
			'CHAR_TEMPLATE' => 'ALPHABETIC,NUMERIC,UNDERSCORE',
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'item_name' => array(
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 48,
			'MIN-SIZE' => 5,
			'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'response_field' => array(
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'response_value' => array(
			'SEARCH' => true,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 32,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'READONLY' => false,
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'created_by' => array(
			'SHOW-ADMIN' => true,
			'RETRIEVE' => false,
			'EDIT' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'auser',
			'ANSMODULE' => 'ums',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'created_at' => array(
			'SHOW-ADMIN' => true,
			'RETRIEVE' => false,
			'EDIT' => false,
			'TYPE' => 'GDAT',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'updated_by' => array(
			'SHOW-ADMIN' => true,
			'RETRIEVE' => false,
			'EDIT' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'auser',
			'ANSMODULE' => 'ums',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'updated_at' => array(
			'SHOW-ADMIN' => true,
			'RETRIEVE' => false,
			'EDIT' => false,
			'TYPE' => 'GDAT',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'validated_by' => array(
			'SHOW-ADMIN' => true,
			'RETRIEVE' => false,
			'EDIT' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'auser',
			'ANSMODULE' => 'ums',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'validated_at' => array(
			'SHOW-ADMIN' => true,
			'RETRIEVE' => false,
			'EDIT' => false,
			'TYPE' => 'GDAT',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',
			'STEP' => 1,
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
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'id_aut'         => array(
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

		'date_aut'            => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'TECH_FIELDS-RETRIEVE' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'GDAT',
			'FGROUP' => 'tech_fields'
		),

		'id_mod'           => array(
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

		'date_mod'              => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'TECH_FIELDS-RETRIEVE' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'GDAT',
			'FGROUP' => 'tech_fields'
		),

		'id_valid'       => array(
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

		'date_valid'          => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'GDAT',
			'FGROUP' => 'tech_fields'
		),

		/* 'avail'                   => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 
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
