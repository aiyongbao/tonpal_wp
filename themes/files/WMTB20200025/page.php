<?php

	$data = get_post();
	
	while ( have_posts() ) :
		the_post();
	endwhile;
	if(strtolower($data->post_name) == 'aboutus')
	{	
		include('templates/page/page-about.php');
	}
	elseif(strtolower($data->post_name) == 'contactus')
	{	
		include('templates/page/page-contacts.php');
	}
    elseif(strtolower($data->post_name) == 'video' )
    {
        include('templates/page/page-video.php');
    }
    elseif(strtolower($data->post_name) == 'showcase')
    {
        include('templates/page/page-showcase.php');
    }
    elseif(strtolower($data->post_name) == 'certificate')
    {
        include('templates/page/page-certificate.php');
    }
    elseif(strtolower($data->post_name) == 'rec-product')
    {
        include('templates/page/rec-product.php');
    }
	else{
		include('templates/page/page.php');
	}
