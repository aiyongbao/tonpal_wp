<?php
$theme_vars_header = json_config_array('header','vars',1);
$icon = ifEmptyText($theme_vars_header['icon']['value']);
$googleId = get_option('google_id');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<link rel="apple-touch-icon-precomposed" href="">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link href="//q.zvk9.com/Model15/assets/css/main.css" rel="stylesheet">
<?php if (!empty($icon)) { ?>
    <link rel="shortcut icon" href="<?php echo $icon; ?>" />
<?php } ?>
<link href="//q.zvk9.com/Model15/assets/css/style.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="//q.zvk9.com/Model15/assets/css/language.css" />
<link type="text/css" rel="stylesheet" href="//q.zvk9.com/Model15/assets/css/custom_service_on.css" />
<link type="text/css" rel="stylesheet" href="//q.zvk9.com/Model15/assets/css/custom_service_off.css" />
<link type="text/css" rel="stylesheet" href="//q.zvk9.com/Model15/assets/css/bottom_service.css" />
<link type="text/css" rel="stylesheet" href="//q.zvk9.com/Model15/assets/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="//q.zvk9.com/Model15/assets/css/swiper.min.css">
<link href="//q.zvk9.com/plugins/tinymce.20170727.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/assets/css/style.css">
<?php get_href_lang($cat); ?>
<?php if( ifEmptyText($googleId) !== '') {
    echo $googleId;
}?>
