<?php

/**
 * @var string $out_scr
 * @var string $lang
 */

try {
        $file_dir_name = dirname(__FILE__);

        require_once("$file_dir_name/../config/global_config.php");
        // old include of afw.php
        // require_once("$file_dir_name/../lib/afw/modes/afw_ config.php");

        $cl = 'Request';
        $currmod = 'crm';
        // $currdb = $server_db_prefix . 'crm';
        $limite = 0;

        // Rafik !!!! HARD BUG WORKAROUND !!!!!! 
        // When the filter criterea contain multiple choice (like mfk) we can not send the value inside hidden input
        // so the excel should be generated always in each search action otherwise you will get this SQL error 
        // [field_name] in (Array) 
        // IMPORTANT WORKAROUND ^^^^^^^^^^^
        // VVVVVVV  *** DONT REMOVE BELOW *** VVVVVVVV         
        $xls_on = $genere_xls = (count($_POST) > 0);
        // ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

        $arr_sql_conds = array();
        $arr_sql_conds[] = "me.active='Y'";
        $objme = AfwSession::getUserConnected();
        $myEmplObj = $objme->getEmployee();
        $myEmplId = $objme->getEmployeeId();


        $sql_order_by = 'request_date asc, id asc';


        $actions_tpl_arr = array();
        $action = "retrieve-simple";
        // $actions_tpl_arr['edit'] = array('framework_action');

        $fixed_criterea_arr =  array(
                0 => array('col' => 'request_type_id', 'oper' => '=', 'val' => '18',),
                1 => array('col' => 'datatable_off', 'oper' => '=', 'val' => true,),
        );

        $current_page = "balagh_qsearch.php";

        $option = $_REQUEST["option"];
        if (!$option) $option = "report";

        $readOnlyColumns = [
                'request_type_id',
        ];




        $formColumns = [
                'request_type_id',
                'request_category_id',
                'request_date',
                'orgunit_id',
                'status_id',
        ];

        if ($option == "report") {
                $forced_retrieve_cols = [
                        'request_type_id',
                        'request_category_id',
                        'request_code',
                        'crm_customer_id',
                        'orgunit_id',
                        'request_date',
                        'request_time',
                        'status_id',
                        'status_date',
                        'status_time',
                        'close_date',
                        'close_time',
                        'employee_id',
                        'last_response_id',
                ];
                $hide_retrieve_cols = [
                        'crm_model_id',
                        'crm_session_id',
                        'crm_stage_id',
                        'crm_status_id',
                        'crm_scope_id',
                        'active',
                        'done',
                        'done_date',
                        'orgunit_id',
                        'employee_id',
                        'request_date',
                ];

                $requiredColumns = [
                        'crm_model_id',
                ];

                $specialStructure = [
                        'crm_scope_id' =>
                        [
                                'SEARCH-MULTIPLE' => true,
                        ],

                        'crm_sub_scope_id' =>
                        [
                                'SEARCH-MULTIPLE' => true,
                        ],

                ];

                $qsearch_page_title = AfwLanguageHelper::tt('Report Log', $lang, $currmod);
        } else {
                

                $specialStructure = [];
                $qsearch_page_title = AfwLanguageHelper::tt('Report Log', $lang, $currmod);
        }

        $instanceOptions = [
                'excelExport' => true,
                'pdfExport' => true,
        ];


        include "$file_dir_name/../lib/afw/modes/afw_mode_qsearch.php";
        $collapse_in = '';



        
} catch (Exception $e) {
        $out_scr .= $e->getMessage() . "<br>\n" . $e->getFile() . ' Line ' . $e->getLine() . "<br>\n" . $e->getTraceAsString();
}
