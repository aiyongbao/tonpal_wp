<?php
$googleId = get_option('google_id');
?>
<!--[if lt IE 9]>
<script src="//q.zvk9.com/Model20/assets/js/html5.js"></script>
<![endif]-->
<script src="//q.zvk9.com/Model20/assets/js/jquery.min.js"></script>
<script src="//q.zvk9.com/Model20/assets/js/language.js"></script>
<script type='text/javascript' src='//q.zvk9.com/Model20/assets/js/jquery.themepunch.tools.min.js'></script>
<script src="<?php echo get_template_directory_uri()?>/assets/js/common.js"></script>
<script src="//q.zvk9.com/Model20/assets/js/wow.js"></script>
<script type="text/javascript" src="//q.zvk9.com/Model20/assets/js/bottom_service.js"></script>
<script src="//q.zvk9.com/Model20/assets/js/owl.carousel.js"></script>
<script type="text/javascript" src="//q.zvk9.com/Model20/assets/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="//q.zvk9.com/Model20/assets/js/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="//q.zvk9.com/Model20/assets/js/cloud-zoom.1.0.3.js"></script>
<script src="//q.zvk9.com/Model20/assets/js/jquery.cookie.js"></script>
<script type="text/javascript" src="//q.zvk9.com/Model20/assets/js/custom_service.js"></script>
<script type="text/javascript" src="//q.zvk9.com/Model20/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="//q.zvk9.com/Model20/assets/js/masonry-docs.js"></script>
<script>

</script>
<?php if( ifEmptyText($googleId) !== '') {
    echo $googleId;
}?>
