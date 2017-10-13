<?php

include_once(dirname(__FILE__) . "/../../config.php");
include_once(FRAMEWORK_PATH . "logging.php");
include_once(FRAMEWORK_PATH . "cache.php");
include_once(FRAMEWORK_PATH . "database.php");

class db_contact extends database {
    private static $instance = null;
    public static function inst() {
        if (self::$instance == null)
            self::$instance = new db_contact();
        return self::$instance;
    }

    public function __construct() {
        try {
            $this->init(MYSQL_DATABASE);
        } catch (PDOException $e) {
            logging::e("PDO.Exception", $e, false);
            die($e);
            // $this->init();
        }
    }

    public function get_all_users() {
        return $this->get_all_table(TABLE_CONTACTS);
    }

    public function one($userid) {
        $userid = (int)$userid;
        return $this->get_one_table(TABLE_CONTACTS, "userid = $userid");
    }

    public function one_by_username($username) {
        $username = $this->escape($username);
        return $this->get_one_table(TABLE_CONTACTS, "username = $username");
    }

    public function add($userid) {
        return $this->insert(TABLE_CONTACTS, array("userid" => $userid));
    }

    public function modify($userid, $contact_list) {
        $contact_list = implode(",", $contact_list);
        return $this->update(TABLE_CONTACTS, array("contact_list" => $contact_list), "userid = '$userid'");
    }

    public function update_login_time($userid) {
        $now = time();
        $userid = (int)$userid;
        return $this->update(TABLE_CONTACTS, array("last_login_time" => $now), "id = $userid");
    }

    public function update_face($userid, $face) {
        $userid = (int)$userid;
        return $this->update(TABLE_CONTACTS, array("face" => $face), "id = $userid");
    }

    public function update_password($userid, $password) {
        $userid = (int)$userid;
        return $this->update(TABLE_CONTACTS, array("password" => $password), "id = $userid");
    }
    
    public function update_detail($userid, $nick, $face) {
        $userid = (int)$userid;
        return $this->update(TABLE_CONTACTS, array("nick" => $nick, "face" => $face), "id = $userid");
    }

    public function update_login_token($userid, $token) {
        $userid = (int)$userid;
        $now = time();
        return $this->update(TABLE_CONTACTS, array("token" => $token, "tokentime" => $now), "id = $userid");
    }

    public function update_nick($userid, $nick) {
        $userid = (int)$userid;
        return $this->update(TABLE_CONTACTS, array("nick" => $nick), "id = $userid");
    }

    public function disable_login_token($userid) {
        $userid = (int)$userid;
        return $this->update(TABLE_CONTACTS, array("token" => "", "tokentime" => $now), "id = $userid");
    }
};


