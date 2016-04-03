<?php
namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller {
    public function index() {
        $this->display();
    }

    public function doLogin() {
        $username = I('post.name');
        $password = md5(I('post.password'));
        if (empty($username) || empty($password)) {
            $data['error'] = 1;
            $data['msg'] = "请输入帐号密码";
            $this->ajaxReturn($data);
        }
        $map = array();
        $map['name'] = $username;
        $user = D('user');

        $userInfo = $user->where($map)->find();

        if ($userInfo) {
            if ($userInfo['password'] != $password) {
                $data['error'] = 1;
                $data['msg'] = '密码不正确!';
                $this->ajaxReturn($data);
            }
            session('username', $username);
            session('password', $password);
            $data1['error'] = 0;
            //$data1['url']=U('Index/index');
            $this->ajaxReturn($data1);
        } else {
            $data['error'] = 1;
            $data['msg'] = '帐号不存在!';
            $this->ajaxReturn($data);

        }
    }

    public function loginout() {
        session('username', null);
        session('password', null);
        redirect(U('Login/index'));
    }

    public function login() {
        redirect(U('Check/upload'));
    }

}