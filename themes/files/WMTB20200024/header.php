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
$header_key_word = ifEmptyText($theme_vars['key_word']['value']);

$phone = ifEmptyArray($theme_vars['phone']['vars']['items']['value'][0]);
$email = ifEmptyArray($theme_vars['email']['vars']['items']['value'][0]);
$facebook_link = ifEmptyText($theme_vars['facebookLink']['value']);
$twitter_link = ifEmptyText($theme_vars['twitterLink']['value']);
$linkedin_link = ifEmptyText($theme_vars['linkedinLink']['value']);
$youtube_link = ifEmptyText($theme_vars['youtubeLink']['value']);

$header_contact_phone = ifEmptyText($phone['value']);
$header_contact_email = ifEmptyText($email['value']);
$icon = ifEmptyText($theme_vars['icon']['value']);
$sideBarMenu = ifEmptyText($theme_vars['sideBarMenu']['value']);
$sideBarHotProduct = ifEmptyText($theme_vars['sideBarHotProduct']['value']);
$sideBarTags = ifEmptyText($theme_vars['sideBarTags']['value']);
set_query_var('sideBarMenu', $sideBarMenu);
set_query_var('sideBarHotProduct', $sideBarHotProduct);
set_query_var('sideBarTags', $sideBarTags);
$home_url = get_lang_home_url();


?>



<style>
    .head-search .search-1{
        float:right
    }

@media screen and (max-width: 769px)  {
    .head-search{
        top:0;
    }
    .topbar .head-search {
        display: none;
        opacity: 0
    }
    .head-search .search-ipt {
    width: 100%;
    display: block;
    }
    .head-search .search-1{
    float: none;
    }
    .head-search .search-btn {
    z-index: 9;
    height: 31px;
    right: 0px;
    }
}
</style>
<header class="head-wrapper">
    <!--  top   -->
    <section class="topbar">
        <section class="head-top">
            <section class="layout">

                <!--联系方式-->
                <div class="gm-sep head-contact">
                    <div class="head-phone"><a class="link" href="<?php echo $header_contact_email ?>" rel="nofollow"><span><?php echo $header_contact_email ?></span></a></div>
                    <div class="head-email"><a class="link" href="<?php echo $header_contact_phone ?>" rel="nofollow"><span><?php echo $header_contact_phone ?></span></a></div>
                </div>
                <!--联系方式完-->

                <!--语言-->
                <div class="change-language ensemble">
                    <div class="change-language-info">
                        <?php if (!empty($languagesArray)) { ?>
                            <div class="change-language-title medium-title">
                                <?php if (!empty(get_query_var('lang'))) { ?>
                                    <?php foreach ($languagesArray as $item) {
                                        if ($item['abbr'] == get_query_var('lang')) {
                                    ?>
                                            <div class="language-flag language-flag-en"><a title="<?php echo $item['name'] ?>" href="javascript:;"><span><?php echo $item['name'] ?></span></a></div>
                                    <?php }
                                    } ?>
                                <?php } else { ?>
                                    <div class="language-flag language-flag-en" onclick="changeLanguage('en');"><a title="English" href="javascript:;"><span>English</span> </a> </div>
                                <?php } ?>

                            </div>
                            <div class="change-language-cont sub-content"> </div>
                        <?php } ?>
                        <div class="change-language-cont sub-content"> </div>
                    </div>
                </div>
                <!--语言完-->
                <!--search strat  -->
                <div class="head-search" style="top: 10px;">
                    <section class="head-search-form">
                        <!-- <form action="//www.google.com.hk/search" id='search' target="_blank" method="get" class="head-search"> -->
                        <div class="search-1" >
                        <form id="search" action="<?php echo get_lang_home_url(); ?>" target="_blank">
                            <input class="search-ipt" name="s" id="s" type="text" placeholder="" />
                            <button class="search-btn" type="submit" onclick="search()">
                                <svg t="1569239650756" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2056" width="20" height="20" >
                                    <path d="M882.6369 904.308991 730.351542 708.192358c7.884574-6.656607 15.529695-13.647835 22.890336-21.0095 33.348526-33.350572 59.533908-72.194252 77.8296-115.453499 18.948561-44.803415 28.555359-92.378967 28.555359-141.40659 0-49.021483-9.607822-96.593965-28.556383-141.393287-18.295692-43.256176-44.481074-82.09781-77.828576-115.446335S681.053766 113.948215 637.797589 95.652524C592.99929 76.703963 545.429879 67.096141 496.409418 67.096141c-49.021483 0-96.593965 9.607822-141.394311 28.556383-43.256176 18.295692-82.098833 44.482097-115.446335 77.830623-33.348526 33.347502-59.533908 72.189136-77.830623 115.446335-18.948561 44.800345-28.556383 92.371804-28.556383 141.393287 0 49.027623 9.607822 96.603175 28.556383 141.40659 18.295692 43.259246 44.481074 82.10395 77.8296 115.453499 33.347502 33.349549 72.189136 59.536978 115.446335 77.833693 44.800345 18.948561 92.371804 28.556383 141.394311 28.556383 49.019437 0 96.590895-9.608845 141.389194-28.557406 12.920264-5.465478 25.436322-11.649318 37.541011-18.502399l154.415882 198.860117c11.339256 14.603603 31.987528 17.545608 46.119387 6.572696l1.705851-1.325182C891.713626 939.6458 893.977179 918.912593 882.6369 904.308991zM496.409418 732.173538c-166.428473 0-301.82928-135.410016-301.82928-301.851792 0-166.428473 135.399783-301.828256 301.82928-301.828256 166.423357 0 301.818023 135.399783 301.818023 301.828256C798.228465 596.763522 662.832775 732.173538 496.409418 732.173538z" p-id="2057" fill="#707070"></path>
                                </svg>
                            </button>
                        </form>
                        </div>
                        <!-- </form> -->
                    </section>
                </div>
                
                <!--search end  -->
            </section>
        </section>
    </section>
    <section class="nav-bar">
        <section class="layout">
            <div class="logo">
                <?php if (is_home()) { ?>
                    <h1 class="logo-img">
                        <a href="<?php echo $home_url; ?>">
                            <img  style="width: 150px;height:50px;margin-top: 11px;" src="<?php echo $header_logo; ?>" alt="<?php echo $header_title;
                                echo $header_key_word; ?>" />
                        </a>
                    </h1>
                <?php } else { ?>
                    <div class="logo-img">
                        <a href="<?php echo $home_url; ?>">
                            <img  style="width: 150px;height:50px;margin-top: 11px;" src="<?php echo $header_logo; ?>" alt="<?php echo $header_title;
                                echo $header_key_word; ?>" />
                        </a>
                    </div>
                <?php } ?>
            </div>
            <!--导航  -->
            <section class="nav-wrap">

                <?php if (has_nav_menu('primary')) : ?>
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

            </section>
            <!--导航  -->

        </section>
    </section>
</header>
<script>
    $("#search-ipt").on("keypress", function(event) {
        if (event.keyCode == 13) {
            $(".search-btn").trigger("click");
        }
    })

    function search() {
        $.ajax({
            url: "/search.php",
            type: 'get',
            // dataType: 'JSON',
            data: {
                "keyword": JSON.stringify($(".search-ipt").val())
            },
            success: function(data) {
                window.open("http://" + $(".searchDomain").val() + '/search.php?keyword=' + $(".search-ipt").val());
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>


