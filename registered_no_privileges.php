<?php
$file_dir_name = dirname(__FILE__);

require_once("$file_dir_name/../config/global_config.php");
$objme = AfwSession::getUserConnected();
$lang = AfwLanguageHelper::getGlobalLanguage();
$wb_prefix = AfwLanguageHelper::tt("Welcome", $lang);
$full_name = $objme->getShortDisplay($lang);
$crmEmplmObj = new CrmEmployee();
$phrase = "$wb_prefix $full_name <br> " . 
     $crmEmplmObj->tm("Your are registered now, you can contact your administrator to give you privileges", $lang) . 
     "<br>" . $objme->tm("You may need to attach the approval from your direct manager for this") . 
     " <!-- user name : [" . $objme->getVal("username") . "] -->";
$out_scr .= "<div class='crm-information hzm-info'>
        <i class=\"hzm-container-center hzm-vertical-align-middle hzm-icon-fm hzm-icon-inbox\"></i>
        $phrase
        </div>";
      

                             
?>