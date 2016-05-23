<?php

function statisticsAPI($name,$result){ //统计api,用于调用api时使用,写将api调用数据写入数据库
	$api=M('api_record');
	$data['api_name']=$name;
	$data['api_ip']=getIP();
	$data['api_time']=date('Y-m-d H:i:s');
	$data['api_result']=$result;
	$api->add($data);
	
}

function getIP(){
	
    static $realip;
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        } 
    }
    return $realip;
}

function StatisticSuccessfulNum(){
	$today=date('Y-m-d');
	$install=M('install');
	$result=$install->where('install_time="'.$today.'"')->find();
	if($result){
		//已经存在,更新
		$record=M('record');
		$num=$record->where('date(record_time)="'.$today.'" and record_is_ok=1')->count();
		$numFailed=$record->where('date(record_time)="'.$today.'" and record_is_ok=0')->count();
		$install->where('date(install_time)="'.$today.'"')->setField('install_num',$num);
		$install->where('date(install_time)="'.$today.'"')->setField('install_failed_num',$numFailed);
		$install->where('date(install_time)="'.$today.'"')->setField('install_update_time',date('Y-m-d H:i:s'));
		
	}else{
		//不存在,insert
		$data['install_time']=$today;
		//取今天的安装量
		$record=M('record');
		$num=$record->where('date(record_time)="'.$today.'" and record_is_ok=1')->count();
		$numFailed=$record->where('date(record_time)="'.$today.'" and record_is_ok=0')->count();
		
		$data['install_num']=$num;
		$data['install_failed_num']=$numFailed;
		$data['install_update_time']=date('Y-m-d H:i:s');
		
		$result=$install->add($data);
		
	}
}



function checkVerify($code,$id=""){
		 $verify=new \Think\Verify();
		 return $verify->check($code,$id);
	 }
	 
function checkClass(){  
			
			$class=session('user_class');
			
			return($class);  //1 管理员 2二级管理员 3注册用户 4游客
			
		
	 }


function checknetbar(){
	return session('netbar_id') > 0;
}
	 
	 
	 
function checkData($hash,$accessKey,$params){//检查访问数据的合法性
		//返回1 合法 返回0 数据不一致 返回2 非法accessKey,或者secretkey不匹配
		
		
		
		//根据accessKey查找数据库中对应的secretKey
		$key=M('key');
		$secret=$key->where('key_access="'.$accessKey.'"')->getField('key_secret');
		if($secret<>""){ 
			//存在secret,验证数据
			$serverHash=hash_hmac('sha1',$params,$secret);
			//echo $params;
			//echo $serverHash.'---';
			//echo $hash;
			
			if($hash==$serverHash){
				//数据合法
				return(1);
			}else{
				//数据非法
				return(0);
			}
		}else{
			//非法accessKey,或者使用了非法secretKey
			return(2);
			
		}
		
		
		
		//服务器使用secretKey对参数数据进行加密,看看是否与header一致,一致则认为数据没有被更改,合法
		
	}
	
function checkAuth($method,$apiName){//检查api访问的合法性
		//取出head中的数accessKey
		$accessKey=$_SERVER['HTTP_ACCESSKEY'];
		//取出加密的数据
		$hashData=$_SERVER['HTTP_HASH'];
		
		//做一个判断,如果没有这两个协议头,说明是蜘蛛或者非法请求,直接拒绝
		if(isset($accessKey) and isset($hashData)){
			//取出post数据
		
		$postData=file_get_contents("php://input");
		//echo $postData;
		
		$params='requestMethod='.$method.'&accessKey='.$accessKey.'&api='.$apiName.'&params='.$postData;
		//然后使用function.php中函数验证
		
		$int_return=checkData($hashData,$accessKey,$params);
		
		return($int_return);
		}else{
			return(2);//返回2 {error:wrong accessKey or secretKey}
		}


}