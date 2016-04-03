<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>无标题文档</title>
    <link href="<?php echo (PUBLIC_URL); ?>/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo (PUBLIC_URL); ?>/css/select.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo (PUBLIC_URL); ?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo (PUBLIC_URL); ?>/js/select-ui.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function (e) {
            $(".select1").uedSelect({
                width: 200
            });
            $(".select2").uedSelect({
                width: 167
            });
            $(".select3").uedSelect({
                width: 100
            });
        });
    </script>
</head>

<body>
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
                    <option>美术支撑</option>
                    <option>运营支撑</option>
                    <option>管理支撑</option>
                    <option>技术支撑</option>
                    <option>产品一部</option>
                    <option>产品二部</option>
                    <option>产品三部</option>
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
                <td><a href="/ljCheck/index.php/Staff/updateStaff?id=<?php echo ($vo["id"]); ?>" class="tablelink">修改</a>
                    <a href="/ljCheck/index.php/Staff/deleteStaff?id=<?php echo ($vo["id"]); ?>" class="tablelink"> 删除</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="pagin">
        <div class="message">共<i class="blue">1256</i>条记录，当前显示第&nbsp;<i class="blue">2&nbsp;</i>页</div>
        <ul class="paginList">
            <li class="paginItem"><a href="javascript:;"><span class="pagepre"></span></a></li>
            <li class="paginItem"><a href="javascript:;">1</a></li>
            <li class="paginItem current"><a href="javascript:;">2</a></li>
            <li class="paginItem"><a href="javascript:;">3</a></li>
            <li class="paginItem"><a href="javascript:;">4</a></li>
            <li class="paginItem"><a href="javascript:;">5</a></li>
            <li class="paginItem more"><a href="javascript:;">...</a></li>
            <li class="paginItem"><a href="javascript:;">10</a></li>
            <li class="paginItem"><a href="javascript:;"><span class="pagenxt"></span></a></li>
        </ul>
    </div>
</div>
<script>
    $('#btn_search').click(function(){
        var name = $('#name').val();
        var department = $('#department').val();
        if (department == '全部'){
            department = '';
        }
        var position = $('#position').val();
        if (position == '全部'){
            position ='';
        }
        var level = $('#level').val();
        if (level == '全部') {
            level = '';
        }

        $.post("/ljCheck/index.php/Staff/doSearch",
                    {'name':name,
                    'department':department,
                    'position':position,
                    'level':level
                    },
                   function(){
                       location.href = "/ljCheck/index.php/Staff/staffList";
                   }
        );
//
//        $.ajax({
//            type: "POST",
//            url: "/ljCheck/index.php/Staff/doSearch",
//            data:{
//                'name':name,
//                'department':department,
//                'position':position,
//                'level':level
//            },
//            dataType:'json',
//            success: function(data){
//                console.log(data);
//                console.log(data.list);
//                if(data.error == 0){
//                    //alert("查询成功!");
//                    location.href = "/ljCheck/index.php/Staff/searchList?list=data.list";
//                }else{
//                   //alert("查询失败，请稍候再试!");
//                }
//            },
//            error: function(){
//                alert("服务器忙，请稍候再试!");
//            }
//        });
    });
</script>
</body>
</html>