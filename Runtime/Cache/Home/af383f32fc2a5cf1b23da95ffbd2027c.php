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

<div id="top" style="height: 80px;">
    <div class="topleft">
        <a href="/ljCheck/index.php/Staff/index" target="_parent">
            <!--<img src="/ljCheck/Public/images/logo.png" title="系统首页"/>-->
        </a>
    </div>
    <div class="topright">
        <ul>
            <li><span><img src="/ljCheck/Public/images/help.png" title="帮助" class="helpimg"/></span>
                <a href="javascript:;" id="help">帮助</a>
            </li>
            <li><a href="javascript:;" id="about">关于</a></li>
            <li><a href="/ljCheck/index.php/Login/loginOut" target="_parent">退出</a></li>
        </ul>
        <div class="user">
            <span><?php echo ($_SESSION['username']); ?></span>
        </div>
    </div>
</div>

<div class="lefttop" style="clear: both;"><span></span></div>
<!--左边导航栏-->

<div id="left" style="width: 15%; position: absolute">
    <dl class="leftmenu">
        <dd>
            <div class="title">
                <span><img src="/ljCheck/Public/images/leftico01.png"/></span>员工信息管理
            </div>
            <ul class="menuson">
                <!--<li class="active"><cite></cite><a href="/ljCheck/index.php/Staff/welcome" target="rightFrame">欢迎页</a><i></i></li>-->
                <li><cite></cite><a href="<?php echo U('Staff/staffList');?>" >员工列表</a><i></i></li>

                <li><cite></cite><a href="<?php echo U('Staff/addStaff');?>" >添加员工</a><i></i></li>
            </ul>
        </dd>

        <dd>
            <div class="title">
                <span><img src="/ljCheck/Public/images/leftico02.png"/></span>考勤统计
            </div>
            <ul class="menuson">
                <li><cite></cite><a href=" <?php echo U('Check/upload');?>" >上传考勤数据</a><i></i></li>
                <li><cite></cite><a href=" <?php echo U('Check/signList');?>" >打卡数据</a><i></i></li>
                <li><cite></cite><a href=" <?php echo U('Check/repSignList');?>" >补签数据</a><i></i></li>
                <li><cite></cite><a href=" <?php echo U('Check/overWorkList');?>" >加班数据</a><i></i></li>
                <li><cite></cite><a href=" <?php echo U('Check/leaveList');?>" >请假数据</a><i></i></li>
                <li><cite></cite><a href=" <?php echo U('Check/checkList');?>" >考勤列表</a><i></i></li>
                <li><cite></cite><a href=" <?php echo U('Check/checkAnalyse');?>" >考勤分析</a><i></i></li>
            </ul>
        </dd>

        <dd>
            <div class="title"><span><img src="/ljCheck/Public/images/leftico03.png"/></span>用户管理</div>
            <ul class="menuson">
                <li><cite></cite><a href="<?php echo U('User/userList');?>">用户列表</a><i></i></li>
                <!--<li><cite></cite><a href="<?php echo U('User/addUser');?>">注册用户</a><i></i></li>-->
            </ul>
        </dd>
    </dl>
</div>


<!--main部分-->
<div id="staffList" style="width: 85%;float: left;padding-left: 15%">
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="<?php echo U('Staff/staffList');?>">员工信息管理</a></li>
            <li><a href="<?php echo U('Staff/updateStaff');?>">修改员工信息</a></li>
        </ul>
    </div>

    <div class="formbody">

        <div class="formtext">Hi，<b>admin</b>，欢迎使用添加员工功能！</div>
        <ul class="forminfo">
            <li><label>名称<b>*</b></label><input id="name" type="text" class="dfinput" value="<?php echo ($data["name"]); ?>"/></li>
            <li><label>工号<b>*</b></label><input id="staff_id" type="text" class="dfinput" value="<?php echo ($data["staff_id"]); ?>"/>
            </li>
            <li><label>性别</label>
                <input name="gender" type="radio" value="1"
                <?php if($data["gender"] == 1 ): ?>checked="checked"<?php endif; ?>
                />男&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="gender" type="radio" value="0"
                <?php if($data["gender"] == 0 ): ?>checked="checked"<?php endif; ?>
                />女</cite>
            </li>
            <li><label>部门<b>*</b></label>
                <div class="vocation">
                    <select class="select1" id="department">
                        <option><?php echo ($data["department"]); ?></option>
                        <option>零境</option>
                        <option>思炫</option>
                        <option>合推</option>
                        <option>灵域</option>
                    </select>
                </div>
            </li>
            <!--<li><label>职务</label>-->
                <!--<div class="vocation">-->
                    <!--<select class="select1" id="position">-->
                        <!--<option><?php echo ($data["position"]); ?></option>-->
                        <!--<option>总经理</option>-->
                        <!--<option>副总经理</option>-->
                        <!--<option>总监</option>-->
                        <!--<option>助理总监</option>-->
                        <!--<option>原画</option>-->
                        <!--<option>动作</option>-->
                        <!--<option>特效</option>-->
                        <!--<option>UI</option>-->
                        <!--<option>场景</option>-->
                        <!--<option>角色</option>-->
                        <!--<option>运营</option>-->
                        <!--<option>财务</option>-->
                        <!--<option>行政</option>-->
                        <!--<option>出纳</option>-->
                        <!--<option>动作</option>-->
                        <!--<option>前台</option>-->
                        <!--<option>运维</option>-->
                        <!--<option>测试</option>-->
                        <!--<option>IT</option>-->
                        <!--<option>策划</option>-->
                        <!--<option>商务</option>-->
                        <!--<option>前端程序</option>-->
                        <!--<option>后端程序</option>-->
                        <!--<option>web程序</option>-->
                    <!--</select>-->
                <!--</div>-->
            <!--</li>-->
            <!--<li><label>职称</label>-->
                <!--<div class="vocation">-->
                    <!--<select class="select1" id="level">-->
                        <!--<option><?php echo ($data["level"]); ?></option>-->
                        <!--<option>A1</option>-->
                        <!--<option>A2</option>-->
                        <!--<option>A3</option>-->
                        <!--<option>A4</option>-->
                        <!--<option>A5</option>-->
                        <!--<option>A6</option>-->
                        <!--<option>B1</option>-->
                        <!--<option>B2</option>-->
                        <!--<option>B3</option>-->
                        <!--<option>C1</option>-->
                        <!--<option>C2</option>-->
                        <!--<option>C3</option>-->
                        <!--<option>D1</option>-->
                        <!--<option>D2</option>-->
                        <!--<option>D3</option>-->
                        <!--<option>E1</option>-->
                        <!--<option>E2</option>-->
                        <!--<option>E3</option>-->
                        <!--<option>F1</option>-->
                        <!--<option>F2</option>-->
                        <!--<option>F3</option>-->
                        <!--<option>G1</option>-->
                        <!--<option>G2</option>-->
                        <!--<option>G3</option>-->
                        <!--<option>H1</option>-->
                        <!--<option>H2</option>-->
                        <!--<option>H3</option>-->
                    <!--</select>-->
                <!--</div>-->
            <!--</li>-->
            <li><label>年假</label><input id="annul_holidays" type="text" class="dfinput"
                                                value="<?php echo ($data["annul_holidays"]); ?>"/></li>
            <li><label>积分</label><input id="points" type="text" class="dfinput" value="<?php echo ($data["points"]); ?>"/></li>
            <li><label>入职日期</label><input id="entry_date" value="<?php echo ($data["entry_date"]); ?>" type="text" class="Wdate"
                                                  onFocus="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd'})"
                                                  style="width: 190px;height: 34px; padding-left: 10px;"/></li>
            <li><label>联系电话</label><input id="telephone" value="<?php echo ($data["telephone"]); ?>" type="text" class="dfinput"/>
            </li>
            <li style="display: none"><label>id<b>*</b></label><input id="id" value="<?php echo ($data["id"]); ?>" type="text" class="dfinput"/></li>
            <li style="display: none"><label>page<b>*</b></label><input id="page" value="<?php echo ($data["page"]); ?>" type="text" class="dfinput"/></li>
            <li><input id="btn_updateStaff" type="button" class="btn" value="提交"/> <label>&nbsp;</label>
                <input id="cancel_btn_updateStaff" type="button" class="btn" value="取消"/>
            </li>
        </ul>
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