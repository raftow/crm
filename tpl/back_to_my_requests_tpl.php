<?php
/**
 * @var string $my_survey2_url
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
      if(true)
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
</div>  
</div>