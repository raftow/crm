<?php
    $email_body_arr = array();
    $email_body_arr["ar"] = "<html><body style='font-family: calibri;font-size: 16px;'>
            المكرم(ة) [firstname] [lastname]<br>
            إذا كان هذا البريد لا يعنيك أو لم تعد المنسق لـ : [the_orgunit] الرجاء تحويل هذه الرسالة إلى مكتب العلاقات مع العملاء cso@ttc.gov.sa وأخبرهم بذلك<br>
            <b>يوجد لديك [waiting] طلبات في انتظار الرد من قبلكم</b><br>
            للقيام بالمهام المطلوبة، يرجى زيارة منصة خدمة العملاء : <br>
            <a href='[crm_site_url]/login.php'>[crm_site_url]/login.php</a><br>
            <br><b>ثم &larr; صندوق الوارد</b><br>
            مع الشكر الجزيل<br>
            <br>
            فريق مراقبة جودة خدمة العميل<br>
            <br>
            <br>
            <hr>
            <i>ملاحظات : </i><br>
            <i>هذا البريد آلي لا ترد عليه</i><br>            
            <i>لمزيد الاستفسار : [crm_general_admin]</i><br>";

    $email_body_arr["subject-ar"] = "خدمة العملاء - يوجد طلبات في الانتظار";

    return $email_body_arr;