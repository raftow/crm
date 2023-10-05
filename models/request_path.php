<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table request_path : request_path - مسارات الطلبات الالكترونية 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class RequestPath extends AFWObject{

        public static $MY_ATABLE_ID=13459; 

        
	public static $DATABASE		= ""; public static $MODULE		    = "crm"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; /* = array(
        id => array(SHOW => true, RETRIEVE => true, EDIT => true, TYPE => PK),

        orgunit_id => array(SHORTNAME => orgunit,  SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => FK,  ANSWER => orgunit,  ANSMODULE => crm,  
				RELATION => ManyToOne,  READONLY => false, ),

                
        service_category_id => array(SHORTNAME => category,  SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => FK,  ANSWER => service_category,  ANSMODULE => crm,  
				RELATION => ManyToOne,  READONLY => false, ),

        service_id => array(SHORTNAME => service,  SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => FK,  ANSWER => service,  ANSMODULE => crm,  
                WHERE => "service_category_id = §service_category_id§",
                DEPENDENCIES=>array("service_category_id"),                 
				RELATION => ManyToOne,  READONLY => false, ),

        request_type_mfk => array(SHORTNAME => types,  SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => MFK,  ANSWER => request_type,  ANSMODULE => crm,  
				RELATION => ManyToOne,  READONLY => false, ),

		prio_min => array(SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => ENUM,  ANSWER => request_prio,  ANSMODULE => crm,  READONLY => false, ),

		prio_max => array(SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => false,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => ENUM,  ANSWER => request_prio,  ANSMODULE => crm,  READONLY => false, ),

        customer_type_mfk => array(SHORTNAME => types,  SEARCH => true,  QSEARCH => false,  SHOW => true,  RETRIEVE => false,  
				EDIT => true,  QEDIT => false,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => MFK,  ANSWER => customer_type,  ANSMODULE => crm,  READONLY => false, ),

		responsibility_1_id => array(SHORTNAME => responsibility1,  SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => FK,  ANSWER => jobrole, ANSMODULE => pag,  
				RELATION => ManyToOne,  READONLY => false, ),

        responsibility_1_desc => array(SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => AEREA,  MANDATORY => true,  UTF8 => false,  
				TYPE => TEXT,  
				READONLY => false, ),                

        responsibility_2_required => array(SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => YN,  
				READONLY => false, ),                

        responsibility_2_id => array(SHORTNAME => responsibility2,  SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => FK,  ANSWER => jobrole, ANSMODULE => pag,  
				RELATION => ManyToOne,  READONLY => false, ),
        
        responsibility_2_desc => array(SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => AEREA,  MANDATORY => true,  UTF8 => false,  
				TYPE => TEXT,  
				READONLY => false, ),

        responsibility_3_required => array(SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => YN,  
				READONLY => false, ),                

        responsibility_3_id => array(SHORTNAME => responsibility3,  SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 32,  MANDATORY => true,  UTF8 => false,  
				TYPE => FK,  ANSWER => jobrole, ANSMODULE => pag,  
				RELATION => ManyToOne,  READONLY => false, ),
        
        responsibility_3_desc => array(SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => AEREA,  MANDATORY => true,  UTF8 => false,  
				TYPE => TEXT,  
				READONLY => false, ),
                
        
                
                created_by => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                created_at => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                updated_by => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                updated_at => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
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
		parent::__construct("request_path","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "";
                $this->ORDER_BY_FIELDS = "orgunit_id, service_category_id, service_id, request_type_mfk, prio_min, prio_max, customer_type_mfk";
                 
                
                $this->UNIQUE_KEY = array('orgunit_id', 'service_category_id', 'service_id', 'request_type_mfk', 'prio_min', 'prio_max', 'customer_type_mfk');
                
                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;
	}
        
        public static function loadById($id)
        {
           $obj = new RequestPath();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        
        
        public static function loadByMainIndex($prio_max,$create_obj_if_not_found=false)
        {
           $obj = new RequestPath();
           if(!$prio_max) $obj->_error("loadByMainIndex : prio_max is mandatory field");


           $obj->select("prio_max",$prio_max);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("prio_max",$prio_max);

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
               

               list($data[0],$link[0]) = $this->displayAttribute("program_id",false, $lang);
               list($data[1],$link[1]) = $this->displayAttribute("request_type_id",false, $lang);
               list($data[2],$link[2]) = $this->displayAttribute("prio_min",false, $lang);

               
               return implode(" - ",$data);
        }
        
        
        
        public function list_of_prio_min() { 
            $list_of_items = array(); 
            $list_of_items[2] = "أولوية عالية";  //     code : HIGH_PRIO 
            $list_of_items[4] = "أولوية منخفضة";  //     code : LOW_PRIO 
            $list_of_items[3] = "أولوية عادية";  //     code : NORMAL_PRIO 
            $list_of_items[1] = "أولوية قصوى";  //     code : URGENT 
           return  $list_of_items;
        } 


        public function list_of_prio_max() { 
            $list_of_items = array(); 
            $list_of_items[2] = "أولوية عالية";  //     code : HIGH_PRIO 
            $list_of_items[4] = "أولوية منخفضة";  //     code : LOW_PRIO 
            $list_of_items[3] = "أولوية عادية";  //     code : NORMAL_PRIO 
            $list_of_items[1] = "أولوية قصوى";  //     code : URGENT 
           return  $list_of_items;
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