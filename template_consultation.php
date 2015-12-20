<?php 
	/*
	Template Name: Consultation Pages
	*/
	
	get_header(); 
	
	global $post; 
	$top_link = '<a href="'.get_permalink().'">Εισαγωγή</a>';
	$parent_id = $post->post_parent;
	if($post->ID != $parent_id and $parent_id != 0){
		$parent = get_page($parent_id);
		$top_link = '<a href="'.get_permalink($parent_id).'">'.$parent->post_title.'</a>';
	} else {
		$parent_id = $post->ID;
	}
?>

	<div class="container title toptitle constitle">
		<div class="col-md-12">
			<h1>
				<span><?php echo $top_link; ?></span>
				<?php the_title(); ?>
			</h1>
			<a class="submit-idea" href="#comments">
				Σχολίασε!
			</a>
		</div>
	</div>
	
	<div class="container main">
		<div class="col-md-8">
			<div class="col-md-12 white content">
				<?php the_content(); ?>
			</div>
			<div class="col-md-12 consinfo">
				<!-- ΣΧΟΛΙΑ ΙΝΦΟ -->
			</div>
			<div class="col-md-12">
				<?php comments_template(); ?>
			</div>
		</div>
		<div class="col-md-4 sidebar">
			<?php include('lib/sidebar-top.php'); ?>

			<div class="version_info">Έκδοση 1.0</div>
			
			<div class="go_consultate">
				<a href="http://guest3.ellak.gr/cons/?p=19">
				Πάρτε μέρος στη διαβούλευση για τους στόχους του στρατηγικού
				</a>
			</div>
			
			<div class="cons_map">
				<div class="cons_map_title">
					Πλοήγηση
				</div>
				<ul class="cons_map_list">
				<?php
					$args = array(
						'child_of' 			=> $parent_id,
						'posts_per_page'	=> -1
					); 
					$pages = get_pages($args); 
					foreach($pages as $page){ $class = '';
						if($page->ID == $post->ID) $class = 'activeitem';
						echo '<li class="'.$class.'"><a href="'.get_permalink($page->ID).'">'.$page->post_title.'</a></li>';
					}
					wp_reset_query();
				?>
				</ul>
			</div>

			<?php include('lib/sidebar-bottom.php'); ?>
		</div>
	</div>
	
<?php get_footer(); ?>