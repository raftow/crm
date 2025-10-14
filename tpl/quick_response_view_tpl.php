<div class="survey-header">
      <div class="survey logo_company">
            <img src="../client-tvtc/pic/logo-company-tvtc.png" alt="" style="margin-top:1px;height:42px;width: 42px;"> 
      </div>
      <div class="survey titre_company">  
            <img src="../client-tvtc/pic/title-company-tvtc.png" alt="" style="margin-top: 0px;width: 206px !important;height: 43px;border-radius: 0;margin-right: auto;margin-left: auto;"> 
      </div>
</div>
<div class="survey_bg survey">
<div class="content_form_bg survey">
        <div class="content_big_title survey">عرض سريع للرد على التذكرة رقم <?php echo $objSurveyToken->getVal("attribute_string_1") ?></div>
<div id="container_div" class="table_div">

                <div id="infos_left_div" class="table_cell_div content_form survey_form">
                        <div id="fg-warn" class="attrib-warn form-group width_pct_100 ">
                                
                                <div id="surveyintro2" class="attrib-warn form-group width_pct_100 survey-intro intro2 <?php echo $hide_intro2 ?>">
                                        <div class='paragraph'>تم الرد على طلبكم الذي بعنوان  <span class='ticket-title'><?php echo $objSurveyToken->getVal("attribute_string_2") ?></span>
                                        وكان الرد كالتالي : </div>
                                        <div class='ticket-final-response'><?php echo $objSurveyToken->getVal("attribute_area_2") ?></div>
                                        <div class='paragraph'> لتقييم الخدمة ولتحسين جودة خدمة العملاء نتطلع إلى أجوبتكم على الاستبانة  التالية </div>
                                </div>  
                                
                                <div class="signature">
                                        <a class='crm suggestion survey' href='i.php?cn=survey&mt=survey_request&tkn=<?php echo $objSurveyToken->getVal("survey_token") ?>'>استبانة تحسين جودة خدمة العملاء</a><br><br>
                                        <a class='crm suggestion survey' href='customer_login.php'>منصة تواصل معنا</a><br>
                                        <br>المؤسسة العامة للتدريب التقني والمهني<br>
                                </div>
                                
                        </div>
                        
                </div> 
</div> 
</div>
</div>