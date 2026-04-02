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
        $trad["crm_emp_request"]["orgunit_id"] = "طلب تعيين كمنسق في";
        
        $trad["crm_emp_request"]["email"] = "البريد الالكتروني";
        
        $trad["crm_emp_request"]["employee_id"] = "الموظف";
        $trad["crm_emp_request"]["company_id"] = "الشركة/المؤسسة";
        $trad["crm_emp_request"]["department_id"] = "الإدارة";
        $trad["crm_emp_request"]["division_id"] = "القسم";

        $trad["crm_emp_request"]["active"] = "نشط";
        $trad["crm_emp_request"]["approved"] = "حالة الاستيراد والإعتماد"; 
        $trad["crm_emp_request"]["approved.EUH"] = "تم الاستيراد"; 
        $trad["crm_emp_request"]["approved.YES"] = "تم الإعتماد"; 
        $trad["crm_emp_request"]["approved.NO"] = "يوجد أخطاء"; 

        $trad["crm_emp_request"]["log_text"] = "تفاصيل تقنية";
        $trad["crm_emp_request"]["error_text"] = "نص الخطأ";
        $trad["crm_emp_request"]["crm_orgunit_id"] = "وحدة خدمة العملاء";
        $trad["crm_emp_request"]["crm_employee_id"] = "حساب موظف خدمة العملاء";

        $trad["crm_emp_request"]["step1"] = "البيانات العامة";
        $trad["crm_emp_request"]["step2"] = "تعيين الموظف";
        $trad["crm_emp_request"]["step3"] = "نتيجة الاستيراد";

        $trad["crm_emp_request"]["unit_token"] = "الرمز السري للوحدة الخاصة"; 
        
    
        return $trad;
    }

    public static function getInstance()
	{
		return new CrmEmpRequest();
	}
}
    

    
	

	 
?>