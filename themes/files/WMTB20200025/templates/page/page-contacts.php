<?php
// contacts.json -> vars 数据获取
$theme_vars = json_config_array('contacts', 'vars');
$theme_widgets_footer = json_config_array('footer', 'widgets', 1);

$contacts_title = ifEmptyText($theme_vars['title']['value']);
$contacts_desc = ifEmptyText($theme_vars['desc']['value']);
$contacts_img = ifEmptyText($theme_vars['img']['value']);
set_query_var('contactsDesc', $contacts_desc);

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
    <!-- SEO -->
    <title><?php echo $seo_title; ?></title>
    <meta name="description" content="<?php echo $seo_description; ?>" />
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <link rel="canonical" href="<?php echo $page_url; ?>" />
    <?php get_template_part('templates/components/head'); ?>
</head>

<body>
    <div class="container">
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->

        <!-- path -->
        <?php get_breadcrumbs(); ?>

        <!-- main_content start -->
        <div class="main_content">
            <div class="layout">
                <!--  aside start -->
                <?php get_template_part('templates/components/side-bar'); ?>
                <!--// aside end -->

                <!-- main begin -->
                <section class="main page-contacts">
                    <!-- <header class="main-tit-bar mb-35">
                        <h1 class="title"><?php echo $contacts_title ?></h1>
                    </header> -->

                    <div class="page-contacts-content">
                        <p style="margin: 0;"><?php echo $contacts_desc; ?></p>
                    </div>

                    <ul class="contacts-ul">
                        <?php if (!empty($email)) { ?>
                            <li class="email">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/image/icon/1-1.png" alt="">
                                <?php foreach ($email as $item) { ?>
                                    <span><?php echo $item['value'] ?></span>
                                <?php } ?>
                            </li>
                        <?php } ?>
                        <?php if (!empty($phone)) {  ?>
                            <li class="phone">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/image/icon/1-2.png" alt="">
                                <?php foreach ($phone as $item) { ?>
                                    <span><?php echo $item['value'] ?></span>
                                <?php } ?>
                            </li>
                        <?php } ?>
                        <?php if (!empty($mobile)) {  ?>
                            <li class="mobile">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/image/icon/1-3.png" alt="">
                                <?php foreach ($mobile as $item) { ?>
                                    <span><?php echo $item['value'] ?></span>
                                <?php } ?>
                            </li>
                        <?php } ?>
                        <?php if (!empty($address)) {  ?>
                            <li class="address">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/image/icon/1-4.png" alt="">
                                <?php foreach ($address as $item) { ?>
                                    <span><?php echo $item['value'] ?></span>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>

                    <?php if ($contacts_img !== '') { ?>
                        <div class="page-contacts-img">
                            <img src="<?php echo $contacts_img ?>" alt="">
                        </div>
                    <?php } ?>

                    <?php get_template_part('templates/components/send-message') ?>
                </section>
                <!--// main end -->
            </div>
        </div>
        <!--// main_content end -->

        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
    </div>
</body>

<?php get_footer(); ?>

<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>