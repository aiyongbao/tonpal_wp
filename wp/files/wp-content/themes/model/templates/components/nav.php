<!-- navbar -->
<div class="navigation w-100">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <a class="navbar-brand" href="index.html"><img src="<?php echo get_template_directory_uri()?>/assets/images/logo.png" alt="logo"></a>
                <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navigation">

                    <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'primary',
                                        'menu_class' => 'navbar-nav ml-auto text-center',
                                        'container' => 'ul',
                                        'container_class' => 'nav-item'
                                    )
                                )
                            ?>
                    <?php endif; ?>
                    
                </div>
            </nav>
        </div>
    </div>