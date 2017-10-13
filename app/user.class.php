<?php
include_once(dirname(__FILE__) . "/../config.php");

class User {
    private $summary = array();

    public function __construct($data) {
        if (empty($data)) {
            $data = array(
            "username" => "",
            "nickname" => "",
            "password" => "",
            "face" => "",
            "register_time" => "",
            "minino" => "",
            "token" => "",
            "tokentime" => "",
            "status" => "",
            );
        }
        $this->summary = $data;
    }

    public static function load_all_users($include_librarian = true) {
        $users = array();

        $ret = db_user::inst()->get_all_users();
        foreach ($ret as $uid => $user) {
            $users[$uid] = new User($user);
        }
        return $users;
    }

    public static function load($userid) {
        $user = db_user::inst()->one($userid);
        return $user ? new User($user) : null;
    }
    
    public static function load_by_username($username) {
        $user = db_user::inst()->one_by_username($username);
        return $user ? new User($user) : null;
    }

    private function summary($key, $def = "") {
        if (isset($this->summary[$key])) {
            return $this->summary[$key];
        }

        return $def;
    }

    public function id() {
        return $this->summary("id", 0);
    }

    public function username() {
        return $this->summary("username");
    }
    
    public function nickname() {
        return $this->summary("nickname");
    }
    
    public function password() {
        return $this->summary("password");
    }
    
    public function face() {
        return $this->summary("face");
    }

    public function register_time() {
        return $this->summary("register_time");
    }
    
    public function minino() {
        return $this->summary("minino");
    }
    
    public function token() {
        return $this->summary("token");
    }
    
    public function tokentime() {
        return $this->summary("tokentime");
    }
    
    public function status() {
        return $this->summary("status");
    }
    
    public function admin() {
        return $this->summary("username") == 'admin' ? 1 : 0 ;
    }
    
    public function contact_list() {
        return $this->summary["contact_list"] = Contact::load($this->id()) ;
    }
    
    public function set_username($username) {
        $this->summary["username"] = $username;
    }
    
    public function set_password($password) {
        $this->summary["password"] = $password;
    }
    
    public function set_token($token) {
        $this->summary["token"] = $token;
        $this->summary["tokentime"] = time() + 7200;
    }
    
    public function save() {
        $id = $this->id();
        if (!$id) {
            return db_user::inst()->add($this->username(), $this->nickname(), $this->password(), $this->face(), $this->minino());
        } else {
            return db_user::inst()->modify($id, $this->username(), $this->nickname(), $this->password(), $this->face(), $this->minino(), $this->token(), $this->tokentime(), $this->status());
        }
    }
    
    public function add_friend_dell ($userid){
        $contact = $this->contact();
       
        if (empty($contact)) {
            $contact = array($userid);
        }

        logging::d("ADD", "user_contact2 " . $this->contact());
        //logging::d("ADD");
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
            "status" => $this->status(),
            "contact_list" => $this->contact_list()
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

    
    
    
    public function face_thumbnail($full = false) {
        if (!isset($this->summary["facethumbnail"])) {
            $this->summary["facethumbnail"] = mkUploadThumbnail($this->summary("face"), 100, 100);
        }
        if ($full) {
            return mk_domain_url($this->summary["facethumbnail"]);
        }
        return $this->summary["facethumbnail"];
    }

    public function last_login_time() {
        $time = get_session("user.last_login_time");
        return date("Y-m-d H:i:s", $time);
    }
    
    
};


