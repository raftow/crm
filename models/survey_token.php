<?php

$file_dir_name = dirname(__FILE__);

// require_once( "$file_dir_name/../afw/afw.php" );

class SurveyToken extends CrmObject
{
    public static $MY_ATABLE_ID = 13973;

    public static $DATABASE = "tvtc_crm";
    public static $MODULE = "crm";

    public static $TABLE = "survey_token";

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct("survey_token", "id", "crm");
        CrmSurveyTokenAfwStructure::initInstance($this);
    }

    public static function loadByToken($survey_token,$create_obj_if_not_found=false)
    {
       $obj = new SurveyToken();
       $obj->select("survey_token",$survey_token);

       if($obj->load())
       {
            if($create_obj_if_not_found) $obj->activate();
            return $obj;
       }
       elseif($create_obj_if_not_found)
       {
            $obj->set("survey_token",$survey_token);

            $obj->insertNew();
            if(!$obj->id) return null; // means beforeInsert rejected insert operation
            $obj->is_new = true;
            return $obj;
       }
       else return null;
       
    }

    public function getUrl()
    {
        return "https://crm.tvtc.gov.sa/crm/i.php?cn=survey&mt=survey_request&tkn=".$this->getVal("survey_token");
    }
    
    public function additional($field_name, $col_struct)
    {
        // if (($field_name == "dragDropDiv") and ($col_struct == "step")) return 11;

        // $params = self::getAdditionalFieldParams($field_name);
        $params = [];

        $col_struct = strtolower($col_struct);
        if ($col_struct == "obsolete") {
            return false;
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

    public function getDisplay($lang = "ar")
    {
    }

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
        $server_db_prefix = AfwSession::config("db_prefix", "tvtc_");

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

    public function switcherConfig($col, $auser = null)
    {
        $switcher_authorized = true;
        $switcher_title = "";
        $switcher_text = "";

        return [$switcher_authorized, $switcher_title, $switcher_text];
    }
}

// errors
