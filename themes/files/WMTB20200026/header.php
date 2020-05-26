<?php
global $wp; // Class_Reference/WP 类实例
$languages = get_languages();
$languagesArray = [];
foreach ($languages as $item) {
    $name = $item['e_name'];
    $link = '/' . $item['abbr'];
    array_push($languagesArray, array('name' => $name, 'link' => $link, 'abbr' => $item['abbr']));
}

// header.json -> vars 数据获取
$theme_vars = json_config_array('header', 'vars', 1);
$header_logo = ifEmptyText($theme_vars['logo']['value']);
$header_title = ifEmptyText($theme_vars['title']['value']);
$header_key_word = ifEmptyText($theme_vars['keyWord']['value']);

$sideBarMenu = ifEmptyText($theme_vars['sideBarMenu']['value']);
$sideBarHotProduct = ifEmptyText($theme_vars['sideBarHotProduct']['value']);
$sideBarTags = ifEmptyText($theme_vars['sideBarTags']['value']);

//footer.json
$theme_widgets = json_config_array('footer', 'widgets', 1);
$phone = ifEmptyArray($theme_widgets['phone']['vars']['items']['value'][0]);
$email = ifEmptyArray($theme_widgets['email']['vars']['items']['value'][0]);
set_query_var('sideBarMenu', $sideBarMenu);
set_query_var('sideBarHotProduct', $sideBarHotProduct);
set_query_var('sideBarTags', $sideBarTags);
$home_url = get_lang_home_url();

// 社媒标签
$theme_vars_footer = json_config_array('footer','vars',1);
$facebook_link = ifEmptyText($theme_vars_footer['facebookLink']['value']);
$twitter_link = ifEmptyText($theme_vars_footer['twitterLink']['value']);
$linkedin_link = ifEmptyText($theme_vars_footer['linkedinLink']['value']);
$youtube_link = ifEmptyText($theme_vars_footer['youtubeLink']['value']);
?>

<!-- web_head start -->
<header class="head-wrapper">
    <div class="tasking"></div>
    <div class="topbar">
        <div class="layout">
            <ul class="foot-social">
                <?php if ($facebook_link !== '') { ?>
                    <li><a href="<?php echo $facebook_link ?>" rel="nofollow" ><i class="sc-ico"><img src="//q.zvk9.com/Model20/assets/images/sns01.png" alt="<?php echo $facebook_link ?>"/></i></a></li>
                <?php } ?>
                <?php if ($twitter_link !== '') { ?>
                    <li><a href="<?php echo $twitter_link ?>" rel="nofollow" ><i class="sc-ico"><img src="//q.zvk9.com/Model20/assets/images/sns02.png" alt="<?php echo $twitter_link ?>" /></i></a></li>
                <?php } ?>
                <?php if ($linkedin_link !== '') { ?>
                    <li><a href="<?php echo $linkedin_link ?>" rel="nofollow" ><i class="sc-ico"><img src="//q.zvk9.com/Model20/assets/images/sns03.png" alt="<?php echo $linkedin_link ?>" /></i></a></li>
                <?php } ?>
                <?php if ($youtube_link !== '') { ?>
                    <li><a href="<?php echo $youtube_link ?>" rel="nofollow" ><i class="sc-ico"><img src="//q.zvk9.com/Model20/assets/images/sns05.png" alt="<?php echo $youtube_link ?>" /></i></a></li>
                <?php } ?>
            </ul>
            <div class="head-search">
                <div class="head-search-form">
                    <form id="search" action="<?php echo get_lang_home_url(); ?>" target="_blank">
                        <input class="search-ipt" name="s" id="s" type="text" placeholder="search" />
                        <button class="search-btn" type="submit" ></button>
                        <input class="search-btn" type="submit" value="&#xf002;" />
                    </form>
                </div>
                <span class="search-toggle"></span>
            </div>
            <div class="change-language ensemble">
                <div class="change-language-info">
                    <?php if (!empty($languagesArray)) { ?>
                        <div class="change-language-title medium-title">
                            <?php if (!empty(get_query_var('lang'))) { ?>
                                <?php foreach ($languagesArray as $item ) {
                                    if ( $item['abbr'] == get_query_var('lang') ) {
                                        ?>
                                        <div class="language-flag language-flag-en"><a title="<?php echo $item['name'] ?>" href="javascript:;"><span><?php echo $item['name'] ?></span></a></div>
                                    <?php } } ?>
                            <?php } else { ?>
                                <div class="language-flag language-flag-en" ><a title="English" href="/"><span>English</span> </a> </div>
                            <?php } ?>
                            <b class="language-icon"></b>
                        </div>
                        <div class="change-language-cont sub-content"> </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <section class="layout head-layout">
            <?php if (is_home()) { ?>
                <h1 class="logo">
                    <a href="<?php echo $home_url; ?>" class="logo-img" >
                        <img src="<?php echo $header_logo; ?>" alt="<?php echo $header_title; ?>">
                    </a>
                </h1>
            <?php } else { ?>
                <figure class="logo">
                    <a href="<?php echo $home_url; ?>" class="logo-img" >
                        <img src="<?php echo $header_logo; ?>" alt="<?php echo $header_title; ?>">
                    </a>
                </figure>
            <?php } ?>
        <nav class="nav-bar">
            <div class="nav-wrap">
                <?php if (has_nav_menu('primary')) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_class' => 'nav',
                            'container' => 'ul',
                            'container_class' => 'nav-current'
                        )
                    );
                } ?>
            </div>
        </nav>
    </section>
</header>
<!--// web_head end -->