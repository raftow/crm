<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table aregion : region - المناطق 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class Aregion extends AFWObject{

	public static $DATABASE		= ""; 
        public static $MODULE		    = "crm"; 
        public static $TABLE			= ""; 
        
	public static $DB_STRUCTURE = null; /* = array(
                id => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "TYPE" => "PK", SHORTNAME=>lookup_code),
                acountry_id => array(SHORTNAME => acountry,  
                        WHERE => "", 
                        SEARCH => true,  QSEARCH => false,  SHOW => true,  AUDIT => false,  RETRIEVE => true,  
                        EDIT => true,  QEDIT => true,  
                        SIZE => 40,  MAXLENGTH => 32,  UTF8 => false,  
                        TYPE => FK,  ANSWER => acountry,  ANSMODULE => crm,  AUTOCOMPLETE => true,  
                        RELATION => ManyToOne,  READONLY => false, ),

		region_name => array("IMPORTANT" => "IN", "SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 48, "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "UTF8" => true, "TYPE" => "TEXT"),
                
                
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
		parent::__construct("aregion","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "region_name";
                $this->ORDER_BY_FIELDS = "region_name";
                
                $this->copypast = true;
                $this->public_display = true;
	}
        
        public static function findRegion($lookup_code, $region_name)
        {
           $obj = new Aregion();
           if(!$lookup_code) $obj->_error("loadByMainIndex : lookup_code is mandatory field");
           if(!$region_name) $obj->_error("loadByMainIndex : region_name is mandatory field");
           
 
           $obj->select("region_name",$region_name);     
           if($obj->load())
           {
                $obj->set("lookup_code",$lookup_code);
                $obj->activate();
                return $obj;
           }

           unset($obj);
           $obj = new Aregion();
           $obj->select("lookup_code",$lookup_code);
 
           if($obj->load())
           {
                $obj->set("region_name",$region_name);
                $obj->activate();
                return $obj;
           }
           else
           {
                $obj->set("lookup_code",$lookup_code);
                $obj->set("region_name",$region_name);
                $obj->insert();
                $obj->is_new = true;
                return $obj;
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