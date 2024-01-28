<?php
// ------------------------------------------------------------------------------------
// 7/6/2022 rafik :
// alter table c0crm.request_file change description description varchar(196);
                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class RequestFile extends AFWObject{

        public static $MY_ATABLE_ID=13748; 
        // إجراء إحصائيات حول مرفقات المشاريع البحثية / التجارب 
        public static $BF_STATS_PRACTICE_FILE = 104091; 
        // إدارة مرفقات المشاريع البحثية / التجارب 
        public static $BF_QEDIT_PRACTICE_FILE = 104086; 
        // إنشاء مرفق ممارسة/تجربة 
        public static $BF_EDIT_PRACTICE_FILE = 104085; 
        // الاستعلام عن مرفق ممارسة/تجربة 
        public static $BF_QSEARCH_PRACTICE_FILE = 104090; 
        // البحث في مرفقات المشاريع البحثية / التجارب 
        public static $BF_SEARCH_PRACTICE_FILE = 104089; 
        // عرض تفاصيل مرفق ممارسة/تجربة 
        public static $BF_DISPLAY_PRACTICE_FILE = 104088; 
        // مسح مرفق ممارسة/تجربة 
        public static $BF_DELETE_PRACTICE_FILE = 104087; 

        
	public static $DATABASE		= ""; public static $MODULE		    = "crm"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; /* = array(
                id => array(SHOW => true, RETRIEVE => true, EDIT => true, TYPE => PK),

		
		request_id => array(SHORTNAME => request,  SEARCH => true,  QSEARCH => false,  SHOW => true,  RETRIEVE => false,  
				EDIT => true,  QEDIT => true,  
				SIZE => 32,  REQUIRED => true,  UTF8 => false,  
				TYPE => FK,  ANSWER => request,  ANSMODULE => crm,  AUTOCOMPLETE => true,  
				RELATION => OneToMany,  READONLY => false, ),

		description => array(SEARCH => true,  QSEARCH => true,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 128,  "MIN-SIZE" => 5,  CHAR_TEMPLATE => "",  REQUIRED => true,  UTF8 => true,  
				TYPE => "TEXT",  READONLY => false, ),
                
                doc_type_id => array(SHORTNAME => type,  SEARCH => true,  QSEARCH => false,  SHOW => true,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 40,  MAXLENGTH => 40,  REQUIRED => true,  UTF8 => false,  
				TYPE => FK,  ANSWER => doc_type,  ANSMODULE => pag,
                                WHERE=>"concat(',',valid_ext,',') like '%,§afile_ext§,%' and id in (§module_config_token_file_types§)",  
				RELATION => ManyToOne,  READONLY => false, ),

                afile_ext => array(TYPE => TEXT, CATEGORY => SHORTCUT, SHORTCUT=>"afile_id.afile_ext","CAN-BE-SETTED"=>false,"NO-COTE"=>true,),                

		afile_id => array(
			         SHORTNAME => "file",
				 SEARCH => true,  QSEARCH => false,  SHOW => true,  RETRIEVE => true,  
				EDIT => true, INPUT_WIDE=>true,  QEDIT => true,  
				SIZE => 255,  REQUIRED => true,  UTF8 => false,  
				TYPE => FK,  ANSWER => afile,  ANSMODULE => pag,  AUTOCOMPLETE => true,
                                	WHERE => "stakeholder_id=§MY_COMPANY§ and doc_type_id in (§module_config_token_file_types§)",  
				RELATION => ManyToOne,  READONLY => true, ),

                creation_user_id => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                creation_date => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                update_user_id => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                update_date => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                validation_user_id => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                validation_date => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                active => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => true, QEDIT => false, "DEFAULT" => 'Y', TYPE => YN),
                version => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => INT),
                update_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                delete_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                display_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                sci_id => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => scenario_item, ANSMODULE => pag),
                tech_notes 	    => array(TYPE => TEXT, CATEGORY => FORMULA, "SHOW-ADMIN" => true, 'STEP' =>"all", TOKEN_SEP=>"§", READONLY=>true, "NO-ERROR-CHECK"=>true),
	);
	
	*/ public function __construct(){
		parent::__construct("request_file","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "id";
                $this->ORDER_BY_FIELDS = "request_id, afile_id";
                 
                
                $this->UNIQUE_KEY = array('request_id','afile_id');
                
                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;

                $this->after_save_edit = array("class"=>'Request',"attribute"=>'request_id', "currmod"=>'crm',"currstep"=>4);
	}
        
        public static function loadById($id)
        {
           $obj = new RequestFile();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        
        
        public static function loadByMainIndex($request_id, $afile_id,$create_obj_if_not_found=false)
        {
           $obj = new RequestFile();
           if(!$request_id) $obj->_error("loadByMainIndex : request_id is mandatory field");
           if(!$afile_id) $obj->_error("loadByMainIndex : afile_id is mandatory field");


           $obj->select("request_id",$request_id);
           $obj->select("afile_id",$afile_id);

           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("request_id",$request_id);
                $obj->set("afile_id",$afile_id);

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
               
               $fle = $this->hetFile();
               if($fle) return $fle->getShortDisplay($lang);

               list($data[0],$link[0]) = $this->displayAttribute("id",false, $lang);

               
               return implode(" - ",$data);
        }
        
        
        

        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")      
        {
                global $lang;
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
            return (($attribute=="creation_user_id") or ($attribute=="creation_date") or ($attribute=="update_user_id") or ($attribute=="update_date") or ($attribute=="validation_user_id") or ($attribute=="validation_date") or ($attribute=="version"));  
        }
        
        public function beforeMAJ($id, $fields_updated) 
        {
                if(!$this->getVal("doc_type_id")) {
                           /*
                           $prObj = $this->hetRequest();
                           if($prObj)
                           {
                          
                           }
                           */
                }

		return true;
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
        
        
        public function userCanDeleteMeSpecial($auser)
        {
                $log = "";
                
                $prc = $this->hetRequest();
                if(!$prc) return true;
                /*
                if($prc->_isSubmitted()) $log .= "_isSubmitted";
                else $log .= "is not Submitted";
                
                if($this->getId() == 17) die("log : $log");
                */
                return (!$prc->estSubmitted());
        }

        protected function attributeCanBeEditedBy($attribute, $user, $desc)
        {
            $prcObj = $this->hetRequest();
            if($prcObj->estSubmitted() and (!$desc["JUSTPROP"])) return array(false, "The request is submitted and $attribute is not setted as JUSTPROP (no impact)"); //  ($attribute!="approve_order") and ($attribute!="vote_order")
              
            return [true, ''];
        }
             
}
?>