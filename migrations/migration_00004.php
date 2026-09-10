<?php
if (!class_exists("AfwSession")) die("Denied access");
/**
 * @var string $migration_error
 */
$server_db_prefix = AfwSession::currentDBPrefix();
try {
    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "crm.crm_orgunit add   id_responsible int(11) DEFAULT NULL  AFTER orgunit_id;");
    AfwDatabase::db_query("UPDATE " . $server_db_prefix . "crm.crm_orgunit co set co.id_responsible = (select id_responsible from " . $server_db_prefix . "hrm.orgunit where id = co.orgunit_id)");

    AfwDatabase::db_query("DROP TABLE IF EXISTS " . $server_db_prefix . "crm.request_category;");

    AfwDatabase::db_query("CREATE TABLE IF NOT EXISTS " . $server_db_prefix . "crm.`request_category` (
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
  
  `lookup_code` varchar(64) DEFAULT NULL,  
   name_ar varchar(32)  NOT NULL DEFAULT '' , 
   name_en varchar(32)  NOT NULL DEFAULT '' , 
   request_type_mfk varchar(255) DEFAULT NULL , 
  
  PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;");


    // -- unique index : 
    AfwDatabase::db_query("create unique index uk_request_category on " . $server_db_prefix . "crm.request_category(lookup_code);");

    AfwDatabase::db_query("insert into " . $server_db_prefix . "crm.request_category(id, created_by,created_at,active,version, lookup_code, name_ar, name_en, request_type_mfk)
        select id, created_by,created_at,active,version, lookup_code, name_ar, name_en, concat(',',id,',')  from " . $server_db_prefix . "crm.request_type where id != 18 and active='Y' and is_public='Y';");


    AfwDatabase::db_query("insert into " . $server_db_prefix . "crm.request_category
VALUES (18,1,'2026-09-09 14:08:05',1,'2026-09-09 14:12:55',NULL,NULL,'Y','Y',1,NULL,NULL,NULL,NULL,'fraud','الاحتيال','fraud',',18,'),
(19,1,'2026-09-09 14:12:55',1,'2026-09-09 14:12:55',0,NULL,'Y','Y',1,',',',',',',NULL,'corruption','الفساد','corruption',',18,'),
(20,1,'2026-09-09 14:12:55',1,'2026-09-09 14:12:55',0,NULL,'Y','Y',1,',',',',',',NULL,'violations','المخالفات المالية','financial violations',',18,'),
(9999,1,'2026-09-09 14:08:05',0,'0000-00-00 00:00:00',NULL,NULL,'Y','Y',0,NULL,NULL,NULL,NULL,'other','أخرى','other',',2,3,12,13,18,');
");

    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "crm.request add   request_category_id int(11) NOT NULL DEFAULT 0  AFTER request_type_id;");
    AfwDatabase::db_query("UPDATE " . $server_db_prefix . "crm.request SET request_category_id = request_type_id");

    AfwDatabase::db_query("ALTER TABLE " . $server_db_prefix . "crm.request_braudit add   request_category_id int(11) NOT NULL DEFAULT 0  AFTER request_type_id;");
    AfwDatabase::db_query("UPDATE " . $server_db_prefix . "crm.request_braudit SET request_category_id = request_type_id");


} catch (Exception $e) {
    $migration_error = " " . $e->getMessage();
}