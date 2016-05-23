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
            <h2>申请托管</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">网吧管理</a>
                </li>
                <li>
                    <strong>申请托管</strong>
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
		
		<div class="ibox-content">
		<div class="table-responsive">
        <table class="table table-striped" id="pingList">
          <thead>
            <tr>
              <th>
                托管商ID
              </th>
              <th>
                托管商联系人
              </th>
              <th>
                托管商电话
              </th>
              <th>
                托管商邮箱
              </th>
			  <th>托管商名称
			  </th>
              <th>
                操作
              </th>
              
			  
            </tr>
          </thead>
          <!--使用volist渲染 -->
          <tbody>
            <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td>
                  <?php echo ($vo["user_id"]); ?>
                </td>
                <td>
                  <?php echo ($vo["user_name"]); ?>
                </td>
                <td>
                  <?php echo ($vo["user_phone"]); ?>
                </td>
                <td>
                  <?php echo ($vo["user_mail"]); ?>
                </td>
				<td>
				<?php echo ($vo["user_agent_name"]); ?>
				</td>
                
               
                <td><a href="orderApply?order_source_user_id=<?php echo ($order_source_user_id); ?>&order_source_netbar_id=<?php echo ($order_source_netbar_id); ?>&order_target_user_id=<?php echo ($vo["user_id"]); ?>">申请托管</a></td>
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