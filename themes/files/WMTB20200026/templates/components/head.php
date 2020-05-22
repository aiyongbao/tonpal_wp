<?php
$theme_vars_header = json_config_array('header', 'vars', 1);
$icon = ifEmptyText($theme_vars_header['icon']['value']);
?>
<meta charset="UTF-8">

<?php if (!empty($icon)) { ?>
    <link rel="shortcut icon" href="<?php echo $icon; ?>" />
<?php } ?>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<link rel="apple-touch-icon-precomposed" href="">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link href="//q.zvk9.com/Model20/assets/css/main.css" rel="stylesheet">
<link href="//q.zvk9.com/Model20/assets/css/style.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="//q.zvk9.com/Model20/assets/css/language.css" />
<link type="text/css" rel="stylesheet" href="//q.zvk9.com/Model20/assets/css/custom_service_on.css" />
<link type="text/css" rel="stylesheet" href="//q.zvk9.com/Model20/assets/css/custom_service_off.css" />
<link type="text/css" rel="stylesheet" href="//q.zvk9.com/Model20/assets/css/bottom_service.css" />
<link href="//q.zvk9.com/plugins/tinymce.20170727.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/assets/css/them.css">

<?php get_href_lang($cat) ?>
