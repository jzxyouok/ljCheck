<?php if (!defined('THINK_PATH')) exit();?><!--top 部分-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>零境考勤系统</title>
    <link href="/ljCheck/Public/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/ljCheck/Public/css/select.css" rel="stylesheet" type="text/css"/>
    <link href="/ljCheck/Public/css/common.css" rel="stylesheet" type="text/css"/>
</head>

<body style="background:url(/ljCheck/Public/images/topbg.gif) repeat-x;">

<div id="top" style="height: 80px;position: relative;">
    <div class="topleft">
        <a href="/ljCheck/index.php/Check/index" target="_parent">
            <!--<img src="/ljCheck/Public/images/logo.png" title="系统首页"/>-->
        </a>
    </div>
    <div class="topright">
        <ul>
            <li><span><img src="/ljCheck/Public/images/help.png" title="帮助" class="helpimg"/></span>
                <a href="javascript:;" class="help">帮助</a>
            </li>
            <li><a href="javascript:;" class="about">关于</a></li>
            <li><a href="/ljCheck/index.php/Login/loginOut" target="_parent">退出</a></li>
        </ul>
        <div class="user">
            <span><?php echo ($_SESSION['username']); ?></span>
        </div>
    </div>
</div>

<div class="lefttop" style="clear: both;"><span></span></div>
<!--左边导航栏-->

<div id="left" style="width: 15%; position: absolute; overflow: hidden;">
    <dl class="leftmenu">
        <dd>
            <div class="title">
                <span><img src="/ljCheck/Public/images/leftico01.png"/></span>员工信息管理
            </div>
            <ul class="menuson">
                <!--<li class="active"><cite></cite><a href="/ljCheck/index.php/Check/welcome" target="rightFrame">欢迎页</a><i></i></li>-->
                <li <?php if($c_a == 'Staff_staffList' ): ?>class='active'<?php endif; ?> ><cite></cite><a href="<?php echo U('Staff/staffList');?>" >员工列表</a><i></i></li>

                <li <?php if($c_a == 'Staff_addStaff' ): ?>class='active'<?php endif; ?> ><cite></cite><a href="<?php echo U('Staff/addStaff');?>" >添加员工</a><i></i></li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="/ljCheck/Public/images/leftico02.png"/></span>考勤统计
            </div>
            <ul class="menuson">
                <li <?php if($c_a == 'Check_upload' ): ?>class='active'<?php endif; ?> ><cite></cite><a href=" <?php echo U('Check/upload');?>" >上传考勤数据</a><i></i></li>
                <li <?php if($c_a == 'Check_signList' ): ?>class='active'<?php endif; ?> ><cite></cite><a href=" <?php echo U('Check/signList');?>" >打卡数据</a><i></i></li>
                <li <?php if($c_a == 'Check_signDetailList' ): ?>class='active'<?php endif; ?> ><cite></cite><a href=" <?php echo U('Check/signDetailList');?>" >打卡详细</a><i></i></li>
                <li <?php if($c_a == 'Check_repSignList' ): ?>class='active'<?php endif; ?> ><cite></cite><a href=" <?php echo U('Check/repSignList');?>" >补签数据</a><i></i></li>
                <li <?php if($c_a == 'Check_overWorkList' ): ?>class='active'<?php endif; ?> ><cite></cite><a href=" <?php echo U('Check/overWorkList');?>" >加班数据</a><i></i></li>
                <li <?php if($c_a == 'Check_leaveList' ): ?>class='active'<?php endif; ?> ><cite></cite><a href=" <?php echo U('Check/leaveList');?>" >请假数据</a><i></i></li>
                <li <?php if($c_a == 'Check_checkList' ): ?>class='active'<?php endif; ?> ><cite></cite><a href=" <?php echo U('Check/checkList');?>" >考勤列表</a><i></i></li>
                <li <?php if($c_a == 'Check_checkAnalyse' ): ?>class='active'<?php endif; ?> ><cite></cite><a href=" <?php echo U('Check/checkAnalyse');?>" >考勤分析</a><i></i></li>
            </ul>
        </dd>

        <dd>
            <div class="title"><span><img src="/ljCheck/Public/images/leftico03.png"/></span>用户管理</div>
            <ul class="menuson">
                <li <?php if($c_a == 'User_userList' ): ?>class='active'<?php endif; ?> ><cite></cite><a href="<?php echo U('User/userList');?>">用户列表</a><i></i></li>
                <!--<li><cite></cite><a href="<?php echo U('User/addUser');?>">注册用户</a><i></i></li>-->
            </ul>
        </dd>
    </dl>
</div>


<!--main部分-->
<div id="staffList" style="width: 85%;float: left;padding-left: 15%;">

    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="<?php echo U('Check/checkList');?>">考勤统计</a></li>
            <li><a href="<?php echo U('Check/upload');?>">上传考勤数据</a></li>
        </ul>
    </div>

    <div class="mainindex">


        <div class="welinfo">
            <!--<span><img src="/ljCheck/Public/images/sun.png" alt="天气"/></span>-->
            <b><?php echo ($username); ?> 您好!，欢迎使用零境考勤管理系统</b>
        </div>

        <span style="color: red; clear: both; padding-left: 10px;">(推荐使用Chrome 浏览器)</span>

        <div class="welinfo">
            <span><img src="/ljCheck/Public/images/time.png" alt="时间"/></span>
            <i>当前日期：<?php echo date("Y-m-d",time());?></i>
        </div>

        <div class="xline"></div>
        <li><img src="/ljCheck/Public/images/ico04.png"/>
            <span><a href="#">文件上传</a><b style="color: red">(提示：将补签，加班，请假，打卡数据等数据表上传完后再进行考勤统计查询;如有数据表未一次添加，用重新统计查询。)</b></span>
        </li>
        <div>

            <div id="rep_sign_excel" style="float: left; padding-left: 60px; padding-top: 20px;">
                <form method="post" action="/ljCheck/index.php/Check/doUploadExcel" enctype="multipart/form-data">
                    <b>选择补签Excel表：</b>
                    <input type="file" name="rep_sign_excel"/>
                    <input type="submit" value="上传" class="scbtn"/>
                </form>
            </div>
            <div id="over_work_excel" style="clear: both; padding-left: 60px; padding-top: 20px;">
                <form method="post" action="/ljCheck/index.php/Check/doUploadExcel" enctype="multipart/form-data">
                    <b>选择加班Excel表：</b>
                    <input type="file" name="over_work_excel"/>
                    <input type="submit" value="上传" class="scbtn"/>
                </form>
            </div>
            <div id="leave_excel" style="clear: both; padding-left: 60px; padding-top: 20px;">
                <form method="post" action="/ljCheck/index.php/Check/doUploadExcel" enctype="multipart/form-data">
                    <b>选择请假Excel表：</b>
                    <input type="file" name="leave_excel"/>
                    <input type="submit" value="上传" class="scbtn"/>
                </form>
            </div>
            <div id="sign_detail_excel" style="clear: both; padding-left: 60px; padding-top: 20px;">
                <form method="post" action="/ljCheck/index.php/Check/doUploadExcel" enctype="multipart/form-data">
                    <b>打卡详情Excel表：</b>
                    <input type="file" name="sign_detail_excel"/>
                    <input type="submit" value="上传" class="scbtn"/>
                </form>
            </div>
            <div id="sign_excel" style="clear: both; padding-left: 60px; padding-top: 20px;">
                <form method="post" action="/ljCheck/index.php/Check/doUploadExcel" enctype="multipart/form-data">
                    <b>选择打卡Excel表：</b>
                    <input type="file" name="sign_excel"/>
                    <input type="submit" value="上传" class="scbtn"/>
                </form>
            </div>

        </div>
    </div>
</div>
<!--页脚-->
<div class="loginbm">版权所有  2009-2016  上海零境网络科技有限公司</div>
</body>
<script src="/ljCheck/Public/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/ljCheck/Public/js/select-ui.min.js"></script>
<script type="text/javascript" src="/ljCheck/Public/plugins/My97/WdatePicker.js"></script>
<script src="/ljCheck/Public/plugins/layer/layer.js" type="text/javascript"></script>
<script src="/ljCheck/Public/plugins/laypage/laypage.js" type="text/javascript"></script>
<!--<script src="/ljCheck/Public/plugins/laydate/laydate.js" type="text/javascript"></script>-->
<script src="/ljCheck/Public/plugins/echarts.min.js" type="text/javascript"></script>
<!--<script src="/ljCheck/Public/plugins/jqueryValidate/jquery.validate.min.js" type="text/javascript"></script>-->
<!--<script src="/ljCheck/Public/plugins/jqueryValidate/messages_zh.min.js" type="text/javascript"></script>-->
<script type="text/javascript" src="/ljCheck/Public/js/common.js"></script>
</html>