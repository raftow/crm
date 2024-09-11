<?php

class CrmLimesurvey
{

    public static function surveyCustomerSatisfactionAndBackToCrm2($send_limit=100)
    {
        $crm_survey_id = AfwSession::config('crm_survey_id', '174363');
        
        $compain_start_date = add_n_days(false, -120, "", "Y-m-d");
        
        $date_start_migration_back = add_n_days(false, -30, "", "Y-m-d"); // 60

        $nb_survey_update_back = 0;
        $nb_bad_customer = 0;
        $nb_bad_request = 0;
         
        $sql_data_from_survey = "select s.token, mpid, completed, attribute_1 as ticket_num, attribute_5 as mobile, email, ipaddr, ${crm_survey_id}X1X1 as FAST, ${crm_survey_id}X1X2 as SATISFACTION, ${crm_survey_id}X1X3 as RESOLVED, ${crm_survey_id}X1X4 as mmServices 
                from lime_survey_${crm_survey_id} s 
                   inner join lime_tokens_${crm_survey_id} t on s.token=t.token
                where t.completed >= '$date_start_migration_back' and t.completed != 'N'  ";
         $data = getDataFromSQL("limesurvey",$sql_data_from_survey);
         $data_count = count($data);
         foreach($data as $rowi => $row)
         {
             AfwBatch::print_info(" --** surveyCustomerSatisfactionAndBackToCrm2 row $rowi/$data_count **-- "); 
             foreach($row as $col => $val) ${$col."_value"} = $val;
             
             if(!$FAST_value) $FAST_value = "Y";
             if(!$SATISFACTION_value) $SATISFACTION_value = "Y";
             if(!$RESOLVED_value) $RESOLVED_value = "Y";
             if(!$mmServices_value) $mmServices_value = "Y";
             if($mobile_value and $email_value) 
             {
                $customerObj = CrmCustomer::loadByMobileAndEmail($mobile_value, $email_value);
                if($customerObj)
                {
                  $requestObj = Request::loadByMainIndex($ticket_num_value,$customerObj->id);
                  if($requestObj)
                  {
                    // customer has opened survey and voted not satisfied but he created taqib ticket
                    // so we put SATISFACTION value = W and we never change it back to N as he created taqib
                    if(($requestObj->getVal("survey_opened") == "Y") and 
                       ($requestObj->getRelatedToTicketsCount()>0) and
                       ($requestObj->getVal("service_satisfied")=="W") and
                       ($SATISFACTION_value == "N")
                       )
                    {
                      $SATISFACTION_value = "W";
                    }
                    
                    $requestObj->set("easy_fast",$FAST_value);
                    $requestObj->set("service_satisfied",$SATISFACTION_value);
                    $requestObj->set("pb_resolved",$RESOLVED_value);
                    $requestObj->set("general_satisfaction",$mmServices_value);
                    $requestObj->set("survey_opened","Y");
                    // to repair previous data but for new data it is already done when creating token
                    $requestObj->set("survey_token",$token_value);
                    $requestObj->set("survey_sent","Y");
                    $requestObj->commit();
                    $nb_survey_update_back++;
                  }
                  else $nb_bad_request++;
                }
                else $nb_bad_customer++;
             }
             else $nb_bad_customer++;
         }


        return array('nb_survey_update_back'=>$nb_survey_update_back, 'nb_bad_customer'=>$nb_bad_customer, 'nb_bad_request'=>$nb_bad_request);  

    }


    public static function surveyClosedTicket($ticketObj)
    {
        $crm_survey_id = AfwSession::config('crm_survey_id', '174363'); 
        $lime_survey_domain = AfwSession::config('lime_survey_domain', 'survey.company');
        $limesurvey_url = AfwSession::config('limesurvey_url', "http://$lime_survey_domain/surv/i.php");
        $customerObj = $ticketObj->hetCustomer();
        $firstname_value = $customerObj->getVal("first_name_ar");
        $lastname_value = $customerObj->getVal("last_name_ar");
        $email_value = $customerObj->getVal("email");
        $mpid_value = 100000 + $ticketObj->id;
        $language_value = "ar";
        $token = substr(md5(trim($firstname_value).trim($lastname_value).trim($email_value).$mpid_value),0,15);

        // field_ticket_number_value as attribute_1,
        $request_code = $ticketObj->getVal("request_code");
        // title as attribute_2,
        $ticket_title = addslashes($ticketObj->getVal("request_title"));
        // body_value as attribute_3,
        $ticket_body = addslashes($ticketObj->getVal("request_text"));
        // field_mobile_number_value as attribute_5,
        $ticket_mobile = $customerObj->getVal("mobile");
        // if(!$ticket_mobile) 
        // die("no mobile number for this customer : $firstname_value $lastname_value ( $email_value ) => [$ticket_mobile] ".$customerObj->id);
        // field_final_decision_value as attribute_7,
        $final_decision = $ticketObj->getFinalDecisionOnRequest($language_value);
        // tdep.name as attribute_8,        
        $ticket_orgunit = $ticketObj->showAttribute("orgunit_id");

        $now_YmdHis = AfwDateHelper::shiftGregDate('',-1);

        $sql_migrate_to_survey_system = "insert into lime_tokens_$crm_survey_id(token,firstname,lastname,email,emailstatus,language,mpid,
              attribute_1, attribute_2, attribute_3, attribute_5, attribute_7, attribute_8, validfrom, usesleft)
        values('$token', _utf8'$firstname_value', _utf8'$lastname_value','$email_value','OK','$language_value', '$mpid_value',
              '$request_code', _utf8'$ticket_title', _utf8'$ticket_body', '$ticket_mobile', _utf8'$final_decision', _utf8'$ticket_orgunit', '$now_YmdHis',40)";

        
        
        $execRes = AfwDB::execQuery("limesurvey", $sql_migrate_to_survey_system);
        if($execRes>0)
        {
          //$sql_log = "";
          $sql_log = " SQL=".$sql_migrate_to_survey_system;   
          $ticketObj->set("survey_token",$token);
          $ticketObj->set("survey_sent","Y");
          $ticketObj->commit();

          return "$limesurvey_url/$crm_survey_id?token=$token".$sql_log; 

          
        }
        else return "failed to create record in limesurvey";
    }

    public static function surveyCompainForClosedTickets($send_limit=100)
    {
        $crm_survey_id = AfwSession::config('crm_survey_id', '174363');   
         
         //$work_date = add_n_days(false, -21, "", "Y-m-d");
         $compain_start_date = add_n_days(false, -120, "", "Y-m-d");
         //$compain_end_date = add_n_days(false, -3, "", "Y-m-d");
         $date_start_migration_back = add_n_days(false, -60, "", "Y-m-d");
         
         $sql_merge_new_tickets_for_survey = "
         insert into survey_token (mpid, validfrom, full_name, email, language, attribute_1, attribute_2, attribute_3, attribute_5, attribute_7, attribute_8, merge_status,
                                    FAST,SATISFACTION,RESOLVED,mmServices)
         
              SELECT  nd.nid as mpid,
                      now() as validfrom,
                      tb3.field_ticket_name_value as full_name,
                      tb6.field_mail_email as email,
                      'ar' as language,
                      tb1.field_ticket_number_value as attribute_1,
                      nd.title as attribute_2,
                      tb8.body_value as attribute_3,
                      tb7.field_mobile_number_value as attribute_5,
                      tb10.field_final_decision__value as attribute_7,
                      tdep.name as attribute_8,
                      'N' as merge_status,
                      'A' as FAST,
                      'A' as SATISFACTION,
                      'A' as RESOLVED,
                      'A' as mmServices
                   FROM node nd
                      INNER JOIN  field_data_field_ticket_number tb1 ON nd.nid = tb1.entity_id  
                      INNER JOIN field_data_field_ticket_name tb3 ON nd.nid = tb3.entity_id  
                      INNER JOIN field_data_field_tanbeeh_status tb4 ON nd.nid = tb4.entity_id  
                      INNER JOIN field_data_field_mail tb6 ON nd.nid = tb6.entity_id
                        LEFT JOIN field_data_field_mobile_number tb7 ON nd.nid = tb7.entity_id  
                        LEFT JOIN field_data_body tb8 ON nd.nid = tb8.entity_id  
                        LEFT JOIN field_data_field_investigator tb9 ON nd.nid = tb9.entity_id
                        LEFT JOIN taxonomy_term_data tdep ON tb9.field_investigator_target_id = tdep.tid  
                        LEFT JOIN field_data_field_final_decision_ tb10 ON nd.nid = tb10.entity_id
                        LEFT JOIN survey_token stkn on nd.nid = stkn.mpid  
              WHERE nd.type = 'support_ticket'
                AND tb4.field_tanbeeh_status_value = 'closed'
                AND date_format(from_unixtime(nd.created),'%Y-%m-%d') >= '$compain_start_date'
                -- AND tb10.field_final_decision__value is not null
                -- AND trim(tb10.field_final_decision__value) != ''
                AND stkn.mpid is null  
              ORDER BY date_format(from_unixtime(nd.created),'%Y-%m-%d') asc
              LIMIT 500";
         
         execQuery("nartaqi", $sql_merge_new_tickets_for_survey);
         
         // merge_status
         // N : means not merged
         // S : means merged to survey system 
         // Y : means merged back to nartaqi system after response of customer or unsubscribe or timeout  (10 days after 3 reminders separated by 3, 7, 10 days : so after 1 month)


         // migrate merge_status from N to S
         $sql_data_to_survey = "select * from survey_token where merge_status = 'N'";
         $data = getDataFromSQL("nartaqi",$sql_data_to_survey);
        
         $nbrows_migrated = 0;
         $nb_errors = 0;
         
         foreach($data as $row)
         {
             foreach($row as $col => $val) ${$col."_value"} = addslashes($val);
         
             $name_full_arr = explode(" ",$full_name_value);
             
             $firstname_value = $name_full_arr[0];
             unset($name_full_arr[0]);
             $lastname_value = implode(" ",$name_full_arr);
             
             if(!$attribute_7_value) $attribute_7_value = "لا يوجد توصية";
             if(!$attribute_8_value) $attribute_8_value = "مكتب خدمة العملاء";
             
             $token = substr(md5(trim($firstname_value).trim($lastname_value).trim($email_value).$mpid_value),0,15);
             
             $validfrom = date("Y-m-d H:i:s");
         
             $sql_migrate_to_survey_system = "insert into lime_tokens_$crm_survey_id(token,firstname,lastname,email,emailstatus,language,mpid,attribute_1, attribute_2, attribute_3, attribute_5, attribute_7, attribute_8, validfrom)
                  values('$token','$firstname_value','$lastname_value','$email_value','OK','$language_value','$mpid_value','$attribute_1_value','$attribute_2_value','$attribute_3_value','$attribute_5_value','$attribute_7_value','$attribute_8_value', '$validfrom')";
                  
                  
             $execRes = execQuery("limesurvey", $sql_migrate_to_survey_system);
             
             if($execRes["result"])
             {
                   execQuery("nartaqi", "update survey_token set merge_status = 'S', validfrom = now() where mpid = '$mpid_value'");
                   $nbrows_migrated++;
             }
             else $nb_errors++;
             
                  
         }
         
         
         
         // after this we send invitations and reminders for customers to participate to survey
         // after customer do the survey (and complete it ? for the moment we take also incomplete participations)  
         // migrate back data from limesurvey to nartaqi database
         // and set merge_status from S to Y
         
         $nbrows_migrated_back = 0;
         
         $sql_data_from_survey = "select mpid, completed, attribute_1 as ticket_num, ipaddr, ${crm_survey_id}X1X1 as FAST, ${crm_survey_id}X1X2 as SATISFACTION, ${crm_survey_id}X1X3 as RESOLVED, ${crm_survey_id}X1X4 as mmServices 
                from lime_survey_${crm_survey_id} s 
                   inner join lime_tokens_${crm_survey_id} t on s.token=t.token
                where t.completed >= '$date_start_migration_back'   ";
         $data = getDataFromSQL("limesurvey",$sql_data_from_survey);
         foreach($data as $row)
         {
             foreach($row as $col => $val) ${$col."_value"} = addslashes($val);
             
             if(!$FAST_value) $FAST_value = "Y";
             if(!$SATISFACTION_value) $SATISFACTION_value = "Y";
             if(!$RESOLVED_value) $RESOLVED_value = "Y";
             if(!$mmServices_value) $mmServices_value = "Y";
             
         
             $sql_migrate_back_to_nartaqi_system = "
                update survey_token set ipaddr = '$ipaddr_value',
                                        FAST = '$FAST_value', 
                                        SATISFACTION = '$SATISFACTION_value',
                                        RESOLVED = '$RESOLVED_value',
                                        mmServices = '$mmServices_value',
                                        completed = '$completed_value',
                                        merge_status = 'Y',
                                        validfrom = now() 
                where mpid = '$mpid_value' and attribute_1 = '$ticket_num_value' and (FAST != '$FAST_value' or SATISFACTION != '$SATISFACTION_value' or RESOLVED != '$RESOLVED_value' or mmServices != '$mmServices_value' or merge_status != 'Y' or ipaddr != '$ipaddr_value')";
                  
                  
             $execRes = execQuery("nartaqi", $sql_migrate_back_to_nartaqi_system);
             
             if($execRes["result"])
             {
                    if($execRes["affected_rows"]) $nbrows_migrated_back++;
             }
             else $nb_errors++;
                 
         }
         
         // احمد سعد الاحمري <ahmdsaaad@mm.gov.sa>
         // 1/8/2019
         // وكذلك اعتبار من لم يشارك بالاستبانة  يعتبر راضي  ..
         $sql_set_default_response_if_no_participation = "update survey_token set FAST='Y',SATISFACTION='Y', RESOLVED='Y', mmServices='Y', validfrom = now()  
                                                              where FAST in ('A','B') 
                                                                and SATISFACTION in ('A','B') 
                                                                and RESOLVED in ('A','B') 
                                                                and mmServices in ('A','B')";
         execQuery("nartaqi", $sql_set_default_response_if_no_participation);
         
         $sql_set_default_response_if_no_response = "update survey_token set SATISFACTION='Y', validfrom = now() where SATISFACTION in ('A','B')";
         execQuery("nartaqi", $sql_set_default_response_if_no_response);
         
         $sql_set_default_response_if_no_response2 = "update survey_token set mmServices='Y', validfrom = now() where mmServices in ('A','B')";
         execQuery("nartaqi", $sql_set_default_response_if_no_response2);
         
         $sql_set_default_response_if_no_response3 = "update survey_token set RESOLVED='Y', validfrom = now() where RESOLVED in ('A','B')";
         execQuery("nartaqi", $sql_set_default_response_if_no_response3);
         
         $sql_set_default_response_if_no_response4 = "update survey_token set FAST='Y', validfrom = now() where FAST in ('A','B')";
         execQuery("nartaqi", $sql_set_default_response_if_no_response4);

         return array("nbrows_migrated"=>$nbrows_migrated, "nbrows_migrated_back"=>$nbrows_migrated_back, "nb_errors"=>$nb_errors);
         

         
    }
}