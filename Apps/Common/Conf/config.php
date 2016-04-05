<?php
return array(
	//'配置项'=>'配置值'
    // 关闭多模块访问
    'MULTI_MODULE'          =>  false,
    'DEFAULT_MODULE'        =>  'Home',
    //设置URL地址不区分大小写
    'URL_CASE_INSENSITIVE'  =>  true,
    /* 数据库配置 */
    'DB_TYPE'   => 'mysqli', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'lingjing_check', // 数据库名
    'DB_USER'   => 'dnsg', // 用户名
    'DB_PWD'    => 'dnsg',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'lj_', // 数据库表前缀
);