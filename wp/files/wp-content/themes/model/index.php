<?php
// 数据获取
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>index</title>
    <!-- 通过 get_template_part() 方法引入模块或者组件 -->
    <?php get_template_part( 'templates/components/head' )?>
</head>
<body>

<!-- header -->
<?php get_header()?>
<!-- /header -->

<!-- main -->
<main>
    <!-- 主体部分 -->
</main>
<!-- /main -->

<!-- footer -->
<!-- 通过 get_template_part() 方法引入模块或者组件 -->
<?php get_template_part( 'templates/components/footer' )?>
<!-- /footer -->
</body>

<?php get_footer() ?>

</html>