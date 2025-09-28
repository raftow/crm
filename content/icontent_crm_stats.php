<?php
$tokens = [];
$tokens["customer_nb"] = CrmCustomer::aggreg("count(*)");
$tokens["customers_title"] = CrmCustomer::t('crm_customer', $lang);
$tokens["request_nb"] = Request::aggreg("count(*)");
$tokens["requests_title"] = Request::t('request', $lang);
$tokens["orgunit_nb"] = CrmOrgunit::aggreg("count(*)");
$tokens["orgunits_title"] = CrmOrgunit::t('', $lang);
$tokens["subject_nb"] = 139; //RequestSubject::aggreg("count(*)");
$tokens["subjects_title"] = Request::t('request_subject', $lang);
$tokens["satisfaction_pct"] = Request::satisfactionPct();
$tokens["satisfaction_title"] = Request::t('satisfaction', $lang);
$tokens["mytasks_nb"] = 11;
$tokens["mytasks_title"] = Request::t('tasks', $lang);
$tokens["days_avg"] = Request::nbDaysWorkByTicketAverage();
$tokens["days_avg_title"] = Request::t('days_avg', $lang);
$tokens["response_avg"] = Request::nbDaysReactionByTicketAverage();
$tokens["response_avg_title"] = Request::t('response_avg', $lang);
$tokens["nb_without"] = Request::nbClosedTicketsWithoutTaqib();
$tokens["nb_without_title"] = Request::t('nb_without', $lang);
$tokens["nb_with"] = Request::nbClosedTicketsWithTaqib();
$tokens["nb_with_title"] = Request::t('nb_with', $lang);
$tokens["nb_closed"] = $tokens["nb_without"] + $tokens["nb_with"];
$tokens["nb_closed_title"] = Request::t('nb_closed', $lang);


$tokens["pct_without"] = Request::pctClosedTicketsWithoutTaqib()."%";
$tokens["pct_without_title"] = Request::t('pct_without', $lang);



return $tokens;