<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function index() {
        /* if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        } */
		
        //判断是否为代理商,选择是否渲染代理商导航
		if(session('user_type')==1){
        $agentCode='<li>
                        <a href="'.U("new/agent",array()).'">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">托管管理</span>
                            <span class="fa arrow"></span>
                        </a>
                                                <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="orderView">托管请求处理</a>
                                
                            </li>
							
                            
                            
                        </ul>
                        
                    </li>';
		$this->assign('agent',$agentCode);
        }
		$this->display("index");
    }
    public function index_v3() {
         if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
		//查询总用户数
		$user_id=session('user_id');//取出管理员id
		
		$netbar_user=M('netbar_user');
		$user_admin_id=$user_id;
		$netbarUserNum=$netbar_user->where("user_admin_id=$user_admin_id")->count();
		$this->assign('netbarUserNum',$netbarUserNum);
		//旗下网吧数
		$netbar=M('netbar');
		$netbarNum=$netbar->where("netbar_user_id=$user_id")->count();
		$this->assign('netbarNum',$netbarNum);
        //查询日志条数
		$log=M('log');
		$logNum=$log->where("log_user_id=$user_id")->count();
		$this->assign('logNum',$logNum);
        //显示监控服务器个数
		$host=M('host');
		$hostNum=$host->where("host_user_id=$user_id")->count();
		$this->assign('hostNum',$hostNum);
		
        //sms
        //显示网吧总短信数,可用短信条数,已使用条数
		$sms=M('sms');
		$result=$sms->where("sms_user_id=$user_id")->find();
		if($result){
			$smsNum=$result['sms_num'];
			$smsUseNum=$result['sms_use'];
			$smsSurplusNum=$smsNum-$smsUseNum;
			
			
		}else{
			$smsSurplusNum=0;
		}
		$this->assign('smsUseNum',$smsUseNum);
		$this->assign('smsNum',$smsNum);
		$this->assign('smsSurplusNum',$smsSurplusNum);
        //显示短信log条数
		$sms_log=M('sms_log');
		$smsLogNum=$sms_log->where("log_user_id=$user_id")->count();
		$this->assign('smsLogNum',$smsLogNum);
        //托管申请数
		$buy_order=M('buy_order');
		$orderApplyNum=$buy_order->where("order_source_user_id=$user_id")->count();
		$this->assign('orderApplyNum',$orderApplyNum);
		
		//待处理申请数
        $result=$user=M('user')->where("user_id=$user_id")->find();
		if($result){
			$this->assign('user_vip_time',$result['user_vip_time']);
		}
		
		
		//查询本月每天新增用户数
		//取月份和年份
		$year=date('Y');
		$month=date('m');
		$Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
		$result=$Model->query("SELECT count(*) as num,year(user_reg_time) as year,month(user_reg_time)as month,day(user_reg_time)as day FROM yun_netbar_user WHERE YEAR(user_reg_time)=$year and MONTH(user_reg_time)=$month GROUP BY day(user_reg_time)");
		
		//渲染js的data
		$this->assign('result',$result);
		//查询最大值,渲染js的max
		$result=$Model->query("SELECT count(*) as num,year(user_reg_time) as year,month(user_reg_time)as month,day(user_reg_time)as day FROM yun_netbar_user WHERE YEAR(user_reg_time)=$year and MONTH(user_reg_time)=$month GROUP BY day(user_reg_time) order by count(*) desc limit 1");
		$maxNum=$result[0]['num'];
		$this->assign("maxNum",$maxNum);
		
		//查询本月新增用户数
		$yearMonth=date('Y-m');
		$nextYearMonth=date('Y-m',strtotime("+1 month"));
		
		$numIncrease=$netbar_user->where("user_reg_time>='$yearMonth' and user_reg_time<='$nextYearMonth'")->count();
		$this->assign('numIncrease',$numIncrease);
		//算出本月新增用户占总用户的百分比
		$increasePercent=round($numIncrease/$netbarUserNum,4);
		$this->assign('increasePercent',$increasePercent);
		
		//显示最近的几条服务器日志
		$log = M('log');
        $userID = session('user_id');
        $result = $log->where('log_user_id=' . $userID)->limit(10)->order('log_time desc')->select(); 
        if ($result){
			
            $this->assign('logResult', $result);
		}
		//显示最近的几条短信日志
		$sms_log=M('sms_log');
		$result=$sms_log->where("log_user_id=$user_id")->order('log_send_time desc')->limit(10)->select();
		if($result){
			$this->assign('smsLogResult',$result);
			
		}
		
		//显示监控的机器个数
        //显示高延迟机器个数,点击进入延迟查看
		
		
		
		
		
		
		
		
		
        $this->display();
    }
    public function login() {
        if (!checkClass() <> 1) {
            $this->error('正在登录', U('index'));
        }
        $user_user = I('user_user');
        $user_pass = I('user_pass');
        $checkCode = I('checkCode');
        if ($user_user == '' && $user_pass == '') {
            $this->display('login');
        } else {
            if (!checkVerify($checkCode)) {
                $this->error('验证码输入错误');
            }
            $user = M('user');
            if ($result = $user->where(array(
                'user_user' => $user_user
            ))->find()) {
                if ($result['user_pass'] == md5($user_pass)) {
                    session('user_id', $result['user_id']);
                    session('user_user', $result['user_user']);
                    session('user_class', $result['user_class']);
                                        /*10:23 2016/5/17 添加一个关于用户type的session 来区分普通用户还是代理商
                                        user_type=0 普通用户
                                        user_type=1 代理用户
                                        
                                        */
                                        session('user_type',$result['user_type']);
                    $this->success('登陆成功', index);
                } else {
                    $this->error('密码输入错误,请重新输入!');
                }
            } else {
                $this->error('帐号不存在');
            }
        }
    }
    public function register(){
        if (!checkClass() <> 1) {
            $this->error('正在登录', U('index'));
        }
        $user_user = I('user_user');
        $user_pass = I('user_pass');
        $user_pass2 = I('user_pass2');
                $user_mail=I('user_mail');
                
        $checkCode = I('checkCode');
        if (!$user_user == '' && !$user_pass == '') {
            if (strlen($user_user) > 20 or strlen($user_user)<1) {
                $this->error('账号长度不合法,请控制在 1 - 20 位');
            }
            else if (strlen($user_pass) > 20 or strlen($user_pass) < 6) {
                $this->error('密码长度不合法,请控制在 6 - 20 位');
            }
            else if ($user_pass != $user_pass2) {
                $this->error('两次输入的密码不相同,请重新输入');
            } 
            else if (!checkVerify($checkCode)) {
                $this->error('验证码输入错误');
            }
            $user = M('user');
            if ($result = $user->where(array(
                'user_user' => $user_user
            ))->find()) {
                $this->error('帐号已存在');
            } else if ($result = $user->where(array(
                'user_mail' => $user_user
            ))->find()){
                                $this->error('邮箱已存在');
                        }else{
                                $data['user_user']  = $user_user;
                $data['user_pass']  = md5($user_pass);
                $data['user_class'] = 1;
                                $data['user_mail']=I('user_mail');      
                $data['user_reg_time']=date("Y-m-d H:i:s",time());
                $user = M('user');
                if (!$result = $user->add($data)) {
                    $this->error('注册失败,数据库异常');
                } else {
                    session('user_id',$result);
                    session('user_class',1);
                                        session('user_user',$user_user);
                                        
                                        
                    $this->success('注册成功,正在登录中',U('_index'));
                }
                        }
        } else {
           $this->display("register"); 
        }
        
    }
    public function logout() {
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        session('user_id', null);
        session('user_class', null);
        $this->success('退出成功', U('login'));
    }
    public function changeInfo() {
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        $user_pass = I('user_pass');
        $user_pass2 = I('user_pass2');
        if ($user_pass <> '' && $user_pass2 <> '') {
            if ($user_pass != $user_pass2) {
                $this->error('两次输入的密码不相同,请重新输入');
            }
            if (strlen($user_pass) > 20 or strlen($user_pass) < 6) {
                $this->error('密码输入过长或过短,请保持密码在 6-20位');
            } else {
                $user = M('user');
                                $data['user_id']=I('user_id');
                                $data['user_pass']=md5($user_pass);
                                $data['user_mail']=I('user_mail');
                                $data['user_phone']=I('user_phone');
                                $data['user_key']=I('user_key');
                                $data['user_name']=I('user_name');
                                $data['user_agent_name']=I('user_agent_name');
                                
                                
                                
                                $result=$user->save($data);
                                if($result){
                                        $this->success('修改资料成功~');
                                }else{
                                        $this->error('修改资料失败~');
                                        
                                }
            }
        } else {
                                $user = M('user');
                                $data['user_id']=I('user_id');
                                
                                $data['user_mail']=I('user_mail');
                                $data['user_phone']=I('user_phone');
                                $data['user_key']=I('user_key');
                                $data['user_name']=I('user_name');
                                $data['user_agent_name']=I('user_agent_name');
                                
                                
                                
                                $result=$user->save($data);
                                if($result){
                                        $this->success('修改资料成功~');
                                }else{
                                        $this->error('修改资料失败~');
                                        
                                }
                        
                        
        }
    }
    public function accountSetting() {
        //检查是否登录
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        //查询登录用户的信息,渲染
                $user=M('user');
                $sql['user_id']=session('user_id');
                
                $result=$user->where($sql)->find();
                if($result){
                        $this->assign('user_id',$result['user_id']);
                        $this->assign('user_user',$result['user_user']);
                        $this->assign('user_mail',$result['user_mail']);
                        $this->assign('user_name',$result['user_name']);
                        $this->assign('user_phone',$result['user_phone']);
                        $this->assign('user_key',$result['user_key']);
						$this->assign('user_agent_name',$result['user_agent_name']);
                        
                        
                        $this->display('_accountSetting');
                }else{
                        $this->error('未找到您的账号~');
                        
                }
                
                
    }
    public function systemSetting() { //5:12 PM 3/23/2016 系统设置 更改账号等
        //检查是否登录
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        $this->display('_systemSetting');
    }
    function verify_img() { //生成验证码 ok
        ob_clean();
        $verify = new \Think\Verify();
        $verify->codeSet = '0123456789';
        $verify->fontSize = '16px';
        $verify->imageW = 120;
        $verify->imageH = 40;
        $verify->length = 4;
        $verify->useCurve = false;
        $verify->useNoise = false;
        $verify->entry();
    }
	
	
	
	//用户管理功能
    public function userView($p=1,$netbar_id=0) {
        //查询此用户id下的所有网吧用户
        //取出管理员id
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        $admin_id = session('user_id');
        
                
                //查询默认的网吧会员,分页
                
                
                if($netbar_id==0){
                        $netbar_user = M('netbar_user');
                        $result = $netbar_user->where('user_admin_id=' . $admin_id)->page($p.',20')->select();
                        if ($result) {
						$this->assign('result', $result);
                        } else {
						$this->assign('noResult', '此管理员下没有用户');
                        }
       
                        //分页处理
                        $count= $netbar_user->where('user_admin_id='. $admin_id)->count();
                        $page=new \Think\Page($count,20);
                        $show=$page->show();
                        $this->assign('page',$show);
                }else{
                        //将网吧id写到session
						session("netbar_id",$netbar_id);
						
						$netbar_user = M('netbar_user');
                        $sql['user_admin_id']=$admin_id;
                        $sql['user_netbar_id']=session("netbar_id");
                        
                        $result = $netbar_user->where($sql)->page($p.',20')->select();
						
                        if ($result) {
						$this->assign('result', $result);
                        } else {
						$this->assign('noResult', '此管理员下没有用户');
                        }
       
                        //分页处理
                        $count= $netbar_user->where($sql)->count();
                        $page=new \Think\Page($count,20);
                        $show=$page->show();
                        $this->assign('page',$show);
                }
				
				
				//查询用户旗下所有网吧列表,渲染select标签
				$netbar=M('netbar');
				$result=$netbar->where("netbar_user_id=$admin_id")->select();
				if($result){
					$this->assign('netbarResult',$result);
					
				}else{
					$this->assign('netbarSelect',"noResult");
					
				}
				
				//渲染现在网吧名
				
				if($netbar_id==0){
					$this->assign("netbarNow","全部网吧用户列表");
					
				}else{
					$result=$netbarNow=$netbar->where("netbar_id=$netbar_id")->find();
					$this->assign("netbarNow",$result['netbar_name']);
				}
				
				
				
				
                
                
                


           $this->display('_userView2');
    }
    public function userDelete($id) {
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        $netbar_user = M('netbar_user');
        $result = $netbar_user->where('user_id=' . $id)->delete();
        if ($result) {
            $this->success('删除成功~');
        } else {
            $this->error('删除失败~');
        }
    }
    public function userEdit($id) {
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        $data['user_id'] = $_POST['user_id'];

        if ($data['user_id'] <> '') { //post请求
            $data['user_nickname'] = $_POST['user_nickname'];
            $data['user_member_card'] = $_POST['user_member_card'];
            $data['user_phone'] = $_POST['user_phone'];
            $data['user_gold'] = $_POST['user_gold'];
            $data['user_qq'] = $_POST['user_qq'];
            $data['user_mail'] = $_POST['user_mail'];
			
            $netbar_user = M('netbar_user');
            $result = $netbar_user->save($data);
            
            if ($result) {
                $this->success('更新成功~');
            } else {
                $this->error('更新失败~');
            }
        } else { //get请求
            $netbar_user = M('netbar_user');
            $result = $netbar_user->where('user_id=' . $id)->select();
            $this->assign('result', $result);
            $this->display('_userEdit');
        }
    }
    public function userSearch($info){
                        $netbar_user = M('netbar_user');
                        $sql['user_admin_id']=session('user_id');
                        $sql['user_user']=I('user_user');
                        $sql="user_user='$info' or user_mail='$info' or user_phone='$info' and user_admin_id='".session('user_id')."'";
                        $result = $netbar_user->where($sql)->select();
                        if ($result) {
            $this->assign('result', $result);
                        $this->display('_userView2');
                        
                        } else {
            $this->error('未找到此用户');
                        }
                
                
                
        }
        
        
        
    /*
	@function 显示某用户名下的网吧列表
	@param 
	@return 
	*/    
    public function netbarView() { //显示某用户名下的网吧列表 4:25 PM 4/7/2016 ok
        //显示已登录用户所拥有的网吧
        //取用户名
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        $user_id = session('user_id');
        //查询属于此用户的网吧
        $netbar = M('netbar');
        $result = $netbar->where("netbar_user_id=" . $user_id)->select();
        if ($result) {
            //存在记录,渲染网吧列表
            $this->assign('result', $result);
        } else {
            //没有记录
            $this->assign('noResult', "没有属于您的网吧~");
        }
        $this->display('_netbarView');
    }
    /*
	@function 根据网吧ID删除网吧
	@param $id 网吧id
	@return 成功或者失败
	*/
	public function netbarDelete($id) { //删除网吧  4:24 PM 4/7/2016  ok
        
        //检查是否登录
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        $userID = session('user_id');
        $wl = M('netbar');
        $result = $wl->where('netbar_id=' . $id . " and netbar_user_id=" . $userID)->delete();
        if ($result) {
            $this->success('删除成功~');
        } else {
            $this->error('删除失败~');
        }
    }
    public function netbarEdit($id=-1){
                //查询这个网吧的信息,然后渲染网吧编辑页面
                if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
                
                if($id<>-1){//设置了$id,则是打开编辑页面
                        $netbar=M('netbar');
                        $result=$netbar->where('netbar_id='.$id)->find();
                        if($result){
                        $this->assign('netbar_id',$result['netbar_id']);
                        $this->assign('netbar_name',$result['netbar_name']);
                        $this->assign('netbar_key',$result['netbar_key']);
                        $this->assign('netbar_contacts',$result['netbar_contacts']);
                        $this->assign('netbar_phone',$result['netbar_phone']);
                        $this->assign('netbar_mail',$result['netbar_mail']);
						$this->assign('netbar_province',$result['netbar_province']);
						$this->assign('netbar_city',$result['netbar_city']);
						$this->assign('netbar_dist',$result['netbar_dist']);
                        $this->display();
                        
                        
                        }else{
                        $this->error('未找到本网吧~');
                        }
                }else{//未设置,确认修改
                        
                        
                        $data=$_POST;
						if($_POST['netbar_dist']==''){
							$data['netbar_dist']='';
						}
                        $netbar=M('netbar');
                        $result=$netbar->save($data);
                        if($result){
                                $this->success('更新网吧资料成功~',"netbarView");
                                
                        }else{
                                $this->error('更新网吧资料失败~');
                                
                        }
                        
                }
                
                
                
                
                
                
                
                
        }
		
		/*
		@function 增加网吧到已登录用户的名下
		@param 
		@return 返回到添加页面
		*/
    public function netbarAdd() { //增加网吧已登录用户的名下  5:04 PM 4/7/2016 ok
        //检查是否登录
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        if ($_POST['netbar_key'] <> "") {
            $data['netbar_key'] = $_POST['netbar_key'];
            $data['netbar_name'] = $_POST['netbar_name'];
            $data['netbar_contacts'] = $_POST['netbar_contacts'];
            $data['netbar_phone'] = $_POST['netbar_phone'];
            $data['netbar_mail'] = $_POST['netbar_mail'];
            $data['netbar_user_id'] = session('user_id');
			$data['netbar_province']=$_POST['netbar_province'];
			$data['netbar_city']=$_POST['netbar_city'];
			$data['netbar_dist']=$_POST['netbar_dist'];
			
            $wl = M('netbar');
            $result = $wl->add($data);
            if ($result) {
                $this->success('添加网吧成功~');
            } else {
                $this->error('添加到数据库失败~');
            }
        } else {
            $this->display('_netbarAdd');
        }
    }    
        
        
        
        
        
        
    /*
	@function 网吧服务器监控记录查看
	@param $p 页数
	@return 返回
	*/    
    public function logView($p = 1) { //按页数查看
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        $log = M('log');
        $userID = session('user_id');
        $result = $log->where('log_user_id=' . $userID)->page($p . ',10')->order('log_time desc')->select(); //page  todo 分页处理 第p页 取5条记录
        if ($result) {
            $this->assign('result', $result);
            $count = $log->where('log_user_id=' . $userID)->count();
            $page=new \Think\Page($count,10); //每页显示10条
            $show = $page->show();
            $this->assign('page', $show);
        }
        $this->display('_logView');
    }
    public function serverView($id = 0) { // 浏览网吧id为$id的下的服务器 5:04 PM 4/7/2016 ok
        //查看服务器情况页面,之后调用 viewServerAjax更新数据
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        //查询属于此用户的网吧
        $host = M('host');
        $result = $host->where("host_netbar_id=" . $id)->select();
        if ($result) {
            //存在记录,渲染网吧的服务器列表
            $this->assign('result', $result);
        } else {
            //没有记录
            $this->assign('noResult', "没有属于您的网吧的服务器~");
        }
        $this->display('_serverView');
    }
    public function pingView($id = 0) { //查看服务器记录的ping值的第一次打开页面,功能:1显示该服务器下的监控的ping值 2生成特定的ajax连接,以便更新
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        $ip = M('ip');
        $result = $ip->where("ip_host_id=" . $id)->select();
        if ($result) {
            $this->assign('result', $result);
        } else {
            $this->assign('noResult', '没有找到此服务器上传的记录~');
        }
        //渲染ajax开始
        $this->assign("host_id", $id);
        //渲染ajax结束
        $this->display('_pingView');
    }
    
    public function pingViewAjax($id) { //查看服务器记录的ping值的ajax接口
        //查看服务器信息,ajax调用接口
        if (checkClass() <> 1) {
            $this->show("[]");
        }
        $ip = M('ip');
        $result = $ip->where("ip_host_id=" . $id)->select();
        $str_json = json_encode($result, JSON_UNESCAPED_UNICODE);
        $this->show($str_json);
    }
    public function logViewDate($p = 1) {
                
        $startDate = $_POST['startDate'];
        $stopDate = $_POST['stopDate'];
        //session保存开始时间,下次分页查询的时候直接使用
        if ($startDate <> '' and $stopDate <> '') {
            //如果没有设置session,则设置session,否则直接取值
            if (session('startDate') <> '' and $p <> 1) { //已经设置过日期
                $startDate = session('startDate');
                $stopDate = session('stopDate');
            } else {
                session('startDate', $startDate);
                session('stopDate', $stopDate);
            }
            $log = M('log');
            $userID = session('user_id');
            $result = $log->where('log_time>="' . $startDate . '" and log_time<="' . $stopDate . '" and log_user_id=' . $userID)->page($p . ',10')->order('log_time desc')->select(); //page  todo 分页处理 第p页 取5条记录
            if ($result) {
                $this->assign('result', $result);
                $count = $log->where('log_time>="' . $startDate . '" and log_time<="' . $stopDate . '" and log_user_id=' . $userID)->count();
                $page=new \Think\Page($count,10); //每页显示10条
                $show = $page->show();
                $this->assign('page', $show);
            }
        } else { //如果没有日期参数,清空session的开始与结束日期
            if ($p <> '') { //有页码
                $startDate = session('startDate');
                $stopDate = session('stopDate');
                $log = M('log');
                $userID = session('user_id');
                $result = $log->where('log_time>="' . $startDate . '" and log_time<="' . $stopDate . '" and log_user_id=' . $userID)->page($p . ',10')->order('log_time desc')->select(); //page  todo 分页处理 第p页 取5条记录
                if ($result) {
                    $this->assign('result', $result);
                    $count = $log->where('log_time>="' . $startDate . '" and log_time<="' . $stopDate . '" and log_user_id=' . $userID)->count();
                    $page=new \Think\Page($count,10); //每页显示10条
                    $show = $page->show();
                    $this->assign('page', $show);
                } else { //无页码
                    session('startDate', '');
                    session('stopDate', '');
                }
            }
        }
        $this->display('_logView');
    }
        
        //代理商相关页面
    public function orderView($p=1){
                
                //查询此用户id下的所有订单
        //取出管理员id
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
                if(session('user_type'<>1)){
                        //不是代理商
                        $this->error('您不是代理商,不能访问此页面');
                        
                }
        $user_id = session('user_id');
        
                
                /* //查询默认的网吧会员,分页
                
                
                
                        $buy_order = M('buy_order');
                        $result = $buy_order->where('order_target_user_id=' . $user_id )->page($p.',20')->select();
                        if ($result) {
            $this->assign('result', $result);
                        }else {
            $this->assign('noResult', '暂时没有关于你的订单');
                        }
       
                        //分页处理
                        $count= $buy_order->where('order_target_user_id='. $user_id)->count();
                        $page=new \Think\Page($count,20);
                        $show=$page->show();
                        $this->assign('page',$show); */
					
					
					$Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
					$result=$Model->query("select * from (select * from yun_buy_order left join yun_netbar  on yun_netbar.netbar_id = yun_buy_order.order_source_netbar_id) as buy left join yun_user on yun_user.user_id = buy.netbar_user_id where order_target_user_id=$user_id");
					$this->assign('result',$result);
					
					
                


                        $this->display('orderView');
                
        }
        /*
        @function 代理商同意用户购买VIP服务
        @param order_id 订单ID
        @return 返回到上一页
        */
    public function orderConfirm($order_id=0){
                if($order_id==0){
                        //参数错误,返回上一页
                        $this->error('错误:缺少订单ID参数');
                }
                //查询此订单记录是否存在
                $buy_order=M('buy_order');
                $result=$buy_order->where("order_id=".$order_id)->find();
                        if($result){
                                //成功 继续
                                //获取获得欲设置为VIP的网吧ID
                                $netbar_id=$result["order_source_netbar_id"];
                                //成功 继续
                                //查询是否存在此网吧
                                                $netbar=M('netbar');
                                                $netbarResult=$netbar->where("netbar_id=".$netbar_id)->find();
                                                        if(netbarResult){
                                                                //成功 继续
                                                                //先给代理商扣点,读取代理商点数,是否大于0
                                                                $user=M('user');
                                                                $result=$user->where("user_id=".session('user_id'))->find();
                                                                if($result){
                                                                        $user_vip_time=$result['user_vip_time'];
                                                                        if($user_vip_time>0){
                                                                                //扣点
                                                                                $user_vip_time=$user_vip_time-1;
                                                                                
                                                                                $data['user_vip_time']=$user_vip_time;
                                                                                $user_id=session('user_id');                                                                            
                                                                                $result=$user->where("user_id=".$user_id)->save($data);
                                                                                if($result){
                                                                                        //成功 继续
                                                                        
                                                                                        //设置网吧网吧VIP,查询此网吧的VIp时间,如果时间还未到期,则在此时间上加上一年,如果已经到期,取现在时间,然后加上一年
                                                                                                //查询VIP时间
                                                                                                $vip_time_old=$netbarResult['netbar_vip_time'];
                                                                                                $now_time=date('Y-m-d');
                                                                                                if($vip_time_old<=$now_time){
                                                                                                        //已经到期
                                                                                                        $vip_time_new=date("Y-m-d",strtotime("+1 year"));
                                                                                                        $data['netbar_vip_time']=$vip_time_new;
                                                                                                        
                                                                                                        
                                                                                                }else{
                                                                                                        //未到期
                                                                                                        $vip_time_new=date('Y-m-d',strtotime("$vip_time_old +1 year")); 
                                                                                                        $data['netbar_vip_time']=$vip_time_new;
                                                                                                        
                                                                                                        
                                                                                                }
                                                                                                $result=$netbar->where('netbar_id='.$netbar_id)->save($data);
                                                                                                if($result){
                                                                                                        //更新VIP时间成功
                                                                                                        //更新订单状态
                                                                                                        $data['order_state']=1;
                                                                                                        $result=$buy_order->where("order_id=$order_id")->save($data);
                                                                                                        if($result){
                                                                                                                $this->success('同意购买请求成功~');
                                                                                                        }else{
                                                                                                                //失败,则返还代理商点数 error('设置目标网吧VIP失败');
                                                                                                                //返点
                                                                                                                $user_vip_time=$user_vip_time+1;
                                                                                                                $data['user_vip_time']=$user_vip_time;
                                                                                                                $result=$user->where("user_id=".$user_id)->save($data);
                                                                                                                if($result){
                                                                                                                        //返点完后,将网吧的VIP时间设置为原来的时间
                                                                                                                        $data['netbar_vip_time']=$vip_time_old;
                                                                                                                        $result=$netbar->where("netbar_id=$netbar_id")->save($data);
                                                                                                                        if($result){
                                                                                                                                $this->error('更新订单状态失败,您的VIP点数得到返还,目标网吧的VIP时间未更改');
                                                                                                                        }else{
                                                                                                                                $this->error('更新订单状态失败,您的VIP点数得到返还,目标网吧的VIP时间已更改');
                                                                                                                        }
                                                                                                                        
                                                                                                                        
                                                                                                                }else{
                                                                                                                        $this->error('更新订单状态失败,您的VIP点数被扣除,请联系管理员');
                                                                                                                }
                                                                                                        }
                                                                                                                
                                                                                                        
                                                                                                }else{
                                                                                                        //失败,则返还代理商点数 error('设置目标网吧VIP失败');
                                                                                                        $data['user_vip_time']=$$user_vip_time+1;
                                                                                                        $result=$user->where("user_id=".$user_id)->save($data);
                                                                                                        if($result){
                                                                                                                $this->error('更新网吧VIP时间失败,您的VIP点数得到返还');
                                                                                                        }else{
                                                                                                                $this->error('更新网吧VIP时间失败,您的VIP点数被扣除,请联系管理员');
                                                                                                        }
                                                                                                        
                                                                                                }
                                                                                                
                                                                                                
                        
                                                                                                
                                                                                }else{
                                                                                        $this->error('错误:更新代理商代理点数失败');
                                                                                }
                                                                                
                                                                        }else{
                                                                                $this->error('您的代理点数不足,请购买');
                                                                        }
                                                                        
                                                                }else{
                                                                        //失败 error('未找到您的账号~');
                                                                        $this->error('未找到您的账号');
                                                                }
                                                                        
                                                                        
                                                        }else{
                                                                //失败 error('不存在此网吧');
                                                                $this->error('不存在此网吧');
                                                        }
                                                        
                                                        
                                        //失败 error('获取网吧ID失败');
                        }else{
                                //失败 error('订单不存在');
                                $this->error('订单不存在');
                        }
                        
                        
                
                
                        
                
                        
                        
                        
                
        }
        /*
        @function 代理商拒绝用户购买VIP服务
        @param order_id 订单ID
        @return 返回到上一页
        */
    public function orderRefuse($order_id=0){
                if($order_id==0){
                        //参数错误,返回上一页
                        $this->error('错误:缺少订单ID参数');
                }
                $buy_order=M('buy_order');
                $data['order_state']=2;
                $result=$buy_order->where("order_id=$order_id")->save($data);
                if($result){
                        //更新订单状态成功
                        $this->success('拒绝此订单成功');
                }else{
                        //更新订单状态失败
                        $this->error('拒绝此订单失败');
                        
                }
        }
        /*
        @function 代理商删除用户购买VIP服务的申请
        @param order_id 订单ID
        @return 返回到上一页
        */
    public function orderDelete($order_id=0){
                if($order_id==0){
                        //参数错误,返回上一页
                        $this->error('错误:缺少订单ID参数');
                }
                $buy_order=M('buy_order');
                $result=$buy_order->where("order_id=$order_id")->delete();
                if($result){
                        
                        $this->success('删除此订单成功');
                }else{
                        
                        $this->error('删除此订单失败');
                        
                }
                
        }
    public function orderSearch($p=1){
                
                //查询此用户id下的参数等于param的订单
        //取出管理员id
        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
        }
        if (session('user_type' <> 1)) {
            //不是代理商
            $this->error('您不是代理商,不能访问此页面');
        }
        $param=$_POST['param'];
                $startDate=$_POST['startDate'];
                $stopDate=$_POST['stopDate'];
                
                
                
                $user_id = session('user_id');
        //查询默认的网吧会员,分页
        $buy_order = M('buy_order');
        
                if(empty($_POST['param'])){
                        //按日期查询
                        $result=$buy_order->where("'$startDate'<=order_time and '$stopDate'>=order_time and order_target_user_id=$user_id")->page($p.',20')->select();
                }else{
                        //按ID查询
                        $result = $buy_order->where("order_id=$param or order_source_user_id=$param and order_target_user_id=$user_id")->page($p . ',20')->select();
                }
                
                
        if ($result) {
            $this->assign('result', $result);
        } else {
            $this->assign('noResult', '暂时没有关于你的订单');
        }
        //分页处理
        $count = $buy_order->where('order_target_user_id=' . $user_id)->count();
        $page = new \Think\Page($count, 20);
        $show = $page->show();
        $this->assign('page', $show);
        $this->display('orderView');
        }
    public function orderBuy($netbar_id){
                        if(empty($netbar_id)){
                                $this->error("orderBuy:缺少参数");
                        }
                        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
                        }
                        //取出网吧的区域
						$netbar=M('netbar');
						$result=$netbar->where("netbar_id=$netbar_id")->find();
						if($result){
							$province=$result['netbar_province'];
							$city=$result['netbar_city'];
							$dist=$result['netbar_dist'];
							
						}else{
							$this->error('未找到本网吧');
						}
						//查询代理商
                        $user=M('user');
                        $result=$user->where("user_area_province='$province' or (user_area_province='$province' and user_area_city='$city') or (user_area_province='$province' and user_area_city='$city' and user_area_dist='$dist') and user_type=1")->select();
                        if($result){
                                $this->assign('result',$result);
                        }else{
                                $this->assign('noResult',"未找到托管商");
                        }
                        $this->assign('order_source_user_id',session('user_id'));
                        $this->assign('order_source_netbar_id',$netbar_id);
                        
                        $this->display();
                        
                }
                 /*
        @function 普通网吧用户或者代理商向代理商发出购买VIP申请
        @param order_source_user_id 申请者id
                @param order_souce_netbar_id 申请者欲开通VIP的网吧id
                @param order_target_user_id 代理商ID
        @return 成功返回网吧列表页 失败返回上一页
        */
    public function orderApply($order_source_user_id,$order_source_netbar_id,$order_target_user_id){
                        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
                        }
                        //检查参数
                        if(empty($order_source_user_id) or empty($order_source_netbar_id) or empty($order_target_user_id)){
                                $this->error('orderApply:错误-缺少参数');
                                
                        }
                        //构建申请的sql
                        $buy_order=M('buy_order');
                        $data['order_source_user_id']=$order_source_user_id;
                        $data['order_source_netbar_id']=$order_source_netbar_id;
                        $data['order_target_user_id']=$order_target_user_id;
                        $data['order_time']=date('Y-m-d H:i:s');
                        
                        $result=$buy_order->add($data);
                        if($result){
                                $this->success('托管请求已经发送成功,等待托管商处理',netbarView);
                                
                        }else{
                                $this->error('托管请求已经发送失败');
                                
                        }
                        
                }
                /*
                @function 托管申请记录查看,查看订单的处理状态,以及删除的操作
                @param $p 页数 默认1
                @return 显示view
                */
    public function orderApplyView($p=1){
                        if (checkClass() <> 1) {
            $this->error('未登录,请先登录!', U('login'));
                        }
                        $order_source_user_id=session('user_id');
                        $buy_order=M('buy_order');
                        $result=$buy_order->where("order_source_user_id=$order_source_user_id")->page($p . ',20')->select();
                         if ($result) {
            $this->assign('result', $result);
        } else {
            $this->assign('noResult', '暂时没有关于你的订单');
        }
        //分页处理
        $count = $buy_order->where("order_source_user_id=$order_source_user_id")->count();
        $page = new \Think\Page($count, 20);
        $show = $page->show();
        $this->assign('page', $show);
        $this->display('');
                }
                /*
                @function 撤销订单
                @param $order_id 订单ID
                @return 返回上一页
                */
    public function orderApplyDelete($order_id){
                        $buy_order=M('buy_order');
                        $result=$buy_order->where("order_id=$order_id")->delete();
                        if($result){
                                $this->success('删除订单成功');
                        }else{
                                $this->error('删除订单失败');
                                
                        }
                }
                
}
?>

