<?php
global $wp; // Class_Reference/WP 类实例
$languages = get_languages();
$languagesArray = [];
foreach ($languages as $item ){
    $name = $item['e_name'];
    $link = '/'.$item['abbr'];
    array_push($languagesArray,array('name'=>$name,'link'=>$link,'abbr'=> $item['abbr']));
}
set_query_var('languagesArray',$languagesArray);

// header.json -> vars 数据获取
$theme_vars = json_config_array('header','vars',1);
$header_logo = ifEmptyText($theme_vars['logo']['value']);
$header_title = ifEmptyText($theme_vars['title']['value']);
$header_key_word = ifEmptyText($theme_vars['keyWord']['value']);

$sideBarMenu = ifEmptyText($theme_vars['sideBarMenu']['value']);
$sideBarHotProduct = ifEmptyText($theme_vars['sideBarHotProduct']['value']);
$sideBarTags = ifEmptyText($theme_vars['sideBarTags']['value']);
set_query_var('sideBarMenu',$sideBarMenu);
set_query_var('sideBarHotProduct',$sideBarHotProduct);
set_query_var('sideBarTags',$sideBarTags);
$home_url = get_lang_home_url();

$languagesArray = get_query_var('languagesArray');

?>

<header class="web_head <?php if (is_home()) echo 'index_web_head'; ?>">
    <section class="head_top">
        <div class="layout">
            <?php if ( is_home() ) { ?>
                <h1 class="logo">
                    <a href="<?php echo $home_url; ?>">
                        <img src="<?php echo $header_logo; ?>" alt="<?php echo $header_title; ?>">
                        <span><?php echo $header_title; echo $header_key_word; ?></span>
                    </a>
                </h1>
            <?php } else { ?>
                <figure class="logo">
                    <a href="<?php echo $home_url; ?>">
                        <img src="<?php echo $header_logo; ?>" alt="<?php echo $header_title; ?>">
                        <span><?php echo $header_title; echo $header_key_word; ?></span>
                    </a>
                </figure>
            <?php } ?>
        </div>
    </section>
    <section class="head_layer">
        <div class="layout">
            <nav class="nav_wrap">
                <?php if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_class' => 'head_nav',
                            'container' => 'ul',
                            'container_class' => 'nav-current'
                        )
                    );
                } ?>
            </nav>
            <div class="top_right">
                <b id="btn-search" class="btn--search"></b>
                <?php if (!empty($languagesArray)) {
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
                    <div class="change-language ensemble">
                        <div class="change-language-title medium-title">
                            <div class="language-flag">
                                <a title="<?php echo $languagesName; ?>" href="javascript:;">
                                    <span><?php echo $languagesName; ?></span>
                                </a>
                            </div>
                        </div>
                        <div class="change-language-cont sub-content"></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</header>
<!--// header end  -->
