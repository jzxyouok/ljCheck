/**
 * Created by mike hu on 2016/3/16.
 */

//左侧栏切换
//$("#left .menuson li").click(function () {
//
//    $(this).addClass("leftCurrent");
//    $("#left .menuson li").removeClass("leftCurrent");
//});
//
//$('#left .title').click(function () {
//    var $ul = $(this).next('ul');
//    $('dd').find('ul').slideUp();
//    if ($ul.is(':visible')) {
//        $(this).next('ul').slideUp();
//    } else {
//        $(this).next('ul').slideDown();
//    }
//});

//选择框样式
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

//提交员工查询
$('#staffList_btn_search').click(function () {
    var name = $('#name').val();
    var department = $('#department').val();
    location.href = "staffList?name=" + name + '&department=' + department;
    return;

});
//验证电话号码
//验证规则：区号+号码，区号以0开头，3位或4位
//号码由7位或8位数字组成
//区号与号码之间可以无连接符，也可以“-”连接
function checkPhone(str){
    var re = /^0\d{2,3}-?\d{7,8}$/;
    if(re.test(str)){
        return true;
    }else{
        return false;
    }
}
//验证手机号码
//验证规则：11位数字，以1开头。
function checkMobile(str) {
    var re = /^1\d{10}$/
    if (re.test(str)) {
       return true;
    } else {
       return false;
    }
}
//添加员工
$("#btn_addStaff").click( function () {
    var name = $("#name").val();
    if(name == ''){
        layer.msg('名称不能为空!',{
            time:1000 //1s后关闭
        });
        return;
    }
    var staff_id = $("#staff_id").val();
    if(staff_id == ''){
        layer.msg('编号不能为空!',{
            time:1000 //1s后关闭
        });
        return;
    }
    var gender = $("input[name='gender']:checked").val();
    var department = $("#department option:selected").text();
    //var position = $("#position option:selected").text();
    //var level = $("#level option:selected").text();
    var annul_holidays = $("#annul_holidays").val();
    var points = $("#points").val();
    //if(points == ''){
    //    layer.msg('积分不能为空!',{
    //        time:1000 //1s后关闭
    //    });
    //    return;
    //}
    var entry_date = $("#entry_date").val();
    if(entry_date == ''){
        layer.msg('入职日期不能为空!',{
            time:1000 //1s后关闭
        });
        return;
    }
    var telephone = $("#telephone").val();
    if (telephone != ''){
        if(checkMobile(telephone) == false && checkPhone(telephone)==false){
            layer.msg('联系电话格式不正确!',{
                time:1000 //1s后关闭
            });
            return;
        }
    }
    $.ajax({
        type: "POST",
        url: "doAddStaff",
        data:{
            'name':name,
            'staff_id':staff_id,
            'gender':gender,
            'department':department,
            'annul_holidays':annul_holidays,
            'points':points,
            'entry_date':entry_date,
            'telephone':telephone
        },
        dataType:'json',
        success: function(data){
            if(data.error == 0){
                layer.msg(data.msg,{
                    time:2000 //1s后关闭
                });
                location.href = "addStaff";
            }else{
                layer.msg(data.msg,{
                    time:1000 //1s后关闭
                });
            }
        },
        error: function(){
            layer.msg('服务器忙，请稍候再试!',{
                time:1000 //1s后关闭
            });
        }
    });
    return;
});

$("#cancel_btn_addStaff").click(function(){
    location.href = "addStaff";
    return;
});

//修改员工
$("#btn_updateStaff").click( function () {
    var id = $("#id").val();
    var name = $("#name").val();
    if(name == ''){
        layer.msg('名称不能为空！！',{
            time:1000 //1s后关闭
        });
        return;
    }
    var staff_id = $("#staff_id").val();
    if(staff_id == ''){
        layer.msg('编号不能为空！',{
            time:1000 //1s后关闭
        });
        return;
    }
    var gender = $("input[name='gender']:checked").val();
    var department = $("#department option:selected").text();
    //var position = $("#position option:selected").text();
    //var level = $("#level option:selected").text();
    var annul_holidays = $("#annul_holidays").val();
    var points = $("#points").val();
    var entry_date = $("#entry_date").val();
    var page = $("#page").val();
    var telephone = $("#telephone").val();

    if (telephone != ''){
        if(checkMobile(telephone) == false && checkPhone(telephone)==false){
            layer.msg('联系电话格式不正确!',{
                time:1000 //1s后关闭
            });
            return;
        }
    }

    $.ajax({
        type: "POST",
        url: "doUpdateStaff",
        data:{
            'id':id,
            'name':name,
            'staff_id':staff_id,
            'gender':gender,
            'department':department,
            'annul_holidays':annul_holidays,
            'points':points,
            'entry_date':entry_date,
            'telephone':telephone
        },
        dataType:'json',
        success: function(data){
            console.log(data);
            if(data.error == 0){
                location.href = "staffList?page="+page;
            }else{
                alert("员工修改失败，请稍候再试!");
            }
        },
        error: function(){
            layer.msg('服务器忙，请稍候再试!',{
                time:1000 //1s后关闭
            });
        }
    });
    return;
});

$("#cancel_btn_updateStaff").click(function(){
    location.href = "staffList";
    return;
});

//考勤统计查询
$('#checkList_btn_search').click(function () {
    var staff_name = $('#checkList_name').val();
    var department = $('#checkList_department').val();
    var year_month = $('#year_month').val();
    location.href = "checkList?staff_name=" + staff_name + '&department=' + department + '&year_month=' + year_month;
    return;
});
//导出考勤数据
$('#checkList_btn_export').click(function(){
    var staff_name = $('#checkList_name').val();
    var department = $('#checkList_department').val();
    var year_month = $('#year_month').val();
    location.href = "checkListExport?staff_name=" + staff_name + '&department=' + department + '&year_month=' + year_month;
});

//重新统计考勤
$('#afresh_checkList_btn').click(function () {
    layer.confirm('重新统计，积分会重复相加，年假也会重复扣减？',{
        title:'重要提示',
        btn:['确定','取消']
    },function(){
        var staff_name = $('#checkList_name').val();
        var department = $('#checkList_department').val();
        var year_month = $('#year_month').val();
        location.href = "checkList?staff_name=" + staff_name + '&department=' + department + '&year_month=' + year_month +'&delete='+true;
        return;
    },function(){
        layer.msg('取消了',{
            time:1000
        })
    });

});

//签到数据查询
$('#signList_btn_search').click(function () {
    var staff_name = $('#signList_name').val();
    var department = $('#signList_department').val();
    var year_month = $('#sign_year_month').val();
    location.href = "signList?staff_name=" + staff_name + '&department=' + department + '&year_month=' + year_month;
    return;

});
//签到打卡详细数据查询
$('#signDetailList_btn_search').click(function () {
    var staff_name = $('#signDetailList_name').val();
    var year_month = $('#signDetail_year_month').val();
    location.href = "signDetailList?staff_name=" + staff_name + '&year_month=' + year_month;
    return;

});

//请假数据查询
$('#leaveList_btn_search').click(function () {
    var staff_name = $('#leaveList_name').val();
    var department = $('#leaveList_department').val();
    var year_month = $('#leave_year_month').val();
    location.href = "leaveList?staff_name=" + staff_name + '&department=' + department + '&year_month=' + year_month;
    return;

});
//补签数据查询
$('#repSignList_btn_search').click(function () {
    var staff_name = $('#repSignList_name').val();
    var department = $('#repSignList_department').val();
    var year_month = $('#repSignList_year_month').val();
    location.href = "repSignList?staff_name=" + staff_name + '&department=' + department + '&year_month=' + year_month;
    return;

});
//加班数据查询
$('#overWorkList_btn_search').click(function () {
    var staff_name = $('#overWorkList_name').val();
    var department = $('#overWorkList_department').val();
    var year_month = $('#overWorkList_year_month').val();
    location.href = "overWorkList?staff_name=" + staff_name + '&department=' + department + '&year_month=' + year_month;
    return;

});

//考勤分析查询
$('#checkAnalyse_btn_search').click(function () {
    var staff_name = $('#checkAnalyse_name').val();
    var department = $('#checkAnalyse_department').val();
    var year_month_start = $('#year_month_start').val();
    var year_month_end = $('#year_month_end').val();
    if (year_month_start > year_month_end){
        layer.msg('开始日期不能大于结束日期',{time:2000});
        return;
    }
    $.ajax({
        type: "POST",
        url: "ajaxCheckAnalyse",
        data:{
            'staff_name':staff_name,
            'department':department,
            'year_month_start' :year_month_start,
            'year_month_end' :year_month_end
            },
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
                            //markLine : {
                            //    lineStyle: {
                            //        normal: {
                            //            type: 'dashed'
                            //        }
                            //    },
                            //    data : [
                            //        [{type : 'min'}, {type : 'max'}]
                            //    ]
                            //}
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
    //location.href = "checkAnalyse?staff_name="+staff_name+'&department='+department+'&year_month_start='+year_month_start+'&year_month_end='+year_month_end;
    return;
});


//添加用户
$("#btn_addUser").click( function () {
    var name = $("#addUser_name").val();
    if(name == ''){
        layer.msg('请填写用户名!',{
            time:1000 //1s后关闭
        });
        return;
    }
    var password = $("#addUser_password").val();
    if(password == ''){
        layer.msg('请填写密码!',{
            time:1000
        });
        return;
    }

    $.ajax({
        type: "POST",
        url: "doAddUser",
        data:{
            'name':name,
            'password':password
        },
        dataType:'json',
        success: function(data){
            if(data.error == 0){
                layer.msg(data.msg,{
                    time:1000
                });
                location.href = "userList";
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
    return;
});

$('#cancel_btn_addUser').click(function(){
    location.href = "userList";
});

$('.help').click(function(){
    layer.open({
        type: 1,
        title:'帮助',
        area: ['600px', '100px'],
        shadeClose: true, //点击遮罩关闭
        content: '技术问题联系：xinghu@lingjing.com'
    });
});

$('.about').click(function(){
    layer.open({
        type: 1,
        title:'关于',
        area: ['600px', '100px'],
        shadeClose: true, //点击遮罩关闭
        content: '各部门的考勤统计与管理'
    });
});







