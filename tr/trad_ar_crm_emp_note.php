<?php

class CrmEmpNoteArTranslator{
    public static function initData()
    {
        $trad = [];	
        $trad["crm_emp_note"]["crmempnote.single"] = "ملاحظة على منسق";
        $trad["crm_emp_note"]["crmempnote.single.short"] = "ملاحظة";
        $trad["crm_emp_note"]["crmempnote.new"] = "جديدة";
        $trad["crm_emp_note"]["crm_emp_note"] = "ملاحظات على المنسقين";
        $trad["crm_emp_note"]["crm_emp_note.short"] = "الملاحظات";

        $trad["crm_emp_note"]["orgunit_id"] = "عنصر الهيكل";
        $trad["crm_emp_note"]["employee_id"] = "الموظف";

        $trad["crm_emp_note"]["active"] = "نشط";
        $trad["crm_emp_note"]["noted"] = "حالة الملاحظة"; 
        $trad["crm_emp_note"]["noted.EUH"] = "تم رفض الملاحظة"; 
        $trad["crm_emp_note"]["noted.YES"] = "تم تفهم الملاحظة"; 
        $trad["crm_emp_note"]["noted.NO"] = "ملاحظة مرسلة"; 

        $trad["crm_emp_note"]["response"] = "جواب الموظف";
        $trad["crm_emp_note"]["note_body"] = "نص الملاحظة";
        $trad["crm_emp_note"]["crm_orgunit_id"] = "وحدة خدمة العملاء";
        $trad["crm_emp_note"]["crm_employee_id"] = "حساب موظف خدمة العملاء";

        $trad["crm_emp_note"]["step1"] = "التعريف";
        $trad["crm_emp_note"]["step2"] = "الملاحظة";
        $trad["crm_emp_note"]["step3"] = "حالة الملاحظة";

        
    
        return $trad;
    }

    public static function getInstance()
	{
		return new CrmEmpNote();
        CrmEmpNoteEnTranslator::initData();
	}
}
    

    
	

	 
?>