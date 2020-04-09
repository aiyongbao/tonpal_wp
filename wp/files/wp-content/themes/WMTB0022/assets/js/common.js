function tabContainer(e, t, n) {
    $(e).each(function() {
        $(this)
            .find(t)
            .each(function() {
                $(this).hasClass('current') &&
                ((j = $(this).index()),
                    $(this)
                        .parents(e)
                        .find(n)
                        .eq(j)
                        .removeClass('disabled')),
                    $(this).click(function() {
                        (i = $(this).index()),
                            $(this)
                                .addClass('current')
                                .siblings()
                                .removeClass('current'),
                            $(this)
                                .parents(e)
                                .find(n)
                                .eq(i)
                                .show(),
                            $(this)
                                .parents(e)
                                .find(n)
                                .not(
                                    $(this)
                                        .parents(e)
                                        .find(n)
                                        .eq(i)
                                )
                                .hide();
                    });
            });
    });
}
function mobileTabContainer(e, i, t, n, a) {
    $(e).each(function() {
        if ($(this).find(i).length > 0 && $(this).find(t).length > 0) {
            $(this).append('<div class="mobile-tab-items"></div>');
            $(this)
                .find(i)
                .each(function() {
                    $(this)
                        .parents(e)
                        .find('.mobile-tab-items')
                        .append(
                            '<div class="mobile-tab-item"><h2 class="mobile-tab-title"></h2><div class="mobile-tab-panel"></div></div>'
                        );
                });
        }
        for (
            var s = $(this).find('.mobile-tab-items .mobile-tab-title'),
                o = $(this).find('.mobile-tab-items .mobile-tab-panel'),
                d = 0;
            d < $(this).find(i).length;
            d++
        )
            $(this)
                .find(i)
                .eq(d)
                .find(n)
                .clone()
                .appendTo(s.eq(d)),
                $(this)
                    .find(t)
                    .eq(d)
                    .find(a)
                    .clone()
                    .appendTo(o.eq(d));
    });
}
function picturesShow(e, i, t) {
    var n = $(e).width(),
        a = 100 * (1 - (1 / 8) * (t - 1)) + '%';
    $(e)
        .find(i)
        .css('width', '12.5%'),
        $(e)
            .find(i)
            .eq(0)
            .addClass('current')
            .css('width', a),
        $(e)
            .find(i)
            .find('.item-wrap')
            .css('width', n * (1 - (1 / 8) * (t - 1))),
        $(e)
            .find(i)
            .each(function() {
                $(this).click(function() {
                    $(this)
                        .addClass('current')
                        .stop()
                        .animate({ width: a }, 600),
                        $(this)
                            .siblings()
                            .removeClass('current')
                            .stop()
                            .animate({ width: '12.5%' }, 300);
                });
            });
}
function decrease(e, i) {
    var t = 0,
        n = e.length;
    e.each(function() {
        var a = ++t - 1,
            s = i * --n;
        e.eq(a).attr('data-wow-delay', s + 's');
    });
}
function add(e, i) {
    e.each(function(e) {
        $(this).attr('data-wow-delay', e * i + 's');
    });
}
function containerItems(e, i, t, n, a) {
    $(e).each(function() {
        $(this)
            .find(t)
            .hide();
        var a = $(this)
            .find(t)
            .find(n)
            .size();
        $(this).find('.product-container').length < 1 &&
        $(this).append("<div class='product-container'></div>");
        for (var s = 0; s < a / i; s++)
            $(this)
                .find('.product-container')
                .append("<div class='product-slide-item'></div>");
        $(this)
            .find('.product-container')
            .find('.product-slide-item')
            .each(function() {
                var a = parseInt($(this).index());
                if (a > 0)
                    for (
                        var s = a * i,
                            o = $(this)
                                .parents('.product-container')
                                .find('.product-slide-item')
                                .eq(a),
                            d = 0;
                        d < i;
                        d++
                    ) {
                        $(this)
                            .parents(e)
                            .find(t)
                            .find(n)
                            .eq(s + d)
                            .clone()
                            .appendTo(o);
                    }
                else
                    for (d = 0; d < i; d++) {
                        $(this)
                            .parents(e)
                            .find(t)
                            .find(n)
                            .eq(d)
                            .clone()
                            .appendTo(
                                $(this)
                                    .parents('.product-container')
                                    .find('.product-slide-item')
                                    .eq(0)
                            );
                    }
            }),
            $(this)
                .find('.product-container')
                .owlCarousel({
                    loop: !0,
                    margin: 0,
                    dots: !0,
                    smartSpeed: 180,
                    lazyLoad: !0,
                    dots: !0,
                    nav: !0,
                    mouseDrag: !0,
                    items: 1,
                    slideBy: 1
                });
    });
}
function showMsgPop() {
    $('.inquiry-pop-bd').fadeIn('fast');
}
function hideMsgPop() {
    $('.inquiry-pop-bd').fadeOut('fast');
}
function changeLanguage(e) {
    var i = window.location.host,
        t = window.location.pathname,
        n = i.split('.')[0],
        a = i.split('.')[1],
        s = i.split('.')[2];
    if ('en' == e && n.length < 3)
        window.location.href = '//www.' + a + '.' + s;
    else {
        var o = t.split('/');
        if (o[1] == e) return;
        var d = '';
        if (2 == o[1].length)
            'en' == e ? o.splice(1, 1) : ((o[1] = e), (d = '/' + e + '/'));
        else {
            if ('en' == e) return;
            o.splice(1, 0, e), (d = '/' + e + '/');
        }
        (t = o.join('/')), (window.location.href = '//' + i + d);
    }
}
!(function(e) {
    var i = [],
        t = [],
        n = 0;
    function a() {
        if (
            (window.innerWidth
                ? (n = window.innerWidth)
                : document.body &&
                document.body.clientWidth &&
                (n = document.body.clientWidth),
                window.innerHeight
                    ? window.innerHeight
                    : document.body &&
                    document.body.clientHeight &&
                    document.body.clientHeight,
            document.documentElement &&
            document.documentElement.clientHeight &&
            document.documentElement.clientWidth &&
            (document.documentElement.clientHeight,
                (n = document.documentElement.clientWidth)),
            n < 951)
        ) {
            if (
                e('.mobile-head-items').length < 1 &&
                e('.mobile-nav-items').length < 1 &&
                e('.mobile-cart-items').length < 1
            ) {
                e('.head-wrapper').append(
                    '<div class="mobile-head-items"><div class="mobile-head-item mobile-head-home"><div class="title"><a href="/"></a></div></div><div class="mobile-head-item mobile-head-nav"><div class="title"></div><div class="main-content-wrap side-content-wrap"><div class="content-wrap"></div></div></div><div class="mobile-head-item mobile-head-language"><div class="title"></div><div class="main-content-wrap side-content-wrap"><div class="content-wrap"></div></div></div><div class="mobile-head-item mobile-head-search"><div class="title"></div><div class="main-content-wrap middle-content-wrap"><div class="content-wrap"></div></div></div></div>'
                ),
                e('body .aside').length > 0 &&
                e('.mobile-head-items').append(
                    '<div class="mobile-head-item mobile-head-aside"><div class="title"></div><div class="main-content-wrap side-content-wrap"><div class="content-wrap"></div></div></div>'
                ),
                    mobileTabContainer(
                        '.tab-content-wrap',
                        '.tab-title',
                        '.tab-panel',
                        'span',
                        '.tab-panel-content'
                    ),
                    e('.mobile-head-item').each(function() {
                        e(this)
                            .find('.title')
                            .click(function() {
                                if (
                                    e(this)
                                        .parents('.mobile-head-item')
                                        .find('.main-content-wrap').length > 0
                                ) {
                                    var i = e(this).parents(
                                        '.mobile-head-item'
                                    );
                                    i
                                        .find('.main-content-wrap')
                                        .hasClass('show-content-wrap')
                                        ? (i
                                            .find('.main-content-wrap')
                                            .removeClass('show-content-wrap'),
                                            i
                                                .find('.side-content-wrap')
                                                .stop()
                                                .animate({ left: '-70%' }, 300),
                                            i
                                                .find('.middle-content-wrap')
                                                .removeClass(
                                                    'middle-show-content-wrap'
                                                ),
                                            i
                                                .find(
                                                    '.side-content-wrap .mobile-ico-close'
                                                )
                                                .remove(),
                                            e('.mobile-body-mask').remove())
                                        : (i
                                            .find('.main-content-wrap')
                                            .addClass('show-content-wrap'),
                                            i
                                                .find('.side-content-wrap')
                                                .stop()
                                                .animate({ left: '0' }, 300),
                                            i
                                                .find('.middle-content-wrap')
                                                .addClass(
                                                    'middle-show-content-wrap'
                                                ),
                                            i
                                                .find('.side-content-wrap')
                                                .append(
                                                    "<b class='mobile-ico-close'></b>"
                                                ),
                                            i
                                                .siblings('.mobile-head-item')
                                                .find('.main-content-wrap')
                                                .removeClass('show-content-wrap'),
                                            i
                                                .siblings('.mobile-head-item')
                                                .find('.side-content-wrap')
                                                .stop()
                                                .animate({ left: '-70%' }, 300),
                                            i
                                                .siblings('.mobile-head-item')
                                                .find('.middle-content-wrap')
                                                .removeClass(
                                                    'middle-show-content-wrap'
                                                ),
                                            i
                                                .siblings('.mobile-head-item')
                                                .find(
                                                    '.side-content-wrap .mobile-ico-close'
                                                )
                                                .remove(),
                                        e('.head-wrapper').length > 0 &&
                                        e('.head-wrapper').find(
                                            '.mobile-body-mask'
                                        ).length < 1 &&
                                        e('.head-wrapper').append(
                                            '<div class="mobile-body-mask"></div>'
                                        )),
                                        e('.mobile-body-mask').click(
                                            function() {
                                                e('.mobile-body-mask').remove(),
                                                    e(
                                                        '.mobile-head-item .main-content-wrap'
                                                    ).removeClass(
                                                        'show-content-wrap'
                                                    ),
                                                    e(
                                                        '.mobile-head-item .side-content-wrap'
                                                    ).animate(
                                                        { left: '-70%' },
                                                        300
                                                    ),
                                                    e(
                                                        '.mobile-head-item .middle-content-wrap'
                                                    ).removeClass(
                                                        'middle-show-content-wrap'
                                                    ),
                                                    e(
                                                        '.mobile-head-item .side-content-wrap .mobile-ico-close'
                                                    ).remove();
                                            }
                                        ),
                                        e('.mobile-ico-close').click(
                                            function() {
                                                e('.mobile-body-mask').remove(),
                                                    e(
                                                        '.mobile-head-item .main-content-wrap'
                                                    ).removeClass(
                                                        'show-content-wrap'
                                                    ),
                                                    e(
                                                        '.mobile-head-item .side-content-wrap'
                                                    )
                                                        .stop()
                                                        .animate(
                                                            { left: '-70%' },
                                                            300
                                                        ),
                                                    e(
                                                        '.mobile-head-item .middle-content-wrap'
                                                    ).removeClass(
                                                        'middle-show-content-wrap'
                                                    ),
                                                    e(
                                                        '.mobile-head-item .side-content-wrap .mobile-ico-close'
                                                    ).remove();
                                            }
                                        ),
                                        e(
                                            '.mobile-head-items .nav>li.arrow'
                                        ).click(function() {
                                            e(
                                                '.mobile-head-items .nav>li.arrow'
                                            ).toggleClass('on'),
                                                e(
                                                    '.mobile-head-items .nav>li.arrow .subnav'
                                                ).slideToggle();
                                        });
                                }
                            });
                    }),
                    e('.change-language .change-language-cont')
                        .clone()
                        .appendTo(
                            '.mobile-head-item.mobile-head-language .main-content-wrap .content-wrap'
                        ),
                    e('.head-search .head-search-form')
                        .clone()
                        .appendTo(
                            '.mobile-head-item.mobile-head-search .main-content-wrap .content-wrap'
                        ),
                    e('.nav-bar .nav')
                        .clone()
                        .appendTo(
                            '.mobile-head-item.mobile-head-nav .main-content-wrap .content-wrap'
                        ),
                    e('.head-social')
                        .clone()
                        .appendTo(
                            '.mobile-head-item.mobile-head-social .main-content-wrap .content-wrap'
                        ),
                    e('.aside .aside-wrap')
                        .clone()
                        .appendTo(
                            '.mobile-head-item.mobile-head-aside .main-content-wrap .content-wrap'
                        );
            }
        } else
            e(document).ready(function() {
                e(
                    '.mobile-body-mask,.mobile-head-items,.mobile-nav-items,.mobile-cart-items,.mobile-tab-items,.mobile-contact'
                ).remove(),
                    e('.nav')
                        .children('li')
                        .each(function() {
                            var i = e(this)
                                .children('a')
                                .children('em')
                                .text();
                            e(this)
                                .children('a')
                                .children('em')
                                .attr('data-hover', i);
                        }),
                    e('.nav li').each(function(n) {
                        e(this).children('ul').length > 0 &&
                        (e(this)
                            .children('a')
                            .find('.nav-ico').length < 1 &&
                        e(this)
                            .children('a')
                            .append("<i class='nav-ico'></i>"),
                            e(this).hover(
                                function() {
                                    var a = this;
                                    clearTimeout(t[n]),
                                        (i[n] = setTimeout(function() {
                                            e(a).addClass('li-hover');
                                        }, 50));
                                },
                                function() {
                                    var a = this;
                                    clearTimeout(i[n]),
                                        (t[n] = setTimeout(function() {
                                            e(a).removeClass('li-hover');
                                        }, 50));
                                }
                            ));
                    });
            }),
                e(document).ready(function() {
                    e('.aside .items_content').each(function() {
                        e(this).find('li').length > 1 &&
                        (e('.items_content').jCarouselLite({
                            btnPrev: '.btn-prev',
                            btnNext: '.btn-next',
                            speed: 300,
                            auto: !1,
                            scroll: 1,
                            visible: 5,
                            vertical: !0,
                            circular: !1,
                            onMouse: !0
                        }),
                            e('.aside .btn-prev').addClass('disabled'));
                    });
                });
    }
    e(function() {
        a();
    }),
        e(window).resize(function() {
            a();
        });
})(jQuery),
    (function(e) {
        function i(i, t) {
            return parseInt(e.css(i[0], t)) || 0;
        }
        e.fn.jCarouselLite = function(t) {
            return (
                (t = e.extend(
                    {
                        btnPrev: null,
                        btnNext: null,
                        btnGo: null,
                        mouseWheel: !1,
                        onMouse: !1,
                        auto: null,
                        speed: 500,
                        easing: null,
                        vertical: !1,
                        circular: !0,
                        visible: 4,
                        start: 0,
                        scroll: 1,
                        beforeStart: null,
                        afterEnd: null
                    },
                    t || {}
                )),
                    this.each(function() {
                        var n = !1,
                            a = t.vertical ? 'top' : 'left',
                            s = t.vertical ? 'height' : 'width',
                            o = e(this),
                            d = e('ul', o),
                            l = e('li', d),
                            c = l.size(),
                            r = t.visible,
                            h = 0;
                        t.circular &&
                        (d
                            .prepend(l.slice(c - r - 1 + 1).clone())
                            .append(l.slice(0, r).clone()),
                            (t.start += r));
                        var m = e('li', d),
                            u = m.size(),
                            p = t.start;
                        o.css('visibility', 'visible'),
                            m.css({
                                overflow: '',
                                float: t.vertical ? 'none' : 'left'
                            }),
                            d.css({
                                position: 'relative',
                                'list-style-type': 'none',
                                'z-index': '1'
                            }),
                            o.css({
                                overflow: 'hidden',
                                position: 'relative',
                                'z-index': '2',
                                left: '0px'
                            });
                        var f,
                            v = t.vertical
                                ? (f = m)[0].offsetHeight +
                                i(f, 'marginTop') +
                                i(f, 'marginBottom')
                                : (function(e) {
                                    return (
                                        e[0].offsetWidth +
                                        i(e, 'marginLeft') +
                                        i(e, 'marginRight')
                                    );
                                })(m),
                            w = v * u,
                            b = v * r;
                        function g() {
                            return m.slice(p).slice(0, r);
                        }
                        function $(i) {
                            if (!n) {
                                if (
                                    (t.beforeStart && t.beforeStart.call(this, g()),
                                        t.circular)
                                )
                                    i <= t.start - r - 1
                                        ? (d.css(a, -(u - 2 * r) * v + 'px'),
                                            (p =
                                                i == t.start - r - 1
                                                    ? u - 2 * r - 1
                                                    : u - 2 * r - t.scroll))
                                        : i >= u - r + 1
                                        ? (d.css(a, -r * v + 'px'),
                                            (p =
                                                i == u - r + 1
                                                    ? r + 1
                                                    : r + t.scroll))
                                        : (p = i);
                                else {
                                    if (i < 0 || i > u - r) return;
                                    p = i;
                                }
                                (n = !0),
                                    d.animate(
                                        'left' == a
                                            ? { left: -p * v }
                                            : { top: -p * v },
                                        t.speed,
                                        t.easing,
                                        function() {
                                            t.afterEnd &&
                                            t.afterEnd.call(this, g()),
                                                (n = !1);
                                        }
                                    ),
                                t.circular ||
                                (e(t.btnPrev + ',' + t.btnNext).removeClass(
                                    'disabled'
                                ),
                                    e(
                                        (p - t.scroll < 0 && t.btnPrev) ||
                                        (p + t.scroll > u - r &&
                                            t.btnNext) ||
                                        []
                                    ).addClass('disabled'));
                            }
                            return !1;
                        }
                        m.css({ width: m.width(), height: m.outerHeight() }),
                            d.css(s, w + 'px').css(a, -p * v),
                            o.css(s, b + 'px'),
                        t.btnPrev &&
                        e(t.btnPrev).click(function() {
                            return $(p - t.scroll);
                        }),
                        t.btnNext &&
                        e(t.btnNext).click(function() {
                            return $(p + t.scroll);
                        }),
                        t.btnGo &&
                        e.each(t.btnGo, function(i, n) {
                            e(n).click(function() {
                                return $(t.circular ? t.visible + i : i);
                            });
                        }),
                        t.mouseWheel &&
                        o.mousewheel &&
                        o.mousewheel(function(e, i) {
                            return $(i > 0 ? p - t.scroll : p + t.scroll);
                        }),
                        t.auto &&
                        (h = setInterval(function() {
                            $(p + t.scroll);
                        }, t.auto + t.speed)),
                        t.onMouse &&
                        (d.bind('mouseover', function() {
                            t.auto && clearInterval(h);
                        }),
                            d.bind('mouseout', function() {
                                t.auto &&
                                (h = setInterval(function() {
                                    $(p + t.scroll);
                                }, t.auto + t.speed));
                            }));
                    })
            );
        };
    })(jQuery),
    $(function() {
        var e = $('.nav-bar').offset().top,
            i = $('<span class="gotop"></span>')
                .appendTo($('body'))
                .text('top')
                .attr('title', 'top')
                .click(function() {
                    $('html, body').animate({ scrollTop: 0 }, 400);
                }),
            t = function() {
                var t = $(document).scrollTop(),
                    n = $(window).height();
                t > e ? i.addClass('active') : i.removeClass('active'),
                window.XMLHttpRequest || i.css('top', t + n - 210);
            };
        $(window).bind('scroll', t),
            $(function() {
                t();
            });
        var n = $('.head-wrapper'),
            a = $('.head-inner').outerHeight(),
            s = 0,
            o = $(window).width(),
            d = jQuery('<div class="head-fixed-holder"></div>');
        $(window).on('scroll', function() {
            var e = $(window).scrollTop();
            d.css('height', a),
                e > a && o > 980
                    ? (d.show().insertBefore(n), n.addClass('fixed-nav'))
                    : (d.hide(), n.removeClass('fixed-nav')),
                e > s && o > 980
                    ? n.removeClass('fixed-nav-appear')
                    : e < s && n.addClass('fixed-nav-appear'),
                (s = $(window).scrollTop());
        }),
            tabContainer('.tab-content-wrap', '.tab-title', '.tab-panel');
    }),
    $(document).ready(function() {
        if (
            ($('.side-widget .side-cate li').each(function() {
                $(this).find('ul').length > 0 &&
                ($(this).append(
                    "<span class='icon-cate icon-cate-down'></span>"
                ),
                    $(this)
                        .children('.icon-cate')
                        .click(function(e) {
                            var i = $(this).parent('li'),
                                t = $(this)
                                    .parent('li')
                                    .children('ul');
                            t.is(':hidden')
                                ? (i.addClass('active'),
                                    t.slideDown(100),
                                    $(this)
                                        .removeClass('icon-cate-down')
                                        .addClass('icon-cate-up'))
                                : (i.removeClass('active'),
                                    t.slideUp(100),
                                    $(this)
                                        .removeClass('icon-cate-up')
                                        .addClass('icon-cate-down')),
                                e.stopPropagation();
                        })),
                $(this).hasClass('active') &&
                ($(this)
                    .children('ul')
                    .show(),
                    $(this)
                        .parents('li')
                        .addClass('active'),
                    $(this)
                        .parents('li')
                        .children('ul')
                        .show(),
                $(this)
                    .children('.icon-cate')
                    .hasClass('icon-cate-up') ||
                ($(this)
                    .children('.icon-cate')
                    .addClass('icon-cate-up'),
                    $(this)
                        .parents('li')
                        .children('.icon-cate')
                        .addClass('icon-cate-up')));
            }),
                $('.side-widget .side-cate .nav-current').parents('ul').length >
                0 &&
                $('.side-widget .side-cate .nav-current').find('ul').length > 0
                    ? ($('.side-widget .side-cate .nav-current')
                        .parents('ul')
                        .show(),
                        $('.side-widget .side-cate .nav-current')
                            .parents('li')
                            .addClass('show_li'),
                        $('.side-widget .side-cate .nav-current')
                            .parents('li.show_li')
                            .children('.icon-cate')
                            .removeClass('icon-cate-down')
                            .addClass('icon-cate-up'),
                        $('.side-widget .side-cate .nav-current')
                            .children('ul')
                            .show(),
                        $('.side-widget .side-cate .nav-current ')
                            .children('.icon-cate')
                            .removeClass('icon-cate-down')
                            .addClass('icon-cate-up'))
                    : $('.side-widget .side-cate .nav-current').parents('ul')
                        .length > 0 &&
                    $('.side-widget .side-cate .nav-current').find('ul').length <
                    1
                    ? ($('.side-widget .side-cate .nav-current')
                        .parents('ul')
                        .show(),
                        $('.side-widget .side-cate .nav-current')
                            .parents('li')
                            .addClass('show_li'),
                        $('.side-widget .side-cate .nav-current')
                            .parents('li.show_li')
                            .children('.icon-cate')
                            .removeClass('icon-cate-down')
                            .addClass('icon-cate-up'))
                    : $('.side-widget .side-cate .nav-current').parents('ul')
                        .length < 1 &&
                    $('.side-widget .side-cate .nav-current').find('ul').length >
                    0 &&
                    ($('.side-widget .side-cate .nav-current')
                        .children('ul')
                        .show(),
                        $('.side-widget .side-cate .nav-current')
                            .children('.icon-cate')
                            .removeClass('icon-cate-down')
                            .addClass('icon-cate-up')),
                $('.gm-sep')
                    .contents()
                    .filter(function() {
                        return 3 === this.nodeType;
                    })
                    .remove(),
                $('.image-additional ul li').length > 0
                    ? $('.image-additional ul').owlCarousel({
                        autoplay: !1,
                        loop: !1,
                        margin: 0,
                        autoplayTimeout: 3e4,
                        smartSpeed: 180,
                        lazyLoad: !0,
                        mouseDrag: !0,
                        slideBy: 1,
                        responsive: {
                            0: { nav: !1, dots: !0, items: 1 },
                            951: { nav: !0, dots: !1, items: 4, margin: 20 }
                        }
                    })
                    : $('.image-additional ul li').addClass('single'),
                $('.goods-items').owlCarousel({
                    autoplay: !1,
                    loop: !0,
                    margin: 20,
                    dots: !0,
                    autoplayTimeout: 3e4,
                    smartSpeed: 180,
                    lazyLoad: !0,
                    responsive: {
                        0: { items: 1, slideBy: 1 },
                        321: { items: 2, slideBy: 2, margin: 10 },
                        769: { dots: !1, nav: !0, items: 3, slideBy: 3, margin: 25 }
                    }
                }),
                $('.banner_flexslider,.main-banner').flexslider({
                    animation: 'fade',
                    direction: 'horizontal',
                    animationLoop: !0,
                    slideshow: !0,
                    slideshowSpeed: 7e3,
                    animationSpeed: 600,
                    touch: !0
                }),
                $('.entry')
                    .find('img')
                    .parents('a')
                    .addClass('fancybox'),
                $('a.fancybox').fancybox(),
            (e = window.location.search).indexOf('uid') < 0 ||
            e.indexOf('pid') < 0)
        );
        else {
            var e = window.location.search,
                i = {},
                t = new RegExp('(^|&)uid=([^&]*)(&|$)'),
                n = e.substr(1).match(t),
                a = new RegExp('(^|&)pid=([^&]*)(&|$)'),
                s = e.substr(1).match(a);
            (i.uid = unescape(n[2])),
                (i.pid = unescape(s[2])),
                $.ajax({
                    url: '//tonpal.aiyongbao.com/email/emailProductTrack',
                    dataType: 'jsonp',
                    type: 'GET',
                    data: i,
                    timeout: 6e4,
                    success: function(e) {},
                    error: function(e) {}
                });
        }
        $('#contact-form').length > 0 &&
        $('#contact-form').validate({
            submitHandler: function(e) {
                $('#customer_submit_button')
                    .prop({ disabled: !0, value: 'Loading...' })
                    .addClass('disabled btn-success');
                var i = {};
                (i.post_name =
                    void 0 === e.product_title.value
                        ? ''
                        : e.product_title.value),
                    (i.name = e.name.value),
                    (i.email = e.email.value),
                    (i.phone = e.phone.value),
                    (i.message = e.message.value),
                    location.href.indexOf('?') > -1
                        ? (i.reference = location.href.split('?')[0])
                        : (i.reference = location.href),
                    $.ajax({
                        url: '/wp-json/portal/v1/inquiry',
                        type:'POST',
                        data: i,
                        success: function(e) {
                            $('#MessageSent').removeClass('hidden'),
                                $('#MessageNotSent').addClass('hidden'),
                                $('#customer_submit_button')
                                    .addClass('btn-success')
                                    .prop('value', 'Message Sent'),
                                setTimeout(function() {
                                    $('#MessageSent').addClass('hidden'),
                                        $('#customer_submit_button')
                                            .removeClass(
                                                'disabled btn-success'
                                            )
                                            .prop({
                                                disabled: !1,
                                                value: 'Send Message'
                                            });
                                }, 2e3);
                        },
                        error: function(e, i, t) {
                            $('#MessageNotSent').removeClass('hidden'),
                                $('#MessageSent').addClass('hidden'),
                                setTimeout(function() {
                                    $('#MessageNotSent').addClass('hidden'),
                                        $('#customer_submit_button')
                                            .removeClass(
                                                'disabled btn-success'
                                            )
                                            .prop({
                                                disabled: !1,
                                                value: 'Send Message'
                                            });
                                }, 2e3);
                        }
                    });
            },
            errorPlacement: function(e, i) {
                i.after(e);
            },
            onkeyup: !1,
            onclick: !1,
            rules: {
                name: { required: !0, minlength: 2 },
                email: { required: !0, email: !0 },
                subject: { required: !0 },
                message: { required: !0, minlength: 10 }
            },
            messages: {
                name: {
                    required: 'Please specify your name',
                    minlength: 'Your name must be longer than 2 characters'
                },
                email: {
                    required: 'We need your email address to contact you',
                    email:
                        'Please enter a valid email address e.g. name@domain.com'
                },
                subject: { required: 'Please enter a subject' },
                message: {
                    required: 'Please enter a message',
                    minlength:
                        'Your message must be longer than 10 characters'
                }
            },
            errorElement: 'span',
            highlight: function(e) {},
            success: function(e) {}
        });
    }),
    $(function() {
        /msie [6|7|8|9]/i.test(navigator.userAgent) ||
        new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: !1,
            live: !0
        }).init();
    }),
    $(function() {
        add($('.company-synopses .synopsis-item'), 0.1);
    }),
    $(function() {
        $('.search-toggle').on('click', function() {
            var e = $(this)
                    .parents('.head-wrapper')
                    .find('.tasking'),
                i =
                    ($(this).parents('.head-search'),
                        $(this).parents('.head-wrapper'));
            e.is(':hidden') ? e.show() : e.delay(600).hide(),
                i.hasClass('head-search-show')
                    ? i.removeClass('head-search-show')
                    : i.addClass('head-search-show');
        }),
            $('.head-search').on('click', function(e) {
                e.stopPropagation();
            }),
            $(document).on('click', function() {
                $('.head-wrapper .tasking')
                    .delay(600)
                    .fadeOut(),
                    $('.head-search .search-toggle').show(),
                    $('.head-wrapper').removeClass('head-search-show');
            });
    }),
    $(function() {
        $('.faq-item').each(function(e) {
            var i = $(this),
                t = i.find('.faq-title'),
                n = i.find('.faq-cont');
            0 == e && t.addClass('show-title'),
                t.on('click', function() {
                    n.is(':hidden') && !$(this).hasClass('show-title')
                        ? (n.slideDown('fast'),
                            $(this).addClass('show-title'),
                            i
                                .siblings()
                                .find('.faq-title')
                                .removeClass('show-title'),
                            i
                                .siblings()
                                .find('.faq-cont')
                                .slideUp('fast'))
                        : (n.slideUp('fast'),
                            $(this).removeClass('show-title'));
                });
        });
    }),
    $(function() {
        var e = new Date().getFullYear();
        $('.get-cur-year').length && $('.get-cur-year').html(e);
    });
