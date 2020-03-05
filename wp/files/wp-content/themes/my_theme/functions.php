<?php
if ( ! function_exists( 'my_theme_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function my_theme_setup()
    {

    }

    endif;
    add_action( 'after_setup_theme', 'my_theme_setup' );

    //添加模板css样式
    function add_theme_scripts() {
        wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css');
        wp_enqueue_style( 'responsive', get_template_directory_uri() . '/assets/css/responsive.css');

        //引入jquery依赖
        wp_enqueue_script('jQuery',get_template_directory_uri() . '/assets/js/jquery.js');

        //引入自定义脚本
        wp_enqueue_script('bootstrap.min',get_template_directory_uri().'/assets/js/bootstrap.min.js');
        wp_enqueue_script('jquery.bxslider.min',get_template_directory_uri().'/assets/js/jquery.bxslider.min.js');
        wp_enqueue_script('jquery.countTo',get_template_directory_uri().'/assets/js/jquery.countTo.js');
        wp_enqueue_script('owl.carousel.min',get_template_directory_uri().'/assets/js/owl.carousel.min.js');
        wp_enqueue_script('jquery.mixitup.min',get_template_directory_uri().'/assets/js/jquery.mixitup.min.js');
        wp_enqueue_script('jquery.easing.min',get_template_directory_uri().'/assets/js/jquery.easing.min.js');
        wp_enqueue_script('gmaps',get_template_directory_uri().'/assets/js/gmaps.js');
        wp_enqueue_script('map-helper',get_template_directory_uri().'/assets/js/map-helper.js');
        wp_enqueue_script('jquery.fitvids',get_template_directory_uri().'/assets/js/jquery.fitvids.js');
        wp_enqueue_script('jquery-ui',get_template_directory_uri().'/assets/jquery-ui-1.11.4/jquery-ui.js');
        wp_enqueue_script('jquery-ui',get_template_directory_uri().'/assets/jquery-ui-1.11.4/jquery-ui.js');
        wp_enqueue_script('jquery.appear',get_template_directory_uri().'/assets/js/jquery.appear.js');
        wp_enqueue_script('isotope',get_template_directory_uri().'/assets/js/isotope.js');
        wp_enqueue_script('jquery.prettyPhoto',get_template_directory_uri().'/assets/js/jquery.prettyPhoto.js');
        wp_enqueue_script('timePicker',get_template_directory_uri().'/assets/timepicker/timePicker.js');
        wp_enqueue_script('bootstrap-select',get_template_directory_uri().'/assets/bootstrap-sl-1.12.1/bootstrap-select.js');

        wp_enqueue_script('jquery.themepunch.tools.min',get_template_directory_uri().'/assets/revolution/js/jquery.themepunch.tools.min.js');
        wp_enqueue_script('jquery.themepunch.revolution.min',get_template_directory_uri().'/assets/revolution/js/jquery.themepunch.revolution.min.js');

        wp_enqueue_script('revolution.extension.actions.min',get_template_directory_uri().'/assets/revolution/js/extensions/revolution.extension.actions.min.js');
        wp_enqueue_script('revolution.extension.carousel.min',get_template_directory_uri().'/assets/revolution/js/extensions/revolution.extension.carousel.min.js');
        wp_enqueue_script('revolution.extension.kenburn.min',get_template_directory_uri().'/assets/revolution/js/extensions/revolution.extension.kenburn.min.js');
        wp_enqueue_script('revolution.extension.layeranimation.min',get_template_directory_uri().'/assets/revolution/js/extensions/revolution.extension.layeranimation.min.js');
        wp_enqueue_script('revolution.extension.migration.min',get_template_directory_uri().'/assets/revolution/js/extensions/revolution.extension.migration.min.js');
        wp_enqueue_script('revolution.extension.navigation.min',get_template_directory_uri().'/assets/revolution/js/extensions/revolution.extension.navigation.min.js');
        wp_enqueue_script('revolution.extension.parallax.min',get_template_directory_uri().'/assets/revolution/js/extensions/revolution.extension.parallax.min.js');
        wp_enqueue_script('revolution.extension.slideanims.min',get_template_directory_uri().'/assets/revolution/js/extensions/revolution.extension.slideanims.min.js');
        wp_enqueue_script('jrevolution.extension.video.min.js',get_template_directory_uri().'/assets/revolution/js/extensions/revolution.extension.video.min.js');
        wp_enqueue_script('custom',get_template_directory_uri().'/assets/js/custom.js');

    }

    add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );
