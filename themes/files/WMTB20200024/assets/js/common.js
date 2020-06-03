/**

 * Created by Administrator on 2017/3/9 0009.

 */

(function($){
// windows size
	var mouseover_tid = [];
	var mouseout_tid = [];
	var winWidth = 0;
	var winHeight = 0;
	function winSize(){
		if (window.innerWidth)
			winWidth = window.innerWidth;
		else if ((document.body) && (document.body.clientWidth))
			winWidth = document.body.clientWidth;
		if (window.innerHeight)
			winHeight = window.innerHeight;
		else if ((document.body) && (document.body.clientHeight))
			winHeight = document.body.clientHeight;
		if (document.documentElement  && document.documentElement.clientHeight && document.documentElement.clientWidth)
		{
			winHeight = document.documentElement.clientHeight;
			winWidth = document.documentElement.clientWidth;
		}
		if(winWidth<769){
			if($('.mobile-head-items').length<1 && $('.mobile-nav-items').length<1 && $('.mobile-cart-items').length<1){
				var mobileService='<div class="mobile-head-items"><div class="mobile-head-item mobile-head-home"><div class="title"><a href="/"></a></div></div><div class="mobile-head-item mobile-head-nav"><div class="title"></div><div class="main-content-wrap side-content-wrap"><div class="content-wrap"></div></div></div><div class="mobile-head-item mobile-head-language"><div class="title"></div><div class="main-content-wrap side-content-wrap"><div class="content-wrap"></div></div></div><div class="mobile-head-item mobile-head-search"><div class="title"></div><div class="main-content-wrap middle-content-wrap"><div class="content-wrap"></div></div></div><div class="mobile-head-item mobile-head-social"><div class="title"></div><div class="main-content-wrap middle-content-wrap"><div class="content-wrap"></div></div></div></div>'
				$('.head-wrapper').append(mobileService)
				if($('body .aside').length>0){
					$('.mobile-head-items').append('<div class="mobile-head-item mobile-head-aside"><div class="title"></div><div class="main-content-wrap side-content-wrap"><div class="content-wrap"></div></div></div>')
				}

				// if($('.mobile-contact').length<1 && $('.head-contact').length>0){
				// 	var mobileContact='<div class="mobile-contact"></div>'
				// 	$('body').append(mobileContact)
				// }

				// mobileTabContainer('.tab-content-wrap','.tab-title','.tab-panel','span','.tab-panel-content')

				$('.mobile-head-item').each(function(){
					$(this).find('.title').click(function(){
						if($(this).parents('.mobile-head-item').find('.main-content-wrap').length>0){
							var pItem=$(this).parents('.mobile-head-item')
							if(!pItem.find('.main-content-wrap').hasClass('show-content-wrap')){
								pItem.find('.main-content-wrap').addClass('show-content-wrap')
								pItem.find('.side-content-wrap').stop().animate({'left':'0'},300)
								pItem.find('.middle-content-wrap').addClass('middle-show-content-wrap')
								pItem.find('.side-content-wrap').append("<b class='mobile-ico-close'></b>")
								pItem.siblings('.mobile-head-item').find('.main-content-wrap').removeClass('show-content-wrap')
								pItem.siblings('.mobile-head-item').find('.side-content-wrap').stop().animate({'left':'-70%'},300)
								pItem.siblings('.mobile-head-item').find('.middle-content-wrap').removeClass('middle-show-content-wrap')
								pItem.siblings('.mobile-head-item').find('.side-content-wrap .mobile-ico-close').remove()
								if($('.container').find('.mobile-body-mask').length<1){
									$('.container').append('<div class="mobile-body-mask"></div>')
								}
							}else{
								pItem.find('.main-content-wrap').removeClass('show-content-wrap')
								pItem.find('.side-content-wrap').stop().animate({'left':'-70%'},300)
								pItem.find('.middle-content-wrap').removeClass('middle-show-content-wrap')
								pItem.find('.side-content-wrap .mobile-ico-close').remove()
							}
							
							$('.mobile-body-mask').click(function(){
								$('.mobile-body-mask').remove()
								$('.mobile-head-item .main-content-wrap').removeClass('show-content-wrap')
								$('.mobile-head-item .side-content-wrap').animate({'left':'-70%'},300)
								$('.mobile-head-item .middle-content-wrap').removeClass('middle-show-content-wrap')
								$('.mobile-head-item .side-content-wrap .mobile-ico-close').remove()
							})

							$('.mobile-ico-close').click(function(){
								$('.mobile-body-mask').remove()
								$('.mobile-head-item .main-content-wrap').removeClass('show-content-wrap')
								$('.mobile-head-item .side-content-wrap').stop().animate({'left':'-70%'},300)
								$('.mobile-head-item .middle-content-wrap').removeClass('middle-show-content-wrap')
								$('.mobile-head-item .side-content-wrap .mobile-ico-close').remove()
							})

							//侧边栏
							$('.mobile-head-items .nav>li.arrow').click(function(){
								$('.mobile-head-items .nav>li.arrow').toggleClass('on');
								$('.mobile-head-items .nav>li.arrow .subnav').slideToggle();
							})
						}
					})
				})

				$('.change-language .change-language-cont ').clone().appendTo('.mobile-head-item.mobile-head-language .main-content-wrap .content-wrap')
				$('.head-search ').clone().appendTo('.mobile-head-item.mobile-head-search .main-content-wrap .content-wrap')
				$('.nav-bar .nav').clone().appendTo('.mobile-head-item.mobile-head-nav .main-content-wrap .content-wrap')
				$('.foot-social').clone().appendTo('.mobile-head-item.mobile-head-social .main-content-wrap .content-wrap')
				$('.aside .aside-wrap').clone().appendTo('.mobile-head-item.mobile-head-aside .main-content-wrap .content-wrap')
				$('.head-contact').clone().appendTo('.mobile-contact')

				////////////////////////////////////////////////手机下的侧边栏产品滚动
				$('.products-scroll-list').each(function(){
					if($(this).find('li').length>1){
						$(".products-scroll-list").jCarouselLite({
							btnPrev: ".products-scroll-btn-prev",
							btnNext: ".products-scroll-btn-next",
							speed:100,
							auto:false,
							scroll:1,
							visible:5,
							vertical:true,
							circular:false,
							onMouse:true
						});
					}
				})
				////////////////////////////////////////////////手机下的侧边栏产品滚动 end
			}

			$(document).ready(function(){
				$('#rev_slider_3_1 ul li').each(function(index){
					if((index+1)%2==0){
						$(this).removeClass('evenItem')
						$(this).find('.tp-caption.itemImg').addClass('lfb').removeClass('lft').attr('data-x','700')
						$(this).find('.tp-caption.itemTitle').attr('data-x','0')
						$(this).find('.tp-caption.itemDetail').addClass('lfl').removeClass('lfr').attr('data-x','0')
						$(this).find('.tp-caption.itemMore').attr('data-x','0')
					}
				})
			})
		}
		//mobile end
		else{

			$(document).ready(function(){
				$('.mobile-body-mask').remove()
				$('.mobile-head-items,.mobile-nav-items,.mobile-cart-items,.mobile-tab-items').remove()
				//nav
				$('.nav li').each(function(index){
					if($(this).children('ul').length>0){
						$(this).append("<div class='nav-ico'></div>")
						$(this).hover(
							function(){
								var _self = this;

								clearTimeout(mouseout_tid[index]);

								mouseover_tid[index] = setTimeout(function() {
									$(_self).children('ul').fadeIn();
								}, 50);
							},

							function(){
								var _self = this;
								clearTimeout(mouseover_tid[index]);
								mouseout_tid[index] = setTimeout(function() {
									$(_self).children('ul').fadeOut();
								}, 50);
							}
						);
					}
				})

				skrollr.init({
					forceHeight: false,
					smoothScrolling: true,
					easing: 'swing',
					forceHeight: false
				});

				$('.synopsis-item').each(function(){
					$('.synopsis-item').eq(1).addClass('current')
					$(this).hover(function(){
						$(this).addClass('current').siblings().removeClass('current')
					})
				})
			});

			$(document).ready(function(){
				$('.products-scroll-list').each(function(){
					if($(this).find('li').length>1){
						$(".products-scroll-list").jCarouselLite({
							btnPrev: ".products-scroll-btn-prev",
							btnNext: ".products-scroll-btn-next",
							speed:100,
							auto:false,
							scroll:1,
							visible:5,
							vertical:true,
							circular:false,
							onMouse:true
						});
					}
				})
			})

		}

	}

	$(function(){
		winSize();
	})

	$(window).resize(function() {
		winSize();
	});
})(jQuery);

$.fn.kxbdMarquee = function(options){
	var opts = $.extend({},$.fn.kxbdMarquee.defaults, options);
	return this.each(function(){
		var $marquee = $(this);
		var _scrollObj = $marquee.get(0);
		var scrollW = $marquee.width();
		var scrollH = $marquee.height();
		var $element = $marquee.children();
		var $kids = $element.children();
		var scrollSize=0;
		var _type = (opts.direction == 'left' || opts.direction == 'right') ? 1:0;
		$element.css(_type?'width':'height',10000);
		if (opts.isEqual) {
			scrollSize = $kids[_type?'outerWidth':'outerHeight']() * $kids.length;
		}else{
			$kids.each(function(){
				scrollSize += $(this)[_type?'outerWidth':'outerHeight']();
			});
		}
		if (scrollSize<(_type?scrollW:scrollH)) return;
		$element.append($kids.clone()).css(_type?'width':'height',scrollSize*2);
		var numMoved = 0;
		function scrollFunc(){
			var _dir = (opts.direction == 'left' || opts.direction == 'right') ? 'scrollLeft':'scrollTop';
			if (opts.loop > 0) {
				numMoved+=opts.scrollAmount;
				if(numMoved>scrollSize*opts.loop){
					_scrollObj[_dir] = 0;
					return clearInterval(moveId);
				}
			}

			if(opts.direction == 'left' || opts.direction == 'up'){

				_scrollObj[_dir] +=opts.scrollAmount;

				if(_scrollObj[_dir]>=scrollSize){

					_scrollObj[_dir] = 0;

				}

			}else{

				_scrollObj[_dir] -=opts.scrollAmount;

				if(_scrollObj[_dir]<=0){

					_scrollObj[_dir] = scrollSize;

				}

			}

		}

		var moveId = setInterval(scrollFunc, opts.scrollDelay);

		$marquee.hover(

			function(){

				clearInterval(moveId);

			},

			function(){

				clearInterval(moveId);

				moveId = setInterval(scrollFunc, opts.scrollDelay);

			}

		);

	});

};

$.fn.kxbdMarquee.defaults = {

	isEqual:true,

	loop: 0,

	direction: 'left',

	scrollAmount:1,

	scrollDelay:20



};

$.fn.kxbdMarquee.setDefaults = function(settings) {

	$.extend( $.fn.kxbdMarquee.defaults, settings );

};





//scroll

(function($){$.fn.jCarouselLite=function(o){o=$.extend({btnPrev:null,btnNext:null,btnGo:null,mouseWheel:false,onMouse: false,auto:null,speed:500,easing:null,vertical:false,circular:true,visible:4,start:0,scroll:1,beforeStart:null,afterEnd:null},o||{});return this.each(function(){var b=false,animCss=o.vertical?"top":"left",sizeCss=o.vertical?"height":"width";var c=$(this),ul=$("ul",c),tLi=$("li",ul),tl=tLi.size(),v=o.visible;var TimeID=0;if(o.circular){ul.prepend(tLi.slice(tl-v-1+1).clone()).append(tLi.slice(0,v).clone());o.start+=v}var f=$("li",ul),itemLength=f.size(),curr=o.start;c.css("visibility","visible");f.css({overflow:"",float:o.vertical?"none":"left"});ul.css({position:"relative","list-style-type":"none","z-index":"1"});c.css({overflow:"hidden",position:"relative","z-index":"2",left:"0px"});var g=o.vertical?height(f):width(f);var h=g*itemLength;var j=g*v;f.css({width:f.width(),height:f.height()});ul.css(sizeCss,h+"px").css(animCss,-(curr*g));c.css(sizeCss,j+"px");if(o.btnPrev)$(o.btnPrev).click(function(){return go(curr-o.scroll)});if(o.btnNext)$(o.btnNext).click(function(){return go(curr+o.scroll)});if(o.btnGo)$.each(o.btnGo,function(i,a){$(a).click(function(){return go(o.circular?o.visible+i:i)})});if(o.mouseWheel&&c.mousewheel)c.mousewheel(function(e,d){return d>0?go(curr-o.scroll):go(curr+o.scroll)});if (o.auto)		TimeID=setInterval(function(){	go(curr + o.scroll);},o.auto+o.speed);if(o.onMouse){ul.bind("mouseover",function(){if(o.auto){clearInterval(TimeID);}}),ul.bind("mouseout",function(){if(o.auto){TimeID=setInterval(function(){go(curr+o.scroll);},o.auto+o.speed);}})}function vis(){return f.slice(curr).slice(0,v)};function go(a){if(!b){if(o.beforeStart)o.beforeStart.call(this,vis());if(o.circular){if(a<=o.start-v-1){ul.css(animCss,-((itemLength-(v*2))*g)+"px");curr=a==o.start-v-1?itemLength-(v*2)-1:itemLength-(v*2)-o.scroll}else if(a>=itemLength-v+1){ul.css(animCss,-((v)*g)+"px");curr=a==itemLength-v+1?v+1:v+o.scroll}else curr=a}else{if(a<0||a>itemLength-v)return;else curr=a}b=true;ul.animate(animCss=="left"?{left:-(curr*g)}:{top:-(curr*g)},o.speed,o.easing,function(){if(o.afterEnd)o.afterEnd.call(this,vis());b=false});if(!o.circular){$(o.btnPrev+","+o.btnNext).removeClass("disabled");$((curr-o.scroll<0&&o.btnPrev)||(curr+o.scroll>itemLength-v&&o.btnNext)||[]).addClass("disabled")}}return false}})};function css(a,b){return parseInt($.css(a[0],b))||0};function width(a){return a[0].offsetWidth+css(a,'marginLeft')+css(a,'marginRight')};function height(a){return a[0].offsetHeight+css(a,'marginTop')+css(a,'marginBottom')}})(jQuery);













$(function(){

	var mHeadTop=$('.topbar').offset().top



	var $backToTopTxt="", $backToTopEle = $('<span class="gotop"></span>').appendTo($("body"))



		.text($backToTopTxt).attr("title", $backToTopTxt).click(function() {



			$("html, body").animate({ scrollTop:0 }, 300);







		}), $backToTopFun = function() {



		var st = $(document).scrollTop(), winh = $(window).height();



		(st > mHeadTop)? $backToTopEle.show(): $backToTopEle.hide();



		if (!window.XMLHttpRequest) {



			$backToTopEle.css("top", st + winh - 210);



		}







	};



	$(window).bind("scroll", $backToTopFun);



	$(function() { $backToTopFun();});



	var $nav = $('.nav-bar'), navTop = $nav.offset().top, navH = $nav.outerHeight(),winTop_1=0,winWidth=$(window).width(), holder=jQuery('<div>');

	$(window).on('scroll',function(){

		var winTop_2 = $(window).scrollTop();

		holder.css('height',navH);



		if(winTop_2>navTop && winWidth>980){

			holder.show().insertBefore($nav);

			$nav.addClass('fixed-nav');

		}else{

			holder.hide();

			$nav.removeClass('fixed-nav');

		}



		if(winTop_2>winTop_1 && winWidth>980){

			$nav.removeClass('fixed-nav-appear');

		}else if(winTop_2<winTop_1){

			$nav.addClass('fixed-nav-appear');

		}

		winTop_1 = $(window).scrollTop();

	})



//tab

	tabContainer('.tab-content-wrap','.tab-title','.tab-panel')

});









$(document).ready(function(){

	/*var sum=0

	 $('.nav-bar .nav').children('li').each(function(index){

	 sum+=$(this).width();

	 if(sum>500){

	 $(this).hide()

	 }

	 })

	 */

$('.side-widget .side-cate li').each(function(){



if($(this).find('ul').length>0){

 

			$(this).append("<span class='side-ico icon-cate-down'></span>")



			$(this).children('.side-ico').click(function(e){



							if($(this).parent('li').children('ul').is(':hidden')){



								$(this).parent('li').children('ul').slideDown(100);



									$(this).removeClass('icon-cate-down').addClass('icon-cate-up');



								}else{



									$(this).parent('li').children('ul').slideUp(100);



									$(this).removeClass('icon-cate-up').addClass('icon-cate-down');



									}



									e.stopPropagation();



							})



			



			}



		})

		if($('.side-widget .side-cate .nav-current').parents('ul').length>0 && $('.side-widget .side-cate .nav-current').find('ul').length>0) {

		$('.side-widget .side-cate .nav-current').parents('ul').show()

		$('.side-widget .side-cate .nav-current').children('ul').show()

		$('.side-widget .side-cate .nav-current ').children('.side-ico').removeClass('icon-cate-down').addClass('icon-cate-up');

		}

		 else if($('.side-widget .side-cate .nav-current').parents('ul').length>0 && $('.side-widget .side-cate .nav-current').find('ul').length<1){

			 $('.side-widget .side-cate .nav-current').parents('ul').show()

			}

		 else if($('.side-widget .side-cate .nav-current').parents('ul').length<1 && $('.side-widget .side-cate .nav-current').find('ul').length>0){

			$('.side-widget .side-cate .nav-current').children('ul').show()

			$('.side-widget .side-cate .nav-current').children('.side-ico').removeClass('icon-cate-down').addClass('icon-cate-up');

			}



	

	

	

	$('.faq-list li').each(function(){

		if($(this).find('.faq-cont').length>0){

			$(this).find('.faq-title b').addClass('faq-up')

			$(this).find('.faq-title').click(function(){

				if($(this).parent('li').find('.faq-cont').is(':hidden')){

					$(this).parent('li').find('.faq-cont').slideDown();

					$(this).find('b').removeClass('faq-down')

					$(this).find('b').addClass('faq-up')

				}else{

					$(this).parent('li').find('.faq-cont').slideUp();

					$(this).find('b').removeClass('faq-up')

					$(this).find('b').addClass('faq-down')

				}

			})

		}

	})



	$('.trusted-partners-wrap ul,.nav-bar ul,.product-list ul,.certificate-list ul,.video-list ul,.products-scroll-list ul,.gm-sep,.main-product-wrap .product-item').contents().filter(function() {

		return this.nodeType === 3;

	}).remove();



	containerItems('.main-product-wrap','.product-items-slide',4,'.product-wrap','.container-item')



	$('.news-slides').owlCarousel({

		autoplay:true,

		loop:true,

		margin:0,

		autoplayTimeout:30000,

		smartSpeed:180,

		lazyLoad:true,

		dots: true,

		nav: false,

		items:1,

		slideBy:1,

	});







	if($('.image-additional ul li').length>1){

		$('.image-additional ul').owlCarousel({

			autoplay:false,

			loop:false,

			margin:0,

			autoplayTimeout:30000,

			smartSpeed:180,

			lazyLoad:true,

			mouseDrag:true,

			slideBy:1,

			responsive: {

				0: {

					nav: false,

					dots: true,

					items:1,

				},

				769: {

					nav: true,

					dots: false,

					items:3,





				}

			}

		});

	}

	else{

		$('.image-additional ul li').addClass('single')

	}

	$('.product-slides').owlCarousel({

		autoplay:true,

		loop:true,

		margin:0,

		dots:  true,

		autoplayTimeout:30000,

		smartSpeed:180,

		lazyLoad:true,



		responsive: {

			0: {

				dots: true,

				nav: false,

				items:2,

				slideBy:2

			},

			641: {

				dots: true,

				nav: false,

				items:3,

				slideBy:3



			},

			769: {

				dots: false,

				nav:  true,

				items:4,

				slideBy:4,

			}

		}



	});

	$('.goods-items').owlCarousel({

		autoplay:true,

		loop:true,

		margin:0,

		dots:  true,

		autoplayTimeout:30000,

		smartSpeed:180,

		lazyLoad:true,



		responsive: {

			0: {

				dots: true,

				nav: false,

				items:2,

				slideBy:2

			},

			641: {

				dots: true,

				nav: false,

				items:3,

				slideBy:3



			},

			769: {

				dots: false,

				nav:  true,

				items:3,

				slideBy:3,

			}

		}



	});

$('.blog-slides ul').owlCarousel({

					autoplay:true,

					loop:true,

					margin:0,

					dots:  true,

					nav: false,

					autoplayTimeout:30000,

					smartSpeed:180,

					lazyLoad:true,

					responsive: {

	                  0: {

						items:1,

						slideBy:1,

						dots:  true,

						nav: false

	                  },

	                  768: {

						items:1,

						slideBy:1,

						mouseDrag:false,

						dots:  true,

						nav: false

	                  }

	                }

				});

	$(".about-img").flexslider({

		animation:"fade",

		direction:"horizontal",

		animationLoop:true,

		slideshow:true,

		slideshowSpeed:7000,

		animationSpeed: 600,

		directionNav:false,

		controlNav:true,

		touch: true

	});





	/*$('.detail-panel,.main-product-item').find('img').parents('a').addClass('lightbox')

	 $('.lightbox,.pd-inq a').lightbox();*/

	$('.entry').find('img').parents('a').addClass('fancybox')

	$("a.fancybox").fancybox();





	// $('.inquiry-form .form-item').each(function(index){
	// 	$(this).addClass('form-item'+(index+1))
	// })

	// var demo = $(".pd-inquiry-form,.ct-inquiry-form,.index-inquiry-form-wrap").Validform({
	// 	tiptype : 3,
	// 	showAllError : true,
	// 	ajaxPost : false
	// });
	// demo.addRule([
	// 	{
	// 		ele : "input.form-input-email",
	// 		datatype : "e",
	// 		nullmsg:"Please enter a valid email address",
	// 		errormsg:"Please enter a valid email address"
	// 	}, {
	// 		ele : "input.form-input-name",
	// 		datatype : "*1-200",
	// 		nullmsg:"Please enter a valid user name",
	// 		errormsg:"Please enter a valid user name"
	// }])

	////////////////////表单验证 start //////////////////////////////
	/*邮件追踪*/
    var product_website = window.location.search;
    if (product_website.indexOf('uid') < 0 || product_website.indexOf('pid') < 0) {
    } else {
        var product_website = window.location.search;
        var aop_param = {};
        var regu = new RegExp("(^|&)"+ "uid" +"=([^&]*)(&|$)");
        var u = product_website.substr(1).match(regu);
        var regp = new RegExp("(^|&)"+ "pid" +"=([^&]*)(&|$)");
        var p = product_website.substr(1).match(regp);
        aop_param.uid = unescape(u[2]);
        aop_param.pid = unescape(p[2]);
        $.ajax({
            url: "//tonpal.aiyongbao.com/email/emailProductTrack",
            dataType: 'jsonp',
            type: 'GET',
            data: aop_param,
            timeout: 60000,
            success: function(rsp){
                return;
            },
            error: function(rsp){
                return;
            }
        });
    }
    
    /*表单验证1 start*/
    if($("#contact-form").length>0) {
        $("#contact-form").validate({
	        submitHandler: function(form) {
		        $('#customer_submit_button').prop({'disabled': true, 'value': 'Loading...'}).addClass("disabled btn-success");
		        var aop_param = {};
		            aop_param.product_title = ((typeof(form.product_title.value) == "undefined")?'':form.product_title.value);
		            aop_param.contact_name = form.name.value;
		            aop_param.contact_email = form.email.value;
		            aop_param.contact_subject = form.phone.value;
		            aop_param.contact_comment = form.message.value;
		            aop_param.organization_id = form.organization_id.value;
		            if(location.href.indexOf('?')>-1){
		                aop_param.reference = location.href.split('?')[0];
		            }else{
		                aop_param.reference = location.href;
		            }
	            $.ajax({
	                url:"//tonpal.aiyongbao.com/action/savemessage",
	                dataType: 'jsonp',
	                type:'GET',
	                data: aop_param,
	                success : function(rsp){
			            $("#MessageSent").show();
			            $("#MessageNotSent").hide();
			            $("#customer_submit_button").addClass("btn-success").prop('value', 'Message Sent');
			            // $("#contact-form .form-control").each(function() {
			            //   $(this).prop('value', '').parent().removeClass("has-success").removeClass("has-error");
			            // });
			            setTimeout(function(){
			              $("#MessageSent").hide();
			              $("#customer_submit_button").removeClass("disabled btn-success").prop({'disabled': false, 'value': 'Send Message'});
			            }, 2000);
	                },
	                error: function(rsp, textStatus, errorThrown){
			            $("#MessageNotSent").show();
			            $("#MessageSent").hide();
			            setTimeout(function(){
			              $("#MessageNotSent").hide();
			              $("#customer_submit_button").removeClass("disabled btn-success").prop({'disabled': false, 'value': 'Send Message'});
			            }, 2000);
	                }
	            });
	    	},
		    errorPlacement: function(error, element) {
		        element.after( error );
		    },
		    onkeyup: false,
		    onclick: false,
		    rules: {
		        name: {
		          required: true,
		          minlength: 2
		        },
		        email: {
		          required: true,
		          email: true
		        },
		        subject: {
		          required: true
		        },
		        message: {
		          required: true,
		          minlength: 10
		        }
		    },
		    messages: {
		        name: {
		          required: "Please specify your name",
		          minlength: "Your name must be longer than 2 characters"
		        },
		        email: {
		          required: "We need your email address to contact you",
		          email: "Please enter a valid email address e.g. name@domain.com"
		        },
		        subject: {
		          required: "Please enter a subject"
		        },
		        message: {
		          required: "Please enter a message",
		          minlength: "Your message must be longer than 10 characters"
		        }
		    },
		    errorElement: "span",
		    highlight: function (element) {
		        $(element).parent().removeClass("has-success").addClass("has-error");
		        // $(element).siblings("label").addClass("hide");
		    },
		    success: function (element) {
		        $(element).parent().removeClass("has-error").addClass("has-success");
		        // $(element).siblings("label").removeClass("hide");
		    }
    	});
    }
    /*表单验证1 end*/

    /*表单验证2 start*/
    if($("#contact-form2").length>0) {
        $("#contact-form2").validate({
	        submitHandler: function(form) {
		        $('#customer_submit_button2').prop({'disabled': true, 'value': 'Loading...'}).addClass("disabled btn-success");
		        var aop_param = {};
		            aop_param.product_title = ((typeof(form.product_title2.value) == "undefined")?'':form.product_title2.value);
		            aop_param.contact_name = form.name2.value;
		            aop_param.contact_email = form.email2.value;
		            aop_param.contact_subject = form.phone2.value;
		            aop_param.contact_comment = form.message2.value;
		            aop_param.organization_id = form.organization_id2.value;
		            if(location.href.indexOf('?')>-1){
		                aop_param.reference = location.href.split('?')[0];
		            }else{
		                aop_param.reference = location.href;
		            }
	            $.ajax({
	                url:"//tonpal.aiyongbao.com/action/savemessage",
	                dataType: 'jsonp',
	                type:'GET',
	                data: aop_param,
	                success : function(rsp){
			            $("#MessageSent2").show();
			            $("#MessageNotSent2").hide();
			            $("#customer_submit_button2").addClass("btn-success").prop('value', 'Message Sent');
			            // $("#contact-form .form-control").each(function() {
			            //   $(this).prop('value', '').parent().removeClass("has-success").removeClass("has-error");
			            // });
			            setTimeout(function(){
			              $("#MessageSent2").hide();
			              $("#customer_submit_button2").removeClass("disabled btn-success").prop({'disabled': false, 'value': 'Send Message'});
			            }, 2000);
	                },
	                error: function(rsp, textStatus, errorThrown){
			            $("#MessageNotSent2").show();
			            $("#MessageSent2").hide();
			            setTimeout(function(){
			              $("#MessageNotSent2").hide();
			              $("#customer_submit_button2").removeClass("disabled btn-success").prop({'disabled': false, 'value': 'Send Message'});
			            }, 2000);
	                }
	            });
	    	},
		    errorPlacement: function(error, element) {
		        element.after( error );
		    },
		    onkeyup: false,
		    onclick: false,
		    rules: {
		        name2: {
		          required: true,
		          minlength: 2
		        },
		        email2: {
		          required: true,
		          email: true
		        },
		        subject2: {
		          required: true
		        },
		        message2: {
		          required: true,
		          minlength: 10
		        }
		    },
		    messages: {
		        name2: {
		          required: "Please specify your name",
		          minlength: "Your name must be longer than 2 characters"
		        },
		        email2: {
		          required: "We need your email address to contact you",
		          email: "Please enter a valid email address e.g. name@domain.com"
		        },
		        subject2: {
		          required: "Please enter a subject"
		        },
		        message2: {
		          required: "Please enter a message",
		          minlength: "Your message must be longer than 10 characters"
		        }
		    },
		    errorElement: "span",
		    highlight: function (element) {
		        $(element).parent().removeClass("has-success").addClass("has-error");
		        // $(element).siblings("label").addClass("hide");
		    },
		    success: function (element) {
		        $(element).parent().removeClass("has-error").addClass("has-success");
		        // $(element).siblings("label").removeClass("hide");
		    }
    	});
    }
    /*表单验证2 end*/

    /*单独发送邮箱给后台*/
    if($("#contact-email-form").length>0){
        $("#email-submit").click(function(){
            var email=$(".contact-email-info").val();
            var emailReg=/^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
            if(emailReg.test(email)){
                var email_account=email.split('@')[0];
                var organization_id=$("#single-email-organization").val();
                $.ajax({
                    url:"//tonpal.aiyongbao.com/action/savemessage",
                    dataType:"jsonp",
                    type:"post",
                    data:{contact_email:email,contact_name:email_account,product_title:"NULL",contact_subject:"",contact_comment:"please connect me soon",organization_id:organization_id,reference:"NULL"},
                    success:function(){
                        $("#MessageSent2").removeClass("hidden");
                        $("#MessageNotSent2").addClass("hidden");
                        $("#email-submit").addClass("btn-success").prop('value', 'Message Sent');
                        $("#contact-email-form .form-control").each(function() {
                            $(this).prop('value', '').parent().removeClass("has-success").removeClass("has-error");
                        });
                        setTimeout(function(){
                            $("#MessageSent2").addClass("hidden");
                        }, 2000);
                    },
                    error:function(){
                        $("#MessageNotSent2").html('Oops! Something went wrong please refresh the page and try again.').removeClass("hidden");
                        $("#MessageSent2").addClass("hidden");
                        setTimeout(function(){
                            $("#MessageNotSent2").addClass("hidden");
                        }, 2000);
                    }
                })
            }else{
              $("#MessageNotSent2").html('please input a correct email account').removeClass("hidden");
              $("#MessageSent2").addClass("hidden");
              setTimeout(function(){
                  $("#MessageNotSent2").addClass("hidden");
              }, 2000);
            }
        })
    }
	///////////////////表单验证 end  ///////////////////////////////

})



function tabContainer(container,title,panel){

	$(container).each(function(){

		$(this).find(title).each(function(){

			if($(this).hasClass('current')){

				j=$(this).index();

				$(this).parents(container).find(panel).eq(j).removeClass('disabled')

			}

			$(this).click(function(){

				i=$(this).index();

				$(this).addClass('current').siblings().removeClass('current');

				$(this).parents(container).find(panel).eq(i).show();

				$(this).parents(container).find(panel).not($(this).parents(container).find(panel).eq(i)).hide();

			})

		})

	})



}



function mobileTabContainer(container,title,panel,titleSpan,panelContent){

	$(container).each(function(){

		if($(this).find(title).length>0 && $(this).find(panel).length>0){

			$(this).append('<div class="mobile-tab-items"></div>')

			var mobileTabItem='<div class="mobile-tab-item"><h2 class="mobile-tab-title"></h2><div class="mobile-tab-panel"></div></div>'

			$(this).find(title).each(function(){

				$(this).parents(container).find('.mobile-tab-items').append(mobileTabItem)

			})

		}

		var mobileTabTitle=$(this).find('.mobile-tab-items .mobile-tab-title')

		var mobileTabPanel=$(this).find('.mobile-tab-items .mobile-tab-panel')

		for(var i=0;i<$(this).find(title).length;i++){

			$(this).find(title).eq(i).find(titleSpan).clone().appendTo(mobileTabTitle.eq(i))

			$(this).find(panel).eq(i).find(panelContent).clone().appendTo(mobileTabPanel.eq(i))

		}

	})



}

function containerItems(container,containerSlideName,itemDisplayLength,containerName,cItem){

	$(container).each(function(){

		$(this).find(containerName).hide()

		var itemLength=$(this).find(containerName).find(cItem).size()

		for(var i=0;i<(itemLength/itemDisplayLength);i++){

			$(this).find(containerSlideName).append("<div class='slide-item-cont'></div>")

		}

		$(this).find(containerSlideName).find('.slide-item-cont').each(function(){

			var itemContIndex=parseInt($(this).index())

			if(itemContIndex>0){

				var itemIndex=itemContIndex*itemDisplayLength;

				var current=$(this).parents(containerSlideName).find('.slide-item-cont').eq(itemContIndex);

				for(var i=0;i<itemDisplayLength;i++){

					var move=$(this).parents(container).find(containerName).find(cItem).eq(itemIndex+i);

					move.clone().appendTo(current);

				}

			}

			else{

				for(var i=0;i<itemDisplayLength;i++){

					var move=$(this).parents(container).find(containerName).find(cItem).eq(i);

					move.clone().appendTo($(this).parents(containerSlideName).find('.slide-item-cont').eq(0));

				}

			}



		})

		$(this).find(containerSlideName).owlCarousel({

			autoplay:true,

			loop:true,

			margin:0,

			autoplayTimeout:2000,

			smartSpeed:1000,

			lazyLoad:true,

			items:1,

			slideBy:1,

			responsive: {

				0: {

					dots: true,

					nav: false,

				},

				769: {

					dots: false,

					nav:  true,

				}

			}

		})

	})

}

$(function(){
	if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
		var wow = new WOW({
		    boxClass: 'wow',
		    animateClass: 'animated',
		    offset: 0,
		    mobile: false,
		    live: true
		});
		wow.init();
	};
})

// nav child
// ============================
$(function(){
	$('.nav li').each(function(){
		if($(this).find('ul').length>0){
			$(this).addClass('has-child');
		}else{
			$(this).addClass('elem-link');
		}
	})
})

function decrease(item,time){
	var i=0;
	var j=item.length;
	item.each(function(){
		i++;
		j--;
		var ii=(i-1);
		var jj=time*j;
		item.eq(ii).attr('data-wow-delay',jj+'s')
	})
}

function add(item,time){
	item.each(function(index){
		$(this).attr('data-wow-delay',(index*time)+'s')
	})
}

$(function(){
	add( $('.main-product-wrap .product-item'),.15)
	add( $('.new-item'),.3)
	add( $('.company-synopses .synopsis-item'),.2)
})

/*小语种切换*/
function changeLanguage(language_abbr) {
    var location_url = window.location.host;
    var location_path = window.location.pathname;
    var url_type = location_url.split('.')[0];
    var url_name = location_url.split('.')[1];
    var url_end = location_url.split('.')[2];
    if (language_abbr == "en" && url_type.length < 3) {
        window.location.href = '//www.' + url_name + "." + url_end;
    } else {
        var path_arr = location_path.split('/');
        if (path_arr[1] == language_abbr) {
            return;
        }
        var abbr = '';
        if (path_arr[1].length == 2) {
            if (language_abbr == 'en') {
                path_arr.splice(1, 1)
            } else {
                path_arr[1] = language_abbr;
                abbr = "/" + language_abbr + "/"
            }
        } else {
            if (language_abbr == 'en') {
                return;
            } else {
                path_arr.splice(1, 0, language_abbr);
                abbr = "/" + language_abbr + "/"
            }
        }
        location_path = path_arr.join('/');
        window.location.href = '//' + location_url + abbr
    }
}