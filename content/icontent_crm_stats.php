<?php


$objme = AfwSession::getUserConnected();
if(!$objme) return [];
// $myEmplObj = $objme->getEmployee();
$myEmplId = $objme->getEmployeeId();
$myCrmEmplObj = CrmEmployee::getDefaultCrmEmployee($myEmplId);
$orgunit_id = $myCrmEmplObj ? $myCrmEmplObj->getVal("orgunit_id") : 0;

// The crm center should see all the stats of all departments, so we set orgunit_id to 0
if($orgunit_id==CrmEmployee::$CRM_CENTER_ID) $orgunit_id = 0;

$department_supervisor = ($objme->isSuperAdmin() or ($myCrmEmplObj and $myCrmEmplObj->sureIs("super_admin")) or $objme->hasRole("crm", CrmObject::$AROLE_OF_GENERAL_SUPERVISOR));
$from_crm_center = ($objme->isSuperAdmin() or ($myCrmEmplObj and $myCrmEmplObj->isFromCrmCenter()));
$general_supervisor = ($department_supervisor and $from_crm_center);


$server_db_prefix = AfwSession::currentDBPrefix();
$period = intval(CrmOrgunit::getGlobalCRMCenter()->getVal("standard_stats_days"));
$date_start_stats = Request::calc_date_start_stats();
$r = new Request();

$tokens = [];
$tokens["general_stats"] = Request::t('general_stats', $lang);
$tokens["monitoring"] = Request::t('monitoring', $lang);
$tokens["satisfaction"] = Request::t('satisfaction', $lang);
$tokens["period"] = "(" . $r->translate("period", $lang) . " " . $period . " " . $r->translate("day(s)", $lang) . ")";
$tokens["customer_nb"] = CrmCustomer::aggreg("count(*)"); // all active or no
$tokens["customers_title"] = CrmCustomer::t('crm_customer', $lang);


$tokens["new_customers_nb"] = CrmCustomer::newCustomersCount($period, $orgunit_id);
$tokens["new_customers_title"] = CrmCustomer::t('new_customers_title', $lang);
$nb_new_customers_error_limit = 1;
$nb_new_customers_warning_limit = 3;
if ($tokens["new_customers_nb"] < $nb_new_customers_error_limit) $tokens["new_customers_nb_status"] = "error";
elseif ($tokens["new_customers_nb"] < ($nb_new_customers_warning_limit)) $tokens["new_customers_nb_status"] = "warning";
else $tokens["new_customers_nb_status"] = "ok";


$statsByType = CrmOrgunit::statsByType(0);

$ot_stats = [];
$ot_labels = [];
foreach($statsByType as $statsByTypeRow) {
    $ot_id = $statsByTypeRow["id"];
    $ot_stats[$ot_id] = $statsByTypeRow["nb"];
    $ot_labels[$ot_id] = $statsByTypeRow["orgunit_type"];
}

$ot_codes = [];
$ot_codes[3] = "division";
$ot_codes[4] = "department";
$ot_codes[9] = "college";
$ot_codes[10] = "institute";
$ot_codes[13] = "general";
$ot_codes[14] = "deputy";
$ot_codes[15] = "training";
$ot_codes[16] = "region";

foreach($ot_codes as $ot_id => $ot_code) {
    $tokens[$ot_code."_nb"] = $ot_stats[$ot_id];
    $tokens[$ot_code."s_title"] = $ot_labels[$ot_id];
}


if($general_supervisor) {
    $tokens["general_stats_s"] = "";
    $tokens["general_stats_e"] = "";
}
else {
    $tokens["general_stats_s"] = "<!-- ";
    $tokens["general_stats_e"] = " -->";
}

$tokens["orgunit_nb"] = CrmOrgunit::aggreg("count(*)", "active='Y'");
$tokens["orgunits_title"] = CrmOrgunit::t('crm_orgunit', $lang);
$tokens["subject_nb"] = 139; //RequestSubject::aggreg("count(*)");
$tokens["subjects_title"] = Request::t('request_subject', $lang);
$tokens["crm_employees_nb"] = CrmEmployee::aggreg("count(*)", "active='Y'");
$tokens["crm_employees_title"] = CrmEmployee::t('crm_employee.short', $lang);
$tokens["operators_nb"] = CrmEmployee::aggreg("count(*)", "active='Y' and investigator='Y'");
$tokens["operators_title"] = CrmEmployee::t('investigators', $lang);
$dailyCapacity = Request::inboxDailyCapacityForMe();
$tokens["mytasks_nb"] = Request::inboxCountForMe();
if ($tokens["mytasks_nb"] > $dailyCapacity) $tokens["mytasks_nb_status"] = "error";
elseif ($tokens["mytasks_nb"] > (0.7 * $dailyCapacity)) $tokens["mytasks_nb_status"] = "warning";
else $tokens["mytasks_nb_status"] = "ok";

$tokens["mytasks_title"] = Request::t('tasks', $lang);
$tokens["days_avg"] = $days_avg = Request::nbDaysWorkByTicketAverage();
$tokens["days_avg_title"] = Request::t('days_avg', $lang);
if ($tokens["days_avg"] > 7) $tokens["days_avg_status"] = "error";
elseif ($tokens["days_avg"] > 5) $tokens["days_avg_status"] = "warning";
else $tokens["days_avg_status"] = "ok";
$tokens["response_avg"] = Request::nbDaysReactionByTicketAverage($days_avg);
if ($tokens["response_avg"] > 2.5) $tokens["response_avg_status"] = "error";
elseif ($tokens["response_avg"] > 1.5) $tokens["response_avg_status"] = "warning";
else $tokens["response_avg_status"] = "ok";
$tokens["response_avg_title"] = Request::t('response_avg', $lang);
$tokens["nb_without"] = Request::nbRespondedTicketsWithoutTaqib();
$tokens["nb_without_title"] = Request::t('nb_without', $lang);
$tokens["nb_with"] = Request::nbRespondedTicketsWithTaqib();
$tokens["nb_with_title"] = Request::t('nb_with', $lang);
$tokens["nb_responded"] = $tokens["nb_without"] + $tokens["nb_with"];
$tokens["nb_responded_title"] = Request::t('nb_responded', $lang);

$tokens["nb_closed"] = Request::nbClosedTickets();
$tokens["nb_closed_title"] = Request::t('nb_closed', $lang);


$tokens["request_nb"] = Request::aggreg("count(*)", "status_id not in (0,1,101,102)");
$tokens["requests_title"] = Request::t('tickets-total', $lang);

$nb_responses_warning_limit = $tokens["request_nb_period"] = Request::aggreg("count(*)", "status_id not in (0,1,101,102) and request_date >= '$date_start_stats'");
$tokens["requests_period_title"] = Request::t('tickets', $lang);


$nb_responded_error_limit = round($tokens["request_nb_period"] * 0.5);
$nb_responded_warning_limit = round($tokens["request_nb_period"] * 0.75);

$nb_closed_error_limit = round($tokens["request_nb_period"] * 0.3);
$nb_closed_warning_limit = round($tokens["request_nb_period"] * 0.5);

if ($tokens["nb_closed"] < $nb_closed_error_limit) $tokens["nb_closed_status"] = "error";
elseif ($tokens["nb_closed"] < ($nb_closed_warning_limit)) $tokens["nb_closed_status"] = "warning";
else $tokens["nb_closed_status"] = "ok";


if ($tokens["nb_responded"] < $nb_responded_error_limit) $tokens["nb_responded_status"] = "error";
elseif ($tokens["nb_responded"] < ($nb_responded_warning_limit)) $tokens["nb_responded_status"] = "warning";
else $tokens["nb_responded_status"] = "ok";




$late_request_error_limit = $tokens["orgunit_nb"] * 0.5;
$late_request_warning_limit = $tokens["orgunit_nb"] * 0.3;
$tokens["late_request_nb"] = Request::lateRequestsCount();
$tokens["late_requests_title"] = Request::t('tickets-late', $lang);

if ($tokens["late_request_nb"] > $late_request_error_limit) $tokens["late_request_nb_status"] = "error";
elseif ($tokens["late_request_nb"] > $late_request_warning_limit) $tokens["late_request_nb_status"] = "warning";
else $tokens["late_request_nb_status"] = "ok";


$tokens["response_nb"] = Response::aggreg("count(*)", "active='Y' and internal='N'");
$tokens["responses_title"] = Response::t('response', $lang);

$tokens["response_nb_period"] = Response::aggreg("count(*)", "active='Y' and internal='N' and response_date >= '$date_start_stats'");
$tokens["responses_period_title"] = Response::t('recent-responses', $lang);

$nb_responses_error_limit = round($nb_responses_warning_limit * 0.7);

if ($tokens["response_nb_period"] < $nb_responses_error_limit) $tokens["response_nb_period_status"] = "error";
elseif ($tokens["response_nb_period"] < ($nb_responses_warning_limit)) $tokens["response_nb_period_status"] = "warning";
else $tokens["response_nb_period_status"] = "ok";




$wwpct = Request::calcPctRespondedTicketsWithoutTaqib($tokens["nb_without"], $tokens["nb_with"]);

$wwpct_error_limit = 80.0;
$wwpct_warning_limit = 90.0;

if ($wwpct < $wwpct_error_limit) $tokens["nb_without_status"] = "error";
elseif ($wwpct < $wwpct_warning_limit) $tokens["nb_without_status"] = "warning";
else $tokens["nb_without_status"] = "ok";



$tokens["pct_without"] = $wwpct . "%";
$tokens["pct_without_title"] = Request::t('pct_without', $lang);


// satisfaction survey
list(
    $pct,
    $date_start_stats,
    $date_end_stats,
    $date_start_stats_greg,
    $date_end_stats_greg,
    $total_sent,
    $total_participated
) = SurveyToken::satisfactionPct();

$tokens["satisfaction_pct"] = $pct;
$tokens["satisfaction_title"] = Request::t('satisfaction', $lang);
$tokens["satisfaction_period"] = "(" . $r->translate("from", $lang, true) . " $date_start_stats_greg " . $r->translate("to", $lang, true) . " $date_end_stats_greg)";


$tokens["survey_sent_nb_period"] = $total_sent;
$tokens["survey_sent_period_title"] = Request::t('survey-sent', $lang);

$tokens["survey_ready_nb_period"] = Request::nbSurveyReadyTickets();
$tokens["survey_ready_period_title"] = Request::t('survey-ready-period-title', $lang);

$nb_survey_sent_warning_limit = round($tokens["survey_ready_nb_period"] * 0.9);
$nb_survey_sent_error_limit = round($tokens["survey_ready_nb_period"] * 0.7);

if ($tokens["survey_sent_nb_period"] < $nb_survey_sent_error_limit) $tokens["survey_sent_nb_period_status"] = "error";
elseif ($tokens["survey_sent_nb_period"] < ($nb_survey_sent_warning_limit)) $tokens["survey_sent_nb_period_status"] = "warning";
else $tokens["survey_sent_nb_period_status"] = "ok";



$nb_survey_opened_warning_limit = round($tokens["survey_sent_nb_period"] / 20);
$nb_survey_opened_error_limit = round($tokens["survey_sent_nb_period"] / 50);


$tokens["survey_opened_nb_period"] = $total_participated;
/*
    SurveyToken::aggreg("count(*)","active = 'Y'  
                                and survey_id = '1' 
                                and attribute_date_1 between '$date_start_stats' and '$date_end_stats' 
                                and attribute_yn_1='Y'
                        ");
    */
$tokens["survey_opened_period_title"] = Request::t('survey-opened', $lang);


if ($tokens["survey_opened_nb_period"] < $nb_survey_opened_error_limit) $tokens["survey_opened_nb_period_status"] = "error";
elseif ($tokens["survey_opened_nb_period"] < ($nb_survey_opened_warning_limit)) $tokens["survey_opened_nb_period_status"] = "warning";
else $tokens["survey_opened_nb_period_status"] = "ok";



$satisfaction_pct_error_limit = 10;
$satisfaction_pct_warning_limit = 30;
if ($tokens["satisfaction_pct"] < $satisfaction_pct_error_limit) $tokens["satisfaction_pct_status"] = "error";
elseif ($tokens["satisfaction_pct"] < ($satisfaction_pct_warning_limit)) $tokens["satisfaction_pct_status"] = "warning";
else $tokens["satisfaction_pct_status"] = "ok";


return $tokens;

