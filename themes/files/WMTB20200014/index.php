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

        <!-- web_head start -->
        <?php get_header() ?>
        <!--// web_head end -->

        <!-- path -->
        <?php get_breadcrumbs();?>

        <!-- page-layout start -->
        <section class="web_main page_main">
            <div class="layout">
                <!-- aside start -->
                <?php get_template_part('templates/components/side-bar'); ?>
                <!--// aside end -->

                <!-- main start -->
                <section class="main" >
                    <div class="main_hd">
                        <div class="page_title">
                            <h1 style="text-transform:uppercase"><?php echo ''; ?></h1>
                        </div>
                    </div>
                    <div>

                    </div>
                </section>
                <!--// main end -->
            </div>
        </section>
        <!--// page-layout end -->

        <!-- web_footer start -->
        <?php get_template_part( 'templates/components/footer' ); ?>
        <!--// web_footer end -->
    </div>
</body>
<?php get_footer() ?>
</html>