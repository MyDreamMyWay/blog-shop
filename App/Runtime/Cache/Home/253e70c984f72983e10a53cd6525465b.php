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
            <h2>您旗下所有网吧用户资料管理</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="userView">用户管理</a>
                </li>
                <li>
                    <strong>用户查询</strong>
                </li>
				<li><?php echo ($noResult); ?>
				</li>
				<li><a href="" class="btn btn-primary">刷新</a></li>
            </ol>
        </div>
        
    </div>

    <div class="wrapper wrapper-content">
		<div class="row">
			<div class="col-sm-4">
				<form method="get" action="userView">
		<div class="form-group">

    <div class="input-group">
      

      <select class="form-control"style="font-size:16px"name="netbar_id">
				<?php if(is_array($netbarResult)): $i = 0; $__LIST__ = $netbarResult;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["netbar_id"]); ?>"><?php echo ($vo["netbar_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				
				</select>
	  <span class="input-group-btn"> <button type="submit" class="btn btn-primary">选择网吧
                                        </button> </span>
    </div>
	

  </div>
  
		
		</form>
		
				
				
				
			</div>
			<div class="col-sm-4"><div id="search">
		<form method="get" action="userSearch">
		<div class="form-group">

    <div class="input-group">
      

      <input type="text" class="form-control" name="info" placeholder="请输入帐号,或者手机号,或者邮箱~" autocomplete="off" />
	   <span class="input-group-btn"> <button type="submit" class="btn btn-primary">搜索用户
                                        </button> </span>
	  
    </div>
	

  </div>
  
		
		</form>
		
		</div></div>
			
			<div class="col-sm-4">
			
			</div>
		</div>
		
		<div class="ibox-content">
		<div class="table-responsive">
        <table class="table table-striped" id="pingList">
          <label><?php echo ($netbarNow); ?></label>
		  <thead>
            <tr>
              <th>
                序号
              </th>
              <th>
                账号
              </th>
              <th>
                昵称
              </th>
              <th>
                上机卡号
              </th>
              <th>
                手机
              </th>
              <th>
                金币
              </th>
              <th>
                QQ
              </th>
			  <th>
                邮箱
              </th>
			  <th>
                最后上机时间
              </th>
			  <th>操作</th>
            </tr>
          </thead>
          <!--使用volist渲染 -->
          <tbody>
            <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td>
                  <?php echo ($vo["user_id"]); ?>
                </td>
                <td>
                  <?php echo ($vo["user_user"]); ?>
                </td>
                <td>
                  <?php echo ($vo["user_nickname"]); ?>
                </td>
                <td>
                  <?php echo ($vo["user_member_card"]); ?>
                </td>
                <td>
                  <?php echo ($vo["user_phone"]); ?>
                </td>
                <td>
                  <?php echo ($vo["user_gold"]); ?>
                </td>
                <td>
                  <?php echo ($vo["user_qq"]); ?>
                </td>
				<td>
                  <?php echo ($vo["user_mail"]); ?>
                </td>
				<td>
                  <?php echo ($vo["user_last_online_time"]); ?>
                </td>
				<td>
				<button href="userEdit?id=<?php echo ($vo["user_id"]); ?>" class="btn-primary btn">编辑</button>
				<button href="userDelete?id=<?php echo ($vo["user_id"]); ?>" class="btn-warning btn">删除</button>
				</td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
      </div>
      <div style="text-align: center;">
        <?php echo ($page); ?>
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