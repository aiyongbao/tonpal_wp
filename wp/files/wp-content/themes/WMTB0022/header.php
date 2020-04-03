<?php
global $wp;

// header.json -> vars 数据获取
$theme_vars = json_config_array('header','vars',1);

$header_logo = ifEmptyText($theme_vars['logo']['value']);

$header_title = ifEmptyText($theme_vars['title']['value']);
$header_key_word = ifEmptyText($theme_vars['key_word']['value']);

$facebook_link = ifEmptyText($theme_vars['facebookLink']['value']);
$twitter_link = ifEmptyText($theme_vars['twitterLink']['value']);
$instagram_link = ifEmptyText($theme_vars['instagramLink']['value']);
$youtube_link = ifEmptyText($theme_vars['youtubeLink']['value']);

$icon = ifEmptyText($theme_vars['icon']['value']);
set_query_var('icon',$icon);
$home_url = get_lang_home_url();
$page_url = get_lang_page_url();
$googleplus_link = '';

?>
<!-- header start -->
<header class="head-wrapper">
    <div class="tasking"></div>
    <section class="head-inner">
        <div class="layout head-layout">
            <div class="logo">
                <?php if ($home_url == $page_url) { ?>
                    <h1 class="logo-img" style="background: url(<?php echo $header_logo; ?>) left 50% no-repeat;">
                        <a href="<?php echo $home_url; ?>"><?php echo $header_title; echo $header_key_word; ?></a>
                    </h1>
                <?php } else { ?>
                    <div class="logo-img" style="background: url(<?php echo $header_logo; ?>) left 50% no-repeat;">
                        <a href="<?php echo $home_url; ?>"><?php echo $header_title; echo $header_key_word; ?></a>
                    </div>
                <?php } ?>
            </div>
            <div class="change-language ensemble">
                <div class="change-language-info">
<!--                    {% if language is not empty %}-->
<!--                    <div class="change-language-title medium-title">-->
<!--                        {% if prefix is defined and prefix is not empty %}-->
<!--                        --><?php //$abbrname = substr($prefix, 0, 2); ?>
<!--                        {% for sub in language %}-->
<!--                        {% if sub['abbr'] == abbrname %}-->
<!--                        <div class="language-flag language-flag-en"><a title="{{ sub['ename'] }}" href="javascript:;"><span>{{ sub['ename'] }}</span> </a> </div>-->
<!--                        {% endif %}-->
<!--                        {% endfor %}-->
<!--                        {% else %}-->
<!--                        <div class="language-flag language-flag-en" onclick="changeLanguage('en');"><a title="English" href="javascript:;"><span>English</span> </a> </div>-->
<!--                        {% endif %}-->
<!---->
<!---->
<!--                        <b class="language-icon"></b>-->
<!--                    </div>-->
<!--                    <div class="change-language-cont sub-content"> </div>-->
<!--                    {% endif %}-->
                </div>
            </div>
            <!-- nav start -->
            <nav class="nav-box">
                    <?php if ( has_nav_menu( 'primary' ) ) : ?>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_class' => 'nav-ul',
                                'container' => 'ul',
                                'container_class' => 'nav-li'
                            )
                        )
                        ?>
                    <?php endif; ?>
            </nav>
            <!-- /nav end-->
            <div class="topr">
                <ul class="social-list">
                    <?php if ($facebook_link !== '') { ?>
                    <li><a href="<?php echo $facebook_link ?>"><i class="sc-ico"><img src="//q.zvk9.com/Model15/assets/images/sns01.png"/></i></a></li>
                    <?php } ?>
                    <?php if ($twitter_link !== '') { ?>
                    <li><a href="<?php echo $facebook_link ?>"><i class="sc-ico"><img src="//q.zvk9.com/Model15/assets/images/sns02.png" alt="" /></i></a></li>
                    <?php } ?>
                    <?php if ($googleplus_link !== '') { ?>
                    <li><a href="<?php echo $googleplus_link ?>"><i class="sc-ico"><img src="//q.zvk9.com/Model15/assets/images/sns04.png" alt="" /></i></a></li>
                    <?php } ?>
                    <?php if ($instagram_link !== '') { ?>
                    <li><a href="<?php echo $instagram_link ?>"><i class="sc-ico"><img src="//q.zvk9.com/Model15/assets/images/sns03.png" alt="" /></i></a></li>
                    <?php } ?>
                    <?php if ($youtube_link !== '') { ?>
                    <li><a href="<?php echo $youtube_link ?>"><i class="sc-ico"><img src="//q.zvk9.com/Model15/assets/images/sns05.png" alt="" /></i></a></li>
                    <?php } ?>
                </ul>
                <div class="head-search">
                    <div class="head-search-form">
                        <!-- <form action="//www.google.com.hk/search" id='search' target="_blank" method="get"> -->
                        <input class="search-ipt" type="text" placeholder="search" id="search-ipt" />
                        <button class="search-btn" type="submit" onclick="search()"></button>
                        <!-- </form> -->
                    </div>
                    <span class="search-toggle"></span>
                </div>
            </div>
        </div>
    </section>
</header>
<!--// header end  -->
