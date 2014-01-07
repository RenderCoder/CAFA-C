<?php 
/*
*微博类
*/
// 定义静态变量
define('AJAX', SITE_URL.'weibo/ajax/');
define('API', SITE_URL.'weibo/api/');
define('PUBLIC', SITE_URL.'weibo/api/');
define('USER', SITE_URL.'weibo/api/');

class weibo extends basic_moudle{
	function getMixData($start=0,$num=30){
		$start=$start*$num;
	    $sql="SELECT a.id,a.content,a.createtime,a.type,b.name,b.mail FROM ".TABLE_H."weibolist a INNER JOIN ".TABLE_H."user b ON a.uid=b.id WHERE a.state=1 AND b.state=1 LIMIT $start,$num";
		return $this->db->get_results($sql);
	}
}
 ?>