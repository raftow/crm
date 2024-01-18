<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of �table� acity : acity - المدن 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class Acity extends AFWObject{

        public static $MY_ATABLE_ID=3621; 
        // إدارة المدن 
        public static $BF_QEDIT_ACITY = 104193; 
        // إنشاء مدينة 
        public static $BF_EDIT_ACITY = 104192; 
        // الاستعلام عن مدينة 
        public static $BF_QSEARCH_ACITY = 104197; 
        // البحث في المدن 
        public static $BF_SEARCH_ACITY = 104196; 
        // عرض تفاصيل مدينة 
        public static $BF_DISPLAY_ACITY = 104195; 
        // مسح مدينة 
        public static $BF_DELETE_ACITY = 104194; 


 // lookup Value List codes 
  
        
	public static $DATABASE		= ""; public static $MODULE		    = "crm"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; /* = array(
                id => array(SHOW => true, RETRIEVE => true, EDIT => true, TYPE => PK),

		
		lookup_code => array("TYPE" => "TEXT", "SHOW" => true, "RETRIEVE"=>true, "EDIT" => true, "SIZE" => 64, "QEDIT" => true, SHORTNAME=>code),

		acountry_id => array(SHORTNAME => acountry,  
				WHERE => "", 
                "DEFAULT" => 183,
                DEPENDENT_OFME=>array("aregion_id", ),
				 SEARCH => true,  QSEARCH => true,  SHOW => true,  AUDIT => false,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 40,  MAXLENGTH => 32,  UTF8 => false,  
				TYPE => FK,  ANSWER => acountry,  ANSMODULE => crm,  AUTOCOMPLETE => true,  
				RELATION => ManyToOne,  READONLY => false, ),

		aregion_id => array(SHORTNAME => aregion,  SEARCH => true,  QSEARCH => true,  SHOW => true,  AUDIT => false,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 40,  MAXLENGTH => 32,  UTF8 => false,  
				TYPE => FK,  ANSWER => aregion,  ANSMODULE => crm,  
				RELATION => ManyToOne,  
                WHERE=>"acountry_id = §acountry_id§",
                DEPENDENCY=>acountry_id,
                
                READONLY => false, ),

		city_name_ar => array(SEARCH => true,  QSEARCH => false,  SHOW => true,  AUDIT => false,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 32,  MAXLENGTH => 48,  "MIN-SIZE" => 5,  CHAR_TEMPLATE => "ALPHABETIC,SPACE",  UTF8 => true,  
				TYPE => "TEXT",  READONLY => false, ),

		city_name_en => array(SEARCH => true,  QSEARCH => false,  SHOW => true,  AUDIT => false,  RETRIEVE => true,  
				EDIT => true,  QEDIT => true,  
				SIZE => 32,  MAXLENGTH => 48,  "MIN-SIZE" => 5,  CHAR_TEMPLATE => "ALPHABETIC,SPACE",  UTF8 => false,  
				TYPE => "TEXT",  READONLY => false, ),

                
                created_by => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                created_at => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                updated_by => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                updated_at => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                validated_by => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => auser, ANSMODULE => ums),
                validated_at => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => DATETIME),
                active => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => true, QEDIT => true, "DEFAULT" => 'Y', TYPE => YN),
                draft => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => true, QEDIT => true, "DEFAULT" => 'Y', TYPE => YN),
                version => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => INT),
                update_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                delete_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                display_groups_mfk => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, ANSWER => ugroup, ANSMODULE => ums, TYPE => MFK),
                sci_id => array("SHOW-ADMIN" => true, RETRIEVE => false, EDIT => false, TYPE => FK, ANSWER => scenario_item, ANSMODULE => pag),
                tech_notes 	    => array(TYPE => TEXT, CATEGORY => FORMULA, "SHOW-ADMIN" => true, 'STEP' =>"all", TOKEN_SEP=>"§", READONLY=>true, "NO-ERROR-CHECK"=>true),
	);  
	
	*/ public function __construct(){
		parent::__construct("acity","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "city_name_ar";
                // $this->ENABLE_DISPLAY_MODE_IN_QEDIT=true;
                $this->ORDER_BY_FIELDS = "lookup_code";
                $this->horizontalTabs = true;
                $this->IS_LOOKUP = true;
                $this->public_display = true;
                $this->ENABLE_DISPLAY_MODE_IN_QEDIT = true;
                $this->showQeditErrors = true; 
                
                $this->ignore_insert_doublon = true;
                $this->UNIQUE_KEY = array('lookup_code');
                
                $this->showQeditErrors = true;
                $this->showRetrieveErrors = true;
                $this->general_check_errors = true;
                // $this->after_save_edit = array("class"=>'Road',"attribute"=>'road_id', "currmod"=>'btb',"currstep"=>9);
	}
        
        public static function loadById($id)
        {
           $obj = new Acity();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        public static function loadAll()
        {
           $obj = new Acity();
           $obj->select("active",'Y');

           $objList = $obj->loadMany();
           
           return $objList;
        }

        
        public static function loadByMainIndex($lookup_code,$create_obj_if_not_found=false)
        {
           if(!$lookup_code) throw new AfwRuntimeException("loadByMainIndex : lookup_code is mandatory field");


           $obj = new Acity();
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
               return $this->getVal("city_name_$lang");
        }
        
        
        

        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")      
        {
             global $lang;
             // $objme = AfwSession::getUserConnected();
             // $me = ($objme) ? $objme->id : 0;

             $otherLinksArray = $this->getOtherLinksArrayStandard($mode, false, $step);
             $my_id = $this->getId();
             $displ = $this->getDisplay($lang);
             
             
             
             // check errors on all steps (by default no for optimization)
             // $obj->general_check_errors = false;
             
             return $otherLinksArray;
        }
        
        protected function getPublicMethods()
        {
            
            $pbms = array();
            
            $color = "green";
            $title_ar = "xxxxxxxxxxxxxxxxxxxx"; 
            $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
            //$pbms[self::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");
            
            
            
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
        
        
        protected function beforeDelete($id,$id_replace) 
        {
            
            
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
                   $server_db_prefix = AfwSession::config("db_prefix","c0"); // FK part of me - not deletable 

                        
                   $server_db_prefix = AfwSession::config("db_prefix","c0"); // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 
                       // crm.request-المدينة	city_id  حقل يفلتر به-ManyToOne
                        if(!$simul)
                        {
                            
                            Request::updateWhere(array('city_id' =>$id_replace), "city_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}crm.request set city_id='$id_replace' where city_id='$id' ");
                        }
                        /*
                       // card.member-مدينة العمل	job_city_id  حقل يفلتر به-ManyToOne
                        if(!$simul)
                        {
                            require_once "../card/member.php";
                            Member::updateWhere(array('job_city_id' =>$id_replace), "job_city_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}card.member set job_city_id='$id_replace' where job_city_id='$id' ");
                        }
                       // card.member-مدينة الولادة	birth_city_id  حقل يفلتر به-ManyToOne
                        if(!$simul)
                        {
                            require_once "../card/member.php";
                            Member::updateWhere(array('birth_city_id' =>$id_replace), "birth_city_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}card.member set birth_city_id='$id_replace' where birth_city_id='$id' ");
                        }
                        */
                        
                   
                   // MFK

               }
               else
               {
                        $server_db_prefix = AfwSession::config("db_prefix","c0"); // FK on me 
                       // crm.request-المدينة	city_id  حقل يفلتر به-ManyToOne
                        if(!$simul)
                        {
                            
                            Request::updateWhere(array('city_id' =>$id_replace), "city_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}crm.request set city_id='$id_replace' where city_id='$id' ");
                        }
                        /*
                       // card.member-مدينة العمل	job_city_id  حقل يفلتر به-ManyToOne
                        if(!$simul)
                        {
                            require_once "../card/member.php";
                            Member::updateWhere(array('job_city_id' =>$id_replace), "job_city_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}card.member set job_city_id='$id_replace' where job_city_id='$id' ");
                        }
                       // card.member-مدينة الولادة	birth_city_id  حقل يفلتر به-ManyToOne
                        if(!$simul)
                        {
                            require_once "../card/member.php";
                            Member::updateWhere(array('birth_city_id' =>$id_replace), "birth_city_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}card.member set birth_city_id='$id_replace' where birth_city_id='$id' ");
                        }
                        */
                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}
?>