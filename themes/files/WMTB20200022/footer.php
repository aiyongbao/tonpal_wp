<?php
$gooleId = ifEmptyText(get_query_var('gooldId'));
?>
<script src="//q.zvk9.com/Model15/assets/js/jquery.min.js"></script>
<script src="//q.zvk9.com/Model15/assets/js/language.js"></script>
<script src="//q.zvk9.com/Model15/assets/js/jquery.validate.min.js"></script>
<script type='text/javascript' src='//q.zvk9.com/Model15/assets/js/jquery.themepunch.tools.min.js'></script>
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

</script>
<?php if( ifEmptyText($gooleId) !== '') {
    echo $gooleId;
}?>
