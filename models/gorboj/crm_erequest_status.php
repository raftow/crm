<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table crm_erequest_status : crm_erequest_status - حالات الطلبات الالكترونية 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class CrmErequestStatus extends AFWObject{

	public static $DATABASE		= ""; public static $MODULE		    = "crm"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; 
        
        
        public function __construct(){
		parent::__construct("crm_erequest_status","id","crm");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "crm_erequest_status_name_ar";
                $this->ORDER_BY_FIELDS = "crm_erequest_status_name_ar";
	}
}
?>