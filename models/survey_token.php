<?php

$file_dir_name = dirname(__FILE__);

// require_once( "$file_dir_name/../afw/afw.php" );

class SurveyToken extends CrmObject
{
    public static $MY_ATABLE_ID = 13973;

    public static $DATABASE = "";
    public static $MODULE = "crm";

    public static $TABLE = "survey_token";

    public static $DB_STRUCTURE = null;

    public static $STATS_CONFIG = array(
        "st001" => array(
            "PARAMS" => ["sid"],
            "STATS_DATA_FROM" => ['class' => 'Survey', 'method' => 'statsData'], // 
            "URL_SETTINGS" => "main.php?Main_Page=afw_mode_edit.php&cl=CrmOrgunit&id=80&currmod=crm&currstep=5",
            "FOOTER_TITLES" => true,
            "SHOW_PIE" => "FOOTER",
            "PIE_MODE" => "FILTER",
            "FILTER" => "question=all",
            "CHART_URL" => "chart.php?m=crm&stc=st001&cl=SurveyToken&survey_id=1&case=1&f=question",

            "FORMULA_COLS" => array(
                //0 => array("SHOW-NAME"=>"perf", "METHOD"=>"getPerf"),
            ),


        ),
    );

    public function __construct()
    {
        parent::__construct("survey_token", "id", "crm");
        CrmSurveyTokenAfwStructure::initInstance($this);
    }


    public function beforeMaj($id, $fields_updated)
    {
        if($this->getVal("survey_id")==1)
        {
            
        }
            if ($fields_updated["attribute_enum_4"]) {
                    $service_satisfied = null;
                    if($this->getVal("attribute_enum_4")>=4) {
                        $service_satisfied = "Y";
                    }
                    elseif($this->getVal("attribute_enum_4")<=2) {
                        $service_satisfied = "N";
                    }

                    if($service_satisfied) {
                        $token = $this->getVal("survey_token");
                        $reqObj = Request::loadByToken($token);
                        if($reqObj) {
                            $reqObj->set("service_satisfied", $service_satisfied);
                            $reqObj->commit();
                        }
                    }
            }
            /*
            if (!intval($this->getVal("new_status_id"))) {
                    $this->calcNewStatusNeeded();
            } else {
                    // throw new AfwRuntimeException("see = this->getVal(new_status_id)=".$this->getVal("new_status_id"));
            }*/

            return true;
    }

    protected function beforeSetAttribute($attribute, $newvalue)
    {
        $oldvalue = $this->getVal($attribute);
        if ($attribute == "attribute_yn_1" and $newvalue == "Y") {
            $reqObj = $this->getMyRequest();
            if ($reqObj) {
                $reqObj->set("survey_opened", $newvalue);
                $reqObj->commit();
            }
        }

        /*
          if($attribute=="attribute_enum_1" and $oldvalue and !$newvalue)
          {
           throw new AfwRuntimeException("before set attribute $attribute from '$oldvalue' to '$newvalue'");
          }
        */
        return true;
    }

    public static function loadByToken($survey_token, $create_obj_if_not_found = false)
    {
        $obj = new SurveyToken();
        $obj->select("survey_token", $survey_token);

        if ($obj->load()) {
            if ($create_obj_if_not_found) $obj->activate();
            return $obj;
        } elseif ($create_obj_if_not_found) {
            $obj->set("survey_token", $survey_token);

            $obj->insertNew();
            if (!$obj->id) return null; // means beforeInsert rejected insert operation
            $obj->is_new = true;
            return $obj;
        } else return null;
    }

    public function getUrl()
    {
        return self::getTokenUrl($this->getVal("survey_token"));
    }

    public function getMyRequest()
    {
        return Request::loadByToken($this->getVal("survey_token"));
    }



    public static function getTokenUrl($token)
    {
        $crm_site_url = AfwSession::config("crm_site_url", "");
        return "$crm_site_url/s.php?t=" . $token;
    }



    public function additional($field_name, $col_struct)
    {
        // if (($field_name == "dragDropDiv") and ($col_struct == "step")) return 11;

        // $params = self::getAdditionalFieldParams($field_name);
        $params = [];

        $survey_id = $this->getVal("survey_id");
        if(!$survey_id) $survey_id = 1;
        $field_part_arr = explode("_", $field_name);
        $field_type = $field_part_arr[1];
        $field_order = $field_part_arr[2];

        $col_struct = strtolower($col_struct);

        if ($col_struct == "mandatory") {
            return (Survey::isQuestionMandatory($survey_id, $field_type, $field_order));
        }

        if ($col_struct == "obsolete") {
            return (!Survey::isQuestionEnabled($survey_id, $field_type, $field_order));
        }
        if (($col_struct == "retrieve") or ($col_struct == "excel")) {
            return (Survey::isQuestionToRetrieve($survey_id, $field_type, $field_order));
        }
        if ($col_struct == "required") {
            return !$params["optional"];
        }

        if ($col_struct == "function_col_name") {
            return "stars";
        }
        if ($col_struct == "stars") {
            return 5;
        }

        if ($col_struct == "maxlength") {
            return 128;
        }

        if ($col_struct == "format") {
            if (
                AfwStringHelper::stringStartsWith(
                    $field_name,
                    "attribute_enum_"
                )
            ) {
                return "stars";
            }
            if (
                AfwStringHelper::stringStartsWith($field_name, "attribute_yn_")
            ) {
                return "icon";
            }
        }

        if ($col_struct == "switcher") {
            return "onoff";
        }
        if ($col_struct == "checkbox") {
            return false;
        }

        if ($col_struct == "css") {
            if (!$params["css"]) {
                $params["css"] = "width_pct_50";
            }
        }

        $return = $params[$col_struct];
        if ($col_struct == "css") {
            // if($field_name=="attribute_18") throw new AfwRuntimeException("css additional for $field_name params=".var_export($params,true)." return=".$return);
        }

        //if($col_struct=="fgroup" and $return == "") throw new AfwRuntimeException("fgroup additional return = $return params=".var_export($params,true));

        //if(!$return) die("no param for additional($field_name, $col_struct) params=".var_export($params,true));

        return $return;
    }

    protected function paggableAttribute($attribute, $structure)
    {
        // can be overridden in subclasses
        return [true, ""];
    }

    public static function loadById($id)
    {
        $obj = new SurveyToken();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else {
            return null;
        }
    }

    public function getScenarioItemId($currstep)
    {
        return 0;
    }

    public function getDisplay($lang = "ar") {}

    protected function getOtherLinksArray(
        $mode,
        $genereLog = false,
        $step = "all"
    ) {
        $lang = AfwLanguageHelper::getGlobalLanguage();
        // $objme = AfwSession::getUserConnected();
        // $me = ( $objme ) ? $objme->id : 0;

        $otherLinksArray = $this->getOtherLinksArrayStandard(
            $mode,
            $genereLog,
            $step
        );
        $my_id = $this->getId();
        $displ = $this->getDisplay($lang);

        // check errors on all steps ( by default no for optimization )
        // rafik don't know why this : \//  = false;

        return $otherLinksArray;
    }

    protected function getPublicMethods()
    {
        $pbms = [];

        $color = "green";
        $title_ar = "xxxxxxxxxxxxxxxxxxxx";
        $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
        //$pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"", 'STEP' =>$this->stepOfAttribute( 'xxyy' ) );

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
        return "active";
    }

    /*

    public function isTechField( $attribute ) {
        return ( ( $attribute == 'created_by' ) or
        ( $attribute == 'created_at' ) or
        ( $attribute == 'updated_by' ) or
        ( $attribute == 'updated_at' ) or
        // ( $attribute == 'validated_by' ) or ( $attribute == 'validated_at' ) or
        ( $attribute == 'version' ) );

    }
    */

    public function beforeDelete($id, $id_replace)
    {
        $server_db_prefix = AfwSession::config("db_prefix", "xxxxx");

        if (!$id) {
            $id = $this->getId();
            $simul = true;
        } else {
            $simul = false;
        }

        if ($id) {
            if ($id_replace == 0) {
                // FK part of me - not deletable

                // FK part of me - deletable

                // FK not part of me - replaceable

                // MFK
            } else {
                // FK on me

                // MFK
            }

            return true;
        }
    }

    public function isClosed()
    {
        return false;
    }

    public function noResponseIDoNotKnow()
    {
        $reqObj = Request::loadByToken($this->getVal("survey_token"));
        if (
            $reqObj and ((!$this->getVal("customer_id")) or
                (!$this->getVal("survey_id")) or
                (!$this->getVal("attribute_string_2")))
        ) {
            // throw new AfwRuntimeException("reqObj need resetSurvey : ".var_export($reqObj, true));
            $reqObj->resetSurveyForMe();
        }
        return true;
    }



    public function switcherConfig($col, $auser = null)
    {
        $switcher_authorized = true;
        $switcher_title = "";
        $switcher_text = "";

        return [$switcher_authorized, $switcher_title, $switcher_text];
    }

    public function calcDate_start_satisfaction()
    {
        return self::calcCrmDate_start_satisfaction();
    }

    public function calcDate_start_satisfaction_greg()
    {
        return self::calcCrmDate_start_satisfaction_greg();
    }

    public function calcDate_end_satisfaction()
    {
        return self::calcCrmDate_end_satisfaction();
    }

    public function calcDate_end_satisfaction_greg()
    {
        return self::calcCrmDate_end_satisfaction_greg();
    }

    public function attributeIsApplicable($attribute)
    {
        // $objme = AfwSession::getUserConnected();
        if (AfwStringHelper::stringStartsWith($attribute, "attribute_")) {
            return (!$this->additional($attribute, "OBSOLETE"));
        }


        return parent::attributeIsApplicable($attribute);
    }

    /**
     * @param string $attribute
     */
    public function getAttributeLabel($attribute, $lang = 'ar', $short = false, $AIT = true)
    {
        $surveyId = $this->getVal("survey_id");
        if(!$surveyId) $surveyId = 1;
        if (AfwStringHelper::stringStartsWith($attribute, "attribute_")) {
            return Survey::getQuestionLabel($surveyId, $attribute, $lang);
        }
        // die("calling getAttributeLabel($attribute, $lang, short=$short)");
        return AfwLanguageHelper::getAttributeTranslation($this, $attribute, $lang, $short);
    }

    public function isFilled() {
        $val_1 = $this->getVal("attribute_enum_1");
        $val_2 = $this->getVal("attribute_enum_2");
        $val_3 = $this->getVal("attribute_enum_3");
        $val_4 = $this->getVal("attribute_enum_4");

        $sum = 0;

        if($val_1>0) $sum++;
        if($val_2>0) $sum++;
        if($val_3>0) $sum++;
        if($val_4>0) $sum++;

        return ($sum>=2);
    }


    public function saveFormHidden($lang = "ar")
    {
        $class_hidden = "";
        $message_hidden = "";

        if ($this->sureIs("attribute_yn_1")) {
            if ($this->isFilled()) {
                $class_hidden = "btn-hidden";
                $message_hidden = "لا يمكن المشاركة مرة ثانية حيث سبقت المشاركة";
            } else {
                $this->set("attribute_yn_1", "N");
                $this->commit();
            }
            
        }
        
        if ($this->isNot("attribute_yn_1")) {            
            $class_hidden = "";  // because done by JS switcher
            $message_hidden = "يرجى تأكيد الموافقة على شرط مشاركة البيانات مع الجهات الحكومية";
        }

        return [$class_hidden, $message_hidden];
    }

    public function containImportantComment() {
        $this->where("length(trim(attribute_area_1)) >= ".CrmCustomerSurvey::$CONSIDERABLE_COMMENT_MIN_LENGTH);
    }

    public function serviceSurveyNotEmpty() {
        $this->where("attribute_yn_1='Y'");
        $this->where("attribute_enum_4 > 0");
    } 

    public function pateformSurveyNotEmpty() {
        $this->where("attribute_enum_1 > 0");
    }


    public static function satisfactionPct($orgunit_id = 0)
    {
        $server_db_prefix = AfwSession::config("db_prefix","ttc_");
        $date_start_stats = self::calcCrmDate_start_satisfaction();
        $date_end_stats = self::calcCrmDate_end_satisfaction();
        $date_start_stats_greg = self::calcCrmDate_start_satisfaction_greg();
        $date_end_stats_greg = self::calcCrmDate_end_satisfaction_greg();
        $survey_token_stats_row     = AfwDatabase::db_recup_row("select sum(IF(attribute_enum_4=5,1,0)) as verysatisfied,
        sum(IF(attribute_enum_4=4,1,0)) as satisfied,
        sum(IF(attribute_enum_4=3,1,0)) as indifferent,
        sum(IF(attribute_enum_4=2,1,0)) as unsatisfied,
        sum(IF(attribute_enum_4=1,1,0)) as veryunsatisfied,
        sum(IF(attribute_enum_4=0,1,0)) as noresponse
    from $server_db_prefix"."crm.survey_token
    where survey_id=1 
      and active = 'Y' 
      and attribute_yn_1='Y' 
      and attribute_gdate_1 between '$date_start_stats_greg' and '$date_end_stats_greg'
      and ($orgunit_id=0 or orgunit_id=$orgunit_id)");

        $verysatisfied = $survey_token_stats_row["verysatisfied"];
        $satisfied     = $survey_token_stats_row["satisfied"];
        $indifferent = $survey_token_stats_row["indifferent"];
        $unsatisfied = $survey_token_stats_row["unsatisfied"];
        $veryunsatisfied = $survey_token_stats_row["veryunsatisfied"];
        $noresponse = $survey_token_stats_row["noresponse"];
        $total_participated = $verysatisfied + $satisfied + $indifferent + $unsatisfied + $veryunsatisfied;
        $total_sent = $total_participated + $noresponse;
        $is_satisfied = $verysatisfied + $satisfied;
        if ($total_participated > 0) $pct = round($is_satisfied * 1000 / $total_participated)/10;
        else $pct = 0;

        
        return [$pct, $date_start_stats, $date_end_stats, $date_start_stats_greg, $date_end_stats_greg, $total_sent, $total_participated];
    }


    public static function list_of_filter()
    {
        $lang = AfwLanguageHelper::getGlobalLanguage();
        return self::filter()[$lang];
    }

    public static function filter()
    {
        $arr_list_of_filter = array();

        $arr_list_of_filter['en'][1] = 'contain important comment';
        $arr_list_of_filter['ar'][1] = 'يحتوي على ملاحظة معتبره';
        $arr_list_of_filter['code'][1] = 'containImportantComment';

        /*$arr_list_of_filter['en'][2] = 'XXXXXXXX';
        $arr_list_of_filter['ar'][2] = 'ييييييي';
        $arr_list_of_filter['code'][2] = 'xxxxxx';*/

        return $arr_list_of_filter;
    }

    public static function filterCode($filter=null)
    {
        // $lang = AfwLanguageHelper::getGlobalLanguage();
        if ($filter)
            return self::filter()['code'][$filter];
        else
            return self::filter()['code'];
    }

    public function updateGregDate($lang="ar") {
        $attribute_date_1 = $this->getVal("attribute_date_1");
        $attribute_gdate_1 = AfwDateHelper::hijriToGreg($attribute_date_1);
        if($attribute_gdate_1) {
            $this->set("attribute_gdate_1", $attribute_gdate_1);
            return $this->update();
        }
        else return 0;
    }

    public static function fillAllGregDates($lang="ar") {
        $obj = new SurveyToken();
        $obj->where("attribute_date_1 is not null and attribute_gdate_1 is null");
        $nb_updated = 0;
        $objList = $obj->loadMany(3000);
        foreach($objList as $objItem) {
            $nb_updated += $objItem->updateGregDate($lang);
        }

        return ["", "$nb_updated row(s) updated"];
    }


    
}

// errors
