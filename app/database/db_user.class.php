<?php

include_once(dirname(__FILE__) . "/../../config.php");
include_once(FRAMEWORK_PATH . "logging.php");
include_once(FRAMEWORK_PATH . "cache.php");
include_once(FRAMEWORK_PATH . "database.php");

class db_user extends database {
    private static $instance = null;
    public static function inst() {
        if (self::$instance == null)
            self::$instance = new db_user();
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
        return $this->get_all_table(TABLE_USERS);
    }

    public function one($userid) {
        $userid = (int)$userid;
        return $this->get_one_table(TABLE_USERS, "id = $userid");
    }

    public function one_by_username($username) {
        $username = $this->escape($username);
        return $this->get_one_table(TABLE_USERS, "username = $username");
    }

    public function add($username, $nickname = '', $password, $face = '', $minino = '') {
        $now = time();
        $id = $this->insert(TABLE_USERS, array("username" => $username, "password" => $password, "nickname" => $nickname, "face" => $face, "register_time" => $now, "minino" => $minino, "status" => 0));
        return db_contact::inst()->add($id);
    }

    public function modify($id, $username, $nickname, $password, $face, $minino, $token, $tokentime, $status) {
        $now = time();
        return $this->update(TABLE_USERS, array("username" => $username, "password" => $password, "nickname" => $nickname, "face" => $face, "minino" => $minino, "status" => $status, "token" => $token, "tokentime" => $tokentime), "id = '$id'");
    }

    public function update_login_time($userid) {
        $now = time();
        $userid = (int)$userid;
        return $this->update(TABLE_USERS, array("last_login_time" => $now), "id = $userid");
    }

    public function update_face($userid, $face) {
        $userid = (int)$userid;
        return $this->update(TABLE_USERS, array("face" => $face), "id = $userid");
    }

    public function update_password($userid, $password) {
        $userid = (int)$userid;
        return $this->update(TABLE_USERS, array("password" => $password), "id = $userid");
    }
    
    public function update_detail($userid, $nick, $face) {
        $userid = (int)$userid;
        return $this->update(TABLE_USERS, array("nick" => $nick, "face" => $face), "id = $userid");
    }

    public function update_login_token($userid, $token) {
        $userid = (int)$userid;
        $now = time();
        return $this->update(TABLE_USERS, array("token" => $token, "tokentime" => $now), "id = $userid");
    }

    public function update_nick($userid, $nick) {
        $userid = (int)$userid;
        return $this->update(TABLE_USERS, array("nick" => $nick), "id = $userid");
    }

    public function disable_login_token($userid) {
        $userid = (int)$userid;
        return $this->update(TABLE_USERS, array("token" => "", "tokentime" => $now), "id = $userid");
    }
};


