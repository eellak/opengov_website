<?php 
	/*
	Template Name: Glossary
	*/
	
	get_header(); ?>
	
<?php if(have_posts()): while(have_posts()): the_post(); ?>

	<div class="container title toptitle glossary">
		<div class="col-md-12">
			<h1>
				<span><a href="<?php echo URL; ?>">Επιστροφή</a></span>
				<?php the_title(); ?>
			</h1>
		</div>
	</div>
	
	<div class="container main">
		<div class="col-md-12 white content glossary">
			<?php the_content(); ?>
			
			<div class="selector">
				<div class="btn-group" role="group" aria-label="...">
				<?php
					$glossary_cat_id = 0;
					
					if(isset($_GET['gcat']) and trim($_GET['gcat'] != '')){
						$glossary_cat_id = intval(trim($_GET['gcat']));
						echo '<a href="'.get_permalink().'" class="btn btn-default">Όλοι</a>';
					} else {
						echo '<a href="'.get_permalink().'" class="btn btn-default active">Όλοι</a>';
					}
						
					$args = array(
							'orderby'           => 'name', 
							'order'             => 'ASC',
							'hide_empty'        => false, 
						);
					$glossary_cats = get_terms('glossary_cat',$args);
					
					foreach($glossary_cats as $glossary_cat){
						$class = '';
						
						//if($glossary_cat_id == 0) $glossary_cat_id = $glossary_cat->term_id;
					
						if($glossary_cat->term_id == $glossary_cat_id)	$class = ' active';
						
						if($glossary_cat->count == 0) $class .= ' disabled';
							
						echo '<a href="'.get_permalink().'&gcat='.$glossary_cat->term_id.'" class="btn btn-default'.$class.'">'.$glossary_cat->name.'</a>';
		
					}
				?>
				</div>
			</div>
			
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				
				<?php
					$args = array(
						'post_type' 	=> 'glossary',
						'orderby' 		=> 'title', 
						'order'	 		=> 'ASC',
						'posts_per_page'	=> -1
					);
					
					if(isset($_GET['gcat']) and trim($_GET['gcat'] != '')){
						$args['tax_query']= array(
								'relation' 	=> 'AND',
								array(      
									'taxonomy' =>  'glossary_cat',
									'field' => 'id',
									'terms' => $glossary_cat_id,
								)
							);
					}
					
					$cnt = 1;
					$terms = query_posts($args );
					foreach($terms as $term){
						
						if($cnt == 1) $class = ' in'; 
						else $class = ''; 
						$cnt++;	
				?>
						  <div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading-<?php echo $term->ID; ?>">
							  <h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $term->ID; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $term->ID; ?>">
								 <?php echo $term->post_title; ?>
								</a>
							  </h4>
							</div>
							<div id="collapse-<?php echo $term->ID; ?>" class="panel-collapse collapse<?php echo $class; ?>" role="tabpanel" aria-labelledby="heading-<?php echo $term->ID; ?>">
							  <div class="panel-body">
								<?php echo apply_filters('the_content', $term->post_content); ?>
							  </div>
							</div>
						  </div>
			  <?php } ?>
			</div>
		</div>
		
		<?php wp_reset_query(); ?>
	</div>
	
<?php endwhile; else: include('lib/error.php'); endif; ?>	
<?php get_footer(); ?>