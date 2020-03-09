<!doctype html>
<title>Educenter</title>
<head>
    <meta charset="utf-8">
    <link rel="canonical" href="<?php echo home_url();?>" />
    <?php get_template_part( 'templates/components/head' )?>
    <style>
        .hero-section {
            padding: 300px 0 290px;
        }
    </style>
</head>

<body>

<?php
// widgets 数据处理
$theme_widgets = json_config_array(__FILE__,'widgets');
set_query_var('theme_widgets', $theme_widgets);

// home.json -> vars 数据获取
$theme_vars = json_config_array(__FILE__,'vars');
// Array 数据处理
$home_special_value = ifEmptyArray($theme_vars['special']['value']);
$home_about_value = ifEmptyArray($theme_vars['about']['value']);
$home_hotProductTitle_value = ifEmptyArray($theme_vars['hotProductTitle']['value']);
$home_hotProductItem_value = ifEmptyArray($theme_vars['hotProductItem']['value']);
$home_modularFour_value = ifEmptyArray($theme_vars['modularFour']['value']);
$home_modularFive_value = ifEmptyArray($theme_vars['modularFive']['value']);
$home_modularSixTitle_value = ifEmptyArray($theme_vars['modularSixTitle']['value']);
$home_modularSixItem_value = ifEmptyArray($theme_vars['modularSixItem']['value']);
$home_modularSevenItem_value = ifEmptyArray($theme_vars['modularSevenItem']['value']);

// Text 数据处理
$home_modularSevenTitle_value = ifEmptyText($theme_vars['modularSevenTitle']['value'],'Latest News');

?>
    <!-- preloader start -->
    <div class="preloader">
        <img src="<?php echo get_template_directory_uri()?>/assets/images/preloader.gif" alt="preloader">
    </div>
    <!-- preloader end -->

    <!-- header -->
    <?php get_header()?>
    <!-- /header -->

    <!-- carousel -->
    <?php get_template_part( 'templates/components/carousel' ); ?>
    <!-- /carousel -->

    <!-- banner-feature -->
    <section class="bg-gray">
      <div class="container-fluid p-0">
        <div class="row no-gutters">
          <div class="col-xl-4 col-lg-5 align-self-end">
            <img class="img-fluid w-100" src="<?php echo get_template_directory_uri()?>/assets/images/banner/banner-feature.png" alt="banner-feature">
          </div>
          <div class="col-xl-8 col-lg-7">
            <div class="row feature-blocks bg-gray justify-content-between">
                <?php
                    foreach ($home_special_value as $key => $item) {
                        if ($key <= 3) {
                        ?>
                        <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
                            <i class="<?php echo ifEmptyText($item['icon']) ?> mb-xl-4 mb-lg-3 mb-4 feature-icon"></i>
                            <?php
                            if (ifEmptyText($item['link'] !== ''))
                            {
                            ?>
                            <a href="<?php echo ifEmptyText($item['link']) ?>">
                                <h3 class="mb-xl-4 mb-lg-3 mb-4"><?php echo ifEmptyText($item['title']) ?></h3>
                            </a>
                            <?php
                                } else {
                            ?>
                                <h3 class="mb-xl-4 mb-lg-3 mb-4"><?php echo ifEmptyText($item['title']) ?></h3>
                            <?php
                            }
                             ?>
                            <p><?php echo ifEmptyText($item['desc']) ?></p>
                        </div>
                        <?php

                            }
                    }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /banner-feature -->


    <!-- about us -->
    <section class="section">
      <div class="container">
        <div class="row align-items-center">
             <?php
                foreach ($home_about_value as $key => $item) {
                    if ($key == 0) {
                        ?>
                        <div class="col-md-6 order-2 order-md-1">
                            <h2 class="section-title"><?php echo ifEmptyText($item['title'],'About US') ?></h2>
                            <p><?php echo ifEmptyText($item['desc1']) ?></p>
                            <p><?php echo ifEmptyText($item['desc2']) ?></p>
                            <a href="<?php echo ifEmptyText($item['link'],'about.html') ?>" class="btn btn-primary-outline">Learn more</a>
                        </div>
                        <div class="col-md-6 order-1 order-md-2 mb-4 mb-md-0">
                            <img class="img-fluid w-100"
                                 src="<?php echo ifEmptyText($item['icon'],get_template_directory_uri().'/assets/images/about/about-us.jpg') ?>"
                                 alt="<?php echo ifEmptyText($item['title']) ?>">
                        </div>
                        <?php
                    }
                }
          ?>
        </div>
      </div>
    </section>
    <!-- /about us -->

    <!-- courses -->
    <section class="section-sm">
      <div class="container">
        <div class="row">
          <div class="col-12">
              <?php
                foreach ($home_hotProductTitle_value as $key => $item) {
                    if ($key == 0) {
                        ?>
                        <div class="d-flex align-items-center section-title justify-content-between">
                            <h2 class="mb-0 text-nowrap mr-3"><?php echo ifEmptyText($item['title'], "HOT PRODUCT") ?></h2>
                            <div class="border-top w-100 border-primary d-none d-sm-block"></div>
                            <div>
                                <a href="<?php echo ifEmptyText($item['link'], "##") ?>"
                                   class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block"><?php echo ifEmptyText($item['btn'], "see all") ?></a>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
          </div>
        </div>
          <!-- course list -->
            <div class="row justify-content-center">
              <!-- course item -->
                <?php
                foreach ($home_hotProductItem_value as $key => $item) {
                    if ($key <= 5) {
                        ?>
                        <div class="col-lg-4 col-sm-6 mb-5">
                            <div class="card p-0 border-primary rounded-0 hover-shadow">
                                <img class="card-img-top rounded-0"
                                     src="<?php echo ifEmptyText($item['image']) ?>"
                                     alt="<?php echo ifEmptyText($item['title']) ?>">
                                <div class="card-body">
                                    <a href="<?php echo ifEmptyText($item['link']) ?>">
                                        <h4 class="card-title"><?php echo ifEmptyText($item['title']) ?></h4>
                                    </a>
                                    <p class="card-text mb-4"><?php echo ifEmptyText($item['desc']) ?></p>
                                    <a href="<?php echo ifEmptyText($item['link']) ?>" class="btn btn-primary btn-sm"><?php echo ifEmptyText($item['btn'],"GET TO") ?></a>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
                ?>

            </div>

          <!-- /course list -->
        <!-- mobile see all button -->
        <div class="row">
          <div class="col-12 text-center">
              <?php
                foreach ($home_hotProductTitle_value as $key => $item) {
                    if ($key == 0) {
                        ?>
                            <a href="<?php echo ifEmptyText($item['link'], "##") ?>" class="btn btn-sm btn-primary-outline d-sm-none d-inline-block"><?php echo ifEmptyText($item['btn'], "see all") ?></a>
                        <?php
                    }
                }
              ?>
          </div>
        </div>
      </div>
    </section>
    <!-- /courses -->

    <!-- cta -->
    <section class="section bg-primary">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
               <?php
                foreach ($home_modularFour_value as $key => $item) {
                    if ($key == 0) {
                        ?>
                        <h6 class="text-white font-secondary mb-0"><?php echo ifEmptyText($item['desc1']) ?></h6>
                        <h2 class="section-title text-white"><?php echo ifEmptyText($item['desc2']) ?>g</h2>
                        <a href="<?php echo ifEmptyText($item['link'], "##") ?>" class="btn btn-secondary"><?php echo ifEmptyText($item['btn'], "Join Now") ?></a>
                        <?php
                    }
                }
               ?>
          </div>
        </div>
      </div>
    </section>
    <!-- /cta -->

    <!-- success story -->
        <?php
            foreach ($home_modularFive_value as $key => $item) {
                if ($key == 0) {
                    ?>
                    <section class="section bg-cover" data-background="<?php echo ifEmptyText($item['bg']) ?>">
                        <div class="container">
                        <div class="row">
                          <div class="col-lg-6 col-sm-4 position-relative success-video">
                            <a class="play-btn venobox" href="<?php echo ifEmptyText($item['video']) ?>" data-vbtype="video">
                              <i class="ti-control-play"></i>
                            </a>
                          </div>
                          <div class="col-lg-6 col-sm-8">
                            <div class="bg-white p-5">
                              <h2 class="section-title"><?php echo ifEmptyText($item['title']) ?></h2>
                              <p><?php echo ifEmptyText($item['desc1']) ?></p>
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

    <!-- events -->
    <section class="section bg-gray">
      <div class="container">
        <div class="row">
          <div class="col-12">
               <?php
                foreach ($home_modularSixTitle_value as $key => $item) {
                    if ($key == 0) {
                        ?>
                        <div class="d-flex align-items-center section-title justify-content-between">
                          <h2 class="mb-0 text-nowrap mr-3"><?php echo ifEmptyText($item['title']) ?></h2>
                          <div class="border-top w-100 border-primary d-none d-sm-block"></div>
                          <div>
                            <a href="<?php echo ifEmptyText($item['link'],'##') ?>" class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block"><?php echo ifEmptyText($item['btn'],'see all') ?></a>
                          </div>
                        </div>
                        <?php
                    }
                }
               ?>
          </div>
        </div>
        <div class="row justify-content-center">
          <!-- event -->
            <?php
                foreach ($home_modularSixItem_value as $key => $item) {
                    if ($key <= 2) {
                        ?>
                      <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                        <div class="card border-0 rounded-0 hover-shadow">
                          <div class="card-img position-relative">
                            <img class="card-img-top rounded-0" src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['title']) ?>">
                              <?php
                              if (ifEmptyText($item['customTop']) !== '' && ifEmptyText($item['customBtm'] !== '' )) {
                                  ?>
                                  <div class="card-date">
                                      <span><?php echo ifEmptyText($item['customTop']) ?></span><br><?php echo ifEmptyText($item['customBtm']) ?>
                                  </div>
                                  <?php
                              }
                            ?>
                          </div>
                          <div class="card-body">
                            <!-- location -->
                            <p><i class="ti-location-pin text-primary mr-2"></i><?php echo ifEmptyText($item['title']) ?></p>
                            <a href="<?php echo ifEmptyText($item['link'],'##') ?>"><h4 class="card-title"><?php echo ifEmptyText($item['title']) ?></h4></a>
                          </div>
                        </div>
                      </div>
                        <?php
                    }
                }
            ?>

        </div>
        <!-- mobile see all button -->
        <div class="row">
          <div class="col-12 text-center">
              <?php
                foreach ($home_modularSixTitle_value as $key => $item) {
                    if ($key == 0) {
                        ?>
                        <a href="<?php echo ifEmptyText($item['link'],'##') ?>" class="btn btn-sm btn-primary-outline d-sm-none d-inline-block"><?php echo ifEmptyText($item['btn'],'see all') ?></a>
                        <?php
                    }
                }
              ?>
          </div>
        </div>
      </div>
    </section>
    <!-- /events -->

    <!-- blog -->
    <section class="section pt-5">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2 class="section-title"><?php echo $home_modularSevenTitle_value ?></h2>
          </div>
        </div>
        <div class="row justify-content-center">
      <!-- blog post -->
            <?php
                foreach ($home_modularSevenItem_value as $key => $item) {
                    if ($key <= 2) {
                        ?>
                        <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                         <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
                          <img class="card-img-top rounded-0" src="<?php echo ifEmptyText($item['image']) ?>" alt="<?php echo ifEmptyText($item['title'],'##') ?>">
                          <div class="card-body">
                            <!-- post meta -->
                            <ul class="list-inline mb-3">
                              <!-- post date -->
                              <li class="list-inline-item mr-3 ml-0"><?php echo ifEmptyText($item['time']) ?></li>
                              <!-- author -->
                              <li class="list-inline-item mr-3 ml-0">By <?php echo ifEmptyText($item['author']) ?></li>
                            </ul>
                            <a href="blog-single.html">
                              <h4 class="card-title"><?php echo ifEmptyText($item['title']) ?></h4>
                            </a>
                            <p class="card-text"><?php echo ifEmptyText($item['desc']) ?></p>
                            <a href="<?php echo ifEmptyText($item['link']) ?>" class="btn btn-primary btn-sm">read more</a>
                          </div>
                        </div>
                      </article>
                        <?php
                    }
                }
            ?>

        </div>
      </div>
    </section>
    <!-- /blog -->

<?php
get_footer();