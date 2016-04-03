<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>零境考勤管理系统</title>
    <link href="<?php echo (PUBLIC_URL); ?>/css/style.css" rel="stylesheet" type="text/css"/>
    <script language="JavaScript" src="<?php echo (PUBLIC_URL); ?>/js/jquery.js"></script>
    <script type="text/javascript">
        $(function () {
            //导航切换
            $(".menuson li").click(function () {
                $(".menuson li.active").removeClass("active")
                $(this).addClass("active");
            });

            $('.title').click(function () {
                var $ul = $(this).next('ul');
                $('dd').find('ul').slideUp();
                if ($ul.is(':visible')) {
                    $(this).next('ul').slideUp();
                } else {
                    $(this).next('ul').slideDown();
                }
            });
        })
    </script>
</head>

<body style="background:#f0f9fd;">
<div class="lefttop"><span></span>考勤统计</div>

<dl class="leftmenu">

    <dd>
        <div class="title">
            <span><img src="<?php echo (PUBLIC_URL); ?>/images/leftico01.png"/></span>员工信息管理
        </div>
        <ul class="menuson">
            <!--<li class="active"><cite></cite><a href="/ljCheck/index.php/Index/welcome" target="rightFrame">欢迎页</a><i></i></li>-->
            <li class="active"><cite></cite><a href="/ljCheck/index.php/Staff/staffList" target="rightFrame">员工列表</a><i></i></li>
            <li><cite></cite><a href="/ljCheck/index.php/Staff/addStaff" target="rightFrame">添加员工</a><i></i></li>
        </ul>
    </dd>

    <dd>
        <div class="title">
            <span><img src="<?php echo (PUBLIC_URL); ?>/images/leftico02.png"/></span>考勤统计
        </div>
        <ul class="menuson">
            <li><cite></cite><a href="/ljCheck/index.php/Check/upload" target="rightFrame">上传考勤数据</a><i></i></li>
            <li><cite></cite><a href="/ljCheck/index.php/Check/checkList" target="rightFrame">考勤列表</a><i></i></li>
            <li><cite></cite><a href="#">总体分析</a><i></i></li>
        </ul>
    </dd>

    <dd>
        <div class="title"><span><img src="<?php echo (PUBLIC_URL); ?>/images/leftico03.png"/></span>用户管理</div>
        <ul class="menuson">
            <li><cite></cite><a href="#">用户列表</a><i></i></li>
            <li><cite></cite><a href="#">添加用户</a><i></i></li>
        </ul>
    </dd>
</dl>
</body>
</html>