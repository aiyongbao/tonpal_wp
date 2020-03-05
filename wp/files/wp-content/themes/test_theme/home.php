<?php

/**
 * The Home template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage test
 * @since 1.0.0
 */

get_header();
?>

<?php get_template_part( 'templates/components/carousel' ); ?>

<div class='container mt-3'>
        <div class='row'>
            <div class="col-md-4">
                <div class='item p-3 text-center'>
                    <i style="font-size: 3rem" class="fa fa-mobile" aria-hidden="true"></i>
                    <div class="mt-3">品牌网站定制</div>
                    <p>从品牌高度，品牌VI系统延展整合到品牌网站设计的视觉效果与交互中</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class='item p-3 text-center'>
                    <i style="font-size: 3rem" class="fa fa-mobile" aria-hidden="true"></i>
                    <div class="mt-3">品牌网站定制</div>
                    <p>从品牌高度，品牌VI系统延展整合到品牌网站设计的视觉效果与交互中</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class='item p-3 text-center'>
                    <i style="font-size: 3rem" class="fa fa-mobile" aria-hidden="true"></i>
                    <div class="mt-3">品牌网站定制</div>
                    <p>从品牌高度，品牌VI系统延展整合到品牌网站设计的视觉效果与交互中</p>
                </div>
            </div>
        </div>
    </div>

    <div style="background: url(http://www.templatesy.com/demo/779/assets/onepage/img/quote.jpg);background-size: cover;color:#fff" class="mt-3">
        <div class="container">
            <div class="p-5">
                <h3>我们承诺：</h3>
                <p>绝不率先使用终极奥义绝不率先使用终极奥义绝不率先使用终极奥义绝不率先使用终极奥义绝不率先使用终极奥义绝不率先使用终极奥义绝不率先使用终极奥义</p>
            </div>
        </div>
    </div>

</main>

<?php
get_footer();