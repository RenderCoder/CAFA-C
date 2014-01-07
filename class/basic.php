<?php 
/*
*基础系统模块
*/
class basic_moudle{
	public $db;
	function __construct(){
		$this->db=new ezSQL_mysql(MYSQL_USER,MYSQL_PWD,MYSQL_DATABASE,MYSQL_HOST);
	}
	/*ajax方法*/
	public function ajax_result($result){//封装并显示json数据
		$ajax_result_array=array();
		if($result==='success'){
			$ajax_result_array['state']=1;
		}else{
			$ajax_result_array['state']=0;
		}
		$ajax_result_array['data']=$result;
		echo json_encode($ajax_result_array);
	}
	/*获取post数据*/
	public function get_post($i){
		if(isset($_POST[$i])){
			return $_POST[$i];
		}else{
			return false;
		}
	}
	/*安全方法*/
	public static function safe($i){
		return mysql_real_escape_string(preg_replace('/[\'\"]+/', '', $i));
	}
	/*加密方法*/
	public static function encrypt($i){
		$i=md5(sha1($i.'changetheworld').'cafa');
		return $i;
	}
	function debug(){
		$this->db->debug();
	}
	function checkPwd($mail,$password){//验证密码
		$mail=$this->safe($mail);
		$password=$this->encrypt($password);
		$sql="SELECT id FROM ".TABLE_H."user WHERE mail='$mail' AND password='$password' LIMIT 0,1";
		$r=count($this->db->get_results($sql));
		if($r>0){
			return true;
		}else{
			return false;
		}
	}
	function checkName($name)//检测昵称是否存在
	{
		$name=$this->safe($name);
		$query=count($this->db->get_row("SELECT name FROM ".TABLE_H."user WHERE name='$name'"));
		if($query===1){return true;}else{return false;}
	}
	function checkRePassword($password1,$password2)//验证两次密码是否一致
	{
		if($password1==$password2){return true;}else{return false;}
	}
	function checkMailFormat($mail)//验证邮箱地址格式
	{
		if(preg_match('/^\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,4}$/', $mail)){
			return true;
		}else{
			return false;
		}
	}
	function checkPasswordFormat($password)//验证密码格式 不少于6位
	{
		if(strlen($password)>=6){return true;}else{return false;}
	}
	function checkCellphoneNumberFormat($cellphoneNumber)//验证手机号码格式
	{
		if(preg_match('/^[0-9]{11}$/', $cellphoneNumber)){return true;}else{return false;}
	}
	function checkNameFormat($name)
	{
		if(preg_match('/^[^\'\"]{2,}$/', $name)){return true;}else{return false;}
	}
	function changePwdTrue($mail,$password){
		$mail=$this->safe($mail);
		$password=$this->encrypt($this->$password);
		$sql="UPDATE ".TABLE_H."user SET password='$password' WHERE mail='$mail'";
		// var_dump($sql);
		$query=$this->db->query($sql);
		// var_dump($query);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	function changePwd($mail,$oldPassword,$password)
	{
		if($this->checkPwd($mail,$oldPassword)){
			// echo 'check ok';
			if($this->changePwdTrue($mail,$password)){return true;}
		}else{
			// echo 'check false';
			return false;
		}
	}
	function checkMail($mail){
		$mail=$this->safe($mail);
		$sql="SELECT id FROM ".TABLE_H."user WHERE mail='$mail' LIMIT 0,1";
		// var_dump($sql);
		$r=count($this->db->get_results($sql));
		if($r>0){
			return true;
		}else{
			return false;
		}
	}
	function register($mail,$name,$password1,$password2){//注册动作
		if($name&&$mail&&$password1&&$password2){
			if(!$this->checkMailFormat($mail))
			{
				return '邮箱格式错误';
			}elseif($this->checkMail($mail))
			{
				return '该邮箱已注册';
			}elseif (!$this->checkNameFormat($name)) 
			{
				return '昵称格式错误';
			}elseif($this->checkName($name))
			{
				return '该昵称已有人使用';
			}elseif(!$this->checkRePassword($password1,$password2))
			{
				return '两次输入密码不一致';
			}elseif(!$this->checkPasswordFormat($password1))
			{
				return '密码应不少于6位';
			}else
			{
				$password=$this->encrypt($password1);
				$sql="INSERT INTO ".TABLE_H."user (name,mail,password) VALUES ('$name','$mail','$password')";
				if($this->db->query($sql)){
					return 'success';
				}else{
					return '数据库写入错误';
				}
			}
		}else{
			return '参数错误';
		}
	}
	function login($mail,$password)//登录动作
	{
		if($mail&&$password)
		{
			if(!$this->checkMailFormat($mail))
			{
				return '邮箱格式错误';
			}elseif(!$this->checkMail($mail))
			{
				return '无此帐户';
			}elseif(!$this->checkPasswordFormat($password))
			{
				return '密码应不少于6位';
			}elseif(!$this->checkPwd($mail,$password))
			{
				return '帐号或密码错误';
			}else{
				return 'success';
			}
		}else{
			return '参数错误';
		}
	}
	/*public function api($i){
		$r=array();
		$r['result']=0;
		$r['msg']='';
		$r['data']='';
		if(isset($i['do'])){
			switch ($this->safe($i['do'])) {
				case 'login':
					if (isset($i['mail'])&&isset($i['password'])) {
						if($this->checkPwd($i['mail'],$i['password'])){
							$r['result']=1;
							setcookie('mail',$i['mail'],time()+3600*24,'/');
						}else{
							$r['msg']='邮箱或密码错误.';
						}
					}else{
						$r['msg']="请输入完整信息.";
					}
					break;
				case 'register':
					if (isset($i['name']) && isset($i['mail']) && isset($i['password'])) {
						$this->register($i['name'],$i['mail'],$i['password'])?$r['result']=1:$r['msg']='该邮箱已注册.';
					}else{
						$r['msg']="请输入完整信息.";
					}
					break;
				case 'changePwd':
					if (isset($i['mail']) && isset($i['oldPassword']) && isset($i['password'])) {
						$this->changePwd($i['mail'],$i['oldPassword'],$i['password'])?$r['result']=1:$r['msg']='修改密码失败.';
					}else{
						$r['msg']="请输入完整信息.";
					}
					break;
				default:
					# code...
					break;
			}
		}
		echo json_encode($r);
	}*/
}
 ?>