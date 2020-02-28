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

    if(function_exists('get_course'))
    {
        $course = get_course();
    }
    else{
        echo 'plugins it not active';
        $course = [];
    }
  ?>

<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        
        <?php
            if(!empty($course))
            {
                $item = '';
                foreach($course as $key => $value)
                {

                    $active = $key == 0 ? 'class="active"' : 'class=""' ;

                    $item .= <<<EOT
                        <li data-target="#carouselExampleCaptions" data-slide-to="{$key}" $active></li>
EOT;
                }
                echo $item;
            }
        ?>

    </ol>
        <div class="carousel-inner">
            
            <?php
                if(!empty($course))
                    {
                        $item = '';
                        foreach($course as $key => $value)
                        {
                            $active = $key == 0 ? 'active' : '' ;
                            $item .= <<<EOT
                            <div class="carousel-item {$active}">
                                <img src="{$value['image']}" class="d-block w-100" alt="{$value['title']}">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{$value['title']}</h5>
                                    <p>{$value['description']}</p>
                                </div>
                            </div>
EOT;
                        }
                        echo $item;
                    }
                ?>
            
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
</div>
