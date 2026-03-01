<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table crm_orgunit : crm_orgunit - جهات المتابعة و إعداداتها 
// ------------------------------------------------------------------------------------
// alter table ".$server_db_prefix."crm.crm_emp_request add   admin char(1) DEFAULT NULL  after service_mfk;
// update ".$server_db_prefix."crm.crm_emp_request set admin = 'N';

$file_dir_name = dirname(__FILE__);

// old include of afw.php

class CrmEmpRequest extends CrmObject
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



        public static $DATABASE                = "";
        public static $MODULE                    = "crm";
        public static $TABLE                        = "crm_emp_request";
        public static $DB_STRUCTURE = null;

        public function __construct()
        {
                parent::__construct("crm_emp_request", "id", "crm");
                CrmCrmEmpRequestAfwStructure::initInstance($this);
        }

        public static function resetAll()
        {
                $obj = new CrmEmpRequest();
                $obj->setForce("active", "N");
                $obj->setForce("admin", "N");
                return $obj->update(false);
        }

        public static function loadById($id)
        {
                $obj = new CrmEmpRequest();
                // $obj->select_visibilite_horizontale();
                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }

        public function getScenarioItemId($currstep)
        {
                if ($currstep == 1) return 502;
                if ($currstep == 2) return 503;
                if ($currstep == 3) return 504;

                return 0;
        }

        public static function loadByMainIndex($orgunit_id, $employee_id, $email, $create_obj_if_not_found = false)
        {
                if (!$orgunit_id) throw new AfwRuntimeException("loadByMainIndex : orgunit_id is mandatory field");
                if (!$employee_id) throw new AfwRuntimeException("loadByMainIndex : employee_id is mandatory field");


                $obj = new CrmEmpRequest();
                $obj->select("orgunit_id", $orgunit_id);
                $obj->select("employee_id", $employee_id);
                $obj->select("email", $email);

                if ($obj->load()) {
                        if ($create_obj_if_not_found) $obj->activate();
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set("orgunit_id", $orgunit_id);
                        $obj->set("employee_id", $employee_id);
                        $obj->set("email", $email);

                        $obj->insertNew();
                        if (!$obj->id) return null; // means beforeInsert rejected insert operation
                        $obj->is_new = true;
                        return $obj;
                } else return null;
        }

        public function getDisplay($lang = "ar")
        {

                $data = array();
                $link = array();


                list($data[0], $link[0]) = $this->displayAttribute("employee_id", false, $lang);
                list($data[1], $link[1]) = $this->displayAttribute("orgunit_id", false, $lang);
                list($data[2], $link[2]) = $this->displayAttribute("email", false, $lang);


                return implode(" - ", $data);
        }

        protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
        {
                global $me, $objme, $lang;
                $otherLinksArray = $this->getOtherLinksArrayStandard($mode, false, $step);
                $my_id = $this->getId();
                $displ = $this->getDisplay($lang);



                return $otherLinksArray;
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

        public function isTechField($attribute)
        {
                return (($attribute == "created_by") or ($attribute == "created_at") or ($attribute == "updated_by") or ($attribute == "updated_at") or ($attribute == "validated_by") or ($attribute == "validated_at") or ($attribute == "version"));
        }


        protected function getPublicMethods()
        {

                $pbms = array();
                $employee_id = $this->getVal("employee_id");
                if ($employee_id) {
                        $methodConfirmationWarningEn = "You formally agree that this employee belongs to this organization";
                        $methodConfirmationWarning = $this->tm($methodConfirmationWarningEn, "ar");                        

                        $methodConfirmationQuestionEn = "Are you sure you want to do this approve ?";
                        $methodConfirmationQuestion = $this->tm($methodConfirmationQuestionEn, "ar");
                        $color = "blue";
                        $title_ar = "تعيين هذا الموظف منسقا على هذه الجهة وعكس صلاحياته";
                        // else $title_ar = "عكس التحديثات على الصلاحيات  والبيانات";
                        $pbms["Ac122B"] = array(
                                "METHOD" => "approveAndUpdateDataAndRoles",
                                "COLOR" => $color,
                                "LABEL_AR" => $title_ar,
                                "PUBLIC" => true,
                                "BF-ID" => "",
                                'CONFIRMATION_NEEDED' => true,
                                'CONFIRMATION_WARNING' => array('ar' => $methodConfirmationWarning, 'en' => $methodConfirmationWarningEn),
                                'CONFIRMATION_QUESTION' => array('ar' => $methodConfirmationQuestion, 'en' => $methodConfirmationQuestionEn),
                        );
                
                        $methodConfirmationWarningEn = "This action can not be canceled !";
                        $methodConfirmationWarning = $this->tm($methodConfirmationWarningEn, "ar");

                        $methodConfirmationQuestionEn = "Are you sure you want to reset the password ?";
                        $methodConfirmationQuestion = $this->tm($methodConfirmationQuestionEn, "ar");
                        $color = "green";
                        $title_ar = "إعادة انشاء كلمة مرور مؤقتة";
                        $pbms["xc123B"] = array(
                                "METHOD" => "temporaryPassword",
                                "COLOR" => $color,
                                "LABEL_AR" => $title_ar,
                                "PUBLIC" => true,
                                "BF-ID" => "",
                                'CONFIRMATION_NEEDED' => true,
                                'CONFIRMATION_WARNING' => array('ar' => $methodConfirmationWarning, 'en' => $methodConfirmationWarningEn),
                                'CONFIRMATION_QUESTION' => array('ar' => $methodConfirmationQuestion, 'en' => $methodConfirmationQuestionEn),
                        );
                }

                if (!$this->estApproved()) {
                        $methodConfirmationWarningEn = "We can not automatically approve that this employee is from this organization";
                        $methodConfirmationWarning = $this->tm($methodConfirmationWarningEn, "ar");

                        $methodConfirmationQuestionEn = "Are you sure you want to approve this employee on this organization inspite of the aobove explanation ?";
                        $methodConfirmationQuestion = $this->tm($methodConfirmationQuestionEn, "ar");
                        $color = "green";
                        $title_ar = "اعتمد هذا الموظف على هذه الجهة";
                        $pbms["xc123B"] = array(
                                "METHOD" => "approveAnyWay",
                                "COLOR" => $color,
                                "LABEL_AR" => $title_ar,
                                "PUBLIC" => true,
                                "STEP" => 2,
                                'confirmation_needed' => true,
                                'CONFIRMATION_WARNING' => array('ar' => $methodConfirmationWarning, 'en' => $methodConfirmationWarningEn),
                                'CONFIRMATION_QUESTION' => array('ar' => $methodConfirmationQuestion, 'en' => $methodConfirmationQuestionEn),
                        );
                }



                return $pbms;
        }



        public function approveAndUpdateDataAndRoles($lang = 'ar', $pbm = true, $commit = true)
        {
                // $orgunit_id = $this->getVal("orgunit_id");
                $employee_id = $this->getVal("employee_id");
                $email = $this->getVal("email");

                $main_orgunit_id = AfwSession::config("main_orgunit_id", 1);
                $emplObj = Employee::loadByEmail($main_orgunit_id, $email, true);
                list($err, $info) = $emplObj->updateMyInfosFromExternalSources($lang);
                if ($err) {
                        $this->set("approved", "N");
                        $this->set("log_text", $info);
                        $this->set("error_text", $err);
                } else {
                        // $emplObj_name_ar = $emplObj->getDisplay("ar");
                        // $emplObj_name_en = $emplObj->getDisplay("en");
                        $company_id = $emplObj->getVal("id_sh_org");
                        $department_id = $emplObj->getVal("id_sh_dep");
                        $division_id = $emplObj->getVal("id_sh_div");
                        $employee_id = $emplObj->id;
                        // $sh_name_ar = $emplObj->showAttribute("id_sh_org", null, true, "ar") . " >> " . $emplObj->showAttribute("id_sh_dep", null, true, "ar") . "-" . $emplObj->showAttribute("id_sh_div", null, true, "ar");
                        // $sh_name_en = $emplObj->showAttribute("id_sh_org", null, true, "en") . " >> " . $emplObj->showAttribute("id_sh_dep", null, true, "en") . "-" . $emplObj->showAttribute("id_sh_div", null, true, "en");
                        $this->set("approved", "Y");
                        $this->set("employee_id", $employee_id);
                        $this->set("division_id", $division_id);
                        $this->set("department_id", $department_id);
                        $this->set("company_id", $company_id);
                        $this->set("log_text", $info);
                        $this->set("error_text", "--");
                }

                if ($commit) $this->commit();

                return $this->sureIs("approved");
        }


        public function beforeMaj($id, $fields_updated)
        {
                $lang = AfwLanguageHelper::getGlobalLanguage();
                $email = $this->getVal("email");
                $orgunit_id = $this->getVal("orgunit_id");
                $employee_id = $this->getVal("employee_id");
                $approved = $this->sureIs("approved");

                if ($fields_updated["email"] and $email) {
                        $this->approveAndUpdateDataAndRoles($lang, $pbm = true, $commit = false);
                }
                
                if ($this->sureIs("active") and $approved  and ($orgunit_id > 0) and ($employee_id > 0)) {
                        $this->calcCrm_orgunit_id('object', $create_obj_if_not_found = true);
                        $this->calcCrm_employee_id('object', $create_obj_if_not_found = true);
                }


                return true;
        }

        public function afterUpdate($id, $fields_updated, $disableAfterCommitDBEvent = false) {}

        public function  calcCrm_orgunit_id($what='value', $create_obj_if_not_found = false)
        {
                if (!$this->getVal("orgunit_id")) $obj = null;
                else $obj = CrmOrgunit::loadByMainIndex($this->getVal("orgunit_id"), $create_obj_if_not_found);
                return AfwLoadHelper::giveWhat($obj, $what);
        }

        public function  calcCrm_employee_id($what='value', $create_obj_if_not_found = false)
        {
                $employee_id = $this->getVal("employee_id");
                $orgunit_id = $this->getVal("orgunit_id");
                if (!$employee_id) $obj = null;
                elseif (!$orgunit_id) $obj = null;
                else $obj = CrmEmployee::loadByMainIndex($orgunit_id, $employee_id, $create_obj_if_not_found);
                
                return AfwLoadHelper::giveWhat($obj, $what);
        }


        public function beforeDelete($id,$id_replace) 
        {
            $server_db_prefix = AfwSession::config("db_prefix","tvtc_");
            
            if(!$id)
            {
                $id = $this->getId();
                $simul = true;
            }
            else
            {
                $simul = false;
            }
            
            if($id)
            {   
               if($id_replace==0)
               {
                   // FK part of me - not deletable 

                        
                   // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        // FK on me 

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
}
