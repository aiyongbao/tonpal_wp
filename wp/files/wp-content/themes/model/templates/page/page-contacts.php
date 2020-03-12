<?php
$data = get_post();
$type_title = $data->post_name;

// contacts.json -> vars 数据获取
$theme_vars = json_config_array('contacts','vars');

//Text 数据处理
$contacts_title = ifEmptyText($theme_vars['title']['value'],'contacts');
$contacts_bg = ifEmptyText($theme_vars['bg']['value'],'http://wp.io/wp-content/themes/model/assets/images/backgrounds/page-title.jpg');
$contacts_desc = ifEmptyText($theme_vars['desc']['value']);
$contacts_modularTwo = ifEmptyText($theme_vars['modularTwo']['value']);
$contacts_contentDesc= ifEmptyText($theme_vars['contentDesc']['value']);
$contacts_tel = ifEmptyText($theme_vars['tel']['value']);
$contacts_email = ifEmptyText($theme_vars['email']['value']);
$contacts_address = ifEmptyText($theme_vars['address']['value']);
$contacts_latitude = ifEmptyText($theme_vars['latitude']['value']);
$contacts_longitude = ifEmptyText($theme_vars['longitude']['value']);

// SEO
$seo_title = ifEmptyText($theme_vars['seoTitle']['value'],"$contacts_title");
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
?>
    <!doctype html>

    <head>
        <meta charset="utf-8">
        <title><?php echo $seo_title; ?></title>
        <meta name="keywords" content="<?php echo $seo_description; ?>" />
        <meta name="description" content="<?php echo $seo_keywords; ?>" />

    <?php get_template_part('templates/components/head'); ?>

    </head>

    <body>
    <!-- header -->
    <?php get_header() ?>
    <!-- header -->

    <main>
        <!-- page title -->
        <section class="page-title-section overlay" data-background="<?php echo $contacts_bg; ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="list-inline custom-breadcrumb">
                            <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="/">Home</a></li>
                            <li class="list-inline-item text-white h3 font-secondary nasted"><?php echo $contacts_title; ?></li>
                        </ul>
                        <p class="text-lighten"><?php echo $contacts_desc; ?></p>
                    </div>
                </div>
            </div>
        </section>
        <!-- /page title -->

        <!-- contact -->
        <section class="section bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if ($contacts_modularTwo !== '') { ?>
                            <h2 class="section-title"><?php echo $contacts_modularTwo ?></h2>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 mb-4 mb-lg-0">
                        <div class="send-mewssage">
                            <input type="text" class="form-control mb-3" id="name" name="name" placeholder="Your Name">
                            <input type="email" class="form-control mb-3" id="email" name="mail" placeholder="Your Email">
                            <input type="text" class="form-control mb-3" id="phone" name="phone" placeholder="Your Phone">
                            <textarea name="message" id="message" class="form-control mb-3" placeholder="Your Message"></textarea>
                            <input type="hidden" id="organization_id" value="a5168987-eeac-11e6-b0b5-6c92bf2bf11d">

                            <input type="hidden" id="product_title" value="<?php echo ifEmptyText($type_title,'Home');?>">
                            <button type="submit" value="send" class="btn btn-primary send-message-btn" id="customer_submit_button">SEND MESSAGE</button>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <p class="mb-5"><?php echo $contacts_contentDesc ?></p>
                        <a href="tel:<?php echo $contacts_tel ?>" class="text-color h5 d-block"><?php echo $contacts_tel ?></a>
                        <a href="mailto:<?php echo $contacts_email ?>" class="mb-5 text-color h5 d-block"><?php echo $contacts_email ?></a>
                        <p><?php echo $contacts_address ?></p>
                    </div>
                </div>
            </div>
        </section>
        <!-- /contact -->

        <!-- gmap -->
        <section class="section pt-0">
            <!-- Google Map -->
            <div id="map_canvas" data-latitude="<?php echo $contacts_latitude ?>" data-longitude="<?php echo $contacts_longitude ?>"></div>
        </section>
        <!-- /gmap -->
    </main>
    <!-- google map -->
    <?php get_template_part( 'templates/components/footer' ); ?>



    </body>
<?php get_footer(); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu5nZKbeK-WHQ70oqOWo-_4VmwOwKP9YQ"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/plugins/google-map/gmap.js"></script>
<script>
    $('#customer_submit_button').on('click', function() {

        $("#customer_submit_button").attr("disabled","disabled");

        var aop_param = {};

        aop_param.product_title = $("#product_title").val();
        aop_param.contact_name = $("#name").val();
        aop_param.contact_email = $("#email").val();
        aop_param.contact_subject = $("#phone").val();
        aop_param.contact_comment = $("#message").val();
        aop_param.organization_id = $("#organization_id").val();
        if(location.href.indexOf('?')>-1){
            aop_param.reference = location.href.split('?')[0];
        }else{
            aop_param.reference = location.href;
        }
        $.ajax({
            url:"//tonpal.aiyongbao.com/action/savemessage",
            dataType: 'jsonp',
            type:'GET',
            data: aop_param,
            success : function(rsp){
                alert('Sent successfully');
                $("#customer_submit_button").removeAttr("disabled");
                location.reload();
            },
            error: function(rsp, textStatus, errorThrown){
                $("#customer_submit_button").removeAttr("disabled");
                alert('error');
            }
        });
        return false;
    });
</script>
