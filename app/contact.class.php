<?php
include_once(dirname(__FILE__) . "/../config.php");

class Contact {
    public $summary = array();

    public function __construct($summary) {
        $this->summary = $summary;
        return;
    }

    public static function load_all_users($include_librarian = true) {
        $users = array();

        $ret = db_contact::inst()->get_all_users();
        foreach ($ret as $uid => $user) {
            $users[$uid] = new User($user);
        }
        return $users;
    }

    public static function load($userid) {
        $contact = db_contact::inst()->one($userid);
        return $contact ? new Contact($contact) : null;
    }
    
    public static function load_contact_list($userid) {
        $contact = db_contact::inst()->one($userid);
        return $contact['contact_list'];
    }
    
    public static function load_by_username($username) {
        $user = db_contact::inst()->one_by_username($username);
        return $user ? new User($user) : null;
    }

    private function summary($key, $def = "") {
        if (isset($this->summary[$key])) {
            return $this->summary[$key];
        }

        return $def;
    }


    public function userid() {
        return $this->summary("userid");
    }
    
    public function contact_list() {
        return empty($this->summary["contact_list"]) ? [] : is_array($this->summary["contact_list"]) ? $this->summary["contact_list"] : explode(",", $this->summary["contact_list"]);
    }
    
    
    public function add_friend($userid) {
        $list = $this->contact_list();
        $arr = array();
        if (count($list) > 0) {
            $arr = $list;
        }
        if (in_array($userid, $arr)) {
            return false;
        }
        array_push($arr, $userid);
        $this->summary["contact_list"] = $arr;
        return true;
    }

    public function save() {
        $userid = $this->userid();

        return db_contact::inst()->modify($userid, $this->contact_list());
        
    }
    public function package() {
        return array(
            "id" => $this->id(),
            "username" => $this->username(),
            "nickname" => $this->nickname(),
            "face" => $this->face(),
            "minino" => $this->minino(),
            "token" => $this->token(),
            "tokentime" => $this->tokentime(),
            "status" => $this->status()
        );
    }
    
    
    
    public function faceurl($full = false) {
        if (!isset($this->summary["faceurl"])) {
            $this->summary["faceurl"] = rtrim(UPLOAD_URL, "/") . "/" . $this->summary("face");
        }
        if ($full) {
            return mk_domain_url($this->summary["faceurl"]);
        }
        return $this->summary["faceurl"];
    }

    

    
};


