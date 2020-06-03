<?php
$header_vars = json_config_array('header', 'vars', 1);

// Logo
$logo_url = ifEmptyText($header_vars['logo']['value']);
$logo_imgalt = ifEmptyText($header_vars['title']['value']);

// 语种
$languages = get_languages();
$languagesArray = [];
foreach ($languages as $item) {
    $name = $item['e_name'];
    $link = '/' . $item['abbr'];
    array_push($languagesArray, array('name' => $name, 'link' => $link, 'abbr' => $item['abbr']));
}

?>

<div class="web_head"></div>
<div class="wm_head">
    <div class="layout">
        <figure class="logo">
            <a href="<?php echo $home_url ?>"><img id="logo" src="<?php echo $logo_url ?>" alt="<?php echo $logo_imgalt ?>"></a>
        </figure>
        <nav class="nav_wrap <?php if ($languages === [] || $languagesArray === []) echo 'no-language' ?>">
            <?php if (has_nav_menu('primary')) : ?>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'menu_class' => 'head_nav',
                        'container' => 'ul',
                        'container_class' => 'nav-current'
                    )
                )
                ?>
            <?php endif; ?>
        </nav>
        <div class="head_right">
            <div class="head-search">
                <input type="hidden" class='search_url' value="<?php echo get_lang_home_url(); ?>">
                <input type="text" class="search-text" placeholder="Search">
                <img src="<?php echo get_template_directory_uri() ?>/assets/image/search-btn.png" alt="">
            </div>
            <!-- 多语种 -->
            <div class="change-language ensemble">
                <?php if ($languages !== [] && $languagesArray !== []) { ?>
                    <div class="btn-group dropdown dropdown-language">
                        <select class="form-control" id="language_select" onchange="changeLanguage();" style="border: none">
                            <option class="language-li" value="en">English</option>
                            <?php foreach ($languagesArray as $item) { ?>
                                <option class="language-li" data-language="<?php echo $item['link'] ?>" value="<?php echo $item['abbr'] ?>"><?php echo $item['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>