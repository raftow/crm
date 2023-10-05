<?php
      $file_dir_name = dirname(__FILE__); 
      
      
      /*
      $uri_items = explode("/",$_SERVER[REQUEST_URI]);
      if($uri_items[0]) $uri_module = $uri_items[0];
        else $uri_module = $uri_items[1];

      $campaign_type = 1;

      if($uri_module=="best-practice") $campaign_type = 2;
      */
      $objme_customer_id = 0;
      if($objme) 
      {
            $objme_customer_id = $objme->getCustomerId();
      }
      
      if($objme_customer_id>0)
      {      
            $requestList = Request::getMyCurrentRequests($objme_customer_id);
            $finishedRequestList = Request::getMyFinishedRequests($objme_customer_id);
      }      
      else
      {
            $requestList = array();
            $finishedRequestList = array();
      } 


       if(($objme) and ($objme->popup))
       {
            $target = "target='popup'";
            $popup_t = "on";  
       }
       else
       {
            $target = "";
            $popup_t = ""; 
       }

      $menuList = array();
      $nummenu = 0;


      $menuList[$nummenu++] = array("page"=>"main.php?Main_Page=my_account.php", "png"=>"../lib/images/profile.png", "titre"=>"حسابي", "help"=>"الإطلاع على معلوماتك الشخصية وإدارتها", "id"=>"", "class"=>"nice_small_button nice_blue", "subtheme"=>0, 
                                                         "afw"=>"Request", "mod"=>"crm", "operation"=>"");

      $menuList[$nummenu++] = array("page"=>"main.php?Main_Page=afw_mode_edit.php&cl=Request&currmod=crm", "png"=>"../lib/images/faqs.png", "titre"=>"طلب جديد", "help"=>"لتقديم طلب أو شكوى أو استفسار جديد", "id"=>"", "class"=>"nice_small_button nice_ciel", "subtheme"=>0, 
                                                         "afw"=>"Request", "mod"=>"crm", "operation"=>"");

      $menuList[$nummenu++] = array("page"=>"main.php?Main_Page=crm_my_old_requests", "png"=>"../lib/images/work.png", "titre"=>"أرشيف الطلبات القديمة", "help"=>"طلبات اغلقت ومر عليها أكثر من 6 أشهر", "id"=>"archive", "class"=>"nice_small_button nice_silver", "subtheme"=>0,
                                                         "afw"=>"Request", "mod"=>"crm", "operation"=>"");


      foreach($requestList as $rid => $requestItem)
      {
           
           $menuList[$nummenu++] = array("page"=>"main.php?Main_Page=afw_mode_edit.php&cl=Request&currmod=crm&id=$rid", "png"=>"../lib/images/application.png", "titre"=>$requestItem->getShortDisplay($lang), "help"=>$requestItem->getStatusDisplay($lang), "id"=>"", "class"=>"nice_small_button nice_pink", "subtheme"=>0, 
                                                         "afw"=>"Request", "mod"=>"crm", "operation"=>"edit");
      }
      

      foreach($finishedRequestList as $rid => $requestItem)
      {
           
           $menuList[$nummenu++] = array("page"=>"main.php?Main_Page=afw_mode_edit.php&cl=Request&currmod=crm&id=$rid", "png"=>"../lib/images/application.png", "titre"=>$requestItem->getShortDisplay($lang), "help"=>$requestItem->getStatusDisplay($lang), "id"=>"", "class"=>"nice_small_button nice_orange", "subtheme"=>0, 
                                                         "afw"=>"Request", "mod"=>"crm", "operation"=>"edit");
      }

      /*
      $qsearch_title = "الإستعلام عن طلباتي السابقة";

      $menuList[$nummenu++] = array("page"=>"main.php?Main_Page=afw_mode_qsearch.php&cl=Request&currmod=crm", "png"=>"../lib/images/search-white.png", "titre"=>$qsearch_title, "id"=>"", "class"=>"nice_small_button nice_navy", "subtheme"=>0, 
                                                 "afw"=>"Request", "mod"=>"crm", "operation"=>"");
      */
      
      if(($objme_customer_id>0) and (count($requestList)==0))
      {
           echo "<div class=\"alert messages messages--success alert-dismissable\" role=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>لا يوجد لديك طلبات حديثة</div>";
      }
      //echo var_export($menuList,true);
      include "$file_dir_name/../pag/bloc_btns_constructor.php";
      echo $html_btns;    