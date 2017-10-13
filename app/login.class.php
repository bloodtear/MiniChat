<?php

include_once(dirname(__FILE__) . "/../config.php");

class login {

    public static function do_login($username, $cipher) {
        $salt = get_session("login_salt");

        //$user = db_user::inst()->get_user($username);
        $user = User::load_by_username($username);
        logging::d("Login", "user = " . dump_var($user, true));
        if ($user == null) {
            return "invalid username.";
        }

        $password = $user->password();
        $c1 = md5($username. $salt . $password);
        logging::d("Login", "username = " . $username);
        logging::d("Login", "salt = " . $salt);
        logging::d("Login", "password = " . $password);
        logging::d("Login", "c1 = " . $c1);
        logging::d("Login", "cipher = " . $cipher);
        if ($c1 == $cipher) {
            $_SESSION["user.id"] = $user->id();
            $_SESSION["user.name"] = $user->nickname();
            $_SESSION["user.username"] = $user->username();
            $_SESSION["user.detail"] = $user;
            //$_SESSION["user.face"] = mkUploadThumbnail($user["face"], 100, 100);
            //$_SESSION["user.large-face"] = $user["face"];
            //$_SESSION["user.last_login_time"] = $user["last_login_time"];
            $_SESSION["user.admin"] = ($user->admin() == "1");
            //$_SESSION["login.next"] = HOME_URL . "?main/main";
           // db_user::inst()->update_login_time($user["id"]);

            $token = "l" . md5($user->id() . uniqid());
            $user->set_token($token);
            $ret = $user->save();
            
            return $ret ? array("ret" => "success", "refer" => '') : array("ret" => "fail", "refer" => '');
            // jump to homepage after login.
            $refer = get_session("login.next");
            if ($refer == null) {
                $refer = HOME_URL;
            }

            $delimiter = (strstr($refer, "?") === false) ? "?" : "&";
            $refer = $refer . $delimiter . "userid={$user["id"]}&token=$token";

            logging::i("Login", "login success, jump to $refer");
            return array("ret" => "success", "refer" => $refer);
        }
        return "invalid password.";
    }

    public static function bye() {
        unset($_SESSION["admin.login"]);
        unset($_SESSION["user.id"]);
        unset($_SESSION["user.name"]);
        unset($_SESSION["user.username"]);
        unset($_SESSION["user.face"]);
        unset($_SESSION["user.large-face"]);
    }

    public static function mksalt() {
        $salt = md5(uniqid());
        $_SESSION["login_salt"] = $salt;
        return $salt;
    }

    public static function assert() {
        $uid = get_session("user.id");
        if ($uid == null) {
            $refer = $_SERVER["REQUEST_URI"];
            $_SESSION["login_refer"] = $refer;
            logging::d("Login", "refer from $refer");
            go("minichat/login/index");
        }
    }
};

