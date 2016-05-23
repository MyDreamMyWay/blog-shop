<?php
return array(
	//'配置项'=>'配置值'
	/* 数据库设置 */
    'DB_TYPE'    => 'mysql',            //数据库类型
    'DB_HOST'    => 'localhost',      //数据库连接地址
    'DB_NAME'    => 'yun', //数据库名称  
    'DB_USER'    => 'root',             //用户名
    'DB_PWD'     => '',             //密码
    'DB_PORT'    => '3306',            //  端口
    'DB_PREFIX'  => 'yun_',           //数据库表前缀
	'SESSION_TYPE'=>'Db',  //数据库存储session
	
	
	/* 站点配置 */
    'SITE'          => 'www.yibaikeji.com',
    'NAME'      => '服务器管理',
    'FRAME'     => 'ThinkPHP',
    'LANG'       => 'PHP/Mysql',
    'CHARSET' => 'UTF-8',
    'AUTHOR'  => '依佰科技',
    'REMARK'   => '本程序为网吧服务器网络状况管理',
    /* 邮件配置 */
    'MAIL_SMTP' => 'TRUE',
    'MAIL_HOST'     => 'smtp.qq.com',
    'MAIL_SMTPAUTH' => TRUE,
    'MAIL_SECURE'   => 'tls',
    'MAIL_CHARSET'  => 'utf-8',
    'MAIL_USERNAME' => '11111@qq.com',/* 发送邮件账号 */
	'MAIL_FROM' 	=>'11111@qq.com',//发件人地址
	'MAIL_FROMNAME'	=>'依佰科技服务器管理平台',//发件人姓名（qq邮箱昵称）
    'MAIL_PASSWORD' => 'kcjhdjks',/* 发送邮件密码 */
    'MAIL_ISHTML'   => TRUE,

    /* 路由配置 */
    'URL_ROUTER_ON'   => true, 
    'URL_MODEL'          => '2', //URL模式
    //'MULTI_MODULE'          =>  false,
    //'DEFAULT_MODULE'        =>  'Home',

    /* 短信接口 */
    'AlidayuAppKey'    => '23301721',  // app key
    'AlidayuAppSecret' => '11ad8b5b3e4e5ddb7802e6eb34c0217e',  // app secret
	
);