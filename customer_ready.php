<?php
        //effacer les var d'une eventuelle session précédente
        AfwSession::resetSession("main_company");
        $custObj->set("last_login_date", date("Y-m-d H:i:s"));
        $custObj->set("ppa", "Y");
        $custObj->commit();
        // die("debugg custObj = ".var_export($custObj,true));
        AfwSession::setCustomer($custObj->getId());

         
        $customer_default_page = $login_page_options["customer_default_page"];
        if(!$customer_default_page)  $customer_default_page = "customer_index.php";
         
        header("Location: ".$customer_default_page);
?>