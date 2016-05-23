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
            <h2>客户的托管申请处理</h2>
            <ol class="breadcrumb">
                <li>
                    托管管理
                </li>
                <li>
                    <strong>客户的托管申请处理</strong>
                </li>
				<li><?php echo ($noResult); ?>
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
		<div class="row">
			<div class="col-sm-4">
				<div id="search">
		<form method="POST" action="orderSearch">
		<div class="form-group">

    <div class="input-group">
      <div class="input-group-addon">
      </div>

      <input type="text" class="form-control" name="param" placeholder="请输入用户账号或者托管请求ID" autocomplete="off" />
    </div>
	 <button type="submit" class="btn btn-primary btn-block btn-login">
      搜索托管请求
    </button>

  </div>
  
		
		</form>
		
		</div>
			</div>
			<div class="col-sm-4">
			<form class="form-inline" method="POST" action="orderSearch">
        <div class="form-group">
        <label for="startDate">开始日期</label>

        <input id="start"type="text" class="form-control input-sm" name="startDate" placeholder="开始日期" >
        </div>
        <div class="form-group">
        <label for="stopDate">结束日期</label>

        <input id="stop" type="text" class="form-control input-sm" name="stopDate" placeholder="结束日期" >
        </div>
        <button type="submit" class="btn btn-default">查询</button>
        </form>
			</div>
			
			<div class="col-sm-4">
			
			</div>
		</div>
		
		<div class="ibox-content">
		<div class="table-responsive">
        <table class="table table-striped" id="pingList">
          <thead>
            <tr>
              <th>
                托管请求ID
              </th>
              <th>
                申请人昵称
              </th>
              <th>
                申请网吧名
              </th>
              
              <th>
                申请时间
              </th>
              <th>
                订单状态
              </th>
              <th>
                托管请求操作
              </th>
			  
            </tr>
          </thead>
          <!--使用volist渲染 -->
          <tbody>
            <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td>
                  <?php echo ($vo["order_id"]); ?>
                </td>
                <td>
                  <?php echo ($vo["user_name"]); ?>
                </td>
                <td>
                  <?php echo ($vo["netbar_name"]); ?>
                </td>
               
                <td>
                  <?php echo ($vo["order_time"]); ?>
                </td>
                <td>
                  
				  <?php switch($vo["order_state"]): case "0": ?>未处理<?php break;?>
				  <?php case "1": ?>已同意购买<?php break;?>
				  <?php case "2": ?>已拒绝购买<?php break;?>
				  <?php default: ?>未处理<?php endswitch;?>
                </td>
                <td>
				<button onclick="window.location='orderConfirm?order_id=<?php echo ($vo["order_id"]); ?>';" class="btn-primary btn">同意购买</button>
				<button onclick="window.location='orderRefuse?order_id=<?php echo ($vo["order_id"]); ?>';" class="btn">拒绝购买</button>
				<button onclick="window.location='orderDelete?order_id=<?php echo ($vo["order_id"]); ?>';" class="btn-warning btn">删除此申请</button>
				
				
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
	<script src="/cloud-jimersylee/Public/js/plugins/layer/laydate/laydate.js"></script>
    <script>
        //外部js调用
       

        //日期范围限制
        var start = {
            elem: '#start',
            format: 'YYYY/MM/DD hh:mm:ss',
            
            max: '2099-06-16 23:59:59', //最大日期
            istime: true,
            istoday: false,
            choose: function (datas) {
                end.min = datas; //开始日选好后，重置结束日的最小日期
                end.start = datas //将结束日的初始值设定为开始日
            }
        };
        var stop = {
            elem: '#stop',
            format: 'YYYY/MM/DD hh:mm:ss',
            
            max: '2099-06-16 23:59:59',
            istime: true,
            istoday: false,
            choose: function (datas) {
                start.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        laydate(start);
        laydate(stop);
    </script>
    

</body>

</html>