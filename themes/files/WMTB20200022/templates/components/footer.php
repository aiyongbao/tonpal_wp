<?php
// footer.json -> vars 数据获取
$theme_vars = json_config_array('footer','vars',1);
$theme_widgets = json_config_array('footer','widgets',1);

$phone = ifEmptyArray($theme_widgets['phone']['vars']['items']['value'][0]);
$mobile = ifEmptyArray($theme_widgets['mobile']['vars']['items']['value'][0]);
$email = ifEmptyArray($theme_widgets['email']['vars']['items']['value'][0]);
$address = ifEmptyArray($theme_widgets['address']['vars']['items']['value'][0]);

$footer_about_title = ifEmptyText($theme_vars['aboutTitle']['value']);
$footer_about_abstract = ifEmptyText($theme_vars['aboutAbstract']['value']);
$footer_contact_title = ifEmptyText($theme_vars['contactTitle']['value']);
$footer_contact_phone = ifEmptyText($phone['value']);
$footer_contact_mobile = ifEmptyText($mobile['value']);
$footer_contact_email = ifEmptyText($email['value']);
$footer_contact_address = ifEmptyText($address['value']);
$footer_news_title = ifEmptyText($theme_vars['newsTitle']['value']);
$footer_product_title = ifEmptyText($theme_vars['productTitle']['value']);
$footer_copyright = ifEmptyText($theme_vars['copyright']['value']);
$footer_mobile_link = ifEmptyText($theme_vars['mobileLink']['value']);


$languagesArray = ifEmptyArray(get_query_var('languagesArray'));
$footer_news_item = ifEmptyArray($theme_vars['newsItem']['value']);
$footer_product_item = ifEmptyArray($theme_vars['productItem']['value']);
$footer_friend_links = ifEmptyArray($theme_vars['friendLinks']['value']);


$googleExtantion = get_option('google_extantion');


?>
<!--  footer start -->
<footer class="foot-wrapper">
    <div class="foot-items">
        <div class="layout">
            <div class="gd-row">
                <section class="foot-item foot-item-contact">
                    <h2 class="foot-tit"><?php echo $footer_about_title ?></h2>
                    <div class="foot-cont">
                        <p>
                            <?php echo $footer_about_abstract ?>
                        </p>
                    </div>
                </section>
                <section class="foot-item foot-item-contact">
                    <h2 class="foot-tit"><?php echo $footer_contact_title ?></h2>
                    <div class="foot-cont">
                        <ul class="contact-list">
                            <?php if ($footer_contact_phone !== '' ) { ?>
                                <li class="foot_tel has-mobile-link"><a class="link" href="tel:<?php echo $footer_contact_phone ?>" rel="nofollow" ><?php echo $footer_contact_phone ?></a></li>
                            <?php } ?>
                            <?php if ($footer_contact_mobile !== '' ) { ?>
                                <li class="foot_tel has-mobile-link"><a class="link" href="tel:<?php echo $footer_contact_mobile ?>" rel="nofollow" ><?php echo $footer_contact_mobile ?></a></li>
                            <?php } ?>
                            <?php if ($footer_contact_email !== '' ) { ?>
                                <li class="foot_email"><label>Email:</label><a href="mailto:<?php echo $footer_contact_email ?>" rel="nofollow" ><?php echo $footer_contact_email ?></a></li>
                            <?php } ?>
                            <?php if ($footer_contact_address !== '' ) { ?>
                                <li class="foot_addr"><?php echo $footer_contact_address ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                </section>
                <section class="foot-item">
                    <h2 class="foot-tit"><?php echo $footer_news_title ?></h2>
                    <div class="foot-cont">
                        <ul class="foot-txt-list news-list">
                            <?php foreach ($footer_news_item as $item ) { ?>
                                <li>
                                    <a href="<?php echo ifEmptyText($item['link'],'javascript:;') ?>"><?php echo ifEmptyText($item['title']) ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </section>
                <section class="foot-item foot-item-news">
                    <h2 class="foot-tit"><?php echo $footer_product_title ?></h2>
                    <div class="foot-cont">
                        <?php foreach ($footer_product_item as $item ) { ?>
                            <div class="new-item">
                                <span class="img"><a href="<?php echo ifEmptyText($item['link'],'javascript:;') ?>" title="<?php echo ifEmptyText($item['title']) ?>"><img src="<?php echo ifEmptyText($item['image']) ?>_thumb_262x262.jpg" alt="<?php echo ifEmptyText($item['title']) ?>" title="<?php echo ifEmptyText($item['title']) ?>" /></a></span>
                                <figcaption class="item-info">
                                    <h3 class="title"><a href="<?php echo ifEmptyText($item['link'],'javascript:;') ?>" title="<?php echo ifEmptyText($item['title']) ?>"><?php echo ifEmptyText($item['title']) ?></a></h3>
                                </figcaption>
                            </div>
                        <?php } ?>
                    </div>
                </section>
            </div>
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
            <div class="footer-info">
                <?php print_r('&nbsp|&nbsp <a href="/privacy-policy-page">Privacy Policy</a>'); ?>
                <?php print_r('&nbsp|&nbsp <a href="/sitemap.xml">Sitemap</a>'); ?>
                <?php if (get_category_by_slug('info-news')) print_r('<a href="/info-news">INFO NEWS</a>'); ?>
                <?php if (get_category_by_slug('info-product')) print_r('<a href="/info-product">INFO PRODUCT</a>'); ?>
            </div>
        </div>
    </div>
</footer>

<?php if ( !empty($languagesArray)) { ?>
    <ul class="prisna-wp-translate-seo" id="prisna-translator-seo">
        <li class="language-flag language-flag-en"> <a title="English" href="/"><span>English</span> </a> </li>
        <?php foreach ($languagesArray as $item) { ?>
        <li class="cart-menu-item index-li">
            <a data-language="<?php echo ifEmptyText($item['link'],'javascript:;') ?>"  value="<?php echo ifEmptyText($item['abbr']) ?>" href="<?php echo ifEmptyText($item['link'],'javascript:;') ?>"><?php echo ifEmptyText($item['name']) ?></a>
        </li>
        <?php } ?>
    </ul>
<?php } ?>

<div class="fixed-bottom">
    <?php if ($footer_contact_phone !== '' ) { ?>
        <a href="tel:<?php echo $footer_contact_phone ?>" rel="nofollow"><img src="//q.zvk9.com/Model15/assets/images/btm1.png"></a>
    <?php } else { ?>
        <a href="tel:<?php echo $footer_contact_mobile ?>" rel="nofollow"><img src="//q.zvk9.com/Model15/assets/images/btm1.png"></a>
    <?php } ?>
    <a href="<?php echo $footer_mobile_link ?>" rel="nofollow" ><img src="//q.zvk9.com/Model15/assets/images/btm2.png"></a>
</div>
<?php if ( ifEmptyText($googleExtantion) !== '' ) {
    echo $googleExtantion;
} ?>
<!-- /footer -->

