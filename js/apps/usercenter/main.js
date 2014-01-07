/*
*User Center脚本
*/
$(function(){
	switch(APP_PAGE){
		case'/register':
			$(document).on('click','#register_submit',function(){
				var mail=$('#input-account').val();
				var name=$('#input-name').val();
				var password=$('#input-password').val();
				var re_password=$('#input-password-repeat').val();
				if(!basic.checkFormat.mail(mail))
				{
					basic.tip('邮箱格式错误，例：bo@moreii.com','danger');
				}else if(!basic.checkFormat.name(name))
				{
					basic.tip('昵称格式错误，应为2个字符以上长度。','danger');
				}else if(!basic.checkFormat.password(password))
				{
					basic.tip('密码应不少于6位。','danger');
				}else if(password!=re_password)
				{
					basic.tip('两次输入密码不一致。','danger');
				}else{
					basic.tip('通讯中...');
					$.ajax({
						type:'POST',
						url:AJAX+'register',
						data:
						{
							mail:mail,
							name:name,
							password1:password,
							password2:re_password
						},
						dataType:'json',
						timeout:1000,
						success:function(data){
							if(data.state=='1'){
								window.location.href=APP_URL+'home';
							}else{
								basic.tip(data.data,'danger');
							}
						},
						error:function(xhr,type){
							basic.tip('服务器通讯错误，请检查您的网络连接并重新提交数据。','danger');
						}
					});
				}
			});
			break;

		default:
		break;
	}
})