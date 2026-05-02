<?php
if(date("Y-m-d")<="2026-05-05") {
    $warning_employee = "عزيزي المنسق يرجى ملاحظة أنه تم تحديث بعض الملفات في الاصدار الجديد.
     لأجل الاستفادة من الوظائف الجديدة يرجى القيام بالضغط على الزرين 
    CTRL+F5 في نفس الوقت ثلاث مرات لأجل تحديث ملفات التصفح. 
    <br>شاكرين تعاونكم";
    $out_scr .= "<div class='crm-title hzm-warning note statusY1'>$warning_employee</div>";

    $crmEmplObj = CrmEmployee::findCrmEmployee($myEmplId);
    $ai_when = "";
    if($crmEmplObj) {
        $arabic_name = $crmEmplObj->getShortDisplay("ar");
        $ai_notes = [];
        /*
        if($crmEmplObj->sureIs("approved")){
            $ai_when = "اليوم";
            $pctWithoutTaqib = $crmEmplObj->pctWithoutTaqib();
            if(($pctWithoutTaqib!="N/A") and $pctWithoutTaqib<90) {
                $crmEmplObj->set("approved", "W");
                $crmEmplObj->commit();
            }
        } */
        

        if($crmEmplObj->getVal("approved") == "W")
        {
            $pctWithTaqib = round(100 - $pctWithoutTaqib);
            $ai_notes[] = "المنسق المكرم $arabic_name ،
            خضعت $ai_when أجوبتك على العملاء لعملية تحليل الذكاء الاصطناعي وذلك أنه يوجد
عدد كبير من العملاء غير راض عن الخدمة المقدمة له وكذلك بعض التعقيبات المتكررة  ($pctWithTaqib %)
لذلك نذكرك عزيزي المنسق بالتوجيهات التالية
    . عدم احالة العميل على منصات أخرى أو على مكتب الادارة مباشرة 
    . عدم احالة العميل على البريد الالكتروني للادارة
    . تقديم الدعم المطلوب للعميل وتحرير الجواب مباشرة عبر منصة خدمة العملاء الزاميا ولو تمت افادة العميل بالجواب عبر قنوات أخرى مثل الواتساب او الاتصال الهاتفي
    . اجتناب غلق التذكرة قبل التأكد من اكتمال وتحرير الرد وأنه يفي للعميل بالمطلوب بشكل تام وواضح

مع جزيل الشكر";
        }


        foreach($ai_notes as $ai_note) $out_scr .= "<div class='crm-title hzm-warning note statusN'>$ai_note</div>";

    
        $currentNotes = $crmEmplObj->get("currentNotes");

        foreach($currentNotes as $currentNote) {
            $note_body = $currentNote->getVal("note_body");
            $status = $currentNote->getVal("noted");
            $out_scr .= "<div class='crm-title hzm-warning note status$status'>$note_body</div>";
        }
    }
    
}