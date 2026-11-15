<?php

class ServiceCategoryArTranslator
{
	public static function initData()
	{
		$trad = [];

		$trad["service_category"]["servicecategory.single"] = "صنف خدمة";
		$trad["service_category"]["servicecategory.new"] = "جديد(ة)";
		$trad["service_category"]["service_category"] = "أصناف الخدمات";
		$trad["service_category"]["lookup_code"] = "الرمز الفني";
		$trad["service_category"]["name_ar"] = "مسمى صنف خدمة بالعربية";
		$trad["service_category"]["name_en"] = "مسمى صنف خدمة بالانجليزية";
		$trad["service_category"]["desc_ar"] = "وصف صنف خدمة بالعربية";
		$trad["service_category"]["desc_en"] = "وصف صنف خدمة بالانجليزية";
		// steps
		$trad["service_category"]["step1"] = "التعريف";
		return $trad;
	}

	public static function getInstance()
	{
		if (false) return new ServiceCategoryEnTranslator();
		return new ServiceCategory();
	}
}
