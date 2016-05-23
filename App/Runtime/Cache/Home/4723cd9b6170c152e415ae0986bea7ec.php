<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      服务器管理
    </title>
    <link href="/cloud-jimersylee/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/cloud-jimersylee/Public/css/style.css" rel="stylesheet">
  </head>
  
  <body>
<div class="container">
  <div class="page-header">
    <br>

  <h1 class="text-center">申请云平台帐号</h1>
      <br>
</div>
<div class="row">

<div class="col-md-4 col-md-offset-4">


<form action="<?php echo U('new/register',array());?>" name='form' method="post">

  <div class="form-group">

    <div class="input-group">
      <div class="input-group-addon">
      </div>

      <input type="text" class="form-control" name="user_user" placeholder="请输入帐号,长度1至20" autocomplete="off" />
    </div>

  </div>
  <div class="form-group">

    <div class="input-group">
      <div class="input-group-addon">
      </div>

      <input type="email" class="form-control" name="user_mail" placeholder="请输入邮箱" autocomplete="off" />
    </div>

  </div>

  <div class="form-group">

    <div class="input-group">
      <div class="input-group-addon">

      </div>

      <input type="password" class="form-control" name="user_pass"  placeholder="请输入密码,6-20位" autocomplete="off" />
    </div>

  </div>

  <div class="form-group">

    <div class="input-group">
      <div class="input-group-addon">

      </div>

      <input type="password" class="form-control" name="user_pass2"  placeholder="请重复密码,6-20位" autocomplete="off" />
    </div>

  </div>

    <div class="form-group">

    <div class="input-group">

      <div class="input-group-addon">
      
        <img onclick="this.src='<?php echo U('new/verify_img',array());?>'" height="30" width="120" src="<?php echo U('new/verify_img',array());?>">
      </div>
     
      <input type="text" class="form-control" name="checkCode" placeholder="输入验证码"  />
    </div>

  </div>
  
  <div class="form-group">

    <button type="submit" class="btn btn-primary btn-block btn-login">
      立即申请
    </button>
    <hr>

    <a  class="btn btn-primary btn-block btn-login" href="<?php echo U('new/login',array());?>">
    马上登陆
    </a>

  </div> 
    
</form>
</div>
</div>
</div>
    <script src="/cloud-jimersylee/Public/js/jquery.min.js">
    </script>
    <script src="/cloud-jimersylee/Public/js/bootstrap.min.js">
    </script>
    <script src="/cloud-jimersylee/Public/js/scripts.js">
    </script>
  </body>

</html>