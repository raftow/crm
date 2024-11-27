<?php
$file_dir_name = dirname(__FILE__); 
include_once ("$file_dir_name/ini.php");
<<<<<<< HEAD
include_once ("$file_dir_name/module_config.php"); 
require("$file_dir_name/../lib/afw/afw_main_page.php"); 
if($_REQUEST["Main_Page"])
{
    $Main_Page = $_REQUEST["Main_Page"];
}
else
{
    $Main_Page = "home.php";
}
AfwMainPage::echoMainPage($MODULE, $Main_Page, $file_dir_name);
=======
include_once ("$file_dir_name/module_config.php");

//echo "The system is under maintenance please contact administrator or try later.";


$file_dir_name = dirname(__FILE__);
require("$file_dir_name/../lib/afw/afw_main_page.php"); AfwMainPage::echoMainPage($MODULE);

?>
>>>>>>> fc44ba392bef732750194f6aeb3afd63e52ff420
