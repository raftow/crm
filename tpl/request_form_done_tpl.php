<?php
/**
 * @var string $main_module_home_page
 * @var string $img_company_path
 * @var string $customer_module_banner
 * @var bool $customer_connected
 * @var Request $ticketObj
 */
?>
<div class="cms_bg_pic">    
<div class='hzm_left_image award award_glue'>
            <a href='<?php echo $main_module_home_page ?>'><img alt="" src="<?php echo $img_company_path ?>/<?php echo $customer_module_banner ?>" class="award_home_image"></a>
</div> 
<div class="content_form_bg survey">

<div class="success_hzm">
      <div class="register_success_message">تم تسجيل طلبكم بنجاح. <br><br>
<?php
$my_survey2_url = $ticketObj->mySurvey2Url();
      if($customer_connected)
      {
?>
              يمكنكم متابعة حالة طلباتكم من خلال القائمة <a href='i.php?cn=crm&mt=myrequests'> طلباتي</a>
<?php
      }
      else
      {
?>
            <a href='#' onclick="window.close()"> غلق النافذة</a>
<?php

      }
?>
      <hr class="separator">
      <br>
      <?php
          include("eval_crm_phrase.php");
      ?>
            <div class='hzm_xgreen hzm_blink hzm_print'>
                  <a href='<?php echo $my_survey2_url ?>'>
                  تقييم المنصة
                  </a>
            </div>
      </div>
</div>


</div>
</div>