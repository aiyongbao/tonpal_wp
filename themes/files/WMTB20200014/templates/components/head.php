<?php
$theme_vars_header = json_config_array('header','vars',1);
$icon = ifEmptyText($theme_vars_header['icon']['value']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<link rel="apple-touch-icon-precomposed" href="">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<?php if (!empty($icon)) { ?>
    <link rel="shortcut icon" href="<?php echo $icon; ?>" />
<?php } ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/assets/css/style.css">
<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/assets/css/themes.css">
    <link href="//q.zvk9.com/plugins/tinymce.20170727.css" rel="stylesheet">
<?php get_href_lang($cat); ?>