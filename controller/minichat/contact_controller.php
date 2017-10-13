<?php
include_once(dirname(__FILE__) . "/../../config.php");
include_once(dirname(__FILE__) . "/../../app/login.class.php");

class contact_controller {
    public function preaction($action) {
        login::assert();
    }
    public function index_action() {
        $tpl = new tpl("minichat/noheader", "minichat/chatfooter");
        $userid = get_session('user.id');
        $contact_list = Contact::load($userid);
        $contact_list = $contact_list->contact_list();

        $all_user = User::load_all_users();
        
        $contact_user_list = [];
        foreach ($contact_list as $userid) {
            foreach ($all_user as $user) {
                if ($userid ==  $user->id()) {
                    $contact_user_list[$userid] = $user;
                }
            }
        }
        $tpl->set('contact_list', $contact_list);
        $tpl->set('all_user', $all_user);
        $tpl->set('contact_user_list', $contact_user_list);
        $tpl->display("minichat/contact/index");
    }
    
    public function add_action() {
        $tpl = new tpl("minichat/noheader", "minichat/chatfooter");
        $tpl->display("minichat/contact/add");
    }
    
    public function add_friend_ajax() {
        $add_userid = get_request('add_userid');
        $user = User::load(get_session('user.id'));
        $contact = $user->contact_list();
        if(!$contact->add_friend($add_userid) ){
            return array('ret' => '此用户已经添加', "detail" => "");
        }
        if(get_session('user.id') == $add_userid ){
            return array('ret' => '不能添加自己', "detail" => "");
        }
        $ret = $contact->save();
        return array('ret' => 'success', "detail" => $ret);
    }
    
    public function search_ajax() {
        $userid = get_request('userid');
        $user = User::load($userid);
        if (!$user) {
            return array("ret" => '此用户不存在', 'detail' => '此用户不存在');
        }
        //unset($user['password']);
        return array("ret" => 'success', 'userinfo' => $user->package());
    }

  
}













