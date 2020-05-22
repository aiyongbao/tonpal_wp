<?php
// footer.json -> vars 数据获取
$theme_vars = json_config_array('footer','vars',1);
$theme_widgets = json_config_array('footer','widgets',1);

$phone = ifEmptyArray($theme_widgets['phone']['vars']['items']['value'][0]);
$email = ifEmptyArray($theme_widgets['email']['vars']['items']['value'][0]);
$address = ifEmptyArray($theme_widgets['address']['vars']['items']['value'][0]);
$contactus_googleplus = ifEmptyArray($theme_widgets['contactusGoogleplus']['vars']['items']['value'][0]);
$contactus_youtube = ifEmptyArray($theme_widgets['contactusYoutube']['vars']['items']['value'][0]);
$footer_inquiry = ifEmptyArray($theme_widgets['footerInquiry']);

$footer_about_title = ifEmptyText($theme_vars['aboutTitle']['value']);
$footer_about_abstract = ifEmptyText($theme_vars['aboutAbstract']['value']);
$footer_contact_title = ifEmptyText($theme_vars['contactTitle']['value']);

$footer_copyright = ifEmptyText($theme_vars['copyright']['value']);

// header.json
$theme_vars_header = json_config_array('header','vars',1);

// 多语种
$languages = get_languages();
$languagesArray = [];
foreach ($languages as $item) {
    $name = $item['e_name'];
    $link = '/' . $item['abbr'];
    array_push($languagesArray, array('name' => $name, 'link' => $link, 'abbr' => $item['abbr']));
}

$footer_friend_links = ifEmptyArray($theme_vars['friendLinks']['value']);


$googleExtantion = get_option('google_extantion');


?>
<footer class="foot-wrapper" style="background-image: url(//q.zvk9.com/Model20/assets/images/footer_bg.jpg)">
    <div class="gm-sep layout foot-items">
        <div class="foot-item  foot-item-contact">
            <h2 class="foot-tit"><?php echo $footer_about_title ?></h2>
            <div class="foot-about limit-6-line">
                <?php echo $footer_about_abstract ?>
            </div>
        </div>
        <div class="foot-item  foot-item-contact">
            <h2 class="foot-tit"><?php echo $footer_contact_title ?></h2>
            <ul class="foot-cont">
                <ul class="contact-list">
                    <?php if ( !empty($address['value']) ) { ?>
                        <li class="foot_addr"><?php printf('%s:%s',ifEmptyText($address['name'],'Address'),$address['value']); ?></li>
                    <?php } ?>
                    <?php if ( !empty($phone['value']) ) { ?>
                        <li class="foot_phone"><a class="link" href="tel:<?php echo $phone['value'] ?>" rel="nofollow" ><?php printf('%s:%s',ifEmptyText($phone['name'],'Phone'),$phone['value']); ?></a></li>
                    <?php } ?>
                    <?php if ( !empty($email['value']) ) { ?>
                        <li class="foot_email"><a href="mailto:<?php echo $email['value'] ?>" rel="nofollow" ><?php printf('%s:%s',ifEmptyText($email['name'],'Email'),$email['value']); ?></a></li>
                    <?php } ?>
                    <?php if ( !empty($contactus_googleplus['value'])) { ?>
                        <li class="foot_googleplus">
                            <a href="javascript:;"><?php printf('%s:%s',ifEmptyText($contactus_googleplus['name'],'WhatsApp'),$contactus_googleplus['value']); ?></a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty($contactus_youtube['value'])) { ?>
                        <li class="foot_youtube">
                            <a href="javascript:;"><?php printf('%s:%s',ifEmptyText($contactus_youtube['name'],'Viber'),$contactus_youtube['value']); ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </ul>
        </div>
        <?php if($footer_inquiry['display'] == 1) {
            $title = ifEmptyText($footer_inquiry['vars']['title']['value'],'SUBSCRIBE');
            $desc = ifEmptyText($footer_inquiry['vars']['desc']['value']);
            $btn = ifEmptyText($footer_inquiry['vars']['btn']['value'],'Inquiry');
            ?>
            <div class="foot-item foot-item-inquiry">
                <h2 class="foot-tit"><?php echo $title; ?></h2>
                <div class="foot-cont">
                    <div class="subscribe">
                        <span class="txt"><?php echo $desc; ?></span>
                        <div class="button" onclick="showMsgPop();"><?php echo $btn; ?></div>
                    </div>
                </div>
            </div>
        <?php } ?>
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
    <div class="foot-bar">
        <div class="layout">
            <?php if (ifEmptyText($footer_copyright) !== '') : ?>
                <div class="copyright">Copyright&nbsp;©&nbsp;<span class="get-cur-year"><?php echo date('Y') ?>&nbsp;</span><?php echo $footer_copyright ?></div>
            <?php endif; ?>
            <div class="footer-info">
                <?php print_r('&nbsp|&nbsp <a href="/privacy-policy-page">Privacy Policy</a>'); ?>
                <?php print_r('&nbsp|&nbsp <a href="/sitemap.xml">Sitemap</a>'); ?>
                <?php if (get_category_by_slug('info-news')) print_r('&nbsp|&nbsp<a href="/info-news">Info News</a>'); ?>
                <?php if (get_category_by_slug('info-product')) print_r('&nbsp|&nbsp<a href="/info-product">Info Product</a>'); ?>
            </div>
        </div>
    </div>
</footer>
<!--// web_footer end -->

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

<div class="mobile-contact">
    <div class="gm-sep head-mobile-contact">
        <div class="head-phone">
            <a href="tel:<?php echo $phone['value']; ?>"><img src="//q.zvk9.com/Model20/assets/images/btm1.png"><?php echo $phone['name']; ?></a>
        </div>
        <div class="head-email">
            <a onclick="showMsgPop();"><img src="//q.zvk9.com/Model20/assets/images/btm2.png"><?php echo ifEmptyText($footer_inquiry['vars']['btn']['value'],'Inquiry'); ?></a>
        </div>
    </div>
</div>

<?php if ( ifEmptyText($googleExtantion) !== '' ) {
    echo $googleExtantion;
} ?>
<!-- /footer -->

<!-- 询盘弹窗 -->
<?php
$data = get_post();
$type_title = $data->post_name;

$message_title = ifEmptyText($theme_vars_header['sendMessageTitle']['value']);
$message_btn = ifEmptyText($theme_vars_header['sendMessageBtn']['value']);
$placeholder_name = ifEmptyText($theme_vars_header['sendMessagePlaName']['value']);
$placeholder_email = ifEmptyText($theme_vars_header['sendMessagePlaEmail']['value']);
$placeholder_phone = ifEmptyText($theme_vars_header['sendMessagePlaPhone']['value']);
$placeholder_content = ifEmptyText($theme_vars_header['sendMessagePlaContent']['value']);


$contacts_desc = ifEmptyText(get_query_var('contactsDesc'));

?>
<section class="inquiry-pop-bd">
    <section class="inquiry-pop">
        <i class="ico-close-pop" onClick="hideMsgPop();"></i>
        <section class="inquiry-form-wrap ct-inquiry-form">
            <form id="contact-form2"  role="form">
                <section class="inquiry-form">
                    <div class="inquiry-form-ico"> <img src="//q.zvk9.com/Model20/assets/images/inq03.png" alt="Send Inquiry Now" /> </div>
                    <ul>
                        <li class="form-item">
                            <input id="name2" type="text" name="name2" class="form-input form-input-name" placeholder="<?php echo $placeholder_name ?>">
                        </li>
                        <li class="form-item">
                            <input id="email2" type="text" name="email2" class="form-input form-input-email" placeholder="<?php echo $placeholder_email ?>">
                        </li>
                        <li class="form-item">
                            <input id="phone2" type="text" name="phone2" class="form-input form-input-phone" placeholder="<?php echo $placeholder_phone ?>">
                        </li>
                        <li class="form-item">
                            <textarea id="message2" name="message2" class="form-text form-input-massage" placeholder="<?php echo $placeholder_content ?>"></textarea>
                        </li>
                    </ul>
                    <div class="form-btn-wrapx">
                        <input type="hidden" name="product_title2" value="<?php echo $type_title;?>">
                        <div class="alert-success" id="MessageSent2" style="display: none">
                            We have received your message, we will contact you very soon.
                        </div>
                        <div class="alert-danger" id="MessageNotSent2" style="display: none">
                            Oops! Something went wrong please refresh the page and try again.
                        </div>
                        <input type="submit" id="customer_submit_button2" value="<?php echo $message_btn;?>" class="wpcf7-form-control wpcf7-submit form-btn-submitx" />
                    </div>
                </section>
            </form>
        </section>
    </section>
</section>