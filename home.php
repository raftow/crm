<?php
   $file_dir_name = dirname(__FILE__);
   include("$file_dir_name/crm_start.php");

   $customerMe = AfwSession::getCustomerConnected();
   $objme = AfwSession::getUserConnected();
   

   if($customerMe)
   {
      $controllerName = "Crm";
      $methodName = "myrequests";

      $file_dir_name = dirname(__FILE__);
      include("$file_dir_name/../crm/i.php");      
   }
   elseif($objme)
   {
      $Main_Page = "stats.php";
      $My_Module = "crm";
      /*
      $cl = "Request";
      $currmod="crm";
      */
      $customerMe = null;

      include("$file_dir_name/../lib/afw/afw_main_page.php");
   }
   else
   {
      die("no one authenticated");
   }
    /*
  
  $file_dir_name = dirname(__FILE__);
  include("$file_dir_name/../aw ard/index.php");
   */
 
?>