<?php

class SurveyController extends AfwController
{
        public static function pushError($message_en, $lang="")
        {
                if (!$lang) $lang = AfwSession::getSessionVar("current_lang");
                if (!$lang) $lang = "ar";
                $support_mobile_number = AfwSession::config("support_mobile_number","0500000001");
                self::pushError(AfwLanguageHelper::translateCompanyMessage($message_en,"crm",$lang));
                self::pushError(AfwLanguageHelper::translateCompanyMessage("Please try again later or send a technical support request. You can send a screenshot and ask your questions on WhatsApp to the number","crm",$lang)." ".$support_mobile_number);
        }

        public function headerTemplate($methodName, $default_header_template)
        {
                return "no-header";
        }
        public function menuTemplate($methodName, $default_menu_template)
        {
                return "no-menu";
        }
        public function bodyTemplate($methodName, $default_body_template)
        {
                return "survey";
        }
        public function footerTemplate($methodName, $default_footer_template)
        {
                return "modern";
        }


        public function getMyModule()
        {
                return "crm";
        }

        public function getMyParentModule()
        {
                return AfwSession::config("main_module", "");
        }

        public function defaultMethod($request)
        {
                return "survey_request";
        }


        public function prepareOptions($methodName)
        {
                $options= [];
                $options["front-application"] = "crm";
                $options["user-is-customer"] = true;
                $options["menu"] = false;
                $options["stars-rating"] = true;

                return $options;
        }

        public function prepareStandard($request)
        {
                if($request["all_error"])
                {
                        self::pushError($request["all_error"]);
                }
                $custom_scripts = array();
                $custom_scripts[] = array('type' => 'css', 'path' => "./css/content.css");
                $custom_scripts[] = array('type' => 'css', 'path' => "./css/survey.css");
                // $custom_scripts[] = array('type' => 'css', 'path' => "../lib/css/sweetalert2.min.css");
                // $custom_scripts[] = array('type' => 'js',   'path' => "../lib/js/sweetalert2.min.js");
                // $custom_scripts[] = array('type' => 'js',   'path' => "../lib/js/sweetalert.min.js");
                // $custom_scripts[] = array('type' => 'js',   'path' => "./js/jquery.nicefileinput.js");
                // $custom_scripts[] = array('type' => 'js',   'path' => "./js/edit_request.js");
                // $custom_scripts[] = array('type' => 'css',   'path' => "./css/jquery-nicefileinput-js.css");


                return $custom_scripts;
        }


        public function getSurveyToken($request)
        {
            $token = $request["tkn"];
            $obj = SurveyToken::loadByToken($token);
            if($obj->noResponseIDoNotKnow())
            {
                $obj->set("survey_id", 1);
                for($k=1;$k<=10;$k++) if(!$obj->sureIs("attribute_yn_$k")) $obj->set("attribute_yn_$k", 'N');
            }
            return $obj;
        }


        /******************************** survey_request action ********************************************** */

        public function prepareSurvey_request($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function survey_request($request)
        {
                foreach ($request as $key => $value) $$key = $value;
                $data = $request;

                if(!$objSurveyToken) $objSurveyToken = $this->getSurveyToken($request);

                if(!$objSurveyToken) {
                    $this->renderError("action aborted ! survey token not found, contact your admin");
                    return;
                }

                if ($objSurveyToken->isClosed()) {
                    $this->renderError("This survey token is already closed, responses can't be edited");
                    return;
                }

                if (true) {
                        $data["objSurveyToken"] = $objSurveyToken;

                        $question_list = [];

                        $question_list[1] = [
                            'question_type'=>'yn',
                            'question_type_order'=>1,
                            'question_title'=>'أوافق على مشاركة بياناتي مع الجهات الحكومية',
                        ];

                        $question_list[2] = [
                            'question_type'=>'enum',
                            'question_type_order'=>1,
                            'question_title'=>'ما مدى رضاك عن وضوح الإفادة لطلبك؟',
                        ];

                        $question_list[3] = [
                            'question_type'=>'enum',
                            'question_type_order'=>2,
                            'question_title'=>'ما مدى رضاك عن وضوح الإجراءات والتعليمات المطلوبة لتقديم طلبك؟',
                        ];


                        $question_list[4] = [
                            'question_type'=>'enum',
                            'question_type_order'=>3,
                            'question_title'=>'ما مدى رضاك عن سهولة استخدام المنصة؟',
                        ];


                        $question_list[5] = [
                            'question_type'=>'enum',
                            'question_type_order'=>4,
                            'question_title'=>'ما مدى رضاك عن جودة الخدمة المقدمة بشكل عام؟',
                        ];

                        $question_list[6] = [
                            'question_type'=>'area',
                            'question_type_order'=>1,
                            'question_title'=>'يرجى ذكر أي ملاحظات أو اقتراحات لتحسين الخدمة:',
                        ];

                        $data["question_list"] = $question_list;


                        /*
                        $data["request_type"] = $data["obj"]->getVal("request_type_id");
                        $data["request_type_display"] = $data["obj"]->decode("request_type_id");
                        $data["request_status_id"] = $data["obj"]->getVal("status_id");
                        $data["request_status"] = $data["obj"]->decode("status_id");
                        list($data["request_instructions"], $data["files_list"]) = $data["obj"]->getLastInstructionDetailsOnRequest();
                        $data["your_full_name"] = $theCustomer->calc("full_name");
                        $data["customer_mobile"] = $theCustomer->getVal("mobile");
                        $data["customer_idn"] = $theCustomer->getVal("idn");
                        $data["customer_type"] = $theCustomer->decode("customer_type_id");
                        $data["request_code"] = $data["obj"]->getVal("request_code");
                        $data["request_subject"] = $data["obj"]->getVal("request_title");
                        $data["request_body"] = $data["obj"]->getVal("request_text");
                        $data["old_ticket"] = $data["obj"]->getVal("related_request_code");
                        $data["web_site"] = $data["obj"]->getVal("request_link");
                        
                        $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                        $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");*/
                        // call the view 1
                        $this->render("crm", "survey_request_form", $data);
                }
        }


        /******************************** submit_survey action ********************************************** */

        public function prepareSubmit_survey($request)
        {
                $custom_scripts = $this->prepareStandard($request);

                return $custom_scripts;
        }

        public function initiateSubmit_survey($request)
        {
                AfwAutoLoader::addMainModule("crm");
                $objSurveyToken = $this->getSurveyToken($request);
                $data = $this->standardSubmit($request, $objSurveyToken);

                return $data;
        }

        public function submit_survey($request)
        {
                $data = $request;

                if (!$data["all_error"]) 
                {
                    $this->thankYou($data);
                } 
                else 
                {
                    $this->survey_request($data);
                }
        }

        public function thankYou($data)
        {
            $this->render("crm", "thank_you", $data);
        }

        
}