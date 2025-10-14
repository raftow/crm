<?php 

                
$file_dir_name = dirname(__FILE__); 
                
// require_once("$file_dir_name/../afw/afw.php");

class Survey extends CrmObject{

        public static $MY_ATABLE_ID=13972; 
  
        public static $DATABASE		= "tvtc_crm";
        public static $MODULE		        = "crm";        
        public static $TABLE			= "survey";

	    public static $DB_STRUCTURE = null;
	
	    public function __construct(){
		parent::__construct("survey","id","crm");
            CrmSurveyAfwStructure::initInstance($this);    
	    }
        
        public static function loadById($id)
        {
           $obj = new Survey();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        

        public function getScenarioItemId($currstep)
                {
                    
                    return 0;
                }
        
        
        public function getDisplay($lang="ar")
        {
               
        }


        public static function statsData($paramsArr=[])
        {
            $lang= AfwLanguageHelper::getGlobalLanguage();
            $survey_id = $paramsArr["sid"];
            if(!$survey_id) $survey_id = 1;

            $start_date = self::calcCrmDate_start_satisfaction();
            $end_date = self::calcCrmDate_end_satisfaction();

            $question_list = self::getQuestionList($survey_id);
            $sql_arr = [];
            $stat_trad = [];
            // $stat_trad["question"] = AfwLanguageHelper::translateStatsColumn("question", "Survey", null, $lang);
            $stat_trad["question_title"] = AfwLanguageHelper::translateStatsColumn("question_title", "Survey", null, $lang);
            $stat_trad["verysatisfied"] = AfwLanguageHelper::translateStatsColumn("verysatisfied", "Survey", null, $lang);
            $stat_trad["satisfied"] = AfwLanguageHelper::translateStatsColumn("satisfied", "Survey", null, $lang);
            $stat_trad["indifferent"] = AfwLanguageHelper::translateStatsColumn("indifferent", "Survey", null, $lang);
            $stat_trad["unsatisfied"] = AfwLanguageHelper::translateStatsColumn("unsatisfied", "Survey", null, $lang);
            $stat_trad["veryunsatisfied"] = AfwLanguageHelper::translateStatsColumn("veryunsatisfied", "Survey", null, $lang);
            $stat_trad["noresponse"] = AfwLanguageHelper::translateStatsColumn("noresponse", "Survey", null, $lang);
            // $stat_trad["all_count"] = AfwLanguageHelper::translateStatsColumn("all_count", "Survey", null, $lang);

            $question_title_arr = [];

            foreach($question_list as $question_order => $question_row)
            {
                $question_title_arr[$question_order] = $question_title = $question_row["question_title"];;
                $question_type = $question_row["question_type"];
                if($question_type=="enum")
                {
                    
                    $question_type_order = $question_row["question_type_order"];
                    $sql_arr[] = "select 'question_$question_order' as question,
                    '$question_title' as question_title,
        sum(IF(attribute_enum_$question_type_order=5,1,0)) as verysatisfied,
        sum(IF(attribute_enum_$question_type_order=4,1,0)) as satisfied,
        sum(IF(attribute_enum_$question_type_order=3,1,0)) as indifferent,
        sum(IF(attribute_enum_$question_type_order=2,1,0)) as unsatisfied,
        sum(IF(attribute_enum_$question_type_order=1,1,0)) as veryunsatisfied,
        sum(IF(attribute_enum_$question_type_order=0,1,0)) as noresponse,
        count(*) as all_count
    from tvtc_crm.survey_token
    where survey_id=1 
    and active = 'Y' 
    and attribute_yn_1='Y' 
    and attribute_date_1 between '$start_date' and '$end_date'";
                }
            }

            $sql = implode("\n union \n", $sql_arr);

            
            


            return [AfwDatabase::db_recup_rows($sql), $stat_trad, $question_title_arr];

            
        }


        public static function getQuestionList($survey_id, $question_num="all")
        {
            $question_list = [];

            if(($question_num==1) or ($question_num=="all")) $question_list[1] = [
                'question_type'=>'yn',
                'question_type_order'=>1,
                'question_title'=>'أوافق على مشاركة بياناتي مع الجهات الحكومية',
            ];

            if(($question_num==2) or ($question_num=="all")) $question_list[2] = [
                'question_type'=>'enum',
                'question_type_order'=>1,
                'question_title'=>'ما مدى رضاك عن وضوح الإفادة لطلبك؟',
            ];

            if(($question_num==3) or ($question_num=="all")) $question_list[3] = [
                'question_type'=>'enum',
                'question_type_order'=>2,
                'question_title'=>'ما مدى رضاك عن وضوح الإجراءات والتعليمات المطلوبة لتقديم طلبك؟',
            ];


            if(($question_num==4) or ($question_num=="all")) $question_list[4] = [
                'question_type'=>'enum',
                'question_type_order'=>3,
                'question_title'=>'ما مدى رضاك عن سهولة استخدام منصة تواصل معنا؟',
            ];


            if(($question_num==5) or ($question_num=="all")) $question_list[5] = [
                'question_type'=>'enum',
                'question_type_order'=>4,
                'question_title'=>'ما مدى رضاك عن جودة الخدمة المقدمة بشكل عام؟',
            ];

            if(($question_num==6) or ($question_num=="all")) $question_list[6] = [
                'question_type'=>'area',
                'question_type_order'=>1,
                'question_title'=>'يرجى ذكر أي ملاحظات أو اقتراحات لتحسين الخدمة:',
            ];

            return $question_list;
        }
        
        
        

        
        protected function getOtherLinksArray($mode,$genereLog=false,$step="all")      
        {
             $lang = AfwLanguageHelper::getGlobalLanguage();
             // $objme = AfwSession::getUserConnected();
             // $me = ($objme) ? $objme->id : 0;

             $otherLinksArray = $this->getOtherLinksArrayStandard($mode,$genereLog,$step);
             $my_id = $this->getId();
             $displ = $this->getDisplay($lang);
             
             
             
             // check errors on all steps (by default no for optimization)
             // rafik don't know why this : \//  = false;
             
             return $otherLinksArray;
        }
        
        protected function getPublicMethods()
        {
            
            $pbms = array();
            
            $color = "green";
            $title_ar = "xxxxxxxxxxxxxxxxxxxx"; 
            $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
            //$pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"", 'STEP' =>$this->stepOfAttribute("xxyy"));
            
            
            
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
        
        /*
        public function isTechField($attribute) {
            return (($attribute=="created_by") or 
                    ($attribute=="created_at") or 
                    ($attribute=="updated_by") or 
                    ($attribute=="updated_at") or 
                    // ($attribute=="validated_by") or ($attribute=="validated_at") or 
                    ($attribute=="version"));  
        }*/
        
        
        public function beforeDelete($id,$id_replace) 
        {
            $server_db_prefix = AfwSession::config("db_prefix","tvtc_");
            
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
                   // FK part of me - not deletable 

                        
                   // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        // FK on me 

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}



// errors 

