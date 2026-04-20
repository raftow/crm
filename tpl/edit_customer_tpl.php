<?php
$uri_module = "crm";
$file_dir_name = dirname(__FILE__);
require_once("$file_dir_name/../../$uri_module/ini.php");
require_once("$file_dir_name/../../$uri_module/module_config.php");
include_once("$file_dir_name/../../$uri_module/application_config.php");
AfwSession::initConfig($config_arr, "system", "$file_dir_name/../$uri_module/application_config.php");
?>
<div class="cms_bg_pic contact">
        <div class='hzm_left_image award award_glue'>
                <a href='<?php echo $main_module_home_page ?>'><img alt="" src="<?php echo $img_company_path ?>/<?php echo $customer_module_banner ?>" class="award_home_image"></a>
        </div>
        <div class="content_big_title registration">تعديل الملف الشخصي للعميل</div>
        <div class="cms_bg">
                <?
                /**
                 * @var CrmCustomer $theCustomer
                 */

                if ($_POST["save_customer"]) {
                        $customer_mobile = AfwStringHelper::hardSecureCleanString(trim($_POST["customer_mobile"]));
                        $customer_email = AfwStringHelper::hardSecureCleanString(strtolower(trim($_POST["customer_email"])));
                        $customer_idn = AfwStringHelper::hardSecureCleanString(trim($_POST["customer_idn"]));
                        $gender_id = $_POST["gender_id"];
                        $customer_type_id = $_POST["customer_type_id"];
                        $first_name_ar = AfwStringHelper::hardSecureCleanString(trim($_POST["first_name_ar"]));
                        $last_name_ar = AfwStringHelper::hardSecureCleanString(trim($_POST["last_name_ar"]));
                        $org_name = AfwStringHelper::hardSecureCleanString(trim($_POST["org_name"]));
                        $ref_num = AfwStringHelper::hardSecureCleanString(trim($_POST["ref_num"]));
                } else {
                        $customer_mobile = $theCustomer->getVal("mobile");
                        $customer_email = $theCustomer->getVal("email");
                        $customer_idn = $theCustomer->getVal("idn");
                        $gender_id = $theCustomer->getVal("gender_id");
                        $customer_type_id = $theCustomer->getVal("customer_type_id");
                        $first_name_ar = $theCustomer->getVal("first_name_ar");
                        $last_name_ar = $theCustomer->getVal("last_name_ar");
                        $org_name = $theCustomer->getVal("org_name");
                        $ref_num = $theCustomer->getVal("ref_num");
                }

                if ($gender_id == 2) {
                        $gender_id_selected_2 = "selected";
                        $gender_id_selected_1 = "";
                } else {
                        $gender_id = 1;
                        $gender_id_selected_2 = "";
                        $gender_id_selected_1 = "selected";
                }

                $customer_register_errors = array();

                list($customer_idn_correct, $customer_idn_type_id) = AfwFormatHelper::getIdnTypeId($customer_idn);
                if ((!$customer_idn_correct) or (!$customer_idn_type_id)) {
                        $customer_register_errors["customer_idn"] = "رقم الهوية غير صحيح";
                }

                $customer_mobile = AfwFormatHelper::formatMobile($customer_mobile);
                if (!AfwFormatHelper::isCorrectMobileNum($customer_mobile)) {
                        $customer_register_errors["customer_mobile"] = "رقم الجوال غير صحيح";
                }

                if (!AfwFormatHelper::isCorrectEmailAddress($customer_email)) {
                        $customer_register_errors["customer_email"] = "عنوان البريد الالكتروني غير صحيح";
                        //$customer_email = "";
                }


                if ((is_array($customer_register_errors)) and (count($customer_register_errors) > 0) and $_POST["save_customer"]) {
                        $customer_msg = "تعذر الحفظ. يوجد أخطاء في البيانات";
                }


                if (!$customer_type_id) $customer_type_id = 1;


                //if(!$theCustomer) die("this ticket is lost");
                if ($theCustomer->sureIs("active")) {
                        $my_status = $theCustomer->sureIs("ppa") ? 3 : 9;
                        $my_status_decoded = $theCustomer->sureIs("ppa") ? "نشط" : "حساب مجمد"; //$theCustomer->getCustomerStatus("ar");
                } else {
                        $my_status = 8;
                        $my_status_decoded = "غير نشط";
                }



                // test of ->showAttribute(..) after ->set(..)
                // $theCustomer->set("status_id", Request::$REQUEST_STATUS_REDIRECT);
                // $my_status_show = $theCustomer->showAttribute("status_id");
                // die("my_status_show=$my_status_show");

                $customer_type_decoded = $theCustomer->decode("customer_type_id");

                $ref_num_label = $theCustomer->getAttributeLabel("ref_num", $lang);
                $org_name_label = $theCustomer->getAttributeLabel("org_name", $lang);
                // die("$ref_num_label = theCustomer->getAttributeLabel('ref_num', '$lang') / $org_name_label = theCustomer->getAttributeLabel('org_name', '$lang')");

                $note = "عزيزي المستفيد، نود التأكيد على أن الحصول على أياً من: اسمك ورقم جوالك وهويتك والرقم الوظيفي أو التدريبي هو لغرض معالجة طلبك، كما نؤكد لك اهتمامنا وحرصنا على أمان بياناتك وخصوصيتك";

                if($all_error) {
                ?>
                <div class='crm-title hzm-error'><?php echo $all_error; ?></div>
                <?php
                }

                if($all_info) {
                ?>
                <div class='crm-title hzm-info'><?php echo $all_info; ?></div>
                <?php
                }
                ?>
                <div class='crm-title hzm-info'><?php echo $note; ?></div>
                <div class="cms_container ticket_div">
                        <div class='hzm_attribute hzm_wd4 hzm_minibox_header0'>

                                <div class='front_bloc hzm_crm_bloc ticket status_<?php echo $my_status; ?>'>
                                        <div class='mb_long_title my_customer'>
                                                <div class='my_crm_ticket'>
                                                        <div class='crm_div'><?php echo $ref_num_label ?> </div>
                                                        <div class='crm_div crm_ticket_num'><?php echo $theCustomer->getVal("ref_num"); ?> </div>
                                                        <div class='crm_div'><?php echo $org_name_label ?> </div>
                                                        <div class='crm_div crm_org_name'><?php echo $theCustomer->getVal("org_name"); ?> </div>
                                                </div>
                                                <div class='my_crm_ticket fleft'>
                                                        <div class='request_status status_<?php echo $my_status; ?>'><?php echo $my_status_decoded; ?> </div>
                                                </div>
                                        </div>
                                        <div class='my_crm_bloc_title'>
                                                <div class='mb_med_title my_ticket'>
                                                        <div class='crm_calendar crm_data'>
                                                                <label> <?php echo $theCustomer->getShortDisplay("ar"); ?> </label>
                                                        </div>
                                                </div>
                                        </div>

                                        <div class='front_bloc hzm_data_props my_cms'>
                                                <form id="customer_account" name="customer_account" method="post" action="i.php" onSubmit="return register_checkForm();" dir="rtl" enctype="multipart/form-data">
                                                        <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $theCustomer->id ?>">
                                                        <input type="hidden" name="cn" id="cn" value="customer">
                                                        <input type="hidden" name="mt" id="mt" value="submitaccount">
                                                        <div class='my_crm_ticket_data'>
                                                                <div class="edit row crm_data">
                                                                        <label class="edit hzm_label hzm_label_ppa label_mandatory">الاطلاع والموافقة على سياسة الخصوصية</label>
                                                                        <div class='edit hzm_data_prop ppa-prop'>
                                                                                <?php echo $theCustomer->sureIs("ppa") ? "تم الاطلاع والموافقة" : "حساب مجمد"; ?>
                                                                        </div>
                                                                </div>
                                                                <div class="edit row crm_data">
                                                                        <label class="edit hzm_label hzm_label_mobile label_mandatory">رقم الجوال</label>
                                                                        <div class='edit hzm_data_prop mobile'>
                                                                                <?php echo $theCustomer->getVal("mobile"); ?>
                                                                        </div>
                                                                </div>
                                                                <div class="edit row crm_data">
                                                                        <label class="edit hzm_label hzm_label_email label_mandatory">البريد الالكتروني</label>
                                                                        <div class='edit hzm_data_prop email'>
                                                                                <?php echo $theCustomer->getVal("email"); ?>
                                                                        </div>
                                                                </div>
                                                                <div class="edit row crm_data">
                                                                        <label class="edit hzm_label hzm_label_idn label_mandatory">رقم الهوية</label>
                                                                        <div class='edit hzm_data_prop idn'>
                                                                                <?php echo $theCustomer->getVal("idn"); ?>
                                                                        </div>
                                                                </div>
                                                                <div class="edit row crm_data">
                                                                        <label class='edit hzm_label hzm_label_gender_id label_mandatory'>الجنس</label>
                                                                        <div class='edit hzm_data_prop gender_id'>
                                                                                <select class="form-control valid" name="gender_id" id="gender_id" size="1" required>
                                                                                        <option value="1" <?php echo $gender_id_selected_1 ?>>ذكر</option>
                                                                                        <option value="2" <?php echo $gender_id_selected_2 ?>>انثى</option>

                                                                                </select>
                                                                        </div>
                                                                </div>
                                                                <div class="edit row crm_data">
                                                                        <label class="edit hzm_label hzm_label_customer_type_id label_mandatory">نوع العميل</label>
                                                                        <div class='edit hzm_data_prop customer_type_id'>
                                                                                <select class="form-control valid" name="customer_type_id" id="customer_type_id" tabindex="0" onchange="register_customer_type_id_changed()" size="1" required="required" aria-invalid="false">
                                                                                        <?php
                                                                                        $custTypeListDefault = array(1 => "عميل");
                                                                                        $custTypeList = AfwSession::config("cust_type_list", $custTypeListDefault);
                                                                                        foreach ($custTypeList as $custTypeId => $custTypeName) {
                                                                                                $customer_type_id_selected_i = ($customer_type_id == $custTypeId) ? "selected" : "";
                                                                                        ?>
                                                                                                <option value="<?php echo $custTypeId ?>" <?php echo $customer_type_id_selected_i ?>><?php echo $custTypeName['ar'] ?></option>
                                                                                        <?php

                                                                                        }

                                                                                        $custTypeLogic = AfwSession::config("cust_type_logic", []);
                                                                                        // $custTypeLogicRow = ;
                                                                                        $org_name_label = $custTypeLogic[$customer_type_id]["org_name"]["title_ar"];
                                                                                        $org_name_class = $org_name_label ? "org-name" : "org-name hide";
                                                                                        $org_name_required = $org_name_label ? "required" : "";

                                                                                        $ref_num_label = $custTypeLogic[$customer_type_id]["ref_num"]["title_ar"];
                                                                                        $ref_num_class = $ref_num_label ? "ref-num" : "ref-num hide";
                                                                                        $ref_num_required = $ref_num_label ? "required" : "";
                                                                                        ?>
                                                                                </select>
                                                                                <script>
                                                                                        <?php


                                                                                        $js_of_cust_type = "";
                                                                                        foreach ($custTypeLogic as $custTypeId => $custTypeLogicRow) {
                                                                                                $ct_org_name_label = $custTypeLogicRow["org_name"]["title_ar"];
                                                                                                $ct_ref_num_label = $custTypeLogicRow["ref_num"]["title_ar"];

                                                                                                if ($ct_org_name_label or $ct_ref_num_label) {
                                                                                                        $js_org_name_label = "";
                                                                                                        $js_ref_num_label = "";

                                                                                                        if ($ct_org_name_label) {
                                                                                                                $js_org_name_label = "$(\"#org_name_div\").removeClass(\"hide\");
                    $(\"#label_org_name\").text('$ct_org_name_label');";
                                                                                                        }

                                                                                                        if ($ct_ref_num_label) {
                                                                                                                $js_ref_num_label = "$(\"#ref_num_div\").removeClass(\"hide\");
                    $(\"#label_ref_num\").text('$ct_ref_num_label');";
                                                                                                        }

                                                                                                        $js_of_cust_type .= "if(customer_type_id==$custTypeId)
                {
                    $js_org_name_label
                    $js_ref_num_label
                }";
                                                                                                }
                                                                                        }

                                                                                        $js_for_cust_type = "function register_customer_type_id_changed()
{
    customer_type_id = $(\"#customer_type_id\").val();
    $(\"#org_name_div\").addClass(\"hide\");
    $(\"#ref_num_div\").addClass(\"hide\");
    $js_of_cust_type
}";

                                                                                        echo $js_for_cust_type;

                                                                                        ?>
                                                                                </script>
                                                                        </div>
                                                                </div>
                                                                <div id='org_name_div' class="edit row crm_data <?php echo $org_name_class ?>">
                                                                        <label id='label_org_name' class="edit hzm_label hzm_label_org_name label_mandatory"><?php echo $org_name_label ?></label>
                                                                        <div class='edit hzm_data_prop org_name'>
                                                                                <input type="text" class="form-control" name="org_name" id="org_name" dir="rtl" value="<?php echo $org_name ?>" maxlength="48" <?php echo $org_name_required ?>>
                                                                                <?php
                                                                                if ($customer_register_errors["org_name"]) $d_class = "";
                                                                                else $d_class = "d-none";
                                                                                echo "<label id='org_name-error' class='down error $d_class' for='org_name'>" . $customer_register_errors["org_name"] . "</label>";
                                                                                ?>
                                                                        </div>
                                                                </div>
                                                                <div id='ref_num_div' class="edit row crm_data <?php echo $ref_num_class ?>">
                                                                        <label id='label_ref_num' class="edit hzm_label hzm_label_ref_num label_mandatory"><?php echo $ref_num_label ?></label>
                                                                        <div class='edit hzm_data_prop ref_num'>
                                                                                <input type="text" class="form-control" name="ref_num" id="ref_num" dir="rtl" value="<?php echo $ref_num ?>" maxlength="48" <?php echo $ref_num_required ?>>
                                                                                <?php
                                                                                if ($customer_register_errors["ref_num"]) $d_class = "";
                                                                                else $d_class = "d-none";
                                                                                echo "<label id='ref_num-error' class='down error $d_class' for='ref_num'>" . $customer_register_errors["ref_num"] . "</label>";
                                                                                ?>
                                                                        </div>
                                                                </div>


                                                                <div class="edit row crm_data"> 
                                                                        <label class="edit hzm_label hzm_label_first_name_ar label_mandatory">الاسم الأول
                                                                        </label>
                                                                        <input type="text" class="form-control" name="first_name_ar" id="first_name_ar" dir="rtl" value="<?php echo $first_name_ar ?>" maxlength="48" required>
                                                                        <?php
                                                                        if ($customer_register_errors["first_name_ar"]) $d_class = "";
                                                                        else $d_class = "d-none";
                                                                        echo "<label id='first_name_ar-error' class='down error $d_class' for='first_name_ar'>" . $customer_register_errors["first_name_ar"] . "</label>";
                                                                        ?>
                                                                </div>

                                                                <div class="edit row crm_data">
                                                                        <label class="edit hzm_label hzm_label_last_name_ar label_mandatory">الاسم الأخير
                                                                        </label>
                                                                        <input type="text" class="form-control" name="last_name_ar" id="last_name_ar" dir="rtl" value="<?php echo $last_name_ar ?>" maxlength="48" required>
                                                                        <?php
                                                                        if ($customer_register_errors["last_name_ar"]) $d_class = "";
                                                                        else $d_class = "d-none";
                                                                        echo "<label id='last_name_ar-error' class='down error $d_class' for='last_name_ar'>" . $customer_register_errors["last_name_ar"] . "</label>";
                                                                        ?>
                                                                </div>

                                                                <div class="form-footer">
                                                                        <label class="edit hzm_label label_mandatory bgwhite"> النجمة الحمراء تعني حقل إجباري
                                                                        </label>
                                                                        <input type="submit" class="btnbtsp btn-primary btnregister" value="حفظ البيانات" name="save_customer">&nbsp;
                                                                </div>






                                                        </div>
                                                </form>
                                        </div>
                                </div>


                        </div>
                </div>
                <?
                include("$file_dir_name/../customer_account_js.php");
                $cr_prefix = "العودة إلى";
                include("back_to_my_requests_tpl.php");
                ?>
        </div>
</div>