<?php
// footer.json -> vars 数据获取
$theme_vars = json_config_array('footer','vars',1);
$theme_widgets = json_config_array('footer','widgets',1);

$footer_quick_links = $theme_widgets['quickLink'];
$phone = ifEmptyArray($theme_widgets['phone']['vars']['items']['value'][0]);
$email = ifEmptyArray($theme_widgets['email']['vars']['items']['value'][0]);
$address = ifEmptyArray($theme_widgets['address']['vars']['items']['value'][0]);

$footer_logo = ifEmptyText($theme_vars['footerLogo']['value']);
$footer_about_abstract = ifEmptyText($theme_vars['aboutAbstract']['value']);
$footer_contact_title = ifEmptyText($theme_vars['contactTitle']['value']);
$facebook_link = ifEmptyText($theme_vars['facebookLink']['value']);
$twitter_link = ifEmptyText($theme_vars['twitterLink']['value']);
$linkedin_link = ifEmptyText($theme_vars['linkedinLink']['value']);
$youtube_link = ifEmptyText($theme_vars['youtubeLink']['value']);
$footer_copyright = ifEmptyText($theme_vars['copyright']['value']);

// header.json
$theme_vars_header = json_config_array('header','vars',1);
$search_tip = ifEmptyText($theme_vars_header['searchTip']['value']);
$search_slogan = ifEmptyText($theme_vars_header['searchSlogan']['value']);
$header_title = ifEmptyText($theme_vars_header['headerTitle']['value']);



$languagesArray = ifEmptyArray(get_query_var('languagesArray'));
$footer_friend_links = ifEmptyArray($theme_vars['friendLinks']['value']);


$googleExtantion = get_option('google_extantion');


?>
<footer class="web_footer">
    <section class="foot_service">
        <div class="layout">
            <div class="foot_items">
                <nav class="foot_item foot_item_info wow fadeInLeftA" data-wow-delay=".1s" data-wow-duration=".8s">
                    <div class="foot_logo"><img src="<?php echo $footer_logo; ?>" alt="<?php echo $header_title; ?>"></div>
                    <div class="info_desc break-word ellipsis-8"><?php echo $footer_about_abstract; ?></div>
                </nav>
                <?php if ($footer_quick_links['display'] == 1) {
                    $quick_links_title = ifEmptyText($footer_quick_links['vars']['title']['value']);
                    $quick_links_items = ifEmptyArray($footer_quick_links['vars']['items']['value']);
                    ?>
                    <nav class="foot_item foot_item_product wow fadeInLeftA" data-wow-delay=".2s" data-wow-duration=".8s">
                        <div class="foot_item_hd">
                            <h2 class="title"><?php echo $quick_links_title; ?></h2>
                        </div>
                        <div class="foot_item_bd">
                            <ul class="foot_txt_list">
                                <?php foreach ($quick_links_items as $item ) { ?>
                                    <li><a class="ellipsis-1" rel="nofollow" href="<?php echo $item['link']; ?>"><?php echo $item['name'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                <?php } ?>
                <nav class="foot_item wow fadeInLeftA" data-wow-delay=".3s" data-wow-duration=".8s">
                    <div class="foot_item_hd">
                        <h2 class="title"><?php echo $footer_contact_title ?></h2>
                    </div>
                    <div class="foot_item_bd">
                        <address class="foot_contact_list">
                            <ul>
                                <?php if (ifEmptyText($address['value']) !== '' ) { ?>
                                    <li class="contact_item">
                                        <i class="contact_ico contact_ico_local"></i>
                                        <div class="contact_txt">
                                            <span class="item_val break-word ellipsis-4"><?php echo $address['value']; ?></span>
                                        </div>
                                    </li>
                                <?php } ?>
                                <?php if (ifEmptyText($phone['value']) !== '' ) { ?>
                                    <li class="contact_item">
                                        <i class="contact_ico contact_ico_phone"></i>
                                        <div class="contact_txt">
                                            <a class="tel_link " rel="nofollow" href="tel:<?php echo $phone['value'] ?>"><span class="item_label"><?php echo ifEmptyText($phone['name'],'Phone'); ?>:</span><span class="item_val"><?php echo $phone['value'] ?></span></a>
                                        </div>
                                    </li>
                                <?php } ?>
                                <?php if (ifEmptyText($email['value']) !== '' ) { ?>
                                    <li class="contact_item">
                                        <i class="contact_ico contact_ico_email"></i>
                                        <div class="contact_txt">
                                            <a href="mailto:<?php echo $email['value'] ?>" rel="nofollow" ><span class="item_label"><?php echo ifEmptyText($email['name'],'Email'); ?>:</span><span class="item_val"><?php echo $email['value'] ?></span></a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </address>
                        <ul class="foot_sns">
                            <?php if ($facebook_link !== '') { ?>
                                <li><a href="<?php echo $facebook_link ?>" rel="nofollow" ><i class="sc-ico"><img src="<?php echo get_template_directory_uri()?>/assets/images/facebook.png" alt="<?php echo $facebook_link ?>"/></i></a></li>
                            <?php } ?>
                            <?php if ($twitter_link !== '') { ?>
                                <li><a href="<?php echo $twitter_link ?>" rel="nofollow" ><i class="sc-ico"><img src="<?php echo get_template_directory_uri()?>/assets/images/twitter.png" alt="<?php echo $twitter_link ?>" /></i></a></li>
                            <?php } ?>
                            <?php if ($linkedin_link !== '') { ?>
                                <li><a href="<?php echo $linkedin_link ?>" rel="nofollow" ><i class="sc-ico"><img src="<?php echo get_template_directory_uri()?>/assets/images/linkedin.png" alt="<?php echo $linkedin_link ?>" /></i></a></li>
                            <?php } ?>
                            <?php if ($youtube_link !== '') { ?>
                                <li><a href="<?php echo $youtube_link ?>" rel="nofollow" ><i class="sc-ico"><img src="<?php echo get_template_directory_uri()?>/assets/images/youtube.png" alt="<?php echo $youtube_link ?>" /></i></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
                <?php if ($footer_friend_links != []) { ?>
                    <div id="link-item">
                        <div>links<span></span></div>
                        <ul>
                            <?php foreach ($footer_friend_links as $item) { ?>
                                <li><a href="<?php echo ifEmptyText($item['link'],'javascript:;') ?>"><?php echo ifEmptyText($item['name']) ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php }?>
            </div>
        </div>
        <div class="foot-bar">
            <div class="layout">
                <?php if (ifEmptyText($footer_copyright) !== '') : ?>
                    <div class="copyright">Copyright&nbsp;©&nbsp;<span class="get-cur-year"><?php echo date('Y') ?>&nbsp;</span><?php echo $footer_copyright ?></div>
                <?php endif; ?>
                <?php print_r('&nbsp|&nbsp <a href="/privacy-policy-page">Privacy Policy</a>'); ?>
                <?php print_r('&nbsp|&nbsp <a href="/sitemap.xml">Sitemap</a>'); ?>
                <?php if (get_category_by_slug('info-news')) print_r('&nbsp|&nbsp<a href="/info-news">INFO NEWS</a>'); ?>
                <?php if (get_category_by_slug('info-product')) print_r('&nbsp|&nbsp<a href="/info-product">INFO PRODUCT</a>'); ?>
            </div>
        </div>
    </section>
</footer>
<!--// web_footer end -->
<div class="web-search"> <b id="btn-search-close" class="btn--search-close"></b>
    <div style=" width:100%">
        <div class="head-search">
            <form id="search" action="<?php echo get_lang_home_url(); ?>">
                <input class="search-ipt" name="s" id="s" placeholder="<?php echo $search_tip; ?>" />
                <input class="search-btn" type="button" />
                <span class="search-attr"><?php echo $search_slogan; ?></span>
            </form>
        </div>
    </div>
</div>
<?php if ( !empty($languagesArray)) { ?>
    <ul class="prisna-wp-translate-seo" id="prisna-translator-seo">
        <li class="language-flag language-flag-en"><a title="English" href="/"><span>English</span></a></li>
        <?php foreach ($languagesArray as $item) { ?>
            <li class="language-flag language-flag-<?php echo ifEmptyText($item['abbr']); ?>">
                <a data-language="<?php echo ifEmptyText($item['link'],'javascript:;') ?>"  value="<?php echo ifEmptyText($item['abbr']) ?>" href="<?php echo ifEmptyText($item['link'],'javascript:;') ?>"><?php echo ifEmptyText($item['name']) ?></a>
            </li>
        <?php } ?>
    </ul>
<?php } ?>
<?php if ( ifEmptyText($googleExtantion) !== '' ) {
    echo $googleExtantion;
} ?>
<!-- /footer -->

