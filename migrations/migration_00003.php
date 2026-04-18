<?php
if (!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::config("db_prefix", "default_db_");
try {
    unset($obj);
    $obj = CrmCustomer::loadOrCreateWithUniqueKey(array(
        'mobile' => '0500000001',
        'email' => 'pt1114827486@pt.com',
        'idn_type_id' => '1',
        'idn' => '1114827486',
    ));
    $obj->multipleSet(array(
        'id' => '79773',
        'mobile' => '0500000001',
        'idn_type_id' => '1',
        'idn' => '1114827486',
        'email' => 'pt1114827486@pt.com',
        'gender_id' => '1',
        'first_name_ar' => 'سلطان مضيف',
        'father_name_ar' => '',
        'last_name_ar' => 'ردود الحجي',
        'customer_type_id' => '6',
        'first_name_en' => '',
        'father_name_en' => '',
        'last_name_en' => '',
        'customer_orgunit_id' => '0',
        'ref_num' => '',
        'org_name' => '',
        'phone' => NULL,
        'region_id' => '0',
        'city_id' => '0',
        'other_city' => '',
        'lang_id' => '1',
        'hijri' => 'Y',
        'service_satisfied' => 'N',
        'pb_resolved' => 'N',
        'last_request_date' => '14470323',
        'last_login_date' => NULL,
        'ppa' => NULL,
        'active' => 'Y',
        'created_by' => '0',
        'created_at' => '2025-09-15 11:10:27',
        'updated_by' => '1',
        'updated_at' => '2026-04-14 17:24:21',
        'validated_by' => '0',
        'validated_at' => NULL,
        'version' => '4',
        'update_groups_mfk' => ',',
        'delete_groups_mfk' => ',',
        'display_groups_mfk' => ',',
        'sci_id' => '2',
    ), true);
    
    unset($objPillar0);
    $objPillar0 = Request::loadOrCreateWithUniqueKey(array(
        'request_code' => '038c4f8',
        'customer_id' => '79773',
    ));
    $objPillar0->multipleSet(array(
        'id' => '89425',
        'status_id' => '7',
        'status_date' => '14470326',
        'status_time' => '00:00:20',
        'supervisor_id' => '1917',
        'orgunit_id' => '9323',
        'employee_id' => '1',
        'assign_date' => '14470323',
        'assign_time' => '14:18:56',
        'request_text' => 'طلب إضافة مؤهل معلق في منصة مؤهل


الاسم / سلطان مضيف ردود الحجي
السجل المدني / 1114827486
 
سلام عليكم ورحمة الله وبركاتة 
 
أنا درست بمعهد جدة الدولي العالي للتدريب 
واختبرت في الكلية التقنية بالطايف - رميدة في التدريب الاهلي 
وصدرت شهادتي ولكن لم اجدها في توكلنا خدمات 
 
رفعت اضافة مؤهل عن طريق جامعة 

برقم طلب ADQ096594
مع العلم انه وصل المؤسسة العامة للتدريب التقني والمهني
بحالة مراجعة *وتدقيق الطلب*
بتاريخ  ٢٧/٧/٢٠٢٥
 
والى الان لم تضف في توكلنا 
',
        'confidential' => NULL,
        'request_date' => '14470323',
        'request_time' => '14:00:02',
        'request_code' => '038c4f8',
        'related_request_code' => '',
        'request_type_id' => '3',
        'region_id' => '9056',
        'city_id' => '101',
        'other_city' => '',
        'customer_type_id' => '6',
        'ref_num' => '',
        'org_name' => '',
        'customer_id' => '79773',
        'request_priority' => '3',
        'lang_id' => '1',
        'request_title' => 'طلب إضافة مؤهل معلق في منصة مؤهل',
        'request_for' => 'crm-',
        'request_link' => '',
        'service_category_id' => '1',
        'service_id' => '1',
        'status_comment' => 'تم غلق الطلب',
        'status_action_enum' => '12',
        'nb_taqibs' => '0',
        'hours_investigator_work' => '58',
        'survey_token' => '38c2a285158859b',
        'survey_sent' => 'Y',
        'survey_opened' => 'N',
        'easy_fast' => 'W',
        'service_satisfied' => 'W',
        'pb_resolved' => 'W',
        'general_satisfaction' => 'W',
        'last_response_id' => '307061',
        'active' => 'Y',
        'created_by' => '1079773',
        'created_at' => '2025-09-15 14:00:02',
        'updated_by' => '0',
        'updated_at' => '2025-10-11 06:00:26',
        'validated_by' => '0',
        'validated_at' => NULL,
        'version' => '18',
        'update_groups_mfk' => ',',
        'delete_groups_mfk' => ',',
        'display_groups_mfk' => ',',
        'sci_id' => '2',
        'concerned_orgunit_id' => NULL,
        'days_investigator' => '0',
        'days_delay' => '0',
    ), true);
    
} catch (Exception $e) {
    $migration_info .= " " . $e->getMessage();
}
