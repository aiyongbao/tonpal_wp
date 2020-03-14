
<h1>Products</h1>
<?php
    // Start the loop.
    while ( have_posts() ) : the_post();
?>
    <h1>
        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
            <?php the_title() ?>
        </a>
    </h1>  

    <div class="info">
        <?php the_excerpt();?>
    </div>

<?php
    endwhile;
?>
 
<?php get_footer(); ?>