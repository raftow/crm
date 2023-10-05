<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table crm_orgunit : crm_orgunit - جهات المتابعة و إعداداتها 
// ------------------------------------------------------------------------------------
// alter table c0crm.crm_employee add   admin char(1) DEFAULT NULL  after service_mfk;
// update c0crm.crm_employee set admin = 'N';
                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class CrmEmployee extends CrmObject
{

        // public static $MY_ATABLE_ID= ??; 
        // 117 CRM_INVESTIGATOR	محقق خدمة العملاء			
        public static $JOBROLE_CRM_INVESTIGATOR =  117;
        // 118 CRM_CONTROLLER	مراقب خدمة العملاء			
        public static $JOBROLE_CRM_CONTROLLER =  118;
        // 119 CRM_SUPERVISION	الإشراف العام	
        public static $JOBROLE_CRM_SUPERVISION =  119;		
        // 107 CRM_COORDINATION	مشرف تنسيق
        public static $JOBROLE_CRM_COORDINATION =  107;

     
        
	public static $DATABASE		= ""; 
        public static $MODULE		    = "crm"; 
        public static $TABLE			= ""; 
        public static $DB_STRUCTURE = null; /* = array(
        id => array(SHOW => true, RETRIEVE => true, EDIT => true, TYPE => PK,  CSS => width_pct_25),

		
	orgunit_id => array(SHORTNAME => orgunit,  SEARCH => true,  QSEARCH => true,  INTERNAL_QSEARCH => true,
                                SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => false,  EDIT_IF_EMPTY => true,
				SIZE => 40,  MANDATORY => true,  UTF8 => false,  CSS => width_pct_25,  
				TYPE => FK,  ANSWER => orgunit,  ANSMODULE => hrm,   
                                DEPENDENT_OFME=>array("employee_id"),
                                WHERE => "me.id in (select orgunit_id from c0crm.crm_orgunit where active='Y')",
				RELATION => OneToMany,   READONLY => true, ),


        employee_id => array(SHORTNAME => employee,  SEARCH => true,  QSEARCH => false, INTERNAL_QSEARCH => true,  
                                SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => false,  EDIT_IF_EMPTY => true,  CSS => width_pct_25,  
				SIZE => 40,  MANDATORY => true,  UTF8 => false,  
				TYPE => FK,  ANSWER => employee,  ANSMODULE => hrm,   
                                WHERE => "id_sh_div = §orgunit_id§ and jobrole_mfk like '%,117,%'",
                                DEPENDENCY=>orgunit_id, 
				RELATION => OneToMany,   READONLY => true, ),        

        requests_nb => array(SEARCH => true,  QSEARCH => false,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => false,  CSS => width_pct_25,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => "INT", "DEFAULT" => 15,  READONLY => false, ),


        service_category_mfk => array(SHORTNAME => categorys,  SEARCH => true,  QSEARCH => false,  SHOW => true,  RETRIEVE => false,  
				EDIT => true,  QEDIT => false,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => MFK,  ANSWER => service_category, "DEFAULT" => ",1,",  ANSMODULE => crm,  READONLY => false, ),

		service_mfk => array(SHORTNAME => services,  SEARCH => true,  QSEARCH => false,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => false,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false, "DEFAULT" => ",1,",
				TYPE => MFK,  ANSWER => service,  ANSMODULE => crm,  READONLY => false, ),


        active => array(SHOW => true, RETRIEVE => true, EDIT => true, QEDIT => true, "DEFAULT" => 'Y', TYPE => YN),

        admin => array(SHOW => true, RETRIEVE => true,  SEARCH => true,  QSEARCH => true, EDIT => true, QEDIT => true, "DEFAULT" => 'N', TYPE => YN),

        ongoing_requests_count => array(SHOW=> true,  CSS => width_pct_25, CATEGORY => FORMULA, TYPE => "INT", 
                EDIT=>true,  READONLY => true,  RETRIEVE => true, ), 

        done_requests_count => array(SHOW=> true,  CSS => width_pct_25, CATEGORY => FORMULA, TYPE => "INT", 
                EDIT=>true,  READONLY => true,  RETRIEVE => true, ), 
        
        requests_count => array(SHOW=> true,  CSS => width_pct_25, CATEGORY => FORMULA, TYPE => "INT", 
                EDIT=>true,  READONLY => true,  RETRIEVE => true, ), 

        statif_pct => array(SHOW=> true,  CSS => width_pct_25, CATEGORY => FORMULA, TYPE => "PCTG", 
                EDIT=>true,  READONLY => true,  RETRIEVE => true, ), 


        'currentRequests' => array('STEP' => 2,  
				'TYPE' => 'FK',  'ANSWER' => 'request',  'ANSMODULE' => 'crm',  
				'CATEGORY' => 'ITEMS',  'ITEM' => '', //'HIDE_COLS' => ['employee_id','orgunit_id'],
				'WHERE' => "(1 or (orgunit_id = §orgunit_id§ and employee_id = §employee_id§) or (§orgunit_id§ = '70' and supervisor_id = §employee_id§)) and status_id not in (5,6,7,8,9)", 
				 'FORMAT' => 'retrieve',  'SHOW' => true,  'EDIT' => false,  'ICONS' => true,  'DELETE-ICON' => false,  'BUTTONS' => true,  'NO-LABEL' => false,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '', 
				),

	'finishedRequests' => array('STEP' => 2,  
				'TYPE' => 'FK',  'ANSWER' => 'request',  'ANSMODULE' => 'crm',  
				'CATEGORY' => 'ITEMS',  'ITEM' => '',  
				'WHERE' => "((orgunit_id = §orgunit_id§ and employee_id = §employee_id§) or (§orgunit_id§ = '70' and supervisor_id = §employee_id§)) and status_id in (5,6,7,8,9) and request_date >= §archive_date§",
				 'FORMAT' => 'retrieve',  'SHOW' => true,  'EDIT' => false,  'ICONS' => true,  'DELETE-ICON' => false,  'BUTTONS' => true,  'NO-LABEL' => false,  'SEARCH-BY-ONE' => '',  'DISPLAY' => true,  
				'DISPLAY-UGROUPS' => '',  'EDIT-UGROUPS' => '',               
                                
                
                created_by => array(STEP => 99, RETRIEVE => false, SHOW => true, EDIT => true, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                created_at => array(STEP => 99, RETRIEVE => false, SHOW => true, EDIT => true, TYPE => DATETIME),
                updated_by => array(STEP => 99, RETRIEVE => false, SHOW => true, EDIT => true, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                updated_at => array(STEP => 99, RETRIEVE => false, SHOW => true, EDIT => true, TYPE => DATETIME),
                validated_by => array(STEP => 99, RETRIEVE => false, SHOW => true, EDIT => true, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                validated_at => array(STEP => 99, RETRIEVE => false, SHOW => true, EDIT => true, TYPE => DATETIME),
                
                version => array(STEP => 99, RETRIEVE => false, SHOW => true, EDIT => true, TYPE => INT),
                update_groups_mfk => array(STEP => 99, RETRIEVE => false, SHOW => true, EDIT => true, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                delete_groups_mfk => array(STEP => 99, RETRIEVE => false, SHOW => true, EDIT => true, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                display_groups_mfk => array(STEP => 99, RETRIEVE => false, SHOW => true, EDIT => true, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                sci_id => array(STEP => 99, RETRIEVE => false, SHOW => true, EDIT => true, TYPE => FK, ANSWER => scenario_item, ANSMODULE => pag),
                tech_notes 	    => array(TYPE => TEXT, EDIT => true, SHOW => true, CATEGORY => FORMULA, STEP => 99, TOKEN_SEP=>"§", READONLY=>true, "NO-ERROR-CHECK"=>true),
	);
	
	*/ public function __construct(){
		parent::__construct("crm_employee","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "";
                $this->ORDER_BY_FIELDS = "orgunit_id, employee_id";
                 
                
                $this->UNIQUE_KEY = array('orgunit_id', 'employee_id');
                $this->editByStep = true;
                $this->editNbSteps = 3;
                
                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;

                $this->OwnedBy = array('module'=>"crm", 'afw'=>"CrmOrgunit");
	}

        

        public static function resetAll()
        {
           $obj = new CrmEmployee();
           $obj->setForce("active", "N");
           $obj->setForce("admin", "N");
           return $obj->update(false);           
        }
        
        public static function loadById($id)
        {
           $obj = new CrmEmployee();
           // $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
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
                        // he is allowed to see crm employee if :
                        // 1. he is a general supervisor 
                        // or
                        // 2. he is a supervisor

                        $employee_allowed_to_see_crm_employee_cond = 
                            "($iam_general_supervisor>0 or $iam_supervisor>0)";
                        
                        $this->where("($empl_id>0 and $employee_allowed_to_see_crm_employee_cond)"); 

                }
                        
                $selects = array();
                $this->select_visibilite_horizontale_default($dropdown, $selects);
        }
        
        
        public static function loadByMainIndex($orgunit_id, $employee_id, $create_obj_if_not_found=false)
        {
           $obj = new CrmEmployee();
           if(!$orgunit_id) $obj->throwError("loadByMainIndex : orgunit_id is mandatory field");
           if(!$employee_id) $obj->throwError("loadByMainIndex : employee_id is mandatory field");


           $obj->select("orgunit_id",$orgunit_id);
           $obj->select("employee_id",$employee_id);

           if($obj->load())
           {
                if(!$obj->getVal("service_category_mfk")) $obj->set("service_category_mfk", ",1,");
                if(!$obj->getVal("service_mfk")) $obj->set("service_mfk", ",1,");                 
                if(!$obj->getVal("requests_nb")) $obj->set("requests_nb", 15);                 
                
		
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("orgunit_id",$orgunit_id);
                $obj->set("employee_id",$employee_id);
                $obj->set("service_category_mfk", ",1,");
                $obj->set("service_mfk", ",1,");
                $obj->set("requests_nb", 15);                 

                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }


        public static function auserCrmEmployee($employee_id, $orgunit_id=0)
        {
                if(!$orgunit_id) $orgunit_id = CrmEmployee::orgOfEmployee($employee_id, false, true);

                if($orgunit_id>0) return CrmEmployee::checkExistance($orgunit_id, $employee_id);
                else return null;
        }
        

        public static function checkExistance($orgunit_id, $employee_id)
        {
                if(!$orgunit_id) return false;
                if(!$employee_id) return false;

                $objcrmemp = self::loadByMainIndex($orgunit_id, $employee_id, $create_obj_if_not_found=false);

                return $objcrmemp;
        }



        public function getDisplay($lang="ar")
        {
               
               $data = array();
               $link = array();
               

               list($data[0],$link[0]) = $this->displayAttribute("employee_id",false, $lang);
               list($data[1],$link[1]) = $this->displayAttribute("orgunit_id",false, $lang);

               
               return implode(" - ",$data);
        }

        public function getShortDisplay($lang="ar")
        {
               return $this->showAttribute("employee_id");
        }


        
        
        
        

        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")      
        {
             global $me, $objme, $lang;
             $otherLinksArray = $this->getOtherLinksArrayStandard($mode, false, $step);
             $my_id = $this->getId();
             $displ = $this->getDisplay($lang);
             
             
             
             return $otherLinksArray;
        }
        
        protected function getPublicMethods()
        {
            
            $pbms = array();
            
            $color = "green";
            $title_ar = "xxxxxxxxxxxxxxxxxxxx"; 
            //$pbms["xc123B"] = array("METHOD"=>"methodName","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");
            
            
            
            return $pbms;
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
        


        protected function afterInsert($id, $fields_updated) 
        {
                if($this->est("active") and ($this->getVal("employee_id")>0))
                {
                        $empl = $this->het("employee_id");
                        if($empl)
                        {
                                $empl->addMeThisJobrole(self::$JOBROLE_CRM_INVESTIGATOR);
                                $empl->updateMyUserInformation();
                        }
                }
        }

        protected function afterUpdate($id, $fields_updated) 
        {
                if(($this->getVal("employee_id")>0) and 
                   ($fields_updated["active"] or $fields_updated["admin"] or $fields_updated["super_admin"] or $fields_updated["requests_nb"]))
                {
                        $empl = $this->het("employee_id");
                        if($this->est("active"))
                        {
                                if($this->est("super_admin"))
                                {
                                     //
                                     $empl->addMeThisJobrole(self::$JOBROLE_CRM_INVESTIGATOR);
                                     $empl->addMeThisJobrole(self::$JOBROLE_CRM_COORDINATION);
                                     $empl->addMeThisJobrole(self::$JOBROLE_CRM_CONTROLLER);
                                     $empl->addMeThisJobrole(self::$JOBROLE_CRM_SUPERVISION);
                                     $empl->updateMyUserInformation();    
                                }
                                elseif($this->est("admin"))
                                {
                                        $empl->addMeThisJobrole(self::$JOBROLE_CRM_INVESTIGATOR);
                                        $empl->addMeThisJobrole(self::$JOBROLE_CRM_COORDINATION);
                                        $empl->addMeThisJobrole(self::$JOBROLE_CRM_CONTROLLER);
                                        $empl->removeMeThisJobrole(self::$JOBROLE_CRM_SUPERVISION);
                                        $empl->updateMyUserInformation();    
                                }
                                else
                                {
                                        $empl->addMeThisJobrole(self::$JOBROLE_CRM_INVESTIGATOR);
                                        $empl->removeMeThisJobrole(self::$JOBROLE_CRM_COORDINATION);
                                        $empl->removeMeThisJobrole(self::$JOBROLE_CRM_CONTROLLER);
                                        $empl->removeMeThisJobrole(self::$JOBROLE_CRM_SUPERVISION);
                                        $empl->updateMyUserInformation();    
                                }        
                        }
                        else
                        {
                                $empl->removeMeThisJobrole(self::$JOBROLE_CRM_COORDINATION);
                                $empl->removeMeThisJobrole(self::$JOBROLE_CRM_SUPERVISION);
                                $empl->removeMeThisJobrole(self::$JOBROLE_CRM_CONTROLLER);
                                $empl->updateMyUserInformation();    
                                // has been disabled so remove all ongoing assigned tickets   
                                $this->removeMeAllAssigned();
                        }
                         

                        Request::assignSupervisorForNonAssigned(false,true);
                }
        }


        private function removeMeAllAssigned()
        {
            $obj = new Request();

            $me_id = $this->getVal("employee_id");
            $me_org_id = $this->getVal("orgunit_id");


            $obj->where("supervisor_id = $me_id");
            $obj->where("status_id not in (6,7,8,9)");
            $obj->setForce("supervisor_id",0);
            $obj->update(false);


            
            $obj->where("(employee_id = $me_id and orgunit_id = $me_org_id)");
            $obj->where("status_id in (2,4)");
            $obj->setForce("employee_id",0);
            $obj->setForce("orgunit_id",0);
            $status_comment = "removeMeAllAssigned me_id=".$me_id;
            $obj->setForce("status_comment", $status_comment);
            $obj->update(false);
        }
        
        protected function beforeDelete($id,$id_replace) 
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


        


        public function  calcCrm_orgunit_id()        
        {
                if(!$this->getVal("orgunit_id")) return null;
                $obj = CrmOrgunit::loadByMainIndex($this->getVal("orgunit_id"));
                return $obj;
        }

        


        public function calcRequests_count($only_done=false, $ongoing_only=false, $satisfied_only=false, $surveyed_only=false)
        {
            if(!$this->getVal("employee_id")) return null;

            $employee_id = $this->getVal("employee_id");
            $orgunit_id = $this->getVal("orgunit_id");

            $obj = new Request();
            $obj->select("employee_id", $employee_id);
            $obj->select("orgunit_id", $orgunit_id);

            if($only_done) $obj->where("status_id in (".Request::$REQUEST_STATUSES_DONE.")");
            elseif($ongoing_only) $obj->where("status_id in (".Request::$REQUEST_STATUSES_ONGOING_INVESTIGATOR.")");

            if($satisfied_only) $obj->where("service_satisfied = 'Y'");

            if($surveyed_only) $obj->where("survey_sent = 'Y'");

            return $obj->count();
        }

        public function calcDone_requests_count($satisfied_only=false, $surveyed_only=false)
        {
                return $this->calcRequests_count($only_done=true, $ongoing_only=false, $satisfied_only, $surveyed_only);
        }

        public function calcDoneSurveyed_requests_count($satisfied_only=false)
        {
                return $this->calcDone_requests_count($satisfied_only, $surveyed_only=true);
        }

        public function calcDoneSurveyedSatisfied_requests_count()
        {
                return $this->calcDoneSurveyed_requests_count($satisfied_only=true);
        }

        public function calcOngoing_requests_count($satisfied_only=false, $surveyed_only=false)
        {
                return $this->calcRequests_count($only_done=false, $ongoing_only=true, $satisfied_only, $surveyed_only);
        }

        public function calcInbox_count()
        {
                if(!$this->getVal("employee_id")) return null;
                $myEmplId = $this->getVal("employee_id");
                if(CrmEmployee::isAdmin($myEmplId)) 
                {
                        $where_sql = "((".Request::inboxSqlCond("supervisor", $myEmplId, "").") or (".Request::inboxSqlCond("investigator", $myEmplId, "")."))";
                }
                else
                {
                        $where_sql = Request::inboxSqlCond("investigator", $myEmplId, "");
                }

                $obj = new Request();
                $obj->where($where_sql);

                return $obj->count();
        }


        public function calcStatif_pct()
        {
            $all_count = $this->calcDoneSurveyed_requests_count();
            if(!$all_count) return null;
            $satisfied_only_count = $this->calcDoneSurveyedSatisfied_requests_count();
            

            return round($satisfied_only_count*100/$all_count);
        }

        public static function getSupervisorArray()
        {
                $obj = new CrmEmployee();
                // $obj->select_visibilite_horizontale();
                $obj->select("admin","Y");
                $obj->select("active", 'Y');

                return $obj->loadMany();
        }

        public static function getSupervisorList()
        {
                
                $objList = self::getSupervisorArray();

                $supervList = array();

                foreach($objList as $objItem)
                {
                        $supervList[$objItem->getVal("employee_id")] = array('obj' => $objItem, 'curr' => 0);   // ->getDisplay("ar")
                }
                return $supervList;
        }

        public static function isAdmin($employee_id)
        {
                $obj = new CrmEmployee();
                $obj->select("admin","Y");
                $obj->select("employee_id",$employee_id);
                $obj->load();
                return $obj->id;

        }


        public static function isGeneralAdmin($employee_id)
        {
                $obj = new CrmEmployee();
                $obj->select("super_admin","Y");
                $obj->select("employee_id",$employee_id);
                $obj->load();
                return $obj->id;

        }

        public static function getInvestigatorListOfIds($orgunit_id)
        {
                $invList = self::getInvestigatorList($orgunit_id);

                $invListIds = array();
                foreach($invList as $id => $invObj)
                {
                        $invListIds[] = $invObj->id;
                }

                return array($invListIds, $invList);
        }

        public static function getInvestigatorList($orgunit_id, $except_investigator_id=0)
        {
                $obj = new CrmEmployee();
                if(!$orgunit_id) $obj->simpleError("getInvestigatorList need a correct and valid orgunit_id");
                // $obj->select_visibilite_horizontale();
                $obj->select("orgunit_id",$orgunit_id);
                $obj->select("active", 'Y');
                $obj->where("super_admin = 'N' and employee_id != $except_investigator_id");  
                // admin = 'N' and // rafik 30/8/2022 : I removed this from above acondition because admin (مشرف تنسيق) can be a supervisor 
                
                
                $objList = $obj->loadList("employee_id");

                return $objList;
        }

        public static function getInvestigatorArray($orgunit_id, $except_investigator_id=0)
        {
                $obj = new CrmEmployee();
                if(!$orgunit_id) $obj->simpleError("getInvestigatorList need a correct and valid orgunit_id");
                // $obj->select_visibilite_horizontale();
                $obj->select("orgunit_id",$orgunit_id);
                $obj->select("active", 'Y');
                $obj->where("admin = 'N' and super_admin = 'N' and employee_id != $except_investigator_id");
                
                $objList = $obj->loadMany();

                $investList = array();

                foreach($objList as $objItem)
                {
                        $investList[$objItem->getVal("employee_id")] = array('obj' => $objItem, 'curr' => 0);   // ->getDisplay("ar")
                }
                return $investList;
        }


        public static function orgOfEmployee($employee_id, $return_object=false, $return_id = true)
        {
                $obj = new CrmEmployee();
                // $obj->select_visibilite_horizontale();
                $obj->select("employee_id",$employee_id);
                $obj->select("active", 'Y');
                
                $objList = $obj->loadList("orgunit_id");

                if(count($objList)==1)
                {
                        foreach($objList as $objItem) 
                        {
                                if($return_object) return  $objItem;
                                elseif($return_id) return $objItem->id;
                                else 
                                {
                                        $lang = AfwSession::getSessionVar("lang");
                                        if(!$lang) $lang = "ar";
                                        return CrmEmployee::tt("المنسق(ـة) في") . " " . $objItem->getDisplay($lang);
                                }
                        }                
                }
                elseif(count($objList)>1)
                {
                        if($return_object) return  null;
                        elseif($return_id) return 0;
                        else 
                        {
                                $lang = AfwSession::getSessionVar("lang");
                                if(!$lang) $lang = "ar";
                                return "<div class='crm-warning'>".CrmEmployee::tt("معين في أكثر من جهة متابعة",$lang)."</div>";
                        }
                }
                else
                {
                        if($return_object) return  null;
                        elseif($return_id) return 0;
                        else 
                        {
                                $lang = AfwSession::getSessionVar("lang");
                                if(!$lang) $lang = "ar";
                                return "<div class='crm-warning'>".CrmEmployee::tt("غير معين في جهة متابعة",$lang)."</div>";
                        }
                }
        }

        public static function getBestAvailableInvestigator($orgunit_id, $except_investigator_id=0)
        {
                $investigatorList = self::getInvestigatorArray($orgunit_id);
                if($except_investigator_id) unset($investigatorList[$except_investigator_id]);
                else $except_investigator_id=0;
                // self::safeDie("investigatorList = ".var_export($investigatorList,true));
                $stats_arr = Request::aggreg($function="count(*)", $where="active='Y' and status_id in (".Request::$REQUEST_STATUSES_ONGOING_INVESTIGATOR.") and orgunit_id=$orgunit_id and employee_id > 0 and employee_id != $except_investigator_id", $group_by = "employee_id",$throw_error=true, $throw_analysis_crash=true);
                // self::safeDie("stats_arr = ".var_export($stats_arr,true));
                $best_investigator_id = 0;
                if(count($stats_arr)>0)
                {
                        $min_curr_count = 99999;
                        
                        foreach($stats_arr as $investigator_id => $curr_count)
                        {
                                $investigatorList[$investigator_id]["curr"] = $curr_count;
                                if(($curr_count < $min_curr_count) and ($investigatorList[$investigator_id]["obj"]))
                                {
                                        $min_curr_count = $curr_count;
                                        $best_investigator_id = $investigator_id; 
                                }

                        }
                }

                // but if one licensor doesn't have any previous request assigned he will not be in $stats_arr 
                // he should be the best_licensor because he have no request assigned, so check this :
                foreach($investigatorList as $investigator_id => $investigatorItem)
                {
                        if(!$investigatorItem["curr"]) $best_investigator_id = $investigator_id; 
                }


                
                
                if((!$best_investigator_id) or (!$investigatorList[$best_investigator_id]["obj"]))
                {
                        reset($investigatorList);
                        $first_item = current($investigatorList);
                        // self::safeDie("first_item = ".var_export($first_item,true)." investigatorList = ".var_export($investigatorList,true));
                        if($first_item["obj"]) $best_investigator_id = $first_item["obj"]->getVal("employee_id");
                }

                if($best_investigator_id) $return = $investigatorList[$best_investigator_id];
                else $return = null;

                // die("best_investigator_id = $best_investigator_id , return = ".var_export($return,true).", investigatorList = ".var_export($investigatorList,true));

                return array($best_investigator_id, $return, $investigatorList);

                
                
                
        }

        public static function getBestAvailableSupervisor($except_supervisor_id=0,$re_distribution=false)
        {
                global $allSupervisorList;
                if(!$allSupervisorList) $allSupervisorList = self::getSupervisorList();                
                $supervisorList = $allSupervisorList;
                if($except_supervisor_id) unset($supervisorList[$except_supervisor_id]);
                else $except_supervisor_id=0;                 
                // self::safeDie("supervisorList = ".var_export($supervisorList,true));
                $best_supervisor_id = 0;


                $stats_arr = Request::aggreg($function="count(*)", $where="active='Y' and status_id in (".Request::$REQUEST_STATUSES_ONGOING_SUPERVISOR.") and supervisor_id > 0 and supervisor_id != $except_supervisor_id", $group_by = "supervisor_id",$throw_error=true, $throw_analysis_crash=true);                                        
                if(count($stats_arr)>0)
                {
                        foreach($stats_arr as $superv_id => $curr_count)
                        {
                                $supervisorList[$superv_id]["curr"] = $curr_count;
                        }
                }



                $min_curr_count = 99999;

                foreach($supervisorList as $superv_id => $supervisorRow)
                {
                        $curr_count = $supervisorRow["curr"];
                        if(($curr_count < $min_curr_count) and ($supervisorRow["obj"]))
                        {
                                $min_curr_count = $curr_count;
                                $best_supervisor_id = $superv_id; 
                        }
                }


                if((!$best_supervisor_id) or (!$supervisorList[$best_supervisor_id]["obj"]))
                {
                        reset($supervisorList);
                        $first_item = current($supervisorList);
                        // self::safeDie("first_item = ".var_export($first_item,true)." supervisorList = ".var_export($supervisorList,true));
                        if($first_item["obj"]) $best_supervisor_id = $first_item["obj"]->getVal("employee_id");
                }

                if($best_supervisor_id) $return = $supervisorList[$best_supervisor_id];
                else $return = null;

                // self::safeDie("best_supervisor_id = $best_supervisor_id , return = ".var_export($return,true));

                return array($best_supervisor_id, $return, $supervisorList, $stats_arr);

                
                
                
        }

        public function assignMeAsRequestSupervisor($requestObj, $commit = true)
        {
                $requestObj->set("supervisor_id", $this->getVal("employee_id"));
                if($commit) $requestObj->commit();
        }


        public function assignMeAsRequestInvestigator($requestObj, $lang="ar")
        {
                list($err, $info) = $requestObj->assignRequest($this->getVal("employee_id"), $lang);
                if($err) AfwSession::pushError($err);
                if($info) AfwSession::pushInformation($info); 
        }

        public function calcArchive_date()
        {                
		return AfwDateHelper::shiftHijriDate("",-180);
        }


        protected function hideDisactiveRowsFor($auser)
        {
                if(!$auser) return true;
                if(CrmObject::userConnectedIsGeneralSupervisor($auser)) return false;
                if($auser->isAdmin()) return false;  
                return true;
        }
             
}
?>