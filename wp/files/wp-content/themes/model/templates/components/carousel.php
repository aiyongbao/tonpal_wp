<?php
/**
 * Template part for carousel
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage test
 * @since 1.0.0
 */

?>

<?php 

$theme_vars = get_query_var('theme_vars');

$carousel_vars = $theme_vars['carousel'];

if($carousel_vars['display'] == 1)
{

?>

<section class="hero-section overlay bg-cover" data-background="<?php echo get_template_directory_uri()?>/assets/images/banner/banner-1.jpg">
  <div class="container">
    <div class="hero-slider">
    <?php
    foreach($carousel_vars['vars']['items']['value'] as $key => $item){
    ?>
      <!-- slider item -->
      <div class="hero-slider-item">
        <div class="row">
          <div class="col-md-8">
            <h1 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".1"><?php echo isset($item['title']) ? $item['title'] : '' ?></h1>
            <p class="text-muted mb-4" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".4"><?php echo isset($item['desc']) ? $item['desc'] : '' ?></p>
            <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".7"><?php echo isset($item['btn']) ? $item['btn'] : '' ?></a>
          </div>
        </div>
      </div>

      <?php
    }
  ?>

    </div>
  </div>
</section>

<?php

  }
?>