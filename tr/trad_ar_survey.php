<?php

class SurveyArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["survey"]["survey.single"] = "استبانة";
		$trad["survey"]["survey.new"] = "جديد(ة)";
		$trad["survey"]["survey"] = "الاستبانات";
		$trad["survey"]["name_ar"] = "مسمى  بالعربية";
		$trad["survey"]["desc_ar"] = "وصف  بالعربية";
		$trad["survey"]["name_en"] = "مسمى  بالانجليزية";
		$trad["survey"]["desc_en"] = "وصف  بالانجليزية";

		$trad["survey"]["question_title"] = 'نص السؤال';
		$trad["survey"]["verysatisfied"] = CrmObject::stars()['ar'][5];
		$trad["survey"]["satisfied"] = CrmObject::stars()['ar'][4];
		$trad["survey"]["indifferent"] = CrmObject::stars()['ar'][3];
		$trad["survey"]["unsatisfied"] = CrmObject::stars()['ar'][2];
		$trad["survey"]["veryunsatisfied"] = CrmObject::stars()['ar'][1];
		$trad["survey"]["noresponse"] = 'بدون إجابة';

        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new SurveyEnTranslator();
		return new Survey();
	}
}