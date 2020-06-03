<?php


// contacts.json -> vars 数据获取
$theme_vars = json_config_array('contacts', 'vars');
$theme_widgets_footer = json_config_array('footer', 'widgets', 1);

//Text 数据处理
$contacts_title = ifEmptyText($theme_vars['title']['value']);
$contacts_desc = ifEmptyText($theme_vars['desc']['value']);
set_query_var('contactsDesc', $contacts_desc);
$phone = ifEmptyArray($theme_widgets_footer['phone']['vars']['items']['value'][0]);
$mobile = ifEmptyArray($theme_widgets_footer['mobile']['vars']['items']['value'][0]);
$email = ifEmptyArray($theme_widgets_footer['email']['vars']['items']['value'][0]);
$address = ifEmptyArray($theme_widgets_footer['address']['vars']['items']['value'][0]);
$company = ifEmptyArray($theme_widgets_footer['company']['vars']['items']['value'][0]);

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
    <style>
        .product-detail {
            position: relative;
            overflow: visible;
            margin: 50px 0 0;
        }
        .powered :after {
            content: "";
            display: inherit;
            clear: both;
            visibility: hidden;
            height: 0;
}
       
        
    </style>

</head>

<body>
    <div class="container">
        <!-- header start -->
        <?php get_header() ?>
        <!--// header end  -->
        <!-- path -->
        <nav class="path-bar">
            <?php get_breadcrumbs(); ?>
        </nav>
        <!-- main_content start -->
        <section class="page-layout">
            <section class="layout">
                <!--  aside start -->
                <?php get_template_part('templates/components/side-bar'); ?>
                <!--// aside end -->
                <!-- main begin -->
                <section class="main">
                    <div class="product-intro">
                        <h1 class="product-title"><?php echo $contacts_title ?></h1>
                    </div>
                    <div class="tab-content-wrap product-detail">
                        <div class="tab-panel-wrap">
                            <div class="tab-panel">
                                <div class="tab-panel-content entry">
                                    <?php if (!empty($company)) { ?>
                                        <p><strong><?php echo ifEmptyText($company['name']) ?></strong><?php echo ifEmptyText($company['value']) ?></p>
                                    <?php } ?>
                                    <?php if (!empty($address)) { ?>
                                        <p><strong><?php echo ifEmptyText($address['name']) ?></strong><?php echo ifEmptyText($address['value']) ?></p>
                                    <?php } ?>
                                    <?php if (!empty($mobile)) { ?>
                                        <p><strong><?php echo ifEmptyText($mobile['name']) ?></strong>
                                            <?php echo ifEmptyText($mobile['value']) ?></p>
                                    <?php } ?>
                                    <?php if (!empty($phone)) { ?>
                                        <p><strong><?php echo ifEmptyText($phone['name']) ?></strong>
                                            <?php echo ifEmptyText($phone['value']) ?></p>
                                    <?php } ?>
                                    <?php if (!empty($email)) { ?>
                                        <p><strong><?php echo ifEmptyText($email['name']) ?></strong>
                                            <?php echo ifEmptyText($email['value']) ?></p>
                                    <?php } ?>
                                    
                                    <p><br /><br /><br /><br /></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php get_template_part('templates/components/sendMessage') ?>
                    </article>
                </section>
                <!--// main end -->
            </section>
        </section>
        <!--// main_content end -->
        <!--  footer start -->
        <?php get_template_part('templates/components/footer'); ?>
        <!--  footer end -->
    </div>
</body>
<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>