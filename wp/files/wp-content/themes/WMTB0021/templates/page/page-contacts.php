<?php


// contacts.json -> vars 数据获取
$theme_vars = json_config_array('contacts','vars');

//Text 数据处理
$contacts_title = ifEmptyText($theme_vars['title']['value'],'contacts');
$contacts_bg = ifEmptyText($theme_vars['bg']['value'],'https://iph.href.lu/1600x500?text=1600x500');
$contacts_desc = ifEmptyText($theme_vars['desc']['value'],'This is desc');
$contacts_modularTwo = ifEmptyText($theme_vars['modularTwo']['value']);
$contacts_contentDesc= ifEmptyText($theme_vars['contentDesc']['value']);
$contacts_tel = ifEmptyText($theme_vars['tel']['value']);
$contacts_email = ifEmptyText($theme_vars['email']['value']);
$contacts_address = ifEmptyText($theme_vars['address']['value']);
$contacts_latitude = ifEmptyText($theme_vars['latitude']['value']);
$contacts_longitude = ifEmptyText($theme_vars['longitude']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$contacts_title");
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

    <!-- preloader start -->
    <div class="preloader">
        <img src="<?php echo get_template_directory_uri()?>/assets/images/preloader.gif" alt="preloader">
    </div>
    <!-- preloader end -->

    <!-- header -->
    <?php get_header() ?>
    <!-- header -->

    <main>
        <!-- page title -->
        <section class="page-title-section overlay page-bg" data-background="<?php echo $contacts_bg; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <?php get_breadcrumbs();?>
                        <p class="text-lighten"><?php echo $contacts_desc; ?></p>
                    </div>
                </div>
            </div>
        </section>
        <!-- /page title -->

        <!-- contact -->
        <section class="section bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if ($contacts_modularTwo !== '') { ?>
                            <h2 class="section-title"><?php echo $contacts_modularTwo ?></h2>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 mb-4 mb-lg-0">
                        <?php get_template_part( 'templates/components/sendMessage' )?>
                    </div>
                    <div class="col-lg-5">
                        <p class="mb-5"><?php echo $contacts_contentDesc ?></p>
                        <a href="tel:<?php echo $contacts_tel ?>" class="text-color h5 d-block"><?php echo $contacts_tel ?></a>
                        <a href="mailto:<?php echo $contacts_email ?>" class="mb-5 text-color h5 d-block"><?php echo $contacts_email ?></a>
                        <p><?php echo $contacts_address ?></p>
                    </div>
                </div>
            </div>
        </section>
        <!-- /contact -->

    </main>
    <!-- google map -->
    <?php get_template_part( 'templates/components/footer' ); ?>



    </body>
<?php get_footer(); ?>
    <!--微数据-->
    <?php get_template_part( 'templates/components/microdata' )?>
</html>