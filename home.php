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
      $customerMe = null;
<<<<<<< HEAD
      include("$file_dir_name/stats.php");
=======

      require("$file_dir_name/../lib/afw/afw_main_page.php"); AfwMainPage::echoMainPage($MODULE);
>>>>>>> fc44ba392bef732750194f6aeb3afd63e52ff420
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