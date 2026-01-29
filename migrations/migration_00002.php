<?php
if(!class_exists("AfwSession")) die("Denied access");

$server_db_prefix = AfwSession::config("db_prefix", "default_db_");
try
{   

    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.request_status add who_enum smallint;"); 
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.request_status add user_type_menum varchar(255);"); 


    AfwDatabase::db_query("DROP TABLE IF EXISTS ".$server_db_prefix."crm.survey_token;");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS ".$server_db_prefix."crm.`survey_token` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `created_by` int(11) NOT NULL,
    `created_at`   datetime NOT NULL,
    `updated_by` int(11) NOT NULL,
    `updated_at` datetime NOT NULL,
    `validated_by` int(11) DEFAULT NULL,
    `validated_at` datetime DEFAULT NULL,
    `active` char(1) NOT NULL,
    `draft` char(1) NOT NULL default  'Y' ,
    `version` int(4) DEFAULT NULL,
    `update_groups_mfk` varchar(255) DEFAULT NULL,
    `delete_groups_mfk` varchar(255) DEFAULT NULL,
    `display_groups_mfk` varchar(255) DEFAULT NULL,
    `sci_id` int(11) DEFAULT NULL,
    
        
    survey_id int(11) NOT NULL DEFAULT 0 , 
    customer_id int(11) NOT NULL DEFAULT 0 , 
    survey_token varchar(32)  NOT NULL , 
    attribute_enum_1 smallint DEFAULT NULL , 
    attribute_enum_2 smallint DEFAULT NULL , 
    attribute_enum_3 smallint DEFAULT NULL , 
    attribute_enum_4 smallint DEFAULT NULL , 
    attribute_enum_5 smallint DEFAULT NULL , 
    attribute_enum_6 smallint DEFAULT NULL , 
    attribute_enum_7 smallint DEFAULT NULL , 
    attribute_enum_8 smallint DEFAULT NULL , 
    attribute_enum_9 smallint DEFAULT NULL , 
    attribute_enum_10 smallint DEFAULT NULL , 
    attribute_yn_1 char(1) DEFAULT NULL , 
    attribute_yn_2 char(1) DEFAULT NULL , 
    attribute_yn_3 char(1) DEFAULT NULL , 
    attribute_yn_4 char(1) DEFAULT NULL , 
    attribute_yn_5 char(1) DEFAULT NULL , 
    attribute_yn_6 char(1) DEFAULT NULL , 
    attribute_yn_7 char(1) DEFAULT NULL , 
    attribute_yn_8 char(1) DEFAULT NULL , 
    attribute_yn_9 char(1) DEFAULT NULL , 
    attribute_yn_10 char(1) DEFAULT NULL , 
    attribute_date_1 varchar(8) DEFAULT NULL , 
    attribute_date_2 varchar(8) DEFAULT NULL , 
    attribute_gdate_1 datetime DEFAULT NULL , 
    attribute_gdate_2 datetime DEFAULT NULL , 
    attribute_string_1 varchar(128)  DEFAULT NULL , 
    attribute_string_2 varchar(128)  DEFAULT NULL , 
    attribute_string_3 varchar(128)  DEFAULT NULL , 
    attribute_area_1 text  DEFAULT NULL , 
    attribute_area_2 text  DEFAULT NULL , 
    attribute_area_3 text  DEFAULT NULL , 

    
    PRIMARY KEY (`id`)
    ) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");

    AfwDatabase::db_query("create unique index uk_survey_token on ".$server_db_prefix."crm.survey_token(survey_token);"); 
    
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.request add last_response_id int(11);"); 
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.request add confidential char(1) after request_text;"); 
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.request add nb_taqibs smallint after status_time;"); 
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.request add hours_investigator_work int after status_time;"); 
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.response_type add from_employee char(1);"); 
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.crm_orgunit add late_days smallint;"); 
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.crm_orgunit add perf_stats_days smallint;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.crm_orgunit add standard_stats_days smallint;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.crm_orgunit add satisfaction_stats_days smallint;");
    

    /*
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.response CONVERT TO CHARACTER SET utf8mb4;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.crm_customer add org_name varchar(64) after ref_num;");

    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.request add ref_num varchar(32) after supervisor_id;");
    AfwDatabase::db_query("ALTER TABLE ".$server_db_prefix."crm.request add org_name varchar(64) after ref_num;");
    AfwDatabase::db_query("UPDATE ".$server_db_prefix."crm.request_status me SET updated_by = 1, updated_at = '2025-09-07 11:36:05', version = 5,  customer_status_name_ar = _utf8'طلب قديم مؤرشف', customer_status_name_en = 'old archived request' WHERE id = '9';");
    AfwDatabase::db_query("DELETE FROM ".$server_db_prefix."hrm.`employee` where id (2,3);");
    AfwDatabase::db_query("INSERT INTO ".$server_db_prefix."hrm.`employee` VALUES 
            (2,1,'2024-12-26 07:54:05',1,'2024-12-26 07:54:05',NULL,NULL,'Y',NULL,NULL,NULL,NULL,NULL,2,1,'المهمة',NULL,NULL,'الآلية','Scheduled',NULL,NULL,'Task',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
            (3,1,'2025-09-07 18:05:23',1,'2025-09-07 18:06:31',0,NULL,'Y',3,NULL,NULL,NULL,0,1654,1,'عميل','','','المؤسسة','Customer','','','ttc','',183,'',1,1,9323,33,NULL,'customer@ttc.com','102050','','','customer@ttc.com','','',NULL,'','',NULL,'',NULL,NULL,NULL,NULL,'');    ");
    */
    
}
catch(Exception $e)
{
    $migration_info .= " " . $e->getMessage();
}



