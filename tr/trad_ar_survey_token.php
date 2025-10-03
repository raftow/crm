<?php

class SurveyTokenArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["survey_token"]["surveytoken.single"] = "جواب استبانة";
		$trad["survey_token"]["surveytoken.new"] = "جديد(ة)";
		$trad["survey_token"]["survey_token"] = "اجوبة الاستبانات";
		$trad["survey_token"]["name_ar"] = "مسمى  بالعربية";
		$trad["survey_token"]["desc_ar"] = "وصف  بالعربية";
		$trad["survey_token"]["name_en"] = "مسمى  بالانجليزية";
		$trad["survey_token"]["desc_en"] = "وصف  بالانجليزية";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new SurveyTokenEnTranslator();
		return new SurveyToken();
	}
}