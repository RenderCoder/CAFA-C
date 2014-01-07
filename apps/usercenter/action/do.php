<?php 
/*
*usercenter
*用户中心
*/
// 定义静态变量
define('APP_NAME', 'usercenter');
define('APP_URL', SITE_URL.APP_NAME.'/');
define('AJAX', APP_URL.'ajax/');
class usercenter extends basic_moudle{
}
$uc=new usercenter();
switch (route::$app_page) {//根据页面执行动作
	case '/index':
		tip('小提示：您现在位于User Center应用下的 "'.route::$app_page.'" 页面。');
		break;

	case 'login':

		break;

	case '/register':
		tip('注册即视为同意我们的相关服务协议。');
		var_dump($uc->checkCellphoneNumberFormat(route::$url_argument[0]));
		break;

	case '/ajax/login':
		// $uc->ajax_result($uc->login('hu@cafa.me','920326'));//test
		$uc->ajax_result($uc->login($uc->get_post('mail'),$uc->get_post('password')));
		break;

	case '/ajax/register':
		// $uc->ajax_result($uc->register('hu@cafa.me','Boooo','920326','920326'));//test
		$uc->ajax_result($uc->register($uc->get_post('mail'),$uc->get_post('name'),$uc->get_post('password1'),$uc->get_post('password2')));
		break;
	
	default:
		# code...
		break;
}
 ?>