<?php

function statisticsAPI($name,$result){ //ͳ��api,���ڵ���apiʱʹ��,д��api��������д�����ݿ�
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
		//�Ѿ�����,����
		$record=M('record');
		$num=$record->where('date(record_time)="'.$today.'" and record_is_ok=1')->count();
		$numFailed=$record->where('date(record_time)="'.$today.'" and record_is_ok=0')->count();
		$install->where('date(install_time)="'.$today.'"')->setField('install_num',$num);
		$install->where('date(install_time)="'.$today.'"')->setField('install_failed_num',$numFailed);
		$install->where('date(install_time)="'.$today.'"')->setField('install_update_time',date('Y-m-d H:i:s'));
		
	}else{
		//������,insert
		$data['install_time']=$today;
		//ȡ����İ�װ��
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
			
			return($class);  //1 ����Ա 2��������Ա 3ע���û� 4�ο�
			
		
	 }


function checknetbar(){
	return session('netbar_id') > 0;
}
	 
	 
	 
function checkData($hash,$accessKey,$params){//���������ݵĺϷ���
		//����1 �Ϸ� ����0 ���ݲ�һ�� ����2 �Ƿ�accessKey,����secretkey��ƥ��
		
		
		
		//����accessKey�������ݿ��ж�Ӧ��secretKey
		$key=M('key');
		$secret=$key->where('key_access="'.$accessKey.'"')->getField('key_secret');
		if($secret<>""){ 
			//����secret,��֤����
			$serverHash=hash_hmac('sha1',$params,$secret);
			//echo $params;
			//echo $serverHash.'---';
			//echo $hash;
			
			if($hash==$serverHash){
				//���ݺϷ�
				return(1);
			}else{
				//���ݷǷ�
				return(0);
			}
		}else{
			//�Ƿ�accessKey,����ʹ���˷Ƿ�secretKey
			return(2);
			
		}
		
		
		
		//������ʹ��secretKey�Բ������ݽ��м���,�����Ƿ���headerһ��,һ������Ϊ����û�б�����,�Ϸ�
		
	}
	
function checkAuth($method,$apiName){//���api���ʵĺϷ���
		//ȡ��head�е���accessKey
		$accessKey=$_SERVER['HTTP_ACCESSKEY'];
		//ȡ�����ܵ�����
		$hashData=$_SERVER['HTTP_HASH'];
		
		//��һ���ж�,���û��������Э��ͷ,˵����֩����߷Ƿ�����,ֱ�Ӿܾ�
		if(isset($accessKey) and isset($hashData)){
			//ȡ��post����
		
		$postData=file_get_contents("php://input");
		//echo $postData;
		
		$params='requestMethod='.$method.'&accessKey='.$accessKey.'&api='.$apiName.'&params='.$postData;
		//Ȼ��ʹ��function.php�к�����֤
		
		$int_return=checkData($hashData,$accessKey,$params);
		
		return($int_return);
		}else{
			return(2);//����2 {error:wrong accessKey or secretKey}
		}


}