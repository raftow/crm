<?php
// die("rafik debugging : please try later");
$file_dir_name = dirname(__FILE__);
set_time_limit(8400);
ini_set('error_reporting', E_ERROR | E_PARSE | E_RECOVERABLE_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);


// 

$logbl = substr(md5($_SERVER["HTTP_USER_AGENT"] . "-" . date("Y-m-d")),0,10);

if(!$lang) $lang = "ar";
$module_dir_name = $file_dir_name;

require_once("$file_dir_name/../lib/afw/afw_autoloader.php");
AfwSession::startSession();
$uri_module = AfwUrlManager::currentURIModule();       
AfwAutoLoader::addMainModule($uri_module);
if(!$uri_module) die("site code not defined !!!");
else
{ 
   require_once("$file_dir_name/../$uri_module/ini.php");
   require_once("$file_dir_name/../$uri_module/module_config.php");
}

include_once ("$file_dir_name/../$uri_module/application_config.php");
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

if(AfwSession::customerIsConnected()) 
{
    // die("rafik debugging : customerIsConnected");     
    header("Location: customer_index.php");
} 
elseif(($_POST["customer_mobile_or_email"]) and ($_POST["customer_idn"]) and ($_POST["crm_go"]))
{
    $customer_mobile_or_email = AfwStringHelper::hardSecureCleanString(trim(strtolower($_POST["customer_mobile_or_email"])));
    $customer_idn = AfwStringHelper::hardSecureCleanString(trim($_POST["customer_idn"]));
    if(strpos($customer_mobile_or_email, "@") === false) 
    {
        $customer_email = "";
        $customer_mobile = AfwFormatHelper::formatMobile($customer_mobile_or_email);
    }
    else
    {
        $customer_mobile = "";
        $customer_email = $customer_mobile_or_email;
    }

    $custObj = CrmCustomer::loadByLoginInfos($customer_mobile, $customer_email, $customer_idn);

    if($custObj and $custObj->sureIs("ppa"))
    {
        $_POST["ppa"] = "Y";
        include("$file_dir_name/../crm/customer_login.php");
        die();
    }
    else 
    {
        if(!$front_header_page) $front_header_page = "lib/hzm/oldweb/hzm_header.php";
        $no_menu = AfwSession::config("no_menu_for_login", true);
        if(!file_exists("$file_dir_name/../$front_header_page"))
        {
            echo "customer_login : header file $file_dir_name/../$front_header_page doesn't exist";
        }
        else 
        {
                $no_front_header = true;
                include_once("$file_dir_name/../$front_header_page");
        }    
?>
    <div class="home_banner login_banner">
    <div class="modal-dialog popup-login-customer ppa">
        <div class="modal-content">
                <div class="modal-header">
                        <div>
                                <a href="index.php" title="الرئيسسة">
                                        <img src="pic/logo.png" alt="<?=$customer_login_by_sentence?>" title="<?=$customer_login_by_sentence?>"></a>
                                        
                                <h2 class='title_login'>الموافقة على سياسة الخصوصية</h2>        
                        </div>
                </div>
                    <?php                         
                       $company = AfwSession::currentCompany();
                       $main_company_domain = AfwSession::config("main_company_domain", "$company.gov.sa");       
                       $url_ppa = AfwSession::config("url_ppa", "https://$main_company_domain/ar/Pages/PrivacyPolicy.aspx");       
                    ?>                    
                <div class="modal-body">
                        <div class="ppa">
                                <p class="special-link todo">قبل تسجيل الدخول فضلا نأمل منكم فتح الرابط أسفله ثم قراءة تفاصيل وينود سياسة الخصوصية في النافذة الجديدة ثم غلقها والموافقة عليها في هذه النافذة</p>
                                <p class="special-link ppa read"><a target="_new" href="<?php echo $url_ppa;?>">الاطلاع على سياسة الخصوصية</a></p>
                        </div><br>
                        <?php
                        if($custObj->getVal("ppa") == "W") {
                        ?>
                        <div class="ppa warning">
                                <p class="special-link important">يبدوا أن هذا الحساب مجمد يكفي قراءة سياسة الخصوصية والموافقة عليها واكمال عملية تسجيل الدخول لرفع التجميد</p>
                        </div><br>
                        <?php
                        }
                        ?>
                        <form id="formlogin2" name="formlogin2" method="post" action="customer_login.php" dir="rtl" enctype="multipart/form-data">
                                        <input type="hidden" name="customer_mobile_or_email" value="<?php echo $customer_mobile_or_email?>">
                                        <input type="hidden" name="customer_idn" value="<?php echo $customer_idn?>">                                        
                                        <input type="hidden" name="customer_id" value="<?php echo $customer_id?>">                                        
                                        
                                        <p class="ppa-acceptance hide">
                                            <input type="checkbox" name="ppa" id="ppa" value="Y">
                                            <span>
                                                أوافق على سياسة الخصوصية
                                            </span>    
                                        </p>
                                <script>  
                                $(document).ready(function() {       
                                        $(".special-link.ppa.read>a").click(function() {
                                                $(".ppa-acceptance.hide").removeClass("hide");
                                        });

                                        $(".ppa-acceptance").click(function() {
                                            if($("#ppa").val() == "Y")
                                            {
                                                $("#crm_go").removeAttr("disabled");
                                            }
                                            else 
                                            {
                                                alert("ppa val = "+$("#ppa").val());    
                                            }    
                                                
                                        });
                                });
                                </script>  

                                <input type="submit" class="btnbtsp btn-primary btnregister" value="تسجيل الدخول" id="crm_go" name="crm_go" disabled>&nbsp;
                        </form>
                </div>
        </div>
       
</div>
<?php
        include("version_2_desc.php");
?>
</div>
<?php
        if(!$front_footer) $front_footer = "lib/hzm/oldweb/hzm_simple_footer.php";
        if(!file_exists("$file_dir_name/../$front_footer"))
        {
                echo "customer_login : the footer file $file_dir_name/../$front_footer doesn't exist";
        }
        include("$file_dir_name/../$front_footer");
    }
}