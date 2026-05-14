<?php
/**
 * @var string  $main_module_home_page
 * @var string  $employee_name
 * @var string  $employee_dep
 * @var string  $customer_module_banner
 * @var string  $img_company_path
 */
?>
<div class="cms_bg_pic">    
<div class='hzm_left_image award award_glue'>
            <a href='<?php echo $main_module_home_page ?>'><img alt="" src="<?php echo $img_company_path ?>/<?php echo $customer_module_banner ?>" class="award_home_image"></a>
</div> 
<div class="content_form_bg">

<div class="success_hzm">
      <div class="crm_success_message">تم تسجيل/تفعيل الموظف بنجاح. <br><br>
      الاسم الكامل : <?php echo $employee_name ?><br>
      الوحدة : <?php echo $employee_dep ?>
      </div>

</div>


</div>
</div>