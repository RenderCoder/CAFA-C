/*
*for weibo APP
*/
var SITE_URL='http://192.168.1.132/c/weibo/';
var comment_input_box='';
$(function(){
	/*load-data-start*/
	pageMode=$('body').data('mode');
	/*load-data-end*/
	/*动作*/
	$(document).on('click','#do-search',function(){
		$(this).hide();
		$('#search-box').show();
	});
	scroll_90=0;
	/*$(document).on('scroll',function(){
		if($(this).scrollTop()>=0 && scroll_90===0){
			if(pageMode!='sidebar-right'){
				$('#sidebar').css({
					'width':$('#sidebar').width()+30+'px',
					'position':'fixed'
				});
				$('#sidebar-none').show();
			}else{
				$('#sidebar').css({
					'width':$('#sidebar').width()+30+'px',
					'position':'fixed',
					'left':'50%',
					'margin-left':$('#content').width()/4+'px'
				});
			}
			scroll_90=1;
		}else if($(this).scrollTop()>=0 && scroll_90===1){
			//do nothing
		}else{
			$('#sidebar').css({
				'width':'',
				'position':''
			});
			$('#sidebar-none').hide();
			scroll_90=0;
		}
	});*/
	$(document).on('click','.weibo-comment',function(){
		if($(this).data('show')=='0'){
			$(this).parent('.weibo-item-bar').find('div').css({'display':'inline'});
			$(this).parent('.weibo-item-bar').next('.comment-input-box').show().find('.comment-input').focus();
			$(this).parent('.weibo-item-bar').siblings('.comment-list-box').show();
			$(this).data('show','1');
		}else{
			$(this).parent('.weibo-item-bar').find('div').css({'display':''});
			$(this).parent('.weibo-item-bar').next('.comment-input-box').hide().find('.comment-input').focus();
			$(this).parent('.weibo-item-bar').siblings('.comment-list-box').hide();
			$(this).data('show','0');
		}
	});
	$(document).on('click','#more-post-button',function(){
		$('#more-post-box').show();
		$(this).hide();
	});
	$(document).on('click','#more-post-button-hide',function(){
		$('#more-post-box').hide();
		$('#more-post-button').show();
	});
	// 发帖
	$(document).on('click','#group-topost-btn',function(){
		$('#start-box').toggle();
		$('#tieba-title').focus();
	});
});