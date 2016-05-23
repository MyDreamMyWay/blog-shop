<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title></title>
    

    <link rel="shortcut icon" href="/cloud-jimersylee/Public/favicon.ico"> <link href="/cloud-jimersylee/Public/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/cloud-jimersylee/Public/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="/cloud-jimersylee/Public/css/animate.css" rel="stylesheet">
    <link href="/cloud-jimersylee/Public/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>修改个人资料</h2>
            <ol class="breadcrumb">
                <li>
                    系统管理
                </li>
                <li>
                    <strong>账号设置</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="" class="btn btn-primary">刷新</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox-content">
      <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-5">
          <!--tiles start-->
          <h3>
            修改个人资料
          </h3>
          <form role="form" method="POST" action="<?php echo U('new/changeInfo',array());?>">
            <input name="user_id" value="<?php echo ($user_id); ?>" type="hidden"></input>
			<div class="form-group">
              <label>
                账号
              </label>
              <input name="user_user" disabled="true" type="text" placeholder="" class="form-control" value="<?php echo ($user_user); ?>">
            </div>
			<div class="form-group">
              <label>
                联系人
              </label>
              <input name="user_name" type="text" placeholder="" class="form-control" value="<?php echo ($user_name); ?>">
            </div>
			<div class="form-group">
              <label>
                电话
              </label>
              <input name="user_phone" type="text" placeholder="" class="form-control" value="<?php echo ($user_phone); ?>">
            </div>
			<div class="form-group">
              <label>
				邮箱
              </label>
              <input name="user_mail" type="text" placeholder="" class="form-control" value="<?php echo ($user_mail); ?>">
            </div>
			<div class="form-group">
              <label>
                通讯秘钥
              </label>
              <input name="user_key" type="text" placeholder="" class="form-control" value="<?php echo ($user_key); ?>">
            </div>
			<div class="form-group">
              <label>
                新密码
              </label>
              <input name="user_pass" type="password" placeholder="新密码,长度为6-20的字符" class="form-control">
            </div>
            <div class="form-group">
              <label>
                确认密码
              </label>
              <input name="user_pass2" type="password" placeholder="再输入一次" class="form-control">
            </div>
			
			<div class="form-group">
              <label>
                公司或组织名称
              </label>
              <input name="user_agent_name" type="text" placeholder="" class="form-control" value="<?php echo ($user_agent_name); ?>">
            </div>
            <div>
              <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit">
                <strong>
                  修改
                </strong>
              </button>
            </div>
          </form>
          <!--tiles end-->
        </div>
        <div class="col-sm-6">
        </div>
      </div>
    </div>
    </div>

    <!-- 全局js -->
    <script src="/cloud-jimersylee/Public/js/jquery.min.js?v=2.1.4"></script>
    <script src="/cloud-jimersylee/Public/js/bootstrap.min.js?v=3.3.6"></script>

    <!-- 自定义js -->
    <script src="/cloud-jimersylee/Public/js/content.js?v=1.0.0"></script>
	

    

</body>

</html>