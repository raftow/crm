<?php

class RequestArTranslator
{
	public static function initData()
	{
		$trad = [];

		$trad["request"]["request.single"] = "طلب الكتروني";
		$trad["request"]["request.new"] = "جديد";
		$trad["request"]["request"] = "الطلبات الالكترونية";
		$trad["request"]["request_title"] = "موضوع الطلب";
		$trad["request"]["lang_id"] = "لغة الطلب";
		$trad["request"]["request_for"] = "متعلق الطلب";
		$trad["request"]["request_for_help"] = "الجهة المبلغ عنها أو المعنية بالطلب";
		$trad["request"]["request_text"] = "نص الطلب";
		$trad["request"]["body"] = "نص الطلب";
		$trad["request"]["props"] = "خصائص الطلب";
		$trad["request"]["request_code"] = "رمز الطلب";
		$trad["request"]["request_date"] = "تاريخ الطلب";
		$trad["request"]["request_time"] = "وقت الطلب";
		$trad["request"]["request_type_id"] = "نوع  الطلب";
		$trad["request"]["related_request_code"] = "رمز طلب سابق";
		$trad["request"]["request_link"] = "رابط متعلق بالطلب";
		$trad["request"]["service_category_id"] = "صنف الخدمة";
		$trad["request"]["service_id"] = "الخدمة";
		$trad["request"]["request_priority"] = "أولوية الطلب";
		$trad["request"]["prio_icon"] = "الأولوية";

		$trad["request"]["orgunit_id"] = "الجهة المعنية بالطلب";
		$trad["request"]["employee_id"] = "المنسق المكلف";
		$trad["request"]["supervisor_id"] = "المشرف المكلف";
		$trad["request"]["man"] = "الآن الطلب عند من ؟";
		$trad["request"]["man.short"] = "عند من ؟";
		$trad["request"]["mobile"] = "الجوال";
		$trad["request"]["response_all"] = "الإجابات والتعليقات";

		$trad["request"]["orgunit_id_tooltip"] = "الإدارة المكلفة بالإجابة التي عينها المشرف ويمكن طلب إعادة التحويل في حال عدم التخصص";
		$trad["request"]["employee_id_tooltip"] = "موظف الإدارة المكلف بالتحقيق ثم بتحرير الإجابة";
		$trad["request"]["supervisor_id_tooltip"] = "المشرف المكلف بتعيين الإدارة المكلفة بالرد وبمتابعة تنفيذ الطلب وغلقة بدون تأخير على العميل";
		$trad["request"]["assign_date"] = "تاريخ التكليف";
		$trad["request"]["assignment"] = "التكليف";
		$trad["request"]["status_id"] = "حالة التذكرة";
		$trad["request"]["status"] = "حالة التذكرة";
		$trad["request"]["status_comment"] = "ملاحظات حول حالة التذكرة";
		$trad["request"]["status_date"] = "تاريخ الحالة";
		$trad["request"]["status_time"] = "وقت الحالة";

		$trad["request"]["region_id"] = "المنطقة";
		$trad["request"]["city_id"] = "المدينة";
		$trad["request"]["other_city"] = "مدينة أخرى";
		$trad["request"]["responseList"] = "إجابة أو تعليق";
		$trad["request"]["survey"] = "الإستبيان";
		$trad["request"]["survey_sent"] = "تم إرسال الإستبيان";
		$trad["request"]["survey_opened"] = "تمت المشاركة في الإستبيان";
		$trad["request"]["easy_fast"] = "تواصل سهل وسريع";
		$trad["request"]["easy_fast.YES"] = "سريع";
		$trad["request"]["easy_fast.NO"]  = "بطيء";
		$trad["request"]["easy_fast.EUH"] = "محايد";

		$trad["request"]["service_satisfied"] = "رضا العميل";
		$trad["request"]["service_satisfied.YES"] = "راض";
		$trad["request"]["service_satisfied.NO"]  = "غير راض";
		$trad["request"]["service_satisfied.EUH"] = "محايد";


		$trad["request"]["pb_resolved"] = "تم حل المشكل";
		$trad["request"]["pb_resolved.YES"] = "نعم";
		$trad["request"]["pb_resolved.NO"]  = "لا";
		$trad["request"]["pb_resolved.EUH"] = "محايد";

		$trad["request"]["general_satisfaction"] = "الرضا عموما عن خدمات المؤسسة";
		$trad["request"]["customer_id"] = "العميل صاحب الطلب";
		$trad["request"]["assign_time"] = "وقت التكليف";
		$trad["request"]["request_subject"] = "مواضيع الطلبات";
		$trad["request"]["satisfaction"] = "نسبة رضا العملاء";
		$trad["request"]["tasks"] = "مهام بالانتظار";
		
		$trad["request"]["concerned_orgunit_id"] = "الجهة المعنية بالطلب";
		$trad["request"]["customer_type_id"] = "نوع العميل";
		$trad["request"]["email"] = "البريد الالكتروني";

		$trad["request"]["other_data"] = "بيانات أخرى";
		$trad["request"]["tech_data"] = "بيانات فنية";

		$trad["request"]["step1"] = "أساسيات الطلب";
		$trad["request"]["step2"] = "نص الطلب";
		$trad["request"]["step3"] = "حالة التذكرة";
		$trad["request"]["step4"] = "الإجابات والتعليقات";
		$trad["request"]["step5"] = "رضا العميل";

		$trad["request"]["perf"] = "مؤشر الأداء";
		$trad["request"]["request_ongoing"] = "جاري";
		$trad["request"]["request_late"] = "متأخر";
		$trad["request"]["request_done"] = "منجز";
		$trad["request"]["is_support"] = "دعم فني";
		$trad["request"]["is_suggestion"] = "اقتراح";
		$trad["request"]["is_complaint"] = "شكوى";
		$trad["request"]["is_enquiry"] = "استفسار";
		$trad["request"]["is_request"] = "طلب إداري";


		$trad["request"]["chez_supervisor"] = "عند المشرف";
		$trad["request"]["chez_customer"] = "عند العميل";
		$trad["request"]["chez_investigator"] = "عند المنسق";
		$trad["request"]["chez_archive"] = "مؤرشف";


		$trad["request"]["count_request"] = "عدد الطلبات";
		$trad["request"]["ul_cl_files"] = "مرفقات الطلب";


		$trad["request"]["sms"] = "رسالة قصيرة";
		$trad["request"]["email"] = "بريد الكتروني";


		$trad["request"]["days_investigator"] = "عدد أيام عمل المنسق";
		$trad["request"]["days_delay"] = "عدد أيام العمل على التذكرة";
		$trad["request"]["status_action_enum"] = "آخر اجراء على الطلب";


		$trad["request"]["stats.gs001"] = "تقرير الأداء لفترة من [date_start_perf] إلى [date_end_perf]";
		$trad["request"]["stats.gs003"] = "احصائيات الطلبات لفترة من [date_start_stats] إلى [date_end_stats]";
		$trad["request"]["stats.gs004"] = "الطلبات بحسب حالة الطلب لفترة من [date_start_stats] إلى [date_end_stats]";
		$trad["request"]["stats.gs005"] = "تقرير رضا العملاء لفترة من [date_start_perf] إلى [date_end_perf]";
		$trad["request"]["stats.gs006"] = "تقرير حالة الطلبات لفترة من [date_start_perf] إلى [date_end_perf]";
		return $trad;
	}

	public static function getInstance()
	{
		return new Request();
	}
}