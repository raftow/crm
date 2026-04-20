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
                        if (!$theCustomer->myDataIsOk()) {
                                $data["all_error"] = implode(",<br>\n", AfwDataQualityHelper::getDataErrors($theCustomer, ));
                        }                                                                                                
                        else {
                                $errors = [];
                                $infos = [];
                                if($theCustomer->commit()) {
                                        $infos[] = AfwLanguageHelper::tt("Your account has been updated successfully");
                                        $template = "account_edited";
                                        // send SMS to warn customer
                                        $token_arr = array(
                                                "[edit_datetime]" => date("Y-m-d H:i:s"),
                                        );
                                        list($sms_ok, $sms_info, $sms_body) = $theCustomer->sendSmsToCustomer($template, $lang, $token_arr);
                                        if($sms_ok) {
                                                $infos[] = AfwLanguageHelper::tt("SMS notification has been sent to customer's mobile number to inform him about the account update",$lang);
                                        }
                                        else {
                                                $errors[] = AfwLanguageHelper::tt("Failed to send SMS notification to customer's mobile number to inform him about the account update",$lang);
                                        }
                                }
                                else {
                                        $infos[] = AfwLanguageHelper::tt("Nothing was updated in your account",$lang);
                                }
                                
                                if(count($errors)>0) $data["all_error"] = implode(",<br>\n", $errors);
                                if(count($infos)>0) $data["all_info"] = implode(",<br>\n", $infos);                                
                        } 

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

        /******************************** ppnotaccepted action ********************************************** */
        
        public function preparePpnotaccepted($request)
        {
                $custom_scripts = $this->prepareStandard($request);


                return $custom_scripts;
        }


        public function initiatePpnotaccepted($request)
        {
                $lang = AfwLanguageHelper::getGlobalLanguage();
                foreach ($request as $key => $value) $$key = $value;
                $data = $request;
                AfwAutoLoader::addMainModule("crm");

                $theCustomer = self::checkLoggedIn();

                // die("will set ppa to W for theCustomer : ".var_export($theCustomer, true));

                if(!$theCustomer->id) {
                        $error_saving = AfwLanguageHelper::tt("No customer authenticated");
                        self::pushError($error_saving);
                        $data["all_error"] = $error_saving;
                }
                elseif($customer_id and ($theCustomer->id != $customer_id)) {
                        $error_saving = AfwLanguageHelper::tt("Can't edit a customer with another customer account. Data security firewall violation attempt");
                        self::pushError($error_saving);
                        $data["all_error"] = $error_saving;
                }
                else {
                        // die("will set ppa to W for customer id : ".$theCustomer->id);
                        $theCustomer->set("ppa","W");
                        $errors = [];
                        $infos = [];
                        if($theCustomer->commit()) {
                                $infos[] = AfwLanguageHelper::tt("Your account has been frozen successfully");
                                $template = "account_frozen";
                                // send SMS to warn customer
                                $token_arr = array(
                                        "[edit_datetime]" => date("Y-m-d H:i:s"),
                                );
                                list($sms_ok, $sms_info, $sms_body) = $theCustomer->sendSmsToCustomer($template, $lang, $token_arr);
                                if($sms_ok) {
                                        $infos[] = AfwLanguageHelper::tt("SMS notification has been sent to customer's mobile number to inform him about the account update",$lang);
                                }
                                else {
                                        $errors[] = AfwLanguageHelper::tt("Failed to send SMS notification to customer's mobile number to inform him about the account update",$lang);
                                }
                        }
                        else {
                                $infos[] = AfwLanguageHelper::tt("Nothing was updated in your account",$lang);
                        }
                        
                        if(count($errors)>0) $data["all_error"] = implode(",<br>\n", $errors);
                        if(count($infos)>0) $data["all_info"] = implode(",<br>\n", $infos);                                
                        

                }

                $data["theCustomer"] = $theCustomer;

                foreach ($request as $key => $value) $data[$key] = $value;
                // die("ppnotaccepted data = ".var_export($data,true));
                return $data;
        }

        public function ppnotaccepted($request)
        {
                $data = $request;
                AfwSession::startSession();
                AfwSession::logout();
                $this->renderLogOutMessage("Your account has been frozen");
        }

        /* cause infinite loop I don't know why
        public function logout($request)
        {
                AfwSession::startSession();
                AfwSession::logout();
                //else echo "you are not connected";
                header("Location: customer_login.php");
        }*/


        /******************************** advanced action ********************************************** */
        public function prepareAdvanced($request)
        {
                $custom_scripts = $this->prepareStandard($request);


                return $custom_scripts;
        }

        public function initiateAdvanced($request)
        {
                global $lang;
                if (!$lang) $lang = "ar";
                if ($lang == "ar") $lang_suffix = "";
                else $lang_suffix = "_" . $lang;


                $theCustomer = self::checkLoggedIn();

                $data["theCustomer"] = $theCustomer;
                $data["html_advanced"] = $theCustomer->calcOinfo_html("value", true);
                
                // $data = AfwPrevilegeHelper::prepareAfwTokens($theCustomer, "",$lang,[],$data,true,true);

                foreach ($request as $key => $value) $data[$key] = $value;

                return $data;
        }

        public function advanced($request)
        {
                $data = $request;                
                $data["main_module_home_page"] = AfwSession::config("main_module_home_page", "");
                $data["customer_module_banner"] = AfwSession::config("customer_module_banner", "");
                // die("customer advanced data = ".var_export($data,true));
                // call the view 1
                $this->render("crm", "view_advanced", $data);
        }


        
}