<?php
// footer.json -> vars 数据获取
$theme_vars = json_config_array('footer','vars',1);
$theme_widgets = json_config_array('footer','widgets',1);

$phone = ifEmptyText($theme_widgets['phone']['vars']['value'][0]);
$mobile = ifEmptyText($theme_widgets['mobile']['vars']['value'][0]);
$email = ifEmptyText($theme_widgets['email']['vars']['value'][0]);
$address = ifEmptyText($theme_widgets['address']['vars']['value'][0]);


// array
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
$GA = '';
set_query_var('GA', $GA);
set_query_var('phone', $phone);
set_query_var('mobile', $mobile);
set_query_var('email', $email);
set_query_var('address', $address);

$languagesArray = ifEmptyArray(get_query_var('languagesArray'));
$footer_news_item = ifEmptyArray($theme_vars['newsItem']['value']);
$footer_product_item = ifEmptyArray($theme_vars['productItem']['value']);

$google_extantion = '';

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
                                <li class="foot_tel has-mobile-link"><a class="link" href="tel:<?php echo $footer_contact_phone ?>"><?php echo $footer_contact_phone ?></a></li>
                            <?php } ?>
                            <?php if ($footer_contact_mobile !== '' ) { ?>
                                <li class="foot_tel has-mobile-link"><a class="link" href="tel:<?php echo $footer_contact_mobile ?>"><?php echo $footer_contact_mobile ?></a></li>
                            <?php } ?>
                            <?php if ($footer_contact_email !== '' ) { ?>
                                <li class="foot_email"><label><?php echo $footer_contact_email ?>:</label><a href="mailto:<?php echo $footer_contact_email ?>"><?php echo $footer_contact_email ?></a></li>
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
                                    <a href="<?php echo ifEmptyText($item['link']) ?>"><?php echo ifEmptyText($item['title']) ?></a>
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
                                <span class="img"><a href="<?php echo ifEmptyText($item['link']) ?>" title="<?php echo ifEmptyText($item['title']) ?>"><img src="<?php echo ifEmptyText($item['image']) ?>_thumb_262x262.jpg" alt="<?php echo ifEmptyText($item['title']) ?>"></a></span>
                                <figcaption class="item-info">
                                    <h3 class="title"><a href="<?php echo ifEmptyText($item['link']) ?>" title="<?php echo ifEmptyText($item['title']) ?>"><?php echo ifEmptyText($item['title']) ?></a></h3>
                                </figcaption>
                            </div>
                        <?php } ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="foot-bar">
        <div class="layout">
            <?php if (ifEmptyText($footer_copyright) !== '') : ?>
                <div class="copyright">Copyright © <span class="get-cur-year"><?php echo date('Y') ?></span><?php echo $footer_copyright ?></div>
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php if ( !empty($languagesArray)) { ?>
    <ul class="prisna-wp-translate-seo" id="prisna-translator-seo">
        <li class="language-flag language-flag-en"> <a title="English" href="javascript:changeLanguage('en');"><span>English</span> </a> </li>
        <?php foreach ($languagesArray as $item) { ?>
        <li class="cart-menu-item index-li">
            <a data-language="<?php echo $item['link'] ?>"  value="<?php echo $item['abbr'] ?>" href="<?php echo $item['link'] ?>"><?php echo $item['name'] ?></a>
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
    <a href="<?php echo $footer_mobile_link ?>"><img src="//q.zvk9.com/Model15/assets/images/btm2.png"></a>
</div>
<?php if ( ifEmptyText($google_extantion) !== '' ) {
    echo $google_extantion;
} ?>
<!-- /footer -->

