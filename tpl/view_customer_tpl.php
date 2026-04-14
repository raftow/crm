<div class="cms_bg_pic contact">    
<div class='hzm_left_image award award_glue'>
            <a href='<?php echo $main_module_home_page ?>'><img alt="" src="<?php echo $img_company_path ?>/<?php echo $customer_module_banner ?>" class="award_home_image"></a>
</div>  
<div class="content_big_title registration">الملف الشخصي للعميل</div>
<div class="cms_bg">
<?
        /* */
        /**
         * @var CrmCustomer $theCustomer
         */
        
        
        //if(!$theCustomer) die("this ticket is lost");
        if($theCustomer->sureIs("active")) {
                $my_status = $theCustomer->sureIs("ppa") ? 3 : 9;
                $my_status_decoded = $theCustomer->sureIs("ppa") ? "نشط" : "حساب مجمد"; //$theCustomer->getCustomerStatus("ar");
        }
        else {
                $my_status = 8;
                $my_status_decoded = "غير نشط";
        }

        
        
        // test of ->showAttribute(..) after ->set(..)
        // $theCustomer->set("status_id", Request::$REQUEST_STATUS_REDIRECT);
        // $my_status_show = $theCustomer->showAttribute("status_id");
        // die("my_status_show=$my_status_show");

        $customer_type_decoded = $theCustomer->decode("customer_type_id");
                    
        $ref_num_label = $theCustomer->getAttributeLabel("ref_num", $lang);
        $org_name_label = $theCustomer->getAttributeLabel("org_name", $lang);


        $note = "عزيزي المستفيد، نود التأكيد على أن الحصول على أياً من: اسمك ورقم جوالك وهويتك والرقم الوظيفي أو التدريبي هو لغرض معالجة طلبك، كما نؤكد لك اهتمامنا وحرصنا على أمان بياناتك وخصوصيتك";
                    
?>
<div class='crm-title hzm-info'><?php echo $note; ?></div>
<div class="cms_container ticket_div">
        <div class='hzm_attribute hzm_wd4 hzm_minibox_header0'>                
                
                <div class='front_bloc hzm_crm_bloc ticket status_<?php echo $my_status; ?>'>
                        <div class='mb_long_title my_customer'> 
                                <div class='my_crm_ticket'>
                                <div class='crm_div'><?php echo $ref_num_label ?> </div>
                                <div class='crm_div crm_ticket_num'><?php echo $theCustomer->getVal("ref_num"); ?> </div>
                                <div class='crm_div'><?php echo $org_name_label ?> </div>
                                <div class='crm_div crm_org_name'><?php echo $theCustomer->getVal("org_name"); ?> </div>
                                </div>
                                <div class='my_crm_ticket fleft'>
                                       <div class='request_status status_<?php echo $my_status; ?>' ><?php echo $my_status_decoded; ?> </div>
                                </div>
                        </div>
                        <div class='my_crm_dates'>
                                <div class='mb_med_title my_ticket'> 
                                        <div class='crm_calendar crm_data'>
                                        <label> <?php echo $customer_type_decoded." : ".$theCustomer->getDisplay("ar"); ?> </label>                                        
                                        </div>
                                </div>
                        </div>

                        <div class='front_bloc hzm_data_props my_cms'>
                                <div class='my_crm_ticket_data'>                        
                                        <div class="row crm_data">
                                                <label>رقم الجوال</label>
                                                <div class='hzm_data_prop full_name'>
                                                <?php echo $theCustomer->getVal("mobile"); ?> 
                                                </div>
                                        </div>
                                        <div class="row crm_data">
                                                <label>البريد الالكتروني</label>
                                                <div class='hzm_data_prop email'>
                                                <?php echo $theCustomer->getVal("email"); ?> 
                                                </div>
                                        </div>
                                        <div class="row crm_data">
                                                <label>رقم الهوية</label>
                                                <div class='hzm_data_prop idn'>
                                                <?php echo $theCustomer->getVal("idn"); ?> 
                                                </div>
                                        </div>
                                        <div class="row crm_data">
                                                <label>الاطلاع والموافقة على سياسة الخصوصية</label>
                                                <div class='hzm_data_prop ppa-prop'>
                                                <?php echo $theCustomer->sureIs("ppa") ? "تم الاطلاع والموافقة" : "حساب مجمد"; ?> 
                                                </div>
                                        </div>

                                        <div class="row crm_data">
                                                <div class='hzm_data_prop perso-data-prop'>
                                                        <a href='i.php?cn=customer&mt=editaccount'><div class="hzm_blue hzm_print">تعديل</div></a>
                                                </div>
                                        </div>


                                
                                
                                
                                
                                </div>                                
                        </div>
                </div>
                   
                
        </div>
</div>
<?
$cr_prefix = "العودة إلى";
include("back_to_my_requests_tpl.php");
?>
</div>
</div>
