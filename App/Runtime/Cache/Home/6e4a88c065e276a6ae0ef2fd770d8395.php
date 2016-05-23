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
            <h2>网吧用户资料管理</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">用户管理</a>
                </li>
                <li>
                    <strong>用户资料修改</strong>
                </li>
				<li><?php echo ($noResult); ?>
				</li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox-content">
      <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-5">
          
           <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><form role="form" method="post" action="">
            <input style="display:none" name="user_id" value=<?php echo ($vo["user_id"]); ?>></input>
			<div class="form-group">
              <label>
                用户名:
              </label>
              <input name="user_user" type=""  disabled="true" placeholder="" class="form-control" value="<?php echo ($vo["user_user"]); ?>">
            </div>
            <div class="form-group">
              <label>
                昵称:
              </label>
              <input name="user_nickname" type="" placeholder="" class="form-control" value="<?php echo ($vo["user_nickname"]); ?>">
            </div>
            <div class="form-group">
              <label>
                上机卡号:
              </label>
              <input name="user_member_card" type="" placeholder="" class="form-control" value="<?php echo ($vo["user_member_card"]); ?>">
            </div>
            <div class="form-group">
              <label>
                电话:
              </label>
              <input name="user_phone" type="" placeholder="" class="form-control" value="<?php echo ($vo["user_phone"]); ?>">
            </div>
            <div class="form-group">
              <label>
                邮箱:
              </label>
              <input name="user_mail" type="" placeholder="" class="form-control"  value="<?php echo ($vo["user_mail"]); ?>">
            </div>
            <div>
			<div class="form-group">
              <label>
                金币:
              </label>
              <input name="user_gold" type="" disabled="true" placeholder="" class="form-control"  value="<?php echo ($vo["user_gold"]); ?>">
            </div>
			<div class="form-group">
              <label>
               身份证:
              </label>
              <input name="user_card" type="" placeholder="" class="form-control"  value="<?php echo ($vo["user_card"]); ?>">
            </div>
			<div class="form-group">
              <label>
                最后上机时间:
              </label>
              <input name="user_last_online_time" disabled="true" type="" placeholder="" class="form-control" value="<?php echo ($vo["user_last_online_time"]); ?>">
            </div>
              <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit">
                <strong>
                  确认修改
                </strong>
              </button>
            </div>
          </form><?php endforeach; endif; else: echo "" ;endif; ?>
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