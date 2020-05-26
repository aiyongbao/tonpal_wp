(function($) {
    // windows size
    var mouseover_tid = [];
    var mouseout_tid = [];
    var winWidth = 0;
    var winHeight = 0;

    function winSize() {
        if (window.innerWidth)
            winWidth = window.innerWidth;
        else if ((document.body) && (document.body.clientWidth))
            winWidth = document.body.clientWidth;
        if (window.innerHeight)
            winHeight = window.innerHeight;
        else if ((document.body) && (document.body.clientHeight))
            winHeight = document.body.clientHeight;
        if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth) {
            winHeight = document.documentElement.clientHeight;
            winWidth = document.documentElement.clientWidth;
        }
        if (winWidth < 951) {

            if ($('.mobile-head-items').length < 1 && $('.mobile-nav-items').length < 1 && $('.mobile-cart-items').length < 1) {

                var mobileService = '<div class="mobile-head-items"><div class="mobile-head-item mobile-head-home"><div class="title"><a href="/"></a></div></div><div class="mobile-head-item mobile-head-nav"><div class="title"></div><div class="main-content-wrap side-content-wrap"><div class="content-wrap"></div></div></div><div class="mobile-head-item mobile-head-language"><div class="title"></div><div class="main-content-wrap side-content-wrap"><div class="content-wrap"></div></div></div><div class="mobile-head-item mobile-head-search"><div class="title"></div><div class="main-content-wrap middle-content-wrap"><div class="content-wrap"></div></div></div></div>'
                $('.head-wrapper').append(mobileService)
                if ($('body .aside').length > 0) {
                    $('.mobile-head-items').append('<div class="mobile-head-item mobile-head-aside"><div class="title"></div><div class="main-content-wrap side-content-wrap"><div class="content-wrap"></div></div></div>')
                }
                /*if($('.mobile-contact').length<1 && $('.head-contact').length>0){
                    var mobileContact='<div class="mobile-contact"></div>'
                    $('body').append(mobileContact)
                }*/

                //mobileTabContainer('.tab-content-wrap', '.tab-title', '.tab-panel', 'span', '.tab-panel-content')


                $('.mobile-head-item').each(function() {
                    $(this).find('.title').click(function() {
                        if ($(this).parents('.mobile-head-item').find('.main-content-wrap').length > 0) {
                            var pItem = $(this).parents('.mobile-head-item')
                            if (!pItem.find('.main-content-wrap').hasClass('show-content-wrap')) {
                                pItem.find('.main-content-wrap').addClass('show-content-wrap')
                                pItem.find('.side-content-wrap').stop().animate({
                                    'left': '0'
                                }, 300)
                                pItem.find('.middle-content-wrap').addClass('middle-show-content-wrap')
                                pItem.find('.side-content-wrap').append("<b class='mobile-ico-close'></b>")

                                pItem.siblings('.mobile-head-item').find('.main-content-wrap').removeClass('show-content-wrap')
                                pItem.siblings('.mobile-head-item').find('.side-content-wrap').stop().animate({
                                    'left': '-70%'
                                }, 300)
                                pItem.siblings('.mobile-head-item').find('.middle-content-wrap').removeClass('middle-show-content-wrap')
                                pItem.siblings('.mobile-head-item').find('.side-content-wrap .mobile-ico-close').remove()
                                if($('.head-wrapper').length>0){
                                    if ($('.head-wrapper').find('.mobile-body-mask').length < 1) {
                                        $('.head-wrapper').append('<div class="mobile-body-mask"></div>');
                                    }
                                }

                            } else {
                                pItem.find('.main-content-wrap').removeClass('show-content-wrap')
                                pItem.find('.side-content-wrap').stop().animate({
                                    'left': '-70%'
                                }, 300)
                                pItem.find('.middle-content-wrap').removeClass('middle-show-content-wrap')
                                pItem.find('.side-content-wrap .mobile-ico-close').remove()
                                $('.mobile-body-mask').remove()
                            }
                            $('.mobile-body-mask').click(function() {
                                $('.mobile-body-mask').remove()
                                $('.mobile-head-item .main-content-wrap').removeClass('show-content-wrap')
                                $('.mobile-head-item .side-content-wrap').animate({
                                    'left': '-70%'
                                }, 300)
                                $('.mobile-head-item .middle-content-wrap').removeClass('middle-show-content-wrap')
                                $('.mobile-head-item .side-content-wrap .mobile-ico-close').remove()

                            })
                            $('.mobile-ico-close').click(function() {
                                $('.mobile-body-mask').remove()
                                $('.mobile-head-item .main-content-wrap').removeClass('show-content-wrap')
                                $('.mobile-head-item .side-content-wrap').stop().animate({
                                    'left': '-70%'
                                }, 300)
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
                $('.head-search .head-search-form').clone().appendTo('.mobile-head-item.mobile-head-search .main-content-wrap .content-wrap')
                $('.nav-bar .nav').clone().appendTo('.mobile-head-item.mobile-head-nav .main-content-wrap .content-wrap')
                $('.head-social').clone().appendTo('.mobile-head-item.mobile-head-social .main-content-wrap .content-wrap')
                $('.aside .aside-wrap').clone().appendTo('.mobile-head-item.mobile-head-aside .main-content-wrap .content-wrap')
                /*$('.head-contact').clone().appendTo('.mobile-contact')*/

            }
            $(document).ready(function() {
                $('#rev_slider_3_1 ul li').each(function(index) {
                    if ((index + 1) % 2 == 0) {
                        $(this).removeClass('evenItem')
                        $(this).find('.tp-caption.itemImg').addClass('lfb').removeClass('lft').attr('data-x', '700')
                        $(this).find('.tp-caption.itemTitle').attr('data-x', '0')
                        $(this).find('.tp-caption.itemDetail').addClass('lfl').removeClass('lfr').attr('data-x', '0')
                        $(this).find('.tp-caption.itemMore').attr('data-x', '0')
                    }

                })


            })
        }

        //mobile end
        else {


            $(document).ready(function() {

                //$('.mobile-body-mask,.mobile-head-items,.mobile-nav-items,.mobile-cart-items,.mobile-tab-items,.mobile-contact').remove()

                //nav
                $('.nav').children('li').each(function() {
                    var te = $(this).children('a').children('em').text()
                    $(this).children('a').children('em').attr('data-hover', te)
                })

                $('.nav li').each(function(index){
                    if($(this).children('ul').length>0){
                        if($(this).children('a').find('.nav-ico').length<1){
                            $(this).children('a').append("<i class='nav-ico'></i>");
                        }
                        $(this).hover(
                            function(){
                                var _self = this;
                                clearTimeout(mouseout_tid[index]);
                                mouseover_tid[index] = setTimeout(function() {
                                    // $(_self).children('ul').fadeIn(200); //2017-09-23
                                    $(_self).addClass('li-hover');
                                }, 50);
                            },

                            function(){
                                var _self = this;
                                clearTimeout(mouseover_tid[index]);
                                mouseout_tid[index] = setTimeout(function() {
                                    // $(_self).children('ul').fadeOut(150); //2017-09-23
                                    $(_self).removeClass('li-hover');
                                }, 50);

                            }
                        );
                    }
                })


            })

            $(window).load(function() {

                $('.items_content').each(function() {
                    if ($(this).find('li').length > 1) {

                        $(".items_content").jCarouselLite({
                            btnPrev: ".btn-prev",
                            btnNext: ".btn-next",
                            speed: 100,
                            auto: false,
                            scroll: 1,
                            visible: 5,
                            vertical: true,
                            circular: false,
                            onMouse: true
                        });
                    }

                })
            })

        }


    }
    $(function() {
        winSize();
    })
    $(window).resize(function() {
        winSize();
    });

})(jQuery);
$(document).ready(function() {


});



//scroll
(function($) {
    $.fn.jCarouselLite = function(o) {
        o = $.extend({
            btnPrev: null,
            btnNext: null,
            btnGo: null,
            mouseWheel: false,
            onMouse: false,
            auto: null,
            speed: 500,
            easing: null,
            vertical: false,
            circular: true,
            visible: 4,
            start: 0,
            scroll: 1,
            beforeStart: null,
            afterEnd: null
        }, o || {});
        return this.each(function() {
            var b = false,
                animCss = o.vertical ? "top" : "left",
                sizeCss = o.vertical ? "height" : "width";
            var c = $(this),
                ul = $("ul", c),
                tLi = $("li", ul),
                tl = tLi.size(),
                v = o.visible;
            var TimeID = 0;
            if (o.circular) {
                ul.prepend(tLi.slice(tl - v - 1 + 1).clone()).append(tLi.slice(0, v).clone());
                o.start += v
            }
            var f = $("li", ul),
                itemLength = f.size(),
                curr = o.start;
            c.css("visibility", "visible");
            f.css({
                overflow: "",
                float: o.vertical ? "none" : "left"
            });
            ul.css({
                position: "relative",
                "list-style-type": "none",
                "z-index": "1"
            });
            c.css({
                overflow: "hidden",
                position: "relative",
                "z-index": "2",
                left: "0px"
            });
            var g = o.vertical ? height(f) : width(f);
            var h = g * itemLength;
            var j = g * v;
            f.css({
                width: f.width(),
                height: f.outerHeight()
            });
            ul.css(sizeCss, h + "px").css(animCss, -(curr * g));
            c.css(sizeCss, j + "px");
            if (o.btnPrev) $(o.btnPrev).click(function() {
                return go(curr - o.scroll)
            });
            if (o.btnNext) $(o.btnNext).click(function() {
                return go(curr + o.scroll)
            });
            if (o.btnGo) $.each(o.btnGo, function(i, a) {
                $(a).click(function() {
                    return go(o.circular ? o.visible + i : i)
                })
            });
            if (o.mouseWheel && c.mousewheel) c.mousewheel(function(e, d) {
                return d > 0 ? go(curr - o.scroll) : go(curr + o.scroll)
            });
            if (o.auto) TimeID = setInterval(function() {
                go(curr + o.scroll);
            }, o.auto + o.speed);
            if (o.onMouse) {
                ul.bind("mouseover", function() {
                    if (o.auto) {
                        clearInterval(TimeID);
                    }
                }), ul.bind("mouseout", function() {
                    if (o.auto) {
                        TimeID = setInterval(function() {
                            go(curr + o.scroll);
                        }, o.auto + o.speed);
                    }
                })
            }

            function vis() {
                return f.slice(curr).slice(0, v)
            };

            function go(a) {
                if (!b) {
                    if (o.beforeStart) o.beforeStart.call(this, vis());
                    if (o.circular) {
                        if (a <= o.start - v - 1) {
                            ul.css(animCss, -((itemLength - (v * 2)) * g) + "px");
                            curr = a == o.start - v - 1 ? itemLength - (v * 2) - 1 : itemLength - (v * 2) - o.scroll
                        } else if (a >= itemLength - v + 1) {
                            ul.css(animCss, -((v) * g) + "px");
                            curr = a == itemLength - v + 1 ? v + 1 : v + o.scroll
                        } else curr = a
                    } else {
                        if (a < 0 || a > itemLength - v) return;
                        else curr = a
                    }
                    b = true;
                    ul.animate(animCss == "left" ? {
                        left: -(curr * g)
                    } : {
                        top: -(curr * g)
                    }, o.speed, o.easing, function() {
                        if (o.afterEnd) o.afterEnd.call(this, vis());
                        b = false
                    });
                    if (!o.circular) {
                        $(o.btnPrev + "," + o.btnNext).removeClass("disabled");
                        $((curr - o.scroll < 0 && o.btnPrev) || (curr + o.scroll > itemLength - v && o.btnNext) || []).addClass("disabled")
                    }
                }
                return false
            }
        })
    };

    function css(a, b) {
        return parseInt($.css(a[0], b)) || 0
    };

    function width(a) {
        return a[0].offsetWidth + css(a, 'marginLeft') + css(a, 'marginRight')
    };

    function height(a) {
        return a[0].offsetHeight + css(a, 'marginTop') + css(a, 'marginBottom')
    }
})(jQuery);



$(function() {

    var mHeadTop = $('.head-wrapper').offset().top

    var $backToTopTxt = "top",
        $backToTopEle = $('<span class="gotop"></span>').appendTo($("body"))

            .text($backToTopTxt).attr("title", $backToTopTxt).click(function() {

                $("html, body").animate({
                    scrollTop: 0
                }, 1000);



            }), $backToTopFun = function() {

            var st = $(document).scrollTop(),
                winh = $(window).height();

            (st > mHeadTop) ? $backToTopEle.fadeIn(): $backToTopEle.fadeIn();

            if (!window.XMLHttpRequest) {

                $backToTopEle.css("top", st + winh - 210);

            }



        };

    $(window).bind("scroll", $backToTopFun);

    $(function() {
        $backToTopFun();
    });

    var $nav = $('.head-wrapper'),
        navTop = $nav.offset().top,
        navH = $nav.outerHeight(),
        winTop_1 = 0,
        winWidth = $(window).width(),
        navHeight= jQuery('.nav-bar').height();
    holder = jQuery('<div class="head-fixed-holder"></div>');
    $(window).on('scroll', function() {
        var winTop_2 = $(window).scrollTop();
        holder.css('height', navHeight);

        if (winTop_2 > navTop && winWidth > 980) {
            holder.show().insertBefore($nav);
            $nav.addClass('fixed-nav');
        } else {
            holder.hide();
            $nav.removeClass('fixed-nav');
        }

        if (winTop_2 > winTop_1 && winWidth > 980) {
            $nav.removeClass('fixed-nav-appear');
        } else if (winTop_2 < winTop_1) {
            $nav.addClass('fixed-nav-appear');
        }
        winTop_1 = $(window).scrollTop();
    })

    //tab
    tabContainer('.tab-content-wrap', '.tab-title', '.tab-panel')

});



$(document).ready(function() {

    /*侧栏产品分类*/
    $('.side-widget .side-cate li').each(function() {

        if ($(this).find('ul').length > 0) {

            $(this).append("<span class='icon-cate icon-cate-down'></span>")

            $(this).children('.icon-cate').click(function(e) {

                if ($(this).parent('li').children('ul').is(':hidden')) {

                    $(this).parent('li').children('ul').slideDown(100);

                    $(this).removeClass('icon-cate-down').addClass('icon-cate-up');

                } else {

                    $(this).parent('li').children('ul').slideUp(100);

                    $(this).removeClass('icon-cate-up').addClass('icon-cate-down');

                }

                e.stopPropagation();

            })



        }

    })
    if ($('.side-widget .side-cate .nav-current').parents('ul').length > 0 && $('.side-widget .side-cate .nav-current').find('ul').length > 0) {
        $('.side-widget .side-cate .nav-current').parents('ul').show()
        $('.side-widget .side-cate .nav-current').parents('li').addClass("show_li")
        $('.side-widget .side-cate .nav-current').parents('li.show_li').children('.icon-cate').removeClass('icon-cate-down').addClass('icon-cate-up')
        $('.side-widget .side-cate .nav-current').children('ul').show()
        $('.side-widget .side-cate .nav-current ').children('.icon-cate').removeClass('icon-cate-down').addClass('icon-cate-up');
    } else if ($('.side-widget .side-cate .nav-current').parents('ul').length > 0 && $('.side-widget .side-cate .nav-current').find('ul').length < 1) {
        $('.side-widget .side-cate .nav-current').parents('ul').show()
        $('.side-widget .side-cate .nav-current').parents('li').addClass("show_li")
        $('.side-widget .side-cate .nav-current').parents('li.show_li').children('.icon-cate').removeClass('icon-cate-down').addClass('icon-cate-up')
    } else if ($('.side-widget .side-cate .nav-current').parents('ul').length < 1 && $('.side-widget .side-cate .nav-current').find('ul').length > 0) {
        $('.side-widget .side-cate .nav-current').children('ul').show()
        $('.side-widget .side-cate .nav-current').children('.icon-cate').removeClass('icon-cate-down').addClass('icon-cate-up');
    }


    $('.gm-sep').contents().filter(function() {
        return this.nodeType === 3;
    }).remove();



    // $('.product-items .items-content').owlCarousel({
    // 	autoplay: true,
    // 	loop: true,
    // 	margin: 0,
    // 	dots: true,
    // 	autoplayTimeout: 30000,
    // 	smartSpeed: 180,
    // 	lazyLoad: true,

    // 	responsive: {
    // 		0: {

    // 			items: 1,
    // 			slideBy: 1

    // 		},
    // 		321: {

    // 			items: 2,
    // 			slideBy: 2

    // 		},
    // 		500: {

    // 			items: 3,
    // 			slideBy: 3

    // 		},

    // 		1024: {
    // 			dots: false,
    // 			nav: true,
    // 			items: 4,
    // 			slideBy: 4,
    // 		}
    // 	}

    // });


    if ($('.image-additional ul li').length > 1) {
        $('.image-additional ul').owlCarousel({
            autoplay: false,
            loop: false,
            margin: 0,
            autoplayTimeout: 30000,
            smartSpeed: 180,
            lazyLoad: true,
            mouseDrag: true,
            slideBy: 1,
            responsive: {
                0: {
                    nav: false,
                    dots: true,
                    items: 1,
                },
                951: {
                    nav: true,
                    dots: false,
                    items: 3,

                }
            }
        });
    } else {
        $('.image-additional ul li').addClass('single')
    }


    $('.goods-items').owlCarousel({
        autoplay: true,
        loop: true,
        margin: 0,
        dots: true,
        autoplayTimeout: 30000,
        smartSpeed: 180,
        lazyLoad: true,
        responsive: {
            0: {

                items: 1,
                slideBy: 1

            },
            321: {

                items: 2,
                slideBy: 2

            },
            500: {

                items: 3,
                slideBy: 3

            },
            769: {
                dots: false,
                nav: true,
                items: 3,
                slideBy: 3
            }
        }

    });



    $('.banner_flexslider,.about-img,.main-banner').flexslider({
        animation: "fade",
        direction: "horizontal",
        animationLoop: true,
        slideshow: true,
        slideshowSpeed: 7000,
        animationSpeed: 600,
        touch: true
    });
    /*$('.detail-panel,.main-product-item').find('img').parents('a').addClass('lightbox')
    $('.lightbox,.pd-inq a').lightbox();*/
    $('.entry').find('img').parents('a').addClass('fancybox')
    $("a.fancybox").fancybox();


    // $('.inquiry-form .form-item').each(function(index) {
    // 	$(this).addClass('form-item' + (index + 1))
    // })
    // var demo = $(".inquiry-form,.wpcf7-form").Validform({
    // 	tiptype: 3,
    // 	showAllError: true,
    // 	ajaxPost: false
    // });
    // demo.addRule([{
    // 	ele: "input.form-input-email",
    // 	datatype: "e",
    // 	nullmsg: "Please enter a valid email address",
    // 	errormsg: "Please enter a valid email address"
    // }, {
    // 	ele: "input.form-input-name",
    // 	datatype: "*1-200",
    // 	nullmsg: "Please enter a valid user name",
    // 	errormsg: "Please enter a valid user name"
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
                aop_param.post_name = ((typeof(form.product_title.value) == "undefined")?'':form.product_title.value);
                aop_param.name = form.name.value;
                aop_param.email = form.email.value;
                aop_param.phone = form.phone.value;
                aop_param.message = form.message.value;
                if(location.href.indexOf('?')>-1){
                    aop_param.reference = location.href.split('?')[0];
                }else{
                    aop_param.reference = location.href;
                }
                $.ajax({
                    url:"/wp-json/portal/v1/inquiry",
                    type:'POST',
                    data: aop_param,
                    success : function(rsp){
                        console.log(rsp);
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
                aop_param.post_name = ((typeof(form.product_title2.value) == "undefined")?'':form.product_title2.value);
                aop_param.name = form.name2.value;
                aop_param.email = form.email2.value;
                aop_param.phone = form.phone2.value;
                aop_param.message = form.message2.value;
                if(location.href.indexOf('?')>-1){
                    aop_param.reference = location.href.split('?')[0];
                }else{
                    aop_param.reference = location.href;
                }
                $.ajax({
                    url:"/wp-json/portal/v1/inquiry",
                    type:'POST',
                    data: aop_param,
                    success : function(rsp){
                        console.log(rsp)
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

function tabContainer(container, title, panel) {
    $(container).each(function() {
        $(this).find(title).each(function() {
            if ($(this).hasClass('current')) {
                j = $(this).index();
                $(this).parents(container).find(panel).eq(j).removeClass('disabled')
            }
            $(this).click(function() {
                i = $(this).index();
                $(this).addClass('current').siblings().removeClass('current');
                $(this).parents(container).find(panel).eq(i).show();
                $(this).parents(container).find(panel).not($(this).parents(container).find(panel).eq(i)).hide();
            })
        })
    })

}

function mobileTabContainer(container, title, panel, titleSpan, panelContent) {
    $(container).each(function() {
        if ($(this).find(title).length > 0 && $(this).find(panel).length > 0) {
            $(this).append('<div class="mobile-tab-items"></div>')
            var mobileTabItem = '<div class="mobile-tab-item"><h2 class="mobile-tab-title"></h2><div class="mobile-tab-panel"></div></div>'
            $(this).find(title).each(function() {
                $(this).parents(container).find('.mobile-tab-items').append(mobileTabItem)
            })
        }
        var mobileTabTitle = $(this).find('.mobile-tab-items .mobile-tab-title')
        var mobileTabPanel = $(this).find('.mobile-tab-items .mobile-tab-panel')
        for (var i = 0; i < $(this).find(title).length; i++) {
            $(this).find(title).eq(i).find(titleSpan).clone().appendTo(mobileTabTitle.eq(i))
            $(this).find(panel).eq(i).find(panelContent).clone().appendTo(mobileTabPanel.eq(i))
        }
    })

}

function picturesShow(container, picturesItem, length) {
    var containerWidth = $(container).width()
    var itemCurrentWidth = ((1 - 1 / 8 * (length - 1)) * 100) + "%"
    var itemWidth = (1 / 8 * 100) + "%"
    $(container).find(picturesItem).css('width', itemWidth)
    $(container).find(picturesItem).eq(0).addClass('current').css('width', itemCurrentWidth)
    $(container).find(picturesItem).find('.item-wrap').css('width', containerWidth * (1 - 1 / 8 * (length - 1)))
    $(container).find(picturesItem).each(function() {
        $(this).click(function() {
            $(this).addClass('current').stop().animate({
                'width': itemCurrentWidth
            }, 600)
            $(this).siblings().removeClass('current').stop().animate({
                'width': itemWidth
            }, 300)

        })
    })
}


$(function() {
    if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))) {
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


function decrease(item, time) {
    var i = 0;
    var j = item.length;
    item.each(function() {
        i++
        j--
        var ii = (i - 1)
        var jj = time * j
        item.eq(ii).attr('data-wow-delay', jj + 's')
    })
}

function add(item, time) {
    item.each(function(index) {
        $(this).attr('data-wow-delay', (index * time) + 's')
    })
}
$(function() {
    add($('.company-synopses .synopsis-item'), .1);
    add($('.featured-count li'), .1);
    // decrease($('.news-items .news-item'), .1);
    // containerItems('.foot-item-news .foot-cont', 2, '.blog-news-list', '.blog-news-item', new Array("1"));
})

function containerItems(container, itemDisplayLength, containerName, cItem, showItems) {
    $(container).each(function() {
        $(this).find(containerName).hide()
        var itemLength = $(this).find(containerName).find(cItem).size()
        if ($(this).find('.product-container').length < 1) {
            $(this).append("<div class='product-container'></div>")
        }
        for (var i = 0; i < (itemLength / itemDisplayLength); i++) {

            $(this).find('.product-container').append("<div class='product-slide-item'></div>")
        }
        $(this).find('.product-container').find('.product-slide-item').each(function() {
            var itemContIndex = parseInt($(this).index())
            if (itemContIndex > 0) {
                var itemIndex = itemContIndex * itemDisplayLength;
                var current = $(this).parents('.product-container').find('.product-slide-item').eq(itemContIndex);
                for (var i = 0; i < itemDisplayLength; i++) {
                    var move = $(this).parents(container).find(containerName).find(cItem).eq(itemIndex + i);
                    move.clone().appendTo(current);
                }
            } else {
                for (var i = 0; i < itemDisplayLength; i++) {
                    var move = $(this).parents(container).find(containerName).find(cItem).eq(i);
                    move.clone().appendTo($(this).parents('.product-container').find('.product-slide-item').eq(0));

                }
            }

        })
        var productContainer = $(this).find('.product-container')
        productContainer.owlCarousel({
            loop: true,
            margin: 0,
            dots: true,
            smartSpeed: 180,
            lazyLoad: true,
            dots: true,
            nav: true,
            mouseDrag: true,
            items: 1,
            slideBy: 1
        })

    })

}
$(function() {
    $('.search-toggle').on('click', function() {
        var tasking = $(this).parents('.head-wrapper').find('.tasking');
        var hdSearch = $(this).parents('.head-search');
        if (tasking.is(':hidden')) {
            tasking.show();
            // $(this).hide()
        } else {
            tasking.delay(600).hide();
            // $(this).show()
        }
        if (!hdSearch.hasClass('head-search-show')) {
            hdSearch.addClass('head-search-show');
        } else {
            hdSearch.removeClass('head-search-show');
        }

    })
    $('.head-search').on('click', function(e) {
        e.stopPropagation();
    })
    $(document).on('click', function() {
        $('.head-wrapper .tasking').delay(600).fadeOut()
        $('.head-search .search-toggle').show()
        $('.head-search').removeClass('head-search-show');
    })
})



$(function() {
    $('.faq-item').each(function(index) {
        var _this = $(this)
        var title = _this.find('.faq-title')
        var cont = _this.find('.faq-cont')
        if (index == 0) {
            title.addClass('show-title')
        }
        title.on('click', function() {
            if (cont.is(':hidden') && !$(this).hasClass('show-title')) {
                cont.slideDown('fast')
                $(this).addClass('show-title')
                _this.siblings().find('.faq-title').removeClass('show-title')
                _this.siblings().find('.faq-cont').slideUp('fast')
            } else {
                cont.slideUp('fast')
                $(this).removeClass('show-title')
            }
        })
    })
})



// synopsis slides
// ============================
$(function(){
    $('.synopsis-slides').owlCarousel({
        autoplay:false,
        loop:true,
        margin:30,
        dots:  true,
        autoplayTimeout:30000,
        smartSpeed:180,
        lazyLoad:true,
        dots: true,
        nav: false,
        responsive: {
            0: {
                items:1,
                slideBy:1,
                margin:0
            },

            769: {
                items:3,
                slideBy:3,
                margin:20
            }
        }
    });
})



// partner slides
// ============================
$(function(){
    $('.partner-slides').owlCarousel({
        autoplay:false,
        loop:true,
        margin:30,
        dots:  true,
        autoplayTimeout:30000,
        smartSpeed:180,
        lazyLoad:true,
        dots: false,
        nav: true,
        responsive: {
            0: {
                items:2,
                slideBy:2,
                margin:10,
                dots: true,
                nav: false
            },
            551: {
                items:3,
                slideBy:3,
                margin:10,
                dots: true,
                nav: false
            },
            769: {
                items:5,
                slideBy:5,
                margin:35,
                dots: false,
                nav: true
            }
        }
    });
})
$(function(){
    $('body table').each(function(){
        if(!$(this).parent().hasClass('table_wrap')){
            $(this).wrap("<div class='table_wrap'></div>")
            var tableWidth=$(this).outerWidth()
            var tabWrapWidth=$('body').outerWidth()

            if(tableWidth>tabWrapWidth){
                $(this).parent('.table_wrap').css('overflow-x','scroll')
            }else{
                $(this).parent('.table_wrap').css('overflow-x','hidden')
            }
        }
    })
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