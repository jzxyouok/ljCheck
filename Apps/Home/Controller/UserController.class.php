<?php
namespace Home\Controller;

use Think\Controller;

class UserController extends BaseController {
    //用户列表
    public function userList() {
        $user = D('user');
        $count = $user->count();
        $page = $_REQUEST['page'] ? trim($_REQUEST['page']) : 1;
        $pageSize = 12;
        $list = $user->limit(($page - 1) * $pageSize, $pageSize)->select();
        $pageNum = ceil($count / $pageSize);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $page);
        $this->assign('pageNum', $pageNum);
        $this->display();
    }

    //添加用户
    public function addUser() {
        if($_SESSION['username']!='admin'){
            $this->error('非admin用户,没有添加用户权限!',U('User/userList'),1);
        }
        $this->display();
    }

    public function doAddUser() {
        $return = array();
        $return['error'] = 1;
        $data = array();
        $data['name'] = I('post.name');
        $data['password'] = md5(I('post.password'));
        $data['reg_time'] = date("Y-m-d H:i:s", time());
        if($_SESSION['username']!='admin'){
            $return['msg'] = '非admin用户,没有添加用户权限!';
            $this->ajaxReturn($return);
        }
        $user = D('user');
        if ($data['name'] == null) {
            $return['msg'] = '请填写用户名!';
            $this->ajaxReturn($return);
        } elseif($user->where("name='{$data['name']}'")->select()) {
            $return['msg'] = $data['name'].':用户名已存在!';
            $this->ajaxReturn($return);
        }

        if ($data['password'] == null) {
            $return['msg'] = '请填写密码!';
            $this->ajaxReturn($return);
        }

        if ($user->add($data)) {
            $return['error'] = 0;
            $return['msg'] = '添加用户成功!';
        }
        $this->ajaxReturn($return);

    }

    public function updateUser() {

    }

    public function deleteUser() {
        if($_SESSION['username']!='admin'){
            $this->error('非admin用户,没有删除用户权限!',U('User/userList'),1);
        }
        $id = intval($_REQUEST['id']);
        $user = D('user');
        if ($user->where("id={$id}")->delete()) {
            //$this->success("删除成功!", U('Staff/staffList'));
            redirect(U('User/userList'));
            return;
        } else {
            $this->error('操作失败!', U('User/userList'));
            return;
        }
    }

}