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
            <h2>查看您所拥有的网吧列表</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="netbarView">网吧管理</a>
                </li>
                <li>
                    <strong>网吧列表</strong>
                </li>
				<li>
                    <strong><?php echo ($noResult); ?></strong>
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
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>
                网吧ID
              </th>
              <!-- <th>
                网吧所有者ID
              </th> -->
              <th>
                网吧名
              </th>
              <!-- <th>
                通讯密码
              </th> -->
              <th>
                联系人
              </th>
              <th>
                电话
              </th>
              <th>
                邮箱
              </th>
			  <th>
				VIP到期时间
			  </th>
			  <th>
				版本类型
			  </th>
			  <th></th>
			  <th>用户查看</th>
			  <th>编辑网吧资料</th>
			  <th>删除网吧</th>
            </tr>
          </thead>
          <!--使用volist渲染 -->
          <tbody>
            <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td>
                  <?php echo ($vo["netbar_id"]); ?>
                </td>
                <!-- <td>
                  <?php echo ($vo["netbar_user_id"]); ?>
                </td> -->
                <td>
                  <?php echo ($vo["netbar_name"]); ?>
                </td>
                
                <td>
                  <?php echo ($vo["netbar_contacts"]); ?>
                </td>
                <td>
                  <?php echo ($vo["netbar_phone"]); ?>
                </td>
                <td>
                  <?php echo ($vo["netbar_mail"]); ?>
                </td>
				<td>
					<?php echo ($vo["netbar_vip_time"]); ?>
				</td>
				<td>
					<?php switch($vo["netbar_type"]): case "0": ?>试用<?php break;?>
						<?php case "1": ?>VIP<?php break;?>
						
						<?php default: ?>试用</a><?php endswitch;?>
				</td>
				<td>
					<?php switch($vo["netbar_type"]): case "0": ?><a href="orderBuy?netbar_id=<?php echo ($vo["netbar_id"]); ?>" class="btn btn-primary">购买VIP</a><?php break;?>
						<?php case "1": ?><a href="orderBuy?netbar_id=<?php echo ($vo["netbar_id"]); ?>" class="btn btn-primary">VIP续期</a><?php break;?>
						
						<?php default: ?><a href="orderBuy?netbar_id=<?php echo ($vo["netbar_id"]); ?>" class="btn btn-primary">购买VIP</a><?php endswitch;?>
				</td>
                <td>
                  <a href="userView?netbar_id=<?php echo ($vo["netbar_id"]); ?>" class="btn btn-primary">
                    用户列表
                  </a>
                  
                  <!-- <a href="serverView?id=<?php echo ($vo["netbar_id"]); ?>">
                    查看监控服务器 |
                  </a> -->
				  
				  
                </td>
				<td><a href="netbarEdit?id=<?php echo ($vo["netbar_id"]); ?>" class="btn btn-primary J_menuItem">
					编辑
				  </a></td>
				  <td><a href="netbarDelete?id=<?php echo ($vo["netbar_id"]); ?>" class="btn btn-danger">
                    删除
                  </a></td>
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
	<script src="/cloud-jimersylee/Public/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <!-- 自定义js -->
    <script src="/cloud-jimersylee/Public/js/content.js?v=1.0.0"></script>

    

</body>

</html>