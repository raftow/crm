<?php

class CrmOrgunitEnTranslator{
    public static function initData()
    {
        $trad = [];	
		$trad["crm_orgunit"]["crmorgunit.single"] = "Crm orgunit";
		$trad["crm_orgunit"]["crmorgunit.new"] = "new";
		$trad["crm_orgunit"]["crm_orgunit"] = "Crm orgunits";
		$trad["crm_orgunit"]["orgunit_id"] = "Orgunit";
		$trad["crm_orgunit"]["service_category_mfk"] = "Service category mfk";
		$trad["crm_orgunit"]["service_mfk"] = "Service mfk";
		$trad["crm_orgunit"]["requests_nb"] = "Requests nb";

		
		$trad["crm_orgunit"]["service_category_mfk_tooltip"] = "أصناف الخدمات  التي تقدمها";
		
		
		$trad["crm_orgunit"]["requests_count"] = "مجموع عدد الطلبات الجارية";
		$trad["crm_orgunit"]["requests_count.tooltip"] = "الطلبات الجارية هي التي جاري العمل عليها ولم تقفل بعد بغض النظر عن كونها عند المنسق حاليا أو عند المشرف أو حتى عند العميل لاستكمال بعض النواقص";
		$trad["crm_orgunit"]["new_requests_count"] = "مجموع عدد الطلبات الجديدة";
		$trad["crm_orgunit"]["new_requests_count.tooltip"] = "تعريف الطلبات الجديدة هي التي لم يعين عليها مشرف أو لم تعين لها جهة متابعة";
		$trad["crm_orgunit"]["allEmployeeList"] = "الموظفين المنسقين لدى مركز خدمة العملاء";
		$trad["crm_orgunit"]["unAssignedRequests"] = "طلبات يجب العمل عليها واسنادها";
		$trad["crm_orgunit"]["currentRequests"] = "الطلبات الجارية";
		


		$trad["crm_orgunit"]["step1"] = "البيانات العامة";
		$trad["crm_orgunit"]["step2"] = "الموظفون";
		$trad["crm_orgunit"]["step3"] = "الطلبات المسندة";
		$trad["crm_orgunit"]["step4"] = "تعيين الموظفين";
		$trad["crm_orgunit"]["step5"] = "إعدادات الاحصائيات";

		$trad["crm_orgunit"]["tempEmployeeList"] = "طلبات تعيين موظف";

		$trad["crm_orgunit"]["perf_stats_days"] = "عدد أيام تقرير الأداء";
		$trad["crm_orgunit"]["standard_stats_days"] = "عدد أيام تقارير الاحصائيات";
		$trad["crm_orgunit"]["satisfaction_stats_days"] = "عدد أيام تقرير رضا العملاء";
		$trad["crm_orgunit"]["late_days"] = "عدد الأيام الأقصى للرد على العميل";
		$trad["crm_orgunit"]["late_days.tooltip"] = "بعدها يحسب الطلب متأخرا في التقارير";
	
		return $trad;
    }

    public static function getInstance()
	{
		return new CrmOrgunit();
	}
}	