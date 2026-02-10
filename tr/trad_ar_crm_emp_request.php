<?php

class CrmEmpRequestArTranslator{
    public static function initData()
    {
        $trad = [];	
        $trad["crm_emp_request"]["crmemprequest.single"] = "إستيراد منسق من نظام الموارد البشرية";
        $trad["crm_emp_request"]["crmemprequest.single.short"] = "طلب إستيراد منسق";
        $trad["crm_emp_request"]["crmemprequest.new"] = "جديد";
        $trad["crm_emp_request"]["crm_emp_request"] = "طلبات إستيراد المنسقين من نظام الموارد البشرية";
        $trad["crm_emp_request"]["crm_emp_request.short"] = "طلبات إستيراد المنسقين";
        $trad["crm_emp_request"]["orgunit_id"] = "الجهة المتابعة";
        $trad["crm_emp_request"]["crm_orgunit_id"] = "الجهة التابع لها";
        $trad["crm_emp_request"]["email"] = "البريد الالكتروني";
        
        $trad["crm_emp_request"]["employee_id"] = "الموظف";


        $trad["crm_emp_request"]["active"] = "نشط";
        $trad["crm_emp_request"]["approved"] = "حالة الاستيراد"; 
        $trad["crm_emp_request"]["approved.EUH"] = "لم يتم الاستيراد يعد"; 
        $trad["crm_emp_request"]["approved.YES"] = "تم الاستيراد"; 
        $trad["crm_emp_request"]["approved.NO"] = "يوجد أخطاء"; 

        $trad["crm_emp_request"]["reject_reason_ar"] = "نص الخطأ بالعربية";
        $trad["crm_emp_request"]["reject_reason_en"] = "نص الخطأ بالانجليزية";
        $trad["crm_emp_request"]["step1"] = "البيانات العامة";
        $trad["crm_emp_request"]["step2"] = "البيانات المتقدمة";
        
    
        return $trad;
    }

    public static function getInstance()
	{
		return new CrmEmpRequest();
	}
}
    

    
	

	 
?>