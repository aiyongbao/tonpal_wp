<?php
// footer.json -> vars 数据获取
$theme_vars = json_config_array(__FILE__,'vars',1);
$footer_message = ifEmptyArray($theme_vars['message']['value']);
$footer_friendshipLinks = ifEmptyArray($theme_vars['friendshipLinks']['value']);
?>
<footer>
  <!-- newsletter -->
  <div class="newsletter">
    <div class="container">
      <div class="row">
        <div class="col-md-9 ml-auto bg-primary py-5 newsletter-block">
          <h3 class="text-white">Subscribe Now</h3>
          <form action="#">
            <div class="input-wrapper">
              <input type="email" class="form-control border-0" id="newsletter" name="newsletter" placeholder="Enter Your Email...">
              <button type="submit" value="send" class="btn btn-primary">Join</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- footer content -->
  <div class="footer bg-footer section border-bottom">
    <div class="container">
      <div class="row">
          <?php
              foreach ($footer_message as $key => $item) {
                if ($key == 0) {
              ?>
                    <div class="col-lg-4 col-sm-8 mb-5 mb-lg-0">
                      <!-- logo -->
                      <a class="logo-footer" href="/"><img class="img-fluid mb-4" src="<?php echo ifEmptyText($item['logo']) ?>" alt="logo"></a>
                      <ul class="list-unstyled">
                        <li class="mb-2"><?php echo ifEmptyText($item['address']) ?></li>
                        <li class="mb-2"><?php echo ifEmptyText($item['Telephone']) ?></li>
                        <li class="mb-2"><?php echo ifEmptyText($item['mobilePhone']) ?></li>
                        <li class="mb-2"><?php echo ifEmptyText($item['email']) ?></li>
                      </ul>
                    </div>
                  <?php
                }
              }
          ?>
        <!-- company -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">COMPANY</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" rel="nofollow" href="about.html">About Us</a></li>
            <li class="mb-3"><a class="text-color" rel="nofollow" href="teacher.html">Our Teacher</a></li>
            <li class="mb-3"><a class="text-color" rel="nofollow" href="contact.html">Contact</a></li>
            <li class="mb-3"><a class="text-color" rel="nofollow" href="blog.html">Blog</a></li>
          </ul>
        </div>
        <!-- links -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">LINKS</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" rel="nofollow" href="courses.html">Courses</a></li>
            <li class="mb-3"><a class="text-color" rel="nofollow" href="event.html">Events</a></li>
            <li class="mb-3"><a class="text-color" rel="nofollow" href="gallary.html">Gallary</a></li>
            <li class="mb-3"><a class="text-color" rel="nofollow" href="faqs.html">FAQs</a></li>
          </ul>
        </div>
        <!-- support -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">SUPPORT</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" rel="nofollow" href="#">Forums</a></li>
            <li class="mb-3"><a class="text-color" rel="nofollow" href="#">Documentation</a></li>
            <li class="mb-3"><a class="text-color" rel="nofollow" href="#">Language</a></li>
            <li class="mb-3"><a class="text-color" rel="nofollow" href="#">Release Status</a></li>
          </ul>
        </div>
        <!-- support -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">RECOMMEND</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" rel="nofollow" href="#">WordPress</a></li>
            <li class="mb-3"><a class="text-color" rel="nofollow" href="#">LearnPress</a></li>
            <li class="mb-3"><a class="text-color" rel="nofollow" href="#">WooCommerce</a></li>
            <li class="mb-3"><a class="text-color" rel="nofollow" href="#">bbPress</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- copyright -->
  <div class="copyright py-4 bg-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-7 text-sm-left text-center">
          <p class="mb-0">TONPAL.COM Copyfight ©
            <script>
              var CurrentYear = new Date().getFullYear()
              document.write(CurrentYear)
            </script> 
            </p>
        </div>
        <div class="col-sm-5 text-sm-right text-center">
            <ul class="list-inline">
            <?php
            foreach ($footer_friendshipLinks as $key => $item) {
            ?>
            <li class="list-inline-item"><a class="d-inline-block p-2" rel="nofollow" href="<?php echo ifEmptyText($item['link']) ?>"><i class="<?php echo ifEmptyText($item['icon']) ?> text-primary"></i></a></li>
                <?php
            }
            ?>
            </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- /footer -->
<!-- jQuery -->
<script src="<?php echo get_template_directory_uri()?>/assets/plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo get_template_directory_uri()?>/assets/plugins/bootstrap/bootstrap.min.js"></script>
<!-- slick slider -->
<script src="<?php echo get_template_directory_uri()?>/assets/plugins/slick/slick.min.js"></script>
<!-- aos -->
<script src="<?php echo get_template_directory_uri()?>/assets/plugins/aos/aos.js"></script>
<!-- venobox popup -->
<script src="<?php echo get_template_directory_uri()?>/assets/plugins/venobox/venobox.min.js"></script>
<!-- filter -->
<script src="<?php echo get_template_directory_uri()?>/assets/plugins/filterizr/jquery.filterizr.min.js"></script>

<!-- Main Script -->
<script src="<?php echo get_template_directory_uri()?>/assets/js/script.js"></script>