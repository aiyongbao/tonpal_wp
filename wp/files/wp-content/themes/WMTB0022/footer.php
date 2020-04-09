<?php
$GA = get_query_var('GA');
$goole_id = '';
?>
<script src="//q.zvk9.com/Model15/assets/js/jquery.min.js"></script>
<script src="//q.zvk9.com/Model15/assets/js/language.js"></script>
<script src="//q.zvk9.com/Model15/assets/js/jquery.validate.min.js"></script>
<script type='text/javascript' src='//q.zvk9.com/Model15/assets/js/jquery.themepunch.tools.min.js'></script>
<!--<script src="//q.zvk9.com/Model15/assets/js/common.js"></script> 无用测试完毕删除-->
<script src="//q.zvk9.com/Model15/assets/js/wow.js"></script>
<script type="text/javascript" src="//q.zvk9.com/Model15/assets/js/bottom_service.js"></script>
<script src="//q.zvk9.com/Model15/assets/js/owl.carousel.js"></script>
<script type="text/javascript" src="//q.zvk9.com/Model15/assets/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="//q.zvk9.com/Model15/assets/js/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="//q.zvk9.com/Model15/assets/js/cloud-zoom.1.0.3.js"></script>
<script src="//q.zvk9.com/Model15/assets/js/jquery.cookie.js"></script>

<!--[if lt IE 9]>
<script src="//q.zvk9.com/Model15/assets/js/html5.js"></script>
<![endif]-->
<script src="<?php echo get_template_directory_uri()?>/assets/js/common.js"></script>
<script>
    // $(function () {
    //     init();
    // });
    //
    // function init(){
    //     var url = '//tonpal.aiyongbao.com/hm/index';
    //     var data = {{hm}};
    //
    //     data['address'] = window.location.href;
    //
    //     $.post(url,data,function (res) {
    //         console.log(res);
    //     });
    // }
</script>

<script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', '<?php echo $GA ?>', {'siteSpeedSampleRate': 100});
        ga('send', 'pageview');
</script>
<?php if( ifEmptyText($goole_id) !== '') {
    echo $goole_id;
}?>
