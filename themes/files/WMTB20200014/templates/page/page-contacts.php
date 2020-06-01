<?php


// contacts.json -> vars 数据获取
$theme_vars = json_config_array('contacts','vars');
$theme_widgets_footer = json_config_array('footer','widgets',1);

//Text 数据处理
$contacts_title = ifEmptyText($theme_vars['title']['value']);
$contacts_desc = ifEmptyText($theme_vars['desc']['value']);
$contacts_image = ifEmptyText($theme_vars['image']['value']);
$phone = ifEmptyArray($theme_widgets_footer['phone']['vars']['items']['value']);
$mobile = ifEmptyArray($theme_widgets_footer['mobile']['vars']['items']['value']);
$email = ifEmptyArray($theme_widgets_footer['email']['vars']['items']['value']);
$address = ifEmptyArray($theme_widgets_footer['address']['vars']['items']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>
<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>
    <meta charset="utf-8">
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

<?php get_template_part('templates/components/head'); ?>

</head>

<body>
<div class="container">

    <!-- web_head start -->
    <?php get_header() ?>
    <!--// web_head end -->

    <!-- path -->
    <?php get_breadcrumbs();?>

    <!-- page-layout start -->
    <section class="web_main page_main">
        <div class="layout">
            <!-- aside start -->
            <?php get_template_part('templates/components/side-bar'); ?>
            <!--// aside end -->

            <!--// main start -->
            <section class="main contact" >
                <header class="border-bottom-2 mb-10">
                    <h1 class="ellipsis-1"><?php echo $contacts_title ?></h1>
                </header>
                <div class="page-desc mt-15 ellipsis-8">
                    <?php echo $contacts_desc; ?>
                </div>
                <article class="blog-article">
                    <section class="mt15 contacts-box">
                        <?php if (!empty($email)) { ?>
                            <div class="contact-email">
                                <i></i>
                                <?php foreach ($email as $item ) { ?>
                                    <span><?php echo $item['value'] ?></span>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php if (!empty($phone)) { ?>
                            <div class="contact-phone">
                                <i></i>
                                <?php foreach ($phone as $item ) { ?>
                                    <span><?php echo $item['value'] ?></span>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php if (!empty($mobile)) { ?>
                            <div class="contact-mobile">
                                <i></i>
                                <?php foreach ($mobile as $item ) { ?>
                                    <span><?php echo $item['value'] ?></span>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php if (!empty($address)) { ?>
                            <div class="contact-address">
                                <i></i>
                                <?php foreach ($address as $item ) { ?>
                                    <span><?php echo $item['value'] ?></span>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </section>
                    <?php if (!empty($contacts_image)) { ?>
                        <div class="contact-image">
                            <img src="<?php echo $contacts_image; ?>" alt="<?php echo $contacts_title ?>" width="100%" />
                        </div>
                    <?php } ?>
                </article>
                <?php get_template_part( 'templates/components/sendMessage' )?>
            </section>
            <!--// main end -->
        </div>
    </section>
    <!--// page-layout end -->

    <!-- web_footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
    <!--// web_footer end -->
</div>

</body>
<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>