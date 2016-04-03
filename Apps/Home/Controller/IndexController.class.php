<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends BaseController {
    public function index() {
        if (isset($_SESSION['password'])==null || $_SESSION['password']==null || isset($_SESSION['username'])==null || $_SESSION['username']==null) {
            redirect(U('Login/index'));
        }
        $this->display('Check/upload');
    }

}