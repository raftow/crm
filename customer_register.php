<?php
$file_dir_name = dirname(__FILE__);
set_time_limit(8400);
ini_set('error_reporting', E_ERROR | E_PARSE | E_RECOVERABLE_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);


 

$logbl = substr(md5($_SERVER["HTTP_USER_AGENT"] . "-" . date("Y-m-d")),0,10);

$uri_items = explode("/",$_SERVER["REQUEST_URI"]);
if($uri_items[0]) $uri_module = $uri_items[0];
else $uri_module = $uri_items[1];

if(!$lang) $lang = "ar";
$module_dir_name = $file_dir_name;

require_once("$file_dir_name/../lib/afw/afw_autoloader.php");
$uri_module = AfwUrlManager::currentURIModule();       
AfwSession::startSession();

if(!$uri_module) die("site code not defined !!!");
else
{ 
   require_once("$file_dir_name/../$uri_module/ini.php");
   require_once("$file_dir_name/../$uri_module/module_config.php");
}
include_once ("$file_dir_name/../$uri_module/application_config.php");
AfwSession::initConfig($config_arr);

if(!$NOM_SITE) die("site not configured or not initialized !!!");

$nom_site = $NOM_SITE[$lang];
$desc_site = $DESC_SITE[$lang];
$welcome_site = $WELCOME_SITE[$lang];

$debugg_login = false;
$debugg_after_login = true;
$debugg_after_golden_or_db = true;
$debugg_after_session_created = true;

$customer_msg = "";
$gender_id = 1;
$gender_id_selected_2 = "";
$gender_id_selected_1 = "selected";
        
require_once("$file_dir_name/../external/db.php");
// here old require of common.php

if(($_SESSION["user_avail"] == "Y") and ($_SESSION["user_firstname"])) 
{
	//die("rafik 2019-007 sess = ".var_export($_SESSION,true));
        header("Location: index.php");
} 
elseif($_POST["crm_new_go"])
{
      if((!AfwSession::config("sms-captcha-register",true)) or (strtoupper($_POST["customer_cpt"])==strtoupper($_SESSION["cpt"])))
      {
              $customer_mobile = AfwStringHelper::hardSecureCleanString(trim($_POST["customer_mobile"]));
              $customer_email = AfwStringHelper::hardSecureCleanString(strtolower(trim($_POST["customer_email"])));
              $customer_idn = AfwStringHelper::hardSecureCleanString(trim($_POST["customer_idn"]));
              $gender_id = $_POST["gender_id"];
              $customer_type_id = $_POST["customer_type_id"];
              $first_name_ar = $_POST["first_name_ar"];
              $last_name_ar = $_POST["last_name_ar"];
              
              for($cti=0;$cti<=3;$cti++)
              {
                  if($customer_type_id == $cti)  ${"customer_type_id_selected_$cti"} = "selected";
                  else ${"customer_type_id_selected_$cti"} = "";
              }
              
              if($gender_id==2)  
              {
                $gender_id_selected_2 = "selected";
                $gender_id_selected_1 = "";
              }
              else
              {
                $gender_id = 1;
                $gender_id_selected_2 = "";
                $gender_id_selected_1 = "selected";
              }  
              
              $customer_register_errors = array();
              
              list($customer_idn_correct, $customer_idn_type_id) = CrmCustomer::getIdnTypeId($customer_idn);
              if((!$customer_idn_correct) or (!$customer_idn_type_id))
              {
                   $customer_register_errors["customer_idn"] = "رقم الهوية غير صحيح";
              }
             
              $customer_mobile = CrmCustomer::formatMobile($customer_mobile);
              if(!CrmCustomer::isCorrectMobileNum($customer_mobile))
              {
                    $customer_register_errors["customer_mobile"] = "رقم الجوال غير صحيح";
              }
              
              if(!CrmCustomer::isCorrectEmailAddress($customer_email))
              {
                    $customer_register_errors["customer_email"] = "عنوان البريد الالكتروني غير صحيح";
                    //$customer_email = "";
              }
              
              
              if((!is_array($customer_register_errors)) or (count($customer_register_errors)==0)) 
              {
                     // be sure that this customer is not already existing
                     $custObj = CrmCustomer::loadByMainIndex($customer_mobile, $customer_idn_type_id, $customer_idn, $create_obj_if_not_found=false);
                     if($custObj)
                     {
                           $customer_msg = "هذا العميل موجود سابقا. قم بتسجيل الدخول  مباشرة"."<br><a href='customer_login.php?mb=$customer_mobile&idn=$customer_idn'> من هنا</a>";
                     }
                     else
                     {
                           $new_customer = 1;
                           include("$file_dir_name/../crm/customer_verify.php");
                     }
                     
                     /*
                     $custObj = CrmCustomer::loadByMainIndex($customer_mobile, $customer_idn_type_id, $customer_idn, $create_obj_if_not_found=true);
                     if($custObj)
                     {
                              
                         $custObj->set("gender_id",$gender_id);
                         $custObj->set("email",$customer_email);
                         $custObj->set("customer_type_id",$customer_type_id);
                         //$custObj->set("ref_num",$ref_num);
                         $custObj->set("first_name_ar",$first_name_ar);
                         $custObj->set("last_name_ar",$last_name_ar);
                         $custObj->commit();
                         include("$file_dir_name/../crm/customer_verify.php");
                     }
                     else
                     {
                            $customer_msg = "أثناء الحفظ. حصل خطأ أرجوا التواصل مع المشرف أو المحاولة لاحقا";
                     }
                     */
              }
              else
              {
                    $customer_msg = "تعذر الحفظ. يوجد أخطاء في البيانات";
              }
        }
        else
        {
        
              if(AfwSession::config("sms-captcha-register",true))
              {
                    $customer_msg = "الرمز المدخل خطأ ";// . $_POST["customer_cpt"] . " تختلف عن" . $_SESSION["cpt"];
              }
        }       
}
else
{
       //
       $customer_mobile = AfwStringHelper::hardSecureCleanString(trim($_GET["mb"]),true);
       $customer_email = AfwStringHelper::hardSecureCleanString(trim($_GET["em"]),true);
       $customer_idn = AfwStringHelper::hardSecureCleanString(trim($_GET["id"]),true);
}

if(!$customer_type_id) $customer_type_id = 1;

if(!$front_header_page) $front_header_page = "lib/hzm/web/hzm_header.php";
if(!file_exists("$file_dir_name/../$front_header_page"))
{
     echo "the header file $file_dir_name/../$front_header_page doesn't exist";
}
else include_once("$file_dir_name/../$front_header_page");

?>
<div class="home_banner login_banner">
<div class="modal-dialog popup-register">
        <div class="modal-content">
                <div class="modal-header">
                        <div>
                                <a href="index.php" title="الرئيسسة">
                                        <img src="pic/logo.png" alt="" title="">
                                </a>
                                        
                                <h2 class='title_login'>عميلنا العزيز، تفضل بادخال  بياناتك</h2>        
                        </div>
                </div>
                
                    <?
                       if($customer_msg)
                       {
                    ?>
                        <div class="quote">
                            <div class="quoteinn">
                               <p class='login_error'><?=$customer_msg?></p>
                            </div>
                        </div>
                    <? 
                       }         
                    ?>                    
                <div class="modal-body">
                        <form id="form_register" name="form_register" method="post" action="customer_register.php"  onSubmit="return register_checkForm();" dir="rtl" enctype="multipart/form-data">
                                <?php                                
                                if(AfwSession::config("sms-captcha-register",true))
                                {
?>
                                <div class="form-group width_pct_50">
                                        <label class="hzm_label hzm_label_customer_cpt">أدخل الرمز البصري
                                        </label>                                        
                                        <input type="text" class="form-control customer_cpt" name="customer_cpt" id="customer_cpt" value=""  autocomplete="off" required>
                                                                                
                                </div>
                                <div class='form-group width_pct_50 hzm_captcha'>
                                        <label class="hzm_label hzm_label_customer_cpt">الرمز البصري
                                        </label>
                                        <img style="width: auto;height: 42px;margin-right: 2%;" src="../lib/afw/afw_captcha.php" />                                        
                                </div>
                                <div class="form-group width_pct_100 hzm_help"> 
                                        upper or lower case doesn't matter <br>
                                        لا يهم حجم الحرف صغيرا كان أو كبيرا
                                                                                <br>
                                                قم بتحديث الصفحة إذا لم يكن الرمز واضحا
                                        
                                </div>
<?php                                
                                }
?>
                                <div class="form-group width_pct_50">
                                        <label class="hzm_label hzm_label_customer_idn label_mandatory">رقم الهوية
                                        </label>
                                        <input type="text" class="form-control" name="customer_idn" id="customer_idn" value="<?php echo $customer_idn?>"  autocomplete="off" required>
                                        <?php 
                                                if($customer_register_errors["customer_idn"]) $d_class = ""; else $d_class = "d-none"; 
                                                echo "<label id='customer_idn-error' class='down error $d_class' for='customer_idn'>".$customer_register_errors["customer_idn"]."</label>"; 
                                        ?>
                                </div>
                                <div class="form-group width_pct_50">
                                        <label class="hzm_label hzm_label_customer_mobile label_mandatory">الجوال
                                        </label>
                                        <input class="form-control" type="text" name="customer_mobile" id="customer_mobile" value="<?php echo $customer_mobile?>" required>
                                        <?php 
                                                if($customer_register_errors["customer_mobile"]) $d_class = ""; else $d_class = "d-none";
                                                echo "<label id='customer_mobile-error' class='down error $d_class' for='customer_mobile'>".$customer_register_errors["customer_mobile"]."</label>"; 
                                        ?>
                                </div>
                                
                                <div class="form-group width_pct_100">
                                        <label class="hzm_label hzm_label_customer_email">البريد الالكتروني
                                        </label>
                                        <input class="form-control" type="text" name="customer_email" id="customer_email" value="<?php echo $customer_email?>">
                                        <?php 
                                                if($customer_register_errors["customer_email"]) $d_class = ""; else $d_class = "d-none"; 
                                                echo "<label id='customer_email-error' class='down error $d_class' for='customer_email'>".$customer_register_errors["customer_email"]."</label>"; 
                                        ?>
                                </div>
                                <div class="form-group width_pct_50">
                                        <label class="hzm_label hzm_label_gender_id">الجنس
                                        </label>
                                        <select class="form-control valid" name="gender_id" id="gender_id" size="1" required>
                                			<option value="1" <?php echo $gender_id_selected_1?>>ذكر</option>
                                			<option value="2" <?php echo $gender_id_selected_2?>>انثى</option>
                                	        
                                	</select>                                        
                                </div>
                                
                                <div class="form-group width_pct_50">
                                        <label class="hzm_label hzm_label_customer_type_id">نوع العميل
                                        </label>
                                        <select class="form-control valid" name="customer_type_id" id="customer_type_id" tabindex="0" onchange="" size="1" required="" aria-invalid="false">
<?php
                $custTypeListDefault = array(1=>"عميل");
                $custTypeList = AfwSession::config("cust_type_list", $custTypeListDefault);
                foreach($custTypeList as $custTypeId => $custTypeName)
                {
                        $customer_type_id_selected_i = ($customer_type_id == $custTypeId) ? "selected" : "";
                        ?>                                        
                        <option value="<?php echo $custTypeId?>" <?php echo $customer_type_id_selected_i?>><?php echo $custTypeName?></option>        
                        <?php

                }
?>                                        
                                	</select>                                        
                                </div>

                                <div class="form-group">
                                        <label class="hzm_label hzm_label_first_name_ar label_mandatory">الاسم الأول  
                                        </label>
                                        <input type="text" class="form-control" name="first_name_ar" id="first_name_ar" dir="rtl" value="<?php echo $first_name_ar?>" maxlength="48" required>                                        
                                        <?php 
                                                if ($invester_register_errors["first_name_ar"]) $d_class = ""; else $d_class = "d-none";
                                                echo "<label id='first_name_ar-error' class='down error $d_class' for='first_name_ar'>" . $invester_register_errors["first_name_ar"] . "</label>"; 
                                        ?>
                                </div>
                                
                                <div class="form-group">
                                        <label class="hzm_label hzm_label_last_name_ar label_mandatory">الاسم الأخير  
                                        </label>
                                        <input type="text" class="form-control" name="last_name_ar" id="last_name_ar" dir="rtl" value="<?php echo $last_name_ar?>" maxlength="48" required>                                        
                                        <?php 
                                                if ($invester_register_errors["last_name_ar"]) $d_class = ""; else $d_class = "d-none";
                                                echo "<label id='last_name_ar-error' class='down error $d_class' for='last_name_ar'>" . $invester_register_errors["last_name_ar"] . "</label>"; 
                                        ?>
                                </div>
                                
                                <div class="form-group">
                                        <label class="hzm_label label_mandatory">  النجمة الحمراء تعني حقل إجباري  
                                        </label>                                                                               
                                </div>
                                <!-- logreg:<?php echo $logbl?> -->
                                <input type="submit" class="btnbtsp btn-primary btnregister" value="حفظ البيانات والدخول" name="crm_new_go">&nbsp;
                                
                                
                        </form>
                </div>
        </div>
       
</div>
<?
        include("version_2_desc.php");
?>
</div>

<script> 
        // alert('test 123');
        $(document).ready(function() {       
                $("#customer_cpt").on("input", function() {
                        $(".login_error").remove();
                        
                });

                $('#customer_mobile').on('change', function() {
                        if(!isCorrectMobileNumber($('#customer_mobile').val()))
                        {
                                $('#customer_mobile-error').removeClass('d-none').text('رقم الجوال غير صحيح، استخدم الصيغة : 0512345678');
                        }
                        else
                        {
                                $('#customer_mobile-error').addClass('d-none');
                                console.log($('#customer_mobile').val()+' is good saudi mobile number');
                        }                                                                        
                });

                $('#customer_idn').on('change', function() {
                        // alert('test 456');
                        if(validateSaudiID($('#customer_idn').val()) < 0)
                        {
                                $('#customer_idn-error').removeClass('d-none').text('رقم الهوية غير صحيح');
                        }
                        else
                        {
                                $('#customer_idn-error').addClass('d-none');
                                console.log($('#customer_idn').val()+' is good saudi ID');
                        }                                                                        
                });

                $('#first_name_ar').on('change', function() {
                        if(!isCorrectName($('#first_name_ar').val()))
                        {
                                $('#first_name_ar-error').removeClass('d-none').text('هذا الاسم غير صحيح. يجب أن يكون الاسم حروفا عربية أو انجليزية فقط');
                        }
                        else
                        {
                                $('#first_name_ar-error').addClass('d-none');
                                console.log($('#first_name_ar').val()+' is good Name');
                        }                                                                        
                });

                

                $('#last_name_ar').on('change', function() {
                        if(!isCorrectName($('#last_name_ar').val()))
                        {
                                $('#last_name_ar-error').removeClass('d-none').text('هذا الاسم غير صحيح. يجب أن يكون الاسم حروفا عربية أو انجليزية فقط');
                        }
                        else
                        {
                                $('#last_name_ar-error').addClass('d-none');
                                console.log($('#last_name_ar').val()+' is good Name');
                        }                                                                        
                });

                $('#customer_email').on('change', function() {
                        if(!isCorrectEmail($('#customer_email').val()))
                        {
                                $('#customer_email-error').removeClass('d-none').text('البريد الالكتروني غير صحيح');
                        }
                        else
                        {
                                $('#customer_email-error').addClass('d-none');
                                console.log($('#customer_email').val()+' is good email format');
                        }                                                                        
                });



                
        });
</script>

<?
        if(!$front_footer) $front_footer = "lib/hzm/web/hzm_simple_footer.php";
        if(!file_exists("$file_dir_name/../$front_footer"))
        {
                echo "the header file $file_dir_name/../$front_footer doesn't exist";
        }
        include("$file_dir_name/../$front_footer");
?>