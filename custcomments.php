<?php
try {
        $file_dir_name = dirname(__FILE__);

        require_once("$file_dir_name/../config/global_config.php");
        // old include of afw.php
        // require_once("$file_dir_name/../lib/afw/modes/afw_ config.php");

        $cl = 'SurveyToken';
        $currmod = 'crm';
        $currdb = $server_db_prefix . 'crm';
        $limite = 0;

        // Rafik !!!! HARD BUG WORKAROUND !!!!!! 
        // When the filter criterea contain multiple choice (like mfk) we can not send the value inside hidden input
        // so the excel should be generated always in each search action otherwise you will get this SQL error 
        // [field_name] in (Array)
        // IMPORTANT WORKAROUND ^^^^^^^^^^^
        // VVVVVVV  *** DONT REMOVE BELOW *** VVVVVVVV         
        $xls_on = $genere_xls = false;//(count($_POST) > 0);
        // ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

        $arr_sql_conds = array();
        $arr_sql_conds[] = "me.active='Y'";
        $objme = AfwSession::getUserConnected();
        $myEmplObj = $objme->getEmployee();
        $myEmplId = $objme->getEmployeeId();


        $sql_order_by = 'id asc';


        $actions_tpl_arr = array();
        $action = "retrieve-simple";
        // $actions_tpl_arr['edit'] = array('framework_action');


        $current_page = "custcomments.php";
        $special_filter = "containComment";
        $option = $_REQUEST["option"];
        if (!$option) $option = "service";

        $readOnlyColumns = [
                'survey_id',
        ];




        
        if ($option == "service") {
                $formColumns = [
                        'survey_id',
                        'attribute_date_1',
                        'attribute_enum_1',
                        'attribute_enum_4',
                ];

                $fixed_survey_id = 1;
                $forced_retrieve_cols = [
                        'customer_id',
                        'attribute_string_2',
                        'attribute_area_1',                          
                ];
                $hide_retrieve_cols = [
                        // 'workflow_model_id',
                ];

                $requiredColumns = [
                ];

                $specialStructure = [

                ];

                $qsearch_page_title = AfwLanguageHelper::tt('ملاحظات العملاء على الخدمة', $lang, $currmod);
        } else {
                $formColumns = [
                        'survey_id',
                        'attribute_date_1',
                        'attribute_enum_1',
                ];

                $fixed_survey_id = 2;
                $forced_retrieve_cols = [
                        'customer_id',
                        'attribute_string_2',
                        'attribute_area_1',                          
                ];
                $hide_retrieve_cols = [
                        
                ];

                $requiredColumns = [

                ];

                $specialStructure = [];
                $qsearch_page_title = AfwLanguageHelper::tt('ملاحظات العملاء على المنصة', $lang, $currmod);
        }

        $fixed_criterea_arr =  array(
                0 => array('col' => 'survey_id', 'oper' => '=', 'val' => $fixed_survey_id,),
                1 => array('col' => 'datatable_off', 'oper' => '=', 'val' => true,),
        );

        $instanceOptions = [
                'excelExport' => true,
                'pdfExport' => true,
        ];


        include "$file_dir_name/../lib/afw/modes/afw_mode_qsearch.php";
        $collapse_in = '';



        /*$out_scr .= "<div class='workflow-title hzm-info'>$wp_title</div>";

        if ($datatable_on) {
                if ($data_count > 0)
                        $out_scr .= $search_result_html;  // die("search_result_html=".$search_result_html); //
                else
                        $out_scr .= '<div class=\'workflow-information hzm-info\'>
        <i class="hzm-container-center hzm-vertical-align-middle hzm-icon-fm hzm-icon-inbox"></i>
        لا يوجد طلبات للمفاضلة
        </div>';
        }
        */
} catch (Exception $e) {
        $out_scr .= $e->getMessage() . "<br>\n" . $e->getFile() . ' Line ' . $e->getLine() . "<br>\n" . $e->getTraceAsString();
}
