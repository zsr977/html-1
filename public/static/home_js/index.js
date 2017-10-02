/*
 * 首页js
 */
$(function(){
	
	// 背景随机
	var rand = Math.ceil(Math.random() * 3);
	$('body').css('background','url('+ThinkPHP['IMG']+'/bg'+rand+'.jpg) no-repeat fixed').css('background-size','100%');
	
	// 雪花效果
	$(document).snow();
	
	//自动隐藏/展开顶部
	$(window).scroll(function(){
		var h=$(document).scrollTop();
		if (h > 20 && h<200 ) {
			$(document).scrollTop(380)
			$('#info').css("margin-top","100px");
			$('#content').css("margin-top","100px");
		} else if(h >=200 && h<380 ) {
			$(document).scrollTop(0);
			$('#info').css("margin-top","20px");
			$('#content').css("margin-top","20px");
		}
	});
	
	// 文字效果
	setTimeout(function() {
		$( "header section").children("p").eq(0).css("display","block").lbyl({
			content: "岁月难得沉默　秋风厌倦漂泊　　",
		    speed: 250,
		    type: 'show', 
		    finished: function() {
		    	$( "header section").children("p").eq(1).css("display","block").lbyl({
					content: "夕阳赖着不走　挂在墙头　舍不得我　　　",
				    speed: 250,
				    type: 'show', 
				    finished: function() {
				    	$( "header section").children("p").eq(2).css("display","block").lbyl({
							content: "壮志凌云几分愁　知己难逢几人留　　",
						    speed: 250,
						    type: 'show', 
						    finished: function() {
						    	$( "header section").children("p").eq(3).css("display","block").lbyl({
									content: "再回首　却闻笑传醉梦中　　　　　",
								    speed: 250,
								    type: 'show', 
								    finished: function() {
								    	$( "header section").children("p").eq(4).css("display","block").lbyl({
											content: "笑叹词穷古痴今狂终成空　刀钝刃乏恩断义绝梦方破　　",
										    speed: 250,
										    type: 'show', 
										    finished: function() {
										    	$( "header section").children("p").eq(5).css("display","block").lbyl({
													content: "路荒已叹饱览足迹没人懂　多年望眼欲穿过红尘滚滚　我没看透　　　　",
												    speed: 250,
												    type: 'show', 
												    finished: function() {
												    	$( "header section").children("p").eq(6).css("display","block").lbyl({
															content: "自嘲墨尽千情万怨英杰愁　曲终人散发花鬓白红颜殁　　",
														    speed: 250,
														    type: 'show', 
														    finished: function() {
														    	$( "header section").children("p").eq(7).css("display","block").lbyl({
																	content: "烛残未觉与日争辉图消瘦　当泪干血盈眶涌白雪纷飞　都成空",
																    speed: 250,
																    type: 'show', 
																});
														    }
														});
												    }
												});
										    }
										});
								    }
								});
						    }
						});
				    }
				});
		    }
		});
	}, 1000);
	
	//微信打赏
	$("#thank ul").children("li").eq(0).click(function(){
		$("#thank img").attr("src",ThinkPHP['IMG']+"/1.jpg");
	});
	$("#thank ul").children("li").eq(1).click(function(){
		$("#thank img").attr("src",ThinkPHP['IMG']+"/2.jpg");
	});
	$("#thank ul").children("li").eq(2).click(function(){
		$("#thank img").attr("src",ThinkPHP['IMG']+"/5.jpg");
	});
	$("#thank ul").children("li").eq(3).click(function(){
		$("#thank img").attr("src",ThinkPHP['IMG']+"/10.jpg");
	});
});