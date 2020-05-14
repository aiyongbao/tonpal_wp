<?php
$theme_vars_header = json_config_array('header', 'vars', 1);
$icon = ifEmptyText($theme_vars_header['icon']['value']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<?php if (!empty($icon)) { ?>
    <link rel="shortcut icon" href="<?php echo $icon; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/assets/css/style.css">
<link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//q.zvk9.com/plugins/tinymce.20170727.css">
<?php get_href_lang($cat) ?>
