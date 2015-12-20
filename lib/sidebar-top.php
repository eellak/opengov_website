<div id="sidebar">
	
	<?php 
		if(function_exists('wpsocialite_markup')){
			echo '<div id="wpsocialite-widget" class="widget wpsocialite-widget">';
			wpsocialite_markup();
			echo '</div>';
		}
	?>
	
<?php dynamic_sidebar( 'sidebar-top' ); ?>