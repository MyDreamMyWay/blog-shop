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

  <h1 class="text-center">管理登陆</h1>
      <br>
</div>
<div class="row">

<div class="col-md-4 col-md-offset-4">


<form role="form" action="<?php echo U('new/login',array());?>" method="POST">

  <div class="form-group">

    <div class="input-group">
      <div class="input-group-addon">
      </div>

      <input type="text" class="form-control" name="user_user" placeholder="请输入帐号" autocomplete="off" />
    </div>

  </div>

  <div class="form-group">

    <div class="input-group">
      <div class="input-group-addon">

      </div>

      <input type="password" class="form-control" name="user_pass"  placeholder="请输入密码" autocomplete="off" />
    </div>

  </div>

    <div class="form-group">

    <div class="input-group">

      <div class="input-group-addon">
    
        <img onclick="this.src='<?php echo U('home/new/verify_img',array());?>'" height="30" width="120" src="<?php echo U('home/new/verify_img',array());?>">
      </div>
     
      <input type="text" class="form-control" name="checkCode" placeholder="输入验证码"  />
    </div>

  </div>
  
  <div class="form-group">

    <button type="submit"  name ='login' value = 'login'  class="btn btn-primary btn-block btn-login">
      立即登陆
    </button>
    <hr>

    <a  class="btn btn-primary btn-block btn-login" href="<?php echo U('new/register',array());?>">
    申请帐号
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