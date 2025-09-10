<?php

class CrmEmployeeEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["crm_employee"]["crmemployee.single"] = "Crm employee";
		$trad["crm_employee"]["crmemployee.new"] = "new";
		$trad["crm_employee"]["crm_employee"] = "Crm employees";
		$trad["crm_employee"]["orgunit_id"] = "Organization / Department";
		$trad["crm_employee"]["crm_orgunit_id"] = "Crm Organization / Department";
		$trad["crm_employee"]["employee_id"] = "The Employee";
		$trad["crm_employee"]["email"] = "e-mail";
		$trad["crm_employee"]["service_category_mfk"] = "Services categories managed";
		$trad["crm_employee"]["service_mfk"] = "Services managed";
		$trad["crm_employee"]["requests_nb"] = "Employee Capacity";
		$trad["crm_employee"]["approved"] = "approved";
		$trad["crm_employee"]["admin"] = "admin";
		$trad["crm_employee"]["super_admin"] = "super_admin";
		$trad["crm_employee"]["requests_count"] = "Request count";
		$trad["crm_employee"]["done_requests_count"] = "done requests count";
		$trad["crm_employee"]["ongoing_requests_count"] = "ongoing requests count";
		$trad["crm_employee"]["statif_pct"] = "statif_pct";
		$trad["crm_employee"]["currentRequests"] = "Current Requests";
		$trad["crm_employee"]["finishedRequests"] = "finished Requests";
		$trad["crm_employee"]["allOrgunitList"] = "allOrgunitList";
        // steps
		$trad["crm_employee"]["step1"] = "البيانات العامة";
		$trad["crm_employee"]["step2"] = "الطلبات المسندة";
		$trad["crm_employee"]["step3"] = "جهات المتابعة";
        return $trad;
    }

    public static function getInstance()
	{
		return new CrmEmployee();
	}
}