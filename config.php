<?php

if (file_exists(dirname(__FILE__) . "/../PATH.php")) {
    include_once(dirname(__FILE__) . "/../PATH.php");
}

include_once(dirname(__FILE__) . "/../framework/config.php");
include_once(dirname(__FILE__) . "/app/database/db_user.class.php");
include_once(dirname(__FILE__) . "/app/database/db_contact.class.php");
// include_once(dirname(__FILE__) . "/app/database/db_customers.class.php");
// include_once(dirname(__FILE__) . "/app/database/db_muffininfos.class.php");
// include_once(dirname(__FILE__) . "/app/database/db_questionnaires.class.php");
// include_once(dirname(__FILE__) . "/app/database/db_question.class.php");
//include_once(dirname(__FILE__) . "/app/database/db_answer.class.php");
// include_once(dirname(__FILE__) . "/app/database/db_questionoptions.class.php");
// include_once(dirname(__FILE__) . "/app/database/db_muffins.class.php");
// include_once(dirname(__FILE__) . "/app/database/db_wechatusers.class.php");
// include_once(dirname(__FILE__) . "/app/database/db_sheets.class.php");
// include_once(dirname(__FILE__) . "/app/database/db_papers.class.php");
// include_once(dirname(__FILE__) . "/app/database/db_questions.class.php");
// include_once(dirname(__FILE__) . "/app/database/db_answers.class.php");
// include_once(dirname(__FILE__) . "/app/user.class.php");
include_once(dirname(__FILE__) . "/app/upload.php");
include_once(dirname(__FILE__) . "/app/thumbnail.php");
// include_once(dirname(__FILE__) . "/app/mailer.class.php");
// include_once(dirname(__FILE__) . "/app/settings.class.php");
// include_once(dirname(__FILE__) . "/app/projects.class.php");
// include_once(dirname(__FILE__) . "/app/tasks.class.php");
// include_once(dirname(__FILE__) . "/app/customers.class.php");
// include_once(dirname(__FILE__) . "/app/questionnaires.class.php");
// include_once(dirname(__FILE__) . "/app/questions.class.php");
// include_once(dirname(__FILE__) . "/app/questionoptions.class.php");
include_once(dirname(__FILE__) . "/app/contact.class.php");
include_once(dirname(__FILE__) . "/app/login.class.php");
include_once(dirname(__FILE__) . "/app/user.class.php");
// include_once(dirname(__FILE__) . "/app/sheet.class.php");
// include_once(dirname(__FILE__) . "/app/location.class.php");
// include_once(dirname(__FILE__) . "/app/question.class.php");
// include_once(dirname(__FILE__) . "/app/answer.class.php");
// include_once(dirname(__FILE__) . "/app/exif.class.php");
// include_once(dirname(__FILE__) . "/app/wechatuser.class.php");
// include_once(dirname(__FILE__) . "/app/mc.class.php");
include_once(FRAMEWORK_PATH . "/helper.php");
include_once(FRAMEWORK_PATH . "/logging.php");
include_once(FRAMEWORK_PATH . "/tpl.php");

//include_once(dirname(__FILE__) . "/wechat/wxApi.php");
//include_once(dirname(__FILE__) . "/wechat/wxBizMsgCrypt.php");

defined('UPLOAD_DIR') or define('UPLOAD_DIR', ROOT_PATH . '/upload/images');
defined('UPLOAD_URL') or define('UPLOAD_URL', rtrim(INSTANCE_URL, "/") . '/upload/images');

defined('VENDOR_DIR') or define('VENDOR_DIR', ROOT_PATH . '/vendor/');

defined('FILEUPLOAD_DIR') or define('FILEUPLOAD_DIR', ROOT_PATH . '/upload/files');
defined('FILEUPLOAD_URL') or define('FILEUPLOAD_URL', rtrim(INSTANCE_URL, "/") . '/upload/files');

defined('THUMBNAIL_DIR') or define('THUMBNAIL_DIR', ROOT_PATH . '/upload/thumbnails');
defined('THUMBNAIL_URL') or define('THUMBNAIL_URL', rtrim(INSTANCE_URL, "/") . '/upload/thumbnails');defined('LOCK_DIR') or define('LOCK_DIR', ROOT_PATH . '/tmp');
defined('LOCK_URL') or define('LOCK_URL', rtrim(INSTANCE_URL, "/") . '/tmp');
defined('UPLOAD_LIMIT') or define('UPLOAD_LIMIT', 10 * 1024 * 1024);
defined('PICSERVICE_IP') or define('PICSERVICE_IP', "http://pic.zizhuzhuangxiu.cn");
defined('PICSERVICE_URL') or define('PICSERVICE_URL', "http://pic.zizhuzhangxiu.cn/");
//defined('PICSERVICE_IP') or define('PICSERVICE_IP', "http://127.0.0.1");
//defined('PICSERVICE_URL') or define('PICSERVICE_URL', "http://127.0.0.1/picservice/");


// security
defined('ALLOW_ROOT') or define('ALLOW_ROOT', true);

// database
defined('MYSQL_SERVER') or define('MYSQL_SERVER', '180.76.160.113');
defined('MYSQL_USERNAME') or define('MYSQL_USERNAME', 'minichat_admin');
defined('MYSQL_PASSWORD') or define('MYSQL_PASSWORD', 'minichat_pwd');
defined('MYSQL_DATABASE') or define('MYSQL_DATABASE', 'minichat');
defined('MYSQL_PREFIX') or define('MYSQL_PREFIX', 'minichat_');

defined('MYSQL_COMMON') or define('MYSQL_COMMON', 'common_');

// db_settings
defined('TABLE_SETTINGS') or define('TABLE_SETTINGS', MYSQL_PREFIX . "settings");

// db_users
defined('TABLE_USERS') or define('TABLE_USERS', MYSQL_PREFIX . "users");
// db_contacts
defined('TABLE_CONTACTS') or define('TABLE_CONTACTS', MYSQL_PREFIX . "contacts");


// mailer
defined('MAIL_SUBJECT_PREFIX') or define('MAIL_SUBJECT_PREFIX', '');


defined('MEMCACHE_SERVER') or define('MEMCACHE_SERVER', '180.76.188.68');
defined('MEMCACHE_PORT') or define('MEMCACHE_PORT', '11211');



