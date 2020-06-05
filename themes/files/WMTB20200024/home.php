<?php
global $wp; // Class_Reference/WP 类实例
// home.json -> widgets 数据获取
$theme_widgets = json_config_array('home', 'widgets');
set_query_var('home_carousel', $theme_widgets['carousel']);
// home.json -> vars 数据获取
$theme_vars = json_config_array('home', 'vars');
// widgets 数据处理
$home_special = $theme_widgets['special'];
$home_about = $theme_widgets['about'];
$home_hotProduct = $theme_widgets['hotProduct'];
$home_news = $theme_widgets['news'];
$home_thank = $theme_widgets['thank'];
// SEO
$seo_Title = ifEmptyText($theme_vars['seoTitle']['value'], 'Home');
$seo_description = ifEmptyText($theme_vars['seoDescription']['value']);
$seo_keywords = ifEmptyText($theme_vars['seoKeywords']['value']);
// 当前页面url
$page_url = get_full_path();
$swiper = ifEmptyArray($theme_widgets['carousel']['vars']['items']['value']);
// special
$home_special_items = ifEmptyArray($home_special['vars']['items']['value']);
//hotprouduct
$home_hotProduct_items = ifEmptyArray($home_hotProduct['vars']['items']['value']);
//about
$home_about_items = ifEmptyArray($home_about['vars']['items']['value']);
//news
$home_news_items = ifEmptyArray($home_news['vars']['items']['value']);
//thank
$home_thank_items = ifEmptyArray($home_thank['vars']['items']['value']);



?>
<!Doctype html>
<html lang="<?php echo empty(get_query_var('lang')) ? 'en' : get_query_var('lang') ?>">

<head>

	<head>
		<meta charset="utf-8">
		<title><?php echo $seo_Title; ?></title>
		<meta name="keywords" content="<?php echo $seo_keywords; ?>" />
		<meta name="description" content="<?php echo $seo_description; ?>" />
		<link rel="canonical" href="<?php echo $page_url; ?>" />
		<?php get_template_part('templates/components/head'); ?>
		<style>
			@media screen and (max-width: 769px) {
				.company-synopses {
					margin: 0;
					display: flex;
					flex-wrap: wrap;
				}

				.synopsis-item {
					width: 48%;
					margin: 1%;
					flex-wrap: wrap;
				}

				.synopsis-item .item-img img {
					width: auto;
					height: 48% ! important;
				}
			}

			.synopsis-item .item-img {
				max-width: 370px;
				max-height: 210px;
				margin: 1%;
				flex-wrap: wrap;
			}

			.synopsis-item .item-img img {
				width: 370px;
				height: 210px;
			}
			
		</style>
	</head>

<body>
	<section class="container">
		<!-- header -->
		<?php get_header(); ?>
		<!-- /header -->
		<!-- carousel -->
		<?php get_template_part('templates/components/carousel') ?>
		<!-- /carousel -->
		<!-- main_content start -->
		<div class="main_content index-main-content">
			<!--company-synopses-wrap  star-->
			<section class="index-layout">
				<!--company-synopses-wrap  star-->
				<section class="company-synopses-wrap">
					<section class="layout">
						<?php if ($home_special['display'] == 1) { ?>
							<ul class="gm-sep company-synopses">
								<?php foreach ($home_special_items as $item) { ?>
									<li class="synopsis-item wow fadeInUp">
										<div class="gm-sep item-wrap">
											<div class="item-img"style="width: 100%; position: relative; display: inline-block">
												<a href="<?php echo $item['link'] ?>" >
													<img src="<?php echo $item['image'] ?>" style="max-width: 360px;max-height: 204px;width: 100%; height: 50%; object-fit: cover;top: 0; left: 0" alt="" />
												</a>
											</div>
											<div class="item-info">
												<h4 class="item-text limit-1-line"></h4>
												<p class="sv-desc limit-2-line"></p>
											</div>
										</div>
									</li>
								<?php } ?>
							</ul>
						<?php } ?>
					</section>
				</section>
				<!--company-synopses-wrap   end-->
				<!--ABOUT star-->
				<section class="about-us-wrap-cont wow zoomIn">
					<?php if ($home_about['display'] == 1) {
						$home_about_title = ifEmptyText($home_about['vars']['title']['value']); ?>
						<section class="about-us-wrap" style="background-color: #212121">
							<section class="layout">
								<div class="gm-sep about-us">

									<?php foreach ($home_about_items as $item) { ?>
										<h1 class="title" style="font-weight: 700; font-size:36px"><?php echo $home_about_title ?></h1>
										<div class="about-detail limit-4-line" style="height:110px;">
											<p style="margin: 0;word-wrap:break-word"><?php echo $home_about_items[0]['date'] ?></p>
										</div>
										<a href="<?php echo $item['link'] ?>" class="read-more"><?php echo $item['btn'] ?></a>
									<?php } ?>

								</div>
							</section>
						</section><?php } ?>
				</section>
				<!--ABOUT end-->
				<!--main products-->
				<?php if ($home_hotProduct['display'] == 1) {
										$home_hotProduct_title = ifEmptyText($home_hotProduct['vars']['title']['value']);
										$home_hotProduct_subtitle = ifEmptyText($home_hotProduct['vars']['subtitle']['value']);
									?>
					<section class="main-product-wrap">
						<section class="layout">

							<h2 class="main-title"> <span class="wrap-1"><?php echo $home_hotProduct_title ?></span> <span class="wrap-2"><?php echo $home_hotProduct_subtitle ?></span></h2>
							<section class="product-items-slide"> </section>
							<section class="gm-sep product-wrap ">
								<?php foreach ($home_hotProduct_items as $item) { ?>
									<div class="container-item product-item wow fadeInUp">
										<div class="item-wrap">
											<div class="pd-img"><a href="<?php echo $item['link'] ?>" style="width: 100%; padding-bottom: 100%; position: relative; display: inline-block">
											<img src="<?php echo $item['image'] ?>" style="position: absolute; width: 100%; height: 100%; object-fit: cover;top: 0; left: 0">
										</a></div>
											<div class="pd-info">
												<h3 class="pd-name"><a class="limit-2-line"><?php echo $item['desc'] ?></a></h3>
											</div>
										</div>
									</div>
								<?php } ?>
							</section>
						<?php } ?>

						</section>
					</section>
					<!--product end-->
					<!-- latest new-->
					<section class="latest-new-wrapper">
						<section class="layout">
							<?php if ($home_news['display'] == 1) {
								$home_news_title = ifEmptyText($home_news['vars']['title']['value']);
								$home_news_subtitle = ifEmptyText($home_news['vars']['subtitle']['value']);
							?>
								<h2 class="main-title"> <span class="wrap-1"><?php echo $home_news_title ?></span> <span class="wrap-2"><?php echo $home_news_subtitle ?></span></h2>
								<section class="new-wrap">
									<ul class="new-item-wrap">
										<?php foreach ($home_news_items as $item) { ?>
											<li class="new-item wow fadeInUp">
												<div class="new-img"><img src="<?php echo $item['image'] ?>" style="width:370px; height:214px;" alt="" /></div>
												<div class="new-info"> <span class="item_published"><?php echo $item['date'] ?></span>
													<h4 class="item_header limit-2-line"><?php echo $item['title'] ?></h4>
													<div class="item_introtext limit-2-line">
														<p><?php echo $item['desc'] ?></p>
													</div>
													<a href="<?php echo $item['link'] ?>" class="read_more"><?php echo $item['btn'] ?></a>
												</div>
											</li>
										<?php } ?>
									</ul>
								<?php } ?>
								</section>
						</section>
					</section>
					<!-- latest new--><?php if ($home_thank['display'] == 1) { ?>
						<section class="thank-wrap">
							<section class="layout">

								<?php foreach ($home_thank_items as $item) { ?>
									<a href="<?php echo $item['link'] ?> " target="_blank">
										<h2 class="main-title limit-1-line"><?php echo $item['desc'] ?></h2>
									</a>
								<?php } ?>

							</section>
						</section><?php } ?>
		</div>
		<!--// main_content end -->
		<?php get_template_part('templates/components/footer') ?>
		<?php get_footer(); ?>
		<!--foot-wrapper  end-->
	</section>

</html>