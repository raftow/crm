<?php
if (!class_exists("AfwSession")) die("Denied access");
/**
 * @var string $migration_error
 */
$server_db_prefix = AfwSession::currentDBPrefix();
try {
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "crm.crm_orgunit add new_hrm_code varchar(16);");    
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "hrm.orgunit add   log text  DEFAULT NULL;");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "crm.crm_orgunit add   id_responsible int(11) DEFAULT NULL  AFTER orgunit_id;");    
    AfwDatabase::db_query("UPDATE " . $server_db_prefix . "crm.crm_orgunit co set co.id_responsible = (select id_responsible from " . $server_db_prefix . "hrm.orgunit where id = co.orgunit_id)");
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "crm.crm_orgunit add satisfaction_report_end_date datetime;");    
    

} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}