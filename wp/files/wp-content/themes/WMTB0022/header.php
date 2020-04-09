<?php
global $wp;
$languages = get_languages();
$languagesArray = [];
foreach ($languages as $item ){
    $name = $item['e_name'];
    $link = home_url(add_query_arg(array('lang'=>$item['abbr']),$wp->request));
    array_push($languagesArray,array('name'=>$name,'link'=>$link,'abbr'=> $item['abbr']));
}
set_query_var('languagesArray',$languagesArray);

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
$sideBarMenu = ifEmptyText($theme_vars['sideBarMenu']['value']);
$sideBarHotProduct = ifEmptyText($theme_vars['sideBarHotProduct']['value']);
$sideBarTags = ifEmptyText($theme_vars['sideBarTags']['value']);
set_query_var('icon',$icon);
set_query_var('sideBarMenu',$sideBarMenu);
set_query_var('sideBarHotProduct',$sideBarHotProduct);
set_query_var('sideBarTags',$sideBarTags);
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
                    <h1 class="logo-img">
                        <a href="<?php echo $home_url; ?>">
                            <img src="<?php echo $header_logo; ?>" alt="<?php echo $header_title; echo $header_key_word; ?>" />
                            <span><?php echo $header_title; echo $header_key_word; ?></span>
                        </a>
                    </h1>
                <?php } else { ?>
                    <div class="logo-img">
                        <a href="<?php echo $home_url; ?>">
                            <img src="<?php echo $header_logo; ?>" alt="<?php echo $header_title; echo $header_key_word; ?>" />
                            <span><?php echo $header_title; echo $header_key_word; ?></span>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="change-language ensemble">
                <div class="change-language-info">
                    <?php if (!empty($languagesArray)) { ?>
                        <div class="change-language-title medium-title">
                            <?php if (!empty(get_query_var('lang'))) { ?>
                                <?php foreach ($languagesArray as $item ) {
                                    if ( $item['abbr'] == get_query_var('lang') ) {
                                    ?>
                                    <div class="language-flag language-flag-en"><a title="<?php echo $item['e_name'] ?>" href="javascript:;"><span><?php echo $item['e_name'] ?></span></a></div>
                                <?php } } ?>
                            <?php } else { ?>
                                <div class="language-flag language-flag-en" onclick="changeLanguage('en');"><a title="English" href="javascript:;"><span>English</span> </a> </div>
                            <?php } ?>


                            <b class="language-icon"></b>
                        </div>
                        <div class="change-language-cont sub-content"> </div>
                    <?php } ?>
                </div>
            </div>
            <!-- nav start -->
            <nav class="nav-bar">
                <div class="nav-wrap">
                    <?php if ( has_nav_menu( 'primary' ) ) : ?>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_class' => 'nav',
                                'container' => 'ul',
                                'container_class' => 'nav-current'
                            )
                        )
                        ?>
                    <?php endif; ?>
                </div>
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
                        <form id="search" action="<?php bloginfo('url'); ?>/" target="_blank">
                            <input class="search-ipt" name="s" id="s" type="text" placeholder="search" />
                            <button class="search-btn" type="submit" ></button>
                         </form>
                    </div>
                    <span class="search-toggle"></span>
                </div>
            </div>
        </div>
    </section>
</header>
<!--// header end  -->
