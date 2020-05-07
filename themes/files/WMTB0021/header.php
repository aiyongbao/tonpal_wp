<?php
// header.json -> vars 数据获取
$theme_vars = json_config_array(__FILE__,'vars',1);
$header_tel = ifEmptyText($theme_vars['tel']['value']);
$facebook_link = ifEmptyText($theme_vars['facebookLink']['value']);
$twitter_link = ifEmptyText($theme_vars['twitterLink']['value']);
$linkedin_link = ifEmptyText($theme_vars['linkedinLink']['value']);
$instagram_link = ifEmptyText($theme_vars['instagramLink']['value']);

set_query_var('facebook_link', $facebook_link);
set_query_var('twitter_link', $twitter_link);
set_query_var('linkedin_link', $linkedin_link);
set_query_var('instagram_link', $instagram_link);
$header_modular = ifEmptyArray($theme_vars['modular']['value']);


?>

<header class="fixed-top header">
    <!-- top header -->
    <div class="top-header py-2 bg-white">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-4 text-center text-lg-left">
                    <a class="text-color mr-3" rel="nofollow" href="callto:<?php echo ifEmptyText($header_tel) ?>"><strong>CALL : </strong><?php echo ifEmptyText($header_tel) ?></a>
                    <ul class="list-inline d-inline">
                        <?php if ($facebook_link !== '') { ?>
                            <li class="list-inline-item mx-0">
                                <a class="d-inline-block p-2 text-color" rel="nofollow" href="<?php echo $facebook_link ?>">
                                    <i class="ti-facebook"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($twitter_link !== '') { ?>
                            <li class="list-inline-item mx-0">
                                <a class="d-inline-block p-2 text-color" rel="nofollow" href="<?php echo $twitter_link ?>">
                                    <i class="ti-twitter-alt"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($linkedin_link !== '') { ?>
                            <li class="list-inline-item mx-0">
                                <a class="d-inline-block p-2 text-color" rel="nofollow" href="<?php echo $linkedin_link ?>">
                                    <i class="ti-linkedin "></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($instagram_link !== '') { ?>
                            <li class="list-inline-item mx-0">
                                <a class="d-inline-block p-2 text-color" rel="nofollow" href="<?php echo $instagram_link ?>">
                                    <i class="ti-instagram"></i>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-lg-8 text-center text-lg-right">
                    <ul class="list-inline">
                        <?php
                        foreach ($header_modular as $key => $item) {
                        ?>
                            <li class="list-inline-item">
                                <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" rel="nofollow" href="<?php echo ifEmptyText($item['link']) ?>"><?php echo ifEmptyText($item['title']) ?></a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php get_template_part( 'templates/components/nav' ); ?>

</header>