<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<link rel="apple-touch-icon-precomposed" href="">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link href="//q.zvk9.com/Model27/assets/css/style.css" rel="stylesheet">
<style>
    p {
        word-break: break-word !important;
    }

    .head_top div.change-language {
        margin-bottom: 5px;
    }

    .mobile-head-language {
        display: none;
    }

    .index_main .product_item figure {
        margin: 10px auto;
    }

    .intro_desc {
        word-break: break-word;
    }

    .nav_wrap .head_nav>li {
        padding: 0;
    }

    .main .items_list>ul>li figcaption a {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
    }

    .left-swiper-ul li {
        height: 90px !important;
    }

    div.side-widget {
        margin-bottom: 70px;
    }

    .side-product-items div.items_content {
        padding: 0;
    }

    .aside div.tags,
    .page-tags div.tags,
    .post-tags div.tags {
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
        overflow: hidden;
    }

    .aside div.tags a,
    .page-tags div.tags a,
    .post-tags div.tags a {
        float: left;
        position: relative;
        display: block;
        padding: 10px 15px;
        font-weight: 400;
        font-size: 12px;
        border: 1px solid #f3f3f3;
        background: #fff;
        color: #666;
        margin: 0 3px 3px 0;
    }

    .aside div.tags a:hover,
    .page-tags div.tags a:hover,
    .post-tags div.tags a:hover {
        background: rgba(255, 183, 186, 0.7);
    }

    .send-message {
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .send-message-header {
        background-color: #013e5a;
        height: 55px;
        line-height: 55px;
        color: #fff;
        cursor: default;
    }

    .send-message-header-title {
        font-size: 16px;
        margin-left: 18px;
        float: left;
        padding-left: 4px;
        cursor: default;
    }

    .send-message-content-div {
        width: 100%;
        background: #fff;
        padding: 10px 0;
    }

    .send-message-content input {
        padding: 10px;
        width: 100%;
        border: 1px #efefef solid;
        border-left: 3px #013e5a solid;
    }

    .send-message-textarea {
        width: 100%;
        height: 100%;
        border: 1px #efefef solid;
        border-left: 3px #013e5a solid;
    }

    .send-message-btn {
        width: 100%;
        border: none;
        height: 32px;
        background: #ff6f00;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    .menu-item .sub-menu .has-child::after {
        content: '';
        display: inline-block;
        width: 0;
        height: 0;
        overflow: hidden;
        border: 5px solid #8e8e8e;
        border-left-width: 6px;
        border-right: 0;
        border-top-color: transparent;
        border-bottom-color: transparent;
        position: absolute;
        right: 15px;
        top: 14px;
    }

    @media only screen and (max-width: 950px) {
        .sys_sub_head {
            margin-top: 0;
        }

        .side-product-items .side_product_item {
            width: 30% !important;
        }

        ul.swiper-wrapper.left-swiper-ul li {
            width: 20%;
        }

        .side-widget .tags a {
            display: block;
            float: left;
            padding: 5px;
            border: 1px solid #efefef;
            margin: 0 5px 5px 0;
        }

        .path_bar .layout ul {
            margin: 0;
            text-align: center;
        }

    }

    @media only screen and (max-width: 480px) {
        .main .main-left {
            width: 100%;
            padding: 10px;
        }
    }

    @keyframes explode {
        0% {
            width: 0;
            height: 0;
            margin-left: 0;
            margin-top: 0;
            background-color: rgba(0, 0, 0, .1)
        }

        100% {
            width: 300%;
            padding: 150% 0;
            margin-left: -150%;
            margin-top: -150%;
            background-color: #0497e6
        }
    }

    @keyframes desplode {
        0% {
            width: 300%;
            padding: 150% 0;
            margin-left: -150%;
            margin-top: -150%;
            background-color: #0497e6
        }

        100% {
            width: 0;
            height: 0;
            margin-left: 0;
            margin-top: 0;
            background-color: rgba(0, 0, 0, .1)
        }
    }
</style>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/common.css">