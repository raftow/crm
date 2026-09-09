<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table request_category : request_category - أنواع الطلبات الالكترونية 
// ------------------------------------------------------------------------------------


$file_dir_name = dirname(__FILE__);

// old include of afw.php

class RequestCategory extends CrmObject
{

     public static $MY_ATABLE_ID = 13455;


     // lookup Value List codes 


     public static $DATABASE          = "";
     public static $MODULE              = "crm";
     public static $TABLE               = "request_category";
     public static $DB_STRUCTURE = null;

     public function __construct()
     {
          parent::__construct("request_category", "id", "crm");
          $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
          $this->DISPLAY_FIELD = "name_ar";
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
          $obj = new RequestCategory();
          $obj->select_visibilite_horizontale();
          if ($obj->load($id)) {
               return $obj;
          } else return null;
     }

     /**
      * Load all request categories related to a specific request type.
      * @param int $request_type_id The ID of the request type.
      * @return RequestCategory[]
      */
     public static function loadAllRelatedTo($request_type_id)
     {
          $obj = new RequestCategory();
          $obj->select("active", 'Y');
          if($request_type_id) {
               $obj->mfkContain("request_type_mfk", $request_type_id);
          }

          $objList = $obj->loadMany();

          return $objList;
     }



     public static function loadByMainIndex($lookup_code, $create_obj_if_not_found = false)
     {
          $obj = new RequestCategory();
          if (!$lookup_code) $obj->_error("loadByMainIndex : lookup_code is mandatory field");


          $obj->select("lookup_code", $lookup_code);

          if ($obj->load()) {
               if ($create_obj_if_not_found) $obj->activate();
               return $obj;
          } elseif ($create_obj_if_not_found) {
               $obj->set("lookup_code", $lookup_code);

               $obj->insert();
               $obj->is_new = true;
               return $obj;
          } else return null;
     }


     public function getDisplay($lang = "ar")
     {

          $data = array();
          $link = array();


          if ($lang == "ar") list($data[0], $link[0]) = $this->displayAttribute("name_ar", false, $lang);
          if ($lang == "en") list($data[0], $link[0]) = $this->displayAttribute("name_en", false, $lang);


          return implode(" - ", $data);
     }





     protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
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



     public function beforeDelete($id, $id_replace)
     {


          if ($id) {
               if ($id_replace == 0) {
                    $server_db_prefix = AfwSession::currentDBPrefix(); // FK part of me - not deletable 


                    $server_db_prefix = AfwSession::currentDBPrefix(); // FK part of me - deletable 


                    // FK not part of me - replaceable 
                    // crm.request-نوع  الطلب	request_category_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.request set request_category_id='$id_replace' where request_category_id='$id' ");
                    


                    // MFK

               } else {
                    $server_db_prefix = AfwSession::currentDBPrefix(); // FK on me 
                    // crm.request-نوع  الطلب	request_category_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.request set request_category_id='$id_replace' where request_category_id='$id' ");
                    // MFK

               }
               return true;
          }
     }
}
