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
            <h2>此网吧下的监控服务器列表</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">网吧管理</a>
                </li>
                <li>
                    <strong>监控服务器列表</strong>
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
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>
                监控服务器ID
              </th>
              <th>
                所属网吧ID
              </th>
              <th>
                服务器名
              </th>
              <th>
                公网IP
              </th>
              <th>
                内网IP
              </th>
              <th>
                网卡地址
              </th>
            </tr>
          </thead>
          <!--使用volist渲染 -->
          <tbody>
            <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td>
                  <?php echo ($vo["host_id"]); ?>
                </td>
                <td>
                  <?php echo ($vo["host_netbar_id"]); ?>
                </td>
                <td>
                  <?php echo ($vo["host_name"]); ?>
                </td>
                <td>
                  <?php echo ($vo["host_public_ip"]); ?>
                </td>
                <td>
                  <?php echo ($vo["host_private_ip"]); ?>
                </td>
                <td>
                  <?php echo ($vo["host_mac"]); ?>
                </td>
                <td>
                  <a href="serverDelete?id=<?php echo ($vo["host_id"]); ?>">
                    删除
                  </a>
                  |
                  <a href="pingView?id=<?php echo ($vo["host_id"]); ?>">
                    查看此服务器监控的地址
                  </a>
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