//slide 幻灯插件
//author: lizus.com@gmail.com
//url: http://lizus.com
//插件使用:
//需要保持幻灯所在DIV的格式如下:
/*
<div class="vitara_slide_in no-js" id="vitara_slide_homepage" data-img-width="1920" data-img-height="500" data-content-width="1200" data-animate="rightToLeft" data-speed="5000" data-event="click">
	<div class="slide_loading"></div>
	<div class="vitara_slide"><ul>
		<li><a><img src=></a></li>
	</ul></div>
</div>
*/
jQuery.fn.extend({
	slide:function(o){
		o=jQuery.extend({
			imgWidth:jQuery(this).attr('data-img-width')|| 500,//图片最大宽度
			conWidth:jQuery(this).attr('data-content-width')|| 500,//内容最大宽度
			imgHeight:jQuery(this).attr('data-img-height')|| 300,//图片最大高度
			animate:jQuery(this).attr('data-animate')|| 'leftToRight',//动画
			speed:jQuery(this).attr('data-speed')|| 5000,//轮播速度
			e:jQuery(this).attr('data-event')|| 'click',//用于extra是用什么事件触发，选项有hover,click
		}, o || {});
		var w_h=o.imgWidth/o.imgHeight;//图片宽高比
		var c_h=o.conWidth/o.imgHeight;//最少显示内容宽高比
		var that=jQuery(this);
		var s=that.children('.vitara_slide');//真正的轮播区域
		if (s.length<1) return;
		var ul=s.children('ul');
		if (ul.length<1) return;
		var lis=ul.children('li');
		if (lis.length<1) return;
		var imgs=lis.find('img');
		if (imgs.length<1) return;
		firstInit();
		//init();//解决因加载Slide导致页面出现滚动条而宽度不对的问题
		if (lis.length<2) return;//只有一张图的话初始化一下不启动轮播
		var btns=that.children('.slide_btn');
		var es=that.children('.extra').find('li');
		es.eq(0).addClass('current');
		btns.on(o.e,function (){
			lis.stop(true,true);
			var index=lis.index(lis.filter('.current'));
			if (jQuery(this).hasClass('slide_prev')) {
				index=index-1;
				if (index<0) index=lis.length-1;
			}
			if (jQuery(this).hasClass('slide_next')) {
				index=index+1;
				if(index>=lis.length) index=0;
			}
			goTo(index);
		});
		touchEvent.swipeLeft(s[0],function (){
			btns.filter('.slide_next').trigger('click');
		});
		touchEvent.swipeRight(s[0],function (){
			btns.filter('.slide_prev').trigger('click');
		});
		touchEvent.swipeUp(s[0],function (e,y){
			orz.log(y);
			var st=window.pageYOffset
						|| document.documentElement.scrollTop
						|| document.body.scrollTop
						|| 0;
			jQuery(document).scrollTop(st+y);
		});
		touchEvent.swipeDown(s[0],function (e,y){
			orz.log(y);
			var st=window.pageYOffset
						|| document.documentElement.scrollTop
						|| document.body.scrollTop
						|| 0;
			jQuery(document).scrollTop(st+y);
		});
		es.on(o.e,function (){
			lis.stop(true,true);
			var index=es.index(jQuery(this));
			goTo(index);
		});
		var _loop=setInterval(loop,o.speed);
		that.hover(function (){
			lis.stop(true,true);
			clearInterval(_loop);
		},function (){
			lis.stop(true,true);
			_loop=setInterval(loop,o.speed);
		});

		//第一次加载时要做的初始化
		function firstInit(){
			var html='<div class="extra"><ul class="ul_'+imgs.length+'">';
			var i=1;
			imgs.each(function (){
				html+='<li><i class="sign icon-circle-empty"></i><span class="num">'+i+'</span><img src="'+jQuery(this).attr('src')+'" class="thumb" alt="thumb"><span class="title">'+jQuery(this).attr('data-title')+'</span></li>';
				i++;
			});
			html+='</ul></div>';
			that.append(html);
			that.append('<span class="slide_btn slide_prev"><i class="icon-left"></i></span>');
			that.append('<span class="slide_btn slide_next"><i class="icon-right"></i></span>');
			lis.eq(0).addClass('current');
			init();
			that.removeClass('no-js');
			that.find('.slide_loading').hide();
			jQuery(window).on('resize',init);
		}
		//初始化外观,样式
		function init(){
			var w=s.width();
			var btns=that.children('.slide_btn');
			lis.stop(true,true);
			s.height(h());
			lis.width(w);
			lis.height(h());
			imgs.width(w_h*h());
			imgs.height(h());
			imgs.css('margin-left',0-w_h*h()/2);
			switch (o.animate) {
				case 'leftToRight':
					lis.css('float','left');
					ul.width(lis.length*w);
					break;
				case 'rightToLeft':
					lis.css('float','right');
					ul.width(lis.length*w);
					//ul.css('left',(0-(lis.length-1)*w));
					break;
				case 'topToBottom':
					lis.each(function (i){
            ul.append(lis.eq((lis.length-1)-i));
					});
					lis=ul.children('li');
					ul.css('top',0-(lis.length-1)*h());
					break;
				case 'bottomToTop':
				default:
			}
			btns.css({
				'height':h(),
				'line-height':h()+'px'
			});
		}
		//真实使用的高度
		function h(){
			var w=s.width();
			if (w<o.conWidth) {
				return w/c_h;
			}
			if (w>=o.imgWidth) {
				return w/w_h;
			}
			return o.imgHeight;
		}
		//单步动画
		function goTo(eq){
			var obj={};
			switch (o.animate) {
				case 'leftToRight':
					obj={
						'left':0-eq*s.width()
					}
					break;
				case 'rightToLeft':
					obj={
						'left':0-(lis.length-1-eq)*s.width()
					}
					break;
				case 'bottomToTop':
					obj={
						'top':0-eq*h()
					}
					break;
				case 'topToBottom':
					obj={
						'top':0-(lis.length-1-eq)*h()
					}
					break;
				default:

			}
			ul.animate(obj,500,function (){
				lis.removeClass('current');
				lis.eq(eq).addClass('current');
			});
			es.removeClass('current');
			es.eq(eq).addClass('current');
		}
		//循环动画
		function loop(){
			var index=lis.index(lis.filter('.current'));
			index=index+1;
			if(index>=lis.length) index=0;
			goTo(index);
		}
	}
});

//自动加载
jQuery(document).ready(function (){
	jQuery('.vitara_slide_in').each(function(){
		jQuery(this).slide();
	});
});
