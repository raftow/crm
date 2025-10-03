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


        public function getRequestToSurvey($request)
        {
            $token = $request["tkn"];

            $objRequest = Request::loadByToken($token);
        }

        
}