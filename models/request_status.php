<?php
// ------------------------------------------------------------------------------------
// 7/4/2020 :
// alter table request_status change lookup_code lookup_code  varchar(128) NOT NULL;
// alter table ".$server_db_prefix."crm.request_status add customer_status_name_ar varchar(128) NOT NULL;
// alter table ".$server_db_prefix."crm.request_status add customer_status_name_en varchar(128) NOT NULL;
// update ".$server_db_prefix."crm.request_status set customer_status_name_ar = request_status_name_ar;
// update ".$server_db_prefix."crm.request_status set customer_status_name_en = request_status_name_en;



$file_dir_name = dirname(__FILE__);

// old include of afw.php

class RequestStatus extends CrmObject
{

     public static $MY_ATABLE_ID = 3570;



     public static $DATABASE          = "";
     public static $MODULE              = "crm";
     public static $TABLE               = "request_status";
     public static $DB_STRUCTURE = null;




     public function __construct()
     {
          parent::__construct("request_status", "id", "crm");
          CrmRequestStatusAfwStructure::initInstance($this);    
     }

     public static function loadById($id)
     {
          $obj = new RequestStatus();
          $obj->select_visibilite_horizontale();
          if ($obj->load($id)) {
               return $obj;
          } else return null;
     }



     public static function loadByMainIndex($lookup_code, $create_obj_if_not_found = false)
     {
          $obj = new RequestStatus();
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



     public function calcWho($what = "value")
     {
          $who = "archive";
          $lang = AfwLanguageHelper::getGlobalLanguage();
          $status_id = $this->id;

          // NEW -  مسودة طلب جديد  
          if ($status_id == Request::$REQUEST_STATUS_DRAFT) $who = "customer";

          // MISSED_INFO -  عودة للعميل لاستكمال البيانات
          if ($status_id == Request::$REQUEST_STATUS_MISSED_INFO) $who = "customer";

          // MISSED_FILES -  عودة للعميل لاستكمال المرفقات
          if ($status_id == Request::$REQUEST_STATUS_MISSED_FILES) $who = "customer";

          // SENT - طلب مرسل  للتحقيق
          if ($status_id == Request::$REQUEST_STATUS_SENT) $who = "supervisor";


          // ASSIGNED - تم اسناده للموظف المختص
          if ($status_id == Request::$REQUEST_STATUS_ASSIGNED) $who = "employee";

          // REDIRECT - طلب إعادة التحويل  
          if ($status_id == Request::$REQUEST_STATUS_REDIRECT) $who = "supervisor";

          // RESPONSE UNDER REVISION - تدقيق الاجابة
          if ($status_id == Request::$REQUEST_STATUS_RESPONSE_UNDER_REVISION) $who = "supervisor";

          // ONGOING - طلب تحت الإنجاز - جاري العمل
          if ($status_id == Request::$REQUEST_STATUS_ONGOING) $who = "employee";

          // DONE - تمت الإجابة  
          if ($status_id == Request::$REQUEST_STATUS_DONE) $who = "customer";

          // CANCELED - طلب ملغى  
          if ($status_id == Request::$REQUEST_STATUS_CANCELED) $who = "supervisor";

          // CLOSED - طلب مغلق  
          if ($status_id == Request::$REQUEST_STATUS_CLOSED) $who = "supervisor";

          // REJECTED - طلب مستبعد  
          if ($status_id == Request::$REQUEST_STATUS_REJECTED) $who = "supervisor";

          // IGNORED - طلب تم تجاهله  
          if ($status_id == Request::$REQUEST_STATUS_IGNORED) $who = "supervisor";



          if ($what == "value") return $who;
          else return $this->translate($who, $lang);
     }


     public function getDisplay($lang = "ar")
     {

          if ($this->getVal("request_status_name_$lang")) return $this->getVal("request_status_name_$lang");
          $data = array();
          $link = array();




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
                    // crm.request-حالة التذكرة	status_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.request set status_id='$id_replace' where status_id='$id' ");
                    // crm.response-الحالة الجديدة للطلب	new_status_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.response set new_status_id='$id_replace' where new_status_id='$id' ");
                    // crm.action_policy-حالة التذكرة قبل	old_status_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.action_policy set old_status_id='$id_replace' where old_status_id='$id' ");
                    // crm.action_policy-حالة التذكرة بعد	new_status_id  حقل يفلتر به-ManyToOne
                    $this->execQuery("update ${server_db_prefix}crm.action_policy set new_status_id='$id_replace' where new_status_id='$id' ");



                    // MFK

               } else {
                    $server_db_prefix = AfwSession::currentDBPrefix(); // FK on me 
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

     public static function colorOfStatus($status_id)
     {
          if(!$status_id) return [null, 'white'];
          $obj = self::loadById($status_id);
          if(!$obj) return [null, 'white'];

          $color = self::color_of_who($obj->getVal("who_enum"));

          return $color;
     }
}
