<?php

class ResponseTypeEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["response_type"]["responsetype.single"] = "Media response type";
		$trad["response_type"]["responsetype.new"] = "new";
		$trad["response_type"]["response_type"] = "Media response types";
		$trad["response_type"]["name_ar"] = "Media response type name ar";
		$trad["response_type"]["name_en"] = "Media response type name en";
		$trad["response_type"]["verb_ar"] = "Verb ar";
		$trad["response_type"]["verb_en"] = "Verb en";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new ResponseTypeArTranslator();
		return new ResponseType();
	}
}
