<?php
namespace Home\Controller;

use Think\Controller;

set_time_limit(0);

class CheckController extends BaseController {

    public function index() {
        $this->display();
    }

    public function upload() {
        $this->display();
    }

    public function doUploadExcel() {
        header("Content-Type:text/html;charset=utf-8");
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('xls', 'xlsx');// 设置附件上传类型
        //$upload->rootPath = './Public/Uploads/';
        $upload->rootPath = '.';
        $upload->savePath  = '/Public/uploads/';// 设置附件上传目录
        // 上传文件
        $tableName = 'sign';
        if (isset($_FILES['sign_excel']) && $_FILES['sign_excel'] != null) {
            $info = $upload->uploadOne($_FILES['sign_excel']);
        } elseif (isset($_FILES['leave_excel']) && $_FILES['leave_excel'] != null) {
            $info = $upload->uploadOne($_FILES['leave_excel']);
            $tableName = 'leave';
        } elseif (isset($_FILES['rep_sign_excel']) && $_FILES['rep_sign_excel'] != null) {
            $info = $upload->uploadOne($_FILES['rep_sign_excel']);
            $tableName = 'rep_sign';
        } elseif (isset($_FILES['over_work_excel']) && $_FILES['over_work_excel'] != null) {
            $info = $upload->uploadOne($_FILES['over_work_excel']);
            $tableName = 'over_work';
        } elseif (isset($_FILES['sign_detail_excel']) && $_FILES['sign_detail_excel'] != null) {
            $info = $upload->uploadOne($_FILES['sign_detail_excel']);
            $tableName = 'sign_detail';
        }

        $exts = $info['ext'];
        $filename = $upload->rootPath . $info['savepath'] . $info['savename'];

        if (!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        } else {
            // 上传成功 获取上传文件信息
            $this->loadExcelData($filename, $exts, $tableName);
        }
    }

    //导入excel数据
    public function loadExcelData($filename, $exts = 'xls', $tableName = 'sign') {
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能import导入
        import("Org.Util.PHPExcel");
        //创建PHPExcel对象，注意，不能少了\
        $PHPExcel = new \PHPExcel();
        //如果excel文件后缀名为.xls，导入这个类
        if ($exts == 'xls') {
            import("Org.Util.PHPExcel.Reader.Excel5");
            $PHPReader = new \PHPExcel_Reader_Excel5();
        } else if ($exts == 'xlsx') {
            import("Org.Util.PHPExcel.Reader.Excel2007");
            $PHPReader = new \PHPExcel_Reader_Excel2007();
        }
        import("Org.Util.PHPExcel.IOFactory.php");

        //载入文件
        $PHPExcel = $PHPReader->load($filename);
        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet = $PHPExcel->getSheet(0);
        //获取总列数
        $allColumn = $currentSheet->getHighestColumn();
        //获取总行数
        $allRow = $currentSheet->getHighestRow();
        $arr = array();
        //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
        if ($tableName == 'sign') {
            $allColumn_toNum = \PHPExcel_Cell::columnIndexFromString($allColumn);
            $Column_AtoNum = \PHPExcel_Cell::columnIndexFromString('A');

            for ($currentRow = 2; $currentRow <= $allRow; $currentRow++) {
                for ($currentColumn = $Column_AtoNum; $currentColumn <= $allColumn_toNum; $currentColumn++) {
                    //数据坐标
                    $currentColumn2 = \PHPExcel_Cell::stringFromColumnIndex($currentColumn);
                    $address = $currentColumn2 . $currentRow;
                    //读取到的数据，保存到数组$arr中
                    $cell = $currentSheet->getCell($address)->getValue();

                    if ($cell instanceof PHPExcel_RichText) {
                        $cell = $cell->__toString();
                    }
                    if (isset(self::$signMap[$currentColumn2])) {
                        $arr[$currentRow][self::$signMap[$currentColumn2]] = $cell;
                    }
                }
            }
        } else {
            for ($currentRow = 2; $currentRow <= $allRow; $currentRow++) {
                //从哪列开始，A表示第一列
                for ($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn++) {
                    //数据坐标
                    $address = $currentColumn . $currentRow;
                    //读取到的数据，保存到数组$arr中
                    $cell = $currentSheet->getCell($address)->getValue();
                    //$cell = $data[$currentRow][$currentColumn];
                    if ($cell instanceof PHPExcel_RichText) {
                        $cell = $cell->__toString();
                    }
                    if ($tableName == 'rep_sign') {
                        $arr[$currentRow][self::$repSignMap[$currentColumn]] = $cell;
                    } elseif ($tableName == 'over_work') {
                        $arr[$currentRow][self::$overWorkMap[$currentColumn]] = $cell;
                    } elseif($tableName == 'leave') {
                        $arr[$currentRow][self::$leaveMap[$currentColumn]] = $cell;
                    } elseif($tableName == 'sign_detail') {
                        $arr[$currentRow][self::$signDetailMap[$currentColumn]] = $cell;
                    }

                }
            }
        }
        $this->saveExcelData($arr, $tableName);
    }

    //保存导入excel数据，入库
    public function saveExcelData($arr, $tableName = 'sign') {
        $table = D($tableName);
        $load_time = date('Y-m-d H:i:s', time());
        $array = array();
        foreach ($arr as $key => $value) {
            //判断这条记录是否保存过
            if ($tableName == 'sign') {
                $staff_name = $value['staff_name'];
                $date = $value['date'];
                if ($table->where("`staff_name`='{$staff_name}' AND `date`='{$date}'")->select()) {
                    continue;
                }
            } elseif($tableName == 'sign_detail') {
                $staff_name = $value['staff_name'];
                $check_time = $value['check_time'];
                if ($table->where("`staff_name`='{$staff_name}' AND `check_time`='{$check_time}'")->select()) {
                    continue;
                }
            } else {
                $appr_num = $value['appr_num'];
                if ($table->where("`appr_num`='{$appr_num}'")->select()) {
                    continue;
                }
            }
            $value['load_time'] = $load_time;
            $array[] = $value;
        }
        $result = $table->addAll($array);
        if (false !== $result || 0 !== $result) {
            $this->success('导入数据成功');
        } else {
            $this->error('导入数据失败');
        }

    }

    //考勤列表数据导出
    public function checkListExport(){
        $check = D('check');
        //默认查询上一个月的数据
        if (isset($_REQUEST['year_month']) && $_REQUEST['year_month'] != null) {
            $y_m = trim($_REQUEST['year_month']);
        } else {
            $y_m = date('Y-m', strtotime('-1 month'));
        }
        $where = '1 = 1';
        $where .= " AND `year_month` LIKE '{$y_m}%'";
        if (isset($_REQUEST['delete']) && $_REQUEST['delete']==true){
            $check->where($where)->delete();
        }
        $tmpCount = $check->where($where)->count();
        if ($tmpCount == 0) {
            $this->calculateCheck($y_m);
        }
        $staff_name = trim($_REQUEST['staff_name']);
        if ($staff_name != null) {
            $where .= " AND `staff_name` LIKE '%{$staff_name}%'";
        }
        $department = trim($_REQUEST['department']);
        if ($department != null && $department != '全部') {
            $where .= " AND `department` = '{$department}'";
        } else {
            $department = '全部';
        }
        $data = $check->where($where)->field('staff_id,staff_name,department,late_time,late_count,unsign_in_count,early_time,early_count,unsign_out_count,leave_days,meal_count,over_normal_count,over_weekend_count,over_festival_count,year_month')->select();
        $filename="check_list";
        $headArr = array('工号','姓名','部门','迟到时间(分钟)','迟到次数','未签到次数','早退时间(分钟)','早退次数','未签退次数','请假天数','餐补次数','工作日加班次数','周末加班次数','节假日加班次数','日期(年-月)');
        $this->exportExcel($filename, $headArr, $data);
    }

    //导出Excel表
    public function exportExcel($fileName,$headArr,$data){
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能import导入
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.Writer.Excel5");
        import("Org.Util.PHPExcel.IOFactory.php");

        $date = date("Y_m_d",time());
        $fileName .= "_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("A");
        foreach($headArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $key += 1;
        }

        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();

        //print_r($data);exit;
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            foreach($rows as $keyName=>$value){// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);

        //重命名表
        //$objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }


    //考勤列表
    public function checkList() {
        $check = D('check');
        //默认查询上一个月的数据
        if (isset($_REQUEST['year_month']) && $_REQUEST['year_month'] != null) {
            $y_m = trim($_REQUEST['year_month']);
        } else {
            $y_m = date('Y-m', strtotime('-1 month'));
        }
        $where = '1 = 1';
        $where .= " AND `year_month` LIKE '{$y_m}%'";
        if (isset($_REQUEST['delete']) && $_REQUEST['delete']==true){
            $check->where($where)->delete();
        }
        $tmpCount = $check->where($where)->count();
        if ($tmpCount == 0) {
            $this->calculateCheck($y_m);
        }
        $staff_name = trim($_REQUEST['staff_name']);
        if ($staff_name != null) {
            $where .= " AND `staff_name` LIKE '%{$staff_name}%'";
        }
        $department = trim($_REQUEST['department']);
        if ($department != null && $department != '全部') {
            $where .= " AND `department` = '{$department}'";
        } else {
            $department = '全部';
        }
        $page = $_REQUEST['page'] ? trim($_REQUEST['page']) : 1;
        $pageSize = 12;
        $count = $check->where($where)->count();
        $list = $check->where($where)->limit(($page - 1) * $pageSize, $pageSize)->select();
        $pageNum = ceil($count / $pageSize);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $page);
        $this->assign('pageNum', $pageNum);
        $this->assign('staff_name', $staff_name);
        $this->assign('department', $department);
        $this->assign('year_month', $y_m);
        $this->display();
    }

    //请假详情
    public function leaveDetails() {
        if (!isset($_REQUEST['staff_name']) || $_REQUEST['staff_name'] == null) {
            $this->error('参数错误，没有传入员工姓名!', 'Check/checkList');
        }
        $staff_name = $_REQUEST['staff_name'];
        $year_month = $_REQUEST['year_month'];
        $leave = D('leave');
        $where = '1=1';
        //$where .= "status = '完成' AND result = '同意'" ;
        $where .= " AND people_name = '{$staff_name}' ";
        $where .= " AND start_date LIKE '{$year_month}%' ";
        $list = $leave->where($where)->select();
        $this->assign('list', $list);
        $this->display();
    }

    //请假数据
    public function leaveList() {
        //默认查询上一个月的数据
        if (isset($_REQUEST['year_month']) && $_REQUEST['year_month'] != null) {
            $year_month = trim($_REQUEST['year_month']);
        } else {
            $year_month = date('Y-m', strtotime('-1 month'));
        }
        $leave = D('leave');
        $where = '1=1';
        //$where .= "status = '完成' AND result = '同意'" ;
        $staff_name = trim($_REQUEST['staff_name']);
        if ($staff_name != null) {
            $where .= " AND people_name LIKE '%{$staff_name}%' ";
        }
        $department = trim($_REQUEST['department']);
        if ($department != null && $department != '全部') {
            $where .= " AND department LIKE '%{$department}%'";
        } else {
            $department = '全部';
        }
        $where .= " AND start_date LIKE '{$year_month}%' ";

        $page = $_REQUEST['page'] ? trim($_REQUEST['page']) : 1;
        $pageSize = 12;
        $count = $leave->where($where)->count();
        $list = $leave->where($where)->limit(($page - 1) * $pageSize, $pageSize)->select();
        $pageNum = ceil($count / $pageSize);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $page);
        $this->assign('pageNum', $pageNum);
        $this->assign('staff_name', $staff_name);
        $this->assign('department', $department);
        $this->assign('year_month', $year_month);
        $this->display();
    }

    //补签数据
    public function repSignList() {
        //默认查询上一个月的数据
        if (isset($_REQUEST['year_month']) && $_REQUEST['year_month'] != null) {
            $year_month = trim($_REQUEST['year_month']);
        } else {
            $year_month = date('Y-m', strtotime('-1 month'));
        }
        $repSign = D('rep_sign');
        $where = '1=1';
        //$where .= "status = '完成' AND result = '同意'" ;
        $staff_name = trim($_REQUEST['staff_name']);
        if ($staff_name != null) {
            $where .= " AND people_name LIKE '%{$staff_name}%' ";
        }
        $department = trim($_REQUEST['department']);
        if ($department != null && $department != '全部') {
            $where .= " AND department LIKE '%{$department}%'";
        } else {
            $department = '全部';
        }
        $where .= " AND `rep_sign_time` LIKE '{$year_month}%' ";

        $page = $_REQUEST['page'] ? trim($_REQUEST['page']) : 1;
        $pageSize = 12;
        $count = $repSign->where($where)->count();
        $list = $repSign->where($where)->limit(($page - 1) * $pageSize, $pageSize)->select();
        $pageNum = ceil($count / $pageSize);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $page);
        $this->assign('pageNum', $pageNum);
        $this->assign('staff_name', $staff_name);
        $this->assign('department', $department);
        $this->assign('year_month', $year_month);
        $this->display();
    }

    //加班数据
    public function overWorkList() {
        //默认查询上一个月的数据
        if (isset($_REQUEST['year_month']) && $_REQUEST['year_month'] != null) {
            $year_month = trim($_REQUEST['year_month']);
        } else {
            $year_month = date('Y-m', strtotime('-1 month'));
        }
        $overWork = D('over_work');
        $where = '1=1';
        //$where .= "status = '完成' AND result = '同意'" ;
        $staff_name = trim($_REQUEST['staff_name']);
        if ($staff_name != null) {
            $where .= " AND people_name LIKE '%{$staff_name}%' ";
        }
        $department = trim($_REQUEST['department']);
        if ($department != null && $department != '全部') {
            $where .= " AND department LIKE '%{$department}%'";
        } else {
            $department = '全部';
        }
        $where .= " AND `over_start_time` LIKE '{$year_month}%' ";

        $page = $_REQUEST['page'] ? trim($_REQUEST['page']) : 1;
        $pageSize = 12;
        $count = $overWork->where($where)->count();
        $list = $overWork->where($where)->limit(($page - 1) * $pageSize, $pageSize)->select();
        $pageNum = ceil($count / $pageSize);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $page);
        $this->assign('pageNum', $pageNum);
        $this->assign('staff_name', $staff_name);
        $this->assign('department', $department);
        $this->assign('year_month', $year_month);
        $this->display();

    }
    //打卡数据列表
    public function signList() {
        //默认查询上一个月的数据
        if (isset($_REQUEST['year_month']) && $_REQUEST['year_month'] != null) {
            $year_month = trim($_REQUEST['year_month']);
        } else {
            $year_month = date('Y-m', strtotime('-1 month'));
        }
        $sign = D('sign');
        $where = '1=1';
        $staff_name = trim($_REQUEST['staff_name']);
        if ($staff_name != null) {
            $where .= " AND staff_name LIKE '%{$staff_name}%' ";
        }
        $department = trim($_REQUEST['department']);
        if ($department != null && $department != '全部') {
            $where .= " AND department = '{$department}'";
        } else {
            $department = '全部';
        }
        $where .= " AND date LIKE '{$year_month}%' ";

        $page = $_REQUEST['page'] ? trim($_REQUEST['page']) : 1;
        $pageSize = 12;
        $count = $sign->where($where)->count();
        $list = $sign->where($where)->limit(($page - 1) * $pageSize, $pageSize)->select();
        $pageNum = ceil($count / $pageSize);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $page);
        $this->assign('pageNum', $pageNum);
        $this->assign('staff_name', $staff_name);
        $this->assign('department', $department);
        $this->assign('year_month', $year_month);
        $this->display();
    }
    //打卡详细数据列表 signDetailList
    public function signDetailList() {
        //默认查询上一个月的数据
        if (isset($_REQUEST['year_month']) && $_REQUEST['year_month'] != null) {
            $year_month = trim($_REQUEST['year_month']);
        } else {
            $year_month = date('Y-m', strtotime('-1 month'));
        }
        $sign = D('sign_detail');
        $where = '1=1';
        $staff_name = trim($_REQUEST['staff_name']);
        if ($staff_name != null) {
            $where .= " AND staff_name LIKE '%{$staff_name}%' ";
        }

        $where .= " AND `check_time` LIKE '{$year_month}%' ";

        $page = $_REQUEST['page'] ? trim($_REQUEST['page']) : 1;
        $pageSize = 12;
        $count = $sign->where($where)->count();
        $list = $sign->where($where)->limit(($page - 1) * $pageSize, $pageSize)->select();
        $pageNum = ceil($count / $pageSize);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('page', $page);
        $this->assign('pageNum', $pageNum);
        $this->assign('staff_name', $staff_name);
        $this->assign('year_month', $year_month);
        $this->display();
    }

    public function checkAnalyse() {
        //默认查询上一个月的数据
        if (isset($_REQUEST['year_month_start']) && $_REQUEST['year_month_start'] != null) {
            $year_month_start = trim($_REQUEST['year_month_start']);
        } else {
            $year_month_start = date('Y-m', strtotime('-1 month'));
        }
        if (isset($_REQUEST['year_month_end']) && $_REQUEST['year_month_end'] != null) {
            $year_month_end = trim($_REQUEST['year_month_end']);
        } else {
            $year_month_end = date('Y-m', strtotime('-1 month'));
        }
        $staff_name = trim($_REQUEST['staff_name']);
        $department = trim($_REQUEST['department']);
        if ($department != null && $department != '全部') {
        } else {
            $department = '全部';
        }

        $this->assign('staff_name', $staff_name);
        $this->assign('department', $department);
        $this->assign('year_month_start', $year_month_start);
        $this->assign('year_month_end', $year_month_end);
        $this->display();
    }

    public function ajaxCheckAnalyse() {
        $return = array();
        $return['error'] = 0;

        //默认查询上一个月的数据
        if (isset($_REQUEST['year_month_start']) && $_REQUEST['year_month_start'] != null) {
            $year_month_start = trim($_REQUEST['year_month_start']);
        } else {
            $year_month_start = date('Y-m', strtotime('-1 month'));
        }
        if (isset($_REQUEST['year_month_end']) && $_REQUEST['year_month_end'] != null) {
            $year_month_end = trim($_REQUEST['year_month_end']);
        } else {
            $year_month_end = date('Y-m', strtotime('-1 month'));
        }

        $xAxisData = array();
        $start = explode('-', $year_month_start);
        $start_year = $start[0];
        $start_month = $start[1];
        $end = explode('-', $year_month_end);
        $end_year = $end[0];
        $end_month = $end[1];
        if ($start_year == $end_year) {
            $months = range($start_month, $end_month);
            foreach ($months as $m) {
                if ($m < 10) {
                    $m = '0' . $m;
                }
                $xAxisData[] = $start_year . '-' . $m;
            }
        } else {
            $years = range($start_year, $end_year);
            foreach ($years as $y) {
                if ($y == $start_year) {
                    $smonths = range($start_month, 12);
                    foreach ($smonths as $m) {
                        if ($m < 10) {
                            $m = '0' . $m;
                        }
                        $xAxisData[] = $start_year . '-' . $m;
                    }
                } elseif ($y == $end_year) {
                    $emonths = range(1, $end_month);
                    foreach ($emonths as $m) {
                        if ($m < 10) {
                            $m = '0' . $m;
                        }
                        $xAxisData[] = $end_year . '-' . $m;
                    }
                } else {
                    $months = range(1, 12);
                    foreach ($months as $m) {
                        if ($m < 10) {
                            $m = '0' . $m;
                        }
                        $xAxisData[] = $y . '-' . $m;
                    }
                }
            }
        }

        $check = D('check');
        $where = ' 1=1 ';
        $staff_name = trim($_REQUEST['staff_name']);
        if ($staff_name != null) {
            $where .= " AND `staff_name` LIKE '%{$staff_name}%' ";
        }
        $department = trim($_REQUEST['department']);
        if ($department != null && $department != '全部') {
            $where .= " AND `department` = '{$department}'";
        }
        $seriesData = array();
        //迟到，请假，旷工,加班，工作日加班，周末加班，节假日加班
        foreach ($xAxisData as $y_m) {
            $where_ym = "AND `year_month` = '{$y_m}'";
            $whereDo = $where . $where_ym;
            $ret = $check->where($whereDo)->field('SUM(late_count),SUM(leave_days),SUM(over_normal_count),SUM(over_weekend_count),SUM(over_festival_count),SUM(unsign_in_count),SUM(unsign_out_count)')->find();
            if (!$ret) {
                $return['error'] = 1;
                $return['msg'] = '查询失败！';
                $this->ajaxReturn($return);
            }
            $seriesData['late_count'][] = $ret['sum(late_count)'];
            $seriesData['leave_days'][] = $ret['sum(leave_days)'];
            $seriesData['over_normal_count'][] = $ret['sum(over_normal_count)'];
            $seriesData['over_weekend_count'][] = $ret['sum(over_weekend_count)'];
            $seriesData['over_festival_count'][] = $ret['sum(over_festival_count)'];
            $seriesData['over_count'][] = $ret['sum(over_normal_count)'] + $ret['sum(over_weekend_count)'] + $ret['sum(over_festival_count)'];
            $seriesData['unsign_in_count'][] = $ret['sum(unsign_in_count)'];
            $seriesData['unsign_out_count'][] = $ret['sum(unsign_out_count)'];
            $seriesData['unsign_count'][] = $ret['sum(unsign_in_count)'] + $ret['sum(unsign_out_count)'];
            $where_ym = '';
        }
        $return['xAxisData'] = $xAxisData;
        $return['seriesData'] = $seriesData;
        $this->ajaxReturn($return);
    }

}