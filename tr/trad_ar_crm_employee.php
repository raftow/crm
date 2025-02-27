<?php

class CrmEmployeeArTranslator{
    public static function initData()
    {
        $trad = [];	
        $trad["crm_employee"]["crmemployee.single"] = "منسق خدمة العملاء";
        $trad["crm_employee"]["crmemployee.single.short"] = "منسق";
        $trad["crm_employee"]["crmemployee.new"] = "جديد";
        $trad["crm_employee"]["crm_employee"] = "المنسقين لدى خدمة العملاء";
        $trad["crm_employee"]["crm_employee.short"] = "المنسقين";
        $trad["crm_employee"]["orgunit_id"] = "الجهة المتابعة";
        $trad["crm_employee"]["crm_orgunit_id"] = "الجهة التابع لها";
        
        $trad["crm_employee"]["service_category_mfk"] = "المسؤوليات المناطة به";
        $trad["crm_employee"]["service_category_mfk_tooltip"] = "أصناف الخدمات  التي يقدمها";
        $trad["crm_employee"]["service_mfk"] = "الخدمات التي يقدمها";
        $trad["crm_employee"]["requests_nb"] = "طاقة استيعاب الطلبات يوميا";
        $trad["crm_employee"]["employee_id"] = "الموظف";

        $trad["crm_employee"]["ongoing_requests_count"] = "عدد الطلبات الجاري العمل عليها";
        $trad["crm_employee"]["done_requests_count"] = "عدد الطلبات التي تم التحقيق عليها";
        $trad["crm_employee"]["requests_count"] = "مجموع عدد الطلبات المسندة";
        $trad["crm_employee"]["statif_pct"] = "نسبة رضا العميل";


        $trad["crm_employee"]["ongoing_requests_count.short"] = "الجاري";
        $trad["crm_employee"]["done_requests_count.short"] = "تم التحقيق";
        $trad["crm_employee"]["requests_count.short"] = "المسند";
        $trad["crm_employee"]["statif_pct.short"] = "رضا العميل";
        

        $trad["crm_employee"]["assignedRequests"] = "الطلبات المسندة";
        $trad["crm_employee"]["currentRequests"] = "الطلبات الحالية";
        $trad["crm_employee"]["finishedRequests"] = "الطلبات المنتهية";
        $trad["crm_employee"]["allOrgunitList"] = "الجهات التي يعمل معها";


        $trad["crm_employee"]["active"] = "نشط";
        $trad["crm_employee"]["admin"] = "مشرف تنسيق";
        $trad["crm_employee"]["super_admin"] = "مشرف عام";
        $trad["crm_employee"]["approved"] = "منسق معتمد"; 
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
    

    
	

	 
?>