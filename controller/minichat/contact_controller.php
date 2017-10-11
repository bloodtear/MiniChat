<?php
include_once(dirname(__FILE__) . "/../../config.php");
include_once(dirname(__FILE__) . "/../../app/login.class.php");

class contact_controller {
    public function index_action() {
        $tpl = new tpl("minichat/noheader", "minichat/chatfooter");
        $tpl->display("minichat/contact/index");
    }
    
    public function add_action() {
        $tpl = new tpl("minichat/noheader", "minichat/chatfooter");
        $tpl->display("minichat/contact/add");
    }
    
    public function search_ajax() {
        $userid = get_request('userid');
        $user = db_user::inst()->get_one_user($userid);
        if (!$user) {
            return array("ret" => 'fail', 'detail' => '此用户不存在');
        }
        unset($user['password']);
        return array("ret" => 'success', 'userinfo' => $user);
    }

  
}













