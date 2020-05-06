<?php
// footer.json -> vars 数据获取
$theme_vars = json_config_array(__FILE__,'vars',1);
// array
$footer_message = ifEmptyArray($theme_vars['message']['value']);
$nav_one_item = ifEmptyArray($theme_vars['navOneItem']['value']);
$nav_two_item = ifEmptyArray($theme_vars['navTwoItem']['value']);
$nav_three_item = ifEmptyArray($theme_vars['navThreeItem']['value']);
$nav_four_item = ifEmptyArray($theme_vars['navFourItem']['value']);

// text
$footer_copyright = ifEmptyText($theme_vars['copyright']['value']);
$footer_friend_links = ifEmptyArray($theme_vars['friendLinks']['value']);
$footer_facebook_link = get_query_var('facebook_link');
$footer_twitter_link = get_query_var('twitter_link');
$footer_linkedin_link = get_query_var('linkedin_link');
$footer_instagram_link = get_query_var('instagram_link');

$nav_one_title = ifEmptyText($theme_vars['navOneTitle']['value']);
$nav_two_title = ifEmptyText($theme_vars['navTwoTitle']['value']);
$nav_three_title = ifEmptyText($theme_vars['navThreeTitle']['value']);
$nav_four_title = ifEmptyText($theme_vars['navFourTitle']['value']);

?>
<footer>
    <!-- footer content -->
    <div class="footer bg-footer section border-bottom">
        <div class="container">
            <div class="row">
                <?php
                foreach ($footer_message as $key => $item) {
                    if ($key == 0) {
                        ?>
                        <div class="col-lg-4 col-sm-8 mb-5 mb-lg-0">
                            <!-- logo -->
                            <a class="logo-footer" href="/"><img class="img-fluid mb-4" src="<?php echo ifEmptyText($item['logo']) ?>" alt="logo"></a>
                            <ul class="list-unstyled">
                                <li class="mb-2"><?php echo ifEmptyText($item['address']) ?></li>
                                <li class="mb-2"><?php echo ifEmptyText($item['Telephone']) ?></li>
                                <li class="mb-2"><?php echo ifEmptyText($item['mobilePhone']) ?></li>
                                <li class="mb-2"><?php echo ifEmptyText($item['email']) ?></li>
                            </ul>
                        </div>
                        <?php
                    }
                }
                ?>
                <!-- // -->
                <?php if ($nav_one_title !== '') { ?>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
                        <h4 class="text-white mb-5"><?php echo $nav_one_title; ?></h4>
                        <ul class="list-unstyled">
                            <?php foreach ($nav_one_item as $item) { ?>
                                <li class="mb-3"><a class="text-color" rel="nofollow" href="<?php echo $item['link']; ?>"><?php echo $item['name']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <!-- // -->
                <?php if ($nav_two_title !== '') { ?>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
                        <h4 class="text-white mb-5"><?php echo $nav_two_title; ?></h4>
                        <ul class="list-unstyled">
                            <?php foreach ($nav_two_item as $item) { ?>
                                <li class="mb-3"><a class="text-color" rel="nofollow" href="<?php echo $item['link']; ?>"><?php echo $item['name']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <!-- // -->
                <?php if ($nav_three_title !== '') { ?>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
                        <h4 class="text-white mb-5"><?php echo $nav_three_title; ?></h4>
                        <ul class="list-unstyled">
                            <?php foreach ($nav_three_item as $item) { ?>
                                <li class="mb-3"><a class="text-color" rel="nofollow" href="<?php echo $item['link']; ?>"><?php echo $item['name']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <!-- // -->
                <?php if ($nav_four_title !== '') { ?>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
                        <h4 class="text-white mb-5"><?php echo $nav_four_title; ?></h4>
                        <ul class="list-unstyled">
                            <?php foreach ($nav_four_item as $item) { ?>
                                <li class="mb-3"><a class="text-color" rel="nofollow" href="<?php echo $item['link']; ?>"><?php echo $item['name']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <?php if ($footer_friend_links != []) { ?>
            <div id="link-item">
                <div>links<span></span></div>
                <ul>
                    <?php foreach ($footer_friend_links as $item) { ?>
                        <li><a href="<?php echo $item['link'] ?>"><?php echo $item['name'] ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <?php }?>
        </div>
    </div>
    <!-- copyright -->
    <div class="copyright py-4 bg-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 text-sm-left text-center">
                    <p class="mb-0"><?php echo $footer_copyright;?>
                        <?php if (ifEmptyText($footer_copyright) !== '') : ?>
                            <script>
                                var CurrentYear = new Date().getFullYear()
                                document.write(CurrentYear)
                            </script>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="col-sm-5 text-sm-right text-center">
                    <ul class="list-inline">
                        <?php if ($footer_facebook_link !== '') { ?>
                            <li class="list-inline-item">
                                <a class="d-inline-block p-2" rel="nofollow" href="<?php echo $footer_facebook_link ?>">
                                    <i class="ti-facebook text-primary"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($footer_twitter_link !== '') { ?>
                            <li class="list-inline-item">
                                <a class="d-inline-block p-2" rel="nofollow" href="<?php echo $footer_twitter_link ?>">
                                    <i class="ti-twitter-alt text-primary"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($footer_linkedin_link !== '') { ?>
                            <li class="list-inline-item">
                                <a class="d-inline-block p-2" rel="nofollow" href="<?php echo $footer_linkedin_link ?>">
                                    <i class="ti-linkedin text-primary"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($footer_instagram_link !== '') { ?>
                            <li class="list-inline-item">
                                <a class="d-inline-block p-2" rel="nofollow" href="<?php echo $footer_instagram_link ?>">
                                    <i class="ti-instagram text-primary"></i>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</footer>
<!-- /footer -->

