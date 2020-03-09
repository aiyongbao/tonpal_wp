<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Educenter</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <?php get_template_part( 'templates/components/head' )?>

</head>

<body>
  <!-- preloader start -->
  <div class="preloader">
    <img src="<?php echo get_template_directory_uri()?>/assets/images/preloader.gif" alt="preloader">
  </div>
  <!-- preloader end -->

<!-- header -->
<?php get_header()?>
<!-- /header -->


<!-- page title -->
<section class="page-title-section overlay" data-background="<?php echo get_template_directory_uri()?>/assets/images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="blog.html">Our Product</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">Product Details</li>
        </ul>
        <p class="text-lighten">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- blog details -->
<section class="section-sm bg-gray">
  <div class="container">
    <div class="row">
      
      <div class="col-12">
        <ul class="list-inline">
          <li class="list-inline-item mr-4 mb-3 mb-md-0 text-light"><span class="font-weight-bold mr-2">Post:</span>Somrat</li>
          <li class="list-inline-item mr-4 mb-3 mb-md-0 text-light">August 28, 2017</li>
          <li class="list-inline-item mr-4 mb-3 mb-md-0 text-light"><i class="ti-book mr-2"></i>Read 289</li>
          <li class="list-inline-item mr-4 mb-3 mb-md-0 text-light"><i class="ti-share mr-2"></i>289</li>
          <li class="list-inline-item mr-4 mb-3 mb-md-0 text-light"><a class="text-light" href="#"><i class="ti-comments mr-2"></i>265</a></li>
        </ul>
      </div>
      <!-- border -->
      <div class="col-12 mt-4">
        <div class="border-bottom border-primary"></div>
      </div>

      <?php $post = get_post(); ?>

      <!-- blog contect -->
      <div class="col-12 mb-5">
        <h2><?php echo $post->post_title ?></h2>
        <div class="content">
        <?php echo $post->post_content ?>
        <?php
          
		    ?>
        
        </div>
      </div>
      <!-- comment box -->
      <div class="col-12">
        <form action="#" class="row">
          <div class="col-sm-6">
            <input type="text" class="form-control mb-4" id="name" name="name" placeholder="Full Name">
          </div>
          <div class="col-sm-6">
            <input type="email" class="form-control mb-4" id="mail" name="mail" placeholder="Email Address">
          </div>
          <div class="col-12">
            <textarea name="comment" id="comment" class="form-control mb-4" placeholder="Comment Here..."></textarea>
          </div>
          <div class="col-12">
            <button type="submit" value="send" class="btn btn-primary">post comment</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- /blog details -->

<!-- footer -->
<?php get_footer() ?>
</body>
</html>
