<?php
// certificate.json -> vars 数据获取
$theme_vars = json_config_array('certificate','vars');

// Array 数据处理
$certificate_items = ifEmptyArray($theme_vars['items']['value']);
// Text 数据处理
$certificate_title = ifEmptyText($theme_vars['title']['value'],'certificate');
$page_bg = ifEmptyText($theme_vars['image']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value']);
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>
<!doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">


<head>
    <meta charset="utf-8">
    <title><?php echo $seo_title; ?></title>
    <meta name="keywords" content="<?php echo $seo_keywords; ?>" />
    <meta name="description" content="<?php echo $seo_description; ?>" />

    <?php get_template_part('templates/components/head'); ?>
    <link href="https://cdn.bootcss.com/fancybox/3.3.5/jquery.fancybox.css" rel="stylesheet">
    <style>
        .fancybox-opened{z-index: 999999}
        .fancybox-overlay{z-index: 99999}
    </style>
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
                    <h1><?php echo $certificate_title ?></h1>
                </header>
                <article class="blog-article">
                    <ul class="certificate_list">
                        <?php if (!empty($certificate_items)) { ?>
                            <?php foreach ($certificate_items as $item) { ?>
                                <li class="certificate_item">
                                    <figure class="item-image">
                                        <a href="<?php echo ifEmptyText($item['image'])?>" data-fancybox="group" data-caption="<?php echo ifEmptyText($item['title'])?>" title="<?php echo ifEmptyText($item['title'])?>" class="item-img">
                                            <img src="<?php echo ifEmptyText($item['image'])?>" alt="<?php echo ifEmptyText($item['desc'])?>" title="<?php echo ifEmptyText($item['title'])?>" />
                                        </a>
                                    </figure>
                                    <div class="item-info pd-10">
                                        <h3 class="item-title"><?php echo ifEmptyText($item['title'])?></h3>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </article>
            </section>
            <!--// main end -->
        </div>
    </section>
    <!--// page-layout end -->
    <div class="page_footer">
        <div class="layout">
            <?php get_template_part( 'templates/components/sendMessage' ); ?>
            <!--// tags -->
            <?php get_template_part( 'templates/components/tags-random-product' )?>
        </div>
    </div>
    <!-- web_footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
    <!--// web_footer end -->
</div>
<?php
// header.json
$theme_vars_header = json_config_array('header','vars',1);
$languagesArray = ifEmptyArray(get_query_var('languagesArray'));
$search_tip = ifEmptyText($theme_vars_header['searchTip']['value']);
$search_slogan = ifEmptyText($theme_vars_header['searchSlogan']['value']);
?>
<div class="web-search"> <b id="btn-search-close" class="btn--search-close"></b>
    <div style=" width:100%">
        <div class="head-search">
            <form id="search" action="<?php echo get_lang_home_url(); ?>" target="_blank" >
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
</body>
<script src="<?php echo get_template_directory_uri()?>/assets/js/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri()?>/assets/js/common.js"></script>

<script src="//q.zvk9.com/Model20/assets/js/jquery.min.js"></script>
<script src="//q.zvk9.com/Model15/assets/js/jquery.validate.min.js"></script>
<script src="https://cdn.bootcss.com/fancybox/3.3.5/jquery.fancybox.min.js"></script>

<script>
    $(function () {
        $('#contact-form').length > 0 &&
        $('#contact-form').validate({
            submitHandler: function(e) {
                $('#customer_submit_button')
                    .prop({ disabled: !0, value: 'Loading...' })
                    .addClass('disabled btn-success');
                var i = {};
                (i.post_name =
                    void 0 === e.product_title.value
                        ? ''
                        : e.product_title.value),
                    (i.name = e.name.value),
                    (i.email = e.email.value),
                    (i.phone = e.phone.value),
                    (i.message = e.message.value),
                    location.href.indexOf('?') > -1
                        ? (i.reference = location.href.split('?')[0])
                        : (i.reference = location.href),
                    $.ajax({
                        url: '/wp-json/portal/v1/inquiry',
                        type:'POST',
                        data: i,
                        success: function(e) {
                            $('#MessageSent').removeClass('hidden'),
                                $('#MessageNotSent').addClass('hidden'),
                                $('#customer_submit_button')
                                    .addClass('btn-success')
                                    .prop('value', 'Message Sent'),
                                setTimeout(function() {
                                    $('#MessageSent').addClass('hidden'),
                                        $('#customer_submit_button')
                                            .removeClass(
                                                'disabled btn-success'
                                            )
                                            .prop({
                                                disabled: !1,
                                                value: 'Send Message'
                                            });
                                    $('#name').val('');
                                    $('#phone').val('');
                                    $('#email').val('');
                                    $('#message').val('');
                                }, 2e3);
                        },
                        error: function(e, i, t) {
                            $('#MessageNotSent').removeClass('hidden'),
                                $('#MessageSent').addClass('hidden'),
                                setTimeout(function() {
                                    $('#MessageNotSent').addClass('hidden'),
                                        $('#customer_submit_button')
                                            .removeClass(
                                                'disabled btn-success'
                                            )
                                            .prop({
                                                disabled: !1,
                                                value: 'Send Message'
                                            });
                                }, 2e3);
                        }
                    });
            },
            errorPlacement: function(e, i) {
                i.after(e);
            },
            onkeyup: !1,
            onclick: !1,
            rules: {
                name: { required: !0, minlength: 2 },
                email: { required: !0, email: !0 },
                subject: { required: !0 },
                message: { required: !0, minlength: 10 }
            },
            messages: {
                name: {
                    required: 'Please specify your name',
                    minlength: 'Your name must be longer than 2 characters'
                },
                email: {
                    required: 'We need your email address to contact you',
                    email:
                        'Please enter a valid email address e.g. name@domain.com'
                },
                subject: { required: 'Please enter a subject' },
                message: {
                    required: 'Please enter a message',
                    minlength:
                        'Your message must be longer than 10 characters'
                }
            },
            errorElement: 'span',
            highlight: function(e) {},
            success: function(e) {}
        });
        $('#link-item>div').click(() => {
            $('#link-item ul li').toggle('500');
        })
    })
</script>

<!--微数据-->
<?php get_template_part( 'templates/components/microdata' )?>
</html>

