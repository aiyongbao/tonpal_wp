<?php


// contacts.json -> vars 数据获取
$theme_vars = json_config_array('contacts','vars');
$theme_widgets_footer = json_config_array('footer','widgets',1);

//Text 数据处理
$contacts_title = ifEmptyText($theme_vars['title']['value']);

$phone = ifEmptyArray($theme_widgets_footer['phone']['vars']['items']['value'][0]);
$mobile = ifEmptyArray($theme_widgets_footer['mobile']['vars']['items']['value'][0]);
$email = ifEmptyArray($theme_widgets_footer['email']['vars']['items']['value'][0]);
$address = ifEmptyArray($theme_widgets_footer['address']['vars']['items']['value'][0]);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_description; ?>" />
    <meta name="description" content="<?php echo $seo_keywords; ?>" />

<?php get_template_part('templates/components/head'); ?>

</head>

<body>
<div class="container">
    <!-- header start -->
    <?php get_header() ?>
    <!--// header end  -->
    <!-- path -->
    <?php get_breadcrumbs();?>
    <!-- main_content start -->
    <div class="main_content">
        <div class="layout">
            <!--  aside start -->
            <?php get_template_part('templates/components/side-bar'); ?>
            <!--// aside end -->
            <!-- main begin -->
            <section class="main">
                <header class="main-tit-bar">
                    <h1 class="title"><?php echo $contacts_title?></h1>
                </header>
                <article class="blog-article">
                    <section class="contact-way clearfix">
                        <?php if (!empty($email)) { ?>
                            <dl class="email fl">
                                <dt><?php echo ifEmptyText($email['name'])?>:</dt>
                                <dd><a href="mailto:<?php echo ifEmptyText($email['name'])?>"><?php echo ifEmptyText($email['value'])?></a></dd>
                            </dl>
                        <?php } ?>
                        <?php if (!empty($phone)) { ?>
                            <dl class="phone fl">
                                <dt><?php echo ifEmptyText($phone['name'])?>:</dt>
                                <dd><a href="tel:<?php echo ifEmptyText($phone['name'])?>"><?php echo ifEmptyText($phone['value'])?></dd>

                            </dl>
                        <?php } ?>
                        <?php if (!empty($address)) { ?>
                            <dl class="address fl">
                                <dt><?php echo ifEmptyText($address['name'])?>:</dt>
                                <dd><a href="javascript:;"><?php echo ifEmptyText($address['value'])?></a></dd>
                            </dl>
                        <?php } ?>
                    </section>
                    <?php get_template_part( 'templates/components/sendMessage' )?>
                </article>
            </section>
            <!--// main end -->
        </div>
    </div>
    <!--// main_content end -->
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
    <!--  footer end -->
</div>
</body>
<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>