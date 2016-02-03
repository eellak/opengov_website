<?php include('lib/sidebar-top.php'); ?>

<?php 
	if(function_exists('the_ratings') and is_singular() and get_post_type()=='idea') { 
		
		echo '<div id="ratings-widget" class="widget ratings-widget">';
			the_ratings(); 
		echo '</div>';
	
	} 
	
	global $cats;
	if(!empty($cats)){
		foreach($cats as $cat){ 
			echo '<div id="info-widget" class="widget info-widget">';
			echo '<h3>'.$cat->name.'</h3>';
			echo apply_filters('the_content', $cat->description );
			echo '</div>';
		}
	}
?>

<?php dynamic_sidebar( 'sidebar-ideas' ); ?>

<?php include('lib/sidebar-bottom.php'); ?>