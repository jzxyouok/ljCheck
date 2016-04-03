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
<div id="staffList" style="width: 85%;float: left;padding-left: 15%">
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="<?php echo U('Check/checkList');?>">考勤统计</a></li>
            <li><a href="<?php echo U('Check/checkAnalyse');?>">考勤分析</a></li>
        </ul>
    </div>

    <div class="formbody">
        <ul class="seachform">
            <li><label>姓名</label><input id="checkAnalyse_name" type="text" class="scinput" value="<?php echo ($staff_name); ?>"/></li>
            <li><label>部门</label>
                <div class="vocation">
                    <select class="select3" id="checkAnalyse_department">
                        <option><?php echo ($department); ?></option>
                        <option>全部</option>
                        <option>零境</option>
                        <option>思炫</option>
                        <option>合推</option>
                        <option>灵域</option>
                    </select>
                </div>
            </li>
            <li><label>从</label>
                <input id="year_month_start" type="text" class="Wdate" onFocus="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM'})" style="width: 100px;height: 28px; padding-left: 10px;" value="<?php echo ($year_month_start); ?>"/>
            </li>
            <li><label>到</label>
                <input id="year_month_end" type="text" class="Wdate" onFocus="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM'})" style="width: 100px;height: 28px; padding-left: 10px;" value="<?php echo ($year_month_end); ?>"/>
            </li>
            <li><label>&nbsp;</label><input id="checkAnalyse_btn_search" type="button" class="scbtn" value="查询"/></li>

        </ul>
    </div>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 85%;height:400px;"></div>
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


<script>
    $.ajax({
        type: "POST",
        url: "ajaxCheckAnalyse",
        data:{},
        dataType:'json',
        success: function(data){
            //console.log(data);
            var seriesData = data.seriesData;
            //console.log(seriesData);
            if(data.error == 0){
                // 基于准备好的dom，初始化echarts实例
                var myChart = echarts.init(document.getElementById('main'));

                // 指定图表的配置项和数据
                option = {
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                            type : 'line'        // 默认为直线，可选为：'line' | 'shadow'
                        }
                    },
                    legend: {
                        data:['迟到次数','请假天数','未打卡次数','未签到次数','未签退次数','加班次数','工作日加班次数','周末加班次数','节假日加班次数']
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    xAxis : [
                        {
                            type : 'category',
                            //data : ['一月','二月','三月','四月','五月','六月']
                            data : data.xAxisData
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ],
                    series : [
                        {
                            name:'迟到次数',
                            type:'bar',
                            stack: '迟到次数',
                            //data:[120, 132, 101, 134, 90, 230]
                            data: seriesData.late_count
                        },
                        {
                            name:'请假天数',
                            type:'bar',
                            stack: '请假天数',
                            //data:[220, 182, 191, 234, 290, 330]
                            data: seriesData.leave_days
                        },
                        {
                            name:'未打卡次数',
                            type:'bar',
                            //data:[320, 332, 301, 334, 390, 330],
                            data: seriesData.unsign_count,
//                            markLine : {
//                                lineStyle: {
//                                    normal: {
//                                        type: 'dashed'
//                                    }
//                                },
//                                data : [
//                                    [{type : 'min'}, {type : 'max'}]
//                                ]
//                            }
                        },
                        {
                            name:'未签到',
                            type:'bar',
                            barWidth : 5,
                            stack: '未打卡次数',
                            //data:[620, 732, 701, 734, 1090, 1130]
                            data: seriesData.unsign_in_count
                        },
                        {
                            name:'未签退',
                            type:'bar',
                            barWidth : 5,
                            stack: '未打卡次数',
                            //data:[620, 732, 701, 734, 1090, 1130]
                            data: seriesData.unsign_out_count
                        },
                        {
                            name:'加班次数',
                            type:'bar',
                            //data:[320, 332, 301, 334, 390, 330],
                            data: seriesData.over_count,
                            markLine : {
                                lineStyle: {
                                    normal: {
                                        type: 'dashed'
                                    }
                                },
                                data : [
                                    [{type : 'min'}, {type : 'max'}]
                                ]
                            }
                        },
                        {
                            name:'工作日加班',
                            type:'bar',
                            barWidth : 5,
                            stack: '加班',
                            //data:[620, 732, 701, 734, 1090, 1130]
                            data: seriesData.over_normal_count
                        },
                        {
                            name:'周末加班',
                            type:'bar',
                            barWidth : 5,
                            stack: '加班',
                            //data:[550, 662, 701, 734, 1090, 1130]
                            data: seriesData.over_weekend_count
                        },
                        {
                            name:'节假日加班',
                            type:'bar',
                            barWidth : 5,
                            stack: '加班',
                            //data:[444, 62, 70, 74, 190, 130]
                            data: seriesData.over_festival_count
                        }
                    ]
                };

                // 使用刚指定的配置项和数据显示图表。
                myChart.setOption(option);



            }else{
                layer.msg(data.msg,{
                    time:1000
                });
            }
        },
        error: function(){
            layer.msg('服务器忙，请稍候再试!');
        }
    });
</script>