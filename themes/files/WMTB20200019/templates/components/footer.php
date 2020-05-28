<?php
// footer.json -> vars 数据获取
$theme_vars = json_config_array('footer','vars',1);
$theme_widgets = json_config_array('footer','widgets',1);

$footer_quick_links = $theme_widgets['quickLink'];
$phone = ifEmptyArray($theme_widgets['phone']);
$email = ifEmptyArray($theme_widgets['email']);
$address = ifEmptyArray($theme_widgets['address']);


$facebook_link = ifEmptyText($theme_vars['facebookLink']['value']);
$twitter_link = ifEmptyText($theme_vars['twitterLink']['value']);
$linkedin_link = ifEmptyText($theme_vars['linkedinLink']['value']);
$youtube_link = ifEmptyText($theme_vars['youtubeLink']['value']);
$footer_copyright = ifEmptyText($theme_vars['copyright']['value']);

$footer_friend_links = ifEmptyArray($theme_vars['friendLinks']['value']);


$googleExtantion = get_option('google_extantion');


?>
<footer class="web_footer">
    <section class="foot_service">
        <div class="layout">
            <?php if ($footer_quick_links['display'] == 1) {
            $quick_links_items = ifEmptyArray($footer_quick_links['vars']['items']['value']);
            if (!empty($quick_links_items)) {
            ?>
            <nav class="foot_nav">
                <ul>
                    <?php foreach ($quick_links_items as $item ) { ?>
                        <li><a rel="nofollow" href="<?php echo $item['link']; ?>"><?php echo $item['name'] ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
            <?php } } ?>
            <address class="foot_contact_list">
                <!--
                icons:
                 ============================
                 contact_ico_local
                 contact_ico_phone
                 contact_ico_email
                 contact_ico_fax
                 contact_ico_skype
                 contact_ico_time  -->
                <ul class="flex_row">
                    <?php if ($address['display'] == 1) {
                        $address_items = ifEmptyArray($address['vars']['items']['value']);
                        ?>
                        <li class="contact_item">
                            <i class="contact_ico contact_ico_local"></i>
                            <?php foreach ($address_items as $item) { ?>
                                <div class="contact_txt">
                                    <span class="item_label"><?php echo ifEmptyText($item['name']) ?></span><span class="item_val"><?php echo ifEmptyText($item['value']) ?></span>
                                </div>
                            <?php } ?>
                        </li>
                    <?php } ?>
                    <?php if ($phone['display'] == 1) {
                        $phone_items = ifEmptyArray($phone['vars']['items']['value']);
                        ?>
                        <li class="contact_item">
                            <i class="contact_ico contact_ico_phone"></i>
                            <?php foreach ($phone_items as $item) { ?>
                                <div class="contact_txt">
                                    <a class="tel_link" href="tel:"><span class="item_label"><?php echo ifEmptyText($item['name']) ?></span><span class="item_val"><?php echo ifEmptyText($item['value']) ?></span></a>
                                </div>
                            <?php } ?>
                        </li>
                    <?php } ?>
                    <?php if ($email['display'] == 1) {
                        $email_items = ifEmptyArray($email['vars']['items']['value']);
                        ?>
                        <li class="contact_item">
                            <i class="contact_ico contact_ico_email"></i>
                            <?php foreach ($email_items as $item) { ?>
                                <div class="contact_txt">
                                    <a href="mailto:"><span class="item_label"><?php echo ifEmptyText($item['name']) ?></span><span class="item_val"><?php echo ifEmptyText($item['value']) ?></span></a>
                                </div>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            </address>
            <?php if ($footer_friend_links != []) { ?>
                <div id="link-item">
                    <div>links<span></span></div>
                    <ul>
                        <?php foreach ($footer_friend_links as $item) { ?>
                            <li><a href="<?php echo ifEmptyText($item['link'],'javascript:;') ?>"><?php echo ifEmptyText($item['name']) ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <ul class="foot_sns">
                <?php if ($facebook_link !== '') { ?>
                    <li><a href="<?php echo $facebook_link ?>" rel="nofollow" ><i class="sc-ico"><img src="<?php echo get_template_directory_uri()?>/assets/picture/sns01.png" alt="<?php echo $facebook_link ?>"/></i></a></li>
                <?php } ?>
                <?php if ($twitter_link !== '') { ?>
                    <li><a href="<?php echo $twitter_link ?>" rel="nofollow" ><i class="sc-ico"><img src="<?php echo get_template_directory_uri()?>/assets/picture/sns02.png" alt="<?php echo $twitter_link ?>" /></i></a></li>
                <?php } ?>
                <?php if ($linkedin_link !== '') { ?>
                    <li><a href="<?php echo $linkedin_link ?>" rel="nofollow" ><i class="sc-ico"><img src="<?php echo get_template_directory_uri()?>/assets/picture/sns03.png" alt="<?php echo $linkedin_link ?>" /></i></a></li>
                <?php } ?>
                <?php if ($youtube_link !== '') { ?>
                    <li><a href="<?php echo $youtube_link ?>" rel="nofollow" ><i class="sc-ico"><img src="<?php echo get_template_directory_uri()?>/assets/picture/sns04.png" alt="<?php echo $youtube_link ?>" /></i></a></li>
                <?php } ?>
            </ul>
        </div>
    </section>
    <section class="foot_bar">
        <div class="layout">
            <?php if (ifEmptyText($footer_copyright) !== '') : ?>
                <div class="copyright">Copyright&nbsp;©&nbsp;<?php echo date('Y') ?>&nbsp;<span class="txt_impt"><?php echo $footer_copyright ?></span></div>
            <?php endif; ?>
            <div class="other">
                <?php print_r('&nbsp|&nbsp <a href="/privacy-policy-page">Privacy Policy</a>'); ?>
                <?php print_r('&nbsp|&nbsp <a href="/sitemap.xml">Sitemap</a>'); ?>
                <?php if (get_category_by_slug('info-news')) print_r('&nbsp|&nbsp<a href="/info-news">Info News</a>'); ?>
                <?php if (get_category_by_slug('info-product')) print_r('&nbsp|&nbsp<a href="/info-product">Info Product</a>'); ?>
            </div>
        </div>
    </section>
</footer>
<!--// web_footer end -->


<?php if ( ifEmptyText($googleExtantion) !== '' ) {
    echo $googleExtantion;
} ?>
<!-- /footer -->

