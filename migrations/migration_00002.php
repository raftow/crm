<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::config("db_prefix", "default_db_");
try
{
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.response CONVERT TO CHARACTER SET utf8mb4;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.crm_customer add org_name varchar(64) after ref_num;");

    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.request add ref_num varchar(32) after supervisor_id;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.request add org_name varchar(64) after ref_num;");
    AfwDatabase::db_query("UPDATE ".$server_db_prefix."crm.request_status me SET updated_by = 1, updated_at = '2025-09-07 11:36:05', version = 5,  customer_status_name_ar = _utf8'طلب قديم مؤرشف', customer_status_name_en = 'old archived request' WHERE id = '9';");
    AfwDatabase::db_query("DELETE FROM ".$server_db_prefix."hrm.`employee` where id (2,3);");
    AfwDatabase::db_query("INSERT INTO ".$server_db_prefix."hrm.`employee` VALUES 
            (2,1,'2024-12-26 07:54:05',1,'2024-12-26 07:54:05',NULL,NULL,'Y',NULL,NULL,NULL,NULL,NULL,2,1,'المهمة',NULL,NULL,'الآلية','Scheduled',NULL,NULL,'Task',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
            (3,1,'2025-09-07 18:05:23',1,'2025-09-07 18:06:31',0,NULL,'Y',3,NULL,NULL,NULL,0,1654,1,'عميل','','','المؤسسة','Customer','','','TVTC','',183,'',1,1,9323,33,NULL,'customer@tvtc.com','102050','','','customer@tvtc.com','','',NULL,'','',NULL,'',NULL,NULL,NULL,NULL,'');    ");
    
    
}
catch(Exception $e)
{
    $migration_info .= " " . $e->getMessage();
}


