<?php
include_once(dirname(__FILE__) . "/../config.php");

class index_controller {
    public function preaction($action) {
        login::assert();
    }
    public function index_action() {
        go("minichat/index/index");
    }
}













