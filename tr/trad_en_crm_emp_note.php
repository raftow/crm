<?php

class CrmEmpNoteEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["crm_emp_note"]["crmempnote.single"] = "Employee note";
		$trad["crm_emp_note"]["crmempnote.new"] = "new";
		$trad["crm_emp_note"]["crm_emp_note"] = "Employee notes";
		$trad["crm_emp_note"]["orgunit_id"] = "Organization";
		$trad["crm_emp_note"]["crm_orgunit_id"] = "Organization In CRM";
		$trad["crm_emp_note"]["employee_id"] = "Employee";
		// $trad["crm_emp_note"]["service_category_mfk"] = "Service categories";
		// $trad["crm_emp_note"]["service_mfk"] = "Services";
		$trad["crm_emp_note"]["noted"] = "Noted";

        // steps
		$trad["crm_emp_note"]["step1"] = "Definition";
		$trad["crm_emp_note"]["step2"] = "The Note";		
        return $trad;
    }

    public static function getInstance()
	{
		return new CrmEmpNote();
	}
}