var basic=new Object();
basic.checkFormat=new Object();//定义格式检查对象
basic.checkFormat.mail=function(i) 
{
	return /^\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,4}$/.test(i);
}
basic.checkFormat.name=function(i)
{
	return /^[^\'\"]{2,}$/.test(i);
}
basic.checkFormat.password=function(i)
{
	if(String(i).length>=6){return true;}else{return false;}
}
basic.checkFormat.cellphoneNumberFormat=function(i){
	if(String(i).length==11){return true;}else{return false;}
}
basic.tip=function(){
	if(arguments[0]){var content=arguments[0];}else{var content=false;}
	if(arguments[1]){var mode=arguments[1];}else{var mode='success';}
	if(content){
		var html='<div class="alert alert-'+mode+' alert-dismissable tip"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+content+'</div>'
		$('#tipbox').html(html);
	}
}