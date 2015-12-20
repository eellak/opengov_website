<?php include('lib/sidebar-top.php'); ?>

<?php 
	if(function_exists('the_ratings') and is_singular() and get_post_type()=='idea') { 
		
		echo '<div id="ratings-widget" class="widget ratings-widget">';
			the_ratings(); 
		echo '</div>';
	
	} 
?>

<?php dynamic_sidebar( 'sidebar-ideas' ); ?>

<?php include('lib/sidebar-bottom.php'); ?>