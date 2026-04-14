<?php

class CustomerController extends CrmController
{
        /******************************** account action ********************************************** */
        public function prepareAccount($request)
        {
                $custom_scripts = $this->prepareStandard($request);


                return $custom_scripts;
        }

        public function initiateAccount($request)
        {
                global $lang;
                if (!$lang) $lang = "ar";
                if ($lang == "ar") $lang_suffix = "";
                else $lang_suffix = "_" . $lang;


                $theCustomer = self::checkLoggedIn();

                $data["theCustomer"] = $theCustomer;
                
                // $data = AfwPrevilegeHelper::prepareAfwTokens($theCustomer, "",$lang,[],$data,true,true);

                foreach ($request as $key => $value) $data[$key] = $value;

                return $data;
        }

        public function account($request)
        {
                $data = $request;                
                $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                // die("customer account data = ".var_export($data,true));
                // call the view 1
                $this->render("crm", "view_customer", $data);
        }
        
        /******************************** editaccount action ********************************************** */
        public function prepareEditaccount($request)
        {
                $custom_scripts = $this->prepareStandard($request);


                return $custom_scripts;
        }

        public function initiateEditaccount($request)
        {
                global $lang;
                if (!$lang) $lang = "ar";
                if ($lang == "ar") $lang_suffix = "";
                else $lang_suffix = "_" . $lang;


                $theCustomer = self::checkLoggedIn();

                $data["theCustomer"] = $theCustomer;
                
                // $data = AfwPrevilegeHelper::prepareAfwTokens($theCustomer, "",$lang,[],$data,true,true);

                foreach ($request as $key => $value) $data[$key] = $value;

                return $data;
        }

        public function editaccount($request)
        {
                $data = $request;                
                $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                // die("customer account data = ".var_export($data,true));
                // call the view 1
                $this->render("crm", "edit_customer", $data);
        } 

        /******************************** submitaccount action ********************************************** */
        
        public function prepareSubmitaccount($request)
        {
                $custom_scripts = $this->prepareStandard($request);


                return $custom_scripts;
        }


        public function initiateSubmitaccount($request)
        {
                global $lang;
                if (!$lang) $lang = "ar";
                if ($lang == "ar") $lang_suffix = "";
                else $lang_suffix = "_" . $lang;


                $lang = AfwLanguageHelper::getGlobalLanguage();
                foreach ($request as $key => $value) $$key = $value;
                $data = $request;
                AfwAutoLoader::addMainModule("crm");

                $theCustomer = self::checkLoggedIn();

                if(!$theCustomer->id) {
                        $error_saving = AfwLanguageHelper::tt("No customer authenticated");
                        self::pushError($error_saving);
                        $data["all_error"] = $error_saving;
                }
                elseif($theCustomer->id != $customer_id) {
                        $error_saving = AfwLanguageHelper::tt("Can't edit a customer with another customer account. Data security firewall violation attempt");
                        self::pushError($error_saving);
                        $data["all_error"] = $error_saving;
                }
                else {

                        $theCustomer->set("gender_id",$gender_id);
                        $theCustomer->set("customer_type_id",$customer_type_id);
                        $theCustomer->set("first_name_ar",$first_name_ar);
                        $theCustomer->set("last_name_ar",$last_name_ar);
                        $theCustomer->set("ref_num",$ref_num);
                        $theCustomer->set("org_name",$org_name);
                        // if he edit account we consider as if he login we the new data
                        $theCustomer->set("last_login_date", date("Y-m-d H:i:s"));
                        // if he edit account we consider it Privacy Policy Acceptance
                        $theCustomer->set("ppa", "Y");
                        if (!$theCustomer->isOk(true)) {
                                $data["all_error"] = implode(",\n", AfwDataQualityHelper::getDataErrors($theCustomer, ));
                        }                                                                                                
                        else $theCustomer->commit();

                }

                $data["theCustomer"] = $theCustomer;

                foreach ($request as $key => $value) $data[$key] = $value;

                return $data;
        }

        public function submitaccount($request)
        {
                $data = $request;

                $this->editaccount($data);

        }


        
}