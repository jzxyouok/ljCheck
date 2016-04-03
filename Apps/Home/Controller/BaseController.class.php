<?php
namespace Home\Controller;

use Think\Controller;

class BaseController extends Controller {
    function __construct() {
        parent::__construct();
        $c_a = CONTROLLER_NAME.'_'. ACTION_NAME;
        $this->assign('c_a', $c_a);
        $this->assign('username', $_SESSION['username']);
//        debug($_SESSION);
        if($_SESSION['username'] == null || $_SESSION['password']==null){

            redirect(U('Login/index'));
        }
    }

    //请假Excel表每列对应的字段
    public static $leaveMap = array(
        'A' => 'appr_num',  //审批编号
        'B' => 'title',     //标题
        'C' => 'status',    //审批状态
        'D' => 'result',    //审批结果
        'E' => 'start_time', //审批发起时间
        'F' => 'end_time',   //审批完成时间
        'G' => 'people_num', //发起人工号
        'H' => 'people_name',//发起人姓名
        'I' => 'department', //发起人部门
        'J' => 'history_appr', //历史审批人姓名
        'K' => 'appr_record',     //审批记录
        'L' => 'curr_manager',   //当前处理人姓名
        'M' => 'time_consuming',  //审批耗时
        'N' => 'leave_type',      //请假类型
        'O' => 'start_date',      //开始时间
        'P' => 'end_date',       //结束时间
        'Q' => 'leave_date',     //请假天数(天)
        'R' => 'leave_reason',   //请假事由
        'S' => 'img'             //图片
    );
    //补签Excel表每列对应的字段
    public static $repSignMap = array(
        'A' => 'appr_num',  //审批编号
        'B' => 'title',     //标题
        'C' => 'status',    //审批状态
        'D' => 'result',    //审批结果
        'E' => 'start_time', //审批发起时间
        'F' => 'end_time',   //审批完成时间
        'G' => 'people_num', //发起人工号
        'H' => 'people_name',//发起人姓名
        'I' => 'department', //发起人部门
        'J' => 'history_appr', //历史审批人姓名
        'K' => 'appr_record',     //审批记录
        'L' => 'curr_manager',   //当前处理人姓名
        'M' => 'time_consuming',  //审批耗时
        'N' => 'rep_sign_time'      //补签时间
    );
    //请假加班表每列对应的字段
    public static $overWorkMap = array(
        'A' => 'appr_num',  //审批编号
        'B' => 'title',     //标题
        'C' => 'status',    //审批状态
        'D' => 'result',    //审批结果
        'E' => 'start_time', //审批发起时间
        'F' => 'end_time',   //审批完成时间
        'G' => 'people_num', //发起人工号
        'H' => 'people_name',//发起人姓名
        'I' => 'department', //发起人部门
        'J' => 'history_appr', //历史审批人姓名
        'K' => 'appr_record',     //审批记录
        'L' => 'curr_manager',   //当前处理人姓名
        'M' => 'time_consuming',  //审批耗时
        'N' => 'over_start_time', //加班开始时间
        'O' => 'over_end_time',   //加班结束时间
        'P' => 'over_hours',       //加班时长
        'Q' => 'is_festival',     //是否法定节假日
        'R' => 'overtime_pay',   //加班核算方式(是否申请加班费)
        'S' => 'over_reason'     //加班原因
    );
    //打卡签到Excel表每列对应的字段
    public static $signMap = array(
        'B' => 'check_id',       //考勤号
        'C' => 'staff_id',      //自定义编号(工号)
        'D' => 'staff_name',    //员工姓名
        'F' => 'date',            //日期
        'H' => 'start_work_time', //上班时间 09:00
        'I' => 'end_work_time',   //下班时间 18:00
        'J' => 'sign_in_time',   //签到时间
        'K' => 'sign_out_time',  //签退时间
        'N' => 'late_time',     //迟到时间
        'O' => 'early_time',    //早退时间
        'P' => 'is_out_work',   //是否旷工
        'V' => 'department',    //部门
        'W' => 'normal',        //平时
        'X' => 'weekend',       //周末
        'Y' => 'festival'      //节假日
    );

    //打卡签到详情Excel表每列对应的字段
    public static $signDetailMap = array(
        'A'=>'check_id',   //考勤号
        'B'=>'staff_id',   //自定义编号(工号)
        'C'=>'staff_name',  //员工姓名
        'D'=>'check_time',  //出勤时间
        'E'=>'check_status', //出勤状态
        'F'=>'update_status', //更正状态
        'G'=>'record_status'  //异常情况(记录状态)
    );

    public function index() {
        $this->assign('username', $_SESSION['username']);
    }

    /**
     * 获取时间差
     * @param $time1 '09:12'
     * @param $time2 '09:00'
     * @return int 时间差(分钟)
     */
    public function periodTimeMinutes($time1, $time2) {
        $time1arr = explode(':', $time1);
        $time2arr = explode(':', $time2);
        $periodTime = ($time1arr[0] * 60 + $time1arr[1]) - ($time2arr[0] * 60 + $time2arr[1]);
        $periodTime = $periodTime < 0 ? 0 : $periodTime;

        return $periodTime;
    }

    //获取节假日(工作日不需要上班的日子)
    public function getHolidays() {
        $holidays = D('cfg_holidays');
        $data = $holidays->field('holiday')->select();
        $array = array();
        if ($data != null) {
            foreach ($data as $v) {
                $array[] = $v['holiday'];
            }
        }
        return $array;
    }

    //获取周末调休(周末需要上班的日子)
    public function getWorkWeekends() {
        $work_weekend = D('cfg_work_weekend');
        $data = $work_weekend->field('work_weekend')->select();
        $array = array();
        if ($data != null) {
            foreach ($data as $v) {
                $array[] = $v['work_weekend'];
            }
        }
        return $array;
    }
    //判断是否是周末
    /**
     * @param $date string '2016-04-04'
     * @return bool
     */
    public function is_weekend($date) {
        $d = date("w", strtotime($date));
        if ($d == "0" || $d == "6") {
            return true;
        }
        return false;
    }

    //计算-统计考勤
    public function calculateCheck($y_m) {
        $sign = D('sign');
        $leave = D('leave');
        $repSign = D('rep_sign');
        $overWork = D('over_work');
        $staff = D('staff');

        $where = '1 = 1';
        $where .= " AND `date` LIKE '{$y_m}%'";
        $data = $sign->where($where)->select();
        $array = array();
        //默认上班时间是09:00 如果前一天加班到11:00,第二天上班时间为10:30; (已处理)
        // 如果前一天加班到12:00,第二天上班时间为13:00; 如果前一天加班到04:00,第二天休息;  todo
        //上班的几个时间点类型
        $start_work_type = array(
            'type10' => '10:30',
            'type13' => '13:00',
            'type04' => '',
            'type09' => '09:00'
        );
        $start_work_time = $start_work_type['type09'];
        //下班的几个时间点类型
        $end_work_type = array(
            'type18' => '18:00',
            'type21' => '21:00',
            'type23' => '23:00',
            'type24' => '23:59',
            'type04' => '04:00'
        );
        $end_work_time = $end_work_type['type18'];
        //日期分为三种类型 工作日0: normal； 周末 1：weekend；节假日2：festival
        $date_type = array('normal', 'weekend', 'festival');
        foreach ($data as $k => $v) {
            $staff_name = $v['staff_name'];
            $staff_id = $v['staff_id'];
            $curr_date = $v['date'];
            $curr_date_type = $date_type[0];
            if (!$this->is_weekend($curr_date) && !in_array($curr_date, $this->getHolidays())) {
                //既不是周末也不是节假日，即是上班的日子
                $curr_date_type = $date_type[0];
            } elseif ($this->is_weekend($curr_date) && in_array($curr_date, $this->getWorkWeekends())) {
                //既是周末同时是调休的日子，即是上班的日子
                $curr_date_type = $date_type[0];
            } elseif ($this->is_weekend($curr_date)) {
                //周末 不是上班的日子
                $curr_date_type = $date_type[1];
            } elseif (in_array($curr_date, $this->getHolidays())) {
                //节假日 不是上班的日子
                $curr_date_type = $date_type[2];
                //判断是否申请了节假日加班并且是申请了加班费
                $overWhere = "status = '完成' AND result = '同意'";
                $overWhere .= " AND `overtime_pay` = '申请加班费' ";
                $overWhere .= " AND `people_name` = '{$staff_name}' ";
                $overWhere .= " AND `over_start_time` LIKE '{$curr_date}%'";
                $overWork_arr = $overWork->where($overWhere)->select();
                if ($overWork_arr == null){
                    $curr_date_type = $date_type[1]; //未申请加班或加班费相当于周末模式
                }
            }

            if (!isset($array[$staff_name])) {
                //共同数据
                $array[$staff_name]['staff_name'] = $v['staff_name'];
                $array[$staff_name]['staff_id'] = $v['staff_id'];
                $array[$staff_name]['department'] = $v['department'];
                //请假数据
                $leaveWhere = "status = '完成' AND result = '同意'";
                $leaveWhere .= " AND people_name = '{$staff_name}' ";
                $leaveWhereCount = $leaveWhere . " AND `start_date` LIKE '{$y_m}%'";  //计算当月总的请假天数
                $leave_days_arr = $leave->where($leaveWhereCount)->field('SUM(leave_date) as leave_date')->find();
                if ($leave_days_arr['leave_date'] == null) {
                    $leave_days = 0;
                } else {
                    $leave_days = $leave_days_arr['leave_date'];
                }
                $array[$staff_name]['leave_days'] = $leave_days;
                if ($leave_days > 0) {
                    //判断当天是否请假了
                    $leaveWhereCurrDate = $leaveWhere . " AND `start_date` <= '{$curr_date}' AND `end_date` >= '{$curr_date}'";
                    $leaveDates = $leave->where($leaveWhereCurrDate)->select();
                    if ($leaveDates != null) {
                        $curr_date_type = $date_type[1]; //当天请假了相当于周末模式
                    }
                }

                //未打卡统计
                $whereSign = " `staff_name` = '{$staff_name}' ";
                $whereSign .= "  AND `date` LIKE '{$y_m}' ";
                //未签到次数
                $whereSignIn = $whereSign . " AND `sign_in_time`='' ";
                $array[$staff_name]['unsign_in_count'] = $sign->where($whereSignIn)->count();
                //未签出次数
                $whereSignOut =  $whereSign . " AND `sign_out_time`='' ";
                $array[$staff_name]['unsign_out_count'] = $sign->where($whereSignOut)->count();

                if ($curr_date_type == $date_type[0]) {      //工作日模式
                    //判断是否有补签了签到或是签退
                    $repSignWhere = " `people_name` = '{$staff_name}' ";
                    $repSignWhere .= " AND `rep_sign_time` LIKE '{$curr_date}' ";
                    $repSigns = $repSign->where($repSignWhere)->field('rep_sign_time')->select();
                    $repSignTimes = array();
                    if ($repSigns != null){
                        foreach ($repSigns as $repSignV){
                             if ($repSignV != null){
                                 $repSignTimes[] = date("H:i", strtotime($repSignV['rep_sign_time']));
                             }
                        }
                    }
                    if ($repSignTimes != null){
                        if (count($repSignTimes) >= 2){
                            $v['sign_in_time'] = min($repSignTimes);
                            $v['sign_out_time'] = max($repSignTimes);
                        } elseif($repSignTimes[0] < $end_work_type['type18']){
                            $v['sign_in_time'] = $repSignTimes[0];
                        } else{
                            $v['sign_out_time'] = $repSignTimes[0];
                        }
                    }

                    //迟到次数，迟到时间
                    $array[$staff_name]['late_count'] = 0;
                    $array[$staff_name]['late_time'] = 0;
                    if ($v['sign_in_time'] != null && $v['sign_in_time'] > $start_work_time) {
                        $array[$staff_name]['late_count'] = 1;
                        $array[$staff_name]['late_time'] = $this->periodTimeMinutes($v['sign_in_time'], $start_work_time);
                    }

                    $start_work_time = $start_work_type['type09'];  //默认上班时间
                    //早退次数，早退时间，加班次数，餐补
                    $array[$staff_name]['early_count'] = 0;
                    $array[$staff_name]['early_time'] = 0;
                    $array[$staff_name]['over_normal_count'] = 0; //加班
                    $array[$staff_name]['meal_count'] = 0; //餐补
                    if ($v['sign_out_time'] != null && $v['sign_out_time'] < $end_work_time) {
                        $array[$staff_name]['early_count'] = 1;
                        $array[$staff_name]['early_time'] = $this->periodTimeMinutes($end_work_time, $v['sign_out_time']);
                    }
                    if ($v['sign_out_time'] != null && $v['sign_out_time'] >= $end_work_type['type21']) {
                        $array[$staff_name]['over_normal_count'] = 1; //加班
                        $array[$staff_name]['meal_count'] = 1; //餐补
                    }
                    //加班时间超过晚上11点，上班时间推迟
                    if ($v['sign_out_time'] != null && $v['sign_out_time'] >= $end_work_type['type23'] && $v['sign_out_time'] < $end_work_type['type24']) {
                        $start_work_time = $start_work_type['type10'];
                    }

                    if ($v['sign_in_time'] == null && $v['sign_out_time'] == null ) {
                        $array[$staff_name]['out_days'] = 1;
                    } else {
                        $array[$staff_name]['out_days'] = 0;
                    }
                    $array[$staff_name]['over_weekend_count'] = 0;   //周末加班次数
                    $array[$staff_name]['over_festival_count'] = 0;  //节假日加班次数
                } elseif ($curr_date_type == $date_type[1] || $curr_date_type == $date_type[2]) {  //周末和节假日模式
                    $array[$staff_name]['late_time'] = 0;
                    $array[$staff_name]['late_count'] = 0;
                    $array[$staff_name]['early_time'] = 0;
                    $array[$staff_name]['early_count'] = 0;
                    $array[$staff_name]['out_days'] = 0;
                    $array[$staff_name]['over_normal_count'] = 0;
                    $array[$staff_name]['over_weekend_count'] = 0;
                    $array[$staff_name]['over_festival_count'] = 0;
                    $array[$staff_name]['meal_count'] = 0;
                    $array[$staff_name]['unsign_in_count'] = 0;
                    $array[$staff_name]['unsign_out_count'] = 0;
                    $proint_count = 0;
                    $meal_count = 0;

                    if ($v['sign_in_time'] != null && $v['sign_out_time'] != null) {
                        $time_range = strtotime($v['sign_out_time']) - strtotime($v['sign_in_time']);

                        if ($time_range >= 4 * 3600 && $time_range < 8 * 3600) {
                            //加班大于4小时小于8小时 0.5个积分，没有餐补
                            $proint_count = 0.5;
                        } elseif ($time_range >= 8 * 3600) {
                            //加班大于等于8小时 积分加1，餐补加1
                            $proint_count = 1;
                            $meal_count = 1;
                        }
                        if ($proint_count > 0) {
                            $staffs = $staff->where("staff_id='{$staff_id}'")->find();
                            $points = floatval($staffs['points']) + 0.5;
                            $staff->points = $points;
                            $staff->save();
                        }

                        if ($curr_date_type == $date_type[2]) {
                            $array[$staff_name]['over_festival_count'] = $proint_count;
                        } else {
                            $array[$staff_name]['over_weekend_count'] = $proint_count;
                        }
                        $array[$staff_name]['meal_count'] = $meal_count;
                    }
                }
            } else {
                //请假数据
                $leaveWhere = "status = '完成' AND result = '同意'";
                $leaveWhere .= " AND `people_name` = '{$staff_name}' ";
                //判断当天是否请假了
                $leaveWhereCurrDate = $leaveWhere . " AND `start_date` <= '{$curr_date}' AND `end_date` >= '{$curr_date}'";
                $leaveDates = $leave->where($leaveWhereCurrDate)->select();
                if ($leaveDates != null) {
                    $curr_date_type = $date_type[1]; //当天请假了相当于周末模式
                }

                if ($curr_date_type == $date_type[0]) {     //工作日模式
                    //判断是否有补签了签到或是签退
                    $repSignWhere = " `people_name` = '{$staff_name}' ";
                    $repSignWhere .= " AND `rep_sign_time` LIKE '{$curr_date}' ";
                    $repSigns = $repSign->where($repSignWhere)->field('rep_sign_time')->select();
                    $repSignTimes = array();
                    if ($repSigns != null){
                        foreach ($repSigns as $repSignV){
                            if ($repSignV != null){
                                $repSignTimes[] = date("H:i", strtotime($repSignV['rep_sign_time']));
                            }
                        }
                    }
                    if ($repSignTimes != null){
                        if (count($repSignTimes) >= 2){
                            $v['sign_in_time'] = min($repSignTimes);
                            $v['sign_out_time'] = max($repSignTimes);
                        } elseif($repSignTimes[0] < $end_work_type['type18']){
                            $v['sign_in_time'] = $repSignTimes[0];
                        } else{
                            $v['sign_out_time'] = $repSignTimes[0];
                        }
                    }

                    if ($v['sign_in_time'] == null) {
                        $array[$staff_name]['unsign_in_count']++;
                    } else {
                        if ($v['sign_in_time'] > $start_work_time) {
                            $array[$staff_name]['late_count']++;
                            $array[$staff_name]['late_time'] += $this->periodTimeMinutes($v['sign_in_time'], $start_work_time);
                        }
                    }

                    $start_work_time = $start_work_type['type09'];  //默认上班时间
                    if ($v['sign_out_time'] == null) {
                        $array[$staff_name]['unsign_out_count']++;
                    } else {
                        if ($v['sign_out_time'] < $end_work_time) {
                            $array[$staff_name]['early_count']++;
                            $array[$staff_name]['early_time'] += $this->periodTimeMinutes($end_work_time, $v['sign_out_time']);
                        }
                        if ($v['sign_out_time'] >= $end_work_type['type21']) {
                            $array[$staff_name]['over_normal_count']++; //加班
                            $array[$staff_name]['meal_count']++; //餐补
                        }
                        if ($v['sign_out_time'] >= $end_work_type['type23'] && $v['sign_out_time'] < $end_work_type['type24']){
                            $start_work_time = $start_work_type['type10'];   //次日上班时间推迟
                        }
                    }

                    if ($v['sign_in_time'] == null && $v['sign_out_time'] == null ) {
                        $array[$staff_name]['out_days']++;
                    }
                } elseif ($curr_date_type == $date_type[1] || $curr_date_type == $date_type[2]) {    //周末和节假日模式
                    $proint_count = 0;
                    $meal_count = 0;
                    if ($v['sign_in_time'] != null && $v['sign_out_time'] != null) {
                        $time_range = strtotime($v['sign_out_time']) - strtotime($v['sign_in_time']);
                        if ($time_range >= 4 * 3600 && $time_range < 8 * 3600) {
                            //加班大于4小时小于8小时 0.5个积分，没有餐补
                            $proint_count = 0.5;
                        } elseif ($time_range >= 8 * 3600) {
                            //加班大于等于8小时 积分加1，餐补加1
                            $proint_count = 1;
                            $meal_count = 1;
                        }

                        if ($proint_count > 0) {
                            $staffs = $staff->where("staff_id='{$staff_id}'")->find();
                            $points = floatval($staffs['points']) + 0.5;
                            $staff->points = $points;
                            $staff->save();
                        }
                        if ($curr_date_type == $date_type[2]) {
                            $array[$staff_name]['over_festival_count'] += $proint_count;
                        } else {
                            $array[$staff_name]['over_weekend_count'] += $proint_count;
                        }
                        $array[$staff_name]['meal_count'] += $meal_count;
                    }
                }
            }
        }
        $check = D('check');
        foreach ($array as $value) {
            $value['year_month'] = $y_m;
            $value['update_time'] = date("Y-m-d H:i:s");
            if (!$check->add($value)) {
                return false;
            }
        }
        return true;
    }

}