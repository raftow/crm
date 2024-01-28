<?php
// ------------------------------------------------------------------------------------
// 7/4/2020 :
// alter table request_status change lookup_code lookup_code  varchar(128) NOT NULL;
// alter table c0crm.request_status add customer_status_name_ar varchar(128) NOT NULL;
// alter table c0crm.request_status add customer_status_name_en varchar(128) NOT NULL;
// update c0crm.request_status set customer_status_name_ar = request_status_name_ar;
// update c0crm.request_status set customer_status_name_en = request_status_name_en;


                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class RequestStatus extends AFWObject{

        public static $MY_ATABLE_ID=3570; 


        // lookup Value List codes 
        // NEW - طلب جديد  
        public static $REQUEST_STATUS_DRAFT = 1; 

        // MISSED_INFO -  عودة للعميل لاستكمال البيانات
        public static $REQUEST_STATUS_MISSED_INFO = 101; 

        // MISSED_FILES -  عودة للعميل لاستكمال المرفقات
        public static $REQUEST_STATUS_MISSED_FILES = 102; 
 
        // SENT - طلب مرسل  
        public static $REQUEST_STATUS_SENT = 2; 
 
        // REDIRECT - طلب إعادة التحويل  
        public static $REQUEST_STATUS_REDIRECT = 3; 
 
        // ONGOING - طلب تحت الإنجاز  
        public static $REQUEST_STATUS_ONGOING = 4;
        
        // DONE - تمت الإجابة  
        public static $REQUEST_STATUS_DONE = 5; 
 
        // CANCELED - طلب ملغى  
        public static $REQUEST_STATUS_CANCELED = 6; 
 
        // CLOSED - طلب مغلق  
        public static $REQUEST_STATUS_CLOSED = 7; 
 
        // REJECTED - طلب مرفوض  
        public static $REQUEST_STATUS_REJECTED = 8; 
 
        // IGNORED - طلب مهمل  
        public static $REQUEST_STATUS_IGNORED = 9;  


        
	public static $DATABASE		= ""; public static $MODULE		    = "crm"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; /* = array(
                id => array(SHOW => true, RETRIEVE => true, EDIT => true, TYPE => PK),

		
		lookup_code => array("TYPE" => "TEXT", "SHOW" => true, "RETRIEVE"=>true, "EDIT" => true, "SIZE" => 64, "QEDIT" => true, SHORTNAME=>code),

		request_status_name_ar => array(SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 128,  "MIN-SIZE" => 5,  CHAR_TEMPLATE => "ARABIC-CHARS,SPACE",  MANDATORY => true,  UTF8 => true,  
				TYPE => "TEXT",  READONLY => false, ),

		request_status_name_en => array(SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 128,  "MIN-SIZE" => 5,  CHAR_TEMPLATE => "ALPHABETIC,SPACE",  MANDATORY => true,  UTF8 => false,  
				TYPE => "TEXT",  READONLY => false, ),

                
                created_by => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                created_at => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                updated_by => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                updated_at => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                validated_by => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                validated_at => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                active => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => true, QEDIT => true, "DEFAULT" => 'Y', TYPE => YN),
                version => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => INT),
                update_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                delete_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                display_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                sci_id => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => scenario_item, ANSMODULE => pag),
                tech_notes 	    => array(TYPE => TEXT, CATEGORY => FORMULA, "SHOW-ADMIN" => true, 'STEP' =>"all", TOKEN_SEP=>"§", READONLY=>true, "NO-ERROR-CHECK"=>true),
	);
	
	*/ public function __construct(){
		parent::__construct("request_status","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "request_status_name_ar";
                $this->ORDER_BY_FIELDS = "lookup_code";
                $this->IS_LOOKUP = true; 
                $this->ignore_insert_doublon = true;
                $this->UNIQUE_KEY = array('lookup_code');
                
                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;
                $this->public_display = true;
	}
        
        public static function loadById($id)
        {
           $obj = new RequestStatus();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        
        
        public static function loadByMainIndex($lookup_code,$create_obj_if_not_found=false)
        {
           $obj = new RequestStatus();
           if(!$lookup_code) $obj->_error("loadByMainIndex : lookup_code is mandatory field");


           $obj->select("lookup_code",$lookup_code);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("lookup_code",$lookup_code);

                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }


        public function getDisplay($lang="ar")
        {
               
               if($this->getVal("request_status_name_$lang")) return $this->getVal("request_status_name_$lang");
               $data = array();
               $link = array();
               


               
               return implode(" - ",$data);
        }
        
        
        

        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")      
        {
             global $me, $objme, $lang;
             $otherLinksArray = array();
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
        
        
        public function beforeDelete($id,$id_replace) 
        {
            
            
            if($id)
            {   
               if($id_replace==0)
               {
                   $server_db_prefix = AfwSession::config("db_prefix","c0"); // FK part of me - not deletable 

                        
                   $server_db_prefix = AfwSession::config("db_prefix","c0"); // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 
                       // crm.request-حالة التذكرة	status_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.request set status_id='$id_replace' where status_id='$id' ");
                       // crm.response-الحالة الجديدة للطلب	new_status_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.response set new_status_id='$id_replace' where new_status_id='$id' ");
                       // crm.action_policy-حالة التذكرة قبل	old_status_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.action_policy set old_status_id='$id_replace' where old_status_id='$id' ");
                       // crm.action_policy-حالة التذكرة بعد	new_status_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.action_policy set new_status_id='$id_replace' where new_status_id='$id' ");

                        
                   
                   // MFK

               }
               else
               {
                        $server_db_prefix = AfwSession::config("db_prefix","c0"); // FK on me 
                       // crm.request-حالة التذكرة	status_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.request set status_id='$id_replace' where status_id='$id' ");
                       // crm.response-الحالة الجديدة للطلب	new_status_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.response set new_status_id='$id_replace' where new_status_id='$id' ");
                       // crm.action_policy-حالة التذكرة قبل	old_status_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.action_policy set old_status_id='$id_replace' where old_status_id='$id' ");
                       // crm.action_policy-حالة التذكرة بعد	new_status_id  حقل يفلتر به-ManyToOne
                        $this->execQuery("update ${server_db_prefix}crm.action_policy set new_status_id='$id_replace' where new_status_id='$id' ");

                        
                        // MFK

                   
               } 
               return true;
            }    
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
             
}
?>