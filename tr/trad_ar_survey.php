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
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new SurveyEnTranslator();
		return new Survey();
	}
}