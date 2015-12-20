<?php 
	/*
	Template Name: Ideas List
	*/
	
	get_header(); ?>

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
				
			<?php endwhile;  endif; wp_reset_query(); ?>
		</div>
		<div class="col-md-4">
			<?php get_sidebar('idea'); ?>
		</div>
	</div>
	
<?php get_footer(); ?>