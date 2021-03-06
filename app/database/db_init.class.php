<?php


include_once(dirname(__FILE__) . "/../../config.php");
include_once(FRAMEWORK_PATH . "logging.php");
include_once(FRAMEWORK_PATH . "cache.php");
include_once(FRAMEWORK_PATH . "database.php");


// --------------------------------------------------------- init --------------------------------------------------------------
class db_init extends database {
    private static $mInstance = null;
    public static function instance() {
        if (self::$mInstance == null)
            self::$mInstance = new db_init();
        return self::$mInstance;
    }

    public function __construct() {
        try {
            $this->init(MYSQL_DATABASE);
        } catch (PDOException $e) {
            $this->init();
        }
    }

    private function create_table($name, $data) {
        $s = array();
        foreach ($data as $k => $v) {
            $s []= "$k $v";
        }
        $s = implode(", ", $s);
        $s = "id INT AUTO_INCREMENT PRIMARY KEY, $s";

        $query = "CREATE TABLE IF NOT EXISTS $name ($s) DEFAULT CHARSET utf8";
        // logging::d("Database", $query);
        $res = $this->exec($query);
        $res = str_replace("\n", " ", print_r($res, true));
        logging::d("Database", $res);
    }

    public function create_tables() {
        $query = "CREATE DATABASE IF NOT EXISTS " . MYSQL_DATABASE . " DEFAULT CHARSET utf8 COLLATE utf8_general_ci";
        $this->exec($query);
        $this->exec("use " . MYSQL_DATABASE);
        
        // settings
        $this->create_table(TABLE_SETTINGS,  array("name" => "TEXT", "value" => "TEXT"));
  
        // users
        $this->create_table(TABLE_USERS,  array("nickname" => "TEXT", "password" => "TEXT", "face" => "TEXT", 
"register_time" => "TEXT", "minino" => "INT", "token" => "TEXT", "tokentime" => "TEXT"));

        // contacts
        $this->create_table(TABLE_CONTACTS,  array("userid" => "INT", "contact_list" => "TEXT", "star_list" => "TEXT", "black_list" => "TEXT", "add_list" => "TEXT", "stranger_list" => "TEXT"));

        //

    }

};