<?php 
/*
*路由
*/
class route{
	public static $path;
	public static $file_path;
	public static $url_argument;//url传参
	public static $app_page='/index';//app内页面路径

	private static function clean(){
		self::$path=urldecode($_SERVER['REQUEST_URI']);
		self::$path=preg_replace('/[\'\"]+/', '', self::$path);
	}
	/*获取路径数组*/
	public static function getPath(){
		self::clean();
		self::$path=explode('/', self::$path);
		foreach (self::$path as $key => $value) {
			if($value===''){
				unset(self::$path[$key]);
			}
		}
		array_splice(self::$path,0,1);
		switch (count(self::$path)) {
			case 0:
				self::$file_path=dirname(dirname(__FILE__)).'/apps/home/tpl';
				self::$path[0]='home';
				break;
			default:
				if(count(self::$path)>1){self::$app_page='';}
				if(SERVER_TYPE=='linux'){
					$test_path=dirname(dirname(__FILE__)).'/apps/'.self::$path[0].'/tpl/';//linux
				}else{
					$test_path=dirname(dirname(__FILE__)).'\apps\\'.self::$path[0].'\\tpl\\';//win
				}
				for ($i=1; $i < count(self::$path); $i++) {
					// var_dump(preg_match("/^[0-9]+$/i", self::$path[$i]));
					// if(preg_match("/^[0-9]+$/i", self::$path[$i])==0){
					if(preg_match("/^[0-9]+$/i", self::$path[$i])==0 && preg_match("/\=/i", self::$path[$i])==0){
						if($i<count(self::$path)-1){
								$test_path.=self::$path[$i].'/';
						}else{
							// $test_path.=self::$path[$i].'.html';
							$test_path.=self::$path[$i];
						}
						self::$app_page.='/'.self::$path[$i];
					}else{
						$test_path=substr($test_path, 0, -1);
						self::$url_argument = array();
						for ($ii=$i; $ii < count(self::$path); $ii++) {
							if(preg_match('/\=/i', self::$path[$ii])==1){
								preg_match('/^[\w]+/i', self::$path[$ii],$value_name);
								preg_match('/(\=)(.*)$/i', self::$path[$ii],$value_value);
								self::$url_argument[$value_name[0]]=$value_value[2];
							}else{
								self::$url_argument[]=self::$path[$ii];
							}
						}
						// var_dump(self::$url_argument);
						break;
					}
				}
				self::$file_path=$test_path;
				break;
		}
		if(file_exists(self::$file_path.'/index.html')){
			self::$file_path=self::$file_path.'/index.html';
		}else if(file_exists(self::$file_path.'.html')){
			self::$file_path=self::$file_path.'.html';
		}else{
			self::$file_path=false;
		}
		/*debug----------------------------*/
		/*debug   end----------------------*/
		return self::$file_path;
	}
	public static function router(){
		self::getPath();
		if(self::$file_path){
			if(file_exists(dirname(dirname(__FILE__)).'/apps/'.self::$path[0].'/action/do.php')){
				include dirname(dirname(__FILE__)).'/apps/'.self::$path[0].'/action/do.php';
			}
			include self::$file_path;
		}else{
			//404
			echo "<h1>404 Error!</h1>";
		}
	}
}
 ?>