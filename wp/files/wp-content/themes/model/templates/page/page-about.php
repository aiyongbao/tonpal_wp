<?php
// about.json -> vars 数据获取
$theme_vars = json_config_array('about','vars');
// Array 数据处理
$about_modularThree_value = ifEmptyArray($theme_vars['modularThree']['value']);
$about_modularFour_value = ifEmptyArray($theme_vars['modularFour']['value']);
$about_modularFiveItem_value = ifEmptyArray($theme_vars['modularFiveItem']['value']);

//Text 数据处理
$about_title = ifEmptyText($theme_vars['title']['value'],'About');
$about_bg = ifEmptyText($theme_vars['bg']['value'],'https://iph.href.lu/1600x500?text=1600x500');
$about_desc = ifEmptyText($theme_vars['desc']['value']);
$about_modularTwo_value = ifEmptyText($theme_vars['modularTwo']['value']);
$about_modularFiveTitle_value = ifEmptyText($theme_vars['modularFiveTitle']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$about_title");
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>

    <!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <!-- SEO -->
        <title><?php echo $seo_title; ?></title>
        <meta name="keywords" content="<?php echo $seo_description; ?>" />
        <meta name="description" content="<?php echo $seo_keywords; ?>" />

        <?php get_template_part('templates/components/head'); ?>

    </head>

    <body>
    <!-- header -->
    <?php get_header() ?>
    <!-- header -->

    <main>
        <!-- page title -->
        <section class="page-title-section overlay" data-background="<?php echo $about_bg; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <?php get_breadcrumbs();?>
                        <p class="text-lighten"><?php echo $about_desc; ?></p>
                    </div>
                </div>
            </div>
        </section>
        <!-- /page title -->

        <!-- about -->
        <section class="section">
            <div class="container">
                <div class="row">
                <div class="col-12">
                    <?php if ($about_modularTwo_value !== '') { ?>
                             <img class="img-fluid w-100 mb-4" src="<?php echo $about_modularTwo_value ?>" alt="about image">
                    <?php } ?>
                    <?php $post = get_post(); ?>
                    <h2 class="section-title"><?php echo $post->post_title ?></h2>
                    <?php echo $post->post_content ?>
                </div>

                </div>
            </div>
        </section>
        <!-- /about -->

        <!-- funfacts -->
        <section class="section-sm bg-primary">
            <div class="container">
                <div class="row">
                    <!-- funfacts item -->
                <?php
                    foreach ($about_modularThree_value as $key => $item) {
                        if ($key <= 3) {
                            ?>
                        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                            <div class="text-center">
                                <h2 class="count text-white" data-count="<?php echo ifEmptyText($item['value']) ?>">0</h2>
                                <h5 class="text-white"><?php echo ifEmptyText($item['type']) ?></h5>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                </div>
            </div>
        </section>
        <!-- /funfacts -->

        <!-- success story -->
        <?php
        foreach ($about_modularFour_value as $key => $item) {
            if ($key == 0) {
                ?>
                <section class="section bg-cover" data-background="<?php echo ifEmptyText($item['bg'],'https://iph.href.lu/1280x720?text=1280x720') ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-sm-4 position-relative success-video">
                                <a class="play-btn venobox" href="<?php echo ifEmptyText($item['video'],'##') ?>" data-vbtype="video">
                                    <i class="ti-control-play"></i>
                                </a>
                            </div>
                            <div class="col-lg-6 col-sm-8">
                                <div class="bg-white p-5">
                                    <h2 class="section-title"><?php echo ifEmptyText($item['title'],'This is title') ?></h2>
                                    <p><?php echo ifEmptyText($item['desc1'],'This is desc') ?></p>
                                    <p><?php echo ifEmptyText($item['desc2']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            }
        }
        ?>
        <!-- /success story -->

        <!-- teachers -->
        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                    <?php if ($about_modularFiveTitle_value !== '') { ?>
                        <h2 class="section-title">Our Teachers</h2>
                    <?php } ?>
                    </div>
                    <!-- teacher -->
                    <?php
                    foreach ($about_modularFiveItem_value as $key => $item) {
                        if ($key <= 2) {
                            ?>
                            <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                                <div class="card border-0 rounded-0 hover-shadow">
                                    <img class="card-img-top rounded-0" src="<?php echo ifEmptyText($item['image'],'https://iph.href.lu/350x395?text=350x395') ?>" alt="<?php echo ifEmptyText($item['name']) ?>">
                                    <div class="card-body">
                                        <a href="teacher-single.html">
                                            <h4 class="card-title"><?php echo ifEmptyText($item['name'],'This is name') ?></h4>
                                        </a>
                                        <div class="d-flex justify-content-between">
                                            <span><?php echo ifEmptyText($item['position'],'This is position') ?></span>
                                            <ul class="list-inline">
                                                <?php if (ifEmptyText($item['facebook']) !== '') { ?>
                                                    <li class="list-inline-item"><a class="text-color" href="<?php echo ifEmptyText($item['name']) ?>"><i class="ti-facebook"></i></a></li>
                                                <?php } ?>
                                                <?php if (ifEmptyText($item['twitter']) !== '') { ?>
                                                    <li class="list-inline-item"><a class="text-color" href="<?php echo ifEmptyText($item['name']) ?>"><i class="ti-twitter-alt"></i></a></li>
                                                <?php } ?>
                                                <?php if (ifEmptyText($item['google']) !== '') { ?>
                                                    <li class="list-inline-item"><a class="text-color" href="<?php echo ifEmptyText($item['name']) ?>"><i class="ti-google"></i></a></li>
                                                <?php } ?>
                                                <?php if (ifEmptyText($item['linkedin']) !== '') { ?>
                                                    <li class="list-inline-item"><a class="text-color" href="<?php echo ifEmptyText($item['name']) ?>"><i class="ti-linkedin"></i></a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- /teachers -->
    </main>
    <?php get_template_part( 'templates/components/footer' ); ?>
    </body>
    <?php get_footer(); ?>
</html>

