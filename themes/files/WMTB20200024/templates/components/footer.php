<?php
// footer.json -> vars 数据获取
$theme_vars = json_config_array('footer', 'vars', 1);
$theme_widgets = json_config_array('footer', 'widgets', 1);

$phone = ifEmptyArray($theme_widgets['phone']['vars']['items']['value'][0]);
$mobile = ifEmptyArray($theme_widgets['mobile']['vars']['items']['value'][0]);
$email = ifEmptyArray($theme_widgets['email']['vars']['items']['value'][0]);
$address = ifEmptyArray($theme_widgets['address']['vars']['items']['value'][0]);

$header_vars = json_config_array('header', 'vars', 1);

$facebook_link = ifEmptyText($header_vars['facebookLink']['value']);
$twitter_link = ifEmptyText($header_vars['twitterLink']['value']);
$linkedin_link = ifEmptyText($header_vars['linkedinLink']['value']);
$youtube_link = ifEmptyText($header_vars['youtubeLink']['value']);


$footer_about_title = ifEmptyText($theme_vars['aboutTitle']['value']);
$footer_about_abstract = ifEmptyText($theme_vars['aboutAbstract']['value']);
$footer_contact_title = ifEmptyText($theme_vars['contactTitle']['value']);
$footer_contact_phone = ifEmptyText($phone['value']);
$footer_contact_mobile = ifEmptyText($mobile['value']);
$footer_contact_email = ifEmptyText($email['value']);
$footer_contact_address = ifEmptyText($address['value']);
$footer_news_title = ifEmptyText($theme_vars['newsTitle']['value']);
$footer_product_title = ifEmptyText($theme_vars['productTitle']['value']);
$footer_product_Item = ifEmptyText($theme_vars['productItem']['value']);
$footer_copyright = ifEmptyText($theme_vars['copyright']['value']);
$footer_mobile_link = ifEmptyText($theme_vars['mobileLink']['value']);


$languagesArray = ifEmptyArray(get_query_var('languagesArray'));
$footer_news_item = ifEmptyArray($theme_vars['newsItem']['value']);
$footer_product_item = ifEmptyArray($theme_vars['productItem']['value']);


$googleExtantion = get_option('google_extantion');
$gooleId = get_option('goole_id');
set_query_var('gooleId', $gooleId);

?>
<!--  footer start -->
<footer class="foot-wrapper">
	<section class="layout">
		<section class="gm-sep foot-items">
			<section class="foot-item foot-item-hide  foot-item-Company">
				<h2 class="foot-tit"><?php echo $footer_about_title ?></h2>
				<div class="foot-cont">
					<div class="limit-5-line" >
						<?php echo $footer_about_abstract ?>
					</div>
					<div class="gm-sep foot-social head-sccial">
						<ul class="sccial-cont">
							<?php if ($facebook_link !== '') { ?>
								<li><a href="<?php echo $facebook_link ?>"><img src="//q.zvk9.com/Model23/assets/images/so02.png"  /></a></li>
							<?php } ?>
							<?php if ($linkedin_link !== '') { ?>
								<li><a href="<?php echo $linkedin_link ?>"><img src="//q.zvk9.com/Model23/assets/images/so04.png" /></a></li>
							<?php } ?>
							<?php if ($twitter_link !== '') { ?>
								<li><a href="<?php echo $twitter_link ?>"><img src="//q.zvk9.com/Model23/assets/images/so03.png" /></a></li>
							<?php } ?>
							<?php if ($youtube_link !== '') { ?>
								<li><a href="<?php echo $youtube_link ?>"><img src="//q.zvk9.com/Model23/assets/images/so05.png"  /></a></li>
							<?php } ?>
							<?php if ($google_link !== '') { ?>
								<li><a href="<?php echo $google_link ?>"><img src="//q.zvk9.com/Model23/assets/images/so01.png"  /></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</section>
			<section class="foot-item foot-item-hide  foot-item-inquiry">
				<h2 class="foot-tit"><?php echo $footer_product_title ?></h2>
				<div class="foot-cont">
					<ul class="news-list">
						<li><a class="limit-2-line" href=""><?php echo $footer_product_Item[0]['title1'] ?></a></li>
						<li><a class="limit-2-line" href=""><?php echo $footer_product_Item[0]['title2'] ?></a></li>
						<li><a class="limit-2-line" href=""><?php echo $footer_product_Item[0]['title3'] ?></a></li>
					</ul>
				</div>
			</section>
			<section class="foot-item foot-item-hide foot-item-contact">
				<h2 class="foot-tit"><?php echo $footer_contact_title ?></h2>
				<div class="foot-cont">
					<ul class="contact">
						<?php if ($footer_contact_address !== '') { ?>
							<li class="foot_addr"><?php echo $footer_contact_address ?></li>
						<?php } ?>
						<?php if ($footer_contact_mobile !== '') { ?>
							<li class="foot_tel has-mobile-link"><a class="link" href="tel:<?php echo $footer_contact_mobile ?>" rel="nofollow"><?php echo $footer_contact_mobile ?></a></li>
						<?php } ?>
						<?php if ($footer_contact_phone !== '') { ?>
							<li class="foot_tel has-mobile-link"><a class="link" href="tel:<?php echo $footer_contact_phone ?>" rel="nofollow"><?php echo $footer_contact_phone ?></a></li>
						<?php } ?>
						<?php if ($footer_contact_email !== '') { ?>
							<li class="foot_email"><a href="mailto:<?php echo $footer_contact_email ?>" rel="nofollow"><?php echo $footer_contact_email ?></a></li>
						<?php } ?>
					</ul>
				</div>
			</section>
		</section>
	</section>
	<div class="mobile-contact2">
    <div class="gm-sep head-mobile-contact">
        <div class="head-phone">
                            <a href="tel:0086-0592-5631692"><img src="//q.zvk9.com/Model23/assets/images/btm1.png">Phone</a>
                    </div>
        <div class="head-email">
            <a onclick="showMsgPop();"><img src="//q.zvk9.com/Model23/assets/images/btm2.png">Inquiry</a>
        </div>
    </div>
</div>
	<section class="footer">
		<section class="layout">
			<?php if (ifEmptyText($footer_copyright) !== '') : ?>
				<div class="copyright">Copyright&nbsp;©&nbsp;<span class="get-cur-year"><?php echo date('Y') ?>&nbsp;</span><?php echo $footer_copyright ?></div>
			<?php endif; ?>
		</section>
	</section>
</footer>


<!-- /footer -->