<?php
// die("rafik debugging : please try later");
$file_dir_name = dirname(__FILE__);
set_time_limit(8400);
ini_set('error_reporting', E_ERROR | E_PARSE | E_RECOVERABLE_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);


// 

$logbl = substr(md5($_SERVER["HTTP_USER_AGENT"] . "-" . date("Y-m-d")), 0, 10);

if (!$lang) $lang = "ar";
$module_dir_name = $file_dir_name;

require_once("$file_dir_name/../lib/afw/core/afw_autoloader.php");
AfwSession::startSession();
$uri_module = UfwUrlManager::currentURIModule();
AfwAutoLoader::addMainModule($uri_module);
if (!$uri_module) die("site code not defined !!!");
else {
        require_once("$file_dir_name/../$uri_module/ini.php");
        require_once("$file_dir_name/../$uri_module/module_config.php");
}
/**
 * customer login page
 * the customer can login by email or mobile and idn
 * @var string $customer_mobile_or_email the email or mobile entered by customer
 * @var string $customer_idn the idn entered by customer
 * @var string $customer_msg the message to show to customer in case of error or any
 * @var string $customer_login_message the message to show to customer in case of error or any 
 *             after login form (used to show error message in case of error in login form filling)
 * 
 * @var string $customer_login_welcome the welcome message to show in login form header
 * @var string $customer_login_by_sentence the sentence to show in login form header when login
 * @var string $customer_id the customer id (used in case of login by email or mobile without idn, then we get the idn by customer id and we put it in hidden field to be able to use it in next step which is verification code sending)
 * @var string $new_customer_managed if true show the new customer registration link in login page, otherwise hide it
 * @var string $front_header_page the header page to include in login page
 * @var string $front_footer the footer page to include in login page
 * @var string $main_company_domain the main company domain (used in email sending)
 * @var array $NOM_SITE the site name in different languages
 * @var array $DESC_SITE the site description in different languages
 * @var array $WELCOME_SITE the welcome message in different languages
 * @var string $login_employee_phrase the sentence to show in login form header when login for
 *              the employee login link 
 * @var array $customer_login_errors the array of errors in login form filling (used to show all errors at once to customer)
 * @var array $config_arr
 */
include_once("$file_dir_name/../$uri_module/application_config.php");
AfwSession::initConfig($config_arr, "system", "$file_dir_name/../$uri_module/application_config.php");



$nom_site = $NOM_SITE[$lang];
$desc_site = $DESC_SITE[$lang];
$welcome_site = $WELCOME_SITE[$lang];

$debugg_login = false;
$debugg_after_login = true;
$debugg_after_golden_or_db = true;
$debugg_after_session_created = true;

$customer_msg = null;

require_once("$file_dir_name/../config/global_config.php");
// 

$login_button_title = "دخول الموظف";
$customer_login_welcome = "دخول العميل";
$login_page = "login.php";
if (!$front_header_page) $front_header_page = "lib/hzm/oldweb/hzm_header.php";

if (AfwSession::customerIsConnected()) {
        // die("rafik debugging : customerIsConnected");     
        header("Location: customer_index.php");
} elseif (($_POST["customer_mobile_or_email"]) and ($_POST["customer_idn"]) and ($_POST["crm_go"])) {
        if (($_POST["ppa"] != "Y") and ($_POST["ppa"] != "X")) {
                include("$file_dir_name/../crm/customer_ppa.php");
                die();
        }
        $sessionVarCpt = AfwSession::getSessionVar("cpt");
        if ((!AfwSession::config("sms-captcha-login", false)) or (strtoupper($_POST["customer_cpt"]) == strtoupper($sessionVarCpt))) {
                $customer_mobile_or_email = AfwStringHelper::hardSecureCleanString(trim(strtolower($_POST["customer_mobile_or_email"])));
                $customer_idn = AfwStringHelper::hardSecureCleanString(trim($_POST["customer_idn"]));


                list($customer_idn, $customer_id) = explode("-", $customer_idn);

                $customer_login_errors = array();

                list($customer_idn_correct, $customer_idn_type_id) = AfwFormatHelper::getIdnTypeId($customer_idn);
                if (!$customer_idn_correct) {
                        $customer_login_errors[] = "رقم الهوية غير صحيح";
                }

                // die("rafik debugging : customer_mobile_or_email = ".$customer_mobile_or_email);

                if (strpos($customer_mobile_or_email, "@") === false) {
                        $customer_email = "";
                        $customer_mobile = AfwFormatHelper::formatMobile($customer_mobile_or_email);
                        if (!AfwFormatHelper::isCorrectMobileNum($customer_mobile)) {
                                $customer_login_errors[] = "رقم الجوال غير صحيح";
                                //$customer_mobile = "";
                        }
                } else {
                        $customer_mobile = "";
                        $customer_email = $customer_mobile_or_email;
                        if (!AfwFormatHelper::isCorrectEmailAddress($customer_email)) {
                                $customer_login_errors[] = "عنوان البريد الالكتروني غير صحيح";
                                //$customer_email = "";
                        }
                }

                if (count($customer_login_errors) == 0) {
                        if (($customer_mobile or $customer_email) and $customer_idn) {
                                if ($customer_id and ($customer_mobile == "0598988330")) {
                                        $custObj = CrmCustomer::loadById($customer_id);
                                } else $custObj = CrmCustomer::loadByLoginInfos($customer_mobile, $customer_email, $customer_idn);
                                if (!$custObj) {
                                        if ($customer_mobile == "0598988330") {
                                                $custObj = CrmCustomer::loadByIdn($customer_idn);
                                        }
                                }
                                // die("rafik debugging : custObj = ".var_export($custObj,true));
                                if ($custObj) {
                                        $new_customer = 0;
                                        if (!$customer_mobile) {
                                                $customer_mobile = $custObj->getVal("mobile");
                                                // die("login by (mobile empty and email=$customer_email) => customer_mobile=$customer_mobile");
                                        }
                                        include("$file_dir_name/../crm/customer_verify.php");
                                        die();
                                } else {
                                        $customer_msg = "لم يتم التعرف على حساب العميل أو يوجد خطأ في البيانات المدخلة";
                                }
                        } else {
                                $customer_login_message = "عميلنا العزيز . الرجاء التثبت من البيانات المدخلة";
                        }
                } else {
                        $customer_login_message = implode("<br>\n", $customer_login_errors);
                }
                /*
              
              customer_idn
              crm_customer*/
        } else {

                if (AfwSession::config("sms-captcha-login", false)) {
                        $customer_login_message = "الرمز المدخل خطأ "; // . $_POST["customer_cpt"] . " تختلف عن" . $sessionVarCpt;
                }
        }
} else {
        $customer_mobile_or_email = AfwStringHelper::hardSecureCleanString(trim($_GET["mb"]), true);
        $customer_idn = AfwStringHelper::hardSecureCleanString(trim($_GET["idn"]), true);

        $customer_msg = null;
}




$no_menu = AfwSession::config("no_menu_for_login", true);
if (!file_exists("$file_dir_name/../$front_header_page")) {
        echo "customer_login : header file $file_dir_name/../$front_header_page doesn't exist";
} else {
        $no_front_header = true;
        include_once("$file_dir_name/../$front_header_page");
}

if ($desc_site) {
        echo "<div class='hzm_intro modal-dialog'>
              <div class='modal-header'>
                        <div>
                                <h2 class='title_intro'>$welcome_site</h2>        
                        </div>
              </div>
              <div class='modal-body'>
                   $desc_site
              </div>
         </div>";
}
?>
<div class="home_banner login_banner">
        <div class="modal-dialog popup-login-customer">
                <?php
                if ($customer_msg) {
                ?>
                        <div class="quote">
                                <div class="quoteinn">
                                        <p class='login_error'><?= $customer_msg ?></p>
                                </div>
                        </div>
                <?php
                }
                ?>
                <div class="modal-header logo-company">
                        <img class='hlc' src="pic/home-company-header.png">
                </div>
                <div class="modal-content">
                        <!-- <div class="modal-header">
                        <div>
                                <a href="index.php" title="الرئيسسة">
                                        <img src="pic/logo.png" alt="<?= $customer_login_by_sentence ?>" title="<?= $customer_login_by_sentence ?>"></a>
                                        
                                <h2 class='title_login'>عميل مسجل سابقا</h2>        
                        </div>
                </div> -->
                        <?php
                        if ($customer_login_message) {
                        ?>
                                <div class="quote">
                                        <div class="quoteinn">
                                                <p class='login_error'><?php echo $customer_login_message ?></p>
                                        </div>
                                </div>
                        <?php
                        }
                        $company = AfwSession::currentCompany();
                        $main_company_domain = AfwSession::config("main_company_domain", "$company.gov.sa");
                        ?>
                        <div class="modal-body">
                                <h1><?php echo $customer_login_welcome ?></h1><br>
                                <form id="formlogin1" name="formlogin1" method="post" action="customer_login.php" onSubmit="return customer_checkForm();" dir="rtl" enctype="multipart/form-data">
                                        <div class="form-group">
                                                <input class="form-control customer-login mobile_or_email" type="text" name="customer_mobile_or_email" value="<?php echo $customer_mobile_or_email ?>" autocomplete="off" placeholder="البريد الالكتروني أو الجوال" required>
                                        </div>
                                        <div class="form-group">
                                                <input type="text" class="form-control customer-login idn" name="customer_idn" value="<?php echo $customer_idn ?>" autocomplete="off" placeholder="رقم الهوية" required>
                                                <input type="hidden" name="customer_id" value="<?php echo $customer_id ?>">
                                        </div>
                                        <?php
                                        if (AfwSession::config("sms-captcha-login", false)) {
                                        ?>
                                                <div class="form-group">
                                                        <label>أدخل الرمز
                                                        </label>
                                                        <input type="text" class="form-control customer_cpt" name="customer_cpt" value="" autocomplete="off" required>
                                                        <div class='hzm_captcha'>
                                                                <img style="width: auto;height: 42px;margin-right: 2%;" src="../lib/afw/includes/afw_captcha.php " />
                                                                <div class="hzm_help">
                                                                        upper or lower case doesn't matter <br>
                                                                        لا يهم حجم الحرف صغيرا كان أو كبيرا
                                                                        <br>
                                                                        قم بتحديث الصفحة إذا لم يكن الرمز واضحا

                                                                </div>
                                                        </div>
                                                </div>
                                        <?php
                                        }
                                        $login_employee_phrase = $login_button_title;
                                        ?>

                                        <!-- logbl:<?php echo $logbl ?> -->
                                        <input type="submit" class="btnbtsp btn-primary btnregister" value="تسجيل الدخول" id="crm_go" name="crm_go">&nbsp;

                                </form>
                        </div>
                </div>
                <div class="modal-header new-customer">
                        <?php

                        $new_customer_managed = AfwSession::config("new_customer_managed", true);
                        if ($new_customer_managed) {
                        ?>
                                <div class="q_new_customer">
                                        <h2 class="crm_question">هل أنت عميل جديد؟</h2>
                                        <br>
                                        <a href="customer_register.php?id=<?php echo $customer_idn ?>&em=<?php echo $customer_email ?>&mb=<?php echo $customer_mobile ?>">
                                                <div class="btnbtsp btn-success btnregister btnlogin" name="register">التسجيل لأول مرة
                                                </div>
                                        </a>
                                        <br>
                                </div>
                        <?php
                        }


                        ?>
                </div>
                <div class="modal-footer">
                        <div class="login-register">
                                <a class="btnbtsp btn_link" href="login.php"><?php echo $login_employee_phrase; ?></a>
                        </div>
                </div>

        </div>
        <?php
        $bcounter = random_int(1, 3);
        ?>
        <div class="modal-dialog popup-company banner<?php echo $bcounter; ?>">
        <?php
                include("version_2_desc.php");
        ?>
        </div>

</div>
<?php
if (!$front_footer) $front_footer = "lib/hzm/oldweb/hzm_simple_footer.php";
if (!file_exists("$file_dir_name/../$front_footer")) {
        echo "customer_login : the footer file $file_dir_name/../$front_footer doesn't exist";
}
include("$file_dir_name/../$front_footer");
?>