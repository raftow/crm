<?php
// ------------------------------------------------------------------------------------
// 6/6/2022 rafik :

// mysql> alter table crm_orgunit change service_mfk service_mfk varchar(255) NOT NULL DEFAULT ',1,';
// mysql> alter table crm_orgunit change service_category_mfk service_category_mfk varchar(255) NOT NULL DEFAULT ',1,';

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class CrmOrgunit extends AFWObject{

        public static $MY_ATABLE_ID=3614; 
        public static $MAIN_CUSTOMER_SERVICE_DEPARTMENT_ID = 70;

        
	public static $DATABASE		= ""; 
        public static $MODULE		    = "crm"; 
        public static $TABLE			= ""; 
        public static $DB_STRUCTURE = null; /* = array(
                id => array(SHOW => true, RETRIEVE => true, EDIT => true, TYPE => PK, "TECH_FIELDS-RETRIEVE" => true),

		
		orgunit_id => array(SHORTNAME => orgunit,  SEARCH => true,  
                                QSEARCH => false,  INTERNAL_QSEARCH=>true, SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => false,  "TECH_FIELDS-RETRIEVE" => true,
				SIZE => 40,  MANDATORY => true,  UTF8 => false,  
				TYPE => FK,  ANSWER => orgunit,  ANSMODULE => hrm,  
				RELATION => OneToMany,  READONLY => true, ),

                requests_count => array(SHOW=> true,  CSS => width_pct_25, CATEGORY => FORMULA, TYPE => "INT", 
                                EDIT=>true,  READONLY => true,  RETRIEVE => true, ), 

                requests_nb => array(SEARCH => true,  QSEARCH => false,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => false,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => "INT",  READONLY => false, ),
                                
                // crm_orgunit_name => array(SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true, EXCEL => true,  
		// 		EDIT => true,  QEDIT => false, CSS => width_pct_100,  
		// 		SIZE => 48,  "MIN-SIZE" => 3,  CHAR_TEMPLATE => "ALPHABETIC,SPACE",  REQUIRED => true,  UTF8 => true,  
		// 		TYPE => "TEXT",  READONLY => false, JUSTPROP=>true, ),
                                                

		service_category_mfk => array(SHORTNAME => categorys,  SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => false,  
				EDIT => true,  QEDIT => false,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => MFK,  ANSWER => service_category,  ANSMODULE => crm,  READONLY => false, ),

		service_mfk => array(SHORTNAME => services,  SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => false,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => MFK,  ANSWER => service,  ANSMODULE => crm,  READONLY => false, ),

                allEmployeeList => array(STEP => 2, TYPE => FK, ANSWER => crm_employee, ANSMODULE => crm, CATEGORY => ITEMS, ITEM => '', 
                                            WHERE=>"orgunit_id = §orgunit_id§",
                                            FORMAT=>retrieve, // HIDE_COLS=>array("id_sh_org", "id_sh_div", "last_empl_date", "idn"),
                                            SHOW => true, 
                                            EDIT => false, ICONS=>true, 'DELETE-ICON'=>false, 
                                            BUTTONS=>true, "NO-LABEL"=>false, ),                

                assignedRequests => array(STEP => 3, TYPE => FK, ANSWER => request, ANSMODULE => crm, CATEGORY => ITEMS, ITEM => '', 
                                            WHERE=>"orgunit_id = §orgunit_id§",
                                            FORMAT=>retrieve, // HIDE_COLS=>array("id_sh_org", "id_sh_div", "last_empl_date", "idn"),
                                            SHOW => true, 
                                            EDIT => false, ICONS=>true, 'DELETE-ICON'=>false, 
                                            BUTTONS=>true, "NO-LABEL"=>false, ),                                

                created_by => array(STEP=>99, SHOW => true, "TECH_FIELDS-RETRIEVE" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                created_at => array(STEP=>99, SHOW => true, "TECH_FIELDS-RETRIEVE" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                updated_by => array(STEP=>99, SHOW => true, "TECH_FIELDS-RETRIEVE" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                updated_at => array(STEP=>99, SHOW => true, "TECH_FIELDS-RETRIEVE" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                validated_by => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                validated_at => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                active => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, QEDIT => false, "DEFAULT" => 'Y', TYPE => YN),
                version => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => INT),
                update_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                delete_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                display_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                sci_id => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => scenario_item, ANSMODULE => pag),
                tech_notes 	    => array(TYPE => TEXT, CATEGORY => FORMULA, "SHOW-ADMIN" => true, 'STEP' =>"all", TOKEN_SEP=>"§", READONLY=>true, "NO-ERROR-CHECK"=>true),
	);
	
	*/ public function __construct(){
		parent::__construct("crm_orgunit","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "";
                $this->ORDER_BY_FIELDS = "orgunit_id";
                 
                
                $this->UNIQUE_KEY = array('orgunit_id');
                $this->editByStep = true;
                $this->editNbSteps = 3;
                
                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;
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
                        
                        if($empl_id) $iam_general_supervisor = CrmObject::userConnectedIsGeneralSupervisor();
                        if($empl_id) $iam_supervisor = CrmObject::userConnectedIsSupervisor();
                        
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
        
        
        
        public static function loadByMainIndex($orgunit_id,$create_obj_if_not_found=false)
        {
           $obj = new CrmOrgunit();
           if(!$orgunit_id) $obj->simpleError("loadByMainIndex : orgunit_id is mandatory field");


           $obj->select("orgunit_id",$orgunit_id);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
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
             
             
             
                return $otherLinksArray;
        }


        
        
        protected function getPublicMethods()
        {
                $pbms = array();
                $iam_general_supervisor = CrmObject::userConnectedIsGeneralSupervisor();
                if($iam_general_supervisor)
                {
                        
                        
                        $color = "green";
                        $title_ar = "اسناد الطلبات إلى المنسقبن"; 
                        $methodName = "requestAssignement";
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
                                "PUBLIC"=>true, "BF-ID"=>"", "HZM-SIZE" =>12, 'STEP'=>$this->stepOfAttribute("allEmployeeList"),
                                
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
                                "PUBLIC"=>true, "BF-ID"=>"", "HZM-SIZE" =>12, 'STEP'=>$this->stepOfAttribute("allEmployeeList"),
                                
                                /* CONFIRMATION_NEEDED=>true,
                                'CONFIRMATION_WARNING' =>array('ar' => "xxxxxx", 
                                                                'en' => "@todo"),
                                'CONFIRMATION_QUESTION' =>array('ar' => "yyyyy", 
                                                        'en' => "@todo"),
                                'MODE' =>array("mode_diploma_approved"=>true),
                                */
                                );


                                
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
                Request::resetAssignSupervisors($lang="ar");
        }

        public function supervisorAssignement($lang="ar")
        {
                Request::silentAssignSupervisorForNonAssigned($lang="ar");
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
                                     (status_id in (".Request::$REQUEST_STATUSES_ONGOING_ALL.") and (employee_id is null or employee_id not in ($arrInvTxt)))");
                }
                else
                {
                        $obj->where("(status_id in (".Request::$REQUEST_STATUSES_ONGOING_ALL.") and (employee_id is null or employee_id not in ($arrInvTxt)))");
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
                $obj->where("status_id in (".Request::$REQUEST_STATUSES_ONGOING_ALL.") and (employee_id is null or employee_id = 0)");
                $nb_assigned = 0;
                $requestWaitingList = $obj->loadMany();
                foreach($requestWaitingList as $requestWaitingObj)
                {
                        $investigator_to_assign = getPrioInvestigator($inbox_arr);  
                        if($investigator_to_assign>0) 
                        {
                                $requestWaitingObj->assignRequest($investigator_to_assign,$lang);                      
                                $nb_assigned++;
                                $inbox_arr[$investigator_to_assign]++;
                        }
                }

                return array("",$nb_resetted." ".AfwLanguageHelper::tarjemMessage("request's reset","crm",$lang).", ".$nb_assigned." ".AfwLanguageHelper::tarjemMessage("request's assign","crm",$lang),"");
        }
        
        public function fld_CREATION_USER_ID()
        {
                return "created_by";
        }
 
        public function fld_CREATION_DATE()
        {
                return "created_at";
        }
 
        public function fld_UPDATE_USER_ID()
        {
        	return "updated_by";
        }
 
        public function fld_UPDATE_DATE()
        {
        	return "updated_at";
        }
 
        public function fld_VALIDATION_USER_ID()
        {
        	return "validated_by";
        }
 
        public function fld_VALIDATION_DATE()
        {
                return "validated_at";
        }
 
        public function fld_VERSION()
        {
        	return "version";
        }
 
        public function fld_ACTIVE()
        {
        	return  "active";
        }
 
        public function isTechField($attribute) {
            return (($attribute=="created_by") or ($attribute=="created_at") or ($attribute=="updated_by") or ($attribute=="updated_at") or ($attribute=="validated_by") or ($attribute=="validated_at") or ($attribute=="version"));  
        }
        
        
        public function beforeDelete($id,$id_replace) 
        {
            
            
            if($id)
            {   
               if($id_replace==0)
               {
                   $server_db_prefix = AfwSession::config("db_prefix","c0"); // FK part of me - not deletable 

                        
                   $server_db_prefix = AfwSession::config("db_prefix","c0"); // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        $server_db_prefix = AfwSession::config("db_prefix","c0"); // FK on me 

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
        


        public function calcNew_requests_count()
        {
                // all requests count
                return self::calcRequests_countFor($only_done=false, $ongoing_only=false, $new_only=true, $aborted_only=false);
        }

        public function calcRequests_count()
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
		return AfwDateHelper::add_x_days_to_hijridate("",-540);
        }

        public function maxRecordsUmsCheck()
        {
                return 0;
        }
             
}
?>