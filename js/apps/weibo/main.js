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
	/*$(document).on('click','#do-search',function(){
		$(this).hide();
		$('#search-box').show();
	});*/
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
	$(document).on('click','.weibo-item',function(){
		var id=$(this).data('id');
		console.log(id);
		if($(this).data('show')=='0'){
			$(this).addClass('weibo-item-left-border-2');
			$(this).parent('.weibo-item-bar').find('.weibo-item-bar-hide').css({'display':'inline'});
			$(this).parent('.weibo-item-bar').find('.weibo-item-bar-show').css({'display':'none'});
			$('#comment-input-box-'+id).show().find('.comment-input').focus();
			$('#comment-list-box-'+id).show();
			$(this).data('show','1');
		}else{
			$(this).removeClass('weibo-item-left-border-2');
			$(this).parent('.weibo-item-bar').find('.weibo-item-bar-hide').css({'display':''});
			$(this).parent('.weibo-item-bar').find('.weibo-item-bar-show').css({'display':''});
			$('#comment-input-box-'+id).hide().find('.comment-input').focus();
			$('#comment-list-box-'+id).hide();
			$(this).data('show','0');
		}
	});
	$(document).on('click','#more-post-button',function(){
		$('#more-post-box').show();
		$(this).hide();
		$('#more-post-button-hide').focus();
	});
	$(document).on('click','#more-post-button-hide',function(){
		$('#more-post-box').hide();
		$('#more-post-button').show();
	});
	// view retweet
	/*$(document).on('click','.weibo-item',function(){
		$.ajax({
			url:'weibo/ajax/sidebar-comment-list',
			timeout:5000,
			dataType:'text',
			success:function(data){
				$('#sidebar-comment-list').html(data).css({
					'top':$(document).scrollTop()-50+'px'
				});
			}
		});
	});*/
	// start-box
	$(document).on('focus','#start-box-textarea',function(){
		$('#post-weibo-btn-box').show();
		$(this).attr({
			'rows':'3'
		});
	});
	$(document).on('blur','#start-box-textarea',function(){
		setTimeout(function(){hideStartboxBtn()},200);
	});
	function hideStartboxBtn(){
		var focus = $(document.activeElement);
		if(!focus.hasClass('start-box-btn')){
			if($('#start-box-textarea').val()==''){
				$('#post-weibo-btn-box').hide();
				$('#start-box-textarea').attr({
					'rows':'2'
				});
			}
		}
	}
	$.ajax({
		url:'ajax/message-tip',
		success:function(data){
			$('.message-tip').remove();
			$('body').append(data);
		}
	})
	$('.weibo-retweet').on('click',function(){
		event.stopPropagation();
	})
	$('.comment-reponse').on('click',function(){
		$('#comment-input-box-'+$(this).data('id')+' .comment-input').val('@用户XXX：');
		$('#comment-input-box-'+$(this).data('id')+' .comment-input').focus();
	});
});