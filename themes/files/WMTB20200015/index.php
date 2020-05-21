<?php
// 数据获取
?>
<!DOCTYPE html>
<html lang="<?php echo get_query_var('lang') ? get_query_var('lang') : 'en' ?>">
<head>
    <meta charset="utf-8">
    <title>index</title>
    <!-- 通过 get_template_part() 方法引入模块或者组件 -->
    <?php get_template_part( 'templates/components/head' )?>
</head>
<body>
<div class="container">
    <!-- header start -->
    <?php get_header() ?>
    <!--// header end  -->
    <div class="page_bg" style='background: url("http://demo.tonpal.com/WMTB20200015/assets/images/main_banner.jpg") fixed no-repeat center center'>
    </div>
    <?php get_breadcrumbs();?>
    <!-- page-layout start -->
    <section class="web_main page_main">
        <div class="layout">
            <!-- aside start -->
            <!--            --><?php //get_template_part('templates/components/side-bar'); ?>
            <!--// aside end -->
            <!-- main start -->
            <section class="main">

                <!--// sendMessage -->
                <!--                --><?php //get_template_part( 'templates/components/sendMessage' ); ?>

            </section>
            <!--// main end -->
        </div>
    </section>
    <!--// page-layout end -->
    <!--  footer start -->
    <?php get_template_part( 'templates/components/footer' ); ?>
</div>
</body>
<?php get_footer() ?>
</html>