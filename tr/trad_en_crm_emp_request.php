<?php

class CrmEmpRequestEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["crm_emp_request"]["crmemprequest.single"] = "???? ???? ???????";
		$trad["crm_emp_request"]["crmemprequest.new"] = "new";
		$trad["crm_emp_request"]["crm_emp_request"] = "???????? ??? ???? ???????";
		$trad["crm_emp_request"]["orgunit_id"] = "????? ????????";
		$trad["crm_emp_request"]["crm_orgunit_id"] = "????? ?????? ???";
		$trad["crm_emp_request"]["employee_id"] = "??????";
		$trad["crm_emp_request"]["email"] = "e-mail";
		$trad["crm_emp_request"]["service_category_mfk"] = "?????????? ??????? ??";
		$trad["crm_emp_request"]["service_mfk"] = "??????? ???? ??????";
		$trad["crm_emp_request"]["requests_nb"] = "???? ??????? ??????? ?????";
		$trad["crm_emp_request"]["approved"] = "???? ?????";
		$trad["crm_emp_request"]["admin"] = "???? ?????";
		$trad["crm_emp_request"]["super_admin"] = "???? ???";
		$trad["crm_emp_request"]["requests_count"] = "??????";
		$trad["crm_emp_request"]["done_requests_count"] = "?? ???????";
		$trad["crm_emp_request"]["ongoing_requests_count"] = "??????";
		$trad["crm_emp_request"]["statif_pct"] = "??? ??????";
		$trad["crm_emp_request"]["currentRequests"] = "??????? ???????";
		$trad["crm_emp_request"]["finishedRequests"] = "??????? ????????";
		$trad["crm_emp_request"]["allOrgunitList"] = "?????? ???? ???? ????";
        // steps
		$trad["crm_emp_request"]["step1"] = "البيانات العامة";
		$trad["crm_emp_request"]["step2"] = "الطلبات المسندة";
		$trad["crm_emp_request"]["step3"] = "جهات المتابعة";
        return $trad;
    }

    public static function getInstance()
	{
		return new CrmEmpRequest();
	}
}