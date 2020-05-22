<?php


// contacts.json -> vars 数据获取
$theme_vars = json_config_array('contacts', 'vars');
$theme_widgets_footer = json_config_array('footer', 'widgets', 1);

//Text 数据处理
$contacts_title = ifEmptyText($theme_vars['title']['value']);
$contacts_desc = ifEmptyText($theme_vars['desc']['value']);

$phone = ifEmptyArray($theme_widgets_footer['phone']['vars']['items']['value'][0]);
$mobile = ifEmptyArray($theme_widgets_footer['mobile']['vars']['items']['value'][0]);
$email = ifEmptyArray($theme_widgets_footer['email']['vars']['items']['value'][0]);
$address = ifEmptyArray($theme_widgets_footer['address']['vars']['items']['value'][0]);
$contactus_googleplus = ifEmptyArray($theme_widgets_footer['contactusGoogleplus']['vars']['items']['value'][0]);
$contactus_youtube = ifEmptyArray($theme_widgets_footer['contactusYoutube']['vars']['items']['value'][0]);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);


$theme_vars_header = json_config_array('header','vars',1);
$type_title = $contacts_title;
$message_title = ifEmptyText($theme_vars_header['sendMessageTitle']['value']);
$message_btn = ifEmptyText($theme_vars_header['sendMessageBtn']['value']);
$placeholder_name = ifEmptyText($theme_vars_header['sendMessagePlaName']['value']);
$placeholder_email = ifEmptyText($theme_vars_header['sendMessagePlaEmail']['value']);
$placeholder_phone = ifEmptyText($theme_vars_header['sendMessagePlaPhone']['value']);
$placeholder_content = ifEmptyText($theme_vars_header['sendMessagePlaContent']['value']);

?>
<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <?php get_template_part('templates/components/head'); ?>
    <style type="text/css">
        .contact-entry {
            display: flex;
            justify-content: space-between;
        }
        .contact-entry .inquiry-form-wrap.contact-entry-left {
            margin-top: 0;
        }
        .contact-entry .contact-entry-left {
            flex-grow: 1;
        }
        .contact-entry .contact-entry-right {
            width: 300px;
            margin-left: 40px;
        }
        .contact-entry .contact-entry-right dt {
            margin-top: 20px;
            color: #000;
            font-size: 18px;
            padding-bottom: 5px;
        }
        .contact-entry .contact-entry-right dd a{
            color: #666;
        }
        @media screen and (max-width: 769px){
            .contact-entry {
                display: block;
            }
            .contact-entry .contact-entry-right {
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<!-- header start -->
<?php get_header() ?>
<!--// header end  -->
<!-- path -->
<?php get_breadcrumbs();?>
<!-- main_content start -->
<div class="layout main_content">
    <!--  aside start -->
    <?php get_template_part('templates/components/side-bar'); ?>
    <!--// aside end -->
    <!-- main begin -->
    <section class="main">
        <div class="main-tit-bar">
            <h1 class="title"><?php echo $contacts_title; ?></h1>
        </div>
        <article class="entry blog-article contact-entry">
            <section class="inquiry-form-wrap ct-inquiry-form fl contact-entry-left" id="inquiryUs">
                <h4 class="inquiry-form-title" style="text-transform:uppercase"><?php echo $message_title ?></h4>
                <p class="inquiry-form-desc"><?php echo $contacts_desc; ?></p>
                <form id="contact-form" role="form">
                    <section class="inquiry-form">
                        <div class="inquiry-form-ico"><img src="//q.zvk9.com/Model20/assets/images/inq03.png" alt="<?php echo $message_title ?>"></div>
                        <ul>
                            <li class="form-item">
                                <input id="name" type="text" name="name" class="form-input form-input-name" placeholder="<?php echo $placeholder_name ?>">
                            </li>
                            <li class="form-item">
                                <input id="email" type="text" name="email" class="form-input form-input-email" placeholder="<?php echo $placeholder_email ?>">
                            </li>
                            <li class="form-item">
                                <input id="phone" type="text" name="phone" class="form-input form-input-phone" placeholder="<?php echo $placeholder_phone ?>">
                            </li>
                            <li class="form-item">
                                <textarea id="message" name="message" class="form-text form-input-massage" placeholder="<?php echo $placeholder_content ?>"></textarea>
                            </li>
                        </ul>
                        <div class="form-btn-wrapx">
                            <input type="hidden" name="product_title" value="<?php echo $type_title;?>">
                            <div class="alert-success" id="MessageSent" style="display: none">
                                We have received your message, we will contact you very soon.
                            </div>
                            <div class="alert-danger" id="MessageNotSent" style="display: none">
                                Oops! Something went wrong please refresh the page and try again.
                            </div>
                            <input type="submit" id="customer_submit_button" value="<?php echo $message_btn;?>" class="wpcf7-form-control wpcf7-submit form-btn-submitx" />
                        </div>
                    </section>
                </form>
            </section>
            <section class="contact-entry-right">
                <?php if (!empty($email['name'])) { ?>
                    <dl class="email fl">
                        <dt><?php echo ifEmptyText($email['name'])?>:</dt>
                        <dd><a href="mailto:<?php echo ifEmptyText($email['name'])?>"><?php echo ifEmptyText($email['value'])?></a></dd>
                    </dl>
                <?php } ?>
                <?php if (!empty($phone['name'])) { ?>
                    <dl class="phone fl">
                        <dt><?php echo ifEmptyText($phone['name'])?>:</dt>
                        <dd><a href="tel:<?php echo ifEmptyText($phone['name'])?>"><?php echo ifEmptyText($phone['value'])?></dd>

                    </dl>
                <?php } ?>
                <?php if (!empty($address['name'])) { ?>
                    <dl class="address fl">
                        <dt><?php echo ifEmptyText($address['name'])?>:</dt>
                        <dd><a href="javascript:;"><?php echo ifEmptyText($address['value'])?></a></dd>
                    </dl>
                <?php } ?>
                <?php if (!empty($contactus_googleplus['name'])) { ?>
                <dl class="whatsapp">
                    <dt><?php echo ifEmptyText($contactus_googleplus['name'])?>:</dt>
                    <dd><a href="javascript:;"><?php echo ifEmptyText($contactus_googleplus['value'])?></a></dd>
                </dl>
                <?php } ?>
                <?php if (!empty($contactus_youtube['name'])) { ?>
                    <dl class="viber">
                        <dt><?php echo ifEmptyText($contactus_youtube['name'])?>:</dt>
                        <dd><a href="javascript:;"><?php echo ifEmptyText($contactus_youtube['value'])?></a></dd>
                    </dl>
                <?php } ?>

            </section>
        </article>
    </section>
    <!--// main end -->
</div>
<!--// main_content end -->
<!--  footer start -->
<?php get_template_part( 'templates/components/footer' ); ?>
<!--  footer end -->
</body>
<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part('templates/components/microdata') ?>

</html>