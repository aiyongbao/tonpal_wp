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

