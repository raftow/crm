<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table crm_orgunit : crm_orgunit - وحدات المتابعة و إعداداتها 
// ------------------------------------------------------------------------------------
// alter table ".$server_db_prefix."crm.crm_emp_note add   admin char(1) DEFAULT NULL  after service_mfk;
// update ".$server_db_prefix."crm.crm_emp_note set admin = 'N';

$file_dir_name = dirname(__FILE__);

// old include of afw.php

class CrmEmpNote extends CrmObject
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
        public static $TABLE                        = "crm_emp_note";
        public static $DB_STRUCTURE = null;

        public function __construct()
        {
                parent::__construct("crm_emp_note", "id", "crm");
                CrmCrmEmpNoteAfwStructure::initInstance($this);
        }

        public static function notedAll()
        {
                $obj = new CrmEmpNote();
                $obj->setForce("noted", "Y");
                return $obj->update(false);
        }

        public static function loadById($id)
        {
                $obj = new CrmEmpNote();
                // $obj->select_visibilite_horizontale();
                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }

        public static function loadByMainIndex($orgunit_id, $employee_id, $note_date, $create_obj_if_not_found = false)
        {
                if (!$orgunit_id) throw new AfwRuntimeException("loadByMainIndex : orgunit_id is mandatory field");
                if (!$employee_id) throw new AfwRuntimeException("loadByMainIndex : employee_id is mandatory field");
                if (!$note_date) throw new AfwRuntimeException("loadByMainIndex : employee_id is mandatory field");

                $obj = new CrmEmpNote();
                $obj->select("orgunit_id", $orgunit_id);
                $obj->select("employee_id", $employee_id);
                $obj->select("note_date", $note_date);

                if ($obj->load()) {
                        if ($create_obj_if_not_found) $obj->activate();
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set("orgunit_id", $orgunit_id);
                        $obj->set("employee_id", $employee_id);
                        $obj->set("note_date", $note_date);

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
                list($data[2], $link[2]) = $this->displayAttribute("note_date", false, $lang);


                return implode(" - ", $data);
        }

        protected function initObject()
        {
            $this->setSlient("note_date", AfwDateHelper::currentHijriDate());
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
                $objme = AfwSession::getUserConnected();
                
                $pbms = array();
                $employee_id = $this->getVal("employee_id");
                if ($employee_id and $objme and $objme->isAdmin()) 
                {
                        if(!$this->sureIs("noted")) {
                                $color = "blue";
                                $title_ar = "تمت استجابة الموظف للملاحظة";
                                $pbms["Ac122B"] = array(
                                        "METHOD" => "makeNoted",
                                        "COLOR" => $color,
                                        "LABEL_AR" => $title_ar,
                                        "PUBLIC" => true,
                                        "BF-ID" => "",
                                );
                        }
                }


                return $pbms;
        }



        public function makeNoted($lang = 'ar')
        {
                $err = "";
                $info = "Noted Done";
                $war = "";
                $this->set("noted", "Y");
                
                $this->commit();

                return [$err, $info, $war];
        }


        public function beforeMaj($id, $fields_updated)
        {
                $lang = AfwLanguageHelper::getGlobalLanguage();
                

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
