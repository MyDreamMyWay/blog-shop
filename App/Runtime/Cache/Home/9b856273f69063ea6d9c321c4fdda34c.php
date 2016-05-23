<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>概览</title>
    

    <link rel="shortcut icon" href="/cloud-jimersylee/Public/favicon.ico">
	<link href="/cloud-jimersylee/Public/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/cloud-jimersylee/Public/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <!-- Morris -->
    <link href="/cloud-jimersylee/Public/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="/cloud-jimersylee/Public/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="/cloud-jimersylee/Public/css/animate.css" rel="stylesheet">
    <link href="/cloud-jimersylee/Public/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <!-- <span class="label label-success pull-right">总计</span> -->
                        <h5>您旗下的网吧数</h5><span class="label label-success pull-right"><a class="label-success pull-right"href="netbarAdd">添加网吧</a> </span>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo ($netbarNum); ?></h1>
                        <div class="stat-percent font-bold text-success">
						
						
                        </div>
                        <small></small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">总计</span>
                        <h5>您旗下网吧用户数</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo ($netbarUserNum); ?></h1>
                        <div class="stat-percent font-bold text-info"> <i class="fa fa-level-up"></i>
                        </div>
                        <small></small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">总计</span>
                        <h5>托管申请数</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo ($orderApplyNum); ?></h1>
                        <div class="stat-percent font-bold text-navy"><i class="fa fa-level-up"></i>
                        </div>
                        <small></small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">总计</span>
                        <h5>VIP点数(用于开通VIP)</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo ($user_vip_time); ?></h1>
                        <div class="stat-percent font-bold text-danger"> <i class="fa fa-level-down"></i>
                        </div>
                        <small></small>
                    </div>
                </div>
            </div>
        </div>
		<div class="row">
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">总计:<?php echo ($smsNum); ?>已使用:<?php echo ($smsUseNum); ?></span>
                        <h5>短信余额</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo ($smsSurplusNum); ?>条</h1>
                        <div class="stat-percent font-bold text-success"> <i class="fa fa-bolt"></i>
                        </div>
                        <small></small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">总计</span>
                        <h5>短信日志条数</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo ($smsLogNum); ?></h1>
                        <div class="stat-percent font-bold text-info"> <i class="fa fa-level-up"></i>
                        </div>
                        <small></small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">总计</span>
                        <h5>监控服务器数</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo ($hostNum); ?></h1>
                        <div class="stat-percent font-bold text-navy"><i class="fa fa-level-up"></i>
                        </div>
                        <small></small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">总计</span>
                        <h5>监控日志数</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo ($logNum); ?></h1>
                        <div class="stat-percent font-bold text-danger"> <i class="fa"></i>
                        </div>
                        <small></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>近一个月每天新增网吧用户数</h5>
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-xs btn-white active">天</button>
                                <button type="button" class="btn btn-xs btn-white">月</button>
                                <button type="button" class="btn btn-xs btn-white">年</button>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <ul class="stat-list">
                                    <li>
                                        <h2 class="no-margins"><?php echo ($netbarUserNum); ?></h2>
                                        <small>总用户数</small>
                                        <div class="stat-percent"><i class="fa fa-level-up text-navy"></i>
                                        </div>
                                        <div class="progress progress-mini">
                                            <div style="width: 100%;" class="progress-bar"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <h2 class="no-margins "><?php echo ($numIncrease); ?></h2>
                                        <small>本月新增用户数</small>
                                        <div class="stat-percent"><?php echo ($increasePercent*100); ?>% <i class="fa fa-level-up text-navy"></i>
                                        </div>
                                        <div class="progress progress-mini">
                                            <div style="width: <?php echo ($increasePercent*100); ?>%;" class="progress-bar"></div>
                                        </div>
                                    </li>
                                    
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>最新的服务器日志</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content ibox-heading">
                        <h3><i class="fa fa-envelope-o"></i> 新消息</h3>
                        <small><i class="fa fa-tim"></i> 最近的十条日志</small>
                    </div>
                    <div class="ibox-content">
                        <div class="feed-activity-list">

                            <?php if(is_array($logResult)): $i = 0; $__LIST__ = $logResult;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="feed-element">
                                <div>
                                    <small class="pull-right text-navy">
									</small>
                                    <strong><?php echo ($vo["log_ip_name"]); ?></strong>
                                    <div>
									延迟:<?php echo ($vo["log_timer"]); ?>
									</div>
                                    <small class="text-muted"><?php echo ($vo["log_time"]); ?></small>
                                </div>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
							

                            

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>最新的短信日志</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-hover no-margins">
                                    <thead>
                                        <tr>
                                            <th>发送结果</th>
                                            <th>发送时间</th>
                                            <th>用户号码</th>
                                            <th>短信内容</th>
											<th>短信模板号</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(is_array($smsLogResult)): $i = 0; $__LIST__ = $smsLogResult;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                            <?php switch($vo["log_send_result"]): case "1": ?><td><span class="label label-primary">发送成功</span></td><?php break;?>
												<?php case "0": ?><td><span class="label label-warning">发送失败</span>
												</td><?php break; endswitch;?>
											
                                            <td><i class="fa fa-clock-o"></i><?php echo ($vo["log_send_time"]); ?></td>
                                            <td><?php echo ($vo["log_rec_num"]); ?></td>
                                            <td class="text-navy"><?php echo ($vo["log_send_msg"]); ?></td>
											<td><?php echo ($vo["log_template_code"]); ?></td>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
               
                </div>

            </div>


        </div>
    </div>

    <!-- 全局js -->
    <script src="/cloud-jimersylee/Public/js/jquery.min.js?v=2.1.4"></script>
    <script src="js/bootstrap.min.js?v=3.3.6"></script>



    <!-- Flot -->
    <script src="/cloud-jimersylee/Public/js/plugins/flot/jquery.flot.js"></script>
    <script src="/cloud-jimersylee/Public/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/cloud-jimersylee/Public/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/cloud-jimersylee/Public/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/cloud-jimersylee/Public/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/cloud-jimersylee/Public/js/plugins/flot/jquery.flot.symbol.js"></script>

    <!-- Peity -->
    <script src="/cloud-jimersylee/Public/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/cloud-jimersylee/Public/js/demo/peity-demo.js"></script>

    <!-- 自定义js -->
    <script src="/cloud-jimersylee/Public/js/content.js?v=1.0.0"></script>


    <!-- jQuery UI -->
    <script src="/cloud-jimersylee/Public/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="/cloud-jimersylee/Public/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/cloud-jimersylee/Public/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="/cloud-jimersylee/Public/js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="/cloud-jimersylee/Public/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="/cloud-jimersylee/Public/js/demo/sparkline-demo.js"></script>

    <script>
        $(document).ready(function () {
            $('.chart').easyPieChart({
                barColor: '#f8ac59',
                //                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            $('.chart2').easyPieChart({
                barColor: '#1c84c6',
                //                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            

            var data3 = [
                //
				<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>[gd(<?php echo ($vo["year"]); ?>,<?php echo ($vo["month"]); ?>,<?php echo ($vo["day"]); ?>),<?php echo ($vo["num"]); ?>],<?php endforeach; endif; else: echo "" ;endif; ?>
				
                
            ];


            var dataset = [
                {
                    label: "新增用户数",
                    data: data3,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 24 * 60 * 60 * 600,
                        lineWidth: 0
                    }

                }
				
            ];


            var options = {
                xaxis: {
                    mode: "time",
                    tickSize: [3, "day"],
                    tickLength: 0,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 10,
                    color: "#838383"
                },
                yaxes: [{
                        position: "left",
                        max: <?php echo ($maxNum); ?>,
                        color: "#838383",
                        axisLabelUseCanvas: true,
                        axisLabelFontSizePixels: 12,
                        axisLabelFontFamily: 'Arial',
                        axisLabelPadding: 3
                }, {
                        position: "right",
                        clolor: "#838383",
                        axisLabelUseCanvas: true,
                        axisLabelFontSizePixels: 12,
                        axisLabelFontFamily: ' Arial',
                        axisLabelPadding: 67
                }
                ],
                legend: {
                    noColumns: 1,
                    labelBoxBorderColor: "#000000",
                    position: "nw"
                },
                grid: {
                    hoverable: false,
                    borderWidth: 0,
                    color: '#838383'
                }
            };

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }

            var previousPoint = null,
                previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);

            var mapData = {
                "US": 298,
                "SA": 200,
                "DE": 220,
                "FR": 540,
                "CN": 120,
                "AU": 760,
                "BR": 550,
                "IN": 200,
                "GB": 120,
            };

            $('#world-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },

                series: {
                    regions: [{
                        values: mapData,
                        scale: ["#1ab394", "#22d6b1"],
                        normalizeFunction: 'polynomial'
                    }]
                },
            });
        });
    </script>

    

</body>

</html>