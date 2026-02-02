<?php
        $company = AfwSession::currentCompany();
?>
<div class="survey-header">
      <div class="survey logo_company">
            <img src="../client-<?php echo $company ?>/pic/logo-company-<?php echo $company ?>.png" alt="" style="margin-top:1px;height:42px;width: 42px;"> 
      </div>
      <div class="survey titre_company">  
            <img src="../client-<?php echo $company ?>/pic/title-company-<?php echo $company ?>.png" alt="" style="margin-top: 0px;width: 206px !important;height: 43px;border-radius: 0;margin-right: auto;margin-left: auto;"> 
      </div>
</div>
<div class="survey_bg survey">
<div class="content_form_bg survey">
        <div class="content_big_title survey">استبانة تحسين جودة خدمة العملاء</div>
<div id="container_div" class="table_div">
        <?php
                list($save_form_hidden, $save_form_hidden_message) = $objSurveyToken->saveFormHidden();
                echo AfwInputHelper::inputErrorsInRequest("all", $data);                
        ?>
        <form id="crm_form" method="POST"  enctype="multipart/form-data" action="i.php">
                <input type="hidden" name="tkn" id="tkn" value="<?php echo $tkn ?>">
                <input type="hidden" name="cn" id="cn" value="survey">
                <input type="hidden" name="mt" id="mt" value="submit_survey">                

                <div id="infos_left_div" class="table_cell_div content_form survey_form">
                        <div id="fg-warn" class="attrib-warn form-group width_pct_100 ">
                        
                                <div id="surveyintro" class="attrib-warn form-group width_pct_100 survey-intro">
نشكر لكم وقتكم في الإجابة على هذه الاستبانة، والتي تهدف إلى تحسين جودة خدماتنا.<br>
علماً بأنها لا تستغرق سوى دقيقة واحدة، ونؤكد لكم أنه لن تُكشف هوية أصحاب الإجابات التي سنحصل عليها،<br>
وسيتم معالجة المعلومات بشكل كلي فقط دون الرجوع للبيانات الفردية.<br>
إن مشاركتكم محل تقدير، فهي تسهم في الارتقاء بخدمات المؤسسة وتلبيتها لتطلعاتكم. <br>
                                </div>                                
                                <div id="surveyintro1" class="attrib-warn form-group width_pct_100 survey-intro intro1 <?php echo $hide_intro1 ?>">
                                        <!--<div class='paragraph'> تقييم الرد على التذكرة رقم <?php echo $objSurveyToken->getVal("attribute_string_1") ?>
                                        بعنوان  <span class='ticket-title'><?php echo $objSurveyToken->getVal("attribute_string_2") ?></span></div>-->
                                        <a class='crm suggestion quick' href='i.php?cn=survey&mt=show_response&tkn=<?php echo $objSurveyToken->getVal("survey_token") ?>'>
                                                اضغط هنا إن لم يسبق لك أن اطلعت على الرد
                                        </a><br><br>
                                </div>
                                <div id="surveyintro2" class="attrib-warn form-group width_pct_100 survey-intro intro2 <?php echo $hide_intro2 ?>">
                                        <div class='paragraph'>تم الرد على طلبكم رقم <?php echo $objSurveyToken->getVal("attribute_string_1") ?>
                                        بعنوان  <span class='ticket-title'><?php echo $objSurveyToken->getVal("attribute_string_2") ?></span>
                                        وكان الرد كالتالي : </div>
                                        <div class='ticket-final-response'><?php echo $objSurveyToken->getVal("attribute_area_2") ?></div>
                                        <div class='paragraph'> لتقييم الخدمة نتطلع إلى أجوبتكم على الأسئلة التالية</div>
                                </div>                                
                                <label id="label_save_form" class="hzm_front_warning">
                                        <?php echo $save_form_hidden_message ?>           
                                        <!-- لا يمكنك ارسال الأجوبة إلا إذا وافقت أعلاه على مشاركتها مع الجهات الحكومية مثل مركز اداء الذي يقوم بدراسة نتائج قياس رضا المستفيد -->
                                </label>
                                <?php
                                        /**
                                         * @var SurveyToken $objSurveyToken
                                         */
                                        // echo var_export($files_list, true);
                                        foreach($question_list as $question_id => $question_row)
                                        {
                                                
                                                foreach($question_row as $question_prop => $question_prop_value) $$question_prop = $question_prop_value;
                                                $question_attribute = "attribute_$question_type"."_$question_type_order";
                                ?>
                                        <label class="hzm_front_label <?php echo "for_question $question_attribute" ?>"><?php echo $question_title ?></label>
                                        <p class="for_question">
                                <?php 
                                        $info = AfwEditMotor::prepareEditInfoForColumn($objSurveyToken, $question_attribute);
                                        echo $info["input"];        

                                        // echo "<!-- info[desc]=".var_export($info["desc"], true)." -->";        

                                        }
                                ?>
                                <input type="submit" name="save" id="save_form" class="bluebtn wizardbtn fright hide <?php echo $save_form_hidden ?>" value="&nbsp; <?php echo AfwLanguageHelper::tt("send participation", $lang, "crm")?>&nbsp;"       style="margin-right: 5px;" >
                                
                                
                        </div>
                        
                </div> 
        </form>
</div> 
</div>
</div>
<script>
        function starlabel(inputname, i) // nb of elemets should be later dynamic @todo
        {
                if(i==1) return 'غير راضي إطلاقًا'; // should be later dynamic
                if(i==2) return 'غير راضي'; // should be later dynamic
                if(i==3) return 'محايد'; // should be later dynamic
                if(i==4) return 'راضي'; // should be later dynamic
                if(i==5) return 'راضي جدًا'; // should be later dynamic

                return '???'+i;
        }

        $(document).ready(function(){
                prepareRatingWithStars(5); // should be later dynamic

                // $("#attribute_yn_1").on('change', function() {
                $("#img-attribute_yn_1").on('click',function() {
                        if($("#attribute_yn_1").val()=='N') // and after the click will become Y
                        {
                                $("#label_save_form").addClass('hide');
                                $("#save_form").removeClass('hide');
                                console.log("now become sendable");
                        }
                        else
                        {
                                $("#save_form").addClass('hide');
                                $("#label_save_form").removeClass('hide');
                                console.log("now become non sendable");
                        }    
                
                });
        });
</script>
<?php 
        $file_dir_name = dirname(__FILE__);
        include("$file_dir_name/loader_front_tpl.php"); 
?>