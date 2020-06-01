<?php


// contacts.json -> vars 数据获取
$theme_vars = json_config_array('contacts','vars');

//Text 数据处理
$contacts_title = ifEmptyText($theme_vars['title']['value']);
$contacts_desc = ifEmptyText($theme_vars['desc']['value']);
$page_bg = ifEmptyText($theme_vars['image']['value']);

$theme_widgets_footer = json_config_array('footer','widgets',1);
$phone = ifEmptyArray($theme_widgets_footer['phone']['vars']['items']['value']);
$mobile = ifEmptyArray($theme_widgets_footer['mobile']['vars']['items']['value']);
$email = ifEmptyArray($theme_widgets_footer['email']['vars']['items']['value']);
$address = ifEmptyArray($theme_widgets_footer['address']['vars']['items']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);

$theme_vars_header = json_config_array('header','vars',1);
$type_title = $contacts_title;

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

</head>

<body>
<div class="container">

    <!-- web_head start -->
    <?php get_header() ?>
    <!--// web_head end -->

    <?php if (!empty($page_bg)) { ?>
        <section class="sys_sub_head">
            <div class="head_bn_slider">
                <ul class="head_bn_items">
                    <li class="head_bn_item swiper-slide"><img src="<?php echo $page_bg; ?>" alt=""></li>
                </ul>
            </div>
        </section>
    <?php } ?>
    <!-- path -->
    <?php get_breadcrumbs();?>

    <!-- page-layout start -->
    <section class="web_main page_main">
        <div class="layout">
            <!-- main start -->
            <section class="main public_page" >
                <header class="title">
                    <h1><?php echo $contacts_title ?></h1>
                </header>
                <article class="blog-article">
                    <section class="contacts_box" id="myform" >
                        <form id="contact-form" class="contact_form" role="form">
                            <section class="inquiry-form">
                                <ul>
                                    <div class="form-left">
                                        <li class="form-item">
                                            <span class="tip"><?php echo $placeholder_name ?></span>
                                            <input id="name" type="text" name="name" class="form-input form-input-name">
                                        </li>
                                        <li class="form-item">
                                            <span class="tip"><?php echo $placeholder_phone ?></span>
                                            <input id="phone" type="tel" name="phone" class="form-input form-input-phone">
                                        </li>
                                        <li class="form-item">
                                            <span class="tip"><?php echo $placeholder_email ?></span>
                                            <input id="email" type="email" name="email" class="form-input form-input-email">
                                        </li>
                                    </div>
                                    <div class="form-right">
                                        <li class="form-item">
                                            <span class="tip"><?php echo $placeholder_content ?></span>
                                            <textarea id="message" name="message" class="form-text form-input-massage"></textarea>
                                        </li>
                                    </div>
                                </ul>
                                <div class="form-btn-wrapx">

                                    <input type="hidden" name="product_title" value="<?php echo $type_title;?>">
                                    <div class="alert-success hidden" id="MessageSent">
                                        We have received your message, we will contact you very soon.
                                    </div>
                                    <div class="alert-danger hidden" id="MessageNotSent">
                                        Oops! Something went wrong please refresh the page and try again.
                                    </div>
                                    <input type="submit" id="customer_submit_button" value="<?php echo $message_btn;?>"
                                           class="wpcf7-form-control wpcf7-submit form-btn-submitx"/>
                                </div>
                            </section>
                        </form>
                    </section>
                    <div class="information_right">
                        <h3><?php echo $contacts_desc; ?></h3>
                        <div class="phone">
                            <ul>
                                <?php if (!empty($email)) { ?>
                                    <li>
                                        <div class="phone_left"><img src="<?php echo get_template_directory_uri()?>/assets/images/1-1.png" alt=""></div>
                                        <div class="phone_right">
                                        <?php foreach ($email as $item) { ?>
                                            <p><?php echo $item['value'] ?></p>
                                        <?php } ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                <?php } ?>
                                <?php if (!empty($phone)) { ?>
                                <li>
                                    <div class="phone_left"><img src="<?php echo get_template_directory_uri()?>/assets/images/1-2.png" alt=""></div>
                                    <div class="phone_right">
                                        <?php foreach ($phone as $item) { ?>
                                            <p><?php echo $item['value'] ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                <?php } ?>
                                <?php if (!empty($mobile)) { ?>
                                <li>
                                    <div class="phone_left"><img src="<?php echo get_template_directory_uri()?>/assets/images/1-3.png" alt=""></div>
                                    <div class="phone_right">
                                        <?php foreach ($mobile as $item) { ?>
                                            <p><?php echo $item['value'] ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                <?php } ?>
                                <?php if (!empty($address)) { ?>
                                <li>
                                    <div class="phone_left"><img src="<?php echo get_template_directory_uri()?>/assets/images/1-4.png" alt=""></div>
                                    <div class="phone_right">
                                        <?php foreach ($address as $item) { ?>
                                            <p><?php echo $item['value'] ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </article>
            </section>
            <!--// main end -->
        </div>
    </section>
    <!--// page-layout end -->
    <div class="contacts_footer">
        <div class="layout">
            <?php get_template_part( 'templates/components/tags-random-product' )?>
        </div>
    </div>
    <!-- web_footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
    <!--// web_footer end -->
</div>

</body>
<?php get_footer(); ?>
<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>