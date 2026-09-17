<?php
// ------------------------------------------------------------------------------------
// 6/6/2022 rafik :

// mysql> alter table crm_orgunit change service_mfk service_mfk varchar(255) NOT NULL DEFAULT ',1,';
// mysql> alter table crm_orgunit change service_category_mfk service_category_mfk varchar(255) NOT NULL DEFAULT ',1,';

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class CrmOrgunit extends CrmObject{

        public static $MY_ATABLE_ID=3614; 
        public static $MAIN_CUSTOMER_SERVICE_DEPARTMENT_ID = 70;

        
	public static $DATABASE		= ""; 
        public static $MODULE		    = "crm"; 
        public static $TABLE			= "crm_orgunit"; 
        public static $DB_STRUCTURE = null; 
        
        
        public function __construct(){
		parent::__construct("crm_orgunit","id","crm");
                CrmCrmOrgunitAfwStructure::initInstance($this); 
	}

        public function select_visibilite_horizontale($dropdown=false)
        {
                $objme = AfwSession::getUserConnected();
                
                if($objme and $objme->isAdmin()) 
                {
                        // no VH for system admin
                }
                else
                {
                        $empl_id = $objme ? $objme->getEmployeeId() : 0;
                        
                        $iam_general_supervisor = 0;
                        $iam_supervisor = 0;
                        if($empl_id) $iam_general_supervisor = CrmObject::userIsGeneralSupervisor();
                        if($empl_id) $iam_supervisor = CrmObject::userIsSupervisor();
                        
                        if(!$iam_general_supervisor) $iam_general_supervisor = 0;
                        if(!$iam_supervisor) $iam_supervisor = 0;

                        // if the user is an employee 
                        // he is allowed to see orgunit if :
                        // 1. he is a general supervisor 
                        // or
                        // 2. he is a supervisor

                        $employee_allowed_to_see_orgunit_cond = 
                            "($iam_general_supervisor>0 or $iam_supervisor>0)";
                        
                        $this->where("($empl_id>0 and $employee_allowed_to_see_orgunit_cond)"); 

                }
                        
                $selects = array();
                $this->select_visibilite_horizontale_default($dropdown, $selects);
        }
        
        public static function loadById($id)
        {
           $obj = new CrmOrgunit();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }

        /**
         * @return CrmOrgunit:
         */
        
        public static function loadByCode($code)
        {
           list($a, $orgunit_id) = explode("-", $code);    
           return CrmOrgunit::loadByMainIndex($orgunit_id);           
        }
        
        /**
         * @return CrmOrgunit:
         */
        
        public static function loadByMainIndex($orgunit_id,$create_obj_if_not_found=false, $activate_obj_if_found=true)
        {
           $obj = new CrmOrgunit();
           if(!$orgunit_id) throw new AfwRuntimeException("loadByMainIndex : orgunit_id is mandatory field");


           $obj->select("orgunit_id",$orgunit_id);

           if($obj->load())
           {
                if($activate_obj_if_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("orgunit_id",$orgunit_id);

                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }


        public function getDisplay($lang="ar")
        {
               
               $data = array();
               $link = array();
               

               list($data[0],$link[0]) = $this->displayAttribute("orgunit_id",false, $lang);

               
               return implode(" - ",$data);
        }
        
        
        

        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")      
        {
                global $me, $objme, $lang;
                $otherLinksArray = $this->getOtherLinksArrayStandard($mode, false, $step);
                $my_id = $this->getId();
                $orgunit_id = $this->getVal("orgunit_id");
                $displ = $this->getDisplay($lang);


                if($mode=="mode_allEmployeeList")
                {
                        unset($link);
                        $link = array();
                        $title = "إضافة منسق ";
                        $title_detailed = $title ."لـ : ". $displ;
                        $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=CrmEmployee&currmod=crm&sel_orgunit_id=$orgunit_id";
                        $link["TITLE"] = $title;
                        $link["TARGET"] = "newEmployee";
                        $link["PUBLIC"] = true;
                        $link["UGROUPS"] = array();
                        $link['ATTRIBUTE_WRITEABLE'] = 'allEmployeeList';
                        $otherLinksArray[] = $link;
                }

                if($mode=="mode_tempEmployeeList")
                {
                        unset($link);
                        $link = array();
                        $title = "إضافة طلب تعيين منسق ";
                        $title_detailed = $title ."لـ : ". $displ;
                        $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=CrmEmpRequest&currmod=crm&sel_orgunit_id=$orgunit_id";
                        $link["TITLE"] = $title;
                        $link["TARGET"] = "newEmployeeRequest";
                        $link["PUBLIC"] = true;
                        $link["UGROUPS"] = array();
                        $link['ATTRIBUTE_WRITEABLE'] = 'tempEmployeeList';
                        $otherLinksArray[] = $link;
                }

                
             
             
             
                return $otherLinksArray;
        }


        
        
        protected function getPublicMethods()
        {
                $pbms = array();
                $iam_general_supervisor = CrmObject::userIsGeneralSupervisor();
                $userIsSuperAdmin = CrmObject::userIsSuperAdmin();

                if($userIsSuperAdmin) {
                        $color = "red";
                        $title_ar = "نقل البيانات إلى وحدة جديدة"; 
                        $methodName = "migrateToNewHrmUnit";
                        $pbms[AfwStringHelper::hzmEncode($methodName)] = array(
                                "METHOD"=>$methodName,
                                "COLOR"=>$color, "LABEL_AR"=>$title_ar, 
                                "HZM-SIZE" =>12, 
                                'STEP'=>$this->stepOfAttribute("new_hrm_code"),
                        
                                'CONFIRMATION_NEEDED'=>true,
                                'CONFIRMATION_WARNING' =>array('ar' => "سجل رمز الوحدة القديم لديك قبل تنفيذ العملية  سوف تحتاجه في حال التراجع", 
                                                                'en' => "Note down your old HR unit code before performing the operation; you will need it if you need to revert the changes."),
                                'CONFIRMATION_QUESTION' =>array('ar' => "هل أنت متأكد من تنفيذ عملية الهجرة", 
                                                        'en' => "Are you sure you want to proceed with the migration process?"),
                        
                        );
                }

                if($iam_general_supervisor)
                {
                        
                        
                        $color = "green";
                        $title_ar = "اسناد الطلبات إلى المنسقبن"; 
                        $methodName = "requestAssignement";
                        $pbms[AfwStringHelper::hzmEncode($methodName)] = array(
                                "METHOD"=>$methodName,
                                "COLOR"=>$color, "LABEL_AR"=>$title_ar, 
                                "PUBLIC"=>true, 
                                "BF-ID"=>"", 
                                "HZM-SIZE" =>12, 
                                'STEP'=>$this->stepOfAttribute("currentRequests"),
                        
                        /* CONFIRMATION_NEEDED=>true,
                        'CONFIRMATION_WARNING' =>array('ar' => "xxxxxx", 
                                                        'en' => "@todo"),
                        'CONFIRMATION_QUESTION' =>array('ar' => "yyyyy", 
                                                'en' => "@todo"),
                        'MODE' =>array("mode_diploma_approved"=>true),
                        */
                        );

                        $color = "orange";
                        $title_ar = "إعادة توزيع الطلبات على المنسقبن"; 
                        $methodName = "resetRequestAssignement";
                        $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,
                        "COLOR"=>$color, "LABEL_AR"=>$title_ar, 
                        "PUBLIC"=>true, "BF-ID"=>"", "HZM-SIZE" =>12, 'STEP'=>$this->stepOfAttribute("currentRequests"),
                        
                        /* CONFIRMATION_NEEDED=>true,
                        'CONFIRMATION_WARNING' =>array('ar' => "xxxxxx", 
                                                        'en' => "@todo"),
                        'CONFIRMATION_QUESTION' =>array('ar' => "yyyyy", 
                                                'en' => "@todo"),
                        'MODE' =>array("mode_diploma_approved"=>true),
                        */
                        );


                        

                        if($this->getVal("orgunit_id") == CrmOrgunit::$MAIN_CUSTOMER_SERVICE_DEPARTMENT_ID)
                        {
                                $color = "blue";
                                $title_ar = "اعادة توزيع الطلبات على مشرفي التنسيق"; 
                                $methodName = "resetSupervisorAssignement";
                                $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,
                                "COLOR"=>$color, "LABEL_AR"=>$title_ar, 
                                "PUBLIC"=>true, "BF-ID"=>"", "HZM-SIZE" =>12, 
                                'STEP'=>$this->stepOfAttribute("allEmployeeList"),
                                
                                /* CONFIRMATION_NEEDED=>true,
                                'CONFIRMATION_WARNING' =>array('ar' => "xxxxxx", 
                                                                'en' => "@todo"),
                                'CONFIRMATION_QUESTION' =>array('ar' => "yyyyy", 
                                                        'en' => "@todo"),
                                'MODE' =>array("mode_diploma_approved"=>true),
                                */
                                );


                                $color = "green";
                                $title_ar = "توزيع الطلبات على مشرفي التنسيق"; 
                                $methodName = "supervisorAssignement";
                                $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,
                                "COLOR"=>$color, "LABEL_AR"=>$title_ar, 
                                "PUBLIC"=>true, "BF-ID"=>"", "HZM-SIZE" =>12, 
                                'STEP'=>$this->stepOfAttribute("allEmployeeList"),
                                /* CONFIRMATION_NEEDED=>true,
                                'CONFIRMATION_WARNING' =>array('ar' => "xxxxxx", 
                                                                'en' => "@todo"),
                                'CONFIRMATION_QUESTION' =>array('ar' => "yyyyy", 
                                                        'en' => "@todo"),
                                'MODE' =>array("mode_diploma_approved"=>true),
                                */
                                );

                                // 
                                
                        }

                        $color = "orange";
                        $title_ar = "أي المنسقبن متوفر أكثر"; 
                        $methodName = "getBestAvailInvestigator";
                        $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,
                                "COLOR"=>$color, "LABEL_AR"=>$title_ar, 
                                "ADMIN"=>true, "BF-ID"=>"", "HZM-SIZE" =>12, 'STEP'=>$this->stepOfAttribute("allEmployeeList"),
                                
                                /* CONFIRMATION_NEEDED=>true,
                                'CONFIRMATION_WARNING' =>array('ar' => "xxxxxx", 
                                                        'en' => "@todo"),
                                'CONFIRMATION_QUESTION' =>array('ar' => "yyyyy", 
                                                        'en' => "@todo"),
                                'MODE' =>array("mode_diploma_approved"=>true),
                        */
                        );                
            
                }
            
                return $pbms;
        }


        
        // also silentAssignSupervisorForNonAssigned($lang="ar")          


        public function resetSupervisorAssignement($lang="ar")
        {
                return Request::resetAssignSupervisors($lang="ar");
        }

        public function supervisorAssignement($lang="ar")
        {
                return Request::silentAssignSupervisorForNonAssigned($lang="ar");
        }


        public function migrateToNewHrmUnit($lang="ar") {
                $err_arr = [];
                $war_arr = [];
                $inf_arr = [];
                $new_hrm_code = $this->getVal("new_hrm_code");
                $id = $this->getVal("orgunit_id");
                $newOrg = Orgunit::loadByHRMCode($new_hrm_code);
                if($newOrg) {
                        $id_replace = $newOrg->id;
                        list($total_affected_row_count, $nb_crm_customers, $nb_crm_emp_notes, $nb_crm_emp_requests, $nb_crm_employees, $nb_crm_orgunits, $nb_requests, $nb_responses, $nb_deleted_crm_orgunits) = self::replaceOrgunitBy($id, $id_replace);
                        if($total_affected_row_count>0) $inf_arr[] = "We migrated successfully from unit [ID=$id] to new unit [ID=$id_replace], <br>
                        $nb_crm_customers customers impacted, <br>
                        $nb_crm_emp_notes crm emp notes impacted, <br>
                        $nb_crm_emp_requests crm emp requests impacted, <br>
                        $nb_crm_employees crm employees impacted, <br>
                        $nb_crm_orgunits crm units impacted, <br>
                        $nb_deleted_crm_orgunits crm units deleted, <br>
                        $nb_requests requests impacted, <br>
                        $nb_responses responses impacted, <br>
                        totally $total_affected_row_count record(s) have been impacted";
                        else $war_arr[] = "Nothing todo when migrating from unit [ID=$id] to new unit [ID=$id_replace]";
                }
                else {
                        $err_arr[] = "HR code $new_hrm_code not found !";
                }

                if(!$nb_deleted_crm_orgunits) {
                        $this->set("new_hrm_code","--done--");
                        $this->update();
                }
                

                
                return AfwFormatHelper::pbm_result($err_arr, $inf_arr, $war_arr);
        }


        /**
         * @param int $id_replace
         * @param int $id
         * 
         */
        public static function replaceOrgunitBy($id, $id_replace) {
                if(!$id_replace) return [0];
                if(!$id) return [0];
                $server_db_prefix = AfwSession::config('db_prefix', 'default_db_');
                $total_affected_row_count = 0;
                
                // crm.request-الإدارة المكلفة بالإجابة	orgunit_id  أنا تفاصيل لها-OneToMany
                list(,,, $affected_row_count) = AfwDatabase::db_query("update " . $server_db_prefix . "crm.request set orgunit_id='$id_replace' where orgunit_id='$id' ");
                $total_affected_row_count += $affected_row_count;
                $nb_requests = $affected_row_count;
                
                // crm.response-الجهة المكلفة بالرد	orgunit_id  أنا تفاصيل لها-OneToMany
                list(,,, $affected_row_count) = AfwDatabase::db_query("update " . $server_db_prefix . "crm.response set orgunit_id='$id_replace' where orgunit_id='$id' ");
                $total_affected_row_count += $affected_row_count;
                $nb_responses = $affected_row_count;
                
                $crmObjNew = CrmOrgunit::loadByMainIndex($id_replace);
                if($crmObjNew) {
                        // 
                        list(,,, $affected_row_count) = AfwDatabase::db_query("delete from " . $server_db_prefix . "crm.crm_orgunit where orgunit_id='$id' ");
                        $total_affected_row_count += $affected_row_count;
                        $nb_deleted_crm_orgunits = $affected_row_count;
                        $nb_crm_orgunits = 0;
                }
                else {
                        // 
                        list(,,, $affected_row_count) = AfwDatabase::db_query("update " . $server_db_prefix . "crm.crm_orgunit set orgunit_id='$id_replace' where orgunit_id='$id' ");
                        $total_affected_row_count += $affected_row_count;
                        $nb_crm_orgunits = $affected_row_count;
                        $nb_deleted_crm_orgunits = 0;
                }
                
                
                // الموظف في خدمة العملاء
                list(,,, $affected_row_count) = AfwDatabase::db_query("update " . $server_db_prefix . "crm.crm_employee set orgunit_id='$id_replace' where orgunit_id='$id' ");
                $total_affected_row_count += $affected_row_count;
                $nb_crm_employees = $affected_row_count;
                
                // طلب اضافة موظف في خدمة العملاء
                list(,,, $affected_row_count) = AfwDatabase::db_query("update " . $server_db_prefix . "crm.crm_emp_request set orgunit_id='$id_replace' where orgunit_id='$id' ");
                $total_affected_row_count += $affected_row_count;
                $nb_crm_emp_requests = $affected_row_count;
                
                // ملاحظات على موظف في خدمة العملاء
                list(,,, $affected_row_count) = AfwDatabase::db_query("update " . $server_db_prefix . "crm.crm_emp_note set orgunit_id='$id_replace' where orgunit_id='$id' ");                
                $total_affected_row_count += $affected_row_count;
                $nb_crm_emp_notes = $affected_row_count;
                
                // المسارات
                // not used
                // AfwDatabase::db_query("update " . $server_db_prefix . "crm.request_path set orgunit_id='$id_replace' where orgunit_id='$id' ");
                

                // crm.request-الجهة المعنية بالطلب	concerned_orgunit_id  أنا تفاصيل لها-OneToMany
                // not used
                // AfwDatabase::db_query("update " . $server_db_prefix . "crm.request set concerned_orgunit_id='$id_replace' where concerned_orgunit_id='$id' ");
                
                // crm.crm_customer-جهة العميل	customer_orgunit_id  حقل يفلتر به-ManyToOne
                list(,,, $affected_row_count) = AfwDatabase::db_query("update " . $server_db_prefix . "crm.crm_customer set customer_orgunit_id='$id_replace' where customer_orgunit_id='$id' ");
                $total_affected_row_count += $affected_row_count;
                $nb_crm_customers = $affected_row_count;

                return [$total_affected_row_count, $nb_crm_customers, $nb_crm_emp_notes, $nb_crm_emp_requests, $nb_crm_employees, $nb_crm_orgunits, $nb_requests, $nb_responses, $nb_deleted_crm_orgunits];

        }

        public function resetRequestAssignement($lang="ar")
        {
                return self::requestAssignement($lang,$reset=true); 
        }

        public function requestAssignement($lang="ar",$reset=false)
        {
                // unassign request assigned to non active investigators
                list($arrInv, $listInv) = CrmEmployee::getInvestigatorListOfIds($this->getVal("orgunit_id"));
                $arrInv[] = 0;
                $arrInvTxt = implode(",",$arrInv);
                $obj = new Request();
                $obj->select("orgunit_id", $this->getVal("orgunit_id"));
                if($reset)
                {
                        // because not good to reassign ticket of investigator who has started to work on it
                        // except if this investigator has been dis-missioned
                        $obj->where("status_id in (".Request::$REQUEST_STATUSES_ASSIGNED_ONLY.") or 
                                     (status_id in (".Request::$REQUEST_STATUSES_ONGOING_TVTC.") and (employee_id is null or employee_id not in ($arrInvTxt)))");
                }
                else
                {
                        $obj->where("(status_id in (".Request::$REQUEST_STATUSES_ONGOING_TVTC.") and (employee_id is null or employee_id not in ($arrInvTxt)))");
                }
                
                
                $obj->setForce("employee_id",0);
                $status_comment = "requestAssignement reset=".$reset;
                $this->setForce("status_comment", $status_comment);
                $nb_resetted = $obj->update(false);

                // prepare array of inbox count for each of them to be equitable 
                // on requests distribution
                $inbox_arr = array();
                foreach($listInv as $objInv)
                {
                        $inbox_arr[$objInv->id] = Request::inboxCountFor($objInv->id);
                }

                // die("inbox count by investigator : ".var_export($inbox_arr,true));

                function getPrioInvestigator($inbox_list)
                {
                        $count_curr = 999999;
                        $inv_selected_id = 0;
                        foreach($inbox_list as $inv_id => $count)  
                        {
                                if($count < $count_curr)
                                {
                                        $count_curr = $count;
                                        $inv_selected_id = $inv_id;   
                                }
                        }

                        return $inv_selected_id;
                }

                unset($obj);
                $obj = new Request();
                $obj->select("orgunit_id", $this->getVal("orgunit_id"));
                $obj->where("status_id in (".Request::$REQUEST_STATUSES_ONGOING_TVTC.") and (employee_id is null or employee_id = 0)");
                $nb_assigned = 0;
                $requestWaitingList = $obj->loadMany();
                /**
                 * @var Request $requestWaitingObj
                 */
                foreach($requestWaitingList as $requestWaitingObj)
                {
                        $investigator_to_assign = getPrioInvestigator($inbox_arr);  
                        if($investigator_to_assign>0) 
                        {
                                $requestWaitingObj->assignRequest($investigator_to_assign, $lang, "Y", "requestAssignement automatic task");                      
                                $nb_assigned++;
                                $inbox_arr[$investigator_to_assign]++;
                        }
                }

                return array("",$nb_resetted." ".AfwLanguageHelper::tarjemMessage("request's reset","crm",$lang).", ".$nb_assigned." ".AfwLanguageHelper::tarjemMessage("request's assign","crm",$lang),"");
        }
        
        
        
        
        public function beforeDelete($id,$id_replace) 
        {
            
            
            if($id)
            {   
               if($id_replace==0)
               {
                   $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK part of me - not deletable 

                        
                   $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        $server_db_prefix = AfwSession::config("db_prefix","default_db_"); // FK on me 

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
        
        public function calcUnit_token($what="value")
        {
                return substr(md5($this->id),1,6);
        }

        public function calcNew_requests_count($what="value")
        {
                // all requests count
                return self::calcRequests_countFor($only_done=false, $ongoing_only=false, $new_only=true, $aborted_only=false);
        }

        public function calcRequests_count($what="value")
        {
                // all requests count
                return self::calcRequests_countFor($only_done=false, $ongoing_only=true, $new_only=false, $aborted_only=false);
        }

        public function calcRequests_countFor($only_done=false, $ongoing_only=false, $new_only=false, $aborted_only=false)
        {
            $obj = new Request();
            $obj->where("request_date >= '".$this->calcArchive_date()."'");
            if($this->getVal("orgunit_id") != CrmOrgunit::$MAIN_CUSTOMER_SERVICE_DEPARTMENT_ID)
            {
                $obj->select("orgunit_id", $this->getVal("orgunit_id"));
            }
            
            if($new_only) $obj->where("supervisor_id = 0 or orgunit_id = 0");
            if($only_done) $obj->where("supervisor_id > 0 and orgunit_id > 0 and status_id in (".Request::$REQUEST_STATUSES_DONE.")");
            if($ongoing_only) $obj->where("supervisor_id > 0 and orgunit_id > 0 and status_id in (".Request::$REQUEST_STATUSES_ONGOING_ALL.")");
            if($aborted_only) $obj->where("supervisor_id > 0 and orgunit_id > 0 and status_id in (".Request::$REQUEST_STATUSES_ABORTED.")");
            
            
           return $obj->count();
        }


        public function getBestAvailInvestigator($lang="ar")
        {
               $res = CrmEmployee::getBestAvailableInvestigator($this->getVal("orgunit_id"), 0);

               return array("",var_export($res,true));
        }

        public function calcArchive_date()
        {    
                // 1 year and half (we should archive requests older than this date @todo this job)            
		return AfwDateHelper::shiftHijriDate("",-540);
        }

        public function maxRecordsUmsCheck()
        {
                return 0;
        }

        public function attributeIsApplicable($attribute)
        {
                if (($attribute == "perf_stats_days") or ($attribute == "standard_stats_days") or ($attribute == "satisfaction_stats_days")) {
                        return ($this->getVal("orgunit_id") == self::$CRM_CENTER_ID);
                }

                return true;
        }

        public function shouldBeCalculatedField($attribute){
                if($attribute=="hrm_code") return true;
                if($attribute=="crm_code") return true;
                if($attribute=="new_requests_count") return true;
                if($attribute=="requests_count") return true;
                if($attribute=="archive_date") return true;
                return false;
        }

        public function estimatedTotalRows() {
                return 2500;
        }


        public function beforeMaj($id, $fields_updated)
        {
                
                if ($fields_updated["orgunit_id"]) {
                        $orgObj = $this->het("orgunit_id");
                        if ($orgObj and $orgObj->getVal("id_responsible") and !$this->getVal("id_responsible")) {
                                $this->set("id_responsible", $orgObj->getVal("id_responsible"));
                        }
                        
                }



                return true;
        }
        

}
?>