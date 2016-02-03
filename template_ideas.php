<?php 
	/*
	Template Name: Ideas List
	*/
	
	get_header(); 
?>

	<div class="container title toptitle ideatitle">
		<div class="col-md-12">
			<h1>
				<span><a href="<?php echo URL; ?>">Επιστροφή</a></span>
				<?php the_title(); ?>
			</h1>
			<a class="submit-idea" href="<?php echo get_permalink(16); ?>">
				Υπέβαλλε τη δική σου!
			</a>
		</div>
	</div>
	
	<div class="container main">
		<div class="col-md-8 white content archive idearch">
			<?php the_content(); ?>
			<?php 
				$catz = get_terms( 'idea_cat', array( 'hide_empty' => false ) );
				foreach($catz as $cat){
					$class='standard';
					$is_active = get_tax_meta($cat->term_id, 'opengov_is_active'); 
					$close_date = get_tax_meta($cat->term_id, 'opengov_close_date');
					if($is_active) $class='open';
				?>
						
						<div class="arch-item list-ideacat arch-<?php echo $class; ?>">
							<h2><a class="" href="<?php echo esc_url( get_term_link( $cat ) ); ?>" title="<?php echo  $cat->name; ?>"><?php echo  $cat->name; ?></a></h2>
							<div class="col-md-9">	
								<div class="idearchcontent">	
									<?php echo apply_filters('the_content', $cat->description ); ?>
								</div>
							</div>
							<div class="col-md-3">	
								<div class="idea-meta">
									<p class="idea-date">Έως <?php echo date('d/m/Y', strtotime($close_date)); ?></p>
									<p class="idea-comments">
										<a class="btn btn-default" href="<?php echo esc_url( get_term_link( $cat ) ); ?>" >Προβολή Ιδεών</a>
									</p>
									<?php if($is_active){ ?>
										<p class="idea-comments">
											<a class="btn btn-success" href="<?php echo get_permalink(16); ?>?call=<?php echo  $cat->term_id; ?>" >Υποβολή Ιδέας</a>
										</p>
									<?php } ?>
								</div>
							</div>
						</div>
			
				<?php
				}
			?>

			<?php 
				/*
				$args = array(
					'post_type' => 'idea'
				); 
			?>
			<?php query_posts($args); ?>
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
				
				<div class="arch-item">
				
					<h2><a class="" href="<?php the_permalink();?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h2>
					
					<div class="col-md-8">	
						
						<div class="idearchcontent">	
							<?php the_content(''); ?>
						</div>
						<?php $cats = get_the_terms(get_the_ID(), 'idea_cat'); ?>
						<?php foreach($cats as $cat){ echo '<a href="'.get_term_link( $cat).'" class="pull-left">'.$cat->name.'</a>'; break; } ?> 
						
						<a class="more" href="<?php the_permalink();?>" title="<?php the_title_attribute();?>">Διαβάστε περισσότερα &raquo;</a>
					</div>
					
					<div class="col-md-4">	
						<div class="idea-meta">
							<p class="idea-date"><?php the_time('j F Y'); ?></p>
							<p class="idea-user"><?php echo get_post_meta(get_the_ID(), 'user_name', true). ' '.get_post_meta(get_the_ID(), 'user_surname', true); ?></p>
							<p class="idea-comments">Σχόλια <?php comments_number( '0', '1', '%' ); ?></p>
						</div>
					</div>
					
				</div>
				
			<?php endwhile;  endif; wp_reset_query(); */ ?>
		</div>
		<div class="col-md-4">
			<?php get_sidebar('idea'); ?>
		</div>
	</div>
	
<?php get_footer(); ?>