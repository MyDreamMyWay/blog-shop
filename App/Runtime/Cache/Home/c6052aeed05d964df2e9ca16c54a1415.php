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
            <h2>添加名下的网吧</h2>
            <ol class="breadcrumb">
                <li>
                    网吧管理
                </li>
                <li>
                    <strong>添加网吧</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
        
        <div class="col-sm-6">
          <h3 class="m-t-none m-b">
            添加网吧
          </h3>
          <form role="form" method="post" action="">
            <div class="form-group">
              <label>
                网吧名字:
              </label>
              <input name="netbar_name" type="" placeholder="" class="form-control">
            </div>
            <div class="form-group">
              <label>
				密码:
              </label>
              <input name="netbar_key" type="" placeholder="如:12344123" class="form-control">
            </div>
            <div class="form-group">
              <label>
                联系人:
              </label>
              <input name="netbar_contacts" type="" placeholder="如:李先生" class="form-control">
            </div>
            <div class="form-group">
              <label>
                电话:
              </label>
              <input name="netbar_phone" type="" placeholder="如:13811111111" class="form-control">
            </div>
            <div class="form-group">
              <label>
                邮箱:
              </label>
              <input name="netbar_mail" type="" placeholder="如:123456@qq.com" class="form-control">
            </div>
			<div class="form-group">
              <label>
                区域选择
              </label>
              <div id="city_1">  
			<select style="font-size:16px;width:200px;height:35px"name="netbar_province" class="prov">
			
			</select>   
			<select style="font-size:16px;width:200px;height:35px" name="netbar_city" class="city">
			
			</select>  
			<select style="font-size:16px;width:200px;height:35px" name="netbar_dist" class="dist">
			
			</select>  
			</div>
            </div>
            <div>
              <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit">
                <strong>
                  确认添加
                </strong>
              </button>
            </div>
          </form>
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
	<script type="text/javascript">
            $(function() {
                $("#city_1").citySelect({
                    prov:"<?php echo ($netbar_province); ?>",
					city:"<?php echo ($netbar_city); ?>",
					dist:"<?php echo ($netbar_dist); ?>",
					
					nodata: "none",
                    required: false
                }); 
               
                
            });
        </script>
		<script>
			/*
 Ajax 三级省市联动
 http://code.ciaoca.cn/
 日期：2012-7-18
 
 settings 参数说明
 -----
 url:省市数据josn文件路径
 prov:默认省份
 city:默认城市
 dist:默认地区（县）
 nodata:无数据状态
 required:必选项
 ------------------------------ */
(function($) {
    $.fn.citySelect = function(settings) {
        if (this.length < 1) {
            return;
        }
        ;

        // 默认值
        settings = $.extend({
            url: "/cloud-jimersylee/Public/js/cityselect/city.min.js",
            prov: null,
            city: null,
            dist: null,
            nodata: null,
            required: true
        }, settings);

        var box_obj = this;
        var prov_obj = box_obj.find(".prov");
        var city_obj = box_obj.find(".city");
        var dist_obj = box_obj.find(".dist");
        var prov_val = settings.prov;
        var city_val = settings.city;
        var dist_val = settings.dist;
        var select_prehtml = (settings.required) ? "" : "<option value=''>请选择</option>";
        var city_json;

        // 赋值市级函数
        var cityStart = function() {
            var prov_id = prov_obj.get(0).selectedIndex;
            if (!settings.required) {
                prov_id--;
            }
            ;
            city_obj.empty().attr("disabled", true);
            dist_obj.empty().attr("disabled", true);

            if (prov_id < 0 || typeof (city_json.citylist[prov_id].c) == "undefined") {
                if (settings.nodata == "none") {
                    city_obj.css("display", "none");
                    dist_obj.css("display", "none");
                } else if (settings.nodata == "hidden") {
                    city_obj.css("visibility", "hidden");
                    dist_obj.css("visibility", "hidden");
                }
                ;
                return;
            }
            ;

            // 遍历赋值市级下拉列表
            temp_html = select_prehtml;
            $.each(city_json.citylist[prov_id].c, function(i, city) {
                temp_html += "<option value='" + city.n + "'>" + city.n + "</option>";
            });
            city_obj.html(temp_html).attr("disabled", false).css({"display": "", "visibility": ""});
            distStart();
        };

        // 赋值地区（县）函数
        var distStart = function() {
            var prov_id = prov_obj.get(0).selectedIndex;
            var city_id = city_obj.get(0).selectedIndex;
            if (!settings.required) {
                prov_id--;
                city_id--;
            }
            ;
            dist_obj.empty().attr("disabled", true);

            if (prov_id < 0 || city_id < 0 || typeof (city_json.citylist[prov_id].c[city_id].a) == "undefined") {
                if (settings.nodata == "none") {
                    dist_obj.css("display", "none");
                } else if (settings.nodata == "hidden") {
                    dist_obj.css("visibility", "hidden");
                }
                ;
                return;
            }
            ;

            // 遍历赋值市级下拉列表
            temp_html = select_prehtml;
            $.each(city_json.citylist[prov_id].c[city_id].a, function(i, dist) {
                temp_html += "<option value='" + dist.s + "'>" + dist.s + "</option>";
            });
            dist_obj.html(temp_html).attr("disabled", false).css({"display": "", "visibility": ""});
        };

        var init = function() {
            // 遍历赋值省份下拉列表
            temp_html = select_prehtml;
            $.each(city_json.citylist, function(i, prov) {
                temp_html += "<option value='" + prov.p + "'>" + prov.p + "</option>";
            });
            prov_obj.html(temp_html);

            // 若有传入省份与市级的值，则选中。（setTimeout为兼容IE6而设置）
            setTimeout(function() {
                if (settings.prov != null) {
                    prov_obj.val(settings.prov);
                    cityStart();
                    setTimeout(function() {
                        if (settings.city != null) {
                            city_obj.val(settings.city);
                            distStart();
                            setTimeout(function() {
                                if (settings.dist != null) {
                                    dist_obj.val(settings.dist);
                                }
                                ;
                            }, 1);
                        }
                        ;
                    }, 1);
                }
                ;
            }, 1);

            // 选择省份时发生事件
            prov_obj.bind("change", function() {
                cityStart();
            });

            // 选择市级时发生事件
            city_obj.bind("change", function() {
                distStart();
            });
        };

        // 设置省市json数据
        if (typeof (settings.url) == "string") {
            $.getJSON(settings.url, function(json) {
                city_json = json;
                init();
            });
        } else {
            city_json = settings.url;
            init();
        }
        ;
    };
})(jQuery);
		
		</script>

    

</body>

</html>