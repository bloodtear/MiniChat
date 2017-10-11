<?php
include_once(dirname(__FILE__) . "/../../config.php");
include_once(dirname(__FILE__) . "/../../app/login.class.php");

class me_controller {
    public function index_action() {
        $tpl = new tpl("minichat/noheader", "minichat/chatfooter");
        $tpl->display("minichat/me/index");
    }

  
}













