<?php
/**
 * @var string $my_survey2_url
 * @var string $my_survey_url
 * @var Request $ticketObj
 */
?>
<div class="cms_bg_pic contact">
<div class="cms_bg">
<div class="">
        <div class='content_body contact'>
                    <a class='unique_crm_btn crm question' href='/crm/i.php?cn=crm&mt=myrequests'><?php echo $cr_prefix ?> طلباتي الحالية </a>
        </div>
</div>
<?php 
if($my_survey2_url)        
{
      if(!$ticketObj->calcRequest_late())
      {
?>       
      <hr class="separator">
      <div class='footer-ad'>      
      <?php
          include("eval_crm_phrase.php");
      ?>      
            <div class='hzm_xgreen hzm_blink hzm_print'>
                  <a href='<?php echo $my_survey2_url ?>'>
                  تقييم المنصة
                  </a>
            </div>
      </div>      
<?php
      }
}
?>    

<?php 
if($my_survey_url)        
{
      if($ticketObj->calcRequest_very_late())
      {
?>       
      <hr class="separator">
      <div class='footer-ad'>      
            عزيزي العميل بعد مرور فترة كافية منذ انشاء الطلب يحق لك من الآن ابداء رأيك في الخدمة المقدمة لك
            <div class='hzm_xgreen hzm_print'>
                  <a href='<?php echo $my_survey_url ?>'>
                  تقييم الخدمة
                  </a>
            </div>
      </div>      
<?php
      }
}
?>  
</div>  
</div>