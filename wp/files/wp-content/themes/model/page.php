<?php

/**
 * 具体单页面模板判断页面
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

<main>

<?php

	$data = get_post();
	
	while ( have_posts() ) :
		the_post();
	endwhile;
	
	if(strtolower($data->post_name) == 'about')
	{	
		include('templates/page/page-about.php');
	}
	elseif(strtolower($data->post_name) == 'contacts')
	{	
		include('templates/page/page-contacts.php');
	}
	else{
		include('templates/page/page.php');
	}


?>
    
<?php
get_footer();
