<?php
namespace Home\Model;

use Think\Model;

class StaffModel extends Model {
    protected $pk = 'id';
    protected $tableName = 'staff';
    protected $token = 'staff';

    protected $_validate = array(
        array('name', '', '员工名称已经存在！', 0, 'unique', 1), // 在新增的时候验证name字段是否唯一
        array('staff_id', '', '工号已经存在！', 0, 'unique', 1) // 在新增的时候验证staff_id字段是否唯一
    );

}
