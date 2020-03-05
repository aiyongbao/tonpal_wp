        <meta charset="utf-8">
		<title>{{ seo_title }}</title>
		<meta name="keywords" content="{{ seo_keywords }}" />
		<meta name="description" content="{{ seo_description }}" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		{% if header_logo_img is defined and header_logo_img is not empty %}
		<link rel="shortcut icon" href="{{ header_logo_img }}" />
		{% else %}
		<link rel="shortcut icon" href="{{ logo_url }}_thumb_150x50.png" />
		{% endif %}
		{% if domain is defined and domain is not empty %}
		<link rel="canonical" href='//{{domain}}/{{ page_url }}' />
		{% endif %}

		<link href="//q.zvk9.com/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="//q.zvk9.com/{{tmpl}}/assets/css/animate.min.css" rel="stylesheet">
		<link href="//q.zvk9.com/{{tmpl}}/assets/css/main170810.min.css" rel="stylesheet">
		<!-- 模板6和模板5基于同一套模板原型,所以这里引用模板5的网站颜色 -->
		{% if websitecolor_check is defined and websitecolor_check is not empty %}
		<link href="//q.zvk9.com/model5/assets/css/skins/{{ websitecolor_check }}.css" rel="stylesheet" type="text/css" id="color_scheme" />
		{% endif %}
        <link href="//q.zvk9.com/plugins/tinymce.20170727.css" rel="stylesheet">
		{{json_ld}}
        <style>

			.solution .col-md-3{
				width: 25%!important;
			}

			.swiper-container {
				width: 100%;
				height: 350px;
			}

			.swiper-slide img {
				width: 100%;
				height: 100%;
			}

			.welcome{
				font-size: 38px;
				font-weight: 700;
				text-align:center;
			}

			.solution_title{
				font-size: 38px;
				font-weight: 700;
				text-align:center;
			}

			.listing-item {
				margin: 0 0 20px 0!important;
				width: 100% !important;
				max-width: inherit !important;
			}

			.listing-item .overlay-container img{
				width: 100%;
			}

			.custom-index-section1 .grid-space-20 .listing-item-body p:first{
                height: 38px;
			}

			.custom-index-section1 .grid-space-20 .listing-item-body p:second{
			    height:55px;
			}

			@media only screen and (max-width: 990px){
				.solution  .col-sm-6 {
					width: 50%;
					float: left;
				}

				.solution .col-sm-6:nth-child(odd){
					padding-left: 10px;
					padding-right: 5px;
				}

				.solution .col-sm-6:nth-child(even){
					padding-left: 5px;
					padding-right: 10px;
				}

				.swiper-container {
					width: 100%;
					height: 100%;
				}

				.container{
					padding: 0;
				}

				.header .navbar-header{
					margin-bottom: 0
				}

				.welcome{
					font-size: 25px;
					font-weight: 700;
					text-align:center;
				}

				.solution_title{
					font-size: 25px;
					font-weight: 700;
					text-align:center;
				}

				.callout .container{
					padding: 15px 0;
				}

				.callout .col-md-9 p{
					margin-bottom: 5px;
				}

				.btn.btn-lg {
					padding: 10px 12px;
					font-size: 14px;
				}

				.custom-index-section1 .grid-space-20 {
					margin: 0 !important;
				}

				.listing-item-body {
					padding: 10px;
				}

				.custom-index-section1 .grid-space-20 .listing-item-body p{
					margin: 0;
				}

				.listing-item {
					margin-bottom: 10px !important;
				}

				.custom-index-section1 .grid-space-20 .listing-item-body p:first{
                                height: 38px;
                			}

                			.custom-index-section1 .grid-space-20 .listing-item-body p:second{
                			    height:55px;
                			}

			}

			@media (max-width: 767px){
				.solution .col-sm-6 {
					width: 50%!important;
					float: left;
				}

				.solution .col-sm-6:nth-child(odd){
					padding-left: 10px;
					padding-right: 5px;
				}

				.solution .col-sm-6:nth-child(even){
					padding-left: 5px;
					padding-right: 10px;
				}

				.swiper-container {
					width: 100%;
					height: 100%;
				}

				.container{
					padding: 0;
				}

				.header .navbar-header{
					margin-bottom: 0;
				}

				.welcome{
					font-size: 25px;
					font-weight: 700;
					text-align:center;
				}

				.solution_title{
					font-size: 25px;
					font-weight: 700;
					text-align:center;
				}

				.callout .container{
					padding: 15px 0;
				}

				.callout .col-md-9 p{
					margin-bottom: 5px;
				}

				.btn.btn-lg {
					padding: 10px 12px;
					font-size: 14px;
				}

				.custom-index-section1 .grid-space-20 {
					margin: 0 !important;
				}

				.listing-item-body {
					padding: 10px;
				}

				.custom-index-section1 .grid-space-20 .listing-item-body p{
					margin: 0;
				}

				.listing-item {
					margin-bottom: 10px !important;
				}

				.custom-index-section1 .grid-space-20 .listing-item-body p:first{
                                height: 38px;
                			}

                			.custom-index-section1 .grid-space-20 .listing-item-body p:second{
                			    height:55px;
                			}

			}

		</style>