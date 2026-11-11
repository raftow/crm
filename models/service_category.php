<?php
// ------------------------------------------------------------------------------------
// ----             auto generated php class of table service_category : service_category - أصناف الخدمات 
// ------------------------------------------------------------------------------------


$file_dir_name = dirname(__FILE__);

// old include of afw.php

class ServiceCategory extends AFWObject
{

        public static $MY_ATABLE_ID = 3612;
        // إدارة أصناف الخدمات 
        public static $BF_QEDIT_SERVICE_CATEGORY = 103925;
        // إنشاء صنف خدمة 
        public static $BF_EDIT_SERVICE_CATEGORY = 103924;
        // الاستعلام عن صنف خدمة 
        public static $BF_QSEARCH_SERVICE_CATEGORY = 103929;
        // البحث في أصناف الخدمات 
        public static $BF_SEARCH_SERVICE_CATEGORY = 103928;
        // عرض تفاصيل صنف خدمة 
        public static $BF_DISPLAY_SERVICE_CATEGORY = 103927;
        // مسح صنف خدمة 
        public static $BF_DELETE_SERVICE_CATEGORY = 103926;


        // lookup Value List codes 


        public static $DATABASE                = "";
        public static $MODULE                    = "crm";
        public static $TABLE                        = "service_category";
        public static $DB_STRUCTURE = null;

        public function __construct()
        {
                parent::__construct("service_category", "id", "crm");
                CrmServiceCategoryAfwStructure::initInstance($this);
        }

        public static function loadById($id)
        {
                $obj = new ServiceCategory();
                $obj->select_visibilite_horizontale();
                if ($obj->load($id)) {
                        return $obj;
                } else return null;
        }


        /**
         * @param string $lookup_code
         * @param string $name_ar
         */

        public static function loadByMainIndex($lookup_code, $name_ar, $create_obj_if_not_found = false)
        {
                $obj = new ServiceCategory();
                if (!$lookup_code) throw new AfwRuntimeException("loadByMainIndex : lookup_code is mandatory field");


                $obj->where("lookup_code='$lookup_code' or name_ar = _utf8'$name_ar'");

                if ($obj->load()) {
                        if ($create_obj_if_not_found) {
                                $obj->set("name_ar", $name_ar);
                                $obj->activate();
                        }
                        return $obj;
                } elseif ($create_obj_if_not_found) {
                        $obj->set("lookup_code", $lookup_code);
                        $obj->set("name_ar", $name_ar);
                        $obj->insert();
                        $obj->is_new = true;
                        return $obj;
                } else return null;
        }


        public function getDisplay($lang = "ar")
        {
                if ($this->getVal("name_$lang")) return $this->getVal("name_$lang");
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


        public function beforeDelete($id, $id_replace)
        {


                if ($id) {
                        if ($id_replace == 0) {
                                $server_db_prefix = AfwSession::currentDBPrefix(); // FK part of me - not deletable 


                                $server_db_prefix = AfwSession::currentDBPrefix(); // FK part of me - deletable 


                                // FK not part of me - replaceable 
                                // crm.request-صنف الخدمة	service_category_id  حقل يفلتر به-ManyToOne
                                $this->execQuery("update ${server_db_prefix}crm.request set service_category_id='$id_replace' where service_category_id='$id' ");
                                // crm.servic-صنف الخدمة	service_category_id  حقل يفلتر به-ManyToOne
                                $this->execQuery("update ${server_db_prefix}crm.servic set service_category_id='$id_replace' where service_category_id='$id' ");



                                // MFK
                                // crm.crm_orgunit-أصناف الخدمات  التي تقدمها	service_category_mfk  
                                $this->execQuery("update ${server_db_prefix}crm.crm_orgunit set service_category_mfk=REPLACE(service_category_mfk, ',$id,', ',') where service_category_mfk like '%,$id,%' ");
                        } else {
                                $server_db_prefix = AfwSession::currentDBPrefix(); // FK on me 
                                // crm.request-صنف الخدمة	service_category_id  حقل يفلتر به-ManyToOne
                                $this->execQuery("update ${server_db_prefix}crm.request set service_category_id='$id_replace' where service_category_id='$id' ");
                                // crm.servic-صنف الخدمة	service_category_id  حقل يفلتر به-ManyToOne
                                $this->execQuery("update ${server_db_prefix}crm.servic set service_category_id='$id_replace' where service_category_id='$id' ");


                                // MFK
                                // crm.crm_orgunit-أصناف الخدمات  التي تقدمها	service_category_mfk  
                                $this->execQuery("update ${server_db_prefix}crm.crm_orgunit set service_category_mfk=REPLACE(service_category_mfk, ',$id,', ',$id_replace,') where service_category_mfk like '%,$id,%' ");
                        }
                        return true;
                }
        }
}
