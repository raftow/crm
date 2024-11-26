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
      include("$file_dir_name/stats.php");
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