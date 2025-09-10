<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::config("db_prefix", "default_db_");
try
{
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.response CONVERT TO CHARACTER SET utf8mb4;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.crm_customer add org_name varchar(64) after ref_num;");

    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.request add ref_num varchar(32) after supervisor_id;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.request add org_name varchar(64) after ref_num;");
}
catch(Exception $e)
{
    $migration_info .= " " . $e->getMessage();
}


