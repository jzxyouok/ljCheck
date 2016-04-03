<?php if (!defined('THINK_PATH')) exit();?>﻿<!--top 部分-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>零境考勤系统</title>
    <link href="/ljCheck/Public/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/ljCheck/Public/css/select.css" rel="stylesheet" type="text/css"/>
</head>

<body style="background:url(/ljCheck/Public/images/topbg.gif) repeat-x;">

<div id="top" style="height: 80px;">
    <div class="topleft">
        <a href="/ljCheck/index.php/Index/index" target="_parent">
            <img src="/ljCheck/Public/images/logo.png" title="系统首页"/>
        </a>
    </div>
    <div class="topright">
        <ul>
            <li><span><img src="/ljCheck/Public/images/help.png" title="帮助" class="helpimg"/></span>
                <a href="#;">帮助</a>
            </li>
            <li><a href="#">关于</a></li>
            <li><a href="/ljCheck/index.php/Login/index" target="_parent">退出</a></li>
        </ul>
        <div class="user">
            <span><?php $_SESSION['name']?></span>
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
                <!--<li class="active"><cite></cite><a href="/ljCheck/index.php/Index/welcome" target="rightFrame">欢迎页</a><i></i></li>-->
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
                <!--<li><cite></cite><a href=" <?php echo U('Check/signList');?>" >签到数据</a><i></i></li>-->
                <!--<li><cite></cite><a href=" <?php echo U('Check/leaveList');?>" >请假数据</a><i></i></li>-->
                <li><cite></cite><a href=" <?php echo U('Check/checkList');?>" >考勤统计</a><i></i></li>
                <li><cite></cite><a href="#">总体分析</a><i></i></li>
            </ul>
        </dd>

        <dd>
            <div class="title"><span><img src="/ljCheck/Public/images/leftico03.png"/></span>用户管理</div>
            <ul class="menuson">
                <li><cite></cite><a href="<?php echo U('User/userList');?>">用户列表</a><i></i></li>
                <li><cite></cite><a href="<?php echo U('User/addUser');?>">注册用户</a><i></i></li>
            </ul>
        </dd>
    </dl>
</div>


<!--main部分-->
<div id="staffList" style="width: 85%;float: left;padding-left: 15%">
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页</a></li>
            <li><a href="#">系统设置</a></li>
        </ul>
    </div>

    <div class="formbody">
        <ul class="seachform">
            <li><label>姓名</label><input id="name" type="text" class="scinput"/></li>
            <li><label>部门</label>
                <div class="vocation">
                    <select class="select3" id="department">
                        <option>全部</option>
                        <option>零境</option>
                        <option>思炫</option>
                        <option>合推</option>
                        <option>灵域</option>
                    </select>
                </div>
            </li>

            <li><label>职务</label>
                <div class="vocation">
                    <select class="select3" id="position">
                        <option>全部</option>
                        <option>总经理</option>
                        <option>副总经理</option>
                        <option>总监</option>
                        <option>助理总监</option>
                        <option>原画</option>
                        <option>动作</option>
                        <option>特效</option>
                        <option>UI</option>
                        <option>场景</option>
                        <option>角色</option>
                        <option>运营</option>
                        <option>财务</option>
                        <option>行政</option>
                        <option>出纳</option>
                        <option>动作</option>
                        <option>前台</option>
                        <option>运维</option>
                        <option>测试</option>
                        <option>IT</option>
                        <option>策划</option>
                        <option>商务</option>
                        <option>前端程序</option>
                        <option>后端程序</option>
                        <option>web程序</option>
                    </select>
                </div>
            </li>

            <li><label>职称</label>
                <div class="vocation">
                    <select class="select3" id="level">
                        <option>全部</option>
                        <option>A1</option>
                        <option>A2</option>
                        <option>A3</option>
                        <option>A4</option>
                        <option>A5</option>
                        <option>A6</option>
                        <option>B1</option>
                        <option>B2</option>
                        <option>B3</option>
                        <option>C1</option>
                        <option>C2</option>
                        <option>C3</option>
                        <option>D1</option>
                        <option>D2</option>
                        <option>D3</option>
                        <option>E1</option>
                        <option>E2</option>
                        <option>E3</option>
                        <option>F1</option>
                        <option>F2</option>
                        <option>F3</option>
                        <option>G1</option>
                        <option>G2</option>
                        <option>G3</option>
                        <option>H1</option>
                        <option>H2</option>
                        <option>H3</option>
                    </select>
                </div>
            </li>

            <li><label>&nbsp;</label><input id="btn_search" type="button" class="scbtn" value="查询"/></li>

        </ul>

        <table class="tablelist">
            <thead>
            <tr>
                <th>工号</th>
                <th>姓名</th>
                <th>性别</th>
                <th>部门</th>
                <th>职位</th>
                <th>级别</th>
                <th>年假</th>
                <th>积分</th>
                <th>入职日期</th>
                <th>联系电话</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["staff_id"]); ?></td>
                    <td><?php echo ($vo["name"]); ?></td>
                    <td>
                        <?php if($vo["gender"] == 0 ): ?><span>女</span><?php endif; ?>
                        <?php if($vo["gender"] == 1 ): ?><span>男</span><?php endif; ?>
                    </td>
                    <td><?php echo ($vo["department"]); ?></td>
                    <td><?php echo ($vo["position"]); ?></td>
                    <td><?php echo ($vo["level"]); ?></td>
                    <td><?php echo ($vo["annul_holidays"]); ?></td>
                    <td><?php echo ($vo["points"]); ?></td>
                    <td><?php echo ($vo["entry_date"]); ?></td>
                    <td><?php echo ($vo["telephone"]); ?></td>
                    <td><?php echo ($vo["update_time"]); ?></td>
                    <td><a href="/ljCheck/index.php/Index/updateStaff?id=<?php echo ($vo["id"]); ?>" class="tablelink">修改</a>
                        <a href="/ljCheck/index.php/Index/deleteStaff?id=<?php echo ($vo["id"]); ?>" class="tablelink"> 删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div class="pagin">
            <div class="message">共<i class="blue"><?php echo ($count); ?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo ($page); ?>&nbsp;</i>页</div>
            <ul class="paginList">

                <?php if($page == 1 ): ?><li class="paginItem"><a href="/ljCheck/index.php/Index/staffList?page=1"><span class="pagepre"></span></a>
                    </li>
                    <?php else: ?>
                    <li class="paginItem"><a href="/ljCheck/index.php/Index/staffList?page=<?php echo ($page-1); ?>"><span
                            class="pagepre"></span></a></li><?php endif; ?>
                <?php if(is_array($pageArr)): foreach($pageArr as $key=>$vo): if($vo == $page ): ?><li class="paginItem current"><a href="/ljCheck/index.php/Index/staffList?page=<?php echo ($vo); ?>"><?php echo ($vo); ?></a></li>
                        <?php else: ?>
                        <li class="paginItem"><a href="/ljCheck/index.php/Index/staffList?page=<?php echo ($vo); ?>"><?php echo ($vo); ?></a></li><?php endif; endforeach; endif; ?>
                <?php if($page == $pageNum ): ?><li class="paginItem"><a href="/ljCheck/index.php/Index/staffList?page=<?php echo ($pageNum); ?>"><span
                            class="pagenxt"></span></a></li>
                    <?php else: ?>
                    <li class="paginItem"><a href="/ljCheck/index.php/Index/staffList?page=<?php echo ($page+1); ?>"><span
                            class="pagenxt"></span></a></li><?php endif; ?>

            </ul>
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
<script type="text/javascript" src="/ljCheck/Public/js/common.js"></script>
</html>