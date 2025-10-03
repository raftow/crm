<?php

class SurveyEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["survey"]["survey.single"] = "survey";
		$trad["survey"]["survey.new"] = "new";
		$trad["survey"]["survey"] = "surveys";
		$trad["survey"]["name_ar"] = "Arabic Survey name";
		$trad["survey"]["desc_ar"] = "Arabic Survey description";
		$trad["survey"]["name_en"] = "English Survey name";
		$trad["survey"]["desc_en"] = "English Survey description";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new SurveyArTranslator();
		return new Survey();
	}
}