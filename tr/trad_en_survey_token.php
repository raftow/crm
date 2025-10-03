<?php

class SurveyTokenEnTranslator {
    public static function initData()
    {
        $trad = [];

		$trad["survey_token"]["surveytoken.single"] = "survey response";
		$trad["survey_token"]["surveytoken.new"] = "new";
		$trad["survey_token"]["survey_token"] = "survey responses";
		$trad["survey_token"]["name_ar"] = "Arabic Survey token name";
		$trad["survey_token"]["desc_ar"] = "Arabic Survey token description";
		$trad["survey_token"]["name_en"] = "English Survey token name";
		$trad["survey_token"]["desc_en"] = "English Survey token description";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new SurveyTokenArTranslator();
		return new SurveyToken();
	}
}