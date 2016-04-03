<?php
namespace Home\Controller;

use Think\Controller;
use Think\Think;

class StaffController extends BaseController {
    public function index() {
        $this->display();
    }

    /**
     *员工列表
     */

    public function staffList() {
        $staffModel = D('Staff');
        $where = '1 = 1';
        $name = trim($_REQUEST['name']);
        if ($name != null) {
            $where .= " AND name LIKE '%{$name}%'";
        }
        $department = trim($_REQUEST['department']);
        if ($department != null && $department !='全部') {
            $where .= " AND department = '{$department}'";
        }else{
            $department = '全部';
        }
        $page = $_REQUEST['page'] ? trim($_REQUEST['page']) : 1;
        $count = $staffModel->where($where)->count();
        $pageSize = 12;
        $list = $staffModel->where($where)->limit(($page-1) * $pageSize, $pageSize)->select();
        $pageNum = ceil($count / $pageSize);
        $this->assign('list', $list);
        $this->assign('page',$page);
        $this->assign('pageNum', $pageNum);
        $this->assign('name', $name);
        $this->assign('department', $department);
        $this->display('staffList');


    }

    /**
     *添加员工
     */
    public function addStaff() {
        $this->display();
    }

    public function doAddStaff() {
        $staffModel = D('Staff');
        $return = array();
        $return['error'] = 1;
        $data = array();
        $data['name'] = I('post.name');
        $data['staff_id'] = I('post.staff_id');
        $data['gender'] = I('post.gender');
        $data['department'] = I('post.department');
        $data['position'] = I('post.position');
        $data['level'] = I('post.level');
        $data['annul_holidays'] = I('post.annul_holidays');
        $data['points'] = I('post.points');
        $data['entry_date'] = I('post.entry_date');
        $data['telephone'] = I('post.telephone');
        $data['update_time'] = date("Y-m-d H:i:s", time());

        if ($data['name'] == null) {
            $return['msg'] = '请填写姓名!';
            $this->ajaxReturn($return);
        } elseif($staffModel->where("`name`='{$data['name']}'")->select()!= null){
            $return['msg'] = $data['name'].':'.'该姓名已存在!';
            $this->ajaxReturn($return);
        }

        if ($data['staff_id'] == null){
            $return['msg'] = '请填写工号!';
            $this->ajaxReturn($return);
        } elseif($staffModel->where("`staff_id`='{$data['staff_id']}'")->select()!=null){
            $return['msg'] = $data['staff_id'].':'.'该工号已存在!';
            $this->ajaxReturn($return);
        }

        if ($staffModel->add($data)) {
            $return['error'] = 0;
            $return['msg'] = '员工添加成功!';
        }
        $this->ajaxReturn($return);
    }

    public function updateStaff() {
        $id = intval($_REQUEST['id']);
        $page = intval($_REQUEST['page']);
        $staffModel = D('Staff');
        $array = $staffModel->where("id=%d", $id)->find();
        $array['page'] = $page;
        $this->assign('data', $array);
        $this->display('updateStaff');
    }

    public function doUpdateStaff() {
        $return = array();
        $return['error'] = 1;
        $data = array();
        $data['id'] = intval(I('post.id'));
        $data['name'] = I('post.name');
        $data['staff_id'] = I('post.staff_id');
        $data['gender'] = I('post.gender');
        $data['department'] = I('post.department');
        $data['position'] = I('post.position');
        $data['level'] = I('post.level');
        $data['annul_holidays'] = I('post.annul_holidays');
        $data['points'] = I('post.points');
        $data['entry_date'] = I('post.entry_date');
        $data['telephone'] = I('post.telephone');
        $data['update_time'] = date("Y-m-d H:i:s", time());

        if ($data['name'] == null || $data['staff_id'] == null || $data['entry_date'] == null) {
            $this->ajaxReturn($return);
        }
        $staffModel = D('Staff');
        if ($staffModel->where("id={$data['id']}")->save($data)) {
            $return['error'] = 0;
        }
        $this->ajaxReturn($return);

    }

    public function deleteStaff() {
        $id = intval($_REQUEST['id']);
        $staffModel = D('Staff');
        if ($staffModel->where("id={$id}")->delete()) {
            //$this->success("删除成功!", U('Staff/staffList'));
            redirect(U('Staff/staffList'));
            return;
        } else {
            $this->error('操作失败!', U('Staff/staffList'));
            return;
        }
    }

}