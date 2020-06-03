<?php
$footer_vars = json_config_array('footer', 'vars', 1);
$footer_widgets = json_config_array('footer', 'widgets', 1);

$email = ifEmptyArray($footer_widgets['email']['vars']['items']['value']);
$mobile = ifEmptyArray($footer_widgets['mobile']['vars']['items']['value']);

// 关于我们
$subscribe_title =  ifEmptyText($footer_vars['aboutTitle']['value']);
$subscribe_desc =  ifEmptyText($footer_vars['aboutAbstract']['value']);
// 组织名
$organization_name = json_config_array('header', 'vars', 1)['title']['value'];
// contactus
$contactus_btn = $footer_vars['contactBtn']['value'];
// 底部图标
$facebookLink = ifEmptyText($footer_vars['facebookLink']['value']);
$twitterLink = ifEmptyText($footer_vars['twitterLink']['value']);
$youtubeLink = ifEmptyText($footer_vars['youtubeLink']['value']);
?>

<footer class="web_footer">
    <div class="layer_top_bg"></div>
    <div class="foot_service">
        <div class="layout">
            <div class="foot_items">
                <nav class="foot_item foot_item_inquiry wow fadeInLeftA" data-wow-delay=".2s" data-wow-duration=".8s">
                    <div class="foot_item_bd">
                        <div class="company_subscribe">
                            <h2 class="subscribe_title"><?php echo $subscribe_title ?></h2>
                            <p class="subscribe_desc"><?php echo $subscribe_desc ?></p>
                            <div class="learn_more">
                                <a href="/contactus.html" class="sys_btn button"><?php echo $contactus_btn ?></a>
                            </div>
                        </div>
                    </div>
                </nav>
                <nav class="foot_item foot_item_follow wow fadeInRightA" data-wow-delay=".2s" data-wow-duration=".8s">
                    <div class="foot_item_bd">
                        <address class="foot_contact_list">
                            <ul>
                                <?php if ($email !== []) { ?>
                                    <li class="contact_item"><?php echo $email[0]['value'] ?></li>
                                <?php } ?>
                                <?php if ($mobile !== []) { ?>
                                    <li class="contact_item"><?php echo $mobile[0]['value'] ?></li>
                                <?php } ?>
                            </ul>
                        </address>
                        <ul class="foot_sns">
                            <li> <a href="//google.com" target="_blank"><img src="//q.zvk9.com/Model27/assets/images/sns01.png" alt=""></a> </li>
                            <?php if (!empty($facebookLink)) { ?>
                                <li> <a href="<?php echo $facebookLink ?>" target="_blank"><img src="//q.zvk9.com/Model27/assets/images/sns02.png" alt=""></a> </li>
                            <?php } ?>
                            <?php if (!empty($twitterLink)) { ?>
                                <li> <a href="<?php echo $twitterLink ?>" target="_blank"> <img src="//q.zvk9.com/Model27/assets/images/sns03.png" alt=""></a></li>
                            <?php } ?>
                            <?php if (!empty($youtubeLink)) { ?>
                                <li> <a href="<?php echo $youtubeLink ?>" target="_blank"><img src="//q.zvk9.com/Model27/assets/images/sns06.png" alt=""></a> </li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="foot_bar wow fadeInUpA" data-wow-delay=".2s" data-wow-duration=".8s">
        <div class="layout">
            <div class="copyright"><?php echo $organization_name ?> Copyright &copy; <?php echo date('Y') ?> | <a href="/privacy_policy.html" style="text-decoration: underline;">Privacy Policy</a> | <a href="/sitemap.xml" style="text-decoration: underline;">Sitemap</a>
                <?php if (get_category_by_slug('info-news')) print_r('|  <a href="/info-news">INFO NEWS</a>'); ?>
                <?php if (get_category_by_slug('info-product')) print_r('|  <a href="/info-product">INFO PRODUCT</a>'); ?>
            </div>
        </div>
    </div>

</footer>