<?php 
define('SITE_NAME', 'Demo');
define('SITE_DOMAIN', $_SERVER['HTTP_HOST']);
define('SITE_URL', 'http://'.SITE_DOMAIN.'/c/');
define('JS', SITE_URL.'js/');
define('CSS', SITE_URL.'css/');
define('IMG', SITE_URL.'img/');
define('TABLE_H', 'c_');//表头
/*mysql info*/
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PWD', '920326');
define('MYSQL_DATABASE', 'cafa-c');
/*server type*/
define('SERVER_TYPE', 'linux');
$GLOBALS['title'] = '';
$GLOBALS['tip'] = '';
class basic{
	var $db;
	function __construct(){
		$this->db=new ezSQL_mysql(MYSQL_USER,MYSQL_PWD,MYSQL_DATABASE,MYSQL_HOST);
	}
	function q_text($start=0,$num=10){
		return $this->db->get_results("SELECT * FROM text LIMIT $start,$num");
	}
}
include 'class/display.php';
 ?>