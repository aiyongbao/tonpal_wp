<?php
global $wp; // Class_Reference/WP 类实例
$languages = get_languages();
$languagesArray = [];
foreach ($languages as $item) {
    $name = $item['e_name'];
    $link = '/' . $item['abbr'];
    array_push($languagesArray, array('name' => $name, 'link' => $link, 'abbr' => $item['abbr']));
}
set_query_var('languagesArray', $languagesArray);

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

$languagesArray = get_query_var('languagesArray');
$the_abbr = get_query_var('lang') ? get_query_var('lang') : 'en';
if ($the_abbr != 'en') {
    foreach ($languagesArray as $item) {
        if ($item['abbr'] == $the_abbr) {
            $languagesName = $item['name'];
        }
    }
} else {
    $languagesName = 'English';
}
?>

<!-- web_head start -->
<header class="<?php if (is_home()) echo 'index_web_head'; ?> web_head">
    <div class="head_top">
        <div class="layout">
            <figure class="logo">
                <?php if (is_home()) { ?>
                    <h1 class="logo">
                        <a href="<?php echo $home_url; ?>">
                            <img src="<?php echo $header_logo; ?>" alt="<?php echo $header_title; ?>">
                        </a>
                    </h1>
                <?php } else { ?>
                    <figure class="logo">
                        <a href="<?php echo $home_url; ?>">
                            <img src="<?php echo $header_logo; ?>" alt="<?php echo $header_title; ?>">
                        </a>
                    </figure>
                <?php } ?>
            </figure>
            <div class="head_right">
                <ul class="top_contacts">
                    <li>
                        <i class="top_ico_tel"></i><span class="top_label"><a class="link-tel" href="tel:">Phone: <?php echo $phone['value']; ?></a></span>
                    </li>
                    <li>
                        <i class="top_ico_email"></i><span class="top_label"><a href="mailto:">Email: <?php echo $email['value']; ?></a></span>
                    </li>
                </ul>
                <div class="change-language ensemble">
                    <div class="change-language-title medium-title">
                        <div class="language-flag language-flag-en"> <a title="<?php echo $languagesName; ?>" href="javascript:;">
                                <span><?php echo $languagesName; ?></span>
                            </a> </div>
                    </div>
                    <div class="change-language-cont sub-content"></div>
                </div>

            </div>
        </div>
    </div>
    <nav class="nav_wrap">
        <div class="layout">
                <?php if (has_nav_menu('primary')) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_class' => 'head_nav',
                            'container' => 'ul',
                            'container_class' => 'nav-current'
                        )
                    );
                } ?>
            <b id="btn-search" class="btn--search"></b>
        </div>
    </nav>
</header>
<!--// web_head end -->