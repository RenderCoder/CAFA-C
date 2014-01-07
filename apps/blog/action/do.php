<?php 
/*
*博客类
*/
switch (route::$app_page) {//根据页面执行动作
	case '/index':
		tip('小提示：您现在位于Blog应用下的 "'.route::$app_page.'" 页面。');
		break;
	
	default:
		# code...
		break;
}
 ?>