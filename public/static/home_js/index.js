/*
 * 首页js
 */
$(function(){
	
	// 背景随机
	var rand = Math.ceil(Math.random() * 3);
	$('body').css('background','url('+ThinkPHP['IMG']+'/bg'+rand+'.jpg) no-repeat fixed').css('background-size','100%');
	
	// 雪花效果
	$(document).snow();
	
	// 文字效果
	setTimeout(function() {
		$( "header section" ).effect( "bounce", "slow" );
	}, 1000);
	
});